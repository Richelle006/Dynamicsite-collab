<?php
session_start();
$message = '';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize the username and password
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Raw password, unescaped for password hashing purposes
    $is_new_user = isset($_POST['new_user']) && $_POST['new_user'] == 'on';

    if ($is_new_user) {
        // Register a new user by hashing the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $password_hash);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username; // Set session variable
            $user_id = $conn->insert_id;
            $_SESSION['user_id'] = $user_id;

             // Set a cookie for the login time
             setcookie("login_time", date("Y-m-d H:i:s"), time() + (86400 * 30), "/"); // 30 days expiry

    
            // Redirect the user to the appropriate page
            header('Location: index.php');
            exit();
        } else {
            $message = 'Error registering user.';
        }
    } else {
        // Existing user login
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $stored_password = $row['password'];

            // Verify the entered password against the stored hash
            if (password_verify($password, $stored_password)) {
                $_SESSION['username'] = $username; 
                $_SESSION['user_id'] = $user_id;   
                 // Set the last login time cookie
                 if (isset($_COOKIE["login_time"])) {
                    setcookie("last_login_time", $_COOKIE["login_time"], time() + (86400 * 30), "/");
                }

                // Set the current login time cookie
                setcookie("login_time", date("Y-m-d H:i:s"), time() + (86400 * 30), "/"); // 30 days expiry

                header('Location: index.php');
                exit();
            } else {
                $message = 'Incorrect password.';
            }
        } else {
            $message = 'User not found.';
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <h2>Login or Register</h2>
            <form method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="checkbox" id="new_user" name="new_user">
                <label for="new_user">New User</label>
                <br>
                <button type="submit">Submit</button>
            </form>
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>
    </div>
</body>
</html>
