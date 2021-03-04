<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!class_exists('WB_Form_Builder_Input'))
{
    class WB_Form_Builder_Input
    {
        static function ip_address()
        {

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return apply_filters('wb_form_builder_ip_address', $ip);

        }

        static function post($index= NULL,$default=false)
        {
            // Check if a field has been provided
            if ($index === NULL AND ! empty($_POST))
            {
                return $_POST;
            }

            if(isset($_POST[$index])) return $_POST[$index];

            return $default;

        }

        static function get($index= NULL,$default=false)
        {
            // Check if a field has been provided
            if ($index === NULL AND ! empty($_GET))
            {
                return $_GET;
            }

            if(isset($_GET[$index])) return $_GET[$index];

            return $default;
        }
        static function request($index= NULL,$default=false)
        {
            // Check if a field has been provided
            if ($index === NULL AND ! empty($_REQUEST))
            {
                return $_REQUEST;
            }

            if(isset($_REQUEST[$index])) return $_REQUEST[$index];

            return $default;
        }

    }
}
