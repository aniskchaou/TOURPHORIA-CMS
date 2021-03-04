<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/30/14
 * Time: 5:13 PM
 */
if(!st_check_service_available( 'st_rental' )) {
    return;
}
/**
 * ST Rental Detail Map
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_detail_map' )) {
    function st_rental_detail_map($attr)
    {
        if(is_singular( 'st_rental' )) {
            $default = array(
                'number'      => '12' ,
                'range'       => '20' ,
                'show_circle' => 'no' ,
            );
			$dump = wp_parse_args( $attr , $default );
            extract( $dump );
            $lat   = get_post_meta( get_the_ID() , 'map_lat' , true );
            $lng   = get_post_meta( get_the_ID() , 'map_lng' , true );
            $zoom  = get_post_meta( get_the_ID() , 'map_zoom' , true );
            $class = STRental::inst();
            $data  = $class->get_near_by( get_the_ID() , $range , $number );
            $location_center                     = '[' . $lat . ',' . $lng . ']';
            $data_map                            = array();
            $data_map[ 0 ][ 'id' ]               = get_the_ID();
            $data_map[ 0 ][ 'name' ]             = get_the_title();
            $data_map[ 0 ][ 'post_type' ]        = get_post_type();
            $data_map[ 0 ][ 'lat' ]              = $lat;
            $data_map[ 0 ][ 'lng' ]              = $lng;
            $data_map[ 0 ][ 'icon_mk' ]          = get_template_directory_uri() . '/img/mk-single.png';
            $data_map[ 0 ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => '' ) ) );
            $data_map[ 0 ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => '' ) ) );
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
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => '' ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => '' ) ) );
                        $stt++;
                    }
                endforeach;
                wp_reset_postdata();
            }
            $properties = $class->properties_near_by(get_the_ID(), $lat, $lng, $range);
            if( !empty($properties)){
                foreach($properties as $key => $val){
                    $data_map[] = array(
                        'id' => get_the_ID(),
                        'name' => $val['name'],
                        'post_type' => 'st_rental',
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

    st_reg_shortcode( 'st_rental_map' , 'st_rental_detail_map' );
}

/**
 * ST Rental Detail Review Summary
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_detail_review_summary' )) {
    function st_rental_detail_review_summary()
    {
        if(is_singular( 'st_rental' )) {
            return st()->load_template( 'rental/elements/review_summary' );
        }
    }

    st_reg_shortcode( 'st_rental_review_summary' , 'st_rental_detail_review_summary' );
}

/**
 * ST Rental Detail Review Detail
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_detail_review_detail' )) {
    function st_rental_detail_review_detail()
    {
        if(is_singular( 'st_rental' )) {
            return st()->load_template( 'rental/elements/review_detail' );
        }
    }

    st_reg_shortcode( 'st_rental_review_detail' , 'st_rental_detail_review_detail' );
}

/**
 * ST Rental Review
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_review' )) {
    function st_rental_review( $attr = array() )
    {
        if(is_singular( 'st_rental' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            if(comments_open() and st()->get_option( 'rental_review' ) == 'on') {
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

    st_reg_shortcode( 'st_rental_review' , 'st_rental_review' );

}


/**
 * ST Rental Nearby
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_nearby' )) {
    function st_rental_nearby( $arg = array() )
    {
        if(is_singular( 'st_rental' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $arg , $default ) );
            return st()->load_template( 'rental/elements/nearby' , null , array( 'arg' => $arg ) );
        }
    }

    st_reg_shortcode( 'st_rental_nearby' , 'st_rental_nearby' );

}

/**
 * ST Rental Add Review
 * @since 1.1.0
 **/
    st_reg_shortcode( 'st_rental_add_review' , 'st_rental_add_review' );


if(!function_exists( 'st_rental_add_review' )) {
    function st_rental_add_review()
    {
        if(is_singular( 'st_rental' )) {
            return '<div class="text-right mb10"><a class="btn btn-primary" href="' . get_comments_link() . '">' . __( 'Write a review' , ST_TEXTDOMAIN ) . '</a>
                                        </div>';
        }
    }
}

/**
 * ST Rental Price
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_price' )) {
    function st_rental_price()
    {
        if(is_singular( 'st_rental' )) {
            return st()->load_template( 'rental/elements/price' );
        }
    }

    st_reg_shortcode( 'st_rental_price' , 'st_rental_price' );

}

/**
 * ST Rental Video
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_video' )) {
    function st_rental_video()
    {
        if(is_singular( 'st_rental' )) {
            if($video = get_post_meta( get_the_ID() , 'video' , true )) {
                return "<div class='media-responsive'>" . wp_oembed_get( $video ) . "</div>";
            }
        }
    }

    st_reg_shortcode( 'st_rental_video' , 'st_rental_video' );

}

/**
 * ST Rental Header
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_header' )) {
    function st_rental_header( $arg )
    {
        if(is_singular( 'st_rental' )) {
            return st()->load_template( 'rental/elements/header' , false , array( 'arg' => $arg ) );
        }
        return false;
    }

    st_reg_shortcode( 'st_rental_header' , 'st_rental_header' );

}


/**
 * ST Rental Book Form
 * @since 1.1.0
 **/


if(!function_exists( 'st_rental_book_form' )) {
    function st_rental_book_form( $arg = array() )
    {
        if(is_singular( 'st_rental' )) {
            return st()->load_template( 'rental/elements/book_form' , false , array( 'arg' => $arg ) );
        }
        return false;
    }
}

st_reg_shortcode( 'st_rental_book_form' , 'st_rental_book_form' );

if(!function_exists('st_rental_calendar')){
    function st_rental_calendar($args){
        if(is_singular('st_rental')){
            return st()->load_template('vc-elements/st-rental/st_rental_calendar',null,array('attr'=>$args));
        }
        return false;
    }
}
st_reg_shortcode('st_rental_calendar','st_rental_calendar');
