<?php
$list_extra = array();
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
}

$url = add_query_arg(array(
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
), get_permalink());

$total = $adult_number = STInput::request('adults', 1);
$child_number = STInput::request('children', 0);

$disable_children_name = get_post_meta(get_the_ID(),'disable_children_name',true);

if($disable_children_name!='on') $total+=$child_number;

$total--;

?>
<div class="item-room loop-room post-<?php the_ID() ?> loop-room-style-2 col-md-6">
    <div class="item">
        <div class="feature">
            <?php
            if (has_post_thumbnail() and get_the_post_thumbnail()) {
                the_post_thumbnail(array(340, 240, 'bfi_thumb' => true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id())));
            } else {
                if (function_exists('st_get_default_image'))
                    echo st_get_default_image();
            }
            ?>
        </div>
        <div class="info">
            <div class="name">
                <a href="<?php echo esc_url($url) ?>">
                    <?php the_title() ?>
                </a>
            </div>
            <div class="price">
                <span class="title"><?php esc_html_e("PRICE", ST_TEXTDOMAIN) ?></span>
                <?php
                $room_id = get_the_ID();

                $start = STInput::request('checkin_m') . "/" . STInput::request('checkin_d') . "/" . STInput::request('checkin_y');
                $end = STInput::request('checkout_m') . "/" . STInput::request('checkout_d') . "/" . STInput::request('checkout_y');

                if ($start == '//') $start = '';
                if ($end == '//') $end = '';

                if ($start != '' && $end != '') {
                    $room_num_search = intval(STInput::request('room_number', 1));
                    $sale_price = STPrice::getRoomPrice($room_id, strtotime($start), strtotime($end), $room_num_search);
                    $total_price = STPrice::getRoomPriceOnlyCustomPrice($room_id, strtotime($start), strtotime($end), $room_num_search);
                    $numberday = STDate::dateDiff($start, $end);

                    if ($sale_price < $total_price) {
                        echo '<span class="onsale">' . TravelHelper::format_money($total_price) . '</span> <i class="fa fa-long-arrow-right"></i> ';
                    }
                    echo TravelHelper::format_money($sale_price);
                    ?>
                    <span class="small">
                     <?php
                     if ($numberday > 1) {
                         echo sprintf(esc_html__("/ %s nights", ST_TEXTDOMAIN), $numberday);
                     } else {
                         echo sprintf(esc_html__("/ %s night", ST_TEXTDOMAIN), $numberday);
                     }
                     ?>
                </span>
                <?php } else { ?>
                    <?php
                    $price = get_post_meta(get_the_ID(), 'price', true);
                    echo TravelHelper::format_money($price);
                    ?>
                    <span class="small"><?php esc_html_e("/night", ST_TEXTDOMAIN) ?></span>
                <?php } ?>
            </div>
            <div class="desc">
                <?php echo wp_trim_words(get_the_excerpt(), 10); ?>
            </div>
            <div class="guest">
                <?php
                $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
                $number_child = get_post_meta(get_the_ID(), 'children_number', true);
                if (!empty($number_adult) || !empty($number_child)) {
                    ?>
                    <span><?php echo esc_attr($number_adult + $number_child); ?><?php esc_html_e("GUESTS", ST_TEXTDOMAIN) ?></span>
                <?php } ?>
                <?php
                $room_size = get_post_meta(get_the_ID(), 'room_footage', true);
                if (!empty($room_size)) {
                    echo esc_attr($room_size);
                    echo '<span>';
                    echo ' m<sup>2</sup>';
                    echo '</span>';
                }
                ?>
            </div>
            <div class="facilities">
                <?php $term = get_the_terms(get_the_ID(), 'room_facilities'); ?>
                <?php if (is_array($term) && count($term)) { ?>
                    <?php
                    if ($term) {
                        $i = 0;
                        foreach ($term as $key => $value) {
                            if (!is_wp_error($term) and !empty($value->name)) {
                                if ($i == 4) {
                                    continue;
                                }
                                $i++;
                                ?>
                                <span class="icon-item" data-toggle="tooltip"
                                      title="<?php echo esc_html($value->name) ?>">
                                    <?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($value->term_id, 'st_icon')) { ?>
                                        <i class="<?php echo TravelHelper::handle_icon($icon) ?>"></i>
                                    <?php } ?>
                                </span>
                                <?php
                            }
                        }
                    }

                } ?>
            </div>
            <form class="form-booking-inpage hotel-alone-booking-inpage" class="" method="post">
                <input type="hidden" name="check_in" value="<?php echo $check_in; ?>"/>
                <input type="hidden" name="check_out" value="<?php echo $check_out; ?>"/>
                <input type="hidden" name="room_num_search" value="<?php echo STInput::request('room_number', 0); ?>"/>
                <input type="hidden" name="adult_number" value="<?php echo STInput::request('adults', 0); ?>"/>
                <input type="hidden" name="child_number" value="<?php echo STInput::request('children', 0); ?>"/>
                <input name="action" value="st_add_to_cart" type="hidden">
                <input name="item_id" value="<?php echo $hotel_id; ?>" type="hidden">
                <input name="room_id" value="<?php echo get_the_ID(); ?>" type="hidden">
                <input type="hidden" name="start" value="<?php echo $check_in; ?>"/>
                <input type="hidden" name="end" value="<?php echo $check_out; ?>"/>
                <input type="hidden" name="is_search_room" value="true">
                <div class="room-book  <?php if ($start == '' && $end == '') echo "hide"; ?>">
                    <div class="helios-more-extra">
                        <?php
                        $is_minimum_stay = true;
                        if ($start != '' && $end != '') {
                            $minimun_stay = intval(get_post_meta($hotel_id, 'min_book_room', TRUE));
                            $period = STDate::dateDiff($start, $end);
                            if ($minimun_stay && $period < $minimun_stay) {
                                $is_minimum_stay = false;
                            }
                        }
                        $price = get_post_meta(get_the_ID(), 'price', true);
                        ?>
                        <?php if (!empty($list_extra) and $start != '' and $end != '' and $is_minimum_stay) {
                            ?>
                            <span class="btn_extra">
                            <?php esc_html_e("Extra services", ST_TEXTDOMAIN) ?>
                                <i class="fa fa-angle-down"></i>
                        </span>
                        <?php } ?>
                    </div>
                    <div class="options">
                        <?php if ($start != '' && $end != '' && $is_minimum_stay) { ?>
                            <div class="room-number">
                                <select class="form-control option_number_room"
                                        name="room_num_search"
                                        data-price-base="<?php echo esc_attr($price) ?>">
                                    <option value="-1"><?php esc_html_e("Select Room", ST_TEXTDOMAIN) ?></option>
                                    <?php
                                    $max_room = Hotel_Alone_Helper::inst()->_get_number_room_left_on($hotel_id, get_the_ID(), $check_in_temp, $check_out_temp);
                                    if (empty($max_room)) $max_room = 20;
                                    for ($i = 1; $i <= $max_room; $i++) {
                                    echo "<option value='{$i}'>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="list-extra">
                        <?php if (!empty($list_extra)) { ?>
                            <table>
                                <thead>
                                <tr>
                                    <td class="name">
                                        <?php esc_html_e("Service name", ST_TEXTDOMAIN) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php esc_html_e("Quantity", ST_TEXTDOMAIN) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        echo sprintf(esc_html__("Price (%s)", ST_TEXTDOMAIN), TravelHelper::get_current_currency('name'))
                                        ?>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_extra as $k => $v) { ?>
                                    <?php if (!isset($v['extra_required'])) $v['extra_required'] = 'off'; ?>
                                    <tr>
                                        <td>
                                            <span class="title"><?php echo esc_html($v['title']) ?></span>
                                            <input type="hidden" name="extra_price[price][<?php echo esc_attr($v['extra_name']) ?>]" value="<?php echo $v['extra_price']; ?>" />
                                            <input type="hidden" name="extra_price[title][<?php echo esc_attr($v['extra_name']) ?>]" value="<?php echo $v['title']; ?>" />
                                        </td>
                                        <td>
                                            <select class="form-control option_extra_quantity"
                                                    name="extra_price[value][<?php echo esc_attr($v['extra_name']) ?>]"
                                                    data-price-extra="<?php echo esc_attr($v['extra_price']) ?>">
                                                <?php
                                                $start = 0;
                                                if ($v['extra_required'] == 'on')
                                                    $start = 1;
                                                for ($i = $start; $i <= $v['extra_max_number']; $i++) {
                                                    echo "<option value='{$i}'>{$i}</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <?php echo TravelHelper::format_money($v['extra_price']); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <?php
                    if($total>0){ ?>
                        <div class="clearfix guest_name_input mb15 mt30" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-children="<?php echo get_post_meta(get_the_ID(),'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta(get_the_ID(),'disable_infant_name',true) ?>">
                            <label ><strong><?php esc_html_e('Guest Name',ST_TEXTDOMAIN) ?></strong> <span class="required">*</span></label>
                            <div class="guest_name_control">
                                <?php
                                for ($i=0;$i<$total; $i++){
                                    ?>
                                    <div class="control-item mb10">
                                        <select name="guest_title[]" class="form-control" >
                                            <option value="mr" ><?php esc_html_e('Mr',ST_TEXTDOMAIN) ?></option>
                                            <option value="miss" ><?php esc_html_e('Miss',ST_TEXTDOMAIN) ?></option>
                                            <option value="mrs" ><?php esc_html_e('Mrs',ST_TEXTDOMAIN) ?></option>
                                        </select>
                                        <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="">',sprintf(esc_html__('Guest %d name',ST_TEXTDOMAIN),$i+2));?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php }?>
                    <!-- Booking Button -->
                    <div class="guest">
                        <div class="form-message"></div>
                        <?php
                        $external_booking = get_post_meta(get_the_ID(), 'st_room_external_booking', true);
                        if ($external_booking == 'off') {
                            $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout', false);
                            $st_is_booking_modal = apply_filters('st_is_booking_modal', false);
                            if ($st_is_booking_modal && !$st_is_woocommerce_checkout) {
                                ?>
                                <a class="btn-hotel-alone-st-add-cart" data-effect="mfp-zoom-out" onclick="return false"
                                   data-target="#hotel_booking_<?php echo get_the_ID(); ?>"
                                   type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?> <i class="fa fa-spinner fa-spin"></i></a>
                                <?php
                            }else{
                                ?>
                                <button class="btn btn-primary btn-loading btn_hotel_booking btn-hotel-alone-booking"
                                        value="" type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?></button>
                                <?php
                            }
                        }else{
                            $external_booking_link = get_post_meta(get_the_ID(), 'st_room_external_booking_link', true);
                            ?>
                            <a href="<?php echo esc_url($external_booking_link) ?>" data-toggle="tooltip"
                               title="<?php esc_html_e('External Booking', ST_TEXTDOMAIN); ?>" class="btn-hotel-alone-booking-external">
                                <?php esc_html_e("Book now", ST_TEXTDOMAIN) ?> <i class="fa fa-external-link"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
if (st()->get_option('booking_modal', 'off') == 'on' && $st_is_booking_modal) {
    ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide"
         id="hotel_booking_<?php the_ID() ?>">
        <?php echo st()->load_template('hotel/modal_booking'); ?>
    </div>

<?php } ?>

