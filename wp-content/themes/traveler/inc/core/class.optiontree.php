<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STOptiontree
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STOptiontree'))
{
    class STOptiontree
    {
        public $theme;
        public $check_qtrans; // priority 2
        public $check_wpml; // priority 1
        function __construct()
        {
            $this->check_wpml = self::check_wpml();
            $this->check_qtrans = self::check_qtrans();

            if (!class_exists('OT_Loader')) return;
            //add_action('admin_init', array($this, 'custom_theme_options'));


            add_action('admin_init', array($this, 'custom_meta_boxes'));

            $this->theme = wp_get_theme();
//
//            add_filter('ot_header_version_text', array($this, 'ot_header_version_text'));
//
//            add_filter('ot_theme_options_menu_slug', array($this, 'change_menu_slug'));
//            add_filter('ot_theme_options_icon_url', array($this, 'change_icon_url'));
//            add_filter('ot_theme_options_parent_slug', array($this, 'change_parent_slug'));
//            add_filter('ot_theme_options_menu_title', array($this, 'change_menu_title'));
//            add_filter('ot_theme_options_position', array($this, 'change_position'));
//            add_filter('ot_header_logo_link', array($this, '_change_header_logo_link'));
//
//            add_filter( 'ot_show_new_layout', array(& $this, 'show_new_layout' ));
            add_action('admin_init' , array($this,'deactive_'));
            //Check WPML Installed
            if($this->check_wpml){

                add_action('admin_init', array($this, '_copy_default_theme_option'));
                add_filter('st_options_id',array($this,'_get_option_by_lang'),10,1);
                add_action('admin_init',array($this,'_coppy_default_options_to_all_option'));
            }

            // check qtranslatex installed
            if ($this->check_qtrans){
                add_action('admin_init', array($this, 'qtrans_copy_default_theme_option'));
                add_filter('st_options_id',array($this,'_get_option_by_lang'),10,1);

            }

            //add_action('admin_menu', array(& $this, 'remove_menu_option'), 999);
            //add_filter( 'ot_show_pages', '__return_false' );
            
        }

        /**
        * from 1.1.7
        * deactive qtrans if wpml installed
        */
        static function deactive_(){
            if (self::check_qtrans() and self::check_wpml()){
                deactivate_plugins(QTRANSLATE_DIR."\/qtranslate.php");
            }
        }
        static function check_wpml(){
            if(defined('ICL_LANGUAGE_CODE') and defined('ICL_SITEPRESS_VERSION')){
                return true;
            }
            return false;
        }
        static function check_qtrans(){
            $return = function_exists('qtranxf_init_language');
            //if (self::check_wpml()){$return = false ;}
            return $return ;
        }

        function _get_option_by_lang($option='option_tree')
        {
            $option_key = $option;
            // if wpml
            if($this->check_wpml){
                $option_key = $option.'_'.ICL_LANGUAGE_CODE;
            }
            // if qtranslate
            if ($this->check_qtrans){
                global $q_config;                
                $languge = $q_config['language'];
                $option_key = $option.'_'.$languge;
            }
            return $option_key;
        }
        //*from 1.2.3 when can be save options tree in "all language "
        function _coppy_default_options_to_all_option(){
            if(!$this->check_wpml){ return ;}

            global $sitepress;
            $option_name='option_tree';
            $default_lang = $sitepress->get_default_language();
            $options = get_option($option_name."_".$default_lang);
            if (ICL_LANGUAGE_CODE =='all') {
                update_option($option_name.'_'.'all',$options);
            }
        }
        function _copy_default_theme_option()
        {
            $option_name='option_tree';
            
            if($this->check_wpml){
                //global $sitepress;
                $options = get_option($option_name);

                $st_plugin_list_lang = icl_get_languages('skip_missing=0&orderby=custom');
                //$default_lang = $sitepress->get_default_language();
                if(is_array($st_plugin_list_lang) && !empty($st_plugin_list_lang))
                {
                    foreach ($st_plugin_list_lang as $lang) {
                        $lang_option = get_option($option_name.'_'.$lang['language_code']);
                        if($lang_option==''){
                            update_option($option_name.'_'.$lang['language_code'],$options);
                        }
                    }
                }

            }

        }
        /**
        * from 1.1.7
        */

        function qtrans_copy_default_theme_option()
        {
            if (!$this->check_qtrans){return ; }
            global $q_config;
            $locale_list = $q_config['locale'];
            $option_name='option_tree';
            if($this->check_qtrans){
                $options = get_option($option_name);

                //$st_plugin_list_lang = icl_get_languages('skip_missing=0&orderby=custom');
                $st_plugin_list_lang = array();
                $qtrans_list = qtranxf_getSortedLanguages();
                $flags = qtranxf_language_configured('flag');
                if (!empty($qtrans_list) and is_array ($qtrans_list)){
                    foreach ($qtrans_list as $key=> $value) {       
                        $lang_name = $q_config['language_name'][$value];                
                        $array = array(
                                'id'=>$key,
                                'active'=>($value ==  $q_config['language'] )? 1 : 0  ,
                                'encode_url'=> 0 ,
                                'default_locale'=>$locale_list[$value],
                                'tag'=>'',
                                'native_name'=> $lang_name,
                                'language_code'=> $value,
                                'translated_name'=> $lang_name,
                                'url'=>qtranxf_convertURL(admin_url(),$value, true, true),
                                'country_flag_url'=>qtranxf_flag_location().$flags[$value]
                            );
                        $st_plugin_list_lang [$value] = $array;
                    }
                }; 

                if(is_array($st_plugin_list_lang) && !empty($st_plugin_list_lang))
                {
                    foreach ($st_plugin_list_lang as $lang) {
                        
                        $lang_option = get_option($option_name.'_'.$lang['language_code']);

                        if($lang_option==''){
                            update_option($option_name.'_'.$lang['language_code'],$options);
                        }
                        
                    }
                }
            }

        }
        
        function remove_menu_option(){
            remove_menu_page('ot-settings');
        }

        function show_new_layout(){
            return false;
        }
        function _change_header_logo_link()
        {
            return "<a ><img alt='". TravelHelper::get_alt_image() ."' src='".get_template_directory_uri()."/css/admin/logo-st.png'></a>";
        }
        function change_position()
        {
            if(class_exists('Envato_WP_Toolkit'))
            {
                return 59;
            }
            return 58;
        }
        function change_menu_title()
        {
            return apply_filters('change_menu_settings_title' ,  __('Traveler Settings',ST_TEXTDOMAIN) );
        }
        function change_parent_slug()
        {
            return '';
        }
        function change_icon_url()
        {
            return "dashicons-st-traveler";
        }
        function change_menu_slug($slug)
        {
            return apply_filters('change_menu_settings_slug' ,  'st_traveler_option' );
        }

        function ot_header_version_text($title)
        {
            $title=  esc_html(  $this->theme->display('Name') );
            $title.=' - '. sprintf(__('Version %s', ST_TEXTDOMAIN), $this->theme->display('Version'));

            // if wpml

            if($this->check_wpml)
            {
                $text =  ICL_LANGUAGE_NAME ? ICL_LANGUAGE_NAME : ICL_LANGUAGE_CODE;
                $title.=' '.sprintf(__('for %s',ST_TEXTDOMAIN),$text);

            }
            // if qtranslate
            if ($this->check_qtrans){
                global $q_config; 
                $lan = $q_config['language'];
                $title .= " ".sprintf(__('for %s',ST_TEXTDOMAIN), $q_config['language_name'][$lan]);
            }

            return $title;
        }



        function custom_meta_boxes()
        {
            /**
             * Get a copy of the saved settings array.
             */
            $custom_metabox=array();

            include_once ST()->dir('st-metabox.php');

            /**
             * Register our meta boxes using the
             * ot_register_meta_box() function.
             */
            if ( function_exists( 'ot_register_meta_box' ) )
            {
                if(!empty($custom_metabox))
                {
                    foreach ($custom_metabox as $value)
                    {
                        ot_register_meta_box( $value );
                    }
                }
            }

        }

        function custom_theme_options()
        {
			if(!function_exists('st_reg_shortcode')) return;
	        $option_version = '1.2.3';
	        $db_option_version = get_option( 'st_optiontree_version' );
	        if ( !$db_option_version )
		        $db_option_version = '0.0.0';
	        if ( $db_option_version ) {
		        if ( version_compare( $db_option_version, $option_version, '!=' ) ) {
			        $custom_settings = array();
			        //include_once ST()->dir( 'st-theme-options.php' );
			        /* allow settings to be filtered before saving */
			        $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
			        update_option( ot_settings_id(), $custom_settings );
			        update_option( 'st_optiontree_version', $option_version );
		        }else{
			        return;
		        }
	        }
        }

        // from 1.2.3
        static function get_locales(){
            $return = array();
            if (self::check_wpml()){
                $langs=icl_get_languages('skip_missing=0');
                if (!empty($langs) and is_array($langs)){
                    foreach ($langs as $key=>$val){
                        $return[] = $key ;
                    }
                }
            }
            if (self::check_qtrans()){
                $langs = qtranxf_getSortedLanguages();
                if (!empty($langs) and is_array($langs)){
                    foreach ($langs as $key=>$val) {
                        $return[] = $val;
                    }
                }
                
            }
            return $return ;
        }


    }
    new STOptiontree();
}
