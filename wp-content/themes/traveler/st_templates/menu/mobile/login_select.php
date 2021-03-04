<?php
// login dropdown
// from 1.1.9
if (empty($container)){$container = "div"; }
if (empty($class)) {$class = "top-user-area-avatar" ;}
$class_default = "nav-drop" ;

$login_fb=st()->get_option('social_fb_login','on');
$login_gg=st()->get_option('social_gg_login','on');
$login_tw=st()->get_option('social_tw_login','on');

$is_user_nav = st()->get_option('enable_user_nav','on') ?>
<?php if($is_user_nav == 'on'): ?>
    <?php if(is_user_logged_in()):?>

        <?php
        $account_dashboard = st()->get_option('page_my_account_dashboard');
        $location='#';
        if(!empty($account_dashboard)){
            $location = get_permalink($account_dashboard);
        }
        ?>

        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new top-user-area-avatar" style="display: none" >
            <a href="<?php echo esc_url($location) ?>">
                <?php
                $current_user = wp_get_current_user();
                echo st_get_profile_avatar($current_user->ID,40);
                printf(__(' hi, %s',ST_TEXTDOMAIN),$current_user->display_name);
                ?>
            </a>
        </li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none">
            <a href="<?php echo wp_logout_url(home_url())?>">
                <?php st_the_language('sign_out')?>
            </a>
        </li>
    <?php else: ?>

        <?php
            $enable_popup_login = st()->get_option('enable_popup_login','off');
            $page_login = st()->get_option('page_user_login');
            $page_user_register = st()->get_option('page_user_register');
            $login_modal = $res_modal = '';
            $page_login = esc_url(get_the_permalink($page_login));
            $page_user_register = esc_url(get_the_permalink($page_user_register));
            if($enable_popup_login == 'on'){
                $login_modal = 'data-toggle="modal" data-target="#login_popup"';
                $res_modal = 'data-toggle="modal" data-target="#register_popup"';
                $page_login = $page_user_register = 'javascript:void(0)';
            }
        ?>
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none">
            <a  class="" <?php echo ($login_modal); ?>  href="<?php echo ($page_login) ?>"><?php echo __("Sign In", ST_TEXTDOMAIN);?></a>
            <?php if( $login_fb == 'on' || $login_gg == 'on' || $login_tw == 'on'): ?>
            <ul class="sub-menu social_login_nav_drop" style="display: none;">
                <?php if($login_fb=="on"): ?>
                    <li><a onclick="return false;" class="btn_login_fb_link st_login_social_link" data-channel="facebook" href="#"><?php st_the_language('connect_with')?> <i class="fa fa-facebook"></i></a></li>
                <?php endif;?>

                <?php if($login_gg=="on"): ?>
                    <li><a onclick="return false;" class="btn_login_gg_link st_login_social_link" data-channel="google" href="#"><?php st_the_language('connect_with')?> <i class="fa fa-google-plus"></i></a></li>

                <?php endif;?>

                <?php if($login_tw=="on"): ?>
                    <li><a onclick="return false;" class="btn_login_tw_link login_social_link" data-channel="twitter" href="<?php echo site_url() ?>/social-login/twitter"><?php st_the_language('connect_with')?> <i class="fa fa-twitter"></i></a></li>
                <?php endif;?>
            </ul>
            <?php endif; ?>
        </li>
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  slimmenu-sub-menu st_menu_mobile_new" style="display: none">
            <a  class="" <?php echo ($res_modal); ?>  href="<?php echo ($page_user_register) ?>" ><?php echo __("Sign Up", ST_TEXTDOMAIN);?></a>
        </li>

    <?php endif;?>
<?php endif; ?>

