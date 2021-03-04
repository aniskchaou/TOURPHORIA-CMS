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
if(New_Layout_Helper::isNewLayout()){
    echo st()->load_template('layouts/modern/common/header');
    return;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, minimum-scale=1">
    <meta name="theme-color" content="<?php echo st()->get_option('main_color', '#ED8323'); ?>"/>
    <meta name="robots" content="follow" />
    <?php if(defined('ST_TRAVELER_VERSION')){?>  <meta name="traveler" content="<?php echo esc_attr(ST_TRAVELER_VERSION) ?>"/>  <?php };?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php if(!function_exists('_wp_render_title_tag')):?>
        <title><?php wp_title('|',true,'right') ?></title>
    <?php endif;?>
    <?php wp_head(); ?>
    <script>
        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.fbAsyncInit = function() {

            FB.init({
                appId: st_params.facbook_app_id,
                cookie: true,  // enable cookies to allow the server to access
                               // the session
                xfbml: true,  // parse social plugins on this page
                version: 'v3.1' // use graph api version 2.8
            });

        };
    </script>
</head>
<?php
    $menu_style = st()->get_option('menu_style' , "1");
    if($menu_style == '3'){
        $bclass = 'body-header-3';
    }else{
        $bclass = 'menu-style-' . $menu_style;
    }
?>
<body <?php body_class($bclass); ?>>
    <?php do_action('before_body_content')?>
    <?php $enable_popup_login = st()->get_option('enable_popup_login','off');
    if($enable_popup_login == 'on'){
    ?>
    <?php echo st()->load_template('login/popup-login',null,array()); ?>
    <?php echo st()->load_template('login/popup-register',null,array()); ?>
    <?php } ?>
    <?php 
        $enable_preload = st()->get_option('search_enable_preload', 'on');
        if( $enable_preload == 'on' && !TravelHelper::is_service_search() ){
            echo st()->load_template('search-loading');
        }
    ?>
    <?php
    if(wp_is_mobile()){
        echo '<div id="wp_is_mobile"></div>';
    }
    ?>
    <div id="st_header_wrap" class="global-wrap header-wrap <?php echo apply_filters('st_container',true) ?>">
        <div class="row" id="st_header_wrap_inner">
            <?php
                $is_topbar = st()->get_option('enable_topbar' , 'off') ;
                if ($is_topbar == "on"){
                    echo st()->load_template('menu/top_bar' , null,  array()) ;
                }
            ?>
            <?php
                $menu_style = st()->get_option('menu_style' , "1");
                echo st()->load_template('menu/style' , $menu_style ,  array()) ;
            ?>
        </div>
    </div>
<div class="global-wrap <?php echo apply_filters('st_container',true) ?>">
    <div class="row">
