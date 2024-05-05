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
            <?php
// Check if there is a message to display
if (!empty($message)) {
    echo '<p>' . htmlspecialchars($message) . '</p>';
}
?>
        </div>
    </div>
</body>
</html>