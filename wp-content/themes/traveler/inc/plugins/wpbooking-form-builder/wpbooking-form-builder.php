<?php
if(!class_exists('WB_Form_Builder')){

    class WB_Form_Builder{
        static $_inst;

        private $_version = 1.0;

        protected $_dir_path = FALSE;
        protected $_dir_url = FALSE;
        protected $global_values = array();

        function __construct()
        {

        }

        private function initial()
        {
            $this->_dir_path = st()->dir('plugins/wpbooking-form-builder/');
            $this->_dir_url = st()->url('plugins/wpbooking-form-builder/');
            //add_action('init',[$this,'_load_core_files']);
            $this->_load_core_files();
        }


        /**
         * Load core files
         *
         * @since 1.0
         */
        function _load_core_files(){

            $core_files = array(
                'cores/config',
                'cores/loader',
                'cores/session'
            );

            $this->load($core_files);

            //do_action('wpbooking-form-builder-load-done');

        }

        /**
         * Load file
         *
         * @since 1.0
         *
         * @param $file
         * @param bool $include_once
         */
        function load($file, $include_once = FALSE)
        {
            if (is_array($file)) {
                if (!empty($file)) {
                    foreach ($file as $value) {
                        $this->load($value, $include_once);
                    }
                }
            } else {
                $file = $this->get_dir('shinetheme/' . $file . '.php');

                if (file_exists($file)) {
                    if ($include_once) include_once($file);
                    include($file);

                }
            }
        }

        /**
         * Get dir
         *
         * @since 1.0
         *
         * @param bool $file
         * @return string
         */
        function get_dir($file = FALSE)
        {
            return $this->_dir_path . $file;
        }

        /**
         * Get url
         *
         * @since 1.0
         *
         * @param bool $file
         * @return string
         */
        function get_url($file = FALSE)
        {
            return $this->_dir_url . $file;
        }

        function set($name, $value)
        {
            $this->global_values[$name] = $value;
        }

        function get($name, $default = FALSE)
        {
            return isset($this->global_values[$name]) ? $this->global_values[$name] : $default;
        }

        function set_admin_message($message, $type = 'information')
        {
            $_SESSION['message']['admin'] = array(
                'content' => $message,
                'type'    => $type
            );
        }

        function get_admin_message($clear_message = TRUE)
        {
            $message = isset($_SESSION['message']['admin']) ? $_SESSION['message']['admin'] : FALSE;
            if ($clear_message) $_SESSION['message']['admin'] = array();

            return $message;
        }

        static function inst(){
            if(!self::$_inst){
                self::$_inst = new self();
                self::$_inst->initial();
            }

            return self::$_inst;
        }
    }

    WB_Form_Builder::inst();
}