<div class='row'>
	<div class="bg-holder">
	    <div class="bg-mask"></div>
	<div class="bg-parallax" style="background-image: url(<?php echo esc_url($background_image);?>); background-position: 50% -62.4px;"></div>
	    <div class="bg-content" style='padding: 60px 15px 40px 15px '>
	        <div class="container gap gap-big text-white">
	            <h2 class='text-uc mb20'><?php echo esc_html($welcome_text) ;?></h2>
	               
	                <?php echo  balancetags($content);?>  
	            
	        </div>
	    </div>
	</div>
</div>