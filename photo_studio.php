<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
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
             
                        <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php"><img src="resources/login.png" alt="" class="menu-icon">Login</a></li>
                    <?php endif; ?>

             
                </ul>
            </nav>
        </header>




  <!-- Photo Studio Section -->
<section id="photo-studio">
    <div class="studio-container">
        <!-- Text Container -->
        <div class="content-area">
            <h2>Photo Studio</h2>
            <p>Where we capture the moments that matter most to you, our professional photographers specialize in a variety of styles to perfectly suit your individual needs. With a keen eye for detail and a passion for capturing genuine emotions, our studio ensures that each snapshot tells a unique story. Whether it’s a spontaneous laugh or a tender glance, we transform these fleeting seconds into lasting memories. Come and create your visual legacy with us, where every picture is a work of heart, meticulously framed to be treasured for a lifetime.
            </p>
        </div>

        <!-- Slideshow Container -->
        <div class="slideshow-container">
            <!-- Slides -->
            <div class="mySlides fade">
                <img src="resources/ps1.jpg" alt="Studio Picture">
            </div>
            <div class="mySlides fade">
                <img src="resources/ps2.jpg" alt="Studio Picture 2">
            </div>
            <div class="mySlides fade">
                <img src="resources/ps3.jpg" alt="Studio Picture 3">
            </div>
            <div class="mySlides fade">
                <img src="resources/ps4.jpg" alt="Studio Picture 4">
            </div>
            <div class="mySlides fade">
                <img src="resources/ps5.jpg" alt="Studio Picture 5">
            </div>
            <div class="mySlides fade">
                <img src="resources/ps6.jpg" alt="Studio Picture 6">
            </div>
            <!-- Navigation Arrows -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>
</section>





        
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