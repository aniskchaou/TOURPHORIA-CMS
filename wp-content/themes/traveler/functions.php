<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * function
     *
     * Created by ShineTheme
     *
     */
    if ( !defined( 'ST_TEXTDOMAIN' ) )
        define( 'ST_TEXTDOMAIN', 'traveler' );
    if ( !defined( 'ST_TRAVELER_VERSION' ) ) {
        $theme = wp_get_theme();
        if ( $theme->parent() ) {
            $theme = $theme->parent();
        }
        define( 'ST_TRAVELER_VERSION', $theme->get( 'Version' ) );
    }
    define( "ST_TRAVELER_DIR", get_template_directory() );
    define( "ST_TRAVELER_URI", get_template_directory_uri() );


    $status = load_theme_textdomain( ST_TEXTDOMAIN, get_stylesheet_directory() . '/language' );

    get_template_part( 'inc/class.traveler' );

    if ( !class_exists( "Abraham\TwitterOAuth\TwitterOAuth" ) ) {
        include_once "vendor/autoload.php";
    }
    add_filter( 'upload_mimes', 'traveler_upload_types', 1, 1 );
    function traveler_upload_types( $mime_types )
    {
        $mime_types[ 'svg' ]  = 'image/svg+xml';

        return $mime_types;
    }
    /*get_template_part('demo/landing_function');
    get_template_part('demo/demo_functions');*/

