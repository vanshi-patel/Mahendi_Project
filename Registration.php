<?php
session_start();

// Any PHP code you want to execute before displaying the form can be added here
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
    padding-top: 20px; /* Adjusted padding */
    padding-left: 80px; /* Reduced left padding */
    margin: 0; /* Reset default margin */
}
h2 {
    text-align: center;
    font-size: 16px; /* Further reduced font size */
}
body {
    background-image: url("b-img.jpg");
    min-height: 380px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}
div.main {
    width: 240px; /* Further reduced width */
    padding: 8px 10px; /* Adjusted padding */
    background-color: #bed633;
    border: 6px solid white; /* Reduced border width */
    box-shadow: 0 0 4px; /* Reduced shadow */
    border-radius: 5px; /* Slightly rounded corners */
    font-size: 12px; /* Further reduced font size */
    position: relative;
    left: 40px; /* Shifted form slightly to the right */
    margin: 0 auto; /* Center the form horizontally */
}
input[type=text], [type=password], [type=tel], [type=email], textarea {
    background-color: #fff5e1;
    width: 90%; /* Adjusted width */
    height: 24px; /* Further reduced height */
    padding-left: 5px;
    margin-bottom: 10px; /* Adjusted margin */
    margin-top: 4px; /* Adjusted margin */
    box-shadow: 0 0 2px #9DDE8B; /* Further reduced shadow */
    border: 2px solid #9DDE8B;
    color: #4f4f4f;
    font-size: 12px; /* Further reduced font size */
}
label {
    float: left;
    color: #464646;
    font-size: 12px; /* Further reduced font size */
    font-weight: bold;
}
#register {
    font-size: 12px; /* Further reduced font size */
    margin-top: 8px; /* Adjusted margin */
    background-color: #68b470;
    border: 1px solid #9DDE8B;
    padding: 5px 10px; /* Adjusted padding */
    color: black;
    text-shadow: 0px 1px 0px #9DDE8B;
    font-weight: bold;
    border-radius: 2px;
    cursor: pointer;
    width: 100%;
}
#register:hover {
    background-color: #006769;
    color: white;
}
</style>
</head>
<body>
<center>
<div class="main">
<form class="form" method="post" action="Reg_form_insert.php">
<h2>Registration Form</h2>
<label for="name">Name :</label>
<input type="text" name="dname" id="name" required pattern="[A-Za-z\s]{2,}" title="Name should contain only letters and spaces, and be at least 2 characters long.">
<label for="email">Email :</label>
<input type="email" name="demail" id="email" required>
<label for="num">Number :</label>
<input type="tel" name="dnum" id="num" required pattern="[6-9][0-9]{9}" maxlength="10" title="Please enter a valid 10-digit phone number starting with 6 to 9.">
<label for="user">Username :</label>
<input type="text" name="duser" id="user" required pattern="[A-Za-z0-9]{5,}" title="Username should be at least 5 characters long and contain only letters and numbers.">
<label for="password">Password :</label>
<input type="password" name="password" id="password" required minlength="6" title="Password must be at least 6 characters long.">
<label for="cpassword">Confirm Password :</label>
<input type="password" name="cpassword" id="cpassword" required minlength="6" title="Confirm password must be at least 6 characters long.">
<label for="address">Address :</label>
<textarea rows="4" cols="20" name="add" id="address" required></textarea>
<input type="submit" name="register" id="register" value="Register">
</form>
</div>
</center>
</body>
</html>
