<?php 
if(!class_exists('ST_Location_From_To')){
	class ST_Location_From_To extends BTOptionField{
		static  $instance = null;
        public $curent_key;

        function __construct(){
            parent::__construct(__FILE__);

            parent::init(array(
                'id'=>'st_location_from_to',
                'name'          =>__('Pick Up - Drop Off',ST_TEXTDOMAIN)
            ));


            add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        }

        static function instance()
        {
            if(self::$instance==null)
            {
                self::$instance=new self();
            }

            return self::$instance;
        }

        function add_scripts(){
            
                if(!in_array(get_post_type( ) , array('product', 'shop_order'))){
                    wp_register_script('select2.js', get_template_directory_uri() . '/js/select2/select2.min.js', array('jquery'), NULL, TRUE);

                    $lang = get_locale();
                    $lang_file = ST_TRAVELER_DIR.'/js/select2/select2_locale_'.$lang.'.js';
                    if(file_exists($lang_file)){
                        wp_register_script('select2-lang', get_template_directory_uri().'/js/select2/select2_locale_'.$lang.'.js',array('jquery','select2'),null,true);
                    }else{
                        $locale_array = explode('_',$lang);
                        if(!empty($locale_array) and $locale_array[0]){
                            $locale = $locale_array[0];

                            $lang_file = ST_TRAVELER_DIR.'/js/select2/select2_locale_'.$locale.'.js';
                            if(file_exists($lang_file))
                                wp_register_script('select2-lang',get_template_directory_uri().'/js/select2/select2_locale_'.$locale.'.js',array('jquery','select2'),null,true);
                        }
                    }
                    wp_register_script('st-location-init', $this->_url . '/js/custom.js', array('jquery', 'select2.js', 'select2-lang'), NULL, TRUE);

                    wp_register_style('st-location-bootstrap', $this->_url . '/css/bootstrap.min.css');
                    wp_register_style('st-select2', get_template_directory_uri(). '/js/select2/select2.css');
                }
                wp_register_style('st-location-css', $this->_url . '/css/custom.css');
            
        }
	}

    ST_Location_From_To::instance();

    if(!function_exists('ot_type_st_location_from_to')){
        function ot_type_st_location_from_to($args = array()){
            $default = array(
                'field_name' => ''
            );
            $args = wp_parse_args($args, $default);

            wp_enqueue_script('st-location-init');

            wp_enqueue_style('st-location-bootstrap');
            wp_enqueue_style('st-select2');
            wp_enqueue_style('st-selectize-bootstrap');
            wp_enqueue_style('st-location-css');

            ST_Location_From_To::instance()->curent_key=$args['field_name'];

            echo ST_Location_From_To::instance()->load_view(false,array('args'=>$args));
        }
    }   

    if(!function_exists('ot_type_st_location_from_to_html')){
        function ot_type_st_location_from_to_html($args = array()){
            $default = array(
                'field_name' => ''
            );
            $args = wp_parse_args($args, $default);

            wp_enqueue_script('st-location-init');

            wp_enqueue_style('st-location-bootstrap');
            wp_enqueue_style('st-select2');
            wp_enqueue_style('st-selectize-bootstrap');
            wp_enqueue_style('st-location-css');

            ST_Location_From_To::instance()->curent_key=$args['field_name'];

            echo ST_Location_From_To::instance()->load_view(false,array('args'=>$args));
        }
    }   
}
?>