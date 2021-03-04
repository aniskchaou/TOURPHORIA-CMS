<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Email booking information cars
 *
 * Created by ShineTheme
 *
 */

if (!isset($order_id)) return FALSE;
$order_code = $order_id;
$first_name = get_post_meta($order_id, 'st_first_name', TRUE);
$last_name = get_post_meta($order_id, 'st_last_name', TRUE);

$selected_equipments=get_post_meta($order_code,'data_equipment',true);

$check_in_timestamp=get_post_meta($order_code,'check_in_timestamp',true);

$check_out_timestamp=get_post_meta($order_code,'check_out_timestamp',true);

echo st()->load_template('email/header', NULL, array('email_title' => __('Booking Information' , ST_TEXTDOMAIN)));

$main_color = st()->get_option('main_color', '#ed8323');
?>
    <tr style="background: white">
        <td colspan="10" style="padding: 10px;">
            <?php if (!isset($send_to_admin)): ?>
                <h3 style="
margin-top: 30px;
padding-top: 10px;">
                    <?php printf(__('Hi' , ST_TEXTDOMAIN) . ' <strong>%s</strong>', $first_name . ' ' . $last_name) ?>,
                    <br>

                    <p><?php echo __('Thank you for booking with us. Bellow are your booking details:' , ST_TEXTDOMAIN); ?></p>

                </h3>
            <?php endif; ?>
            <p><strong><?php echo __('Booking Number :' , ST_TEXTDOMAIN); ?></strong> <?php echo esc_html($order_id) ?></p>

            <p>
                <strong><?php echo __('Booking Date :' , ST_TEXTDOMAIN); ?></strong> <?php echo get_the_time(TravelHelper::getDateFormat(), $order_id) ?>
            </p>

            <p><strong><?php echo __('Payment Method :' , ST_TEXTDOMAIN); ?></strong> <?php

                echo STPaymentGateways::get_gatewayname(get_post_meta($order_id, 'payment_method', TRUE));

                ?></p>

            <table cellpadding="0" cellspacing="0" width="100%">
                <tbody>

                <tr>
                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;">
                        *
                    </td>

                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;">
                        <?php echo __('Item', ST_TEXTDOMAIN) ;  ?>
                    </td>
                    <td style="border-left: 1px solid #bcbcbc;border-top: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;padding: 6px;background: #e4e4e4;border-right: 1px solid #bcbcbc;">
                        <?php echo __('Infomation', ST_TEXTDOMAIN) ;  ?>
                    </td>
                </tr>
                <?php

                $total = 0;
                $i = 0;

                $i++;

                $order_item_id = $order_id;

                $object_id = get_post_meta($order_item_id, 'item_id', TRUE);

                $total = STCart::get_order_item_total($order_id);

                ?>
                <tr>
                    <td style="padding: 6px;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;" valign="top" align="center" width="5%">
                        <?php echo esc_html($i) ?>
                    </td>
                    <td width="35%" style="vertical-align: top;padding: 6px;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;">
                        <?php echo get_the_post_thumbnail($object_id, array(360, 270, 'bfi_thumb' => TRUE), array('style' => 'max-width:100%;height:auto', 'alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( $object_id )))) ?>
                    </td>
                    <td style="padding: 6px;vertical-align: top;border-bottom:1px dashed #ccc;border-left: 1px solid #bcbcbc;border-bottom: 1px solid #bcbcbc;border-right: 1px solid #bcbcbc;">
                        <p>
                            <strong><?php echo __('Address :' , ST_TEXTDOMAIN); ?> </strong><?php echo get_post_meta($object_id, 'cars_address', TRUE) ?>
                        </p>

                        <p>
                            <strong><?php echo __('Email :' , ST_TEXTDOMAIN); ?></strong><?php echo get_post_meta($object_id, 'cars_email', TRUE) ?>
                        </p>

                        <p>
                            <strong><?php echo __('Phone :' , ST_TEXTDOMAIN); ?></strong><?php echo get_post_meta($object_id, 'cars_phone', TRUE) ?>
                        </p>

                        <p><strong><?php echo __('Car' , ST_TEXTDOMAIN); ?> : </strong><a target="_blank"
                                                                                 href="<?php echo get_the_permalink($object_id) ?>"><?php echo get_the_title($object_id) ?></a>
                        </p>

                        <p><strong><?php echo __('Price :' , ST_TEXTDOMAIN); ?></strong> 
                        <?php
                            $item_price = get_post_meta($order_item_id, 'item_price', TRUE);
                            echo TravelHelper::format_money($item_price);
                        ?>
                        </p>

                        <?php if($pick_up=get_post_meta($order_code, 'pick_up', TRUE)){?>
                        <p>
                            <strong><?php _e("Pick-up: " , ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($pick_up); ?>
                        </p>
                        <?php }?>

                        <?php if($drop_off=get_post_meta($order_code, 'drop_off', TRUE)){?>
                        <p>
                            <strong><?php _e("Drop-off: " , ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($drop_off); ?>
                        </p>

                        <?php } ?>
                        <p>
                            <strong><?php _e("Pick-up Time: " , ST_TEXTDOMAIN) ?></strong> <?php echo @date_i18n(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_item_id, 'check_in', TRUE))) . ' - ' . get_post_meta($order_item_id, 'check_in_time', TRUE) ?>
                        </p>

                        <p>
                            <strong><?php _e("Drop-off Time: " , ST_TEXTDOMAIN) ?></strong> <?php echo @date_i18n(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_item_id, 'check_out', TRUE))) . ' - ' . get_post_meta($order_item_id, 'check_out_time', TRUE) ?>
                        </p>
                        <?php if($drive_name=get_post_meta($order_code, 'driver_name', TRUE)){ ?>
                        <p>
                            <strong><?php _e("Driver’s Name: " , ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($drive_name);  ?>
                        </p>
                        <?php } ?>

                        <?php if($drive_age=get_post_meta($order_code, 'driver_age', TRUE)){?>
                        <p>
                            <strong><?php _e("Driver’s Age: " , ST_TEXTDOMAIN) ?></strong> <?php echo esc_html($drive_age); ?>
                        </p>
                        <?php }?>
                        <?php if(is_array($selected_equipments) && count($selected_equipments)):?>
                        <p>
                            <strong><?php _e("Equipments: " , ST_TEXTDOMAIN) ?></strong>
                            <ul>
                                <?php

                                        foreach($selected_equipments as $key => $val):
                                ?>
                                <li><?php echo esc_html($val->title .' ('. TravelHelper::format_money($val->price).')'); ?></li>
                                <?php endforeach; else: ?>
                                <li><?php echo __('No select', ST_TEXTDOMAIN); ?></li>

                            </ul>
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
            echo st()->load_template('email/booking_customer_infomation', NULL, array('order_id' => $order_id)); ?>
        </td>
    </tr>

<?php
echo st()->load_template('email/footer');
?>