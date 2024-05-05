<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Database connection details
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "UserDB";

// Create a connection to the database
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user's bookings
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Bookings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();

// Check for any errors in the statement execution
if ($stmt->errno) {
    die("SQL Error: " . $stmt->error);
}

// Fetch results
$result = $stmt->get_result();

// Add headers for security
header('Content-Type: text/html; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

// Close the statement and the connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="header-content">
            <img src="resources/logo.png" alt="Framed Memories Studio Logo" class="site-logo">
        </div>
        <nav id="navbar">
            <ul>
                <li><a href="index.php"><img src="resources/home-button.png" alt="" class="menu-icon">Home</a></li>
                <li><a href="about.php"><img src="resources/about_us.png" alt="" class="menu-icon">About Us</a></li>
                <li class="dropdown">
                    <a href="services.php"><img src="resources/services.png" alt="" class="menu-icon">Services</a>
                    <div class="dropdown-content">
                        <a href="photo_studio.php">Photo Studio</a>
                        <a href="customized_frame.php">Customized Frame</a>
                        <a href="events_workshops.php">Events & Workshops</a>
                    </div>
                </li>
                <li><a href="booking.php"><img src="resources/booking.png" alt="" class="menu-icon">Booking</a></li>
                <li><a href="contact.php"><img src="resources/contact_us.png" alt="" class="menu-icon">Contact</a>
                </li>
                <li><a href="logout.php">Logout</a></li> <!-- Updated to point to logout.php -->
            </ul>
        </nav>
    </header>

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
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['booking_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['service_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>";
                    echo "<a href='edit_booking.php?id=" . urlencode($row['booking_id']) . "'>Edit</a> ";
                    echo "<a href='delete_booking.php?id=" . urlencode($row['booking_id']) . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No bookings found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
