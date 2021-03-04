<?php
global $post;
?>
<div class="item-service-map">
    <div class="thumb">
        <div class="close-popup-on-map" id="close-popup-on-map">
            <i class="fa fa-times"></i>
        </div>
        <div class="service-tag bestseller">
            <?php echo STFeatured::get_featured(); ?>
        </div>
        <a href="<?php echo get_the_permalink() ?>">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(280, 180), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
            } else {
                echo '<img src="' . get_template_directory_uri() . '/img/no-image.png' . '" alt="Default Thumbnail" class="img-responsive" />';
            }
            ?>
        </a>

        <?php
        ?>
        <ul class="icon-group text-color booking-item-rating-stars">
            <?php
            $avg = STReview::get_avg_rate();
            echo TravelHelper::rate_to_string($avg);
            ?>
        </ul>
    </div>
    <div class="content">
        <h4 class="service-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
        <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
            <p class="service-location"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo esc_html($address); ?></p>
        <?php endif; ?>
        <div class="service-price">
        <span>
            <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '10px', '16px'); ?>
            <?php _e("from", ST_TEXTDOMAIN) ?>
        </span>
            <span class="price">
            <?php
            $price = isset($post->st_price) ? $post->st_price : 0;
            echo TravelHelper::format_money($price);
            ?>
        </span>
            <span><?php echo __('/night', ST_TEXTDOMAIN); ?></span>
        </div>
    </div>
</div>