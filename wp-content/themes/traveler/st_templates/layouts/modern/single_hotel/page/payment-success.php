<?php
$order_code = STInput::get('order_code');
$order_token_code=STInput::get('order_token_code');

if($order_token_code)
{
	$order_code=STOrder::get_order_id_by_token($order_token_code);

}
$user_id = get_current_user_id();


if (!$order_code or get_post_type($order_code) != 'st_order') {
	wp_redirect(home_url('/'));
	exit;
}

$gateway=get_post_meta($order_code,'payment_method',true);
get_header('hotel-activity');
?>
    <div class="st-single-hotel-modern-page">
        <?php echo st()->load_template('layouts/modern/single_hotel/elements/banner'); ?>
		<div class="container">
			<div class="st-checkout-page">
				<?php
				$is_show_infomation_allow = STPaymentGateways::gateway_success_page_validate($gateway);
				if($is_show_infomation_allow) {
					echo STTemplate::message();
					echo st()->load_template('layouts/modern/single_hotel/page/booking_infomation',null,array('order_code'=>$order_code));
				}else{
					echo STTemplate::message();
				}
				?>
			</div>
		</div>
    </div>
<?php
get_footer('hotel-activity');
?>