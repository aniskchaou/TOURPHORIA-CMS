<?php
    /**
     * Template Name: Search All Post Type Result
     */


    global $wp_query, $st_search_query,$st_search_page_id;

    $old_page_content = '';
    while (have_posts()) {
        the_post();
        $st_search_page_id=get_the_ID();
        $old_page_content = get_the_content();
    }
    get_header();

?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template('search/search-all-post-type/search-form'); ?>
    </div>
    <div class="container mb20">
        <?php echo apply_filters('the_content', $old_page_content); ?>
    </div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>