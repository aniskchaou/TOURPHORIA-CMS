<?php
/**
 * Template Name: Transfer Search Result
 */
if(!st_check_service_available( 'st_cars' )) {
    wp_redirect( home_url() );
    die;
}
global $st_search_query , $st_search_page_id;
$old_page_content = '';

while( have_posts() ) {
    the_post();
    $st_search_page_id = get_the_ID();
    $old_page_content  = get_the_content();
}

$transfer = new STCarTransfer();
$data = $st_search_query = $transfer->get_search_results();

get_header();

echo st()->load_template( 'search-loading' );
get_template_part( 'breadcrumb' );
$result_string = '';

?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template( 'car_transfer/search-form' ); ?>
    </div>
    <div class="container mb20">
        <?php
            $transfer_from = (int)STInput::get('transfer_from','');
            $transfer_to = (int)STInput::get('transfer_to','');
            $roundtrip = STInput::get('roundtrip','');
            $route = $transfer->get_routes($transfer_from, $transfer_to, $roundtrip);
            $time = $transfer->get_driving_distance($transfer_from, $transfer_to, $roundtrip);
        ?>
        <div class="transfer-map mt20" data-route="<?php echo esc_attr( json_encode($route) ); ?>">
            <div class="transfer-map-content">
                
            </div>
            <div class="transfer-map-infor">
                <i class="fa fa-clock-o mr10"></i> <?php echo __('Travel time about: ', ST_TEXTDOMAIN); ?>
                <?php
                    $hour = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', ST_TEXTDOMAIN ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', ST_TEXTDOMAIN );
                    $minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', ST_TEXTDOMAIN ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', ST_TEXTDOMAIN );
                    echo esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . $time['distance'] . __('Km', ST_TEXTDOMAIN);
                ?>
            </div>
        </div>
        <?php echo apply_filters( 'the_content' , $old_page_content ); ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>