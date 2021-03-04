<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class Traver Helper
     *
     * Created by ShineTheme
     *
     */
    global $st_all_table_loaded;
    $st_all_table_loaded = [];
    if ( !class_exists( 'TravelHelper' ) ) {

        class TravelHelper
        {
            public static $all_currency;
            public static $st_location = [];
            protected static $listFullNameLocations = [];

            protected static $_cachedAlCurrency = [];

            private static $_check_table_duplicate = [];
            private static $_booking_primary_currency;
            private static $fonts = [];
            /*Add function modern*/
            static function getNewIcon($name = '', $color = '', $width = '', $height = '', $stroke = false)
            {
                if (!self::$fonts) {
                    include_once get_template_directory() . '/v2/fonts/fonts.php';
                    if (isset($fonts)) {
                        self::$fonts = $fonts;
                    }
                }
                if (empty(self::$fonts)) {
                    return '';
                }
                if (!isset(self::$fonts[$name])) {
                    return '';
                }
                $icon = self::$fonts[$name];
                if (!empty($color)) {
                    if ($stroke) {
                        $icon = preg_replace('/stroke="(.{7})"/', 'stroke="' . $color . '"', $icon);
                    } else {
                        $icon = preg_replace('/fill="(.{7})"/', 'fill="' . $color . '"', $icon);
                    }

                }

                if (!empty($width)) {
                    $icon = preg_replace('/width="(\d{2}[a-z]{2})"/', 'width="' . $width . '"', $icon);
                }

                if (!empty($width)) {
                    $icon = preg_replace('/height="(\d{2}[a-z]{2})"/', 'height="' . $height . '"', $icon);
                }

                return '<i class="input-icon field-icon fa">' . $icon . '</i>';
            }
            static function get_username($user_id)
                {
                    $userdata = get_userdata($user_id);
                    if (!$userdata) {
                        return __('Customer', ST_TEXTDOMAIN);
                    }
                    if ($userdata->display_name) {
                        return $userdata->display_name;
                    } elseif ($userdata->first_name || $userdata->last_name) {
                        return $userdata->first_name . ' ' . $userdata->last_name;
                    } else {
                        return $userdata->user_login;
                    }
                }



            static function st_admin_notice_post_draft_fc()
            {
                if ( current_user_can( 'manage_options' ) and is_admin() ) {
                    add_action( 'admin_notices', [ __CLASS__, 'st_admin_notice_post_draft' ], 99999 );
                    add_action( 'admin_notices', [ __CLASS__, 'st_admin_notice_user_partner_check_approved' ], 99999 );
                    add_action( 'pre_get_posts', [ __CLASS__, 'add_post_format_filter_to_posts' ], 999 );
                }
            }

            static function add_post_format_filter_to_posts( $query )
            {

                global $post_type, $pagenow;

                if ( $pagenow == 'edit.php' && $post_type == 'location' ) {
                    if ( isset( $_GET[ 'st_update_glocation' ] ) ) {
                        $query->query_vars[ 'meta_key' ]     = 'level_location';
                        $query->query_vars[ 'meta_value' ]   = '';
                        $query->query_vars[ 'meta_compare' ] = 'not exists';
                    }
                }
            }

            static function init()
            {

                self::setCachedCurrency();
                self::$_booking_primary_currency = st()->get_option( 'booking_primary_currency' );

                add_filter( 'st_get_post_id_origin', [ __CLASS__, 'getPostIdOrigin' ] );
                add_action( 'init', [ __CLASS__, 'location_session' ], 1 );
                add_action( 'init', [ __CLASS__, 'change_current_currency' ] );

                add_action( 'init', [ __CLASS__, 'setLocationBySession' ], 100 );
                add_action( 'init', [ __CLASS__, 'getListLocation' ], 51 );

                //add_action('init',array(__CLASS__,'setListFullNameLocation'), 100);

                add_action( 'st_approved_item', [ __CLASS__, 'st_approved_item' ], 50, 2 );

                add_action( 'wp_ajax_st_format_money', [ __CLASS__, '_format_money' ] );
                add_action( 'wp_ajax_nopriv_st_format_money', [ __CLASS__, '_format_money' ] );
                add_action( 'wp_ajax_st_getBookingPeriod', [ __CLASS__, 'getBookingPeriod' ], 9999 );
                add_action( 'wp_ajax_nopriv_st_getBookingPeriod', [ __CLASS__, 'getBookingPeriod' ], 9999 );

                self::$all_currency = [
                    'ALL'  => 'Albania Lek',
                    'DZD ' => 'Algeria',
                    'AFN'  => 'Afghanistan Afghani',
                    'ARS'  => 'Argentina Peso',
                    'AWG'  => 'Aruba Guilder',
                    'AUD'  => 'Australia Dollar',
                    'AZN'  => 'Azerbaijan New Manat',
                    'BSD'  => 'Bahamas Dollar',
                    'BHD'  => 'Bahraini Dinar',
                    'BBD'  => 'Barbados Dollar',
                    'BDT'  => 'Bangladeshi taka',
                    'BYN'  => 'Belarus Ruble',
                    'BZD'  => 'Belize Dollar',
                    'BMD'  => 'Bermuda Dollar',
                    'BOB'  => 'Bolivia Boliviano',
                    'BAM'  => 'Bosnia and Herzegovina Convertible Marka',
                    'BWP'  => 'Botswana Pula',
                    'BGN'  => 'Bulgaria Lev',
                    'BRL'  => 'Brazil Real',
                    'BND'  => 'Brunei Darussalam Dollar',
                    'KHR'  => 'Cambodia Riel',
                    'CAD'  => 'Canada Dollar',
                    'KYD'  => 'Cayman Islands Dollar',
                    'CLP'  => 'Chile Peso',
                    'CNY'  => 'China Yuan Renminbi',
                    'COP'  => 'Colombia Peso',
                    'CRC'  => 'Costa Rica Colon',
                    'HRK'  => 'Croatia Kuna',
                    'CUP'  => 'Cuba Peso',
                    'CZK'  => 'Czech Republic Koruna',
                    'DKK'  => 'Denmark Krone',
                    'DOP'  => 'Dominican Republic Peso',
                    'XCD'  => 'East Caribbean Dollar',
                    'EGP'  => 'Egypt Pound',
                    'SVC'  => 'El Salvador Colon',
                    'EEK'  => 'Estonia Kroon',
                    'EUR'  => 'Euro Member Countries',
                    'FKP'  => 'Falkland Islands (Malvinas) Pound',
                    'FJD'  => 'Fiji Dollar',
                    'GHC'  => 'Ghana Cedis',
                    'GIP'  => 'Gibraltar Pound',
                    'GTQ'  => 'Guatemala Quetzal',
                    'GGP'  => 'Guernsey Pound',
                    'GYD'  => 'Guyana Dollar',
                    'GEL'  => 'Georgia',
                    'HNL'  => 'Honduras Lempira',
                    'HKD'  => 'Hong Kong Dollar',
                    'HUF'  => 'Hungary Forint',
                    'ISK'  => 'Iceland Krona',
                    'INR'  => 'India Rupee',
                    'IDR'  => 'Indonesia Rupiah',
                    'IRR'  => 'Iran Rial',
                    'IMP'  => 'Isle of Man Pound',
                    'ILS'  => 'Israel Shekel',
                    'JMD'  => 'Jamaica Dollar',
                    'JPY'  => 'Japan Yen',
                    'JEP'  => 'Jersey Pound',
                    'KZT'  => 'Kazakhstan Tenge',
                    'KPW'  => 'Korea (North) Won',
                    'KRW'  => 'Korea (South) Won',
                    'KGS'  => 'Kyrgyzstan Som',
                    'KDS'  => 'Kenyan Shilling',
                    'LAK'  => 'Laos Kip',
                    'LVL'  => 'Latvia Lat',
                    'LBP'  => 'Lebanon Pound',
                    'LRD'  => 'Liberia Dollar',
                    'LTL'  => 'Lithuania Litas',
                    'MKD'  => 'Macedonia Denar',
                    'MYR'  => 'Malaysia Ringgit',
                    'MUR'  => 'Mauritius Rupee',
                    'MXN'  => 'Mexico Peso',
                    'MNT'  => 'Mongolia Tughrik',
                    'MMK' => 'Myanmar Kyats',
                    'MAD'  => 'Morocco Dirhams',
                    'MZN'  => 'Mozambique Metical',
                    'MGA'  => 'Malagasy ariary',
                    'NAD'  => 'Namibia Dollar',
                    'NPR'  => 'Nepal Rupee',
                    'ANG'  => 'Netherlands Antilles Guilder',
                    'NZD'  => 'New Zealand Dollar',
                    'NIO'  => 'Nicaragua Cordoba',
                    'NGN'  => 'Nigeria Naira',
                    'NOK'  => 'Norway Krone',
                    'OMR'  => 'Oman Rial',
                    'PKR'  => 'Pakistan Rupee',
                    'PAB'  => 'Panama Balboa',
                    'PYG'  => 'Paraguay Guarani',
                    'PEN'  => 'Peru Nuevo Sol',
                    'SOL' => 'Peruvian Sol',
                    'PHP'  => 'Philippines Peso',
                    'PLN'  => 'Poland Zloty',
                    'QAR'  => 'Qatar Riyal',
                    'RON'  => 'Romania New Leu',
                    'RUB'  => 'Russia Ruble',
                    'RWF'  => 'Rwandan Frank',
                    'SHP'  => 'Saint Helena Pound',
                    'SAR'  => 'Saudi Arabia Riyal',
                    'RSD'  => 'Serbia Dinar',
                    'SCR'  => 'Seychelles Rupee',
                    'SGD'  => 'Singapore Dollar',
                    'SBD'  => 'Solomon Islands Dollar',
                    'SOS'  => 'Somalia Shilling',
                    'ZAR'  => 'South Africa Rand',
                    'LKR'  => 'Sri Lanka Rupee',
                    'SEK'  => 'Sweden Krona',
                    'CHF'  => 'Switzerland Franc',
                    'SRD'  => 'Suriname Dollar',
                    'SYP'  => 'Syria Pound',
                    'TWD'  => 'Taiwan New Dollar',
                    'THB'  => 'Thailand Baht',
                    'TTD'  => 'Trinidad and Tobago Dollar',
                    'TRY'  => 'Turkey Lira',
                    'TRL'  => 'Turkey Lira',
                    'TVD'  => 'Tuvalu Dollar',
                    'TD'   => 'Tunisian Dinar',
                    'TZS'  => 'Tanzanian Shilling',
                    'UAH'  => 'Ukraine Hryvna',
                    'AED'  => 'United Arab Emirates',
                    'GBP'  => 'United Kingdom Pound',
                    'USD'  => 'United States Dollar',
                    'UYU'  => 'Uruguay Peso',
                    'UZS'  => 'Uzbekistan Som',
                    'UGX'  => 'Ugandian Shilling',
                    'VEF'  => 'Venezuela Bolivar',
                    'VND'  => 'Viet Nam Dong',
                    'YER'  => 'Yemen Rial',
                    'CFA'  => 'West African Franc',
                    'ZWD'  => 'Zimbabwe Dollar',
                    'ZMW'  => 'Zambian Kwacha'
                ];

                add_action( 'transition_post_status', [ __CLASS__, 'st_approved_item_action' ], 50, 3 );
                add_action( 'wp_head', [ __CLASS__, '_add_css_vc' ] );

                add_action( 'wp_ajax_st_mapping_currency', [ __CLASS__, 'mapping_currency' ] );
                add_action( 'wp_ajax_nopriv_st_mapping_currency', [ __CLASS__, 'mapping_currency' ] );

                add_action( 'wp_ajax_st_author_contact', [ __CLASS__, 'st_author_contact' ] );
                add_action( 'wp_ajax_nopriv_st_author_contact', [ __CLASS__, 'st_author_contact' ] );

                add_action( 'pre_get_posts', [ __CLASS__, 'pag_filter_author' ] );

                if ( function_exists( 'icl_get_languages' ) ) {
                    add_action( 'init', [ __CLASS__, 'change_language_wpml' ] );
                }
                if ( function_exists( 'qtranxf_init_language' ) ) {
                    add_action( 'init', [ __CLASS__, 'change_language_qtrans' ] );
                }

                add_action( 'init', [ __CLASS__, 'change_author_base' ] );

                add_filter( 'ot_google_fonts_api_key', [ __CLASS__, 'change_google_fonts_api_key' ] );

                $invalidate_actions = [
                    'wp_add_nav_menu_item',
                    'wp_update_nav_menu_item',
                    'wp_create_nav_menu',
                    'wp_update_nav_menu',
                    'wp_delete_nav_menu',
                ];
                foreach ( $invalidate_actions as $action ) {
                    add_action( $action, [ __CLASS__, 'st_delete_menu_transients' ] );
                }
            }

            static function st_nav_menu( $args = [] )
            {
                static $menu_id_slugs = [];

                $defaults = [
                    'menu'  => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
                    'echo'  => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'item_spacing' => 'preserve',
                    'depth' => 0, 'walker' => '', 'theme_location' => ''
                ];

                $args = wp_parse_args( $args, $defaults );

                if ( !in_array( $args[ 'item_spacing' ], [ 'preserve', 'discard' ], true ) ) {
                    // invalid value, fall back to default.
                    $args[ 'item_spacing' ] = $defaults[ 'item_spacing' ];
                }

                /**
                 * Filters the arguments used to display a navigation menu.
                 *
                 * @since 3.0.0
                 *
                 * @see   wp_nav_menu()
                 *
                 * @param array $args Array of wp_nav_menu() arguments.
                 */
                $args = apply_filters( 'wp_nav_menu_args', $args );
                $args = (object)$args;

                /**
                 * Filters whether to short-circuit the wp_nav_menu() output.
                 *
                 * Returning a non-null value to the filter will short-circuit
                 * wp_nav_menu(), echoing that value if $args->echo is true,
                 * returning that value otherwise.
                 *
                 * @since 3.9.0
                 *
                 * @see   wp_nav_menu()
                 *
                 * @param string|null $output Nav menu output to short-circuit with. Default null.
                 * @param stdClass    $args   An object containing wp_nav_menu() arguments.
                 */
                $nav_menu = apply_filters( 'pre_wp_nav_menu', null, $args );

                if ( null !== $nav_menu ) {
                    if ( $args->echo ) {
                        echo $nav_menu;

                        return;
                    }

                    return $nav_menu;
                }

                // Get the nav menu based on the requested menu
                $menu = wp_get_nav_menu_object( $args->menu );

                // Get the nav menu based on the theme_location
                if ( !$menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
                    $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

                // get the first menu that has items if we still can't find a menu
                if ( !$menu && !$args->theme_location ) {
                    $menus = wp_get_nav_menus();
                    foreach ( $menus as $menu_maybe ) {
                        if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, [ 'update_post_term_cache' => false ] ) ) {
                            $menu = $menu_maybe;
                            break;
                        }
                    }
                }

                if ( empty( $args->menu ) ) {
                    $args->menu = $menu;
                }

                // If the menu exists, get its items.
                if ( $menu && !is_wp_error( $menu ) && !isset( $menu_items ) ) {
                    $menu_items = get_transient( 'st_main_menu_query' );
                    if ( $menu_items === false ) {
                        $menu_items = wp_get_nav_menu_items( $menu->term_id, [ 'update_post_term_cache' => false ] );
                        set_transient( 'st_main_menu_query', $menu_items, 60 * 60 * 24 );
                    }
                }

                /*
				 * If no menu was found:
				 *  - Fall back (if one was specified), or bail.
				 *
				 * If no menu items were found:
				 *  - Fall back, but only if no theme location was specified.
				 *  - Otherwise, bail.
				 */
                if ( ( !$menu || is_wp_error( $menu ) || ( isset( $menu_items ) && empty( $menu_items ) && !$args->theme_location ) )
                    && isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) )
                    return call_user_func( $args->fallback_cb, (array)$args );

                if ( !$menu || is_wp_error( $menu ) )
                    return false;

                $nav_menu = $items = '';

                $show_container = false;
                if ( $args->container ) {
                    /**
                     * Filters the list of HTML tags that are valid for use as menu containers.
                     *
                     * @since 3.0.0
                     *
                     * @param array $tags The acceptable HTML tags for use as menu containers.
                     *                    Default is array containing 'div' and 'nav'.
                     */
                    $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', [ 'div', 'nav' ] );
                    if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags ) ) {
                        $show_container = true;
                        $class          = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-' . $menu->slug . '-container"';
                        $id             = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
                        $nav_menu       .= '<' . $args->container . $id . $class . '>';
                    }
                }

                // Set up the $menu_item variables
                _wp_menu_item_classes_by_context( $menu_items );

                $sorted_menu_items = $menu_items_with_children = [];
                foreach ( (array)$menu_items as $menu_item ) {
                    $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
                    if ( $menu_item->menu_item_parent )
                        $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
                }

                // Add the menu-item-has-children class where applicable
                if ( $menu_items_with_children ) {
                    foreach ( $sorted_menu_items as &$menu_item ) {
                        if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                            $menu_item->classes[] = 'menu-item-has-children';
                    }
                }

                unset( $menu_items, $menu_item );

                /**
                 * Filters the sorted list of menu item objects before generating the menu's HTML.
                 *
                 * @since 3.1.0
                 *
                 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
                 * @param stdClass $args              An object containing wp_nav_menu() arguments.
                 */
                $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

                $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
                unset( $sorted_menu_items );

                // Attributes
                if ( !empty( $args->menu_id ) ) {
                    $wrap_id = $args->menu_id;
                } else {
                    $wrap_id = 'menu-' . $menu->slug;
                    while ( in_array( $wrap_id, $menu_id_slugs ) ) {
                        if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                            $wrap_id = preg_replace( '#-(\d+)$#', '-' . ++$matches[ 1 ], $wrap_id );
                        else
                            $wrap_id = $wrap_id . '-1';
                    }
                }
                $menu_id_slugs[] = $wrap_id;

                $wrap_class = $args->menu_class ? $args->menu_class : '';

                /**
                 * Filters the HTML list content for navigation menus.
                 *
                 * @since 3.0.0
                 *
                 * @see   wp_nav_menu()
                 *
                 * @param string   $items The HTML list content for the menu items.
                 * @param stdClass $args  An object containing wp_nav_menu() arguments.
                 */
                $items = apply_filters( 'wp_nav_menu_items', $items, $args );
                /**
                 * Filters the HTML list content for a specific navigation menu.
                 *
                 * @since 3.0.0
                 *
                 * @see   wp_nav_menu()
                 *
                 * @param string   $items The HTML list content for the menu items.
                 * @param stdClass $args  An object containing wp_nav_menu() arguments.
                 */
                $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

                // Don't print any markup if there are no items at this point.
                if ( empty( $items ) )
                    return false;

                $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
                unset( $items );

                if ( $show_container )
                    $nav_menu .= '</' . $args->container . '>';

                /**
                 * Filters the HTML content for navigation menus.
                 *
                 * @since 3.0.0
                 *
                 * @see   wp_nav_menu()
                 *
                 * @param string   $nav_menu The HTML content for the navigation menu.
                 * @param stdClass $args     An object containing wp_nav_menu() arguments.
                 */
                $nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

                if ( $args->echo )
                    echo $nav_menu;
                else
                    return $nav_menu;
            }

            static function st_delete_menu_transients()
            {
                delete_transient( 'st_main_menu_query' );
            }

            static function change_google_fonts_api_key( $api_key )
            {
                $option_api = st()->get_option( 'google_font_api_key' );
                if ( !empty( $option_api ) ) {
                    $api_key = $option_api;
                }

                return $api_key;
            }

            static public function change_language_wpml()
            {
                $mapping_detect = st()->get_option( 'booking_currency_mapping_detect', 'off' );

                if ( $mapping_detect == 'on' ) {
                    $wpml_options = get_option( 'icl_sitepress_settings' );
                    if ( $wpml_options[ 'automatic_redirect' ] == 1 || $wpml_options[ 'automatic_redirect' ] == 2 ) {
                        $mapping_currency = get_option( 'mapping_currency_' . ICL_LANGUAGE_CODE );
                        if ( !empty( $mapping_currency ) ) {
                            $current_lang = ICL_LANGUAGE_CODE;
                            $current_cur  = '';
                            foreach ( $mapping_currency as $item_map ) {
                                if ( $item_map[ 0 ] == $current_lang ) {
                                    $current_cur = $item_map[ 1 ];
                                }
                            }
                            if ( $_SESSION[ 'change_currencyds' ] != 'ok' ) {
                                $primary = $current_cur;
                                TravelHelper::change_current_currency( $primary );
                            }
                        }
                    }
                }
            }

            public static function pag_filter_author( $query )
            {
                if ( !is_admin() && $query->is_main_query() ) {
                    if ( $query->is_author() ) {
                        $query->set( 'post_type', 'st_hotel' );
                    }
                }
            }


            static public function st_author_contact()
            {
                $data = STInput::post( 'data', '' );

                $message = st()->load_template( 'email/header' );
                $message .= st()->load_template( 'email/author_contact', false, [ 'data' => $data ] );
                $message .= st()->load_template( 'email/footer' );

                $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                $subject = sprintf( __( '[%s] Contact from customer', ST_TEXTDOMAIN ), $title );
                //$check   = self::_send_mail_user( $data[0]['value'], $subject, $message );
                if ( $data[ 0 ][ 'value' ] == '' || $data[ 1 ][ 'value' ] == '' || $data[ 2 ][ 'value' ] == '' || $data[ 3 ][ 'value' ] == '' ) {
                    $res = [
                        'status'  => false,
                        'message' => __( "Please fill all required fields", ST_TEXTDOMAIN )
                    ];
                }

                if ( !$message ) {

                    $res = [
                        'status'  => false,
                        'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                    ];
                }

                $from         = st()->get_option( 'email_from' );
                $from_address = st()->get_option( 'email_from_address' );
                $headers      = [];

                if ( $from and $from_address ) {
                    $headers[] = 'From:' . $from . ' <' . $from_address . '>';
                }
                add_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );
                $check = wp_mail( $data[ 0 ][ 'value' ], $subject, $message, $headers );
                remove_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );

                if ( $check ) {
                    $res = [
                        'status'  => true,
                        'message' => __( "Send email successfully!", ST_TEXTDOMAIN )
                    ];
                } else {
                    $res = [
                        'status'  => false,
                        'message' => __( "Some errors occurred!", ST_TEXTDOMAIN )
                    ];
                }

                echo json_encode( $res );
                die;
            }

            static public function change_language_qtrans()
            {
                $mapping_detect = st()->get_option( 'booking_currency_mapping_detect', 'off' );

                if ( $mapping_detect == 'on' ) {
                    global $q_config;
                    if ( isset( $q_config[ 'detect_browser_language' ] ) && $q_config[ 'detect_browser_language' ] == 1 ) {
                        $mapping_currency = get_option( 'mapping_currency_' . $q_config[ 'language' ] );
                        if ( !empty( $mapping_currency ) ) {
                            $current_lang = $q_config[ 'language' ];
                            $current_cur  = '';
                            foreach ( $mapping_currency as $item_map ) {
                                if ( $item_map[ 0 ] == $current_lang ) {
                                    $current_cur = $item_map[ 1 ];
                                }
                            }
                            if ( $_SESSION[ 'change_currencyds' ] != 'ok' ) {
                                $primary = $current_cur;
                                TravelHelper::change_current_currency( $primary );
                            }
                        }
                    }
                }
            }

            static public function mapping_currency()
            {
                $data_mapping = $_POST[ 'data_mapping' ];

                $option_name = 'mapping_currency';

                if ( function_exists( 'icl_get_languages' ) ) {
                    $option_name = 'mapping_currency_' . ICL_LANGUAGE_CODE;
                }
                if ( function_exists( 'qtranxf_init_language' ) ) {
                    global $q_config;
                    $option_name = 'mapping_currency_' . $q_config[ 'language' ];
                }

                $new_value = $data_mapping;

                if ( get_option( $option_name ) !== false ) {
                    update_option( $option_name, $new_value );
                } else {
                    $deprecated = null;
                    $autoload   = 'no';
                    add_option( $option_name, $new_value, $deprecated, $autoload );
                }

                echo json_encode( [ 'status' => true ] );
                die;
            }

            /**
             * @since 1.3.1
             **/
            static function _add_css_vc()
            {
                $slug = get_page_template_slug();
                if ( strpos( $slug, 'template-' ) == 0 ) {
                    $id                    = get_the_ID();
                    $shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
                    if ( !empty( $shortcodes_custom_css ) ) {
                        $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
                        echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                        echo $shortcodes_custom_css;
                        echo '</style>';
                    }
                }
            }

            static function st_approved_item_action( $new_status, $old_status, $post )
            {
                if ( $new_status != $old_status && $old_status != 'publish' && $new_status == 'publish' ) {
                    do_action( 'st_approved_item', get_current_user_id(), $post );
                }
            }

            /**
             *
             *
             * @since 1.1.3
             * */
            static function _format_money()
            {
                $data = STInput::post( 'money_data', [] );

                if ( !empty( $data ) ) {
                    foreach ( $data as $key => $value ) {
                        $data[ $key ] = TravelHelper::format_money( $value );
                    }
                }

                echo json_encode(
                    [
                        'status'     => 1,
                        'money_data' => $data
                    ]
                );
                die;
            }


            static function ot_all_currency()
            {
                $a = [];

                foreach ( self::$all_currency as $key => $value ) {
                    $a[] = [
                        'value' => $key,
                        'label' => $value . '(' . $key . ' )'
                    ];
                }

                return $a;
            }

            /**
             * @todo Setup Session
             *
             *
             * */
            static function location_session()
            {
                if ( !session_id() ) {
                    session_start();
                }
            }


            /**
             * Return All Currencies
             *
             *
             * */
            static function get_currency( $theme_option = false )
            {

                $all = self::$_cachedAlCurrency;

                //return array for theme options choise
                if ( $theme_option ) {
                    $choice = [];

                    if ( !empty( $all ) and is_array( $all ) ) {


                        foreach ( $all as $key => $value ) {
                            $choice[] = [

                                'label' => $value[ 'title' ],
                                'value' => $value[ 'name' ]
                            ];
                        }

                    }

                    return $choice;
                }

                return $all;
            }

            public static function setCachedCurrency()
            {
                self::$_cachedAlCurrency = apply_filters( 'st_booking_currency', st()->get_option( 'booking_currency' ) );
            }


            /**
             * return Default Currency
             *
             *
             * */
            static function get_default_currency( $need = false )
            {

                $primary = self::booking_primary_currency();

                $primary_obj = self::find_currency( $primary );

                if ( $primary_obj ) {
                    if ( $need and isset( $primary_obj[ $need ] ) ) return $primary_obj[ $need ];

                    return $primary_obj;
                } else {
                    //If user dont set the primary currency, we take the first of list all currency
                    $all_currency = self::get_currency();


                    if ( isset( $all_currency[ 0 ] ) ) {
                        if ( $need and isset( $all_currency[ 0 ][ $need ] ) ) return $all_currency[ 0 ][ $need ];

                        return $all_currency[ 0 ];
                    }
                }


            }

            static function booking_primary_currency()
            {
                return self::$_booking_primary_currency;
            }

            /**
             * return Current Currency
             *
             *
             * */
            static function get_current_currency( $need = false )
            {

                //Check session of user first

                if ( isset( $_SESSION[ 'currency' ][ 'name' ] ) ) {
                    $name = $_SESSION[ 'currency' ][ 'name' ];

                    if ( $session_currency = self::find_currency( $name ) ) {
                        if ( $need and isset( $session_currency[ $need ] ) ) return $session_currency[ $need ];

                        return $session_currency;
                    }
                }

                return self::get_default_currency( $need );
            }


            /**
             * @todo Find currency by name, return false if not found
             *
             *
             * */
            static function find_currency( $currency_name, $compare_key = 'name' )
            {
                $currency_name = esc_attr( $currency_name );

                $all_currency = self::$_cachedAlCurrency;
                if ( !empty( $all_currency ) ) {
                    foreach ( $all_currency as $key ) {
                        if ( $key[ $compare_key ] == $currency_name ) {
                            return $key;
                        }
                    }
                }

                return false;
            }

            /**
             * Change Default Currency
             *
             * @param currency_name
             *
             * */
            /**
             * Change Default Currency
             *
             * @param bool $currency_name
             */
            static function change_current_currency( $currency_name = false )
            {
                if ( !isset( $_SESSION[ 'change_currencyds' ] ) ) {
                    $_SESSION[ 'change_currencyds' ] = '';
                }

                if ( isset( $_GET[ 'currency' ] ) and $_GET[ 'currency' ] and $new_currency = self::find_currency( $_GET[ 'currency' ] ) ) {
                    $_SESSION[ 'currency' ]          = $new_currency;
                    $_SESSION[ 'change_currencyds' ] = 'ok';
                }

                if ( $currency_name and $new_currency = self::find_currency( $currency_name ) ) {
                    $_SESSION[ 'currency' ] = $new_currency;
                }
            }

            /**
             *
             * Conver money from default currency to current currency
             *
             *
             *
             * */
            static function convert_money( $money = false, $rate = false, $round = true )
            {
                if ( !$money ) $money = 0;
                if ( !$rate ) {
                    $current_rate = self::get_current_currency( 'rate' );
                    $current      = self::get_current_currency( 'name' );

                    $default = self::get_default_currency( 'name' );

                    if ( $current != $default )
                        $money = $money * $current_rate;
                } else {
                    $current_rate = $rate;
                    $money        = $money * $current_rate;
                }
                if ( $round ) {
                    return round( (float)$money, 2 );
                } else {
                    return (float)$money;
                }
            }

            /**
             *
             * Conver money from current currency to default currency
             *
             *
             *
             * */
            static function convert_money_to_default( $money = false )
            {
                if ( !is_numeric( $money ) ) $money = 0;
                if ( !$money ) $money = 0;
                $current_rate = self::get_current_currency( 'rate' );
                $current      = self::get_current_currency( 'name' );

                $default = self::get_default_currency( 'name' );

                if ( $current != $default )
                    return $money / $current_rate;

                return $money;
            }

            /**
             *
             * Format Money
             * @since 1.1.1
             *
             *
             * */
            static function format_money( $money = false, $need_convert = true, $precision = 0 )
            {
                $money              = (float)$money;
                $symbol             = self::get_current_currency( 'symbol' );
                $precision          = self::get_current_currency( 'booking_currency_precision', 2 );
                $thousand_separator = self::get_current_currency( 'thousand_separator', ',' );
                $decimal_separator  = self::get_current_currency( 'decimal_separator', '.' );
                if ( $money == 0 && st()->get_option( 'show_price_free' ) == 'on' ) {
                    return __( "Free", ST_TEXTDOMAIN );
                }

                if ( $need_convert ) {
                    $money = self::convert_money( $money );
                }

                if ( is_array( $precision ) ) {
                    $precision = st()->get_option( 'booking_currency_precision', 2 );
                }

                if ( $precision ) {
                    $money = round( $money, 2 );
                }

                $template = self::get_current_currency( 'booking_currency_pos' );

                if ( !$template ) {
                    $template = 'left';
                }
                if ( is_array( $decimal_separator ) ) {
                    $decimal_separator = st()->get_option( 'decimal_separator', '.' );
                }
                if ( is_array( $thousand_separator ) ) {
                    $thousand_separator = st()->get_option( 'thousand_separator', ',' );
                }
                $money = number_format( (float)$money, (int)$precision, $decimal_separator, $thousand_separator );

                switch ( $template ) {

                    case "right":
                        $money_string = $money . $symbol;
                        break;
                    case "left_space":
                        $money_string = $symbol . " " . $money;
                        break;

                    case "right_space":
                        $money_string = $money . " " . $symbol;
                        break;
                    case "left":
                    default:
                        $money_string = $symbol . $money;
                        break;


                }

                return $money_string;

            }

            static function format_money_raw( $money = '', $symbol = false, $precision = 2, $template = null )
            {
                if ( $money == 0 && st()->get_option( 'show_price_free' ) == 'on' ) {
                    return __( "Free", ST_TEXTDOMAIN );
                }

                if ( !$symbol ) {
                    $symbol = self::get_current_currency( 'symbol' );
                }

                if ( $precision ) {
                    $money = round( $money, $precision );
                }
                if ( !$template ) $template = self::get_current_currency( 'booking_currency_pos' );

                if ( !$template ) {
                    $template = 'left';
                }

                $money = number_format( (float)$money, $precision );

                switch ( $template ) {


                    case "right":
                        $money_string = $money . $symbol;
                        break;
                    case "left_space":
                        $money_string = $symbol . " " . $money;
                        break;

                    case "right_space":
                        $money_string = $money . " " . $symbol;
                        break;
                    case "left":
                    default:
                        $money_string = $symbol . $money;
                        break;

                }

                return $money_string;
            }

            static function convert_money_from_to( $money = '', $currency_from = '', $currency_to = '' )
            {
                $money = (float)$money;
                if ( empty( $currency_from ) ) {
                    $currency_from = TravelHelper::get_default_currency( 'symbol' );
                }

                if ( empty( $currency_to ) ) {
                    $currency_to = TravelHelper::get_current_currency( 'symbol' );
                }
                $currency_from = TravelHelper::find_currency( $currency_from, 'symbol' );
                $currency_to   = TravelHelper::find_currency( $currency_to, 'symbol' );

                $currency_from_rate = (float)$currency_from[ 'rate' ];
                if ( $currency_from_rate <= 0 ) {
                    $currency_from_rate = 1;
                }
                $currency_to_rate = (float)$currency_to[ 'rate' ];

                $money = $money / $currency_from_rate;
                $money = $money * $currency_to_rate;

                return $money;
            }


            //static function format_money_from_db($money = '', $symbol = false , $rate = 0, $precision = 2)
            static function format_money_from_db( $money = '', $currency = false )
            {
                extract( wp_parse_args( $currency, TravelHelper::get_current_currency() ) );
                if ( $money == 0 ) {
                    return __( "Free", ST_TEXTDOMAIN );
                }
                $money = self::convert_money( $money, $rate );

                if ( !empty( $booking_currency_precision ) ) {
                    $money = round( $money, $booking_currency_precision );
                }
                $money = number_format( (float)$money, $booking_currency_precision, $decimal_separator, $thousand_separator );

                switch ( $booking_currency_pos ) {
                    case "right":
                        $money_string = $money . $symbol;
                        break;
                    case "left_space":
                        $money_string = $symbol . " " . $money;
                        break;

                    case "right_space":
                        $money_string = $money . " " . $symbol;
                        break;
                    case "left":
                    default:
                        $money_string = $symbol . $money;
                        break;


                }

                return $money_string;
            }


            static function build_url( $name, $value )
            {
                $all          = $_GET;
                $current_url  = self::current_url();
                $all[ $name ] = $value;

                return esc_url( $current_url . '?' . http_build_query( $all ) );
            }

            static function build_url_array( $key, $name, $value, $add = true )
            {
                $all = $_GET;


                $val = isset( $all[ $key ][ $name ] ) ? $all[ $key ][ $name ] : '';


                if ( $add ) {

                    if ( $val )

                        $value_array = explode( ',', $val );

                    else

                        $value_array = [];

                    $value_array[] = $value;


                } else {


                    $value_array = explode( ',', $val );

                    unset( $value_array[ $value ] );

                    if ( !empty( $value_array ) ) {

                        foreach ( $value_array as $k => $v ) {

                            if ( $v == $value ) unset( $value_array[ $k ] );

                        }

                    }


                }

                $all[ $key ][ $name ] = implode( ',', $value_array );

                return esc_html( add_query_arg( $all ) );
            }

            static function build_url_array_tree( $key, $name, $value, $add = true, $post_type )
            {
                $all = $_GET;

                $val = isset( $all[ $key ][ $name ] ) ? $all[ $key ][ $name ] : '';

                if ( $add ) {

                    if ( $val ) {
                        $value_array = explode( ',', $val );
                    } else {
                        $value_array = [];
                    }

                    if ( !is_array( $value ) ) {
                        $value = explode( ',', $value );
                    }
                    foreach ( $value as $item ) {
                        $value_array[] = $item;
                    }
                    $value_array = array_unique( $value_array );

                } else {

                    $value_array = explode( ',', $val );

                    if ( is_array( $value ) ) {
                        $value = implode( ',', $value );
                    }

                    $key1 = array_search( (int)$value, $value_array );
                    if ( $key1 >= 0 ) {

                        unset( $value_array[ $key1 ] );
                    }

                }

                $all[ $key ][ $name ] = implode( ',', $value_array );

                wp_reset_postdata();
                wp_reset_query();

                if ( is_front_page() ) {
                    $page_search = home_url( '/?s=&post_type=' . $post_type );

                    return esc_html( add_query_arg( $all, $page_search ) );
                }

                return esc_html( add_query_arg( $all ) );
            }

            static function build_url_auto_key( $key, $value, $add = true )
            {
                global $st_search_page_id;
                $all = $_GET;

                if ( $st_search_page_id ) {
                    $current_url = get_permalink( $st_search_page_id );
                } elseif ( is_page() ) {
                    $current_url = get_permalink();
                } else {
                    $current_url = home_url( '/' );
                    $current_url = add_query_arg( 's', STInput::get( 's' ), $current_url );
                }

                $val         = isset( $all[ $key ] ) ? $all[ $key ] : '';
                $value_array = [];
                $url         = $current_url;

                if ( $add ) {

                    if ( $val ) {
                        $value_array = explode( ',', $val );
                    }
                    $value_array[] = $value;

                } else {

                    $value_array = explode( ',', $val );
                    if ( !empty( $value_array ) ) {
                        foreach ( $value_array as $k => $v ) {
                            if ( $v == $value ) unset( $value_array[ $k ] );
                        }

                    }

                }

                $new_val = implode( ',', $value_array );
                if ( $new_val ) {
                    $all[ $key ] = $new_val;
                } else {
                    $all[ $key ] = '';
                }

                if ( STInput::get( 'paged' ) ) {
                    $all[ 'paged' ] = '';
                }
                $url = esc_url( add_query_arg( $all, $url ) );

                return $url;
            }

            static function checked_array( $key, $need )
            {
                $found = false;
                if ( !empty( $key ) ) {
                    foreach ( $key as $k => $v ) {
                        if ( $need == $v ) {
                            return true;
                        }
                    }
                }

                return $found;
            }

            static function get_time_format()
            {
                $format = st()->get_option( 'time_format', 'true' );

                return $format;
            }

            /**
             * @since 1.1.1
             **/
            static function convertDateFormat( $date )
            {

                $format = self::getDateFormat();
                if ( !empty( $date ) ) {
                    $myDateTime = DateTime::createFromFormat( $format, $date );
                    if ( $myDateTime )
                        return $myDateTime->format( 'm/d/Y' );
                }

                return '';
            }

            /**
             * @since 1.1.1
             **/
            static function getDateFormat()
            {
                $format = st()->get_option( 'datetime_format', '{mm}/{dd}/{yyyy}' );

                $ori_format = [
                    '{d}'    => 'j',
                    '{dd}'   => 'd',
                    '{D}'    => 'D',
                    '{DD}'   => 'l',
                    '{m}'    => 'n',
                    '{mm}'   => 'm',
                    '{M}'    => 'M',
                    '{MM}'   => 'F',
                    '{yy}'   => 'y',
                    '{yyyy}' => 'Y'
                ];
                preg_match_all( "/({)[a-zA-Z]+(})/", $format, $out );

                $out = $out[ 0 ];
                foreach ( $out as $key => $val ) {
                    foreach ( $ori_format as $ori_key => $ori_val ) {
                        if ( $val == $ori_key ) {
                            $format = str_replace( $val, $ori_val, $format );
                        }
                    }
                }

                return $format;
            }

            static function getDateFormatMoment()
            {
                $format = st()->get_option( 'datetime_format', '{mm}/{dd}/{yyyy}' );

                $ori_format = [
                    '{d}'    => 'D',
                    '{dd}'   => 'DD',
                    '{D}'    => 'D',
                    '{DD}'   => 'l',
                    '{m}'    => 'M',
                    '{mm}'   => 'MM',
                    '{M}'    => 'MMM',
                    '{MM}'   => 'MMMM',
                    '{yy}'   => 'YY',
                    '{yyyy}' => 'YYYY'
                ];
                preg_match_all( "/({)[a-zA-Z]+(})/", $format, $out );

                $out = $out[ 0 ];
                foreach ( $out as $key => $val ) {
                    foreach ( $ori_format as $ori_key => $ori_val ) {
                        if ( $val == $ori_key ) {
                            $format = str_replace( $val, $ori_val, $format );
                        }
                    }
                }

                return $format;
            }

            /**
             * @since 1.1.1
             **/
            static function getDateFormatJs( $need = null, $type = '' )
            {
                //$need from theme options placeholder fields
                if ( $need ) return $need;
                $format    = st()->get_option( 'datetime_format', '{mm}/{dd}/{yyyy}' );
                $format_js = str_replace( [ '{', '}' ], '', $format );
                if ( $type == 'calendar' ) {
                    $format_js = str_replace( 'M', 'MMM', $format_js );
                }

                return $format_js;
            }

            static function build_url_muti_array( $key, $name, $name_2, $value )
            {
                $all                             = $_GET;
                $all[ $key ][ $name ][ $name_2 ] = $value;

                return add_query_arg( $all );
            }

            static function current_url()
            {

                $pageURL = 'http';
                if ( isset( $_SERVER[ 'HTTPS' ] ) and $_SERVER[ "HTTPS" ] == "on" ) {
                    $pageURL .= "s";
                }
                $pageURL .= "://";
                if ( $_SERVER[ "SERVER_PORT" ] != "80" ) {
                    $pageURL .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "SCRIPT_NAME" ];
                } else {
                    $pageURL .= $_SERVER[ "SERVER_NAME" ] . parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH );
                }
                $pageURL = rtrim( $pageURL, 'index.php' );

                return $pageURL;
            }

            static function paging( $query = false, $wrapper = true )
            {
                global $wp_query, $st_search_query;
                if ( $st_search_query ) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                // Don't print empty markup if there's only one page.
                if ( $query->max_num_pages < 2 ) {
                    return;
                }

                if ( get_query_var( 'paged' ) ) {
                    $paged = get_query_var( 'paged' );
                } else if ( get_query_var( 'page' ) ) {
                    $paged = get_query_var( 'page' );
                } else {
                    $paged = 1;
                }
                $pagenum_link = html_entity_decode( get_pagenum_link() );
                $query_args   = [];
                $url_parts    = explode( '?', $pagenum_link );

                if ( isset( $url_parts[ 1 ] ) ) {
                    wp_parse_str( $url_parts[ 1 ], $query_args );
                }

                $pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
                $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

                $format = $GLOBALS[ 'wp_rewrite' ]->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
                $format .= $GLOBALS[ 'wp_rewrite' ]->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

                $arg   = [
                    'base'      => $pagenum_link,
                    'format'    => $format,
                    'total'     => $query->max_num_pages,
                    'current'   => $paged,
                    'mid_size'  => 1,
                    // 'add_args' => array_map( 'urlencode', $query_args ),
                    'add_args'  => $query_args,
                    'prev_text' => __( 'Previous Page', ST_TEXTDOMAIN ),
                    'next_text' => __( 'Next Page', ST_TEXTDOMAIN ),
                    'type'      => 'list'
                ];
                $style = st()->get_option( 'pag_style', true );
                if ( $style == 'st_tour_ver' ) {
                    $arg[ 'prev_text' ] = "<i class='fa fa-angle-left'></i>";
                    $arg[ 'next_text' ] = "<i class='fa fa-angle-right'></i>";
                }
                // Set up paginated links.
                $links = paginate_links( $arg );

                if ( $links ) :
                    if ( $wrapper )
                        $links = str_replace( 'page-numbers', 'col-xs-12 pagination ' . $style . "_pag", balanceTags( $links ) );
                    $links = str_replace( '<span', '<a', $links );
                    $links = str_replace( '</span>', '</a>', $links );
                    ?>
                    <?php
                    echo $wrapper ? "<div class='col-xs-12'>" : '';
                    echo balanceTags( $links ); // do not esc_html
                    echo $wrapper ? "</div>" : '';
                endif;
            }

            static function paging_flight( $query1 = false, $param1 = 'paged1', $param2 = 'paged2' )
            {
                global $wp_query;
                if ( $query1 ) {
                    $query = $query1;
                } else $query = $wp_query;

                // Don't print empty markup if there's only one page.
                if ( $query->max_num_pages < 2 ) {
                    return;
                }

                $paged1 = isset( $_GET[ $param1 ] ) ? (int)$_GET[ $param1 ] : 1;
                $paged2 = isset( $_GET[ $param2 ] ) ? (int)$_GET[ $param2 ] : 1;

                // http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
                $_page = $paged2;
                if ( $param2 == 'paged1' ) {
                    $_page = $paged1;
                }

                $pag_args1                = [
                    'format'   => '?' . $param1 . '=%#%',
                    'current'  => $paged1,
                    'total'    => $query->max_num_pages,
                    'add_args' => [ $param2 => $_page ],
                    'type'     => 'list'
                ];
                $pag_args1[ 'prev_text' ] = "<i class='fa fa-angle-left'></i>";
                $pag_args1[ 'next_text' ] = "<i class='fa fa-angle-right'></i>";
                $links                    = paginate_links( $pag_args1 );
                $style                    = st()->get_option( 'pag_style', true );

                if ( $links ) :
                    $links = str_replace( 'page-numbers', 'col-xs-12 pagination ' . $style . "_pag", balanceTags( $links ) );
                    $links = str_replace( '<span', '<a', $links );
                    $links = str_replace( '</span>', '</a>', $links );
                    ?>
                    <?php
                    echo "<div class='col-xs-12'>";
                    echo balanceTags( $links ); // do not esc_html
                    echo "</div>";
                endif;
            }

            static function paging_room( $query = false )
            {
                global $wp_query, $st_search_query;
                if ( $st_search_query ) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                if ( $query->max_num_pages < 2 ) {
                    return;
                }
                $paged          = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
                $max            = $query->found_posts;
                $posts_per_page = $query->query[ 'posts_per_page' ];

                $number = ceil( $max / $posts_per_page );

                $html = ' <ul class="pagination paged_room">';

                if ( $paged > 1 ) {
                    $html .= ' <li><a class="pagination paged_item_room" data-page="' . ( $paged - 1 ) . '">' . __( 'Previous', ST_TEXTDOMAIN ) . '</a></li>';
                }
                for ( $i = 1; $i <= $number; $i++ ) {
                    if ( $i == $paged ) {
                        $html .= ' <li><a class="pagination paged_item_room current" data-page="' . $i . '">' . $i . '</a></li>';
                    } else {
                        $html .= '<li><a class="pagination paged_item_room" data-page="' . $i . '">' . $i . '</a></li>';
                    }
                }
                if ( $paged < $i - 1 ) {
                    $html .= ' <li><a class="pagination paged_item_room" data-page="' . ( $paged + 1 ) . '">' . __( 'Next', ST_TEXTDOMAIN ) . '</a></li>';
                }

                $html . '</ul>';

                return $html;
            }

            static function paging_single_partner( $query = false, $user_id )
            {


                global $wp_query, $st_search_query;
                if ( $st_search_query ) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                if ( $query->max_num_pages < 2 ) {
                    return;
                }

                $post_type = $query->query[ 'post_type' ];

                $paged          = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
                $max            = $query->found_posts;
                $posts_per_page = $query->query[ 'posts_per_page' ];

                $number = ceil( $max / $posts_per_page );

                $obj  = get_post_type_object( $post_type );
                $name = $obj->labels->singular_name;


                $last = $posts_per_page * ( $paged );

                /*  if($last>$query->found_posts) $last=$query->found_posts;
                echo ' '.($posts_per_page*($paged-1)+1).' - '.$last;*/

                $html = '
                     <div class="mt30">
                        <span>' . $max . ' ' . $name . '(s)</span>
                        <span style="padding-left: 10px">' . __( "Showing", ST_TEXTDOMAIN ) . ' ' . ( $posts_per_page * ( $paged - 1 ) + 1 ) . '-' . $last . '</span>
                    </div>
                     <ul class="pagination paged_single_partner mt10">';

                if ( $paged > 1 ) {
                    $html .= ' <li><a class="pagination paged_item_service" data-user-id="' . $user_id . '" data-post-type="' . $post_type . '" data-page="' . ( $paged - 1 ) . '">' . __( 'Previous', ST_TEXTDOMAIN ) . '</a></li>';
                }
                for ( $i = 1; $i <= $number; $i++ ) {
                    if ( $i == $paged ) {
                        $html .= ' <li><a class="pagination paged_item_service current" data-user-id="' . $user_id . '" data-post-type="' . $post_type . '" data-page="' . $i . '">' . $i . '</a></li>';
                    } else {
                        $html .= '<li><a class="pagination paged_item_service" data-user-id="' . $user_id . '" data-post-type="' . $post_type . '" data-page="' . $i . '">' . $i . '</a></li>';
                    }
                }
                if ( $paged < $i - 1 ) {
                    $html .= ' <li><a class="pagination paged_item_service" data-user-id="' . $user_id . '" data-post-type="' . $post_type . '" data-page="' . ( $paged + 1 ) . '">' . __( 'Next', ST_TEXTDOMAIN ) . '</a></li>';
                }

                $html . '</ul>';

                return $html;
            }

            static function comments_paging()
            {
                ob_start();

                paginate_comments_links(
                    [
                        'type'      => 'list',
                        'prev_text' => __( 'Previous Page', ST_TEXTDOMAIN ),
                        'next_text' => __( 'Next Page', ST_TEXTDOMAIN ),
                    ] );

                $links = @ob_get_clean();


                if ( $links ) :
                    $links = str_replace( 'page-numbers', 'pagination pull-right', balanceTags( $links ) );
                    $links = str_replace( '<span', '<a', $links );
                    $links = str_replace( '</span>', '</a>', $links );
                    ?>
                    <?php echo str_replace( 'page-numbers', 'pagination', balanceTags( $links ) );//do not use esc_html() with  paginate_links() result
                    ?>
                <?php
                endif;
            }

            static function comments_list( $comment, $args, $depth )
            {
                //get_template_part('single/comment','list');
                $file = locate_template( 'st_templates/blog/single/comment-list.php' );

                if ( is_file( $file ) )

                    include( $file );
            }

            static function cutnchar( $str, $n )
            {
                if ( strlen( $str ) < $n ) return $str;
                $html = substr( $str, 0, $n );
                $html = substr( $html, 0, strrpos( $html, ' ' ) );

                return $html . '...';
            }

            static function get_orderby_list()
            {
                return [
                    'none'          => 'None',
                    'ID'            => "ID",
                    'author'        => 'Author',
                    'title'         => 'Title',
                    'name'          => "Name",
                    'date'          => "Date",
                    'modified'      => 'Modified Date',
                    'parent'        => 'Parent',
                    'rand'          => 'Random',
                    'comment_count' => 'Comment Count',

                ];

            }

            static function reviewlist()
            {
                $file = locate_template( 'reviews/review-list.php' );

                if ( is_file( $file ) )

                    include( $file );
            }

            static function review_list_st_tour_ver()
            {
                // only st_tour_ver style
                $file = locate_template( 'reviews/st_tour_ver.php' );

                if ( is_file( $file ) )

                    include( $file );
            }

            static function rate_to_string( $star, $max = 5 )
            {
                $html = '';

                if ( $star > $max ) $star = $max;

                $moc1 = (int)$star;

                for ( $i = 1; $i <= $moc1; $i++ ) {
                    $html .= '<li><i class="fa  fa-star"></i></li>';
                }

                $new = $max - $star;

                $du = round( (float)$star - $moc1, 1 );

                if ( $du >= 0.2 and $du <= 0.9 ) {
                    $html .= '<li><i class="fa  fa-star-half-o"></i></li>';
                } elseif ( $du ) {
                    $html .= '<li><i class="fa  fa-star-o"></i></li>';
                }

                for ( $i = 1; $i <= $new; $i++ ) {
                    $html .= '<li><i class="fa  fa-star-o"></i></li>';
                }

                return apply_filters( 'st_rate_to_string', $html );

            }

            static function add_read_more( $content, $max_string = 200 )
            {
                $all = strlen( $content );

                if ( strlen( $content ) < $max_string ) return $content;
                $html       = substr( $content, 0, $max_string );
                $last_space = strrpos( $html, ' ' );
                $html       = substr( $html, 0, $last_space );


                return $html . '<span class="booking-item-review-more">' . substr( $content, -( $all - $last_space ) ) . '</span>';


            }

            static function cal_rate( $number, $total )
            {
                if ( !$total ) return 0;

                return round( ( $number / $total ) * 100 );
            }

            static function handle_icon( $string )
            {
                if ( strpos( $string, 'im-' ) === 0 ) {
                    $icon = "im " . $string;
                } elseif ( strpos( $string, 'fa-' ) === 0 ) {
                    $icon = "fa " . $string;
                } elseif ( strpos( $string, 'ion-' ) === 0 ) {
                    $icon = "ion " . $string;
                } else {
                    $icon = $string;
                }

                //return "<i class=''>"
                return $icon;
            }

            static function find_in_array( $item = [], $item_key = false, $item_value = false, $need = false )
            {
                if ( !empty( $item ) ) {
                    foreach ( $item as $key => $value ) {
                        if ( $item_value == $value[ $item_key ] ) {
                            if ( $need and isset( $value[ $need ] ) ) return $value[ $need ];

                            return $value;
                        }
                    }
                }
            }

            static function get_location_temp( $post_id = false )
            {
                if ( !$post_id ) $post_id = get_the_ID();
                $lat = get_post_meta( $post_id, 'map_lat', true );
                $lng = get_post_meta( $post_id, 'map_lng', true );

                if ( !$lat and !$lng ) return false;

                $dataWeather = self::_get_location_weather( $post_id );

                $c = 0;
                $f = 0;
                if ( isset( $dataWeather->main->temp ) ) {
                    $k           = $dataWeather->main->temp;
                    $temp_format = st()->get_option( 'st_weather_temp_unit', 'c' );
                    $c           = self::_change_temp( $k, $temp_format );
                    $f           = self::_change_temp( $k, 'f' );
                }
                $icon = '';
                if ( !empty( $dataWeather->weather[ 0 ]->icon ) ) {
                    $icon = self::get_weather_icons( $dataWeather->weather[ 0 ]->icon );
                }

                return [
                    'temp'   => $c,
                    'temp_k' => $f,
                    'icon'   => $icon
                ];
            }

            static function _change_temp( $value, $type = 'k' )
            {
                if ( $type == 'c' ) {
                    $value = $value - 273.15;
                }
                if ( $type == 'f' ) {
                    $c     = $value - 273.15;
                    $value = $c * 1.8 + 32;
                }
                $value = number_format( (float)$value, 1 );

                return $value;
            }

            static function get_weather_icons( $id_icon = null )
            {
                // API http://openweathermap.org/weather-conditions
                switch ( $id_icon ) {
                    case "01d":
                        return '<i class="wi wi-solar-eclipse loc-info-weather-icon"></i>';
                        break;
                    case "02d":
                        return '<i class="wi wi-day-cloudy loc-info-weather-icon"></i>';
                        break;
                    case "03d":
                        return '<i class="wi wi-cloud loc-info-weather-icon"></i>';
                        break;
                    case "04d":
                        return '<i class="wi wi-cloudy loc-info-weather-icon"></i>';
                        break;
                    case "09d":
                        return '<i class="wi wi-snow-wind loc-info-weather-icon"></i>';
                        break;
                    case "10d":
                        return '<i class="wi wi-day-rain-mix loc-info-weather-icon"></i>';
                        break;
                    case "11d":
                        return '<i class="wi wi-day-storm-showers loc-info-weather-icon"></i>';
                        break;
                    case "13d":
                        return '<i class="wi wi-showers loc-info-weather-icon"></i>';
                        break;
                    case "50d":
                        return '<i class="wi wi-windy loc-info-weather-icon"></i>';
                        break;
                    case "01n":
                        return '<i class="wi wi-night-clear loc-info-weather-icon"></i>';
                        break;
                    case "02n":
                        return '<i class="wi wi-night-cloudy loc-info-weather-icon"></i>';
                        break;
                    case "03n":
                        return '<i class="wi wi-cloud loc-info-weather-icon"></i>';
                        break;
                    case "04n":
                        return '<i class="wi wi-cloudy loc-info-weather-icon"></i>';
                        break;
                    case "09n":
                        return '<i class="wi wi-snow-wind loc-info-weather-icon"></i>';
                        break;
                    case "10n":
                        return '<i class="wi wi-night-alt-rain-mix loc-info-weather-icon"></i>';
                        break;
                    case "11n":
                        return '<i class="wi wi-day-storm-showers loc-info-weather-icon"></i>';
                        break;
                    case "13n":
                        return '<i class="wi wi-showers loc-info-weather-icon"></i>';
                        break;
                    case "50n":
                        return '<i class="wi wi-windy loc-info-weather-icon"></i>';
                        break;
                }

            }

            private static function _get_location_weather( $post_id = false )
            {
                if ( !$post_id ) $post_id = get_the_ID();

                $lat = get_post_meta( $post_id, 'map_lat', true );
                $lng = get_post_meta( $post_id, 'map_lng', true );


                if ( $lat and $lng ) {
                    $url = "http://api.openweathermap.org/data/2.5/weather?APPID=" . st()->get_option( 'weather_api_key', 'a82498aa9918914fa4ac5ba584a7e623' ) . "&lat=" . $lat . '&lon=' . $lng;
                } else {
                    $url = "http://api.openweathermap.org/data/2.5/weather?APPID=" . st()->get_option( 'weather_api_key', 'a82498aa9918914fa4ac5ba584a7e623' ) . "&q=" . get_the_title( $post_id );
                }

                // fix multilanguage whene translate new location

                $post_data = get_post( $post_id, ARRAY_A );
                $slug      = $post_data[ 'post_name' ];

                $cache = get_transient( 'st_weather_location_' . $slug );
                $hour  = intval( st()->get_option( 'update_weather_by', 1 ) );

                $dataWeather = null;

                if ( $cache === false ) {
                    $raw_geocode = wp_remote_get( $url );

                    $body = wp_remote_retrieve_body( $raw_geocode );
                    $body = json_decode( $body );
                    if ( isset( $body->main->temp ) )
                        set_transient( 'st_weather_location_' . $post_id, $body, 60 * 60 * $hour );
                    $dataWeather = $body;
                } else {
                    $dataWeather = $cache;
                }

                return $dataWeather;
            }

            private static function _change_weather_icon( $icon_old, $icon_new )
            {

                if ( strpos( $icon_old, 'd' ) !== false ) {
                    return str_replace( '-night-', '-day-', $icon_new );
                } else {
                    return str_replace( '-day-', '-night-', $icon_new );
                }
            }


            static function get_weather_icon( $location_id = fasle )
            {
                if ( !$location_id ) $location_id = get_the_ID();

                $dataWeather = self::_get_location_weather( $location_id );

                $c = 0;
                if ( isset( $dataWeather->weather->id ) ) {
                    $w_id     = $dataWeather->weather->id;
                    $old_icon = $dataWeather->weather->id;

                    switch ( $w_id ) {
                        case 200:
                            //$c=self::_change_weather_icon('')
                    }
                }

                return $c;
            }

            /**
             * @since 1.1.0
             *
             * @param string post type
             * @param string type (null or option_tree)
             **/
            static function st_get_field_search( $post_type, $type = '' )
            {
                $list_field = [];
                if ( !empty( $post_type ) ) {
                    switch ( $post_type ) {
                        case "st_hotel":
                            if ( class_exists( 'STHotel' ) )
                                $data_field = STHotel::get_search_fields_name();
                            break;
                        case "st_rental":
                            if ( class_exists( 'STRental' ) )
                                $data_field = STRental::get_search_fields_name();
                            break;
                        case "st_cars":
                            if ( class_exists( 'STCars' ) )
                                $data_field = STCars::get_search_fields_name();
                            break;
                        case "st_tours":
                            if ( class_exists( 'STTour' ) )

                                $data_field = STTour::get_search_fields_name();
                            break;
                        case "st_activity":
                            if ( class_exists( 'STActivity' ) )
                                $data_field = STActivity::get_search_fields_name();
                            break;
                        default:
                            $data_field = apply_filters( 'st_search_fields_name', [], $post_type );
                            break;
                    }
                    $list_field[ __( '--Select--', ST_TEXTDOMAIN ) ] = '';
                    if ( !empty( $data_field ) and is_array( $data_field ) and $type == '' ) {
                        foreach ( $data_field as $k => $v ) {
                            $list_field[ $v[ 'label' ] ] = $v[ 'value' ];
                        }

                        return $list_field;
                    }
                    if ( !empty( $data_field ) and is_array( $data_field ) and $type == 'option_tree' ) {
                        foreach ( $data_field as $k => $v ) {
                            $list_field[] = [
                                'label' => $v[ 'label' ],
                                'value' => $v[ 'value' ]
                            ];
                        }

                        return $list_field;
                    }
                } else {
                    return false;
                }
            }


            /**
             * @since 1.1.7
             **/
            static function getBookingPeriod()
            {
                $booking_period = STInput::request( 'booking_period', 0 );
                $list_date      = [];
                if ( $booking_period > 0 ) {
                    for ( $i = 0; $i < $booking_period; $i++ ) {
                        if ( $i <= 1 ) {
                            $date = date( TravelHelper::getDateFormat(), strtotime( "+" . $i . " day" ) );
                        } elseif ( $i > 1 ) {
                            $date = date( TravelHelper::getDateFormat(), strtotime( "+" . $i . " days" ) );
                        }
                        $list_date[] = $date;
                    }
                }
                echo json_encode( $list_date );
                die();
            }

            static function getListDate( $start, $end )
            {

                $start = new DateTime( $start );
                $end   = new DateTime( $end . ' +1 day' );
                $list  = [];
                foreach ( new DatePeriod( $start, new DateInterval( 'P1D' ), $end ) as $day ) {
                    $list[] = $day->format( TravelHelper::getDateFormat() );
                }

                return $list;
            }

            static function substr( $str, $length, $minword = 3 )
            {
                $sub = '';
                $len = 0;
                foreach ( explode( ' ', $str ) as $word ) {
                    $part = ( ( $sub != '' ) ? ' ' : '' ) . $word;
                    $sub  .= $part;
                    $len  += strlen( $part );
                    if ( strlen( $word ) > $minword && strlen( $sub ) >= $length ) {
                        break;
                    }
                }

                return $sub . ( ( $len < strlen( $str ) ) ? '...' : '' );
            }

            static function getVersion()
            {
                $ver = wp_get_theme()->get( 'Version' );
                $ver = preg_replace( "/(\.)/", "", $ver );

                return intval( $ver );
            }


            static function time_to_date( $times )
            {
                $times = (float)$times;
                if ( $times <= 24 ) {
                    return 1;
                }

                $dates = (int)( $times / 24 );
                if ( $times % 24 > 0 ) {
                    $dates += 1;
                }

                return $dates;

            }

            static function dateCompare( $start, $end )
            {
                $start_ts = strtotime( $start );
                $end_ts   = strtotime( $end );

                return $end_ts - $start_ts;
            }

            /**
             * @since 1.1.7
             **/
            static function getLocationBySession()
            {
                if ( isset( $_SESSION[ 'st_location' ] ) ) {
                    $result = stripslashes( $_SESSION[ 'st_location' ] );

                    return json_decode( $result );
                } else {
                    return '';
                }

            }

            /**
             * @since 1.1.7
             **/
            static function setLocationBySession()
            {

                $current_language = '';
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $current_language = ICL_LANGUAGE_CODE;
                } elseif ( function_exists( 'qtrans_getLanguage' ) ) {
                    $current_language = qtrans_getLanguage();
                }

                if ( !isset( $_SESSION[ 'st_location' ] ) || empty( $_SESSION[ 'st_location' ] ) || get_option( 'st_allow_save_location' ) == false || get_option( 'st_allow_save_location' ) == 'allow' || !isset( $_SESSION[ 'st_current_language_1' ] ) || $current_language != $_SESSION[ 'st_current_language_1' ] ) {
                    $locations = [];

                    $query = [
                        'post_type'      => 'location',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish'
                    ];
                    query_posts( $query );
                    while ( have_posts() ): the_post();
                        $locations[] = [
                            'ID'     => '_' . get_the_ID() . '_',
                            'parent' => wp_get_post_parent_id( get_the_ID() )
                        ];
                    endwhile;
                    wp_reset_postdata();
                    wp_reset_query();

                    $_SESSION[ 'st_location' ] = json_encode( $locations );

                    $_SESSION[ 'st_current_language_1' ] = $current_language;
                    update_option( 'st_allow_save_location', 'not_allow' );
                }
            }

            static function _loop_location( $locations = [], $parent = 0, $l_tmp = [] )
            {
                $location_tmp = [];
                foreach ( $locations as $key => $val ) {
                    if ( intval( $val[ 'parent' ] ) == intval( $parent ) ) {
                        $location_tmp[] = $val;
                        unset( $locations[ $key ] );
                    }
                }
                if ( count( $location_tmp ) ) {
                    foreach ( $location_tmp as $item ) {
                        $l_tmp[] = $item;
                        self::_loop_location( $locations, $item[ 'parent' ], $l_tmp );
                    }
                }
                if ( count( $locations ) == 0 )
                    return $l_tmp;
            }

            /**
             * @since 1.1.7
             **/
            static function getListLocation()
            {
                if ( !is_admin() ) {
                    $post_id = STInput::request( 'id' );
                } else {
                    $post_id = STInput::request( 'post' );
                }
                $muti_location = STInput::request( 'multi_location' );
                if ( empty( $post_id ) || !get_post_status( $post_id ) and empty( $muti_location ) ) {
                    $list_location = json_encode( "" );
                } else {
                    $list_location = get_post_meta( $post_id, 'multi_location', true );

                    if ( empty( $list_location ) and !empty( $muti_location ) ) {
                        if ( STUser_f::get_status_msg() != 'success' ) {
                            $list_location = implode( ',', $muti_location );
                        }
                    }
                    if ( !empty( $list_location ) ) {
                        if ( is_array( $list_location ) ) {
                            foreach ( $list_location as $key => $val ) {
                                $list_location[ $key ] = preg_replace( "/(\_)/", "", $list_location[ $key ] );
                            }
                        } else {
                            $list_location = preg_replace( "/(\_)/", "", $list_location );
                            $list_location = explode( ",", $list_location );
                        }
                        $list_location = json_encode( $list_location );
                    } else {
                        $list_location = get_post_meta( $post_id, 'id_location', true );
                        if ( !empty( $list_location ) ) {
                            $arr           = [ $list_location ];
                            $list_location = json_encode( $arr );
                        } else {
                            $list_location = get_post_meta( $post_id, 'location_id', true );
                            if ( !empty( $list_location ) ) {
                                $arr           = [ $list_location ];
                                $list_location = json_encode( $arr );
                            } else {
                                $list_location = json_encode( "" );
                            }
                        }
                    }
                }
                wp_localize_script( 'jquery', 'list_location', [
                    'list' => $list_location
                ] );
            }

            /**
             * @since 1.1.7
             **/
            static function locationHtml( $post_id = '' )
            {
                $result = '';

                if ( empty( $post_id ) ) {
                    $post_id = get_the_ID();
                }

                $list_location = get_post_meta( $post_id, 'multi_location', true );
                if ( $list_location && !empty( $list_location ) ) {
                    if ( is_array( $list_location ) ) {
                        foreach ( $list_location as $key => $val ) {
                            $list_location[ $key ] = preg_replace( "/(\_)/", "", $list_location[ $key ] );
                        }
                    } else {
                        $list_location = preg_replace( "/(\_)/", "", $list_location );
                        $list_location = explode( ",", $list_location );
                    }
                    foreach ( $list_location as $item ) {
                        if ( empty( $result ) ) {
                            $result .= get_the_title( $item );
                        } else {
                            $result .= ', ' . get_the_title( $item );
                        }
                    }
                } else {
                    $list_location = get_post_meta( $post_id, 'location_id', true );
                    if ( $list_location && !empty( $list_location ) ) {
                        $result = get_the_title( $list_location );
                    } else {
                        $list_location = get_post_meta( $post_id, 'id_location', true );
                        if ( $list_location && !empty( $list_location ) ) {
                            $result = get_the_title( $list_location );
                        }
                    }
                }

                return $result;
            }

            /**
             * @since 1.1.7
             *        remove from 1.2.2
             **/
            static function setListFullNameLocation()
            {
                $current_language = '';
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $current_language = ICL_LANGUAGE_CODE;
                } elseif ( function_exists( 'qtrans_getLanguage' ) ) {
                    $current_language = qtrans_getLanguage();
                }
                if ( !is_admin() && ( !isset( $_SESSION[ 'st_current_language' ] ) || ( $current_language != $_SESSION[ 'st_current_language' ] ) || !isset( $_SESSION[ 'st_cache_location' ] ) || get_option( 'st_allow_save_cache_location' ) == 'allow' || get_option( 'st_allow_save_cache_location' ) == false ) ) {
                    $query = [
                        'post_type'      => 'location',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish'
                    ];

                    $result = [];

                    query_posts( $query );
                    while ( have_posts() ) : the_post();
                        $country = get_post_meta( get_the_ID(), 'location_country', true );
                        if ( !$country ) $country = '';
                        $result[] = [
                            'ID'      => get_the_ID(),
                            'Country' => $country
                        ];
                    endwhile;
                    wp_reset_query();
                    wp_reset_postdata();

                    $_SESSION[ 'st_cache_location' ] = json_encode( $result );
                    update_option( 'st_allow_save_cache_location', 'notallow' );
                    $_SESSION[ 'st_current_language' ] = $current_language;
                }
            }


            /**
             *remove from 1.2.2
             **/
            static function showNameLocation( $post_id = '', $post_title = '' )
            {
                if ( empty( $post_id ) ) return '';

                global $wpdb;
                $table = $wpdb->prefix . 'st_location_nested';

                $ns = new Nested_set();
                $ns->setControlParams( $table );
                $node   = $ns->getNodeWhere( "location_id = {$post_id}" );
                $string = $post_title;
                if ( !empty( $node ) ) {
                    $tree = $ns->getNodesWhere( "left_key < " . (int)$node[ 'left_key' ] . " AND right_key > " . (int)$node[ 'right_key' ] . " AND location_id <> 0", "left_key DESC" );
                    if ( !empty( $tree ) ) {
                        foreach ( $tree as $key => $item ) {
                            $string .= ', ' . get_the_title( (int)$item[ 'location_id' ] );
                        }
                    }
                    $string .= self::getZipCodeHtml( $post_id );
                }

                return $string;
            }

            /**
             * @since 1.1.7
             *        remove from 1.2.2
             **/
            static function getZipCodeHtml( $post_id )
            {
                $zipcode = get_post_meta( $post_id, 'zipcode', true );
                if ( $zipcode && !empty( $zipcode ) ) {
                    return '||' . $zipcode;
                } else {
                    return '';
                }
            }

            /**
             * @since 1.1.7
             *        updated 1.3.1
             *
             * @param $posttype string
             *                  only shows location that has services.
             **/
            static function getListFullNameLocation( $post_type = '' )
            {
                if ( array_key_exists( 'full_name_' . $post_type, self::$listFullNameLocations ) ) return self::$listFullNameLocations[ 'full_name_' . $post_type ];
                global $wpdb;

                $language = "'" . 'en' . "'";
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $language = "'" . ICL_LANGUAGE_CODE . "'";
                }
                $where = '';
                if ( !empty( $post_type ) ) {
                    $where = " AND (node.location_id IN (SELECT
                    location_from
                FROM
                    {$wpdb->prefix}st_location_relationships
                WHERE
                    post_type = '{$post_type}'
                GROUP BY
                    location_from) OR node.location_id IN (SELECT
                    location_to
                FROM
                    {$wpdb->prefix}st_location_relationships
                WHERE 
                    post_type = '{$post_type}'
                GROUP BY
                    location_to)) ";
                }
                $sql = "SELECT
                node.id as post_id,
                node.location_id AS ID,
                node.`name` AS post_title,
                node.location_country AS Country,
                node.fullname,
                node.left_key,
                node.right_key,
                node.parent_id,
                (COUNT(parent.fullname) - 1) AS lv
            FROM
                {$wpdb->prefix}st_location_nested AS node,
                {$wpdb->prefix}st_location_nested AS parent
            WHERE
                node.id <> 1 and node.`language` = {$language} AND
                node.left_key BETWEEN parent.left_key
            AND parent.right_key
            {$where}
            AND node.`status` IN ('publish', 'private')
            GROUP BY
                node.fullname
            ORDER BY
                node.left_key";

                $results                                                  = $wpdb->get_results( $sql );
                self::$listFullNameLocations[ 'full_name_' . $post_type ] = $results;

                return $results;
            }

            static function sort_at_level( $key, $val, &$results, &$return )
            {
                if ( $results ) {
                    $tmp = [];
                    foreach ( $results as $key1 => $val1 ) {
                        if ( $val1->left_key > $val->left_key && $val1->right_key < $val->right_key && ( $val->lv + 1 == $val1->lv ) ) {
                            $tmp[ sanitize_title( $val1->post_title ) ] = $val1;
                            unset( $results[ $key ] );
                        }
                    }
                    if ( $tmp ) {
                        ksort( $tmp );
                        foreach ( $tmp as $key_tmp => $val_tmp ) {
                            $return[] = $val_tmp;

                            self::sort_at_level( $key_tmp, $val_tmp, $results, $return );
                        }
                        unset( $tmp );
                    }
                } else {
                    return $return;
                }
            }

            static function _max_level_location()
            {
                global $wpdb;
                $sql = "SELECT
                max(lv) as max_level
            FROM
                (
                    SELECT
                        (COUNT(parent.fullname) - 1) AS lv
                    FROM
                        {$wpdb->prefix}st_location_nested AS node,
                        {$wpdb->prefix}st_location_nested AS parent
                    WHERE
                        node.left_key BETWEEN parent.left_key
                    AND parent.right_key
                    GROUP BY
                        node.fullname
                    ORDER BY
                        node.left_key
                ) AS lv";

                return $wpdb->get_var( $sql );
            }

            static function getFirstParent( $node )
            {
                global $wpdb;
                $sql = "SELECT
                `name`
            FROM
                {$wpdb->prefix}st_location_nested
            WHERE
                left_key < {$node['left_key']}
            AND right_key > {$node['right_key']}
            AND id <> 1
            ORDER BY
                left_key ASC
            LIMIT 1";

                $name = $wpdb->get_col( $sql, 0 );

                if ( !empty( $name ) ) {
                    return $name[ 0 ];
                }

                return '';
            }

            /**
             * @since 1.1.7
             *        delete from 1.2.2
             **/
            static function getRelationPost( $list = '', $id = '' )
            {
                $parent = wp_get_post_parent_id( $id );
                if ( $parent > 0 ) {
                    return $list .= ', ' . get_the_title( $parent );
                    self::getRelationPost( $parent );
                } else {
                    return $list;
                }
            }

            /**
             * @since 1.1.8
             **/
            static function checkIssetPost( $post_id = '', $post_type = '' )
            {
                global $wpdb;
                if ( intval( $post_id ) && !empty( $post_type ) ) {
                    $table = $wpdb->prefix . $post_type;
                    $sql   = "SELECT post_id FROM {$table} WHERE post_id = '{$post_id}'";

                    $wpdb->query( $sql );

                    $num_rows = $wpdb->num_rows;

                    return $num_rows;
                } else {
                    return 0;
                }

            }

            /**
             * @since 1.1.8
             **/
            static function insertDuplicate( $post_type = 'st_hotel', $data = [] )
            {
                global $wpdb;
                $table = $wpdb->prefix . $post_type;

                $wpdb->insert( $table, $data );
            }

            static function deleteDuplicateData( $post_id, $table )
            {
                global $wpdb;

                $sql = "DELETE FROM {$table} WHERE post_id = '{$post_id}'";

                $rs = $wpdb->query( $sql );

                return $rs;
            }

            /**
             * @since 1.1.8
             **/
            static function updateDuplicate( $post_type = 'st_hotel', $data = [], $where = [] )
            {
                global $wpdb;
                $table = $wpdb->prefix . $post_type;
                $wpdb->update( $table, $data, $where, $format = null, $where_format = null );
            }

            /**
             * @since  1.1.8
             * @update 1.2.0
             **/

            static function checkTableDuplicate( $post_types = [] )
            {
                global $wpdb;

                if ( is_array( $post_types ) && count( $post_types ) ) {
                    foreach ( $post_types as $post_type ) {
                        $table = $wpdb->prefix . $post_type;
                        if ( empty( self::$_check_table_duplicate[ $post_type ] ) ) {
                            if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) !== $table ) {
                                return false;
                            } else {
                                self::$_check_table_duplicate[ $post_type ] = true;
                            }

                        }


                    }
                } else {

                    if ( empty( self::$_check_table_duplicate[ $post_types ] ) ) {
                        $table = $wpdb->prefix . $post_types;

                        if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) !== $table ) {
                            return false;
                        } else self::$_check_table_duplicate[ $post_types ] = true;
                    }


                }

                return true;
            }

            static function count_all_sale( $post_type = 'st_hotel' )
            {
                if ( !self::checkTableDuplicate( $post_type ) ) {
                    return 0;
                }
                global $wpdb;
                $date = date( 'Y-m-d' );
                switch ( $post_type ) {
                    case 'st_hotel':
                    case 'hotel_room':
                        $sql = "SELECT
                        count(discount_rate) as total_discount
                    FROM
                        {$wpdb->prefix}hotel_room
                    WHERE
                        CAST(discount_rate AS UNSIGNED) > 0";
                        break;
                    case 'st_rental':
                        $sql = "SELECT
                        count(discount_rate) AS total_discount
                    FROM
                        {$wpdb->prefix}st_rental
                    WHERE
                        CAST(discount_rate AS UNSIGNED) > 0
                    AND (
                        (
                            is_sale_schedule = 'on'
                            AND STR_TO_DATE('{$date}', '%Y-%m-%d') BETWEEN STR_TO_DATE(sale_price_from, '%Y-%m-%d')
                            AND STR_TO_DATE(sale_price_to, '%Y-%m-%d')
                        )
                        OR is_sale_schedule = 'off'
                    )";
                        break;
                    case 'st_tours':
                        $sql = "SELECT
                        count(discount) AS total_discount
                    FROM
                        {$wpdb->prefix}st_tours
                    WHERE
                        CAST(discount AS UNSIGNED) > 0
                    AND (
                        (
                            is_sale_schedule = 'on'
                            AND STR_TO_DATE('{$date}', '%Y-%m-%d') BETWEEN STR_TO_DATE(sale_price_from, '%Y-%m-%d')
                            AND STR_TO_DATE(sale_price_to, '%Y-%m-%d')
                        )
                        OR is_sale_schedule = 'off'
                    )";
                        break;
                    case 'st_activity':
                        $sql = "SELECT
                        count(discount) AS total_discount
                    FROM
                        {$wpdb->prefix}st_activity
                    WHERE
                        CAST(discount AS UNSIGNED) > 0
                    AND (
                        (
                            is_sale_schedule = 'on'
                            AND STR_TO_DATE('{$date}', '%Y-%m-%d') BETWEEN STR_TO_DATE(sale_price_from, '%Y-%m-%d')
                            AND STR_TO_DATE(sale_price_to, '%Y-%m-%d')
                        )
                        OR is_sale_schedule = 'off'
                    )";
                        break;
                    case 'st_cars':
                        $sql = "SELECT
                        count(discount) AS total_discount
                    FROM
                        {$wpdb->prefix}st_cars
                    WHERE
                        CAST(discount AS UNSIGNED) > 0
                    AND (
                        (
                            is_sale_schedule = 'on'
                            AND STR_TO_DATE('{$date}', '%Y-%m-%d') BETWEEN STR_TO_DATE(sale_price_from, '%Y-%m-%d')
                            AND STR_TO_DATE(sale_price_to, '%Y-%m-%d')
                        )
                        OR is_sale_schedule = 'off'
                    )";
                        break;

                }

                return $wpdb->get_var( $sql );
            }

            /**
             * @since 1.1.8
             **/
            static $flag_query_location = false;

            static function queryLocationByParent( $post_id )
            {
                global $wpdb;

                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $sql = "SELECT
                    {$wpdb->prefix}posts.ID as id,
                    {$wpdb->prefix}posts.post_parent as parent
                FROM
                    {$wpdb->prefix}posts
                JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
                AND t.element_type = 'post_location'
                JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
                AND l.active = 1
                where post_type = 'location'
                and post_status = 'publish'
                AND t.language_code = '" . ICL_LANGUAGE_CODE . "'";
                } else {
                    $sql = "SELECT
                    {$wpdb->prefix}posts.ID as id
                FROM
                    {$wpdb->prefix}posts
                where post_type = 'location'
                and post_status = 'publish'";
                }

                return $wpdb->get_results( $sql, ARRAY_A );
            }

            static $list_location = [];

            static function loopLocationParent( $parent, $list )
            {
                self::$list_location[] = $parent;
                foreach ( $list as $item ) {
                    if ( intval( $parent ) == intval( $item[ 'parent' ] ) ) {
                        self::loopLocationParent( intval( $item[ 'id' ] ), $list );
                    }
                }
            }

            static function getLocationByParent( $post_id )
            {
                $list = false;
                if ( !empty( $flag_query_location ) ) {
                    $list = self::queryLocationByParent( $post_id );
                }
                if ( !empty( $list ) ) {
                    self::loopLocationParent( $post_id, $list );
                }
                self::$list_location = array_unique( self::$list_location );

                return self::$list_location;

            }

            /**
             * @since 1.1.8
             **/
            static function infoItemInLocation( $post_id, $post_type = 'st_hotel' )
            {
                global $wpdb;
                $table          = $wpdb->prefix . $post_type;
                $price_field    = 'price';
                $location_field = 'id_location';

                if ( $post_type == 'st_cars' ) {
                    $price_field = 'cars_price';
                } elseif ( $post_type == 'st_hotel' ) {
                    $price_field = 'price_avg';
                } elseif ( $post_type == 'st_tours' || $post_type == 'st_activity' ) {
                    $price_field = 'sale_price';
                } elseif ( $post_type = 'st_rental' ) {
                    $price_field    = 'sale_price';
                    $location_field = 'location_id';
                }
                $sql     = "SELECT COUNT(post_id) as numbers, MIN($price_field) as froms FROM {$table} WHERE (multi_location LIKE '%_{$post_id}_%' OR {$location_field} IN ({$post_id}))";
                $results = $wpdb->get_row( $sql, ARRAY_A );

                return $results;
            }

            /**
             * @since   1.1.8
             * @updated 1.2.4
             **/

            static function treeLocationHtml( $post_type = '' )
            {
                $lists = self::getListFullNameLocation( $post_type );
                $ns    = new Nested_set();
                global $wpdb;
                $ns->setControlParams( $wpdb->prefix . 'st_location_nested' );

                if ( empty( $lists ) ) {
                    return '';
                }

                $tree = [];
                foreach ( $lists as $key => $location ) {

                    // $parent_name = self::getFirstParent( array('left_key' => $location->left_key, 'right_key' => $location->right_key) );

                    $tree[] = [
                        'ID'          => (int)$location->ID,
                        'post_title'  => $location->post_title,
                        'fullname'    => $location->fullname,
                        'level'       => (int)$ns->getNodeLevel( [ 'left_key' => $location->left_key, 'right_key' => $location->right_key ] ) * 20,
                        'parent_name' => $location->post_title, /*(empty( $parent_name ) )? strtolower($location->post_title) : strtolower($parent_name)*/
                        'post_id'     => $location->post_id,
                        'parent_id'   => $location->parent_id,
                    ];
                }

                return $tree;

            }

            /** FROM 1.1.9
             * removed from 1.2.7
             */
            static function get_duration_text( $value, $number = null )
            {
                // get text by value
                if ( $number <= 0 ) return;
                if ( !$number or $number == 1 ) {
                    switch ( $value ) {
                        case 'month':
                            return __( "month", ST_TEXTDOMAIN );
                            break;
                        case 'week':
                            return __( "week", ST_TEXTDOMAIN );
                            break;
                        case 'hour':
                            return __( "hour", ST_TEXTDOMAIN );
                            break;
                        default:
                            return __( "day", ST_TEXTDOMAIN );
                            break;
                    }
                } else {
                    switch ( $value ) {
                        case 'month':
                            return __( "months", ST_TEXTDOMAIN );
                            break;
                        case 'week':
                            return __( "weeks", ST_TEXTDOMAIN );
                            break;
                        case 'hour':
                            return __( "hours", ST_TEXTDOMAIN );
                            break;
                        default:
                            return __( "days", ST_TEXTDOMAIN );
                            break;
                    }
                }

            }

            /**
             * @since 1.1.8
             **/

            static function _get_location_country( $optiontree = true )
            {
                $countries    = [
                    ''    => '----Select----',
                    'AF'  => 'Afghanistan',
                    'AX'  => 'Aland Islands',
                    'AL'  => 'Albania',
                    'DZ'  => 'Algeria',
                    'AS'  => 'American Samoa',
                    'AD'  => 'Andorra',
                    'AO'  => 'Angola',
                    'AI'  => 'Anguilla',
                    'AQ'  => 'Antarctica',
                    'AG'  => 'Antigua And Barbuda',
                    'AR'  => 'Argentina',
                    'AM'  => 'Armenia',
                    'AW'  => 'Aruba',
                    'AU'  => 'Australia',
                    'AT'  => 'Austria',
                    'AZ'  => 'Azerbaijan',
                    'BS'  => 'Bahamas',
                    'BH'  => 'Bahrain',
                    'BD'  => 'Bangladesh',
                    'BB'  => 'Barbados',
                    'BY'  => 'Belarus',
                    'BE'  => 'Belgium',
                    'BZ'  => 'Belize',
                    'BJ'  => 'Benin',
                    'BM'  => 'Bermuda',
                    'BT'  => 'Bhutan',
                    'BO'  => 'Bolivia',
                    'BA'  => 'Bosnia And Herzegovina',
                    'BW'  => 'Botswana',
                    'BV'  => 'Bouvet Island',
                    'BR'  => 'Brazil',
                    'IO'  => 'British Indian Ocean Territory',
                    'BN'  => 'Brunei Darussalam',
                    'BG'  => 'Bulgaria',
                    'BF'  => 'Burkina Faso',
                    'BI'  => 'Burundi',
                    'KH'  => 'Cambodia',
                    'CM'  => 'Cameroon',
                    'CA'  => 'Canada',
                    'CV'  => 'Cape Verde',
                    'KY'  => 'Cayman Islands',
                    'CF'  => 'Central African Republic',
                    'TD'  => 'Chad',
                    'CL'  => 'Chile',
                    'CN'  => 'China',
                    'CX'  => 'Christmas Island',
                    'CC'  => 'Cocos (Keeling) Islands',
                    'CO'  => 'Colombia',
                    'KM'  => 'Comoros',
                    'CG'  => 'Congo',
                    'CD'  => 'Congo, Democratic Republic',
                    'CK'  => 'Cook Islands',
                    'CR'  => 'Costa Rica',
                    'CI'  => 'Cote D\'Ivoire',
                    'HR'  => 'Croatia',
                    'CU'  => 'Cuba',
                    'CY'  => 'Cyprus',
                    'CZ'  => 'Czech Republic',
                    'DK'  => 'Denmark',
                    'DJ'  => 'Djibouti',
                    'DM'  => 'Dominica',
                    'DO'  => 'Dominican Republic',
                    'EC'  => 'Ecuador',
                    'EG'  => 'Egypt',
                    'SV'  => 'El Salvador',
                    'GQ'  => 'Equatorial Guinea',
                    'ER'  => 'Eritrea',
                    'EE'  => 'Estonia',
                    'ET'  => 'Ethiopia',
                    'FK'  => 'Falkland Islands (Malvinas)',
                    'FO'  => 'Faroe Islands',
                    'FJ'  => 'Fiji',
                    'FI'  => 'Finland',
                    'FR'  => 'France',
                    'GF'  => 'French Guiana',
                    'PF'  => 'French Polynesia',
                    'TF'  => 'French Southern Territories',
                    'GA'  => 'Gabon',
                    'GM'  => 'Gambia',
                    'GE'  => 'Georgia',
                    'DE'  => 'Germany',
                    'GH'  => 'Ghana',
                    'GI'  => 'Gibraltar',
                    'GR'  => 'Greece',
                    'GL'  => 'Greenland',
                    'GD'  => 'Grenada',
                    'GP'  => 'Guadeloupe',
                    'GU'  => 'Guam',
                    'GT'  => 'Guatemala',
                    'GG'  => 'Guernsey',
                    'GN'  => 'Guinea',
                    'GW'  => 'Guinea-Bissau',
                    'GY'  => 'Guyana',
                    'HT'  => 'Haiti',
                    'HM'  => 'Heard Island & Mcdonald Islands',
                    'VA'  => 'Holy See (Vatican City State)',
                    'HN'  => 'Honduras',
                    'HK'  => 'Hong Kong',
                    'HU'  => 'Hungary',
                    'IS'  => 'Iceland',
                    'IN'  => 'India',
                    'ID'  => 'Indonesia',
                    'IR'  => 'Iran, Islamic Republic Of',
                    'IQ'  => 'Iraq',
                    'IE'  => 'Ireland',
                    'IM'  => 'Isle Of Man',
                    'IL'  => 'Israel',
                    'IT'  => 'Italy',
                    'JM'  => 'Jamaica',
                    'JP'  => 'Japan',
                    'JE'  => 'Jersey',
                    'JO'  => 'Jordan',
                    'KZ'  => 'Kazakhstan',
                    'KE'  => 'Kenya',
                    'KI'  => 'Kiribati',
                    'KR'  => 'Korea',
                    'KW'  => 'Kuwait',
                    'KG'  => 'Kyrgyzstan',
                    'LA'  => 'Lao People\'s Democratic Republic',
                    'LV'  => 'Latvia',
                    'LB'  => 'Lebanon',
                    'LS'  => 'Lesotho',
                    'LR'  => 'Liberia',
                    'LY'  => 'Libyan Arab Jamahiriya',
                    'LI'  => 'Liechtenstein',
                    'LT'  => 'Lithuania',
                    'LU'  => 'Luxembourg',
                    'MO'  => 'Macao',
                    'MK'  => 'Macedonia',
                    'MG'  => 'Madagascar',
                    'MW'  => 'Malawi',
                    'MY'  => 'Malaysia',
                    'MV'  => 'Maldives',
                    'ML'  => 'Mali',
                    'MT'  => 'Malta',
                    'MH'  => 'Marshall Islands',
                    'MQ'  => 'Martinique',
                    'MR'  => 'Mauritania',
                    'MU'  => 'Mauritius',
                    'YT'  => 'Mayotte',
                    'MX'  => 'Mexico',
                    'FM'  => 'Micronesia, Federated States Of',
                    'MD'  => 'Moldova',
                    'MC'  => 'Monaco',
                    'MN'  => 'Mongolia',
                    'ME'  => 'Montenegro',
                    'MS'  => 'Montserrat',
                    'MA'  => 'Morocco',
                    'MZ'  => 'Mozambique',
                    'MM'  => 'Myanmar',
                    'NA'  => 'Namibia',
                    'NR'  => 'Nauru',
                    'NP'  => 'Nepal',
                    'NL'  => 'Netherlands',
                    'AN'  => 'Netherlands Antilles',
                    'NC'  => 'New Caledonia',
                    'NZ'  => 'New Zealand',
                    'NI'  => 'Nicaragua',
                    'NE'  => 'Niger',
                    'NG'  => 'Nigeria',
                    'NU'  => 'Niue',
                    'NF'  => 'Norfolk Island',
                    'MP'  => 'Northern Mariana Islands',
                    'NO'  => 'Norway',
                    'OM'  => 'Oman',
                    'PK'  => 'Pakistan',
                    'PW'  => 'Palau',
                    'PS'  => 'Palestinian Territory, Occupied',
                    'PA'  => 'Panama',
                    'PG'  => 'Papua New Guinea',
                    'PY'  => 'Paraguay',
                    'PE'  => 'Peru',
                    'PH'  => 'Philippines',
                    'PN'  => 'Pitcairn',
                    'PL'  => 'Poland',
                    'PT'  => 'Portugal',
                    'PR'  => 'Puerto Rico',
                    'QA'  => 'Qatar',
                    'RE'  => 'Reunion',
                    'RO'  => 'Romania',
                    'RU'  => 'Russian Federation',
                    'RW'  => 'Rwanda',
                    'BL'  => 'Saint Barthelemy',
                    'SH'  => 'Saint Helena',
                    'KN'  => 'Saint Kitts And Nevis',
                    'LC'  => 'Saint Lucia',
                    'MF'  => 'Saint Martin',
                    'PM'  => 'Saint Pierre And Miquelon',
                    'VC'  => 'Saint Vincent And Grenadines',
                    'WS'  => 'Samoa',
                    'SM'  => 'San Marino',
                    'ST'  => 'Sao Tome And Principe',
                    'SA'  => 'Saudi Arabia',
                    'SN'  => 'Senegal',
                    'RS'  => 'Serbia',
                    'SC'  => 'Seychelles',
                    'SL'  => 'Sierra Leone',
                    'SG'  => 'Singapore',
                    'SK'  => 'Slovakia',
                    'SI'  => 'Slovenia',
                    'SB'  => 'Solomon Islands',
                    'SO'  => 'Somalia',
                    'ZA'  => 'South Africa',
                    'GS'  => 'South Georgia And Sandwich Isl.',
                    'ES'  => 'Spain',
                    'LK'  => 'Sri Lanka',
                    'SD'  => 'Sudan',
                    'SR'  => 'Suriname',
                    'SJ'  => 'Svalbard And Jan Mayen',
                    'SZ'  => 'Swaziland',
                    'SE'  => 'Sweden',
                    'CH'  => 'Switzerland',
                    'SY'  => 'Syrian Arab Republic',
                    'TW'  => 'Taiwan',
                    'TJ'  => 'Tajikistan',
                    'TZ'  => 'Tanzania',
                    'TH'  => 'Thailand',
                    'TL'  => 'Timor-Leste',
                    'TG'  => 'Togo',
                    'TK'  => 'Tokelau',
                    'TO'  => 'Tonga',
                    'TT'  => 'Trinidad And Tobago',
                    'TN'  => 'Tunisia',
                    'TR'  => 'Turkey',
                    'TM'  => 'Turkmenistan',
                    'TC'  => 'Turks And Caicos Islands',
                    'TV'  => 'Tuvalu',
                    'UG'  => 'Uganda',
                    'UA'  => 'Ukraine',
                    'AE'  => 'United Arab Emirates',
                    'GB'  => 'United Kingdom',
                    'US'  => 'United States',
                    'UM'  => 'United States Outlying Islands',
                    'UY'  => 'Uruguay',
                    'UZ'  => 'Uzbekistan',
                    'VU'  => 'Vanuatu',
                    'VE'  => 'Venezuela',
                    'VN'  => 'Viet Nam',
                    'VG'  => 'Virgin Islands, British',
                    'VI'  => 'Virgin Islands, U.S.',
                    'WF'  => 'Wallis And Futuna',
                    'EH'  => 'Western Sahara',
                    'YE'  => 'Yemen',
                    'ZM'  => 'Zambia',
                    'ZW'  => 'Zimbabwe',
                    'MMK' => 'Myanmar Kyats'
                ];
                $list_country = [];
                foreach ( $countries as $key => $val ) {
                    $list_country [] = [
                        'value' => $key,
                        'label' => $val
                    ];
                }

                if ( $optiontree ) {
                    return $list_country;
                } else {
                    return $countries;
                }
            }

            // from .1.1.9
            static function get_list_name( $post_type = "st_hotel", $max_num = null )
            {

                global $wpdb;
                $table  = $wpdb->posts;
                $join   = "";
                $join   = self::edit_join_wpml( $join, $post_type );
                $where  = " post_type = '{$post_type}' and post_status = 'publish' ";
                $where  = self::edit_where_wpml( $where );
                $sql    = "select {$table}.ID as id , {$table}.post_title as title from {$table} {$join} where 1=1 and $where order by {$table}.post_title ";
                $result = $wpdb->get_results( $sql, ARRAY_A );

                return $result;
            }

            // from 1.2.0
            static function get_all_post_type()
            {
                $post_type = [];
                if ( st_check_service_available( 'st_hotel' ) ) {
                    $post_type[] = "st_hotel";
                    $post_type[] = "hotel_room";
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $post_type[] = "st_tours";
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $post_type[] = "st_rental";
                }
                if ( st_check_service_available( 'st_cars' ) ) {
                    $post_type[] = "st_cars";
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $post_type[] = "st_activity";
                }
                if ( st_check_service_available( 'st_flight' ) ) {
                    $post_type[] = "st_flight";
                }

                return $post_type;

            }

            // from 1.2.0
            static function get_all_post_type_not_in()
            {
                $post_type = [];
                if ( !st_check_service_available( 'st_hotel' ) ) {
                    $post_type[] = "'st_hotel'";
                    $post_type[] = "'hotel_room'";
                }
                if ( !st_check_service_available( 'st_tours' ) ) {
                    $post_type[] = "'st_tours'";
                }
                if ( !st_check_service_available( 'st_rental' ) ) {
                    $post_type[] = "'st_rental'";
                }
                if ( !st_check_service_available( 'st_cars' ) ) {
                    $post_type[] = "'st_cars'";
                }
                if ( !st_check_service_available( 'st_activity' ) ) {
                    $post_type[] = "'st_activity'";
                }
                if ( !st_check_service_available( 'st_flight' ) ) {
                    $post_type[] = "'st_flight'";
                }
                if ( empty( $post_type ) ) {
                    return "('/')";
                } else {
                    return "(" . implode( ',', $post_type ) . ")";
                }
            }

            static function is_https()
            {
                return ( ( !empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' ) || $_SERVER[ 'SERVER_PORT' ] == 443 );
            }

            static function get_room_price( $room_id = false, $start_date, $end_date )
            {

                if ( !$room_id ) $room_id = get_the_ID();
                $list_price = [];

                $price       = 0;
                $number_days = 0;
                if ( $start_date and $end_date ) {
                    $one_day        = ( 60 * 60 * 24 );
                    $str_start_date = strtotime( $start_date );
                    $str_end_date   = strtotime( $end_date );
                    $number_days    = ( $str_end_date - $str_start_date ) / $one_day;

                    $total = 0;
                    for ( $i = 1; $i <= $number_days; $i++ ) {
                        $data_date    = date( "Y-m-d", $str_start_date + ( $one_day * $i ) );
                        $date_tmp     = date( "Y-m-d", strtotime( $data_date ) - ( $one_day ) );
                        $data_price   = get_post_meta( $room_id, 'price', true );
                        $price_custom = self::st_get_custom_price_by_date( $room_id, $data_date );
                        if ( $price_custom ) $data_price = $price_custom;
                        $list_price[ $data_date ] = [
                            'start' => $date_tmp,
                            'end'   => $data_date,
                            'price' => apply_filters( 'st_apply_tax_amount', $data_price )
                        ];
                        $total                    += $data_price;
                    }
                    $price = $total;
                }


                /** get custom price by date **/

                $data_price = [
                    'discount'   => false,
                    'price'      => apply_filters( 'st_apply_tax_amount', $price ),
                    'info_price' => $list_price,
                    'number_day' => $number_days,
                ];

                if ( $price > 0 ) {
                    $discount_rate = get_post_meta( $room_id, 'discount_rate', true );
                    /*$is_sale_schedule=get_post_meta($room_id,'is_sale_schedule',true);

                if($is_sale_schedule=='on')
                {
                    $sale_from=get_post_meta($room_id,'sale_price_from',true);
                    $sale_to=get_post_meta($room_id,'sale_price_to',true);

                    $str_sale_from   = strtotime($sale_from) ;
                    $str_sale_to = strtotime($sale_to);

                    //$str_start_date
                    // discount = 0
                    if (
                        ($str_sale_from and $str_start_date <$str_sale_from)
                        or ($str_sale_to and $str_start_date >$str_sale_to)
                        or ($str_sale_to and $str_sale_from and $str_sale_from<$str_sale_to and $str_start_date <$str_sale_from and $str_start_date >$str_sale_to )
                        or ($str_sale_to and $str_sale_from and $str_sale_from>$str_sale_to)
                        ){
                        $discount_rate = 0;
                    }
                }*/

                    if ( $discount_rate > 100 ) {
                        $discount_rate = 100;
                    }

                    if ( $discount_rate ) {
                        $data_price = [
                            'discount'   => true,
                            'price'      => apply_filters( 'st_apply_tax_amount', $price - ( $price / 100 ) * $discount_rate ),
                            'price_old'  => apply_filters( 'st_apply_tax_amount', $price ),
                            'info_price' => $list_price,
                            'number_day' => $number_days,
                        ];
                    }

                }

                return $data_price;
            }

            static function st_get_custom_price_by_date( $post_id, $start_date = null, $price_type = 'default' )
            {
                global $wpdb;
                if ( !$post_id )
                    $post_id = get_the_ID();
                if ( empty( $start_date ) )
                    $start_date = date( "Y-m-d" );
                $rs = $wpdb->get_results( "SELECT * FROM " . $wpdb->base_prefix . "st_price WHERE post_id=" . $post_id . " AND price_type='" . $price_type . "'  AND start_date <='" . $start_date . "' AND end_date >='" . $start_date . "' AND status=1 ORDER BY priority DESC LIMIT 1" );
                if ( !empty( $rs ) ) {
                    return $rs[ 0 ]->price;
                } else {
                    return false;
                }
            }

            /* from 1.1.8
        * [SEO ] set static size for image
        */
            static function get_attchment_size( $image_url, $link = true )
            {
                if ( !$image_url ) {
                    return;
                }
                global $wpdb;
                if ( $link ) {
                    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
                    if ( $attachment ) {
                        $info = wp_get_attachment_image_src( $attachment[ 0 ], 'full' );

                        return [
                            'id'     => $attachment[ 0 ],
                            'width'  => $info[ 1 ],
                            'height' => $info[ 2 ]
                        ];
                    }
                }

            }

            /** from 1.1.9 . get list menus*/
            static function get_opt_menus()
            {

                $menus = wp_get_nav_menus();
                if ( empty( $menus ) or !is_array( wp_get_nav_menus() ) ) return;
                $menus  = wp_get_nav_menus();
                $return = [];
                foreach ( $menus as $key => $value ) {
                    $return [] = [
                        'label' => $value->name,
                        'value' => $value->slug
                    ];
                }

                return $return;
            }


            static function get_location()
            {
                if ( is_search() || is_page() ) return;
                $post_type = get_post_type( get_the_ID() );
                $array     = [ 'st_hotel', 'st_activity', 'st_rental', 'st_tours' ];
                if ( !in_array( $post_type, $array ) ) return;
                if ( !st_check_service_available( $post_type ) ) {
                    return;
                }
                $location = get_post_meta( get_the_ID(), 'multi_location', true );

                if ( !empty( $location ) ) {
                    $location = explode( ',', $location );
                    $location = $location[ 0 ];
                    $location = explode( "_", $location );
                    $location = $location[ 1 ];
                }
                if ( !$location ) {
                    $location = get_post_meta( get_the_ID(), 'location_id', true );
                }
                if ( !$location ) {
                    $location = get_post_meta( get_the_ID(), 'id_location', true );
                }
                if ( !$location ) return;

                return $location;
            }

            // from 1.1.9 get location and weather
            static function get_location_weather()
            {

                $location = self::get_location();
                if ( !$location ) return;
                $c    = self::get_location_temp();
                $text = "";
                $text .= '<span>' . get_the_title( $location ) . '</span>
                <span class="loc-info-weather-num">' . $c[ 'temp' ] . '</span>
                 ' . $c[ 'icon' ] . ' </p>';

                return $text;
            }

            /**
             * from 1.1.8
             */
            static function edit_where_wpml( $where, $post_type = null )
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    global $wpdb;
                    $current_language = ICL_LANGUAGE_CODE;
                    $where            .= " AND t.language_code = '{$current_language}' ";
                }

                return $where;
            }

            /**
             * from 1.1.8
             */
            static function edit_join_wpml( $join, $post_type )
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    global $wpdb;
                    $and = "";
                    if ( is_array( $post_type ) ) {

                        foreach ( $post_type as $k => $v ) {
                            $and .= "t.element_type = 'post_{$v}' OR ";
                        }
                        $and = substr( $and, 0, -3 );
                    } else {
                        $and = "t.element_type = 'post_{$post_type}'";
                    }

                    $join .= "
                join {$wpdb->prefix}icl_translations as  t ON {$wpdb->posts}.ID = t.element_id AND {$and}
                JOIN {$wpdb->prefix}icl_languages as  l ON t.language_code = l. CODE AND l.active = 1 ";
                }

                return $join;
            }

            static function isset_table( $table_name )
            {
                global $wpdb;
                $table = $wpdb->prefix . $table_name;
                if ( !empty( self::$_check_table_duplicate[ $table_name ] ) ) return true;

                if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {
                    return false;
                }

                return true;
            }

            static function get_commission( $post_id )
            {
                $g_post         = get_post( $post_id );
                $partner_id     = $g_post->post_author;
                $commission     = floatval( st()->get_option( 'partner_commission' ) );
                $admin_packages = STAdminPackages::get_inst();
                $commission     = $admin_packages->get_commission_package( $partner_id, $commission );

                return $commission;
            }

            static function st_admin_notice_post_draft()
            {
                $post_types = [];
                foreach ( [ 'st_hotel', 'st_rental', 'st_cars', 'st_tours', 'st_activity', 'hotel_room', 'rental_room', 'st_flight' ] as $item ) {
                    if ( st_check_service_available( $item ) ) {
                        $post_types[] = $item;
                    }
                }
                $query  = [
                    'post_status'    => 'draft',
                    'posts_per_page' => -1,
                    'post_type'      => $post_types
                ];
                $return = [];
                $posts  = get_posts( $query );
                if ( count( $posts ) ) {
                    foreach ( $posts as $post ) {
                        $return[ $post->post_type ][] = get_the_ID();
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                if ( count( $return ) ) {
                    echo '<div class="updated" style="padding: 15px 10px 5px 10px !important;">';
                    $name = '';
                    foreach ( $return as $key => $item ) {
                        if ( $key == 'st_hotel' ) {
                            $name = count( $item ) > 1 ? __( 'Hotels', ST_TEXTDOMAIN ) : __( 'Hotel', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'st_rental' ) {
                            $name = count( $item ) > 1 ? __( 'Rentals', ST_TEXTDOMAIN ) : __( 'Rental', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'st_cars' ) {
                            $name = count( $item ) > 1 ? __( 'Cars', ST_TEXTDOMAIN ) : __( 'Car', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'st_tours' ) {
                            $name = count( $item ) > 1 ? __( 'Tours', ST_TEXTDOMAIN ) : __( 'Tour', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'st_activity' ) {
                            $name = count( $item ) > 1 ? __( 'Activities', ST_TEXTDOMAIN ) : __( 'Activity', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'hotel_room' ) {
                            $name = count( $item ) > 1 ? __( 'Hotel rooms', ST_TEXTDOMAIN ) : __( 'Hotel room', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'rental_room' ) {
                            $name = count( $item ) > 1 ? __( 'Rental rooms', ST_TEXTDOMAIN ) : __( 'Rental room', ST_TEXTDOMAIN );
                        }
                        if ( $key == 'st_flight' ) {
                            $name = count( $item ) > 1 ? __( 'Flights', ST_TEXTDOMAIN ) : __( 'Flight', ST_TEXTDOMAIN );
                        }
                        echo '<div style="margin-bottom: 5px;">';
                        echo sprintf( __( 'Have %d new %s need check for approved.', ST_TEXTDOMAIN ), count( $item ), $name );
                        echo '<a style="margin-left: 5px;" href="' . admin_url( 'edit.php?post_status=draft&post_type=' . $key ) . '" target="_blank">' . __( 'Click Here', ST_TEXTDOMAIN ) . '!</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }

            /**
             * @since 1.2.0
             *        remove from 1.2.2
             **/
            static function st_admin_notice_update_location()
            {
                global $wpdb;
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $sql = "SELECT
                    {$wpdb->prefix}posts.*
                FROM
                    {$wpdb->prefix}posts
                LEFT JOIN {$wpdb->prefix}postmeta ON (
                    {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                    AND {$wpdb->prefix}postmeta.meta_key = 'level_location'
                )
                JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
                AND t.element_type = 'post_location'
                JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
                AND l.active = 1
                WHERE
                    1 = 1
                AND ({$wpdb->prefix}postmeta.post_id IS NULL)
                AND {$wpdb->prefix}posts.post_type = 'location'
                AND (
                    {$wpdb->prefix}posts.post_status = 'publish'
                    OR {$wpdb->prefix}posts.post_status = 'future'
                    OR {$wpdb->prefix}posts.post_status = 'draft'
                    OR {$wpdb->prefix}posts.post_status = 'pending'
                    OR {$wpdb->prefix}posts.post_status = 'private'
                )
                AND t.language_code = '" . ICL_LANGUAGE_CODE . "'
                GROUP BY
                    {$wpdb->prefix}posts.ID
                ORDER BY
                    {$wpdb->prefix}posts.post_date DESC";
                } else {
                    $sql = "SELECT
                    {$wpdb->prefix}posts.*
                FROM
                    {$wpdb->prefix}posts
                LEFT JOIN {$wpdb->prefix}postmeta ON (
                    {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
                    AND {$wpdb->prefix}postmeta.meta_key = 'level_location'
                )
                WHERE
                    1 = 1
                AND ({$wpdb->prefix}postmeta.post_id IS NULL)
                AND {$wpdb->prefix}posts.post_type = 'location'
                AND (
                    {$wpdb->prefix}posts.post_status = 'publish'
                    OR {$wpdb->prefix}posts.post_status = 'future'
                    OR {$wpdb->prefix}posts.post_status = 'draft'
                    OR {$wpdb->prefix}posts.post_status = 'pending'
                    OR {$wpdb->prefix}posts.post_status = 'private'
                )
                GROUP BY
                    {$wpdb->prefix}posts.ID
                ORDER BY
                    {$wpdb->prefix}posts.post_date DESC";
                }
                $posts = $wpdb->get_results( $sql );

                $count = count( $posts );

                $name = ( $count > 1 ) ? __( 'Locations', ST_TEXTDOMAIN ) : __( 'Location', ST_TEXTDOMAIN );
                if ( $count >= 1 ):
                    echo '<div class="updated">';
                    echo '<p>';
                    echo sprintf( __( 'Have %d %s need to update for google maps search.', ST_TEXTDOMAIN ), $count, $name );
                    echo '<a style="margin-left: 5px;" href="' . admin_url( 'edit.php?post_type=location&st_update_glocation' ) . '" target="_blank">' . __( 'Click Here', ST_TEXTDOMAIN ) . '!</a>';
                    echo '</p>';
                    echo '</div>';
                endif;
            }

            static function st_admin_notice_user_partner_check_approved()
            {
                $query              = [
                    'role'       => 'Subscriber',
                    'meta_key'   => 'st_pending_partner',
                    'meta_value' => '1'
                ];
                $user_query         = new WP_User_Query( $query );
                $data_user_register = $user_query->results;

                $query                         = [
                    'role'       => 'partner',
                    'meta_key'   => 'st_pending_partner',
                    'meta_value' => '2'
                ];
                $user_query                    = new WP_User_Query( $query );
                $data_user_update_certificates = $user_query->results;
                if ( count( $data_user_register ) > 0 or count( $data_user_update_certificates ) > 0 ) {
                    echo '<div class="updated">';
                    echo '<p>';
                    if ( count( $data_user_register ) > 0 ) {
                        echo sprintf( __( 'Have %d new user partner need check for approved.', ST_TEXTDOMAIN ), count( $data_user_register ) );
                        echo '<a style="margin-left: 5px;" href="' . admin_url( 'admin.php?page=st-users-list-partner-menu&st_tab=partner_pending' ) . '" target="_blank">' . __( 'Click Here', ST_TEXTDOMAIN ) . '!</a><br>';
                    }
                    if ( count( $data_user_update_certificates ) > 0 ) {
                        echo sprintf( __( 'Have %d new user partner update certificates need check for approved.', ST_TEXTDOMAIN ), count( $data_user_update_certificates ) );
                        echo '<a style="margin-left: 5px;" href="' . admin_url( 'admin.php?page=st-users-list-partner-menu&st_tab=partner_update' ) . '" target="_blank">' . __( 'Click Here', ST_TEXTDOMAIN ) . '!</a><br>';
                    }
                    echo '</p>';
                    echo '</div>';
                }
            }

            static function getPostIdOrigin( $post_id )
            {
                global $sitepress;
                if ( $sitepress ) {
                    $lang_code = $sitepress->get_default_language();
                    if ( $lang_code ) {
                        $post_type = get_post_type( $post_id );
                        $origin_id = icl_object_id( $post_id, $post_type, true, $lang_code );
                    } else {
                        $origin_id = $post_id;
                    }
                } else {
                    $origin_id = $post_id;
                }

                return $origin_id;
            }

            static function st_welcome_user( $user_id, $deprecated = null, $notify = '' )
            {
                global $wpdb, $wp_hasher;
                $user = get_userdata( $user_id );

                $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

                $message = sprintf( __( 'New user registration on your site %s:' ), $blogname ) . "\r\n\r\n";
                $message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
                $message .= sprintf( __( 'E-mail: %s' ), $user->user_email ) . "\r\n";

                @wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration' ), $blogname ), $message );

                if ( 'admin' === $notify || empty( $notify ) ) {
                    return;
                }

                $key = wp_generate_password( 20, false );

                if ( empty( $wp_hasher ) ) {
                    require_once ABSPATH . WPINC . '/class-phpass.php';
                    $wp_hasher = new PasswordHash( 8, true );
                }
                $hashed = time() . ':' . $wp_hasher->HashPassword( $key );
                $wpdb->update( $wpdb->users, [ 'user_activation_key' => $hashed ], [ 'user_login' => $user->user_login ] );

                $message = sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
                $message .= __( 'To set your password, visit the following address:' ) . "\r\n\r\n";
                $message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . ">\r\n\r\n";

                $message .= wp_login_url() . "\r\n";

                @wp_mail( $user->user_email, sprintf( __( '[%s] Your username and password info' ), $blogname ), $message );
            }

            /**
             *
             *
             * @since 1.2.0
             * */
            static function st_get_template_footer( $post_id ,$new_layout="")
            {
                //default
                if ($new_layout) {
                    $footer_template = st()->get_option('footer_template_new');

                    return $footer_template;
                }
                $footer_template = st()->get_option( 'footer_template' );
                //custom is single or page
                if ( is_singular() ) {
                    if ( $meta = get_post_meta( get_the_ID(), 'footer_template', true ) ) {
                        $footer_template = $meta;
                    }
                }
                //custom is hotel rental room tours activity cars
                $post_type = get_post_type( $post_id );
                switch ( $post_type ) {
                    case "st_hotel":
                        $detail_layout = apply_filters( 'st_hotel_detail_layout', st()->get_option( 'hotel_single_layout' ) );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                    case "hotel_room":
                        $detail_layout = st()->get_option( 'hotel_single_room_layout', '' );
                        if ( get_post_meta( get_the_ID(), 'st_custom_layout', true ) ) $detail_layout = get_post_meta( get_the_ID(), 'st_custom_layout', true );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                    case "st_rental":
                        $detail_layout = apply_filters( 'rental_single_layout', st()->get_option( 'rental_single_layout' ) );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                    case "rental_room":
                        $detail_layout = st()->get_option( 'rental_room_layout', '' );
                        if ( get_post_meta( get_the_ID(), 'st_custom_layout', true ) ) $detail_layout = get_post_meta( get_the_ID(), 'st_custom_layout', true );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                    case "st_tours":
                        $detail_layout = apply_filters( 'st_tours_detail_layout', st()->get_option( 'tours_layout' ) );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;

                    case "st_activity":
                        $detail_layout = apply_filters( 'st_activity_detail_layout', st()->get_option( 'activity_layout' ) );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                    case "st_cars":
                        $detail_layout = apply_filters( 'st_cars_detail_layout', st()->get_option( 'cars_single_layout' ) );
                        if ( $custom = get_post_meta( $detail_layout, 'footer_template', true ) ) {
                            $footer_template = $custom;
                        }
                        break;
                }

                return $footer_template;

            }

            /**
             * @since 1.2.0
             *
             **/
            static function get_owner_email( $item_id )
            {
                $to = '';
                if ( get_post_type( $item_id ) == 'st_hotel' ) {
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $item_id, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_hotel = get_post( $item_id );
                    $user_id   = $obj_hotel->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'st_rental' ) {
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $item_id, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_post = get_post( $item_id );
                    $user_id  = $obj_post->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'agent_email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'st_tours' ) {
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $item_id, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_post = get_post( $item_id );
                    $user_id  = $obj_post->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'contact_email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'st_activity' ) {
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $item_id, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_post = get_post( $item_id );
                    $user_id  = $obj_post->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'contact_email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'st_cars' ) {
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $item_id, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_post = get_post( $item_id );
                    $user_id  = $obj_post->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'cars_email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'rental_room' ) {
                    $room_parent = get_post_meta( $item_id, 'room_parent', true );
                    /**
                     * update 1.2.4 by quandq
                     */
                    $theme_option   = st()->get_option( 'partner_show_contact_info' );
                    $metabox        = get_post_meta( $room_parent, 'show_agent_contact_info', true );
                    $use_agent_info = false;
                    if ( $theme_option == 'on' ) $use_agent_info = true;
                    if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                    if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                    $obj_post = get_post( $room_parent );
                    $user_id  = $obj_post->post_author;
                    if ( $use_agent_info ) {
                        $to = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $to = get_post_meta( $item_id, 'agent_email', true );
                    }
                } elseif ( get_post_type( $item_id ) == 'hotel_room' ) {
                    $room_parent = get_post_meta( $item_id, 'room_parent', true );
                    if ( empty( $room_parent ) ) {
                        $obj_hotel = get_post( $item_id );
                        $user_id   = $obj_hotel->post_author;
                        $to        = get_the_author_meta( 'user_email', $user_id );
                    } else {
                        $theme_option   = st()->get_option( 'partner_show_contact_info' );
                        $metabox        = get_post_meta( $room_parent, 'show_agent_contact_info', true );
                        $use_agent_info = false;
                        if ( $theme_option == 'on' ) $use_agent_info = true;
                        if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                        if ( $metabox == 'user_item_info' ) $use_agent_info = false;
                        $obj_hotel = get_post( $room_parent );
                        $user_id   = $obj_hotel->post_author;
                        if ( $use_agent_info ) {
                            $to = get_the_author_meta( 'user_email', $user_id );
                        } else {
                            $to = get_post_meta( $room_parent, 'email', true );
                        }
                    }


                }

                return $to;
            }

            /**
             * @since 1.2.0
             **/

            static function st_approved_item( $author, $post )
            {
                if ( st()->get_option( 'enable_email_approved_item', 'off' ) == 'off' ) return false;
                $to      = self::get_owner_email( $post->ID );
                $subject = st()->get_option( 'email_approved_subject', '' );

                global $author_approved, $post_approved;
                $author_approved = $author;
                $post_approved   = $post;

                $email_approved = st()->get_option( 'email_approved', '' );

                $message = TravelHelper::_get_template_email( '', $email_approved );

                $check = self::_send_mail( $to, $subject, $message );

                return $check;
            }

            static function _send_mail( $to, $subject, $message, $attachment = false )
            {

                if ( !$message ) return [
                    'status'  => false,
                    'data'    => '',
                    'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                ];
                $from         = st()->get_option( 'email_from' );
                $from_address = st()->get_option( 'email_from_address' );
                $headers      = [];

                if ( $from and $from_address ) {
                    $headers[] = 'From:' . $from . ' <' . $from_address . '>';
                }

                add_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );

                $check = @wp_mail( $to, $subject, $message, $headers, $attachment );

                remove_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );

                return [
                    'status' => $check,
                    'data'   => [
                        'to'      => $to,
                        'subject' => $subject,
                        'message' => $message,
                        'headers' => $headers
                    ]
                ];
            }

            static function set_html_content_type()
            {
                return 'text/html';
            }

            /**
             * @since 1.2.0
             **/
            static function _st_get_where_location( $location_id, $post_type, $where )
            {
                global $wpdb;

                if ( (int)$location_id > 0 && is_array( $post_type ) ) {
                    $ns = new Nested_set();
                    $ns->setControlParams( $wpdb->prefix . 'st_location_nested' );

                    $post_type_in = "";
                    foreach ( $post_type as $item ) {
                        $post_type_in .= "'" . $item . "',";
                    }
                    $post_type_in = substr( $post_type_in, 0, -1 );

                    $locations = [];

                    if ( is_array( $location_id ) ) {
                        foreach ( $location_id as $location ) {
                            $node = $ns->getNodeWhere( "location_id = " . (int)$location );

                            if ( !empty( $node ) ) {
                                $leftval     = (int)$node[ 'left_key' ];
                                $rightval    = (int)$node[ 'right_key' ];
                                $node_childs = $ns->getNodesWhere( "left_key >= " . $leftval . " AND right_key <= " . $rightval );
                                if ( !empty( $node_childs ) ) {
                                    foreach ( $node_childs as $item ) {
                                        $locations[] = (int)$item[ 'location_id' ];
                                    }
                                } else {
                                    $locations[] = (int)$node[ 'location_id' ];
                                }
                            }
                        }
                    } elseif ( count( explode( ',', $location_id ) ) > 1 ) {
                        $location_tmp = explode( ',', $location_id );
                        foreach ( $location_tmp as $k => $v ) {
                            $node = $ns->getNodeWhere( "location_id = " . $v );
                            if ( !empty( $node ) ) {
                                $leftval     = (int)$node[ 'left_key' ];
                                $rightval    = (int)$node[ 'right_key' ];
                                $node_childs = $ns->getNodesWhere( "left_key >= " . $leftval . " AND right_key <= " . $rightval );
                                if ( !empty( $node_childs ) ) {
                                    foreach ( $node_childs as $item ) {
                                        $locations[] = (int)$item[ 'location_id' ];
                                    }
                                } else {
                                    $locations[] = (int)$node[ 'location_id' ];
                                }
                            }

                        }
                    } else {
                        $node = $ns->getNodeWhere( "location_id = " . $location_id );
                        if ( !empty( $node ) ) {
                            $leftval     = (int)$node[ 'left_key' ];
                            $rightval    = (int)$node[ 'right_key' ];
                            $node_childs = $ns->getNodesWhere( "left_key >= " . $leftval . " AND right_key <= " . $rightval );
                            if ( !empty( $node_childs ) ) {
                                foreach ( $node_childs as $item ) {
                                    $locations[] = (int)$item[ 'location_id' ];
                                }
                            } else {
                                $locations[] = (int)$node[ 'location_id' ];
                            }
                        }
                    }


                    $where_location = " 1=1 ";
                    if ( !empty( $locations ) ) {
                        $where_location .= " AND location_from IN (";
                        $string         = "";
                        foreach ( $locations as $location ) {

                            $string .= "'" . $location . "',";
                        }
                        $string         = substr( $string, 0, -1 );
                        $where_location .= $string . ")";
                    } else {
                        $where_location .= " AND location_from IN ('{$location_id}') ";
                    }

                    if ( !empty( $post_type_in ) ) {
                        $where_location .= " AND post_type IN ({$post_type_in})";
                    }

                    $where .= " AND {$wpdb->prefix}posts.ID IN (SELECT post_id FROM {$wpdb->prefix}st_location_relationships WHERE " . $where_location . ")";

                }

                return $where;
            }

            static function get_minify_locale( $locale )
            {
                $locale_array = explode( '_', str_replace( "-", "_", $locale ) );

                return $locale_array[ 0 ];
            }

            static function get_input_multilingual_wpml()
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) /*and !get_option('permalink_structure')*/ ) {
                    return '<input type="hidden" name="lang" value="' . ICL_LANGUAGE_CODE . '">';
                }
            }

            /**
             * @since 1.2.8
             * @using for filter search
             **/
            static function list_tree_tax_search( $taxonomy = 'category', $parent = 0, $level = 0, $post_type = 'post', &$term_parent = '' )
            {
                $key   = $taxonomy;
                $terms = get_terms( $taxonomy, [ 'hide_empty' => false, 'parent' => $parent ] );
                if ( !empty( $terms ) and !is_wp_error( $terms ) ):
                    $level += 1;
                    foreach ( $terms as $key2 => $value2 ) {
                        if ( $post_type == 'hotel_room' ) {
                            $name_field = "taxonomy_hotel_room";
                        } else {
                            $name_field = "taxonomy";
                        }

                        $current = STInput::get( $name_field );

                        if ( isset( $current[ $key ] ) )
                            $current = $current[ $key ];
                        else $current = '';


                        $checked = TravelHelper::checked_array( explode( ',', $current ), $value2->term_id );

                        $list_term = get_term_children( $value2->term_id, $taxonomy );

                        $string_term = [ $value2->term_id ];

                        if ( $checked ) {
                            $link = TravelHelper::build_url_array_tree( $name_field, $key, $string_term, false, $post_type );
                        } else {
                            if ( !empty( $list_term ) ) {
                                foreach ( $list_term as $term ) {
                                    $string_term[] = $term;
                                }
                            }

                            $link = TravelHelper::build_url_array_tree( $name_field, $key, $string_term, true, $post_type );
                        }

                        $link = preg_replace( "/page\/\d\//", "", $link );

                        if ( $level == 0 ) {
                            $term_parent = $value2->term_id;
                        }
                        if ( $level > 0 ) {
                            echo '<div class="tax-child" data-parent="' . $term_parent . '">';
                        }
                        ?>
                        <div class="checkbox" style="margin-left: <?php echo ( 22 * $level ) . 'px'; ?>">
                            <label>
                                <input <?php if ( $checked ) echo "checked"; ?> value="<?php echo $value2->term_id; ?>"
                                                                                name=""
                                                                                data-url="<?php echo esc_url( $link ) ?>"
                                                                                class="i-check i-check-tax"
                                                                                type="checkbox"/> <?php echo esc_html( $value2->name ) ?>
                            </label>
                        </div>
                        <?php
                        self::list_tree_tax_search( $taxonomy, $value2->term_id, $level, $post_type, $term_parent );
                        if ( $level > 0 ) {
                            echo '</div>';
                        }
                    }
                endif;
            }

            /**
             * xsearch
             * Filter - Filter by taxonomy
             * @since 1.2.8
             * @using for filter search
             **/
            static function list_tree_tax_search_ajax( $taxonomy = 'category', $parent = 0, $level = 0, $post_type = 'post', &$term_parent = '' )
            {
                $key   = $taxonomy;
                $terms = get_terms( $taxonomy, [ 'hide_empty' => false, 'parent' => $parent ] );
                if ( !empty( $terms ) ):
                    $level += 1;
                    foreach ( $terms as $key2 => $value2 ) {
                        if ( $post_type == 'hotel_room' ) {
                            $name_field = "taxonomy_hotel_room";
                        } else {
                            $name_field = "taxonomy";
                        }

                        $current = STInput::get( $name_field );

                        if ( isset( $current[ $key ] ) )
                            $current = $current[ $key ];
                        else $current = '';

                        $checked = TravelHelper::checked_array( explode( ',', $current ), $value2->term_id );

                        $list_term = get_term_children( $value2->term_id, $taxonomy );

                        $string_term = [ $value2->term_id ];

                        if ( $checked ) {
                            $link = TravelHelper::build_url_array_tree( $name_field, $key, $string_term, false, $post_type );
                        } else {
                            if ( !empty( $list_term ) ) {
                                foreach ( $list_term as $term ) {
                                    $string_term[] = $term;
                                }
                            }

                            $link = TravelHelper::build_url_array_tree( $name_field, $key, $string_term, true, $post_type );
                        }

                        $link = preg_replace( "/page\/\d\//", "", $link );

                        if ( $level == 0 ) {
                            $term_parent = $value2->term_id;
                        }
                        if ( $level > 0 ) {
                            echo '<div class="tax-child" data-parent="' . $term_parent . '">';
                        }
                        ?>
                        <div style="margin-left: <?php echo ( 22 * $level ) . 'px'; ?>"
                             class="checkbox-filter-ajax <?php if ( $checked ) echo "active"; ?>" data-tax="taxonomy"
                             data-type="<?php echo $taxonomy; ?>" data-value="<?php echo $value2->term_id; ?>"><span
                                    class="checkbox-yes"><i class="fa fa-check" aria-hidden="true"></i></span></div>
                        <div class="ajax-tax-name"><?php echo esc_html( $value2->name ) ?></div>
                        <?php
                        self::list_tree_tax_search_ajax( $taxonomy, $value2->term_id, $level, $post_type, $term_parent );
                        if ( $level > 0 ) {
                            echo '</div>';
                        }
                    }
                endif;
            }

            static function st_encrypt( $string = '' )
            {
                return md5( md5( 'st-' . md5( $string ) ) );
            }

            static function st_compare_encrypt( $string = '', $encrypt = '' )
            {
                if ( empty( $string ) || empty( $encrypt ) ) {
                    return false;
                }

                if ( md5( md5( 'st-' . md5( $string ) ) ) == $encrypt ) {
                    return true;
                }

                return false;
            }

            static function get_price_refund_for_partner( $price, $cancel_data, $commission )
            {
                if ( isset( $cancel_data ) && !empty( $cancel_data ) ) {
                    return $price - ( $price * $commission / 100 );
                }

                return $price;
            }

            static function _get_currency_book_history( $post_id )
            {
                $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );
                if ( $st_is_woocommerce_checkout ) {
                    global $wpdb;
                    $querystr    = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$post_id}'
                                    AND meta_key = '_st_currency'";
                    $st_currency = $wpdb->get_row( $querystr, OBJECT );
                    if ( !empty( $st_currency->meta_value ) ) {
                        return $st_currency->meta_value;
                    }
                } else {
                    $currency = get_post_meta( $post_id, 'currency', true );
                    if ( isset( $currency[ 'symbol' ] ) ) {
                        return $currency[ 'symbol' ];
                    }
                }

                return null;
            }

            static function is_wpml()
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    return true;
                }

                return false;
            }

            static function current_lang()
            {
                $lang = '';
                if ( self::is_wpml() ) {
                    global $sitepress;
                    $lang = $sitepress->get_current_language();
                }

                return $lang;
            }

            static function get_user_dashboared_link( $url = '', $link )
            {
                global $wp_rewrite;
                if ( $wp_rewrite->using_permalinks() && st()->get_option( 'enable_pretty_link_partner', 'off' ) == 'on' ) {
                    $pos = strpos( $url, '?lang=' );
                    if ( $pos ) {
                        $url = str_replace( '?lang=', $link . '/?lang=', $url );
                    } else {
                        $url = $url . $link;
                    }

                    return $url;
                } else {
                    $url = add_query_arg( 'sc', $link, $url );

                    return $url;
                }
            }

            static function get_services()
            {
                return apply_filters( 'st_all_services', [ 'st_hotel' => 'fa-building-o', 'hotel_room' => 'fa-building-o', 'st_rental' => 'fa-home', 'st_tours' => 'fa-flag-o', 'st_activity' => 'fa-bolt', 'st_cars' => 'fa-car' ] );
            }

            static function is_service_search()
            {
                if ( is_search() or is_page_template( 'template-tour-search.php' )
                    or is_page_template( 'template-hotel-search.php' )
                    or is_page_template( 'template-hotel-room-search.php' )
                    or is_page_template( 'template-cars-search.php' )
                    or is_page_template( 'template-activity-search.php' )
                    or is_page_template( 'template-rental-search.php' )
                ) {
                    return true;
                }

                return false;
            }

            /**
             * @since 1.3.1
             *        get_object_taxonomies
             **/
            static function get_object_taxonomies_service( $post_type = 'st_hotel', $vc = false )
            {
                $return = [];
                $tax    = get_object_taxonomies( $post_type, 'object' );
                if ( !empty( $tax ) ) {
                    foreach ( $tax as $name => $data ) {
                        $return[ $name ] = $data->labels->name;
                    }
                }

                return $return;
            }


            /**
             * @since 1.3.1
             **/
            static function get_member_packages( $where = '' )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_member_packages';
                $sql   = "SELECT * FROM {$table} WHERE 1=1 {$where}";

                return $wpdb->get_results( $sql );
            }

            /**
             * @since 1.3.1
             **/
            static function has_member_package( $user_id )
            {
                global $wpdb;

            }

            static function get_alt_image( $image_id = null )
            {
                $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                if ( !$alt ) {
                    $alt = get_bloginfo( 'description' );
                }

                return $alt;
            }

            static function get_list_all_item_in_services( $post_type, $q = null )
            {
                $list = [];
                switch ( $post_type ) {
                    case 'nav_menu':
                        $args = [ 'hide_empty' => true ];
                        if ( !empty( $q ) )
                            $args[ 'name__like' ] = $q;
                        $nav_menu = get_terms( 'nav_menu', $args );
                        if ( !empty( $nav_menu ) ) {
                            foreach ( $nav_menu as $k => $v ) {
                                $list[] = [
                                    'value' => $v->slug,
                                    'label' => $v->name,
                                ];
                            }
                        }
                        break;
                    case 'travel_payout':
                        $list = self::get_pages_travelpayouts_api();
                        break;
                    default:
                        $args = [ 'post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => 'publish' ];
                        if ( !empty( $q ) )
                            $args[ 's' ] = $q;
                        query_posts( $args );
                        while ( have_posts() ) {
                            the_post();
                            $list[] = [
                                'value' => get_the_ID(),
                                'label' => get_the_title(),
                            ];
                        }
                        wp_reset_query();
                        break;
                }

                return $list;
            }

            static function get_pages_travelpayouts_api()
            {
                global $post;
                $page_list   = [];
                $page_list[] = [
                    'value' => '',
                    'label' => esc_html__( '-- Choose One --', ST_TEXTDOMAIN )
                ];
                $args        = [
                    'post_type'      => 'page',
                    'posts_per_page' => -1,
                ];
                $query       = new WP_Query( $args );
                if ( $query->have_posts() ): while ( $query->have_posts() ):$query->the_post();
                    $tem = get_page_template_slug( $post->ID );
                    if ( $tem == 'template-tp-flights-search.php' ) {
                        $page_list[] = [
                            'value' => $post->ID,
                            'label' => $post->post_title
                        ];
                    }
                endwhile;
                endif;
                wp_reset_postdata();
                wp_reset_query();

                return $page_list;
            }

            static function wc_let_to_num( $size )
            {
                $l   = substr( $size, -1 );
                $ret = substr( $size, 0, -1 );
                switch ( strtoupper( $l ) ) {
                    case 'P':
                        $ret *= 1024;
                    case 'T':
                        $ret *= 1024;
                    case 'G':
                        $ret *= 1024;
                    case 'M':
                        $ret *= 1024;
                    case 'K':
                        $ret *= 1024;
                }

                return $ret;
            }

            static function post_origin( $post_id, $post_type = 'post' )
            {
                if ( self::is_wpml() ) {
                    global $sitepress;

                    return apply_filters( 'wpml_object_id', $post_id, $post_type, true, $sitepress->get_default_language() );
                } else {
                    return $post_id;
                }
            }

            static function transferDestinationOption()
            {
                $return   = [];
                $return[] = [
                    'label' => __( '---- Select ----', ST_TEXTDOMAIN ),
                    'value' => ''
                ];

                $car_by_location = st()->get_option( 'car_transfer_by_location', 'off' );

                $transfers = self::transferDestination();

                if ( empty( $transfers ) ) {
                    return $return;
                }

                if ( $car_by_location == 'off' ) {
                    foreach ( $transfers as $transfer ) {
                        $name     = ( $transfer[ 'type' ] == 'hotel' ) ? __( 'Hotel: ', ST_TEXTDOMAIN ) : __( 'Airport: ', ST_TEXTDOMAIN );
                        $return[] = [
                            'label' => $name . $transfer[ 'name' ],
                            'value' => $transfer[ 'id' ]
                        ];
                    }
                } else {
                    foreach ( $transfers as $transfer ) {
                        $char = '';
                        if ( $transfer[ 'level' ] > 1 ) {
                            for ( $i = 0; $i < $transfer[ 'level' ]; $i++ ) {
                                $char .= '-';
                            }
                        }
                        $return[] = [
                            'label' => $char . $transfer[ 'name' ],
                            'value' => $transfer[ 'id' ]
                        ];
                    }
                }

                return $return;
            }

            /*
        * @since 2.0.1
        */
            static function transferDestination()
            {
                $return = [];

                $car_by_location = st()->get_option( 'car_transfer_by_location', 'off' );

                if ( $car_by_location == 'off' ) {
                    $args = [
                        'post_type'      => 'st_hotel',
                        'posts_per_page' => -1,
                        'orderby'        => 'title',
                        'order'          => 'ASC',
                        'post_status'    => [ 'publish', 'private' ]
                    ];

                    $query = new WP_Query( $args );
                    while ( $query->have_posts() ): $query->the_post();
                        $return[] = [
                            'id'      => get_the_ID(),
                            'name'    => get_the_title(),
                            'address' => get_post_meta( get_the_ID(), 'address', true ),
                            'type'    => 'hotel'
                        ];
                    endwhile;
                    wp_reset_postdata();

                    $terms = get_terms( [
                        'taxonomy'   => 'st_airport',
                        'hide_empty' => false,
                    ] );

                    if ( !is_wp_error( $terms ) ) {
                        $airport_ids = [];
                        foreach ( $terms as $term ) {
                            array_push( $airport_ids, $term->term_id );
                        }

                        if ( !empty( $airport_ids ) ) {
                            $term_data = ST_Flight_Location_Models::inst()->get_data( $airport_ids );
                            if ( $term_data ) {
                                foreach ( $terms as $term ) {
                                    if ( array_key_exists( $term->term_id, $term_data ) ) {
                                        $return[] = [
                                            'id'      => $term->term_id,
                                            'name'    => $term->name,
                                            'address' => $term_data[ $term->term_id ][ 'map_address' ],
                                            'type'    => 'airport'
                                        ];
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $locations = TravelHelper::treeLocationHtml();
                    if ( !empty( $locations ) ) {
                        foreach ( $locations as $k => $v ) {
                            $return[] = [
                                'id'      => $v[ 'ID' ],
                                'name'    => $v[ 'post_title' ],
                                'address' => '',
                                'type'    => 'location',
                                'level'   => $v[ 'level' ] / 20
                            ];
                        }
                    }
                }

                return $return;
            }

            static function setcookie( $name, $value, $expire = 0, $secure = false )
            {
                setcookie( $name, $value, $expire, '/', null, null );
            }

            static function buildTree( array &$elements, $parentId = 1 )
            {
                $branch = [];

                foreach ( $elements as $element ) {
                    if ( $element[ 'parent_id' ] == $parentId ) {
                        $children = self::buildTree( $elements, $element[ 'post_id' ] );
                        if ( $children ) {
                            $element[ 'children' ] = $children;
                        }
                        $branch[ $element[ 'post_title' ] ] = $element;
                        unset( $elements[ $element[ 'post_id' ] ] );
                    }
                }

                return $branch;
            }

            static function recursiveKeySort( &$by_ref_array )
            {
                ksort( $by_ref_array );
                foreach ( $by_ref_array as $key => $value ) {
                    if ( isset( $value[ 'children' ] ) ) {
                        self::recursiveKeySort( $value[ 'children' ] );
                        $by_ref_array[ $key ][ 'children' ] = $value[ 'children' ];
                    }
                    $by_ref_array[ $key ] = $value;
                }

                return $by_ref_array;
            }

            static function buildTreeHasSort( $lists )
            {
                $arr = [];
                if ( !empty( $lists ) ) {
                    $lists_temp = $lists;
                    unset( $lists );
                    foreach ( $lists_temp as $k => $v ) {
                        $lists[ $v->post_title ] = (array)$v;
                    }
                    $lists = self::buildTree( $lists );
                    self::recursiveKeySort( $lists );

                    return $lists;
                } else {
                    return $arr;
                }
            }

            static function buildTreeOptionLocation( $locations, $location_id )
            {
                if ( is_array( $locations ) && count( $locations ) ):
                    foreach ( $locations as $key => $value ):
                        $level = 0;
                        if ( $value[ 'lv' ] == 2 ) {
                            $level = $value[ 'lv' ] * 10;
                        }
                        if ( $value[ 'lv' ] > 2 ) {
                            $level = $value[ 'lv' ] * 10 + ( ( $value[ 'lv' ] - 2 ) * 10 );
                        }
                        ?>
                        <option data-style="padding-left: <?php echo $level . 'px;'; ?>" <?php selected( $value[ 'ID' ], $location_id ); ?>
                                data-country="<?php echo $value[ 'Country' ]; ?>"
                                value="<?php echo $value[ 'ID' ]; ?>"><?php echo $value[ 'post_title' ]; ?></option>
                        <?php
                        if ( isset( $value[ 'children' ] ) ) {
                            if ( is_array( $value[ 'children' ] ) ) {
                                self::buildTreeOptionLocation( $value[ 'children' ], $location_id );
                            }
                        }
                    endforeach;
                endif;
            }

            static function get_current_available_calendar( $post_id )
            {
                if ( !empty( $post_id ) ) {
                    $max_people = get_post_meta( $post_id, 'max_people', true );
                    if ( empty( $max_people ) )
                        $max_people = 0;
                    $data_availbility = AvailabilityHelper::get_current_availability( $post_id, $max_people );

                    return $data_availbility;
                }

                return date( 'Y-m-d' );
            }

            static function change_author_base()
            {
                global $wp_rewrite;
                $author_base             = get_option( 'author_permalink', 'author' );
                $wp_rewrite->author_base = $author_base;
            }

            static function get_ids_selected_tour_package( $packages, $type = 'car' )
            {
                $ids = [];
                if ( $type == 'hotel' ) {
                    if ( !empty( $packages ) ) {
                        foreach ( $packages as $k => $v ) {
                            array_push( $ids, $k );
                        }
                    }
                } elseif ( $type == 'car' ) {
                    if ( !empty( $packages ) ) {
                        foreach ( $packages as $k => $v ) {
                            $ids[ $k ] = $v[ 0 ];
                        }
                    }
                } elseif ( $type == 'flight' ) {
                    if ( !empty( $packages ) ) {
                        foreach ( $packages as $k => $v ) {
                            $v_temp   = $k;
                            $arr_temp = json_decode( wp_unslash( $v[ 0 ] ) );
                            if ( is_object( $arr_temp ) ) {
                                $v_temp .= '_' . $arr_temp->flight_price_type;
                            }
                            array_push( $ids, $v_temp );
                        }
                    }
                }

                return $ids;
            }

            static function parser_default_order_by_search_result( $orderby, $sortby )
            {
                $order_string = '';
                if ( $orderby == '' || !isset( $orderby ) ) {
                    $orderby = 'new';
                }
                switch ( $orderby ) {
                    case 'new':
                        $order_string = 'new';
                        break;
                    case 'random':
                        $order_string = 'rand';
                        break;
                    case 'price':
                        if ( $sortby == 'asc' ) {
                            $order_string = 'price_asc';
                        } else {
                            $order_string = 'price_desc';
                        }
                        break;
                    case 'featured':
                        $order_string = 'featured';
                        break;
                    case 'name':
                        if ( $sortby == 'asc' ) {
                            $order_string = 'name_z_a';
                        } else {
                            $order_string = 'name_a_z';
                        }
                        break;
                    default:
                        $order_string = 'new';
                        break;
                }

                return $order_string;
            }

            static function _parser_orderby_key( $orderby )
            {
                $arr_key_orderby = [];
                if ( !empty( $orderby ) ) {
                    foreach ( $orderby as $k => $v ) {
                        array_push( $arr_key_orderby, $k );
                    }
                }

                return $arr_key_orderby;
            }

            static function _get_template_email( $email_str, $template )
            {
                $enable_header = st()->get_option( 'email_head_foot_on_off', 'off' );
                if ( $enable_header == 'on' ) {
                    $email_header = st()->get_option( 'email_header', '' );
                    $email_footer = st()->get_option( 'email_footer', '' );
                    $email_str    .= do_shortcode( $email_header );
                    $email_str    .= do_shortcode( $template );
                    $email_str    .= do_shortcode( $email_footer );
                } else {
                    $email_str .= do_shortcode( $template );
                }

                return $email_str;
            }

            static function getNamePropertyByID( $field )
            {
                $name        = '';
                $id_property = st()->get_option( $field[ 'id' ], '' );
                if ( !empty( $id_property ) ) {
                    switch ( $field[ 'sparam' ] ) {
                        case 'page';
                        case 'layout':
                            $name = get_the_title( $id_property );
                            break;
                        case 'sidebar':
                            $data_sidebar = $GLOBALS[ 'wp_registered_sidebars' ];
                            if ( isset( $data_sidebar[ $id_property ] ) ) {
                                $name = $data_sidebar[ $id_property ][ 'name' ];
                            }
                            break;
                        case 'posttype_select':
                            switch ( $field[ 'post_type' ] ) {
                                case 'nav_menu':
                                    $menu_obj = wp_get_nav_menu_object( $id_property );
                                    if ( $menu_obj ) {
                                        $name = $menu_obj->name;
                                    }
                                    break;
                                case 'travel_payout':
                                case 'location':
                                    $name = get_the_title( $id_property );
                                    break;
                                default:
                                    $name = get_the_title($id_property);
                                    break;
                            }
                            break;
                    }
                }

                return $name;
            }

            static function getLazyLoadingImage( $size = [ 100, 100, 'bfi_thumb' => true ] )
            {
                if ( has_post_thumbnail() ) {
                    $thumb_src = get_the_post_thumbnail_url( get_the_ID(), $size );
                    $thumb_alt = self::get_alt_image( get_post_thumbnail_id() );
                } else {
                    $thumb_src = get_template_directory_uri() . '/img/no-image.png';
                    $thumb_alt = self::get_alt_image();
                }
                ?>
                <div class="layzyload-wrapper">
                    <div class="layzyload-item">
                        <div class="animated-background">
                            <div class="background-masker"></div>
                            <div class="background-masker"></div>
                            <div class="background-masker"></div>
                            <div class="background-masker"></div>
                        </div>
                    </div>
                    <img class="st-lazy" data-src="<?php echo $thumb_src; ?>" alt="<?php echo $thumb_alt; ?>"
                         style="display: none"/>
                </div>
                <?php
            }
            static function getRatingText($avg){
                if($avg >= 4.5){
                    echo __('Excellent', ST_TEXTDOMAIN);
                }elseif ($avg >= 3.5){
                    echo __('Very Good', ST_TEXTDOMAIN);
                }elseif ($avg >= 3){
                    echo __('Average', ST_TEXTDOMAIN);
                }else{
                    echo __('Poor', ST_TEXTDOMAIN);
                }
            }

            static function getHotelTerm($post_id = false, $tax = 'hotel_facilities'){
                if(!$post_id)
                    $post_id = get_the_ID();

                $term = get_the_terms($post_id, $tax);
                if(!is_wp_error($term)){
                    return $term;
                }else{
                    return false;
                }
            }
            static function get_rate_review_text($review, $count = null)
                {
                    $string = esc_html__('Excellent', ST_TEXTDOMAIN);
                    if ($review > 4) {
                        $string = esc_html__('Excellent', ST_TEXTDOMAIN);
                    } elseif ($review > 3) {
                        $string = esc_html__('Very Good', ST_TEXTDOMAIN);
                    } elseif ($review > 2) {
                        $string = esc_html__('Average', ST_TEXTDOMAIN);
                    } elseif ($review > 1) {
                        $string = esc_html__('Poor', ST_TEXTDOMAIN);
                    } else {
                        $string = esc_html__('Terrible', ST_TEXTDOMAIN);
                    }
                    if ($count !== null) {
                        if ($count <= 0) {
                            $string = esc_html__('Not Rate', ST_TEXTDOMAIN);
                        }
                    }

                    return $string;
                }
        }

        TravelHelper::init();
        TravelHelper::st_admin_notice_post_draft_fc();

    }