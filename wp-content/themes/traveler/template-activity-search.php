<?php
/**
 * Template Name: Activity Search Result
 */

if(!st_check_service_available( 'st_activity' )) {
    wp_redirect( home_url() );
    die;
}

//Redirect new layout if is new layout
$new_layout = st()->get_option('st_theme_style', 'classic');
if($new_layout == 'modern'){
    $layout = get_post_meta(get_the_ID(), 'rs_layout_activity', true);
    if(empty($layout)) $layout = '1';

    echo st()->load_template('layouts/modern/activity/search-page' . $layout);
    return;
}

global $wp_query , $st_search_query , $st_search_page_id;
$old_page_content = '';
while( have_posts() ) {
    the_post();
    $st_search_page_id = get_the_ID();
    $old_page_content  = get_the_content();
}

$activity = STActivity::inst();
$activity->alter_search_query();
if(get_query_var( 'paged' )) {
    $paged = get_query_var( 'paged' );
} else if(get_query_var( 'page' )) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}
query_posts(
    array(
        'post_type' => 'st_activity' ,
        's'         => '' ,
        'paged'     => $paged
    )
);
$st_search_query = $wp_query;
$activity->remove_alter_search_query();
global $wp_query; 

$current_page = get_query_var('paged' );
$total_posts =  $wp_query->found_posts;
if( $total_posts == 0 && $current_page >= 2 ){
    global $wp_rewrite;
    $link = add_query_arg();
    if ($wp_rewrite->using_permalinks()){
        $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
    }else{
        $link = add_query_arg('paged', 1);
    }
    wp_redirect( $link );
}
wp_reset_query();
get_header();

echo st()->load_template( 'search-loading' );
get_template_part( 'breadcrumb' );
$result_string = '';
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template( 'activity/search-form-2' ); ?>
    </div>
    <div class="container mb20">
        <?php echo apply_filters( 'the_content' , $old_page_content ); ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>