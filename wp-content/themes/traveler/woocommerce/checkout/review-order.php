<?php
/**
 * Review order table
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="woocommerce-checkout-review-order-table booking-item-payment">
    <?php
    do_action('woocommerce_review_order_before_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', TRUE, $cart_item, $cart_item_key)) {

            $product_url = '';
            $post_type = FALSE;

            // Traveler
            if (isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data'])) {
                $st_booking_data = $cart_item['st_booking_data'];

                $post_type = isset($st_booking_data['st_booking_post_type']) ? $st_booking_data['st_booking_post_type'] : FALSE;

                $booking_id = isset($st_booking_data['st_booking_id']) ? $st_booking_data['st_booking_id'] : FALSE;
                if ($booking_id)
                    $product_url = get_permalink($booking_id);
            }

            ?>
            <header class="clearfix">
                <a class="booking-item-payment-img" target="_blank" href="<?php echo (!$booking_id)? esc_url($_product->get_permalink($cart_item)):$product_url; ?>">
                    <?php
                    if (isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data'])) {
                        $st_booking_data = $cart_item['st_booking_data'];
                        $booking_id = isset($st_booking_data['st_booking_id']) ? $st_booking_data['st_booking_id'] : FALSE;

                        echo get_the_post_thumbnail($booking_id, 'thumbnail', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));

                    } else {
                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                        if (!$_product->is_visible())
                            echo $thumbnail;
                        else
                            echo $thumbnail;
                    }
                    ?>
                </a>
                <h5 class="booking-item-payment-title">
                    <?php
                    if (!$_product->is_visible())
                        echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;';
                    else
                        echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" target="_blank">%s </a>', $product_url, $_product->get_title()), $cart_item, $cart_item_key);

                    // Meta data
                    echo wc_get_formatted_cart_item_data($cart_item);

                    // Backorder notification
                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                        echo '<p class="backorder_notification">' . __('Available on backorder', ST_TEXTDOMAIN) . '</p>';
                    ?>
                </h5>
                <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>

            </header>

        <?php
        }
    }

    do_action('woocommerce_review_order_after_cart_contents');
    ?>
    <ul class="booking-item-payment-details">
        <li>
            <ul class="booking-item-payment-price">
                <li>
                    <p class="booking-item-payment-price-title"><?php _e('Subtotal', ST_TEXTDOMAIN); ?>

                    </p>

                    <p class="booking-item-payment-price-amount"><?php wc_cart_totals_subtotal_html(); ?></p>
                </li>
                <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>

                    <li>
                        <p class="booking-item-payment-price-title"><?php wc_cart_totals_coupon_label($coupon); ?>

                        </p>

                        <p class="booking-item-payment-price-amount"><?php wc_cart_totals_coupon_html($coupon); ?></p>
                    </li>
                <?php endforeach; ?>

                <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

                    <?php do_action('woocommerce_review_order_before_shipping'); ?>

                    <?php wc_cart_totals_shipping_html(); ?>

                    <?php do_action('woocommerce_review_order_after_shipping'); ?>

                <?php endif; ?>

                <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                    <li>
                        <p class="booking-item-payment-price-title"><?php echo esc_html($fee->name); ?>

                        </p>

                        <p class="booking-item-payment-price-amount"><?php wc_cart_totals_fee_html($fee); ?></p>
                    </li>
                <?php endforeach; ?>

                <?php if (WC()->cart->tax_display_cart === 'excl') : ?>
                    <?php if (get_option('woocommerce_tax_total_display') === 'itemized') : ?>
                        <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
                            <li class="tax-rate tax-rate-<?php echo sanitize_title($code); ?>">
                                <p class="booking-item-payment-price-title"><?php echo esc_html($tax->label); ?>

                                </p>

                                <p class="booking-item-payment-price-amount"><?php echo wp_kses_post($tax->formatted_amount); ?></p>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="tax-total">
                            <p class="booking-item-payment-price-title"><?php echo esc_html(WC()->countries->tax_or_vat()); ?>

                            </p>

                            <p class="booking-item-payment-price-amount"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></p>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>


            </ul>
        </li>
    </ul>
    <?php do_action('woocommerce_review_order_before_order_total'); ?>

    <p class="booking-item-payment-total"><?php _e('Total', ST_TEXTDOMAIN); ?>:
        <span><?php wc_cart_totals_order_total_html(); ?></span>
    </p>

    <?php do_action('woocommerce_review_order_after_order_total'); ?>

</div>