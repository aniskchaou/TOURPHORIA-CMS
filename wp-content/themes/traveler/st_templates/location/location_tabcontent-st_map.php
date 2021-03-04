<?php
$zoom = get_post_meta( get_the_ID() , 'map_zoom' , true );
if(empty( $zoom ) or !$zoom) {
    $zoom = 15;
}

$map_location_style = get_post_meta(get_the_ID(),'map_location_style',true);
if (!$map_location_style){$map_location_style = 'normal';}

$default = array(
    'tab_icon_'          => 'fa fa-map-marker' ,
    'map_height'         => 500 ,
    'map_spots'          => 99 ,
    'map_location_style' => 'normal' ,
    'tab_item_key'       => "location_map" ,
    'show_circle'        => ''
);
$data    = extract( wp_parse_args( $default , $value ) );
$st_type = array();
if($is_hotel = st_check_service_available( 'st_hotel' )) {
    $st_type[ ] = 'st_hotel';
}
if($is_cars = st_check_service_available( 'st_cars' )) {
    $st_type[ ] = 'st_cars';
}
if($st_tours = st_check_service_available( 'st_tours' )) {
    $st_type[ ] = 'st_tours';
}
if($st_rental = st_check_service_available( 'st_rental' )) {
    $st_type[ ] = 'st_rental';
}
if($st_activity = st_check_service_available( 'st_activity' )) {
    $st_type[ ] = 'st_activity';
}


$map_lat                    = get_post_meta( get_the_ID() , 'map_lat' , true );
$map_lng                    = get_post_meta( get_the_ID() , 'map_lng' , true );
$location_center            = '[' . $map_lat . ',' . $map_lng . ']';
$_SESSION[ 'el_post_type' ] = $st_type;
$st_location                = new st_location();
add_filter( 'posts_where' , array( $st_location , '_get_query_where' ) );
$query = array(
    'post_type'      => $st_type ,
    'posts_per_page' => $map_spots ,
    'post_status'    => 'publish' ,
);
global $wp_query;
query_posts( $query );
unset( $_SESSION[ 'el_post_type' ] );
remove_filter( 'posts_where' , array( $st_location , '_get_query_where' ) );
$stt = 0;
$data_map = array();
while( have_posts() ) {
    the_post();
    $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
    $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
    if(!empty( $map_lat ) and !empty( $map_lng ) and is_numeric( $map_lat ) and is_numeric( $map_lng )) {
        $post_type                       = get_post_type();
        $data_map[ $stt ][ 'id' ]        = get_the_ID();
        $data_map[ $stt ][ 'name' ]      = get_the_title();
        $data_map[ $stt ][ 'post_type' ] = $post_type;
        $data_map[ $stt ][ 'lat' ]       = $map_lat;
        $data_map[ $stt ][ 'lng' ]       = $map_lng;
        $post_type_name                  = get_post_type_object( $post_type );
        $post_type_name->label;
        switch( $post_type ) {
            case"st_hotel";
                $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                break;
            case"st_rental";
                $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                break;
            case"st_cars";
                $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                break;
            case"st_tours";
                $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                break;
            case"st_activity";
                $data_map[ $stt ][ 'icon_mk' ]          = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                $data_map[ $stt ][ 'content_html' ]     = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                $data_map[ $stt ][ 'content_adv_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-map/loop-adv/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                break;
        }
        $stt++;
    }
}

wp_reset_query();
if(empty( $location_center ) or $location_center == '[,]')
    $location_center = '[0,0]';
$data_tmp               = array(
    'location_center'    => $location_center ,
    'zoom'               => $zoom ,
    'data_map'           => $data_map ,
    'height'             => $map_height ,
    'style_map'          => $map_location_style ,
    'st_type'            => $st_type ,
    'number'             => $map_spots ,
    'show_search_box'    => 'no' ,
    'show_data_list_map' => 'no' ,
    'range'              => '0' ,
);
$data_tmp[ 'data_tmp' ] = $data_tmp;
echo "<div class='single_location'>".st()->load_template( 'vc-elements/st-list-map-new/html' , '' , $data_tmp )."</div>";



