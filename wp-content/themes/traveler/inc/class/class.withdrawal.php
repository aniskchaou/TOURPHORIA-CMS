<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STWithdrawal
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STWithdrawal' ) ) {
        class STWithdrawal extends TravelerObject
        {
            public static $msg = '';
            static        $_inst;
            public static $validator;

            function __construct()
            {

            }

            function init()
            {
                parent::init();
                self::$validator = new STValidate();
                add_action( 'init', [ $this, 'st_partner_withdrawal' ], 50 );

                add_action( 'wp_ajax_st_load_more_list_withdrawal', [ $this, 'get_list_withdrawal' ] );
                add_action( 'wp_ajax_nopriv_st_load_more_list_withdrawal', [ $this, 'get_list_withdrawal' ] );

                add_action( 'wp_ajax_st_remove_withdrawal', [ $this, 'st_remove_withdrawal_func' ] );
                add_action( 'wp_ajax_nopriv_st_remove_withdrawal', [ $this, 'st_remove_withdrawal_func' ] );


            }

            function st_remove_withdrawal_func()
            {
                $data_user_id     = STInput::request( 'data_user_id' );
                $data_date_create = STInput::request( 'data_date_create' );
                if ( !empty( $data_user_id ) and !empty( $data_date_create ) ) {
                    global $wpdb;
                    $wpdb->delete( $wpdb->prefix . 'st_withdrawal', [ 'user_id' => $data_user_id, "created" => $data_date_create ] );
                    echo json_encode(
                        [
                            'status' => 'true',
                            'msg'    => 'Xóa thành công !',
                        ]
                    );
                } else {
                    echo json_encode(
                        [
                            'status' => 'false',
                            'msg'    => 'Xóa không thành công !',
                        ]
                    );
                }
                die();
            }

            static function get_list_withdrawal()
            {
                global $wpdb;
                $paged = 1;
                $limit = 10;
                if ( !empty( $_REQUEST[ 'paged' ] ) ) {
                    $paged = $_REQUEST[ 'paged' ];
                }
                $offset    = ( $paged - 1 ) * $limit;
                $where     = "";
                $querystr  = "SELECT SQL_CALC_FOUND_ROWS * FROM " . $wpdb->prefix . "st_withdrawal
                                WHERE 1=1
                                AND user_id = " . get_current_user_id() . "
                                {$where}
                                ORDER BY created DESC LIMIT {$offset},{$limit}";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );
                $html      = "";
                if ( !empty( $pageposts ) ) {
                    $i = 1;
                    foreach ( $pageposts as $key => $value ) {
                        $number = $offset + $i;
                        $format = TravelHelper::getDateFormat();
                        $date   = date_i18n( $format, strtotime( $value->created ) );

                        $price    = TravelHelper::format_money( $value->price );
                        $pay_out  = ucwords( $value->payout );
                        $pay_info = $value->data_payout;
                        $status   = ucwords( $value->status );

                        if ( $status == "request" ) {
                            $status = __( "Request", ST_TEXTDOMAIN );
                        }
                        if ( $status == "completed" ) {
                            $status = __( "Completed", ST_TEXTDOMAIN );
                        }
                        if ( $status == "cancel" ) {
                            $status = __( "Cancel", ST_TEXTDOMAIN );
                        }

                        $control = "";
                        if ( $value->status == 'request' ) {
                            $control = " <a data-date-create=" . $value->created . " data-user-id=" . get_current_user_id() . " class='btn btn-danger btn-sm btn_del_withdrawal'> X </a>";
                        }
                        $html .= "<tr class='{$value->created}'>
                                    <td>
                                        {$date}
                                    </td>
                                    <td>
                                        {$price}
                                    </td>
                                    <td>
                                        {$pay_out}
                                    </td>
                                    <td>
                                        {$pay_info}
                                    </td>
                                    <td>
                                        {$status}
                                    </td>
                                    <td class='text-center'>
                                        {$control}
                                    </td>
                              </tr>";
                        $i++;
                    }
                }
                if ( !empty( $_REQUEST[ 'show' ] ) ) {
                    if ( !empty( $html ) )
                        $status = 'true';
                    else
                        $status = 'false';

                    echo json_encode( [
                        'html'     => $html,
                        'data_per' => $paged + 1,
                        'status'   => $status
                    ] );
                    die();
                } else {
                    return $html;
                }
            }

            function st_partner_withdrawal()
            {
                if ( !empty( $_REQUEST[ 'st_is_partner_withdrawal' ] ) ) {
                    if ( wp_verify_nonce( $_REQUEST[ 'st_partner_withdrawal' ], 'user_setting' ) ) {
                        global $current_user;
                        global $wpdb;

                        $db_insert   = [];
                        $data_payout = '';
                        $id_user     = $current_user->ID;

                        $st_partner_payout = STInput::request( 'st_partner_payout' );
                        $st_partner_price  = STInput::request( 'st_partner_price' );
                        $price_min         = st()->get_option( 'partner_withdrawal_payout_price_min', 0 );
                        if ( $st_partner_price < $price_min ) {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => sprintf( __( 'The amount must be greater than %s', ST_TEXTDOMAIN ), TravelHelper::format_money( $price_min ) )
                            ];

                            return false;
                        }
                        $total_price = STUser_f::st_get_data_reports_total_all_time_partner();
                        $total_price = $total_price[ 'average_total' ];

                        $total_price_payout = STAdminWithdrawal::_get_total_price_payout( $id_user );

                        $remaining_price = $total_price - $total_price_payout - $st_partner_price;

                        if ( $remaining_price < 0 ) {
                            self::$msg = [
                                'status' => 'danger',
                                'msg'    => __( 'Withdrawal amount greater than the amount of current account!', ST_TEXTDOMAIN )
                            ];

                            return false;
                        }

                        update_user_meta( $id_user, 'st_partner_payout', $st_partner_payout );
                        switch ( $st_partner_payout ) {
                            case "paypal":
                                $st_partner_paypal_email         = STInput::request( 'st_partner_paypal_email' );
                                $st_partner_confirm_paypal_email = STInput::request( 'st_partner_confirm_paypal_email' );
                                if ( $st_partner_confirm_paypal_email != $st_partner_paypal_email ) {
                                    self::$msg = [
                                        'status' => 'danger',
                                        'msg'    => __( 'Email is not the same!', ST_TEXTDOMAIN )
                                    ];

                                    return false;
                                }
                                $validator = self::$validator;
                                $validator->set_rules( 'st_partner_paypal_email', __( "Email", ST_TEXTDOMAIN ), 'required|valid_email' );
                                $result = $validator->run();
                                if ( !$result ) {
                                    STTemplate::set_message( $validator->error_string(), 'warning' );

                                    return false;
                                }
                                $data_payout = $st_partner_paypal_email;

                                update_user_meta( $id_user, 'st_partner_paypal_email', $st_partner_paypal_email );
                                break;
                            case "stripe":
                                $st_partner_stripe_key = STInput::request( 'st_partner_stripe_key' );
                                $validator             = self::$validator;
                                $validator->set_rules( 'st_partner_stripe_key', __( "Stripe key", ST_TEXTDOMAIN ), 'required' );
                                $result = $validator->run();
                                if ( !$result ) {
                                    STTemplate::set_message( $validator->error_string(), 'warning' );

                                    return false;
                                }
                                $data_payout = $st_partner_stripe_key;
                                update_user_meta( $id_user, 'st_partner_stripe_key', $st_partner_stripe_key );
                                break;
                            case "bank_transfer":
                                $st_partner_bank_transfer_info = STInput::request( 'st_partner_bank_transfer_info' );
                                $validator                     = self::$validator;
                                $validator->set_rules( 'st_partner_bank_transfer_info', __( "Bank information", ST_TEXTDOMAIN ), 'required' );
                                $result = $validator->run();
                                if ( !$result ) {
                                    STTemplate::set_message( $validator->error_string(), 'warning' );

                                    return false;
                                }
                                $data_payout = $st_partner_bank_transfer_info;
                                update_user_meta( $id_user, 'st_partner_bank_transfer_info', $st_partner_bank_transfer_info );
                                break;
                        }

                        $db_insert[ 'user_id' ]     = $id_user;
                        $db_insert[ 'payout' ]      = $st_partner_payout;
                        $db_insert[ 'data_payout' ] = $data_payout;
                        $db_insert[ 'price' ]       = $st_partner_price;
                        $db_insert[ 'created' ]     = date( 'Y-m-d' );
                        $db_insert[ 'status' ]      = 'request';
                        $rs                         = STAdminWithdrawal::_insert( $id_user, $db_insert );
                        if ( $rs[ 'status' ] == true ) {
                            STTemplate::set_message( __( "Your payment request has been successful!", ST_TEXTDOMAIN ), 'success' );
                            self::_send_admin_new_request_withdrawal( $id_user, $rs[ 'id' ] );
                            self::_send_user_new_request_withdrawal( $id_user, $rs[ 'id' ] );
                        } else {
                            STTemplate::set_message( $rs[ 'msg' ], 'warning' );
                        }

                    }
                }
            }

            static function _send_admin_new_request_withdrawal( $user_id, $withdrawal_id )
            {
                global $st_user_id;
                global $st_withdrawal_id;
                $st_user_id       = $user_id;
                $st_withdrawal_id = $withdrawal_id;
                $admin_email      = st()->get_option( 'email_admin_address' );
                if ( !$admin_email ) return false;
                $to = $admin_email;
                if ( $user_id ) {
                    $message  = st()->load_template( 'email/header' );
                    $email_to = st()->get_option( 'send_admin_new_request_withdrawal', '' );
                    $message .= do_shortcode( $email_to );
                    $message .= st()->load_template( 'email/footer' );
                    $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $subject = sprintf( __( '[%s] New User Request Withdrawal', ST_TEXTDOMAIN ), $title );
                    $check   = self::_send_mail_user( $to, $subject, $message );
                }
                unset( $st_user_id );

                return $check;
            }

            static function _send_user_new_request_withdrawal( $user_id, $withdrawal_id )
            {
                global $st_user_id;
                global $st_withdrawal_id;
                $st_user_id       = $user_id;
                $st_withdrawal_id = $withdrawal_id;

                $user_data  = get_userdata( $user_id );
                $user_email = $user_data->user_email;
                if ( !$user_email ) return false;
                $to = $user_email;
                if ( $user_id ) {
                    $message  = st()->load_template( 'email/header' );
                    $email_to = st()->get_option( 'send_user_new_request_withdrawal', '' );
                    $message .= do_shortcode( $email_to );
                    $message .= st()->load_template( 'email/footer' );
                    $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $subject = sprintf( __( '[%s] Your Request Withdrawal', ST_TEXTDOMAIN ), $title );
                    $check   = self::_send_mail_user( $to, $subject, $message );
                }
                unset( $st_user_id );

                return $check;
            }

            private static function _send_mail_user( $to, $subject, $message, $attachment = false )
            {
                if ( !$message ) return [
                    'status'  => false,
                    'data'    => '',
                    'message' => __( "Email content is empty", ST_TEXTDOMAIN )
                ];
                $from         = st()->get_option( 'email_from' );
                $from_address = st()->get_option( 'email_from_address' );
                $headers      = [];

                if ( $from and $from_address ) {
                    $headers[] = 'From:' . $from . ' <' . $from_address . '>';
                }
                add_filter( 'wp_mail_content_type', [ __CLASS__, 'set_html_content_type' ] );
                $check = wp_mail( $to, $subject, $message, $headers, $attachment );
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

            static function set_html_content_type()
            {
                return 'text/html';
            }

            static function get_msg()
            {
                if ( !empty( STWithdrawal::$msg ) ) {
                    return '<div class="alert alert-' . STWithdrawal::$msg[ 'status' ] . '">
                        <button data-dismiss="alert" type="button" class="close"><span aria-hidden="true">×</span>
                        </button>
                        <p class="text-small">' . STWithdrawal::$msg[ 'msg' ] . '</p>
                      </div>';
                }

                return '';
            }

            static function inst()
            {
                if ( !self::$_inst ) {
                    self::$_inst = new self();
                }

                return self::$_inst;
            }
        }

        STWithdrawal::inst()->init();
    }