<?php
if (!isset($_GET['method']) || !isset($_GET['total'])) {
    // Redirect back to cart if no method or total provided
    header('Location: cart.php');
    exit();
}

$paymentMethod = htmlspecialchars($_GET['method']);
$total = htmlspecialchars($_GET['total']);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .confirmation-container h1 {
            color: #28a745;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .confirmation-container p {
            font-size: 1.2em;
            color: #333;
        }
        .confirmation-container .details {
            margin: 20px 0;
        }
        .back-link {
            display: inline-block;
            background-color: #90a14e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #006769;
        }
        .success-icon {
            font-size: 4em;
            color: #28a745;
            margin-bottom: 20px;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }
        @keyframes fadeIn {
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class='confirmation-container fade-in'>
        <div class='success-icon'>✔️</div>
        <h1>Payment Successful</h1>
        <p>Thank you for your payment of Rs. $total using <strong>$paymentMethod</strong>.</p>
        <div class='details'>
            Your transaction is complete.
        </div>
        <a class='back-link' href='welcome.php'>Back to Site</a>
    </div>
</body>
</html>";
?>
