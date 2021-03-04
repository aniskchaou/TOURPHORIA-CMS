<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20-12-2018
 * Time: 1:55 PM
 * Since: 1.0.0
 * Updated: 1.0.0
 */
while (have_posts()): the_post();
    $post_id = get_the_ID();
    $address = get_post_meta($post_id, 'address', true);
    $review_rate = STReview::get_avg_rate();
    $count_review = STReview::count_review($post_id);
    $lat = get_post_meta($post_id, 'map_lat', true);
    $lng = get_post_meta($post_id, 'map_lng', true);
    $zoom = get_post_meta($post_id, 'map_zoom', true);

    $gallery = get_post_meta($post_id, 'gallery', true);
    $gallery_array = explode(',', $gallery);
    $marker_icon = st()->get_option('st_cars_icon_map_marker', '');

    $car_external = get_post_meta(get_the_ID(), 'st_car_external_booking', true);
    $car_external_link = get_post_meta(get_the_ID(), 'st_car_external_booking_link', true);

    $pickup_date = STInput::get('pick-up-date', date(TravelHelper::getDateFormat()));
    $dropoff_date = STInput::get('drop-off-date', date(TravelHelper::getDateFormat(), strtotime("+ 1 day")));

    $pickup_date = TravelHelper::convertDateFormat($pickup_date);
    $dropoff_date = TravelHelper::convertDateFormat($dropoff_date);

    $pick_up_time = STInput::get('pick-up-time', '12:00 PM');
    $drop_off_time = STInput::get('drop-off-time', '12:00 PM');

    $info_price = STCars::get_info_price(get_the_ID(), strtotime($pickup_date), strtotime($dropoff_date));
    $cars_price = $info_price['price'];
    $count_sale = $info_price['discount'];
    $price_origin = $info_price['price_origin'];
    $list_price = $info_price['list_price'];
    ?>
    <div id="st-content-wrapper" class="st-single-car style-2">
        <?php st_breadcrumbs_new() ?>
        <div class="hotel-target-book-mobile">
            <div class="price-wrapper">
                <?php echo wp_kses(sprintf(__('from <span class="price">%s</span><span class="unit">/%s</span>', ST_TEXTDOMAIN), TravelHelper::format_money($cars_price), strtolower(STCars::get_price_unit('label'))), ['span' => ['class' => []]]) ?>
            </div>
            <?php
            if ($car_external == 'off' || empty($car_external)) {
                ?>
                <a href=""
                   class="btn btn-mpopup btn-green"><?php echo esc_html__('Book Now', ST_TEXTDOMAIN) ?></a>
                <?php
            } else {
                ?>
                <a href="<?php echo esc_url($car_external_link); ?>"
                   class="btn btn-green"><?php echo esc_html__('Book Now', ST_TEXTDOMAIN) ?></a>
                <?php
            }
            ?>
        </div>
        <div class="st-tour-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-9">
                        <div class="st-hotel-header">
                            <div class="left">
                                <h2 class="st-heading"><?php the_title(); ?></h2>
                                <div class="sub-heading">
                                    <?php if ($address) {
                                        echo TravelHelper::getNewIcon('ico_maps_add_2', '#5E6D77', '16px', '16px');
                                        echo esc_html($address);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="right">
                                <div class="review-score style-2">
                                    <span class="head-rating"><?php echo TravelHelper::get_rate_review_text($review_rate, $count_review); ?></span>
                                    <?php echo st()->load_template('layouts/modern/common/star', '', ['star' => $review_rate, 'style' => 'style-2']); ?>
                                    <p class="st-link"><?php comments_number(__('from 0 review', ST_TEXTDOMAIN), __('from 1 review', ST_TEXTDOMAIN), __('from % reviews', ST_TEXTDOMAIN)); ?></p>
                                </div>
                            </div>
                        </div>
                        <!--Tour Info-->
                        <div class="st-tour-feature">
                            <div class="row">
                                <div class="col-xs-6 col-lg-3">
                                    <div class="item has-matchHeight">
                                        <div class="icon">
                                            <?php
                                            $fee_cancellation = get_post_meta(get_the_ID(), 'fee_cancellation', true);
                                            if ($fee_cancellation == 'on') {
                                                echo TravelHelper::getNewIcon('check-1', '#5191FA', '16px', '16px');
                                            } else {
                                                echo TravelHelper::getNewIcon('remove', '#FA5636', '18px', '18px');
                                            }
                                            ?>
                                        </div>
                                        <div class="info">
                                            <h4 class="name"><?php echo __('Fee Cancellation', ST_TEXTDOMAIN); ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-3">
                                    <div class="item has-matchHeight">
                                        <div class="icon">
                                            <?php
                                            $pay_at_pick_up = get_post_meta(get_the_ID(), 'pay_at_pick_up', true);
                                            if ($pay_at_pick_up == 'on') {
                                                echo TravelHelper::getNewIcon('check-1', '#5191FA', '16px', '16px');
                                            } else {
                                                echo TravelHelper::getNewIcon('remove', '#FA5636', '18px', '18px');
                                            }
                                            ?>
                                        </div>
                                        <div class="info">
                                            <h4 class="name"><?php echo __('Pay at Pickup', ST_TEXTDOMAIN); ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-3">
                                    <div class="item has-matchHeight">
                                        <div class="icon">
                                            <?php
                                            $unlimited_mileage = get_post_meta(get_the_ID(), 'unlimited_mileage', true);
                                            if ($unlimited_mileage == 'on') {
                                                echo TravelHelper::getNewIcon('check-1', '#5191FA', '16px', '16px');
                                            } else {
                                                echo TravelHelper::getNewIcon('remove', '#FA5636', '18px', '18px');
                                            }
                                            ?>
                                        </div>
                                        <div class="info">
                                            <h4 class="name"><?php echo __('Unlimited Mileage', ST_TEXTDOMAIN); ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-3">
                                    <div class="item has-matchHeight">
                                        <div class="icon">
                                            <?php
                                            $shuttle_to_car = get_post_meta(get_the_ID(), 'shuttle_to_car', true);
                                            if ($shuttle_to_car == 'on') {
                                                echo TravelHelper::getNewIcon('check-1', '#5191FA', '16px', '16px');
                                            } else {
                                                echo TravelHelper::getNewIcon('remove', '#FA5636', '18px', '18px');
                                            }
                                            ?>
                                        </div>
                                        <div class="info">
                                            <h4 class="name"><?php echo __('Shuttle to Car', ST_TEXTDOMAIN); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Tour info-->
                        <?php
                        if (!empty($gallery_array)) { ?>
                            <div class="st-gallery" data-width="100%"
                                 data-nav="thumbs" data-allowfullscreen="true">
                                <div class="fotorama" data-auto="false">
                                    <?php
                                    foreach ($gallery_array as $value) {
                                        ?>
                                        <img src="<?php echo wp_get_attachment_image_url($value, [900, 600]) ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="shares dropdown">
                                    <?php $video_url = get_post_meta(get_the_ID(), 'video', true);
                                    if (!empty($video_url)) {
                                        ?>
                                        <a href="<?php echo esc_url($video_url); ?>"
                                           class="st-video-popup share-item"><?php echo TravelHelper::getNewIcon('video-player', '#FFFFFF', '20px', '20px') ?></a>
                                    <?php } ?>
                                    <a href="#" class="share-item social-share">
                                        <?php echo TravelHelper::getNewIcon('ico_share', '', '20px', '20px') ?>
                                    </a>
                                    <ul class="share-wrapper">
                                        <li><a class="facebook"
                                               href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="Facebook"><i
                                                        class="fa fa-facebook fa-lg"></i></a></li>
                                        <li><a class="twitter"
                                               href="https://twitter.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="Twitter"><i
                                                        class="fa fa-twitter fa-lg"></i></a></li>
                                        <li><a class="google"
                                               href="https://plus.google.com/share?url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="Google+"><i
                                                        class="fa fa-google-plus fa-lg"></i></a></li>
                                        <li><a class="no-open pinterest"
                                               href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"
                                               target="_blank" rel="noopener" original-title="Pinterest"><i
                                                        class="fa fa-pinterest fa-lg"></i></a></li>
                                        <li><a class="linkedin"
                                               href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title() ?>"
                                               target="_blank" rel="noopener" original-title="LinkedIn"><i
                                                        class="fa fa-linkedin fa-lg"></i></a></li>
                                    </ul>
                                    <?php echo st()->load_template('layouts/modern/hotel/loop/wishlist'); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <!--Tour Overview-->
                        <?php
                        global $post;
                        $content = $post->post_content;
                        $count = str_word_count($content);
                        if (!empty($content)) {
                            ?>
                            <div class="st-overview">
                                <h3 class="st-section-title"><?php echo __('Overview', ST_TEXTDOMAIN); ?></h3>
                                <div class="st-description"
                                     data-toggle-section="st-description" <?php if ($count >= 120) {
                                    echo 'data-show-all="st-description"
                             data-height="120"';
                                } ?>>
                                    <?php the_content(); ?>
                                    <?php if ($count >= 120) { ?>
                                        <div class="cut-gradient"></div>
                                    <?php } ?>
                                </div>
                                <?php if ($count >= 120) { ?>
                                    <a href="#" class="st-link block" data-show-target="st-description"
                                       data-text-less="<?php echo esc_html__('View Less', ST_TEXTDOMAIN) ?>"
                                       data-text-more="<?php echo esc_html__('View More', ST_TEXTDOMAIN) ?>"><span
                                                class="text"><?php echo esc_html__('View More', ST_TEXTDOMAIN) ?></span><i
                                                class="fa fa-caret-down ml3"></i></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <!--End Tour Overview-->
                        <div class="st-hr large"></div>
                        <h2 class="st-heading-section"><?php echo esc_html__( 'Car Features', ST_TEXTDOMAIN ) ?>
                            <a href="#" class="pull-right toggle-section"
                               data-target="st-facilities">
                                <i class="fa fa-angle-up"></i>
                            </a>
                        </h2>
                        <?php
                        $facilities = get_the_terms( $post_id, 'car_features');
                        if ( $facilities ) {
                            $count = count( $facilities );
                            ?>
                            <div class="facilities" data-toggle-section="st-facilities"
                                <?php if ( $count > 6 ) echo 'data-show-all="st-facilities"
                                     data-height="150"'; ?>>
                                <div class="row">
                                    <?php
                                    foreach ( $facilities as $term ) {
                                        $icon     = TravelHelper::handle_icon( get_tax_meta( $term->term_id, 'st_icon', true ) );
                                        $icon_new = TravelHelper::handle_icon( get_tax_meta( $term->term_id, 'st_icon_new', true ) );
                                        if ( !$icon ) $icon = "fa fa-cogs";
                                        ?>
                                        <div class="col-xs-6 col-sm-4">
                                            <div class="item has-matchHeight">
                                                <?php
                                                if ( !$icon_new ) {
                                                    echo '<i class="' . $icon . '"></i>' . $term->name;
                                                } else {
                                                    echo TravelHelper::getNewIcon( $icon_new, '#5E6D77', '24px', '24px' ) . $term->name;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <?php if ( $count > 6 ) { ?>
                                <a href="#" class="st-link block" data-show-target="st-facilities"
                                   data-text-less="<?php echo esc_html__( 'Show Less', ST_TEXTDOMAIN ) ?>"
                                   data-text-more="<?php echo esc_html__( 'Show All', ST_TEXTDOMAIN ) ?>"><span
                                            class="text"><?php echo esc_html__( 'Show All', ST_TEXTDOMAIN ) ?></span>
                                    <i
                                            class="fa fa-caret-down ml3"></i></a>
                                <?php
                            }
                        }
                        ?>

                        <!--Tour Map-->
                        <div class="st-hr large st-height2"></div>
                        <div class="st-map-wrapper">
                            <?php
                            if (!$zoom) {
                                $zoom = 13;
                            }
                            ?>
                            <div class="st-flex space-between">
                                <h2 class="st-heading-section mg0"><?php echo __('Car\'s Location', ST_TEXTDOMAIN) ?></h2>
                                <?php if ($address) {
                                    ?>
                                    <div class="c-grey"><?php
                                        echo TravelHelper::getNewIcon('Ico_maps', '#5E6D77', '18px', '18px');
                                        echo esc_html($address); ?></div>
                                    <?php
                                } ?>
                            </div>
                            <div class="st-map mt30">
                                <div class="google-map" data-lat="<?php echo trim($lat) ?>"
                                     data-lng="<?php echo trim($lng) ?>"
                                     data-icon="<?php echo esc_url($marker_icon); ?>"
                                     data-zoom="<?php echo (int)$zoom; ?>" data-disablecontrol="true"
                                     data-showcustomcontrol="true"
                                     data-style="normal"></div>
                            </div>
                        </div>
                        <!--End Tour Map-->

                        <!--Review Option-->
                        <div class="st-hr large st-height2 st-hr-comment"></div>
                        <h2 class="st-heading-section"><?php echo esc_html__('Reviews', ST_TEXTDOMAIN) ?></h2>
                        <div id="reviews" data-toggle-section="st-reviews" class=" stoped-scroll-section">
                            <div class="review-box">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="review-box-score">
                                            <?php
                                            $avg = STReview::get_avg_rate();
                                            ?>
                                            <div class="review-score">
                                                <?php echo esc_attr($avg); ?><span class="per-total">/5</span>
                                            </div>
                                            <div class="review-score-text"><?php echo TravelHelper::get_rate_review_text($avg, $count_review); ?></div>
                                            <div class="review-score-base">
                                                <?php echo __('Based on', ST_TEXTDOMAIN) ?>
                                                <span><?php comments_number(__('0 review', ST_TEXTDOMAIN), __('1 review', ST_TEXTDOMAIN), __('% reviews', ST_TEXTDOMAIN)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="review-sumary">
                                            <?php $total = get_comments_number(); ?>
                                            <?php $rate_exe = STReview::count_review_by_rate(null, 5); ?>
                                            <div class="item">
                                                <div class="label">
                                                    <?php echo esc_html__('Excellent', ST_TEXTDOMAIN) ?>
                                                </div>
                                                <div class="progress">
                                                    <div class="percent green"
                                                         style="width: <?php echo TravelHelper::cal_rate($rate_exe, $total) ?>%;"></div>
                                                </div>
                                                <div class="number"><?php echo $rate_exe; ?></div>
                                            </div>
                                            <?php $rate_good = STReview::count_review_by_rate(null, 4); ?>
                                            <div class="item">
                                                <div class="label">
                                                    <?php echo __('Very Good', ST_TEXTDOMAIN) ?>
                                                </div>
                                                <div class="progress">
                                                    <div class="percent darkgreen"
                                                         style="width: <?php echo TravelHelper::cal_rate($rate_good, $total) ?>%;"></div>
                                                </div>
                                                <div class="number"><?php echo $rate_good; ?></div>
                                            </div>
                                            <?php $rate_avg = STReview::count_review_by_rate(null, 3); ?>
                                            <div class="item">
                                                <div class="label">
                                                    <?php echo __('Average', ST_TEXTDOMAIN) ?>
                                                </div>
                                                <div class="progress">
                                                    <div class="percent yellow"
                                                         style="width: <?php echo TravelHelper::cal_rate($rate_avg, $total) ?>%;"></div>
                                                </div>
                                                <div class="number"><?php echo $rate_avg; ?></div>
                                            </div>
                                            <?php $rate_poor = STReview::count_review_by_rate(null, 2); ?>
                                            <div class="item">
                                                <div class="label">
                                                    <?php echo __('Poor', ST_TEXTDOMAIN) ?>
                                                </div>
                                                <div class="progress">
                                                    <div class="percent orange"
                                                         style="width: <?php echo TravelHelper::cal_rate($rate_poor, $total) ?>%;"></div>
                                                </div>
                                                <div class="number"><?php echo $rate_poor; ?></div>
                                            </div>
                                            <?php $rate_terible = STReview::count_review_by_rate(null, 1); ?>
                                            <div class="item">
                                                <div class="label">
                                                    <?php echo __('Terrible', ST_TEXTDOMAIN) ?>
                                                </div>
                                                <div class="progress">
                                                    <div class="percent red"
                                                         style="width: <?php echo TravelHelper::cal_rate($rate_terible, $total) ?>%;"></div>
                                                </div>
                                                <div class="number"><?php echo $rate_terible; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-pagination">
                                <div class="summary">
                                    <?php
                                    $comments_count = wp_count_comments(get_the_ID());
                                    $total = (int)$comments_count->approved;
                                    $comment_per_page = (int)get_option('comments_per_page', 10);
                                    $paged = (int)STInput::get('comment_page', 1);
                                    $from = $comment_per_page * ($paged - 1) + 1;
                                    $to = ($paged * $comment_per_page < $total) ? ($paged * $comment_per_page) : $total;
                                    ?>
                                </div>
                                <div id="reviews" class="review-list">
                                    <?php
                                    $offset = ($paged - 1) * $comment_per_page;
                                    $args = [
                                        'number' => $comment_per_page,
                                        'offset' => $offset,
                                        'post_id' => get_the_ID(),
                                        'status' => ['approve']
                                    ];
                                    $comments_query = new WP_Comment_Query;
                                    $comments = $comments_query->query($args);

                                    if ($comments):
                                        foreach ($comments as $key => $comment):
                                            echo st()->load_template('layouts/modern/common/reviews/review', 'list', ['comment' => (object)$comment, 'post_type' => 'st_tours']);
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="review-pag-wrapper">
                                <div class="review-pag-text">
                                    <?php echo sprintf(__('Showing %s - %s of %s in total', ST_TEXTDOMAIN), $from, $to, get_comments_number_text('0', '1', '%')) ?>
                                </div>
                                <?php TravelHelper::pagination_comment(['total' => $total]) ?>
                            </div>
                            <?php
                            if (comments_open($post_id)) {
                                ?>
                                <div id="write-review">
                                    <h4 class="heading">
                                        <a href="" class="toggle-section c-main f16"
                                           data-target="st-review-form"><?php echo __('Write a review', ST_TEXTDOMAIN) ?>
                                            <i class="fa fa-angle-down ml5"></i></a>
                                    </h4>
                                    <?php
                                    TravelHelper::comment_form();
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!--End Review Option-->

                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="widgets">
                            <div class="fixed-on-mobile" id="booking-request" data-screen="992px">
                                <div class="close-icon hide">
                                    <?php echo TravelHelper::getNewIcon('Ico_close'); ?>
                                </div>
                                <div class="form-book-wrapper relative">
                                    <?php if (!empty($info_price['discount']) and $info_price['discount'] > 0 and $info_price['price_new'] > 0) { ?>
                                        <div class="tour-sale-box">
                                            <?php echo STFeatured::get_sale($info_price['discount']); ?>
                                        </div>
                                    <?php } ?>
                                    <?php echo st()->load_template('layouts/modern/common/loader'); ?>
                                    <div class="form-head">
                                        <?php echo wp_kses(sprintf(__('<span class="price">%s</span><span class="unit">/%s</span>', ST_TEXTDOMAIN), TravelHelper::format_money($cars_price), strtolower(STCars::get_price_unit('label'))), ['span' => ['class' => []]]) ?>
                                    </div>
                                    <?php if (empty($car_external) || $car_external == 'off') { ?>
                                        <form id="form-booking-inpage" method="post" action="#booking-request">
                                            <input type="hidden" name="action" value="cars_add_to_cart">
                                            <input type="hidden" name="item_id" value="<?php echo get_the_ID(); ?>">
                                            <?php echo st()->load_template('layouts/modern/car/elements/search/location', ''); ?>
                                            <?php echo st()->load_template('layouts/modern/car/elements/search/date', ''); ?>
                                            <?php echo st()->load_template('layouts/modern/car/elements/search/extra', ''); ?>
                                            <div class="submit-group">
                                                <input class="btn btn-green btn-large btn-full upper"
                                                       type="submit"
                                                       name="submit"
                                                       value="<?php echo esc_html__('Book Now', ST_TEXTDOMAIN) ?>">
                                            </div>
                                            <div class="message-wrapper mt30">
                                                <?php echo STTemplate::message() ?>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <div class="submit-group mb30">
                                            <a href="<?php echo esc_url($car_external_link); ?>"
                                               class="btn btn-green btn-large btn-full upper"><?php echo esc_html__('Book Now', ST_TEXTDOMAIN); ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="owner-info widget-box">
                                    <h4 class="heading"><?php echo __('Organized by', ST_TEXTDOMAIN) ?></h4>
                                    <div class="media">
                                        <div class="media-left">
                                            <?php
                                            $author_id = get_post_field('post_author', get_the_ID());
                                            $userdata = get_userdata($author_id);
                                            ?>
                                            <a href="<?php echo get_author_posts_url($author_id); ?>">
                                                <?php
                                                echo st_get_profile_avatar($author_id, 60);
                                                ?>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a
                                                        href="<?php echo get_author_posts_url($author_id); ?>"
                                                        class="author-link"><?php echo TravelHelper::get_username($author_id); ?></a>
                                            </h4>
                                            <p><?php echo sprintf(__('Member Since %s', ST_TEXTDOMAIN), date('Y', strtotime($userdata->user_registered))) ?></p>
                                            <?php
                                            $arr_service = STUser_f::getListServicesAuthor($userdata);
                                            $review_data = STUser_f::getReviewsDataAuthor($arr_service, $userdata);
                                            if (!empty($review_data)) {
                                                $avg_rating = STUser_f::getAVGRatingAuthor($review_data);
                                                ?>
                                                <div class="author-review-box">
                                                    <div class="author-start-rating">
                                                        <div class="stm-star-rating">
                                                            <div class="inner">
                                                                <div class="stm-star-rating-upper"
                                                                     style="width:<?php echo $avg_rating / 5 * 100; ?>%;"></div>
                                                                <div class="stm-star-rating-lower"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="author-review-label">
                                                        <?php printf(__('%d Reviews', ST_TEXTDOMAIN), count($review_data)); ?>
                                                    </p>
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $args = [
                    'posts_per_page' => 4,
                    'post_type' => 'st_car',
                    'post_author' => get_post_field('post_author', get_the_ID()),
                    'post__not_in' => [get_the_ID()]
                ];
                global $post;
                $old_post = $post;
                $query = new WP_Query($args);
                if ($query->have_posts()):
                    ?>
                    <div class="st-hr large"></div>
                    <h2 class="heading text-center f28 mt50"><?php echo esc_html__('You might also like', ST_TEXTDOMAIN) ?></h2>
                    <div class="st-list-tour-related row mt50">
                        <?php
                        while ($query->have_posts()): $query->the_post();
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="item has-matchHeight">
                                    <div class="featured">
                                        <a href="<?php the_permalink() ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), [800, 600]) ?>"
                                                 alt="<?php echo TravelHelper::get_alt_image() ?>"
                                                 class="img-responsive">
                                        </a>
                                        <?php echo st()->load_template('layouts/modern/hotel/loop/wishlist'); ?>
                                        <?php echo st_get_avatar_in_list_service(get_the_ID(), 50); ?>
                                    </div>
                                    <div class="body">
                                        <?php
                                        $address = get_post_meta(get_the_ID(), 'address', true);
                                        if ($address) {
                                            echo TravelHelper::getNewIcon('ico_maps_add_2', '#5E6D77', '16px', '16px');
                                            echo '<span class="ml5 f14 address">' . esc_html($address) . '</span>';
                                        }
                                        ?>
                                        <h4 class="title"><a href="<?php the_permalink() ?>"
                                                             class="st-link c-main"><?php the_title(); ?></a></h4>
                                        <?php
                                        $review_rate = STReview::get_avg_rate();
                                        echo st()->load_template('layouts/modern/common/star', '', ['star' => $review_rate, 'style' => 'style-2']);
                                        ?>
                                        <p class="review-text"><?php comments_number(__('0 review', ST_TEXTDOMAIN), __('1 review', ST_TEXTDOMAIN), __('% reviews', ST_TEXTDOMAIN)); ?></p>
                                        <div class="st-flex space-between">
                                            <div class="left st-flex">
                                                <?php echo TravelHelper::getNewIcon('time-clock-circle-1', '#5E6D77', '16px', '16px'); ?>
                                                <span class="duration"><?php echo get_post_meta(get_the_ID(), 'duration_day', true); ?></span>
                                            </div>
                                            <div class="right st-flex">
                                                <?php echo TravelHelper::getNewIcon('thunder', '#FFAB53', '9px', '16px', false); ?>
                                                <span class="price">
                                                                <?php echo sprintf(esc_html__('from %s', ST_TEXTDOMAIN), STTour::get_price_html(get_the_ID())); ?>
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                <?php
                endif;
                wp_reset_postdata();
                $post = $old_post;
                ?>
            </div>
        </div>
    </div>
<?php
endwhile;
