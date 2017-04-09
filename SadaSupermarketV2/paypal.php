<?php include 'config.php'; ?>
<html>
<head>
<title>Redirecting to paypal...</title>
</head>
<body>
<p style="top:50%;left:50%;position:absolute;margin-left:-200px;">You are being redirected to the paypal secured page...</p>
<form id = "paypal_checkout" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post">
    <input name = "cmd" value = "_cart" type = "hidden">
    <input name = "upload" value = "1" type = "hidden">
    <input name = "no_note" value = "0" type = "hidden">
    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
    <input name = "tax" value = "0" type = "hidden">
    <input name = "rm" value = "2" type = "hidden">
 
    <input name = "business" value = "dmasiliunas-facilitator@yahoo.com" type = "hidden">
    <input name = "handling_cart" value = "0" type = "hidden">
    <input name = "currency_code" value = "GBP" type = "hidden">
    <input name = "lc" value = "GB" type = "hidden">
    <input name = "return" value = "<?php echo $site_url;?>/?id=<?php echo $_SESSION['user_id']; ?>" type = "hidden">
    <input name = "cbt" value = "Return to My Site" type = "hidden">
    <input name = "cancel_return" value = "http://mysite/mycancelpage" type = "hidden">
    
 <?php
$count = 1;
//print_r($_SESSION['cart_products']); 
$total = 0; 
foreach ($_SESSION["cart_products"] as $cart_itm)
{
//set variables to use in content below
	$product_name = $cart_itm["name"];
	$product_qty = $cart_itm["product_qty"];
	$product_price = $cart_itm["price"];
	$product_code = $cart_itm["code"];
$subtotal = ($product_price * $product_qty); //calculate Price x Qty ?>
    <div id = "item_<?php echo $count; ?>" class = "itemwrap">
        <input name = "item_name_<?php echo $count; ?>" value = "<?php echo $product_name; ?>" type = "hidden">
        <input name = "quantity_<?php echo $count; ?>" value = "<?php echo $product_qty; ?>" type = "hidden">
        <input name = "amount_<?php echo $count; ?>" value = "<?php echo $product_price; ?>" type = "hidden">
        <input name = "shipping_<?php echo $count; ?>" value = "0" type = "hidden">
    </div>
<?php 
	$count++; 
	$total = ($total + $subtotal); //add subtotal to total var
}?>
 
 <input name = "custom" value = "<?php echo base64_encode($_SESSION['email'] . '|' . $total ); ?>" type = "hidden">
    <input id = "ppcheckoutbtn" value = "Checkout" class = "button" type = "submit" style="display:none;">

</form>
</body>
<script>
	document.getElementById("paypal_checkout").submit();
</script>
</html>