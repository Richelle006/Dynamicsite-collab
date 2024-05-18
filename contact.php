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
    

    

                <!-- "CONTACT" SECTION Page -->
                <section id="contact">
                    <div class="container contact-container">
                        <div class="contact-info">
                            <h2>Get in touch.</h2>
                            <p>We offer multi-day discounts, event space, workshops, and customizable package bundles. Just drop us a message to get the convo started.</p>
                            <form id="contact-form">
                                <label for="name">Name (required)</label>
                                <input type="text" id="name" name="name" placeholder="First Name" required>
                                <input type="text" name="surname" placeholder="Last Name">
                                
                                <label for="email">Email (required)</label>
                                <input type="email" id="email" name="email" required>
                                
                                <label for="subject">Subject (required)</label>
                                <input type="text" id="subject" name="subject" required>
                                
                                <label for="message">Message (required)</label>
                                <textarea id="message" name="message" required></textarea>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                        <div class="contact-image">
                            <img src="resources/2.jpg" alt="Contact Us Photo">
                        </div>
                    </div>
                </section>


         <!-- "FOOTER" SECTION Page-->
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