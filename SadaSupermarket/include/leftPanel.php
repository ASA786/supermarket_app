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
?>
<div class="leftcol">


	


	
	<div class="leftPanelTitle">Shopping Cart</div>
	<div class="leftPanelContent" > 
	<?php if (isset($_SESSION['login_user'])) { ?>
<div id="shopping-cart"><form method="post" action="">

<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<br>
<th><strong>Name</strong></th>

<th><strong>QTY</strong></th>

<th><strong></strong></th>
</tr>	
<?php
		
   $productsInBasket = getProductsFromBasket($conn,$_SESSION['login_user']);
           $totalprice = 0;
        if (count($productsInBasket)) {
            foreach ($productsInBasket AS $id => $basket_info) {
				
		?>
				<tr>
				<td><strong><?php echo $basket_info['product_name']; ?></strong></td>

				<td><?php echo $basket_info['quantity']; ?></td>

				<td>	
				<button name="remove" type="submit" value="<?php echo $basket_info['id']; ?>" style = "width:70px;">Remove</button></td>
				</tr>
				
<?php 

} } 





?>


<tr>

</tr>


</tbody>

</table>
<br>



<button name="clear" type="submit" value="" style="width: 145px;" >Clear Cart</button>
<button name="checkout" type="submit" value="" style="width: 145px; float:right;" >Checkout</button>
</form>
<br>
<?php 
	if ( isset($_POST['remove'])){
        $deleteProductByCode = deleteProductsFromBasket($conn,$_SESSION['login_user'], $_POST['remove']);
	echo $deleteProductByCode;
	echo "<meta http-equiv='refresh' content='0'>";
	}
	
	if ( isset($_POST['checkout'])){
header('Location: ?checkout');
	}

	if ( isset($_POST['clear'])){
        $deleteProduct = deleteProducts($conn,$_SESSION['login_user']);
	echo $deleteProduct;
	echo "<meta http-equiv='refresh' content='0'>";
	}

echo "	</div> ";echo "	</div> ";
}else { 
echo "Need to be logged in";
echo "	</div> ";
}


?>	


	
		
	<div class="leftPanelTitle"><?php
if (isset($_SESSION['login_user'])) {
    echo "Account";
} else {
    echo "Login";
}
?>

   </div>
	<div class="leftPanelContent">
	


	<?php
if (isset($_SESSION['login_user'])) {
    $info = accountInfo($_SESSION['login_user'], $conn);
    if (count($info)) {
        foreach ($info AS $id => $info_data) {
            echo "\n";
            echo "  <div class=\"text\">";
            echo "   <h1>  Profile Information </h1> ";

            echo " Email: $info_data[email]\n";
			echo "<br>";
			 echo " Balance:  £$info_data[balance]\n";
			 			echo "<br>";
			 echo "  Loyality Points:  $info_data[points]\n";
			 echo "<br>";

		
            $ucp = ucp($conn, $info_data['account_type']);
            $i   = 0;
			echo "<ul style=\"list-style-type:none;\">\n";
			echo "  <li><a href=\"?transc\"> Receipts</a></li>\n";
            if (count($ucp)) {
                foreach ($ucp AS $id => $ucpdata) {

                    echo "  <li><a href=\"?ucp=$ucpdata[id]\"> $ucpdata[name]</a></li>\n";

                }
		}                    echo "</ul>";
		echo "<br>";
		?> <div style = "text-align: center;"><?php
						echo "		<form action=\"\"  method = \"post\">\n";			
            echo "	<button type=\"submit\" name=\"redeem\" >Redeem Points</button>\n";
			echo "	<button type=\"submit\" name=\"addBalance\">Add Balance</button>\n";
			
            echo "	</form>\n";
            echo "		<form action=\"/core/logout.php\"  method = \"post\">\n";
			
            echo "	<button type=\"submit\" name=\"logout\">Logout</button>\n";

            echo "	</form>\n";
			?> </div>
			<?php
			if (isset($_POST['redeem'])){
				
		
	

	 
			$redeemedPoints = redeemPoints ($conn,$_SESSION['login_user'], $info_data['points']);
			echo "<meta http-equiv='refresh' content='0'>";
			echo $redeemedPoints;

			
			
			
			
			}elseif (isset($_POST['addBalance'])) {
				
				
				
				
			header('Location: ?addBalance');
			
			
			
			}
			

			
            echo "</div>\n";
			echo "	</div> ";echo "	</div> ";
        }
    }
} else {
    echo "  <div class=\"text\" style=\"text-align:;\">";
    echo "		<form action=\"\" class=\"container\" method = \"post\">\n";
    echo "    <input type=\"text\" placeholder=\"Enter Email\" name=\"username\" required>\n";
    echo "    <input type=\"password\" placeholder=\"Enter Password\" name=\"password\"  \"required>      \n";
    echo "	<button type=\"submit\" name=\"login\">Login</button>\n";
				echo "<a style =\"margin-left:5px;\" href=\"?page=register\">Register here</a>";

    echo "	</form>\n";

    if (isset($_POST['login'])) {
        $result = login($_POST['username'], $_POST['password'], $conn);
        if ($result == true) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "  <div class=\"text\" style=\"text-align:center;color:#d42d2d; \"> Username or Password are wrong, Please try again.";
           echo "	</div> ";echo "	</div> ";echo "	</div> ";echo "	</div> ";
			
        } 
    }else {echo "</div>";echo "</div>";echo "	</div> ";}
}

?>	
