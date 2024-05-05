<?php
// Debugging: Output contents of $_POST superglobal
var_dump($_POST);

// Check if all required fields are present in $_POST
if (!isset($_POST['booking-date']) || !isset($_POST['service-avail']) || !isset($_POST['event-description'])) {
    echo "All fields are required!";
    exit;
}

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

// Validate service type
$valid_service_types = ['photo-studio', 'event', 'workshop'];
if (!in_array($service_type, $valid_service_types)) {
    echo "Invalid service type.";
    exit;
}

// Map service type to appropriate table and column
switch ($service_type) {
    case 'photo-studio':
        $table = 'photo_studio';
        $column = 'photo';
        break;
    case 'event':
        $table = 'event';
        $column = 'event';
        break;
    case 'workshop':
        $table = 'workshop';
        $column = 'workshop';
        break;
    default:
        echo "Invalid service type.";
        exit;
}

// Insert into the correct table using a prepared statement
$stmt = $conn->prepare("INSERT INTO $table (booking, $column) VALUES (?, ?)");
$stmt->bind_param('ss', $booking_date, $description);

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
