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
