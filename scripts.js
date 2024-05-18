
// to make the video auto play and pause when user toggle outside the video
document.addEventListener('DOMContentLoaded', (event) => {
    const video = document.getElementById('mainVideo');

       const togglePlayVideo = () => {
        if (isInView(video)) {
            video.play();
        } else {
            video.pause();
        }
    };
});

//CONTACT US (Validate Form)

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        if (validateForm()) {
            alert('Thank you for your inquiry. Your message has been submitted.');
            form.reset();
        } else {
            alert('Please fill out all required fields correctly.');
        }
    });
});

function validateForm() {
    let isValid = true;

    // Required fields
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const subject = document.getElementById('subject');
    const message = document.getElementById('message');

    if (!name.value.trim()) {
        isValid = false;
        alert('Name is required');
    } else if (!/^[a-zA-Z-' ]*$/.test(name.value.trim())) {
        isValid = false;
        alert('Name can only contain letters and white space');
    }

    if (!email.value.trim()) {
        isValid = false;
        alert('Email is required');
    } else if (!validateEmail(email.value.trim())) {
        isValid = false;
        alert('Invalid email format');
    }

    if (!subject.value.trim()) {
        isValid = false;
        alert('Subject is required');
    }

    if (!message.value.trim()) {
        isValid = false;
        alert('Message is required');
    }

    // Custom validation (example)
    if (message.value.length < 10) {
        isValid = false;
        alert('Message should be at least 10 characters long');
    }

    return isValid;
}

function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
}





//FOR THE SLIDESHOW IN THE BOOKING SECTION
let slideIndex = 0;
showSlides();

// Function to show a specific slide
function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    // Move to the next slide
    slideIndex++;
    // If we're over the number of slides, reset to the first slide
    if (slideIndex > slides.length) { 
        slideIndex = 1;
    }
    // Display the current slide
    slides[slideIndex - 1].style.display = "block";
    // Change slide every 2 seconds
    setTimeout(showSlides, 2000);
}


//Booking Section BOOK NOW
document.getElementById('book-now-button').addEventListener('click', function () {
    // Get form values
    var date = document.getElementById('booking-date').value;
    var service = document.getElementById('service-avail').value;
    var description = document.getElementById('event-description').value;

    // Basic validation
    if (!date || service === "" || !description) {
        alert('Please fill in all fields.');
        return;
    }

    // Create a FormData object for AJAX request
    var formData = new FormData();
    formData.append('booking-date', date);
    formData.append('service-avail', service);
    formData.append('event-description', description);

    // Send AJAX request using Fetch API
    fetch('process_booking.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Display the response message
        document.getElementById('bookingForm').reset(); // Reset the form
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Booking failed. Please try again.');
    });
});



  //PHOTO STUDIO PAGE
  document.addEventListener('DOMContentLoaded', function() {
    var slideIndexphoto = 1;
    showSlides(slideIndexphoto);
    
    // Function to change the slide
    window.plusSlides = function(n) {
        showSlides(slideIndexphoto += n);
        document.getElementById("caption").innerText = "Test caption for slide " + slideIndexphoto;
    };

    function showSlides(n) {
        var slides = document.getElementsByClassName("mySlides");
        var captionText = document.getElementById("caption");

        console.log('Current slide index: ' + slideIndexphoto);

        if (n > slides.length) { slideIndexphoto = 1; }
        if (n < 1) { slideIndexphoto = slides.length; }

        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndexphoto - 1].style.display = "block";

        console.log('Current caption: ' + captions[slideIndexphoto - 1]);

        captionText.innerHTML = captions[slideIndexphoto - 1];
    }
});


//EVENTS AND WORKSHOP Page
document.addEventListener('DOMContentLoaded', function() {
    var slideIndexEW = 1;
    showSlidesEW(slideIndexEW);

    // Function to change the slide
    window.plusSlides = function(n) {
        showSlidesEW(slideIndexEW += n);
    };

    function showSlidesEW(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {slideIndexEW = 1}
        if (n < 1) {slideIndexEW = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndexEW - 1].style.display = "block";
    }
});
