<?php
if ( ! class_exists( 'BTOTPostTypeSelect' ) ) {
	class BTOTPostTypeSelect extends BTOptionField {
		static $instance = null;
		public $curent_key;

		function __construct() {
			parent::__construct( __FILE__ );

			parent::init( array(
				'id'   => 'st_post_type_select',
				'name' => __( 'Page select', ST_TEXTDOMAIN )
			) );
		}

		static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	BTOTPostTypeSelect::instance();

	if ( ! function_exists( 'ot_type_st_post_type_select' ) ) {
		function ot_type_st_post_type_select( $args = array() ) {
			BTOTPostTypeSelect::instance()->curent_key = $args['field_name'];

			echo BTOTPostTypeSelect::instance()->load_view( false, array( 'args' => $args ) );
		}
	}
}
