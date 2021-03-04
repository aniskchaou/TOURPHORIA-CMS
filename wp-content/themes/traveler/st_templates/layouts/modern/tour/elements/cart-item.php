<?php
if(isset($item_id) and $item_id):
    $item = STCart::find_item($item_id);
    $tour = $item_id;

    $check_in = $item['data']['check_in'];
    $check_out = $item['data']['check_out'];
    $type_tour=$item['data']['type_tour'];
    $duration = isset($item['data']['duration']) ? $item['data']['duration'] : 0;
    $tour_price_by = get_post_meta($tour, 'tour_price_by', true);

    $date_diff = STDate::dateDiff($check_in,$check_out);

    $adult_number = intval($item['data']['adult_number']);
    $child_number = intval($item['data']['child_number']);
    $infant_number = intval($item['data']['infant_number']);
    $extras = isset($item['data']['extras']) ? $item['data']['extras'] : array();
?>
<div class="service-section">
    <div class="service-left">
        <h4 class="title"><a href="<?php echo get_permalink($tour)?>"><?php echo get_the_title($tour)?></a></h4>
        <?php
        $address = get_post_meta( $item_id, 'address', true);
        if( $address ):
            ?>
            <p class="address"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo esc_html($address); ?> </p>
            <?php
        endif;
        ?>
    </div>
    <div class="service-right">
        <?php echo get_the_post_thumbnail($tour,array(110,110,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($tour )), 'class' => 'img-responsive'));?>
    </div>
</div>
<div class="info-section">
    <ul>
        <?php if($tour_price_by != 'fixed_depart'){ ?>
            <li>
                <span class="label">
                    <?php echo __('Tour type', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                     <?php
                     if($type_tour == 'daily_tour'){
                         echo __('Daily Tour', ST_TEXTDOMAIN);
                     }elseif($type_tour == 'specific_date'){
                         echo __('Special Date', ST_TEXTDOMAIN);
                     }
                     ?>
                </span>
            </li>
            <?php if($type_tour == 'daily_tour'): ?>
            <li>
                <span class="label">
                    <?php echo __('Departure date', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                    <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?>
                    <?php
                        $start = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
                        $end   = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
                        $date  = date( 'd/m/Y h:i a', strtotime( $check_in ) ) . '-' . date( 'd/m/Y h:i a', strtotime( $check_out ) );
                        $args  = [
                            'start' => $start,
                            'end'   => $end,
                            'date'  => $date
                        ];
                    ?>
                    <a class="st-link" style="font-size: 12px;" href="<?php echo add_query_arg( $args, get_the_permalink( $item_id ) ); ?>"><?php echo __( 'Edit', ST_TEXTDOMAIN ); ?></a>
                </span>
            </li>
            <?php else: ?>
                <li>
                <span class="label">
                    <?php echo __('Date', ST_TEXTDOMAIN); ?>
                </span>
                    <span class="value">
                    <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_in ) ); ?>
                        -
                        <?php echo date_i18n( TravelHelper::getDateFormat(), strtotime( $check_out ) ); ?>
                        <?php
                        $start = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
                        $end   = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
                        $date  = date( 'd/m/Y h:i a', strtotime( $check_in ) ) . '-' . date( 'd/m/Y h:i a', strtotime( $check_out ) );
                        $args  = [
                            'start' => $start,
                            'end'   => $end,
                            'date'  => $date
                        ];
                        ?>
                        <a class="st-link" style="font-size: 12px;" href="<?php echo add_query_arg( $args, get_the_permalink( $item_id ) ); ?>"><?php echo __( 'Edit', ST_TEXTDOMAIN ); ?></a>
                    </span>
                </li>
            <?php endif; ?>
            <?php
            /*Starttime*/
            if(isset($item['data']['starttime']) && !empty($item['data']['starttime'])){
                ?>
                <li>
                <span class="label">
                    <?php echo __('Start time', ST_TEXTDOMAIN); ?>
                </span>
                    <span class="value">
                        <?php echo $item['data']['starttime']; ?>
                    </span>
                </li>
                <?php
            }
            ?>
            <?php if($type_tour == 'daily_tour' and $duration): ?>
                <li>
                    <span class="label">
                        <?php echo __('Duration', ST_TEXTDOMAIN); ?>
                    </span>
                        <span class="value">
                         <?php
                         echo STTour::get_duration_unit($item_id);
                         ?>
                    </span>
                </li>
            <?php endif; ?>
        <?php }else{ ?>
            <li><b><?php echo __('Fixed Departure', ST_TEXTDOMAIN); ?></b></li>
            <li>
                <span class="label">
                    <?php echo __('Start', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                     <?php
                     echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in));
                     ?>
                </span>
            </li>
            <li>
                <span class="label">
                    <?php echo __('End', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                     <?php
                     echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out));
                     ?>
                </span>
            </li>
        <?php } ?>


        <!--Add Info-->
        <li class="ad-info">
            <ul>
                <?php if($adult_number) {?>
                <li><span class="label"><?php echo __('Number of Adult', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo $adult_number; ?></span></li>
                <?php } ?>
                <?php if($child_number) {?>
                    <li><span class="label"><?php echo __('Number of Children', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo $child_number; ?></span></li>
                <?php } ?>
                <?php if($infant_number) {?>
                    <li><span class="label"><?php echo __('Number of Infant', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo $infant_number; ?></span></li>
                <?php } ?>
            </ul>
        </li>


        <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
            <li>
                <span class="label"><?php echo __('Extra', ST_TEXTDOMAIN); ?></span>
            </li>
            <li class="extra-value">
                    <?php
                    foreach ($extras['value'] as $name => $number):
                        $number_item = intval($extras['value'][$name]);
                        if ($number_item <= 0) $number_item = 0;
                        if ($number_item > 0):
                            $price_item = floatval($extras['price'][$name]);
                            if ($price_item <= 0) $price_item = 0;
                            ?>
                            <span class="pull-right">
                            <?php echo $extras['title'][$name] . ' (' . TravelHelper::format_money($price_item) . ') x ' . $number_item . ' ' . __('Item(s)', ST_TEXTDOMAIN); ?>
                            </span> <br/>
                        <?php endif;
                    endforeach;
                    ?>
            </li>
        <?php endif; ?>
        <?php
        if(isset($item['data']['deposit_money'])):
            $deposit      = $item['data']['deposit_money'];
            if(!empty($deposit['type']) and !empty($deposit['amount'])){
            ?>
            <li>
                <span class="label"><?php printf(__('Deposit %s',ST_TEXTDOMAIN),$deposit['type']) ?></span>
                <span class="value pull-right">
                    <?php
                    switch($deposit['type']){
                        case "percent":
                            echo $deposit['amount'].' %';
                            break;
                        case "amount":
                            echo TravelHelper::format_money($deposit['amount']);
                            break;
                    }
                    ?>
                </span>
            </li>
        <?php } endif; ?>
    </ul>
</div>
<div class="coupon-section">
    <h5><?php echo __('Coupon Code', ST_TEXTDOMAIN); ?></h5>

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
            <?php $code = STInput::post('coupon_code') ? STInput::post('coupon_code') : STCart::get_coupon_code();?>
            <input id="field-coupon_code" value="<?php echo esc_attr($code ); ?>" type="text" name="coupon_code" />
            <input type="hidden" name="st_action" value="apply_coupon">
            <?php if(st()->get_option('use_woocommerce_for_booking','off') == 'off' && st()->get_option('booking_modal','off') == 'on' ){ ?>
                <input type="hidden" name="action" value="ajax_apply_coupon">
                <button type="submit" class="btn btn-primary add-coupon-ajax"><?php echo __('APPLY', ST_TEXTDOMAIN); ?></button>
                <div class="alert alert-danger hidden"></div>
            <?php }else{ ?>
                <button type="submit" class="btn btn-primary"><?php echo __('APPLY', ST_TEXTDOMAIN); ?></button>
            <?php } ?>
        </div>
    </form>
</div>
<div class="total-section">
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
    $price_coupon = floatval(STCart::get_coupon_amount());
    $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price);
    $price_with_tax -= $price_coupon;
    ?>
    <ul>
        <?php if($price_type == 'person' or $price_type == 'fixed_depart'){ ?>
            <li>
                <span class="label">
                    <?php echo __('Adult Price', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                    <?php if($data_price['adult_price']) echo TravelHelper::format_money($data_price['adult_price']); else echo '0'; ?>
                </span>
            </li>

            <li>
                <span class="label">
                    <?php echo __('Children Price', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                    <?php if($data_price['child_price']) echo TravelHelper::format_money($data_price['child_price']); else echo '0'; ?>
                </span>
            </li>

            <li>
                <span class="label">
                    <?php echo __('Infant Price', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                    <?php if($data_price['infant_price']) echo TravelHelper::format_money($data_price['infant_price']); else echo '0'; ?>
                </span>
            </li>
        <?php }else{ ?>
            <li>
                <span class="label">
                    <?php echo __('Price', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                    <?php if($data_price['total_price']) echo TravelHelper::format_money($data_price['total_price']); else echo '0'; ?>
                </span>
            </li>
        <?php } ?>

        <li><span class="label"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo TravelHelper::format_money($sale_price); ?></span></li>
        <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && isset($item['data']['extra_price'])): ?>
            <li>
                <span class="label"><?php echo __('Extra Price', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($extra_price); ?></span>
            </li>
        <?php endif; ?>
        <li><span class="label"><?php echo __('Tax', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo STPrice::getTax().' %'; ?></span></li>
        <?php if (STCart::use_coupon()):
            if($price_coupon < 0) $price_coupon = 0;
            ?>
            <li>
                <span class="label text-left">
                    <?php printf(st_get_language('coupon_key'), STCart::get_coupon_code()) ?> <br/>
                    <?php if(st()->get_option('use_woocommerce_for_booking','off') == 'off' && st()->get_option('booking_modal','off') == 'on' ){ ?>
                        <a href="javascript: void(0);" title="" class="ajax-remove-coupon" data-coupon="<?php echo STCart::get_coupon_code(); ?>"><small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</a>
                    <?php }else{ ?>
                        <a href="<?php echo st_get_link_with_search(get_permalink(), array('remove_coupon'), array('remove_coupon' => STCart::get_coupon_code())) ?>"
                           class="danger"><small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</small></a>
                    <?php } ?>
                </span>
                <span class="value">
                        - <?php echo TravelHelper::format_money( $price_coupon ) ?>
                </span>
            </li>
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
            <li>
                <span class="label"><?php echo __('Total', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($price_with_tax); ?></span>
            </li>
            <li>
                <span class="label"><?php echo __('Deposit', ST_TEXTDOMAIN); ?></span>
                <span class="value">
                    <?php echo TravelHelper::format_money($deposit_price); ?>
                </span>
            </li>
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
            <li>
                <span class="label"><?php echo __('Fee', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></span>
            </li>
            <?php } ?>
            <li class="payment-amount">
                <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                <span class="value">
                        <?php echo TravelHelper::format_money($total_price); ?>
                </span>
            </li>

        <?php else: ?>
            <?php if(!empty($item['data']['booking_fee_price'])){
                $price_with_tax = $price_with_tax + $item['data']['booking_fee_price'];
                ?>
                <li>
                    <span class="label"><?php echo __('Fee', ST_TEXTDOMAIN); ?></span>
                    <span class="value"><?php echo TravelHelper::format_money($item['data']['booking_fee_price']); ?></span>
                </li>
            <?php } ?>
            <li class="payment-amount">
                <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($price_with_tax); ?></span>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php
endif;
?>