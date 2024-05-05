<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

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

// Retrieve the user_id from the session
$user_id = $_SESSION['user_id'];

// Retrieve user's bookings
$sql = "SELECT b.booking_id, b.booking_date, s.service_name, b.description 
        FROM Bookings b
        JOIN Services s ON b.service_id = s.service_id
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Close the statement
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="header-content">
            <img src="resources/logo.png" alt="Site Logo" class="site-logo">
            <nav id="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li class="dropdown">
                        <a href="services.php">Services</a>
                        <div class="dropdown-content">
                            <a href="photo_studio.php">Photo Studio</a>
                            <a href="customized_frame.php">Customized Frame</a>
                            <a href="events_workshops.php">Events & Workshops</a>
                        </div>
                    </li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php 
                        // Display the My Profile link and Logout link if the user is logged in
                        if (isset($_SESSION['user_id'])) {
                            echo "<li><a href='profile.php'>My Profile</a></li>";
                            echo "<li><a href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<li><a href='login.php'>Login</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="profile-page">
        <h2>User Profile</h2>
        <h3>My Bookings</h3>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['booking_id']); ?></td>
                <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="edit_booking.php?id=<?php echo urlencode($row['booking_id']); ?>">Edit</a>
                    <a href="delete_booking.php?id=<?php echo urlencode($row['booking_id']); ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <!-- Include your footer content here -->
    </footer>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
