<?php 
if(!class_exists('ST_Rental_Distance_Field')){
	class ST_Rental_Distance_Field{
		public  $url;
        public $dir;

        function __construct(){

            $this->dir = st()->dir('plugins/ot-custom/fields/rental-distance');
            $this->url = st()->url('plugins/ot-custom/fields/rental-distance');


            add_action('admin_enqueue_scripts',array($this,'add_scripts'));
        }
        function init(){

            if( !class_exists( 'OT_Loader' ) ) return false;

            //Default Fields
            add_filter( 'ot_st_rental_distance_unit_types', array($this, 'ot_post_select_ajax_unit_types'), 10, 2 );

            add_filter( 'ot_option_types_array', array($this, 'ot_add_custom_option_types'));


        }
        function add_scripts(){
                wp_register_script('st-distance-rental-init', $this->url . '/js/custom.js', array('jquery'), NULL, TRUE);
                wp_register_style('st-distance-rental-init', $this->url . '/css/custom.css');
                wp_register_style('st-distance-rental-bootstrap', $this->url . '/css/bootstrap.min.css');

        }

        function ot_post_select_ajax_unit_types($array, $id){
            return apply_filters( 'st_rental_distance', $array, $id );
        }

        function ot_add_custom_option_types( $types ) {
            $types['st_rental_distance'] = __('Rental Distance',ST_TEXTDOMAIN);

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

    $calendar_rental = new ST_Rental_Distance_Field();
    $calendar_rental->init();

    if(!function_exists('ot_type_st_rental_distance')){
        function ot_type_st_rental_distance($args = array()){
            $calendar_rental = new ST_Rental_Distance_Field();
            $default = array(
                'field_name' => ''
            );
            $args = wp_parse_args($args, $default);
	        //wp_enqueue_script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAbiWD8crgFpYN8GEeaL6Qjg0lTpFJgmuk&libraries=places');
            wp_enqueue_script('st-distance-rental-init');
            wp_enqueue_style('st-distance-rental-bootstrap');
            wp_enqueue_style('st-distance-rental-init');

            echo $calendar_rental->load_view(false, $args);
        }
    }    
}
?>