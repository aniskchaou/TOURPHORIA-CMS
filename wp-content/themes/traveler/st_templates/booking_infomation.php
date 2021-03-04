<?php
/**
* Created by PhpStorm.
* User: me664
* Date: 5/4/15
* Time: 4:36 PM
*
* @since 1.0.8
* @update 1.0.9
*/
$user_id = get_current_user_id();

$order_item = get_post($order_code);
wp_reset_postdata();

$payment_method = get_post_meta($order_item->ID, 'payment_method', true);

$currency = get_post_meta($order_code, 'currency', true);
?>
<div class="row">
<div class="col-md-8 col-md-offset-2 text-center">
<i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>

<h2 class="text-center">

<?php
    echo get_post_meta($order_code, 'st_first_name', true);
    echo ', ';

    if (get_post_meta($order_code, 'payment_method', true) == 'st_submit_form') {
        echo __('your order was submitted successfully!' , ST_TEXTDOMAIN ) ;
    } else
        echo __('your payment was successful!' , ST_TEXTDOMAIN ) ;
?>
</h2>
<h5 class="text-center mb30"><?php _e('Booking details has been sent to: ',ST_TEXTDOMAIN);
    echo get_post_meta($order_code, 'st_email', true) ?> </h5>

<p><strong><?php echo __('Booking Number :' , ST_TEXTDOMAIN ) ;  ?></strong> <?php echo esc_html($order_code) ?></p>

<p>
<strong><?php echo __('Booking Date :' , ST_TEXTDOMAIN ) ;  ?></strong> <?php echo get_the_time(TravelHelper::getDateFormat(), $order_code) ?>
</p>

<p><strong><?php echo __('Payment Method :' , ST_TEXTDOMAIN ) ;  ?></strong> <?php

    echo STPaymentGateways::get_gatewayname(get_post_meta($order_code, 'payment_method', true));

?></p>
<table cellpadding="0" cellspacing="0" width="100%" class="tb_list_cart">
<thead>
<tr>
    <td style="background: transparent; border-color: #e9e9e9;font-weight: bold">
        *
    </td>
    <td class=""  style="background: transparent; border-color: #e9e9e9;font-weight: bold">
        <?php echo __('Item' , ST_TEXTDOMAIN ) ;  ?>
    </td>
    <td  style="background: transparent; border-color: #e9e9e9;font-weight: bold">
        <?php echo __('Information' , ST_TEXTDOMAIN ) ;  ?>
    </td>
</tr>
</thead>
<tbody>
<?php

    $i = 0;
    $key = get_post_meta($order_code, 'item_id', true);
    $post_type = get_post_type($key);

    $value_cart_info = get_post_meta($order_code,'st_cart_info',true);
    $value = $value_cart_info[$key];
    if($key == 'car_transfer'){
        echo st()->load_template('car_transfer/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
    }else{
        switch ($post_type) {
            case "st_hotel":
                echo st()->load_template('hotel/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "hotel_room":
                echo st()->load_template('hotel-room/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "st_tours":
                echo st()->load_template('tours/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "st_cars":
                echo st()->load_template('cars/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "st_activity":
                echo st()->load_template('activity/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "st_rental":
                echo st()->load_template('rental/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                break;
            case "st_flight":
                if(function_exists('st_flight_load_view')) {
                    echo st_flight_load_view('flights/success_payment_item_row', false, array('order_id' => $order_code, 'data' => $value, 'key' => $key, 'i' => $i));
                }
                break;
        }
    }    
?>
</tbody>
<tfoot>
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
<tr>
    <!--<td colspan="2" style="border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;"></td>-->
    <td colspan="3" style="/* border-bottom: 1px solid #bcbcbc;border-right:1px solid #bcbcbc;padding: 6px;background: #e4e4e4; */">
        <table cellspacing="0px" cellpadding="0" width="100%" class="tb_cart_total">
            <?php
            if($post_type != 'st_flight'):

                if(isset($data_price['adult_price']) && isset($data_price['child_price']) && isset($data_price['infant_price'])):
            ?>
			<?php if($adult_price){?>
            <tr>
                <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Adult Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px; text-align: right; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($adult_price ,$currency); ?>
                </td>
            </tr>
			<?php }?>
			<?php if($child_price){?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Children Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($child_price ,$currency); ?>
                </td>
            </tr>
			<?php }?>
			<?php if($infant_price){?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Infant Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($infant_price ,$currency); ?>
                </td>
            </tr>
			<?php }?>
            <?php endif; ?>
            <?php
                if($key == 'car_transfer'){
                    $base_price = get_post_meta($order_code, 'base_price', true);
                    $discount_rate = get_post_meta($order_code, 'discount_rate', true);
                    ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Car price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                            <?php echo TravelHelper::format_money_from_db($base_price ,$currency); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Extra price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                            <?php echo TravelHelper::format_money_from_db($extra_price ,$currency); ?>
                        </td>
                    </tr>
                    <?php if(!empty($discount_rate)) { ?>
                        <tr>
                            <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                                <strong><?php echo __('Discount rate', ST_TEXTDOMAIN); ?></strong></td>
                            <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                                <?php echo esc_html($discount_rate . '%'); ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Subtotal' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($sale_price ,$currency); ?>
                </td>
            </tr>
            <?php if(!empty($extras['value']) and is_array($extras['value']) && count($extras['value'])): ?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Extra Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($extra_price ,$currency); ?>
                </td>
            </tr>
            <?php endif; ?>
                <!-- Hotel package -->
                <?php if(!empty($hotel_package) and is_array($hotel_package) && count($hotel_package)): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Hotel Package Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($hotel_package_price ,$currency); ?>
                    </td>
                </tr>
            <?php endif; ?>
                <?php if(!empty($activity_package) and is_array($activity_package) && count($activity_package)): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Activity Package Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($activity_package_price ,$currency); ?>
                    </td>
                </tr>
            <?php endif; ?>
                <?php if(!empty($car_package) and is_array($car_package) && count($car_package)): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Car Package Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($car_package_price ,$currency); ?>
                    </td>
                </tr>
            <?php endif; ?>
	            <?php if(!empty($flight_package) and is_array($flight_package) && count($flight_package)): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Flight Package Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
			            <?php echo TravelHelper::format_money_from_db($flight_package_price ,$currency); ?>
                    </td>
                </tr>
            <?php endif; ?>
                <!-- End Hotel package -->
            <?php if(isset($data_price['price_equipment'])): ?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Equipment Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo TravelHelper::format_money_from_db($price_equipment ,$currency); ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Tax' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                    <?php echo esc_html($tax.' %'); ?>
                </td>
            </tr>
            <?php if ($coupon_price) :?>
            <tr>
                <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                    <strong><?php echo __('Coupon' , ST_TEXTDOMAIN) ;  ?></strong></td>
                <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">-
                    <?php echo TravelHelper::format_money_from_db($coupon_price ,$currency); ?>
                </td>
            </tr>
            <?php endif; ?>
            <?php if(is_array($deposit_status) && !empty($deposit_status['type']) && floatval($deposit_status['amount']) > 0): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Deposit' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($deposit_price ,$currency); ?>
                    </td>
                </tr>
                <?php
                if(!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))){
                    ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Fee' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                            <?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Total' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($price_with_tax ,$currency); ?>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Pay Amount' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($total_price ,$currency); ?>
                    </td>
                </tr>
            <?php else: ?>
                <?php
                if(!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))){
                    ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Fee' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                            <?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Pay Amount' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php
                            $booking_fee_add_total = 0;
                            if(!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))){
                                $booking_fee_add_total = $booking_fee_price;
                            }
                            echo TravelHelper::format_money_from_db($price_with_tax + $booking_fee_add_total ,$currency);
                        ?>
                    </td>
                </tr>
            <?php endif;

            else:
                ?>
                <?php if(!empty($passenger) && intval($passenger) > 0): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Passenger' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo esc_attr($passenger); ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if($enable_tax_depart == 'yes_not_included' && intval($tax_percent_depart) > 0): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Tax Depart' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo esc_attr($tax_percent_depart).'%'; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php if($enable_tax_return == 'yes_not_included' && intval($tax_percent_return) > 0): ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Tax Return' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo esc_attr($tax_percent_return).'%'; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php
                if(!empty($booking_fee_price = get_post_meta($order_code, 'booking_fee_price', true))){
                    ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Fee' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                            <?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                        <strong><?php echo __('Pay Amount' , ST_TEXTDOMAIN) ;  ?></strong></td>
                    <td style="text-align: right; border-bottom: 1px dashed #ccc;padding:10px; font-weight: bold;">
                        <?php echo TravelHelper::format_money_from_db($price_with_tax ,$currency); ?>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </table>
    </td>
</tr>
</tfoot>
</table>
<h2 style=";
margin-top: 50px;"><?php echo __('Customer Information' , ST_TEXTDOMAIN) ;  ?></h2>
<?php
ob_start();
?>
<table cellpadding="0" cellspacing="0" width="100%" border="0px" class="mb30 tb_cart_customer">
<tbody>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('First name ' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_first_name', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Last name ' , ST_TEXTDOMAIN) ; ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_last_name', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Email ' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_email', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Phone ' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_phone', true) ?>
    </td>
</tr>

<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Address Line 1' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_address', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Address Line 2' , ST_TEXTDOMAIN ) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_address2', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('City' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_city', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('State/Province/Region' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_province', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('ZIP code/Postal code' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_zip_code', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Country' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <?php echo get_post_meta($order_code, 'st_country', true) ?>
    </td>
</tr>
<tr>
    <td width="50%" style="border-bottom: 1px dashed #ccc;padding:10px;">
        <strong><?php echo __('Special Requirements' , ST_TEXTDOMAIN) ;  ?></strong></td>
    <td align="right" class="text-right"
        style="border-bottom: 1px dashed #ccc;padding:10px;vertical-align: top">
        <?php echo get_post_meta($order_code, 'st_note', true) ?>
    </td>
</tr>
</tbody>
</table>
<?php
$customer_infomation = @ob_get_clean();
echo apply_filters( 'st_order_success_custommer_billing' , $customer_infomation, $order_code );
?>
    <div class="text-center mg20">
        <?php
	    if (is_user_logged_in()){
		    $page_user = st()->get_option('page_my_account_dashboard');
		    if ($link = get_permalink($page_user)){
			    $link = esc_url(add_query_arg(array('sc'=>'booking-history'),$link));
			    ?>
                <a href="<?php echo esc_url($link)?>" class="btn btn-primary"><i
                            class="fa fa-book"></i> <?php echo __('Booking Management' , ST_TEXTDOMAIN) ;  ?></a>
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
