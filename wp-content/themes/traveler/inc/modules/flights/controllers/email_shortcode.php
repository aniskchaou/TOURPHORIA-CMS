<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 7/19/2017
 * Version: 1.0
 */
if(!function_exists('st_email_booking_passenger') && function_exists('st_reg_shortcode')) {
    function st_email_booking_passenger($atts = array()){
        global $order_id;
        $data = shortcode_atts(array(
            'title' => __('Passenger', ST_TEXTDOMAIN),
        ), $atts);
        if(!empty($order_id)){
            $passenger = get_post_meta($order_id, 'passenger', true);
            $html = '
                        <span style="text-align: left; width: 48%; display: inline-block; padding-top: 25px; padding-bottom: 25px">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 48%; display: inline-block; padding-top: 25px; padding-bottom: 25px">
                             <strong>'.$passenger.'</strong>
                        </span>
                ';
            return $html;
        }
        return '';
    }
    st_reg_shortcode('st_email_booking_passenger', 'st_email_booking_passenger');
}

if(!function_exists('st_email_booking_flight_info') && function_exists('st_reg_shortcode')) {
    function st_email_booking_flight_info($atts = array()){
        global $order_id;

        if(!empty($order_id)){

        }
        return '';
    }
    st_reg_shortcode('st_email_booking_flight_info', 'st_email_booking_flight_info');
}

