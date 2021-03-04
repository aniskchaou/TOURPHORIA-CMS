<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 14-11-2018
     * Time: 8:16 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
    $post_id      = get_the_ID();
    $thumbnail_id = get_post_thumbnail_id();
    $price        = STTour::get_info_price();
?>
<div class="item">
    <div class="thumb">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo wp_get_attachment_image_url( $thumbnail_id, array(80, 80) ); ?>" alt="<?php echo TravelHelper::get_alt_image($thumbnail_id); ?>"
                 class="img-responsive img-full">
        </a>
    </div>
    <div class="content">
        <h4 class="title"><a href="<?php the_permalink() ?>" class="st-link c-main"><?php the_title() ?></a></h4>
        <div class="price-wrapper">
            <?php echo __('from', ST_TEXTDOMAIN); ?> <span class="price"><?php echo TravelHelper::format_money( $price['price_new'] ); ?></span>
        </div>
    </div>
</div>