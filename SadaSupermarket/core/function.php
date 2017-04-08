<?php

function register($fname, $sname, $email, $address, $postcode, $number, $password, $conn)
{


}

function getProducts($conn, $cate)
{


}

function getProductsFromBasket($conn, $user)
{


}

function getProductsFromStock($conn, $cate)
{


}

function receipt($conn, $user)
{


}
function insertProductsToBasket($conn, $user, $code, $quantity)
{


}


function deleteProductsFromBasket($conn, $user, $id)
{


}

function deleteProducts($conn, $user)
{




}

function checkOut($conn, $user, $price, $balance)
{ 
	
	
}

function login($username, $password, $conn)
{


}

function news($conn)
{
 // username and password sent from form 
    $messages = array();
    $sql      = "SELECT * FROM news ORDER BY date";
    $result   = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $messages["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $messages;
    }
}
function accountInfo($username, $conn)
{


}

function pages($conn)
{


}
function page_info($conn, $pagename)
{


}
function ucp($conn, $type)
{


}

function addBalance($conn, $user, $balance) {
	

}

function redeemPoints($conn, $user, $points) {
	
	
}

function promoCode($conn, $user, $code) {
	
$sql = "SELECT * FROM promotions WHERE code = '$code'";	
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $newCat = $row["cate"];
		$reduction = $row["discount"];

		
    }
if ($newCat == 0) {
	$sql1 = "UPDATE cart SET s_price = s_price - s_price *'$reduction', discounted = 1  WHERE user_id = '$user' AND discounted = 0";
}else {
$sql1 = "UPDATE cart SET s_price = s_price - s_price *'$reduction', discounted = 1  WHERE user_id = '$user' AND cate = '$newCat' AND discounted = 0";
}
if (mysqli_query($conn, $sql1)){
$result = "Points Redeemed";
}else {
	$result = "Not Added";
}
	return $result;	
	
}}

function restock($conn, $code, $quantity) {

}
?>
