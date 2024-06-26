<?php
 session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
// Retrieve services from db
$sql = "SELECT service_id, service_name, price FROM services";
$result = $conn->query($sql);
$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[$row['service_id']] = [
            'service_name' => $row['service_name'],
            'price' => $row['price']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
                <li><a href="booking.php"><img src="resources/booking.png"  alt="" class="menu-icon">Booking</a></li>
                <li><a href="contact.php"><img src="resources/contact us.png" alt="" class="menu-icon">Contact</a></li>

                <!--Profile-->
                <?php 
                if (isset($_SESSION['username'])) {
                    $username = htmlspecialchars($_SESSION['username']);
                    echo "<li><a href='profile.php' class='username'>My Profile: $username</a></li>";
                } else {
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
    
    <!-- Booking-->
    <section id="booking-section">
        <div class="booking-container">
          <div class="booking-form">
              <h3>Book Your Session</h3>
              <form method="POST" action="process_booking.php" id="bookingForm">
                  <label for="booking-date">Choose a Date:</label>
                  <input type="date" id="booking-date" name="booking-date" required>
                  <br>
                  <label for="service-avail">Service to Avail:</label>
                  <select id="service-avail" name="service-avail" required>
                        <option value="">Select a Service</option>
                        <?php foreach ($services as $service_id => $service): ?>
                        <option value="<?php echo $service_id; ?>">
                        <?php echo $service['service_name']; ?> 
                        <?php echo $service['price']; ?></option>
                        <?php endforeach; ?>
                  </select>
                  <br>
                  <label for="event-description">Event Description:</label>
                  <input type="text" id="event-description" name="event-description" placeholder="e.g., Wedding, Birthday" required>
                  <br>
                  <button type="button" id="book-now-button">Book Now</button>
              </form>
          </div>
            <div class="booking-details">
                <h2>BOOK NOW!</h2>
                <p>Don’t miss out on the moments that matter. Frame your memories in style with our expertly crafted photo sessions. Ready to create timeless memories? Book your session with <b>Framed Memories Studio!</b></p>
            </div>
            <!--Slideshow-->
            <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="resources/20.jpg" alt="Event Photo 1">
            </div>
            <div class="mySlides fade">
                <img src="resources/19.jpg" alt="Event Photo 2">
            </div>
            <div class="mySlides fade">
                <img src="resources/5.jpg" alt="Event Photo 3">
            </div>
            <div class="mySlides fade">
                <img src="resources/6.jpg" alt="Event Photo 4">
            </div>
            <div class="mySlides fade">
                <img src="resources/4.jpg" alt="Event Photo 5">
            </div>
            </div>
        </div>
        </section>
    
    <!--Footer-->
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
        <p><img src="resources/email.png" alt="Email"> info@framedmemoriesstudios.com.au</p>
        <p><img src="resources/call.png" alt="Phone"> +123 456 7890</p>
    </div>
</footer>

    <script src="scripts.js"></script>
</body>
</html>