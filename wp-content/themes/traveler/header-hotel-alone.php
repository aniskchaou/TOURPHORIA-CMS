<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Header
 *
 * Created by ShineTheme
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('hotel-alone'); ?>>
<?php
$enable_preload = st()->get_option('search_enable_preload', 'on');
if ($enable_preload == 'on' && !TravelHelper::is_service_search()) {
    echo st()->load_template('search-loading');
}
?>
<div class="site_wrapper helios_main_content">
    <?php
    $class = '';
    $extra_style = '';
    $transparent = st()->get_option('st_hotel_alone_topbar_background_transparent');
    $st_topbar_background = st()->get_option('st_hotel_alone_topbar_background');
    $custom_header_page = get_post_meta(get_the_ID(), 'custom_header_page', true);
    if ($custom_header_page == 'on') {
        $transparent = get_post_meta(get_the_ID(), 'st_topbar_background_transparent', true);
        $st_topbar_background = get_post_meta(get_the_ID(), 'st_topbar_background', true);
    }
    if ($transparent == 'on') {
        $class = " background-transparent ";
    } else {
	    $class = " no-transparent ".Hotel_Alone_Helper::inst()->build_css('background:'.esc_attr($st_topbar_background));
    }
    ?>
    <div class="topbar <?php echo esc_attr($class); ?>">
        <?php echo st_hotel_alone_load_view('header/top-bar/top-bar'); ?>
    </div>
    <?php
    $st_fixed_menu = st()->get_option('st_hotel_alone_fixed_menu', 'off');
    if ($st_fixed_menu == 'on') {
        ?>
        <div class="topbar-scroll">
            <?php echo st_hotel_alone_load_view('header/top-bar/top-bar-scroll'); ?>
        </div>
    <?php }
    ?>
    <?php echo st_hotel_alone_load_view('header/header-mobile'); ?>