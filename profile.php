<?php
session_start();

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Database connection
include 'process_booking.php';

// Retrieve booking data for the logged-in user
$user_id = $_SESSION['user_id']; // Assuming you have a user ID in your database
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
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <h3>Your Bookings:</h3>
        <table>
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Service Type</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['booking_date']; ?></td>
                        <td><?php echo $booking['service_type']; ?></td>
                        <td><?php echo $booking['description']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?php echo $booking['id']; ?>">Edit</a>
                            <a href="delete_booking.php?id=<?php echo $booking['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
