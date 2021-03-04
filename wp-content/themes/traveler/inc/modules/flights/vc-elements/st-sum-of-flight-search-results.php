<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/26/2017
 * Version: 1.0
 */

if(!function_exists('st_vc_sum_of_flight_search_result') && function_exists('vc_map') && function_exists('st_reg_shortcode') && st_check_service_available('st_flight')){
    function st_vc_sum_of_flight_search_result($atts, $content = false){
        $atts = shortcode_atts(array(
            'extra_class' => '',
        ), $atts);

        $html = st_flight_load_view('vc-elements/st-sum-of-flight-search-results/st-sum-of-flight-search-results', false, array('atts' => $atts));

        return $html;
    }

    st_reg_shortcode('st_sum_of_flight_search_result', 'st_vc_sum_of_flight_search_result');

}
