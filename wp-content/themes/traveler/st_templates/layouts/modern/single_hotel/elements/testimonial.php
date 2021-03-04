<?php extract(shortcode_atts(array(
    'title'          => '',
    'list_testimonial'      => '',
    'icon_image'      => '',
  ), $attr));
$list_testimonial = vc_param_group_parse_atts($list_testimonial);
$icon = wp_get_attachment_image_src($icon_image, array(30,30)); 
if(isset($icon) && !empty($icon)){
	$icon_image = $icon;
} else {
	$icon_image = get_template_directory_uri() .'/v2/images/html/ico_right-quote-sign.svg';
}?>
<div class="st-testimonial-slider">
	<h3><?php  echo esc_attr($title);?></h3>
<?php if(!empty($list_testimonial)){ ?>
    <div class="owl-carousel st-testimonial-slider-single">
    	<?php foreach ($list_testimonial as $k => $v){ ?>
        <div class="item has-matchHeight">
        	<div class="icon-test">
        		<img src="<?php echo esc_url($icon_image[0]);?>" alt="Testimonial">
        	</div>
        	<p>
                <?php echo esc_attr($v['content']); ?>
            </p>
            <div class="info-author">
            	<div class="author">
	                <?php $img = wp_get_attachment_image_src($v['avatar'], array(60,60)); ?>
	                <img src="<?php echo esc_url($img[0]); ?>" alt="User Avatar" />
	                <div class="author-meta">
	                	<div class="st-wrap-content">
	                		<h4><?php echo esc_attr($v['name']); ?></h4>
		                    <div class="job">
		                    	<?php echo esc_attr($v['job']);?>
		                    </div>
	                	</div>
	                    
	                </div>
	            </div>
            </div>
        </div>
        <?php }?>
	</div>
	<button class="st-arrow prev carousel--prev"><img src="<?php echo get_template_directory_uri() .'/v2/images/html/ico_pre_3.svg';?>" alt=""></button>
        <button class="st-arrow next carousel--next"><img src="<?php echo get_template_directory_uri() .'/v2/images/html/ico_next_3.svg';?>" alt=""></button>
	<script type="text/javascript">
		jQuery(function ($){
			$('.st-testimonial-slider-single').each(function () {
				var parent = $(this).parent();
				var owl = $(this);
	            $(this).owlCarousel({
	                loop:true,
	                items: 1,
	                navigation: true,
	                responsiveClass:true,
	                responsive:{
	                    0:{
	                        items:1,
	                        margin: 15,
	                    },
	                    575:{
	                        items:2,
	                    },
	                    992:{
	                        items:1,
	                    },
	                    1200:{
	                        items:1,
	                    }
	                }
	            });
	            $('.next', parent).click(function(ev) {
	                ev.preventDefault();
	                owl.trigger('next.owl.carousel');
	            });
	            $('.prev', parent).click(function(ev) {
	                ev.preventDefault();
	                owl.trigger('prev.owl.carousel');
	            });
	        });
		});
		
	</script>
<?php }?>
</div>