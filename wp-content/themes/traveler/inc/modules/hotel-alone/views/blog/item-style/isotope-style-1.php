<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */

$post_cat_lists = get_the_terms(get_the_ID(), 'category');
$cat_slug = '';
if (is_array($post_cat_lists) && !empty($post_cat_lists)) {
    foreach ($post_cat_lists as $cat) {
        $cat_slug .= ' ' . $cat->slug;
    }
}
?>
<div class="grid-item col-md-4 col-sm-6 col-xs-12 st-post-isotope style-1 <?php echo esc_attr($cat_slug)?>">
    <div class="header-thumb">
        <?php
        if(has_post_thumbnail(get_the_ID())) {
            echo get_the_post_thumbnail(get_the_ID(), array(360, 0));
        }else{
            echo st_get_default_image();
        }
        ?>
    </div>
    <div class="caption-post">
        <span class="time">
            <span class="meta-category">
                <?php the_category(', '); ?>
            </span>  |
            <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>"><?php echo get_the_date(get_option('date_format')) ?></a>
        </span>
        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="short-desc"><?php
            echo wp_trim_words(get_the_excerpt(get_the_ID()), 12, '');
            ?>
        </p>
        <div class="author">
            <span class="name"><?php echo esc_html__('BY', ST_TEXTDOMAIN)?> &nbsp;<span class="main-color"><?php echo get_the_author_meta('user_login'); ?></span></span>
        </div>
    </div>
</div>