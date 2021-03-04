<?php
/* Partner Info */

if(!function_exists( 'st_partner_info' )) {
    function st_partner_info( $arg )
    {
        $output = st()->load_template('user/partner/partner', 'info', array('atts' => $arg));
        return $output;
    }
}

st_reg_shortcode( 'st_partner_info' , 'st_partner_info' );

/* Partner avarage rating */


if(!function_exists( 'st_partner_average_rating' )) {
    function st_partner_average_rating( $attr , $content = false )
    {
        $default=array(
            'font_size'=>4
        );
        $attr=wp_parse_args($attr,$default);

        $output = st()->load_template('user/partner/partner', 'average-rating', array('atts' => $attr));
        return $output;
    }
}

st_reg_shortcode( 'st_partner_average_rating' , 'st_partner_average_rating' );

/* Partner contact form */


if(!function_exists( 'st_partner_contact_form' )) {
    function st_partner_contact_form( $attr , $content = false )
    {
        $default=array(
            'font_size'=>4
        );
        $attr=wp_parse_args($attr,$default);

        $output = st()->load_template('user/partner/partner', 'contact-form', array('atts' => $attr));
        return $output;
    }
}

st_reg_shortcode( 'st_partner_contact_form' , 'st_partner_contact_form' );

/* Partner list service */

if(!function_exists( 'st_partner_list_service' )) {
    function st_partner_list_service( $attr , $content = false )
    {
        $default=array(
            'font_size'=>4,
            'post_per_page_service' => 10,
            'post_per_page_review' => 5,
        );
        $attr=wp_parse_args($attr,$default);

        $output = st()->load_template('user/partner/partner', 'list-services', array('atts' => $attr));
        return $output;
    }
}

st_reg_shortcode( 'st_partner_list_service' , 'st_partner_list_service' );

/* Partner Info In post */


if(!function_exists( 'st_partner_info_in_post' )) {
    function st_partner_info_in_post( $attr , $content = false )
    {
        $default=array(
            'font_size'=>4
        );
        $attr=wp_parse_args($attr,$default);

        $output = st()->load_template('user/partner/partner', 'info-inpost', array('atts' => $attr));
        return $output;
    }
}
st_reg_shortcode( 'st_partner_info_in_post' , 'st_partner_info_in_post' );