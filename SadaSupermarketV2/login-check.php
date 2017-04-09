<?php
include 'config.php';

$username = strip_tags($_POST['u']);
$password = strip_tags($_POST['p']);
$sql = "SELECT id,email FROM customers where username='{$username}' and password = '".md5($_POST['p'])."'";
$results = $mysqli->query($sql);
if(!empty($results)){
	if($results->num_rows > 0){
		$obj = $results->fetch_object();	
		$id = $obj->id;

		if($id > 0){
			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $id;
			$_SESSION['email_address'] = $obj->email;
			header("Location: index.php");
			exit;
		}
	}
	header("Location: login.php?action=error");	
	exit;
}else{
	header("Location: login.php?action=error");
	exit;
}
