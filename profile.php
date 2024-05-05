<?php
session_start();

// Redirect to login page if user_id is not set
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
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

// Retrieve the user_id from the session
$user_id = $_SESSION['user_id'];

// Retrieve user's bookings based on user_id
$sql = "SELECT b.booking_id, b.booking_date, s.service_name, b.description
        FROM Bookings b
        JOIN Services s ON b.service_id = s.service_id
        JOIN Users u ON b.user_id = u.user_id
        WHERE u.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
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
            <img src="resources/logo.png" alt="Framed Memories Studio Logo" class="site-logo">
        </div>
        <nav id="navbar">
            <ul>
                <li><a href="index.php"><img src="resources/home-button.png" alt="" class="menu-icon">Home</a></li>
                <li><a href="about.php"><img src="resources/about us.png" alt="" class="menu-icon">About Us</a></li>
                <li class="dropdown">
                    <a href="services.php"><img src="resources/services.png" alt="" class="menu-icon">Services</a>
                    <div class="dropdown-content">
                        <a href="photo_studio.php">Photo Studio</a>
                        <a href="customized_frame.php">Customized Frame</a>
                        <a href="events_workshops.php">Events & Workshops</a>
                    </div>
                </li>
                <li><a href="booking.php"><img src="resources/booking.png" alt="" class="menu-icon">Booking</a></li>
                <li><a href="contact.php"><img src="resources/contact us.png" alt="" class="menu-icon">Contact</a></li>

                <?php 
                    if (isset($_SESSION['user_id'])) {
                        $user_id = htmlspecialchars($_SESSION['user_id']);
                        echo "<li><a href='profile.php' class='user_id'>My Profile: $user_id</a></li>";
                    } else {
                        // If the user is not logged in, show a login link instead
                        echo "<li><a href='login.php' class='user_id'>Login</a></li>";
                    }
                    
                    // Display the "Logout" link if the user is logged in
                    if (isset($_SESSION['user_id'])) {
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    }
                
                ?>

            </ul>
        </nav>
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

         <!-- "FOOTER" SECTION INDEX -->
         <footer class="footer">
            <div class="footer-hours">
                <h3>Operating Hours</h3>
                <p>Monday – Friday: 9am – 5pm</p>
                <p>Saturday: 10am – 4pm</p>
                <p>Sunday: Closed</p>
            </div>
        
            <div class="footer-social">
                <h3>Follow Us</h3>
                <a href="https://www.facebook.com/" target="_blank" aria-label="Facebook">
                    <img src="resources/fb.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/" target="_blank" aria-label="Instagram">
                    <img src="resources/insta.png" alt="Instagram">
                </a>
            </div>

            <div class="footer-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13236.892065074411!2d151.12603910928777!3d-33.96110692077346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12b9fda64fa8f9%3A0xd1480172c44825ab!2s676%20Princes%20Hwy%2C%20Kogarah%20NSW%202217!5e0!3m2!1sen!2sau!4v1712456775204!5m2!1sen!2sau"
                    width="400"
                    height="200"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                ></iframe>
            </div>

            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p><img src="resources/address.png" alt="Address"> 676 Princes Highway, Sydney NSW 2217</p>
                <p><img src="resources/email.png" alt="Email"> info@framedmemoriesstudio.com.au</p>
                <p><img src="resources/call.png" alt="Phone"> +123 456 7890</p>
            </div>
        </footer>
        
        
    <script src="scripts.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
