<?php
/**
 * Template Name: Amadeus Flight Search Result
 */
$old_page_content = '';
while( have_posts() ) {
    the_post();
    $old_page_content  = get_the_content();
}
get_header();
echo st()->load_template( 'search-loading' );
get_template_part( 'breadcrumb' );
?>
    <div class="container mb20">
        <?php echo apply_filters( 'the_content' , $old_page_content ); ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>