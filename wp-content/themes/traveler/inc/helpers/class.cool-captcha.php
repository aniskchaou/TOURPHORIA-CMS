<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STCoolCaptcha
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STCoolCaptcha'))
{
    class STCoolCaptcha
    {
        static function init()
        {
            add_action('init',array(__CLASS__,'_start_session'));
            add_action('init',array(__CLASS__,'_get_image'));
        }

        static function _start_session()
        {
            if(!session_id()){

                session_start();
            }

        }
        static function validate_captcha($key=false)
        {
            if($key){
                if (empty($_SESSION[$key]) || strtolower(trim($_REQUEST[$key])) != $_SESSION[$key]) {
                    return false;
                }else{
                    return true;
                }
            }
        }

        static function _get_image()
        {

            if(STInput::get('st_get_captcha')){
                $key=STInput::get('key');
                $captcha = new SimpleCaptcha();
                if($key){
                    $captcha->session_var = $key;
                }
                $captcha->CreateImage();
                die;
            }

        }

        static function get_code()
        {
            return 'st_'.md5(rand(1,999)*time());
        }
        static function get_captcha_url($key)
        {
            return esc_url(add_query_arg(array(
                'st_get_captcha'=>1,
                'key'=>$key
            ),home_url()));
        }
    }

    STCoolCaptcha::init();
}
