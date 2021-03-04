<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Loop content blog
 *
 * Created by ShineTheme
 *
 */

?>
<div class="col-xs-12 col-sm-6">
    <div <?php  post_class('article post') ?> >
        <?php if(get_post_format()):?>
            <header class="post-header">
                <?php echo st()->load_template('blog/single/loop_st_tour_grid/loop',get_post_format());?>
            </header>
        <?php elseif(has_post_thumbnail() and get_the_post_thumbnail() ):?>
            <header class="post-header">
                <?php echo st()->load_template('blog/single/loop_st_tour_grid/loop-image');?>
            </header>
        <?php endif;?>
        <div class="post-inner">
            <?php echo st()-> load_template('blog/single/content-meta','st_tour_grid');?>
            <div class="post-desciption">
                <span>
                    <?php
                    if (strlen(get_the_excerpt())>apply_filters('st_tour_grid_blog_excerpt_max_length',180)) {
                        echo substr(get_the_excerpt(),0,apply_filters('st_tour_grid_blog_excerpt_max_length',180))." [...]";
                    }else {
                        the_excerpt();
                    }

                    ?>
                </span>
            </div>
            <a class="st_tour_ver_btn bgr-main-hover text-white text-uppercase" href="<?php the_permalink()?>"><strong><?php esc_html_e('Read More','traveler')?></strong></a>
        </div>
    </div>
</div>