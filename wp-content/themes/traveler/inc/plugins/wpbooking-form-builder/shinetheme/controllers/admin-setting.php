<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */

if(!class_exists('WB_Form_Builder_Admin_Settings')){
    class WB_Form_Builder_Admin_Settings{

        static $_inst;

        function __construct()
        {
            add_action( 'admin_menu', array($this,'register_wpbooking_form_builder_menu_page'),55 );

            add_action('admin_enqueue_scripts', array($this, '_enqueue_scripts'));
        }

        /**
         * Register form builder in menu
         *
         * @since 1.0
         */
        function register_wpbooking_form_builder_menu_page(){
            add_submenu_page( 'st_traveler_option', __( 'ST Form Builder', ST_TEXTDOMAIN ), __( 'ST Form Builder', ST_TEXTDOMAIN ), 'manage_options', 'wb_page_form_builder', [ $this, 'callback_wb_from_builder_sub_menu' ] );

        }

        /**
         * Load page builder html
         *
         * @since 1.0
         */
        function callback_wb_from_builder_sub_menu(){
            echo wb_form_builder_load_view('admin/form-builder');
        }

        /**
         * Enqueue scripts
         *
         * @since 1.0
         */
        function _enqueue_scripts(){
            if(isset($_GET['page']) && ($_GET['page'] == 'wb_page_form_builder') ) {
                wp_enqueue_script( 'jquery-ui-sortable' );
                wp_enqueue_script('form-builder', WB_Form_Builder::inst()->get_url('assets/admin/js/form-builder.js'), array('jquery','wp-util'), null, true);
                wp_localize_script('jquery', 'wb_fb_param', array(
                    'ajax_url'              => admin_url('admin-ajax.php'),
                    'error_form_title_empty'              => esc_html__('The form title is not empty.', ST_TEXTDOMAIN),
                    'error_field_title_empty'              => esc_html__('The title of item is not empty.', ST_TEXTDOMAIN),
                    'error_field_name_empty'              => esc_html__('The name of item is not empty.', ST_TEXTDOMAIN),
                    'error_field_name_contain_special'    => esc_html__('The name of item does not contain special characters.', ST_TEXTDOMAIN),
                    'error_field_title_contain_special'    => esc_html__('The title of item does not contain special characters.', ST_TEXTDOMAIN),
                    'error_field_name_iden'              => esc_html__('The name of item is not identical.', ST_TEXTDOMAIN)
                ));
                wp_enqueue_style('form-builder', WB_Form_Builder::inst()->get_url('assets/admin/css/form-builder.css'));
            }
        }

        static function inst(){
            if(!self::$_inst) self::$_inst = new self();

            return self::$_inst;
        }
    }

    WB_Form_Builder_Admin_Settings::inst();
}
