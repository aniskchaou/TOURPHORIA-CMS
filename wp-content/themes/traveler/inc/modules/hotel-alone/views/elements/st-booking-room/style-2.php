<?php
extract($data);
$form_search_data = vc_param_group_parse_atts($hotel_room_fields);
$list_extra   = array();
$list_extra   = get_post_meta( get_the_ID() , 'extra_price' , true );
?>
<?php
$checkin_d = STInput::request('checkin_d');
$checkin_m = STInput::request('checkin_m');
$checkin_y = STInput::request('checkin_y');

$checkout_d = STInput::request('checkout_d');
$checkout_m = STInput::request('checkout_m');
$checkout_y = STInput::request('checkout_y');

$service_id = get_post_meta(get_the_ID(), 'room_parent', true);
?>
<div id="st-form-booking-room" class="st-form-booking-room style-2">
    <form class="wpbooking-search-form-wrap wpbooking_order_form form-has-guest-name" action="<?php echo get_the_permalink(get_the_ID()); ?>">
        <?php wp_nonce_field('room_search', 'room_search') ?>
        <input name="" class="form_book_checkin_d" value="<?php echo esc_attr($checkin_d) ?>"  type="hidden">
        <input name="" class="form_book_checkin_m" value="<?php echo esc_attr($checkin_m) ?>" type="hidden">
        <input name="" class="form_book_checkin_y" value="<?php echo esc_attr($checkin_y) ?>" type="hidden">

        <input name="" class="form_book_checkout_d" value="<?php echo esc_attr($checkout_d) ?>" type="hidden">
        <input name="" class="form_book_checkout_m" value="<?php echo esc_attr($checkout_m) ?>" type="hidden">
        <input name="" class="form_book_checkout_y" value="<?php echo esc_attr($checkout_y) ?>" type="hidden">

        <input name="room_num_search" class="form_book_room_number"  type="hidden" value="<?php echo STInput::get('room_number', 1); ?>">
        <input name="adult_number" class="form_book_adults adult_number"  type="hidden" value="<?php echo STInput::get('adults', 1); ?>">
        <input name="child_number" class="form_book_children child_number"  type="hidden" value="<?php echo STInput::get('children', 0); ?>">

        <input name="action" class="hotel-alone-action" value="st_add_to_cart" type="hidden">
        <input name="item_id" value="<?php echo $service_id; ?>" type="hidden">
        <input name="room_id" value="<?php echo get_the_ID(); ?>" type="hidden">
        <input name="check_in" class="form_book_check_in" value="" type="hidden">
        <input name="check_out" class="form_book_check_out" value="" type="hidden">

        <div class="title">
            <?php echo do_shortcode($title) ?>
        </div>
        <div class="field">
            <div class="center">
                <div class="row">
                    <?php
                    if(!empty($form_search_data)){
                        foreach($form_search_data as $k => $v){
                            echo st_hotel_alone_load_view('elements/st-form-search-room/fields/' . $v['field_attribute'], false, $v, true);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="control hide_mobile">
            <?php
            $external_booking = get_post_meta(get_the_ID(), 'st_room_external_booking', true);
            if ($external_booking == 'off') {
                $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout', false);
                $st_is_booking_modal = apply_filters('st_is_booking_modal', false);
                if ($st_is_booking_modal && !$st_is_woocommerce_checkout) {
                    ?>
                    <a class="btn-st-add-cart btn btn-primary helios-submit-button" data-effect="mfp-zoom-out" onclick="return false"
                       data-target="#hotel_booking_<?php echo get_the_ID(); ?>"
                       type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?> <i class="fa fa-spinner fa-spin"></i></a>
                    <?php
                }else{
                    ?>
                    <button class="btn btn-primary btn-loading helios-submit-button hotel-alone-booking-now"
                            value="" type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?></button>
                    <?php
                }
            }else{
                $external_booking_link = get_post_meta(get_the_ID(), 'st_room_external_booking_link', true);
                ?>
                <a class="btn btn-primary btn-loading helios-submit-button" href="<?php echo esc_url($external_booking_link) ?>" data-toggle="tooltip"
                   title="<?php esc_html_e('External Booking', ST_TEXTDOMAIN); ?>">
                    <?php esc_html_e("Book Now",ST_TEXTDOMAIN) ?> <i class="fa fa-external-link"></i>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="helios-more-extra">
            <span class="btn_extra"><?php esc_html_e("Extra services",ST_TEXTDOMAIN) ?> <i class="fa fa-angle-down"></i> </span>
        </div>
        <div class="list-extra">
            <?php if(!empty($list_extra)){ ?>
                <table>
                    <thead>
                    <tr>
                        <td class="name">
                            <?php esc_html_e( "Service name" , ST_TEXTDOMAIN ) ?>
                        </td>
                        <td class="text-center">
                            <?php esc_html_e( "Quantity" , ST_TEXTDOMAIN ) ?>
                        </td>
                        <td class="text-center">
                            <?php
                            echo sprintf( esc_html__( "Price (%s)" , ST_TEXTDOMAIN ) , TravelHelper::get_current_currency( 'name' ) )
                            ?>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach( $list_extra as $k => $v ) { ?>
                        <?php if (!isset($v['extra_required'])) $v['extra_required'] = 'off'; ?>
                        <tr>
                            <td>
                                <span class="title"><?php echo esc_html( $v[ 'title' ] ) ?></span>
                                <input type="hidden" name="extra_price[price][<?php echo esc_attr($v['extra_name']) ?>]" value="<?php echo $v['extra_price']; ?>" />
                                <input type="hidden" name="extra_price[title][<?php echo esc_attr($v['extra_name']) ?>]" value="<?php echo $v['title']; ?>" />
                            </td>
                            <td>
                                <select class="form-control option_extra_quantity" name="extra_price[value][<?php echo esc_attr($v['extra_name']) ?>]" data-price-extra="<?php echo esc_attr( $v[ 'extra_price' ] ) ?>">
                                    <?php
                                    $start = 0;
                                    if($v[ 'extra_required' ] == 'on')
                                        $start = 1;
                                    for( $i = $start ; $i <= $v[ 'extra_max_number' ] ; $i++ ) {
                                        echo "<option value='{$i}'>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <?php echo TravelHelper::format_money( $v[ 'extra_price' ] ); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="guest_name_input hidden mb15 mt30" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-children="<?php echo get_post_meta(get_the_ID(),'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta(get_the_ID(),'disable_infant_name',true) ?>">
                    <label ><strong><?php esc_html_e('Guest Name',ST_TEXTDOMAIN) ?></strong> <span class="required">*</span></label>
                    <div class="guest_name_control">
                        <?php
                        $controls = STInput::request('guest_name');
                        $guest_titles = STInput::request('guest_title');
                        if(!empty($controls) and is_array($controls))
                        {
                            foreach ($controls as $k=>$control){
                                ?>
                                <div class="control-item mb10">
                                    <select name="guest_title[]" class="form-control" >
                                        <option value="mr" <?php selected('mr',isset($guest_titles[$k])?$guest_titles[$k]:'') ?>><?php esc_html_e('Mr',ST_TEXTDOMAIN) ?></option>
                                        <option value="miss" <?php selected('miss',isset($guest_titles[$k])?$guest_titles[$k]:'') ?> ><?php esc_html_e('Miss',ST_TEXTDOMAIN) ?></option>
                                        <option value="mrs" <?php selected('mrs',isset($guest_titles[$k])?$guest_titles[$k]:'') ?>><?php esc_html_e('Mrs',ST_TEXTDOMAIN) ?></option>
                                    </select>
                                    <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="%s">',sprintf(esc_html__('Guest %d name',ST_TEXTDOMAIN),$k+2),esc_attr($control));?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <script type="text/html" id="guest_name_control_item">
                        <div class="control-item mb10">
                            <select name="guest_title[]" class="form-control" >
                                <option value="mr" ><?php esc_html_e('Mr',ST_TEXTDOMAIN) ?></option>
                                <option value="miss"  ><?php esc_html_e('Miss',ST_TEXTDOMAIN) ?></option>
                                <option value="mrs" ><?php esc_html_e('Mrs',ST_TEXTDOMAIN) ?></option>
                            </select>
                            <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="">',esc_html__('Guest %d name',ST_TEXTDOMAIN));?>
                        </div>
                    </script>
                </div>
            </div>
        </div>

        <div class="control show_mobile">
            <?php
            $external_booking = get_post_meta(get_the_ID(), 'st_room_external_booking', true);
            if ($external_booking == 'off') {
                $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout', false);
                $st_is_booking_modal = apply_filters('st_is_booking_modal', false);
                if ($st_is_booking_modal && !$st_is_woocommerce_checkout) {
                    ?>
                    <a class="btn-st-add-cart btn btn-primary helios-submit-button" data-effect="mfp-zoom-out" onclick="return false"
                       data-target="#hotel_booking_<?php echo get_the_ID(); ?>"
                       type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?> <i class="fa fa-spinner fa-spin"></i></a>
                    <?php
                }else{
                    ?>
                    <button class="btn btn-primary btn-loading helios-submit-button hotel-alone-booking-now"
                            value="" type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?></button>
                    <?php
                }
            }else{
                $external_booking_link = get_post_meta(get_the_ID(), 'st_room_external_booking_link', true);
                ?>
                <a class="btn btn-primary btn-loading helios-submit-button" href="<?php echo esc_url($external_booking_link) ?>" data-toggle="tooltip"
                   title="<?php esc_html_e('External Booking', ST_TEXTDOMAIN); ?>">
                    <?php esc_html_e("Book Now",ST_TEXTDOMAIN) ?> <i class="fa fa-external-link"></i>
                </a>
                <?php
            }
            ?>
        </div>
        <div class="message_box"></div>
        <div class="search_room_alert"></div>
    </form>
</div>

<?php $st_is_booking_modal = apply_filters('st_is_booking_modal', false); ?>
<?php if (st()->get_option('booking_modal', 'off') == 'on' && $st_is_booking_modal): ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="hotel_booking_<?php the_ID() ?>">
        <?php echo st()->load_template('hotel/modal_booking'); ?>
    </div>
<?php endif; ?>
