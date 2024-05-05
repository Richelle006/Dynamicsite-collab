<?php
session_start();
// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Database connection and retrieval of booking data for the logged-in user
include 'process_booking.php'; // Include database connection script
$username = $_SESSION['username']; // Assuming you have a user ID in your database
// Query to retrieve booking data for the user
// Adjust this query according to your database schema
$sql = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch booking data into an associative array
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-page">
        <div class="profile-container">
            <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
            <h3>Your Bookings:</h3>
            <ul>
                <?php foreach ($bookings as $booking): ?>
                    <li>
                        <?php echo $booking['booking_info']; ?>
                        <!-- Add edit and delete links/buttons here -->
                        <a href="edit_booking.php?id=<?php echo $booking['id']; ?>">Edit</a>
                        <a href="delete_booking.php?id=<?php echo $booking['id']; ?>">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
