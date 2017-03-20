<?php

require_once __DIR__ . "/../config.php";
// Create connection

$conn  = mysqli_connect($servername, $username, $password, $database_cms);
// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

