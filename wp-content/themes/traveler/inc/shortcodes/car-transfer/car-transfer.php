<?php 

if(!function_exists( 'st_search_car_transfer_title' )) {
    function st_search_car_transfer_title( $arg = array() )
    {

        $default = array(
            'search_modal' => 1
        );
        
        wp_enqueue_script('magnific.js' );

        extract( wp_parse_args( $arg , $default ) );

        $object = STCarTransfer::inst();
        $a      = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags( $object->get_result_string() ) . '</span>';

        if($search_modal) {
            $a .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
        }
        $a .= '</h3>';

        return $a;
    }
}
st_reg_shortcode( 'st_search_car_transfer_title' , 'st_search_car_transfer_title' );