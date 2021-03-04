<?php
/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Class STCart
 *
 * Created by ShineTheme
 *
 */
$order_id     = '';
$confirm_link = '';
if ( ! class_exists( 'STCart' ) ) {
    /*
 * STCart class, handling cart action, included saving order and sending e-mail after booking
 *
 * */

    class STCart {
        static $coupon_error;

        /**
         * Init Session and register ajax action
         * @update 1.1.1
         * */
        static function init() {

            if ( ! session_id() ) {
                session_start();
            }

            //Checkout Fields
            STTraveler::load_libs(
                [
                    'helpers/st_checkout_fields'
                ]
            );

            add_action( 'wp_ajax_booking_form_submit', [ __CLASS__, 'ajax_submit_form' ] );
            add_action( 'wp_ajax_nopriv_booking_form_submit', [ __CLASS__, 'ajax_submit_form' ] );

            add_action( 'wp_ajax_st_add_to_cart', [ __CLASS__, 'ajax_st_add_to_cart' ] );
            add_action( 'wp_ajax_nopriv_st_add_to_cart', [ __CLASS__, 'ajax_st_add_to_cart' ] );

            add_action( 'wp_ajax_booking_form_direct_submit', [ __CLASS__, 'direct_submit_form' ] );
            add_action( 'wp_ajax_nopriv_booking_form_direct_submit', [ __CLASS__, 'direct_submit_form' ] );

            add_action( 'wp_ajax_modal_get_cart_detail', [ __CLASS__, 'modal_get_cart_detail' ] );
            add_action( 'wp_ajax_nopriv_modal_get_cart_detail', [ __CLASS__, 'modal_get_cart_detail' ] );

            add_action( 'init', [ __CLASS__, '_confirm_order' ], 100 );

            add_action( 'init', [ __CLASS__, '_apply_coupon' ], 10 );
            add_action( 'init', [ __CLASS__, '_remove_coupon' ] );


            add_action( 'wp_ajax_ajax_apply_coupon', [ __CLASS__, 'ajax_apply_coupon' ] );
            add_action( 'wp_ajax_nopriv_ajax_apply_coupon', [ __CLASS__, 'ajax_apply_coupon' ] );

            add_action( 'wp_ajax_ajax_remove_coupon', [ __CLASS__, 'ajax_remove_coupon' ] );
            add_action( 'wp_ajax_nopriv_ajax_remove_coupon', [ __CLASS__, 'ajax_remove_coupon' ] );

            add_action( 'st_after_footer', [ __CLASS__, 'show_modal_booking' ] );

            /**
             * @since 1.3.1
             **/
            add_action( 'init', [ __CLASS__, '_remove_cart' ] );


            add_action( 'wp_ajax_apply_mdcoupon_function', [ __CLASS__, 'apply_mdcoupon_function' ] );
            add_action( 'wp_ajax_nopriv_apply_mdcoupon_function', [ __CLASS__, 'apply_mdcoupon_function' ] );

            add_filter('st_cart_total_with_out_tax_for_coupon', [__CLASS__, 're_calculator_totla_price_for_coupon']);

        }

        static function re_calculator_totla_price_for_coupon($total){
            $total = STPrice::getTotal(false, true);
            return $total;
        }

        static function _remove_cart() {
            if ( STInput::get( 'action', '' ) === 'st-remove-cart' && wp_verify_nonce( STInput::get( 'security', '' ), 'st-security' ) ) {
                if ( class_exists( 'WC_Product' ) ) {
                    global $woocommerce;
                    $woocommerce->cart->empty_cart();
                }
                self::destroy_cart();
                wp_redirect( remove_query_arg( [ 'action', 'security' ] ) );
                exit();
            }
        }

        static function show_modal_booking() {
            if ( st()->get_option( 'booking_modal', 'off' ) == 'on' ) {
                $cart = STCart::get_items();
                if ( ! empty( $cart ) ) {
                    foreach ( $cart as $key => $cart_item ) {
                        $post_id = (int) $key;
                        if ( get_the_ID() != $post_id ) {
                            echo st()->load_template( 'modal_booking', null, [ 'post_id' => $post_id, 'cart', $cart ] );
                        }
                    }
                }
            }
        }

        static function modal_get_cart_detail() {
            $return    = "";
            $all_items = STCart::get_items();
            if ( ! empty( $all_items ) and is_array( $all_items ) ) {
                foreach ( $all_items as $key => $value ) {
                    if ( get_post_status( $key ) ) {
                        $post_type = get_post_type( $key );
                        switch ( $post_type ) {
                            case "st_hotel":
                                if(class_exists('STHotel')){
                                $hotel  = new STHotel();
                                $return = balanceTags( $hotel->get_cart_item_html( $key ) );
                                }
                                break;
                            case "hotel_room":
                                if(class_exists('STRoom')){
                                $room   = new STRoom();
                                $return = balanceTags( $room->get_cart_item_html( $key ) );
                                }
                                break;
                            case "st_cars":
                                if(class_exists('STCars')){
                                $cars   = new STCars();
                                $return = balanceTags( $cars->get_cart_item_html( $key ) );
                                }
                                break;
                            case "st_tours":
                                if(class_exists('STTour')){
                                $tours  = new STTour();
                                $return = balanceTags( $tours->get_cart_item_html( $key ) );
                                }
                                break;
                            case "st_rental":
                                if(class_exists('STRental')){
                                $object = STRental::inst();
                                $return = balanceTags( $object->get_cart_item_html( $key ) );
                                }
                                break;
                            case "st_activity":
                                if(class_exists('STActivity')){
                                    $object = STActivity::inst();
                                    $return = balanceTags( $object->get_cart_item_html( $key ) );
                                }
                                break;
                        }
                    }
                }
            }
            echo json_encode( $return );
            die;
        }

        static function direct_submit_form() {
            $cart = STInput::post( 'st_cart' );
            $cart = base64_decode( $cart );
            self::set_cart( 'st_cart', unserialize($cart) );
            $return = self::booking_form_submit();
            echo json_encode( $return );
            die;
        }


        static function _confirm_order() {
            if ( STInput::get( 'st_action' ) == 'confirm_order' and STInput::get( 'hash' ) ) {
                $hash = STInput::get( 'hash' );

                //zzz debug send email with id booking
                //self::send_mail_after_booking( 7392 );

                $query = new WP_Query( [
                    'post_type'      => 'st_order',
                    'posts_per_page' => 1,
                    'meta_key'       => 'order_confirm_hash',
                    'meta_value'     => $hash
                ] );

                $status             = false;
                $message            = false;
                $order_id           = false;
                $order_confirm_page = st()->get_option( 'page_order_confirm' );

                while ( $query->have_posts() ) {
                    $query->the_post();
                    $order_id = get_the_ID();

                    $status = get_post_meta( $order_id, 'status', true );

                    if ( $status == 'pending' ) {
                        $payment = get_post_meta( $order_id, 'payment_method', true );
                        if ( $payment == 'st_submit_form' ) {
                            update_post_meta( get_the_ID(), 'status', 'incomplete' );
                        } else {
                            update_post_meta( get_the_ID(), 'status', 'complete' );
                        }
                        do_action( 'st_booking_change_status', 'complete', $order_id, 'normal_booking' );
                        self::send_mail_after_booking( $order_id );
                        $status  = true;
                        $message = __( 'Thank you. Your order is confirmed', ST_TEXTDOMAIN );
                    } elseif ( $status == 'complete' ) {
                        $status  = false;
                        $message = __( 'Your order is confirmed already.', ST_TEXTDOMAIN );
                    } else {
                        $status  = false;
                        $message = __( 'Sorry. We cannot recognize your order code!', ST_TEXTDOMAIN );
                    }
                    break;
                }

                wp_reset_query();

                if ( $status ) {
                    STTemplate::set_message( $message, 'success' );
                } else {
                    STTemplate::set_message( $message, 'danger' );
                }

                if ( $order_confirm_page ) {
                    $order_confirm_page_link = get_permalink( $order_confirm_page );

                    if ( $order_confirm_page_link ) {
                        wp_redirect( $order_confirm_page_link );
                    }
                    die;
                }

                echo balanceTags( $message );
                die;

            }
        }


        static function set_html_content_type() {

            return 'text/html';
        }

        static function send_mail_after_booking( $order_id = false, $made_by_admin = false, $made_by_partner = false ) {

            if ( ! $order_id ) {
                return;
            }

            $email_to_custommer = st()->get_option( 'enable_email_for_custommer', 'on' );
            $email_to_admin     = st()->get_option( 'enable_email_for_admin', 'on' );
            $email_to_owner     = st()->get_option( 'enable_email_for_owner_item', 'on' );

            // Send Email to Custommer
            if ( $email_to_custommer == 'on' ) {
                self::_send_custommer_booking_email( $order_id, $made_by_admin, $made_by_partner );
            }

            // Send booking email to admin
            if ( $email_to_admin == 'on' ) {
                self::_send_admin_booking_email( $order_id );
            }

            // Send Booking Email to Owner Item
            if ( $email_to_owner == 'on' ) {
                self::_send_owner_booking_email( $order_id );
            }

        }

        static function _send_custommer_booking_email( $order, $made_by_admin = false, $made_by_partner = false ) {
            global $order_id;
            $order_id       = $order;
            $item_post_type = get_post_meta( $order_id, 'st_booking_post_type', true );

            $to      = get_post_meta( $order_id, 'st_email', true );
            $subject = st()->get_option( 'email_subject', __( 'Booking Confirm - ' . get_bloginfo( 'title' ), ST_TEXTDOMAIN ) );


            $subject = sprintf( __( 'Your booking at %s', ST_TEXTDOMAIN ), get_bloginfo( 'title' ) );

            $item_id = get_post_meta( $order_id, 'item_id', true );

            $check_in  = get_post_meta( $order_id, 'check_in', true );
            $check_out = get_post_meta( $order_id, 'check_out', true );

            $date_check_in  = @date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
            $date_check_out = @date( TravelHelper::getDateFormat(), strtotime( $check_out ) );

            if ( $item_id ) {
                $message = st()->load_template( 'email/header' );

                $email_to_custommer = st()->get_option( 'email_for_customer', '' );
	            $message .= TravelHelper::_get_template_email($message, $email_to_custommer);
                $message .= st()->load_template( 'email/footer' );

                //zzz debug email

                $title   = '';
                if ( $title = get_the_title( $item_id ) ) {
                    $subject = sprintf( __( 'Your booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $date_check_out );
                }
                //Flight
                if ( $item_post_type == 'st_flight' ) {
                    $depart_data_location = get_post_meta( $order_id, 'depart_data_location', true );
                    $depart_data_time     = get_post_meta( $order_id, 'depart_data_time', true );
                    if ( ! empty( $depart_data_location ) ) {
                        if ( ! empty( $depart_data_location['origin_location'] ) && ! empty( $depart_data_location['destination_location'] ) && ! empty( $depart_data_time['depart_time'] ) ) {
                            $subject = sprintf( esc_html__( 'Booking flight: From %s to %s at %s %s', ST_TEXTDOMAIN ), get_the_title( $depart_data_location['origin_location'] ), get_the_title( $depart_data_location['destination_location'] ), $depart_data_time['depart_time'], $depart_data_time['depart_date'] );
                        } else {
                            $subject = esc_html__( 'Booking flight', ST_TEXTDOMAIN );
                        }
                    }
                }

                if ( ! empty( $item_post_type ) and $item_post_type == 'st_tours' ) {
                    $type_tour = get_post_meta( $order_id, 'type_tour', true );
                    if ( $type_tour == 'daily_tour' ) {
                        $duration = get_post_meta( $order_id, 'duration', true );
                        $subject  = sprintf( __( 'Your booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $duration );
                    }
                }
                $check = self::_send_mail( $to, $subject, $message );
            }

            return $check;
        }

        static function _send_admin_booking_email( $order ) {
            global $order_id;
            $order_id       = $order;
            $admin_email    = st()->get_option( 'email_admin_address' );
            $item_post_type = get_post_meta( $order_id, 'st_booking_post_type', true );
            if ( ! $admin_email ) {
                return false;
            }

            $to = $admin_email;

            $subject = sprintf( __( 'New Booking at %s', ST_TEXTDOMAIN ), get_bloginfo( 'title' ) );

            $item_id = get_post_meta( $order_id, 'item_id', true );

            $check_in  = get_post_meta( $order_id, 'check_in', true );
            $check_out = get_post_meta( $order_id, 'check_out', true );

            $date_check_in  = @date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
            $date_check_out = @date( TravelHelper::getDateFormat(), strtotime( $check_out ) );

            if ( $item_id ) {
                $message = st()->load_template( 'email/header' );

                $email_to_admin = st()->get_option( 'email_for_admin', '' );
	            $message .= TravelHelper::_get_template_email($message, $email_to_admin);

                $message .= st()->load_template( 'email/footer' );
                $title   = '';
                if ( $title = get_the_title( $item_id ) ) {
                    $subject = sprintf( __( 'New Booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $date_check_out );
                }
                //Flight
                if ( $item_post_type == 'st_flight' ) {
                    $depart_data_location = get_post_meta( $order_id, 'depart_data_location', true );
                    $depart_data_time     = get_post_meta( $order_id, 'depart_data_time', true );
                    if ( ! empty( $depart_data_location ) ) {
                        if ( ! empty( $depart_data_location['origin_location'] ) && ! empty( $depart_data_location['destination_location'] ) && ! empty( $depart_data_time['depart_time'] ) ) {
                            $subject = sprintf( esc_html__( 'Booking flight: From %s to %s at %s %s', ST_TEXTDOMAIN ), get_the_title( $depart_data_location['origin_location'] ), get_the_title( $depart_data_location['destination_location'] ), $depart_data_time['depart_time'], $depart_data_time['depart_date'] );
                        } else {
                            $subject = esc_html__( 'Booking flight', ST_TEXTDOMAIN );
                        }
                    }
                }
                if ( ! empty( $item_post_type ) and $item_post_type == 'st_tours' ) {
                    $type_tour = get_post_meta( $order_id, 'type_tour', true );
                    if ( $type_tour == 'daily_tour' ) {
                        $duration = get_post_meta( $order_id, 'duration', true );
                        $subject  = sprintf( __( 'Your booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $duration );
                    }
                }
                $check = self::_send_mail( $to, $subject, $message );
            }

            return $check;

        }

        static function _send_owner_booking_email( $order ) {
            global $order_id;
            $order_id       = $order;
            $item_post_type = get_post_meta( $order_id, 'st_booking_post_type', true );
            $to             = false;

            $subject = sprintf( __( 'New Booking at %s', ST_TEXTDOMAIN ), get_bloginfo( 'title' ) );

            $check = false;

            $item_id = get_post_meta( $order_id, 'item_id', true );

            $check_in  = get_post_meta( $order_id, 'check_in', true );
            $check_out = get_post_meta( $order_id, 'check_out', true );

            $date_check_in  = @date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
            $date_check_out = @date( TravelHelper::getDateFormat(), strtotime( $check_out ) );

            if ( $item_id ) {
                $message = st()->load_template( 'email/header' );

                $email_for_partner = st()->get_option( 'email_for_partner', '' );
	            $message .= TravelHelper::_get_template_email($message, $email_for_partner);
                $message           .= st()->load_template( 'email/footer' );
                $title             = '';
                if ( $title = get_the_title( $item_id ) ) {
                    $subject = sprintf( __( 'New Booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $date_check_out );
                }
                //Flight
                if ( $item_post_type == 'st_flight' ) {
                    $depart_data_location = get_post_meta( $order_id, 'depart_data_location', true );
                    $depart_data_time     = get_post_meta( $order_id, 'depart_data_time', true );
                    if ( ! empty( $depart_data_location ) ) {
                        if ( ! empty( $depart_data_location['origin_location'] ) && ! empty( $depart_data_location['destination_location'] ) && ! empty( $depart_data_time['depart_time'] ) ) {
                            $subject = sprintf( esc_html__( 'Booking flight: From %s to %s at %s %s', ST_TEXTDOMAIN ), get_the_title( $depart_data_location['origin_location'] ), get_the_title( $depart_data_location['destination_location'] ), $depart_data_time['depart_time'], $depart_data_time['depart_date'] );
                        } else {
                            $subject = esc_html__( 'Booking flight', ST_TEXTDOMAIN );
                        }
                    }
                }
                if ( ! empty( $item_post_type ) and $item_post_type == 'st_tours' ) {
                    $type_tour = get_post_meta( $order_id, 'type_tour', true );
                    if ( $type_tour == 'daily_tour' ) {
                        $duration = get_post_meta( $order_id, 'duration', true );
                        $subject  = sprintf( __( 'Your booking at %s: %s - %s', ST_TEXTDOMAIN ), $title, $date_check_in, $duration );
                    }
                }
                $to = TravelHelper::get_owner_email( $item_id );

                if ( $to ) {
                    $check = self::_send_mail( $to, $subject, $message );
                }
            }

            return $check;
        }


        private static function _send_mail( $to, $subject, $message, $attachment = false ) {

            if ( ! $message ) {
                return [
                    'status'  => false,
                    'data'    => '',
                    'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                ];
            }
            $from         = st()->get_option( 'email_from' );
            $from_address = st()->get_option( 'email_from_address' );
            $headers      = [];

            if ( $from and $from_address ) {
                $headers[] = 'From:' . $from . ' <' . $from_address . '>';
            }

            add_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );

            $check = @wp_mail( $to, $subject, $message, $headers, $attachment );

            remove_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );

            return [
                'status' => $check,
                'data'   => [
                    'to'      => $to,
                    'subject' => $subject,
                    'message' => $message,
                    'headers' => $headers
                ]
            ];
        }

        static function send_email_confirm( $order_id = false ) {
            global $confirm_link;
            if ( ! $order_id ) {
                return;
            }
            if ( st()->get_option( 'enable_email_for_custommer' ) == 'off' or st()->get_option( 'enable_email_confirm_for_customer', 'on' ) == 'off' ) {
                return;
            }

            $order_confirm_code = $random_hash = md5( uniqid( rand(), true ) );

            update_post_meta( $order_id, 'order_confirm_hash', $order_confirm_code );

            if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                $my_home_url  = apply_filters( 'wpml_home_url', get_option( 'home' ) );
                $confirm_link = add_query_arg( [
                    "st_action" => "confirm_order",
                    "hash"      => $order_confirm_code
                ], $my_home_url );
            } else {
                $confirm_link = home_url( '?st_action=confirm_order&hash=' . $order_confirm_code );
            }

            $message = st()->load_template( 'email/header' );

            $email_confirm = st()->get_option( 'email_confirm', '' );
	        $message .= TravelHelper::_get_template_email($message, $email_confirm);
            $message .= st()->load_template( 'email/footer' );

            $to = get_post_meta( $order_id, 'st_email', true );

            $subject = __( 'Confirmation needed', ST_TEXTDOMAIN );

            self::_send_mail( $to, $subject, $message );
        }

        /**
         *
         *
         *
         * @update 1.1.3
         * */
        static function add_cart( $item_id, $number = 1, $price = false, $data = [] ) {
            $data['st_booking_post_type'] = ( $item_id == 'car_transfer' ) ? 'car_transfer' : get_post_type( $item_id );
            $data['st_booking_id']        = ( $item_id == 'car_transfer' ) ? $data['car_id'] : $item_id;
            $data['sharing']              = get_post_meta( $item_id, 'sharing_rate', true );
            $data['duration_unit']        = self::get_duration_unit( $item_id ); // from 1.1.9
            //check is woocommerce
            $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );

            //Enable booking fee for woocommerce
            //if ( ! $st_is_woocommerce_checkout ) {
            $data = self::_get_data_booking_fee( $price, $data );
            //}
            $number    = intval( $number );
            $cart_data = [
                'number' => $number,
                'price'  => $price,
                'data'   => $data,
                'title'  => ( $item_id == 'car_transfer' ) ? $data['pick_up'] . ' - ' . $data['drop_off'] : get_the_title( $item_id )
            ];
            if ( $st_is_woocommerce_checkout ) {
                $cart_data['price']               = floatval( $data['ori_price'] );
                $cart_data['data']['total_price'] = floatval( $data['ori_price'] );
                if ( get_post_type( $item_id ) == 'st_hotel' ) {
                    $post_id = intval( $cart_data['data']['room_id'] );
                } else {
                    $post_id = intval( $item_id );
                }
                if ( $item_id == 'car_transfer' ) {
                    $post_id = (int) $data['car_id'];
                }
                $product_id = self::_create_new_product( $post_id, $cart_data );
                if ( $product_id ) {
                    self::_add_product_to_cart( $product_id, $cart_data['data'] );
                }
            } else {
                if ( get_post_type( $item_id ) == 'st_hotel' ) {
                    $post_id = intval( $cart_data['data']['room_id'] );
                } else {
                    if ( $item_id == 'car_transfer' ) {
                        $post_id = $data['car_id'];
                    } else {
                        $post_id = intval( $item_id );
                    }

                }
                $cart_data = STPrice::getDepositData( $post_id, $cart_data );
            }

            $cart_data['data']['user_id'] = get_current_user_id();
            self::destroy_cart();
            if ( isset( $cart_data['data']['transfer_from'] ) ) {
                $data_cart['car_transfer'] = $cart_data;
                self::set_cart( 'st_cart', $data_cart );
            } else {
                $data_cart[ $item_id ] = $cart_data;
                self::set_cart( 'st_cart', $data_cart );
            }
        }

        static function set_cart( $cart_name, $data ) {
            $data_compress = base64_encode(gzcompress(addslashes(serialize($data)), 9));
            TravelHelper::setcookie( $cart_name, $data_compress, time() + ( 86400 * 30 ) );
            //TravelHelper::setcookie( $cart_name, serialize($data), time() + ( 86400 * 30 ) );
        }

        static function delete_cart( $cart_name ) {
            TravelHelper::setcookie( $cart_name, '', time() - 3600 );
        }

        static function _get_data_booking_fee( $price, $data ) {
            $booking_fee = st()->get_option( 'booking_fee_enable', 'off' );
            if ( $booking_fee == "on" ) {
                $booking_fee_type   = st()->get_option( 'booking_fee_type' );
                $booking_fee_amount = st()->get_option( 'booking_fee_amount' );
                if ( empty( $booking_fee_amount ) ) {
                    $booking_fee_amount = 0;
                }
                $price_fee = 0;
                if ( $booking_fee_type == 'percent' ) {
                    if ( $booking_fee_amount < 0 ) {
                        $booking_fee_amount = 0;
                    }
                    if ( $booking_fee_amount > 100 ) {
                        $booking_fee_amount = 100;
                    }
                    $price_fee = ( $price / 100 ) * $booking_fee_amount;
                }
                if ( $booking_fee_type == 'amount' ) {
                    $price_fee = $booking_fee_amount;
                }
                $data['booking_fee_type']   = $booking_fee_type;
                $data['booking_fee_amount'] = $booking_fee_amount;
                $data['booking_fee_price']  = $price_fee;
            }

            return $data;
        }

        // from 1.1.9
        static function get_duration_unit( $item_id ) {
            $post_type = get_post_type( $item_id );
            //if ($post_type =='st_tours') return STTour::get_simple_duration_unit($item_id);
            if ( $post_type == 'st_cars' ) {
                $type = st()->get_option( 'cars_price_unit', 'day' );

                return $type;
            }

            return "";
        }

        /**
         * Add product to cart by product id
         *
         * @since 1.1.1
         * */
        static function _add_product_to_cart( $product_id, $cart_data = [] ) {
            global $woocommerce;
            if ( is_array( $product_id ) and ! empty( $product_id['product_id'] ) and ! empty( $product_id['variation_id'] ) ) {
                $cart = WC()->cart->add_to_cart( $product_id['product_id'], 1, $product_id['variation_id'], [], [ 'st_booking_data' => $cart_data ] );
            } elseif ( $product_id > 0 ) {
                $cart = WC()->cart->add_to_cart( $product_id, 1, '', [], [ 'st_booking_data' => $cart_data ] );
            }
        }

        /**
         * Create new Woocommerce Product by cart item information
         *
         *
         * @since 1.1.1
         * */
        static function _create_new_product( $item_id, $cart_item ) {

            $default = [
                'title'  => '',
                'price'  => 0,
                'number' => 1,
                'data'   => ''
            ];

            $cart_item             = wp_parse_args( $cart_item, $default );
            $total_cart_item_price = 0;

            if ( ! $cart_item['number'] ) {
                $cart_item['number'] = 1;
            }

            $total_cart_item_price = $cart_item['price'];

            $total_cart_item_price = apply_filters( 'st_' . get_post_type( $item_id ) . '_item_total', $total_cart_item_price, $item_id, $cart_item );

            // Check if product exists
            $check_exists = [
                'post_type'      => 'product',
                'meta_key'       => '_st_booking_id',
                'meta_value'     => $item_id,
                'posts_per_page' => 1
            ];
            $query_exists = new WP_Query( $check_exists );
            // if product exists
            if ( $query_exists->have_posts() ) {
                while ( $query_exists->have_posts() ) {
                    $query_exists->the_post();
                    // Create a variation
                    $variation = [
                        'post_content'   => '',
                        'post_status'    => "publish",
                        'post_title'     => sprintf( __( '%s in %s', ST_TEXTDOMAIN ), $cart_item['title'], date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ) ),
                        'post_parent'    => get_the_ID(),
                        'post_type'      => "product_variation",
                        'comment_status' => 'closed'
                    ];

                    $variation_id = wp_insert_post( $variation );
                    if ( is_wp_error( $variation_id ) ) {
                        STTemplate::set_message( __( 'Sorry! Can not create variation product', ST_TEXTDOMAIN ) );

                        return false;
                    }

                    update_post_meta( get_the_ID(), '_stock_status', 'instock' );

                    // Product Meta
                    update_post_meta( $variation_id, '_stock_status', 'instock' );
                    update_post_meta( $variation_id, '_visibility', 'visible' );
                    update_post_meta( $variation_id, '_downloadable', 'no' );
                    update_post_meta( $variation_id, '_virtual', 'no' );
                    update_post_meta( $variation_id, '_featured', 'no' );
                    update_post_meta( $variation_id, '_sold_individually', 'yes' );
                    update_post_meta( $variation_id, '_manage_stock', 'no' );
                    update_post_meta( $variation_id, '_backorders', 'no' );
                    update_post_meta( $variation_id, '_regular_price', $total_cart_item_price );
                    update_post_meta( $variation_id, '_st_booking_id', $item_id );
                    update_post_meta( $variation_id, 'data', $cart_item['data'] );
                    update_post_meta( $variation_id, 'attribute_types', '' );
                    update_post_meta( $variation_id, '_product_version', '3.0.1' );

                    /**
                     * Return the variation
                     */
                    return [
                        'product_id'   => get_the_ID(),
                        'variation_id' => $variation_id
                    ];
                }
                wp_reset_postdata();
            } else {
                // if not , create new product
                $post = [
                    'post_content'   => '',
                    'post_status'    => "publish",
                    'post_title'     => $cart_item['title'],
                    'post_parent'    => '',
                    'post_type'      => "product",
                    'comment_status' => 'closed'
                ];

                $product_id = wp_insert_post( $post );
                if ( is_wp_error( $product_id ) ) {
                    STTemplate::set_message( __( 'Sorry! Can not create product', ST_TEXTDOMAIN ) );

                    return false;
                }
                // Product Type simple
                wp_set_object_terms( $product_id, 'variable', 'product_type' );


                // Product Meta
                update_post_meta( $product_id, '_stock_status', 'instock' );
                update_post_meta( $product_id, '_visibility', 'visible' );
                update_post_meta( $product_id, '_downloadable', 'no' );
                update_post_meta( $product_id, '_virtual', 'no' );
                update_post_meta( $product_id, '_featured', 'no' );
                update_post_meta( $product_id, '_sold_individually', 'yes' );
                update_post_meta( $product_id, '_manage_stock', 'no' );
                update_post_meta( $product_id, '_backorders', 'no' );
                update_post_meta( $product_id, '_price', $total_cart_item_price );
                update_post_meta( $product_id, '_st_booking_id', $item_id );
                update_post_meta( $product_id, 'data', $cart_item['data'] );

                $data_variation = [
                    'types' => [
                        'name'         => 'types',
                        'value'        => 'service',
                        'position'     => 0,
                        'is_visible'   => 1,
                        'is_variation' => 1,
                        'is_taxonomy'  => 1
                    ]
                ];

                update_post_meta( $product_id, '_product_attributes', $data_variation );
                update_post_meta( $product_id, '_product_version', '3.0.1' );

                return $product_id;
            }

        }

        static function get_carts() {
            return isset( $_COOKIE['st_cart'] ) ? unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart'])))) : false;
            //return isset( $_COOKIE['st_cart'] ) ? unserialize(stripslashes($_COOKIE['st_cart'])) : false;
        }

        static function get_cart_item() {
            $items = isset( $_COOKIE['st_cart'] ) ? $_COOKIE['st_cart'] : '';
            $items = unserialize(stripslashes(gzuncompress(base64_decode($items))));
            //$items = unserialize( stripslashes( $items ) );
            if ( ! empty( $items ) and is_array( $items ) ) {
                foreach ( $items as $key => $value ) {
                    return [ 'key' => $key, 'value' => $value ];
                }
            }
        }

        static function count() {
            if ( isset( $_COOKIE['st_cart'] ) ) {
                //return count( unserialize( stripslashes( $_COOKIE['st_cart'] ) ) );
                return count (unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart'])))));
            } else {
                return 0;
            }
        }

        static function check_cart() {
            $cart = isset( $_COOKIE['st_cart'] ) ? unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart'])))) : false;
            //$cart = isset( $_COOKIE['st_cart'] ) ? unserialize( stripslashes( $_COOKIE['st_cart'] ) ) : false;

            if ( ! is_array( $cart ) ) {
                return false;
            }

            return true;
        }


        /**
         * return total value of cart (tax included) without format money
         *
         * @return float|int|mixed|void
         */
        static function get_total() {

            //Tax
            $total = self::get_total_with_out_tax();
            $total -= self::get_coupon_amount();
            $total += self::get_tax_amount();

            $total = apply_filters( 'st_cart_total_value', $total );

            return $total;
        }

        /**
         * Return tax percent from theme options
         *
         * @update 1.0.9
         * */
        static function get_tax( $raw_data = false ) {
            if ( $raw_data ) {
                return (float) st()->get_option( 'tax_value', 0 );
            }

            if ( self::is_tax_enable() and ! self::is_tax_included_listing_page() ) {
                return (float) st()->get_option( 'tax_value', 0 );
            }

            return 0;
        }


        /*
         * return Tax amount value.
         *
         *
         * */
        static function get_tax_amount() {
            if ( self::is_tax_enable() and ! self::is_tax_included_listing_page() ) {
                $tax   = self::get_tax();
                $total = self::get_total_with_out_tax();

                return ( $total / 100 ) * $tax;
            }

            return 0;
        }

        /*
         * Check if tax is enabled from theme options
         *
         * @return bool
         *
         * */
        static function is_tax_enable() {
            if ( st()->get_option( 'tax_enable', 'off' ) == 'on' ) {
                return true;
            }

            return false;
        }


        /**
         *
         *
         * @since 1.0.9
         * */
        static function is_tax_included_listing_page() {
            if ( st()->get_option( 'st_tax_include_enable' ) == 'on' ) {
                return true;
            }

            return false;
        }


        /**
         * Get cart total amount with out tax
         *
         * @update 1.1.7
         * */
        static function get_total_with_out_tax( $deposit_calculator = false ) {
            if ( isset( $_COOKIE['st_cart'] ) ) {
                $cart = unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart']))));

                if ( ! empty( $cart ) ) {
                    $total = STPrice::getTotal();
                    $total = apply_filters( 'st_cart_total_with_out_tax', $total );
                    return $total;
                }
            } else {
                return 0;
            }

        }

        static function get_total_with_out_tax_for_coupon( $deposit_calculator = false ) {
            if ( isset( $_COOKIE['st_cart'] ) ) {
                $cart = unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart']))));

                if ( ! empty( $cart ) ) {
                    $total = STPrice::getTotal();
                    $total = apply_filters( 'st_cart_total_with_out_tax_for_coupon', $total );
                    return $total;
                }
            } else {
                return 0;
            }

        }


        /**
         * Get total amount of each items in cart.
         *
         * @param $item
         * @param $key
         *
         * @return mixed
         *
         * @update 1.1.3
         */
        static function get_item_total( $item, $key ) {
            $data = $item['data'];

            $post_type = get_post_type( $key );

            switch ( $post_type ) {
                case "st_hotel":
                    $return = self::get_hotel_price( $data, $item['price'], $item['data']['room_num_search'] );
                    break;
                case "hotel_room":
                    $return = self::get_hotel_price( $data, $item['price'], 1 );
                    break;
                case "st_rental":
                    $return = self::get_hotel_price( $data, $item['price'], 1 );
                    break;
                case "st_cars":
                    if(class_exists('STCars'))
                    $return = STCars::get_cart_item_total( $key, $item );
                    break;
                case "st_tours":

                    if(class_exists('STTour'))
                    $return = STTour::get_cart_item_total( $key, $item );
                    break;
                case "st_activity":
                    if(class_exists('STActivity'))
                    $return = STActivity::get_cart_item_total( $key, $item );
                    //return $item['price'];
                    break;
            }

            return $return;
        }

        /**
         *
         *
         * */
        static function get_hotel_price( $data, $price, $number = 1 ) {
            $default = [
                'check_in'  => false,
                'check_out' => false
            ];

            extract( wp_parse_args( $data, $default ) );

            return $price * $number;
        }

        /**
         * Return all items in cart
         * Current version only one item in cart at once time.
         * @return mixed
         *
         * */
        static function get_items() {
            return isset( $_COOKIE['st_cart'] ) ? unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart'])))) : [];
        }

        /**
         * Get the current item of cart
         *
         * @since 1.0.9
         * @todo  get the current item of cart
         */
        static function get_first_id_items() {
            return isset( $_COOKIE['st_cart'] ) ? key( unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart'])))) ) : [];
            //return isset( $_COOKIE['st_cart'] ) ? key( unserialize( stripslashes( $_COOKIE['st_cart'] ) ) ) : [];
        }

        static function find_item( $item_id ) {
            $cart = unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart']))));
            //$cart = unserialize( stripslashes( $_COOKIE['st_cart'] ) );

            if ( ! empty( $cart ) ) {
                if ( isset( $cart[ $item_id ] ) ) {
                    return $cart[ $item_id ];
                }
            }
        }

        /**
         *
         *
         *
         * @update 1.1.1
         * */
        static function get_cart_link() {
            $cart_link                  = get_permalink( st()->get_option( 'page_checkout' ) );
            $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );

            if ( $st_is_woocommerce_checkout ) {
                $url = wc_get_cart_url();
                if ( $url ) {
                    $cart_link = $url;
                }
            }

            return apply_filters( 'st_cart_link', $cart_link );
        }

        /**
         * @update 1.2.0
         *
         * @param bool|FALSE $order_id
         *
         * @return mixed|void
         */
        static function get_success_link( $order_id = false ) {
            $payment_success = get_permalink( st()->get_option( 'page_payment_success' ) );
            if ( $order_id ) {
                $order_token_code = get_post_meta( $order_id, 'order_token_code', true );
                if ( ! $order_token_code ) {
                    $array = [
                        'order_code' => $order_id,
                        'status'     => true
                    ];
                } else {
                    $array = [
                        'order_token_code' => $order_token_code,
                        'status'           => true
                    ];

                }
                $payment_success = add_query_arg( $array, $payment_success );
            }

            return apply_filters( 'st_payment_success_link', $payment_success, $order_id );
        }

        static function destroy_cart() {
            do_action( 'st_before_destroy_cart' );

            self::delete_cart( 'st_cart' );
            self::delete_cart( 'st_cart_coupon' );

            do_action( 'st_after_destroy_cart' );

        }

        static function use_coupon() {
            if ( isset( $_COOKIE['st_cart_coupon'] ) and $_COOKIE['st_cart_coupon'] ) {
                return true;
            } else {
                return false;
            }
        }


        static function booking_form_submit( $item_id = '' ) {

            $selected = 'st_submit_form';

            $first_item_id = self::get_booking_id();

            // All gateway available
            $gateways = STPaymentGateways::get_payment_gateways();
            if ( empty( $gateways ) ) {
                return [
                    'status'  => false,
                    'message' => __( 'Sorry! No payment gateway available', ST_TEXTDOMAIN )
                ];
            }

            $payment_gateway_id   = STInput::post( 'st_payment_gateway', $selected );
            $payment_gateway_used = STPaymentGateways::get_gateway( $payment_gateway_id, $first_item_id );

            if ( ! $payment_gateway_id or ! $payment_gateway_used ) {
                $payment_gateway_name = apply_filters( 'st_payment_gateway_' . $payment_gateway_id . '_name', $payment_gateway_id );

                return [
                    'status'  => false,
                    'message' => sprintf( __( 'Sorry! Payment Gateway: <code>%s</code> is not available for this item!', ST_TEXTDOMAIN ), $payment_gateway_name )
                ];
            }

            // Action before submit form
            do_action( 'st_before_form_submit_run' );

            $form_validate = true;

            $booking_by = STInput::post('booking_by', '');
            if($booking_by != 'partner'){
                if ( ! self::check_cart() and ! STInput::post( 'order_id' ) ) {
                    return [
                        'status'  => false,
                        'message' => __( 'Your cart is currently empty.', ST_TEXTDOMAIN ),
                        'code'    => '1'
                    ];
                }
            }else{
                if ( ! self::check_cart() and ! STInput::post( 'order_id' ) ) {
                    return [
                        'status'  => 'partner',
                        'message' => '',
                        'code'    => '1'
                    ];
                }
            }


            if ( $coupon_code = STInput::request( 'coupon_code' ) ) {
                $status = self::do_apply_coupon( $coupon_code );

                if ( ! $status['status'] ) {
                    return [
                        'status'  => false,
                        'message' => $status['message']
                    ];
                }
            }


            $is_guest_booking  = st()->get_option( 'is_guest_booking', "on" );
            $is_user_logged_in = is_user_logged_in();
            if ( ! empty( $is_guest_booking ) and $is_guest_booking == "off" and ! $is_user_logged_in ) {
                $page_checkout = st()->get_option( 'page_checkout' );
                $page_login    = st()->get_option( 'page_user_login' );
                if ( empty( $page_login ) ) {
                    $page_login = home_url();
                } else {
                    $page_login = get_permalink( $page_login );
                }
                $page_login = add_query_arg( [ 'st_url_redirect' => get_permalink( $page_checkout ) ], $page_login );

                return [
                    'status'   => true,
                    'redirect' => esc_url( $page_login ),
                ];
            }

            if ( st()->get_option( 'booking_enable_captcha', 'on' ) == 'on' ) {

                $st_security_key = STInput::request( 'st_security_key' );
                $allow_captcha   = STInput::request( 'allow_capcha', 'off' );
                if ( $allow_captcha == 'off' ) {
                    if ( ! $st_security_key ) {
                        return [
                            'status'  => false,
                            'message' => __( 'You did not enter the captcha', ST_TEXTDOMAIN )
                        ];
                    }
                    $valid = STCoolCaptcha::validate_captcha( $st_security_key );
                    if ( ! $valid ) {
                        return [
                            'status'     => false,
                            'message'    => __( 'Captcha is not correct', ST_TEXTDOMAIN ),
                            'error_code' => 'invalid_captcha'
                        ];
                    }
                }

            }

            $default = [
                'st_note'         => '',
                'term_condition'  => '',
                'create_account'  => false,
                'paypal_checkout' => false
            ];

            extract( wp_parse_args( $_POST, $default ) );


            $form_validate = self::validate_checkout_fields();
            //Term and condition
            if ( ! $term_condition ) {
                return [
                    'status'  => false,
                    'message' => __( 'Please accept our terms and conditions', ST_TEXTDOMAIN )
                ];
            }
            $form_validate = self::validate_checkout_fields();

            if ( $form_validate ) {
                // Allow to hook before save order
                $form_validate = apply_filters( 'st_checkout_form_validate', $form_validate );
            }

            if ( $form_validate ) {
                // Allow to hook before save order
                $form_validate = apply_filters( 'st_checkout_form_validate', $form_validate );
            }

            if ( $form_validate ) {
                $form_validate = $payment_gateway_used->_pre_checkout_validate();
            }

            if ( ! $form_validate ) {
                $message = [

                    'status'        => false,
                    'message'       => STTemplate::get_message_content(),
                    'form_validate' => 'false'
                ];

                STTemplate::clear();

                return $message;
            }

            // if order is already posted as order_id, we only need to make payment for it
            if ( STInput::post( 'order_id' ) and strtolower( STInput::post( 'order_id' ) ) != 'false' ) {
                return STPaymentGateways::do_checkout( $payment_gateway_used, STInput::post( 'order_id' ) );
            }

            $post       = [
                'post_title'  => __( 'Order', ST_TEXTDOMAIN ) . ' - ' . date( get_option( 'date_format' ) ) . ' @ ' . date( get_option( 'time_format' ) ),
                'post_type'   => 'st_order',
                'post_status' => 'publish'
            ];
            $data_price = STPrice::getDataPrice();
            //save the order
            $insert_post = wp_insert_post( $post );

            if ( $insert_post ) {

                $cart = self::get_items();

                $fields = self::get_checkout_fields();
                if ( ! empty( $fields ) ) {
                    foreach ( $fields as $key => $value ) {
                        update_post_meta( $insert_post, $key, STInput::post( $key ) );
                    }
                }
                if ( ! is_user_logged_in() ) {
                    $user_name = STInput::post( 'st_email' );
                    $user_id   = username_exists( $user_name );

                    //Now Create Account if user agree
                    $create_account_opt = ( st()->get_option( 'guest_create_acc_required', 'off' ) == 'on' ) and ( st()->get_option( 'st_booking_enabled_create_account', 'off' ) == 'on' ) and ( st()->get_option( 'is_guest_booking', 'off' ) == 'on' );
                    if ( $create_account or $create_account_opt ) {
                        if ( ! $user_id and email_exists( $user_name ) == false ) {
                            $random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
                            $userdata        = [
                                'user_login' => $user_name,
                                'user_pass'  => $random_password,
                                'user_email' => $user_name,
                                'first_name' => STInput::post( 'st_first_name' ),
                                // When creating an user, `user_pass` is expected.
                                'last_name'  => STInput::post( 'st_last_name' )
                                // When creating an user, `user_pass` is expected.
                            ];
                            $user_id         = wp_insert_user( $userdata );
                            //Create User Success, send the nofitication
                            wp_send_new_user_notifications( $user_id );
                        }
                    }
                } else {
                    $user_id = get_current_user_id();
                }

                if ( $user_id ) {
                    //Now Update the Post Meta
                    update_post_meta( $insert_post, 'id_user', $user_id );
                    //Update User Meta
                    update_user_meta( $user_id, 'st_phone', STInput::post( 'st_phone' ) );
                    update_user_meta( $user_id, 'first_name', STInput::post( 'st_first_name' ) );
                    update_user_meta( $user_id, 'last_name', STInput::post( 'st_last_name' ) );
                    update_user_meta( $user_id, 'st_address', STInput::post( 'st_address' ) );
                    update_user_meta( $user_id, 'st_address2', STInput::post( 'st_address2' ) );
                    update_user_meta( $user_id, 'st_city', STInput::post( 'st_city' ) );
                    update_user_meta( $user_id, 'st_province', STInput::post( 'st_province' ) );
                    update_user_meta( $user_id, 'st_zip_code', STInput::post( 'st_zip_code' ) );
                    update_user_meta( $user_id, 'st_apt_unit', STInput::post( 'st_apt_unit' ) );
                    update_user_meta( $user_id, 'st_country', STInput::post( 'st_country' ) );
                }

                self::saveOrderItems( $insert_post );

                update_post_meta( $insert_post, 'st_tax', STPrice::getTax() );
                update_post_meta( $insert_post, 'st_tax_percent', STPrice::getTax() );
                update_post_meta( $insert_post, 'st_is_tax_included_listing_page', STCart::is_tax_included_listing_page() ? 'on' : 'off' );
                update_post_meta( $insert_post, 'currency', TravelHelper::get_current_currency() );
                update_post_meta( $insert_post, 'coupon_code', STCart::get_coupon_code() );
                update_post_meta( $insert_post, 'coupon_amount', STCart::get_coupon_amount() );
                update_post_meta( $insert_post, 'status', 'pending' );
                update_post_meta( $insert_post, 'st_cart_info', $cart );
                update_post_meta( $insert_post, 'total_price', STPrice::getTotal() );
                update_post_meta( $insert_post, 'ip_address', STInput::ip_address() );
                update_post_meta( $insert_post, 'order_token_code', wp_hash( $insert_post ) );
                update_post_meta( $insert_post, 'data_prices', $data_price );
                update_post_meta( $insert_post, 'booking_by', STInput::post( 'booking_by', '' ) );
                update_post_meta( $insert_post, 'payment_method', $payment_gateway_id );

                do_action( 'st_booking_success', $insert_post );

                // destroy cart
                STCart::destroy_cart();

                // Now gateway do the rest
                $res = STPaymentGateways::do_checkout( $payment_gateway_used, $insert_post );

                return $res;


            } else {
                return [
                    'status'  => false,
                    'message' => __( 'Can not save order.', ST_TEXTDOMAIN )
                ];
            }


        }


        static function ajax_apply_coupon() {
            self::_apply_coupon();
            echo json_encode( self::$coupon_error );
            die;
        }

        static function ajax_remove_coupon() {
            $coupon = STInput::request( 'coupon', '' );
            if ( ! empty( $coupon ) ) {
                TravelHelper::setcookie( 'st_cart_coupon', '', time() - 3600 );
                echo json_encode( [
                    'status'  => 1,
                    'message' => __( 'Success', ST_TEXTDOMAIN )
                ] );
                die;
            }

            echo json_encode( [
                'status'  => 0,
                'message' => __( 'Coupon is not correct', ST_TEXTDOMAIN )
            ] );
            die;
        }

        /**
         *
         *
         * @return Bool
         *
         * */
        static function validate_checkout_fields() {
            $fields = self::get_checkout_fields();

            $result    = true;
            $validator = new STValidate();

            if ( is_array( $fields ) and ! empty( $fields ) ) {
                foreach ( $fields as $key => $value ) {
                    $default = [
                        'label'       => '',
                        'placeholder' => '',
                        'class'       => [
                            'form-control'
                        ],
                        'type'        => 'text',
                        'size'        => 6,
                        'icon'        => '',
                        'validate'    => ''
                    ];

                    $value = wp_parse_args( $value, $default );
                    if ( $value['validate'] ) {
                        $validator->set_rules( $key, $value['label'], $value['validate'] );
                    }
                }
            }


            $result = $validator->run();

            if ( ! $result ) {
                STTemplate::set_message( $validator->error_string(), 'danger' );
            }

            return $result;
        }

        static function saveOrderItems( $order_id ) {
            $cart = self::get_items();

            if ( ! empty( $cart ) ) {
                foreach ( $cart as $key => $value ) {
                    $value = apply_filters( 'st_order_item_data', $value );

                    $new_post = $order_id;

                    if ( $new_post ) {
                        update_post_meta( $new_post, 'item_price', $value['price'] );
                        update_post_meta( $new_post, 'item_id', $key );
                        if ( get_post_type( $key ) != 'st_rental' ) {
                            update_post_meta( $new_post, 'item_number', $value['number'] );
                        }
                        if ( $key == 'car_transfer' ) {
                            update_post_meta( $new_post, 'item_post_type', 'car_transfer' );
                        } else {
                            update_post_meta( $new_post, 'item_post_type', get_post_type( $key ) );
                        }

                        if ( ! empty( $value['data'] ) and is_array( $value['data'] ) and ! empty( $value['data'] ) ) {
                            $dk = true;
                            foreach ( $value['data'] as $k => $v ) {
                                if ( $k == 'check_in' or $k == 'check_out' and $dk == true ) {
                                    update_post_meta( $new_post, $k, date( 'Y-m-d H:i:s', strtotime( $v ) ) );
                                } else {
                                    update_post_meta( $new_post, $k, $v );
                                }
                            }
                        }
                    }

                    if ( isset( $value['data'] ) ) {
                        if ( (int) $value['data']['user_id'] == 0 ) {
                            $user_id                  = get_post_meta( $order_id, 'id_user', true );
                            $value['data']['user_id'] = $user_id;
                        }
                        do_action( 'st_save_order_item_meta', $value['data'], $order_id );
                    }


                    do_action( 'st_after_save_order_item', $order_id, $key, $value );


                }
            }
        }

        /**
         * @since 1.1.10
         * @return array
         */
        static function ajax_st_add_to_cart() {
            $item_id = STInput::post( 'item_id' );
            //Add to cart then submit form
            $sc = STInput::request( 'sc', '' );
            if ( ! $item_id ) {
                $name = '';
                if ( $sc == 'add-hotel-booking' ) {
                    $name = __( 'Hotel', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-rental-booking' ) {
                    $name = __( 'Rental', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-car-booking' ) {
                    $name = __( 'Car', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-tour-booking' ) {
                    $name = __( 'Tour', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-activity-booking' ) {
                    $name = __( 'Activity', ST_TEXTDOMAIN );
                }
                $return = [
                    'status'  => false,
                    'message' => sprintf( __( 'Please choose a %s item ', ST_TEXTDOMAIN ), $name )
                ];

            } else {

                $post_type = get_post_type( $item_id );

                $number_room = STInput::post( 'number_room' ) ? STInput::post( 'number_room' ) : false;
                if ( ! $number_room ) {
                    $number_room = STInput::post( 'room_num_search' ) ? STInput::post( 'room_num_search' ) : 1;
                }

                self::destroy_cart();

                $validate = true;

                switch ( $post_type ) {
                    case "st_hotel":
                        if(class_exists('STHotel')) {
                        $hotel    = new STHotel();
                        $validate = $hotel->do_add_to_cart();
                        }
                        break;
                    case "hotel_room":
                        if(class_exists('STHotel')) {
                        $hotel    = new STHotel();
                        $validate = $hotel->do_add_to_cart();
                        }
                        break;
                    case "st_cars":
                        if(class_exists('STCars')) {
                        $car      = new STCars();
                        $validate = $car->do_add_to_cart();
                        }
                        break;
                    case "st_activity":
                        if(class_exists('STActivity')) {
                            $class = STActivity::inst();
                            $validate = $class->do_add_to_cart();
                        }
                        break;
                    case "st_tours":
                        if(class_exists('STTour')) {
                        $class    = new STTour();
                        $validate = $class->do_add_to_cart();
                        }
                        break;
                    case "st_rental":
                        if(class_exists('STRental')) {
                        $class    = STRental::inst();
                        $validate = $class->do_add_to_cart();
                        }
                        break;
                }

                if ( $validate ) {
                    $return = [
                        'status' => 1,

                    ];
                } else {
                    $return = [
                        'status'  => 0,
                        'message' => STTemplate::get_message_content()
                    ];
                    STTemplate::clear();
                }
            }
            echo json_encode( $return );
            die;
        }

        /**
         * @update 1.1.10
         * @return array|void
         */
        static function ajax_submit_form() {

            $item_id = STInput::post( 'item_id' );
            // check origin is already taken
            if ( STInput::post( 'order_id' ) and strtolower( STInput::post( 'order_id' ) ) != 'false' ) {
                return self::booking_form_submit( $item_id );
            }

            //Add to cart then submit form
            $sc = STInput::request( 'sc', '' );
            if ( ! $item_id ) {
                $name = '';
                if ( $sc == 'add-hotel-booking' ) {
                    $name = __( 'Hotel', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-rental-booking' ) {
                    $name = __( 'Rental', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-car-booking' ) {
                    $name = __( 'Car', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-tour-booking' ) {
                    $name = __( 'Tour', ST_TEXTDOMAIN );
                } elseif ( $sc == 'add-activity-booking' ) {
                    $name = __( 'Activity', ST_TEXTDOMAIN );
                }
                $return = [
                    'status'  => false,
                    'message' => sprintf( __( 'Please choose a %s item ', ST_TEXTDOMAIN ), $name )
                ];

            } else {

                $post_type = get_post_type( $item_id );

                $number_room = STInput::post( 'number_room' ) ? STInput::post( 'number_room' ) : false;
                if ( ! $number_room ) {
                    $number_room = STInput::post( 'room_num_search' ) ? STInput::post( 'room_num_search' ) : 1;
                }

                self::destroy_cart();

                $validate = true;

                switch ( $post_type ) {
                    case "st_hotel":
                        if(class_exists('STHotel')) {
                        $hotel    = new STHotel();
                        $validate = $hotel->do_add_to_cart();
                        }
                        break;
                    case "hotel_room":
                        if(class_exists('STHotel')) {
                        $hotel    = new STHotel();
                        $validate = $hotel->do_add_to_cart();
                        }
                        break;
                    case "st_cars":
                        if(class_exists('STCars')) {
                        $car      = new STCars();
                        $validate = $car->do_add_to_cart();
                        }
                        break;
                    case "st_activity":
                        if(class_exists('STActivity')) {
                            $class = STActivity::inst();
                            $validate = $class->do_add_to_cart();
                        }
                        break;
                    case "st_tours":
                        if(class_exists('STTour')) {
                        $class    = new STTour();
                        $validate = $class->do_add_to_cart();
                        }
                        break;
                    case "st_rental":
                        if(class_exists('STRental')) {
                        $class    = STRental::inst();
                        $validate = $class->do_add_to_cart();
                        }
                        break;
                }

                if ( $validate ) {
                    $return = self::booking_form_submit( $item_id );
                } else {
                    $return = [
                        'status'  => false,
                        'message' => STTemplate::get_message_content()
                    ];
                    STTemplate::clear();
                }
            }
            echo json_encode( $return );
            die;
        }


        static function save_user_checkout( $user = [] ) {

        }

        static function handle_link( $link1, $link2 ) {
            {
                global $wp_rewrite;
                if ( $wp_rewrite->permalink_structure == '' ) {
                    return $link1 . '&' . $link2;
                } else {
                    return $link1 . '?' . $link2;
                }
            }
        }

        static function get_order_item_total( $item_id, $tax = 0 ) {
            $total   = 0;
            $post_id = get_post_meta( $item_id, 'item_id', true );
            switch ( get_post_type( $post_id ) ) {
                case "st_hotel":
                    $total = get_post_meta( $item_id, 'item_price', true ) * get_post_meta( $item_id, 'item_number', true );
                    break;
                default:
                    $total = get_post_meta( $item_id, 'total_price', true );
                    break;

            }

            if ( $tax > 0 ) {
            }

            return $total;
        }

        static function _apply_coupon() {
            if ( STInput::post( 'st_action' ) == 'apply_coupon' ) {
                TravelHelper::setcookie( 'st_cart_coupon', '', time() - 3600 );
                $code = STInput::post( 'coupon_code' );

                if ( ! $code ) {
                    self::$coupon_error = [
                        'status'  => 0,
                        'message' => __( 'Coupon is not correct', ST_TEXTDOMAIN )
                    ];
                }

                $status = self::do_apply_coupon( $code );

                if ( ! $status['status'] ) {
                    self::$coupon_error = [
                        'status'  => 0,
                        'message' => $status['message']
                    ];

                } else {
                    self::$coupon_error = [
                        'status'  => 1,
                        'message' => __( 'Success', ST_TEXTDOMAIN )
                    ];
                }

            }
        }

        static function apply_mdcoupon_function(){
            $code = STInput::post( 'code' );
            $status = STCoupon::get_coupon_value( $code );
            if ( ! $status['status'] ) {
                echo json_encode(['status' => 1]);
                die;
            } else {
                $data = [
                    'code'   => $code,
                    'amount' => $status['value']
                ];
                TravelHelper::setcookie( 'st_cart_coupon', base64_encode(gzcompress(serialize($data), 9)), time() + ( 86400 * 30 ) );
                echo json_encode(['status' => 1]);
                die;
            }
        }

        static function do_apply_coupon( $code ) {

            $status = STCoupon::get_coupon_value( $code );
            if ( ! $status['status'] ) {
                return [
                    'status'  => 0,
                    'message' => $status['message']
                ];

            } else {
                $data = [
                    'code'   => $code,
                    'amount' => $status['value']
                ];
                TravelHelper::setcookie( 'st_cart_coupon', base64_encode(gzcompress(serialize($data), 9)), time() + ( 86400 * 30 ) );

                return [
                    'status' => 1
                ];

            }
        }

        static function _remove_coupon() {
            if ( $removed_code = STInput::get( 'remove_coupon' ) ) {
                //TravelHelper::setcookie( 'st_cart_coupon', '', time() - 3600 );
                if (isset($_COOKIE['st_cart_coupon'])) {
                    unset($_COOKIE['st_cart_coupon']);
                    setcookie('st_cart_coupon', null, -1, '/');
                }
            }
        }

        static function get_coupon_amount() {
            $coupon = ( isset( $_COOKIE['st_cart_coupon'] ) ) ? unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart_coupon'])))) : [];
            //$coupon = ( isset( $_COOKIE['st_cart_coupon'] ) ) ? unserialize( stripslashes( $_COOKIE['st_cart_coupon'] ) ) : [];
            return isset( $coupon['amount'] ) ? $coupon['amount'] : 0;
        }

        static function get_coupon_code() {
            $coupon = ( isset( $_COOKIE['st_cart_coupon'] ) ) ? unserialize(stripslashes(gzuncompress(base64_decode($_COOKIE['st_cart_coupon'])))) : [];
            //$coupon = ( isset( $_COOKIE['st_cart_coupon'] ) ) ? unserialize( stripslashes( $_COOKIE['st_cart_coupon'] ) ) : [];

            return isset( $coupon['code'] ) ? $coupon['code'] : '';
        }

        static function get_checkout_field_html( $field_name, $field ) {
            $html    = false;
            $default = [
                'label'       => '',
                'placeholder' => '',
                'class'       => [
                    'form-control'
                ],
                'type'        => 'text',
                'size'        => 6,
                'icon'        => '',
                'validate'    => ''
            ];

            $field = wp_parse_args( $field, $default );

            $field_type = $field['type'];
            if ( function_exists( 'st_checkout_fieldtype_' . $field_type ) ) {
                $function = 'st_checkout_fieldtype_' . $field_type;
                $html     = $function( $field_name, $field );
            }

            return apply_filters( 'st_checkout_fieldtype_' . $field_type, $html );
        }

        static function get_checkout_fields() {

            //Logged in User Info
            global $firstname, $user_email;
            wp_get_current_user();
            $st_phone    = false;
            $first_name  = false;
            $last_name   = false;
            $st_address  = false;
            $st_address2 = false;
            $st_city     = false;
            $st_province = false;
            $st_zip_code = false;
            $st_country  = false;
            if ( is_user_logged_in() ) {
                $user_id     = get_current_user_id();
                $st_phone    = get_user_meta( $user_id, 'st_phone', true );
                $first_name  = get_user_meta( $user_id, 'first_name', true );
                $last_name   = get_user_meta( $user_id, 'last_name', true );
                $st_address  = get_user_meta( $user_id, 'st_address', true );
                $st_address2 = get_user_meta( $user_id, 'st_address2', true );
                $st_city     = get_user_meta( $user_id, 'st_city', true );
                $st_province = get_user_meta( $user_id, 'st_province', true );
                $st_zip_code = get_user_meta( $user_id, 'st_zip_code', true );
                $st_country  = get_user_meta( $user_id, 'st_country', true );
            }

            $terms_link           = '<a target="_blank" href="' . get_the_permalink( st()->get_option( 'page_terms_conditions' ) ) . '">' . st_get_language( 'terms_and_conditions' ) . '</a>';
            $checkout_form_fields = [
                'st_first_name' => [
                    'label'    => st_get_language( 'first_name' ),
                    'icon'     => 'fa-user',
                    'value'    => STInput::post( 'st_first_name', $first_name ),
                    'validate' => 'required|trim|strip_tags',
                ],
                'st_last_name'  => [
                    'label'       => st_get_language( 'last_name' ),
                    'placeholder' => st_get_language( 'last_name' ),
                    'validate'    => 'required|trim|strip_tags',
                    'icon'        => 'fa-user',
                    'value'       => STInput::post( 'st_last_name', $last_name )
                ],
                'st_email'      => [
                    'label'       => st_get_language( 'Email' ),
                    'placeholder' => st_get_language( 'email_domain' ),
                    'type'        => 'text',
                    'validate'    => 'required|trim|strip_tags|valid_email',
                    'value'       => STInput::post( 'st_email', $user_email ),
                    'icon'        => 'fa-envelope'

                ],
                'st_phone'      => [
                    'label'       => st_get_language( 'Phone' ),
                    'placeholder' => st_get_language( 'Your_Phone' ),
                    'validate'    => 'required|trim|strip_tags',
                    'icon'        => 'fa-phone',
                    'value'       => STInput::post( 'st_phone', $st_phone ),

                ],
                'st_address'    => [
                    'label'       => st_get_language( 'address_line_1' ),
                    'placeholder' => st_get_language( 'your_address_line_1' ),
                    'icon'        => 'fa-map-marker',
                    'value'       => STInput::post( 'st_address', $st_address ),
                ],
                'st_address2'   => [
                    'label'       => st_get_language( 'address_line_2' ),
                    'placeholder' => st_get_language( 'your_address_line_2' ),
                    'icon'        => 'fa-map-marker',
                    'value'       => STInput::post( 'st_address2', $st_address2 ),
                ],
                'st_city'       => [
                    'label'       => st_get_language( 'city' ),
                    'placeholder' => st_get_language( 'your_city' ),
                    'icon'        => 'fa-map-marker',
                    'value'       => STInput::post( 'st_city', $st_city ),

                ],
                'st_province'   => [
                    'label'       => st_get_language( 'state_province_region' ),
                    'placeholder' => st_get_language( 'state_province_region' ),
                    'icon'        => 'fa-map-marker',
                    'value'       => STInput::post( 'st_province', $st_province ),
                ],
                'st_zip_code'   => [
                    'label'       => st_get_language( 'zip_postal_code' ),
                    'placeholder' => st_get_language( 'zip_postal_code' ),
                    'icon'        => 'fa-map-marker',
                    'value'       => STInput::post( 'st_zip_code', $st_zip_code ),
                ],
                'st_country'    => [
                    'label' => st_get_language( 'country' ),
                    'icon'  => 'fa-globe',
                    'value' => STInput::post( 'st_country', $st_country ),
                ],
                'st_note'       => [
                    'label' => st_get_language( 'special_requirements' ),
                    'icon'  => false,
                    'type'  => 'textarea',
                    'size'  => 12,
                    'value' => STInput::post( 'st_note' ),
                    'attrs' => [
                        'rows' => 6
                    ]
                ]

            ];


            $checkout_form_fields = apply_filters( 'st_booking_form_fields', $checkout_form_fields );

            return $checkout_form_fields;
        }

        static function get_default_checkout_fields( $name = false ) {
            if ( $name == 'st_check_create_account' and ! is_user_logged_in() and st()->get_option( 'is_guest_booking' ) == "on" and st()->get_option( 'st_booking_enabled_create_account', 'off' ) != "off" ) {
                $checked  = "";
                $disabled = "";
                $required = "";
                if ( ( st()->get_option( 'st_booking_enabled_create_account' ) !== 'off' ) ) {

                    $option_required = st()->get_option( 'guest_create_acc_required', 'off' );
                    if ( $option_required == "on" ) {
                        $checked  = " checked ";
                        $required = " required ";
                        $disabled = " disabled ";
                    } else {
                        if ( STInput::post( 'create_account' ) == 1 ) {
                            $checked = 'checked ';
                        }
                    }
                }
                ?>
                <div class="checkbox <?php echo esc_attr( $name ); ?>">
                    <label>
                        <input class="i-check " name="create_account" type="checkbox"
                               value=" " <?php echo esc_attr( $checked . $disabled . $required ) ?> /><?php printf( __( 'Create %s account ', ST_TEXTDOMAIN ), get_bloginfo( 'title' ) ) ?>
                        <small><?php esc_html_e('(password will be sent to your e-mail)','traveler')?></small>
                    </label>
                </div>
            <?php }
            if ( $name == 'st_check_term_conditions' ) { ?>
                <?php
	            $page_privacy_policy = get_option('wp_page_for_privacy_policy');
	            $page_privacy_policy_link = '#';
	            if(!empty($page_privacy_policy)){
		            $page_privacy_policy_link = get_permalink($page_privacy_policy);
	            }
                ?>
                <div class="checkbox <?php echo esc_attr( $name ); ?>">
                    <label>
                        <input class="i-check" value="1" name="term_condition"
                               type="checkbox" <?php if ( STInput::post( 'term_condition' ) == 1 ) {
                            echo 'checked';
                        } ?>/><?php echo st_get_language( 'i_have_read_and_accept_the' ) . '<a target="_blank" href="' . get_the_permalink( st()->get_option( 'page_terms_conditions' ) ) . '"> ' . st_get_language( 'terms_and_conditions' ) . '</a> '. __('and', ST_TEXTDOMAIN) .' <a href="'. esc_url($page_privacy_policy_link) .'" target="_blank">'. __('Privacy Policy', ST_TEXTDOMAIN) .'</a>'; ?>
                    </label>
                </div>
            <?php }
        }

        /**
         * return the current booking id, if hotel is booked return the room_id
         *
         * @todo get the current booking id, if hotel is booked return the room_id
         */
        static function get_booking_id() {
            $cart = self::get_carts();

            if ( ! empty( $cart ) ) {
                foreach ( $cart as $key => $value ) {
                    $item_id = $key;
                    $data    = isset( $value['data'] ) ? $value['data'] : [];

                    if ( $data['st_booking_post_type'] == 'st_hotel' and isset( $data['room_id'] ) ) {
                        $item_id = $data['room_id'];
                    }

                    return apply_filters( 'st_cart_booking_' . $data['st_booking_post_type'] . '_id', $item_id, $value, $key );
                }
            }
        }

        /**
         * @since 1.2.0
         * @return array|bool
         */
        static function get_line_items( $order_id = '' ) {
            // Do not send lines when  too many line items in the order.
            $count = STCart::count();
            if ( $count > 9 or ! $count ) {
                return false;
            }

            $args      = [];
            $item_loop = 0;

            if ( STCart::check_cart() ) {
                $cart = STCart::get_carts();

                if ( ! empty( $cart ) ) {
                    foreach ( $cart as $key => $value ) {

                        $args[] =
                            [
                                'name'     => self::_handle_item_name( get_the_title( $key ) ),
                                'quantity' => intval( $value['number'] ),
                                'price'    => round( STPrice::getTotal( true ), 2 )
                            ];
                    }
                }


            }

            return $args;
        }

        /**
         * @since 1.2.0
         * @return int
         */
        static function getPriceByLineItems() {
            $lines = self::get_line_items();
            $total = 0;
            if ( is_array( $lines ) && count( $lines ) ) {
                foreach ( $lines as $item ) {
                    $number = intval( $item['quantity'] );
                    $price  = floatval( $item['price'] );
                    $total  += ( $number * $price );
                }
            }

            return $total;
        }

        /**
         * @since 1.2.0
         *
         * @param $item_name
         *
         * @return string
         */
        static function _handle_item_name( $item_name ) {
            if ( strlen( $item_name ) > 127 ) {
                $item_name = substr( $item_name, 0, 124 ) . '...';
            }

            return html_entity_decode( $item_name, ENT_NOQUOTES, 'UTF-8' );
        }

    }

    STCart::init();
}