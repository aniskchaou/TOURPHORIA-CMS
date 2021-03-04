<?php extract(shortcode_atts(array(
    'room_id'          => '',
  ), $attr));
$page = STInput::request( 'wpbooking_paged' );
$arg = [
    'post_type' => 'hotel_room',
    'posts_per_page' =>1,
    'paged'          => $page,
    'post__in' => array($room_id)
];
$query = new WP_Query($arg);
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
}

if($query->post_count > 0){
    if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); 
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
    <div class="item-room">
        <a href="<?php echo esc_url($url); ?>" title="<?php the_title(); ?>">
            <div class="img-thumnail">
                <?php
                if (has_post_thumbnail() and get_the_post_thumbnail()) {
                    the_post_thumbnail(array(750, 370, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id())));
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
<?php 
    endwhile; endif;wp_reset_postdata();
}?>