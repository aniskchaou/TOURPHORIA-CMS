<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */
$thumb_img = get_the_post_thumbnail_url(get_the_ID(), array(645, 842));

$class_bg = Hotel_Alone_Helper::inst()->build_css('background: #ccc url('.$thumb_img.') !important');

?>
<div class="item st-post-slider style-1 <?php echo esc_attr($class_bg); ?>">
    <div class="bg-white">
        <div class="caption-post text-center">
            <span class="time">
                <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>"><?php echo get_the_date(get_option('date_format')) ?></a>
            </span>
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="meta-category">
                <?php the_category(' '); ?>
            </div>
        </div>
        <div class="hide-caption text-center">
            <span class="time">
                <a href="<?php echo esc_url(get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'))) ?>"><?php echo get_the_date(get_option('date_format')) ?></a>
            </span>
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="meta-category">
                <?php the_category(' '); ?>
            </div>
            <p class="short-desc"><?php
                echo wp_trim_words(get_the_excerpt(get_the_ID()), 23, '');
                ?>
            </p>
            <div class="author">
                <?php
                echo get_avatar( get_the_author_meta( 'ID' ) , 40 );
                ?>
                <span class="name"><?php echo esc_html__('BY', ST_TEXTDOMAIN)?> &nbsp;<span class="main-color"><?php echo get_the_author_meta('user_login'); ?></span></span>
            </div>
        </div>
    </div>
</div>
