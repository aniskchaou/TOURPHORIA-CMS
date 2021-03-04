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

$car_id = $data['data']['car_id'];
$check_in = $data['data']['check_in'];
$check_in_time = $data['data']['check_in_time'];
$check_out = $data['data']['check_out'];
$check_out_time = $data['data']['check_out_time'];
$roundtrip = $data['data']['roundtrip'];
$extras = $data['data']['extras'];

$date_diff = STDate::dateDiff($check_in,$check_out);

$passenger = intval($data['data']['passenger']);
$currency = get_post_meta($order_code, 'currency', true);

$transfer_from = $data['data']['pick_up'];
$transfer_to = $data['data']['drop_off'];
?>
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td>
        <a href="<?php echo esc_url(get_the_permalink( $car_id ))?>" target="_blank">

        <?php echo get_the_post_thumbnail($car_id,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($car_id ))))?>
        </a>
    </td>
    <td>
        <?php if(isset($car_id) and $car_id):?>
            <?php
            $theme_option=st()->get_option('partner_show_contact_info');
            $metabox=get_post_meta($car_id,'show_agent_contact_info',true);
            $use_agent_info=FALSE;
            if($theme_option=='on') $use_agent_info=true;
            if($metabox=='user_agent_info') $use_agent_info=true;
            if($metabox=='user_item_info') $use_agent_info=FALSE;
            $obj_car = get_post( $car_id );
            $user_id = $obj_car->post_author;
            ?>
        <?php if($use_agent_info){ ?>

            <p style="margin-top:10px;"><strong> <?php echo __('Journey', ST_TEXTDOMAIN) ?>:</strong> <?php echo esc_html($transfer_from . ' - '. $transfer_to); ?></p>
            <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($car_id,'cars_address',true)?> </p>
            <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_the_author_meta('user_email',$user_id)?> </p>
            <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_user_meta($user_id,'st_phone',true)?> </p>
        <?php }else{ ?>
            <p style="margin-top:10px;"><strong> <?php echo __('Journey', ST_TEXTDOMAIN) ?>:</strong> <?php echo esc_html($transfer_from . ' - '. $transfer_to); ?></p>
            <p><strong><?php st_the_language('booking_address') ?></strong> <?php echo get_post_meta($car_id,'cars_address',true)?> </p>
            <p><strong><?php st_the_language('booking_email') ?></strong> <?php echo get_post_meta($car_id,'cars_email',true)?> </p>
            <p><strong><?php st_the_language('booking_phone') ?></strong> <?php echo get_post_meta($car_id,'cars_phone',true)?> </p>
        <?php } ?>
        <?php endif;?>
        <p><strong><?php echo __('Arrival Date', ST_TEXTDOMAIN) ?>:</strong>
            <?php echo date(TravelHelper::getDateFormat(), strtotime($check_in)); ?>
	        <?php echo date(' H:i:s', strtotime($check_in_time)); ?>
        </p>
        <?php if(!empty($roundtrip)){ ?>
        <p><strong><?php echo __('Departure Date', ST_TEXTDOMAIN) ?>:</strong>
	        <?php echo date(TravelHelper::getDateFormat(), strtotime($check_out)); ?>
	        <?php echo date(' H:i:s', strtotime($check_out_time)); ?>
        </p>
        <?php } ?>
        <p><strong><?php echo __('Passengers', ST_TEXTDOMAIN) ?>:</strong> <?php echo esc_html($passenger); ?></p>
        <?php 
            $time = $data['data']['distance'];
            if(!empty($time)):
        ?>
        <p><strong><?php echo __('Estimated Time', ST_TEXTDOMAIN) ?></strong> 
            <?php
                $hour = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', ST_TEXTDOMAIN ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', ST_TEXTDOMAIN );
                $minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', ST_TEXTDOMAIN ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', ST_TEXTDOMAIN );
                echo esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . $time['distance'] . __('Km', ST_TEXTDOMAIN);
            ?>
        </p>
        <?php endif; ?>
        <?php
        if(!empty($extras) and is_array($extras)){
            ?>
            <p><strong><?php echo __('Extra services', ST_TEXTDOMAIN) ?></strong></p>
            <?php
            echo '<p>';
            foreach ($extras as $k => $v){
                echo '&nbsp; &nbsp; &nbsp; ' . $v['title'] . ' ('. TravelHelper::format_money($v['price']) .') x ' . $v['number'] . ' ' . ($v['number'] > 1 ? __('items', ST_TEXTDOMAIN) : __('item', ST_TEXTDOMAIN)) . '<br />';
            }
            echo '</p>';
        }
        ?>
        <?php st_print_order_item_guest_name($data['data']) ?>
    </td>
</tr>