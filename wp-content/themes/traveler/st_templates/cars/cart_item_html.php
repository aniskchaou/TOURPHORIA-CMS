<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars cart item html
 *
 * Created by ShineTheme
 *
 */
if (isset($item_id) and $item_id):
    $item = STCart::find_item($item_id);
    $item_price = floatval($item['data']['item_price']);
    $selected_equipments = $item['data']['data_equipment'];
    $price_equipment = floatval($item['data']['price_equipment']);
    $check_in = $item['data']['check_in']; //date
    $check_out = $item['data']['check_out'];
    $check_in_time = $item['data']['check_in_time'];
    $check_out_time = $item['data']['check_out_time'];
    $check_in_timestamp = $item['data']['check_in_timestamp'];
    $check_out_timestamp = $item['data']['check_out_timestamp'];
    $unit = st()->get_option('cars_price_unit', 'day');
    if ($unit == "distance") {
        $numberday = $item['data']['distance'];
    } else {
        $numberday = STCars::get_date_diff($check_in_timestamp, $check_out_timestamp, $unit);
    }
    ///// get Price
    $info_price = STCars::get_info_price($item['data']['st_booking_id'], $check_in_timestamp, $check_out_timestamp);
    $cars_price = $info_price['price'];
    $count_sale = $info_price['discount'];
    $price_origin = $info_price['price_origin'];
    $list_price = $info_price['list_price'];
    ?>
    <div style="display: none;" class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <header class="clearfix">
        <?php if (get_post_status($item_id)): ?>
            <a class="booking-item-payment-img" href="#">
                <?php echo get_the_post_thumbnail($item_id, array(98, 74, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID())))); ?>
            </a>
            <h5 class="booking-item-payment-title"><a
                        href="<?php echo get_permalink($item_id) ?>"><?php echo get_the_title($item_id) ?></a></h5>
            <ul class="icon-group booking-item-rating-stars">
                <?php echo TravelHelper::rate_to_string(STReview::get_avg_rate($item_id)); ?>
            </ul>
            <?php
            $address = get_post_meta($item_id, 'cars_address', true);
            if ($address):
                ?>
                <h5 class="booking-item-payment-title mt5"><i
                            class="fa fa-map-marker mr5"></i><?php echo esc_html($address); ?></h5>
            <?php endif; ?>
            <?php
        else: echo st_get_language('no_cars_found');
        endif; ?>
    </header>
    <ul class="booking-item-payment-details">

        <li>
            <h5><?php echo __('Car', ST_TEXTDOMAIN); ?></h5>
            <p class="booking-item-payment-item-title"><?php echo get_the_title($item_id) ?></p>
            <ul class="booking-item-payment-price">
                <?php if (!empty($item['data']['pick_up'])): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Pickup', ST_TEXTDOMAIN); ?></p>
                        <p class="booking-item-payment-price-amount"><?php echo esc_html($item['data']['pick_up']); ?></p>
                    </li>
                <?php endif; ?>
                <?php if (!empty($item['data']['drop_off'])): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Dropoff', ST_TEXTDOMAIN); ?></p>
                        <p class="booking-item-payment-price-amount"><?php echo esc_html($item['data']['drop_off']); ?></p>
                    </li>
                <?php endif; ?>
                <?php if (empty($list_price)) { ?>
                    <li>
                        <p class="booking-item-payment-price-title">
                            <?php echo __('Car Price', ST_TEXTDOMAIN); ?>
                        </p>
                        <p class="booking-item-payment-price-amount">
                            <?php
                            if ($cars_price != $price_origin) {
                                echo '<span class=" onsale">';
                                echo TravelHelper::format_money($price_origin);
                                echo '</span>';
                                echo ' <i class="fa fa-long-arrow-right" ></i > ';
                            }
                            echo TravelHelper::format_money($cars_price);
                            ?>
                        </p>
                    </li>
                <?php } ?>
                <?php $unit = st()->get_option('cars_price_unit');

                $data_time = "";
                if ($unit == 'day') {
                    $data_time = date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)) . ' <i class="fa fa-arrow-right "></i> ' . date_i18n(TravelHelper::getDateFormat(), strtotime($check_out));
                }
                if ($unit == 'hour') {
                    $data_time = date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)) . " " . $check_in_time . ' <i class="fa fa-arrow-right "></i> ' . date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)) . " " . $check_out_time;
                }
                ?>
                <?php if (!empty($date_time)) { ?>
                    <li>
                        <p class="booking-item-payment-price-title">
                            <?php echo __('Date', ST_TEXTDOMAIN); ?>
                        </p>
                        <p class="booking-item-payment-price-amount">
                            <?php echo balanceTags($data_time); ?>
                        </p>
                    </li>
                <?php } ?>

                <li>
                    <p class="booking-item-payment-price-title">
                        <?php
                        if ($unit == 'day') {
                            echo __('Number of Days', ST_TEXTDOMAIN);
                        } elseif ($unit == 'hour') {
                            echo __('Number of Hours', ST_TEXTDOMAIN);
                        } elseif ($unit == "distance") {
                            $type_distance = st()->get_option("cars_price_by_distance", "kilometer");
                            if ($type_distance == "kilometer") {
                                $type_distance = __("kilometers", ST_TEXTDOMAIN);
                            } else {
                                $type_distance = __("miles", ST_TEXTDOMAIN);
                            }
                            echo __(sprintf('Number of %s', $type_distance), ST_TEXTDOMAIN);
                        }
                        ?>
                    </p>
                    <p class="booking-item-payment-price-amount">
                        <?php
                        $unit_html = $unit;
                        switch ($unit) {
                            case 'day':
                                $unit_html = __("day(s)", ST_TEXTDOMAIN);
                                break;
                            case 'distance':

                                if (st()->get_option('cars_price_by_distance', 'kilometer') == "kilometer") {
                                    $unit_html = __("kilometers", ST_TEXTDOMAIN);
                                } else {
                                    $unit_html = __("miles", ST_TEXTDOMAIN);
                                }
                                break;
                            default:
                                $unit_html = __("hour(s)", ST_TEXTDOMAIN);
                                break;
                        }

                        ?>
                        <?php echo esc_html($numberday . ' ' . $unit_html); ?>
                    </p>
                </li>
                <?php if (!empty($list_price)) { ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Car Price:", ST_TEXTDOMAIN) ?></p>
                    </li>
                    <?php
                    $unit = st()->get_option('cars_price_unit', 'day');
                    $format = "d/m/Y";
                    $tmp_price = 0;
                    $list_price = STPrice::convert_array_date_custom_price_by_date($list_price);
                    foreach ($list_price as $k => $v):
                        ?>
                        <li class="padding_l_20">
                            <p class="booking-item-payment-price-title">
                                <?php if ($v['start'] == $v['end']) {
                                    ?>
                                    <?php echo esc_html(date_i18n($format, strtotime($v['start']))) ?>
                                <?php } else {
                                    ?>
                                    <?php echo esc_html(date_i18n($format, strtotime($v['start']))) ?>
                                    -
                                    <?php echo esc_html(date_i18n($format, strtotime($v['end']))) ?>
                                <?php } ?>
                            </p>
                            <p class="booking-item-payment-price-amount">
                                <?php echo esc_html(TravelHelper::format_money($v['price'])) ?>
                                /<?php echo esc_html($unit) ?>
                            </p>
                        </li>
                    <?php endforeach ?>

                <?php } ?>
                <li>
                    <p class="booking-item-payment-price-title">
                        <?php echo __('Equipment(s)', ST_TEXTDOMAIN); ?>
                    </p>
                    <?php
                    if (is_array($selected_equipments) && count($selected_equipments)):
                        foreach ($selected_equipments as $key => $val):
                            ?>
                            <p class="booking-item-payment-price-amount">
                                <?php echo esc_html($val->title . ' (' . TravelHelper::format_money($val->price) . ')'); ?>
                                <?php
                                if ((int)$val->number_item < 2) {
                                    $val->number_item = 1;
                                }
                                echo ' x ' . $val->number_item;
                                ?>
                            </p> <br/>
                        <?php endforeach; else: ?>
                        <p class="booking-item-payment-price-amount">
                            <?php echo __('None', ST_TEXTDOMAIN); ?>
                        </p>
                    <?php endif; ?>
                </li>
                <?php
                if (isset($item['data']['deposit_money']) && !empty($item['data']['deposit_money']['amount'])):
                    $deposit = $item['data']['deposit_money'];
                    ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php printf(__('Deposit %s', ST_TEXTDOMAIN), $deposit['type']) ?> </p>
                        <p class="booking-item-payment-price-amount"><?php
                            switch ($deposit['type']) {
                                case "percent":
                                    echo esc_html($deposit['amount'] . ' %');
                                    break;
                                case "amount":
                                    echo TravelHelper::format_money($deposit['amount']);
                                    break;
                            }
                            ?>
                        </p>
                    </li>
                <?php endif; ?>
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
            <?php $code = STInput::post('coupon_code') ? STInput::post('coupon_code') : STCart::get_coupon_code(); ?>
            <input id="field-coupon_code" value="<?php echo esc_attr($code); ?>" type="text"
                   class="form-control" name="coupon_code">
        </div>
        <input type="hidden" name="st_action" value="apply_coupon">
        <?php if (st()->get_option('use_woocommerce_for_booking', 'off') == 'off' && st()->get_option('booking_modal', 'off') == 'on') { ?>
            <input type="hidden" name="action" value="ajax_apply_coupon">
            <button class="btn btn-primary add-coupon-ajax"><?php _e('Apply Coupon', ST_TEXTDOMAIN) ?></button>
            <div class="alert alert-danger hidden">
            </div>
        <?php } else { ?>
            <button class="btn btn-primary" type="submit"><?php _e('Apply Coupon', ST_TEXTDOMAIN) ?></button>
        <?php } ?>
    </form>
</div>
<div class="booking-item-payment-total text-right">
    <?php
    $unit = st()->get_option('cars_price_unit', 'day');
    $price_equipment = STPrice::getPriceEuipmentCar($selected_equipments, $check_in_timestamp, $check_out_timestamp);
    $origin_price = $item_price * $numberday;
    $sale_price = STPrice::getSaleCarPrice($item_id, $item_price, $check_in_timestamp, $check_out_timestamp, $item['data']['location_id_pick_up'], $item['data']['location_id_drop_off']);
    $price_coupon = floatval(STCart::get_coupon_amount());
    $price_with_tax = STPrice::getPriceWithTax($sale_price + $price_equipment);
    $price_with_tax -= $price_coupon;
    ?>
    <table border="0" class="table_checkout">
        <tr>
            <td class="text-left title"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php echo TravelHelper::format_money($sale_price); ?></strong></td>
        </tr>
        <?php if ($price_equipment) { ?>
            <tr>
                <td class="text-left title">
                    <?php echo __('Equipment Price', ST_TEXTDOMAIN); ?>
                </td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($price_equipment); ?></strong>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="text-left title">
                <?php echo __('Tax', ST_TEXTDOMAIN); ?>
            </td>
            <td class="text-right "><strong><?php echo STPrice::getTax() . ' %'; ?></strong></td>
        </tr>
        <?php if (STCart::use_coupon()):
            $price_coupon = floatval(STCart::get_coupon_amount());
            if ($price_coupon < 0) $price_coupon = 0;
            ?>
            <tr>
                <td class="text-left title">
                    <?php printf(st_get_language('coupon_key'), STCart::get_coupon_code()) ?> <br/>
                    <?php if (st()->get_option('use_woocommerce_for_booking', 'off') == 'off' && st()->get_option('booking_modal', 'off') == 'on') { ?>
                        <a href="javascript: void(0);" title="" class="ajax-remove-coupon"
                           data-coupon="STCart::get_coupon_code()">
                            <small class='text-color'>(<?php st_the_language('Remove coupon') ?> )
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo st_get_link_with_search(get_permalink(), array('remove_coupon'), array('remove_coupon' => STCart::get_coupon_code())) ?>"
                           class="danger">
                            <small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</small>
                        </a>
                    <?php } ?>
                </td>
                <td class="text-right ">
                    <strong>
                        - <?php echo TravelHelper::format_money($price_coupon) ?>
                    </strong>
                </td>
            </tr>
        <?php endif; ?>
        <?php
        if (isset($item['data']['deposit_money']) && count($item['data']['deposit_money']) && floatval($item['data']['deposit_money']['amount']) > 0):
            $deposit = $item['data']['deposit_money'];
            $deposit_price = $price_with_tax;
            if ($deposit['type'] == 'percent') {
                $de_price = floatval($deposit['amount']);
                $deposit_price = $deposit_price * ($de_price / 100);
            } elseif ($deposit['type'] == 'amount') {
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
            if (isset($item['data']['deposit_money']) && floatval($item['data']['deposit_money']['amount']) > 0) {
                $total_price = $deposit_price;
            } else {
                $total_price = $price_with_tax;
            }
            ?>
            <?php if (!empty($item['data']['booking_fee_price'])) {
            $total_price = $total_price + $item['data']['booking_fee_price'];
            ?>
            <tr>
                <td class="text-left title"><?php echo __('Fee', ST_TEXTDOMAIN); ?></td>
                <td class="text-right ">
                    <strong><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></strong></td>
            </tr>
        <?php } ?>
            <tr>
                <td class="text-left title " style="border: none; text-transform: uppercase;">
                    <strong><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></strong></td>
                <td class="text-right " style="border: none;">
                    <strong><?php echo TravelHelper::format_money($total_price); ?></strong></td>
            </tr>
        <?php else: ?>
            <?php if (!empty($item['data']['booking_fee_price'])) {
                $price_with_tax = $price_with_tax + $item['data']['booking_fee_price'];
                ?>
                <tr>
                    <td class="text-left title"><?php echo __('Fee', ST_TEXTDOMAIN); ?></td>
                    <td class="text-right ">
                        <strong><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></strong>
                    </td>
                </tr>
            <?php } ?>
            <tr style="border-top: 1px solid #CCC; font-size: 20px; text-transform: uppercase; margin-top: 20px;">
                <td class="text-left title"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($price_with_tax); ?></strong></td>
            </tr>
        <?php endif; ?>
    </table>
</div>