<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:35 PM
 */
if(!class_exists('BTOTAddress'))
{
    class BTOTAddress extends BTOptionField
    {
        static  $instance=null;
        public $curent_key;

        function __construct()
        {
            parent::__construct(__FILE__);

            parent::init(array(
                'id'=>'address_autocomplete',
                'name'          =>__('Address Autocomplete',ST_TEXTDOMAIN)
            ));

            add_action('admin_enqueue_scripts',array($this,'add_scripts'));

        }

        
        function add_scripts()
        {
            wp_register_script('bt-address-init',$this->_url.'js/init.js',array('jquery','gmap-apiv3'),false,true);
            wp_register_style('bt-address',$this->_url.'css/address-autocomplete.css');
        }


        static function instance()
        {
            if(self::$instance==null)
            {
                self::$instance=new self();
            }

            return self::$instance;
        }

    }

    BTOTAddress::instance();

    if(!function_exists('ot_type_address_autocomplete'))
    {
        function ot_type_address_autocomplete($args = array())
        {
            wp_enqueue_script('bt-address-init');
            wp_enqueue_style('bt-address');

            BTOTAddress::instance()->curent_key=$args['field_name'];

            echo BTOTAddress::instance()->load_view(false,array('args'=>$args));
        }
    }
}
