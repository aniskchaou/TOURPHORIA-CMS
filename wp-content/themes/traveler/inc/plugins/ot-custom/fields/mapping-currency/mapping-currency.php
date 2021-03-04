<?php
if(!class_exists('ST_Mapping_Currency_Field')){
	class ST_Mapping_Currency_Field{
		public  $url;
		public $dir;

		function __construct(){

			$this->dir = st()->dir('plugins/ot-custom/fields/mapping-currency');
			$this->url = st()->url('plugins/ot-custom/fields/mapping-currency');


			add_action('admin_enqueue_scripts',array($this,'add_scripts'));
		}

		function init(){

			if( !class_exists( 'OT_Loader' ) ) return false;

			add_filter( 'ot_option_types_array', array($this, 'ot_add_custom_option_types'));

		}
		function add_scripts(){
			wp_register_script('st-mapping-currency-init', $this->url . '/js/custom.js', array('jquery'), NULL, TRUE);
			wp_register_style('st-mapping-currency-init', $this->url . '/css/custom.css');
			wp_register_style('st-mapping-currency-bootstrap', $this->url . '/css/bootstrap.min.css');

		}

		function ot_post_select_ajax_unit_types($array, $id){
			return apply_filters( 'st_mapping_currency', $array, $id );
		}

		function ot_add_custom_option_types( $types ) {
			$types['st_mapping_currency'] = __('Mapping Currency',ST_TEXTDOMAIN);

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

	$mapping_currency = new ST_Mapping_Currency_Field();
    $mapping_currency->init();

	//XKEI - Required register type ì not "No function load..."
	if(!function_exists('ot_type_st_mapping_currency')){
		function ot_type_st_mapping_currency($args = array()){
            $mapping_currency = new ST_Mapping_Currency_Field();
			$default = array(
				'field_name' => ''
			);
			$args = wp_parse_args($args, $default);

			wp_enqueue_script('st-mapping-currency-init');
			wp_enqueue_style('st-mapping-currency-bootstrap');
			wp_enqueue_style('st-mapping-currency-init');

			echo $mapping_currency->load_view(false, $args);
		}
	}
}
?>