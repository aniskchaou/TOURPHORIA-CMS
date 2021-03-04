<div class="booking-item-details no-border-top">
	<div class="row">
		<div class="col-xs-12 col-md-3 avatar">
			<?php 
				$rental_id = get_post_meta(get_the_ID(), 'room_parent', true);
			?>
			<?php if(!empty($rental_id)): 
				$image = wp_get_attachment_image_src(get_post_thumbnail_id( $rental_id), array(165,82));
				if($image):
			?>
				<img src="<?php echo esc_url($image[0]); ?>" alt="avatar">
				<?php endif; ?>
			<?php else: ?>
				<?php 
				$user = get_userdata( get_the_author_meta('ID') );
				echo get_avatar( get_the_author_meta( 'ID' ), 100, null, TravelHelper::get_alt_image() ); 
				?>
				<?php if(!empty($user->display_name)): ?>
					<h5 class="text-center">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo esc_html($user->display_name); ?></a>
					</h5>
				<?php endif; ?>
			<?php endif; ?>	
		</div>
		<div class="col-xs-12 col-md-9">
			<h2 class="title"><?php the_title(); ?></h2>
			<?php 
				if(!empty($rental_id)){
					?>
					<div class="booking-item-rating" style="border:none">
				        <ul class="icon-group booking-item-rating-stars">
				            <?php
				            echo '<div class="pull-left" style="margin-right: 20px;"><strong>'.'<a href="'.get_the_permalink($rental_id).'" title="">'.get_the_title($rental_id).'</a></strong></div>';
				            echo  TravelHelper::rate_to_string(STReview::get_avg_rate());
				            ?>
				        </ul>
			    	</div>
					<?php
				}
			?>
			<?php 
				$adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
				$children_number = intval(get_post_meta(get_the_ID(), 'children_number', true));
				$bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
				$room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));
			?>
			<div class="row">
				<div class="col-xs-6 col-sm-3">
					<div class="facility-item" rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Adults Occupancy', ST_TEXTDOMAIN); ?>">
						<i class="fa fa-male"></i>
						<h5 class="booking-item-feature-sign"><?php echo esc_html($adult_number); ?> <?php echo ($adult_number >= 2)? __('adults', ST_TEXTDOMAIN) : __('adult', ST_TEXTDOMAIN); ?></h5>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="facility-item" rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Children', ST_TEXTDOMAIN); ?>">
						<i class="im im-children"></i>
						<h5 class="booking-item-feature-sign"><?php echo esc_html($children_number); ?> <?php echo ($children_number >= 2)? __('children', ST_TEXTDOMAIN) : __('children', ST_TEXTDOMAIN); ?></h5>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="facility-item" rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Beds', ST_TEXTDOMAIN); ?>">
						<i class="im im-bed"></i>
						<h5 class="booking-item-feature-sign"><?php echo esc_html($bed_number); ?> <?php echo ($bed_number >= 2)? __('beds', ST_TEXTDOMAIN) : __('bed', ST_TEXTDOMAIN); ?></h5>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="facility-item" rel="tooltip" data-placement="top" title="" data-original-title="<?php echo __('Room footage (square feet)', ST_TEXTDOMAIN); ?>">
						<i class="im im-width"></i>
						<h5 class="booking-item-feature-sign"><?php echo esc_html($room_footage); ?> <?php echo esc_html('m', ST_TEXTDOMAIN); ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>