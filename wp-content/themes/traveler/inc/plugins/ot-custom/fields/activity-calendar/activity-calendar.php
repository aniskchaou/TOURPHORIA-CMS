<?php 
if(!class_exists('ST_Activity_Calendar_Field')){
	class ST_Activity_Calendar_Field{
		public  $url;
        public $dir;

        function __construct(){

            $this->dir = st()->dir('plugins/ot-custom/fields/activity-calendar');
            $this->url = st()->url('plugins/ot-custom/fields/activity-calendar');


            add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        }
        function init(){

            if( !class_exists( 'OT_Loader' ) ) return false;

            add_filter( 'ot_st_activity_calendar_unit_types', array($this, 'ot_post_select_ajax_unit_types'), 10, 2 );

            add_filter( 'ot_option_types_array', array($this, 'ot_add_custom_option_types'));

        }
        function add_scripts(){
                wp_register_script('date.js', get_template_directory_uri() . '/js/date.js', array('jquery'), NULL, TRUE);
                wp_register_script('st-availablility-activity-init', $this->url . '/js/custom.js', array('jquery', 'date.js'), NULL, TRUE);
                wp_register_style('st-availablility-activity-init', $this->url . '/css/custom.css');
                wp_register_style('st-availablility-activity-bootstrap', $this->url . '/css/bootstrap.min.css');
        }

        function ot_post_select_ajax_unit_types($array, $id){
            return apply_filters( 'st_activity_calendar', $array, $id );
        }

        function ot_add_custom_option_types( $types ) {
            $types['st_activity_calendar'] = __('Availability activity',ST_TEXTDOMAIN);

            return $types;
        }

        function load_view($view = false, $data = array()){

            if(!$view) $view = 'index';

            $file_name = $this->dir.'/views/'.$view.'.php';

            if(file_exists($file_name)){
                extract($data);

                ob_start();

                include $file_name;

                return @ob_get_clean();
            }
        }
	}

    $calendar_activity = new ST_Activity_Calendar_Field();
    $calendar_activity->init();

    if(!function_exists('ot_type_st_activity_calendar')){
        function ot_type_st_activity_calendar($args = array()){
            $calendar_activity = new ST_Activity_Calendar_Field();
            $default = array(
                'field_name' => ''
            );
            $args = wp_parse_args($args, $default);

            wp_enqueue_script('fullcalendar-lang');
            wp_enqueue_style('fullcalendar-css');
            
            wp_enqueue_script('st-availablility-activity-init');
            wp_enqueue_style('st-availablility-activity-bootstrap');
            wp_enqueue_style('st-availablility-activity-init');

            echo $calendar_activity->load_view(false, $args);
        }
    }    
}
?>