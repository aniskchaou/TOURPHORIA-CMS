<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/28/2019
 * Time: 1:46 PM
 */
$url = get_the_permalink();
$start = STInput::get('start', date(TravelHelper::getDateFormat()));
$end = STInput::get('end', date(TravelHelper::getDateFormat(), strtotime("+ 1 day")));
$start = TravelHelper::convertDateFormat($start);
$end = TravelHelper::convertDateFormat($end);
$price = STPrice::getSalePrice(get_the_ID(), strtotime($start), strtotime($end));

?>

<div class="item-service grid-item has-matchHeight">
    <div class="featured-image">
        <?php echo STFeatured::get_featured(); ?>
        <?php if (is_user_logged_in()) { ?>
            <?php $data = STUser_f::get_icon_wishlist(); ?>
            <div class="service-add-wishlist login <?php echo $data['status'] ? 'added' : ''; ?>"
                 data-id="<?php echo get_the_ID(); ?>" data-type="<?php echo get_post_type(get_the_ID()); ?>"
                 title="<?php echo $data['status'] ? __('Remove from wishlist', ST_TEXTDOMAIN) : __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                <i class="fa fa-heart"></i>
                <div class="lds-dual-ring"></div>
            </div>
        <?php } else { ?>
            <a href="#" class="login" data-toggle="modal" data-target="#st-login-form">
                <div class="service-add-wishlist" title="<?php echo __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                    <i class="fa fa-heart"></i>
                    <div class="lds-dual-ring"></div>
                </div>
            </a>
        <?php } ?>
        <a href="<?php echo esc_url($url); ?>">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(740, 560), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
            } else {
                echo '<img src="' . get_template_directory_uri() . '/img/no-image.png' . '" alt="Default Thumbnail" class="img-responsive" />';
            }
            ?>
        </a>
        <div class="price-wrapper">
            <?php echo wp_kses(sprintf(__('<span class="price">%s</span><span class="unit">/night</span>', ST_TEXTDOMAIN), TravelHelper::format_money($price)), ['span' => ['class' => []]]) ?>
        </div>
    </div>
    <div class="item-content">
        <h4 class="service-title plr15"><a href="<?php echo esc_url($url); ?>"><?php echo get_the_title(); ?></a></h4>
        <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
            <p class="service-location plr15"><?php echo esc_html($address); ?></p>
        <?php endif; ?>
        <div class="service-review plr15">
            <?php
            $count_review = STReview::count_comment(get_the_ID());
            $avg = STReview::get_avg_rate();
            ?>
            <span class="rate">
                <?php echo esc_html($avg) . '/5'; ?>
                <span class="rate-text"><?php echo TravelHelper::get_rate_review_text($avg, $count_review); ?></span>
            </span>
            <span class="review"><?php echo esc_html($count_review) . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN), esc_html__('Reviews', ST_TEXTDOMAIN), $count_review); ?></span>
        </div>
        <div class="amenities clearfix">
            <span class="amenity total" data-toggle="tooltip" title="<?php echo esc_attr__('No. People', ST_TEXTDOMAIN) ?>"><?php echo TravelHelper::getNewIcon('ico_people_1', '','22px', '22px', false); ?><?php echo (int)get_post_meta(get_the_ID(), 'rental_max_adult', true) + (int)get_post_meta(get_the_ID(), 'rental_max_children', true); ?></span>
            <span class="amenity bed" data-toggle="tooltip" title="<?php echo esc_attr__('No. Bed', ST_TEXTDOMAIN) ?>"><?php echo TravelHelper::getNewIcon('ico_bed_1', '','20px', '22px', false); ?><?php echo (int)get_post_meta(get_the_ID(), 'rental_bed', true) ?></span>
            <span class="amenity bath" data-toggle="tooltip" title="<?php echo esc_attr__('No. Bathroom', ST_TEXTDOMAIN) ?>"><?php echo TravelHelper::getNewIcon('ico_bathroom_1' ,'','22px', '22px', false); ?><?php echo (int)get_post_meta(get_the_ID(), 'rental_bath', true) ?></span>
            <span class="amenity size" data-toggle="tooltip" title="<?php echo esc_attr__('Square', ST_TEXTDOMAIN) ?>"><?php echo TravelHelper::getNewIcon('ico_square_1', '', '21px', '21px', false); ?><?php echo get_post_meta(get_the_ID(), 'rental_size', true); ?>m<sup>2</sup></span>
        </div>
    </div>
</div>