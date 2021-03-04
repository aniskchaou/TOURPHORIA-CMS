<?php
if ( ! class_exists( 'BTOTPosttypeCheckbox' ) ) {
	class BTOTPosttypeCheckbox extends BTOptionField {
		static $instance = null;
		public $curent_key;

		function __construct() {
			parent::__construct( __FILE__ );

			parent::init( array(
				'id'   => 'st_checkbox_posttype',
				'name' => __( 'Taxonomy select', ST_TEXTDOMAIN )
			) );
		}

		static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	BTOTPosttypeCheckbox::instance();

	if ( ! function_exists( 'ot_type_st_checkbox_posttype' ) ) {
		function ot_type_st_checkbox_posttype( $args = array() ) {
			BTOTPosttypeCheckbox::instance()->curent_key = $args['field_name'];

			echo BTOTPosttypeCheckbox::instance()->load_view( false, array( 'args' => $args ) );
		}
	}
}
