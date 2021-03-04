<?php
if(!class_exists('ST_Hotel_Alone_Base_Controller')){
    class ST_Hotel_Alone_Base_Controller{
        static $_inst;
        public $asset_url;

        public function __construct()
        {
            add_action( 'admin_init', array($this, '_custom_hotel_alone_meta_boxes') );
            add_action('admin_enqueue_scripts', array($this, '_load_hotel_alone_admin_scripts'));
            add_action('wp_enqueue_scripts', array($this, '_load_hotel_alone_scripts'));

            add_action('wp_head', array($this, '_show_custom_css'), 100);
        }

        static function studio_fonts_url() {
            $font_url = '';

            if ( 'off' !== _x( 'on', 'Google font: on or off', ST_TEXTDOMAIN ) ) {
                $font_url = add_query_arg( 'family', ( 'Lato:300,300i,400,400i,700,700i,900,900i|Amatic+SC:400,700|Playfair+Display:300,300i,400,400i,700,700i,900,900i' ), "//fonts.googleapis.com/css" );
            }
            return $font_url;
        }

        public function _show_custom_css(){
            $check = false;
            if(is_page_template('template-hotel-alone.php')){
                $check = true;
            }
            if(is_singular('hotel_room')){
                $room_id = get_the_ID();
                $hotel_room_alone = get_post_meta($room_id, 'hotel_alone_room_layout', true);
                if($hotel_room_alone == 'on'){
                    $check = true;
                }
            }
            if (  $check ) {
                $style = st_hotel_alone_load_view('custom_css', false);
                ?>
                <style id="hotel_alone_cutom_css">
                    <?php echo ($style);?>
                </style>
                <?php
                echo "\n";
            }
        }

        public function _load_hotel_alone_scripts(){
            $check = false;
            if(is_page_template('template-hotel-alone.php')){
                $check = true;
            }
            if(!New_Layout_Helper::isNewLayout()) {
                if (is_singular('hotel_room')) {
                    $room_id = get_the_ID();
                    $hotel_room_alone = get_post_meta($room_id, 'hotel_alone_room_layout', true);
                    if ($hotel_room_alone == 'on') {
                        $check = true;
                    }
                }
            }
            if (  $check ) {
                wp_enqueue_style('hotel-alone-lato-fonts', self::studio_fonts_url());
                wp_enqueue_style('hotel-alone-animate', st_hotel_alone_load_assets_dir() . '/css/animate.css');
                wp_register_style('hotel-alone-slick-css', st_hotel_alone_load_assets_dir() . '/lib/slick/slick.css');
                wp_register_style('hotel-alone-slick-theme-css', st_hotel_alone_load_assets_dir() . '/lib/slick/slick-theme.css');
                wp_enqueue_style('hotel-alone-component', st_hotel_alone_load_assets_dir() . '/lib/mutimenu/css/component.css');
                wp_enqueue_style('hotel-alone-owl-carousel', st_hotel_alone_load_assets_dir() . '/css/owl.carousel.min.css');
                wp_enqueue_style('hotel-alone-font-awesome-css', st_hotel_alone_load_assets_dir() . '/css/lib/font-awesome/css/font-awesome.min.css');
                wp_enqueue_style('hotel-alone-main-css', st_hotel_alone_load_assets_dir() . '/css/hotel-alone-css.css');
                wp_enqueue_style('hotel-alone-custom-css', st_hotel_alone_load_assets_dir() . '/css/custom.css');

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
                    'room_required' => esc_html("Room number field is required!", ST_TEXTDOMAIN),
                    'add_to_cart_link' => STCart::get_cart_link(),
                ));

                wp_enqueue_script('hotel-alone-moment-js', st_hotel_alone_load_assets_dir() . '/js/moment.min.js', ['jquery'], null, true);

                wp_enqueue_script('hotel-alone-modernizr', st_hotel_alone_load_assets_dir() . '/lib/mutimenu/js/modernizr.custom.js', array('jquery'), null, true);
                wp_enqueue_script('hotel-alone-dlmenu', st_hotel_alone_load_assets_dir() . '/lib/mutimenu/js/jquery.dlmenu.js', array('jquery'), null, true);

                wp_enqueue_script('hotel-alone-isotope', st_hotel_alone_load_assets_dir() . '/js/isotope.js', array('jquery'), null, true);
                wp_enqueue_script('imagesloaded');

                wp_enqueue_script('hotel-alone-owl-carousel', st_hotel_alone_load_assets_dir() . '/js/owl.carousel.min.js', array('jquery'), null, true);

                wp_register_script('mb-YTPlayer', st_hotel_alone_load_assets_dir() . '/js/jquery.mb.YTPlayer.min.js', array('jquery'), null, true);

                wp_register_script('hotel-alone-slick-js', st_hotel_alone_load_assets_dir() . '/lib/slick/slick.min.js', array('jquery'), null, true);

                wp_enqueue_style('hotel-alone-daterangepicker-css', st_hotel_alone_load_assets_dir() . '/js/daterangepicker/daterangepicker.css');
                $locale = get_locale();
                wp_enqueue_script('hotel-alone-daterangepicker-lang-script', st_hotel_alone_load_assets_dir() . '/js/daterangepicker/languages/' . $locale . '.js', array(), null, true);
                wp_enqueue_script('hotel-alone-daterangepicker-script', st_hotel_alone_load_assets_dir() . '/js/daterangepicker/daterangepicker.js', array('jquery', 'hotel-alone-daterangepicker-lang-script'), null, true);

                //wp_enqueue_script( 'hotel-alone-booking-modal', get_template_directory_uri() . '/js/init/booking_modal.js', [ 'jquery' ], null, true );

                wp_enqueue_script('hotel-alone-main-script', st_hotel_alone_load_assets_dir() . '/js/hotel-alone-script.js', array('jquery'), null, true);

                wp_enqueue_script( 'magnific.js' );
            }
        }

        public function _load_hotel_alone_admin_scripts(){
            wp_enqueue_style('hotel-alone-admin-main-css', st_hotel_alone_load_assets_dir() . '/css/admin-css.css');
            wp_enqueue_style('hotel-alone-admin-css', st_hotel_alone_load_assets_dir() . '/admin/css/admin.css');
        }

        public function _custom_hotel_alone_meta_boxes(){
                $meta_data_box = array(
                    'id' => 'st_hotel_alone_page_options',
                    'title' => esc_html__('Hotel Alone Setting', ST_TEXTDOMAIN),
                    'desc' => '',
                    'pages' => array('page'),
                    'context' => 'normal',
                    'priority' => 'high',
                    'fields' => array(
                        array(
                            'id' => 'tab_option_page_header',
                            'label' => esc_html__('Options Page Header', ST_TEXTDOMAIN),
                            'type' => 'tab',
                        ),
                        array(
                            'id' => 'custom_header_page',
                            'label' => esc_html__('Custom Header', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Custom Header', ST_TEXTDOMAIN),
                            'type' => 'on-off',
                            'std' => 'off',
                        ),
                        array(
                            'id' => 'st_topbar_style',
                            'label' => esc_html__('TopBar style', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
                            'type' => 'radio-image',
                            'section' => 'option_header',
                            'std' => 'style_9',
                            'condition' => 'custom_header_page:is(on)',
                            'choices' => array(
                                array(
                                    'value' => 'none',
                                    'label' => esc_html__('No Topbar', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/topbar/no_topbar.jpg'
                                ),
                                array(
                                    'value' => 'style_1',
                                    'label' => esc_html__('Style 1', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/topbar/topbar1.jpg'
                                ),
                                array(
                                    'value' => 'style_2',
                                    'label' => esc_html__('Style 2', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/topbar/topbar2.jpg'
                                ),
                                array(
                                    'value' => 'style_3',
                                    'label' => esc_html__('Style 3', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/topbar/topbar3.jpg'
                                ),
                                array(
                                    'value' => 'style_4',
                                    'label' => esc_html__('Style 4', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/topbar/topbar4.jpg'
                                ),
                            )
                        ),
                        array(
                            'id' => 'st_topbar_background_transparent',
                            'label' => esc_html__("Topbar Background Transparent", ST_TEXTDOMAIN),
                            'type' => 'on-off',
                            'std' => 'off',
                            'condition' => 'custom_header_page:is(on)',
                            'section' => 'option_header'
                        ),
                        array(
                            'id' => 'st_topbar_background',
                            'label' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
                            'desc' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
                            'type' => 'colorpicker_opacity',
                            'section' => 'option_header',
                            'condition' => 'st_topbar_background_transparent:is(off),custom_header_page:is(on)',
                            'operator' => 'and',
                            'std' => '#ffffff'
                        ),
                        array(
                            'id' => 'st_topbar_contact_number',
                            'label' => esc_html__('Contact Number', ST_TEXTDOMAIN),
                            'type' => 'text',
                            'section' => 'option_header',
                            'condition' => 'custom_header_page:is(on)',
                        ),
                        array(
                            'id' => 'st_topbar_email_address',
                            'label' => esc_html__('Email Address', ST_TEXTDOMAIN),
                            'type' => 'text',
                            'section' => 'option_header',
                            'condition' => 'custom_header_page:is(on)',
                        ),
                        array(
                            'id' => 'st_topbar_location',
                            'label' => esc_html__('Location Select', ST_TEXTDOMAIN),
                            'type' => 'st_post_type_select',
                            'post_type' => 'location',
                            'condition' => 'custom_header_page:is(on)',
                        ),
                        //--------------------------------------------------------------------------------------------------

                        //--------------------------------------------------------------------------------------------------
                        array(
                            'id' => 'menu_setting',
                            'label' => esc_html__('Menu Options', ST_TEXTDOMAIN),
                            'type' => 'tab',
                            'section' => 'option_header',
                        ),
                        array(
                            'id' => 'custom_menu_style',
                            'label' => esc_html__('Custom Menu', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Custom Menu', ST_TEXTDOMAIN),
                            'type' => 'on-off',
                            'std' => 'off',
                        ),
                        array(
                            'id' => 'st_menu_style',
                            'label' => esc_html__('Menu style', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
                            'type' => 'radio-image',
                            'section' => 'option_header',
                            'condition' => 'custom_menu_style:is(on)',
                            'choices' => array(
                                array(
                                    'value' => 'none',
                                    'label' => esc_html__('None', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/menu/menu_none.jpg'
                                ),
                                array(
                                    'value' => 'style_1',
                                    'label' => esc_html__('Style 1', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/menu/menu1.jpg'
                                ),
                                array(
                                    'value' => 'style_2',
                                    'label' => esc_html__('Style 2', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/menu/menu2.jpg'
                                ),
                                array(
                                    'value' => 'style_3',
                                    'label' => esc_html__('Style 3', ST_TEXTDOMAIN),
                                    'src' => st_hotel_alone_load_assets_dir() . '/images/menu/menu3.jpg'
                                ),
                            )
                        ),
                        array(
                            'id' => 'st_left_menu',
                            'label' => esc_html__('Left Menu', ST_TEXTDOMAIN),
                            'type' => 'st_post_type_select',
                            'post_type' => 'nav_menu',
                            'section' => 'option_header',
                            'condition' => 'st_menu_style:is(style_1),custom_menu_style:is(on)'
                        ),
                        array(
                            'id' => 'st_right_menu',
                            'label' => esc_html__('Right Menu', ST_TEXTDOMAIN),
                            'type' => 'st_post_type_select',
                            'post_type' => 'nav_menu',
                            'section' => 'option_header',
                            'condition' => 'st_menu_style:is(style_1),custom_menu_style:is(on)'
                        ),
                        array(
                            'id' => 'st_menu_color',
                            'label' => esc_html__('Menu color', ST_TEXTDOMAIN),
                            'type' => 'colorpicker',
                            'section' => 'option_header',
                            'condition' => 'custom_menu_style:is(on)',
                            'std' => '#fff',
                        ),
                        //--------------------------------------------------------------------------------------------------
                        array(
                            'id' => 'tab_option_page_logo',
                            'label' => esc_html__('Options Logo', ST_TEXTDOMAIN),
                            'type' => 'tab',
                        ),
                        array(
                            'id' => 'custom_logo',
                            'label' => esc_html__('Custom Logo', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Custom Logo', ST_TEXTDOMAIN),
                            'type' => 'on-off',
                            'std' => 'off',
                        ),
                        array(
                            'id' => 'logo_light',
                            'label' => esc_html__('Logo', ST_TEXTDOMAIN),
                            'desc' => esc_html__('This allow you to change logo', ST_TEXTDOMAIN),
                            'type' => 'upload',
                            'section' => 'option_logo',
                            'condition' => 'custom_logo:is(on)',
                        ),

                        array(
                            'id' => 'tab_option_page_footer',
                            'label' => esc_html__('Options Footer', ST_TEXTDOMAIN),
                            'type' => 'tab',
                        ),
                        array(
                            'id' => 'custom_footer',
                            'label' => esc_html__('Custom Footer', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Custom Footer', ST_TEXTDOMAIN),
                            'type' => 'on-off',
                            'std' => 'off',
                        ),
                        array(
                            'id' => 'st_footer_page',
                            'label' => esc_html__('Footer Page', ST_TEXTDOMAIN),
                            'desc' => esc_html__('Include page to Footer', ST_TEXTDOMAIN),
                            'type' => 'st_post_type_select',
                            'post_type' => 'page',
                            'condition' => 'custom_footer:is(on)',
                        ),
                    )
                );
                /**
                 * Register our meta boxes using the
                 * ot_register_meta_box() function.
                 */
                if (function_exists('ot_register_meta_box')){
                        //$post_id = isset($_GET['post']) ? $_GET['post'] : '';
                        //if(!empty($post_id)) {
                        //    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
                        //    if ($template_file == 'template-hotel-alone.php') {
                                ot_register_meta_box($meta_data_box);
                        //    }
                        //}
                }
        }


        public function st_remove_all_theme_styles() {
            if ( is_page_template('template-hotel-alone.php') ) {
                global $wp_styles;
                $wp_styles->queue = array();
            }
        }

        function st_remove_all_theme_scripts() {
            if ( is_page_template('template-hotel-alone.php') ) {
                global $wp_scripts;
                $wp_scripts->queue = array();
            }
        }


        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Hotel_Alone_Base_Controller::inst();
}