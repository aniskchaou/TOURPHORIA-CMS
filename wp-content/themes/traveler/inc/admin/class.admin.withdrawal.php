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
    if ( !class_exists( 'STAdminWithdrawal' ) ) {
        class STAdminWithdrawal extends STAdmin
        {
            static $_inst;
            static $_table_version = "1.2.10";

            function __construct()
            {

            }

            function init()
            {
                //parent::init();
                add_action( 'after_setup_theme', [ __CLASS__, '_check_table_st_withdrawal' ] );

                add_action( 'admin_menu', [ $this, 'st_users_partner_withdrawal_menu' ] );

                //Check booking edit and redirect
                if ( self::is_withdrawal_page() ) {
                    add_action( 'admin_enqueue_scripts', [ __CLASS__, 'add_edit_scripts' ] );
                }

                add_action( 'wp_ajax_st_change_status_withdrawal', [ $this, 'st_change_status_withdrawal_func' ] );
                add_action( 'wp_ajax_nopriv_st_change_status_withdrawal', [ $this, 'st_change_status_withdrawal_func' ] );

            }

            static function check_ver_working()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );

                return $dbhelper->check_ver_working( 'st_withdrawal_table_version' );
            }

            static function _check_table_st_withdrawal()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );
                $dbhelper->setTableName( 'st_withdrawal' );
                $column = [
                    'ID'          => [
                        'type'           => 'INT',
                        'length'         => 11,
                        'AUTO_INCREMENT' => true
                    ],
                    'user_id'     => [
                        'type'   => 'INT',
                        'length' => 11,
                    ],
                    'payout'      => [
                        'type'   => 'text',
                        'length' => 11,
                    ],
                    'data_payout' => [
                        'type'   => 'text',
                        'length' => 11,
                    ],
                    'price'       => [
                        'type'   => 'INT',
                        'length' => 11,
                    ],
                    'created'     => [
                        'type' => 'date'
                    ],
                    'message'     => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'status'      => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],

                ];
                $column = apply_filters( 'st_change_column_st_withdrawal', $column );
                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'st_withdrawal_table_version' );

                return array_keys( $column );
            }

            static function is_withdrawal_page()
            {
                if ( is_admin()
                    and isset( $_GET[ 'page' ] )
                    and $_GET[ 'page' ] == 'st-users-partner-withdrawal-menu'
                ) return TRUE;

                return FALSE;
            }

            static function add_edit_scripts()
            {
                wp_enqueue_script( 'select2' );
                wp_enqueue_script( 'st-jquery-ui-datepicker', get_template_directory_uri() . '/js/jquery-ui.js' );
                wp_enqueue_style( 'jjquery-ui.theme.min.css', get_template_directory_uri() . '/css/admin/jquery-ui.min.css' );

                wp_enqueue_script( 'thickbox' );
                wp_enqueue_style( 'thickbox' );

                wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/inc/css/bootstrap_admin.css' );


            }

            function st_users_partner_withdrawal_menu()
            {
                if ( current_user_can( 'manage_options' ) && st()->get_option( 'enable_withdrawal', 'on' ) == 'on' ) {
                    add_submenu_page( 'st-users-partner-static-menu', __( 'Partner Withdrawal', ST_TEXTDOMAIN ), __( 'Partner Withdrawal', ST_TEXTDOMAIN ), 'manage_options', 'st-users-partner-withdrawal-menu', [ $this, 'st_callback_user_partner_withdrawal_function' ] );
                }
            }

            function st_callback_user_partner_withdrawal_function()
            {
                $action = STInput::request( 'st_action', false );
                switch ( $action ) {
                    case "partner_profile":
                        echo balanceTags( $this->load_view( 'users_withdrawal/partner_profile', false ) );
                        break;
                    default:
                        echo balanceTags( $this->load_view( 'users_withdrawal/partner_index', false ) );

                }

            }

            static function _get_list_withdrawal( $status = "all", $offset, $limit, $user_id = false )
            {
                global $wpdb;
                $where = '';
                $join  = " INNER JOIN {$wpdb->prefix}users ON {$wpdb->prefix}users.ID = {$wpdb->prefix}st_withdrawal.user_id ";
                if ( $status == "partner_request" ) {
                    $where .= " AND {$wpdb->prefix}st_withdrawal.status = 'request' ";
                }
                if ( $status == "partner_completed" ) {
                    $where .= " AND {$wpdb->prefix}st_withdrawal.status = 'completed' ";
                }
                if ( $status == "partner_cancel" ) {
                    $where .= " AND {$wpdb->prefix}st_withdrawal.status = 'cancel' ";
                }

                if ( $c_name = STInput::request( 'st_custommer_name' ) ) {

                    $where .= "
                AND (  {$wpdb->users}.user_login LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_email LIKE '%{$c_name}%'
                    OR {$wpdb->users}.user_nicename LIKE '%{$c_name}%'
                    OR {$wpdb->users}.display_name LIKE '%{$c_name}%')
                ";

                }
                if ( $c_start = STInput::request( 'st_date_start' ) ) {
                    $date = date( 'Y-m-d', strtotime( $c_start ) );
                    $where .= "
                AND {$wpdb->prefix}st_withdrawal.created >= '{$date}'
                ";
                }
                if ( $c_end = STInput::request( 'st_date_end' ) ) {
                    $date = date( 'Y-m-d', strtotime( $c_end ) );
                    $where .= "
                AND {$wpdb->prefix}st_withdrawal.created <= '{$date}'
                ";
                }
                if ( !empty( $user_id ) ) {
                    $where .= " AND {$wpdb->prefix}st_withdrawal.user_id = " . $user_id;
                }

                $querystr  = "
                SELECT SQL_CALC_FOUND_ROWS *,{$wpdb->prefix}st_withdrawal.ID as withdrawal_id FROM {$wpdb->prefix}st_withdrawal
                {$join}
                WHERE 1=1
                " . $where . "
                ORDER BY {$wpdb->prefix}st_withdrawal.created DESC
                LIMIT {$offset},{$limit}
            ";
                $pageposts = $wpdb->get_results( $querystr, OBJECT );

                return [ 'total' => $wpdb->get_var( "SELECT FOUND_ROWS();" ), 'rows' => $pageposts ];
            }

            static function _insert( $user_id, $data )
            {
                if ( !empty( $data ) and !empty( $user_id ) ) {
                    global $wpdb;
                    $fist_month = date( 'Y-m-01' );
                    $last_month = date( 'Y-m-t' );
                    $sql        = "SELECT count(*) as number FROM {$wpdb->prefix}st_withdrawal
                        WHERE 1=1
                        AND user_id = {$user_id}
                        AND created >= '{$fist_month}'
                        AND created <= '{$last_month}'";
                    $rs         = $wpdb->get_row( $sql );
                    if ( empty( $rs->number ) ) {
                        $wpdb->insert( $wpdb->prefix . 'st_withdrawal', $data );
                        $ID = $wpdb->insert_id;

                        return [ 'status' => true, "id" => $ID ];
                    } else {
                        return [ 'status' => false, 'msg' => __( 'You have done withdrawal request  of the current month already. Please wait!', ST_TEXTDOMAIN ) ];
                    }
                } else {
                    return [ 'status' => false, 'msg' => __( "Invalid data!", ST_TEXTDOMAIN ) ];
                }
            }

            static function _get_total_price_payout( $user_id )
            {
                $total_price = 0;
                if ( !empty( $user_id ) ) {
                    global $wpdb;
                    $sql = "SELECT *,SUM(price) as total_price  FROM {$wpdb->prefix}st_withdrawal
                WHERE 1=1
                AND user_id = {$user_id}
                AND status = 'completed'";
                    $rs  = $wpdb->get_row( $sql );
                    if ( !empty( $rs->total_price ) ) {
                        $total_price = $rs->total_price;
                    }
                }

                return $total_price;
            }

            static function _count_item_post_type_by_user( $post_type = "st_hotel", $user_id )
            {

                if ( empty( $user_id ) ) return;
                global $wpdb;
                $sql       = "SELECT SQL_CALC_FOUND_ROWS * FROM  {$wpdb->posts}

                    WHERE 1=1

                    AND post_author = {$user_id}

                    AND post_type = '{$post_type}'

                    GROUP BY ID
                  ";
                $pageposts = $wpdb->get_results( $sql, OBJECT );

                return $wpdb->get_var( "SELECT FOUND_ROWS();" );

            }

            static function _admin_get_total_price_payout()
            {
                $total_price = 0;
                global $wpdb;
                $sql = "SELECT *,SUM(price) as total_price  FROM {$wpdb->prefix}st_withdrawal
            WHERE 1=1
            AND status = 'completed'";
                $rs  = $wpdb->get_row( $sql );
                if ( !empty( $rs->total_price ) ) {
                    $total_price = $rs->total_price;
                }

                return $total_price;
            }

            static function _admin_get_total_price_payout_this_month()
            {
                $fist_month  = date( 'Y-m-01' );
                $last_month  = date( 'Y-m-t' );
                $total_price = 0;
                global $wpdb;
                $sql = "SELECT *,SUM(price) as total_price  FROM {$wpdb->prefix}st_withdrawal
            WHERE 1=1
            AND created >= '{$fist_month}'
            AND created <= '{$last_month}'";
                $rs  = $wpdb->get_row( $sql );
                if ( !empty( $rs->total_price ) ) {
                    $total_price = $rs->total_price;
                }

                return $total_price;
            }

            static function _admin_count_new_user_pending_partner()
            {
                $data = STUser::get_list_partner( 'partner_pending', 0, 10 );

                return $data[ 'total' ];
            }

            static function _admin_count_new_user_partner_this_month()
            {
                global $wpdb;
                $fist_month = date( 'Y-m-01' );
                $last_month = date( 'Y-m-t' );
                $querystr   = "
                SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}users.* FROM {$wpdb->prefix}users

                INNER JOIN {$wpdb->prefix}usermeta ON ( {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id )

                INNER JOIN {$wpdb->prefix}usermeta as mt1 ON ( {$wpdb->prefix}users.ID = mt1.user_id ) and mt1.meta_key = 'st_partner_approved_date'

                WHERE 1=1

                AND ( {$wpdb->prefix}usermeta.meta_key = '{$wpdb->prefix}capabilities' AND CAST({$wpdb->prefix}usermeta.meta_value AS CHAR) LIKE '%\"partner\"%' )

                AND mt1.meta_value >= '{$fist_month}'

				AND mt1.meta_value <= '{$last_month}'

                GROUP BY {$wpdb->prefix}users.ID

            ";

                $pageposts = $wpdb->get_results( $querystr, OBJECT );
                if ( !empty( $pageposts ) ) {
                    return count( $pageposts );
                } else {
                    return 0;
                }
            }

            function st_change_status_withdrawal_func()
            {
                $st_user_id       = STInput::request( 'st_user_id' );
                $st_withdrawal_id = STInput::request( 'st_withdrawal_id' );
                $st_status        = STInput::request( 'st_status' );
                $st_message       = STInput::request( 'st_message' );
                if ( !empty( $st_withdrawal_id ) and !empty( $st_status ) ) {
                    global $wpdb;
                    $wpdb->update( $wpdb->prefix . "st_withdrawal", [ 'status' => $st_status, 'message' => $st_message ], [ 'ID' => $st_withdrawal_id ] );
                    if ( $st_status == "completed" ) {
                        $st_status = __( "Completed", ST_TEXTDOMAIN );
                        self::_send_admin_approved_withdrawal( $st_user_id, $st_withdrawal_id );
                        self::_send_user_approved_withdrawal( $st_user_id, $st_withdrawal_id );
                    }
                    if ( $st_status == "cancel" ) {
                        $st_status = __( "Cancel", ST_TEXTDOMAIN );
                        self::_send_user_cancel_withdrawal( $st_user_id, $st_withdrawal_id );
                    }


                    echo json_encode(
                        [
                            'status'      => 'true',
                            'msg'         => '',
                            'html_status' => $st_status
                        ]
                    );
                } else {
                    echo json_encode(
                        [
                            'status' => 'false',
                            'msg'    => ''
                        ]
                    );
                }
                die();
            }

            static function _send_admin_approved_withdrawal( $user_id, $withdrawal_id )
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
                    $email_to = st()->get_option( 'send_admin_approved_withdrawal', '' );
                    $message .= do_shortcode( $email_to );
                    $message .= st()->load_template( 'email/footer' );
                    $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $subject = sprintf( __( '[%s] Approved Request Withdrawal', ST_TEXTDOMAIN ), $title );
                    $check   = self::_send_mail_user( $to, $subject, $message );
                }
                unset( $st_user_id );

                return $check;
            }

            static function _send_user_approved_withdrawal( $user_id, $withdrawal_id )
            {
                global $st_user_id;
                global $st_withdrawal_id;
                $st_user_id       = $user_id;
                $st_withdrawal_id = $withdrawal_id;
                $user_data        = get_userdata( $user_id );
                $user_email       = $user_data->user_email;
                if ( !$user_email ) return false;
                $to = $user_email;
                if ( $user_id ) {
                    $message  = st()->load_template( 'email/header' );
                    $email_to = st()->get_option( 'send_user_approved_withdrawal', '' );
                    $message .= do_shortcode( $email_to );
                    $message .= st()->load_template( 'email/footer' );
                    $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $subject = sprintf( __( '[%s] Approved Request Withdrawal', ST_TEXTDOMAIN ), $title );
                    $check   = self::_send_mail_user( $to, $subject, $message );
                }
                unset( $st_user_id );

                return $check;
            }

            static function _send_user_cancel_withdrawal( $user_id, $withdrawal_id )
            {
                global $st_user_id;
                global $st_withdrawal_id;
                $st_user_id       = $user_id;
                $st_withdrawal_id = $withdrawal_id;
                $user_data        = get_userdata( $user_id );
                $user_email       = $user_data->user_email;
                if ( !$user_email ) return false;
                $to = $user_email;
                if ( $user_id ) {
                    $message  = st()->load_template( 'email/header' );
                    $email_to = st()->get_option( 'send_user_cancel_withdrawal', '' );
                    $message .= do_shortcode( $email_to );
                    $message .= st()->load_template( 'email/footer' );
                    $title   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                    $subject = sprintf( __( '[%s] Cancel Request Withdrawal', ST_TEXTDOMAIN ), $title );
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

            static function inst()
            {
                if ( !self::$_inst ) {
                    self::$_inst = new self();
                }

                return self::$_inst;
            }
        }

        STAdminWithdrawal::inst()->init();
    }