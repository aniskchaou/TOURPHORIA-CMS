<?php wp_enqueue_script( 'owl-carousel.js' ); ?>
<div class="st-slider-list-hotel owl-carousel" data-effect="<?php echo esc_attr($st_effect); ?>">
<?php 
	if(!empty($st_hotel_id)):
		$st_hotel_id = explode(',', $st_hotel_id);
		foreach($st_hotel_id as $hotel_id):
			$thumbnail = get_post_thumbnail_id($hotel_id);
			$img = wp_get_attachment_url($thumbnail);
			if(empty($img)){
			    $img = ST_TRAVELER_URI.'/img/no-image.png';
			}
?>
	<div class="item" style="background: url('<?php echo esc_url($img); ?>') no-repeat center center">
	</div>
<?php endforeach; endif; ?>
</div>