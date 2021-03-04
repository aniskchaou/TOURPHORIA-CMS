<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 12/23/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if(!class_exists('WB_Form_Builder_Abstract_fields')){
    abstract class WB_Form_Builder_Abstract_fields{

        protected $field_id;
        protected $field_settings;
        protected $field_group;
        protected $field_info = array();

        function __construct()
        {
            $this->field_info = wp_parse_args($this->field_info, array(
                'title' => '',
                'desc' => ''
            ));
            add_filter('init', array($this, '_register_field'));
        }

        function get_info($key){
            if(key_exists($key, $this->field_info)){
                return $this->field_info[$key];
            }
            return FALSE;
        }

        function get_field_settings(){
            return $this->field_settings;
        }

        public function get_frontend_html($data){

        }
        public function get_admin_html($data, $order_id){
            
        }

        function _register_field()
        {
            WB_Form_Builder_Controller::inst()->register_fields($this->field_id, $this->field_group, $this);
        }
    }
}