<?php 
/**
*@since 1.2.5
*	Shopping Cart showing header
**/

if (empty($container)){$container = "div"; }
if (empty($class)) {$class = "nav-drop nav-symbol" ;}

$st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout',false);
if($st_is_woocommerce_checkout and function_exists('WC')):
	//$cart_url = WC()->cart->get_cart_url();
    $cart_url = wc_get_cart_url();
	$cart_total_item = (int) WC()->cart->get_cart_contents_count();
	$cart_total_amount = WC()->cart->get_cart_subtotal();
?>
<li class="<?php echo esc_attr( $class ); ?>">
	<a id="show-mini-cart-button" href="<?php echo esc_url( $cart_url ); ?>"><i class="fa fa-shopping-cart"></i><span class="badge"><?php echo esc_html($cart_total_item); ?></span></a>
	<?php if( $cart_total_item ): ?>
	<div class="traveler-cart-mini">
		<div class="traveler-cart-header">
            <?php
                global $woocommerce;
                $booking_fee_price = $woocommerce->cart->fee_total;
                if($booking_fee_price > 0){
                    $booking_with_fee = $woocommerce->cart->subtotal + $booking_fee_price;
                    echo TravelHelper::format_money($booking_with_fee);
                }else{
                    echo esc_html($cart_total_amount);
                }
            ?>
		</div>
		<div class="traveler-cart-content">
            <?php
                if($booking_fee_price > 0) {
                    ?>
                    <div class="col-lg-12 traveler-cart-booking-fee">
                        <b><?php echo __('Booking fee: ', ST_TEXTDOMAIN); ?></b>
                        <b><span><?php echo TravelHelper::format_money($booking_fee_price); ?></span></b>
                    </div>
                    <?php
                }
                $items = WC()->cart->get_cart();
		        foreach($items as $item => $values):
		        	$_product = wc_get_product( $values['data']->get_id());
		        	$post_id = (int) get_post_meta($_product->get_id(), '_st_booking_id', true );

		        	$post_title = $_product->get_title();
		        	if( get_post_type( $post_id ) == 'st_hotel' ){
		        		$room_id = (int) get_post_meta( $_product->get_id(), 'room_id', true );
		        		$post_title = get_the_title( $room_id );
		        	}
		        	$quantity = (int) $values['quantity'];
		        	$price = (float) $values['line_total'];
		        	$tax = (float) $values['line_tax'];
		        	$price = $price + $tax;
		    ?>
				<div class="traveler-cart-item">
					<div class="row">
						<div class="col-xs-4">
							<?php
								if( has_post_thumbnail( $post_id ) ){
									echo get_the_post_thumbnail( $post_id, 'thumbnail', array('class' => 'img-responsive', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($post_id ))) );
								}
							?>
						</div>
						<div class="col-xs-8">
							<?php 
								if( get_post_type( $post_id ) == 'st_hotel '):
									$room_id = (int) get_post_meta( $_product->ID, 'room_id', true );
							?>
								<h4 class="traveler-cart-title"><a href="<?php echo get_the_permalink( $room_id ) ?>"><?php echo esc_html($post_title); ?></a></h4>
							<?php else: ?>	
								<h4 class="traveler-cart-title"><a href="<?php echo get_the_permalink( $post_id ) ?>"><?php echo esc_html($post_title); ?></a></h4>
							<?php endif; ?>
							<h4 class="traveler-cart-price">
								<?php echo __('Price', ST_TEXTDOMAIN ); ?>: <span><?php echo TravelHelper::format_money( $price ); ?></span>
							</h4>
						</div>
					</div>
				</div>
			<?php
		        endforeach;
			?>
		</div>
		<div class="traveler-cart-footer clearfix">
			<a href="<?php echo esc_url( $cart_url ); ?>" class="text-center pull-left"><?php echo __('Checkout', ST_TEXTDOMAIN ); ?></a>
			<a href="<?php echo add_query_arg(array('action' => 'st-remove-cart', 'security' => wp_create_nonce( 'st-security' ))); ?>" class="minicart-remove pull-right"><?php echo __('Remove Cart', ST_TEXTDOMAIN); ?></a>
		</div>
	</div>
	<?php endif; ?>
</li>
<?php else: 
	$check_out_url = (int) st()->get_option('page_checkout','');
	$check_out_url = get_permalink( $check_out_url );
	$cart_total_item = (int) STCart::count();
	$cart_total_amount = (float) (STCart::check_cart()) ? STPrice::getTotal() : 0;

	$post_id_global = 0;
?>
<li class="<?php echo esc_attr( $class ); ?>">
	<a id="show-mini-cart-button" href="<?php echo esc_url( $check_out_url ); ?>"><i class="fa fa-shopping-cart"></i><span class="badge"><?php echo esc_html($cart_total_item); ?></span></a>
	<?php if( $cart_total_item ): ?>
	<div class="traveler-cart-mini">
		<div class="traveler-cart-header">
			<?php echo TravelHelper::format_money( $cart_total_amount ); ?>
		</div>
		<div class="traveler-cart-content">
			<?php
				if( STCart::check_cart() ):
					$items = STCart::get_carts();
					
					foreach( $items as $post_id => $value ):
						$post_id_global = $post_id;
						$post_title = get_the_title( $post_id );
						if( get_post_type( $post_id ) == 'st_hotel'){
							$room_id = (int) $value['data']['room_id'];
							$post_title = get_the_title( $room_id );
						}
									
		        		$quantity = (int) count($items);
		        		$price = (float) STPrice::getTotal();
			?>
			<div class="traveler-cart-item">
					<div class="row">
						<div class="col-xs-4">
							<?php
								if( has_post_thumbnail( $post_id ) ){
									echo get_the_post_thumbnail( $post_id, 'thumbnail', array('class' => 'img-responsive', 'alt' => TravelHelper::get_alt_image()) );
								}
							?>
						</div>
						<div class="col-xs-8">
							<?php 
								if( get_post_type( $post_id ) == 'st_hotel'):
									$room_id = (int) $value['data']['room_id'];
							?>
								<h4 class="traveler-cart-title"><a href="<?php echo get_the_permalink( $room_id ) ?>"><?php echo esc_html($post_title); ?></a></h4>
							<?php else: ?>	
								<h4 class="traveler-cart-title"><a href="<?php echo get_the_permalink( $post_id ) ?>"><?php echo esc_html($post_title); ?></a></h4>
							<?php endif; ?>
							<h4 class="traveler-cart-price">
								<?php echo __('Price', ST_TEXTDOMAIN ); ?>: <span><?php echo TravelHelper::format_money( $price ); ?></span>
							</h4>
						</div>
					</div>
				</div>
			<?php endforeach; endif; ?>
		</div>
		<div class="traveler-cart-footer clearfix">
		<?php 
			$class = '';
			$attr = '';
			$prefix = 'hotel';
			$post_type = get_post_type( $post_id_global );
			switch ( $post_type) {
				case 'st_hotel':
					$prefix = 'hotel';
					break;
				case 'st_rental':
					$prefix = 'rental';
					break;
				case 'st_cars':
					$prefix = 'car';
				break;
				case 'st_tours':
					$prefix = 'tour';
				break;
				case 'st_activity':
					$prefix = 'activity';
				break;
				default:
					$prefix = 'hotel';
					break;
			}
			 if(st()->get_option('booking_modal','off')=='on'){
			 	$class = ' btn-st-show-cart-modal ';
			 	$attr = ' data-effect="mfp-zoom-out" onclick="return false" data-target="#'. $prefix .'_booking_'. $post_id_global .'" ';
			 }
		?>
			<a href="<?php echo esc_url( $check_out_url ); ?>" class="text-center <?php echo esc_attr($class); ?> pull-left" <?php echo esc_attr($attr); ?>><?php echo __('Checkout', ST_TEXTDOMAIN ); ?></a>
			<a href="<?php echo add_query_arg(array('action' => 'st-remove-cart', 'security' => wp_create_nonce( 'st-security' ))); ?>" class="minicart-remove pull-right"><?php echo __('Remove Cart', ST_TEXTDOMAIN); ?></a>
		</div>
	</div>
	<?php endif; ?>
</li>
<?php endif; ?>
