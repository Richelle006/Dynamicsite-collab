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
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
        <style>
        .service-action {
        display: flex;
        justify-content: center;
        }
    </style>
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
  <section id="services-intro">
    <div class="container">
        <h2 class="section-title">Services</h2>
        <p>We're dedicated to providing top-notch services to capture and enhance your precious moments. Explore our range of professional services tailored to meet all your photography needs.</p>
    </div>
</section>

<section id="services" class="services">
    <div class="service">
        <h3>PHOTO STUDIO</h3>
        <img src="resources/18.jpg" alt="Photo Studio">
        <p>Our Photo Studio is equipped with state-of-the-art lighting and a spacious cyclorama, ideal for all kinds of photography projects.</p>
        <div class="service-action">
            <button onclick="redirectToGallery()">View Gallery</button>
            <button onclick="redirectToBookingPage()">Book Studio</button>
        </div>
    </div>

<script>
function redirectToGallery() {
    window.location.href = 'gallery.php';
}

function redirectToBookingPage() {
    window.location.href = 'booking.php#photostudio';
}
</script>
    </div>
    <div class="service">
        <h3>CUSTOMIZED FRAME </h3>
        <img src="resources/4.jpg" alt="Customized Frame">
        <p>Enhance the beauty of your portraits with our bespoke framing services, offering a variety of styles and materials.</p>
        <div class="service-action">
        <button onclick="redirectToFrames()">View Frames</button>
        <button onclick="redirectToBookingPage()">Book Studio</button>
    </div>

<script>
    function redirectToFrames() {
        window.location.href = 'frames.php';
    }

    function redirectToBookingPage() {
        window.location.href = 'booking.php#photostudio';
    }
</script>
</div>
    <div class="service">
        <h3>EVENTS & WORKSHOPS </h3>
        <img src="resources/20.jpg" alt="Events & Workshops">
        <p>Join our workshops or host your event in a creative setting, perfect for learning, celebrating events, and networking.</p>
        <div class="service-action">
        <button onclick="redirectToEvents()">View Events</button>
        <button onclick="redirectToBookingPage()">Book Studio</button>
    </div>

<script>
    function redirectToEvents() {
        window.location.href = 'event.php';
    }

    function redirectToBookingPage() {
        window.location.href = 'booking.php#photostudio';
    }
</script>
</div>
</section>

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