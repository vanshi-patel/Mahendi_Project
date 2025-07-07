<?php
session_start();

// Database connection details
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

echo $cart = implode(json_decode($_POST['cart'] ?? '[]', true));

$stmt = $pdo->prepare("INSERT INTO appointments ( img_name, price, image) VALUES (:appointment_id, :img_name, :price, :image_path)");
    foreach ($cart as $item) {
        $img_name = $item['name'];
        $price = $item['price'];
        $image_path = $item['path'];
        $stmt->bindParam(':appointment_id', $appointmentId);
        $stmt->bindParam(':img_name', $img_name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->execute();
    }
    echo "Images added successfully!<br>";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$pdo = null;
?>