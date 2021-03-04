<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/16/2017
 * Version: 1.0
 */

if(!function_exists('st_vc_flight_search_results') && st_check_service_available('st_flight') && function_exists('vc_map') && function_exists('st_reg_shortcode')) {
    function st_vc_flight_search_results($atts, $content = false)
    {
        $atts = shortcode_atts(array(
            'extra_class' => ''
        ), $atts);

        $output = st_flight_load_view('vc-elements/st-flight-search-results/st-flight-search-results', false, array('atts' => $atts));

        return $output;
    }


    st_reg_shortcode('st_flight_search_results', 'st_vc_flight_search_results');

}