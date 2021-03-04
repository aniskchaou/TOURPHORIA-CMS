<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Email booking information activity
 *
 * Created by ShineTheme
 *
 */

if(!isset($order_id)) return false;
    $order_code = $order_id;
$first_name = get_post_meta($order_id,'st_first_name',true);
$last_name = get_post_meta($order_id,'st_last_name',true);
echo st()->load_template('email/header',null,array('email_title'=>__('Booking Information')));

$main_color=st()->get_option('main_color','#ed8323');

$type_activity  = get_post_meta( $order_code , 'type_activity' , true );
$title_type_activity = '';
if($type_activity == 'specific_date')
    $title_type_activity = __('Specific Date',ST_TEXTDOMAIN);
if($type_activity == 'daily_activity')
    $title_type_activity = __('Daily Activity',ST_TEXTDOMAIN);

$post_id =  get_post_meta($order_id,'item_id',true);

$deposit_money = get_post_meta($order_id,'deposit_money',true);

$check_in = get_post_meta($order_id, 'check_in');
$check_out = get_post_meta($order_id, 'check_out');
$item_price = floatval((get_post_meta($order_id, 'item_price', true)));
$data_price = get_post_meta($order_id, 'data_prices', true);
$adult_price = floatval(get_post_meta($order_id,'adult_price', true));
$child_price = floatval(get_post_meta($order_id,'child_price', true));
?>
    <tr style="background: white">
        <td colspan="10" style="padding: 10px;">
            <?php if(!isset($send_to_admin)):?>
            <h3 style="margin-top: 30px;padding-top: 10px;">
                <?php printf(__('Hi' , ST_TEXTDOMAIN).' <strong>%s</strong>',$first_name.' '.$last_name)?>,
                <br>
                <p><?php echo __('Thank you for booking with us. Bellow are your booking details:' , ST_TEXTDOMAIN) ;  ?></p>
            </h3>
            <?php endif;?>
            <p><strong><?php echo __('Booking Number :' , ST_TEXTDOMAIN) ; ?></strong> <?php echo esc_html($order_id)?></p>
            <p><strong><?php echo __('Booking Date :' , ST_TEXTDOMAIN) ; ?></strong> <?php echo get_the_time(TravelHelper::getDateFormat(),$order_id)?></p>
            <p><strong><?php echo __('Payment Method :' , ST_TEXTDOMAIN) ; ?></strong> 
                <?php
                   echo STPaymentGateways::get_gatewayname(get_post_meta($order_id,'payment_method',true));

                ?>
            </p>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;">
                        *
                    </td>
                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;">
                        <?php echo __('Item' , ST_TEXTDOMAIN); ?>
                    </td>
                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;border-right: 1px solid #bcbcbc;">
                        <?php echo __('Information' , ST_TEXTDOMAIN); ?>
                    </td>
                </tr>
                <?php
                $total = 0;
                $i = 0;

                    $i++;

                    $order_item_id = $order_id;

                    $object_id = get_post_meta($order_item_id,'item_id',true);

                    
                    $check_in = get_post_meta($order_item_id,'check_in',true);
                    $check_out = get_post_meta($order_item_id,'check_out',true);
                    $number = get_post_meta($order_item_id,'item_number',true);

                    $total = get_post_meta($order_item_id,'total_price',true);

                    ?>
                    <tr>
                        <td style="padding: 6px;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;" valign="top" align="center" width="5%">
                            <?php echo esc_html($i) ?>
                        </td>
                        <td width="35%" style="vertical-align: top;padding: 6px;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;">
                            <?php echo get_the_post_thumbnail($object_id,array(360,270,'bfi_thumb'=>true),array('style'=>'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( $object_id ))))?>
                        </td >
                        <td style="padding: 6px;vertical-align: top;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;border-right: 1px solid #bcbcbc;">
                            <p><strong><?php echo __('Address :' , ST_TEXTDOMAIN); ?></strong> <?php echo get_post_meta($object_id,'address',true)?> </p>
                            <p><strong><?php echo __('Email :' , ST_TEXTDOMAIN); ?></strong> <?php echo get_post_meta($object_id,'contact_email',true)?> </p>
                            <p><strong><?php echo __('Phone :' , ST_TEXTDOMAIN); ?></strong> <?php echo get_post_meta($object_id,'contact_phone',true)?> </p>
                            <p><strong><?php echo __('Activity :' , ST_TEXTDOMAIN); ?> :</strong> <a target="_blank" href="<?php  echo get_the_permalink($object_id)?>"><?php  echo get_the_title($object_id)?></a> </p>

                            <p>
                                <strong><?php _e('Adult Price',ST_TEXTDOMAIN) ?>: </strong>
                                <?php echo TravelHelper::format_money($adult_price); ?>
                            </p>
                            <p><strong><?php _e('Child Price',ST_TEXTDOMAIN) ?>: </strong>
                                <?php echo TravelHelper::format_money($child_price); ?>
                            </p>
                            <p>
                                <strong><?php _e( "Activity Type:" , ST_TEXTDOMAIN ) ?></strong> 
                                <?php echo esc_html($title_type_activity) ?>
                            </p>
                            <p><strong><?php echo __('Check In :' , ST_TEXTDOMAIN); ?></strong> <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_in)); ?></p>
                            <p><strong><?php echo __('Check Out:' , ST_TEXTDOMAIN); ?></strong> <?php echo date_i18n(TravelHelper::getDateFormat(), strtotime($check_out)); ?></p>

                        </td>
                    </tr>
                <?php


                ?>
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
                            <?php echo TravelHelper::format_money($origin_price); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                             <strong><?php echo __('Sale Price :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money($sale_price); ?>
                        </td>
                    </tr>
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
                            <?php echo TravelHelper::format_money($price_with_tax); ?>
                        </td>
                    </tr>
                    <?php if(is_array($deposit_status) && !empty($deposit_status['type'])): ?>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Deposit Price :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money($deposit_price); ?>
                        </td>
                    </tr>
                    <?php endif;?>
                    <tr>
                        <td  style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <strong><?php echo __('Pay Amount :', ST_TEXTDOMAIN); ?></strong>
                        </td>
                        <td style="border-bottom: 1px dashed #ccc;padding:10px;">
                            <?php echo TravelHelper::format_money($total_price); ?>
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
