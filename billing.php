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

// Function to correct image path
function correctImagePath($path) {
    $pattern = '/(images)([a-z]+)(img-\d+\.png)/i';
    $replacement = 'images/$2/$3';
    return preg_replace($pattern, $replacement, $path);
}

// Function to calculate the total price of items in the cart
function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += (float)$item['price'];
    }
    return $total;
}

// Redirect to cart if session cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Fetch appointment_id (modify this query as needed to get the correct appointment_id)
$appointment_id_query = "SELECT appointment_id FROM appointments ORDER BY appointment_id DESC LIMIT 1";
$result = $conn->query($appointment_id_query);

if ($result && $row = $result->fetch_assoc()) {
    $appointment_id = $row['appointment_id'];
} else {
    die("Error fetching appointment ID or no appointment found.");
}

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {
    $paymentMethod = $_POST['payment_method'];
    $total = calculateTotal($_SESSION['cart']);

    // Insert cart items into the appointment_images table
    $stmt_images = $conn->prepare("INSERT INTO appointment_images (appointment_id, img_name, price, images) VALUES (?, ?, ?, ?)");

    foreach ($_SESSION['cart'] as $item) {
        $img_name = $conn->real_escape_string($item['name']);
        $price = $conn->real_escape_string($item['price']);
        $images = $conn->real_escape_string(correctImagePath($item['path']));

        $stmt_images->bind_param("isss", $appointment_id, $img_name, $price, $images);

        if (!$stmt_images->execute()) {
            echo "Error: " . $stmt_images->error;
        }
    }

    // Close statement and connection
    $stmt_images->close();
    $conn->close();

    // Clear the cart after inserting
    unset($_SESSION['cart']);

    // Redirect to the new confirmation page with payment method and total amount as query parameters
    header("Location: payment_confirmation.php?method=$paymentMethod&total=$total");
    exit();
}

$total = calculateTotal($_SESSION['cart']);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Billing Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #5a5a5a;
            margin-top: 20px;
        }
        .billing-container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-style: solid;
            border-color: #B2BEB5;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
        }
        .total {
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
        }
        .payment-form {
            text-align: center;
        }
        .payment-options {
            text-align: left;
            margin: 20px 0;
        }
        .payment-options label {
            display: block;
            margin-bottom: 10px;
        }
        .payment-form input[type='submit'] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .payment-form input[type='submit']:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }
        .payment-form input[type='submit']:active {
            background-color: #388e3c;
            transform: translateY(0);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            text-decoration: none;
            background-color: #ff4b4b;
            color: #fff;
            padding: 12px 24px;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .back-link:hover {
            background-color: #c70000;
            transform: translateY(-3px);
        }
        .back-link:active {
            background-color: #a70000;
            transform: translateY(0);
        }
    </style>
</head>
<body>";

echo "<div class='billing-container'>";
echo "<h1>Billing Page</h1>";
echo "<div class='total'>Total Price: Rs. $total</div>";

echo "<form class='payment-form' method='post' action='billing.php'>";
echo "<div class='payment-options'>";
echo "<label><input type='radio' name='payment_method' value='Cash on Delivery (COD)' required> Cash on Delivery (COD)</label>";
echo "<label><input type='radio' name='payment_method' value='Credit/Debit Card' required> Credit/Debit Card</label>";
echo "<label><input type='radio' name='payment_method' value='Net Banking' required> Net Banking</label>";
echo "<label><input type='radio' name='payment_method' value='UPI' required> UPI</label>";
echo "</div>";

echo "<input type='submit' name='pay' value='Proceed to Payment'>";
echo "</form>";

echo "<a class='back-link' href='cart.php'>Back to Cart</a>";

echo "</div>";

echo "</body></html>";
?>
