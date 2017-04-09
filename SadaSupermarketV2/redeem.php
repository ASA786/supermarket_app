<?php
require 'config.php';
require 'includes/functions.php';

$cart_total = $_SESSION['cart_total'];
$user_id = $_SESSION['user_id'];
$points_requested_to_redeem = fx_get_customer_points($user_id); 
// echo $user_id;
// echo "<br />";
// echo $points_requested_to_redeem;
// echo "<br />";
// echo $cart_total;
$redeemed_point = fx_redeem_points($user_id, $points_requested_to_redeem,$cart_total);

if($redeemed_point){
	header("Location: success.php?m=points&points={$points_requested_to_redeem}");
	exit;
}else{
	header("Location: checkout.php?next=true&message=fail&text=You do not have enough points to redeem for this checkout");
	exit;
}
