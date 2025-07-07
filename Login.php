<?php
// login.php
session_start();

// Any PHP code you want to execute before displaying the form can be added here

?>
<!DOCTYPE html>
<html>
<head>
<style>
body{
    padding-top: 100px;
}
h2{
    text-align: center;
    font-size: 20px; /* Reduced font size */
}
body{
    padding-left: 50px; /* Adjusted padding */
    background-image: url("b-img.jpg");
    min-height: 380px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}
div.main{
    width: 280px; /* Reduced width */
    padding: 10px 30px; /* Adjusted padding */
    background-color: #bed633;
    border: 10px solid white; /* Reduced border width */
    box-shadow: 0 0 8px; /* Reduced shadow */
    border-radius: 5px; /* Slightly rounded corners */
    font-size: 14px; /* Reduced font size */
}
input[type=text], [type=password] {
    background-color: #fff5e1;
    width: 95%; /* Adjusted width */
    height: 30px; /* Reduced height */
    padding-left: 5px;
    margin-bottom: 15px; /* Adjusted margin */
    margin-top: 5px; /* Adjusted margin */
    box-shadow: 0 0 4px #9DDE8B; /* Reduced shadow */
    border: 2px solid #9DDE8B;
    color: #4f4f4f;
    font-size: 14px; /* Reduced font size */
}
label {
    float: left;
    color: #464646;
    font-size: 16px; /* Reduced font size */
    font-weight: bold;
}
#login {
    font-size: 16px; /* Reduced font size */
    margin-top: 10px; /* Adjusted margin */
    background-color: #68b470;
    border: 1px solid #9DDE8B;
    padding: 5px 20px; /* Adjusted padding */
    color: black;
    text-shadow: 0px 1px 0px #9DDE8B;
    font-weight: bold;
    border-radius: 2px;
    cursor: pointer;
    width: 100%;
}
#login:hover {
    background-color: #006769;
    color: white;
}
</style>
</head>
<body>
<center>
<div class="main">
<form class="form" method="post" action="login_process.php">
<h2>Login Form</h2>
<label>Username :</label>
<input type="text" name="user" id="usr" required>
<label>Password :</label>
<input type="password" name="pass" id="pwd" required>
<input type="submit" name="login" id="login" value="Login">
</form>
</div>
</center>
</body>
</html>
