<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * List all hook register
 *
 * Created by ShineTheme
 *
 */
//Default Framwork Hooked
add_filter( 'document_title_parts', 'st_wp_title', 10, 1 );
add_action( 'wp', 'st_setup_author' );
add_action( 'after_setup_theme', 'st_setup_theme' );
add_action('wp_head','st_set_post_view');
add_action( 'widgets_init', 'st_add_sidebar' );
//Add Scripts
add_action('wp_enqueue_scripts', 'st_add_scripts');
//Ad admin scripts
add_action('admin_enqueue_scripts','st_admin_add_scripts');
add_action('get_footer', 'st_enqueue_scripts_footer', 9999);
//add Favicon
add_action('wp_head','st_add_favicon');
add_action('wp_head','st_add_ie8_support',999);
add_action('wp_head','st_add_custom_style',999);
add_action('wp_head','st_add_meta_keywords',999);
//add Preload
add_action('before_body_content','st_before_body_content');
//add_body_class
/**
 *  * Nice Scroll Class
 *
 *
 * */
add_action('body_class','st_add_body_class');
//add html compression
add_action('init','st_add_compress_html');
add_filter('st_container','st_control_container');
//Change Sidebar Position of Blog
add_filter('st_blog_sidebar','st_blog_sidebar');
add_filter('st_blog_sidebar_id','st_blog_sidebar_id');
add_filter('comment_excerpt','st_change_comment_excerpt_limit');
//add_action();
add_filter('admin_body_class','st_admin_body_class');
//add_action('wp_head','st_add_custom_css');
add_filter('post_gallery', 'st_inside_post_gallery', 10, 2);

add_action('login_enqueue_scripts','st_add_login_css');

/*add_action('wp_footer','st_show_box_icon_css');*/
add_filter('st_is_woocommerce_checkout','st_check_is_checkout_woocomerce');

add_filter('st_is_booking_modal','st_check_is_booking_modal');

add_action('logout_redirect','st_after_logout_redirect',10,3);
//add_action('login_redirect','st_after_login_redirect',10, 3 );

add_filter( 'style_loader_src', 'st_switch_stylesheet_src', 50, 2 );
//add_action( 'init', 'st_limit_partner_goto_dashboard' );

/*Change link access to theme option in admin bar menu frontend*/
add_action('admin_bar_menu', 'st_edit_admin_bar', 9999);
/*Store google font front end*/
add_action( 'wp_enqueue_scripts', 'st_load_google_fonts_css', 1 );




