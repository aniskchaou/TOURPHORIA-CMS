<?php extract(shortcode_atts(array(
    'style_layout'  => '',
    'st_images_slider'         => '',
  ), $attr));
$img_ids = explode(",",$st_images_slider);
if(isset($style_layout) && !empty($style_layout)){
	$item = $style_layout;
} else {
	$item =1;
}
?>
<div class="st-single-slider">
	<div class="owl-carousel slider-st">
		<?php
			foreach ($img_ids as $key => $imgs) {
				$image_src = wp_get_attachment_image_src($imgs,'');?>
				<div class="item-img">
					<?php if(isset($image_src)){?>
					<img src="<?php echo esc_url($image_src[0]);?>" alt="">
					<?php }?>
				</div>
		<?php }?>
	</div>
</div>
<script type="text/javascript">
	jQuery(function($){
	    $(document).ready(function(){
	        $('.st-single-slider .slider-st').each(function () {
	            $(this).owlCarousel({
	                loop:true,
	                items: 1,
	                margin: 0,
	                responsiveClass:true,
	                navigation: true,
	                autoplay:true,
				    autoplayTimeout:3000,
				    autoplayHoverPause:true,
	                responsive:{
	                    0:{
	                        items:1,
	                    },
	                    575:{
	                        items:1,
	                    },
	                    992:{
	                        items:1,
	                    },
	                    1200:{
	                        items:1,
	                    }
	                }
	            });
	        });
	    });
	});
</script>