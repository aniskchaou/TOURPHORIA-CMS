<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'NewOrderData' ) ) {
        class NewOrderData
        {
            public $table = 'st_order_item_meta';
            public $st_upgrade_order = 0;
            public $allow_version = false;

            public function __construct()
            {
                add_action( 'st_save_order_item_meta', [ &$this, '_save_data' ], 10, 3 );
                add_action( 'st_booking_change_status', [ &$this, '_st_booking_change_status' ], 10, 3 );
                add_action( 'st_traveler_do_upgrade_table', [ &$this, '_action_check_upgrade_order' ] );
                add_action( 'after_setup_theme', [ &$this, '_check_table_order' ], 10 );
                add_action( 'after_setup_theme', [ &$this, '_check_upgrade_order' ], 50 );
                add_action( 'admin_init', [ $this, 'upgrade_order_2_0_3' ] );
            }

            public function upgrade_order_2_0_3()
            {
                $updated = get_option( 'st_upgrade_order_2_0_3', '' );
                if ( !$updated ) {
                    global $wpdb;
                    if ( TravelHelper::is_wpml() ) {
                        $sql = "UPDATE {$wpdb->prefix}st_order_item_meta AS ord
                            INNER JOIN {$wpdb->prefix}icl_translations AS translation ON (
                                ord.room_id = translation.element_id
                            )
                            SET ord.room_origin = translation.trid ";
                    } else {
                        $sql = "UPDATE {$wpdb->prefix}st_order_item_meta SET room_origin = room_id";
                    }

                    $wpdb->query( $sql );
                    update_option( 'st_upgrade_order_2_0_3', 'updated' );
                }
            }

            public function _action_check_upgrade_order()
            {
                $this->st_upgrade_order = 1;
                $this->allow_version    = true;
                $this->_check_table_order();
                $this->_check_upgrade_order();
            }

            public function _check_table_order()
            {
                $dbhelper = new DatabaseHelper( '2.0.3' );
                $dbhelper->setTableName( $this->table );
                $column = [
                    'id'                   => [
                        'type'           => 'bigint',
                        'length'         => 9,
                        'AUTO_INCREMENT' => true
                    ],
                    'order_item_id'        => [
                        'type'   => 'INT',
                        'length' => 255
                    ],
                    'type'                 => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_in'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_out'            => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'starttime'            => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'st_booking_post_type' => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'st_booking_id'        => [
                        'type' => 'INT'
                    ],
                    'duration'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'adult_number'         => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'child_number'         => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'infant_number'        => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'discount'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'room_id'              => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'room_num_search'      => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_in_timestamp'   => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_out_timestamp'  => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'status'               => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'wc_order_id'          => [
                        'type' => 'INT'
                    ],
                    'user_id'              => [
                        'type' => 'INT'
                    ],
                    'partner_id'           => [
                        'type' => 'INT'
                    ],
                    'created'              => [
                        'type' => 'date'
                    ],
                    'commission'           => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'total_order'          => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'origin_id'            => [
                        'type' => 'INT',
                    ],
                    'cancel_percent'       => [
                        'type' => 'INT',
                    ],
                    'cancel_refund'        => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'cancel_refund_status' => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'return_id'            => [
                        'type'   => 'INT',
                        'length' => 11
                    ],
                    'raw_data'             => [
                        'type' => 'text'
                    ],
                    'log_mail'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'room_origin'          => [
                        'type'   => 'INT',
                        'length' => 11
                    ],
                ];
                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'neworder_table_version' );
            }

            public function _check_upgrade_order()
            {
                $complete = get_option( 'st_upgrade_order' );
                if ( !$complete || $complete == 0 || $this->st_upgrade_order == 1 || $this->allow_version ) {
                    $this->_duplicateOrder();
                }
            }

            static function isset_table()
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_order_item_meta';
                if ( $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) != $table ) {
                    return false;
                }

                return true;
            }

            public function _save_data( $data = [], $order_item_id = false, $type = 'normal_booking' )
            {
                if ( is_array( $data ) && count( $data ) ) {
                    global $wpdb;

                    $table = $wpdb->prefix . $this->table;

                    $post_type_check = get_post_type( $data[ 'st_booking_id' ] );

                    $check_in             = isset( $data[ 'check_in' ] ) ? $data[ 'check_in' ] : null;
                    $check_out            = isset( $data[ 'check_out' ] ) ? $data[ 'check_out' ] : null;
                    $starttime            = isset( $data[ 'starttime' ] ) ? $data[ 'starttime' ] : null;
                    $st_booking_post_type = $data[ 'st_booking_post_type' ];
                    $st_booking_id        = $data[ 'st_booking_id' ];
                    $duration             = isset( $data[ 'duration' ] ) ? $data[ 'duration' ] : null;
                    $adult_number         = isset( $data[ 'adult_number' ] ) ? $data[ 'adult_number' ] : 0;
                    if ( $post_type_check == 'st_flight' ) {
                        $adult_number = ( isset( $data[ 'passenger' ] ) ) ? $data[ 'passenger' ] : 0;
                    }
                    $child_number    = isset( $data[ 'child_number' ] ) ? $data[ 'child_number' ] : 0;
                    $infant_number   = isset( $data[ 'infant_number' ] ) ? $data[ 'infant_number' ] : 0;
                    $discount        = isset( $data[ 'discount' ] ) ? $data[ 'discount' ] : null;
                    $room_id         = isset( $data[ 'room_id' ] ) ? $data[ 'room_id' ] : null;
                    $room_origin     = isset( $data[ 'room_id' ] ) ? TravelHelper::post_origin( $data[ 'room_id' ], 'hotel_room' ) : null;
                    $room_num_search = isset( $data[ 'room_num_search' ] ) ? $data[ 'room_num_search' ] : null;
                    $wc_order_id     = isset( $data[ 'wc_order_id' ] ) ? $data[ 'wc_order_id' ] : $order_item_id;
                    $user_id         = isset( $data[ 'user_id' ] ) ? $data[ 'user_id' ] : get_current_user_id();
                    $g_post          = get_post( $data[ 'st_booking_id' ] );
                    $partner_id      = $g_post->post_author;
                    if ( !empty( $data[ 'st_booking_post_type' ] ) && $data[ 'st_booking_post_type' ] == 'st_flight' ) {
                        $check_in            = date( 'm/d/Y', $data[ 'depart_date' ] );
                        $data[ 'check_in' ]  = date( 'm/d/Y', $data[ 'depart_date' ] );
                        $check_out           = !empty( $data[ 'return_date' ] ) ? date( 'm/d/Y', $data[ 'return_date' ] ) : null;
                        $data[ 'check_out' ] = !empty( $data[ 'return_date' ] ) ? date( 'm/d/Y', $data[ 'return_date' ] ) : null;
                        $data[ 'ori_price' ] = $data[ 'total_price' ];
                    }
                    $return_id = isset( $data[ 'return_id' ] ) ? $data[ 'return_id' ] : null;
                    $raw_data  = json_encode( $data );

                    if ( !isset( $data[ 'check_in_timestamp' ] ) && isset( $data[ 'check_in' ] ) ) {
                        $check_in_timestamp = strtotime( $data[ 'check_in' ] );
                    } else {
                        $check_in_timestamp = $data[ 'check_in_timestamp' ];
                    }
                    if ( !isset( $data[ 'check_out_timestamp' ] ) && isset( $data[ 'check_out' ] ) ) {
                        $check_out_timestamp = strtotime( $data[ 'check_out' ] );
                    } else {
                        $check_out_timestamp = $data[ 'check_out_timestamp' ];
                    }
                    $total_order = isset( $data[ 'ori_price' ] ) ? $data[ 'ori_price' ] : 0;
                    $commission  = isset( $data[ 'commission' ] ) ? $data[ 'commission' ] : 0;

                    if ( !empty( $data[ 'booking_fee_price' ] ) ) {
                        $total_order = $total_order + $data[ 'booking_fee_price' ];
                    }
                    global $sitepress;
                    if ( $sitepress ) {
                        $post_type = get_post_type( $st_booking_id );
                        if ( $post_type == 'st_hotel' ) {
                            $post_type = 'hotel_room';
                            $id        = $room_id;
                        } else {
                            $id = $st_booking_id;
                        }
                        $lang_code = $sitepress->get_default_language();
                        $origin_id = icl_object_id( $id, $post_type, true, $lang_code );
                    } else {
                        $origin_id = $st_booking_id;
                    }

                    $value = [
                        'order_item_id'        => $order_item_id,
                        'type'                 => $type,
                        'check_in'             => $check_in,
                        'check_out'            => $check_out,
                        'starttime'            => $starttime,
                        'check_in_timestamp'   => $check_in_timestamp,
                        'check_out_timestamp'  => $check_out_timestamp,
                        'st_booking_post_type' => $st_booking_post_type,
                        'st_booking_id'        => $st_booking_id,
                        'user_id'              => $user_id,
                        'partner_id'           => $partner_id,
                        'discount'             => $discount,
                        'duration'             => $duration,
                        'adult_number'         => $adult_number,
                        'child_number'         => $child_number,
                        'infant_number'        => $infant_number,
                        'room_id'              => $room_id,
                        'room_origin'          => $room_origin,
                        'room_num_search'      => $room_num_search,
                        'wc_order_id'          => $wc_order_id,
                        'status'               => 'pending',
                        'created'              => get_the_date( 'Y-m-d', $wc_order_id ),
                        'total_order'          => $total_order,
                        'commission'           => $commission,
                        'origin_id'            => $origin_id,
                        'return_id'            => $return_id,
                        'raw_data'             => $raw_data
                    ];

                    //Update data to number_booked id
	                AvailabilityHelper::syncAvailabilityOrder($value);

                    $wpdb->insert( $table, $value );
                }
            }

            public function _st_booking_change_status( $status, $order_id, $booking_type )
            {
                if ( !$this->isset_table() ) return false;

                global $wpdb;
                $table = $wpdb->prefix . $this->table;

                $data = [
                    'status' => $status
                ];

                $where = [
                    'order_item_id' => intval( $order_id )
                ];
                $rs    = $wpdb->update( $table, $data, $where );
            }

            public function _duplicateOrder()
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                if ( $this->allow_version ) {
                    if ( $this->isset_table() ) {
                        $this->_deleteTable();
                        $this->_check_table_order();
                    }
                }

                $list_normal = $this->_getOldData();

                if ( is_array( $list_normal ) && count( $list_normal ) ) {
                    foreach ( $list_normal as $key => $val ) {
                        $order_item_id        = $key;
                        $type                 = 'normal_booking';
                        $check_in             = isset( $val[ 'check_in' ] ) ? date( 'm/d/Y', strtotime( $val[ 'check_in' ] ) ) : '';
                        $check_out            = isset( $val[ 'check_out' ] ) ? date( 'm/d/Y', strtotime( $val[ 'check_out' ] ) ) : '';
                        $st_booking_post_type = isset( $val[ 'st_booking_post_type' ] ) ? $val[ 'st_booking_post_type' ] : '';
                        $st_booking_id        = isset( $val[ 'st_booking_id' ] ) ? $val[ 'st_booking_id' ] : '';
                        $duration             = isset( $val[ 'duration' ] ) ? $val[ 'duration' ] : '';
                        $adult_number         = isset( $val[ 'adult_number' ] ) ? $val[ 'adult_number' ] : 0;
                        $child_number         = isset( $val[ 'child_number' ] ) ? $val[ 'child_number' ] : 0;
                        $infant_number        = isset( $val[ 'infant_number' ] ) ? $val[ 'infant_number' ] : 0;
                        $discount             = isset( $val[ 'discount' ] ) ? $val[ 'discount' ] : '';
                        $room_id              = isset( $val[ 'room_id' ] ) ? $val[ 'room_id' ] : '';
                        $room_num_search      = isset( $val[ 'room_num_search' ] ) ? $val[ 'room_num_search' ] : '';
                        $check_in_timestamp   = isset( $val[ 'check_in_timestamp' ] ) ? $val[ 'check_in_timestamp' ] : strtotime( $check_in );
                        $check_out_timestamp  = isset( $val[ 'check_out_timestamp' ] ) ? $val[ 'check_out_timestamp' ] : strtotime( $check_out );
                        $status               = isset( $val[ 'status' ] ) ? $val[ 'status' ] : 'canceled';
                        $wc_order_id          = $order_item_id;
                        $user_id              = isset( $val[ 'user_id' ] ) ? $val[ 'user_id' ] : 1;
                        $g_post               = get_post( $st_booking_id );
                        $partner_id           = $g_post ? $g_post->post_author : '';
                        $commission           = isset( $val[ 'commission' ] ) ? $val[ 'commission' ] : 0;
                        if ( $type == 'normal_booking' ) {
                            $total_order       = get_post_meta( $wc_order_id, 'total_price', true );
                            $booking_fee_price = get_post_meta( $wc_order_id, 'booking_fee_price', true );
                            if ( !empty( $booking_fee_price ) ) {
                                $total_order = $total_order + $booking_fee_price;
                            }
                        }
                        if ( $type == 'woocommerce' ) {
                            $total_order = get_post_meta( $wc_order_id, '_order_total', true );
                        }
                        global $sitepress;
                        if ( $sitepress ) {
                            $post_type = get_post_type( $st_booking_id );
                            if ( $post_type == 'st_hotel' ) {
                                $post_type = 'hotel_room';
                                $id        = $room_id;
                            } else {
                                $id = $st_booking_id;
                            }
                            $lang_code = $sitepress->get_default_language();
                            $origin_id = icl_object_id( $id, $post_type, true, $lang_code );
                        } else {
                            $origin_id = $st_booking_id;
                        }
                        $data = [
                            'order_item_id'        => $order_item_id,
                            'type'                 => $type,
                            'check_in'             => $check_in,
                            'check_out'            => $check_out,
                            'st_booking_post_type' => $st_booking_post_type,
                            'st_booking_id'        => $st_booking_id,
                            'duration'             => $duration,
                            'adult_number'         => $adult_number,
                            'child_number'         => $child_number,
                            'infant_number'        => $infant_number,
                            'discount'             => $discount,
                            'room_id'              => $room_id,
                            'room_num_search'      => $room_num_search,
                            'check_in_timestamp'   => $check_in_timestamp,
                            'check_out_timestamp'  => $check_out_timestamp,
                            'status'               => $status,
                            'wc_order_id'          => $wc_order_id,
                            'user_id'              => $user_id,
                            'partner_id'           => $partner_id,
                            'created'              => get_the_date( 'Y-m-d', $order_item_id ),
                            'total_order'          => $total_order,
                            'commission'           => $commission,
                            'origin_id'            => $origin_id
                        ];

                        $wpdb->insert( $table, $data );
                    }
                }

                $list_woo = $this->_getOldDataWoo();
                if ( is_array( $list_woo ) && count( $list_woo ) ) {
                    foreach ( $list_woo as $key => $val ) {
                        $order_item_id        = $key;
                        $type                 = 'woocommerce';
                        $check_in             = isset( $val[ '_st_check_in' ] ) ? date( 'm/d/Y', strtotime( $val[ '_st_check_in' ] ) ) : '';
                        $check_out            = isset( $val[ '_st_check_out' ] ) ? date( 'm/d/Y', strtotime( $val[ '_st_check_out' ] ) ) : '';
                        $st_booking_post_type = isset( $val[ '_st_st_booking_post_type' ] ) ? $val[ '_st_st_booking_post_type' ] : '';
                        $st_booking_id        = isset( $val[ '_st_st_booking_id' ] ) ? $val[ '_st_st_booking_id' ] : '';
                        $duration             = isset( $val[ '_st_duration' ] ) ? $val[ '_st_duration' ] : '';
                        $adult_number         = isset( $val[ '_st_adult_number' ] ) ? $val[ '_st_adult_number' ] : 0;
                        $child_number         = isset( $val[ '_st_child_number' ] ) ? $val[ '_st_child_number' ] : 0;
                        $infant_number        = isset( $val[ '_st_infant_number' ] ) ? $val[ '_st_infant_number' ] : 0;
                        $discount             = isset( $val[ '_st_discount' ] ) ? $val[ '_st_discount' ] : '';
                        $room_id              = isset( $val[ '_st_room_id' ] ) ? $val[ '_st_room_id' ] : '';
                        $room_num_search      = isset( $val[ '_st_room_num_search' ] ) ? $val[ '_st_room_num_search' ] : '';
                        $check_in_timestamp   = isset( $val[ '_st_check_in_timestamp' ] ) ? $val[ '_st_check_in_timestamp' ] : strtotime( $check_in );
                        $check_out_timestamp  = isset( $val[ '_st_check_out_timestamp' ] ) ? $val[ '_st_check_out_timestamp' ] : strtotime( $check_out );
                        $status               = isset( $val[ 'order_id' ] ) ? get_post_status( $val[ 'order_id' ] ) : 'trash';
                        $wc_order_id          = isset( $val[ 'order_id' ] ) ? $val[ 'order_id' ] : '';
                        $user_id              = isset( $val[ '_st_user_id' ] ) ? $val[ '_st_user_id' ] : 1;
                        $g_post               = get_post( $st_booking_id );
                        $partner_id           = $g_post ? $g_post->post_author : '';
                        $commission           = isset( $val[ 'st_commission' ] ) ? $val[ 'st_commission' ] : 0;
                        if ( $type == 'normal_booking' ) {
                            $total_order       = get_post_meta( $wc_order_id, 'total_price', true );
                            $booking_fee_price = get_post_meta( $wc_order_id, 'booking_fee_price', true );
                            if ( !empty( $booking_fee_price ) ) {
                                $total_order = $total_order + $booking_fee_price;
                            }
                        }
                        if ( $type == 'woocommerce' ) {
                            $total_order = get_post_meta( $wc_order_id, '_order_total', true );
                        }
                        global $sitepress;
                        if ( $sitepress ) {
                            $post_type = get_post_type( $st_booking_id );
                            if ( $post_type == 'st_hotel' ) {
                                $post_type = 'hotel_room';
                                $id        = $room_id;
                            } else {
                                $id = $st_booking_id;
                            }
                            $lang_code = $sitepress->get_default_language();
                            $origin_id = icl_object_id( $id, $post_type, true, $lang_code );
                        } else {
                            $origin_id = $st_booking_id;
                        }
                        $data = [
                            'order_item_id'        => $order_item_id,
                            'type'                 => $type,
                            'check_in'             => $check_in,
                            'check_out'            => $check_out,
                            'st_booking_post_type' => $st_booking_post_type,
                            'st_booking_id'        => $st_booking_id,
                            'duration'             => $duration,
                            'adult_number'         => $adult_number,
                            'child_number'         => $child_number,
                            'infant_number'        => $infant_number,
                            'discount'             => $discount,
                            'room_id'              => $room_id,
                            'room_num_search'      => $room_num_search,
                            'check_in_timestamp'   => $check_in_timestamp,
                            'check_out_timestamp'  => $check_out_timestamp,
                            'status'               => $status,
                            'wc_order_id'          => $wc_order_id,
                            'user_id'              => $user_id,
                            'partner_id'           => $partner_id,
                            'created'              => get_the_date( 'Y-m-d', $wc_order_id ),
                            'total_order'          => $total_order,
                            'commission'           => $commission,
                            'origin_id'            => $origin_id
                        ];

                        $wpdb->insert( $table, $data );
                    }
                }
                update_option( 'st_upgrade_order', 1 );
            }

            public function _deleteTable()
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                $wpdb->query( "DROP TABLE {$table}" );
            }

            public function _getOldData()
            {
                global $wpdb;

                $sql     = "SELECT ID, meta_key, meta_value
			FROM {$wpdb->prefix}posts, {$wpdb->prefix}postmeta
			WHERE {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id
			AND post_type = 'st_order'
			AND (
			meta_key = 'st_booking_post_type'
			or meta_key = 'st_booking_id'
			or meta_key = 'check_in_timestamp'
			or meta_key = 'check_out_timestamp'
			or meta_key = 'check_in'
			or meta_key = 'check_out'
			or meta_key = 'duration'
			or meta_key = 'room_id'
			or meta_key = 'status'
			or meta_key = 'room_num_search'
			or meta_key = 'room_id'
			or meta_key = 'adult_number'
			or meta_key = 'child_number'
			or meta_key = 'infant_number'
			or meta_key = 'discount'
			or meta_key = 'user_id'
			or meta_key = 'commission'
			)
			ORDER BY ID";
                $results = $wpdb->get_results( $sql );
                $list    = [];
                if ( is_array( $results ) && count( $results ) ) {
                    foreach ( $results as $val ) {
                        $list[ $val->ID ][ $val->meta_key ] = $val->meta_value;
                    }
                }

                return $list;
            }

            public function _getOldDataWoo()
            {
                global $wpdb;
                $list   = [];
                $table  = $wpdb->prefix . 'woocommerce_order_items';
                $table2 = $wpdb->prefix . 'woocommerce_order_itemmeta';
                if ( ( $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) != $table ) || ( $wpdb->get_var( "SHOW TABLES LIKE '$table2'" ) != $table2 ) ) {
                    return $list;
                }
                $sql = "SELECT 
			{$wpdb->prefix}woocommerce_order_items.order_item_id, {$wpdb->prefix}woocommerce_order_items.order_id,  {$wpdb->prefix}woocommerce_order_itemmeta.meta_key, {$wpdb->prefix}woocommerce_order_itemmeta.meta_value
			FROM {$wpdb->prefix}woocommerce_order_items, {$wpdb->prefix}woocommerce_order_itemmeta
			WHERE {$wpdb->prefix}woocommerce_order_items.order_item_id = {$wpdb->prefix}woocommerce_order_itemmeta.order_item_id
			AND order_item_type = 'line_item' 
			AND(
			{$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_adult_number'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_child_number'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_infant_number'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_discount'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_duration'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_check_in'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_check_out'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_st_booking_post_type'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_st_booking_id'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_user_id'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_check_in_timestamp'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_check_out_timestamp'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_room_num_search'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_room_id'
			or {$wpdb->prefix}woocommerce_order_itemmeta.meta_key = '_st_commission'
			)
			ORDER BY {$wpdb->prefix}woocommerce_order_items.order_item_id";

                $results = $wpdb->get_results( $sql );
                if ( is_array( $results ) && count( $results ) ) {
                    foreach ( $results as $val ) {
                        $list[ $val->order_item_id ][ 'order_id' ]     = $val->order_id;
                        $list[ $val->order_item_id ][ $val->meta_key ] = $val->meta_value;
                    }
                }

                return $list;
            }
        }

        new NewOrderData();
    }
?>