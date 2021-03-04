<?php
/**
 * Template Name: Hotel Room Search Result
 */
if(!st_check_service_available( 'hotel-room' )) {
    wp_redirect( home_url() );
    die;
}
global $wp_query , $st_search_query , $st_search_page_id;
$old_page_content = '';
while( have_posts() ) {
    the_post();
    $st_search_page_id = get_the_ID();
    $old_page_content  = get_the_content();
}
$room = STRoom::inst();
$room->alter_search_query();
if(get_query_var( 'paged' )) {
    $paged = get_query_var( 'paged' );
} else if(get_query_var( 'page' )) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}
query_posts(
    array(
        'post_type' => 'hotel_room' ,
        's'         => '' ,
        'paged'     => $paged
    )
);
$st_search_query = $wp_query;
$room->remove_alter_search_query();
global $wp_query; 
$current_page = get_query_var('paged' );
$total_posts =  $wp_query->found_posts;
if( $total_posts == 0 && $current_page >= 2){
    global $wp_rewrite;
    $link = add_query_arg();
    if ($wp_rewrite->using_permalinks()){
        $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
    }else{
        $link = add_query_arg('paged', 1);
    }
    wp_redirect( $link );
}
get_header();

echo st()->load_template( 'search-loading' );
get_template_part( 'breadcrumb' );
$result_string = '';
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template( 'hotel-room/search-form-2' ); ?>
    </div>
    <div class="container mb20">
        <?php
        echo apply_filters( 'the_content' , $old_page_content );
        ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>