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

// Check if booking ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "Booking ID is missing.";
    exit();
}

$booking_id = $_GET['id'];

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the booking belongs to the logged-in user
$check_stmt = $conn->prepare("SELECT * FROM Bookings WHERE booking_id = ? AND user_id = ?");
$check_stmt->bind_param('ii', $booking_id, $_SESSION['user_id']);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows != 1) {
    echo "Booking not found or does not belong to the current user.";
    exit();
}

// Close statement
$check_stmt->close();

// Delete the booking from the database
$delete_stmt = $conn->prepare("DELETE FROM Bookings WHERE booking_id = ?");
$delete_stmt->bind_param('i', $booking_id);

if ($delete_stmt->execute()) {
    // Booking deleted successfully
    header('Location: profile.php'); // Redirect to profile page after successful deletion
    exit();
} else {
    echo "Error deleting booking: " . $delete_stmt->error;
}

// Close statement
$delete_stmt->close();

// Close connection
$conn->close();
?>
