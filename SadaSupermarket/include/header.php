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




<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <li><a href="index.php">Home</a></li>
	
	<?php
if (!isset($_SESSION['login_user'])) {
    echo "<li><a href=\"?page=register\">Register</a></li>";
}
?>
<li><a href="?page=htc">How to Connect</a></li>
<?php
$pages = pages($conn);
if (count($pages)) {
    foreach ($pages AS $id => $pageData) {
        echo "<li><a href=\"?page=$pageData[page_url]\">$pageData[page_name]</a></li>";
    }
}
?>

</div>
