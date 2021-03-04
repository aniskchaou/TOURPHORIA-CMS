<?php
global $post;

$start = STInput::get('start', date(TravelHelper::getDateFormat()));
$end = STInput::get('end', date(TravelHelper::getDateFormat(), strtotime("+ 1 day")));
$start = TravelHelper::convertDateFormat($start);
$end = TravelHelper::convertDateFormat($end);
$price = STPrice::getSalePrice(get_the_ID(), strtotime($start), strtotime($end));
?>
<div class="item-service item-service-halfmap">
    <div class="has-matchHeight">
        <div class="thumb">
            <?php if (is_user_logged_in()) { ?>
                <?php $data = STUser_f::get_icon_wishlist(); ?>
                <div class="service-add-wishlist login <?php echo $data['status'] ? 'added' : ''; ?>"
                     data-id="<?php echo get_the_ID(); ?>" data-type="<?php echo get_post_type(get_the_ID()); ?>"
                     title="<?php echo $data['status'] ? __('Remove from wishlist', ST_TEXTDOMAIN) : __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                    <i class="fa fa-heart"></i>
                    <div class="lds-dual-ring"></div>
                </div>
            <?php } else { ?>
                <a href="" class="login" data-toggle="modal" data-target="#st-login-form">
                    <div class="service-add-wishlist" title="<?php echo __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                        <i class="fa fa-heart"></i>
                        <div class="lds-dual-ring"></div>
                    </div>
                </a>
            <?php } ?>
            <div class="service-tag bestseller">
                <?php echo STFeatured::get_featured(); ?>
            </div>
            <a href="<?php echo get_the_permalink() ?>">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail(array(680, 630), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/img/no-image.png' . '" alt="Default Thumbnail" class="img-responsive" />';
                }
                ?>
            </a>
            <ul class="icon-group text-color booking-item-rating-stars">
                <?php
                $avg = STReview::get_avg_rate();
                echo TravelHelper::rate_to_string($avg);
                ?>
            </ul>
        </div>
        <h4 class="service-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
        <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
            <p class="service-location"><?php echo TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true); ?><?php echo $address; ?></p>
        <?php endif; ?>
        <div class="section-footer">
            <div class="service-review">
                <?php
                $count_review = STReview::count_comment(get_the_ID());
                $avg = STReview::get_avg_rate();
                ?>
                <span class="rating"><?php echo $avg; ?>/5 <?php echo TravelHelper::get_rate_review_text($avg, $count_review); ?></span>
                <span class="st-dot"></span>
                <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN), esc_html__('Reviews', ST_TEXTDOMAIN), $count_review); ?></span>
            </div>
            <div class="service-price">
                <span>
                    <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '10px', '16px'); ?>
                    <?php _e("From", ST_TEXTDOMAIN) ?>
                </span>
                <span class="price">
                    <?php
                    echo TravelHelper::format_money($price);
                    ?>
                </span>
                <span><?php echo __('/night', ST_TEXTDOMAIN); ?></span>
            </div>
        </div>
    </div>
</div>