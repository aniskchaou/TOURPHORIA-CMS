<?php
$woo_order_id = $order_data['order_item_id'];
$order = wc_get_order( $order_id );
$total = $tax = $sub_total = 0;
$data_price = STUser_f::_get_price_item_order_woo($woo_order_id);

//Add fee to detail booking
foreach ( $order->get_items() as $key => $item ) {
    $fee_price = wc_get_order_item_meta( $key, '_st_booking_fee_price' );
}

if(!empty($data_price)){
    if($fee_price > 0){
        $total = $data_price[0]['meta_value'] + $data_price[1]['meta_value'] + $fee_price;
    }else{
        $total = $data_price[0]['meta_value'] + $data_price[1]['meta_value'];
    }

    $tax = $data_price[1]['meta_value'];
    $sub_total = $data_price[0]['meta_value'];
} ?>
<div class="line col-md-12"></div>
<div class="col-md-12">
    <strong><?php esc_html_e("Sub Total: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo wc_price($sub_total,array( 'currency' => $order->get_currency())); ?></strong>
    </div>
</div>
<div class="col-md-12">
    <strong><?php esc_html_e("Tax: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo wc_price($tax,array( 'currency' => $order->get_currency())); ?></strong>
    </div>
</div>
<?php if($fee_price > 0){ ?>
<div class="col-md-12">
    <strong><?php esc_html_e("Fee: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo wc_price($fee_price,array( 'currency' => $order->get_currency())); ?></strong>
    </div>
</div>
<?php } ?>
<div class="line col-md-12"></div>
<div class="col-md-12">
    <strong><?php esc_html_e("Pay Amount: ",ST_TEXTDOMAIN) ?></strong>
    <div class="pull-right">
        <strong><?php echo wc_price($total,array( 'currency' => $order->get_currency())) ?></strong>
    </div>
</div>
