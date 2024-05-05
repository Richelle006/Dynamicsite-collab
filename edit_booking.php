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

// Retrieve booking details
$sql = "SELECT * FROM Bookings WHERE booking_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $booking_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Booking not found.";
    exit();
}

// Close statement
$stmt->close();

// Handle form submission for editing booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to update booking details
    $new_booking_date = $_POST['booking_date'];
    $new_description = $_POST['description'];

    // Update booking details in the database
    $update_stmt = $conn->prepare("UPDATE Bookings SET booking_date = ?, description = ? WHERE booking_id = ?");
    $update_stmt->bind_param('ssi', $new_booking_date, $new_description, $booking_id);

    if ($update_stmt->execute()) {
        // Booking updated successfully
        header('Location: profile.php'); // Redirect to profile page after successful update
        exit();
    } else {
        echo "Error updating booking: " . $update_stmt->error;
    }

    // Close statement
    $update_stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="edit-booking-page">
        <h2>Edit Booking</h2>
        <form method="POST">
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" value="<?php echo $row['booking_date']; ?>" required>
            <br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
