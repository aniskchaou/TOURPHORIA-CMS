<?php
    //wp_enqueue_script( 'detailed-map' );
?>
<?php 
	$hotel_id = get_post_meta(get_the_ID(), 'room_parent', true );
	$lat = '';
	$lng = '';
	if($hotel_id && intval($hotel_id) > 0){
		$lat = get_post_meta($hotel_id, 'map_lat', true);
		$lng = get_post_meta($hotel_id, 'map_lng', true);
	}

	$img = '';
	if(has_post_thumbnail() and get_the_post_thumbnail()){
		$img_tmp = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
		$img = $img_tmp[0];
	}else{
		$img = ST_TRAVELER_URI.'/img/no-image.png';
	}
?>
<div class="st-room-map" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>" data-zoom="<?php echo esc_attr($data['zoom']); ?>">
	
</div>
<div id="st-room-map-content-wrapper" style="display: none">
	<div class="st-room-map-content">
		<div class="thumb">
			<img src="<?php echo esc_url($img); ?>" alt="<?php echo TravelHelper::get_alt_image(get_post_thumbnail_id( )); ?>" class="img-responsive">
		</div>
		<div class="content clearfix">
			<h6 class="text-color"><?php the_title(); ?></h6>
			<?php 
				if($hotel_id && intval($hotel_id)){
					echo '<div class="pull-left" style="margin-right: 20px;"><strong>'.__('in', ST_TEXTDOMAIN).'<a class="ml5" href="'.get_the_permalink($hotel_id).'" title="">'.get_the_title($hotel_id).'</a></strong></div>';
				
					$hotel_star = get_post_meta($hotel_id, 'hotel_star', true);
					if(!empty($hotel_star)){
						$hotel_star = intval($hotel_star);
						?>
						
						<div class="booking-item-rating" style="border:none">
					        <ul class="icon-group booking-item-rating-stars">
					            <?php
					            echo  TravelHelper::rate_to_string($hotel_star).' &nbsp('.$hotel_star.')';
					            ?>
					        </ul>
				    	</div>
						<?php
					}
				}
			?>
		</div>
	</div>
</div>