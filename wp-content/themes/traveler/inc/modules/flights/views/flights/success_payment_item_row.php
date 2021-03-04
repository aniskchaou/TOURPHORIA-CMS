<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 7/7/2017
 * Version: 1.0
 */
$order_token_code = STInput::get('order_token_code');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$object_id = $key;

$rental_link = get_permalink($object_id);
$data_prices = get_post_meta( $order_id , 'data_prices' , true);
$depart_price = floatval($data_prices['sale_price']);
$return_price = floatval($data_prices['return_price']);
$check_in = get_post_meta($order_code, 'depart_date', true);
$check_out = get_post_meta($order_code, 'return_date', true);

$flight_type = get_post_meta($order_code, 'flight_type', true);
$depart_data_location = get_post_meta($order_code, 'depart_data_location', true);
if(!empty($depart_data_location)){
    $item = $depart_data_location['origin_location_full'].' ('.$depart_data_location['origin_iata'].') - '.$depart_data_location['destination_location_full'].' ('.$depart_data_location['destination_iata'].')';

    if($flight_type == 'return'){
        $item .= esc_html__(' (Return)', ST_TEXTDOMAIN);
    }
?>
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td >
        <?php  echo do_shortcode($item); ?>
    </td>
    <td>
        <p><strong><?php echo esc_html__('Depart Flight Price', ST_TEXTDOMAIN) ?></strong> <?php echo TravelHelper::format_money($depart_price); ?></p>
        <p><strong><?php echo esc_html__('Depart Date', ST_TEXTDOMAIN) ?></strong> <?php echo date_i18n(TravelHelper::getDateFormat(), ($check_in)) ?></p>
        <?php
        if(!empty($check_out) && $flight_type == 'return'){
        ?>
            <p><strong><?php echo esc_html__('Return Flight Price', ST_TEXTDOMAIN) ?></strong> <?php echo TravelHelper::format_money($return_price); ?></p>
        <p><strong><?php echo esc_html__('Return Date', ST_TEXTDOMAIN) ?></strong> <?php echo date_i18n(TravelHelper::getDateFormat(), ($check_out)) ?></p>
        <?php } ?>

        <?php st_print_order_item_guest_name($data['data']) ?>
    </td>
</tr>
<?php } ?>