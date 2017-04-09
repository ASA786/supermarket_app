<?php
include_once("config.php");
$total = 0;
 foreach ($_SESSION["cart_products"] as $cart_itm)
{
    //set variables to use in content below

    $product_qty = $cart_itm["product_qty"];
    $product_price = $cart_itm["price"];

    $subtotal = ($product_price * $product_qty); //calculate Price x Qty

    $total = ($total + $subtotal); //add subtotal to total var
}
$_SESSION['cart_total'] = $total;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Billing Info</title>
	<link href="style/style.css" rel="stylesheet" type="text/css"></head>
</head>
<body>
	<h1 align="center">Checkout page</h1>
	<div class="cart-view-table-back">
		<div class="checkout-form">


		<table width="100%"  cellpadding="6" cellspacing="0">
			<thead>
				<tr>
					<th>Quantity</th>
					<th>Name</th>
					<th>Price</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
if(isset($_SESSION["cart_products"])) //check session var
{
$total = 0; //set initial total value
$b = 0; //var for zebra stripe table 
foreach ($_SESSION["cart_products"] as $cart_itm)
{
//set variables to use in content below
	$product_name = $cart_itm["name"];
	$product_qty = $cart_itm["product_qty"];
	$product_price = $cart_itm["price"];
	$product_code = $cart_itm["code"];
$subtotal = ($product_price * $product_qty); //calculate Price x Qty

$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
echo '<tr class="'.$bg_color.'">';
echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
echo '<td>'.$product_name.'</td>';
echo '<td>'.$currency.$product_price.'</td>';
echo '<td>'.$currency.$subtotal.'</td>';
echo '</tr>';
$total = ($total + $subtotal); //add subtotal to total var
}

$grand_total = $total + $shipping_cost; //grand total including shipping cost
foreach($taxes as $key => $value){ //list and calculate all taxes in array
	$tax_amount     = round($total * ($value / 100));
	$tax_item[$key] = $tax_amount;
$grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
}

$list_tax       = '';
foreach($tax_item as $key => $value){ //List all taxes
	$list_tax .= $key. ' : '. $currency. sprintf("%01.2f", $value).'<br />';
}
$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
}
?>
<tr>
	<td colspan="5">
		<span style="float:right;text-align: right;"><?php echo $shipping_cost. $list_tax; ?>Amount Payable : <?php echo sprintf("%01.2f", $grand_total);?></span>
	</td>
</tr>
<tr>
</tr>
</tbody>
</table>
			<?php if(@$_GET['message']=="fail"): ?>
				<?php if(isset($_GET['text'])): ?>
					<P class="error"><?php echo strip_tags(@$_GET['text']); ?></P>
				<?php else: ?>
					<p class="error">System has issues creating a user. Please try again</p>					
				<?php endif; ?>
				
			<?php endif; ?>
			
			<form <?php if(@$_GET['next']=="true" && !empty($_SESSION['user_id']) ) echo 'style="display:none"'; ?> action="create-user.php" method="post" name="checkout-form" id="checkout-form" novalidate>
				<fieldset>
					<legend>Account Info</legend>

					<div class="half-width">
						<label for="userName">Username</label>
						<input type="text" id="userName" name="username" required>
					</div>

					<div class="half-width m0">
						<label for="userEmail">Email</label>
						<input type="email" id="userEmail" name="email" required>
					</div>

					<div class="half-width">
						<label for="userPassword">Password</label>
						<input type="password" id="password" name="password" required>
					</div>

					<div class="half-width m0">
						<label for="password_again">Repeat Password</label>
						<input type="password" id="password_again" name="password_again">
					</div>
					<div class="full-width m0">
						<input type="submit" value="Next" class="button submit-btn">
					</div>
				</fieldset>

			</form> 
			
			<?php if(@$_GET['next']=="true" && $_SESSION['payment-step']=="true"): ?>
			<form action="success.php" method="post" name="checkout-form" id="checkout-form">
				<fieldset id="payment">
					<legend>Payment Method</legend>

					<div>
						<ul class="cd-payment-gateways">
							<li>
								<a class="redeempoint" id="redeem-link" href="redeem.php" style="text-decoration: none;">Redeem with Points</a>
							</li>
			
							<li>
								<!-- <input type="radio" name="payment-method" id="paypal" value="paypal" checked> -->
								<a href="paypal.php"><img src="images/paypal.png" height="60"></a>

							</li>

							<li>
								<!-- <input type="radio" name="payment-method" id="card" value="credit-card" > -->
<!-- 								<label for="card">Credit Card</label> -->

							  <script
							    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							    data-key="<?php echo $stripe_api_key; ?>"
							    data-amount="<?php echo $total; ?>"
							    data-currency="GBP"
							    data-name="<?php echo $site_name; ?>"
							    data-description="Charge GBP <?php echo $total; ?>"
							    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
							    data-locale="auto">
							  </script>
							
							</li> 
						</ul> <!-- .cd-payment-gateways -->
					</div>

				</fieldset>
				<div class="submit-btn">
					<!-- <input type="submit" value="Complete Your Order" class="submit-btn"> -->
				</div>
			</form>
		<?php endif; ?>
		</div>

</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
	jQuery(function($){
		$("#checkout-form").validate({
			  rules: {
			  	username: "required",
			  	email: {
			  		required:true,
			  		email : true
			  	},
			    password: "required",
			    password_again: {
			      equalTo: "#password"
			    }
			  }
			});
	});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	jQuery(function(){
		jQuery("#redeem-link").on("click",function(e){
			jQuery(this).attr("href","redeem.php?points="+jQuery("#redeem-points-text").val());
			return true;
		});
	})
</script>
<script type="text/javascript">
	$(function(){
		$('input[type="radio"]#card').click(function(){
			if ($(this).is(':checked'))
			{
				$('.cd-credit-card').css('display','block');
			}
		});

		$('input[type="radio"]#paypal').click(function(){
			if ($(this).is(':checked'))
			{
				$('.cd-credit-card').css('display','none');
			}
		});
	});
</script>
</body>
</html>