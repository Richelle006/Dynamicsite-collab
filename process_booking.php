<?php
session_start();
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

// Retrieve data from the form via POST
$booking_date = $_POST['booking-date'];
$service_name = $_POST['service-avail'];
$description = $_POST['event-description'];

// Validate inputs
if (empty($booking_date) || empty($service_name) || empty($description)) {
    echo "All fields are required!";
    exit;
}

// Check if $_SESSION['user_id'] is set before accessing it
if (isset($_SESSION['user_id'])) {
    // Get user_id from the session 
    $user_id = $_SESSION['user_id'];

    // Function to get service_id based on service_name
    function getServiceId($conn, $service_name) {
        $stmt = $conn->prepare("SELECT service_id FROM services WHERE service_name = ?");
        $stmt->bind_param('s', $service_name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Fetch the row
            $row = $result->fetch_assoc();

            // Return the value of 'service_id'
            return $row['service_id'];
        } else {
            return null;
        }
    }

    // Get service_id based on service_name
    $service_id = getServiceId($conn, $service_name); 
    // Insert into the Bookings table using a prepared statement
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, service_id, booking_date, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $user_id, $service_id, $booking_date, $description);

    // Execute and provide feedback
    if ($stmt->execute()) {
        echo "Booking successfully created!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case where $_SESSION['user_id'] is not set
    echo "User ID is not set. Please log in first.";
}

// Close the database connection
$conn->close();
?>
