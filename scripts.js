
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

//Document to validate the Contact-Us button, making sure all fields have inputs
//and not blank and that is correct in format
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Check if the form fields are valid (this function should contain your validation logic)
        if (validateForm()) {
            // If valid, show an alert box
            alert('Thank you for your inquiry. Your message has been submitted.');
            // upon validation, it will reset the form
            form.reset();
        } else {
            // If not valid, show an error message
            alert('Please fill out all required fields correctly.');
        }
    });
});

function validateForm() {
    return true; 
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
