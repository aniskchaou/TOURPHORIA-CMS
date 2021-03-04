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
<?php if(isset($hotel_id) and $hotel_id):?>
<div class="service-section">
    <div class="service-left">
        <h4 class="title"><a href="<?php echo esc_url($hotel_link)?>"><?php echo get_the_title($hotel_id); ?></a></h4>
        <?php
        $address = get_post_meta($hotel_id,'address',true);
        if($address){
        ?>
            <p class="address"><i class="fa fa-map-marker"></i> <?php echo $address; ?></p>
        <?php } ?>
    </div>
    <div class="service-right">
        <?php echo get_the_post_thumbnail($key,array(110,110,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($key ))))?>
    </div>
</div>
<?php endif;?>
<div class="info-section">
    <ul>
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
        <?php if(isset($hotel_id) and $hotel_id):?>
            <?php if($use_agent_info){ ?>
                <li><span class="label"><?php st_the_language('booking_email') ?></span><span class="value"><?php echo get_the_author_meta('user_email',$user_id)?></span></li>
                <li><span class="label"><?php st_the_language('booking_phone') ?></span><span class="value"><?php echo get_user_meta($user_id,'st_phone',true)?></span></li>
            <?php }else{ ?>
                <li><span class="label"><?php st_the_language('booking_email') ?></span><span class="value"><?php echo get_post_meta($hotel_id,'email',true)?></span></li>
                <li><span class="label"><?php st_the_language('booking_phone') ?></span><span class="value"><?php echo get_post_meta($hotel_id,'phone',true)?></span></li>
            <?php } ?>
        <?php endif; ?>
        <li><span class="label"><?php st_the_language('booking_room') ?></span><span class="value"><?php  echo get_the_title($room_id)?></span></li>
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