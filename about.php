<?php
session_start();
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
        <div class="header-content">
            <img src="resources/logo.png" alt="Framed Memories Studio Logo" class="site-logo">
        </div>
        <nav id="navbar">
            <ul>
                <li><a href="index.php"><img src="resources/home-button.png" alt="Home Icon" class="menu-icon">Home</a></li>
                <li><a href="about.php"><img src="resources/about us.png" alt="About Us Icon" class="menu-icon">About Us</a></li>
                <li class="dropdown">
                    <a href="services.php"><img src="resources/services.png" alt="Services Icon" class="menu-icon">Services</a>
                    <div class="dropdown-content">
                        <a href="photo_studio.php">Photo Studio</a>
                        <a href="customized_frame.php">Customized Frame</a>
                        <a href="events_workshops.php">Events & Workshops</a>
                    </div>
                </li>
                <li><a href="booking.php"><img src="resources/booking.png" alt="Booking Icon" class="menu-icon">Booking</a></li>
                <li><a href="contact.php"><img src="resources/contact us.png" alt="Contact Us Icon" class="menu-icon">Contact</a></li>

                <?php 
                    if (isset($_SESSION['username'])) {
                        $username = htmlspecialchars($_SESSION['username']);
                        echo "<li><a href='profile.php' class='username'>My Profile: $username</a></li>";
                    } else {
                        // If the user is not logged in, show a login link instead
                        echo "<li><a href='login.php' class='username'>Login</a></li>";
                    }
                    
                    // Display the "Logout" link if the user is logged in
                    if (isset($_SESSION['username'])) {
                        echo "<li><a href='logout.php'>Logout</a></li>";
                    }
                
                ?>
            </ul>
        </nav>
    </header>
    

      <!-- About Framed Memories Studio Section -->
    <main>
      
<section class="about-studio-section">
    <div class="container">
        <div class="about-studio-content">
            <h1>About Us</h1>
            <p>At Framed Memories Studio, we believe in the power of a photograph to tell a story, immortalize a moment, and open a window to the past. Our state-of-the-art photo studio, diverse range of customized frame products, and flexible event spaces provide a one-stop-shop for all your photography needs. From weddings and birthdays to corporate events and intimate workshops, our team's expertise ensures that your special moments are captured and preserved with care.</p>
        </div>
        <div class="about-studio-image">
            <img src="resources/7.jpg" alt="About Our Studio">
        </div>
    </div>
</section>

<!-- Our Philosophy Section -->
<section class="philosophy-section">
    <div class="container">
        <div class="philosophy-image">
            <img src="resources/3.jpg" alt="Our Philosophy">
        </div>
        <div class="philosophy-content">
            <h2>Our Philosophy</h2>
            <p>Every snapshot has a story, and every frame is a gateway to reliving cherished memories. We strive to make professional photography accessible and enjoyable for everyone, ensuring each client feels valued and each moment is captured with precision and artistry.</p>
        </div>
    </div>
</section>

        <section class="team">
            <h2 class="team-title">Meet Our Team</h2>
            <div class="team-members">
                <div class="member">
                    <img src="resources/8.jpg" alt="Ella Brown" class="member-photo">
                    <h3>Ella Brown</h3>
                    <p>Owner-Photographer</p>
                </div>
                <div class="member">
                    <img src="resources/9.jpg" alt="John White" class="member-photo">
                    <h3>John White</h3>
                    <p>Photographer</p>
                </div>
                <div class="member">
                    <img src="resources/11.jpg" alt="Sarah Mcconell" class="member-photo">
                    <h3>Sarah Mcconell</h3>
                    <p>Wardrobe Stylist</p>
                </div>

                <div class="member">
                    <img src="resources/10.jpg" alt="Team Member Name" class="responsive">
                    <h3>Stacey Lipa</h3>
                    <p>Make-up Artist</p>
                </div>
               
            </div>
        </section>

    </main>
  

    
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
        <p><img src="resources/email.png" alt="Email"> info@framedmemoriesstudios.com.au</p>
        <p><img src="resources/call.png" alt="Phone"> +123 456 7890</p>
    </div>
</footer>

    <script src="scripts.js"></script>
</body>
</html>
