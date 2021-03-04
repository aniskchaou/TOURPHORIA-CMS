<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */

if(!function_exists('st_vc_single_search_flights') && function_exists('vc_map') && function_exists('st_reg_shortcode') && st_check_service_available('st_flight')){
    function st_vc_single_search_flights($atts, $content = false){
        $atts = shortcode_atts(array(
            'title' => '',
            'style' => 'default',
            'search_type' => 'both',
            'box_shadow' => 'no'
        ), $atts);

        $html = st_flight_load_view('vc-elements/st-single-search-flights/st-single-search-flights', false, array('atts' => $atts));

        return $html;
    }

    st_reg_shortcode('st_single_search_flights', 'st_vc_single_search_flights');

}

