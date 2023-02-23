    	<!--<a href="#"><img src="img/San_Pham/msi_xmas_banner_6.jpg" width="1100px" height="350px"/></a>-->
<div class="slideshow-container">

    <div class="mySlides fade">
      <img src="img/Banner/bannertrangchu-1.jpg" style="width:100%; height:350px">
    </div>

    <div class="mySlides fade">
      <img src="img/Banner/bannertrangchu-2.jpg" style="width:100%; height:350px">
    </div>

    <div class="mySlides fade">
      <img src="img/Banner/bannertrangchu-3.png" style="width:100%; height:350px">
    </div>
    
    <div class="mySlides fade">
      <img src="img/Banner/bannertrangchu-4.jpg" style="width:100%; height:350px">
    </div>
	
    <div style="text-align:center; width:100px; margin:0px auto; margin-top:-22px">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span>
    </div>
</div>

<!-- Nguon : w3shool-->
<script>
		var slideIndex = 0;
		showSlides();
		
		function showSlides() {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			for (i = 0; i < slides.length; i++) 
			{
			   slides[i].style.display = "none";  
			}
			slideIndex++;
			if (slideIndex > slides.length) {slideIndex = 1}    
			for (i = 0; i < dots.length; i++)
			{
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";  
			dots[slideIndex-1].className += " active";
			setTimeout(showSlides, 5000); // Change image every 2 seconds
		}
	</script> 
        
