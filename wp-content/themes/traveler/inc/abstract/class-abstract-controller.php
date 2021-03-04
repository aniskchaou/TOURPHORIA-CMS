<?php
    /**
     * Created by PhpStorm.
     * User: me664
     * Date: 4/9/15
     * Time: 3:55 PM
     */

    if ( !class_exists( 'ST_Abstract_Controller' ) ) {
        abstract class ST_Abstract_Controller
        {
            public $post_type;
            public $module;
            public $template_dir;


            function __construct( $arg = [] )
            {
                $default = [
                    'post_type'   => '',
                    'module_file' => '',
                    'module'      => ''
                ];

                $arg = wp_parse_args( $arg, $default );

                $this->post_type = $arg[ 'post_type' ];
                $this->module    = $arg[ 'module' ];

                if ( $arg[ 'module_file' ] ) {
                    $this->module = basename( dirname( dirname( $arg[ 'module_file' ] ) ) );
                }

                $this->template_dir = 'inc/modules/' . $this->module . '/views';
            }


            function load_view( $slug, $name = false, $data = [] )
            {
                extract( $data );

                $template = false;

                if ( $name ) {
                    $slug_new = $slug . '-' . $name;

                    $template = locate_template( $this->template_dir . '/' . $slug_new . '.php' );

                }

                if ( !$template ) $template = locate_template( $this->template_dir . '/' . $slug . '.php' );

                if ( !$template ) {
                    $template = locate_template( [
                        'st_templates/' . $this->module . '/' . $slug . '-' . $name . '.php',
                        'st_templates/' . $this->module . '/' . $slug . '.php',
                    ] );

                }

                //If file not found
                if ( is_file( $template ) ) {
                    ob_start();

                    include $template;

                    $data = @ob_get_clean();

                    return $data;
                }
            }
        }
    }