<?php

echo "<!DOCTYPE HTML>
<html><head><title>Mahendi Magic Hub</title><meta charset='utf-8'><meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'><meta name='viewport' content='width=device-width, initial-scale=1'><link rel='stylesheet' href='assets/css/main.css'></head>
<style>
.media {
  padding-left: 100px;
  position: relative;
  width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  padding-bottom: 50px;
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.media:hover .image {
  opacity: 0.3;
}

.media:hover .middle {
	opacity:1;
}
h4,h2{
text-decoration: underline;
}
h3{
margin-left: 23px;
}
h5{
margin-right: 600px;
margin-bottom:50px;
font-size: medium;
}
.text {
  background-color: #90a14e;
  font-family:'Times New Roman';
  letter-space: 2px;
  font-weight: bold;
  text-align: left;
  color: black;
  font-size: 18px;
  padding: 20px 15px 1px 15px;
}
</style>
<body> 
       
        <div class='page-wrap'>

			<!-- Nav -->
				<nav id='nav'><ul><li><a href='welcome.php' class='active'><span class='icon fa-home'></span></a></li>
						<li><a href='gallery.php'><span class='icon fa-camera-retro'></span></a></li>
						<li><a href='ganeric.php'><span class='icon fa-file-text-o'></span></a></li>
						<li><a href='cart.php'><span class='icon fa-shopping-cart'></span></a></li>
						<li><a href='logout.php' ><span class='icon fa-sign-out'></span></a></li>
					</ul></nav><!-- Main --><section id='main'><!-- Banner --><section id='banner'><div class='inner'>
								<h1>Mahendi Magic Hub </h1>
								<p>Adoring Your Moments With Art</p>
								<ul class='actions'><li><a href='#galleries' class='button alt scrolly big'>Continue</a></li>
								</ul></div>
						</section><!-- Gallery --><section id='galleries'><!-- Photo Galleries --><div class='gallery'>
						
									<header class='special'><h2>Pick Your Perfect Pack</h2><div><h5>-Prices of Packages varies as per Design and Length.<br>-Starting price per head is Mentioned.</h5></div>
									</header><div class='content'>";
                                  
										include 'config.php';
										
										$sql="SELECT * FROM packages";
					                    $result=$conn->query($sql);
					
					                    if($result->num_rows >0){
										
										    while($row=$result->fetch_assoc()){
							                echo '<div class="media">';
							                echo '<img src=" ' . $row["image"]  . ' " height=400 width=360>';
						                  	echo '<div class="middle"><div class="text"><h4>Starting from Rs. '.$row["price"].'</h4><pre>'.$row["package_description"].'</pre>';
											echo '</div></div><h3>'.$row["package_name"].'</h3></div>';
											}
					                    }
					                    else{
					                        echo "0 Results";
					                    }
					
					                    $conn->close();
									
								echo	"</div>
            </div>
        </section>
  
<div class='copyright'>
    Design by: <a href=''>1C</a>
</div>
<!-- Scripts -->
<script src='assets/js/jquery.min.js'></script><script src='assets/js/jquery.poptrox.min.js'></script><script src='assets/js/jquery.scrolly.min.js'></script><script src='assets/js/skel.min.js'></script><script src='assets/js/util.js'></script><script src='assets/js/main.js'></script></body></html>";
?>