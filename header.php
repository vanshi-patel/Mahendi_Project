<?php
session_start();

echo "
    <!-- Nav -->
    <nav id='nav'>
        <ul>
            <li><a href='welcome.php' class='active'><span class='icon fa-home'></span></a></li>
            <li><a href='gallery.php'><span class='icon fa-camera-retro'></span></a></li>
            <li><a href='ganeric.php'><span class='icon fa-file-text-o'></span></a></li>
            <li><a href='cart.php'><span class='icon fa-shopping-cart'></span></a></li>
            <li><a href='logout.php'><span class='icon fa-sign-out'></span></a></li>
        </ul>
    </nav>
    <!-- Main -->
    <section id='main'>
        <!-- Header -->
        <header id='header'>
            <span class='logo' style='font-size: 1.5em;'>Mahendi Magic Hub</span>
        </header>
		
        <!-- Gallery -->
        <section id='galleries'>
            <!-- Photo Galleries -->
            <div class='gallery'>
";

?>
