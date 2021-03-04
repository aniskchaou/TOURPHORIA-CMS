<?php
if ( ! class_exists( 'BTOTSSContentSelect' ) ) {
	class BTOTSSContentSelect extends BTOptionField {
		static $instance = null;
		public $curent_key;

		function __construct() {
			parent::__construct( __FILE__ );

			parent::init( array(
				'id'   => 'ss_content_select',
				'name' => __( 'SkyScanner Content select', ST_TEXTDOMAIN )
			) );
		}

		static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	BTOTSSContentSelect::instance();

	if ( ! function_exists( 'ot_type_ss_content_select' ) ) {
		function ot_type_ss_content_select( $args = array() ) {
			BTOTSSContentSelect::instance()->curent_key = $args['field_name'];

			echo BTOTSSContentSelect::instance()->load_view( false, array( 'args' => $args ) );
		}
	}
}
