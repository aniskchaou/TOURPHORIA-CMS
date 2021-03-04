<?php
$st_location_style = st()->get_option('location_tab_type', 'list');
if(st()->get_option( 'location_posts_per_page' )) {
    $st_location_num = st()->get_option( 'location_posts_per_page' );
}
global $wp_query , $st_search_query , $st_search_args;
$location_id    = get_the_ID();
$st_search_args = array( 'st_location' => $location_id );
$location_title = get_the_title();
$post_type      = "st_tours";
$query          = array(
    'post_type'      => $post_type ,
    'post_status'    => 'publish' ,
    'posts_per_page' => $st_location_num ,
    'order'          => apply_filters('st_tab_location_order', 'ASC' ) ,
    'orderby'        => apply_filters('st_tab_location_orderby', 'ID' ),
);
$return         = "";
if(STInput::request( 'style' )) {
    $st_location_style = STInput::request( 'style' );
};
if($st_location_style == "list") {
    $return .= '<ul class="booking-list loop-tours style_list">';
} else {
    $return .= '<div class="row row-wrap">';
}
$tour = STTour::get_instance();
$tour->alter_search_query();
query_posts( $query );
$tour->remove_alter_search_query();
if(have_posts()) {
    while( have_posts() ) {
        the_post();
        if($st_location_style == 'list') {
	        $return .= st()->load_template( 'tours/elements/loop/loop-1', null );
        }else{
	        wp_enqueue_script( 'jquery.matchHeight-min' );
	        $return .= st()->load_template( 'tours/elements/loop/loop-2', null );
        }
    }
} else {
    echo '<div class="col-xs-12"><div class="alert alert-warning">' . __( "There are no available tour for this location, time and/or date you selected." , ST_TEXTDOMAIN ) . '</div></div>';
}
if($st_location_style == "list") {
    $return .= '</ul>';
} else {
    $return .= "</div>";
}
$array = array(
    'post_type'      => $post_type ,
    'location_title' => $location_title ,
    'location_id'    => $location_id
);
$return .= st()->load_template( 'location/result_string' , null , $array );
wp_reset_query();
echo "<div class='col-md-12 col-xs-12'>" . balancetags( $return ) . "</div>";