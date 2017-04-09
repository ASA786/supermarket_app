<?php
include 'config.php';
extract($_POST);
$sql= "INSERT INTO customers set username='{$username}', email='{$email}', password='".md5($password)."'";
try{
	if($id = $mysqli->query($sql)){
		$_SESSION['payment-step'] = "true";
		$_SESSION['email'] = $email;
		$_SESSION['user_id'] = $id;
		header("Location: checkout.php?next=true&message=success");
		exit;
	}else{
		unset($_SESSION['payment-step']);
		header("Location: checkout.php?next=false&message=fail");
		exit;
	}	
}catch(Exception $e){
	echo $e->getMessage();
}
