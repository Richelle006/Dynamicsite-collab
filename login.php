<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if(!isset($_SESSION['username'])) { ?>
    <!-- Show login form if user is not logged in -->
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
    <?php } else { ?>
    <!-- Show logged-in user content -->
    <div class="logged-in-content">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <!-- Add your navigation or other content here for logged-in users -->
    </div>
    <?php } ?>
</body>
</html>
