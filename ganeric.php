
<?php
echo "<!DOCTYPE HTML>
<html>
<head>
    <title>Mahendi Magic Hub</title>
    <meta charset='utf-8'>
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='assets/css/main.css'>
    <style>
    .time-selector {
        display: flex;
        gap: 5px; /* Add some space between the dropdowns */
    }
    .time-selector select {
        font-size: 14px; /* Increase font size */
        padding: 5px; /* Add padding for better spacing */
    }
</style>
</head>
<body>
<div class='page-wrap'>";

include 'header.php';

echo "<!-- Contact --><section id='contact'><!-- Social --><div class='social column'>
        <h3>About Us</h3>
        <p>Welcome to Mahendi Magic Hub! Our passion for Mehendi art has brought together a team of skilled artists dedicated to creating beautiful and intricate designs that celebrate tradition and creativity.</p>
        <p>At Mahendi Magic Hub, we believe that Mehendi is not just a form of body art; it's a vibrant expression of culture, beauty, and celebration. Whether you're looking for traditional bridal designs, contemporary patterns, or unique custom artwork, our talented artists are here to bring your vision to life with precision and elegance.</p>
        <h3>Our Story</h3>
        <p>Founded by a group of Mehendi enthusiasts, Mahendi Magic Hub started as a small studio and has grown into a beloved destination for Mehendi lovers. Our journey is one of passion, learning, and growth, constantly evolving to bring you the latest trends and timeless classics in Mehendi art.</p>
        <h3>Follow Me</h3>
        <ul class='icons'>
            <li><a href='#' class='icon fa-twitter'><span class='label'>Twitter</span></a></li>
            <li><a href='#' class='icon fa-facebook'><span class='label'>Facebook</span></a></li>
            <li><a href='#' class='icon fa-instagram'><span class='label'>Instagram</span></a></li>
        </ul>
    </div>

    <!-- Form -->
    <div class='column'>
        <h3>Book Appointment</h3>
        <form action='insert.php' method='post' onsubmit='return validateForm()'>
            <div class='field half first'>
                <label for='name'>Name</label>
                <input name='name' id='name' type='text' placeholder='Name' required pattern='[A-Za-z\s]{2,}' title='Name must contain only letters and be at least 2 characters long'>
            </div>
            <div class='field half second'>
                <label for='email'>Email</label>
                <input name='email' id='email' type='email' placeholder='Email' required>
            </div>
            <div class='field half third'>
                <label for='number'>Number</label>
                <input name='number' id='number' type='tel' placeholder='Number' required maxlength='10' pattern='^\d{10}$' title='Number must be 10 digits long'>
            </div>
            <div class='field half sixth'>
                <label for='date'>Date</label>
                <input type='date' name='dt' id='date' required>
            </div>
            <div class='field half fifth'>
                <label for='time'>Time</label>
                <div class='time-selector'>
                    <select id='hours' name='hrs' required>
                        <option value='' disabled selected>Hour</option>
                        <option value='00'>00</option>";
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    echo "</select>
                    <select id='minutes' name='min' required>
                        <option value='' disabled selected>Minutes</option>
                        <option value='00'>00</option>";
                        for ($j = 1; $j <= 59; $j++) {
                            echo "<option value='$j'>$j</option>";
                        }
                    echo "</select>
                    <select id='meridian' name='mer' required>
                        <option value='' disabled selected>AM/PM</option>
                        <option value='PM'>PM</option>
                        <option value='AM'>AM</option>
                    </select>
                </div>
            </div>
            <div class='field'>
                <label for='address'>Address</label>
                <textarea name='add' id='address' rows='6' placeholder='Address' required></textarea>
            </div>
            <ul class='actions'>
                <li><input value='BOOK' class='button' type='submit'></li>
            </ul>
        </form>
    </div>
</section>
</div>";

include 'footer.php';
?>

<script>
function validateForm() {
    var hours = document.getElementById('hours').value;
    var minutes = document.getElementById('minutes').value;
    var meridian = document.getElementById('meridian').value;

    if (hours === '' || minutes === '' || meridian === '') {
        alert('Please select a valid time.');
        return false;
    }

    return true;
}
</script>
