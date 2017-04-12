<?php
#####################################################
##                                                 ##
##                                                 ##
##                                                 ##
##            Copyrights © PosionCMS     		   ##
##                                                 ##
##                                                 ##
##                                                 ##
##                                                 ##
#####################################################


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
    $info   = array();
    $sql    = "SELECT * FROM products WHERE cate = '$cate' ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

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
    $info   = array();
	if ($cate == 1){
    $sql    = "SELECT * FROM stock ORDER BY product_type ASC";
	}elseif ($cate == 2){
		$sql = "SELECT * FROM stock WHERE product_quantity < 750 ORDER BY product_quantity ASC";
	}
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

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
    $info   = array();
    $sql    = "SELECT * FROM products WHERE code='$code'";
	


    $check    = mysqli_query($conn, $sql);
	if (mysqli_num_rows($check) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($check)) {
		
		$r_name = $row['name'];
		$r_code = $row['code'];
		$r_cate = $row['cate'];
		$r_price = $row['price'];
		$f_price = $r_price * $quantity;
	$sql1    = "SELECT * FROM cart WHERE product_code='$code' AND user_id = '$user'";	
		
	$check1    = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($check1) > 0) {
	$sql2 = "UPDATE cart SET quantity = quantity + '$quantity' WHERE product_code = '$code' AND user_id='$user'" ;
	}else {
   $sql2     = "INSERT INTO cart (`user_id`,`cate`,`product_name`,`product_code`,`quantity`,`s_price`, `f_price`)
VALUES ('$user','$r_cate','$r_name','$r_code','$quantity','$r_price','$f_price')";
	}
        if (mysqli_query($conn, $sql2)) {
            $result = "Added To Basket";

        } else {
            $result = "Error: " . $sql2 . "<br>" . mysqli_error($conn);

        }
    }return $result;
} 

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
	
	$sql1 = "INSERT INTO purchase_order (`user_id`, `price`, `date`) VALUES ('$user', '$price', now())"; 
	if (mysqli_query($conn, $sql1)) {
    $last_id = mysqli_insert_id($conn);
	$sql2 = "INSERT INTO purchase_transaction (`purchase_id`, `product_id`, `product_name`, `s_price`, `quantity`) 
	(SELECT '$last_id', product_code, product_name, s_price, quantity FROM cart where user_id = '$user');";
	$sql3 = "DELETE FROM cart WHERE user_id = '$user';";
	$sql4 = "UPDATE account SET balance = '$balance' WHERE email = '$user'";
	$points = $price * 0.1;
	$sql5 = "UPDATE account SET points = points + '$points' WHERE email = '$user'";
	$sql_select = "SELECT * FROM cart where user_id = '$user'";

	mysqli_query($conn, $sql2);
	
	$result = mysqli_query($conn, $sql_select);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$quan = $row['quantity'];
		$cod = $row['product_code'];
		$sql_update = "UPDATE stock SET product_quantity = product_quantity - '$quan' WHERE product_id = '$cod' ";
		mysqli_query($conn, $sql_update);

	}	
    }
	mysqli_query($conn, $sql3);
		mysqli_query($conn, $sql4);
				mysqli_query($conn, $sql5);
} else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}


	
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
    // username and password sent from form 
    $info   = array();
    $sql    = "SELECT * FROM account WHERE email = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

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
    // username and password sent from form 
    $info   = array();
    $sql    = "SELECT * FROM pages WHERE page_url = '$pagename'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }

}

function ucp($conn, $type)
{
    // username and password sent from form 
    $info   = array();
    $sql    = "SELECT * FROM ucp_features WHERE enable = '$type'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($results = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $info["$results[id]"] = $results;
        }
        mysqli_free_result($result);
        return $info;
    }
    return $info;

}


function addBalance($conn, $user, $balance) {
	
$sql = "UPDATE account SET balance = balance + '$balance' WHERE email = '$user'";
if (mysqli_query($conn, $sql)){
$result = "Added";
}else {
	$result = "Not Added";
}
	return $result;
}


function redeemPoints($conn, $user, $points) {
	
	
$sql = "UPDATE account SET points = 0 WHERE email = '$user'";	
$newBalance = $points * 0.05;
$sql1 = "UPDATE account SET balance = balance + '$newBalance' WHERE email = '$user'";
mysqli_query($conn, $sql);
if (mysqli_query($conn, $sql1)){
$result = "Points Redeemed";
}else {
	$result = "Not Added";
}
	return $result;
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
	
	
$sql = "UPDATE stock SET product_quantity = product_quantity + '$quantity' WHERE id = '$code'";	

if (mysqli_query($conn, $sql)){
$result = "Restocked";
}else {
	$result = "Error";
}
	return $result;
}
?>
