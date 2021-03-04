<?php
    /*
     * Template Name: Payment Success
    */
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Template Name : Payment success
     *
     * Created by ShineTheme
     *
     */
$hotel_parent = st()->get_option('hotel_alone_assign_hotel');
if(!empty($hotel_parent)){
    echo st()->load_template('layouts/modern/single_hotel/page/payment-success');
    return;
}

if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/payment-success');
    return;
}

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

    $key = get_post_meta($order_code, 'item_id', true);
    $post_type = get_post_type($key);

    $gateway=get_post_meta($order_code,'payment_method',true);

    get_header();
    
?>
    <div class="gap"></div>
    <div class="container">

<?php
    // Booking Content
    $is_show_infomation_allow = STPaymentGateways::gateway_success_page_validate($gateway);

    if($is_show_infomation_allow){
        echo STTemplate::message();
        echo st()->load_template('booking_infomation',null,array('order_code'=>$order_code));
    }else{
        echo STTemplate::message();
    }

?>

    </div>
<?php
    get_footer();