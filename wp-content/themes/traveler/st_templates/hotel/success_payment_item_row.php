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

$data_prices = get_post_meta( $order_id , 'data_prices' , true);

$price = floatval($data_prices['sale_price']);

$hotel_link='';
if(isset($hotel_id) and $hotel_id){
    $hotel_link = get_permalink($hotel_id);
}
$currency = get_post_meta($order_code, 'currency', true);

?>
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td>
        <a href="<?php echo esc_url($hotel_link)?>" target="_blank">

        <?php echo get_the_post_thumbnail($key,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($key ))))?>
        </a>
    </td>
    <td>
        <?php if(isset($hotel_id) and $hotel_id):?>
            <?php
            $theme_option=st()->get_option('partner_show_contact_info');
            $metabox=get_post_meta($hotel_id,'show_agent_contact_info',true);
            $use_agent_info=FALSE;
            if($theme_option=='on') $use_agent_info=true;
            if($metabox=='user_agent_info') $use_agent_info=true;
            if($metabox=='user_item_info') $use_agent_info=FALSE;
            $obj_hotel = get_post( $hotel_id );
            $user_id = $obj_hotel->post_author;
            ?>
        <?php if($use_agent_info){ ?>

            <p style="margin-top:10px;"><strong> <?php st_the_language('hotel') ?>:</strong> <a href="<?php echo esc_url($hotel_link)?>" target="_blank"><?php echo strtoupper( get_the_title($hotel_id))?> </a></p>
            <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($hotel_id,'address',true)?> </p>
            <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_the_author_meta('user_email',$user_id)?> </p>
            <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_user_meta($user_id,'st_phone',true)?> </p>
        <?php }else{ ?>
            <p style="margin-top:10px;"><strong> <?php st_the_language('hotel') ?>:</strong> <a href="<?php echo esc_url($hotel_link)?>" target="_blank"><?php echo strtoupper( get_the_title($hotel_id))?> </a></p>
            <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($hotel_id,'address',true)?> </p>
            <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_post_meta($hotel_id,'email',true)?> </p>
            <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_post_meta($hotel_id,'phone',true)?> </p>
        <?php } ?>


        <?php endif;?>

        <p><strong><?php st_the_language('booking_room') ?></strong> <?php  echo get_the_title($room_id)?></p>
        <p><strong><?php _e('Number of rooms',ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($number_room)?></p>
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