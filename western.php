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
        h4 {
            padding-left: 20px;
            font-family: 'Nunito Sans';
            letter-spacing: 1px;
        }
        button {
            margin-left: 20px;
            margin-bottom: 20px;
            border-radius: 0px;
        }
    </style>
</head>
<body>
<div class='page-wrap'>";

include 'header.php';    

echo "<!-- Filters -->
<header>
    <h1>Western Designs</h1>
    <ul class='tabs'>
        <li><a href='gallery.php' data-tag='All' class='button'>All</a></li>
        <li><a href='arabic.php' data-tag='Arabic' class='button'>Arabic</a></li>
        <li><a href='western.php' data-tag='Western' class='button'>Western</a></li>
        <li><a href='bridal.php' data-tag='Bridal' class='button'>Bridal</a></li>
        <li><a href='babyshower.php' data-tag='Baby-shower' class='button'>Baby-shower</a></li>
        <li><a href='kankupagla.php' data-tag='Kanku-Pagla' class='button'>Kanku-Pagla</a></li>
        <!-- <li><a href='#' data-tag='thing' class='button'>Things</a></li> -->
    </ul>
</header>
<div class='content'>";

include 'config.php';

$sql = "SELECT * FROM western_images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="media all people">';
        echo '<a href="' . $row["image_path"] . '"><img src="' . $row["image_path"] . '" title="' . $row["image_name"] . '" height="260" width="260"></a><br>';
        echo '<h4>For Both Hands Rs.' . $row["price"] . '</h4>';
        echo '<button type="button" onclick="addToCart(\'' . $row["id"] . '\', \'' . $row["image_path"] . '\', \'' . $row["image_name"] . '\', ' . $row["price"] . ')">Add to Cart</button>';
        echo '</div>';    
    }
} else {
    echo "0 Results";
}

$conn->close();

echo "</div>
</div>
</section>";

echo "<script>
function addToCart(id, path, name, price) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Image added to cart successfully!');
        }
    };
    xhr.send('id=' + encodeURIComponent(id) + '&path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent(name) + '&price=' + encodeURIComponent(price));
}
</script></body></html>";

include 'footer.php'; // Corrected include statement

?>
