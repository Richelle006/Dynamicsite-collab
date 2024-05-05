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
    $row = $result->fetch_assoc();
    return $row['service_id'];
}

// Insert into the Bookings table using a prepared statement
$stmt = $conn->prepare("INSERT INTO Bookings (user_id, service_id, booking_date, description) VALUES (?, ?, ?, ?)");

// Debugging: Print values to be inserted
echo "Inserting booking with user_id: $user_id, service_id: $service_id, booking_date: $booking_date, description: $description";

// Bind parameters and execute statement
$stmt->bind_param('iiss', $user_id, $service_id, $booking_date, $description);
if ($stmt->execute()) {
    echo "Booking successfully created!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
