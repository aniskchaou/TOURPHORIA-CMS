<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours cart item html
 *
 * Created by ShineTheme
 *
 */
if(isset($item_id) and $item_id):
    $item = STCart::find_item($item_id);

    $tour_id = $item_id;

    $check_in = $item['data']['check_in'];
    $check_out = $item['data']['check_out'];

    $type_tour=$item['data']['type_tour'];
    $duration = isset($item['data']['duration']) ? $item['data']['duration'] : 0;

    //Start Time since 2.0.0
    $starttime = $item['data']['starttime'];

    $adult_number = intval($item['data']['adult_number']);
    $child_number = intval($item['data']['child_number']);
    $infant_number = intval($item['data']['infant_number']);
    $extras = isset($item['data']['extras']) ? $item['data']['extras'] : array();
    $hotel_package = isset($item['data']['package_hotel']) ? $item['data']['package_hotel'] : array();
    $activity_package = isset($item['data']['package_activity']) ? $item['data']['package_activity'] : array();
    $car_package = isset($item['data']['package_car']) ? $item['data']['package_car'] : array();
    $flight_package = isset($item['data']['package_flight']) ? $item['data']['package_flight'] : array();

    $tour_price_by = get_post_meta($tour_id, 'tour_price_by', true);
    ?>
    <div style="display: none;" class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <header class="clearfix" style="position: relative">
        <?php if(!empty($count_sale)){ ?>
            <?php STFeatured::get_sale($count_sale) ; ?>
        <?php } ?>
        <?php if(get_post_status($tour_id)):?>
            <a class="booking-item-payment-img" href="#">
                <?php echo get_the_post_thumbnail($tour_id,array(98,74,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($tour_id ))));?>
            </a>
            <h5 class="booking-item-payment-title"><a href="<?php echo get_permalink($tour_id)?>"><?php echo get_the_title($tour_id)?></a></h5>
            <ul class="icon-group booking-item-rating-stars">
                <?php echo TravelHelper::rate_to_string(STReview::get_avg_rate($tour_id)); ?>
            </ul>
            <?php
            $address = get_post_meta( $tour_id, 'address', true);
            if( $address ):
                ?>
                <h5 class="booking-item-payment-title"><i class="fa fa-map-marker mr5"></i> <?php echo esc_html( $address ); ?></h5>
            <?php endif; ?>
            <?php
        else: st_the_language('sorry_tour_not_found');
        endif;?>
    </header>
    <ul class="booking-item-payment-details">
        <li>
            <h5><?php st_the_language('tours_information')?></h5>
            <p class="booking-item-payment-item-title"><?php echo get_the_title($item_id)?></p>
        </li>
        <li>
            <ul class="booking-item-payment-price">
	            <?php if($tour_price_by != 'fixed_depart'){ ?>
                    <li>
                        <p class="booking-item-payment-price-title">
                            <?php echo __('Type Tour', ST_TEXTDOMAIN); ?>
                        </p>
                        <p class="booking-item-payment-price-amount">
                            <?php
                                if($type_tour == 'daily_tour'){
                                    echo __('Daily Tour', ST_TEXTDOMAIN);
                                }elseif($type_tour == 'specific_date'){
                                    echo __('Special Date', ST_TEXTDOMAIN);
                                }
                            ?>
                        </p>
                    </li>
                    <?php if($type_tour == 'daily_tour'): ?>
                        <li>
                            <p class="booking-item-payment-price-title">
                                <?php echo __('Departure date', ST_TEXTDOMAIN); ?>
                            </p>
                            <p class="booking-item-payment-price-amount">
                                <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)) . ($starttime == '' ? '' : ' - ' . $starttime); ?>
                            </p>
                        </li>
                    <?php else: ?>
                        <li>
                            <p class="booking-item-payment-price-title">
                                <?php echo __('Date', ST_TEXTDOMAIN); ?>
                            </p>
                            <p class="booking-item-payment-price-amount">
                                <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?> -
                                <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)) . ($starttime == '' ? '' : ' - ' . $starttime); ?>
                            </p>
                        </li>
                    <?php endif; ?>
                    <?php if($type_tour == 'daily_tour' and $duration): ?>
                        <li>
                            <p class="booking-item-payment-price-title"><?php  _e('Duration',ST_TEXTDOMAIN)?> </p>
                            <p class="booking-item-payment-price-amount">
                                <?php
                                echo STTour::get_duration_unit($tour_id);
                                ?>
                            </p>
                        </li>
                    <?php endif; ?>
                <?php }else{ ?>
                    <li><b><?php echo __('Fixed Departure', ST_TEXTDOMAIN); ?></b></li>
                    <li>
                        <p class="booking-item-payment-price-title"><?php  _e('Start',ST_TEXTDOMAIN)?> </p>
                        <p class="booking-item-payment-price-amount">
				            <?php
				            echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in));
				            ?>
                        </p>
                    </li>
                    <li>
                        <p class="booking-item-payment-price-title"><?php  _e('End',ST_TEXTDOMAIN)?> </p>
                        <p class="booking-item-payment-price-amount">
				            <?php
				            echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out));
				            ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if($adult_number){?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Number of Adult',ST_TEXTDOMAIN) ?> </p>


                        <p class="booking-item-payment-price-amount"><?php echo $adult_number; ?>
                        </p>

                    </li>
                <?php } ?>
                <?php if($child_number){?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Number of Children',ST_TEXTDOMAIN) ?> </p>
                        <p class="booking-item-payment-price-amount"><?php echo $child_number; ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if($infant_number){?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e('Number of Infant',ST_TEXTDOMAIN) ?> </p>
                        <p class="booking-item-payment-price-amount"><?php echo $infant_number; ?>
                        </p>
                    </li>
                <?php } ?>
                <?php
                if(isset($item['data']['deposit_money'])):
                    $deposit = $item['data']['deposit_money'];
                    if(floatval($deposit['amount']) > 0) :
	                    $deposite_text = __('Deposit percent', ST_TEXTDOMAIN);
                        if($deposit['type'] == 'amount'){
	                        $deposite_text = __('Deposit amount', ST_TEXTDOMAIN);
                        }
                        ?>
                        <li>
                            <p class="booking-item-payment-price-title"><?php echo $deposite_text; ?> </p>
                            <p class="booking-item-payment-price-amount"><?php
                                switch($deposit['type']){
                                    case "percent":
                                        echo $deposit['amount'].' %';
                                        break;
                                    case "amount":
                                        echo TravelHelper::format_money($deposit['amount']);
                                        break;
                                }
                                ?>
                            </p>
                        </li>
                    <?php endif; endif; ?>
                <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Extra",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
                            <?php
                            foreach($extras['value'] as $name => $number):
                                $number_item = intval($extras['value'][$name]);
                                if($number_item <= 0) $number_item = 0;
                                if($number_item > 0):
                                    $price_item = floatval($extras['price'][$name]);
                                    if($price_item <= 0) $price_item = 0;

                                    ?>
                                    <span class="pull-right">
                            <?php echo $extras['title'][$name].' ('.TravelHelper::format_money($price_item).') x '.$number_item.' '.__('Item(s)', ST_TEXTDOMAIN); ?>
                        </span> <br />
                                <?php endif;  endforeach;?>
                        </p>
                    </li>
                <?php  endif; ?>
                <!-- Tour Package -->
                <?php if(is_array($hotel_package) && count($hotel_package)): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Selected Hotel Package",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
                            <?php
                            foreach($hotel_package as $k_hp => $v_hp): ?>
                                <span class="pull-right">
                                    <?php echo $v_hp->hotel_name . ' ('.TravelHelper::format_money($v_hp->hotel_price).')'; ?>
                                </span> <br />
                            <?php endforeach;?>
                        </p>
                    </li>
                <?php  endif; ?>
                <?php if(is_array($activity_package) && count($activity_package)): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Selected Activity Package",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
                            <?php
                            foreach($activity_package as $k_hp => $v_hp): ?>
                                <span class="pull-right">
                                    <?php echo $v_hp->activity_name . ' ('.TravelHelper::format_money($v_hp->activity_price).')'; ?>
                                </span> <br />
                            <?php endforeach;?>
                        </p>
                    </li>
                <?php  endif; ?>
                <?php if(is_array($car_package) && count($car_package)): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Selected Car Package",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
                            <?php
                            foreach($car_package as $k_hp => $v_hp): ?>
                                <span class="pull-right">
                                    <?php echo $v_hp->car_name . ' ('.TravelHelper::format_money($v_hp->car_price).') x ' . $v_hp->car_quantity; ?>
                                </span> <br />
                            <?php endforeach;?>
                        </p>
                    </li>
                <?php  endif; ?>
	            <?php if(is_array($flight_package) && count($flight_package)): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Selected Flight Package",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
				            <?php
				            foreach($flight_package as $k_fp => $v_fp): ?>
                                <span class="pull-right">
                                    <?php
                                    $name_flight_package = $v_fp->flight_origin . ' <i class="fa fa-long-arrow-right"></i> ' . $v_fp->flight_destination;
                                    $price_flight_package = '';
                                    if($v_fp->flight_price_type == 'business'){
	                                    $price_flight_package = TravelHelper::format_money($v_fp->flight_price_business);
                                    }else{
	                                    $price_flight_package = TravelHelper::format_money($v_fp->flight_price_economy);
                                    }
                                    ?>
                                    <?php echo $name_flight_package . ' (' . $price_flight_package . ')'; ?>
                                </span> <br />
				            <?php endforeach;?>
                        </p>
                    </li>
	            <?php  endif; ?>
                <!-- End Tour Package -->
            </ul>
        </li>
    </ul>
<?php endif; ?>
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
            <input id="field-coupon_code" value="<?php echo esc_attr($code ); ?>" type="text" class="form-control" name="coupon_code">
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
    $price_type = STTour::get_price_type($item_id);
    if($price_type == 'person' or $price_type == 'fixed_depart'){
	    $data_price = STPrice::getPriceByPeopleTour($item_id, strtotime($check_in), strtotime($check_out),  $adult_number, $child_number, $infant_number);
    }else{
	    $data_price = STPrice::getPriceByFixedTour($item_id, strtotime($check_in), strtotime($check_out));
    }
    $origin_price = floatval($data_price['total_price']);
    $sale_price = STPrice::getSaleTourSalePrice($item_id, $origin_price, $type_tour, strtotime($check_in));
    $extra_price = isset($item['data']['extra_price']) ? floatval($item['data']['extra_price']) : 0;
    $hotel_package_price = isset($item['data']['package_hotel_price']) ? floatval($item['data']['package_hotel_price']) : 0;
    $activity_package_price = isset($item['data']['package_activity_price']) ? floatval($item['data']['package_activity_price']) : 0;
    $car_package_price = isset($item['data']['package_car_price']) ? floatval($item['data']['package_car_price']) : 0;
    $flight_package_price = isset($item['data']['package_flight_price']) ? floatval($item['data']['package_flight_price']) : 0;
    $price_coupon = floatval(STCart::get_coupon_amount());
    $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price + $hotel_package_price + $activity_package_price + $car_package_price + $flight_package_price);
    $price_with_tax -= $price_coupon;
    ?>
    <table border="0" class="table_checkout">
        <?php if($price_type == 'person' or $price_type == 'fixed_depart'){ ?>
        <tr>
            <td class="text-left title"><?php echo __('Adult Price', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php if($data_price['adult_price']) echo TravelHelper::format_money($data_price['adult_price']); else echo '0'; ?></strong></td>
        </tr>
        <tr>
            <td class="text-left title"><?php echo __('Children Price', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php if($data_price['child_price']) echo TravelHelper::format_money($data_price['child_price']); else echo '0'; ?></strong></td>
        </tr>
        <tr>
            <td class="text-left title"><?php echo __('Infant Price', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php if($data_price['infant_price']) echo TravelHelper::format_money($data_price['infant_price']); else echo '0'; ?></strong></td>
        </tr>
        <?php }else{ ?>
            <tr>
                <td class="text-left title"><?php echo __('Price', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php if($data_price['total_price']) echo TravelHelper::format_money($data_price['total_price']); else echo '0'; ?></strong></td>
            </tr>
        <?php } ?>


        <tr>
            <td class="text-left title"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php echo TravelHelper::format_money($sale_price); ?></strong></td>
        </tr>
        <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && isset($item['data']['extra_price'])): ?>
            <tr>
                <td class="text-left title"><?php echo __('Extra Price', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($extra_price); ?></strong></td>
            </tr>
        <?php endif; ?>
        <?php if(is_array($hotel_package) && count($hotel_package)): ?>
            <tr>
                <td class="text-left title"><?php echo __('Hotel Package', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($hotel_package_price); ?></strong></td>
            </tr>
        <?php endif; ?>
        <?php if(is_array($activity_package) && count($activity_package)): ?>
            <tr>
                <td class="text-left title"><?php echo __('Activity Package', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($activity_package_price); ?></strong></td>
            </tr>
        <?php endif; ?>
        <?php if(is_array($car_package) && count($car_package)): ?>
            <tr>
                <td class="text-left title"><?php echo __('Car Package', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($car_package_price); ?></strong></td>
            </tr>
        <?php endif; ?>
	    <?php if(is_array($flight_package) && count($flight_package)): ?>
            <tr>
                <td class="text-left title"><?php echo __('Flight Package', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($flight_package_price); ?></strong></td>
            </tr>
	    <?php endif; ?>
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
                <td class="text-right " style="border: none;"><strong><?php echo TravelHelper::format_money($total_price); ?></strong></td>
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