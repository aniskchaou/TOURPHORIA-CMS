<?php 
if(!class_exists('ST_Total_Time')){
	class ST_Total_Time extends BTOptionField{
        static  $instance=null;
        public $curent_key;

        function __construct()
        {
            parent::__construct(__FILE__);

            parent::init(array(
                'id'=>'st_total_time',
                'name'          =>esc_html__('ST Total Time',ST_TEXTDOMAIN)
            ));

            add_action('admin_enqueue_scripts',array($this,'add_scripts'));

        }


        function add_scripts()
        {
            wp_register_style('st-total-time',$this->_url.'css/custom.css');
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

    ST_Total_Time::instance();

    if(!function_exists('ot_type_st_total_time')){
        function ot_type_st_total_time($args = array()){

            wp_enqueue_style('st-total-time');

            ST_Total_Time::instance()->curent_key=$args['field_name'];

            echo ST_Total_Time::instance()->load_view(false,array('args'=>$args));
        }
    }    
}
?>