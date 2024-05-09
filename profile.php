<?php
session_start();
$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve services from the database
$sql = "SELECT service_id, service_name FROM services";
$result = $conn->query($sql);

$services = [];

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[$row['service_id']] = $row['service_name'];
    }
} else {
    die("No services found in the database.");
}


// Retrieve user's bookings
$user_id = $_SESSION['user_id'];
$sql_bookings = "SELECT * FROM bookings WHERE user_id = ?";
$stmt_bookings = $conn->prepare($sql_bookings);
$stmt_bookings->bind_param('i', $user_id);
$stmt_bookings->execute();
$result_bookings = $stmt_bookings->get_result();
$stmt_bookings->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .profile-container {
            margin: 20px auto;
            max-width: 800px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Drop shadow */
            background-color: rgba(255, 255, 255, 0.5); /* White with 50% opacity */
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2; /* Light gray background for table header */
        }
        
        tr:hover {
            background-color: #ddd; /* Darker gray background when hovering over a row */
        }
        
        a {
            color: blue;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <header>
        <!-- Header content -->
        <div class="header-content">
            <img src="resources/logo.png" alt="Framed Memories Studio Logo" class="site-logo">
        </div>
        
        <!-- Navigation menu -->
        <nav id="navbar">
            <ul>
                <!-- Navigation links -->
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

                <!-- Profile link -->
                <?php 
                if (isset($_SESSION['username'])) {
                    $username = htmlspecialchars($_SESSION['username']);
                    echo "<li><a href='profile.php' class='username'>My Profile: $username</a></li>";
                } else {
                    // If the user is not logged in, show a login link instead
                    echo "<li><a href='login.php' class='username'>Login</a></li>";
                }
                
                // Logout link
                if (isset($_SESSION['username'])) {
                    echo "<li><a href='logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    
    <!-- Profile section -->
    <section id="profile-section">
        <div class="profile-container">
            <h2>My Bookings</h2>
            <table>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Booking Date</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result_bookings->fetch_assoc()): ?>
                <tr>
                    <td><?php echo isset($services[$row['service_id']]) ? $services[$row['service_id']] : 'Service Not Found'; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <!-- <td>
                        <?php
                        // Check if the service_id exists in the $services array
                        if (isset($services[$row['service_id']])) {
                            // Retrieve the service information
                            $service_info = $services[$row['service_id']];
                            // Check if the price attribute exists in the service information
                            if (isset($service_info['price'])) {
                                echo $service_info['price'];
                            } else {
                                echo 'Price Not Available';
                            }
                        } else {
                            echo 'Service Not Found';
                        }
                        ?>
                    </td> -->
                    <td>
                        <a href="edit_booking.php?id=<?php echo $row['booking_id']; ?>">Edit</a>
                        <a href="delete_booking.php?id=<?php echo $row['booking_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </section>
    
    <!-- Footer section -->
    <footer class="footer">
        <!-- Operating Hours -->
        <div class="footer-hours">
            <h3>Operating Hours</h3>
            <p>Monday – Friday: 9am – 5pm</p>
            <p>Saturday: 10am – 4pm</p>
            <p>Sunday: Closed</p>
        </div>

        <!-- Social Media Links -->
        <div class="footer-social">
            <h3>Follow Us</h3>
            <a href="https://www.facebook.com/" target="_blank" aria-label="Facebook">
                <img src="resources/fb.png" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/" target="_blank" aria-label="Instagram">
                <img src="resources/insta.png" alt="Instagram">
            </a>
        </div>

        <!-- Google Map -->
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
        
        <!-- Contact Information -->
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p><img src="resources/address.png" alt="Address"> 676 Princes Highway, Sydney NSW 2217</p>
            <p><img src="resources/email.png" alt="Email"> info@framedmemoriesstudios.com.au</p>
            <p><img src="resources/call.png" alt="Phone"> +123 456 7890</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="scripts.js"></script>
</body>
</html>
<?php
$conn->close();
?>