<?php

/**
 * ST Thumbnail Cars
 * @since 1.1.0
 **/
if(!st_check_service_available( 'st_cars' )) {
    return;
}


if(!function_exists( 'st_thumbnail_cars_func' )) {
    function st_thumbnail_cars_func()
    {
        if(is_singular( 'st_cars' )) {
            return st()->load_template( 'cars/elements/image' , 'featured' );
        }
    }

    st_reg_shortcode( 'st_thumbnail_cars' , 'st_thumbnail_cars_func' );
}

/**
 * ST Excerpt Cars
 * @since 1.1.0
 **/

if(!function_exists( 'st_excerpt_cars_func' )) {
    function st_excerpt_cars_func()
    {
        if(is_singular( 'st_cars' )) {
            return '<p class="">' . get_the_excerpt() . "</p><hr>";
        }
    }

    st_reg_shortcode( 'st_excerpt_cars' , 'st_excerpt_cars_func' );
}

/**
 * ST Detail Location Cars
 * @since 1.1.0
 **/

if(!function_exists( 'st_detail_date_location_cars_func' )) {
	function st_detail_date_location_cars_func()
	{
		if(is_singular( 'st_cars' )) {

			wp_enqueue_script('magnific.js' );

			$default = array(
				'drop-off'             => __( 'none' , ST_TEXTDOMAIN ) ,
				'pick-up'              => __( 'none' , ST_TEXTDOMAIN ) ,
				'location_id_drop_off' => '' ,
				'location_id_pick_up'  => '' ,
			);

			$_REQUEST = wp_parse_args( $_REQUEST , $default );


			if(!empty( $_REQUEST[ 'pick-up-date' ] )) {
				$pick_up_date = $_REQUEST[ 'pick-up-date' ];
			} else {
				$pick_up_date = date( TravelHelper::getDateFormat() , strtotime( "now" ) );
			}
			if(!empty( $_REQUEST[ 'pick-up-time' ] )) {
				$pick_up_time = $_REQUEST[ 'pick-up-time' ];
			} else {
				$pick_up_time = "12:00 AM";
			}
			if(STInput::request( "location_id_pick_up" )) {
				$address_pick_up = get_the_title( STInput::request( "location_id_pick_up" ) );
			} else {
				$address_pick_up = STInput::request( 'pick-up' );
			}
			if(!empty($_REQUEST[ 'st_google_location_pickup' ])){
				$address_pick_up = STInput::request('st_google_location_pickup', '');
			}
			$pick_up = '<h5>' . st_get_language( 'car_pick_up' ) . ':</h5>
        <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i>' . $address_pick_up . '</p>
        <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i>' . $pick_up_date . '</p>
        <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i>' . $pick_up_time . '</p>';

			if(!empty( $_REQUEST[ 'drop-off-date' ] )) {
				$drop_off_date = $_REQUEST[ 'drop-off-date' ];
			} else {
				$drop_off_date = $pick_up_date = date( TravelHelper::getDateFormat() , strtotime( "+1 day" ) );
			}

			if(!empty( $_REQUEST[ 'drop-off-time' ] )) {
				$drop_off_time = $_REQUEST[ 'drop-off-time' ];
			} else {
				$drop_off_time = "12:00 AM";
			}
			if(STInput::request( 'location_id_drop_off' )) {
				$address_drop_off = get_the_title( STInput::request( 'location_id_drop_off' ) );
			} elseif(STInput::request('drop-off')) {
				$address_drop_off = STInput::request( 'drop-off' );
			}else{
				$address_drop_off=$address_pick_up;
			}
			if(!empty($_REQUEST[ 'st_google_location_dropoff' ])){
				$address_drop_off = STInput::request('st_google_location_dropoff', '');
			}
			$drop_off = '   <h5>' . st_get_language( 'car_drop_off' ) . ':</h5>
                        <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i>' . $address_drop_off . '</p>
                        <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i>' . $drop_off_date . '</p>
                        <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i>' . $drop_off_time . '</p>';

			$logo = get_post_meta( get_the_ID() , 'cars_logo' , true );
			if(is_numeric($logo)){
				$logo = wp_get_attachment_url($logo);
			}
			if(!empty( $logo )) {
				$logo = '<img src="' . bfi_thumb( $logo , array( 'width'  => '120' ,
				                                                 'height' => '120'
					) ) . '" alt="logo" />';
			}
			$about = get_post_meta( get_the_ID() , 'cars_about' , true );
			if(!empty( $about )) {
				$about = ' <h5>' . st_get_language( 'car_about' ) . '</h5>
                      <p>' . get_post_meta( get_the_ID() , 'cars_about' , true ) . '</p>';
			}

			return '<div class="booking-item-deails-date-location border-main">
                        <ul>
                            <li class="text-center">
                                ' . $logo . '
                            </li>
                            <li>
                                <p class="f-20 text-center">' . get_post_meta( get_the_ID() , 'cars_name' , true ) . '</p>
                            </li>
                            <li>
                                <h5>' . st_get_language( 'car_phone' ) . ':</h5>
                                <p><i class="fa fa-phone box-icon-inline box-icon-gray"></i>' . get_post_meta( get_the_ID() , 'cars_phone' , true ) . '</p>
                            </li>
                             <li>
                                <h5>' . st_get_language( 'car_email' ) . ':</h5>
                                <p><i class="fa fa-envelope-o box-icon-inline box-icon-gray"></i>' . get_post_meta( get_the_ID() , 'cars_email' , true ) . '</p>
                            </li>
                            <li>
                                ' . $about . '
                            </li>
                            <li>' . $pick_up . '</li>
                            <li>' . $drop_off . '</li>
                        </ul>
                        <a href="#search-dialog" data-effect="mfp-zoom-out" class="btn btn-primary popup-text" href="#">' . st_get_language( 'change_location_and_date' ) . '</a>
                    </div>';
		}
	}

	st_reg_shortcode( 'st_detail_date_location_cars' , 'st_detail_date_location_cars_func' );
}

/**
 * ST Car Video
 * @since 1.1.0
 **/

if(!function_exists( 'st_car_video' )) {
    function st_car_video( $attr = array() )
    {
        if(is_singular( 'st_cars' )) {
            if($video = get_post_meta( get_the_ID() , 'video' , true )) {
                return "<div class='media-responsive'>" . wp_oembed_get( $video ) . "</div>";
            }
        }
    }
}
st_reg_shortcode( 'st_car_video' , 'st_car_video' );

/**
 * ST Activity Detail Review Summary
 * @since 1.1.5
 **/

if(!function_exists( 'st_car_review' )) {
    function st_car_review()
    {
        if(is_singular( 'st_cars' )) {
            if(comments_open() and st()->get_option( 'car_review' )) {
                ob_start();
                comments_template( '/reviews/reviews.php' );
                return @ob_get_clean();
            }

        }
    }
}
st_reg_shortcode( 'st_car_review' , 'st_car_review' );

/**
 * ST Car Detail Map
 * @since 1.1.3
 **/


if(!function_exists( 'st_cars_detail_map' )) {
    function st_cars_detail_map( $attr )
    {
        if(is_singular( 'st_cars' )) {
            $default = array(
                'number'      => '12' ,
                'range'       => '20' ,
                'show_circle' => 'no' ,
            );
			$dump = wp_parse_args( $attr , $default );
            extract( $dump );
            $lat                                 = get_post_meta( get_the_ID() , 'map_lat' , true );
            $lng                                 = get_post_meta( get_the_ID() , 'map_lng' , true );
            $zoom                                = get_post_meta( get_the_ID() , 'map_zoom' , true );
            $class = new STCars();
            $data  = $class->get_near_by( get_the_ID() , $range , $number );
            $location_center                     = '[' . $lat . ',' . $lng . ']';
            $data_map                            = array();
            $data_map[ 0 ][ 'id' ]               = get_the_ID();
            $data_map[ 0 ][ 'name' ]             = get_the_title();
            $data_map[ 0 ][ 'post_type' ]        = get_post_type();
            $data_map[ 0 ][ 'lat' ]              = $lat;
            $data_map[ 0 ][ 'lng' ]              = $lng;
            $data_map[ 0 ][ 'icon_mk' ]          = get_template_directory_uri() . '/img/mk-single.png';
            $data_map[ 0 ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => '' ) ) );
            $data_map[ 0 ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => '' ) ) );
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
                        $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                        $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => '' ) ) );
                        $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => '' ) ) );
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

    st_reg_shortcode( 'st_cars_detail_map' , 'st_cars_detail_map' );
}

/**
 * ST Cars Detail Review Detail
 * @since 1.1.0
 **/


if(!function_exists( 'st_car_detail_review_detail' )) {
    function st_car_detail_review_detail()
    {
        if(is_singular( 'st_cars' )) {
            return st()->load_template( 'cars/elements/review_detail' );
        }
    }
}
st_reg_shortcode( 'st_car_detail_review_detail' , 'st_car_detail_review_detail' );
/**
 * since 1.1.7
 * Car review summary (like hotel)
 */

if(!function_exists( 'st_car_detail_review_summary' )) {
    function st_car_detail_review_summary()
    {
        if(is_singular( 'st_cars' )) {
            return st()->load_template( 'cars/elements/review_summary' );
        }

    }
}
st_reg_shortcode( 'st_car_detail_review_summary' , 'st_car_detail_review_summary' );

/**
 * ST Cars Detail Review Detail
 * @since 1.1.0
 **/



if(!function_exists( 'st_car_show_discount' )) {
    function st_car_show_discount()
    {
        if(is_singular( 'st_cars' )) {
            return st()->load_template( 'cars/elements/car_show_info_discount' );
        }
    }
}
st_reg_shortcode( 'st_car_show_discount' , 'st_car_show_discount' );


/**
 * ST Cars Distance
 * @since 1.1.0
 **/



if(!function_exists( 'st_car_show_distance' )) {
    function st_car_show_distance()
    {
        if(is_singular( 'st_cars' )) {
            return st()->load_template( 'cars/elements/car_show_info_distance' );
        }
    }
}
st_reg_shortcode( 'st_car_show_distance' , 'st_car_show_distance' );