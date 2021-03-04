<?php

/**
 * Created by PhpStorm.
 * User: me664
 * Date: 1/20/15
 * Time: 2:35 PM
 */
if(!class_exists( 'BTOTCustomPrice' )) {
    class BTOTCustomPrice extends BTOptionField
    {
        static $instance = null;
        public $curent_key;

        function __construct()
        {
            parent::__construct( __FILE__ );

            parent::init( array(
                'id'   => 'st_custom_price' ,
                'name' => __( 'Custom Price' , ST_TEXTDOMAIN )
            ) );

            //add_action('admin_enqueue_scripts',array($this,'add_scripts'));

            add_action( 'save_post' , array( $this , '_save_separated_field' ) );
        }

        /**
         *
         *
         * @since 1.0
         * */
        function _save_separated_field( $post_id )
        {

            if(!empty( $_POST[ 'st_custom_price_nonce' ] )) {
                if(!wp_verify_nonce( $_POST[ 'st_custom_price_nonce' ] , plugin_basename( __FILE__ ) ))
                    return $post_id;

                if(!current_user_can( 'edit_post' , $post_id ))
                    return $post_id;

                $price_new  = STInput::request('st_price');
                $price_type = STInput::request('st_price_type');
                $start_date = STInput::request('st_start_date');
                $end_date   = STInput::request('st_end_date');
                $status     = STInput::request('st_status');
                $priority   = STInput::request('st_priority');

                STAdmin::st_delete_price( $post_id );

                if($price_new and $start_date and $end_date) {
                    foreach( $price_new as $k => $v ) {
                        if(!empty( $v )) {
                            STAdmin::st_add_price( $post_id , $price_type[ $k ] , $v , $start_date[ $k ] , $end_date[ $k ] , $status[ $k ] , $priority[ $k ] );
                        }
                    }
                }
            }
        }

        function add_scripts()
        {
        }


        static function instance()
        {
            if(self::$instance == null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

    }

    BTOTCustomPrice::instance();

    if(!function_exists( 'ot_type_st_custom_price' )) {
        function ot_type_st_custom_price( $args = array() )
        {
            wp_enqueue_script( 'st-custom-price' );
            $default = array(
                'field_name' => 'st_custom_price',
                'st_custom_price_nonce' => wp_create_nonce( plugin_basename( __FILE__ ) )
            );
            $args    = wp_parse_args( $args , $default );


            BTOTCustomPrice::instance()->curent_key = $args[ 'field_name' ];
            echo BTOTCustomPrice::instance()->load_view( false , array( 'args' => $args ) );
        }
    }

    if(!function_exists( 'ot_type_st_custom_price_html' )) {
        function ot_type_st_custom_price_html( $args = array() )
        {
            wp_enqueue_script( 'st-custom-price' );
            $default = array(
                'field_name' => 'st_custom_price'
            );
            $args    = wp_parse_args( $args , $default );


            BTOTCustomPrice::instance()->curent_key = $args[ 'field_name' ];

            echo BTOTCustomPrice::instance()->load_view( false , array( 'args' => $args ) );
        }
    }
}
