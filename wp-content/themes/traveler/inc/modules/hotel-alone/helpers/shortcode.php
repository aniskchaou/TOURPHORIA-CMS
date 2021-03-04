<?php
if(!function_exists('hotel_alone_sc_maincolor') && function_exists('st_reg_shortcode') && st_check_service_available('st_hotel')){
    function hotel_alone_sc_maincolor($atts, $content = false){
        $output = '<span class="maincolor">'.wpb_js_remove_wpautop($content, false).'</span>';
        return $output;
    }
    st_reg_shortcode('maincolor', 'hotel_alone_sc_maincolor');
}

if(!function_exists('hotel_alone_sc_b') && function_exists('st_reg_shortcode') && st_check_service_available('st_hotel')){
    function hotel_alone_sc_b($atts, $content = false){
        $output = '<strong>'.wpb_js_remove_wpautop($content, false).'</strong>';
        return $output;
    }
    st_reg_shortcode('b', 'hotel_alone_sc_b');
}
if(!function_exists('hotel_alone_sc_letter_spacing') && function_exists('st_reg_shortcode') && st_check_service_available('st_hotel')){
    function hotel_alone_sc_letter_spacing($atts, $content = false){
        extract( $data = shortcode_atts( array(
            'value'             => '0' ,
        ) , $atts ) );
        $class = Hotel_Alone_Helper::inst()->build_css('letter-spacing:'.$value.'px !important');
        $output = '<span class="'.esc_attr($class).'">'.wpb_js_remove_wpautop($content, false).'</span>';
        return $output;
    }
    st_reg_shortcode('letter_spacing', 'hotel_alone_sc_letter_spacing');
}
if(!function_exists('hotel_alone_sc_highlight') && function_exists('st_reg_shortcode') && st_check_service_available('st_hotel')){
    function hotel_alone_sc_highlight($atts, $content = false){
        $output = '<span class="highlight">'.wpb_js_remove_wpautop($content, false).'</span>';
        return $output;
    }
    st_reg_shortcode('highlight', 'hotel_alone_sc_highlight');
}
/**
 * VC element params
 */
