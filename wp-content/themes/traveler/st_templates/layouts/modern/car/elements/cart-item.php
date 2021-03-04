<?php
if (isset($item_id) and $item_id):
    $item = STCart::find_item($item_id);
    $tour = $item_id;

    $check_in = $item['data']['check_in'];
    $check_out = $item['data']['check_out'];

    $extras = isset($item['data']['data_equipment']) ? $item['data']['data_equipment'] : array();
    ?>
    <div class="service-section">
        <div class="service-left">
            <h4 class="title"><a href="<?php echo get_permalink($tour) ?>"><?php echo get_the_title($tour) ?></a></h4>
            <?php
            $address = get_post_meta($item_id, 'cars_address', true);
            if ($address):
                ?>
                <p class="address"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo esc_html($address); ?> </p>
            <?php
            endif;
            ?>
        </div>
        <div class="service-right">
            <?php echo get_the_post_thumbnail($tour, array(110, 110, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($tour)), 'class' => 'img-responsive')); ?>
        </div>
    </div>
    <div class="info-section">
        <ul>
            <li>
                <span class="label">
                    <?php echo __('Car type', ST_TEXTDOMAIN); ?>
                </span>
                <span class="value">
                     <?php
                     $cartype = get_the_terms($tour, 'st_category_cars');
                     if (!is_wp_error($cartype) && !empty($cartype)) {
                         $cartype_html = '';
                         foreach ($cartype as $type) {
                             $cartype_html .= $type->name . ', ';
                         }
                         if (!empty($cartype_html)) {
                             echo substr($cartype_html, 0, -2);
                         }
                     }
                     ?>
                </span>
            </li>
            <!--Add Info-->
            <li>
                <span class="label"><?php echo __('Pick Up From', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo esc_html($item['data']['pick_up']); ?></span>
            </li>
            <li>
                <span class="label"><?php echo __('Drop Off To', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo esc_html($item['data']['drop_off']); ?></span>
            </li>
            <li>
                <span class="label"><?php echo __('Est. Distance', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo round($item['data']['data_destination'], 2); ?><?php echo strtolower(STCars::get_price_unit('label')) ?></span>
            </li>
            <li>
                <span class="label"><?php echo __('Date', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo date(TravelHelper::getDateFormat() . ', H:i A', $item['data']['check_in_timestamp']); ?> - <?php echo date(TravelHelper::getDateFormat() . ', H:i A', $item['data']['check_out_timestamp']); ?></span>
            </li>

            <?php if (isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
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
                <?php $code = STInput::post('coupon_code') ? STInput::post('coupon_code') : STCart::get_coupon_code(); ?>
                <input id="field-coupon_code" value="<?php echo esc_attr($code); ?>" type="text" name="coupon_code"/>
                <input type="hidden" name="st_action" value="apply_coupon">
                <?php if (st()->get_option('use_woocommerce_for_booking', 'off') == 'off' && st()->get_option('booking_modal', 'off') == 'on') { ?>
                    <input type="hidden" name="action" value="ajax_apply_coupon">
                    <button type="submit"
                            class="btn btn-primary add-coupon-ajax"><?php echo __('APPLY', ST_TEXTDOMAIN); ?></button>
                    <div class="alert alert-danger hidden"></div>
                <?php } else { ?>
                    <button type="submit" class="btn btn-primary"><?php echo __('APPLY', ST_TEXTDOMAIN); ?></button>
                <?php } ?>
            </div>
        </form>
    </div>
    <div class="total-section">
        <ul>
            <li>
                <span class="label"><?php echo __('Subtotal', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($item['data']['sale_price']) ?></span>
            </li>
            <?php if ($item['data']['price_equipment']): ?>
                <li>
                    <span class="label"><?php echo __('Extra ', ST_TEXTDOMAIN); ?></span>
                    <span class="value"><?php echo TravelHelper::format_money($item['data']['price_equipment']) ?></span>
                </li>
            <?php endif; ?>
            <li><span class="label"><?php echo __('Tax', ST_TEXTDOMAIN); ?></span><span
                        class="value"><?php echo STPrice::getTax() . ' %'; ?></span></li>
            <?php
            $price_coupon = 0;
            $price_with_tax = (float)$item['data']['price_with_tax'];
            if (STCart::use_coupon()):
                $price_coupon = floatval(STCart::get_coupon_amount());
                if ($price_coupon < 0) $price_coupon = 0;
                $price_with_tax -= $price_coupon;
                ?>
                <li>
                <span class="label text-left">
                    <?php printf(st_get_language('coupon_key'), STCart::get_coupon_code()) ?> <br/>
                    <?php if (st()->get_option('use_woocommerce_for_booking', 'off') == 'off' && st()->get_option('booking_modal', 'off') == 'on') { ?>
                        <a href="javascript: void(0);" title="" class="ajax-remove-coupon"
                           data-coupon="<?php echo STCart::get_coupon_code(); ?>"><small
                                    class='text-color'>(<?php st_the_language('Remove coupon') ?> )</a>
                    <?php } else { ?>
                        <a href="<?php echo st_get_link_with_search(get_permalink(), array('remove_coupon'), array('remove_coupon' => STCart::get_coupon_code())) ?>"
                           class="danger"><small class='text-color'>(<?php st_the_language('Remove coupon') ?> )</small></a>
                    <?php } ?>
                </span>
                    <span class="value">
                        - <?php echo TravelHelper::format_money($price_coupon) ?>
                </span>
                </li>
            <?php endif; ?>
            <li class="payment-amount">
                <span class="label"><?php echo __('Pay Amount', ST_TEXTDOMAIN); ?></span>
                <span class="value"><?php echo TravelHelper::format_money($price_with_tax); ?></span>
            </li>
        </ul>
    </div>
<?php
endif;
?>