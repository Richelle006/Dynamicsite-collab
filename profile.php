<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's bookings
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Close statement
$stmt->close();

// Close connection
$conn->close();
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
        <h2>User Profile</h2>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Service</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td><?php echo $row['service_id']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="edit_booking.php?id=<?php echo $row['booking_id']; ?>">Edit</a>
                    <a href="delete_booking.php?id=<?php echo $row['booking_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
