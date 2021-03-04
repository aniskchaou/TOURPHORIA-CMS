<?php
if(!st_check_service_available( 'st_hotel' )) {
    return;
}
/**
* @since 1.1.3
* Hotel Room Header
**/	

if(!function_exists('st_hotel_room_header_ft')){
	function st_hotel_room_header_ft($args){
		if(is_singular('hotel_room')){
			return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_header', false, array('data' => $args));
		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_header','st_hotel_room_header_ft');

/**
* @since 1.1.3
* Hotel Room Facility
**/


if(!function_exists('st_hotel_room_facility_ft')){
	function  st_hotel_room_facility_ft($args, $content = null){
		$default=array(
                'choose_taxonomies'=>''
            );

        $args = wp_parse_args($args,$default);
        
		if(is_singular('hotel_room')){

            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_facility', false, array('args' => $args));

		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_facility','st_hotel_room_facility_ft');
// from 1.2.0

if(!function_exists('st_hotel_room_description_f')){
	function  st_hotel_room_description_f($args, $content = null){
		$default=array(
                'title'=>__('Room Description' , ST_TEXTDOMAIN)
            );

        $args = wp_parse_args($args,$default);        
		if(is_singular('hotel_room')){
            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_description', false, array('args' => $args));

		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_description' , 'st_hotel_room_description_f');

// from 1.2.0

if(!function_exists('st_hotel_room_amenities_f')){
	function  st_hotel_room_amenities_f($args, $content = null){
		$default=array(
                'title'=>__('Amenities' , ST_TEXTDOMAIN)
            );

        $args = wp_parse_args($args,$default);
        
		if(is_singular('hotel_room')){ 
            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_amenities', false, array('args' => $args));

		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_amenities' , 'st_hotel_room_amenities_f');

// from 1.2.0

if(!function_exists('st_hotel_room_space_f')){
	function  st_hotel_room_space_f($args, $content = null){
		$default=array(
                'title'=>__('The Space' , ST_TEXTDOMAIN)
            );

        $args = wp_parse_args($args,$default);
        
		if(is_singular('hotel_room')){			 
            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_space', false, array('args' => $args));

		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_space' , 'st_hotel_room_space_f');
/**
*@since 1.1.8
**/

if(!function_exists('st_hotel_room_content_ft')){
	function  st_hotel_room_content_ft($args, $content = null){
		$default=array(
                'choose_taxonomies'=>''
            );

        $args = wp_parse_args($args,$default);
        
		if(is_singular('hotel_room')){

            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_content', false, array('args' => $args));

		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_content','st_hotel_room_content_ft');

if(!function_exists('st_hotel_room_gallery_ft')){
    function st_hotel_room_gallery_ft($attr,$content=false)
    {
        $default=array(
            'st_hotel_room_gallery'=>'slide'
        );
        $attr=wp_parse_args($attr,$default);

        if(is_singular('hotel_room'))
        {
            return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_gallery',null,array('attr'=>$attr));
        }
    }
}
st_reg_shortcode('st_hotel_room_gallery','st_hotel_room_gallery_ft');


if(!function_exists('st_hotel_room_sidebar_ft')){
	function st_hotel_room_sidebar_ft($args){
		$args = wp_parse_args($args, array(
			'show_sidebar' => 'fixed_top'
			) );
		if(is_singular('hotel_room')){
			return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_sidebar',null,array('attr'=>$args));
		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_sidebar','st_hotel_room_sidebar_ft');


if(!function_exists('st_hotel_room_review_ft')){
	function st_hotel_room_review_ft($args){
		if(is_singular('hotel_room')){
			if(comments_open() and st()->get_option('hotel_review')=='on'){
                ob_start();
                    comments_template('/reviews/reviews.php');
                return @ob_get_clean();
            }
		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_review','st_hotel_room_review_ft');

if(!function_exists('st_hotel_room_calendar')){
	function st_hotel_room_calendar($args){
		if(is_singular('hotel_room')){
			return st()->load_template('vc-elements/st-hotel-room/st_hotel_room_calendar',null,array('attr'=>$args));
		}
		return false;
	}
}
st_reg_shortcode('st_hotel_room_calendar','st_hotel_room_calendar');
