<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Email booking information
 *
 * Created by ShineTheme
 *
 */

if(!isset($order_id)) return false;
    $order_code = $order_id;
if(!isset($made_by_admin)) $made_by_admin = false;  

$first_name=get_post_meta($order_id,'st_first_name',true);
$last_name=get_post_meta($order_id,'st_last_name',true);
echo st()->load_template('email/header',null,array('email_title'=>__('Booking Information' , ST_TEXTDOMAIN)));

$main_color =st()->get_option('main_color','#ed8323');

$post_id =  get_post_meta($order_id,'item_id',true);

$room_id = intval(get_post_meta($order_id, 'room_id', true));

$deposit_money  = get_post_meta($order_id,'deposit_money',true);

$check_in = get_post_meta($order_id, 'check_in', true);
$check_in = date('Y-m-d', strtotime($check_in));

$check_out = get_post_meta($order_id, 'check_out', true);
$check_out = date('Y-m-d', strtotime($check_out));


$currency = get_post_meta($order_id, 'currency', true);
?>
<tr style="background: white">
    <td colspan="10" style="padding: 10px;">
<?php if(!isset($send_to_admin)):?>
    <h3 style="margin-top: 30px; padding-top: 10px;">
    <?php 
        if($made_by_admin):
    ?>
    <?php printf(__('Dear' , ST_TEXTDOMAIN).' <strong>%s</strong>',$first_name.' '.$last_name)?>,
    <?php else: ?>
    <?php printf(__('Hi' , ST_TEXTDOMAIN).' <strong>%s</strong>',$first_name.' '.$last_name)?>,
    <br>
    <p><?php echo __('Thank you for booking with us. Below are your booking details:' , ST_TEXTDOMAIN) ;  ?></p>
    <?php endif; ?>
    </h3>
    <?php 
    if($made_by_admin):
    ?>
    <?php printf(__('As you required us to booking "%s".', ST_TEXTDOMAIN), get_the_title($post_id)); ?>
    <br />
    <?php echo __('Now our system make a booking for you with info below:', ST_TEXTDOMAIN); ?>
    <?php endif; ?>
<?php endif;?>
        <p><strong><?php echo __('Booking Number :' , ST_TEXTDOMAIN) ; ?></strong> <?php echo esc_html($order_id)?></p>
        <p><strong><?php echo __('Booking Date :' , ST_TEXTDOMAIN) ; ?></strong> <?php echo get_the_time(TravelHelper::getDateFormat(),$order_id)?></p>
        <p><strong><?php echo __('Payment Method :' , ST_TEXTDOMAIN) ; ?></strong> <?php

            echo STPaymentGateways::get_gatewayname(get_post_meta($order_id,'payment_method',true));

            ?></p>

<table cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;
"
                >
                    *
            </td>
            <td style=" border-left: 1px solid #bcbcbc; border-top: 1px solid #bcbcbc; border-bottom: 1px solid #bcbcbc; padding: 6px; background: #e4e4e4;">
                <?php echo __('Item :' , ST_TEXTDOMAIN) ;  ?>
            </td>
            <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;border-right: 1px solid #bcbcbc;">
                <?php echo __('Information: ' , ST_TEXTDOMAIN) ;  ?>
            </td>
        </tr>
        <?php
        $total = 0;
        $i = 0;
            $i++;


            $object_id           = get_post_meta($order_id,'item_id',true);
            $hotel_id            = $object_id;
            
            $check_in            = get_post_meta($order_id,'check_in',true);
            $check_out           = get_post_meta($order_id,'check_out',true);
            $number              = get_post_meta($order_id,'item_number',true);
            $price               = get_post_meta($order_id,'item_price',true);
            $extras = get_post_meta($order_id, 'extras', true);
            $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
            if(!$number) $number = 1;

            $total = get_post_meta($order_id,'total_price',true);

            $hotel_link = '';
            if(isset($hotel_id) and $hotel_id){
                $hotel_link=get_permalink($hotel_id);
            }
            ?>
            <tr>
                <td style="padding: 6px;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;" valign="top" align="center" width="5%">
                    <?php echo esc_html($i) ?>
                </td>
                <td width="35%" style="vertical-align: top;padding: 6px;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;">
                    <a href="<?php echo esc_url($hotel_link)?>" target="_blank">
                    <?php echo get_the_post_thumbnail($object_id,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($object_id ))))?>
                    </a>
                </td >
                <td style="padding: 6px;vertical-align: top;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;border-right: 1px solid #bcbcbc;">
                    <?php if(isset($hotel_id) and $hotel_id) : ?>

                    <p style="margin-top:10px;"><strong><?php echo __('Hotel :' , ST_TEXTDOMAIN) ;  ?>:</strong>
                        <a href="<?php echo esc_url($hotel_link)?>" target="_blank"><?php echo strtoupper( get_the_title($hotel_id))?></a> </p>

                        <p><strong><?php echo __('Address :' , ST_TEXTDOMAIN) ;  ?></strong> <?php echo get_post_meta($hotel_id,'address',true)?> </p>
                        <p><strong><?php echo __('Email :' , ST_TEXTDOMAIN) ;  ?></strong> <?php echo get_post_meta($hotel_id,'email',true)?> </p>
                        <p><strong><?php echo __('Phone :' , ST_TEXTDOMAIN) ;  ?></strong> <?php echo get_post_meta($hotel_id,'phone',true)?> </p>

                    <?php endif;?>

                    <p><strong><?php echo __('Booking room' , ST_TEXTDOMAIN) ;  ?></strong> <?php  echo get_the_title($object_id)?></p>


                    <p><strong><?php _e('Number of rooms',ST_TEXTDOMAIN) ?>:</strong> <?php echo TravelHelper::format_money_from_db(get_post_meta($order_id, 'item_price',true), $currency); ?></p>
                    <p><strong><?php _e('Number of rooms',ST_TEXTDOMAIN) ?>:</strong> <?php echo get_post_meta($order_id, 'room_num_search',true)?></p>
                    
                    <p><strong><?php echo __('Check In :' , ST_TEXTDOMAIN) ;  ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true))) ?></p>
                    <p><strong><?php echo __('Check Out :' , ST_TEXTDOMAIN) ;  ?></strong> <?php echo date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true))) ?></p>
                    <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
                    <p>
                        <strong><?php echo __('Extra', ST_TEXTDOMAIN); ?></strong>
                    </p>
                    <p>    
                    <?php        
                        foreach($extras['value'] as $name => $value):
                            $price_item = floatval($extras['price'][$name]);
                            if($price_item <= 0) $price_item = 0;
                            $number_item = intval($extras['value'][$name]);
                            if($number_item <= 0) $number_item = 0;
                    ?>
                        <span>
                            <?php echo esc_html($extras['title'][$name].' ('.TravelHelper::format_money_from_db($price_item, $currency).') x '.$number_item.' '.__('Item(s)', ST_TEXTDOMAIN)); ?>
                        </span> <br />
                        
                    <?php endforeach; ?>
                    </p>
                    <?php endif; ?>
                </td>
            </tr>
    </tbody>
<?php 
    $data_price = get_post_meta($order_id, 'data_prices', true);
    if(!$data_price) $data_price = array();
    $origin_price = isset($data_price['origin_price']) ? $data_price['origin_price'] : 0;
    $sale_price = isset($data_price['sale_price']) ? $data_price['sale_price'] : 0;
    $coupon_price = isset($data_price['coupon_price']) ? $data_price['coupon_price'] : 0;
    $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;
    $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0 ;
    $deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
    $tax = intval(get_post_meta($order_id, 'st_tax_percent', true));
    $deposit_status = get_post_meta($order_id, 'deposit_money', true);
?>
    <tfoot >
        <tr>
            <td colspan="2" style="border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;"></td>
            <td  style="border-bottom: 1px solid #bcbcbc;border-right:1px solid #bcbcbc;padding: 6px;background: #e4e4e4;">
                <table cellspacing="0px" cellpadding="0" width="100%">
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong>
                                <?php echo __('Origin Price:' , ST_TEXTDOMAIN) ;  ?>
                            </strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($origin_price, $currency); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                             <strong><?php echo __('Sale Price :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($sale_price, $currency); ?>
                        </td>
                    </tr>
                    <?php if(isset($extras['value']) && is_array($extras['value']) && count($extras['value'])): ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Extra Price' , ST_TEXTDOMAIN) ;  ?></strong></td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($extra_price, $currency) ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Tax :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo esc_html($tax.' %'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Total Price (with tax) :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($price_with_tax, $currency); ?>
                        </td>
                    </tr>
                    <?php if(is_array($deposit_status) && !empty($deposit_status['type'])): ?>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Deposit Price :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($deposit_price, $currency); ?>
                        </td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Pay Amount :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money_from_db($total_price, $currency); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </tfoot>

</table>
    <?php
    echo st()->load_template('email/booking_customer_infomation',null,array('order_id'=>$order_id));?>
    </td>
</tr>

<?php
echo st()->load_template('email/footer');
