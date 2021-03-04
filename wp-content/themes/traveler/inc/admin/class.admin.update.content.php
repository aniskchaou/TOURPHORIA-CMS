<?php
    /**
     * @subpackage Traveler
     * @since      1.0.9
     **/

    if ( !class_exists( 'STAdminUpdateContent' ) ) {

        class STAdminUpdateContent extends STAdmin
        {
            function _init()
            {
                add_action( 'admin_menu', [ __CLASS__, 'st_update_content_admin_menu' ], 50 );
                add_action( 'admin_enqueue_scripts', [ $this, '_add_style_javascript' ] );


                add_action( 'wp_ajax_st_my_update_content', [ __CLASS__, 'st_my_update_content_func' ] );
                add_action( 'wp_ajax_nopriv_st_my_update_content', [ __CLASS__, 'st_my_update_content_func' ] );
            }

            function _add_style_javascript()
            {
                wp_register_script( 'update-content.js', get_template_directory_uri() . '/js/admin/update-content.js', [ 'jquery' ], null, true );
            }

            static function st_update_content_admin_menu()
            {
                //add_submenu_page( apply_filters('ot_theme_options_menu_slug','st_traveler_options'), "Update unsupplied content", 'Update unsupplied content', 'manage_options', 'update_all_content', array(__CLASS__,'st_control_update_content'));
            }

            static function st_control_update_content()
            {
                wp_enqueue_script( 'update-content.js' );
                $data_json = [ 'st_hotel', 'st_rental', 'st_cars', 'st_tours', 'st_activity', 'hotel_room', 'location' ];
                echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
                echo '<h2>Update Content and Meta box</h2>';
                echo '<span>update all post types to add up the unsupplied field meta, like field "Average Price" in Hotel</span><br><br><br>';
                echo '<button id="btn_update_content" data-json=' . json_encode( $data_json, JSON_FORCE_OBJECT ) . '  class="button button-primary" >Update Now</button>
                        <br><div class="console_iport">';
                echo '</div>';
            }

            static function st_my_update_content_func()
            {
                if ( !empty( $_REQUEST[ 'post_type' ] ) ) {
                    $post_type = $_REQUEST[ 'post_type' ];
                    $my_posts  = get_posts( [ 'post_type' => $post_type, 'numberposts' => -1 ] );
                    if ( !empty( $my_posts ) ) {
                        foreach ( $my_posts as $my_post ):
                            wp_update_post( $my_post );
                        endforeach;
                    }
                    $obj = get_post_type_object( $post_type );
                    echo json_encode(
                        [
                            'message'    => "Post Type : " . $obj->labels->singular_name . " -> update " . count( $my_posts ) . " post content ... !<span>DONE!</span><br>",
                            'status'     => 'true',
                            'count_post' => count( $my_posts ),
                        ]
                    );
                } else {
                    echo json_encode(
                        [
                            'message' => "<span>Error!</span><br>",
                            'status'  => 'false',
                        ]
                    );
                }
                die();
            }


        }

        $ob = new STAdminUpdateContent();
        $ob->_init();
    }
