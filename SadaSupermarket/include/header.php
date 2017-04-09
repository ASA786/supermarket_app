<?php
#####################################################
##                                                 ##
##                                                 ##
##                                                 ##
##            Copyrights © PosionCMS     		   ##
##                                                 ##
##                                                 ##
##                                                 ##
##                                                 ##
#####################################################
?>
<?php
$time  = microtime();
$time  = explode(' ', $time);
$time  = $time[1] + $time[0];
$start = $time;
require_once "/../config.php";
require_once SITE_ROOT . "/core/function.php";
require_once SITE_ROOT . "/core/connect.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/main.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<script src="js/js-image-slider.js" type="text/javascript"></script>
<title>Sada Supermarket</title>
</head>

<body>

<div class="wrapper">
<div class="navbar">


<ul>
  <li><a class="active" href="index.php">Home</a></li>
	<?php
if (!isset($_SESSION['login_user'])) {
    echo "<li><a href=\"?page=register\">Register</a></li>";
}
?>
 
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Categories</a>
    <div class="dropdown-content">
      <a href="?cat=1">Fruits</a>
      <a href="?cat=2">Veg</a>
      <a href="?cat=3">Meat and Poultry</a>
	  <a href="?cat=4">Fish and Seafood</a>
      <a href="?cat=5">Bakery</a>
	  <a href="?cat=6">Drinks</a>
	  <a href="?cat=7">Electronics</a>
	  <a href="?cat=8">Kids Toys</a>	  
      <a href="?cat=9">Bed, Bath and Home</a>


    </div>
<?php
$pages = pages($conn);
if (count($pages)) {
    foreach ($pages AS $id => $pageData) {
        echo "<li><a href=\"?page=$pageData[page_url]\">$pageData[page_name]</a></li>";
    }
}
?>
  <li><a href="?page=contact">Contact Us</a></li>

</ul>

 </div>
