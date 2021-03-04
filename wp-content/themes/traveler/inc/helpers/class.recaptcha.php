<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STRecaptcha
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STRecaptcha'))
{
    class STRecaptcha
    {
        static $_inst;
        protected $_api_key = array(
            'recaptcha'=>array(
                'key'=>'',
                'secret_key'=>''
            )
        );

        function __construct()
        {
            add_action('init', array($this, 'init'));
        }

        function init()
        {
            $this->_api_key = array(
                'recaptcha'=>array(
                    'key'=>st()->get_option('recaptcha_key'),
                    'secret_key'=>st()->get_option('recaptcha_secretkey')
                )
            );
            add_action('wp_enqueue_scripts',array($this,'register_script'));
        }

        function register_script()
        {
            if(is_singular())
            {
            	if(!empty($this->_api_key['recaptcha']['key']) && !empty($this->_api_key['recaptcha']['secret_key']) && $this->_is_check_allow_captcha()) {
		            wp_register_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
		            /*wp_localize_script( 'recaptcha', '', array(
			            'sitekey' => $this->_api_key['recaptcha']['key']
		            ) );*/
		            wp_enqueue_script( 'recaptcha' );
	            }
            }
        }

        function get_captcha($post_id = false)
        {
            if($this->_is_check_allow_captcha()){
                return '<div id="st_recaptcha_field_'.$post_id.'" class="g-recaptcha" data-sitekey="'.esc_attr($this->_api_key['recaptcha']['key']).'"></div>';
            }
        }

        function _is_check_allow_captcha(){
            $enable = st()->get_option('enable_captcha_login', 'off');
            if($enable == 'on'){
                return true;
            }else{
                return false;
            }

        }

        function validate_captcha()
        {
            if(!$this->_is_check_allow_captcha()){
                return array('status'=> 1 );
            }

            $url='https://www.google.com/recaptcha/api/siteverify';
            $url=add_query_arg(array(
                'secret'=>st()->get_option('recaptcha_secretkey'),
                'response'=>STInput::request('g-recaptcha-response'),
                'remoteip'=>STInput::ip_address()
            ),$url);

            $data=wp_remote_get($url);

            if(!is_wp_error($data)){
                $body = wp_remote_retrieve_body($data);

                $body_obj = json_decode($body);

                if(isset($body_obj->success) and $body_obj->success){
                    return array('status'=>1);
                }else{
                    return array('status'=>0,'message'=>__('Your captcha is not correct',ST_TEXTDOMAIN));
                }
            }else{
                return array(
                    'status'=>0,
                    'message'=>__('Can not verify reCAPTCHA',ST_TEXTDOMAIN)
                );
            }
        }

        static function inst(){
            if(!self::$_inst){
                self::$_inst = new self();
            }

            return self::$_inst;
        }
    }

    STRecaptcha::inst();
}
