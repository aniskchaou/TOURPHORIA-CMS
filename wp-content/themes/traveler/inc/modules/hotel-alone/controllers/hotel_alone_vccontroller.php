<?php
if(!function_exists('vc_map')) return false;
if(!class_exists('Hotel_Alone_VCController')) {
    class Hotel_Alone_VCController
    {
        static $_inst;
        function __construct()
        {
            $this->add_st_number_shortcode_param('st_number', array($this, 'number_shortcode_param'));
            $this->add_radio_image_shortcode_param('radio_image', array($this, 'radio_image_shortcode_param'), st_hotel_alone_load_assets_dir() . '/admin/js/custom-vc.js');
	        //$this->add_st_checkbox_shortcode_param('st_checkbox', array($this, 'checkbox_shortcode_param'), st_hotel_alone_load_assets_dir() . '/admin/js/custom-vc.js');
	        //$this->add_st_dropdown_shortcode_param('st_dropdown', array($this, 'dropdown_shortcode_param'), st_hotel_alone_load_assets_dir() . '/admin/js/custom-vc.js');
        }

	    function add_st_dropdown_shortcode_param($name, $form_field_callback, $script_url = null){

		    if(class_exists('WpbakeryShortcodeParams')) {
			    return WpbakeryShortcodeParams::addField($name, $form_field_callback, $script_url);
		    }
		    return $name;
	    }

	    function dropdown_shortcode_param($settings, $value){
		    if(class_exists('WpbakeryShortcodeParams')) {
			    return st_hotel_alone_load_view('vc_param/st_dropdown',false,array('settings'=>$settings,'value'=>$value));
		    }
		    return false;
	    }

	    function add_st_checkbox_shortcode_param($name, $form_field_callback, $script_url = null){

		    if(class_exists('WpbakeryShortcodeParams')) {
			    return WpbakeryShortcodeParams::addField($name, $form_field_callback, $script_url);
		    }
		    return $name;
	    }

	    function checkbox_shortcode_param($settings, $value){
		    if(class_exists('WpbakeryShortcodeParams')) {
			    return st_hotel_alone_load_view('vc_param/st_checkbox',false,array('settings'=>$settings,'value'=>$value));
		    }
		    return false;
	    }


        function add_st_number_shortcode_param($name, $form_field_callback, $script_url = null){

            if(class_exists('WpbakeryShortcodeParams')) {
                return WpbakeryShortcodeParams::addField($name, $form_field_callback, $script_url);
            }
            return $name;
        }

        function number_shortcode_param($settings, $value){

            $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
            $class = isset($settings['class']) ? $settings['class'] : '';
            $min = isset($settings['min'])? $settings['min']:'';
            $max = isset($settings['max'])? $settings['max']:'';
            $prefix = isset($settings['prefix'])? $settings['prefix']:'';
            $val = isset($settings['value'])? $settings['value']:'';

            $output = '<label><input type="number" class="st_number wpb_vc_param_value wpb-input '.esc_attr($class).'" name="'.$param_name.'" min="'.esc_attr($min).'" max="'.esc_attr($max).'" value="'.(!empty($value)? $value: $val).'" /> '.$prefix.'</label>';

            return $output;
        }

        function add_radio_image_shortcode_param($name, $form_field_callback, $script_url = null){

            if(class_exists('WpbakeryShortcodeParams')) {
                return WpbakeryShortcodeParams::addField($name,$form_field_callback, $script_url);
            }
            return $name;
        }

        function radio_image_shortcode_param($settings, $value){
            if(class_exists('WpbakeryShortcodeParams')) {
                return st_hotel_alone_load_view('vc_param/radio_image',false,array('settings'=>$settings,'value'=>$value));
            }
            return false;
        }

        static function inst(){

            if(empty(self::$_inst)){
                self::$_inst = new self();
            }

            return self::$_inst;
        }
    }
    Hotel_Alone_VCController::inst();
}