<?php

class ST_Mega_Menu {

	public function __construct() {
		$this->_include_file();
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'st_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'st_update_custom_nav_fields' ), 10, 3 );
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'st_edit_walker' ), 10, 2 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_megamenu' ) );
	}

	function enqueue_megamenu() {
		//wp_enqueue_style( 'megamenu', get_template_directory_uri() . '/css/megamenu.css' );
	}

	function st_add_custom_nav_fields( $menu_item ) {
		$menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );

		return $menu_item;
	}

	function st_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		if ( !empty( $_POST['menu-item-megamenu'][ $menu_item_db_id ] ) ) {
			if ( $args['menu-item-parent-id'] == '0' ) {
				$subtitle_value = $_POST['menu-item-megamenu'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $subtitle_value );
			}
		}

	}

	function st_edit_walker( $walker, $menu_id ) {
		return 'Walker_Nav_Menu_Edit_Custom';
	}

	function _include_file() {
		require_once 'class.megamenu-posttype.php';
		include_once( 'edit_custom_walker.php' );
		include_once( 'custom_walker.php' );
	}
}

new ST_Mega_Menu();
