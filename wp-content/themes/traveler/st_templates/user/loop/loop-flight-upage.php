<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User loop tours
 *
 * Created by ShineTheme
 *
 */

$status = get_post_status(get_the_ID());
$icon_class = STUser_f::st_get_icon_status_partner();
$page_my_account_dashboard = st()->get_option('page_my_account_dashboard');
?>
<li <?php  post_class() ?>>
    <div class="spinner user_img_loading ">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
    <div <?php post_class('booking-item') ?>>
        <div class="row">
            <div class="col-md-2">
                <?php
                $airline = get_post_meta(get_the_ID(), 'airline', true);
                if(!empty($airline)){
                    $logo = get_tax_meta($airline, 'airline_logo');
                    echo wp_get_attachment_image($logo, array(106, 0));
                }
                ?>
            </div>
            <div class="col-md-10">
                <div class="color-inherit">
                    <?php
                    $origin = get_post_meta(get_the_ID(), 'origin', true);
                    $destination = get_post_meta(get_the_ID(), 'destination', true);
                    $location_origin = get_tax_meta($origin, 'location_id');
                    $origin_iata = get_tax_meta($origin, 'iata_airport');
                    $location_des = get_tax_meta($destination, 'location_id');
                    $destination_iata = get_tax_meta($destination, 'iata_airport');
                    if(!empty($location_origin) && !empty($location_des)){
                        echo '<h5 class="booking-item-title">'.get_the_title($location_origin).' ('.$origin_iata.') - '.get_the_title($location_des).' ('.$destination_iata.')</h5>';
                    }
                    ?>
                    <p class="booking-item-address">
                        <?php $flight_type =  get_post_meta(get_the_ID() ,'flight_type' ,true);
                        $types = array(
                            'direct' => esc_html__('Direct', ST_TEXTDOMAIN),
                            'one_stop' => esc_html__('One stop', ST_TEXTDOMAIN),
                            'two_stops' => esc_html__('Two stop', ST_TEXTDOMAIN)
                        );
                        if(!empty($types[$flight_type])){
                            echo '<i class="fa fa-plane"></i> '.esc_html__('Flight type: ', ST_TEXTDOMAIN).$types[$flight_type];
                        }
                        ?>
                    </p>
                    <p class="package-info">
                        <?php $depart_time = get_post_meta(get_the_ID(),'departure_time', true) ?>
                        <i class="fa fa-clock-o"></i>
                        <span class=""><?php echo esc_html__('Departure time') ?> : </span>
                        <?php echo strtoupper($depart_time) ?>
                    </p>
                    <div class="package-info">
                        <?php $total_time = get_post_meta(get_the_ID(),'total_time', true) ?>
                        <i class="fa fa-clock-o"></i>
                        <span class=""><?php echo esc_html__('Total time') ?> : </span>
                        <?php echo $total_time['hour'].esc_html__('h ', ST_TEXTDOMAIN).$total_time['minute'].esc_html__('m', ST_TEXTDOMAIN); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

