<?php
if(!st_check_service_available( 'st_rental' )) {
    return;
}
/**
* @since 1.1.3
* Rental Room Header
**/	

if(!function_exists('st_rental_room_header_ft')){
	function st_rental_room_header_ft($args){
		if(is_singular('rental_room')){
			return st()->load_template('vc-elements/st-rental-room/st_rental_room_header', false, array('data' => $args));
		}
		return false;
	}
}
st_reg_shortcode('st_rental_room_header','st_rental_room_header_ft');

/**
* @since 1.1.3
* Rental Room Excerpt
**/


if(!function_exists('st_rental_room_content_ft')){
    function st_rental_room_content_ft($attr, $content = null){
        if(is_singular('rental_room')){
            return '<div class="content mt20">'.get_the_content( ).'</div>';
        }
        return false;
    }
}
st_reg_shortcode('st_rental_room_content','st_rental_room_content_ft');
/**
* @since 1.1.3
* Rental Room Gallery
**/

if(!function_exists('st_rental_room_gallery_ft')){
    function st_rental_room_gallery_ft($attr,$content=false)
    {
        if(is_singular('rental_room'))
        {
            return st()->load_template('vc-elements/st-rental-room/st_rental_room_gallery',null,array('attr'=>$attr));
        }
    }
}
st_reg_shortcode('st_rental_room_gallery','st_rental_room_gallery_ft');

/**
* @since 1.1.3
* List Rental Room
**/

if(!function_exists('st_list_rental_room_ft')){

    function st_list_rental_room_ft($attr, $content = false){
        $attr = wp_parse_args( $attr, array(
            'header_title' => '',
            'post_per_page' => 12,
            'orderby' => 'date',
            'order' => 'desc'
        ));
        if(is_singular('st_rental')){
            wp_enqueue_script( 'owl-carousel.js' );

            return st()->load_template('vc-elements/st-rental-room/st_list_rental_room',null,array('attr'=>$attr));
        }
    }
}

st_reg_shortcode('st_list_rental_room','st_list_rental_room_ft');

/**
* @since 1.1.3
* List Related Rental Room
**/

if(!function_exists('st_related_rental_room_ft')){

    function st_related_rental_room_ft($attr, $content = null){
        if(is_singular('rental_room')){

            return st()->load_template('vc-elements/st-rental-room/st_related_rental_room',null,array('attr'=>$attr));
        }
    }
}
st_reg_shortcode('st_related_rental_room','st_related_rental_room_ft');

/**
* ST Rental Room Review
* @since 1.1.4
**/

if(!function_exists('st_rental_room_review'))
{
    function st_rental_room_review()
    {
        
        if(get_post_type() == 'rental_room')
        {
            if(comments_open() and st()->get_option('rental_review')=='on')
            {
                ob_start();
                comments_template('/reviews/reviews.php');
                return @ob_get_clean();
            }
        }
    }
    st_reg_shortcode('st_rental_room_review','st_rental_room_review');

}

/**
* ST Room rental facility
* @since 1.1.4
**/
if(!function_exists('st_rental_room_facility_ft'))
{
    function st_rental_room_facility_ft($attr, $content = null)
    {
        $default=array(
                'choose_taxonomies'=>''
            );

        $attr=wp_parse_args($attr,$default);
        
        if(get_post_type() == 'rental_room')
        {
            return st()->load_template('vc-elements/st-rental-room/st_rental_room_facility',false,array('args'=>$attr));
        }
        return false;
    }
    st_reg_shortcode('st_rental_room_facility','st_rental_room_facility_ft');

}
