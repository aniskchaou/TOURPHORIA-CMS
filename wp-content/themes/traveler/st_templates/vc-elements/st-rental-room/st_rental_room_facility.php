<div class="hotel-room-content">
    <?php
    while(have_posts())
    {
        the_post();
        the_content();
    }
    wp_reset_query();
    wp_reset_postdata();
    ?>
</div>
<div class="room-facility">
	<h3 class="booking-item-title"><?php echo __('About This Listing', ST_TEXTDOMAIN); ?></h3>
	<?php 
		$adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
		$children_number = intval(get_post_meta(get_the_ID(), 'child_number', true));
		$bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
		$room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));

	?>
	<div id="list-facility" class="row">
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('The Space', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Adult number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($adult_number); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Bed number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($bed_number); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Children number', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($children_number); ?></strong></span>
						</div>
						<div class="col-xs-12 col-sm-6 sub-item">
							<span><?php echo __('Room Footage', ST_TEXTDOMAIN) ?>: <strong><?php echo esc_html($room_footage); ?></strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			extract($args);
			$choose_taxonomies = explode(',', $choose_taxonomies);
			if(is_array($choose_taxonomies) && count($choose_taxonomies)):
				foreach($choose_taxonomies as $terms):
					$tax = get_taxonomy($terms);
					$term = get_the_terms(get_the_ID(), $terms);
					if(is_array($term) && count($term)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo esc_html($tax->labels->name); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<?php 
							$term = get_the_terms(get_the_ID(), $terms);
							if($term):
								foreach($term as $key => $val):
						?>
						<div class="col-xs-12 col-sm-6 sub-item">
							
							<span>
								<?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($val->term_id, 'st_icon')): ?>
                                <i class="<?php echo TravelHelper::handle_icon($icon) ?> mr5"></i>
                            	<?php endif; ?>

                                <?php echo esc_html( $val->name) ?>
                        	</span>
						</div>

						<?php endforeach; endif;?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; endforeach; endif; ?>
		<?php 
			$other_facility = get_post_meta(get_the_ID(),'add_new_facility', true);
			if(is_array($other_facility) && count($other_facility)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Other', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<?php 
							$other_facility = get_post_meta(get_the_ID(),'add_new_facility', true);
							foreach($other_facility as $item):
						?>
						<div class="col-xs-12 col-sm-6 sub-item">
							
							<span><?php if(!empty($item['facility_icon'])): ?><i class="<?php echo TravelHelper::handle_icon($item['facility_icon']); ?> mr5"></i><?php endif; ?><?php echo esc_html($item['title']); ?>: <strong><?php echo esc_html($item['value']); ?></strong></span>
						</div>

						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<?php  endif; ?>
		<?php 
			$room_description = get_post_meta(get_the_ID(),'room_description', true);
			if(!empty($room_description)):
		?>
		<div class="col-xs-12 item">
			<div class="row">
				<div class="col-xs-5 col-sm-3">
					<strong><?php echo __('Description', ST_TEXTDOMAIN); ?></strong>
				</div>
				<div class="col-xs-7 col-sm-9">
					<div class="row">
						<div class="col-xs-12 sub-item">
							<div class="text-justify">
								<div id="show-description">
									<?php echo TravelHelper::substr($room_description, 100); ?>
								</div>
								<a class="button-readmore text-color" href="javascript:;"><?php echo __('Read more',ST_TEXTDOMAIN); ?></a>
								<div id="read-more" class="hidden">
									<?php echo balanceTags($room_description); ?>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php  endif; ?>
	</div>
</div>