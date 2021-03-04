<?php
    if ( !class_exists( 'ST_Tour_Package_Field' ) ) {
        class ST_Tour_Package_Field
        {
            public $url;
            public $dir;

            function __construct()
            {

                $this->dir = st()->dir( 'plugins/ot-custom/fields/tour-package' );
                $this->url = st()->url( 'plugins/ot-custom/fields/tour-package' );


                add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
                //add_action('save_post', [$this, '_save_post'], 10, 2);
            }

            function init()
            {

                if ( !class_exists( 'OT_Loader' ) ) return false;


                add_filter( 'ot_option_types_array', array( $this, 'ot_add_custom_option_types' ) );

            }

            public function _save_post($post_id, $post_object){
                if(STInput::post('ical_url','') != ''){
                    update_post_meta($post_id, 'ical_url', STInput::post('ical_url',''));
                }
                return $post_id;
            }

            function add_scripts()
            {
                wp_register_script( 'tour-package-js', $this->url . '/js/custom.js', array( 'jquery' ), NULL, TRUE );
                wp_register_style( 'tour-package-css', $this->url . '/css/custom.css');
            }

            function ot_post_select_ajax_unit_types( $array, $id )
            {
                return apply_filters( 'st_tour_package', $array, $id );
            }

            function ot_add_custom_option_types( $types )
            {
                $types[ 'st_tour_package' ] = __( 'Tour Package', ST_TEXTDOMAIN );

                return $types;
            }

            function load_view( $view = false, $data = array() )
            {

                if ( !$view ) $view = 'index';

                $file_name = $this->dir . '/views/' . $view . '.php';

                if ( file_exists( $file_name ) ) {
                    extract( $data );

                    ob_start();

                    include $file_name;

                    return @ob_get_clean();
                }
            }
        }

        $tour_package = new ST_Tour_Package_Field();
        $tour_package->init();

        if ( !function_exists( 'ot_type_st_tour_package' ) ) {
            function ot_type_st_tour_package( $args = array() )
            {
                $tour_package = new ST_Tour_Package_Field();
                $default = array(
                    'field_name' => ''
                );
                $args = wp_parse_args($args, $default);

                wp_enqueue_script( 'tour-package-js' );
                wp_enqueue_style( 'tour-package-css' );

                echo $tour_package->load_view(false, $args);
            }
        }
    }