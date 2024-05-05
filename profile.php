<?php
session_start();

// Redirect to login page if username is not set
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: login.php');
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

// Retrieve the username from the session
$username = $_SESSION['username'];

// Retrieve user's bookings based on username
$sql = "SELECT b.booking_id, b.booking_date, s.service_name, b.description
        FROM Bookings b
        JOIN Services s ON b.service_id = s.service_id
        JOIN Users u ON b.user_id = u.user_id
        WHERE u.username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
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
        <!-- Add your header content here -->
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
        <!-- Add your footer content here -->
    </footer>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
