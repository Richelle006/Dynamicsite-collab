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

// Function to get service_id based on service_name
function getServiceId($conn, $service_name) {
    $stmt = $conn->prepare("SELECT service_id FROM services WHERE service_name = ?");
    $stmt->bind_param('s', $service_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['service_id'];
    } else {
        return null;
    }
}
// Retrieve data from the form via POST
$booking_date = $_POST['booking-date'];
$service_id = $_POST['service-avail'];
$description = $_POST['event-description'];

// Validate inputs
if (empty($booking_date) || empty($service_id) || empty($description)) {
    echo "All fields are required!";
    exit;
}

// Check if $_SESSION['user_id'] is set before accessing it
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Insert into the Bookings table
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, service_id, booking_date, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $user_id, $service_id, $booking_date, $description);
    try {
        if ($stmt->execute()) {
            echo "Booking successfully created!";
        } else {
            throw new Exception("Error creating booking: " . $stmt->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case where $_SESSION['user_id'] is not set
    echo "User ID is not set. Please log in first.";
}

$conn->close();
?>
