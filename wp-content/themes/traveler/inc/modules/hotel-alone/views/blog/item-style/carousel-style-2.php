<?php
/**
 * Created by ShineTheme.
 * Developer: sejuani37
 * Date: 8/15/2017
 * Version: 1.0
 */
$thumb_img = get_the_post_thumbnail_url(get_the_ID(), 'full');

$class_bg = Hotel_Alone_Helper::inst()->build_css('background: #ccc url('.$thumb_img.') !important');

?>
<div class="item st-post-slider style-2 <?php echo esc_attr($class_bg); ?>">
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
    </div>
</div>
