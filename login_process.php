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

// Handle login form data
$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';

try {
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($pass, $result['password'])) {
        // Successful login
        $_SESSION['username'] = $user; // Set session variable
        header("Location: welcome.php"); // Redirect to a welcome or home page
        exit();
    } else {
        // Invalid credentials
       echo "<script type='text/javascript'>
                alert('Invalid username or password. Please try again.');
                window.location.href = 'Login.php'; // Redirect back to login page
              </script>";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$pdo = null;
?>
