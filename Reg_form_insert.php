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

// Handle form data
$name = $_POST['dname'] ?? '';
$email = $_POST['demail'] ?? '';
$number = $_POST['dnum'] ?? '';
$username = $_POST['duser'] ?? '';
$password = $_POST['password'] ?? '';
$address = $_POST['add'] ?? '';
$cpassword = $_POST['cpassword'] ?? '';

// Validate passwords
if ($password !== $cpassword) {
    die("Passwords do not match.");
}

try {
    // Insert form data into the database
    $stmt = $pdo->prepare("INSERT INTO users (name, email, number, username, password, address) VALUES (:name, :email, :number, :username, :password, :address)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Hash the password
    $stmt->bindParam(':address', $address);
    $stmt->execute();

    // Redirect to login page
    header("Location: login.php"); // Ensure 'login.php' is the correct path to your login page
    exit();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$pdo = null;
?>
