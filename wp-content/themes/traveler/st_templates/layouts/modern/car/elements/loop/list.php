<?php
global $post;

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
$url = st_get_link_with_search(get_permalink(), array('location_id_pick_up','location_id_drop_off','pick-up','drop-off','pick-up-date', 'drop-off-date', 'pick-up-time', 'drop-off-time'), $_REQUEST);
?>
<div class="item-service item-service-car">
    <div class="row item-service-wrapper has-matchHeight">
        <div class="col-sm-4 thumb-wrapper">
            <div class="thumb">
                <?php if (!empty($info_price['discount']) and $info_price['discount'] > 0 and $info_price['price'] > 0) { ?>
                    <?php echo STFeatured::get_sale($info_price['discount']); ?>
                <?php } ?>
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
                <a href="<?php echo esc_url($url); ?>">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail(array(760, 460), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/img/no-image.png' . '" alt="Default Thumbnail" class="img-responsive" />';
                    }
                    ?>
                </a>
                <?php echo st_get_avatar_in_list_service(get_the_ID(), 35) ?>
            </div>
        </div>
        <div class="col-sm-5 item-content">
            <div class="item-content-w">
                <?php
                $category = get_the_terms(get_the_ID(), 'st_category_cars');
                if (!is_wp_error($category) && is_array($category)) {
                    $category = array_shift($category);
                    echo '<div class="car-type">' . esc_html($category->name) . '</div>';
                }
                ?>
                <h4 class="service-title"><a href="<?php echo esc_url($url); ?>"><?php echo get_the_title(); ?></a></h4>
                <div class="service-review">
                    <ul class="icon-group text-color booking-item-rating-stars">
                        <?php
                        $avg = STReview::get_avg_rate();
                        echo TravelHelper::rate_to_string($avg);
                        ?>
                    </ul>
                    <?php
                    $count_review = STReview::count_comment(get_the_ID());
                    ?>
                    <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN), esc_html__('Reviews', ST_TEXTDOMAIN), $count_review); ?></span>
                </div>
                <div class="car-equipments clearfix">
                    <?php
                    $pasenger = (int)get_post_meta(get_the_ID(), 'passengers', true);
                    $auto_transmission = get_post_meta(get_the_ID(), 'auto_transmission', true);
                    $baggage = (int)get_post_meta(get_the_ID(), 'baggage', true);
                    $door = (int)get_post_meta(get_the_ID(), 'door', true);
                    ?>
                    <div class="item" data-toggle="tooltip" title="<?php echo esc_attr__('Passenger', ST_TEXTDOMAIN) ?>">
                        <span class="ico"><?php echo TravelHelper::getNewIcon('ico_regular_1', '#1A2B50', '22px', '22px') ?></span>
                        <span class="text"><?php echo esc_attr($pasenger); ?></span>
                    </div>
                    <div class="item" data-toggle="tooltip" title="<?php echo esc_attr__('Gear Shift', ST_TEXTDOMAIN) ?>">
                        <span class="ico"><?php echo TravelHelper::getNewIcon('ico_gear_shift', '#1A2B50', '22px', '22px') ?></span>
                        <span class="text"><?php if ($auto_transmission == 'on') echo esc_html__('Auto', ST_TEXTDOMAIN); else echo esc_html__('Not Auto', ST_TEXTDOMAIN) ?></span>
                    </div>
                    <div class="item" data-toggle="tooltip" title="<?php echo esc_attr__('Baggage', ST_TEXTDOMAIN) ?>">
                        <span class="ico"><?php echo TravelHelper::getNewIcon('ico_suite_1', '#1A2B50', '22px', '22px') ?></span>
                        <span class="text"><?php echo esc_attr($baggage); ?></span>
                    </div>
                    <div class="item">
                        <span class="ico" data-toggle="tooltip" title="<?php echo esc_attr__('Door', ST_TEXTDOMAIN) ?>"><?php echo TravelHelper::getNewIcon('ico_doors_1', '#1A2B50', '22px', '22px') ?></span>
                        <span class="text"><?php echo esc_attr($door); ?></span>
                    </div>
                </div>
                <?php
                $show_avatar = st()->get_option('avatar_in_list_service', 'off');
                if ($show_avatar == 'on') {
                    ?>
                    <div class="service-author">
                        <?php echo st_get_avatar_in_list_service(get_the_ID(), 30) ?>
                        <p class="name">
                            <?php
                            $post_author_id = get_post_field('post_author', get_the_ID());
                            echo trim(TravelHelper::get_username($post_author_id));
                            ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-3 section-footer">
            <div class="service-price">
                    <span>
                        <?php echo TravelHelper::getNewIcon('thunder', '#ffab53', '10px', '16px'); ?>
                    </span>
                <span class="price">
                        <?php
                        echo TravelHelper::format_money($cars_price);
                        ?>
                    </span>
                <span class="unit">/<?php echo strtolower(STCars::get_price_unit('label')) ?></span>
            </div>
            <a href="<?php echo esc_url($url) ?>"
               class="btn btn-primary btn-view-more"><?php echo __('VIEW CAR', ST_TEXTDOMAIN); ?></a>

            <?php if (!empty($info_price['discount']) and $info_price['discount'] > 0 and $info_price['price'] > 0) { ?>
                <?php echo STFeatured::get_sale($info_price['discount']); ?>
            <?php } ?>
        </div>
    </div>
</div>