<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * archive
 *
 * Created by ShineTheme
 *
 */

if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/page/archive');
    return;
}
    get_header();

    ?>
    <div class="container">
        <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
    </div>
    <div class="container">
        <div class="row">
            <?php $sidebar_pos = apply_filters('st_blog_sidebar', 'right');
            if ($sidebar_pos == "left") {
                get_sidebar('blog');
            }
            ?>
            <div class="<?php echo apply_filters('st_blog_sidebar', 'right') == 'no' ? 'col-sm-12' : 'col-sm-9'; ?>">
                <?php
                if (have_posts()):
                    while (have_posts()) {
                        the_post();
                        echo st()->load_template('blog/content-loop');
                    }
                    TravelHelper::paging();
                else:
                    echo st()->load_template('blog/content-none');
                endif;
                ?>
            </div>
            <?php $sidebar_pos = apply_filters('st_blog_sidebar', 'right');
            if ($sidebar_pos == "right") {
                get_sidebar('blog');
            }
            ?>
        </div>
    </div>
    <?php
    get_footer();
?>