<?php extract(shortcode_atts(array(
    'style'          => '',
    'number_show_room'      => '',
    'service_id'      => '',
  ), $attr));
global $wp_query;
$rooms = Hotel_Alone_Helper::inst()->seach_room_hotel_activity_by_id($service_id,$number_show_room);
$list_extra = [];
$list_extra = get_post_meta(get_the_ID(), 'extra_price', true);
$hotel_id = get_post_meta(get_the_ID(), 'room_parent', true);

$check_in = STInput::request('checkin_y') . "-" . STInput::request('checkin_m') . "-" . STInput::request('checkin_d');
$check_in_temp = $check_in;
if ($check_in == '--') $check_in = ''; else$check_in = date(TravelHelper::getDateFormat(), strtotime($check_in));
if (empty($check_in)) {
    $check_in = date(TravelHelper::getDateFormat());
}

$check_out = STInput::request('checkout_y') . "-" . STInput::request('checkout_m') . "-" . STInput::request('checkout_d');
$check_out_temp = $check_out;
if ($check_out == '--') $check_out = ''; else$check_out = date(TravelHelper::getDateFormat(), strtotime($check_out));
if (empty($check_out)) {
    $check_out = date(TravelHelper::getDateFormat(), strtotime('+1 day', strtotime(date('Y-m-d'))));
}?>

<div class="row" style="margin-top: 30px;">
<?php if(!empty($rooms)){
    if($rooms['status']){
        if ( $rooms['data']->have_posts() ) {
            while ( $rooms['data']->have_posts() ) {
                $rooms['data']->the_post();
                $url = add_query_arg([
                    'checkin_d' => STInput::request('checkin_d'),
                    'checkin_m' => STInput::request('checkin_m'),
                    'checkin_y' => STInput::request('checkin_y'),
                    'checkin' => STInput::request('checkin'),
                    'checkout_d' => STInput::request('checkout_d'),
                    'checkout_m' => STInput::request('checkout_m'),
                    'checkout_y' => STInput::request('checkout_y'),
                    'checkout' => STInput::request('checkout'),
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'room_number' => STInput::request('room_number', 1),
                    'room_num_search' => STInput::request('room_number', 1),
                    'check_in_out' => STInput::request('check_in_out'),
                    'adults' => STInput::request('adults', 1),
                    'children' => STInput::request('children', 0),
                    'adult_number' => STInput::request('adults', 1),
                    'child_number' => STInput::request('children', 0),
                ], get_permalink());

                ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="item-room">
                        <a href="<?php echo esc_url($url); ?>" title="<?php the_title(); ?>">
                            <div class="img-thumnail">
                                <?php
                                    if (has_post_thumbnail() and get_the_post_thumbnail()) {
                                        the_post_thumbnail(array(370, 370, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id())));
                                    } else {
                                        if (function_exists('st_get_default_image'))
                                            echo st_get_default_image();
                                    }
                                    ?>
                            </div>
                            <div class="info-item">
                                <div class="info">
                                    <span class="price"><?php esc_html_e("From", ST_TEXTDOMAIN) ?> 
                                        <?php
                                            $price = get_post_meta(get_the_ID(), 'price', true);
                                            echo TravelHelper::format_money($price);
                                            ?>
                                    </span>
                                    <h4><?php the_title(); ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php 
            }

        }
        wp_reset_postdata();
    }else{
        ?>
        <div class="search_room_alert_new">
            <div class="alert alert-danger"><?php echo $rooms['message']; ?></div>
        </div>
        <?php
    }
} ?>
</div>