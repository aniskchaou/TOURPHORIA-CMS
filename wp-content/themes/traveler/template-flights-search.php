<?php
/**
 * Template Name: Flight Search Result
 */
if(!st_check_service_available( 'st_flight' ) || !class_exists('ST_Flights_Controller')) {
    wp_redirect( home_url() );
    die;
}
global $st_search_page_id;

$old_page_content = '';
while( have_posts() ) {
    the_post();
    $st_search_page_id = get_the_ID();
    $old_page_content  = get_the_content();
}
global $wp_query, $st_flight_search_query, $st_flight_search_return_query;
$paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;
ST_Flights_Controller::inst()->alter_search_query();
query_posts(
    array(
        'post_type' => 'st_flight' ,
        's'         => '' ,
        'paged'     => $paged1
    )
);
$st_flight_search_query = $wp_query;

ST_Flights_Controller::inst()->remove_alter_search_query();
wp_reset_query();

if(STInput::get('flight_type',false) == 'return') {
    ST_Flights_Controller::inst()->alter_search_return_query();
    $paged2 = isset( $_GET['paged2'] ) ? (int) $_GET['paged2'] : 1;
    query_posts(
        array(
            'post_type' => 'st_flight',
            's' => '',
            'paged' => $paged2
        )
    );
    $st_flight_search_return_query = $wp_query;
    ST_Flights_Controller::inst()->remove_alter_search_return_query();
}
wp_reset_query();
get_header();

echo st()->load_template( 'search-loading' );
get_template_part( 'breadcrumb' );
$result_string = '';
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-flight-dialog">
        <?php echo st_flight_load_view( 'flights/search-form-2' ); ?>
    </div>
    <div class="container mb20">
        <?php echo apply_filters( 'the_content' , $old_page_content ); ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>