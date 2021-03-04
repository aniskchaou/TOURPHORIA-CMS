<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STFacebook
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STFacebook'))
{
    class STFacebook
    {
        static $_fb=false;
        static $_wp_social_plugin=false;
        static function init()
        {
//        if(class_exists('STPFacebook'))
//        {
//            self::$_fb=true;
//        }

//        add_action('after_setup_theme',array(__CLASS__,'setup'));
//
//        add_action('init',array(__CLASS__,'st_handle_social_login'));
//
//        add_action('wp_logout', array(__CLASS__,'unset_facebook_session'));


            //Use Plugins
            if(defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ))
            {
                self::$_wp_social_plugin=true;
            }

        }

        static function get_provider_login_url($provider="Facebook")
        {
            $provider_id=ucfirst($provider);
            $current_page_url = wsl_get_current_url();

            $authenticate_base_url = site_url( 'wp-login.php', 'login_post' ) . ( strpos( site_url( 'wp-login.php', 'login_post' ), '?' ) ? '&' : '?' ) . "action=wordpress_social_authenticate&mode=login&";

            $authenticate_url = $authenticate_base_url . "provider=" . $provider_id . "&redirect_to=" . urlencode( $current_page_url );
        }

        static function unset_facebook_session()
        {
//        unset($_SESSION['st_facebook_data']);
//        STPFacebook::destroy_session();
        }

        static function st_handle_social_login()
        {
//        if(STInput::get('st_facebook_login'))
//        {
//            if( STInput::get('st_action'))
//            {
//                $url=STInput::get('url');
//
//                if(!self::$_fb) return false;
//
//                $redirect=home_url('/').'?st_facebook_login=1&st_action=complete';
//
//                if($url) $redirect.='&url='.urlencode($url);
//
//                switch(STInput::get('st_action'))
//                {
//                    case "authorize":
//                        $login_url=STPFacebook::get_login_url($redirect);
//                        wp_redirect($login_url);die;
//                        return;
//                    break;
//
//                    case "complete":
//
//                        $login_status=STPFacebook::check_login($redirect);
//                        if(isset($login_status['status']))
//                        {
//                            if(!$login_status['status'])
//                            {
//
//                            }
//                        }
//
//                        if(isset($_SESSION['st_facebook_data']) and  !empty($_SESSION['st_facebook_data'])){
//                            self::_try_login($_SESSION['st_facebook_data'],$url);
//                        }
//
//
//                        break;
//                    default:
//                        self::_redirect_off();
//                        break;
//                }
//
//            }else{
//                self::_redirect_off();
//            }
//
//        }
//
//        if(STInput::get('destroy_session'))
//        {
//            STPFacebook::destroy_session();
//        }


        }

        static private function _try_login($data,$redirect_after_login=false){

//        if(!$redirect_after_login) $redirect_after_login=home_url('/');
//
//        if(!isset($data['email']) or !$data['email']){
//            STTemplate::set_message(__('Sorry! We can not get your Facebook User Email. Please try again later',ST_TEXTDOMAIN),'danger');
//            return;
//        }
//
//        //Try Login
//        $query=new WP_User_Query(array(
//            'search_columns'=>array('user_login'),
//            'search'=>$data['email'],
//        ));
//
//
//
//        $user_founded=false;
//        $login_founded=false;
//        $email_founded=false;
//
//        if ( ! empty( $query->results ) ) {
//            foreach ( $query->results as $user ) {
//                if( $user->user_login ==$data['email'] and get_user_meta($user->ID,'oauth_platform',true)=='facebook')
//                {
//                    $user_founded=$user->ID;
//                    $login_founded=$user->user_login;
//                    break;
//                }
//
//                if($user->user_login==$data['email']){
//                    $email_founded=true;
//                }
//
//            }
//        }
//
//        //IF Found User, Try To login now
//        if($user_founded){
//            wp_set_current_user($user_founded,$login_founded);
//            wp_set_auth_cookie($user_founded);
//            do_action('wp_login', $login_founded);
//
//            wp_redirect($redirect_after_login);die;
//        }
//
//        //IF Email Founded but not by facebook register
//        if($email_founded){
//            STTemplate::set_message(sprintf(__('The Email: %s was used already. Please try with other facebook account.',ST_TEXTDOMAIN),$data['email']));
//            return;
//        }
//
//        // If Not, Register
//        $new=array(
//            'user_login'=>$data['email'],
//            'user_email'=>$data['email'],
//            'first_name'=>$data['first_name'],
//            'last_name'=>$data['last_name'],
//            'display_name'=>$data['display_name']
//        );
//
//        $user_id=wp_insert_user($new);
//
//        $user_exists=false;
//
//        if(!is_wp_error($user_id)){
//            wp_set_current_user($user_id,$data['email']);
//            update_user_meta($user_id,'oauth_platform','facebook');
//            wp_set_auth_cookie($user_id);
//            do_action('wp_login', $user_id);
//
//            wp_redirect($redirect_after_login);die;
//        }else
//        {
//            STTemplate::set_message($user_id->get_error_message(),'danger');
//        }
        }
        static private function _redirect_off(){
//        $redirect_off=home_url('/');
//        if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'])
//        {
//            $redirect=$_SERVER['HTTP_REFERER'];
//        }
//
//        wp_redirect('?st_action=11');die;
        }
        static private function _do_fblogin()
        {
            //$login_status=STPFacebook::check_login(home_url());
        }
        static function setup()
        {
//        if(!self::$_fb) return false;
//
//        $app_id=st()->get_option('social_fb_app_id');
//        $app_secret=st()->get_option('social_fb_app_secret');
//
//        if($app_id and $app_secret)
//        {
//            $status= STPFacebook::setup($app_id,$app_secret);
//        }
//        else{
//            self::$_fb=false;
//        }
        }

        static function get_login_url($url=false)
        {
//        if(!self::$_fb) return false;
//
//        $redirect=home_url('/').'?st_facebook_login=1&st_action=authorize';
//
//        if($url) $redirect.='&url='.urlencode($url);
//
//        return $redirect;
        }
    }

    STFacebook::init();
}

