<?php
    /**
     * Created by PhpStorm.
     * User: me664
     * Date: 4/9/15
     * Time: 3:12 PM
     */

    if ( !class_exists( 'ST_Abstract_Admin_Controller' ) ) {
        abstract class ST_Abstract_Admin_Controller extends ST_Abstract_Controller
        {
            public $metabox;

            function __construct( $arg = [] )
            {
                parent::__construct( $arg );
            }

            static function init()
            {
                add_action( 'after_setup_theme', [ __CLASS__, '_check_create_table_price' ] );
            }

            static function _check_create_table_price()
            {
                if ( is_admin() ) {
                    global $wpdb;

                    $table_name = $wpdb->prefix . 'st_price';
                    if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {

                        //table is not created. you may create the table here.
                        global $wpdb;
                        $charset_collate = $wpdb->get_charset_collate();

                        $sql = "CREATE TABLE $table_name (
                        id mediumint(9) NOT NULL AUTO_INCREMENT,
                        post_id int  NOT NULL,
                        price_type varchar(255),
                        price float(10,2) NOT NULL,
                        start_date date NOT NULL,
                        end_date date NOT NULL,
                        status int NOT NULL,
                        priority int NOT NULL,
                        UNIQUE KEY id (id)
                    ) $charset_collate;";

                        $wpdb->query( $sql );

                        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {

                            return false;

                        } else {
                            return true;
                        }

                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }

        ST_Abstract_Admin_Controller::init();

    }