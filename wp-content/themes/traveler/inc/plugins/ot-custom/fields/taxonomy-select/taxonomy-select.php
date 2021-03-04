<?php
if ( ! class_exists( 'BTOTTaxSelect' ) ) {
	class BTOTTaxSelect extends BTOptionField {
		static $instance = null;
		public $curent_key;

		function __construct() {
			parent::__construct( __FILE__ );

			parent::init( array(
				'id'   => 'st_select_tax',
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

	BTOTTaxSelect::instance();

	if ( ! function_exists( 'ot_type_st_select_tax' ) ) {
		function ot_type_st_select_tax( $args = array() ) {
			BTOTTaxSelect::instance()->curent_key = $args['field_name'];

			echo BTOTTaxSelect::instance()->load_view( false, array( 'args' => $args ) );
		}
	}
}
