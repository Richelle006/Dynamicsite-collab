<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UserDB";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Check if booking ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "Booking ID is missing.";
    exit();
}

$booking_id = $_GET['id'];

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve booking details
$sql = "SELECT * FROM Bookings WHERE booking_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $booking_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Booking not found.";
    exit();
}

$stmt->close();
// Fetch services available from the database
$services = array();
$services_query = $conn->query("SELECT * FROM Services");
while ($service_row = $services_query->fetch_assoc()) {
    $services[$service_row['service_id']] = $service_row;
}


// Handle form submission for editing booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission to update booking details
    $new_booking_date = $_POST['booking_date'];
    $new_description = $_POST['description'];
    $new_service_id = $_POST['service-avail']; 
    // Update booking details in the database
    $update_stmt = $conn->prepare("UPDATE Bookings SET booking_date = ?, description = ?, service_id = ? WHERE booking_id = ?");
    $update_stmt->bind_param('ssii', $new_booking_date, $new_description, $new_service_id, $booking_id);

    if ($update_stmt->execute()) {
        // Booking updated successfully
        header('Location: profile.php'); // Redirect to profile page after successful update
        exit();
    } else {
        echo "Error updating booking: " . $update_stmt->error;
    }

    // Close statement
    $update_stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        
        .edit-booking-page {
            margin: 20px auto;
            padding: 20px;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); /* White with low opacity */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Drop shadow */
        }
        
        h2 {
            text-align: center;
        }
        
        form {
            margin-top: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
        }
        
        input[type="date"],
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4caf50; /* Green */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #45a049; /* Darker green */
        }
    </style>
</head>
<body>
    <div class="edit-booking-page">
        <h2>Edit Booking</h2>
        <form method="POST" onsubmit="return confirm('Are you sure you want to update this booking?');">
            <select id="service-avail" name="service-avail" required>
                <option value="">Select a Service</option>
                <?php foreach ($services as $service_id => $service): ?>
                <option value="<?php echo $service_id; ?>"><?php echo $service['service_name']; ?> - <?php echo $service['price']; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" value="<?php echo $row['booking_date']; ?>" required>
            <br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $row['description']; ?>" required>
            <br>
                <label for="service-avail">Service to Avail:</label>
                <select id="service-avail" name="service-avail" required>
                    <option value="">Select a Service</option>
                    <?php foreach ($services as $service_id => $service): ?>
                        <option value="<?php echo $service_id; ?>"><?php echo $service['service_name']; ?> - <?php echo         $service['price']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
