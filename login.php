<?php
session_start();

// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password (you can add more robust validation here)
    if (empty($username) || empty($password)) {
        echo "Please enter both username and password.";
    } else {
        // Prepare and execute SQL query to retrieve user details
        $stmt = $conn->prepare("SELECT user_id, username, password FROM Users WHERE username = ?");
        $stmt->bind_param("s", $username);
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
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close database connection
$conn->close();
?>
