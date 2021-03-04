<?php wp_enqueue_script( 'owl-carousel.js' ); ?>
<div class="content-section">
	<h4 class="heading"><?php echo esc_html($st_title); ?></h4>
	<div class="line-heading bgr-main"></div>
	<div class="st-slider-list-room-wrapper">
	<div class="st-slider-list-room owl-carousel">
	<?php 
		$query = array(
			'post_type' => 'hotel_room',
			'posts_per_page' => intval($st_number_item),
			'orderby' => $st_order_by,
			'order' => $st_order,
			'meta_key' => 'room_parent',
			'meta_value' => get_the_ID()
		);
		query_posts($query);
		while(have_posts()) : the_post();
		?>
		<div class="item">
		<?php 
			$thumbnail = get_post_thumbnail_id();
			$img = wp_get_attachment_url($thumbnail);
			if(empty($img)){
			    $img = ST_TRAVELER_URI.'/img/no-image.png';
			}
		?>
			<div class="thumb">
				<img src="<?php echo esc_url($img); ?>" alt="<?php echo TravelHelper::get_alt_image($thumbnail); ?>" class="img-responsive">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8 mt10">
					<h4 class="title"><a href="<?php echo get_the_permalink(); ?>" target="_blank"><?php echo get_the_title(); ?></a></h4>
				</div>
				<div class="col-xs-12 col-sm-4 mt10">
				<?php 
					$check_in = date('m/d/Y', strtotime("now"));
					$check_out = date('m/d/Y', strtotime("+1 day"));
					$total_price = STPrice::getRoomPriceOnlyCustomPrice(get_the_ID(), strtotime($check_in), strtotime($check_out), 1);
				?>
					<div class="pull-right">
			            <span class="text-lg text-color price"><?php echo TravelHelper::format_money($total_price) ?></span>
			        </div>
				</div>
			</div>
		</div>
		<?php
		endwhile;
	?>
	</div>
	<a href="#" class="control control-left"><i class="fa fa-chevron-left"></i></a>
	<a href="#" class="control control-right"><i class="fa fa-chevron-right"></i></a>
	</div>
</div>	