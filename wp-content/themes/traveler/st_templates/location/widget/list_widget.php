<?php
extract($instance);
if (!$instance['title']){
	$title  = ucfirst($instance['style']);
	$title .= " ".STLocation::get_post_type_name($instance['post_type']);
	$title .=" ".__("in",ST_TEXTDOMAIN);
	$title .=" <strong>". ucfirst(get_the_title($instance['location']))."</strong>";
}else {
	$title = $instance['title'];
}
echo "<h4> ".$title." </h4>";

	if ($style =='attraction'){
		$k = (STLocation::get_top_attractions($post_type) );
		if ($k) arsort($k);
		echo '<ul>';
		if(!empty($k) and is_array($k)){
			foreach ($k as $key=>$value){
				$page_search = st_get_page_search_result( 'st_tours' );
				if ($page_search){
					$link_arg = array('taxonomy['.$cat.']'=>$term->term_id);
					$link = add_query_arg($link_arg, get_permalink($page_search));
				}
				else {
					$link = home_url("?s&post_type=".$post_type."&id_location=".$key);
				}
				echo "<li><a class='text-darken' href='".$link."'>".get_the_title($key)."</a></li>";
			}
		}
		echo '</ul>';

	}else {
		$results = STLocation::location_widget3($instance);
		echo "<ul class='booking-list'>";
		if (!empty($results) and is_array($results)){
			foreach($results as $key=>$value){
				$link = get_permalink($value->ID);
				$post_id = $value->ID ;
				$thumbnail = get_the_post_thumbnail( $post_id, 'full', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($post_id ))));
				if (!$thumbnail){
					$thumbnail = st_get_default_image();
				}
				if(isset($instance['layout']) && !empty($instance['layout'])){
					$layout = $instance['layout'];
				}else{
					$layout = 'layout1';
				}
				?>
				<li class='widget_location '>
					<div class="bookinst_save_attributeg-item booking-item booking-item-small">
						<div class="row">
							<div class="<?php if($layout == 'layout2') echo 'col-xs-12'; else echo 'col-xs-4'; ?>">
								<a href="<?php echo esc_url($link); ?>">
									<?php echo balancetags($thumbnail); ?>
								</a>
							</div>
							<div class="<?php if($layout == 'layout2')  echo 'col-xs-12'; else echo 'col-xs-5'; ?>">
								<h5 class="booking-item-title" <?php if($layout == 'layout2') echo 'style="font-size: 20px;"'; ?>><a href="<?php echo esc_url($link ); ?>"><?php echo get_the_title($post_id)?></a> </h5>
								<ul class="icon-group booking-item-rating-stars">
									<?php
									if ($instance['post_type']!='st_cars'){
										$avg = STReview::get_avg_rate($post_id);
										echo TravelHelper::rate_to_string($avg);
									}
									?>
								</ul>
							</div>
							<div class="<?php if($layout == 'layout2')  echo 'col-xs-12'; else echo 'col-xs-3'; ?>">
								<?php switch ($instance['post_type']) {
									case 'st_cars':
										?>
										<div <?php if($layout == 'layout2') echo 'class="list-location-2"'; ?>>
	                        		<span class="booking-item-price">
					                    <?php
										$info_price = STCars::get_info_price();
										$cars_price = $info_price['price'];
										$count_sale = $info_price['discount'];
										$price_origin = $info_price['price_origin'];
										?>
										<?php if($price_origin!=$cars_price){ ?>
											<span class="text-lg lh1em sale_block onsale">
												<?php echo TravelHelper::format_money( $price_origin ) ;?>
					                        </span>
										<?php } ?>
										<?php echo TravelHelper::format_money($cars_price) ?>
					                </span>
											<span>/<?php echo strtolower(STCars::get_price_unit('label')) ?></span>
										</div>
										<?php
										break;
									case 'st_hotel':
										?>
										<div <?php if($layout == 'layout2') echo 'class="list-location-2"'; ?>>
	                        		<span class="booking-item-price-from">
			                    		<?php _e("avg",ST_TEXTDOMAIN) ?>
			                    	</span>
			                    	<span class="booking-item-price">
				                        <?php
										$min_price=STHotel::get_avg_price($post_id);
										echo TravelHelper::format_money($min_price);
										?>
			                        </span>
											<span>/<?php st_the_language('night')?></span>
										</div>
										<?php
										break;
									case 'st_tours':
										$info_price = STTour::get_info_price($post_id);
										?>
										<div <?php if($layout == 'layout2') echo 'class="list-location-2"'; ?>>
											<span class="booking-item-price-from"><?php st_the_language('tour_from') ?></span>

											<?php echo STTour::get_price_html($post_id,false,'<br>'); ?>

											<span class="info_price"></span>
										</div>
										<?php
										break;
									case 'st_rental':
										$is_sale=STRental::is_sale($post_id);
										$orgin_price=STRental::get_orgin_price($post_id);
										$price=STRental::get_price($post_id);
										$show_price = st()->get_option('show_price_free');
										?>
									<div <?php if($layout == 'layout2') echo 'class="list-location-2"'; ?>>
										<span class="booking-item-price-from"><?php _e("From",ST_TEXTDOMAIN) ?></span>
										<?php
										if($is_sale):

											echo "<span class='booking-item-old-price'>".TravelHelper::format_money($orgin_price)."</span>";
										endif;
										?>
										<?php if($show_price == 'on' || $price) : ?>
										<span class="booking-item-price m0"><?php echo TravelHelper::format_money($price) ?></span>
										<span>/<?php st_the_language('rental_night')?></span>
										</div>
									<?php endif; ?>

										<?php
										break;
									case 'st_activity':
										$info_price = STActivity::get_info_price($post_id);
										?>
										<div <?php if($layout == 'layout2') echo 'class="list-location-2"'; ?>>
											<span class="booking-item-price-from"><?php st_the_language( 'from' ) ?></span>
											<?php echo STActivity::get_price_html( $post_id, false , '<br>' , 'booking-item-price' ); ?>
										</div>
										<?php
										break;

									default:
										?>
										<span class="booking-item-price-from">
		                    		<?php _e("avg",ST_TEXTDOMAIN) ?>
		                    	</span>
										<span class="booking-item-price">
			                        <?php
									$min_price=STHotel::get_avg_price($post_id);
									echo TravelHelper::format_money($min_price);
									?>
		                        </span>
										<?php
										break;
								}?>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
		}
		echo "</ul>";
	}

?>