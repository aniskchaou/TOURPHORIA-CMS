<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STSocialLogin
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STSocialLogin'))
{
    class STSocialLogin
    {

        static $_wp_social_installed = false;

        static function init()
        {
            add_action('init', array(__CLASS__, '_plugins_check'));
            add_action('init',array(__CLASS__,'_javascript_reload_parentwindow'));
        }

        static function _javascript_reload_parentwindow()
        {
            if(STInput::get('social_login_success')==1)
            {
                ?>
                <script>
                    window.opener.location.reload();
                    window.close();
                </script>
                <span class="hidden st_social_login_success_check"></span>
                <?php
                die;
            }
        }


        static function _plugins_check()
        {
            if (defined('WORDPRESS_SOCIAL_LOGIN_ABS_PATH')) {
                self::$_wp_social_installed = true;
            }
        }

        static function get_provider_login_url($provider = "Facebook")
        {
            if(!self::$_wp_social_installed) return false;
            $provider_id = ucfirst($provider);
            $current_page_url = home_url('?social_login_success=1');

            $authenticate_base_url = site_url('wp-login.php', 'login_post') . (strpos(site_url('wp-login.php', 'login_post'), '?') ? '&' : '?') . "action=wordpress_social_authenticate&amp;mode=login&amp;";

            $authenticate_url = $authenticate_base_url . "provider=" . $provider_id . "&amp;redirect_to=" . urlencode($current_page_url);

            return $authenticate_url;

        }
    }

    STSocialLogin::init();
}
