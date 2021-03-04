<div class="my-account <?php if(!is_user_logged_in()) echo 'no_login'; ?>">
    <?php
    if(is_user_logged_in()){
        $current_user = wp_get_current_user();
        $user_email = $current_user->user_email;
        $account_dashboard = st()->get_option('page_my_account_dashboard');
        $my_account='#';
        if(!empty($account_dashboard)){
            $my_account = get_permalink($account_dashboard);
        }

        $setting_link = add_query_arg([
            'sc' => 'setting'
        ], $my_account);

        $is_account_sub_menu = 'on';
        $name = $current_user->first_name." ".$current_user->last_name;
        if(empty($current_user->first_name) and empty($current_user->last_name)) $name = $current_user->display_name;
        $url_logout = wp_logout_url();
        ?>
        <div class="dropdown">
            <?php if($is_account_sub_menu == 'on'){?>
                <span class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user-circle"></i>
                </span>
            <?php }else{  ?>
                <a href="<?php echo esc_url($my_account) ?>">
                    <span class="dropdown-toggle"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                </a>
            <?php } ?>
            <ul class="dropdown-menu <?php if($is_account_sub_menu == 'off') echo "hide"; ?>">
                <div class="overlay"></div>
                <li><a href="<?php echo esc_url($my_account) ?>"><i class="fa fa-user"></i> <?php echo esc_html($name) ?></a> </li>
                <li><a href="<?php echo esc_url($setting_link) ?>"><i class="fa fa-cog"></i> <?php esc_html_e("Account settings",ST_TEXTDOMAIN) ?></a></li>
                <li><a href="<?php echo esc_html($url_logout) ?>"><i class="fa fa-power-off"></i> <?php esc_html_e("Log out",ST_TEXTDOMAIN) ?></a></li>
            </ul>
        </div>
    <?php }else{
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
        $login_fb=st()->get_option('social_fb_login','on');
        $login_gg=st()->get_option('social_gg_login','on');
        $login_tw=st()->get_option('social_tw_login','on');
        ?>
        <div class="dropdown">
            <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </span>
            <ul class="dropdown-menu register-user">
                <li><a  class="" <?php echo ($login_modal); ?>  href="<?php echo ($page_login) ?>"><?php echo __("Login", ST_TEXTDOMAIN);?></a></li>
                <li><a  class="" <?php echo ($res_modal); ?>  href="<?php echo ($page_user_register) ?>" ><?php echo __("Sign Up", ST_TEXTDOMAIN);?></a></li>
                <?php if(defined('WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL')) { ?>
                    <?php if($login_fb=="on"): ?>
                        <li class="social_img"><a onclick="return false" class="btn_login_fb_link login_social_link" href="<?php echo STSocialLogin::get_provider_login_url('Facebook') ?>"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo ST_TRAVELER_URI."/img/social/facebook-logo.jpg"; ?>"/></a></li>
                    <?php endif;?>

                    <?php if($login_gg=="on"): ?>
                        <li class="social_img"><a onclick="return false" class="btn_login_gg_link login_social_link" href="<?php echo STSocialLogin::get_provider_login_url('Google') ?>"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo ST_TRAVELER_URI."/img/social/google-plus.jpg"; ?>"/></a></li>
                    <?php endif;?>

                    <?php if($login_tw=="on"): ?>
                        <li class="social_img"><a onclick="return false" class="btn_login_tw_link login_social_link" href="<?php echo STSocialLogin::get_provider_login_url('Twitter') ?>"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo ST_TRAVELER_URI."/img/social/twitter-logo.png"; ?>"/></a></li>
                    <?php endif;?>
                <?php }; ?>
            </ul>
        </div>
    <?php } ?>
</div>