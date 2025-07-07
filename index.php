<!DOCTYPE html>
<html>
<head>
<style>
body {
    padding-top: 190px;
    background-image: url("b-img.jpg");
    min-height: 280px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    margin: 0;
    padding-left: 350px;
    text-align: center;
    font-family: Arial, sans-serif;
    color: #fff; /* Ensure text is readable on the background */
}

.container {
    width: 60%; /* Adjust width as needed */
    margin: 0 auto;
    padding: 20px;
    background: rgba(190, 214, 51, 0.5); /* Semi-transparent background for readability */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.9);
}

h2 {
    font-size: 28px; /* Larger font size for better visibility */
    color: black; /* Light color for contrast against the background */
    margin-bottom: 20px;
}

button {
    font-size: 18px;
    margin: 10px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #68b470, #4caf50); /* Gradient background */
    border: 2px solid #4caf50;
    color: #fff;
    text-shadow: 0px 1px 0px #2c6b3f; /* Darker text shadow for better contrast */
    font-weight: bold;
    border-radius: 50px;
    cursor: pointer;
    width: 220px;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
    background: linear-gradient(135deg, #4caf50, #68b470); /* Reverse gradient on hover */
    color: #fff;
    transform: scale(1.05); /* Slightly enlarge button on hover */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Shadow on hover */
}

.contact-logo {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-image: url('black-contact-icon.png'); /* Use your black contact icon */
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
    z-index: 1000; /* Ensure the logo is on top of other content */
}

.contact-logo:hover {
    opacity: 0.8; /* Slightly fade on hover */
}
h4{
	padding-top:30px;
	color: black;
}
</style>
</head>
<body>
    <div class="container">
        <h2>Welcome! Please select an option:</h2>
        <button onclick="location.href='registration.php'">Register</button>
        <button onclick="location.href='login.php'">Login</button>
    </div>

    <!-- Contact Logo -->
    <a href="dashboard_login.php">
        <div class="contact-logo" title="Admin Dashboard"><div><h4>Admin</h4></div></div>
    </a>
</body>
</html>
