<?php
session_start();

// Check if appointment_id is available in the session
if (!isset($_SESSION['appointment_id'])) {
    echo "<h2>Appointment ID not found. Please try again.</h2>";
    echo "<a href='index.php'>Go Back</a>";
    exit();
}

$appointment_id = $_SESSION['appointment_id'];

// Database configuration
$servername = "localhost"; // Replace with your database server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "project";       // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check the appointment status
$result = $conn->query("SELECT name, status FROM appointments WHERE appointment_id = $appointment_id");
$row = $result->fetch_assoc();

$appointmentStatus = $row['status'];

if (empty($appointmentStatus)) {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Waiting for Response</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='assets/css/main.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .waiting-message {
                background-color: #fff;
                border-radius: 8px;
                padding: 30px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: auto;
            }
            h2 {
                color: #f39c12;
                font-size: 24px;
            }
            p {
                font-size: 16px;
                color: #333;
                line-height: 1.6;
            }
            .button {
                background-color: #f39c12;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-top: 20px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: #e67e22;
            }
            .button i {
                margin-right: 8px;
            }
        </style>
        <script>
            // Function to reload the page
            function reloadPage() {
                window.location.reload();
            }
            // Check every 1 seconds if the status has changed
            setInterval(reloadPage, 1000);
        </script>
    </head>
    <body>
    <div class='waiting-message'>
        <h2>Please wait for the response</h2>
        <p>Your appointment request is being processed. You will be notified once the status is updated.</p>
        <a href='welcome.php' class='button'><i class='fas fa-home'></i> Go Home</a>
    </div>
    </body>
    </html>";
}

if ($appointmentStatus === 'canceled') {
    // If appointment is canceled, display cancellation message
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Appointment Canceled</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='assets/css/main.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .error-message {
                background-color: #fff;
                border-radius: 8px;
                padding: 30px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: auto;
            }
            h2 {
                color: #E74C3C;
                font-size: 24px;
            }
            p {
                font-size: 16px;
                color: #333;
                line-height: 1.6;
            }
            .button {
                background-color: #E74C3C;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-top: 20px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: #c0392b;
            }
            .button i {
                margin-right: 8px;
            }
        </style>
        <script>
            // Function to reload the page
            function reloadPage() {
                window.location.reload();
            }
            // Check every 1 seconds if the status has changed
            setInterval(reloadPage, 1000);
        </script>
    </head>
    <body>
    <div class='error-message'>
        <h2>Appointment Canceled</h2>
        <p>Unfortunately, your appointment has been canceled. Please contact us if you have any questions.</p>
        <a href='welcome.php' class='button'><i class='fas fa-home'></i> Go Back</a>
    </div>
    </body>
    </html>";
} elseif($appointmentStatus === 'confirmed') {
    // If appointment is confirmed, display booking confirmation
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Appointment Confirmation</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='assets/css/main.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .confirmation-message {
                background-color: #fff;
                border-radius: 8px;
                padding: 30px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: auto;
            }
            h2 {
                color: #4CAF50;
                font-size: 24px;
            }
            p {
                font-size: 16px;
                color: #333;
                line-height: 1.6;
            }
            .button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-top: 20px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
                background-color: #006769;
            }
            .button i {
                margin-right: 8px;
            }
        </style>
        <script>
            // Function to reload the page
            function reloadPage() {
                window.location.reload();
            }
            // Check every 1 seconds if the status has changed
            setInterval(reloadPage, 1000);
        </script>
    </head>
    <body>
    <div class='confirmation-message'>
        <h2>Appointment booked successfully!</h2>
        <p>Thank you, <strong>{$row['name']}</strong>. Your appointment has been successfully booked.</p>
        <a href='cart.php' class='button'><i class='fas fa-shopping-cart'></i> View Cart</a>
    </div>
    </body>
    </html>";
}

// Close the connection
$conn->close();
?>
