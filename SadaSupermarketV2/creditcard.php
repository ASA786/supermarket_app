<?php
require 'config.php';
require 'lib/stripe/init.php';
  $error = '';
  $success = '';
  $total = 0;
 foreach ($_SESSION["cart_products"] as $cart_itm)
{
    //set variables to use in content below

    $product_qty = $cart_itm["product_qty"];
    $product_price = $cart_itm["price"];

    $subtotal = ($product_price * $product_qty); //calculate Price x Qty

    $total = ($total + $subtotal); //add subtotal to total var
}

if ($_POST) {
  Stripe::setApiKey($stripe_api_key);




 
  try {
    if (!isset($_POST['stripeToken']))
      throw new Exception("The payment token was not generated correctly");
    Stripe_Charge::create(array("amount" => $total,
                                "currency" => "gbp",
                                "card" => $_POST['stripeToken']));
    $success = 'Your payment was successful.';
  }
  catch (Exception $e) {
    $error = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Credit Card Processing...</title>
        <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('YOUR-PUBLISHABLE-API-KEY');

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }

            $(document).ready(function() {
                $("#payment-form").submit(function(event) {
                    // disable the submit button to prevent repeated clicks
                    $('.submit-button').attr("disabled", "disabled");

                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                });
            });
        </script>
    </head>
    <body>
        <h1>Charge GBP <?php echo $total; ?> with Stripe</h1>
        <!-- to display errors returned by createToken -->
        <div class="payment-errors" style="color:#d90000;padding:10px;"><?php $error ?></div>
        <div class="payment-success"><?php $success ?></div>
        <form action="" method="POST" id="payment-form">

            <div class="form-row">
                <label>Card Number</label>
                <input type="text" value="4242424242424242" size="20" autocomplete="off" class="card-number" />
            </div>
            <div class="form-row">
                <label>CVC</label>
                <input type="text" value="123" size="4" autocomplete="off" class="card-cvc" />
            </div>
            <div class="form-row">
                <label>Expiration (MM/YYYY)</label>
                <input type="text" size="2" value="05" class="card-expiry-month"/>
                <span> / </span>
                <input type="text" size="4" value="2020" class="card-expiry-year"/>
            </div>
            <input type="hidden" name="key" value="pk_test_ji7RKADCKT1i9fohMXv0HrU6">
            <button type="submit" class="submit-button">Submit Payment</button>
        </form>
    </body>
</html>