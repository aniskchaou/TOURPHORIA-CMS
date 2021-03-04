<?php

/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 10/29/2018
 * Time: 10:56 AM
 */
class New_Layout_Helper
{
    /*NgoThoai*/
    static function isRoomAloneLayout($post_id = false)
    {
        if (empty($post_id))
            $post_id = get_the_ID();
        $hotel_parent = get_post_meta($post_id, 'room_parent', true);
        if (!empty($hotel_parent)) {
            $hotel_alone_in_setting = st()->get_option('hotel_alone_assign_hotel', '');
            if ($hotel_alone_in_setting == $hotel_parent) {
                $is_room_alone = get_post_meta($post_id, 'hotel_alone_room_layout', true);
                if ($is_room_alone == 'on') {
                    return true;
                }
            }
        }
        return false;
    }

    static function isLayoutHotelActivity()
    {
        $check = false;
        if (is_page_template('template-hotel-activity.php') || is_page_template('template-single-hotel-modern.php')) {
            $check = true;
        }

        $hotel_parent = st()->get_option('hotel_alone_assign_hotel');
        if ((is_page_template('template-checkout.php') || is_page_template('template-confirm.php') || is_page_template('template-payment-success.php') || self::isCheckWooPage() || is_404() || is_singular('post')) && !empty($hotel_parent)) {
            $check = true;
        }

        if (self::isRoomAloneLayout()) {
            $check = true;
        }

        return $check;
    }

    static function isLayoutTourModern()
    {
        $check = false;
        if (is_page_template('template-single-tour-modern.php') || is_singular('post')) {
            $check = true;
        }

        return $check;
    }

    static function enqueueTourModern()
    {
        wp_localize_script('jquery', 'st_checkout_text', [
            'without_pp' => __('Submit Request', ST_TEXTDOMAIN),
            'with_pp' => __('Booking Now', ST_TEXTDOMAIN),
            'validate_form' => __('Please fill all required fields', ST_TEXTDOMAIN),
            'error_accept_term' => __('Please accept our terms and conditions', ST_TEXTDOMAIN),
            'email_validate' => __('Email is not valid', ST_TEXTDOMAIN),
            'adult_price' => __('Adult', ST_TEXTDOMAIN),
            'child_price' => __("Child", ST_TEXTDOMAIN),
            'infant_price' => __("Infant", ST_TEXTDOMAIN),
            'adult' => __("Adult", ST_TEXTDOMAIN),
            'child' => __("Child", ST_TEXTDOMAIN),
            'infant' => __("Infant", ST_TEXTDOMAIN),
            'price' => __("Price", ST_TEXTDOMAIN),
            'origin_price' => __("Origin Price", ST_TEXTDOMAIN)
        ]);
        wp_localize_script('jquery', 'st_params', [
            'theme_url' => get_template_directory_uri(),
            'site_url' => site_url(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'loading_url' => admin_url('/images/wpspin_light.gif'),
            'st_search_nonce' => wp_create_nonce("st_search_security"),
            'facebook_enable' => st()->get_option('social_fb_login', 'on'),
            'facbook_app_id' => st()->get_option('social_fb_app_id'),
            'booking_currency_precision' => TravelHelper::get_current_currency('booking_currency_precision'),
            'thousand_separator' => TravelHelper::get_current_currency('thousand_separator'),
            'decimal_separator' => TravelHelper::get_current_currency('decimal_separator'),
            'currency_symbol' => TravelHelper::get_current_currency('symbol'),
            'currency_position' => TravelHelper::get_current_currency('booking_currency_pos'),
            'currency_rtl_support' => TravelHelper::get_current_currency('currency_rtl_support'),
            'free_text' => __('Free', ST_TEXTDOMAIN),
            'date_format' => TravelHelper::getDateFormatJs(),
            'date_format_calendar' => TravelHelper::getDateFormatJs(null, 'calendar'),
            'time_format' => st()->get_option('time_format', '12h'),

            'mk_my_location' => get_template_directory_uri() . '/img/my_location.png',
            'locale' => file_exists(ST_TRAVELER_DIR . '/js/locales/bootstrap-datepicker.' . get_locale() . '.js') ? get_locale() : TravelHelper::get_minify_locale(get_locale()),
            'header_bgr' => st()->get_option('header_background', ''),
            'text_refresh' => __("Refresh", ST_TEXTDOMAIN),
            'date_fomat' => TravelHelper::getDateFormatMoment(),
            'text_loading' => __("Loading...", ST_TEXTDOMAIN),
            'text_no_more' => __("No More", ST_TEXTDOMAIN),
            'weather_api_key' => st()->get_option('weather_api_key', 'a82498aa9918914fa4ac5ba584a7e623'),
            'no_vacancy' => __('No vacancies', ST_TEXTDOMAIN),
            'a_vacancy' => __('a vacancy', ST_TEXTDOMAIN),
            'more_vacancy' => __('vacancies', ST_TEXTDOMAIN),
            'utm' => (is_ssl() ? 'https' : 'http') . '://shinetheme.com/utm/utm.gif',
            '_s' => wp_create_nonce('st_frontend_security'),
            'mclusmap' => get_template_directory_uri() . '/v2/images/icon_map/ico_gruop_location.svg',
            'icon_contact_map' => get_template_directory_uri() . '/v2/images/markers/ico_location_3.png',
            'text_adult' => __('Adult', ST_TEXTDOMAIN),
            'text_adults' => __('Adults', ST_TEXTDOMAIN),
            'text_child' => __('Children', ST_TEXTDOMAIN),
            'text_childs' => __('Childrens', ST_TEXTDOMAIN),
            //Set multi lang using js
        ]);
        wp_localize_script('jquery', 'st_timezone', [
            'timezone_string' => get_option('timezone_string', 'local')
        ]);
        wp_localize_script('jquery', 'st_list_map_params', [
            'mk_my_location' => get_template_directory_uri() . '/img/my_location.png',
            'text_my_location' => __("3000 m radius", ST_TEXTDOMAIN),
            'text_no_result' => __("No Result", ST_TEXTDOMAIN),
            'cluster_0' => __("<div class='cluster cluster-1'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_20' => __("<div class='cluster cluster-2'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_50' => __("<div class='cluster cluster-3'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_m1' => get_template_directory_uri() . '/img/map/m1.png',
            'cluster_m2' => get_template_directory_uri() . '/img/map/m2.png',
            'cluster_m3' => get_template_directory_uri() . '/img/map/m3.png',
            'cluster_m4' => get_template_directory_uri() . '/img/map/m4.png',
            'cluster_m5' => get_template_directory_uri() . '/img/map/m5.png',
            'icon_full_screen' => get_template_directory_uri() . '/v2/images/icon_map/ico_fullscreen.svg',
            'icon_my_location' => get_template_directory_uri() . '/v2/images/icon_map/ico_location.svg',
            'icon_my_style' => get_template_directory_uri() . '/v2/images/icon_map/ico_view_maps.svg',
            'icon_zoom_out' => get_template_directory_uri() . '/v2/images/icon_map/ico_maps_zoom-out.svg',
            'icon_zoom_in' => get_template_directory_uri() . '/v2/images/icon_map/ico_maps_zoom_in.svg',
            'icon_close' => get_template_directory_uri() . '/v2/images/icon_map/icon_close.svg',
        ]);
        wp_localize_script('jquery', 'st_config_partner', [
            'text_er_image_format' => false,
        ]);

        wp_enqueue_style('select2.min-css', get_template_directory_uri() . '/v2/css/select2.min.css');
        wp_enqueue_style('google-font-css', 'https://fonts.googleapis.com/css?family=Playfair+Display|Poppins:400,500,600');
        wp_enqueue_style('google-font-Poppins', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
        wp_enqueue_style('google-font-Playfair', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700&amp;subset=latin-ext');
        wp_enqueue_style('daterangepicker-css', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.css');
        wp_enqueue_style('carousel-css', get_template_directory_uri() . '/v2/js/owlcarousel/assets/owl.carousel.min.css');
        wp_enqueue_style('theme.default-css', get_template_directory_uri() . '/v2/css/owl.theme.default.min.css');
        wp_enqueue_style('helpers-css', get_template_directory_uri() . '/v2/css/helpers.css');

        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/v2/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/v2/css/font-awesome.min.css');
        wp_enqueue_style('fotorama-css', get_template_directory_uri() . '/v2/js/fotorama/fotorama.css');
        wp_enqueue_style('single-tour-modern-css', get_template_directory_uri() . '/v2/css/single-tour.css');

        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/v2/js/bootstrap.min.js', ['jquery'], null, true);
        wp_enqueue_script('fotorama-js', get_template_directory_uri() . '/v2/js/fotorama/fotorama.js', ['jquery'], null, true);
        wp_enqueue_script('owlcarousel-js', get_template_directory_uri() . '/v2/js/owlcarousel/owl.carousel.min.js', ['jquery'], null, true);
        wp_enqueue_script('moment-js', get_template_directory_uri() . '/v2/js/moment.min.js', ['jquery'], null, true);
        wp_enqueue_script('select2.full.min-js', get_template_directory_uri() . '/v2/js/select2.full.min.js', ['jquery'], null, true);
        wp_enqueue_script('daterangepicker-js', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.js', ['jquery'], null, true);
        wp_enqueue_script('daterangepicker-lang-js', get_template_directory_uri() . '/v2/js/daterangepicker/languages/' . get_locale() . '.js', ['jquery'], null, true);

        wp_enqueue_script('map', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . st()->get_option('google_api_key'), ['jquery'], null, false);
        wp_enqueue_script('match-height-js', get_template_directory_uri() . '/v2/js/jquery.matchHeight.js', ['jquery'], null, true);
        wp_enqueue_script('single-tour-modern', get_template_directory_uri() . '/v2/js/single-tour.js', ['jquery'], null, true);
    }

    static function enqueueHotelActivity()
    {
        wp_localize_script('jquery', 'hotel_alone_params', array(
            'theme_url' => get_template_directory_uri(),
            'site_url' => site_url(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'loading_icon' => '<i class="fa fa-spinner fa-spin"></i>',
            'dateformat_convert' => TravelHelper::getDateFormatJs(),
            'dateformat' => TravelHelper::getDateFormatMoment(),
            'month_1' => esc_html__("Jan", ST_TEXTDOMAIN),
            'month_2' => esc_html__("Feb", ST_TEXTDOMAIN),
            'month_3' => esc_html__("Mar", ST_TEXTDOMAIN),
            'month_4' => esc_html__("Apr", ST_TEXTDOMAIN),
            'month_5' => esc_html__("May", ST_TEXTDOMAIN),
            'month_6' => esc_html__("Jun", ST_TEXTDOMAIN),
            'month_7' => esc_html__("Jul", ST_TEXTDOMAIN),
            'month_8' => esc_html__("Aug", ST_TEXTDOMAIN),
            'month_9' => esc_html__("Sep", ST_TEXTDOMAIN),
            'month_10' => esc_html__("Oct", ST_TEXTDOMAIN),
            'month_11' => esc_html__("Nov", ST_TEXTDOMAIN),
            'month_12' => esc_html__("Dec", ST_TEXTDOMAIN),
            'room_required' => esc_html__("Room number field is required!", ST_TEXTDOMAIN),
            'add_to_cart_link' => STCart::get_cart_link(),
            'number_room_required' => __('Number room is required.', ST_TEXTDOMAIN),
            '_s' => wp_create_nonce('st_frontend_security'),
        ));


        wp_enqueue_style('google-font-css', 'https://fonts.googleapis.com/css?family=Playfair+Display|Poppins:400,500,600');
        wp_enqueue_style('google-font-Poppins', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
        wp_enqueue_style('google-font-Playfair', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700&amp;subset=latin-ext');
        wp_enqueue_style('daterangepicker-css', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.css');
        wp_enqueue_style('magnific-css', get_template_directory_uri() . '/v2/css/magnific-popup.css');
        wp_enqueue_style('flickity-css', get_template_directory_uri() . '/v2/css/flickity.css');
        wp_enqueue_style('carousel-css', get_template_directory_uri() . '/v2/js/owlcarousel/assets/owl.carousel.min.css');
        wp_enqueue_style('theme.default-css', get_template_directory_uri() . '/v2/css/owl.theme.default.min.css');

        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/v2/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/v2/css/font-awesome.min.css');
        wp_enqueue_style('fotorama-css', get_template_directory_uri() . '/v2/js/fotorama/fotorama.css');
        wp_enqueue_style('single-hotel-css', get_template_directory_uri() . '/v2/css/single-hotel.css');

        wp_enqueue_style('sts-single-hotel-checkout-css', get_template_directory_uri() . '/v2/css/single-hotel-checkout.css');
        wp_enqueue_style('sts-single-hotel-page', get_template_directory_uri() . '/v2/css/single-hotel-page.css');
        wp_enqueue_style('sts-fsafari-single-hotel-page', get_template_directory_uri() . '/v2/css/fsafari-single-hotel.css');
        wp_enqueue_style('sts-single-hotel-page-responsive', get_template_directory_uri() . '/v2/css/single-hotel-page-responsive.css');
        wp_enqueue_style('sts-rtl', get_template_directory_uri() . '/v2/css/rtl3.css');
        if (is_page() and is_page_template('template-member-package-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        if (is_page() and is_page_template('template-checkout-packages-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        if (is_page() and is_page_template('template-package-success-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        if (is_rtl() || st()->get_option('right_to_left') == 'on') {
            wp_enqueue_style('sts-rtl', get_template_directory_uri() . '/v2/css/rtl3.css');
        }

        wp_enqueue_style('single-hotel-responsive-css', get_template_directory_uri() . '/v2/css/single-hotel-responsive.css');
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/v2/js/bootstrap.min.js', ['jquery'], null, true);
        wp_enqueue_script('fotorama-js', get_template_directory_uri() . '/v2/js/fotorama/fotorama.js', ['jquery'], null, true);
        wp_enqueue_script('owlcarousel-js', get_template_directory_uri() . '/v2/js/owlcarousel/owl.carousel.min.js', ['jquery'], null, true);
        wp_enqueue_script('flickity-js', get_template_directory_uri() . '/v2/js/flickity.pkgd.min.js', ['jquery']);
        wp_enqueue_script('masonry-js', get_template_directory_uri() . '/v2/js/masonry.pkgd.min.js', ['jquery'], null, true);
        wp_enqueue_script('moment-js', get_template_directory_uri() . '/v2/js/moment.min.js', ['jquery'], null, true);
        wp_enqueue_script('modernizr-js', get_template_directory_uri() . '/inc/modules/hotel-alone/assets/lib/mutimenu/js/modernizr.custom.js', ['jquery'], null, true);

        wp_enqueue_script('daterangepicker-js', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.js', ['jquery'], null, true);
        wp_enqueue_script('scrollreveal-js', get_template_directory_uri() . '/v2/js/scrollreveal.js', ['jquery'], null, true);
        wp_enqueue_script('daterangepicker-lang-js', get_template_directory_uri() . '/v2/js/daterangepicker/languages/' . get_locale() . '.js', ['jquery'], null, true);
        wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', ['jquery'], null, true);

        //Load Hai Slider
        wp_register_style('sts-hai-slider', get_template_directory_uri() . '/v2/js/hai-slider/css/style.css');
        wp_enqueue_script('sts-hai-imagesloaded', get_template_directory_uri() . '/v2/js/hai-slider/js/imagesloaded.pkgd.min.js', ['jquery'], null, true);
        wp_enqueue_script('sts-hai-slider', get_template_directory_uri() . '/v2/js/hai-slider/js/vinhomeSlider.js', ['jquery'], null, true);

        wp_enqueue_script('scroll-desktop-smoothjs', get_template_directory_uri() . '/v2/js/scroll-desktop-smooth.js', ['jquery'], null, true);
        wp_enqueue_script('scroll-desktop-js', get_template_directory_uri() . '/v2/js/scroll-desktop.js', ['jquery'], null, true);
        wp_enqueue_script('single-hotel-origin', get_template_directory_uri() . '/v2/js/single-hotel.js', ['jquery'], null, true);
        wp_enqueue_script('sts-single-hotel-filter', get_template_directory_uri() . '/v2/js/filter/single-hotel.js', ['jquery'], null, true);
        wp_register_script('checkout-js', get_template_directory_uri() . '/js/init/template-checkout.js', ['jquery'], null, true);
        $google_api_key = st()->get_option('google_api_key');
        wp_enqueue_script('map', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . $google_api_key, ['jquery'], null, false);
        wp_enqueue_script('match-height-js', get_template_directory_uri() . '/v2/js/jquery.matchHeight.js', ['jquery'], null, true);

        wp_localize_script('jquery', 'st_checkout_text', [
            'without_pp' => __('Submit Request', ST_TEXTDOMAIN),
            'with_pp' => __('Booking Now', ST_TEXTDOMAIN),
            'validate_form' => __('Please fill all required fields', ST_TEXTDOMAIN),
            'error_accept_term' => __('Please accept our terms and conditions', ST_TEXTDOMAIN),
            'email_validate' => __('Email is not valid', ST_TEXTDOMAIN),
            'adult_price' => __('Adult', ST_TEXTDOMAIN),
            'child_price' => __("Child", ST_TEXTDOMAIN),
            'infant_price' => __("Infant", ST_TEXTDOMAIN),
            'adult' => __("Adult", ST_TEXTDOMAIN),
            'child' => __("Child", ST_TEXTDOMAIN),
            'infant' => __("Infant", ST_TEXTDOMAIN),
            'price' => __("Price", ST_TEXTDOMAIN),
            'origin_price' => __("Origin Price", ST_TEXTDOMAIN)
        ]);

        wp_localize_script('jquery', 'st_params', [
            'theme_url' => get_template_directory_uri(),
            'site_url' => site_url(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'loading_url' => admin_url('/images/wpspin_light.gif'),
        ]);
    }

    static function isNewLayout()
    {
        $check = false;
        $new_layout = st()->get_option('st_theme_style', 'classic');
        if ($new_layout == 'modern') {
            if ((is_front_page() or is_page() or is_home()) and is_page_template('template-home-modern.php')) {
                $check = true;
            }

            if (is_singular() and get_post_type(get_the_ID()) == 'st_hotel') {
                $check = true;
            }
            if (is_singular('hotel_room')) {
                $check = true;
            }
            if (is_singular('st_rental')) {
                $check = true;
            }
            if (is_singular('st_tours')) {
                $check = true;
            }
            if (is_singular('st_activity')) {
                $check = true;
            }
            if (is_singular('st_cars')) {
                $check = true;
            }
            if (is_singular('post')) {
                $check = true;
            }

            if (is_page() and (is_page_template('template-hotel-search.php'))) {
                $check = true;
            }

            if (is_page() and (is_page_template('template-tour-search.php'))) {
                $check = true;
            }
            if (is_page() and (is_page_template('template-activity-search.php'))) {
                $check = true;
            }

            if (is_page() and (is_page_template('template-activity-search.php'))) {
                $check = true;
            }
            if (is_page() and (is_page_template('template-rental-search.php'))) {
                $check = true;
            }
            if (is_page() and (is_page_template('template-cars-search.php'))) {
                $check = true;
            }

            if (is_page() and is_page_template('template-checkout.php')) {
                $check = true;
            }

            if (is_page() and is_page_template('template-payment-success.php')) {
                $check = true;
            }

            if (is_404()) {
                $check = true;
            }

            if (is_page() and is_page_template('template-blog.php')) {
                $check = true;
            }

            if (is_archive() and !is_author()) {
                $check = true;
            }

            if (is_search()) {
                $check = true;
            }

            if (is_page_template('template-confirm.php')) {
                $check = true;
            }

            if (is_author()) {
                $check = true;
            }

            //Woo check
            if (self::isCheckWooPage()) {
                $check = true;
            }
            if (is_page() and is_page_template('template-member-package-new.php')) {
                $check = true;
            }
            if (is_page() and is_page_template('template-checkout-packages-new.php')) {
                $check = true;
            }
            if (is_page() and is_page_template('template-package-success-new.php')) {
                $check = true;
            }
        } else {
            if (is_page() and is_page_template('template-member-package-new.php')) {
                $check = true;
            }
        }

        return $check;
    }

    static function buildTreeOptionLocation($locations, $location_id)
    {
        if (is_array($locations) && count($locations)):
            foreach ($locations as $key => $value):
                $level = 20;
                if ($value['lv'] == 2) {
                    $level = $value['lv'] * 10;
                }
                if ($value['lv'] > 2) {
                    $level = $value['lv'] * 10 + (($value['lv'] - 2) * 10);
                }
                $class_f = '';
                if ($value['lv'] == 1)
                    $class_f = 'parent_li';
                ?>
                <li style="padding-left: <?php echo $level . 'px;'; ?>" <?php selected($value['ID'], $location_id); ?>
                    data-country="<?php echo $value['Country']; ?>"
                    data-value="<?php echo $value['ID']; ?>" class="item <?php echo $class_f; ?>">
                    <?php
                    if ($value['lv'] == 2) {
                        echo TravelHelper::getNewIcon('ico_maps_search_box', 'gray', '16px', '16px', true);
                        echo '<span class="lv2">' . $value['post_title'] . '</span>';
                    } else {
                        if ($value['lv'] == 1) {
                            echo '<span class="parent">' . $value['post_title'] . '</span>';
                        } else {
                            echo '<span class="child">' . $value['post_title'] . '</span>';
                        }

                    }
                    ?>
                </li>
                <?php
                if (isset($value['children'])) {
                    if (is_array($value['children'])) {
                        self::buildTreeOptionLocation($value['children'], $location_id);
                    }
                }
            endforeach;
        endif;
    }

    static function listTaxTreeFilter($taxonomy = 'category', $parent = 0, $level = 0, $post_type = 'post', $more = true, &$term_parent = '')
    {
        $key = $taxonomy;
        $terms = get_terms($taxonomy, ['hide_empty' => false, 'parent' => $parent]);
        if (!empty($terms)):
            $level += 1;
            $count_hidden = 1;
            foreach ($terms as $key2 => $value2) {
                if ($post_type == 'hotel_room') {
                    $name_field = "taxonomy_hotel_room";
                } else {
                    $name_field = "taxonomy";
                }

                $current = STInput::get($name_field);

                if (isset($current[$key]))
                    $current = $current[$key];
                else $current = '';

                $checked = TravelHelper::checked_array(explode(',', $current), $value2->term_id);

                if ($level == 0) {
                    $term_parent = $value2->term_id;
                }
                $style_rtl = 'margin-left: ' . (22 * $level) . 'px';
                if (is_rtl()) {
                    $style_rtl = 'margin-right: ' . (22 * $level) . 'px';
                }
                ?>
                <li class="<?php echo ($count_hidden > 3 && $more) ? 'hidden' : ''; ?> st-icheck-item"
                    style="<?php echo $style_rtl; ?>"><label><?php echo esc_html($value2->name) ?><input
                                data-tax="taxonomy" data-type="<?php echo $taxonomy; ?>"
                                value="<?php echo $value2->term_id; ?>" type="checkbox"
                                name="taxonomy" <?php if ($checked) echo "checked"; ?> class="filter-tax"/><span
                                class="checkmark fcheckbox"></span>
                    </label></li>
                <?php
                self::listTaxTreeFilter($taxonomy, $value2->term_id, $level, $post_type, $term_parent);
                $count_hidden++;
            }
        endif;
    }

    static function cutStringByNumWord($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . ' ...';
        }
        return $text;
    }

    static function enqueueNewScript()
    {
        //Enqueue new script here
        wp_enqueue_style('google-font-css', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600');
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/v2/css/bootstrap.min.css');
        wp_enqueue_style('helpers-css', get_template_directory_uri() . '/v2/css/helpers.css');
        wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/v2/css/font-awesome.min.css');
        wp_enqueue_style('fotorama-css', get_template_directory_uri() . '/v2/js/fotorama/fotorama.css');
        wp_enqueue_style('rangeSlider-css', get_template_directory_uri() . '/v2/js/ion.rangeSlider/css/ion.rangeSlider.css');
        wp_enqueue_style('rangeSlider-skinHTML5-css', get_template_directory_uri() . '/v2/js/ion.rangeSlider/css/ion.rangeSlider.skinHTML5.css');
        wp_enqueue_style('daterangepicker-css', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.css');
        wp_enqueue_style('sweetalert2-css', get_template_directory_uri() . '/v2/css/sweetalert2.css');
        wp_enqueue_style('select2.min-css', get_template_directory_uri() . '/v2/css/select2.min.css');
        wp_enqueue_style('flickity-css', get_template_directory_uri() . '/v2/css/flickity.css');
        wp_enqueue_style('magnific-css', get_template_directory_uri() . '/v2/js/magnific-popup/magnific-popup.css');
        wp_enqueue_style('owlcarousel-css', get_template_directory_uri() . '/v2/js/owlcarousel/assets/owl.carousel.min.css');
        wp_enqueue_style('st-style-css', get_template_directory_uri() . '/v2/css/style.css');
        wp_enqueue_style('search-result-css', get_template_directory_uri() . '/v2/css/search_result.css');
        wp_enqueue_style('st-fix-safari-css', get_template_directory_uri() . '/v2/css/fsafari.css');
        wp_enqueue_style('checkout-css', get_template_directory_uri() . '/v2/css/checkout.css');
        wp_enqueue_style('partner-page-css', get_template_directory_uri() . '/v2/css/partner_page.css');
        wp_enqueue_style('responsive-css', get_template_directory_uri() . '/v2/css/responsive.css');
        if (is_page() and is_page_template('template-member-package-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        if (is_page() and is_page_template('template-checkout-packages-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        if (is_page() and is_page_template('template-package-success-new.php')) {
            wp_enqueue_style('menbership-css', get_template_directory_uri() . '/v2/css/membership.css');
            wp_enqueue_script('icheck.js', get_template_directory_uri() . '/js/icheck.js', ['jquery'], null, true);
        }
        $google_api_key = st()->get_option('google_api_key');
        wp_enqueue_script('map', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . $google_api_key, ['jquery'], null, false);
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/v2/js/bootstrap.min.js', ['jquery'], null, true);
        wp_enqueue_script('match-height-js', get_template_directory_uri() . '/v2/js/jquery.matchHeight.js', ['jquery'], null, true);
        wp_enqueue_script('fotorama-js', get_template_directory_uri() . '/v2/js/fotorama/fotorama.js', ['jquery'], null, true);
        wp_enqueue_script('ion-rangeslider-js', get_template_directory_uri() . '/v2/js/ion.rangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js', ['jquery'], null, true);
        wp_enqueue_script('moment-js', get_template_directory_uri() . '/v2/js/moment.min.js', ['jquery'], null, true);
        wp_enqueue_script('daterangepicker-js', get_template_directory_uri() . '/v2/js/daterangepicker/daterangepicker.js', ['jquery'], null, true);
        wp_enqueue_script('daterangepicker-lang-js', get_template_directory_uri() . '/v2/js/daterangepicker/languages/' . get_locale() . '.js', ['jquery'], null, true);
        wp_enqueue_script('nicescroll-js', get_template_directory_uri() . '/v2/js/jquery.nicescroll.min.js', ['jquery'], null, true);
        wp_enqueue_script('sweetalert2.min-js', get_template_directory_uri() . '/v2/js/sweetalert2.min.js', ['jquery'], null, true);
        wp_enqueue_script('markerclusterer-js', get_template_directory_uri() . '/v2/js/markerclusterer.js', ['jquery'], null, true);
        wp_enqueue_script('select2.full.min-js', get_template_directory_uri() . '/v2/js/select2.full.min.js', ['jquery'], null, true);
        wp_enqueue_script('infobox-js', get_template_directory_uri() . '/v2/js/infobox.js', ['jquery'], null, true);
        wp_enqueue_script('magnific-js', get_template_directory_uri() . '/v2/js/magnific-popup/jquery.magnific-popup.min.js');
        wp_register_script('filter-hotel-js', get_template_directory_uri() . '/v2/js/filter/hotel.js', ['jquery'], null, true);
        wp_register_script('filter-tour-js', get_template_directory_uri() . '/v2/js/filter/tour.js', ['jquery'], null, true);
        wp_register_script('filter-activity-js', get_template_directory_uri() . '/v2/js/filter/activity.js', ['jquery'], null, true);
        wp_register_script('filter-rental-js', get_template_directory_uri() . '/v2/js/filter/rental.js', ['jquery'], null, true);
        wp_register_script('filter-car-js', get_template_directory_uri() . '/v2/js/filter/car.js', ['jquery'], null, true);
        wp_enqueue_script('flickity.pkgd.min-js', get_template_directory_uri() . '/v2/js/flickity.pkgd.min.js', ['jquery'], null, true);
        wp_enqueue_script('owlcarousel-js', get_template_directory_uri() . '/v2/js/owlcarousel/owl.carousel.min.js', ['jquery'], null, true);
        wp_enqueue_script('mb-YTPlayer', get_template_directory_uri() . '/v2/js/jquery.mb.YTPlayer.min.js', array('jquery'), null, true);
        wp_enqueue_script('custom-js', get_template_directory_uri() . '/v2/js/custom.js', ['jquery'], null, true);

        wp_register_script('checkout-js', get_template_directory_uri() . '/js/init/template-checkout.js', ['jquery'], null, true);

        if (is_rtl() || st()->get_option('right_to_left') == 'on') {
            wp_enqueue_style('rtl-css', get_template_directory_uri() . '/v2/css/rtl.css');
            wp_enqueue_style('rtl2-css', get_template_directory_uri() . '/v2/css/rtl2.css');
        }

        wp_localize_script('jquery', 'st_checkout_text', [
            'without_pp' => __('Submit Request', ST_TEXTDOMAIN),
            'with_pp' => __('Booking Now', ST_TEXTDOMAIN),
            'validate_form' => __('Please fill all required fields', ST_TEXTDOMAIN),
            'error_accept_term' => __('Please accept our terms and conditions', ST_TEXTDOMAIN),
            'email_validate' => __('Email is not valid', ST_TEXTDOMAIN),
            'adult_price' => __('Adult', ST_TEXTDOMAIN),
            'child_price' => __("Child", ST_TEXTDOMAIN),
            'infant_price' => __("Infant", ST_TEXTDOMAIN),
            'adult' => __("Adult", ST_TEXTDOMAIN),
            'child' => __("Child", ST_TEXTDOMAIN),
            'infant' => __("Infant", ST_TEXTDOMAIN),
            'price' => __("Price", ST_TEXTDOMAIN),
            'origin_price' => __("Origin Price", ST_TEXTDOMAIN)
        ]);
        wp_localize_script('jquery', 'st_params', [
            'theme_url' => get_template_directory_uri(),
            'site_url' => site_url(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'loading_url' => admin_url('/images/wpspin_light.gif'),
            'st_search_nonce' => wp_create_nonce("st_search_security"),
            'facebook_enable' => st()->get_option('social_fb_login', 'on'),
            'facbook_app_id' => st()->get_option('social_fb_app_id'),
            'booking_currency_precision' => TravelHelper::get_current_currency('booking_currency_precision'),
            'thousand_separator' => TravelHelper::get_current_currency('thousand_separator'),
            'decimal_separator' => TravelHelper::get_current_currency('decimal_separator'),
            'currency_symbol' => TravelHelper::get_current_currency('symbol'),
            'currency_position' => TravelHelper::get_current_currency('booking_currency_pos'),
            'currency_rtl_support' => TravelHelper::get_current_currency('currency_rtl_support'),
            'free_text' => __('Free', ST_TEXTDOMAIN),
            'date_format' => TravelHelper::getDateFormatJs(),
            'date_format_calendar' => TravelHelper::getDateFormatJs(null, 'calendar'),
            'time_format' => st()->get_option('time_format', '12h'),

            'mk_my_location' => get_template_directory_uri() . '/img/my_location.png',
            'locale' => file_exists(ST_TRAVELER_DIR . '/js/locales/bootstrap-datepicker.' . get_locale() . '.js') ? get_locale() : TravelHelper::get_minify_locale(get_locale()),
            'header_bgr' => st()->get_option('header_background', ''),
            'text_refresh' => __("Refresh", ST_TEXTDOMAIN),
            'date_fomat' => TravelHelper::getDateFormatMoment(),
            'text_loading' => __("Loading...", ST_TEXTDOMAIN),
            'text_no_more' => __("No More", ST_TEXTDOMAIN),
            'weather_api_key' => st()->get_option('weather_api_key', 'a82498aa9918914fa4ac5ba584a7e623'),
            'no_vacancy' => __('No vacancies', ST_TEXTDOMAIN),
            'a_vacancy' => __('a vacancy', ST_TEXTDOMAIN),
            'more_vacancy' => __('vacancies', ST_TEXTDOMAIN),
            'utm' => (is_ssl() ? 'https' : 'http') . '://shinetheme.com/utm/utm.gif',
            '_s' => wp_create_nonce('st_frontend_security'),
            'mclusmap' => get_template_directory_uri() . '/v2/images/icon_map/ico_gruop_location.svg',
            'icon_contact_map' => get_template_directory_uri() . '/v2/images/markers/ico_location_3.png',
            'text_adult' => __('Adult', ST_TEXTDOMAIN),
            'text_adults' => __('Adults', ST_TEXTDOMAIN),
            'text_child' => __('Children', ST_TEXTDOMAIN),
            'text_childs' => __('Childrens', ST_TEXTDOMAIN),
            //Set multi lang using js
        ]);
        wp_localize_script('jquery', 'st_timezone', [
            'timezone_string' => get_option('timezone_string', 'local')
        ]);
        wp_localize_script('jquery', 'st_list_map_params', [
            'mk_my_location' => get_template_directory_uri() . '/img/my_location.png',
            'text_my_location' => __("3000 m radius", ST_TEXTDOMAIN),
            'text_no_result' => __("No Result", ST_TEXTDOMAIN),
            'cluster_0' => __("<div class='cluster cluster-1'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_20' => __("<div class='cluster cluster-2'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_50' => __("<div class='cluster cluster-3'>CLUSTER_COUNT</div>", ST_TEXTDOMAIN),
            'cluster_m1' => get_template_directory_uri() . '/img/map/m1.png',
            'cluster_m2' => get_template_directory_uri() . '/img/map/m2.png',
            'cluster_m3' => get_template_directory_uri() . '/img/map/m3.png',
            'cluster_m4' => get_template_directory_uri() . '/img/map/m4.png',
            'cluster_m5' => get_template_directory_uri() . '/img/map/m5.png',
            'icon_full_screen' => get_template_directory_uri() . '/v2/images/icon_map/ico_fullscreen.svg',
            'icon_my_location' => get_template_directory_uri() . '/v2/images/icon_map/ico_location.svg',
            'icon_my_style' => get_template_directory_uri() . '/v2/images/icon_map/ico_view_maps.svg',
            'icon_zoom_out' => get_template_directory_uri() . '/v2/images/icon_map/ico_maps_zoom-out.svg',
            'icon_zoom_in' => get_template_directory_uri() . '/v2/images/icon_map/ico_maps_zoom_in.svg',
            'icon_close' => get_template_directory_uri() . '/v2/images/icon_map/icon_close.svg',
        ]);
        wp_localize_script('jquery', 'st_config_partner', [
            'text_er_image_format' => false,
        ]);

    }

    static function isCheckWooPage()
    {
        $new_layout = st()->get_option('st_theme_style', 'classic');
        if ($new_layout == 'modern') {
            if (function_exists("is_woocommerce") && is_woocommerce()) {
                return true;
            }
            $woocommerce_keys = array("woocommerce_shop_page_id",
                "woocommerce_terms_page_id",
                "woocommerce_cart_page_id",
                "woocommerce_checkout_page_id",
                "woocommerce_pay_page_id",
                "woocommerce_thanks_page_id",
                "woocommerce_myaccount_page_id",
                "woocommerce_edit_address_page_id",
                "woocommerce_view_order_page_id",
                "woocommerce_change_password_page_id",
                "woocommerce_logout_page_id",
                "woocommerce_lost_password_page_id");

            foreach ($woocommerce_keys as $wc_page_id) {
                if (get_the_ID() == get_option($wc_page_id, 0)) {
                    return true;
                }
            }
        }
        return false;
    }
}