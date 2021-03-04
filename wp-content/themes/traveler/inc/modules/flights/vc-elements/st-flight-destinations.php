<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/26/2017
 * Version: 1.0
 */
if(!function_exists('st_vc_flight_destinations') && function_exists('vc_map') && function_exists('st_reg_shortcode') && st_check_service_available('st_flight')){
    function st_vc_flight_destinations($atts, $content = false){
        $atts = shortcode_atts(array(
            'st_ids' => '',
            'column' => 'col-md-3'
        ), $atts);

        $html = st_flight_load_view('vc-elements/st-flight-destinations/st-flight-destinations', false, array('atts' => $atts));

        return $html;
    }

    st_reg_shortcode('st_flight_destinations', 'st_vc_flight_destinations');

}
