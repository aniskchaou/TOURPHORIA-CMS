<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental cart item html
 *
 * Created by ShineTheme
 *
 */
if(isset($item_id) and $item_id):

    $item = STCart::find_item($item_id);

    extract($item);

    $check_in = $data['check_in'];

    $check_out = $data['check_out'];

    $numberday = STDate::dateDiff($check_in, $check_out);

    $adult_number = intval($data['adult_number']);

    $child_number = intval($data['child_number']);
    $extras = isset($item['data']['extras']) ? $item['data']['extras'] : array();

    $price_coupon = floatval(STCart::get_coupon_amount());

    ?>
    <div style="display: none;" class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <header class="clearfix">
        <a class="booking-item-payment-img" href="<?php echo get_the_permalink($item_id)?>">
            <?php echo get_the_post_thumbnail($item_id,array(98,74,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($item_id ))));?>
        </a>
        <h5 class="booking-item-payment-title"><a href="<?php echo get_permalink($item_id)?>"><?php echo get_the_title($item_id)?></a></h5>
        <ul class="icon-group booking-item-rating-stars">
            <?php echo TravelHelper::rate_to_string(STReview::get_avg_rate($item_id)); ?>
        </ul>
        <?php
        $address = get_post_meta( $item_id, 'address', true);
        if( $address ):
            ?>
            <h5 class="booking-item-payment-title"><i class="fa fa-map-marker mr5"></i> <?php echo esc_html( $address ); ?></h5>
        <?php endif; ?>
    </header>
    <ul class="booking-item-payment-details">
        <li>
            <h5><?php echo __('Rental', ST_TEXTDOMAIN); ?></h5>
            <p class="booking-item-payment-item-title"><?php echo get_the_title($item_id)?></p>
            <ul class="booking-item-payment-price">
                <li>
                    <p class="booking-item-payment-price-title">
                        <?php echo __('Date', ST_TEXTDOMAIN); ?>
                    </p>
                    <p class="booking-item-payment-price-amount">
                        <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?>
                        <i class="fa fa-arrow-right "></i>
                        <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)); ?>
                        <br />
                        <button id="getInfoPriceLink" type="button" class="btn btn-primary btn-xs pull-right" style="margin-bottom: 1px;" aria-expanded="false" aria-controls="getInfoPrice" data-toggle="collapse" data-target="#getInfoPrice"><?php echo __('Details', ST_TEXTDOMAIN); ?></button>
                    </p>
                    <div class="collapse" id="getInfoPrice" style="width:100%; height:200px; overflow-y:auto;">
                        <?php echo STPrice::showRentalPriceInfo($item_id, strtotime($check_in), strtotime(($check_out))); ?>
                    </div>
                </li>
                <li>
                    <p class="booking-item-payment-price-title">
                        <?php echo __('Number Night', ST_TEXTDOMAIN); ?>
                    </p>
                    <p class="booking-item-payment-price-amount">
                        <?php
                        if($numberday > 1){
                            printf(st_get_language('d_night'),$numberday);
                        }else{
                            printf(st_get_language('1_night'),$numberday);
                        }
                        ?>
                    </p>
                </li>
                <?php if($adult_number){?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Number of Adult",ST_TEXTDOMAIN) ?></p>
                        <p class="booking-item-payment-price-amount"><?php echo esc_html($adult_number).__(' Adult(s)', ST_TEXTDOMAIN);?></p>
                    </li>
                <?php }?>
                <?php if($child_number){?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Number of Children",ST_TEXTDOMAIN) ?></p>
                        <p class="booking-item-payment-price-amount"><?php echo esc_html($child_number).__(' Children', ST_TEXTDOMAIN);?></p>
                    </li>
                <?php }?>
                <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php _e("Extra",ST_TEXTDOMAIN) ?></p><br />
                        <p class="booking-item-payment-price-amount">
                            <?php
                            foreach($extras['value'] as $name => $number):
                                $price_item = floatval($extras['price'][$name]);
                                if($price_item <= 0) $price_item = 0;
                                $number_item = intval($extras['value'][$name]);
                                if($number_item <= 0) $number_item = 0;

                                if(!$number_item) continue;
                                ?>
                                <span class="pull-right">
                            <?php echo esc_html($extras['title'][$name]).' ('.TravelHelper::format_money($price_item).') x '.$number_item.' '.__('Item(s)', ST_TEXTDOMAIN); ?>
                        </span> <br />
                            <?php endforeach;?>
                        </p>
                    </li>
                <?php  endif; ?>
                <?php
                if(isset($item['data']['deposit_money']) and !empty($item['data']['deposit_money']['type'])):
                    $deposit = $item['data']['deposit_money'];
                    ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php printf(__('Deposit %s',ST_TEXTDOMAIN),$deposit['type']) ?> </p>
                        <p class="booking-item-payment-price-amount"><?php
                            switch($deposit['type']){
                                case "percent":
                                    echo esc_html($deposit['amount'].' %');
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
    $item_price = STPrice::getRentalPriceOnlyCustomPrice($item_id, strtotime($check_in), strtotime($check_out));
    $price =  $item_price;
    $sale_price = STPrice::getSalePrice($item_id, strtotime($check_in), strtotime($check_out));
    $extra_price = isset($item['data']['extra_price']) ? floatval($item['data']['extra_price']) : 0;
    $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price);
    $price_coupon = floatval(STCart::get_coupon_amount());
    $price_with_tax -= $price_coupon;
    ?>
    <table border="0" class="table_checkout">
        <tr>
            <td class="text-left title"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></td>
            <td class="text-right "><strong><?php echo TravelHelper::format_money($sale_price); ?></strong></td>
        </tr>
        <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && isset($item['data']['extra_price']) and $extra_price): ?>
            <tr>
                <td class="text-left title"><?php echo __('Extra Price', ST_TEXTDOMAIN); ?></td>
                <td class="text-right "><strong><?php echo TravelHelper::format_money($extra_price); ?></strong></td>
            </tr>
        <?php endif; ?>
        <?php if($tax=STPrice::getTax()){?>
            <tr>
                <td class="text-left title">
                    <?php echo __('Tax', ST_TEXTDOMAIN); ?>
                </td>
                <td class="text-right "><strong><?php echo STPrice::getTax().' %'; ?></strong></td>
            </tr>
        <?php }?>
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
                        - <?php echo TravelHelper::format_money( $price_coupon) ?>
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
            <?php
            if(!empty($item['data']['booking_fee_price'])){
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