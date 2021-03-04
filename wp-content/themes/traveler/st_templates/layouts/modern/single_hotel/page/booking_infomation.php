<?php
	$user_id = get_current_user_id();
	$order_item = get_post($order_code);
	wp_reset_postdata();
	$payment_method = get_post_meta($order_item->ID, 'payment_method', true);
	$currency = get_post_meta($order_code, 'currency', true);
?>
<div class="row booking-success-notice">
	<div class="col-lg-8 col-md-8 col-left">
		<img src="<?php echo get_template_directory_uri(); ?>/v2/images/ico_success.svg" alt="Payment Success"/>
		<div class="notice-success">
			<p class="line1"><span><?php echo get_post_meta($order_code, 'st_first_name', true); ?>,</span>
				<?php
				if (get_post_meta($order_code, 'payment_method', true) == 'st_submit_form') {
					echo __('your order was submitted successfully!' , ST_TEXTDOMAIN ) ;
				} else
					echo __('your payment was successful!' , ST_TEXTDOMAIN ) ;
				?>
			</p>
			<p class="line2"><?php _e('Booking details has been sent to: ',ST_TEXTDOMAIN); ?><span><?php echo get_post_meta($order_code, 'st_email', true) ?></span></p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4">
		<ul class="booking-info-detail">
			<li><span><?php echo __('Booking Number:', ST_TEXTDOMAIN); ?></span> <?php echo esc_html($order_code) ?></li>
			<li><span><?php echo __('Booking Date:', ST_TEXTDOMAIN); ?></span> <?php echo get_the_time(TravelHelper::getDateFormat(), $order_code) ?></li>
			<li><span><?php echo __('Payment Method:', ST_TEXTDOMAIN); ?></span> <?php echo STPaymentGateways::get_gatewayname(get_post_meta($order_code, 'payment_method', true)); ?></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-4">
		<h3 class="title">
			<?php echo __('Your Item', ST_TEXTDOMAIN); ?>
		</h3>
		<div class="cart-info">
            <?php
            $i = 0;
            $key = get_post_meta($order_code, 'item_id', true);

            $value_cart_info = get_post_meta($order_code,'st_cart_info',true);
            $value = $value_cart_info[$key];
            $post_type = get_post_type($key);

            echo st()->load_template('layouts/modern/single_hotel/page/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
            ?>
			<div class="total-section">
                <?php
                $data_price = get_post_meta($order_code, 'data_prices', true);
                if(!$data_price) $data_price = array();
                $adult_price = isset($data_price['adult_price']) ? $data_price['adult_price'] : 0;
                $child_price = isset($data_price['child_price']) ? $data_price['child_price'] : 0;
                $infant_price = isset($data_price['infant_price']) ? $data_price['infant_price'] : 0;
                $origin_price = isset($data_price['origin_price']) ? $data_price['origin_price'] : 0;
                $sale_price = isset($data_price['sale_price']) ? $data_price['sale_price'] : 0;

                $coupon_price = isset($data_price['coupon_price']) ? $data_price['coupon_price'] : 0;
                $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;

                $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0 ;
                $deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
                $tax = intval(get_post_meta($order_code, 'st_tax_percent', true));
                $deposit_status = get_post_meta($order_code, 'deposit_money', true);
                $price_equipment = isset($data_price['price_equipment']) ? $data_price['price_equipment'] : 0;
                $extras = get_post_meta($order_code, 'extras', true);
                $extra_price = floatval(get_post_meta($order_code, 'extra_price', true));
                //Tour package
                $hotel_package = get_post_meta($order_code, 'package_hotel', true);
                $hotel_package_price = get_post_meta($order_code, 'package_hotel_price', true);
                $activity_package = get_post_meta($order_code, 'package_activity', true);
                $activity_package_price = get_post_meta($order_code, 'package_activity_price', true);
                $car_package = get_post_meta($order_code, 'package_car', true);
                $car_package_price = get_post_meta($order_code, 'package_car_price', true);
                $flight_package = get_post_meta($order_code, 'package_flight', true);
                $flight_package_price = get_post_meta($order_code, 'package_flight_price', true);
                //End package
                $passenger = get_post_meta($order_code, 'passenger', true);

                $enable_tax_depart = get_post_meta($order_code, 'enable_tax_depart', true);
                $tax_percent_depart = get_post_meta($order_code, 'tax_percent_depart', true);

                $enable_tax_return = get_post_meta($order_code, 'enable_tax_return', true);

                $tax_percent_return = get_post_meta($order_code, 'tax_percent_return', true);
                ?>
				<ul>
                    <?php
                    if ($post_type != 'st_flight') {
                        if (isset($data_price['adult_price']) && isset($data_price['child_price']) && isset($data_price['infant_price'])) {
                            ?>
                            <?php if ($adult_price) { ?>
                                <li><span class="label"><?php echo __('Adult Price', ST_TEXTDOMAIN); ?></span><span
                                            class="value"><?php echo TravelHelper::format_money_from_db($adult_price, $currency); ?></span>
                                </li>
                            <?php } ?>

                            <?php if ($child_price) { ?>
                                <li><span class="label"><?php echo __('Children Price', ST_TEXTDOMAIN); ?></span><span
                                            class="value"><?php echo TravelHelper::format_money_from_db($child_price, $currency); ?></span>
                                </li>
                            <?php } ?>

                            <?php if ($infant_price) { ?>
                                <li><span class="label"><?php echo __('Infant Price', ST_TEXTDOMAIN); ?></span><span
                                            class="value"><?php echo TravelHelper::format_money_from_db($infant_price, $currency); ?></span>
                                </li>
                            <?php } ?>
                            <?php
                        }
                        ?>
                        <?php
                        if ($key == 'car_transfer') {
                            $base_price = get_post_meta($order_code, 'base_price', true);
                            $discount_rate = get_post_meta($order_code, 'discount_rate', true);
                            ?>
                            <li>
                                <span class="label"><?php echo __('Car price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($base_price, $currency); ?></span>
                            </li>
                            <li>
                                <span class="label"><?php echo __('Extra price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($extra_price, $currency); ?></span>
                            </li>
                            <?php if (!empty($discount_rate)) { ?>
                                <li>
                                    <span class="label"><?php echo __('Discount rate', ST_TEXTDOMAIN); ?></span>
                                    <span class="value"><?php echo $discount_rate . '%'; ?></span>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <li>
                            <span class="label"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></span>
                            <span class="value"><?php echo TravelHelper::format_money_from_db($sale_price, $currency); ?></span>
                        </li>
                        <?php if (!empty($extras['value']) and is_array($extras['value']) && count($extras['value'])) { ?>
                            <li>
                                <span class="label"><?php echo __('Extra Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($extra_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <!-- Hotel package -->
                        <?php if (!empty($hotel_package) and is_array($hotel_package) && count($hotel_package)) { ?>
                            <li>
                                <span class="label"><?php echo __('Hotel Package Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($hotel_package_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <?php if (!empty($activity_package) and is_array($activity_package) && count($activity_package)) { ?>
                            <li>
                                <span class="label"><?php echo __('Activity Package Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($activity_package_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <?php if (!empty($car_package) and is_array($car_package) && count($car_package)) { ?>
                            <li>
                                <span class="label"><?php echo __('Car Package Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($car_package_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <?php if (!empty($flight_package) and is_array($flight_package) && count($flight_package)) { ?>
                            <li>
                                <span class="label"><?php echo __('Flight Package Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($flight_package_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <?php if (isset($data_price['price_equipment'])) { ?>
                            <li>
                                <span class="label"><?php echo __('Equipment Price', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($price_equipment, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <li>
                            <span class="label"><?php echo __('Tax', ST_TEXTDOMAIN); ?></span>
                            <span class="value"><?php echo $tax . ' %'; ?></span>
                        </li>
                        <?php if ($coupon_price) { ?>
                            <li>
                                <span class="label"><?php echo __('Coupon', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($coupon_price, $currency); ?></span>
                            </li>
                        <?php } ?>


                        <?php if (is_array($deposit_status) && !empty($deposit_status['type']) && floatval($deposit_status['amount']) > 0) { ?>
                            <li>
                                <span class="label"><?php echo __('Deposit', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($deposit_price, $currency); ?></span>
                            </li>
                            <?php
                            if (!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))) {
                                ?>
                                <li>
                                    <span class="label"><?php echo __('Fee', ST_TEXTDOMAIN); ?></span>
                                    <span class="value"><?php echo TravelHelper::format_money_from_db($booking_fee_price, $currency); ?></span>
                                </li>
                            <?php } ?>
                            <li>
                                <span class="label"><?php echo __('Total', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($price_with_tax, $currency); ?></span>
                            </li>
                            <li>
                                <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($total_price, $currency); ?></span>
                            </li>
                        <?php } else { ?>
                            <?php
                            if (!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))) {
                                ?>
                                <li>
                                    <span class="label"><?php echo __('Fee', ST_TEXTDOMAIN); ?></span>
                                    <span class="value"><?php echo TravelHelper::format_money_from_db($booking_fee_price, $currency); ?></span>
                                </li>
                            <?php } ?>
                            <li class="payment-amount">
                                <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                                <span class="value">
                                    <?php
                                    $booking_fee_add_total = 0;
                                    if (!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))) {
                                        $booking_fee_add_total = $booking_fee_price;
                                    }
                                    echo TravelHelper::format_money_from_db($price_with_tax + $booking_fee_add_total, $currency);
                                    ?>
                                </span>
                            </li>
                        <?php
                        }
                    } else {
                        if (!empty($passenger) && intval($passenger) > 0) { ?>
                            <li>
                                <span class="label"><?php echo __('Passenger', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo esc_attr($passenger); ?></span>
                            </li>
                        <?php } ?>
                        <?php if ($enable_tax_depart == 'yes_not_included' && intval($tax_percent_depart) > 0) { ?>
                            <li>
                                <span class="label"><?php echo __('Tax Depart', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo esc_attr($tax_percent_depart) . '%'; ?></span>
                            </li>
                        <?php } ?>
                        <?php if ($enable_tax_return == 'yes_not_included' && intval($tax_percent_return) > 0) { ?>
                            <li>
                                <span class="label"><?php echo __('Tax Return', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo esc_attr($tax_percent_return) . '%'; ?></span>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))) {
                            ?>
                            <li>
                                <span class="label"><?php echo __('Fee', ST_TEXTDOMAIN); ?></span>
                                <span class="value"><?php echo TravelHelper::format_money_from_db($booking_fee_price, $currency); ?></span>
                            </li>
                        <?php } ?>
                        <li class="payment-amount">
                            <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                            <span class="value"><?php echo TravelHelper::format_money_from_db($price_with_tax, $currency); ?></span>
                        </li>
                        <?php
                    }
                    ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-8">
		<h3 class="title">
			<?php echo __('Your Information', ST_TEXTDOMAIN); ?>
		</h3>
        <?php
        ob_start();
        ?>
		<div class="info-form">
			<ul>
				<li><span class="label"><?php echo __('First Name', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_first_name', true) ?></span></li>
				<li><span class="label"><?php echo __('Last name', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_last_name', true) ?></span></li>
				<li><span class="label"><?php echo __('Email', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_email', true) ?></span></li>
				<li><span class="label"><?php echo __('Address Line 1', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_address', true) ?></span></li>
				<li><span class="label"><?php echo __('Address Line 2', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_address2', true) ?></span></li>
				<li><span class="label"><?php echo __('City', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_city', true) ?></span></li>
				<li><span class="label"><?php echo __('State/Province/Region', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_province', true) ?></span></li>
				<li><span class="label"><?php echo __('ZIP code/Postal code', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_zip_code', true) ?></span></li>
				<li><span class="label"><?php echo __('Country', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_country', true) ?></span></li>
				<li><span class="label"><?php echo __('Special Requirements', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_post_meta($order_code, 'st_note', true) ?></span></li>
			</ul>
		</div>
        <?php
        $customer_infomation = @ob_get_clean();
        echo apply_filters( 'st_order_success_custommer_billing' , $customer_infomation, $order_code );
        ?>
        <div class="text-center mg20 mt30">
            <?php
            if (is_user_logged_in()){
                $page_user = st()->get_option('page_my_account_dashboard');
                if ($link = get_permalink($page_user)){
                    $link = esc_url(add_query_arg(array('sc'=>'booking-history'),$link));
                    ?>
                    <a href="<?php echo esc_url($link)?>" class="btn btn-primary sts-btn sts-btn-booking-manage"><span><i
                                    class="fa fa-book"></i> <?php echo __('Booking Management' , ST_TEXTDOMAIN) ;  ?></span></a>
                    <?php
                }
            }
            ?>
            <?php
            $option_allow_guest_booking = st()->get_option('is_guest_booking');
            if($option_allow_guest_booking == 'on'){
                do_action('st_after_order_success_page_information_table',$order_code);
            }else{
                if (is_user_logged_in()){
                    do_action('st_after_order_success_page_information_table',$order_code);
                }
            }
            ?>

        </div>
	</div>
</div>