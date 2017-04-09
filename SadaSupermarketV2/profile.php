<?php 
include 'config.php';
if(empty($_SESSION['user_id'])){
	header("Location: login.php?action=error");
	exit;
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM customers where id ='{$user_id}'";
$results = $mysqli->query($sql);
$obj = $results->fetch_object();
?>
<h1>User Profile</h1>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<th align="left" width="150">ID</th><td>:</td><td><?php echo $obj->id; ?></td></tr>
	<tr><th align="left">Username</th><td>:</td><td><?php echo $obj->username; ?></td></tr>
	<tr><th align="left">Email:</th><td>:</td><td><?php echo $obj->email; ?></td></tr>
	<tr><th align="left">Loyalty Points:</th><td>:</td><td><?php echo $obj->points; ?></td></tr>
</tr>
</table>
<hr>
<a href="index.php">Go back to store</a>