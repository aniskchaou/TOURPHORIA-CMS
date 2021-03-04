<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel payment item row
 *
 * Created by ShineTheme
 *
 */
$order_token_code = STInput::get('order_token_code');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$hotel_id = $key;

$object_id = $key;
$total = 0;

$room_id = $data['data']['room_id'];

$check_in = $data['data']['check_in'];

$check_out = $data['data']['check_out'];

$number_room = intval($data['number']);

$price = floatval(get_post_meta($room_id, 'price', true));

$room_link='';
if(isset($room_id) and $room_id){
    $room_link = get_permalink($room_id);
}
$currency = get_post_meta($order_code, 'currency', true);

?>
<div class="service-section">
    <div class="service-left">
        <h4 class="title"><a href="<?php echo esc_url($room_link)?>"><?php echo get_the_title($room_id); ?></a></h4>
        <?php
        $address = get_post_meta($room_id,'address',true);
        if($address){
        ?>
            <p class="address"><i class="fa fa-map-marker"></i> <?php echo $address; ?></p>
        <?php } ?>
    </div>
    <div class="service-right">
        <?php echo get_the_post_thumbnail($object_id,array(110,110,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($object_id ))))?>
    </div>
</div>
<div class="info-section">
    <ul>
        <li><span class="label"><?php _e('Number of rooms',ST_TEXTDOMAIN) ?></span><span class="value"><?php echo esc_html($number_room)?></span></li>
        <li><span class="label"><?php st_the_language('booking_check_in') ?></span><span class="value"><?php echo date(TravelHelper::getDateFormat(), strtotime($check_in)); ?></span></li>
        <li><span class="label"><?php st_the_language('booking_check_out') ?></span><span class="value"><?php echo date(TravelHelper::getDateFormat(), strtotime($check_out)); ?></span></li>
        <li><span class="label"><?php st_the_language('booking_price') ?></span>
            <span class="value">
                <?php
                echo TravelHelper::format_money_from_db($price,$currency);
                ?>
            </span>
        </li>
        <?php
        $extras = get_post_meta($order_code, 'extras', true);
        if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])):
        ?>
            <li><span class="label"><?php echo __('Extra:', ST_TEXTDOMAIN); ?></span>
                <span class="value">

                </span>
            </li>
            <li class="extra-value">
                <?php
                    foreach ($extras['value'] as $name => $number):
                        $price_item = floatval($extras['price'][$name]);
                        if ($price_item <= 0) $price_item = 0;
                        $number_item = intval($extras['value'][$name]);
                        if ($number_item <= 0) $number_item = 0;
                        if ($number_item > 0) {
                            ?>
                            <span>
                    <?php echo $extras['title'][$name] . ' (' . TravelHelper::format_money($price_item) . ') x ' . $number_item . ' ' . __('Item(s)', ST_TEXTDOMAIN); ?>
                </span> <br/>
                            <?php
                        }
                    endforeach;
                ?>
            </li>
        <?php endif; ?>
        <li class="guest-value">
            <?php st_print_order_item_guest_name($data['data']) ?>
        </li>
    </ul>
</div>