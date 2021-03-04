<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */


if(!class_exists('WB_Form_Builder_Loader')){
    class WB_Form_Builder_Loader{

        static $_inst;

        private $lib_loaded=array();

        function __construct()
        {
            //add_action('wpbooking-form-builder-load-done',[$this,'_autoload']);
            $this->_autoload();
        }

        /**
         * Auto load
         *
         * @since 1.0
         *
         * @return bool
         */
        function _autoload(){


            $file = WB_Form_Builder::inst()->get_dir('shinetheme/configs/autoload.php');

            if(file_exists($file)) include $file;

            if(!isset($autoload)) return FALSE;

            if(!empty($autoload['config']))
            {
                WB_Form_Builder_Config::inst()->load($autoload['config']);
            }

            if(!empty($autoload['libs']))
            {
                $this->load_lib($autoload['libs']);
            }

            if(!empty($autoload['helper']))
            {
                $this->load_helper($autoload['helper']);
            }

            if(!empty($autoload['model']))
            {
                $this->load_model($autoload['model']);
            }

            if(!empty($autoload['controller']))
            {
                $this->load_controller($autoload['controller']);
            }

            return TRUE;
        }

        /**
         * Load controller
         *
         * @since 1.0
         *
         * @param $file
         */
        function load_controller($file){
            if(is_array($file) and !empty($file)){
                foreach($file as $f){
                    $this->load_controller($f);
                }
            }

            if(is_string($file)){
                $real_file = WB_Form_Builder::inst()->get_dir('shinetheme/controllers/'.$file.'.php');
                if(file_exists($real_file))
                {
                    include_once $real_file;

                }
            }
        }

        /**
         * Load helper
         *
         * @since 1.0
         *
         * @param $file
         */
        function load_helper($file){
            if(is_array($file) and !empty($file)){
                foreach($file as $f){
                    $this->load_helper($f);
                }
            }

            if(is_string($file)){
                $real_file = WB_Form_Builder::inst()->get_dir('shinetheme/helpers/'.$file.'.php');
                if(file_exists($real_file))
                {
                    include_once $real_file;

                }
            }
        }

        /**
         * Load libraries
         *
         * @since 1.0
         *
         * @param $file
         */
        function load_lib($file){
            if(is_array($file) and !empty($file)){
                foreach($file as $f){
                    $this->load_lib($f);
                }
            }

            if(is_string($file)){
                $real_file = WB_Form_Builder::inst()->get_dir('shinetheme/libs/'.$file.'.php');
                if(file_exists($real_file))
                {
                    include_once $real_file;
                }
            }
        }

        /**
         * Load model
         *
         * @since 1.0
         *
         * @param $file
         */
        function load_model($file)
        {
            if(is_array($file) and !empty($file)){
                foreach($file as $f){
                    $this->load_model($f);
                }
            }

            if(is_string($file)){

                if(isset($this->lib_loaded['model'][$file])) return;// Ignore Loaded File

                $real_file = WB_Form_Builder::inst()->get_dir('shinetheme/models/'.$file.'.php');
                if(file_exists($real_file))
                {
                    $this->lib_loaded['model'][$file]=true;
                    include_once $real_file;

                }
            }
        }

        static function init(){
            if(!self::$_inst) self::$_inst = new self();

            return self::$_inst;
        }

    }

    WB_Form_Builder_Loader::init();
}