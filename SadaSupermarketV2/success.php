<?php
 // include essential config and functions file to handle actions 
 include 'config.php';
 include 'includes/functions.php';
$method = @$_GET['m'];

 // skipping adding points if checkout made through the redeem process as redeem proccess should not increase the loyalty points as it 
 // doesn't have involvment of pounds (money)
 if($method!=="points"){

	 // getting custom data that is passed through the payment successfull redirects. This page loads only when there is a successful payment 
	 // is made through the payment methods added in the system, in our case that is either paypal or creditcard payment. 
	 
	 $custom_data = $_GET['custom'];


	 // Calling point add function for a customer, that $custom_data parameters is a base64 encoded values passed through the payment process. 
	 // to this success page and then add points to the customer database. 
	 
	 fx_add_customer_points($custom_data);

 } 

 unset($_SESSION['user_id']);
 unset($_SESSION['email_address']);
 unset($_SESSION['logged-in']);
 unset($_SESSION);
 session_destroy();
?>
<html>
<head>
<title>Thank you for your payment</title>
</head>
<body>
<h1> Thank you for your payment</h1>
<script>
	
		setTimeout(function(){
			location.href="index.php";
		},5000); // wait for 3 seconds and then redirect to index.php
	
</script>
</body>
</html>