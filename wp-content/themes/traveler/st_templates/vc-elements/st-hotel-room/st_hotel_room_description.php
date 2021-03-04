<div class="room-facility">
	<h3 class="booking-item-title"><?php echo esc_attr($args['title']); ?></h3>
	<?php 
		//$room_description = get_post_meta(get_the_ID(),'room_description', true);
		$room_description = get_the_excerpt();
		if(!empty($room_description)):			
	?>
	<div class='row'>
		<div class="col-xs-12 sub-item">
			<div class="text-justify">
				<div id="show-description">
					<?php echo TravelHelper::substr($room_description, 500); ?>
				</div>
				<?php if( strlen( $room_description ) > 500 ): ?>
				<a class="button-readmore text-color" href="javascript:;"><?php echo __('Read more', ST_TEXTDOMAIN); ?></a>
			<?php endif; ?>
				<div id="read-more" class="hidden">
					<?php echo esc_html($room_description); ?>
				</div>
			</div>
		</div>
	</div>
	<?php  endif; ?>
</div>