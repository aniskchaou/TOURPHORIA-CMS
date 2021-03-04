<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity payment success
 *
 * Created by ShineTheme
 *
 */

$order_token_code = STInput::get('order_token_code', '');

if($order_token_code){
    $order_code = STOrder::get_order_id_by_token($order_token_code);
}

$object_id = $key;

$check_in = get_post_meta($order_code, 'check_in', true) ; 
$check_out = get_post_meta($order_code, 'check_out', true);
$starttime = get_post_meta($order_code, 'starttime', true);
$data_prices = get_post_meta($order_code, 'data_prices', true);
$type_activity = get_post_meta($order_code,'type_activity',true);
$adult_number = intval(get_post_meta($order_code, 'adult_number', true));
$child_number = intval(get_post_meta($order_code, 'child_number', true));
$infant_number = intval(get_post_meta($order_code, 'infant_number', true));
$link='';
if(isset($object_id) && $object_id){
    $link = get_permalink($object_id);
}
?>
<tr>
    <td><?php echo esc_html($i+1) ?></td>
    <td>
        <a href="<?php echo esc_url($link)?>" target="_blank">
        <?php echo get_the_post_thumbnail($key,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image($key)))?>
        </a>
    </td>
    <td>
        <?php if($address=get_post_meta($object_id,'address',true)){?>
        <p><strong><?php esc_html_e('Address :','traveler') ?></strong> <?php echo esc_html($address)?> </p>
        <?php }?>
        <?php if($contact_email=get_post_meta($object_id,'contact_email',true)){?>
        <p><strong><?php esc_html_e('Email :','traveler') ?></strong> <?php echo esc_html($contact_email)?> </p>
        <?php }?>
        <p><strong><?php _e("Activity",ST_TEXTDOMAIN) ?>:</strong> <?php  echo get_the_title($object_id)?></p>
        <p><strong><?php esc_html_e('Maximum number of people','traveler') ?>: </strong> <?php
            $max_people =  get_post_meta($object_id,'max_people',true);
            if( (int) $max_people == 0 ){
                $max_people = __('Unlimited', ST_TEXTDOMAIN);
            }
            echo esc_html($max_people);
        ?> </p>
        <?php if($adult_number){?>
        <p><strong><?php _e('Number of Adult',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo esc_html($adult_number); ?>
        </p>
        <?php } ?>
        <?php if($child_number){?>
        <p><strong><?php _e('NUmber of Children',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo esc_html($child_number); ?>
        </p>
        <?php }?>
        <?php if($infant_number){?>
        <p><strong><?php _e('Number of Infant',ST_TEXTDOMAIN) ?>: </strong>
            <?php echo esc_html($infant_number); ?>
        </p>
        <?php }?>
        <p><strong><?php esc_html_e('Date','traveler') ?> : </strong>
            <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?> -
            <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)); ?>
            <?php echo ($starttime != '' && isset($starttime)) ? ' - ' . $starttime : '';   ?>
        </p>
        <?php st_print_order_item_guest_name($data['data']) ?>
    </td>
