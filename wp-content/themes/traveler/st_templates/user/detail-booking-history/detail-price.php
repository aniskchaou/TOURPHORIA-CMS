<?php
$currency = get_post_meta( $order_id, 'currency', true );
$data_price = get_post_meta( $order_id , 'data_prices' , true);
$discount_rate = get_post_meta($order_id, 'discount_rate', true);
$pay_amount = isset($data_price['total_price']) ? $data_price['total_price'] : 0;
$deposit_status = get_post_meta($order_id, 'deposit_money', true);
$deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
$booking_fee_price = isset($data_price['booking_fee_price']) ? $data_price['booking_fee_price'] : 0;
$total_order = $order_data['total_order'];
if(!empty($booking_fee_price)){
    $total_order =$total_order-$booking_fee_price;
}
$price_total_with_tax = STPrice::getTotalPriceWithTaxInOrder($total_order,$order_id);
?>
<div class="line col-md-12"></div>
<?php $subtotal = get_post_meta($order_id, 'ori_price', true); ?>
<div class="col-md-12">
    <strong><?php esc_html_e("Subtotal: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo TravelHelper::format_money_from_db($subtotal ,$currency); ?></strong>
    </div>
</div>
<?php $coupon_price = isset($data_price['coupon_price']) ? $data_price['coupon_price'] : 0; ?>
<div class="col-md-12 <?php if(empty($coupon_price)) echo "hide"; ?>">
    <strong><?php esc_html_e("Coupon: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo TravelHelper::format_money_from_db($coupon_price ,$currency); ?></strong>
    </div>
</div>
<div class="col-md-12">
    <strong><?php esc_html_e("Tax: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <?php
        $tax = intval(get_post_meta($order_id, 'st_tax_percent', true));
        if (!empty($tax)) {
            echo esc_html($tax." %");
        }else{
            echo esc_html($tax);
        }
        ?>
    </div>
</div>
<?php
if(is_array($deposit_status) && !empty($deposit_status['type']) && floatval($deposit_status['amount']) > 0){
    ?>
    <?php if(!empty($price_total_with_tax)){ ?>
        <div class="col-md-12">
            <strong><?php esc_html_e("Total: ",ST_TEXTDOMAIN) ?></strong>
            <div class="pull-right">
                <strong><?php echo TravelHelper::format_money_from_db($price_total_with_tax ,$currency); ?></strong>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-12">
        <strong><?php esc_html_e("Deposit: ",ST_TEXTDOMAIN) ?></strong>
        <div class="pull-right">
            <strong><?php echo TravelHelper::format_money_from_db($deposit_price ,$currency); ?></strong>
        </div>
    </div>
    <?php
    if(!empty($booking_fee_price)){
        ?>
        <div class="col-md-12">
            <strong><?php esc_html_e("Fee: ",ST_TEXTDOMAIN) ?></strong>
            <div class="pull-right">
                <strong><?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?></strong>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-12">
        <strong><?php esc_html_e("Pay Amount: ",ST_TEXTDOMAIN) ?></strong>
        <div class="pull-right">
            <strong><?php echo TravelHelper::format_money_from_db($pay_amount ,$currency); ?></strong>
        </div>
    </div>
    <?php
}else{
    ?>
    <div class="col-md-12">
        <strong><?php esc_html_e("Total: ",ST_TEXTDOMAIN) ?></strong>
        <div class="pull-right">
            <strong><?php echo TravelHelper::format_money_from_db($price_total_with_tax ,$currency); ?></strong>
        </div>
    </div>
    <?php if(!empty($booking_fee_price)){
        ?>
        <div class="col-md-12">
            <strong><?php esc_html_e("Fee: ",ST_TEXTDOMAIN) ?></strong>
            <div class="pull-right">
                <strong><?php echo TravelHelper::format_money_from_db($booking_fee_price ,$currency); ?></strong>
            </div>
        </div>
    <?php } ?>
    <div class="col-md-12">
        <strong><?php esc_html_e("Pay Amount: ",ST_TEXTDOMAIN) ?></strong>
        <div class="pull-right">
            <strong><?php echo TravelHelper::format_money_from_db($pay_amount ,$currency); ?></strong>
        </div>
    </div>
    <?php
}
?>