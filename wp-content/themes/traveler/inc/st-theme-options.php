<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Custom option theme option
 *
 * Created by ShineTheme
 *
 */
if (!class_exists('TravelHelper') or !class_exists('STHotel'))
    return;


$custom_settings = array(

    'sections' => array(
        array(
            'id' => 'option_general',
            'title' => __('<i class="fa fa-tachometer"></i> General Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_style',
            'title' => __('<i class="fa fa-paint-brush"></i> Styling Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_page',
            'title' => __('<i class="fa fa-file-text"></i> Page Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_blog',
            'title' => __('<i class="fa fa-bold"></i> Blog Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_booking',
            'title' => __('<i class="fa fa-book"></i> Booking Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_location',
            'title' => __('<i class="fa fa-location-arrow"></i> Location Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_review',
            'title' => __('<i class="fa fa-comments-o"></i> Review Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_hotel',
            'title' => __('<i class="fa fa-building"></i> Hotel Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_hotel_room',
            'title' => __('<i class="fa fa-building"></i> Room Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_rental',
            'title' => __('<i class="fa fa-home"></i> Rental Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_car',
            'title' => __('<i class="fa fa-car"></i> Car Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_activity_tour',
            'title' => __('<i class="fa fa-suitcase"></i> Tour Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_activity',
            'title' => __('<i class="fa fa-ticket"></i> Activity Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_car_transfer',
            'title' => __('<i class="fa fa-car"></i> Transfer Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_hotel_alone',
            'title' => __('<i class="fa fa-building"></i> Hotel Alone Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_partner',
            'title' => __('<i class="fa fa-users"></i> Partner Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_email_partner',
            'title' => __('<i class="fa fa-users"></i> Email Partner', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_search',
            'title' => __('<i class="fa fa-search"></i> Search Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_email',
            'title' => __('<i class="fa fa-envelope"></i> Email Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_email_template',
            'title' => __('<i class="fa fa-envelope"></i> Email Templates', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_social',
            'title' => __('<i class="fa fa-facebook-official"></i> Social Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_advance',
            'title' => __('<i class="fa fa-cogs"></i> Advance Options', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_update',
            'title' => __('<i class="fa fa-download"></i> Auto Updater', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_api_update',
            'title' => __('<i class="fa fa-download"></i> API Configure', ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'option_bc',
            'title' => __('<i class="fa fa-hashtag"></i> Other options', ST_TEXTDOMAIN)
        ),
    ),
    'settings' => array(
        /*---- .START GENERAL OPTIONS ----*/
        array(
            'id' => 'general_tab',
            'label' => __('General Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_general',
        ),
        array(
            'id' => 'enable_user_online_noti',
            'label' => __('User notification info', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable online notification of user', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'on'
        ),
        array(
            'id' => 'enable_last_booking_noti',
            'label' => __('Last booking notification', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable notification of last booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'on'
        ),
        array(
            'id' => 'enable_user_nav',
            'label' => __('User navigator', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable user dashboard menu', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'on'
        ),
        array(
            'id' => 'noti_position',
            'label' => __('Notification position', ST_TEXTDOMAIN),
            'desc' => __('The position to appear notices', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_general',
            'std' => 'topRight',
            'choices' => array(
                array(
                    'label' => __('Top Right', ST_TEXTDOMAIN),
                    'value' => 'topRight'
                ),
                array(
                    'label' => __('Top Left', ST_TEXTDOMAIN),
                    'value' => 'topLeft'
                ),
                array(
                    'label' => __('Bottom Right', ST_TEXTDOMAIN),
                    'value' => 'bottomRight'
                ),
                array(
                    'label' => __('Bottom Left', ST_TEXTDOMAIN),
                    'value' => 'bottomLeft'
                )
            ),
        ),
        array(
            'id' => 'admin_menu_normal_user',
            'label' => __('Normal user adminbar', ST_TEXTDOMAIN),
            'desc' => __('Show/hide adminbar for user', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'off'
        ),
        array(
            'id' => 'once_notification_per_each_session',
            'label' => __('Only show notification for per session', ST_TEXTDOMAIN),
            'desc' => __('Only show the unique notification for each user\'s session', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'off'
        ),
        array(
            'id' => 'st_weather_temp_unit',
            'label' => __('Weather unit', ST_TEXTDOMAIN),
            'desc' => __('The unit of weather- you can use Fahrenheit or Celsius or Kelvin', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_general',
            'std' => 'c',
            'choices' => array(
                array(
                    'label' => __('Fahrenheit (f)', ST_TEXTDOMAIN),
                    'value' => 'f'
                ),
                array(
                    'label' => __('Celsius (c)', ST_TEXTDOMAIN),
                    'value' => 'c'
                ),
                array(
                    'label' => __('Kelvin (k)', ST_TEXTDOMAIN),
                    'value' => 'k'
                ),
            ),
        ),
        array(
            'id' => 'search_enable_preload',
            'label' => __('Preload option', ST_TEXTDOMAIN),
            'desc' => __('Enable Preload when loading site', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'std' => 'on'
        ),
        array(
            'id' => 'search_preload_image',
            'label' => __('Preload image', ST_TEXTDOMAIN),
            'desc' => __('This is the background for preload', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
            'condition' => 'search_enable_preload:is(on)'
        ),
        array(
            'id' => 'search_preload_icon_default',
            'label' => __('Customize preloader icon', ST_TEXTDOMAIN),
            'desc' => __('Using custom preload icon', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_general',
            'condition' => 'search_enable_preload:is(on)',
            'std' => 'off'
        ),
        array(
            'id' => 'search_preload_icon_custom',
            'label' => __('Upload custom preload image', ST_TEXTDOMAIN),
            'desc' => __('This is the image for preload', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
            'operator' => 'and',
            'condition' => 'search_preload_icon_default:is(on),search_enable_preload:is(on)'
        ),
        array(
            'id' => 'list_disabled_feature',
            'label' => __('Disable Theme Service Option', ST_TEXTDOMAIN),
            'desc' => __('Hide one or many services of theme. In order to disable services (holtel, tour,..) you do not use, please tick the checkbox', ST_TEXTDOMAIN),
            'type' => 'checkbox',
            'section' => 'option_general',
            'choices' => array(
                array(
                    'label' => __('Hotel', ST_TEXTDOMAIN),
                    'value' => 'st_hotel'
                ),
                array(
                    'label' => __('Car', ST_TEXTDOMAIN),
                    'value' => 'st_cars'
                ),
                array(
                    'label' => __('Rental', ST_TEXTDOMAIN),
                    'value' => 'st_rental'
                ),
                array(
                    'label' => __('Tour', ST_TEXTDOMAIN),
                    'value' => 'st_tours'
                ),
                array(
                    'label' => __('Activity', ST_TEXTDOMAIN),
                    'value' => 'st_activity'
                )
            ),
        ),

        array(
            'id' => 'logo_tab',
            'label' => __('Logo', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_general',
        ),
        array(
            'id' => 'logo',
            'label' => __('Logo options', ST_TEXTDOMAIN),
            'desc' => __('To change logo', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
        ),
        array(
            'id' => 'logo_retina',
            'label' => __('Retina logo', ST_TEXTDOMAIN),
            'desc' => __('Note: You MUST re-name Logo Retina to logo-name@2x.ext-name. Example:<br>
                                    Logo is: <em>my-logo.jpg</em><br>Logo Retina must be: <em>my-logo@2x.jpg</em>  ', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
            'std' => get_template_directory_uri() . '/img/logo@2x.png'
        ),
        array(
            'id' => 'logo_mobile',
            'label' => __('Mobile logo', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
            'std' => '',
            "desc" => __("To change logo used for mobile screen", ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'favicon',
            'label' => __('Favicon', ST_TEXTDOMAIN),
            'desc' => __('To change favicon', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
        ),
        array(
            'id' => '404_tab',
            'label' => __('404 Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_general',
        ),
        array(
            'id' => '404_bg',
            'label' => __('Background for 404 page', ST_TEXTDOMAIN),
            'desc' => __('To change background for 404 error page', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_general',
        ),
        array(
            'id' => '404_text',
            'label' => __('Text of 404 page', ST_TEXTDOMAIN),
            'desc' => __('To change text for 404 page', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '3',
            'section' => 'option_general',
        ),
        array(
            'id' => 'seo_tab',
            'label' => __('SEO Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_general',
        ),
        array(
            'id' => 'st_seo_option',
            'label' => __('Enable SEO info', ST_TEXTDOMAIN),
            'desc' => __('Show/hide SEO feature', ST_TEXTDOMAIN),
            'std' => '',
            'type' => 'on-off',
            'section' => 'option_general',
            'class' => '',
        ),
        array(
            'id' => 'st_seo_title',
            'label' => __('Site title', ST_TEXTDOMAIN),
            'desc' => __('To change SEO title', ST_TEXTDOMAIN),
            'std' => '',
            'type' => 'text',
            'section' => 'option_general',
            'class' => '',
            'condition' => 'st_seo_option:is(on)',
        ),
        array(
            'id' => 'st_seo_desc',
            'label' => __('Site description', ST_TEXTDOMAIN),
            'desc' => __('To change SEO description', ST_TEXTDOMAIN),
            'std' => '',
            'rows' => '5',
            'type' => 'textarea-simple',
            'section' => 'option_general',
            'class' => '',
            'condition' => 'st_seo_option:is(on)',
        ),
        array(
            'id' => 'st_seo_keywords',
            'label' => __('Site keywords', ST_TEXTDOMAIN),
            'desc' => __('To change the list of SEO keywords', ST_TEXTDOMAIN),
            'std' => '',
            'rows' => '5',
            'type' => 'textarea-simple',
            'section' => 'option_general',
            'class' => '',
            'condition' => 'st_seo_option:is(on)',
        ),/*---- .END GENERAL OPTIONS ----*/
        array(
            'id' => 'login_tab',
            'label' => __('Login Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_general',
        ),
        array(
            'id' => 'enable_captcha_login',
            'label' => __('Enable Google Captcha Login', ST_TEXTDOMAIN),
            'desc' => __('Show/hide google captcha for page login and register. Note: This function not support for popup login and popup register', ST_TEXTDOMAIN),
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'option_general',
            'class' => '',
        ),
        array(
            'id' => 'recaptcha_key',
            'label' => __('Re-Captcha Key', ST_TEXTDOMAIN),
            'desc' => '',
            'std' => '',
            'type' => 'text',
            'section' => 'option_general',
            'class' => '',
            'condition' => 'enable_captcha_login:is(on)',
        ),
        array(
            'id' => 'recaptcha_secretkey',
            'label' => __('Re-Captcha Secret Key', ST_TEXTDOMAIN),
            'desc' => '',
            'std' => '',
            'type' => 'text',
            'section' => 'option_general',
            'class' => '',
            'condition' => 'enable_captcha_login:is(on)',
        ),

        /*---- .START STYLE OPTIONS ----*/
        array(
            'id' => 'general_style_tab',
            'label' => __('General', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_style',
        ),
        array(
            'id' => 'right_to_left',
            'label' => __('Right to left mode', ST_TEXTDOMAIN),
            'desc' => __('Enable "Right to let" displaying mode for content', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'output' => '',
            'std' => 'off'
        ),
        array(
            'id' => 'style_layout',
            'label' => __('Layout', ST_TEXTDOMAIN),
            'desc' => __('You can choose wide layout or boxed layout', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_style',
            'choices' => array(
                array(
                    'value' => 'wide',
                    'label' => __('Wide', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'boxed',
                    'label' => __('Boxed', ST_TEXTDOMAIN)
                )

            )
        ),
        array(
            'id' => 'typography',
            'label' => __('Typography, Google Fonts', ST_TEXTDOMAIN),
            'desc' => __('To change the display of text', ST_TEXTDOMAIN),
            'type' => 'typography',
            'section' => 'option_style',
            'output' => 'body'
        ),
        array(
            'id' => 'google_fonts',
            'label' => __('Google Fonts', ST_TEXTDOMAIN),
            'type' => 'google-fonts',
            'section' => 'option_style',
        ),
        array(
            'id' => 'star_color',
            'label' => __('Star color', ST_TEXTDOMAIN),
            'desc' => __('To change the color of star hotel', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
        ),
        array(
            'id' => 'body_background',
            'label' => __('Body Background', ST_TEXTDOMAIN),
            'desc' => __('To change the color, background image of body', ST_TEXTDOMAIN),
            'type' => 'background',
            'section' => 'option_style',
            'output' => 'body',
            'std' => array(
                'background-color' => "",
                'background-image' => "",
            )
        ),
        array(
            'id' => 'main_wrap_background',
            'label' => __('Wrap background', ST_TEXTDOMAIN),
            'desc' => __('To change background color, bachground image of box surrounding the content', ST_TEXTDOMAIN),
            'type' => 'background',
            'section' => 'option_style',
            'output' => '.global-wrap',
            'std' => array(
                'background-color' => "",
                'background-image' => "",
            )
        ),
        array(
            'id' => 'style_default_scheme',
            'label' => __('Default Color Scheme', ST_TEXTDOMAIN),
            'desc' => __('Select  available color scheme to display', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_style',
            'output' => '',
            'std' => '',
            'choices' => array(
                array('label' => '-- Please Select ---', 'value' => ''),
                array('label' => 'Bright Turquoise', 'value' => '#0EBCF2'),
                array('label' => 'Turkish Rose', 'value' => '#B66672'),
                array('label' => 'Salem', 'value' => '#12A641'),
                array('label' => 'Hippie Blue', 'value' => '#4F96B6'),
                array('label' => 'Mandy', 'value' => '#E45E66'),
                array('label' => 'Green Smoke', 'value' => '#96AA66'),
                array('label' => 'Horizon', 'value' => '#5B84AA'),
                array('label' => 'Cerise', 'value' => '#CA2AC6'),
                array('label' => 'Brick red', 'value' => '#cf315a'),
                array('label' => 'De-York', 'value' => '#74C683'),
                array('label' => 'Shamrock', 'value' => '#30BBB1'),
                array('label' => 'Studio', 'value' => '#7646B8'),
                array('label' => 'Leather', 'value' => '#966650'),
                array('label' => 'Denim', 'value' => '#1A5AE4'),
                array('label' => 'Scarlet', 'value' => '#FF1D13'),
            )
        ),
        array(
            'id' => 'main_color',
            'label' => __('Main Color', ST_TEXTDOMAIN),
            'desc' => __('To change the main color for web', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
            'std' => '#ed8323',

        ),
        array(
            'id' => 'custom_css',
            'label' => __('CSS custom', ST_TEXTDOMAIN),
            'desc' => __('Use CSS Code to customize the interface', ST_TEXTDOMAIN),
            'type' => 'css',
            'section' => 'option_style',
        ),
        array(
            'id' => 'header_tab',
            'label' => __('Header', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_style',
        ),
        array(
            'id' => 'header_background',
            'label' => __('Header background', ST_TEXTDOMAIN),
            'desc' => __('To change background color, background image of header section', ST_TEXTDOMAIN),
            'type' => 'background',
            'section' => 'option_style',
            'output' => '.header-top, .menu-style-2 .header-top',
            'std' => array(
                'background-color' => "",
                'background-image' => "",
            )
        ),
        array(
            'id' => 'gen_enable_sticky_header',
            'label' => __('Sticky header', ST_TEXTDOMAIN),
            'desc' => __('Enable fixed mode for header', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'off'
        ),
        array(
            'id' => 'sort_header_menu',
            'label' => __('Header menu items', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_style',
            'desc' => __('Select  items displaying at the right of main menu', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'header_item',
                    'label' => __('Item', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'desc' => __('Select header item shown in header right', ST_TEXTDOMAIN),
                    'choices' => array(
                        array(
                            'value' => 'login',
                            'label' => __('Login', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'currency',
                            'label' => __('Currency', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'language',
                            'label' => __('Language', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'search',
                            'label' => __('Search Header', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'shopping_cart',
                            'label' => __('Shopping Cart', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'link',
                            'label' => __('Custom Link', ST_TEXTDOMAIN)
                        ),
                    )
                ),
                array(
                    'id' => 'header_custom_link',
                    'label' => __('Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'header_item:is(link)'
                ),
                array(
                    'id' => 'header_custom_link_title',
                    'label' => __('Title Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'header_item:is(link)'
                ),
                array(
                    'id' => 'header_custom_link_icon',
                    'label' => __('Icon Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'desc' => __('Enter a awesome font icon. Example: <code>fa-facebook</code>', ST_TEXTDOMAIN),
                    'condition' => 'header_item:is(link)'
                )
            ),
        ),
        array(
            'id' => 'menu_bar',
            'label' => __('Menu', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_style',
        ),
        array(
            'id' => 'gen_enable_sticky_menu',
            'label' => __('Sticky menu', ST_TEXTDOMAIN),
            'desc' => __('This allows you to turn on or off <em>Sticky Menu Feature</em>', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'off',
        ),
        array(
            'id' => 'menu_style',
            'label' => __('Select menu style', ST_TEXTDOMAIN),
            'desc' => __('Select  styles of menu ( it is default as style 1)', ST_TEXTDOMAIN),
            'type' => 'radio-image',
            'section' => 'option_style',
            'std' => '1',
            'choices' => array(
                array(
                    'value' => '1',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'src' => get_template_directory_uri() . '/img/nav1.png'
                ),
                array(
                    'value' => '2',
                    'label' => __('Logo Center', ST_TEXTDOMAIN),
                    'src' => get_template_directory_uri() . '/img/nav2-new.png'
                ),
            )
        ),
        //Turn On/Off Mega menu
        array(
            'id' => 'allow_megamenu',
            'label' => __('Mega menu', ST_TEXTDOMAIN),
            'desc' => __('Enable Mega Menu', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'off'
        ),

        array(
            'id' => 'mega_menu_background',
            'label' => __('Mega Menu background', ST_TEXTDOMAIN),
            'desc' => __('To change mega menu\'s background', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
            'std' => '#ffffff',

        ),

        array(
            'id' => 'mega_menu_color',
            'label' => __('Mega Menu color', ST_TEXTDOMAIN),
            'desc' => __('To change mega menu\'s color', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
            'std' => '#333333',
        ),

        array(
            'id' => 'menu_color',
            'label' => __('Menu color', ST_TEXTDOMAIN),
            'desc' => __('To change the color for menu', ST_TEXTDOMAIN),
            'type' => 'typography',
            'section' => 'option_style',
            'std' => '#333333',
            'output' => '.st_menu ul.slimmenu li a, .st_menu ul.slimmenu li .sub-toggle>i,.menu-style-2 ul.slimmenu li a, .menu-style-2 ul.slimmenu li .sub-toggle>i, .menu-style-2 .nav .collapse-user'
        ),
        array(
            'id' => 'menu_background',
            'label' => __('Menu background', ST_TEXTDOMAIN),
            'desc' => __('To change menu\'s background image', ST_TEXTDOMAIN),
            'type' => 'background',
            'section' => 'option_style',
            'output' => '#menu1,#menu1 .menu-collapser, #menu2 .menu-wrapper, .menu-style-2 .user-nav-wrapper',
            'std' => array(
                'background-color' => "#ffffff",
                'background-image' => "",
            )
        ),
        array(
            'id' => 'top_bar',
            'label' => __('Top Bar', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_style',
        ),
        array(
            'id' => 'enable_topbar',
            'label' => __('Topbar menu', ST_TEXTDOMAIN),
            'desc' => __('On to Enable Top bar ', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'off',
        ),
        array(
            'id' => 'sort_topbar_menu',
            'label' => __('Topbar menu options', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_style',
            'desc' => __('Select topbar item shown in topbar right', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'topbar_item',
                    'label' => __('Item', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'desc' => __('Select item shown in topbar', ST_TEXTDOMAIN),
                    'choices' => array(
                        array(
                            'value' => 'login',
                            'label' => __('Login', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'currency',
                            'label' => __('Currency', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'language',
                            'label' => __('Language', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'search',
                            'label' => __('Search Topbar', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'shopping_cart',
                            'label' => __('Shopping Cart', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'link',
                            'label' => __('Custom Link', ST_TEXTDOMAIN)
                        ),
                    )
                ),
                array(
                    'id' => 'topbar_custom_link',
                    'label' => __('Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'topbar_item:is(link)'
                ),
                array(
                    'id' => 'topbar_custom_link_title',
                    'label' => __('Title Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'topbar_item:is(link)'
                ),
                array(
                    'id' => 'topbar_custom_link_icon',
                    'label' => __('Icon Link', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'desc' => __('Enter a awesome font icon. Example: <code>fa-facebook</code>', ST_TEXTDOMAIN),
                    'condition' => 'topbar_item:is(link)'
                ),
                array(
                    'id' => 'topbar_custom_link_target',
                    'label' => __('Open new window', ST_TEXTDOMAIN),
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => __('Yes', ST_TEXTDOMAIN),
                            'value' => 'yes'
                        )
                    ),
                    'desc' => __('Open new window', ST_TEXTDOMAIN),
                    'condition' => 'topbar_item:is(link)'
                ),
                array(
                    'id' => 'topbar_position',
                    'label' => __('Position', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'left',
                            'label' => __('Left', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'right',
                            'label' => __('Right', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
            ),
        ),
        array(
            'id' => 'hidden_topbar_in_mobile',
            'label' => esc_html__('Hidden topbar in mobile', ST_TEXTDOMAIN),
            'desc' => __('Hidden top bar in mobile', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'on',
            'condition' => 'enable_topbar:is(on)'
        ),
        array(
            'id' => 'gen_enable_sticky_topbar',
            'label' => __('Sticky topbar', ST_TEXTDOMAIN),
            'desc' => __('Enable fixed mode for topbar', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_style',
            'std' => 'off',
        ),
        array(
            'id' => 'topbar_bgr',
            'label' => __('Topbar background', ST_TEXTDOMAIN),
            'desc' => __('To change background color for topbar', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'condition' => 'enable_topbar:is(on)',
            'section' => 'option_style',
            'std' => '#333',
        ),/*---- ./END STYLE OPTIONS ----*/
        array(
            'id' => 'featured_tab',
            'label' => __('Featured', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_style',
        ),
        array(
            'id' => 'st_text_featured',
            'label' => __("Feature text", ST_TEXTDOMAIN),
            'desc' => __("To change text to display featured content:", ST_TEXTDOMAIN) . "<br>Example: <br>-  Feature<xmp>- BEST <br><small>CHOICE</small></xmp>",
            'type' => 'text',
            'section' => 'option_style',
            'class' => '',
            'std' => 'Featured'
        ),

        array(
            'id' => 'st_ft_label_w',
            'label' => __("Label style fixed width (pixel)", ST_TEXTDOMAIN),
            'desc' => __("Type label width, Default : automatic ", ST_TEXTDOMAIN),
            'type' => 'text',
            'condition' => 'feature_style:is(label)',
            'section' => 'option_style',
        ),
        array(
            'id' => 'st_text_featured_bg',
            'label' => __('Feature background color', ST_TEXTDOMAIN),
            'desc' => __('Text color of featured word', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
            'class' => '',
            'std' => '#19A1E5',
        ),
        array(
            'id' => 'st_sl_height',
            'label' => __("Sale label fixed height (pixel)", ST_TEXTDOMAIN),
            'desc' => __("Type label height, Default : automatic ", ST_TEXTDOMAIN),
            'type' => 'text',
            'condition' => 'sale_style:is(label)',
            'section' => 'option_style',
        ),
        array(
            'id' => 'st_text_sale_bg',
            'label' => __('Promotion background color', ST_TEXTDOMAIN),
            'desc' => __('To change background color of the box displaying sale', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_style',
            'class' => '',
            'std' => '#cc0033',
        ),
        /*--------------Location options ----------*/

        array(
            'id' => 'location_posts_per_page',
            'label' => __('Number of items in one location', ST_TEXTDOMAIN),
            'desc' => __('Default number of posts are shown in Location tab', ST_TEXTDOMAIN),
            'type' => 'numeric-slider',
            'min_max_step' => '1,15,1',
            'section' => 'option_location',
            'std' => 5
        ),

        array(
            'id' => 'bc_show_location_url',
            'label' => __('Location link options', ST_TEXTDOMAIN),
            'desc' => __('ON: Link of items will redirect to results search page <br>OFF: Link of items will redirect to details page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_location',
            'std' => 'on'
        ),
        array(
            'id' => 'bc_show_location_tree',
            'label' => __('Build locations by tree structure', ST_TEXTDOMAIN),
            'desc' => __('Build locations by tree structure', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_location',
            'std' => 'off'
        ),

        /*--------------End Location options ----------*/

        /*--------------Review Options------------*/

        array(
            'id' => 'review_without_login',
            'label' => __('Write review', ST_TEXTDOMAIN),
            'desc' => __('ON: Reviews can be written without logging in <br>OFF: Reviews cannot be written without logging in', ST_TEXTDOMAIN),
            'section' => 'option_review',
            'type' => 'on-off',
            'std' => 'on'
        ),
        array(
            'id' => 'review_need_booked',
            'label' => __('User who booked can write review', ST_TEXTDOMAIN),
            'desc' => __('ON: User booked can write review <br>OFF: Everyone can write review', ST_TEXTDOMAIN),
            'section' => 'option_review',
            'type' => 'on-off',
            'std' => 'off'
        )
    ,
        array(
            'id' => 'review_once',
            'label' => __('Times for review', ST_TEXTDOMAIN),
            'desc' => __('ON: Only one time for review <br>OFF: Many times for review', ST_TEXTDOMAIN),
            'section' => 'option_review',
            'type' => 'on-off',
            'std' => 'off'
        ),
        array(
            'id' => 'is_review_must_approved',
            'label' => __('Review approved', ST_TEXTDOMAIN),
            'desc' => __('ON: Review must be approved by admin <br>OFF: Review is automatically approved', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_review',
            'std' => 'off'
        ),
        /*--------------End Review Options------------*/


        /*--------------Blog Options------------*/
        array(
            'id' => 'blog_sidebar_pos',
            'label' => __('Sidebar position', ST_TEXTDOMAIN),
            'desc' => __('Select the position to show sidebar', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_blog',
            'choices' => array(
                array(
                    'value' => 'no',
                    'label' => __('No', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'left',
                    'label' => __('Left', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'right',
                    'label' => __('Right', ST_TEXTDOMAIN)
                )

            ),
            'std' => 'right'
        )
    ,
        array(
            'id' => 'blog_sidebar_id',
            'label' => __('Widget position on slidebar', ST_TEXTDOMAIN),
            'desc' => __('You can choose from the list', ST_TEXTDOMAIN),
            'type' => 'sidebar-select',
            'section' => 'option_blog',
            'std' => 'blog-sidebar',
        ),
        /*--------------End Blog Options------------*/
        /*--------------Page Options------------*/

        array(
            'id' => 'page_my_account_dashboard',
            'label' => __('Select user dashboard page', ST_TEXTDOMAIN),
            'desc' => __('Select the page to display dashboard user page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_redirect_to_after_login',
            'label' => __('Redirect page after login', ST_TEXTDOMAIN),
            'desc' => __('Select the page to display after users login to the system ', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_redirect_to_after_logout',
            'label' => __('Redirect page after logout', ST_TEXTDOMAIN),
            'desc' => __('Select the page to display after users logout from the system ', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'enable_popup_login',
            'label' => esc_html__('Show popup when register', ST_TEXTDOMAIN),
            'desc' => esc_html__('Enable/disable login/ register mode in form of popup', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_page',
            'std' => 'off'
        ),
        array(
            'id' => 'page_user_login',
            'label' => __('User Login', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
            'condition' => 'enable_popup_login:is(off)'
        ),
        array(
            'id' => 'page_user_register',
            'label' => __('User Register', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
            'condition' => 'enable_popup_login:is(off)'
        ),
        array(
            'id' => 'page_reset_password',
            'label' => __('Select page for reset password', ST_TEXTDOMAIN),
            'desc' => __('Select page for resetting password', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_checkout',
            'label' => __('Select page for checkout', ST_TEXTDOMAIN),
            'desc' => __('Select page for checkout', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_payment_success',
            'label' => __('Select page for successfully booking', ST_TEXTDOMAIN),
            'desc' => __('Select page for successful booking', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_order_confirm',
            'label' => __('Order Confirmation Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show booking order', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        array(
            'id' => 'page_terms_conditions',
            'label' => __('Terms and Conditions Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show Terms and Conditions', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),

        array(
            'id' => 'footer_template',
            'label' => __('Footer Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show Footer', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),

        array(
            'id' => 'partner_info_page',
            'label' => __('Partner Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show Partner Information', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_page',
        ),
        /*--------------End Page Options------------*/

        array(
            'id' => 'datetime_format',
            'label' => __('Input date format', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '{mm}/{dd}/{yyyy}',
            'section' => 'option_advance',
            'desc' => __('The date format, combination of d, dd, mm, yy, yyyy. It is surrounded by <code>\'{}\'</code>. Ex: {dd}/{mm}/{yyyy}.
                <ul>
                <li><code>d, dd</code>: Numeric date, no leading zero and leading zero, respectively. Eg, 5, 05.</li>
                <li><code>m, mm</code>: Numeric month, no leading zero and leading zero, respectively. Eg, 7, 07.</li>
                <li><code>yy, yyyy:</code> 2- and 4-digit years, respectively. Eg, 12, 2012.</li>
                </ul>
                ', ST_TEXTDOMAIN),
        ),
        array(
            'id' => 'time_format',
            'label' => __('Select time format', ST_TEXTDOMAIN),
            'type' => 'select',
            'std' => '12h',
            'choices' => array(
                array(
                    'value' => '12h',
                    'label' => __('12h', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => '24h',
                    'label' => __('24h', ST_TEXTDOMAIN)
                ),
            ),
            'section' => 'option_advance',
        ),
        array(
            'id' => 'update_weather_by',
            'label' => __('Weather auto update after:', ST_TEXTDOMAIN),
            'type' => 'numeric-slider',
            'min_max_step' => '1,12,1',
            'std' => 12,
            'section' => 'option_advance',
            'desc' => __('Weather updates (Unit: hour)', ST_TEXTDOMAIN),
        ),
        array(
            'id' => 'show_price_free',
            'label' => __('Show info when service is free', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'desc' => __('Price is not shown when accommodation is free', ST_TEXTDOMAIN),
            'section' => 'option_advance',
            'std' => 'off'
        ),
        //        array(
        //            'id'      => 'adv_compress_html' ,
        //            'label'   => __( 'Compress HTML' , ST_TEXTDOMAIN ) ,
        //            'desc'    => __( 'This allows you to compress HTML code.' , ST_TEXTDOMAIN ) ,
        //            'type'    => 'on-off' ,
        //            'section' => 'option_advance' ,
        //            'std'     => 'off'
        //        )
        //        ,
        array(
            'id' => 'adv_before_body_content',
            'label' => __('Before Body Content', ST_TEXTDOMAIN),
            'desc' => sprintf(__('Input content after %s tag.', ST_TEXTDOMAIN), esc_html('<body>')),
            'type' => 'textarea-simple',
            'section' => 'option_advance',
            //'std'=>'off'
        )
    ,
        array(
            'id' => 'edv_enable_demo_mode',
            'label' => __('Show demo mode', ST_TEXTDOMAIN),
            'desc' => __('Do some magical', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_advance',
            'std' => 'off',
            //'std'=>'off'
        ),
        array(
            'id' => 'envato_username',
            'label' => __("Envato username", ST_TEXTDOMAIN),
            'desc' => __("Envato username", ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_update'
        ),
        array(
            'id' => 'envato_apikey',
            'label' => __("Envato API key", ST_TEXTDOMAIN),
            'desc' => __("Envato API key", ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_update'
        ),
        array(
            'id' => 'envato_purchasecode',
            'label' => __("Purchase code", ST_TEXTDOMAIN),
            'desc' => __("Purchase code", ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_update'
        ),
        /*------------- Booking Option --------------*/
        array(
            'id' => 'booking_tab',
            'label' => __('Booking Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_booking'
        ),
        array(
            'id' => 'booking_modal',
            'label' => __('Show popup booking form', ST_TEXTDOMAIN),
            'desc' => __('Show/hide booking mode with popup form. This option only works when turning off Woocommerce Checkout', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_booking',
            'condition' => 'use_woocommerce_for_booking:is(off)'
        )
    ,
        array(
            'id' => 'booking_enable_captcha',
            'label' => __('Show captcha', ST_TEXTDOMAIN),
            'desc' => __('Enable captcha for booking form. It is applied for normal booking form', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_booking',
            'desc' => __('Only use for submit form booking', ST_TEXTDOMAIN),
        ),
        array(
            'id' => 'booking_card_accepted',
            'label' => __('Accepted cards', ST_TEXTDOMAIN),
            'desc' => __('Add, remove accepted payment cards ', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'settings' => array(
                array(
                    'id' => 'image',
                    'label' => __('Image', ST_TEXTDOMAIN),
                    'desc' => __('Image', ST_TEXTDOMAIN),
                    'type' => 'upload'
                )
            ),
            'std' => array(
                array(
                    'title' => 'Master Card',
                    'image' => get_template_directory_uri() . '/img/card/mastercard.png'
                ),
                array(
                    'title' => 'JCB',
                    'image' => get_template_directory_uri() . '/img/card/jcb.png'
                ),
                array(
                    'title' => 'Union Pay',
                    'image' => get_template_directory_uri() . '/img/card/unionpay.png'
                ),
                array(
                    'title' => 'VISA',
                    'image' => get_template_directory_uri() . '/img/card/visa.png'
                ),
                array(
                    'title' => 'American Express',
                    'image' => get_template_directory_uri() . '/img/card/americanexpress.png'
                ),
            ),
            'section' => 'option_booking',
        )
    ,
        array(
            'id' => 'booking_currency',
            'label' => __('List of currencies', ST_TEXTDOMAIN),
            'desc' => __('Add, remove a kind of currency for payment', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_booking',
            'settings' => array(
                array(

                    'id' => 'name',
                    'label' => __('Currency Name', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => TravelHelper::ot_all_currency()
                ),
                array(

                    'id' => 'symbol',
                    'label' => __('Currency Symbol', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),
                array(

                    'id' => 'rate',
                    'label' => __('Exchange rate', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                    'desc' => __('Exchange rate vs Primary Currency', ST_TEXTDOMAIN)
                ),
                array(

                    'id' => 'booking_currency_pos',
                    'label' => __('Currency Position', ST_TEXTDOMAIN),
                    'desc' => __('This controls the position of the currency symbol.<br>Ex: $400 or 400 $', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'left',
                            'label' => __('Left (£99.99)', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'right',
                            'label' => __('Right (99.99£)', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'left_space',
                            'label' => __('Left with space (£ 99.99)', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'right_space',
                            'label' => __('Right with space (99.99 £)', ST_TEXTDOMAIN),
                        )
                    ),
                    'std' => 'left'
                ),
                array(
                    'id' => 'currency_rtl_support',
                    'type' => "on-off",
                    'label' => __("This currency is use for RTL languages?", ST_TEXTDOMAIN),
                    'std' => 'off'
                ),
                array(

                    'id' => 'thousand_separator',
                    'label' => __('Thousand Separator', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'std' => '.',
                    'desc' => __('Optional. Specifies what string to use for thousands separator.', ST_TEXTDOMAIN)
                ),
                array(
                    'id' => 'decimal_separator',
                    'label' => __('Decimal Separator', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'std' => ',',
                    'desc' => __('Optional. Specifies what string to use for decimal point', ST_TEXTDOMAIN)

                ),
                array(
                    'id' => 'booking_currency_precision',
                    'label' => __('Currency decimal', ST_TEXTDOMAIN),
                    'desc' => __('Sets the number of decimal points.', ST_TEXTDOMAIN),
                    'type' => 'numeric-slider',
                    'min_max_step' => '0,5,1',
                    'std' => 2
                ),

            ),
            'std' => array(
                array(
                    'title' => 'USD',
                    'name' => 'USD',
                    'symbol' => '$',
                    'rate' => 1,
                    'booking_currency_pos' => 'left',
                    'thousand_separator' => '.',
                    'decimal_separator' => ',',
                    'booking_currency_precision' => 2,

                ),
                array(
                    'title' => 'EUR',
                    'name' => 'EUR',
                    'symbol' => '€',
                    'rate' => 0.796491,
                    'booking_currency_pos' => 'left',
                    'thousand_separator' => '.',
                    'decimal_separator' => ',',
                    'booking_currency_precision' => 2,
                ),
                array(
                    'title' => 'GBP',
                    'name' => 'GBP',
                    'symbol' => '£',
                    'rate' => 0.636169,
                    'booking_currency_pos' => 'right',
                    'thousand_separator' => ',',
                    'decimal_separator' => ',',
                    'booking_currency_precision' => 2,
                ),
            )

        ),
        array(
            'id' => 'booking_primary_currency',
            'label' => __('Primary Currency', ST_TEXTDOMAIN),
            'desc' => __('Select a unit of currency as main currency', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_booking',
            'choices' => TravelHelper::get_currency(true),
            'std' => 'USD'
        ),
        array(
            'id' => 'booking_currency_conversion',
            'label' => __('Currency conversion', ST_TEXTDOMAIN),
            'desc' => __('It is used to convert any currency into dollars (USD) when booking in paypal with the currencies having not been supported yet.', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_booking',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Currency Name', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => TravelHelper::ot_all_currency()
                ),
                array(
                    'id' => 'rate',
                    'label' => __('Exchange rate', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                    'desc' => __('Exchange rate vs Primary Currency', ST_TEXTDOMAIN)
                ),
            )
        ),
        array(
            'id' => 'is_guest_booking',
            'label' => __('Allow guest booking', ST_TEXTDOMAIN),
            'desc' => __("Enable/disable this mode to allow users who have not logged in to book", ST_TEXTDOMAIN),
            'section' => 'option_booking',
            'type' => 'on-off',
            'std' => 'off'
        ),

        array(
            'id' => 'st_booking_enabled_create_account',
            'label' => __('Enable create account option', ST_TEXTDOMAIN),
            'desc' => __('Enable create account option in checkout page. Default: Enabled', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_booking',
            'condition' => 'is_guest_booking:is(on)'
        ),
        array(
            'id' => 'guest_create_acc_required',
            'label' => __('Always create new account after checkout', ST_TEXTDOMAIN),
            'desc' => __('This options required input checker <em>Create new account</em> for Guest booking ', ST_TEXTDOMAIN),
            'section' => 'option_booking',
            'type' => 'on-off',
            'std' => 'off',
            'condition' => 'is_guest_booking:is(on)st_booking_enabled_create_account:is(on)'
        ),
        array(
            'id' => 'woocommerce_tab',
            'label' => __('Woocommerce Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_booking',
        ),
        array(
            'id' => 'use_woocommerce_for_booking',
            'section' => 'option_booking',
            'label' => __('Use WooCommerce checkout', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable Woocomerce for Booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
        ),
        array(
            'id' => 'woo_checkout_show_shipping',
            'section' => 'option_booking',
            'label' => __('Show Shipping Information', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'condition' => "use_woocommerce_for_booking:is(on)"
        ),
        array(
            'id' => 'st_woo_cart_is_collapse',
            'section' => 'option_booking',
            'label' => __('Show Cart item Information collapsed', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'condition' => "use_woocommerce_for_booking:is(on)"
        ),
        array(
            'id' => 'tax_tab',
            'label' => __('Tax Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_booking',
        ),
        array(
            'id' => 'tax_enable',
            'label' => __('Enable tax', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable this feature for tax', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_booking',
            'std' => 'off'
        )
    ,
        array(
            'id' => 'st_tax_include_enable',
            'label' => __('Price included tax', ST_TEXTDOMAIN),
            'desc' => __('ON: Tax has been included in the price of product <br>OFF: Tax has not been included in the price of product', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_booking',
            'condition' => 'tax_enable:is(on)',
            'std' => 'off'
        )
    ,
        array(
            'id' => 'tax_value',
            'label' => __('Tax value (%)', ST_TEXTDOMAIN),
            'desc' => __('Tax percentage', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'tax_enable:is(on)',
            'std' => 10
        ),
        array(
            'id' => 'invoice_tab',
            'label' => __('Invoice Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_booking'
        ),
        array(
            'id' => 'invoice_enable',
            'label' => __('Enable invoice', ST_TEXTDOMAIN),
            'desc' => __('Enable/disable this feature for invoice', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_booking',
            'std' => 'off'
        ),
        array(
            'id' => 'invoice_logo',
            'label' => __('Company Logo', ST_TEXTDOMAIN),
            'desc' => __('Company Logo', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_company_name',
            'label' => __('Company Name', ST_TEXTDOMAIN),
            'desc' => __('Company Name', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_address',
            'label' => __('Address', ST_TEXTDOMAIN),
            'desc' => __('Address', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_phone_number',
            'label' => __('Phone Number', ST_TEXTDOMAIN),
            'desc' => __('Phone Number', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_zpc',
            'label' => __('Zip / Postal Code', ST_TEXTDOMAIN),
            'desc' => __('Zip / Postal Code', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_registration_number',
            'label' => __('Registration Number', ST_TEXTDOMAIN),
            'desc' => __('Registration Number', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_tax_vat_number',
            'label' => __('Tax / VAT Number', ST_TEXTDOMAIN),
            'desc' => __('Tax / VAT Number', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'condition' => 'invoice_enable:is(on)',
        ),
        array(
            'id' => 'invoice_show_link_page_order',
            'label' => __('Show download link in page order success', ST_TEXTDOMAIN),
            'desc' => __('Show download link in page order success', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_booking',
            'std' => 'off',
            'condition' => 'invoice_enable:is(on)'
        ),
        array(
            'id' => 'booking_fee_tab',
            'label' => __('Booking Fee Options', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_booking',
        ),
        array(
            'id' => 'booking_fee_enable',
            'label' => __('Enable Booking Fee', ST_TEXTDOMAIN),
            'desc' => __('This feature only for normal booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_booking',
            'std' => 'off'
        ),
        array(
            'id' => 'booking_fee_type',
            'label' => __("Fee Type", ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'value' => 'percent',
                    'label' => __('Fee by percent', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'amount',
                    'label' => __('Fee by amount', ST_TEXTDOMAIN)
                ),
            ),
            'section' => 'option_booking',
            'condition' => 'booking_fee_enable:is(on)',
        ),
        array(
            'id' => 'booking_fee_amount',
            'label' => __('Fee amount', ST_TEXTDOMAIN),
            'desc' => __('Leave empty for disallow booking fee', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_booking',
            'std' => '0',
            'condition' => 'booking_fee_enable:is(on)',
        ),

        /*------------- End Booking Option --------------*/


        /*------------- Hotel Option --------------*/
        array(
            'id' => 'hotel_single_book_room',
            'label' => __('Booking room in single hotel', ST_TEXTDOMAIN),
            'desc' => '',
            'type' => 'on-off',
            'section' => 'option_hotel',
            'std' => 'off'
        ),
        array(
            'id' => 'hotel_show_min_price',
            'label' => __("Price show on listing", ST_TEXTDOMAIN),
            'desc' => __('AVG: Show average price on results search page <br>MIN: Show minimum price on results search page', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'value' => 'avg_price',
                    'label' => __('Avg Price', ST_TEXTDOMAIN)

                ),
                array(
                    'value' => 'min_price',
                    'label' => __('Min Price', ST_TEXTDOMAIN)
                ),
            ),
            'section' => 'option_hotel',
        ),
        array(
            'id' => 'view_star_review',
            'label' => __('Show Hotel Stars or Hotel Reviews', ST_TEXTDOMAIN),
            'desc' => __('Hotel star: Show hotel stars on elements of hotel list <br>Hotel review: Show the number of review stars on elements of hotel list ', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_hotel',
            'choices' => array(
                array(
                    'label' => __('Hotel Stars', ST_TEXTDOMAIN),
                    'value' => 'star'
                ),
                array(
                    'label' => __('Hotel Reviews', ST_TEXTDOMAIN),
                    'value' => 'review'
                )
            ),
        ),
        array(
            'id' => 'hotel_search_result_page',
            'label' => __('Hotel search result page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show hotel results search page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_hotel',
        ),
        array(
            'id' => 'hotel_posts_per_page',
            'label' => __('Items per page', ST_TEXTDOMAIN),
            'desc' => __('Number of items on a hotel results search page', ST_TEXTDOMAIN),
            'type' => 'numeric-slider',
            'min_max_step' => '1,50,1',
            'section' => 'option_hotel',
            'std' => '12'

        )
    ,
        array(
            'id' => 'hotel_single_layout',
            'label' => __('Hotel details layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to display default single hotel', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_hotel',
            'section' => 'option_hotel'
        )
    ,
        array(
            'id' => 'hotel_search_layout',
            'label' => __('Hotel search layout', ST_TEXTDOMAIN),
            'desc' => __('Select page to display hotel search page', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_hotel_search',
            'section' => 'option_hotel'
        )
    ,


        array(
            'id' => 'hotel_max_adult',
            'label' => __('Max Adults in search field', ST_TEXTDOMAIN),
            'desc' => __('Select max adults for search field', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel',
            'std' => 14

        )
    ,
        array(
            'id' => 'hotel_max_child',
            'label' => __('Max Children in search field', ST_TEXTDOMAIN),
            'desc' => __('Select max children for search field', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel',
            'std' => 14

        ),
        array(
            'id' => 'hotel_review',
            'label' => __('Enable Review', ST_TEXTDOMAIN),
            'desc' => __('ON: Users can review for hotel  <br>OFF: User can not review for hotel', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_hotel',
            'std' => 'on'
        ),

        array(
            'id' => 'hotel_review_stats',
            'label' => __('Review criterias', ST_TEXTDOMAIN),
            'desc' => __('You can add, edit, delete an review criteria for hotel', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_hotel',
            'condition' => 'hotel_review:is(on)',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Stat Name', ST_TEXTDOMAIN),
                    'type' => 'textblock',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'icon',
                    'label' => __('Icon review', ST_TEXTDOMAIN),
                    'type' => 'upload',
                    'operator' => 'and',
                )
            ),
            'std' => array(

                array('title' => 'Sleep'),
                array('title' => 'Location'),
                array('title' => 'Service'),
                array('title' => 'Cleanliness'),
                array('title' => 'Room(s)'),
            )
        ),
        array(
            'id' => 'hotel_sidebar_pos',
            'label' => __('Hotel slidebar position', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_hotel',
            'choices' => array(
                array(
                    'value' => 'no',
                    'label' => __('No', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'left',
                    'label' => __('Left', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'right',
                    'label' => __('Right', ST_TEXTDOMAIN)
                )

            ),
            'std' => 'left'

        ),
        array(
            'id' => 'hotel_sidebar_area',
            'label' => __('Sidebar Area', ST_TEXTDOMAIN),
            'type' => 'sidebar-select',
            'section' => 'option_hotel',
        ),
        array(
            'id' => 'is_featured_search_hotel',
            'label' => __('Show featured hotels on top of search result', ST_TEXTDOMAIN),
            'desc' => __('ON: Show featured items on top of result search page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_hotel'
        ),
        'flied_hotel' => array(
            'id' => 'hotel_search_fields',
            'label' => __('Hotel custom search form', ST_TEXTDOMAIN),
            'desc' => __('You can add, edit, delete or sort fields to make a search form for hotel', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_hotel',
            'std' => array(
                array(
                    'title' => __('Where are you going?', ST_TEXTDOMAIN),
                    'name' => 'location',
                    'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12

                ),
                array(
                    'title' => __('Check in', ST_TEXTDOMAIN),
                    'name' => 'checkin',
                    'layout_col' => 3,
                    'layout2_col' => 3
                ),
                array(
                    'title' => __('Check out', ST_TEXTDOMAIN),
                    'name' => 'checkout',
                    'layout_col' => 3,
                    'layout2_col' => 3
                ),
                array(
                    'title' => __('Room(s)', ST_TEXTDOMAIN),
                    'name' => 'room_num',
                    'layout_col' => 3,
                    'layout2_col' => 3
                ),
                array(
                    'title' => __('Adult', ST_TEXTDOMAIN),
                    'name' => 'adult',
                    'layout_col' => 3,
                    'layout2_col' => 3
                )
            ),
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STHotel::get_search_fields_name()
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_hotel'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'taxonomy_room',
                    'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'st_select_tax',
                    'post_type' => 'hotel_room'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel_room',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'name:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            )
        ),
        array(
            'id' => 'hotel_allow_search_advance',
            'label' => __('Allow advanced search', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on the mode to add advanced search field in hotel search form', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_hotel',
            'std' => 'off',
        ),
        array(
            'id' => 'hotel_search_advance',
            'label' => __('Hotel Advanced Search fields', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_hotel',
            'condition' => 'hotel_allow_search_advance:is(on)',
            'desc' => __('You can add, edit, delete, drag and drop any field for settingup advanced search form', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STHotel::get_search_fields_name()

                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_hotel'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'taxonomy_room',
                    'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'st_select_tax',
                    'post_type' => 'hotel_room'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel_room',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'name:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array(
                    'title' => __('Hotel Theme', ST_TEXTDOMAIN),
                    'name' => 'taxonomy',
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'taxonomy' => 'hotel_theme',


                ),
                array(
                    'title' => __('Room Facilitites', ST_TEXTDOMAIN),
                    'name' => 'taxonomy_room',
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'taxonomy' => 'hotel_facilities',
                ),
            ),
        ),
        array(
            'id' => 'hotel_nearby_range',
            'label' => __('Hotel Nearby Range', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel',
            'desc' => __('You can input distance (km) to find nearby hotels ', ST_TEXTDOMAIN),
            'std' => 10
        ),
        array(
            'id' => 'hotel_unlimited_custom_field',
            'label' => __('Hotel custom fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_hotel',
            'desc' => __('You can add, edit, delete custom fields for hotel', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'type_field',
                    'label' => __('Field type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'text',
                            'label' => __('Text field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'textarea',
                            'label' => __('Textarea field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'date-picker',
                            'label' => __('Date field', ST_TEXTDOMAIN)
                        ),
                    )

                ),
                array(
                    'id' => 'default_field',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),

            ),
        ),
        array(
            'id' => 'st_hotel_icon_map_marker',
            'label' => __('Map marker icon', ST_TEXTDOMAIN),
            'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_hotel',
            'std' => 'http://maps.google.com/mapfiles/marker_black.png'
        ),
        /*------------- End Hotel Option --------------*/
        /*------------- Hotel Room Option --------------*/
        array(
            'id' => 'hotel_room_search_layout',
            'label' => __('Select room search layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout for searching room', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_hotel_room_search',
            'section' => 'option_hotel_room'
        ),
        array(
            'id' => 'hotel_room_search_result_page',
            'label' => __('Room Search Result Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show room search results', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_hotel_room',
        ),
        array(
            'id' => 'hotel_single_room_layout',
            'label' => __('Single room layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show single room', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'hotel_room',
            'section' => 'option_hotel_room'
        ),
        'flied_room' => array(
            'id' => 'room_search_fields',
            'label' => __('Room advanced search fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, edit, delete, drag and drop any fields to setup advanced form', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_hotel_room',
            'std' => array(
                array(
                    'title' => __('Where are you going?', ST_TEXTDOMAIN),
                    'name' => 'location',
                    'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12

                ),
                array(
                    'title' => __('Check in', ST_TEXTDOMAIN),
                    'name' => 'checkin',
                    'layout_col' => 3,
                    'layout2_col' => 3
                ),
                array(
                    'title' => __('Check out', ST_TEXTDOMAIN),
                    'name' => 'checkout',
                    'layout_col' => 3,
                    'layout2_col' => 3
                ),
                array(
                    'title' => __('Room(s)', ST_TEXTDOMAIN),
                    'name' => 'room_num',
                    'layout_col' => 3,
                    'layout2_col' => 3
                )
            ),
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STRoom::get_search_fields_name()
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'st_select_tax',
                    'post_type' => 'hotel_room'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'taxonomy_room',
                    'label' => __('Taxonomy Room', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'st_select_tax',
                    'post_type' => 'hotel_room'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel_room',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'name:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),

            )
        ),
        array(
            'id' => 'hotel_room_allow_search_advance',
            'label' => __('Allow advanced search', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_hotel_room',
            'std' => 'off',
        ),
        array(
            'id' => 'hotel_room_search_advance',
            'label' => __('Room advanced search fields', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_hotel_room',
            'condition' => 'hotel_room_allow_search_advance:is(on)',
            'desc' => __('You can add, edit, delete, drag and drop any field for setup advanced form', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STRoom::get_search_fields_name()

                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'hotel_room'
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'type_show_taxonomy_hotel_room',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy_room)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'name:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => "",
        ),

        /*------------- End Hotel Room Option --------------*/


        /*------------- Rental Option -----------------*/
        array(
            'id' => 'rental_search_result_page',
            'label' => __('Select Search Result Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show search results page for rental', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_rental',
        ),
        array(
            'id' => 'rental_single_layout',
            'label' => __('Rental Single Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show single retal', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_rental',
            'section' => 'option_rental'
        ),
        array(
            'id' => 'rental_search_layout',
            'label' => __('Rental Search Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show rental search page', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_rental_search',
            'section' => 'option_rental'
        ),
        array(
            'id' => 'rental_room_layout',
            'label' => __('Rental Room Default Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show single room rental page', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'rental_room',
            'section' => 'option_rental'
        ),
        array(
            'id' => 'rental_review',
            'label' => __('Review options', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on review feature for rental', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_rental',
            'std' => 'on'

        ),

        array(
            'id' => 'rental_review_stats',
            'label' => __('Rental Review Criteria', ST_TEXTDOMAIN),
            'desc' => __('You can add, delete, sort review criteria for rental', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_rental',
            'condition' => 'rental_review:is(on)',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Stat Name', ST_TEXTDOMAIN),
                    'type' => 'textblock',
                )
            ),
            'std' => array(

                array('title' => 'Sleep'),
                array('title' => 'Location'),
                array('title' => 'Service'),
                array('title' => 'Cleanliness'),
                array('title' => 'Room(s)'),
            )
        ),
        array(
            'id' => 'rental_sidebar_pos',
            'label' => __('Rental slidebar position', ST_TEXTDOMAIN),
            'desc' => __('The position to show sidebar for rental', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_rental',
            'choices' => array(
                array(
                    'value' => 'no',
                    'label' => __('No', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'left',
                    'label' => __('Left', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'right',
                    'label' => __('Right', ST_TEXTDOMAIN)
                )

            ),
            'std' => 'left'

        ),
        array(
            'id' => 'rental_sidebar_area',
            'label' => __('Sidebar Area', ST_TEXTDOMAIN),
            'desc' => __('Select a sidebar widget to display for rental', ST_TEXTDOMAIN),
            'type' => 'sidebar-select',
            'section' => 'option_rental',
            'std' => 'rental-sidebar'

        ),
        array(
            'id' => 'is_featured_search_rental',
            'label' => __('Show featured rentals on top of search result', ST_TEXTDOMAIN),
            'desc' => __('ON: Show featured items on top of result search page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_rental'
        ),
        array(
            'id' => 'rental_search_fields',
            'label' => __('Rental Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, delete, sort rental search fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_rental',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => TravelHelper::st_get_field_search('st_rental', 'option_tree')
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Large-box column size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout_col2',
                    'label' => __('Small-box column size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'operator' => 'and',
                    'condition' => 'name:is(taxonomy)',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_rental'
                ),
                array(
                    'id' => 'type_show_taxonomy_rental',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'name:is(list_name)',
                    'operator' => 'and',
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array(
                    'title' => __('Where are you going?', ST_TEXTDOMAIN),
                    'name' => 'location',
                    'placeholder' => __('Location/ Zipcode', ST_TEXTDOMAIN),
                    'layout_col' => '12',
                    'layout_col2' => '12'
                ),
                array(
                    'title' => __('Check in', ST_TEXTDOMAIN),
                    'name' => 'checkin',
                    'layout_col' => '3',
                    'layout_col2' => '3'
                ),
                array(
                    'title' => __('Check out', ST_TEXTDOMAIN),
                    'name' => 'checkout',
                    'layout_col' => '3',
                    'layout_col2' => '3'
                ),
                array(
                    'title' => __('Room(s)', ST_TEXTDOMAIN),
                    'name' => 'room_num',
                    'layout_col' => '3',
                    'layout_col2' => '3'
                ),
                array(
                    'title' => __('Adults', ST_TEXTDOMAIN),
                    'name' => 'adult',
                    'layout_col' => '3',
                    'layout_col2' => '3'
                )
            )
        ),
        array(
            'id' => 'allow_rental_advance_search',
            'label' => __("Allowed Rental Advanced Search", ST_TEXTDOMAIN),
            'desc' => __("ON: Turn on this mode to add advanced search fields", ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => "off",
            'section' => 'option_rental'
        ),
        array(
            'id' => 'rental_advance_search_fields',
            'label' => __('Rental advanced search fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort advanced search fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_rental',
            'condition' => "allow_rental_advance_search:is(on)",
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => TravelHelper::st_get_field_search('st_rental', 'option_tree')
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Large-box column size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout_col2',
                    'label' => __('Small-box column size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'operator' => 'and',
                    'condition' => 'name:is(taxonomy)',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_rental'
                ),
                array(
                    'id' => 'type_show_taxonomy_rental',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'name:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'condition' => 'name:is(list_name)',
                    'operator' => 'and',
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array(
                    'title' => __('Amenities', ST_TEXTDOMAIN),
                    'name' => 'taxonomy',
                    'layout_col' => '12',
                    'layout_col2' => '12',
                    'taxonomy' => 'amenities'
                ),
                array(
                    'title' => __('Suitabilities', ST_TEXTDOMAIN),
                    'name' => 'taxonomy',
                    'layout_col' => '12',
                    'layout_col2' => '12',
                    'taxonomy' => 'suitability'
                ),
            )
        ),
        array(
            'id' => 'rental_unlimited_custom_field',
            'label' => __('Rental custom fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_rental',
            'desc' => __('You can create, add custom fields for rental', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'type_field',
                    'label' => __('Field type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'text',
                            'label' => __('Text field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'textarea',
                            'label' => __('Textarea field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'date-picker',
                            'label' => __('Date field', ST_TEXTDOMAIN)
                        ),
                    )

                ),
                array(
                    'id' => 'default_field',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),

            ),
        ),
        array(
            'id' => 'st_rental_icon_map_marker',
            'label' => __('Map marker icon', ST_TEXTDOMAIN),
            'desc' => __('Select map icon to show rental on Map Google', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_rental',
            'std' => 'http://maps.google.com/mapfiles/marker_brown.png'
        ),
        /*------------ End Rental Option --------------*/

        /*------------- Cars Option -----------------*/
        array(
            'id' => 'car_equipment_info_limit',
            'label' => __('Equipment Limit', ST_TEXTDOMAIN),
            'desc' => __('Number of equipment showing on search results', ST_TEXTDOMAIN),
            'std' => 15,
            'type' => 'numeric-slider',
            'min_max_step' => '0,50, 1',
            'section' => 'option_car',
        ),
        array(
            'id' => 'cars_search_result_page',
            'label' => __('Search Result Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show search results for car', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_car',
        ),
        array(
            'id' => 'cars_single_layout',
            'label' => __('Cars Single Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show single car', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_cars',
            'section' => 'option_car',
        ),
        array(
            'id' => 'cars_layout_layout',
            'label' => __('Cars Search Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show search page for car', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_cars_search',
            'section' => 'option_car',
        ),
        array(
            'id' => 'cars_price_unit',
            'label' => __('Price unit', ST_TEXTDOMAIN),
            'desc' => __('The unit to calculate the price of car<br/>Day: The price is calculated according to day<br/>Hour: The price is calculated according to hour<br/>Distance: The price is calculated according to distance', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_car',
            'choices' => STCars::get_option_price_unit(),
            'std' => 'day'
        ),
        array(
            'id' => 'cars_price_by_distance',
            'label' => __('Price by distance', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_car',
            'choices' => array(
                array(
                    'value' => 'kilometer',
                    'label' => __('Kilometer', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'mile',
                    'label' => __('Mile', ST_TEXTDOMAIN)
                )
            ),
            'std' => 'kilometer',
            'condition' => 'cars_price_unit:is(distance)'
        ),
        /*array(
            'id' => 'equipment_by_unit',
            'label' => __('Set equipment price by day/hour', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_car',
            'operator' => 'or',
            'condition' => 'cars_price_unit:is(day),cars_price_unit:is(hour)'
        ),*/
        array(
            'id' => 'booking_days_included',
            'label' => __('Set default booking info', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_car',
            'desc' => __("ON: Add one day / hour into day / hour for check in.<br/>For example: 22-23/11/2017 will be 2 days.", ST_TEXTDOMAIN)
        ),
        array(
            'id' => 'is_featured_search_car',
            'label' => __('Show featured cars on top of search results', ST_TEXTDOMAIN),
            'desc' => __('Show featured cars on top of result search page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_car'
        ),
        array(
            'id' => 'car_search_fields',
            'label' => __('Car Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort search fields for car', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_car',
            'settings' => array(

                array(
                    'id' => 'field_atrribute',
                    'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STCars::get_search_fields_name()
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col_normal',
                    'label' => __('Layout Normal size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_cars'
                ),
                array(
                    'id' => 'type_show_taxonomy_cars',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(list_name)',
                    'type' => 'text',
                    'operator' => 'and',
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => 'Pick Up From, Drop Off To', 'layout_col_normal' => 12, 'field_atrribute' => 'location'),
                array('title' => 'Pick-up Date ,Pick-up Time',
                    'layout_col_normal' => 6,
                    'field_atrribute' => 'pick-up-date-time'
                ),
                array('title' => 'Drop-off Date ,Drop-off Time',
                    'layout_col_normal' => 6,
                    'field_atrribute' => 'drop-off-date-time'
                ),
            )
        ),
        array(
            'id' => 'car_allow_search_advance',
            'label' => __('Allow advanced search', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_car'
        ),
        array(
            'id' => 'car_advance_search_fields',
            'label' => __('Allowed Advanced Search  ', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on thiis mode to add advanced search  ', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_car',
            'condition' => 'car_allow_search_advance:is(on)',
            'settings' => array(

                array(
                    'id' => 'field_atrribute',
                    'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STCars::get_search_fields_name()
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col_normal',
                    'label' => __('Layout Normal size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_cars'
                ),
                array(
                    'id' => 'type_show_taxonomy_cars',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(list_name)',
                    'type' => 'text',
                    'operator' => 'and',
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => __('Taxonomy', ST_TEXTDOMAIN), 'layout_col_normal' => 12, 'field_atrribute' => 'taxonomy'),
                array('title' => __('Filter Price', ST_TEXTDOMAIN),
                    'layout_col_normal' => 12,
                    'field_atrribute' => 'price_slider',
                ),
            )
        ),
        array(
            'id' => 'car_search_fields_box',
            'label' => __('Location & Date Change Box', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort fields in the change box for car search in the car single page', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_car',
            'settings' => array(


                array(
                    'id' => 'field_atrribute',
                    'label' => __('Field Atrribute', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STCars::get_search_fields_name()
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col_box',
                    'label' => __('Layout Box size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11/12', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12/12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_cars'
                ),
                array(
                    'id' => 'type_show_taxonomy_cars',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'condition' => 'field_atrribute:is(list_name)',
                    'type' => 'text',
                    'operator' => 'and',
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => 'Pick Up From, Drop Off To', 'layout_col_box' => 6, 'field_atrribute' => 'location'),
                array('title' => 'Pick-up Date', 'layout_col_box' => 3, 'field_atrribute' => 'pick-up-date'),
                array('title' => 'Pick-up Time', 'layout_col_box' => 3, 'field_atrribute' => 'pick-up-time'),
                array('title' => 'Drop-off Date', 'layout_col_box' => 3, 'field_atrribute' => 'drop-off-date'),
                array('title' => 'Drop-off Time', 'layout_col_box' => 3, 'field_atrribute' => 'drop-off-time'),

            )
        ),
        array(
            'id' => 'car_review',
            'label' => __('Review options', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on the mode of car review', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_car',
            'std' => 'on'

        ),
        array(
            'id' => 'car_review_stats',
            'label' => __('Review criterias', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort review criteria for car', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_car',
            'condition' => 'car_review:is(on)',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Stat Name', ST_TEXTDOMAIN),
                    'type' => 'textblock',
                    'operator' => 'and',
                )
            ),
            'std' => array(

                array('title' => 'stat name 1'),
                array('title' => 'stat name 2'),
                array('title' => 'stat name 3'),
                array('title' => 'stat name 4'),
                array('title' => 'stat name 5'),
            )
        ),
        array(
            'id' => 'st_cars_unlimited_custom_field',
            'label' => __('Car custom fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_car',
            'desc' => __('You can create, add custom fields for car', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'type_field',
                    'label' => __('Field type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'text',
                            'label' => __('Text field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'textarea',
                            'label' => __('Textarea field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'date-picker',
                            'label' => __('Date field', ST_TEXTDOMAIN)
                        ),
                    )

                ),
                array(
                    'id' => 'default_field',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),

            ),
        ),
        array(
            'id' => 'st_cars_icon_map_marker',
            'label' => __('Map marker icon', ST_TEXTDOMAIN),
            'desc' => __('Select map icon to show car on Map Google', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_car',
            'std' => 'http://maps.google.com/mapfiles/marker_green.png'
        ),
        /*------------ End Car Option --------------*/


        /*------------ Begin Email Option --------------*/

        array(
            'id' => 'email_from',
            'label' => __('From name', ST_TEXTDOMAIN),
            'desc' => __('Email from name', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_email',
            'std' => 'Traveler Shinetheme'

        ),
        array(
            'id' => 'email_from_address',
            'label' => __('From address', ST_TEXTDOMAIN),
            'desc' => __('Email from address', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_email',
            'std' => 'traveler@shinetheme.com'

        )
    ,
        array(
            'id' => 'email_logo',
            'label' => __('Select logo in email', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_email',
            'desc' => __('Logo in Email', ST_TEXTDOMAIN),
            'std' => get_template_directory_uri() . '/img/logo.png'

        ),

        array(
            'id' => 'enable_email_for_custommer',
            'label' => __('Email to customer after booking', ST_TEXTDOMAIN),
            'desc' => __('Email to customer after booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_email',
        ),
        array(
            'id' => 'enable_email_confirm_for_customer',
            'label' => __('Email confirm to customer after booking', ST_TEXTDOMAIN),
            'desc' => __('Email confirm to customer after booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_email',
            //'condition' => 'enable_email_for_custommer:is(on)' ,
        ),
        array(
            'id' => 'enable_email_for_admin',
            'label' => __('Email to administrator after booking', ST_TEXTDOMAIN),
            'desc' => __('Email to administrator after booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_email',
        ),
        array(
            'id' => 'email_admin_address',
            'label' => __('Input administrator email', ST_TEXTDOMAIN),
            'desc' => __('Booking information will be sent to here', ST_TEXTDOMAIN),
            'type' => 'text',
            'condition' => '',
            'section' => 'option_email',
        ),
        array(
            'id' => 'enable_email_for_owner_item',
            'label' => __('Email after booking for partner/owner item', ST_TEXTDOMAIN),
            'desc' => __('Email after booking for partner/owner item', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_email',
        ),
        array(
            'id' => 'enable_email_approved_item',
            'label' => __('Email to partner when item approved by administrator', ST_TEXTDOMAIN),
            'desc' => __('Email to partner when item approved by administrator', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_email',
        ),
        array(
            'id' => 'enable_email_cancel',
            'label' => __('Email to administrator when have an cancel booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'desc' => __('Email to administrator when have an cancel booking', ST_TEXTDOMAIN),
            'section' => 'option_email'
        ),
        array(
            'id' => 'enable_partner_email_cancel',
            'label' => __('Email to partner when have an cancel booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'desc' => __('Email to partner when have an cancel booking', ST_TEXTDOMAIN),
            'section' => 'option_email'
        ),
        array(
            'id' => 'enable_email_cancel_success',
            'label' => __('Email to user when booking is cancelled', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'desc' => __('Email to user when booking is cancelled', ST_TEXTDOMAIN),
            'section' => 'option_email'
        ),
        /*------------ End Email Option --------------*/
        /*-------------Email Template ----------------*/
        array(
            'id' => 'tab_email_document',
            'label' => __('Email Documents', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_document',
            'label' => __('Email Documents', ST_TEXTDOMAIN),
            'type' => 'email_template_document',
            'section' => 'option_email_template',
        ),
	    array(
		    'id' => 'tab_email_header_footer',
		    'label' => __('Email Header/Footer', ST_TEXTDOMAIN),
		    'type' => 'tab',
		    'section' => 'option_email_template',
	    ),
	    array(
		    'id' => 'email_head_foot_on_off',
		    'label' => __('User this header and footer for all template', ST_TEXTDOMAIN),
		    'type' => 'on-off',
		    'section' => 'option_email_template',
            'std' => 'off'
	    ),
	    array(
		    'id' => 'email_header',
		    'label' => __('Email header template', ST_TEXTDOMAIN),
		    'type' => 'textarea',
		    'rows' => '10',
		    'section' => 'option_email_template',
		    'condition' => 'email_head_foot_on_off:is(on)',
		    'std' => function_exists('st_default_email_header_template') ? st_default_email_header_template() : false
	    ),
	    array(
		    'id' => 'email_footer',
		    'label' => __('Email footer template', ST_TEXTDOMAIN),
		    'type' => 'textarea',
		    'rows' => '10',
		    'section' => 'option_email_template',
		    'condition' => 'email_head_foot_on_off:is(on)',
		    'std' => function_exists('st_default_email_footer_template') ? st_default_email_footer_template() : false
	    ),
        array(
            'id' => 'tab_email_for_admin',
            'label' => __('Email For Admin', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_for_admin',
            'label' => __('Email template send to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_template',
            'std' => function_exists('st_default_email_template_admin') ? st_default_email_template_admin() : false
        ),

        array(
            'id' => 'tab_email_for_partner',
            'label' => __('Email For Partner', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_for_partner',
            'label' => __('Email template send to partner/owner', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('st_default_email_template_partner') ? st_default_email_template_partner() : false
        ),
        //Email to partner when expired date
        array(
            'id' => 'email_for_partner_expired_date',
            'label' => __('Email template send to partner when package is expired date', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('st_default_email_template_partner_expired_date') ? st_default_email_template_partner_expired_date() : false
        ),
        array(
            'id' => 'tab_email_for_customer',
            'label' => __('Email For Customer', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_for_customer',
            'label' => __('Email template for booking info send to customer', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('st_default_email_template_customer') ? st_default_email_template_customer() : false
        ),
        //Email to custommer when out of date
        array(
            'id' => 'email_for_customer_out_of_depature_date',
            'label' => __('Email template for notification of departure date send to customer', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('st_default_email_template_notification_depature_customer') ? st_default_email_template_notification_depature_customer() : false
        ),
        array(
            'id' => 'tab_email_confirm',
            'label' => __('Email Confirm', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_confirm',
            'label' => __('Email template for confirm send to customer', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_confirm_template') ? get_email_confirm_template() : false
        ),
        array(
            'id' => 'tab_email_approved',
            'label' => __('Email Approved', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_approved_subject',
            'label' => __('Email Subject', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_email_template',
            'std' => __('You have a item is approved', ST_TEXTDOMAIN),
        ),
        array(
            'id' => 'email_approved',
            'label' => __('Email template for approve send to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_approved_template') ? get_email_approved_template() : false
        ),
        array(
            'id' => 'tab_email_cancel_booking',
            'label' => __('Email Cancel Booking', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_template',
        ),
        array(
            'id' => 'email_has_refund',
            'label' => __('Email template for cancel booking send to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_has_refund_template') ? get_email_has_refund_template() : false
        ),
        array(
            'id' => 'email_has_refund_for_partner',
            'label' => __('Email template for cancel booking send to partner', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '50',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_has_refund_for_partner_template') ? get_email_has_refund_for_partner_template() : false
        ),
        array(
            'id' => 'email_cancel_booking_success_for_partner',
            'label' => __('Email template for successful canceled send to partner', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '100',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_cancel_booking_success_for_partner_template') ? get_email_cancel_booking_success_for_partner_template() : false
        ),
        array(
            'id' => 'email_cancel_booking_success',
            'label' => __('Email template for successful canceled send to customer', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '100',
            'section' => 'option_email_template',
            'std' => function_exists('get_email_cancel_booking_success_template') ? get_email_cancel_booking_success_template() : false
        ),

        /*------------- End Email Template ----------------*/

        /*------------- Activity - Tour Option  -----------------*/
        array(
            'id' => 'tour_show_calendar',
            'label' => __('Show calendar', ST_TEXTDOMAIN),
            'desc' => __('ON: Show calendar<br/>OFF: Show small calendar in form of popup', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'label' => __('Big calendar show in content', ST_TEXTDOMAIN),
                    'value' => 'on'
                ),
                array(
                    'label' => __('Show calendar as date picker', ST_TEXTDOMAIN),
                    'value' => 'off'
                ),
            ),
            'section' => 'option_activity_tour',
            'std' => 'on'

        ),
        array(
            'id' => 'tour_show_calendar_below',
            'label' => __('Calendar position', ST_TEXTDOMAIN),
            'desc' => __('ON: Show calendar below book form<br/>OF: Show calendar above book form', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'label' => __('Under check availability', ST_TEXTDOMAIN),
                    'value' => 'off'
                ),
                array(
                    'label' => __('Below check availability', ST_TEXTDOMAIN),
                    'value' => 'on'
                ),
            ),
            'section' => 'option_activity_tour',
            'std' => 'off',
            'condition' => 'tour_show_calendar:is(on)',
        ),

        array(
            'id' => 'activity_tour_review',
            'label' => __('Review options', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on the mode for reviewing tour', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_activity_tour',
            'std' => 'on'

        ),
        array(
            'id' => 'tour_review_stats',
            'label' => __('Review criteria', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort review criteria for tour', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_activity_tour',
            'condition' => 'activity_tour_review:is(on)',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Stat Name', ST_TEXTDOMAIN),
                    'type' => 'textblock',
                    'operator' => 'and',
                )
            ),
            'std' => array(

                array('title' => 'Sleep'),
                array('title' => 'Location'),
                array('title' => 'Service'),
                array('title' => 'Cleanliness'),
                array('title' => 'Room(s)'),
            )
        ),
        array(
            'id' => 'tours_search_result_page',
            'label' => __('Select layout for result page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_activity_tour',
        ),
        array(
            'id' => 'tours_layout',
            'label' => __('Tour Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show single tour ', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_tours',
            'section' => 'option_activity_tour',
        ),
        array(
            'id' => 'tours_search_layout',
            'label' => __('Tour Search Result Page', ST_TEXTDOMAIN),
            'desc' => __('Select page to show search results for tour', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_tours_search',
            'section' => 'option_activity_tour',
        ),
        array(
            'id' => 'tour_sidebar_pos',
            'label' => __('Sidebar position', ST_TEXTDOMAIN),
            'desc' => __('Just apply for default search layout', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_activity_tour',
            'condition' => 'tours_search_layout:is()',
            'choices' => array(
                array(
                    'value' => 'no',
                    'label' => __('No', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'left',
                    'label' => __('Left', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'right',
                    'label' => __('Right', ST_TEXTDOMAIN)
                )

            ),
            'std' => 'left'
        ),
        array(
            'id' => 'is_featured_search_tour',
            'label' => __('Show featured tours on top of search result', ST_TEXTDOMAIN),
            'desc' => __('ON: Show featured tours on top of result search page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_activity_tour'
        ),
        array(
            'id' => 'activity_tour_search_fields',
            'label' => __('Tour Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort search fields for tour', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_activity_tour',
            'settings' => array(

                array(
                    'id' => 'tours_field_search',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STTour::get_search_fields_name(),
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_tours'
                ),
                array(
                    'id' => 'type_show_taxonomy_tours',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => __('Where', ST_TEXTDOMAIN),
                    'layout_col' => 6,
                    'layout2_col' => 6,
                    'tours_field_search' => 'address',
                    'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN)
                ),
                array('title' => __('Departure date', ST_TEXTDOMAIN),
                    'layout_col' => 3,
                    'layout2_col' => 3,
                    'tours_field_search' => 'check_in'
                ),
                array('title' => __('Arrival Date', ST_TEXTDOMAIN),
                    'layout_col' => 3,
                    'layout2_col' => 3,
                    'tours_field_search' => 'check_out'
                ),
            )
        ),
        array(
            'id' => "tour_allow_search_advance",
            'label' => __("Allowed Tour  Advanced Search", ST_TEXTDOMAIN),
            'desc' => __("ON: Turn on thiis mode to add advanced search of tour", ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => "off",
            'section' => 'option_activity_tour'
        ),
        array(
            'id' => 'tour_advance_search_fields',
            'label' => __('Tour advanced search fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort advanced search fields of tour', ST_TEXTDOMAIN),
            'condition' => 'tour_allow_search_advance:is(on)',
            'type' => 'Slider',
            'section' => 'option_activity_tour',
            'settings' => array(

                array(
                    'id' => 'tours_field_search',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STTour::get_search_fields_name(),
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_tours'
                ),
                array(
                    'id' => 'type_show_taxonomy_tours',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __("Max number", ST_TEXTDOMAIN),
                    'condition' => 'tours_field_search:is(list_name)',
                    'type' => "text",
                    'std' => 20
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => __('Tour Duration ', ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'tours_field_search' => 'duration-dropdown'
                ),
                array('title' => __('Taxonomy', ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'tours_field_search' => 'taxonomy',
                    'taxonomy' => 'st_tour_type'
                ),
            )
        ),
        array(
            'id' => 'st_show_number_user_book',
            'label' => __('Number of tour booked users', ST_TEXTDOMAIN),
            'desc' => __('ON: Show number of users who booked tour on each item in search results page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_activity_tour',
            'std' => 'off'
        ),
        array(
            'id' => 'tours_unlimited_custom_field',
            'label' => __('Tour custom fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_activity_tour',
            'desc' => __('You can create custom fields for tour. Fields will be displayed in metabox of single tour', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'type_field',
                    'label' => __('Field type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'text',
                            'label' => __('Text field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'textarea',
                            'label' => __('Textarea field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'date-picker',
                            'label' => __('Date field', ST_TEXTDOMAIN)
                        ),
                    )

                ),
                array(
                    'id' => 'default_field',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),

            ),
        ),
        array(
            'id' => 'st_tours_icon_map_marker',
            'label' => __('Map marker icon', ST_TEXTDOMAIN),
            'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_activity_tour',
            'std' => 'http://maps.google.com/mapfiles/marker_purple.png'
        ),
        /*------------- Activity - Tour Option  -----------------*/

        /*------------- Activity Option  -----------------*/
        array(
            'id' => 'activity_show_calendar',
            'label' => __('Show calendar', ST_TEXTDOMAIN),
            'desc' => __('ON: Show calendar<br/>OFF: Show small calendar in form of popup', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'label' => __('Big calendar show in content', ST_TEXTDOMAIN),
                    'value' => 'on'
                ),
                array(
                    'label' => __('Show calendar as date picker', ST_TEXTDOMAIN),
                    'value' => 'off'
                ),
            ),
            'section' => 'option_activity',
            'std' => 'on'

        ),
        array(
            'id' => 'activity_show_calendar_below',
            'label' => __('Calendar position', ST_TEXTDOMAIN),
            'desc' => __('ON: Show calendar below book form<br/>OFF: Show calendar above book form', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'label' => __('Under check availability', ST_TEXTDOMAIN),
                    'value' => 'off'
                ),
                array(
                    'label' => __('Below check availability', ST_TEXTDOMAIN),
                    'value' => 'on'
                ),
            ),
            'section' => 'option_activity',
            'std' => 'off',
            'condition' => 'activity_show_calendar:is(on)',
        ),
        array(
            'id' => 'activity_search_result_page',
            'label' => __('Activity Search Result Page', ST_TEXTDOMAIN),
            'label' => __('Select page to show search results for activity', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_activity',
        ),
        array(
            'id' => 'activity_review',
            'label' => __('Review options', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on the mode for reviewing activity', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_activity',
            'std' => 'on'
        ),
        array(
            'id' => 'activity_review_stats',
            'label' => __('Review criteria', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort review criteria for activity', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_activity',
            'condition' => 'activity_review:is(on)',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Stat Name', ST_TEXTDOMAIN),
                    'type' => 'textblock',
                    'operator' => 'and',
                )
            ),
            'std' => array(

                array('title' => 'Sleep'),
                array('title' => 'Location'),
                array('title' => 'Service'),
                array('title' => 'Cleanliness'),
                array('title' => 'Room(s)'),
            )
        ),
        array(
            'id' => 'activity_layout',
            'label' => __('Activity Layout', ST_TEXTDOMAIN),
            'label' => __('Select layout to show single activity', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_activity',
            'section' => 'option_activity',
        ),
        array(
            'id' => 'activity_search_layout',
            'label' => __('Activity Search Layout', ST_TEXTDOMAIN),
            'desc' => __('Select layout to show search results for activity', ST_TEXTDOMAIN),
            'type' => 'st_select_layout',
            'post_type' => 'st_activity_search',
            'section' => 'option_activity',
        ),
        array(
            'id' => 'activity_sidebar_pos',
            'label' => __('Sidebar Position', ST_TEXTDOMAIN),
            'desc' => __('Just apply for default search layout', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_activity',
            'condition' => 'activity_search_layout:is()',
            'choices' => array(
                array(
                    'value' => 'no',
                    'label' => __('No', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'left',
                    'label' => __('Left', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'right',
                    'label' => __('Right', ST_TEXTDOMAIN)
                )

            ),
            'std' => 'left'
        ),
        array(
            'id' => 'is_featured_search_activity',
            'label' => __('Show featured activities on top of search result', ST_TEXTDOMAIN),
            'desc' => __('ON: Show featured activities on top of result search page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_activity'
        ),
        array(
            'id' => 'activity_search_fields',
            'label' => __('Activity  Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort search fields for activity', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_activity',
            'settings' => array(

                array(
                    'id' => 'activity_field_search',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => class_exists('STActivity')?STActivity::get_search_fields_name():[]
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_activity'
                ),
                array(
                    'id' => 'type_show_taxonomy_activity',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(list_name)',
                    'type' => 'text',
                    'operator' => 'and',
                    'std' => '20'
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => 'Address',
                    'layout_col' => 3,
                    'layout2_col' => 6,
                    'activity_field_search' => 'address',
                    'placeholder' => __("Location/ Zipcode", ST_TEXTDOMAIN),
                ),
                array('title' => 'From',
                    'layout_col' => 3,
                    'layout2_col' => 3,
                    'activity_field_search' => 'check_in'
                ),
                array('title' => 'To',
                    'layout_col' => 3,
                    'layout2_col' => 3,
                    'activity_field_search' => 'check_out'
                ),
            )
        ),
        array(
            'id' => 'allow_activity_advance_search',
            'label' => __('Allowed Activity  Advanced Search', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on thiis mode to add advanced search of activities', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_activity'
        ),
        array(
            'id' => 'activity_advance_search_fields',
            'label' => __('Activity Advanced Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort advanced search fields of activity', ST_TEXTDOMAIN),
            'condition' => 'allow_activity_advance_search:is(on)',
            'type' => 'Slider',
            'section' => 'option_activity',
            'settings' => array(

                array(
                    'id' => 'activity_field_search',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => class_exists('STActivity')?STActivity::get_search_fields_name():[]
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(taxonomy)',
                    'operator' => 'and',
                    'type' => 'st_select_tax',
                    'post_type' => 'st_activity'
                ),
                array(
                    'id' => 'type_show_taxonomy_activity',
                    'label' => __('Type show', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(taxonomy)',
                    'operator' => 'or',
                    'type' => 'select',
                    'choices' => array(
                        array(
                            'value' => 'checkbox',
                            'label' => __('Checkbox', ST_TEXTDOMAIN),
                        ),
                        array(
                            'value' => 'select',
                            'label' => __('Select', ST_TEXTDOMAIN),
                        ),
                    )
                ),
                array(
                    'id' => 'max_num',
                    'label' => __('Max number', ST_TEXTDOMAIN),
                    'condition' => 'activity_field_search:is(list_name)',
                    'type' => 'text',
                    'operator' => 'and',
                    'std' => '20'
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => __('Taxonomy', ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'activity_field_search' => 'taxonomy',
                    'taxonomy' => 'attractions'
                ),
                array('title' => __('Price Filter', ST_TEXTDOMAIN),
                    'layout_col' => 12,
                    'layout2_col' => 12,
                    'activity_field_search' => 'price_slider'
                ),
            )
        ),
        array(
            'id' => 'st_activity_unlimited_custom_field',
            'label' => __('Activity custom fields', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_activity',
            'desc' => __('You can create custom fields for activity. Fields will be displayed in metabox of single activity', ST_TEXTDOMAIN),
            'settings' => array(
                array(
                    'id' => 'type_field',
                    'label' => __('Field type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'text',
                            'label' => __('Text field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'textarea',
                            'label' => __('Textarea field', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'date-picker',
                            'label' => __('Date field', ST_TEXTDOMAIN)
                        ),
                    )

                ),
                array(
                    'id' => 'default_field',
                    'label' => __('Default', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and'
                ),
            ),
        ),
        array(
            'id' => 'st_activity_icon_map_marker',
            'label' => __('Map marker icon', ST_TEXTDOMAIN),
            'desc' => __('Select map icon to show hotel on Map Google', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_activity',
            'std' => 'http://maps.google.com/mapfiles/marker_yellow.png'
        ),
        /*------------- Activity  Option  -----------------*/
        array(
            'id' => 'car_transfer_search_page',
            'label' => __('Select page to show search results for transfer', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_car_transfer',
        ),
        array(
            'id' => 'car_transfer_search_fields',
            'label' => __('Transfer Search Fields', ST_TEXTDOMAIN),
            'desc' => __('You can add, sort search fields for transfer', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_car_transfer',
            'settings' => array(
                array(
                    'id' => 'name',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => STCarTransfer::get_search_fields_name(),
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'layout2_col',
                    'label' => __('Layout 2 Size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'std' => 4,
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
        ),
        /*----------- Hotel Alone Options--------------*/
        /*----------------Begin Header --------------------*/
        array(
            'id' => 'hotel_alone_general_setting',
            'label' => esc_html__('General Options',ST_TEXTDOMAIN ),
            'type' => 'tab',
            'section' => 'option_hotel_alone' ,
        ),
        array(
            'id' => 'hotel_alone_logo',
            'label' => __('Logo options', ST_TEXTDOMAIN),
            'desc' => __('To change logo', ST_TEXTDOMAIN),
            'type' => 'upload',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id' => 'st_hotel_alone_main_color',
            'label' => __('Main Color', ST_TEXTDOMAIN),
            'desc' => __('To change the main color for web', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_hotel_alone',
            'std' => '#ed8323',

        ),
        array(
            'id' => 'st_hotel_alone_footer_page',
            'label' => __('Select footer page', ST_TEXTDOMAIN),
            'desc' => __('Select the page to display as footer', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id' => 'st_hotel_alone_room_search_page',
            'label' => __('Select room search page', ST_TEXTDOMAIN),
            'desc' => __('Select the page to display room result', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id'          => 'st_hotel_alone_blog_list_style',
            'label'       => esc_html__( 'Blog style', ST_TEXTDOMAIN ),
            'section'     => 'option_hotel_alone',
            'type' => 'select',
            'choices' => array(
                array(
                    'value' => 'list',
                    'label' => esc_html__('List', ST_TEXTDOMAIN),
                ),
                array(
                    'value' => 'grid',
                    'label' => esc_html__('Grid', ST_TEXTDOMAIN),
                ),
            )
        ),

        array(
            'id' => 'hotel_alone_topbar_setting',
            'label' => esc_html__('Topbar Options',ST_TEXTDOMAIN ),
            'type' => 'tab',
            'section' => 'option_hotel_alone' ,
        ),
        array(
            'id' => 'st_hotel_alone_topbar_style',
            'label' => esc_html__('TopBar style', ST_TEXTDOMAIN),
            'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
            'type' => 'radio-image',
            'section' => 'option_hotel_alone',
            'std'=>'none',
            'choices' => array(
                array(
                    'value' => 'none',
                    'label' => esc_html__('No Topbar', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/topbar/no_topbar.jpg'
                ),
                array(
                    'value' => 'style_1',
                    'label' => esc_html__('Style 1', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/topbar/topbar1.jpg'
                ),
                array(
                    'value' => 'style_2',
                    'label' => esc_html__('Style 2', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/topbar/topbar2.jpg'
                ),
                array(
                    'value' => 'style_3',
                    'label' => esc_html__('Style 3', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/topbar/topbar3.jpg'
                ),
                array(
                    'value' => 'style_4',
                    'label' => esc_html__('Style 4', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/topbar/topbar4.jpg'
                ),
            )
        ),
        array(
            'id' => 'st_hotel_alone_topbar_background_transparent',
            'label' => esc_html__("Topbar Background Transparent", ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std'=>'off',
            'section' => 'option_hotel_alone'
        ),
        array(
            'id' => 'st_hotel_alone_topbar_background',
            'label' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
            'desc' => esc_html__("Topbar Background", ST_TEXTDOMAIN),
            'type' => 'colorpicker_opacity',
            'section' => 'option_hotel_alone',
            'condition' => 'st_hotel_alone_topbar_background_transparent:is(off)',
            'operator' => 'or',
            'std'=>'#ffffff'
        ),
        array(
            'id' => 'st_hotel_alone_topbar_contact_number',
            'label' => esc_html__('Contact Number', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id' => 'st_hotel_alone_topbar_email_address',
            'label' => esc_html__('Email Address', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id'          => 'st_hotel_alone_topbar_location',
            'label'       => esc_html__( 'Location Select', ST_TEXTDOMAIN ),
            'section'     => 'option_hotel_alone',
            'type' => 'st_post_type_select',
            'post_type' => 'location'
        ),

        //Search form topbar
        array(
            'id' => 'hotel_alone_form_search_setting',
            'label' => esc_html__('Form Search On Topbar Options',ST_TEXTDOMAIN ),
            'type' => 'tab',
            'section' => 'option_hotel_alone' ,
        ),
        array(
            'id' => 'st_hotel_alone_topbar_title_search_form',
            'label' => esc_html__('Title Form Search', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel_alone',
        ),
        array(
            'id'       => 'st_hotel_alone_topbar_search_form' ,
            'label'    => esc_html__( 'Room search form' , ST_TEXTDOMAIN ) ,
            'desc'     => esc_html__( 'Room search fields' , ST_TEXTDOMAIN ) ,
            'type'     => 'list-item' ,
            'section'  => 'option_hotel_alone' ,
            'std' => array(
                array(
                    'title'       => esc_html__( 'Check in' , ST_TEXTDOMAIN ) ,
                    'placeholder'       => esc_html__( 'Check in' , ST_TEXTDOMAIN ) ,
                    'name'        => 'check_in' ,
                    'layout_size' => 6 ,
                ) ,
                array(
                    'title'       => esc_html__( 'Check out' , ST_TEXTDOMAIN ) ,
                    'placeholder'       => esc_html__( 'Check out' , ST_TEXTDOMAIN ) ,
                    'name'        => 'check_out' ,
                    'layout_size' => 6 ,
                ) ,
                array(
                    'title'       => esc_html__( 'Room' , ST_TEXTDOMAIN ) ,
                    'name'        => 'room_number' ,
                    'layout_size' => 6 ,
                ) ,
                array(
                    'title'       => esc_html__( 'Adult' , ST_TEXTDOMAIN ) ,
                    'name'        => 'adults' ,
                    'layout_size' => 6 ,
                )
            ) ,
            'settings' => array(
                array(
                    'id'       => 'name' ,
                    'label'    => esc_html__( 'Field Type' , ST_TEXTDOMAIN ) ,
                    'type'     => 'select' ,
                    'operator' => 'and' ,
                    'choices'  => st_hotel_alone_option_tree_convert_array(st_hotel_alone_get_search_fields_for_element())
                ) ,
                array(
                    'id'       => 'placeholder' ,
                    'label'    => esc_html__( 'Placeholder' , ST_TEXTDOMAIN ) ,
                    'desc'     => esc_html__( 'Placeholder' , ST_TEXTDOMAIN ) ,
                    'type'     => 'text' ,
                    'operator' => 'and' ,
                ) ,
                array(
                    'id'       => 'layout_size' ,
                    'label'    => esc_html__( 'Layout Normal Size' , ST_TEXTDOMAIN ) ,
                    'type'     => 'select' ,
                    'operator' => 'and' ,
                    'std'      => 6 ,
                    'choices'  => array(
                        array(
                            'value' => '1' ,
                            'label' => esc_html__( 'column 1' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '2' ,
                            'label' => esc_html__( 'column 2' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '3' ,
                            'label' => esc_html__( 'column 3' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '4' ,
                            'label' => esc_html__( 'column 4' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '5' ,
                            'label' => esc_html__( 'column 5' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '6' ,
                            'label' => esc_html__( 'column 6' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '7' ,
                            'label' => esc_html__( 'column 7' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '8' ,
                            'label' => esc_html__( 'column 8' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '9' ,
                            'label' => esc_html__( 'column 9' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '10' ,
                            'label' => esc_html__( 'column 10' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '11' ,
                            'label' => esc_html__( 'column 11' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => '12' ,
                            'label' => esc_html__( 'column 12' , ST_TEXTDOMAIN )
                        ) ,
                    ) ,
                ) ,

            )
        ) ,
        array(
            'id' => 'st_hotel_alone_topbar_desc_search_form',
            'label' => esc_html__('Description', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_hotel_alone',
        ),
        //----------------------------------------------------------------------------------------------------

        array(
            'id' => 'hotel_alone_menu_setting',
            'label' => esc_html__('Menu Options',ST_TEXTDOMAIN ),
            'type' => 'tab',
            'section' => 'option_hotel_alone' ,
        ),
        array(
            'id'          => 'st_hotel_alone_menu_location',
            'label'       => esc_html__( 'Menu Select', ST_TEXTDOMAIN ),
            'section'     => 'option_hotel_alone',
            'type' => 'st_post_type_select',
            'post_type' => 'nav_menu'
        ),
        array(
            'id' => 'st_hotel_alone_menu_style',
            'label' => esc_html__('Menu style', ST_TEXTDOMAIN),
            'desc' => esc_html__('Choose a layout for your theme', ST_TEXTDOMAIN),
            'type' => 'radio-image',
            'section' => 'option_hotel_alone',
            'choices' => array(
                array(
                    'value' => 'none',
                    'label' => esc_html__('None', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/menu/menu_none.jpg'
                ),
                array(
                    'value' => 'style_1',
                    'label' => esc_html__('Style 1', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/menu/menu1.jpg'
                ),
                array(
                    'value' => 'style_2',
                    'label' => esc_html__('Style 2', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/menu/menu2.jpg'
                ),
                array(
                    'value' => 'style_3',
                    'label' => esc_html__('Style 3', ST_TEXTDOMAIN),
                    'src'     => st_hotel_alone_load_assets_dir().'/images/menu/menu3.jpg'
                ),
            ),
            'std' => 'style_2'
        ),

        array(
            'id' => 'st_hotel_alone_left_menu',
            'label' => esc_html__('Left Menu', ST_TEXTDOMAIN),
            'section' => 'option_hotel_alone',
            'condition' => 'st_hotel_alone_menu_style:is(style_1)',
            'type' => 'st_post_type_select',
            'post_type' => 'nav_menu'
        ),
        array(
            'id' => 'st_hotel_alone_right_menu',
            'label' => esc_html__('Right Menu', ST_TEXTDOMAIN),
            'section' => 'option_hotel_alone',
            'condition' => 'st_hotel_alone_menu_style:is(style_1)',
            'type' => 'st_post_type_select',
            'post_type' => 'nav_menu'
        ),
        array(
            'id' => 'st_hotel_alone_menu_color',
            'label' => esc_html__('Menu color', ST_TEXTDOMAIN),
            'type' => 'colorpicker',
            'section' => 'option_hotel_alone',
            'std' => '#fff',
        ),
        array(
            'id' => 'st_hotel_alone_fixed_menu',
            'label' => esc_html__('Sticky Menu', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_hotel_alone',
            'std' => 'off',
        ),
        /*----------- End Hotel Alone Options--------------*/

        /*------------- Option Partner Option --------------------*/
        array(
            'id' => 'partner_general_tab',
            'label' => __("General Options", ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_partner',
        ),
        array(
            'id' => 'enable_automatic_approval_partner',
            'label' => __('Automatic approval', ST_TEXTDOMAIN),
            'desc' => __('Partner be automatic approval.', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'enable_pretty_link_partner',
            'label' => __('Allowed custom sort link for partner page', ST_TEXTDOMAIN),
            'desc' => __('ON: show link of partner page in form of pretty link', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'slug_partner_page',
            'label' => __('Slug of the partner page', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => 'page-user-setting',
            'desc' => __('Enter slug name of partner page to show pretty link', ST_TEXTDOMAIN),
            'condition' => 'enable_pretty_link_partner:is(on)',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_show_contact_info',
            'label' => __('Show email contact info', ST_TEXTDOMAIN),
            'desc' => __('ON: Show email of author(who posts service) in single, email page<br/>OFF: Show email entered in metabox of service', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_partner',
            'std' => 'off',
        ),
        array(
            'id' => 'partner_enable_feature',
            'label' => __('Enable Partner Feature', ST_TEXTDOMAIN),
            'desc' => __('ON: Show services for partner.<br/>OFF: Turn off services, partner is not allowed to register service, it is not displayed in dashboard', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_partner',
            'std' => 'off',
        ),
        array(
            'id' => 'partner_post_by_admin',
            'label' => __('Partner\'s post must be aprroved by admin', ST_TEXTDOMAIN),
            'desc' => __('ON: When partner posts a service, it needs to be approved by administrator ', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_partner',
            'std' => 'on'
        ),
        array(
            'id' => 'admin_menu_partner',
            'label' => __('Partner menubar', ST_TEXTDOMAIN),
            'desc' => __('ON: Turn on partner menubar <br/>OFF: Turn off partner menubar', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_partner',
            'std' => 'off'
        ),

        array(
            'id' => 'partner_commission',
            'label' => __('Commission(%)', ST_TEXTDOMAIN),
            'desc' => __('Enter commission of partner for admin after each item is booked ', ST_TEXTDOMAIN),
            'type' => 'numeric-slider',
            'section' => 'option_partner',
            'min_max_step' => '0,100,1',
        ),
        /*array(
            'id'      => 'partner_commission_required' ,
            'label'   => __( 'Commission Required' , ST_TEXTDOMAIN ) ,
            'desc'   => __( 'The payment amount must be greater than the commission' , ST_TEXTDOMAIN ) ,
            'type'    => 'on-off' ,
            'section' => 'option_partner' ,
            'std'     => 'off'
        ) ,*/
        array(
            'id' => 'partner_set_feature',
            'label' => __('Partner can set featured', ST_TEXTDOMAIN),
            'section' => 'option_partner',
            'type' => 'on-off',
            'desc' => __('It allows partner to set an item to be featured', ST_TEXTDOMAIN),
            'std' => 'off'
        ),
        array(
            'id' => 'partner_set_external_link',
            'label' => __('Partner can set external link for services', ST_TEXTDOMAIN),
            'section' => 'option_partner',
            'type' => 'on-off',
            'desc' => __('It allows partner to set external link for services', ST_TEXTDOMAIN),
            'std' => 'off'
        ),
        //1.3.0
        array(
            'id' => 'avatar_in_list_service',
            'label' => __('Show avatar user in list services', ST_TEXTDOMAIN),
            'section' => 'option_partner',
            'type' => 'on-off',
            'std' => 'off'
        ),
        array(
            'id' => 'membership_tab',
            'label' => __('Membership', ST_TEXTDOMAIN),
            'section' => 'option_partner',
            'type' => 'tab'
        ),
        array(
            'id' => 'enable_membership',
            'label' => __('Enable Membership', ST_TEXTDOMAIN),
            'type' => 'on_off',
            'std' => 'on',
            'section' => 'option_partner',
        ),
        array(
            'id' => 'member_packages_page',
            'label' => __('Member Packages Page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'desc' => __('Select a page for member packages page', ST_TEXTDOMAIN),
            'section' => 'option_partner'
        ),
        array(
            'id' => 'member_checkout_page',
            'label' => __('Member Checkout Page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'desc' => __('Select a checkout page for member packages', ST_TEXTDOMAIN),
            'section' => 'option_partner'
        ),
        array(
            'id' => 'member_success_page',
            'label' => __('Member Checkout Success Page', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'desc' => __('Select a checkout success page for member packages', ST_TEXTDOMAIN),
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_custom_layout_tab',
            'label' => __("Layout Dashboard", ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_partner',
        ),
        array(
            'id' => 'partner_custom_layout',
            'label' => __('Configuration partner profile info', ST_TEXTDOMAIN),
            'desc' => __('Show/hide sections for partner dashboard', ST_TEXTDOMAIN),
            'section' => 'option_partner',
            'type' => 'on-off',
            'std' => 'off'
        ),
        array(
            'id' => 'partner_custom_layout_total_earning',
            'label' => __('Show total earning', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'desc' => __('ON: Display earnings information in accordance with time periods', ST_TEXTDOMAIN),
            'std' => "on",
            'condition' => 'partner_custom_layout:is(on)',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_custom_layout_service_earning',
            'label' => __('Show each service earning', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'desc' => __('ON: Display earnings according to each service', ST_TEXTDOMAIN),
            'std' => "on",
            'condition' => 'partner_custom_layout:is(on)',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_custom_layout_chart_info',
            'label' => __('Show chart info', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'desc' => __('ON: Display visual graphs to follow your earnings through each time', ST_TEXTDOMAIN),
            'std' => "on",
            'condition' => 'partner_custom_layout:is(on)',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_custom_layout_booking_history',
            'label' => __('Show booking history', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'desc' => __('ON: Show book ing history of partner', ST_TEXTDOMAIN),
            'std' => "on",
            'condition' => 'partner_custom_layout:is(on)',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_withdrawal_options',
            'label' => __("Withdrawal Options", ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_partner',
        ),
        array(
            'id' => 'enable_withdrawal',
            'label' => __('Allow request withdrawal', ST_TEXTDOMAIN),
            'desc' => __('ON: Partner is allowed to withdraw money', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_partner'
        ),
        array(
            'id' => 'partner_withdrawal_payout_price_min',
            'label' => __('Minimum value request when withdrawal', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_partner',
            'desc' => __('Enter minimum value when a withdrawal is conducted', ST_TEXTDOMAIN),
            'std' => '100'
        ),
        array(
            'id' => 'partner_date_payout_this_month',
            'label' => __('Date of sucessful payment in current month', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_partner',
            'desc' => __('Enter the date monthly payment. Ex: 25', ST_TEXTDOMAIN),
            'std' => '25'
        ),
        array(
            'id' => 'partner_inbox_options',
            'label' => __("Inbox Options", ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_partner',
        ),
        array(
            'id' => 'enable_inbox',
            'label' => __('Allow request inbox', ST_TEXTDOMAIN),
            'desc' => __('ON: Partner is allowed to inbox', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'section' => 'option_partner'
        ),

        array(
            'id' => 'enable_send_email_partner',
            'label' => __('Allow send to partner', ST_TEXTDOMAIN),
            'desc' => __('It allows partner to receive email when there is a new message', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_partner'
        ),

        array(
            'id' => 'enable_send_email_buyer',
            'label' => __('Allow send to buyer', ST_TEXTDOMAIN),
            'desc' => __('It allows users to receive email when there is a new message', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_partner'
        ),


        /*------------- End Option Partner Option --------------------*/
        /*------------- Email Partner Template --------------------*/
        array(
            'id' => 'tab_partner_email_for_admin',
            'label' => __('[Register] Email For Admin', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_partner',
        ),
        array(
            'id' => 'partner_email_for_admin',
            'label' => __('[Register] Email to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_template_for_admin_partner') ? st_default_email_template_for_admin_partner() : false
        ),
        array(
            'id' => 'partner_resend_email_for_admin',
            'label' => __('[Register] Resend email to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_template_for_resend_admin_partner') ? st_default_email_template_for_resend_admin_partner() : false
        ),
        array(
            'id' => 'user_register_email_for_admin',
            'label' => __('[Register normal user] Email to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_register_user_normal_template_for_admin') ? st_default_email_register_user_normal_template_for_admin() : false
        ),
        array(
            'id' => 'tab_partner_email_for_customer',
            'label' => __('[Register] Email for customer', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_partner',
        ),
        array(
            'id' => 'partner_email_for_customer',
            'label' => __('[Register] Email to customer', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_template_for_customer_partner') ? st_default_email_template_for_customer_partner() : false
        ),
        array(
            'id' => 'partner_email_approved',
            'label' => __('[Register] Email to partner', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_template_for_customer_approved_partner') ? st_default_email_template_for_customer_approved_partner() : false
        ),
        array(
            'id' => 'partner_email_cancel',
            'label' => __('[Register] Email for cancellation', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_email_template_for_customer_cancel_partner') ? st_default_email_template_for_customer_cancel_partner() : false
        ),
        array(
            'id' => 'tab_withdrawal_email_for_admin',
            'label' => __('[Withdrawal] Email For Admin', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_partner',
        ),
        array(
            'id' => 'send_admin_new_request_withdrawal',
            'label' => __('[Request] Email to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_admin_new_request_withdrawal') ? st_default_admin_new_request_withdrawal() : false
        ),
        array(
            'id' => 'send_admin_approved_withdrawal',
            'label' => __('[Approved] Email to administrator', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_send_admin_approved_withdrawal') ? st_default_send_admin_approved_withdrawal() : false
        ),
        array(
            'id' => 'tab_withdrawal_email_for_customer',
            'label' => __('[Withdrawal] Email For Customer', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_partner',
        ),
        array(
            'id' => 'send_user_new_request_withdrawal',
            'label' => __('[Request] Email to user', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_send_user_new_request_withdrawal') ? st_default_send_user_new_request_withdrawal() : false

        ),
        array(
            'id' => 'send_user_approved_withdrawal',
            'label' => __('[Approved] Email to user', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_send_user_approved_withdrawal') ? st_default_send_user_approved_withdrawal() : false
        ),
        array(
            'id' => 'send_user_cancel_withdrawal',
            'label' => __('[Cancel] Email to user', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'rows' => '10',
            'section' => 'option_email_partner',
            'std' => function_exists('st_default_send_user_cancel_withdrawal') ? st_default_send_user_cancel_withdrawal() : false
        ),
        array(
            'id' => 'member_packages_tab',
            'label' => __('[Membership] Email For Admin', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_email_partner',
        ),
        array(
            'id' => 'membership_email_admin',
            'label' => __('Email for admin when have a new member.', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'section' => 'option_email_partner',
            'std' => function_exists('st_email_member_packages_admin') ? st_email_member_packages_admin() : false
        ),
        array(
            'id' => 'membership_email_partner',
            'label' => __('Email for partner when have a new member.', ST_TEXTDOMAIN),
            'type' => 'textarea',
            'section' => 'option_email_partner',
            'std' => function_exists('st_email_member_packages_partner') ? st_email_member_packages_partner() : false
        ),
        /*------------- End Email Partner Template --------------------*/

        /*------------- Search Option -----------------*/
        array(
            'id' => 'search_results_view',
            'label' => __('Select default search result layout', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_search',
            'desc' => __('List view or Grid view', ST_TEXTDOMAIN),
            'choices' => array(
                array(
                    'value' => 'list',
                    'label' => __('List view', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'grid',
                    'label' => __('Grid view', ST_TEXTDOMAIN)
                ),
            )
        ),
        array(
            'id' => 'search_tabs',
            'label' => __('Display searching tabs', ST_TEXTDOMAIN),
            'desc' => __('Search Tabs on home page', ST_TEXTDOMAIN),
            'type' => 'list-item',
            'section' => 'option_search',
            'settings' => array(
                array(
                    'id' => 'check_tab',
                    'label' => __('Show tab', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                ),
                array(
                    'id' => 'tab_icon',
                    'label' => __('Icon', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'desc' => __('This allows you to change icon next to the title', ST_TEXTDOMAIN)
                ),
                array(
                    'id' => 'tab_search_title',
                    'label' => __('Form Title', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'desc' => __('This allows you to change the text above the form', ST_TEXTDOMAIN)
                ),
	            array(
		            'id' => 'tab_name',
		            'label' => __('Choose Tab', ST_TEXTDOMAIN),
		            'type' => 'select',
		            'choices' => array(
			            array(
				            'value' => 'hotel',
				            'label' => __('Hotel', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'rental',
				            'label' => __('Rental', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'tour',
				            'label' => __('Tour', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'cars',
				            'label' => __('Car', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'activities',
				            'label' => __('Activities', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'hotel_room',
				            'label' => __('Room', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'flight',
				            'label' => __('Flight', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'all_post_type',
				            'label' => __('All Post Type', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'tp_flight',
				            'label' => esc_html__('TravelPayouts Flight', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'tp_hotel',
				            'label' => esc_html__('TravelPayout Hotel', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'ss_flight',
				            'label' => esc_html__('Skyscanner Flight', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'car_transfer',
				            'label' => esc_html__('Car Transfer', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'hotels_combined',
				            'label' => esc_html__('HotelsCombined', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'bookingdc',
				            'label' => esc_html__('Booking.com', ST_TEXTDOMAIN)
			            ),
			            array(
				            'value' => 'expedia',
				            'label' => esc_html__('Expedia', ST_TEXTDOMAIN)
			            ),
		            )
	            ),
                array(
                    'id' => 'tab_html_custom',
                    'label' => __('Use HTML bellow', ST_TEXTDOMAIN),
                    'type' => 'textarea',
                    'desc' => __('This allows you to do short code or HTML', ST_TEXTDOMAIN)
                ),
            ),
            'std' => array(
                array(
                    'title' => 'Hotel',
                    'check_tab' => 'on',
                    'tab_icon' => 'fa-building-o',
                    'tab_search_title' => 'Search and Save on Hotels',
                    'tab_name' => 'hotel'
                ),
                array(
                    'title' => 'Cars',
                    'check_tab' => 'on',
                    'tab_icon' => 'fa-car',
                    'tab_search_title' => 'Search for Cheap Rental Cars',
                    'tab_name' => 'cars'
                ),
                array(
                    'title' => 'Tours',
                    'check_tab' => 'on',
                    'tab_icon' => 'fa-flag-o',
                    'tab_search_title' => 'Tours',
                    'tab_name' => 'tour'
                ),
                array(
                    'title' => 'Rentals',
                    'check_tab' => 'on',
                    'tab_icon' => 'fa-home',
                    'tab_search_title' => 'Find Your Perfect Home',
                    'tab_name' => 'rental'
                ),
                array(
                    'title' => 'Activity',
                    'check_tab' => 'on',
                    'tab_icon' => 'fa-bolt',
                    'tab_search_title' => 'Find Your Perfect Activity',
                    'tab_name' => 'activities'
                ),
            )
        ),
        array(
            'id' => 'all_post_type_search_result_page',
            'label' => __('Select page display search results for all services', ST_TEXTDOMAIN),
            'type' => 'page-select',
            'section' => 'option_search',
        ),
        array(
            'id' => 'all_post_type_search_fields',
            'label' => __('Custom search form for all services', ST_TEXTDOMAIN),
            'desc' => __('Custom search form for all services', ST_TEXTDOMAIN),
            'type' => 'Slider',
            'section' => 'option_search',
            'settings' => array(
                array(
                    'id' => 'field_search',
                    'label' => __('Field Type', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => 'address',
                            'label' => __('Address', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'item_name',
                            'label' => __('Name', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => 'post_type',
                            'label' => __('Post Type', ST_TEXTDOMAIN)
                        ),
                    )
                ),
                array(
                    'id' => 'placeholder',
                    'label' => __('Placeholder', ST_TEXTDOMAIN),
                    'desc' => __('Placeholder', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'operator' => 'and',
                ),
                array(
                    'id' => 'layout_col',
                    'label' => __('Layout 1 size', ST_TEXTDOMAIN),
                    'type' => 'select',
                    'operator' => 'and',
                    'choices' => array(
                        array(
                            'value' => '1',
                            'label' => __('column 1', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '2',
                            'label' => __('column 2', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '3',
                            'label' => __('column 3', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '4',
                            'label' => __('column 4', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '5',
                            'label' => __('column 5', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '6',
                            'label' => __('column 6', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '7',
                            'label' => __('column 7', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '8',
                            'label' => __('column 8', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '9',
                            'label' => __('column 9', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '10',
                            'label' => __('column 10', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '11',
                            'label' => __('column 11', ST_TEXTDOMAIN)
                        ),
                        array(
                            'value' => '12',
                            'label' => __('column 12', ST_TEXTDOMAIN)
                        ),
                    ),
                    'std' => 4
                ),
                array(
                    'id' => 'is_required',
                    'label' => __('Field required', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'operator' => 'and',
                    'std' => 'on',
                ),
            ),
            'std' => array(
                array('title' => 'Address',
                    'layout_col' => 12,
                    'field_search' => 'address'
                ),
            )
        ),
        array(
            'id' => 'search_header_onoff',
            'label' => __('Allow header search', ST_TEXTDOMAIN),
            'desc' => __('Allow header search', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_search',
            'std' => 'on'
        ),
        array(
            'id' => 'search_header_orderby',
            'label' => __('Header search - Order by', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_search',
            'desc' => __('Header search - Order by', ST_TEXTDOMAIN),
            'condition' => 'search_header_onoff:is(on)',
            'choices' => array(
                array(
                    'value' => 'none',
                    'label' => __('None', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ID',
                    'label' => __('ID', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'author',
                    'label' => __('Author', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'title',
                    'label' => __('Title', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'name',
                    'label' => __('Name', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'date',
                    'label' => __('Date', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'rand',
                    'label' => __('Random', ST_TEXTDOMAIN)
                ),
            ),
        ),
        array(
            'id' => 'search_header_order',
            'label' => __('Header search - order', ST_TEXTDOMAIN),
            'type' => 'select',
            'section' => 'option_search',
            'desc' => __('Header search - order', ST_TEXTDOMAIN),
            'condition' => 'search_header_onoff:is(on)',
            'choices' => array(
                array(
                    'value' => 'ASC',
                    'label' => __('ASC', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'DESC',
                    'label' => __('DESC', ST_TEXTDOMAIN)
                ),
            ),
        ),
        array(
            'id' => 'search_header_list',
            'label' => __('Header search - Search by', ST_TEXTDOMAIN),
            'type' => 'st_checkbox_posttype',
            'section' => 'option_search',
            'desc' => __('Header search - Search by', ST_TEXTDOMAIN),
            'condition' => 'search_header_onoff:is(on)',
        ),
        /*------------- End User Option  --------------------*/

        /*------------- Begin Social Option  --------------------*/
        defined('WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL') ? array(
            'id' => 'social_fb_login',
            'label' => __('Facebook Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ) : array('id' => 'social_fb_login_tmp', 'type' => '', 'section' => '', 'label' => '')
    ,
        defined('WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL') ? array(
            'id' => 'social_gg_login',
            'label' => __('Google Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ) : array('id' => 'social_fb_login_tmp', 'type' => '', 'section' => '', 'label' => '')
    ,
        defined('WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL') ? array(
            'id' => 'social_tw_login',
            'label' => __('Twitter Login', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'on',
            'section' => 'option_social'
        ) : array(
            'id' => 'st_check_login_social',
            'type' => 'text',
            'section' => 'option_social',
            'label' => esc_html__('Please Active WordPress Social Login Plugin', ST_TEXTDOMAIN),
            'class' => 'st_hidden_input_field'
        ),
        array(
            'id' => 'gen_enable_smscroll',
            'label' => __('Enable Nice Scroll', ST_TEXTDOMAIN),
            'desc' => __('This allows you to turn on or off <em>Nice Scroll Effect</em>', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_bc',
            'std' => 'off'
        ),
        array(
            'id' => 'sp_disable_javascript',
            'label' => __('Support Disable javascript', ST_TEXTDOMAIN),
            'desc' => __('This allows css friendly with browsers what disable javascript', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_bc',
            'std' => 'off'
        ),
        array(
            'id' => 'google_api_key',
            'label' => __('Google API key', ST_TEXTDOMAIN),
            'desc' => __('Input your Google API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://developers.google.com/maps/documentation/javascript/get-api-key'>How to get it?</a>",
            'type' => 'text',
            'section' => 'option_bc',
            'std' => 'AIzaSyA1l5FlclOzqDpkx5jSH5WBcC0XFkqmYOY'
        ),
        array(
            'id' => 'google_font_api_key',
            'label' => __('Google Fonts API key', ST_TEXTDOMAIN),
            'desc' => __('Input your Google Fonts API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://developers.google.com/fonts/docs/developer_api'>How to get it?</a>",
            'type' => 'text',
            'section' => 'option_bc',
            //'std' => 'AIzaSyCpAufmacc0zw76gZDkpNsEFldyRyr1J_o'
        ),
        array(
            'id' => 'weather_api_key',
            'label' => __('Weather API key', ST_TEXTDOMAIN),
            'desc' => __('Input your Weather API key ', ST_TEXTDOMAIN) . "<a target='_blank' href='https://home.openweathermap.org/api_keys'>openweathermap.org</a>",
            'type' => 'text',
            'section' => 'option_bc',
            'std' => 'a82498aa9918914fa4ac5ba584a7e623'
        ),

        array(
            'id' => 'tab_general_document',
            'label' => __(' General Configure', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'booking_room_by',
            'label' => __('Booking immediately in search result page', ST_TEXTDOMAIN),
            'desc' => __('Booking immediately in search result page without go to single page', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_api_update',
            'std' => 'on',
        ),
        array(
            'id' => 'st_api_external_booking',
            'section' => 'option_api_update',
            'label' => __('External Booking', ST_TEXTDOMAIN),
            'desc' => __('External Booking', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'std' => 'off',
            'condition' => ""
        ),
        array(
            'id' => 'show_only_room_by',
            'label' => __('Show Only Room By', ST_TEXTDOMAIN),
            'type' => 'checkbox',
            'section' => 'option_api_update',
            'choices' => array(
                array(
                    'label' => __('All', ST_TEXTDOMAIN),
                    'value' => 'all'
                ),
                array(
                    'label' => __('Roomorama', ST_TEXTDOMAIN),
                    'value' => 'st_roomorama'
                ),
            ),
            'std' => 'all',
        ),
        array(
            'id' => 'tab_eroomorama_document',
            'label' => __(' Roomorama.com', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'st_client_identifier',
            'section' => 'option_api_update',
            'label' => __('Client Identifier', ST_TEXTDOMAIN),
            'desc' => __('Client Identifier', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'condition' => ""
        ),
        array(
            'id' => 'st_client_secret',
            'section' => 'option_api_update',
            'label' => __('Client secret', ST_TEXTDOMAIN),
            'desc' => __('Client secret', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'condition' => ""
        ),
        array(
            'id' => 'st_roomorama_token',
            'section' => 'option_api_update',
            'label' => __('Token Access', ST_TEXTDOMAIN),
            'desc' => __('Token Access : https://www.roomorama.com/account/api', ST_TEXTDOMAIN),
            'type' => 'text',
            'std' => '',
            'condition' => ""
        ),
        array(
            'id' => 'show_content_api_roomorama',
            'section' => 'option_api_update',
            'label' => __('Content', ST_TEXTDOMAIN),
            'desc' => __('Content', ST_TEXTDOMAIN),
            'type' => 'show_content_api_roomorama',
            'std' => '',
            'condition' => ""
        ),
        array(
            'id' => 'travelpayouts_option',
            'label' => esc_html__('TravelPayouts', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update'
        ),
        array(
            'id' => 'tp_marker',
            'label' => esc_html__('Your Marker', ST_TEXTDOMAIN),
            'type' => 'text',
            'desc' => esc_html__('Enter your marker', ST_TEXTDOMAIN),
            'section' => 'option_api_update'
        ),
        array(
            'id' => 'tp_locale_default',
            'label' => esc_html__('Default Language', ST_TEXTDOMAIN),
            'type' => 'select',
            'operator' => 'and',
            'choices' => array(
                array(
                    'value' => 'ez',
                    'label' => esc_html__('Azerbaijan', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ms',
                    'label' => esc_html__('Bahasa Melayu', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'br',
                    'label' => esc_html__('Brazilian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'bg',
                    'label' => esc_html__('Bulgarian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'zh',
                    'label' => esc_html__('Chinese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'da',
                    'label' => esc_html__('Danish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'de',
                    'label' => esc_html__('Deutsch (DE)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en',
                    'label' => esc_html__('English', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en-AU',
                    'label' => esc_html__('English (AU)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en-GB',
                    'label' => esc_html__('English (GB)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'fr',
                    'label' => esc_html__('French', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ka',
                    'label' => esc_html__('Georgian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'el',
                    'label' => esc_html__('Greek (Modern Greek)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'it',
                    'label' => esc_html__('Italian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ja',
                    'label' => esc_html__('Japanese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'lv',
                    'label' => esc_html__('Latvian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'pl',
                    'label' => esc_html__('Polish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'pt',
                    'label' => esc_html__('Portuguese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ro',
                    'label' => esc_html__('Romanian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ru',
                    'label' => esc_html__('Russian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'sr',
                    'label' => esc_html__('Serbian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'es',
                    'label' => esc_html__('Spanish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'th',
                    'label' => esc_html__('Thai', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'tr',
                    'label' => esc_html__('Turkish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'uk',
                    'label' => esc_html__('Ukrainian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'vi',
                    'label' => esc_html__('Vietnamese', ST_TEXTDOMAIN)
                ),

            ),
            'section' => 'option_api_update',
            'std' => 'en'
        ),

        array(
            'id' => 'tp_currency_default',
            'label' => esc_html__('Default Currency', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'value' => 'amd',
                    'label' => esc_html__('UAE dirham (AED)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'amd',
                    'label' => esc_html__('Armenian Dram (AMD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ars',
                    'label' => esc_html__('Argentine peso (ARS)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'aud',
                    'label' => esc_html__('Australian Dollar (AUD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'azn',
                    'label' => esc_html__('Azerbaijani Manat (AZN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'bdt',
                    'label' => esc_html__('Bangladeshi taka (BDT)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'bgn',
                    'label' => esc_html__('Bulgarian lev (BGN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'brl',
                    'label' => esc_html__('Brazilian real (BRL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'byr',
                    'label' => esc_html__('Belarusian ruble (BYR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'chf',
                    'label' => esc_html__('Swiss Franc (CHF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'clp',
                    'label' => esc_html__('Chilean peso (CLP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'cny',
                    'label' => esc_html__('Chinese Yuan (CNY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'cop',
                    'label' => esc_html__('Colombian peso (COP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'dkk',
                    'label' => esc_html__('Danish krone (DKK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'egp',
                    'label' => esc_html__('Egyptian Pound (EGP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'eur',
                    'label' => esc_html__('Euro (EUR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'gpb',
                    'label' => esc_html__('British Pound Sterling (GPB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'gel',
                    'label' => esc_html__('Georgian lari (GEL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'hkd',
                    'label' => esc_html__('Hong Kong Dollar (HKD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'huf',
                    'label' => esc_html__('Hungarian forint (HUF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'idr',
                    'label' => esc_html__('Indonesian Rupiah (IDR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'inr',
                    'label' => esc_html__('Indian Rupee (INR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'jpy',
                    'label' => esc_html__('Japanese Yen (JPY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'kgs',
                    'label' => esc_html__('Som (KGS)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'krw',
                    'label' => esc_html__('South Korean won (KRW)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'mxn',
                    'label' => esc_html__('Mexican peso (MXN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'myr',
                    'label' => esc_html__('Malaysian ringgit (MYR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'nok',
                    'label' => esc_html__('Norwegian Krone (NOK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'kzt',
                    'label' => esc_html__('Kazakhstani Tenge (KZT)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ltl',
                    'label' => esc_html__('Latvian Lat (LTL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'nzd',
                    'label' => esc_html__('New Zealand Dollar (NZD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pen',
                    'label' => esc_html__('Peruvian sol (PEN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'php',
                    'label' => esc_html__('Philippine Peso (PHP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pkr',
                    'label' => esc_html__('Pakistan Rupee (PKR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pln',
                    'label' => esc_html__('Polish zloty (PLN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ron',
                    'label' => esc_html__('Romanian leu (RON)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'rsd',
                    'label' => esc_html__('Serbian dinar (RSD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'rub',
                    'label' => esc_html__('Russian Ruble (RUB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sar',
                    'label' => esc_html__('Saudi riyal (SAR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sek',
                    'label' => esc_html__('Swedish krona (SEK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sgd',
                    'label' => esc_html__('Singapore Dollar (SGD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'thb',
                    'label' => esc_html__('Thai Baht (THB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'try',
                    'label' => esc_html__('Turkish lira (TRY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'uah',
                    'label' => esc_html__('Ukrainian Hryvnia (UAH)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'usd',
                    'label' => esc_html__('US Dollar (USD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'vnd',
                    'label' => esc_html__('Vietnamese dong (VND)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'xof',
                    'label' => esc_html__('CFA Franc (XOF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'zar',
                    'label' => esc_html__('South African Rand (ZAR)', ST_TEXTDOMAIN)
                ),
            ),
            'section' => 'option_api_update',
            'std' => 'usd'
        ),

        array(
            'id' => 'tp_redirect_option',
            'label' => esc_html__('Use Whitelabel', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_api_update',
            'std' => 'off'
        ),
        array(
            'id' => 'tp_whitelabel',
            'label' => esc_html__('Whitelabel Name', ST_TEXTDOMAIN),
            'type' => 'text',
            'section' => 'option_api_update',
            'condition' => 'tp_redirect_option:is(on)'
        ),
        array(
            'id' => 'tp_whitelabel_page',
            'label' => esc_html__('Whitelabel Page Search', ST_TEXTDOMAIN),
            'type' => 'st_post_type_select',
            'post_type' => 'travel_payout',
            'section' => 'option_api_update',
            'condition' => 'tp_redirect_option:is(on)',
        ),
        array(
            'id' => 'tp_show_api_info',
            'label' => esc_html__('Show API Info', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_api_update',
            'std' => 'on'
        ),
        /*------------------- Skyscanner ----------------------*/
        array(
            'id' => 'skyscanner_option',
            'label' => esc_html__('Skyscanner', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'ss_api_key',
            'label' => esc_html__('Api Key', ST_TEXTDOMAIN),
            'type' => 'text',
            'desc' => esc_html__('Enter a api key', ST_TEXTDOMAIN),
            'section' => 'option_api_update'
        ),
        array(
            'id' => 'ss_locale',
            'label' => esc_html__('Locale', ST_TEXTDOMAIN),
            'type' => 'ss_content_select',
            'post_type' => 'locale',
            'test' => '12',
            'desc' => esc_html__('The locales that Skyscanner support to translate your content', ST_TEXTDOMAIN),
            'section' => 'option_api_update',
            'std' => 'en-US',
        ),
        array(
            'id' => 'ss_currency',
            'label' => esc_html__('Currency', ST_TEXTDOMAIN),
            'type' => 'ss_content_select',
            'post_type' => 'currency',
            'desc' => esc_html__('The currencies that Skyscanner support', ST_TEXTDOMAIN),
            'section' => 'option_api_update',
            'std' => 'USD',
        ),
        array(
            'id' => 'ss_market_country',
            'label' => esc_html__('Market Country', ST_TEXTDOMAIN),
            'type' => 'ss_content_select',
            'post_type' => 'market',
            'desc' => esc_html__('The market countries that Skyscanner support', ST_TEXTDOMAIN),
            'section' => 'option_api_update',
            'std' => 'US',
        ),
        /*------------------- HotelsCombined API ----------------------*/
        array(
            'id' => 'hotelscb_option',
            'label' => esc_html__('HotelsCombined', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'hotelscb_aff_id',
            'label' => esc_html__('Affiliate ID', ST_TEXTDOMAIN),
            'type' => 'text',
            'desc' => esc_html__('Enter your affiliate ID', ST_TEXTDOMAIN),
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'hotelscb_searchbox_id',
            'label' => esc_html__('Searchbox ID', ST_TEXTDOMAIN),
            'type' => 'text',
            'desc' => esc_html__('Enter your search box ID', ST_TEXTDOMAIN),
            'section' => 'option_api_update',
        ),
        /*------------------- HotelsCombined API ----------------------*/

        /*------------------- Booking.com API ----------------------*/
        array(
            'id' => 'bookingdc_option',
            'label' => esc_html__('Booking.com', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'bookingdc_iframe',
            'label' => __('Using iframe search form', ST_TEXTDOMAIN),
            'desc' => __('Enable iframe search form', ST_TEXTDOMAIN),
            'type' => 'on-off',
            'section' => 'option_api_update',
            'std' => 'on',
        ),
        array(
            'id' => 'bookingdc_iframe_code',
            'label' => __('Search form code', ST_TEXTDOMAIN),
            'desc' => __('Enter your search box code from booking.com', ST_TEXTDOMAIN),
            'type' => 'textarea-simple',
            'rows' => '4',
            'condition' => 'bookingdc_iframe:is(on)',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'bookingdc_aid',
            'label' => __('Your affiliate ID', ST_TEXTDOMAIN),
            'desc' => __('Enter your affiliate ID from booking.com', ST_TEXTDOMAIN),
            'type' => 'text',
            'condition' => 'bookingdc_iframe:is(off)',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'bookingdc_cname',
            'label' => __('Cname', ST_TEXTDOMAIN),
            'desc' => __('Enter your Cname for search box', ST_TEXTDOMAIN),
            'type' => 'text',
            'condition' => 'bookingdc_iframe:is(off)',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'bookingdc_lang',
            'label' => esc_html__('Default Language', ST_TEXTDOMAIN),
            'type' => 'select',
            'operator' => 'and',
            'choices' => array(
                array(
                    'value' => 'ez',
                    'label' => esc_html__('Azerbaijan', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ms',
                    'label' => esc_html__('Bahasa Melayu', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'br',
                    'label' => esc_html__('Brazilian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'bg',
                    'label' => esc_html__('Bulgarian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'zh',
                    'label' => esc_html__('Chinese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'da',
                    'label' => esc_html__('Danish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'de',
                    'label' => esc_html__('Deutsch (DE)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en',
                    'label' => esc_html__('English', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en-AU',
                    'label' => esc_html__('English (AU)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'en-GB',
                    'label' => esc_html__('English (GB)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'fr',
                    'label' => esc_html__('French', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ka',
                    'label' => esc_html__('Georgian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'el',
                    'label' => esc_html__('Greek (Modern Greek)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'it',
                    'label' => esc_html__('Italian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ja',
                    'label' => esc_html__('Japanese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'lv',
                    'label' => esc_html__('Latvian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'pl',
                    'label' => esc_html__('Polish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'pt',
                    'label' => esc_html__('Portuguese', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ro',
                    'label' => esc_html__('Romanian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'ru',
                    'label' => esc_html__('Russian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'sr',
                    'label' => esc_html__('Serbian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'es',
                    'label' => esc_html__('Spanish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'th',
                    'label' => esc_html__('Thai', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'tr',
                    'label' => esc_html__('Turkish', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'uk',
                    'label' => esc_html__('Ukrainian', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'vi',
                    'label' => esc_html__('Vietnamese', ST_TEXTDOMAIN)
                ),

            ),
            'section' => 'option_api_update',
            'std' => 'en',
            'condition' => 'bookingdc_iframe:is(off)',
        ),

        array(
            'id' => 'bookingdc_currency',
            'label' => esc_html__('Default Currency', ST_TEXTDOMAIN),
            'type' => 'select',
            'choices' => array(
                array(
                    'value' => 'amd',
                    'label' => esc_html__('UAE dirham (AED)', ST_TEXTDOMAIN)
                ),
                array(
                    'value' => 'amd',
                    'label' => esc_html__('Armenian Dram (AMD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ars',
                    'label' => esc_html__('Argentine peso (ARS)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'aud',
                    'label' => esc_html__('Australian Dollar (AUD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'azn',
                    'label' => esc_html__('Azerbaijani Manat (AZN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'bdt',
                    'label' => esc_html__('Bangladeshi taka (BDT)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'bgn',
                    'label' => esc_html__('Bulgarian lev (BGN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'brl',
                    'label' => esc_html__('Brazilian real (BRL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'byr',
                    'label' => esc_html__('Belarusian ruble (BYR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'chf',
                    'label' => esc_html__('Swiss Franc (CHF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'clp',
                    'label' => esc_html__('Chilean peso (CLP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'cny',
                    'label' => esc_html__('Chinese Yuan (CNY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'cop',
                    'label' => esc_html__('Colombian peso (COP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'dkk',
                    'label' => esc_html__('Danish krone (DKK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'egp',
                    'label' => esc_html__('Egyptian Pound (EGP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'eur',
                    'label' => esc_html__('Euro (EUR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'gpb',
                    'label' => esc_html__('British Pound Sterling (GPB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'gel',
                    'label' => esc_html__('Georgian lari (GEL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'hkd',
                    'label' => esc_html__('Hong Kong Dollar (HKD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'huf',
                    'label' => esc_html__('Hungarian forint (HUF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'idr',
                    'label' => esc_html__('Indonesian Rupiah (IDR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'inr',
                    'label' => esc_html__('Indian Rupee (INR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'jpy',
                    'label' => esc_html__('Japanese Yen (JPY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'kgs',
                    'label' => esc_html__('Som (KGS)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'krw',
                    'label' => esc_html__('South Korean won (KRW)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'mxn',
                    'label' => esc_html__('Mexican peso (MXN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'myr',
                    'label' => esc_html__('Malaysian ringgit (MYR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'nok',
                    'label' => esc_html__('Norwegian Krone (NOK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'kzt',
                    'label' => esc_html__('Kazakhstani Tenge (KZT)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ltl',
                    'label' => esc_html__('Latvian Lat (LTL)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'nzd',
                    'label' => esc_html__('New Zealand Dollar (NZD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pen',
                    'label' => esc_html__('Peruvian sol (PEN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'php',
                    'label' => esc_html__('Philippine Peso (PHP)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pkr',
                    'label' => esc_html__('Pakistan Rupee (PKR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'pln',
                    'label' => esc_html__('Polish zloty (PLN)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'ron',
                    'label' => esc_html__('Romanian leu (RON)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'rsd',
                    'label' => esc_html__('Serbian dinar (RSD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'rub',
                    'label' => esc_html__('Russian Ruble (RUB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sar',
                    'label' => esc_html__('Saudi riyal (SAR)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sek',
                    'label' => esc_html__('Swedish krona (SEK)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'sgd',
                    'label' => esc_html__('Singapore Dollar (SGD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'thb',
                    'label' => esc_html__('Thai Baht (THB)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'try',
                    'label' => esc_html__('Turkish lira (TRY)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'uah',
                    'label' => esc_html__('Ukrainian Hryvnia (UAH)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'usd',
                    'label' => esc_html__('US Dollar (USD)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'vnd',
                    'label' => esc_html__('Vietnamese dong (VND)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'xof',
                    'label' => esc_html__('CFA Franc (XOF)', ST_TEXTDOMAIN)
                ), array(
                    'value' => 'zar',
                    'label' => esc_html__('South African Rand (ZAR)', ST_TEXTDOMAIN)
                ),
            ),
            'section' => 'option_api_update',
            'std' => 'usd',
            'condition' => 'bookingdc_iframe:is(off)',
        ),
        /*------------------- End Booking.com API ----------------------*/

        /*------------------- Expedia API ----------------------*/
        array(
            'id' => 'expedia_option',
            'label' => esc_html__('Expedia', ST_TEXTDOMAIN),
            'type' => 'tab',
            'section' => 'option_api_update',
        ),
        array(
            'id' => 'expedia_iframe_code',
            'label' => __('Search form code', ST_TEXTDOMAIN),
            'desc' => __('Enter your search box code from expedia', ST_TEXTDOMAIN),
            'type' => 'textarea-simple',
            'rows' => '4',
            'section' => 'option_api_update',
        ),
        /*------------------- End Expedia API ----------------------*/
    )
);

if(function_exists('icl_get_languages') || function_exists('qtranxf_init_language')) {
    $custom_settings_currency_mapping =
        array(
            array(
                'id'      => 'booking_currency_mapping_detect' ,
                'label'   => __( 'Auto detect currency by language' , ST_TEXTDOMAIN ) ,
                'type'    => 'on-off' ,
                'section' => 'option_booking' ,
                'std'     => 'off'
            ) ,
            array(
                'id'      => 'booking_currency_mapping',
                'label'   => __( 'Mapping currencies', ST_TEXTDOMAIN ),
                'desc'    => __( 'Mapping currency with language', ST_TEXTDOMAIN ),
                'type'    => 'st_mapping_currency',
                'condition' => 'booking_currency_mapping_detect:is(on)',
                'section' => 'option_booking',
            )
        );
    array_splice( $custom_settings['settings'], 102, 0, $custom_settings_currency_mapping );
}

$taxonomy_hotel = st_get_post_taxonomy('st_hotel');
if (!empty($taxonomy_hotel)) {
    foreach ($taxonomy_hotel as $k => $v) {
        $terms_hotel = get_terms($v['value']);
        $ids = array();
        if (!empty($terms_hotel)) {
            foreach ($terms_hotel as $key => $value) {
                $ids[] = array(
                    'value' => $value->term_id . "|" . $value->name,
                    'label' => $value->name,
                );
            }
            $custom_settings['settings']['flied_hotel']['settings'][] = array(
                'id' => 'custom_terms_' . $v['value'],
                'label' => $v['label'],
                'condition' => 'name:is(taxonomy),taxonomy:is(' . $v['value'] . ')',
                'operator' => 'and',
                'type' => 'checkbox',
                'choices' => $ids,
                'desc' => __('It will show all Hotel theme If you don\'t have any choose.', ST_TEXTDOMAIN),
            );
            $ids = array();
        }
    }
}
$custom_settings = apply_filters('st_option_tree_settings', $custom_settings);

function ot_type_email_template_document()
{

    echo '<div class="format-setting type-textblock wide-desc">';

    echo '<div class="description">';
    ?>
    <style>
        table {
            border: 1px solid #CCC;
        }

        table tr:not(:last-child) td {
            border-bottom: 1px solid #CCC;
        }

        xmp {
            margin: 0;
        }
    </style>
    <p>
        <?php echo __('From version 1.1.9 you can edit email template for Admin, Partner, Customer by use our shortcodes system with some layout we ready build in. Below is the list shortcodes you can use', ST_TEXTDOMAIN); ?>
        :
    </p>
    <h4><?php echo __('List All Shortcode:', ST_TEXTDOMAIN); ?></h4>
    <ul>
        <li>
            <h5><?php echo __('Customer Information:', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr style="background: #CCC;">
                    <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                </tr>
                <tr>
                    <td><strong><?php echo __('First Name', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_first_name]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Last Name', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_last_name]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Email', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_email]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Address', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_address]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Phone Number', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_phone]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('City', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_city]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Province', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_province]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Zipcode', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_zip_code]</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Country', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_country]</td>
                    <td></td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Item booking Information', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr style="background: #CCC;">
                    <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                </tr>
                <tr>
                    <td><strong><?php echo __('Post type name', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_booking_posttype]</td>
                    <td><em><?php echo __('Show post-type name.', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('ID', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_id]</td>
                    <td>
                        <em><?php echo __('Display the Order ID', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Thumbnail Image', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_thumbnail]</td>
                    <td>
                        <em><?php echo __('Display the product\'s thumbnail image (if have)', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Date', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_date]</td>
                    <td>
                        <em><?php echo __('Display the booking date', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Special Requirements', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_note]</td>
                    <td>
                        <em><?php echo __('Display the information of the \'Special Requirements\' when booking', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Payment Method', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_payment_method]</td>
                    <td>
                        <em><?php echo __('Display the booking method', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Name', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_name]</td>
                    <td>
                        <em><?php echo __('Display item name of service.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Link', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_link]</td>
                    <td>
                        <em><?php echo __('Display the item title with a link under.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Number', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_number_item]</td>
                    <td>
                        <em><?php echo __('Display number of items when booking.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong><?php echo __('Check In', ST_TEXTDOMAIN); ?>:</strong><br/>
                        <strong><?php echo __('Check Out', ST_TEXTDOMAIN); ?>:</strong>
                    </td>
                    <td>
                        [st_email_booking_check_in]<br/>
                        [st_email_booking_check_out]<br/>
                        [st_check_in_out_title] <br/>
                        [st_check_in_out_value]
                    </td>
                    <td>
                        <em>
                            1. <?php echo __('Display check in, check out with Hotel and Rental', ST_TEXTDOMAIN); ?>
                            <br/>
                            2. <?php echo __('Display Pick-up Date and Drop-off Date with Car', ST_TEXTDOMAIN); ?><br/>
                            3. <?php echo __('Display Departure date and Return date with Tour and Activity', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>
                <!-- Since 2.0.0 Start Time Order Shortcode -->
                <tr>
                    <td><strong><?php echo __('Start Time', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_start_time]</td>
                    <td>
                        <em><?php echo __('Display Start Time with Tour', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_price]</td>
                    <td>
                        <em><?php echo __('Display item price (not included Tour and Activity)', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Origin Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_origin_price]</td>
                    <td>
                        <em>
                            <?php echo __('Display original price of the item (not included custom price, sale price and tax)', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Sale Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_sale_price]</td>
                    <td>
                        <em><?php echo __('Display the sale price.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Tax Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_price_with_tax]</td>
                    <td>
                        <em><?php echo __('Display the price with tax.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Deposit Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_deposit_price]</td>
                    <td>
                        <em><?php echo __('Display the deposit require. ', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Total Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_total_price]</td>
                    <td>
                        <em><?php echo __('Display the total price (included sale price and tax).', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Tax Percent', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_total_price]</td>
                    <td>
                        <em><?php echo __('Display the total amount payment.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Address', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_address]</td>
                    <td>
                        <em><?php echo __('Display the address.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Website', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_website]</td>
                    <td>
                        <em><?php echo __('Display the website.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Email', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_email]</td>
                    <td>
                        <em><?php echo __('Display the email.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Phone', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_phone]</td>
                    <td>
                        <em><?php echo __('Display the phone.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item Fax', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_item_fax]</td>
                    <td>
                        <em><?php echo __('Display the fax.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Booking Status', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_status]</td>
                    <td>
                        <em><?php echo __('Display the booking status.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Booking Payment method', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_payment_method]</td>
                    <td>
                        <em><?php echo __('Display the booking payment method.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>

                <tr>
                    <td><strong><?php echo __('Booking Guest Name', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_guest_name]</td>
                    <td>
                        <em><?php echo __('Display the booking guest name.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>

            </table>
        </li>
        <li>
            <h5><?php echo __('Use for Hotel', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr style="background: #CCC;">
                    <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                </tr>
                <tr>
                    <td><strong><?php echo __('Room Name', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_room_name]</td>
                    <td>
                        <em>
                            <?php echo __('Display the room name of hotel.', ST_TEXTDOMAIN); ?>
                            <br/>
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="Room Name"</xmp>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Extra Items', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_extra_items]</td>
                    <td>
                        <em><?php echo __('Display all service/facillities inside a room.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Extra Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_extra_price]</td>
                    <td>
                        <em><?php echo __('Display total price of service in room.', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Use for Car', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr style="background: #CCC;">
                    <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                </tr>
                <tr>
                    <td><strong><?php echo __('Car Time', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_check_in_out_time]</td>
                    <td>
                        <em>
                            <?php echo __('Display Pick up and Drop off time.', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Car pick up from', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_pick_up_from]</td>
                    <td>
                        <em>
                            <?php echo __('Display Pick up from.', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Car Drop off to ', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_drop_off_to]</td>
                    <td>
                        <em>
                            <?php echo __('Car Drop off to ', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Car Driver Informations', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_car_driver]</td>
                    <td>
                        <em>
                            <?php echo __('Car Driver Informations  ', ST_TEXTDOMAIN); ?>
                        </em>
                    </td>
                </tr>

                <tr>
                    <td><strong><?php echo __('Car Equipments', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_equipments]</td>
                    <td>
                        <em>
                            <?php echo __('Display equipment list in a car.', ST_TEXTDOMAIN); ?>
                            </br />
                            @param 'tag' 'string'.<br/>
                            <xmp> Eg: tag="<h3>"</xmp>
                            <br/>
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="Equipments"</xmp>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Car Equipments Price', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_equipment_price]</td>
                    <td>
                        <em>
                            <?php echo __('Display total price of equipment in car.', ST_TEXTDOMAIN); ?>
                            <br/>
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="Equipments Price"</xmp>
                        </em>
                    </td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Use for Tour and Activity', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr style="background: #CCC;">
                    <th align="center" width="33.3333%"><?php echo __('Name', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Code', ST_TEXTDOMAIN); ?></th>
                    <th align="center" width="33.3333%"><?php echo __('Description', ST_TEXTDOMAIN); ?></th>
                </tr>
                <tr>
                    <td><strong><?php echo __('Adult Information', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_adult_info]</td>
                    <td>
                        <em>
                            <?php echo __('Display info of adult (number and price)', ST_TEXTDOMAIN); ?>
                            </br />
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="No. Adults"</xmp>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Children Information', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_children_info]</td>
                    <td>
                        <em>
                            <?php echo __('Display info of adult (number and price)', ST_TEXTDOMAIN); ?>
                            </br />
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="No. Children"</xmp>
                        </em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Infant Information', ST_TEXTDOMAIN); ?>:</strong></td>
                    <td>[st_email_booking_infant_info]</td>
                    <td>
                        <em>
                            <?php echo __('Display info of infant  (number and price)', ST_TEXTDOMAIN); ?>
                            </br />
                            @param 'title' 'string'.<br/>
                            <xmp> Eg: title="No. Infant"</xmp>
                        </em>
                    </td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Use for Confirm Email ', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr>
                    <td><strong><?php echo __('Confirm Link', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_confirm_link]</td>
                    <td><em><?php echo __('Get confirm email link', ST_TEXTDOMAIN); ?></em></td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Use for Approved Email', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr>
                    <td><strong><?php echo __('Account name', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_approved_email_admin_name]</td>
                    <td><em><?php echo __('Returns the name of the accounts was approved', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Post type', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_approved_email_item_type]</td>
                    <td>
                        <em><?php echo __('Returns type is type approved post (Hotel, Rental, Car, ...)', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item name', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_approved_email_item_name]</td>
                    <td><em><?php echo __('Returns the name of the item has been approved', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Item link', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_approved_email_item_link]</td>
                    <td><em><?php echo __('Returns link to item', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Approval date', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_approved_email_date]</td>
                    <td><em><?php echo __('Returns the Approval date', ST_TEXTDOMAIN); ?></em></td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('MemberShip', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr>
                    <td><strong><?php echo __('Partner\'s Name', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_partner_name]</td>
                    <td><em><?php echo __('Returns the name of the partner', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Partner\'s Email', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_partner_email]</td>
                    <td><em><?php echo __('Returns email of the partner', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Partner\'s Phone', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_partner_phone]</td>
                    <td><em><?php echo __('Returns phone number of the partner', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Name', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_name]</td>
                    <td><em><?php echo __('Returns name of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Price', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_price]</td>
                    <td><em><?php echo __('Returns price of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Commission', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_commission]</td>
                    <td><em><?php echo __('Returns commission of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Time', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_time]</td>
                    <td><em><?php echo __('Returns time available of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Item Upload', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_upload]</td>
                    <td><em><?php echo __('Returns number of item uploaded of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Item Set Featured', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_featured]</td>
                    <td><em><?php echo __('Returns number of item set featured of the package', ST_TEXTDOMAIN); ?></em>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo __('Package Description', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_package_description]</td>
                    <td><em><?php echo __('Returns description of the package', ST_TEXTDOMAIN); ?></em></td>
                </tr>
            </table>
        </li>
        <li>
            <h5><?php echo __('Invoice', ST_TEXTDOMAIN); ?></h5>
            <table width="95%" style="margin-left: 20px;">
                <tr>
                    <td><strong><?php echo __('Link Download Invoice', ST_TEXTDOMAIN); ?></strong></td>
                    <td>[st_email_booking_url_download_invoice]</td>
                    <td><em><?php echo __('Returns link download invoice', ST_TEXTDOMAIN); ?></em></td>
                </tr>
            </table>
        </li>
    </ul>
    <?php
    echo '</div>';

    echo '</div>';

}
