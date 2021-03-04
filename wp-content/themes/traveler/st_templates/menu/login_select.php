<?php 
// login dropdown 
// from 1.1.9
if (empty($container)){$container = "div"; }
if (empty($class)) {$class = "top-user-area-avatar" ;}
$class_default = "nav-drop" ; 

$is_user_nav = st()->get_option('enable_user_nav','on') ?>
<?php if($is_user_nav == 'on'): ?>
    <?php if(is_user_logged_in()):?>
    <?php echo '<'.$container.' class="'.$class.'">'; ?>    
        <?php
        $account_dashboard = st()->get_option('page_my_account_dashboard');
        $location='#';
        if(!empty($account_dashboard)){
            $location = get_permalink($account_dashboard);
        }
        ?>
        <a href="<?php echo esc_url($location) ?>">
            <?php
            $current_user = wp_get_current_user();
             echo st_get_profile_avatar($current_user->ID,40);
            //echo st_get_language('hi').', '.$current_user->display_name;
            printf(__('hi, %s',ST_TEXTDOMAIN),$current_user->display_name);
            ?>
        </a>
    <?php echo  '</'.esc_attr($container).'>' ;?>
    <?php echo  '<'.esc_attr($container).'>' ;?>
        <a class="btn-st-logout" href="<?php echo wp_logout_url(home_url())?>"><?php st_the_language('sign_out')?></a>
    <?php echo  '</'.$container.'>' ;?>
    <?php else: ?>
         <?php echo '<'.esc_attr($container).' class="'.esc_attr($class_default).'">'; ?>    
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
            <a href="#" onclick="return false;"><?php echo __("Account", ST_TEXTDOMAIN);?><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
            <ul class="list nav-drop-menu user_nav_big social_login_nav_drop" >
                <li><a  class="" <?php echo ($login_modal); ?>  href="<?php echo ($page_login) ?>"><?php echo __("Sign In", ST_TEXTDOMAIN);?></a></li>
                <li><a  class="" <?php echo ($res_modal); ?>  href="<?php echo ($page_user_register) ?>" ><?php echo __("Sign Up", ST_TEXTDOMAIN);?></a></li>

                <?php if(st_social_channel_status('facebook')): ?>
                    <li class="social_img"><a onclick="return false" class="btn_login_fb_link st_login_social_link" data-channel="facebook" href="#"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo get_template_directory_uri()."/img/social/facebook-logo.jpg"; ?>"/></a></li>
                <?php endif;?>

                <?php if(st_social_channel_status('google')): ?>
                    <li class="social_img"><a onclick="return false" class="btn_login_gg_link st_login_social_link" data-channel="google" href="#"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo get_template_directory_uri()."/img/social/google-plus.jpg"; ?>"/></a></li>
                <?php endif;?>

                <?php if(st_social_channel_status('twitter')): ?>
                    <li class="social_img"><a onclick="return false" class="btn_login_tw_link login_social_link" data-channel="twitter" href="<?php echo site_url() ?>/social-login/twitter"><img width="100" height="37" alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo get_template_directory_uri()."/img/social/twitter-logo.png"; ?>"/></a></li>
                <?php endif;?>
            </ul>
        <?php echo  '</'.esc_attr($container).'>' ;?>
    <?php endif;?>
<?php endif; ?>
<script>
    jQuery(document).ready(function($){

        if(typeof window.gapi!='undefined')
        {
            initGoogleClient();
        }

        function initGoogleClient()
        {
            var config = { client_id:st_social_params.google_client_id, scope: 'profile email https://www.googleapis.com/auth/plus.login' };

            window.gapi.load('auth2', function () {
                window.gapi.auth2.init(config);
            })
        }

        function startLoginWithFacebook(btn){
            btn.addClass('loading');

            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    sendLoginData({
                        'channel':'facebook',
                        'access_token':response.authResponse.accessToken
                    });

                } else{
                    FB.login(function(response) {
                        if (response.authResponse) {
                            sendLoginData({
                                'channel':'facebook',
                                'access_token':response.authResponse.accessToken
                            });

                        } else {
                            alert('User cancelled login or did not fully authorize.');
                        }
                    }, {
                        scope: 'email',
                        return_scopes: true
                    });
                }
            });
        }


        function startLoginWithGoogle(btn){
            btn.addClass('loading');

            if(typeof window.gapi.auth2 =='undefined') return;

            window.gapi.auth2.getAuthInstance().grantOfflineAccess({'redirect_uri': 'postmessage'}).then(function (response) {
                console.log(response);
                sendLoginData({
                    'channel':'google',
                    'authorizationCode':response.code
                });
            }, function (error) {
                console.log(error);
                alert('Google Server SIGN-IN ERROR');
            })
        }

        function sendLoginData(data)
        {
            data._s = st_params._s;
            data.action = 'traveler.socialLogin';

            $.ajax({
                data:data,
                type:'post',
                dataType:'json',
                url:st_params.ajax_url,
                success:function (rs) {
                    handleSocialLoginResult(rs);
                },
                error:function (e) {

                    alert('Can not login. Please try again later');
                }
            })
        }


        function handleSocialLoginResult(rs)
        {
            if(rs.reload) window.location.reload();
            if(rs.message) alert(rs.message);
        }


        $('.st_login_social_link').on('click',function () {
            var channel = $(this).data('channel');

            switch (channel) {
                case "facebook":
                    startLoginWithFacebook($(this));
                    break;
                case "google":
                    startLoginWithGoogle($(this));
                    break;
            }
        })
    })
</script>
