<?php
$booking_form = st()->load_template( 'hotel/booking_form', false, [
    'field_coupon' => false
] );

echo apply_filters( 'st_booking_form_billing', $booking_form );


?>

<?php if ( defined( 'ICL_LANGUAGE_CODE' ) and ICL_LANGUAGE_CODE ): ?>
    <input type="hidden" name="lang" value="<?php echo esc_attr( ICL_LANGUAGE_CODE ) ?>">
<?php endif; ?>

<?php do_action( 'st_booking_form_field' ) ?>

<div class="payment-form">
    <h4 class="title"><?php echo __('Select Payment Method', ST_TEXTDOMAIN); ?></h4>
    <?php
    if ( !isset( $post_id ) ) $post_id = false;
    STPaymentGateways::get_payment_gateways_html( $post_id ) ?>
</div>

<div class="cond-form">
    <?php echo STCart::get_default_checkout_fields( 'st_check_create_account' ); ?>
    <?php echo STCart::get_default_checkout_fields( 'st_check_term_conditions' ); ?>
</div>

<div class="clearfix">
    <div class="row">
        <div class="col-sm-6">
            <?php if ( st()->get_option( 'booking_enable_captcha', 'on' ) == 'on' ) {
                $code = STCoolCaptcha::get_code();
                ?>
                <div class="form-group captcha_box">
                    <label for="field-hotel-captcha"><?php st_the_language( 'captcha' ) ?></label>
                    <img alt="<?php echo TravelHelper::get_alt_image(); ?>"
                         src="<?php echo STCoolCaptcha::get_captcha_url( $code ) ?>" align="captcha code"
                         class="captcha_img">
                    <input id="field-hotel-captcha" type="text" name="<?php echo esc_attr( $code ) ?>" value=""
                           class="form-control">
                    <input type="hidden" name="st_security_key" value="<?php echo esc_attr( $code ) ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
$cart = STCart::get_carts();
$cart = base64_encode( serialize( $cart ) );
?>

<input type="hidden" name="st_cart" value="<?php echo esc_attr( $cart ); ?>">
<div class="alert form_alert hidden"></div>
<a href="#" onclick="return false"
   class="btn btn-primary btn-checkout btn-st-checkout-submit btn-st-big "><?php _e( 'Submit', ST_TEXTDOMAIN ) ?> <i class="fa fa-spinner fa-spin"></i></a>