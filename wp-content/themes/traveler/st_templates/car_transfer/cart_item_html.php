<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel cart item html
 *
 * Created by ShineTheme
 *
 */
if(isset($item_id) and $item_id):

    $item = STCart::find_item($item_id);
    $check_in = $item['data']['check_in'];
    $check_in_time = $item['data']['check_in_time'];
    $check_out = $item['data']['check_out'];
    $check_out_time = $item['data']['check_out_time'];
    $roundtrip = $item['data']['roundtrip'];
    $extras = $item['data']['extras'];
    $extra_price = $item['data']['extra_price'];

    $date_diff = STDate::dateDiff($check_in,$check_out);

    $passenger = intval($item['data']['passenger']);
    ?>
    <div style="display: none;" class="overlay-form"><i class="fa fa-refresh text-color"></i></div>

    <header class="clearfix">
        <h5 class="booking-item-payment-title"><?php echo __('Car Transfer', ST_TEXTDOMAIN) ?></h5>
    </header>

    <ul class="booking-item-payment-details">
        <li>
            <p class="booking-item-payment-item-title"><?php echo esc_html( $item['data']['pick_up'] ) . ' - ' . esc_html($item['data']['drop_off']); ?></p>
            <ul class="booking-item-payment-price">
                <li>
                    <p class="booking-item-payment-price-title">
                        <?php echo __('Arrival Date', ST_TEXTDOMAIN); ?>
                    </p>
                    <p class="booking-item-payment-price-amount">
                        <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?>
                        <?php echo date_i18n(' H:i:s', strtotime($check_in_time)); ?>
                    </p>
                </li>
	            <?php if(!empty($check_out_time) and (!empty($roundtrip)) ): ?>
                    <li>
                        <p class="booking-item-payment-price-title">
				            <?php echo __('Departure Date', ST_TEXTDOMAIN); ?>
                        </p>
                        <p class="booking-item-payment-price-amount">
	                        <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)); ?>
	                        <?php echo date_i18n(' H:i:s', strtotime($check_out_time)); ?>
                        </p>
                    </li>
	            <?php endif; ?>
                <?php if($passenger) {?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Passengers',ST_TEXTDOMAIN) ?> </p>


                        <p class="booking-item-payment-price-amount"><?php echo esc_html($passenger); ?>
                        </p>

                    </li>
                <?php }?>
                <?php 
                    $time = $item['data']['distance'];
                    if(!empty($time)):
                ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Estimated distance',ST_TEXTDOMAIN) ?> </p>
                        <p class="booking-item-payment-price-amount">
                            <?php
                                $hour = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', ST_TEXTDOMAIN ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', ST_TEXTDOMAIN );
                                $minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', ST_TEXTDOMAIN ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', ST_TEXTDOMAIN );
                                echo esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . $time['distance'] . __('Km', ST_TEXTDOMAIN);
                            ?>
                        </p>
                    </li>
                <?php endif; ?>
                <?php
                if(!empty($extras) and is_array($extras)){
                    ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Extras',ST_TEXTDOMAIN) ?> </p>
                        <p class="booking-item-payment-price-amount">
                            <?php
                                foreach ($extras as $k => $v){
                                    echo esc_html($v['title']) . ' ('. TravelHelper::format_money($v['price']) .') x ' . $v['number'] . ' ' . ($v['number'] > 1 ? __('items', ST_TEXTDOMAIN) : __('item', ST_TEXTDOMAIN)) . '<br />';
                                }
                            ?>
                        </p>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
    </ul>
    <?php
endif;
?>
<div class="booking-item-coupon p10">
    <form method="post" action="<?php the_permalink() ?>">
        <?php if (isset(STCart::$coupon_error['status'])): ?>
            <div
                class="alert alert-<?php echo STCart::$coupon_error['status'] ? 'success' : 'danger'; ?>">
                <p>
                    <?php echo STCart::$coupon_error['message'] ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="form-group">

            <label for="field-coupon_code"><?php _e('Coupon Code', ST_TEXTDOMAIN) ?></label>
            <?php $code = STInput::post('coupon_code') ? STInput::post('coupon_code') : STCart::get_coupon_code();?>
            <input id="field-coupon_code" value="<?php echo esc_attr($code ); ?>" type="text"
                   class="form-control" name="coupon_code">
        </div>

        <input type="hidden" name="st_action" value="apply_coupon">
        <?php if(st()->get_option('use_woocommerce_for_booking','off') == 'off' && st()->get_option('booking_modal','off') == 'on' ){ ?>
            <input type="hidden" name="action" value="ajax_apply_coupon">
            <button class="btn btn-primary add-coupon-ajax"><?php _e('Apply Coupon', ST_TEXTDOMAIN) ?></button>
            <div class="alert alert-danger hidden">
            </div>
        <?php }else{ ?>
            <button class="btn btn-primary" type="submit"><?php _e('Apply Coupon', ST_TEXTDOMAIN) ?></button>
        <?php } ?>
    </form>
</div>
<div class="booking-item-payment-total text-right">
    <?php
    $base_price = $item['data']['base_price'];
    $sale_price = $item['data']['sale_price'];
    $discount = $item['data']['discount_rate'];

    $price_coupon = floatval(STCart::get_coupon_amount());

    $price_with_tax = STPrice::getPriceWithTax($sale_price);
    $price_with_tax -= $price_coupon;


    ?>
    <table border="0" class="table_checkout">
        <tr>
            <td class="text-left title"><?php echo __('Car price', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php echo TravelHelper::format_money($base_price); ?></strong></td>
        </tr>
        <?php if(!empty($extras) and is_array($extras)){ ?>
            <tr>
                <td class="text-left title"><?php echo __('Extra price', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($extra_price); ?></strong></td>
            </tr>
        <?php } ?>
        <?php if(!empty($discount)){ ?>
            <tr>
                <td class="text-left title"><?php echo __('Discount', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo esc_html($discount . '%'); ?></strong></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="text-left title"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php echo TravelHelper::format_money($sale_price); ?></strong></td>
        </tr>
        <tr>
            <td class="text-left title">
                <?php echo __('Tax', ST_TEXTDOMAIN); ?>
            </td>
            <td class="text-right "><strong><?php echo STPrice::getTax().' %'; ?></strong></td>
        </tr>
        <?php if (STCart::use_coupon()):
            if($price_coupon < 0) $price_coupon = 0;
            ?>
            <tr>
                <td class="text-left title">
                    <?php printf(st_get_language('coupon_key'), STCart::get_coupon_code()) ?> <br/>
                    <?php if(st()->get_option('use_woocommerce_for_booking','off') == 'off' && st()->get_option('booking_modal','off') == 'on' ){ ?>
                        <a href="javascript: void(0);" title="" class="ajax-remove-coupon" data-coupon="STCart::get_coupon_code()"><small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</a>
                    <?php }else{ ?>
                        <a href="<?php echo st_get_link_with_search(get_permalink(), array('remove_coupon'), array('remove_coupon' => STCart::get_coupon_code())) ?>"
                           class="danger"><small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</small></a>
                    <?php } ?>
                </td>
                <td class="text-right ">
                    <strong>
                        - <?php echo TravelHelper::format_money( $price_coupon ) ?>
                    </strong>
                </td>
            </tr>
        <?php endif; ?>
        <?php
        if(isset($item['data']['deposit_money']) && count($item['data']['deposit_money']) && floatval($item['data']['deposit_money']['amount']) > 0):

            $deposit      = $item['data']['deposit_money'];

            $deposit_price = $price_with_tax;

            if($deposit['type'] == 'percent'){
                $de_price = floatval($deposit['amount']);
                $deposit_price = $deposit_price * ($de_price /100);
            }elseif($deposit['type'] == 'amount'){
                $de_price = floatval($deposit['amount']);
                $deposit_price = $de_price;
            }
            ?>
            <tr>
                <td class="text-left title"><?php echo __('Total', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($price_with_tax); ?></strong></td>
            </tr>
            <tr style="border-top: 1px solid #CCC; font-size: 20px; text-transform: uppercase; margin-top: 20px;">
                <td class="text-left title"><?php echo __('Deposit', ST_TEXTDOMAIN); ?></td>
                <td class="text-right ">
                    <?php echo TravelHelper::format_money($deposit_price); ?>
                </td>
            </tr>
            <?php
            $total_price = 0;
            if(isset($item['data']['deposit_money']) && floatval($item['data']['deposit_money']['amount']) > 0){
                $total_price = $deposit_price;
            }else{
                $total_price = $price_with_tax;
            }
            ?>
            <?php if(!empty($item['data']['booking_fee_price'])){
                $total_price = $total_price + $item['data']['booking_fee_price'];
                ?>
                <tr>
                    <td class="text-left title"><?php echo __('Fee', ST_TEXTDOMAIN); ?></td>
                    <td class="text-right "><strong><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></strong></td>
                </tr>
            <?php } ?>
            <tr>
                <td class="text-left title " style="border: none; text-transform: uppercase;"><strong><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></strong></td>
                <td class="text-right " style="border: none;"><strong>
                        <?php echo TravelHelper::format_money($total_price); ?></strong>
                </td>
            </tr>
        <?php else: ?>
            <?php if(!empty($item['data']['booking_fee_price'])){
                $price_with_tax = $price_with_tax + $item['data']['booking_fee_price'];
                ?>
                <tr>
                    <td class="text-left title"><?php echo __('Fee', ST_TEXTDOMAIN); ?></td>
                    <td class="text-right "><strong><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></strong></td>
                </tr>
            <?php } ?>
            <tr style="border-top: 1px solid #CCC; font-size: 20px; text-transform: uppercase; margin-top: 20px;">
                <td class="text-left title"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($price_with_tax); ?></strong></td>
            </tr>
        <?php endif; ?>
    </table>
</div>