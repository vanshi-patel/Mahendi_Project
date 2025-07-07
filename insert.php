<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$date = $_POST['dt']; // Updated from 'date' to 'dt'
$time = $_POST['hrs'] . ':' . $_POST['min'] . ' ' . $_POST['mer'];
$address = $_POST['add']; // Updated from 'address' to 'add'

// Prepare and execute SQL query without the status field
$stmt = $conn->prepare("INSERT INTO appointments (name, email, number, date, time, address) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $number, $date, $time, $address);

if ($stmt->execute()) {
    // Fetch the newly inserted appointment_id
    $appointment_id = $conn->insert_id;

    // Store appointment_id in session
    $_SESSION['appointment_id'] = $appointment_id;

    // Wait for 10 seconds and then redirect to check_status.php
    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv='refresh' content='5;url=check_status.php'>
        <title>Processing Appointment</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='assets/css/main.css'>
    </head>
    <body>
        <div style='text-align: center; margin-top: 50px;'>
            <h2>Booking your appointment...</h2>
            <p>Please wait while we confirm your booking. You will be redirected shortly.</p>
        </div>
    </body>
    </html>";
} else {
    // Handle insertion error
    echo "<h2>Error booking appointment: " . $stmt->error . "</h2>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
