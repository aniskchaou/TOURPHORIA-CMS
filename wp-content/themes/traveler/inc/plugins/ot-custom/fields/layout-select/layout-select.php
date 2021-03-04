<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:35 PM
 */
if ( ! class_exists( 'BTOTLayoutSelect' ) ) {
	class BTOTLayoutSelect extends BTOptionField {
		static $instance = null;
		public $curent_key;

		function __construct() {
			parent::__construct( __FILE__ );

			parent::init( array(
				'id'   => 'st_select_layout',
				'name' => __( 'Layout select', ST_TEXTDOMAIN )
			) );

		}

		static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}

	BTOTLayoutSelect::instance();

	if ( ! function_exists( 'ot_type_st_select_layout' ) ) {
		function ot_type_st_select_layout( $args = array() ) {

			BTOTLayoutSelect::instance()->curent_key = $args['field_name'];

			echo BTOTLayoutSelect::instance()->load_view( false, array( 'args' => $args ) );
		}
	}
}
