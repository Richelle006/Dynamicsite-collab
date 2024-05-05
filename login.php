<?php
session_start();

// Database connection credentials
$message = '';
$servername = "localhost";
$username = "root";
$password = "";
$db_username = "root";
$db_password = "";
$dbname = "UserDB";

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Retrieve and sanitize the username and password
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Raw password, unescaped for password hashing purposes
    $is_new_user = isset($_POST['new_user']) && $_POST['new_user'] == 'on';

    // Validate username and password (you can add more robust validation here)
    if (empty($username) || empty($password)) {
        echo "Please enter both username and password.";
    if ($is_new_user) {
        // Register a new user by hashing the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $password_hash);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username; // Set session variable
            header('Location: index.php');     // Redirect to the homepage
            exit();
        } else {
            $message = 'Error registering user.';
        }
    } else {
        // Prepare and execute SQL query to retrieve user details
        $stmt = $conn->prepare("SELECT user_id, username, password FROM Users WHERE username = ?");
        $stmt->bind_param("s", $username);
        // Existing user login
        $stmt = $conn->prepare("SELECT user_id, password FROM Users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row was returned
        if ($result->num_rows == 1) {
            // Fetch user details from the result set
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set user_id in session and redirect to profile page
                $_SESSION['user_id'] = $row['user_id'];
                header("Location: profile.php");
                exit;
            $user_id = $row['user_id'];
            $stored_password = $row['password'];

            // Verify the entered password against the stored hash
            if (password_verify($password, $stored_password)) {
                $_SESSION['user_id'] = $user_id; // Set session variable
                header('Location: index.php');    // Redirect to the homepage
                exit();
            } else {
                echo "Invalid password.";
                $message = 'Incorrect password.';
            }
        } else {
            echo "User not found.";
            $message = 'User not found.';
        }

        // Close statement
        $stmt->close();
    }
}

// Close database connection
$conn->close();
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