<?php 
session_start();

function correctImagePath($path) {
    $pattern = '/(images)([a-z]+)(img-\d+\.png)/i';
    $replacement = 'images/$2/$3';
    return preg_replace($pattern, $replacement, $path);
}

// Remove item from cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    $index = $_POST['remove'];
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
    }
}

// Display cart items
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Your Cart</title>
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
        .cart-container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-style: solid;
            border-color: #B2BEB5;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item img {
            border-radius: 5px;
            margin-right: 20px;
        }
        .cart-item-details {
            flex-grow: 1;
        }
        .cart-item-details strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.1em;
            color: #444;
        }
        .cart-item button {
            background-color: #ff4b4b; /* Lighter red background */
            color: #fff;
            border: 3px solid #fff; /* Shining white border */
            padding: 12px 18px;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: transform 0.4s ease, background-color 0.4s ease, box-shadow 0.4s ease, border 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .cart-item button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            transition: width 0.4s ease, height 0.4s ease, top 0.4s ease, left 0.4s ease;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 0;
        }
        .cart-item button:hover::before {
            width: 300%;
            height: 300%;
            top: 50%;
            left: 50%;
        }
        .cart-item button:hover {
            background-color: #c70000; /* Solid red background on hover */
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border: 3px solid transparent; /* Transparent border on hover */
        }
        .cart-item button span {
            position: relative;
            z-index: 1;
        }
        .links-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0px;
        }
        .back-link {
            font-weight: bold;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            color: #fff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .back-link.proceed {
            background-color: #4caf50; /* Solid green background */
        }
        .back-link.proceed.disabled {
            background-color: #9e9e9e; /* Grey background when disabled */
            pointer-events: none; /* Disable clicks */
        }
        .back-link.proceed:hover {
            background-color: #006769; /* Darker green on hover */
            transform: translateY(-3px); /* Lift effect on hover */
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
            text-decoration: none; /* Ensure text remains without underline */
        }
        .back-link.back {
            background-color: #4caf50; /* Solid blue background */
        }
        .back-link.back:hover {
            background-color: #006769; /* Darker blue on hover */
            transform: translateY(-3px); /* Lift effect on hover */
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
            text-decoration: none; /* Ensure text remains without underline */
        }
    </style>
</head>
<body>";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='cart-container'><h1>Your cart is empty.</h1></div>";
} else {
    echo "<div class='cart-container'>";
    echo "<h1>Your Cart</h1>";
    echo "<ul>";
    foreach ($_SESSION['cart'] as $index => $item) {
        $path = htmlspecialchars($item['path'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8');

        // Ensure image path is corrected
        $fullImagePath = correctImagePath($path);

        echo "<li class='cart-item'>";
        echo "<img src='$fullImagePath' alt='$name' height='100' width='100'>";
        echo "<div class='cart-item-details'>";
        echo "<strong>$name</strong>";
        echo "<span>Price: Rs. $price</span>";
        echo "</div>";
        echo "<form method='post' action='cart.php'>";
        echo "<button type='submit' name='remove' value='$index'>Remove</button>";
        echo "</form>";
        echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
}

// Check if appointment form was submitted
$canProceed = isset($_SESSION['appointment_id']);

echo "<div class='links-container'>";
if ($canProceed) {
    echo "<a class='back-link proceed' href='billing.php'>Proceed to Billing</a>";
} else {
    echo "<a class='back-link proceed disabled'>Proceed to Billing</a>";
}
echo "<a class='back-link back' href='gallery.php'>Back to Gallery</a>";
echo "</div>";

echo "</body></html>";
?>
