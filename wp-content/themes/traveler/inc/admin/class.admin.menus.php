<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAdminMenu
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STAdminMenu' ) ) {

        class STAdminMenu extends STAdmin
        {
            function __construct()
            {
                //parent::__construct();
                add_action( 'admin_menu', [ $this, 'admin_menu' ], 50 );
            }

            function admin_menu()
            {
                add_submenu_page( 'st_traveler_option', "Attributes", 'Attributes', 'manage_options', 'hotel_attributes', [ $this, 'attributes_page' ] );
            }

            function attributes_page()
            {
                if ( class_exists( 'STAttribute' ) ) {
                    $a = new STAttribute();
                    echo balanceTags( $a->content() );
                }
            }
        }

        $admin = new STAdminMenu();
    }