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
<div class="footer">

	
	<?php
$time       = microtime();
$time       = explode(' ', $time);
$time       = $time[1] + $time[0];
$finish     = $time;
$total_time = round(($finish - $start), 4);
echo "<div class=\"text\" style =\"margin-left:10px;\" >Powered by <br>sadaCMS<br>loaded in $total_time seconds.";
?>
<p> © <?php
echo "Sada Supermarket";


    mysqli_close($conn);
?></p>
</div>

</div>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}


</script>
</body>
</html>