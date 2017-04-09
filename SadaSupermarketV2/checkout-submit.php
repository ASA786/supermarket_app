<?php

	$payment_method = $_POST['payment-method'];
	$customer_email = $_POST['email'];

	switch($payment_method){
		default:
	 	case 'paypal':
			header("Location: paypal.php?e=" . base64_encode($customer_email));
			break;
		case 'points':
			header("Location: redeem.php");
			break;
		case 'credit-card':
			header("Location: creditcard.php");
			break;


	}