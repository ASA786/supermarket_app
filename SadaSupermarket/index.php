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
<?php
include "include/header.php";
?>



<!-- Displays the header(image banner) -->
<div class="header"></div>


 <div class="menu"></div>
</div>

<div class="row" style="margin-top:1px;" >

<?php
require_once SITE_ROOT . "/include/leftPanel.php";
?>


<?php
include "include/leftPanel.php";
?>

<!-- Where the Right col starts -->
<div class="rightcol">
	<?php

if (isset($_GET['page'])) {
    $page_name = $_GET['page'];
    if ($page_name == "register") {
		
?> <div class="rightPanelTitle">Register</div>              
<div class="rightPanelContent">            
<div class = "text" style = "text-align: center;">
<h1> Registration Form </h1>
			<form  action="" method="POST">

					<input type="text"   name="fname" placeholder="First Name"required><br>
					
					<input type="text"   name="sname" placeholder="Last Name"required><br>
					
					<input type="email"  name="email"placeholder="Enter your email"required><br>
					<br>
					<input type="text"   name="address" placeholder="Address"required><br>	
					
					<input type="text"   name="postcode" placeholder="Enter Postcode"required><br>	
					
					<input type="number"   name="mnumber" placeholder="Enter Mobile number"required><br>					
<br>
					<input type="password" name="pass"placeholder="Enter password"required><br>

					<input type="password" name="repass"placeholder="Re-password"required><br>

<br>
					    <button type="submit" name="register">Register</button>
						
						</form> <br>
						
	<?php   
        if (isset($_POST['register'])) {
            
            if ($_POST['pass'] == $_POST['repass']) {
                $result = register($_POST['fname'], $_POST['sname'], $_POST['email'], $_POST['address'], $_POST['postcode'], $_POST['mnumber'], $_POST['pass'], $conn);
				echo "<h1> ";
			   echo $result;
			   echo "</h1> ";

            } else {
								echo "<h1> ";
                echo "Passwords do not match";
							   echo "</h1> ";
            }
        }echo "</div>";    echo "</div>";    echo "</div>";
    } elseif ($page_name == "contact") {
?>  
	 <div class="rightPanelTitle">Contact Us</div>              
<div class="rightPanelContent">            
<div class = "text" >

<h1>Store Locator: Find a store near you</h1>
    There are many SADA superstores located here is a list of our stores
    <ol type="">
    <b>
<li>Hownslow – 1223 CHARLI LANE, TW34JR, 0845 123 4365</li>
<li>Ealing          - 691 ST MARY’S ROAD, W5 6TR, 0845 678 3432</li>
<li>Wembley    - 987 DELL WAY, NH671WQ  0846 789 2343         </li>   
<li>Hayes          - 43 NORTH HYDE ROAD UB38NR 0845 223 9099</li>
<li>Uxbridge    - 1 LONGLANE DRIVE, UB79PQ, 0854 337 8993     </li> 
<li>Southall     - 27 LANEDRIVESTREETROAD, UB12PT, 0845 001 007 </li>
<li>Northalt    - UNIT 1 DEADLY MEDOWS, NT347ER 0857 090 1122</li>
<li>Acton        -  AMIGO INDUSTRIAL AREA, AM73WR 0867 344 2232</li>
<li>ShepardBush – BUSHY LANE, BU77SH, 0845 777 3242</li>
<li>Reading – FATA LANE, RD11NR, 0877 909 2345</li>
<li>Slough – DE MANGD VILLAS, SL11UT 0867 234 7786</li>
<li>Maidenhead – COOPERS LANE, OM11GY, 0856 887 9922</li>
</b>
</ol>

<h1>Contact us: How do you contact us?</h1>
Email – info@sadasuper.com<br>
Head Office Number – 0845 786 8672    <br><br>

<h1>Refunds: How do I get a refund?</h1>
We are very sorry to hear that you have to return something but we here at SADA superstore follow a very strict no refunds policy, however not to worry we will simply give you store credit for the item you return.                             Your Statuary rights as a customer are not affected.

<h1>Complaints: Got any complaints?</h1>
        Who do you contact to file a complaint, well we break it down in three categories
<ol type="A">
<li>Product – if the complaint is about a product than we regret to inform you that we are mearly a mediator between the brand and the customer so any product complaints should me made directly to the product company. If you require more information just pop down to any one of our branches and a customer service advisor will be able to provide you with more information.</li>
<li>Store – if you need to make a complaint about a store you have visited please email our complaints helpline team at nolyf_help@sadasuper.com please make sure you provide the store location and other details in the complaint.</li>
<li>Service – if you have had poor services we are absolutely sorry that this has happened to you, please provide us with further information and what we could of done to rectify or better provide you of service at service@sadasuper.com.<br></li>
</ol>


<h1>Price match: Our price match policies </h1>
Over here at SADA superstore we have our own price match policies due to the fact that we are not Tesco’s, Sainsbury’s or Asda’s we don’t match simple is it not? But we still have the best deals our customers tell us.
<h1>Product Emergency Recalls: </h1>
If we need to recall our products we will post about it here
Latest updates – we are recalling the following product 100% Beef Patties item no 1016571 sold between June 2001 and July 2017 if you still have this product return it immediately. The reason being because that’s not beef mate it’s a bit of a donkey mixture    still good protein though.


<br> <br>

<?php
        echo "</div>";
        echo "</div>";
    } else {
        $pages = page_info($conn, $page_name);
        if (count($pages)) {
            foreach ($pages AS $id => $data) {
                echo "    <div class=\"rightPanelTitle\">$data[page_name]</div>\n";
                echo "    <div class=\"rightPanelContent\">";
                echo "  <div class=\"text\"> <h1>  $data[title] </h1> $data[content] </div>\n";
            }
        }
    }
} elseif (isset($_GET['cat'])) {
    
    if (isset($_SESSION['login_user'])) {
?>
	<div class="rightPanelTitle">Groceries</div>              
         
<div class = "text" style = "text-align: center; margin-left:20px;">
<?php
        
        
?>


<div id="product-grid">

    <?php
        $products = getProducts($conn, $_GET['cat']);
        if (count($products)) {
            foreach ($products AS $id => $products_info) {
                
                
?>

        <div class="product-item">
            <form method="post" action="">

            <div><strong><?php
                echo $products_info["name"];
?></strong></div>
                        <div class="product-image"><img src="images/products/<?php
                echo $products_info["image"];
?>"></div>
            <div class="product-price"><?php
                echo "£" . $products_info["price"];
?></div>
            <div><input type="text" name="quantity" value="1" size="2" style="width:35px; margin-right:5px;" /><button name="add" type="submit" value="<?php
                echo $products_info["code"];
?>">Add</button></div>
            </form>
        </div>
    <?php
            }
        }
        if (isset($_POST['add'])) {
            $productByCode = insertProductsToBasket($conn, $_SESSION['login_user'], $_POST['add'], $_POST['quantity']);
            echo $productByCode;
            echo "<meta http-equiv='refresh' content='0'>";
            
            
        }
    } else {
        
?> 
        
        <div class="rightPanelTitle">Groceries</div>    
        <div class="rightPanelContent">
        
        <?php
        echo "Need to be logged in";
        echo "</div>  ";
    }
    
?>
</div>
	
	
	<!-- Abdol below here here -->
	
	
	<!--Abdols part finished -->
	
	
	<!-- Akber below here here -->
	
	
	<!--Akber part finished -->
	
		<div class="rightPanelTitle">Latest News</div><!-- Right Panel Title-->
	<div class="rightPanelContent"><div style="text-align:center">
	<!-- Where the Slider starts, -->
<a class="prev" onclick="plusSlides(-1)">❮</a>
  <span class="dot active" onclick="currentSlide(1)"></span> 
  <!-- Different Slides starts here -->
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  <a class="next" onclick="plusSlides(1)">❯</a>
  
  <!-- The content for the slides starts here -->
<br><br></div><div class="mySlides fade" style="display: block;">
<div class="topic_banner" style="background-image:url('/images/topic_banner.jpg')"> </div>


  <div class="text"> <h1> 20% Offer on Fruits </h1> Ut vidit aperiam mea, vim ut dolor graece definitiones. Et alii dolorem usu. Ad est omnesque iracundia, sea reque iuvaret ut. Iriure reprimique eum in, ad has nulla possim, sed in alterum veritus. Te per nihil nusquam luptatum, ad nam appareat argumentum. <h1 style="text-align:right; font-size:12px;">2017-01-07 22:19:14 </h1> </div>
</div><div class="mySlides fade" style="display: none;">
<div class="topic_banner" style="background-image:url('/images/topic_banner.jpg')"> </div>


  <div class="text"> <h1> 20% Offer on Fruits </h1> Ut vidit aperiam mea, vim ut dolor graece definitiones. Et alii dolorem usu. Ad est omnesque iracundia, sea reque iuvaret ut. Iriure reprimique eum in, ad has nulla possim, sed in alterum veritus. Te per nihil nusquam luptatum, ad nam appareat argumentum. <h1 style="text-align:right; font-size:12px;">2017-01-08 19:31:18 </h1> </div>
</div><div class="mySlides fade" style="display: none;">
<div class="topic_banner" style="background-image:url('/images/topic_banner.jpg')"> </div>


  <div class="text"> <h1> Lorem Ipsum </h1> Ut vidit aperiam mea, vim ut dolor graece definitiones. Et alii dolorem usu. Ad est omnesque iracundia, sea reque iuvaret ut. Iriure reprimique eum in, ad has nulla possim, sed in alterum veritus. Te per nihil nusquam luptatum, ad nam appareat argumentum. <h1 style="text-align:right; font-size:12px;">2017-01-19 00:02:44 </h1> </div>
</div><div class="mySlides fade" style="display: none;">
<div class="topic_banner" style="background-image:url('/images/topic_banner.jpg')"> </div>


  <div class="text"> <h1> Lorem Ipsum </h1> Ut vidit aperiam mea, vim ut dolor graece definitiones. Et alii dolorem usu. Ad est omnesque iracundia, sea reque iuvaret ut. Iriure reprimique eum in, ad has nulla possim, sed in alterum veritus. Te per nihil nusquam luptatum, ad nam appareat argumentum. <h1 style="text-align:right; font-size:12px;">2017-01-19 00:02:44 </h1> </div>
</div><div class="mySlides fade" style="display: none;">
<div class="topic_banner" style="background-image:url('/images/topic_banner.jpg')"> </div>


  <div class="text"> <h1> Lorem Ipsum </h1> Ut vidit aperiam mea, vim ut dolor graece definitiones. Et alii dolorem usu. Ad est omnesque iracundia, sea reque iuvaret ut. Iriure reprimique eum in, ad has nulla possim, sed in alterum veritus. Te per nihil nusquam luptatum, ad nam appareat argumentum. <h1 style="text-align:right; font-size:12px;">2017-01-19 00:02:44 </h1> </div>
</div></div></div></div>	



<br>


<br>





<?php
include "include/footer.php";
?>
