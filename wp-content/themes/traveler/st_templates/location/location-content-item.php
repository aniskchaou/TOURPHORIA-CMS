<?php 	
return ; 
	$layout_id = st()->get_option('hotel_search_result_page' , true);
	$image_attributes = wp_get_attachment_image_src( $thumb , array(800,600) );	
	$link=esc_url(add_query_arg(array(
		'location_name'=>get_the_title(),
		'location_id'=>get_the_ID(),
		'post_type'=>$post_type,
		's'=>'',
		'layout'=>$post_type=="st_hotel" ? $layout_id : ''),home_url()));
?>
<div class="">
	<div class="thumb">
		<a class="hover-img" href="<?php echo esc_url($link) ; ?>">
			<?php if ($image_attributes){ ?>
				<?php echo STLocation::scrop_thumb($image_attributes[0]) ; ?>
				
			<?php }?>
			<div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
				<div class="text-small">
					<h5><?php the_title(); ?> <?php echo esc_attr($post_type_name) ; ?></h5>
					<p><?php echo ($reviews>=1)? esc_attr($reviews)." ".__('reviews',ST_TEXTDOMAIN) : __("0 review",ST_TEXTDOMAIN)  ;?></p>
					<p class="mb0"><?php echo ($offers >=1) ? esc_attr($offers)." ".__('offers',ST_TEXTDOMAIN) : __("0 offer",ST_TEXTDOMAIN) ;   echo ' '.__('from',ST_TEXTDOMAIN); echo TravelHelper::format_money( $min_max_price['price_min'] ) ?></p>
				</div>
			</div>
		</a>
	</div>
</div>