<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'AdminWooCheckout' ) ) {
        class AdminWooCheckout extends STAdmin
        {
            function __construct()
            {
                //add_action( 'woocommerce_before_checkout_process', [ $this, '_before_checkout_process' ], 50 );
                add_action( 'save_post', [ $this, 'save_post' ], 10 );
                add_action( 'delete_post', [ $this, 'delete_post' ], 10 );
            }

            public function _before_checkout_process()
            {
                global $woocommerce;
                $cart_url = $woocommerce->cart->get_cart_url();

                $_SESSION[ 'flash_validate_checkout' ] = '';

                $cart = WC()->cart->get_cart();

                $cart_hotel     = ValidateWooCheckout::get_cart_data( $cart, 'st_hotel' );
                $validate_hotel = ValidateWooCheckout::check_validate_hotel( $cart_hotel );
                if ( !$validate_hotel ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }

                $cart_hotel_room     = ValidateWooCheckout::get_cart_data( $cart, 'hotel_room' );
                $validate_hotel_room = ValidateWooCheckout::check_validate_hotel_room( $cart_hotel_room );
                if ( !$validate_hotel_room ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }

                $cart_rental     = ValidateWooCheckout::get_cart_data( $cart, 'st_rental' );
                $validate_rental = ValidateWooCheckout::check_validate_rental( $cart_rental );
                if ( !$validate_rental ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }

                $cart_tour     = ValidateWooCheckout::get_cart_data( $cart, 'st_tours' );
                $validate_tour = ValidateWooCheckout::check_validate_tour( $cart_tour );
                if ( !$validate_tour ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }

                $cart_activity     = ValidateWooCheckout::get_cart_data( $cart, 'st_activity' );
                $validate_activity = ValidateWooCheckout::check_validate_activity( $cart_activity );
                if ( !$validate_activity ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }

                $cart_cars     = ValidateWooCheckout::get_cart_data( $cart, 'st_cars' );
                $validate_cars = ValidateWooCheckout::check_validate_car( $cart_cars );
                if ( !$validate_cars ) {
                    $data                                  = [
                        'result'   => 'failure',
                        'messages' => '<div class="error-checkout mb20">' . $_SESSION[ 'flash_validate_checkout' ] . '<a href="' . $cart_url . '">' . __( 'Back to Cart page.', ST_TEXTDOMAIN ) . '</a></div>',
                        'refresh'  => 'false',
                        'reload'   => 'false'
                    ];
                    $_SESSION[ 'flash_validate_checkout' ] = '';
                    echo json_encode( $data );
                    die();
                }
            }

            public function save_post( $id )
            {
                if ( get_post_type( $id ) == 'shop_order' ) {
                    global $wpdb;

                    $table = $wpdb->prefix . 'st_order_item_meta';

                    $status = get_post_status( $id );
                    $data   = [
                        'status' => $status
                    ];

                    $where = [ 'wc_order_id' => $id ];
                    $wpdb->update( $table, $data, $where );
                }
            }

            public function delete_post( $id )
            {

                if ( get_post_type( $id ) == 'shop_order' ) {
                    global $wpdb;

                    $table = $wpdb->prefix . 'st_order_item_meta';
                    $where = [ 'wc_order_id' => $id ];

                    $wpdb->delete( $table, $where );
                }
                if ( get_post_type( $id ) == 'st_order' ) {
                    global $wpdb;

                    $table = $wpdb->prefix . 'st_order_item_meta';
                    $where = [ 'order_item_id' => $id ];

                    $wpdb->delete( $table, $where );
                }

            }

        }

        new AdminWooCheckout();
    }
?>