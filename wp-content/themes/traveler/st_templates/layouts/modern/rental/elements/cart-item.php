<?php
if(isset($item_id) and $item_id):
    $item = STCart::find_item($item_id);
    $hotel = $item_id;

    $check_in = $item['data']['check_in'];
    $check_out = $item['data']['check_out'];

    $date_diff = STDate::dateDiff($check_in,$check_out);

    $extras = isset($item['data']['extras']) ? $item['data']['extras'] : array();
    $adult_number = intval($item['data']['adult_number']);
    $child_number = intval($item['data']['child_number']);
?>
<div class="service-section">
    <div class="service-left">
        <h4 class="title"><a href="<?php echo get_permalink($hotel)?>"><?php echo get_the_title($hotel)?></a></h4>
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
        <?php echo get_the_post_thumbnail($hotel,array(110,110,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($hotel )), 'class' => 'img-responsive'));?>
    </div>
</div>
<div class="info-section">
    <ul>
        <li><span class="label"><?php echo __('Name', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo get_the_title($item_id)?></span></li>
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
        <li class="ad-info">
            <ul>
                <li><span class="label"><?php echo __('Number of Night', ST_TEXTDOMAIN); ?></span><span class="value">
                        <?php
                        if($date_diff>1){
                            printf(__('%d Nights', ST_TEXTDOMAIN),$date_diff);
                        }else{
                            printf(__('%d Night', ST_TEXTDOMAIN),$date_diff);
                        }
                        ?>
                    </span></li>
                <?php if($adult_number) {?>
                <li><span class="label"><?php echo __('Number of Adult', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo $adult_number; ?></span></li>
                <?php } ?>
                <?php if($child_number) {?>
                    <li><span class="label"><?php echo __('Number of Children', ST_TEXTDOMAIN); ?></span><span class="value"><?php echo $child_number; ?></span></li>
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
    $number_room = intval($item['number']);
    $numberday = STDate::dateDiff($check_in, $check_out);
    $item_price = STPrice::getRentalPriceOnlyCustomPrice($item_id, strtotime($check_in), strtotime($check_out));
    $price =  $item_price;
    $sale_price = STPrice::getSalePrice($item_id, strtotime($check_in), strtotime($check_out));
    $extra_price = isset($item['data']['extra_price']) ? floatval($item['data']['extra_price']) : 0;
    $price_coupon = floatval(STCart::get_coupon_amount());
    $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price);
    $price_with_tax -= $price_coupon;
    ?>
    <ul>
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