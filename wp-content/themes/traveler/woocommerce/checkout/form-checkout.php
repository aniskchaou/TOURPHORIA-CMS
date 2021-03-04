<?php
/**
 * Checkout Form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wc_print_notices();

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);


// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', ST_TEXTDOMAIN));

    return;
}


// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', wc_get_checkout_url()); ?>

<?php do_action('woocommerce_before_checkout_form', $checkout); ?>
<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url($get_checkout_url); ?>" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">

            <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="col2-set" id="customer_details">
                    <div class="">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>


                        <?php
                         if(st()->get_option('woo_checkout_show_shipping')=='on'){
                             echo '<hr>';
                             echo '<div class="">';
                             do_action( 'woocommerce_checkout_shipping' );
                             echo '</div>';
                         } ?>

                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>


            <?php endif; ?>

            <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
            <div id="order_review" class="woocommerce-checkout-review-order mt20">
                <?php woocommerce_checkout_payment() ?>
            </div>
        </div>

        <div class="col-sm-4">

            <?php do_action('woocommerce_checkout_before_order_review'); ?>


            <?php do_action('woocommerce_checkout_order_review'); ?>


            <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
    </div>

</form>



