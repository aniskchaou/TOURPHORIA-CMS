<div class="room-facility">
	<h3 class="booking-item-title"><?php echo esc_attr($args['title']); ?></h3>
<?php 
	$adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
	$children_number = intval(get_post_meta(get_the_ID(), 'children_number', true));
	$bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
	$room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));
?>
	<div class="row list-facility list-facility-space">
		<div class="col-xs-12"> 
			<div class="col-xs-12 col-sm-12">
				<div class="row">
					<div class="col-xs-12 col-sm-6 sub-item">
							<i rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Adults Occupancy', ST_TEXTDOMAIN); ?>" class="fa fa-male mr10"></i>
							<strong><?php echo esc_html($adult_number); ?></strong>
							<?php echo ($adult_number>1) ?  __("adults" , ST_TEXTDOMAIN) :  __("adult" , ST_TEXTDOMAIN); ?>
					</div>
					<div class="col-xs-12 col-sm-6 sub-item">
                        <i rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Beds', ST_TEXTDOMAIN); ?>" class="im im-bed mr10"></i>
                        <strong><?php echo esc_html($bed_number); ?></strong>
							<?php echo ($bed_number>1) ?  __("beds" , ST_TEXTDOMAIN) : __("bed" , ST_TEXTDOMAIN) ;   ?>
					</div>
				</div><div class='row'>
					<div class="col-xs-12 col-sm-6 sub-item">
                        <i rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Children', ST_TEXTDOMAIN); ?>" class="im im-children mr10"></i>
							<strong><?php echo esc_html($children_number); ?></strong>
							<?php echo ($children_number>1) ?  __("children" , ST_TEXTDOMAIN)  : __("child" , ST_TEXTDOMAIN) ; ?>
					</span>
					</div>
					<div class="col-xs-12 col-sm-6 sub-item">
							<i rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Room footage (square feet)', ST_TEXTDOMAIN); ?>" class="im im-width mr10"></i>
							<strong><?php echo esc_html($room_footage); ?></strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 