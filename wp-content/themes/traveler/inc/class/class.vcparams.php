<?php
if(!function_exists('vc_map')) return false;
if(!class_exists('ST_VC_Params')) {
	class ST_VC_Params
	{
		static $_inst;
		function __construct()
		{
			$this->add_st_checkbox_shortcode_param('st_checkbox', array($this, 'checkbox_shortcode_param'), get_template_directory_uri() . '/js/admin/custom-vc.js');
			$this->add_st_dropdown_shortcode_param('st_dropdown', array($this, 'dropdown_shortcode_param'), get_template_directory_uri() . '/js/admin/custom-vc.js');
		}

		function add_st_dropdown_shortcode_param($name, $form_field_callback, $script_url = null){

			if(class_exists('WpbakeryShortcodeParams')) {
				return WpbakeryShortcodeParams::addField($name, $form_field_callback, $script_url);
			}
			return $name;
		}

		function dropdown_shortcode_param($settings, $value){
			if(class_exists('WpbakeryShortcodeParams')) {
				return st()->load_template('vc_params/st_dropdown',false,array('settings'=>$settings,'value'=>$value));
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
				return st()->load_template('vc_params/st_checkbox',false,array('settings'=>$settings,'value'=>$value));
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
	ST_VC_Params::inst();
}