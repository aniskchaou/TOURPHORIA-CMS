<?php
/**
 * Template Name: Single Tour Modern
 */
?>
<?php get_header('tour-modern'); ?>
    <div class="st-single-tour-modern-page">
        <div class="container">
            <?php
            while (have_posts()) {
                the_post();
                the_content();
            }
            wp_reset_query();
            ?>
        </div>
    </div>
<?php get_footer('tour-modern'); ?>