<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 9:44 AM
 */

if(!st_check_service_available( 'st_hotel' )) {
    return;
}
/**
 * ST Hotel header
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_header' )) {
    function st_hotel_header( $arg )
    {
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/header' , false , array( 'arg' => $arg ) );
        }
        return false;
    }
}

st_reg_shortcode( 'st_hotel_header' , 'st_hotel_header' );

/**
 * ST Hotel star
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_star' )) {
    function st_hotel_star( $attr = array() )
    {
        $attr = wp_parse_args( $attr , array(
            'title' => ''
        ) );
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/star' , false , $attr );
        }
        return false;
    }
}
st_reg_shortcode( 'st_hotel_star' , 'st_hotel_star' );
/**
 * ST Hotel Video
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_video' )) {
    function st_hotel_video( $attr = array() )
    {
        if(is_singular( 'st_hotel' )) {
            if($video = get_post_meta( get_the_ID() , 'video' , true )) {
                return "<div class='media-responsive'>" . wp_oembed_get( $video ) . "</div>";
            }
        }
    }
}

st_reg_shortcode( 'st_hotel_video' , 'st_hotel_video' );

/**
 * ST Hotel Price
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_price_func' )) {
    function st_hotel_price_func( $attr , $content = false )
    {
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/price' );
        }
    }
}

st_reg_shortcode( 'st_hotel_price' , 'st_hotel_price_func' );

/**
*hotel policy
*@since 1.1.9
*/


if(!function_exists( 'st_hotel_policy_func' )) {
    function st_hotel_policy_func( $attr , $content = false )
    {
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/policy' );
        }
    }
}

st_reg_shortcode( 'st_hotel_policy' , 'st_hotel_policy_func' );


/**
 * ST Hotel Logo
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_logo' )) {
    function st_hotel_logo( $attr = array() )
    {
        if(is_singular( 'st_hotel' )) {
            $default = array(
                'thumbnail_size' => 'full' ,
                'title'          => '' ,
                'font_size'      => '3' ,
            );

            extract( wp_parse_args( $attr , $default ) );

            $img_id = get_post_meta( get_the_ID() , 'logo' , true );
                        $img_id = get_post_meta( get_the_ID() , 'logo' , true );
            $meta = false;
            if(is_numeric($img_id)){
                $meta = wp_get_attachment_url($img_id);
            }else{
                $meta = $img_id;
            }

            $html = '';
            if($meta) {
                $html = "<img src=".$meta." class='img-responsive' style='margin-bottom:10px;' alt='" . TravelHelper::get_alt_image($img_id) ."'/>";
            }

            if(!empty( $title ) and !empty( $html )) {
                $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
            }
            return $html;
        }
    }
}

st_reg_shortcode( 'st_hotel_logo' , 'st_hotel_logo' );


/**
 * ST Hotel Add Review
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_add_review' )) {
    function st_hotel_add_review()
    {
        if(is_singular( 'st_hotel' )) {
            return '<div class="text-right mb10">
                      <a class="btn btn-primary" href="' . get_comments_link() . '">' . __( 'Write a review' , ST_TEXTDOMAIN ) . '</a>
                   </div>';
        }
    }
}

st_reg_shortcode( 'st_hotel_add_review' , 'st_hotel_add_review' );

/**
 * ST Hotel Nearby
 * @since 1.1.0
 **/

if(!function_exists( 'st_hotel_nearby' )) {
    function st_hotel_nearby( $attr = array() , $content = null )
    {
        if(is_singular( 'st_hotel' )) {
            $default = array(
                'style'     => 'style-1' ,
                'title'     => '' ,
                'font_size' => '3' ,
            );
            $attr    = wp_parse_args( $attr , $default );
            return st()->load_template( 'hotel/elements/nearby' , false , array( 'attr' => $attr ) );
        }
    }
}

st_reg_shortcode( 'st_hotel_nearby' , 'st_hotel_nearby' );

/**
 * ST Hotel Review
 * @since 1.1.0
 **/

if(!function_exists( 'st_hotel_review' )) {
    function st_hotel_review( $attr = array() )
    {
        if(is_singular( 'st_hotel' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            if(comments_open() and st()->get_option( 'hotel_review' ) == 'on') {
                ob_start();
                comments_template( '/reviews/reviews.php' );
                $html = @ob_get_clean();
                if(!empty( $title ) and !empty( $html )) {
                    $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
                }
                return $html;
            }
        }
    }
}

st_reg_shortcode( 'st_hotel_review' , 'st_hotel_review' );

/**
 * ST Hotel Detail List Rooms
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_detail_list_rooms' )) {
    function st_hotel_detail_list_rooms( $attr = array() )
    {
        $attr = wp_parse_args( $attr , array(
            'style' => 'style-1'
        ) );
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/loop_room' , null , array( 'attr' => $attr ) );
        }
    }
}

st_reg_shortcode( 'st_hotel_detail_list_rooms' , 'st_hotel_detail_list_rooms' );

/**
 * ST Hotel Detail Card Accept
 * @since 1.1.0
 **/

if(!function_exists( 'st_hotel_detail_card_accept' )) {
    function st_hotel_detail_card_accept( $arg = array() )
    {
        $arg = wp_parse_args( $arg , array(
            'title' => ''
        ) );
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/card' , false , array( 'arg' => $arg ) );
        }
        return false;
    }
}

st_reg_shortcode( 'st_hotel_detail_card_accept' , 'st_hotel_detail_card_accept' );

/**
 * ST Hotel Detail Search Room
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_detail_search_room' )) {
    function st_hotel_detail_search_room( $attr = array() )
    {
        if(is_singular( 'st_hotel' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
				'style'=>'horizon'
            );
            extract( wp_parse_args( $attr , $default ) );
            $html = st()->load_template( 'hotel/elements/search_room' , null , array( 'attr' => $attr ) );
            if(!empty( $title ) and !empty( $html )) {
                $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
            }
            return $html;
        }
    }
}

st_reg_shortcode( 'st_hotel_detail_search_room' , 'st_hotel_detail_search_room' );

/**
 * ST Hotel Detail Review Detail
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_detail_review_detail' )) {
    function st_hotel_detail_review_detail()
    {
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/review_detail' );
        }
    }
}

st_reg_shortcode( 'st_hotel_detail_review_detail' , 'st_hotel_detail_review_detail' );

/**
 * ST Hotel Detail Review Summary
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_detail_review_summary' )) {
    function st_hotel_detail_review_summary()
    {
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/review_summary' );
        }
    }
}

st_reg_shortcode( 'st_hotel_detail_review_summary' , 'st_hotel_detail_review_summary' );

/**
 * ST Hotel Detail Map
 * @since 1.1.0
 **/


if(!function_exists( 'st_hotel_detail_map' )) {
    function st_hotel_detail_map( $attr )
    {
        if(is_singular( 'st_hotel' )) {
            //$hotel=new STHotel();
            //$data=$hotel->get_near_by(get_the_ID(),200,10);
            $default = array(
                'number'      => '12' ,
                'range'       => '20' ,
                'show_circle' => 'no' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            $lat   = get_post_meta( get_the_ID() , 'map_lat' , true );
            $lng   = get_post_meta( get_the_ID() , 'map_lng' , true );
            $zoom  = get_post_meta( get_the_ID() , 'map_zoom' , true );
            $hotel = new STHotel();
            $data  = $hotel->get_near_by( get_the_ID() , $range , $number );
            $location_center                     = '[' . $lat . ',' . $lng . ']';
            $data_map                            = array();
            $data_map[ 0 ][ 'id' ]               = get_the_ID();
            $data_map[ 0 ][ 'name' ]             = get_the_title();
            $data_map[ 0 ][ 'post_type' ]        = get_post_type();
            $data_map[ 0 ][ 'lat' ]              = $lat;
            $data_map[ 0 ][ 'lng' ]              = $lng;
            $data_map[ 0 ][ 'icon_mk' ]          = get_template_directory_uri() . '/img/mk-single.png';
            $data_map[ 0 ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => '' ) ) );
            $data_map[ 0 ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => '' ) ) );
            $stt                                 = 1;
            global $post;
            if(!empty( $data )) {
                foreach( $data as $post ) :
                    setup_postdata( $post );
                    $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
                    $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
                    if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
                        $post_type                              = get_post_type();
                        $data_map[ $stt ][ 'id' ]               = get_the_ID();
                        $data_map[ $stt ][ 'name' ]             = get_the_title();
                        $data_map[ $stt ][ 'post_type' ]        = $post_type;
                        $data_map[ $stt ][ 'lat' ]              = $map_lat;
                        $data_map[ $stt ][ 'lng' ]              = $map_lng;
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => '' ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => '' ) ) );
                        $stt++;
                    }
                endforeach;
                wp_reset_postdata();
            }
            $properties = $hotel->properties_near_by(get_the_ID(), $lat, $lng, $range);
            if( !empty($properties)){
                foreach($properties as $key => $val){
                    $data_map[] = array(
                        'id' => get_the_ID(),
                        'name' => $val['name'],
                        'post_type' => 'st_hotel',
                        'lat' => (float)$val['lat'],
                        'lng' => (float)$val['lng'],
                        'icon_mk' => (empty($val['icon']))? 'http://maps.google.com/mapfiles/marker_black.png': $val['icon'],
                        'content_html' => preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/property' , null , array( 'post_type' => '', 'data' => $val ) ) ),
                        'content_adv_html' => preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/property' , null , array( 'post_type' => '', 'data' => $val ) ) ),
                    );
                }
            }
            if($location_center == '[,]')
                $location_center = '[0,0]';
            if($show_circle == 'no') {
                $range = 0;
            }
            $data_tmp               = array(
                'location_center' => $location_center ,
                'zoom'            => $zoom ,
                'data_map'        => $data_map ,
                'height'          => 500 ,
                'style_map'       => 'normal' ,
                'number'          => $number ,
                'range'           => $range ,
            );
            $data_tmp[ 'data_tmp' ] = $data_tmp;
            $html                   = '<div class="map_single">'.st()->load_template( 'hotel/elements/detail' , 'map' , $data_tmp ).'</div>';
            return $html;
        }
    }
}

st_reg_shortcode( 'st_hotel_detail_map' , 'st_hotel_detail_map' );





/**
 * NEW STYLE SINGLE HOTEL
 */

if(!function_exists('st_vc_map_gallery')){
    function st_vc_map_gallery($atts, $content = false){
        wp_enqueue_script( 'owl-carousel.js');
        $output = $style = $map_style = $num_image = $extra_class = $style_tour = $service_type_el = '';
        extract(shortcode_atts(array(
            'map_style' => 'style_icy_blue',
            'style' => 'full_map',
            'num_image' => '3',
            'extra_class' => '',
        ), $atts));
        $output .= '<div class="st-hotel-map-gallery '.$extra_class.'">';
        $output .= st()->load_template('hotel/elements/map_gallery_'.$style, false, array(
            'style' => $style,
            'num_image' => $num_image,
            'map_style' => $map_style,
        ));
        $output .= '</div>';
        return $output;
    }
}

st_reg_shortcode('st_hotel_map_gallery', 'st_vc_map_gallery');



if(!function_exists( 'st_vc_hotel_title_address' )) {
    function st_vc_hotel_title_address($atts, $content = false)
    {
        $atts = shortcode_atts(array(
            'align' => 'text-center',
            'extra_class' => '',
        ),$atts);
        return st()->load_template( 'hotel/elements/title-address' , false , array( 'atts' => $atts ) );

    }
}
st_reg_shortcode('st_hotel_title_address', 'st_vc_hotel_title_address');


if(!function_exists('st_hotel_vc_review_score_list')){
    function st_hotel_vc_review_score_list($atts, $content = false){
        $output = $extra_class = '';
        extract(shortcode_atts(array(
            'extra_class' => ''
        ),$atts));
        $output .= '<div class="st-review-score-list text-center '.$extra_class.'">';
        $output .= st()->load_template( 'hotel/elements/review-score-list' , false , array( 'atts' => $atts ) );
        $output .= '</div>';
        return $output;
    }
}

st_reg_shortcode('st_hotel_review_score_list', 'st_hotel_vc_review_score_list');



if(!function_exists( 'st_vc_hotel_tabs_content' )) {
    function st_vc_hotel_tabs_content($atts, $content = false)
    {
        $atts = shortcode_atts(array(
            'extra_class' => '',
            'tab_align' => '',
            'display_tabs' => 'overview,facilities,policies_fqa,reviews,gallery,check_availability'
        ),$atts);
        return st()->load_template( 'hotel/elements/tabs-content/tabs-content' , false , array( 'atts' => $atts ) );

    }
    st_reg_shortcode('st_hotel_tabs_content', 'st_vc_hotel_tabs_content');
}


/**
 * ST Tour Share
 * @since 1.1.0
 **/

if(!function_exists( 'st_vc_hotel_share' )) {
    function st_vc_hotel_share($atts, $content = false){
        $atts = shortcode_atts(array(
            'extra_class' => ''
        ),$atts);

        extract($atts);
        if(is_singular( 'st_hotel' ) || is_singular( 'location' ) || is_singular( 'page' )) {

            return '<div class="package-info tour_share style-2 '.$extra_class.'" style="clear: both;text-align: right">
                    ' . st()->load_template( 'hotel/share' ) . '
                </div>';
        }
    }
}
st_reg_shortcode( 'st_hotel_share' , 'st_vc_hotel_share' );


if(!function_exists( 'st_vc_hotel_contact_info' )) {
    function st_vc_hotel_contact_info($atts, $content = false)
    {
        $atts = shortcode_atts(array(
            'extra_class' => '',
        ),$atts);
        return st()->load_template( 'hotel/elements/contact-info' , false , array( 'atts' => $atts ) );

    }
}
st_reg_shortcode('st_hotel_contact_info', 'st_vc_hotel_contact_info');


if(!function_exists( 'st_vc_hotel_detail_attribute' )) {
    function st_vc_hotel_detail_attribute( $attr , $content = false )
    {
        $default=array(
            'font_size'=>4,
            'item_col'=>12
        );
        $attr=wp_parse_args($attr,$default);
        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/attribute' , null , array( 'attr' => $attr ) );
        }
    }
    st_reg_shortcode( 'st_hotel_detail_attribute' , 'st_vc_hotel_detail_attribute' );

}
if(!function_exists( 'st_vc_search_hotel_result' )) {
    function st_vc_search_hotel_result( $arg = array() )
    {
        $default = array(
            'style'    => '2' ,
            'taxonomy' => '' ,
        );
        $arg     = wp_parse_args( $arg , $default );

        if(!get_post_type() == 'st_hotel' and get_query_var( 'post_type' ) != "st_hotel")
            return;

        return st()->load_template( 'hotel/search-elements/result' , false , array( 'arg' => $arg ) );
    }
    st_reg_shortcode( 'st_search_hotel_result' , 'st_vc_search_hotel_result' );

}
if(!function_exists( 'st_vc_search_hotel_result_ajax' )) {
    function st_vc_search_hotel_result_ajax( $arg = array() )
    {
        $default = array(
            'style'    => '2' ,
            'taxonomy' => '' ,
        );
        $arg     = wp_parse_args( $arg , $default );

        if(!get_post_type() == 'st_hotel' and get_query_var( 'post_type' ) != "st_hotel")
            return;

        return st()->load_template( 'hotel/search-elements/result-ajax' , false , array( 'arg' => $arg ) );
    }
    st_reg_shortcode( 'st_search_hotel_result_ajax' , 'st_vc_search_hotel_result_ajax' );

}
if(!function_exists( 'st_vc_search_hotel_title' )) {
    function st_vc_search_hotel_title( $arg = array() )
    {
        if(!get_post_type() == 'st_hotel' and get_query_var( 'post_type' ) != "st_hotel")
            return;

        $default = array(
            'search_modal' => 1
        );

        wp_enqueue_script('magnific.js' );

        extract( wp_parse_args( $arg , $default ) );
        $hotel = new STHotel();
        $a     = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags( $hotel->get_result_string() ) . '</span>';

        if($search_modal) {
            $a .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
        }
        $a .= '</h3>';

        return $a;
    }
    st_reg_shortcode( 'st_search_hotel_title' , 'st_vc_search_hotel_title' );

}
if(!function_exists( 'st_hotel_list_room_func' )) {
    function st_hotel_list_room_func( $attr )
    {
        $data = shortcode_atts(
            array(
                'st_rows'         => 2 ,
                'st_items_in_row' => 3 ,
                'is_title'        => 'yes' ,
                'is_facilities'   => 'yes' ,
                'is_price'        => 'yes'

            ) , $attr , 'st_hotel_list_room' );
        extract( $data );
        $arg = array(
            'post_type'      => 'hotel_room' ,
            'posts_per_page' => $st_items_in_row * $st_rows ,
            'post_status'    => 'publish' ,
        );
        query_posts( $arg );
        $return = "";
        $return .= "<div class='st_hotel_list_room st_grid'>";
        if(have_posts()) {
            while( have_posts() ) {
                the_post();
                $return .= st()->load_template( 'vc-elements/st-hotel-list-room/st_hotel_list_room' , null , $data );
            }
        }
        wp_reset_postdata();
        $return .= "</div>";
        return $return;

    }

    st_reg_shortcode( 'st_hotel_list_room' , 'st_hotel_list_room_func' );

}
if(!function_exists( 'st_vc_hotel_detail_photo' )) {
    function st_vc_hotel_detail_photo( $attr , $content = false )
    {
        $default = array(
            'style' => 'slide'
        );
        $attr    = wp_parse_args( $attr , $default );

        if(is_singular( 'st_hotel' )) {
            return st()->load_template( 'hotel/elements/photo' , null , array( 'attr' => $attr ) );
        }
    }
    st_reg_shortcode( 'st_hotel_detail_photo' , 'st_vc_hotel_detail_photo' );

}
if (!function_exists('st_vc_search_hotel_room_result')) {
    function st_vc_search_hotel_room_result($arg = array())
    {
        $default = array(
            'style'    => '2',
            'taxonomy' => '',
        );
        $arg = wp_parse_args($arg, $default);

        return st()->load_template('hotel-room/search-elements/result', false, array('arg' => $arg));
    }

    st_reg_shortcode('st_search_hotel_room_result', 'st_vc_search_hotel_room_result');

}
if (!function_exists('st_vc_search_hotel_room_result_ajax')) {
    function st_vc_search_hotel_room_result_ajax($arg = array())
    {
        $default = array(
            'style'    => '2',
            'taxonomy' => '',
        );
        $arg = wp_parse_args($arg, $default);

        return st()->load_template('hotel-room/search-elements/result-ajax', false, array('arg' => $arg));
    }

    st_reg_shortcode('st_search_hotel_room_result_ajax', 'st_vc_search_hotel_room_result_ajax');

}
if(!function_exists( 'st_search_hotel_room_title' )) {
    function st_search_hotel_room_title( $arg = array() )
    {
        if(!get_post_type() == 'hotel_room' and get_query_var( 'post_type' ) != "hotel_room")
            return;

        $default = array(
            'search_modal' => 1
        );

        wp_enqueue_script('magnific.js' );
        extract( wp_parse_args( $arg , $default ) );

        $room = new STRoom();
        $a     = '<h3 class="booking-title"><span id="count-filter-tour">' . balanceTags( $room->get_result_string() ) . '</span>';

        if($search_modal) {
            $a .= '<small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">' . __( 'Change search' , ST_TEXTDOMAIN ) . '</a></small>';
        }
        $a .= '</h3>';

        return $a;
    }
    st_reg_shortcode( 'st_search_hotel_room_title' , 'st_search_hotel_room_title' );

}
if(!function_exists( 'st_vc_list_hotel' )) {
    function st_vc_list_hotel( $attr , $content = false )
    {
        global $st_search_args;
        $default = array(
            'st_ids'                 => "" ,
            'st_number_ht'           => 4 ,
            'st_order'               => '' ,
            'st_orderby'             => '' ,
            'st_ht_of_row'           => 4 ,
            'st_style_ht'            => 'hot-deals' ,
            'only_featured_location' => 'no' ,
            'st_location'            => '' ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_hotel');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $default['taxonomies--'. $name] = '';
            }
        }
        $data = shortcode_atts( $default, $attr , 'st_list_hotel' );
        extract( $data );
        $st_search_args = $data;
        if($st_style_ht == "last_minute_deals") $st_style_ht = "grid2";
        $query = array(
            'post_type'      => 'st_hotel' ,
            'posts_per_page' => $st_number_ht ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby
        );
        $st_search_args['featured_location']=STLocation::inst()->get_featured_ids();
        $hotel = STHotel::inst();
        $hotel->alter_search_query();
        query_posts($query);
        $r = st()->load_template( 'vc-elements/st-list-hotel/loop' , $st_style_ht , $data );
        $hotel->remove_alter_search_query();
        wp_reset_query();
        return $r;
    }
    st_reg_shortcode( 'st_list_hotel' , 'st_vc_list_hotel' );

}
if(!function_exists( 'st_list_hotel_related' )) {
    function st_list_hotel_related( $attr , $content = false )
    {
        global $st_search_args;
        $data_vc = STHotel::get_taxonomy_and_id_term_tour();
        $param   = array(
            'title'          => '' ,
            'st_ids'         => '' ,
            'sort_taxonomy'  => '' ,
            'posts_per_page' => 3 ,
            'st_orderby'     => 'ID' ,
            'st_order'       => 'DESC' ,
            'font_size'      => '3' ,
            'number_of_row'  => 1
        );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data    = shortcode_atts(
            $param , $attr , 'st_list_hotel_related' );
        extract( $data );
        $st_search_args = $data;
        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type'      => 'st_hotel' ,
            'posts_per_page' => $posts_per_page ,
            'post_status'    => 'publish' ,
            'paged'          => $page ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby ,
            'post__not_in'   => array( get_the_ID() )
        );
        $hotel = STHotel::inst();
        $hotel->alter_search_query();
        query_posts($query);
        $r = "<div class='list_hotel_related'>" . st()->load_template( 'vc-elements/st-list-hotel/loop-hot' , 'deals' ) . "</div>";
        $hotel->remove_alter_search_query();
        wp_reset_query();
        if(!empty( $title ) and !empty( $r )) {
            $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
        }
        return $r;
    }
    st_reg_shortcode( 'st_list_hotel_related' , 'st_list_hotel_related' );

}