<?php
/**
 * Template Name: Single Hotel Modern
 */
?>
<?php get_header('hotel-activity');?>
    <div class="st-single-hotel-modern-page">
    <?php echo st()->load_template('layouts/modern/single_hotel/elements/banner'); ?>
    <div class="container">
        <?php
        while ( have_posts() ) {
            the_post();
            the_content();
        }
        wp_reset_query();
        ?>
    </div>
    </div>

<?php get_footer('hotel-activity');?>