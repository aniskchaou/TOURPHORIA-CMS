<?php
global $post;
$url = st_get_link_with_search(get_permalink(), array('location_id_pick_up', 'location_id_drop_off','pick-up','drop-off','pick-up-date', 'drop-off-date', 'pick-up-time', 'drop-off-time'), $_REQUEST);

$class = 'col-lg-4 col-md-6 col-sm-6 col-xs-6 item-service item-service-car grid-item has-matchHeight';
if (isset($top_search) and $top_search)
    $class = 'col-lg-3 col-md-4 col-sm-6 col-xs-6 item-service item-service-car grid-item has-matchHeight';
if (isset($slider) and $slider)
    $class = 'item-service item-service-car grid-item has-matchHeight';

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
<div class="<?php echo $class; ?>">
    <div class="service-border">
        <div class="thumb">
            <?php if (is_user_logged_in()) { ?>
                <?php $data = STUser_f::get_icon_wishlist(); ?>
                <div class="service-add-wishlist login <?php echo $data['status'] ? 'added' : ''; ?>"
                     data-id="<?php echo get_the_ID(); ?>" data-type="<?php echo get_post_type(get_the_ID()); ?>"
                     title="<?php echo $data['status'] ? __('Remove from wishlist', ST_TEXTDOMAIN) : __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                    <?php echo TravelHelper::getNewIcon('icon_love-it'); ?>
                    <div class="lds-dual-ring"></div>
                </div>
            <?php } else { ?>
                <a href="" class="login" data-toggle="modal" data-target="#st-login-form">
                    <div class="service-add-wishlist" title="<?php echo __('Add to wishlist', ST_TEXTDOMAIN); ?>">
                        <?php echo TravelHelper::getNewIcon('icon_love-it'); ?>
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
        <?php
        $category = get_the_terms(get_the_ID(), 'st_category_cars');
        if (!is_wp_error($category) && is_array($category)) {
            $category = array_shift($category);
            echo '<div class="car-type">' . esc_html($category->name) . '</div>';
        }
        ?>
        <h4 class="service-title plr15"><a href="<?php echo esc_url($url); ?>"><?php echo get_the_title(); ?></a></h4>
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
        <div class="section-footer">
            <div class="footer-inner plr15">
                <?php
                $duration = get_post_meta(get_the_ID(), 'duration_day', true);
                if (!empty($duration)) {
                    ?>
                    <div class="service-duration">
                        <?php echo TravelHelper::getNewIcon('time-clock-circle-1', '#5E6D77', '16px', '16px'); ?>
                        <?php echo esc_html($duration); ?>
                    </div>
                    <?php
                }
                ?>
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
            </div>
        </div>
    </div>
</div>