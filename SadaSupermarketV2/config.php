<?php
session_start();
$currency = '£'; //Currency Character or code
$site_name = "Shopping Site";
$site_url = "http://local.shopping.com/";
$db_username = 'root';
$db_password = 'root';
$db_name = 'shopping';
$db_host = 'localhost';
$loyalty_rule = 5; // 5 points for each GBP 1
$stripe_api_key = "pk_test_ji7RKADCKT1i9fohMXv0HrU6";
$shipping_cost      = 0.0; //shipping cost
$taxes              = array( //List your Taxes percent here.
                            'VAT' => 0, 
                            'Service Tax' => 0
                            );						
//connect to MySql						
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>