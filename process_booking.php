<?php
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
$service_type = $_POST['service-avail'];
$description = $_POST['event-description'];

// Validate inputs
if (empty($booking_date) || empty($service_type) || empty($description)) {
    echo "All fields are required!";
    exit;
}

// Get user_id from the session (assuming you have it stored there)
session_start();
$user_id = $_SESSION['user_id'];

// Function to get service_id based on service_type
function getServiceId($conn, $service_type) {
    $stmt = $conn->prepare("SELECT service_id FROM Services WHERE service_name = ?");
    $stmt->bind_param('s', $service_type);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();
        
        // Check if 'service_id' is set in the row
        if (isset($row['service_id'])) {
            // Return the value of 'service_id'
            return $row['service_id'];
        } else {
            // Handle the case where 'service_id' is not set
            // For example, log an error message or return a default value
            return null;
        }
    } else {
        // Handle the case where the query returned no rows
        // For example, log an error message or return a default value
        return null;
    }
}

// Get service_id based on service_type
$service_id = getServiceId($conn, $service_type);

// Insert into the Bookings table using a prepared statement
$stmt = $conn->prepare("INSERT INTO Bookings (user_id, service_id, booking_date, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param('iiss', $user_id, $service_id, $booking_date, $description);

// Execute and provide feedback
if ($stmt->execute()) {
    echo "Booking successfully created!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
