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
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td>
        <a href="<?php echo esc_url($room_link)?>" target="_blank">

        <?php echo get_the_post_thumbnail($object_id,array(360,270,'bfi_thumb'=>false),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($object_id ))))?>
        </a>
    </td>
    <td>
        <p style="margin-top:10px;"><strong> <?php st_the_language('booking_room') ?></strong> <a href="<?php echo esc_url($room_link)?>" target="_blank"><?php echo strtoupper( get_the_title($room_id))?> </a></p>
        <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($room_id,'address',true)?> </p>
        <p><strong><?php _e('Number of rooms',ST_TEXTDOMAIN) ?>:</strong> <?php echo esc_html($number_room)?></p>
        <p><strong><?php st_the_language('booking_price') ?></strong> <?php
            echo TravelHelper::format_money_from_db($price,$currency);
            ?></p>
        <p><strong><?php st_the_language('booking_check_in') ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime($check_in)); ?></p>
        <p><strong><?php st_the_language('booking_check_out') ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime($check_out)); ?></p>
        <?php 
            $extras = get_post_meta($order_code, 'extras', true); 
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])):
        ?>
        <p>
            <strong><?php echo __('Extra:' , ST_TEXTDOMAIN) ;  ?></strong>
        </p>
        <p>    
        <?php        
            foreach($extras['value'] as $name => $number):
                $price_item = floatval($extras['price'][$name]);
                if($price_item <= 0) $price_item = 0;
                $number_item = intval($extras['value'][$name]);
                if($number_item <= 0) $number_item = 0;
                if($number_item > 0){
        ?>
            <span>
                <?php echo esc_html($extras['title'][$name]).' ('.TravelHelper::format_money($price_item).') x '.$number_item.' '.__('Item(s)', ST_TEXTDOMAIN); ?>
            </span> <br />
            
        <?php } endforeach; ?>
        </p>

        <?php endif; ?>


        <?php st_print_order_item_guest_name($data['data']) ?>
        
    </td>
</tr>