<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $path = $_POST['path'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the item to the cart
    $_SESSION['cart'][] = [
        'id' => $id,
        'path' => $path,
        'name' => $name,
        'price' => $price
    ];

    echo 'Success';
} else {
    echo 'Invalid request';
}
?>
