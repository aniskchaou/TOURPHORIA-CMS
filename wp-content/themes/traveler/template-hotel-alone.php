<?php
/**
 * Template Name: Hotel Single
 */
get_header("hotel-alone");
?>
    <div id="main-content">
        <?php do_action('helios_before_main_content') ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php
                            if (is_page_template('default')) {
                                ?>
                                <h2 class="entry-title">
                                    <?php the_title(); ?>
                                </h2>
                            <?php } ?>
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php
                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', ST_TEXTDOMAIN),
                                    'after' => '</div>',
                                ));
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile; ?>
                </div>
            </div>
        </div>
        <?php do_action('helios_after_main_content') ?>
    </div>
<?php get_footer("hotel-alone"); ?>