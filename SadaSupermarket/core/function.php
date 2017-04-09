<?php

function register($fname, $sname, $email, $address, $postcode, $number, $password, $conn)
{
    $fnam     = mysqli_real_escape_string($conn, $fname);
    $snam     = mysqli_real_escape_string($conn, $sname);
	$emai     = mysqli_real_escape_string($conn, $email);
    $addres     = mysqli_real_escape_string($conn, $address);
	$postcod     = mysqli_real_escape_string($conn, $postcode);
    $numbe     = mysqli_real_escape_string($conn, $number);
	$pass     = mysqli_real_escape_string($conn, $password);

  
    $sql1     = "SELECT email FROM account WHERE email = '$email'";
    $sql2     = "INSERT INTO `account` (`fname`,`sname`,`email`,`address`,`postcode`,`number`,`password`)
VALUES ('$fnam','$snam','$emai','$addres','$postcod','$numbe','$pass')";
    $check    = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($check) == 0) {
        if (mysqli_query($conn, $sql2)) {
            $result = "Registration Complete";
            return $result;
        } else {
            $result = "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            return $result;
        }
    } else {
        $result = "Username or Email is already in use";
        return $result;
    }

}

function getProducts($conn, $cate)
{


}

function getProductsFromBasket($conn, $user)
{
    $info   = array();
    $sql    = "SELECT * FROM cart WHERE user_id ='$user'ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

}

function getProductsFromStock($conn, $cate)
{


}

function receipt($conn, $user)
{
    $info   = array();

		$sql = "SELECT * FROM purchase_order WHERE user_id = '$user' ORDER BY date DESC";
	
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

}
function insertProductsToBasket($conn, $user, $code, $quantity)
{


}


function deleteProductsFromBasket($conn, $user, $id)
{
	$sql1    = "Delete FROM cart WHERE id='$id'";	
		
        if (mysqli_query($conn, $sql1)) {
            $result = "Deleted";
  return $result;
        } else {
            $result = "Error: " . $sql1 . "<br>" . mysqli_error($conn);

        }
    return $result;

}

function deleteProducts($conn, $user)
{

	$sql1    = "Delete FROM cart WHERE user_id = '$user'";	
		
        if (mysqli_query($conn, $sql1)) {
            $result = "Deleted";
  return $result;
        } else {
            $result = "Error: " . $sql1 . "<br>" . mysqli_error($conn);

        }
    return $result;



}

function checkOut($conn, $user, $price, $balance)
{ 
	
	
}

function login($username, $password, $conn)
{
    // username and password sent from form 
    $myusername = mysqli_real_escape_string($conn, $username);
    $mypassword = mysqli_real_escape_string($conn, $password);

    $sql        = "SELECT id FROM account WHERE email = '$myusername' and password  = '$mypassword'";
    $result     = mysqli_query($conn, $sql);
    $row        = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count      = mysqli_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $message                = true;
        return $message;
    } else {
        $message = false;
        return $message;
    }


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
	
 // username and password sent from form 
    $info   = array();
    $sql    = "SELECT * FROM pages";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

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
