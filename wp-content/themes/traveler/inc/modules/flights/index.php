<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/7/2017
 * Version: 1.0
 */

if(!class_exists('ST_Traveler_Flights')){
    class ST_Traveler_Flights{

        static $_inst;

        protected $dir;

        function __construct()
        {
            $this->dir = dirname(__FILE__);

            add_filter('st_custom_list_post_type_tree', array($this, '_add_custom_post_type_setting'));

	        if(st_check_service_available( 'st_flight' ) or st_check_service_available('st_cars')) {
		        $this->loadModels();
	        }
            if(st_check_service_available( 'st_flight' )) {
                $this->loadHelpers();
                $this->loadController();
                add_action('init', array($this, 'loadElements'));
                $this->loadVcMap();
            }
        }

        function loadModels()
        {
            $models=glob($this->dir.'/models/*');

            if(!is_array($models) or empty($models)) return false;

            if(!empty($models))
            {
                foreach($models as $key => $value)
                {
                    $dirname = basename($value, '.php');

                    $file = ST_TRAVELER_DIR.'/'.$this->dir_name('models/'.$dirname).'.php';

                    if(file_exists($file)) include_once $file;
                }
            }

            return true;
        }

        function loadController()
        {
            $files = glob($this->dir.'/controllers/*');

            if(!is_array($files) or empty($files)) return false;

            if(!empty($files))
            {
                foreach($files as $key => $value)
                {
                    $dirname = basename($value, '.php');

                    $file = ST_TRAVELER_DIR.'/'.$this->dir_name('controllers/'.$dirname).'.php';

                    if(file_exists($file)) include_once $file;
                }
            }

            return true;
        }

        function loadHelpers()
        {
            $files = glob($this->dir.'/helpers/*');

            if(!is_array($files) or empty($files)) return false;

            if(!empty($files))
            {
                foreach($files as $key => $value)
                {
                    $dirname = basename($value, '.php');

                    $file = ST_TRAVELER_DIR.'/'.$this->dir_name('helpers/'.$dirname).'.php';

                    if(file_exists($file)) include_once $file;
                }
            }

            return true;
        }

        function loadVcMap(){
            $file = ST_TRAVELER_DIR . '/' . $this->dir_name('vc-elements/vc_map.php');
            if (file_exists($file)) include_once $file;
        }

        function loadElements(){

            $files = glob($this->dir.'/vc-elements/*');

            if(!is_array($files) or empty($files)) return false;

            if(!empty($files)){
                foreach($files as $key => $val){
                    $dirname = basename($val, '.php');

                    if($dirname != 'vc_map') {

                        $file = ST_TRAVELER_DIR . '/' . $this->dir_name('vc-elements/' . $dirname) . '.php';

                        if (!function_exists('vc_map') or !function_exists('st_reg_shortcode')) return false;

                        if (file_exists($file)) include_once $file;
                    }
                }
            }

            return true;
        }

        function dir_name($url=false)
        {
            return "inc/modules/flights/".$url;
        }

        function _add_custom_post_type_setting($arr){

            array_push($arr,
                array(
                    'label' => __( 'Flight' , ST_TEXTDOMAIN ) ,
                    'value' => 'st_flight'
                )
            );
            return $arr;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }

    }

    ST_Traveler_Flights::inst();

}