<?php



/**
 * functions to add points based on the rule defined in the config file per each pound spent. 
 * @param $custom_data base64 encoded string value passed through the payment methods. 
 * @return  Object [return a mysqli_result object.]
 * 
 */
function fx_add_customer_points($custom_data){
	global $mysqli, $loyalty_rule;
	$custom = base64_decode($custom_data);
	$raw = explode("|",$custom);
	$email = $raw[0];
	$amount = (int) $raw[1];
	$points = $amount * $loyalty_rule;
	$user_sql = "SELECT id FROM customers where email_addresss='{$email_address}'";
	$results = $mysqli->query($user_sql);
	$return = 0;
	if($results){ 
		$obj = $results->fetch_object();
		$sql = "INSERT INTO loyalty set customer_id='{$obj->id}', points='{$points}'";
		$return = $mysqli->query($sql);
	}	

	return $return;
}


/**
 * fx_get_customer_points() retrive customer points from the db
 * @param  int $user_id customer user id who is logged into the system
 * @return int          return points that customer has in their database
 */

function fx_get_customer_points($user_id){
	global $mysqli;
	$sql = "SELECT points FROM customers where id='{$user_id}'";
	$results = $mysqli->query($sql);
	if($results->num_rows > 0){
		$obj = $results->fetch_object();
		return $obj->points;
	}
	return 0;
}


/**
 * function to redeem points based on the points collected by user, this functions converts points to reusable amount value
 * and that can be used in the checkout process to purchase the product. Also reduced the points that are used when checkout 
 * and update the db with the remaining balance in points. 
 *
 * @param int $user_id customer id
 * @param int $redeem_points_requested points that should be checked against db.
 * @return mixed return object when there update is made in the customer profile or false when fails. 
 */

function fx_redeem_points($user_id,$cart_total){
	global $mysqli, $loyalty_rule;
	$points_required = ceil($cart_total/$loyalty_rule);
	$points = fx_check_points_available($user_id,$points_required);
	if($points){
		// finding out the points that we require to redeem the checkout items.		
		$redeem_points_sql = "UPDATE customers SET points = points - {$points_required} where id = {$user_id}" ;

		return $mysqli->query($redeem_points_sql);		
	}else{
		return false;
	}
}

/**
 * fx_check_points_available()
 * Function will check the requested points against the customer profile to make sure we have
 * the enough points to puchase the product. Otherwise return false if there is no enough balance 
 * in the customer profile. 
 * 
 * 
 * @param int $user_id logged in user id
 * @param int $points_required user requested points to be redeemed 
 * @return int return 0 or available points in the profile. 
 *                      
 */

function fx_check_points_available($user_id,$points_required){
	global $mysqli;
	$sql = "SELECT points FROM customers where id = {$user_id} and points >= $points_required LIMIT 1";
	$results = $mysqli->query($sql);
	if($results->num_rows > 0){
		$obj = $results->fetch_object();
		return $obj->points;
	}
	return 0;
}


