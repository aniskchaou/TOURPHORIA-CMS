<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'AdminNormalCheckout' ) ) {
        class AdminNormalCheckout
        {
            public function __construct()
            {
                //add_filter( 'st_checkout_form_validate', [ $this, '_checkout_form_validate' ] );
                add_action( 'update_booking_hotel', [ $this, '_save_post' ] );
            }

            public function _checkout_form_validate()
            {
                $cart = STCart::get_carts();
                if ( is_array( $cart ) && count( $cart ) ) {
                    $cart_hotel = ValidateNormalCheckout::get_cart_data( $cart, 'st_hotel' );

                    $validate_hotel = ValidateNormalCheckout::_validate_cart_hotel( $cart_hotel );
                    if ( !$validate_hotel ) {
                        $message = $_SESSION[ 'flash_validate_checkout' ];
                        STTemplate::set_message( $message );

                        return false;
                    }

                    $cart_hotel_room     = ValidateNormalCheckout::get_cart_data( $cart, 'hotel_room' );
                    $validate_hotel_room = ValidateNormalCheckout::_validate_cart_hotel_room( $cart_hotel_room );
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

                    $cart_rental     = ValidateNormalCheckout::get_cart_data( $cart, 'st_rental' );
                    $validate_rental = ValidateNormalCheckout::_validate_cart_rental( $cart_rental );
                    if ( !$validate_rental ) {
                        $message = $_SESSION[ 'flash_validate_checkout' ];
                        STTemplate::set_message( $message );

                        return false;
                    }
                }

                return true;
            }

            public function _save_post( $id )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return;
                if ( isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] == 'st_hotel' && isset( $_GET[ 'section' ] ) && $_GET[ 'section' ] == 'edit_order_item' && isset( $_GET[ 'order_item_id' ] ) ) {
                    $item_id = $_GET[ 'order_item_id' ];
                    $status  = $_POST[ 'status' ];
                    if ( $status == 'canceled' ) $status = 'trash';
                    global $wpdb;
                    $table = $wpdb->prefix . 'st_order_item_meta';
                    $data  = [
                        'status' => $status
                    ];
                    $where = [
                        'order_item_id' => $item_id
                    ];
                    $rs    = $wpdb->update( $table, $data, $where );
                }
            }

            public function _new_post( $id, $data )
            {

            }
        }

        new AdminNormalCheckout();
    }
?>