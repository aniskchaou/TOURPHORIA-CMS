<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 8/2/2017
 * Version: 1.0
 */

if(!class_exists('WB_FB_Session'))
{
    class WB_FB_Session
    {
        static function _init()
        {
            //Hook action init: init session
            add_action('init',array(__CLASS__,'_action_init'));
        }

        static function _action_init()
        {
            // Use session for flash message
            if(!session_id()) {
                session_start();
            }
        }

        static function get($key=false,$default=NULL)
        {
            if($key and isset($_SESSION[$key])) return $_SESSION[$key];

            return $default;
        }
        static function set($key=false,$value)
        {
            $_SESSION[$key]=$value;
        }

        static function destroy($key){
            if(isset($_SESSION[$key])) unset($_SESSION[$key]);
        }
    }

    WB_FB_Session::_init();
}