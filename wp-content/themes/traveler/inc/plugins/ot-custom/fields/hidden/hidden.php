<?php 
if(!class_exists('ST_Hidden_Field')){
	class ST_Hidden_Field{
		public  $url;
        public $dir;

        function __construct(){

            $this->dir = st()->dir('plugins/ot-custom/fields/hidden');
            $this->url = st()->url('plugins/ot-custom/fields/hidden');
        }
        function init(){

            if( !class_exists( 'OT_Loader' ) ) return false;

            add_filter( 'ot_option_types_array', array($this, 'ot_add_custom_option_types'));

        }

        function ot_add_custom_option_types( $types ) {
            $types['st_hidden'] = __('Hidden',ST_TEXTDOMAIN);

            return $types;
        }

        function load_view($view = false, $data = array()){

            return '';
        }
	}

    $hidden = new ST_Hidden_Field();
    $hidden->init();

    if(!function_exists('ot_type_st_hidden')){
        function ot_type_st_hidden($args = array()){
            echo '';
        }
    }    
}
?>