<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'HotelHelper' ) ) {
        class HotelHelper
        {
            protected static $priceData = [];

            public function init()
            {
                global $wpdb;
                add_action( 'wp_ajax_st_get_disable_date_hotel', [ __CLASS__, '_get_disable_date' ] );
                add_action( 'wp_ajax_nopriv_st_get_disable_date_hotel', [ __CLASS__, '_get_disable_date' ] );

                add_action( 'wp_ajax_st_get_availability_hotel_room', [ &$this, '_get_availability_hotel_room' ] );
                add_action( 'wp_ajax_nopriv_st_get_availability_hotel_room', [ &$this, '_get_availability_hotel_room' ] );

                //Get real price extra service
                add_action( 'wp_ajax_st_format_real_price', [ &$this, '_format_real_price' ] );
                add_action( 'wp_ajax_nopriv_st_format_real_price', [ &$this, '_format_real_price' ] );
            }

            public function _format_real_price()
            {
                $post_id     = STInput::request( 'post_id', '' );
                $room_origin = TravelHelper::post_origin( $post_id, 'hotel_room' );
                $number_room = STInput::request( 'number_room', '' );
                $check_in    = STInput::request( 'check_in', '' );
                $check_out   = STInput::request( 'check_out', '' );
                $total_extra = STInput::request( 'total_extra', '' );

                $check_in  = TravelHelper::convertDateFormat( $check_in );
                $check_out = TravelHelper::convertDateFormat( $check_out );

                $checkin_ymd  = date( 'Y-m-d', strtotime( $check_in ) );
                $checkout_ymd = date( 'Y-m-d', strtotime( $check_out ) );

                $message = '';

                $status = true;

                //Only check in available
                if ( !self::check_day_cant_order( $room_origin, $checkin_ymd, $checkout_ymd, $number_room ) ) {
                    $message = sprintf( __( 'This room is not available from %s to %s.', ST_TEXTDOMAIN ), $checkin_ymd, $checkout_ymd );
                    $status  = false;
                }

                if ( strtotime( $check_out ) - strtotime( $check_in ) <= 0 ) {
                    $message = __( 'The check-out is later than the check-in.', ST_TEXTDOMAIN );
                    $status  = false;
                }

                //Check cant order
                if ( !HotelHelper::_check_room_only_available( $room_origin, $checkin_ymd, $checkout_ymd, $number_room ) ) {
                    $message = __( 'This room is not available.', ST_TEXTDOMAIN );
                    $status  = false;
                }

                $numberday    = STDate::dateDiff( $check_in, $check_out );
                $origin_price = STPrice::getRoomPriceOnlyCustomPrice( $room_origin, strtotime( $check_in ), strtotime( $check_out ), $number_room );
                $sale_price   = STPrice::getRoomPrice( $room_origin, strtotime( $check_in ), strtotime( $check_out ), $number_room );

                $alert_numday = sprintf( __( 'per %d Night(s)', ST_TEXTDOMAIN ), 1 );
                if ( $numberday > 0 ) {
                    $alert_numday = sprintf( __( 'per %d Night(s)', ST_TEXTDOMAIN ), $numberday );
                }

                $extra_price_type = get_post_meta( $post_id, 'extra_price_unit', true );

                $origin_price_result = TravelHelper::format_money( (float)$origin_price + (float)$total_extra * (int)$number_room * (int)$numberday );
                $sale_price_result   = TravelHelper::format_money( (float)$sale_price + (float)$total_extra * (int)$number_room * (int)$numberday );

                if ( $extra_price_type == 'fixed' ) {
                    $origin_price_result = TravelHelper::format_money( $origin_price + $total_extra * $number_room );
                    $sale_price_result   = TravelHelper::format_money( $sale_price + $total_extra * $number_room );
                }
                $data_result = [
                    'status'    => $status,
                    'origin'    => $origin_price_result,
                    'sale'      => $sale_price_result,
                    'message'   => $message,
                    'numberday' => $alert_numday
                ];
                wp_send_json( $data_result );
            }

            static function _get_max_number_room( $hotel_id )
            {
                global $wpdb;

                $sql = "SELECT 
				MAX(mt.number) as max_room
				FROM {$wpdb->prefix}st_room_availability
				WHERE 
				AND parent_id =%d
				LIMIT 1
				";

                $sql = "SELECT 
				MAX(mt.meta_value) as max_room
				FROM {$wpdb->prefix}posts
				INNER JOIN {$wpdb->prefix}postmeta as mt ON mt.post_id = {$wpdb->prefix}posts.ID and mt.meta_key = 'number_room'
				INNER JOIN {$wpdb->prefix}postmeta as mt1 ON mt1.post_id = {$wpdb->prefix}posts.ID and mt1.meta_key = 'room_parent'
				WHERE
				mt1.meta_value = '{$hotel_id}'
				AND post_type = 'hotel_room'";

                $result = $wpdb->get_row( $sql, ARRAY_A );

                if ( is_array( $result ) && count( $result ) )
                    return intval( $result[ 'max_room' ] );
                else return 0;
            }

            static function get_all_room_cant_book( $check_in = '', $check_out = '', $adult_number = '', $children_number = '', $number_room = 0 )
            {
                global $wpdb;

                $list = [];
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return "''";

                if ( empty( $check_in ) || empty( $check_out ) )
                    return "''";

                $sql     = "
					SELECT
						st_booking_id,
						room_id,
						mt.meta_value AS number_room,
						SUM(DISTINCT room_num_search) AS booked_room,
						mt.meta_value - SUM(DISTINCT room_num_search) AS free_room,
						check_in,
						check_out,
					mt1.allow_full_day
					FROM
						{$wpdb->prefix}st_order_item_meta
					INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}st_order_item_meta.room_id
					INNER JOIN {$wpdb->prefix}postmeta AS mt ON mt.post_id = {$wpdb->prefix}st_order_item_meta.room_id
					AND mt.meta_key = 'number_room'
					INNER JOIN {$wpdb->prefix}st_hotel AS mt1 ON mt1.post_id = {$wpdb->prefix}st_order_item_meta.st_booking_id
					WHERE
						(
							(
								(
									mt1.allow_full_day = 'on'
									OR mt1.allow_full_day = ''
								)
								AND (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
								)
							)
							OR (
								mt1.allow_full_day = 'off'
								AND (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') <= STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') >= STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										(
											STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
											AND STR_TO_DATE(check_out, '%m/%d/%Y')
										)
										AND (
											STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_out, '%m/%d/%Y')
										)
									)
									OR (
										(
											STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
											AND STR_TO_DATE(check_out, '%m/%d/%Y')
										)
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_in, '%m/%d/%Y')
									)
								)
							)
						)
					AND st_booking_post_type = 'st_hotel'
					AND STATUS NOT IN ('trash', 'canceled')
					GROUP BY
						room_id
					HAVING
						number_room - SUM(DISTINCT room_num_search) < {$number_room}
				";
                $results = $wpdb->get_results( $sql, ARRAY_A );

                if ( is_array( $results ) && count( $results ) ) {
                    $list = [];
                    foreach ( $results as $key => $val ) {
                        $list[] = $val[ 'room_id' ];
                    }
                } else {
                    $list = "''";
                }
                $list = self::get_all_hotel_can_order( $list, $adult_number, $children_number, $number_room );

                return $list;
            }

            static function get_all_hotel_can_order( $list_room, $adult_number = '', $children_number = '', $number_room = 0 )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return "''";
                global $wpdb;
                $list = [];

                if ( is_array( $list_room ) && count( $list_room ) )
                    $list_room = implode( ',', $list_room );
                else $list_room = "''";

                $sql     = "
					SELECT DISTINCT SQL_CALC_FOUND_ROWS CAST(mt.meta_value AS UNSIGNED) as hotel_id, ID as room_id FROM {$wpdb->prefix}posts 
					INNER JOIN {$wpdb->prefix}postmeta as mt ON mt.post_id = {$wpdb->prefix}posts.ID AND mt.meta_key = 'room_parent'
					INNER JOIN {$wpdb->prefix}postmeta as mt1 ON mt1.post_id = {$wpdb->prefix}posts.ID AND mt1.meta_key = 'adult_number'
					INNER JOIN {$wpdb->prefix}postmeta as mt2 ON mt2.post_id = {$wpdb->prefix}posts.ID AND mt2.meta_key = 'children_number'
					INNER JOIN {$wpdb->prefix}postmeta as mt3 ON mt3.post_id = {$wpdb->prefix}posts.ID AND mt3.meta_key = 'number_room'
					WHERE post_type = 'hotel_room'
					AND {$wpdb->posts}.ID NOT IN ({$list_room})
					AND CAST(mt1.meta_value AS UNSIGNED) >= {$adult_number}
					AND CAST(mt2.meta_value AS UNSIGNED) >= {$children_number}
					AND CAST(mt3.meta_value AS UNSIGNED) >= {$number_room}
					GROUP BY hotel_id
					ORDER BY mt.meta_value ASC
				";
                $results = $wpdb->get_results( $sql, ARRAY_A );
                if ( false === $results || !is_array( $results ) || count( $results ) <= 0 ) {
                    return "''";
                }
                foreach ( $results as $key => $val ) {
                    $list[] = $val[ 'hotel_id' ];
                }

                return $list;
            }

            static function _get_room_cant_book_by_id( $hotel_id = '', $check_in = '', $check_out = '', $number_room = 0 )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return "''";
                global $wpdb;

                if ( empty( $check_in ) || empty( $check_out ) )
                    return "''";
                $sql     = "
					SELECT
						st_booking_id,
						room_id,
						mt.meta_value AS number_room,
						SUM(DISTINCT room_num_search) AS booked_room,
						mt.meta_value - SUM(DISTINCT room_num_search) AS free_room,
						check_in,
						check_out
					FROM
						{$wpdb->prefix}st_order_item_meta
					INNER JOIN {$wpdb->prefix}postmeta AS mt ON mt.post_id = {$wpdb->prefix}st_order_item_meta.room_id
					AND mt.meta_key = 'number_room'
					INNER JOIN {$wpdb->prefix}st_hotel AS mt1 ON mt1.post_id = {$wpdb->prefix}st_order_item_meta.st_booking_id
					WHERE
					(
							(
								(
									mt1.allow_full_day = 'on'
									OR mt1.allow_full_day = ''
								)
								AND (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
								)
							)
							OR (
								mt1.allow_full_day = 'off'
								AND (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') <= STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') >= STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										(
											STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
											AND STR_TO_DATE(check_out, '%m/%d/%Y')
										)
										AND (
											STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_out, '%m/%d/%Y')
										)
									)
									OR (
										(
											STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
											AND STR_TO_DATE(check_out, '%m/%d/%Y')
										)
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_in, '%m/%d/%Y')
									)
								)
							)
						)
					AND st_booking_post_type = 'st_hotel'
					AND st_booking_id = '{$hotel_id}'
					AND status NOT IN ('trash', 'canceled')
					GROUP BY
						room_id
					HAVING
						number_room - SUM(DISTINCT room_num_search) < {$number_room}
				";
                $results = $wpdb->get_col( $sql, 1 );

                return $results;
            }

            static function _get_room_can_book_by_id( $list_room, $hotel_id = '', $adult_number = '', $children_number = '', $number_room = 0 )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return "''";
                global $wpdb;

                $list = [];

                if ( is_array( $list_room ) && count( $list_room ) )
                    $list_room = implode( ',', $list_room );
                else $list_room = "''";

                $join = $where = '';
                if ( $children_number ) {
                    $join  .= " INNER JOIN {$wpdb->prefix}postmeta as mt2 ON mt2.post_id = {$wpdb->prefix}posts.ID AND mt2.meta_key = 'children_number' ";
                    $where .= " AND CAST(mt2.meta_value AS UNSIGNED) >= {$children_number} ";
                }

                $sql = "
				SELECT DISTINCT SQL_CALC_FOUND_ROWS ID as room_id FROM {$wpdb->prefix}posts 
				INNER JOIN {$wpdb->prefix}postmeta as mt ON mt.post_id = {$wpdb->prefix}posts.ID AND mt.meta_key = 'room_parent'
				INNER JOIN {$wpdb->prefix}postmeta as mt1 ON mt1.post_id = {$wpdb->prefix}posts.ID AND mt1.meta_key = 'adult_number'
				INNER JOIN {$wpdb->prefix}postmeta as mt3 ON mt3.post_id = {$wpdb->prefix}posts.ID AND mt3.meta_key = 'number_room'
				  {$join}
				WHERE post_type = 'hotel_room'
				AND {$wpdb->posts}.ID NOT IN ({$list_room})
				AND mt.meta_value = '{$hotel_id}'
				AND CAST(mt1.meta_value AS UNSIGNED) >= {$adult_number}
				AND CAST(mt3.meta_value AS UNSIGNED) >= {$number_room}
				  {$where}
				GROUP BY ID
				ORDER BY mt.meta_value ASC";

                $results = $wpdb->get_results( $sql, ARRAY_A );
                if ( false === $results || !is_array( $results ) || count( $results ) <= 0 ) {
                    return "''";
                }
                foreach ( $results as $key => $val ) {
                    $list[] = $val[ 'room_id' ];
                }

                return $list;
            }

            static function _check_room_only_available( $room_id = '', $check_in = '', $check_out = '', $number_r = 0, $order_item_id = '' )
            {
                $hotel_id = intval( get_post_meta( $room_id, 'room_parent', true ) );

                if ( empty( $hotel_id ) )
                    $hotel_id = $room_id;

                $allow_full_day = get_post_meta( $hotel_id, 'allow_full_day', true );
                if ( !$allow_full_day || $allow_full_day == '' ) $allow_full_day = 'on';

                $result                  = HotelHelper::_get_full_ordered_new( $room_id, strtotime( $check_in ), strtotime( $check_out ) );
                $number_room             = get_post_meta( $room_id, 'number_room', true );
                $list_date               = [];
                $list_date_fist_half_day = [];
                $list_date_last_half_day = [];
                if ( is_array( $result ) && count( $result ) ) {
                    $disable             = [];
                    $array_fist_half_day = [];
                    $array_last_half_day = [];
                    for ( $i = intval( strtotime( $check_in ) ); $i <= intval( strtotime( $check_out ) ); $i = strtotime( '+1 day', $i ) ) {
                        $num_room           = 0;
                        $num_first_half_day = 0;
                        $num_last_half_day  = 0;
                        foreach ( $result as $key => $date ) {
                            if ( $allow_full_day == 'on' ) {
                                if ( $i >= intval( $date[ 'check_in_timestamp' ] ) && $i <= intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }
                            } else {
                                if ( $i > intval( $date[ 'check_in_timestamp' ] ) && $i < intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }
                                if ( $i == intval( $date[ 'check_in_timestamp' ] ) ) {
                                    $num_first_half_day += $date[ 'number_room' ];
                                }
                                if ( $i == intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_last_half_day += $date[ 'number_room' ];
                                }
                            }
                        }
                        $disable[ $i ]             = $num_room;
                        $array_fist_half_day[ $i ] = $num_first_half_day;
                        $array_last_half_day[ $i ] = $num_last_half_day;
                    }
                    if ( count( $disable ) ) {
                        foreach ( $disable as $key => $num_room ) {
                            if ( intval( $num_room + $number_r ) > $number_room )
                                $list_date[] = date( 'd_m_Y', $key );
                        }
                    }
                    if ( count( $array_fist_half_day ) ) {
                        foreach ( $array_fist_half_day as $key => $num_room ) {
                            if ( intval( $num_room + $number_r ) > $number_room )
                                $list_date_fist_half_day[] = date( 'd_m_Y', $key );

                        }
                    }

                    if ( count( $array_last_half_day ) ) {
                        foreach ( $array_last_half_day as $key => $num_room ) {
                            if ( intval( $num_room + $number_r ) > $number_room )
                                $list_date_last_half_day[] = date( 'd_m_Y', $key );
                        }
                    }

                    if ( ( is_array( $list_date ) and count( $list_date ) ) or ( ( is_array( $list_date_fist_half_day ) and count( $list_date_fist_half_day ) ) and ( is_array( $list_date_last_half_day ) and count( $list_date_last_half_day ) ) ) ) {
                        return false;
                    }
                }

                return true;
            }

            static function _check_room_available( $room_id = '', $check_in = '', $check_out = '', $number_room = 0 )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return true;
                global $wpdb;
                $sql = "
				SELECT
					room_id,
					mt.number_room AS number_room,
					mt.number_room - SUM(room_num_search) AS free_room
				FROM
					{$wpdb->prefix}st_order_item_meta
				INNER JOIN {$wpdb->prefix}hotel_room AS mt ON mt.post_id = {$wpdb->prefix}st_order_item_meta.room_origin
				INNER JOIN {$wpdb->prefix}st_hotel AS mt1 ON mt1.post_id = {$wpdb->prefix}st_order_item_meta.room_origin
				WHERE
				(
						(
							(
								mt1.allow_full_day = 'on'
								OR mt1.allow_full_day = ''
							)
							AND (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									OR (
										STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
							)
						)
						OR (
							mt1.allow_full_day = 'off'
							AND (
								(
									STR_TO_DATE('{$check_in}', '%Y-%m-%d') <= STR_TO_DATE(check_in, '%m/%d/%Y')
									AND STR_TO_DATE('{$check_in}', '%Y-%m-%d') >= STR_TO_DATE(check_out, '%m/%d/%Y')
								)
								OR (
									(
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									AND (
										STR_TO_DATE('{$check_in}', '%Y-%m-%d') < STR_TO_DATE(check_out, '%m/%d/%Y')
									)
								)
								OR (
									(
										STR_TO_DATE('{$check_out}', '%Y-%m-%d') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
										AND STR_TO_DATE(check_out, '%m/%d/%Y')
									)
									AND STR_TO_DATE('{$check_out}', '%Y-%m-%d') > STR_TO_DATE(check_in, '%m/%d/%Y')
								)
							)
						)
					)
				AND room_origin = '{$room_id}'
				AND status NOT IN ('trash', 'canceled')
			
				GROUP BY
					room_origin
				HAVING
					number_room - SUM(room_num_search) < {$number_room}";

                $results = $wpdb->get_row( $sql, ARRAY_A );
                if ( $results == null || !is_array( $results ) || count( $results ) <= 0 )
                    return true;

                return false;
            }

            static function check_day_cant_order( $room_id, $check_in, $check_out, $number_room )
            {
                global $wpdb;

                $default_state = get_post_meta( $room_id, 'default_state', true );
                $room          = intval( get_post_meta( $room_id, 'number_room', true ) );
                if ( !$default_state ) $default_state = 'available';

                $check_in  = strtotime( $check_in );
                $check_out = strtotime( $check_out );

                $sql = "
				SELECT
					`check_in`,
					`check_out`,
					`number`,
					`status`,
					DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
				FROM
					{$wpdb->prefix}st_room_availability
				WHERE
					(
						(
							{$check_in} <= CAST(check_in as UNSIGNED)
							AND {$check_out} >= CAST(check_out as UNSIGNED)
						)
						OR (
							{$check_in} BETWEEN CAST(check_in AS UNSIGNED)
							AND CAST(check_out as UNSIGNED)
						)
						OR (
							{$check_out} BETWEEN CAST(check_in AS UNSIGNED)
							AND CAST( check_out AS UNSIGNED )
						)
					)
				AND post_id = '{$room_id}'";

                $results = $wpdb->get_results( $sql );

                $price = STPrice::getRoomPriceOnlyCustomPrice( $room_id, $check_in, $check_out, 1 );
                if ( $price <= 0 ) {
                    return false;
                }
                if ( is_array( $results ) && count( $results ) ) {
                    for ( $i = $check_in; $i <= $check_out; $i = strtotime( '+1 day', $i ) ) {
                        $in_date = false;
                        $status  = 'available';
                        foreach ( $results as $key => $val ) {
                            if ( $i >= $val->check_in && $i <= $val->check_out ) {
                                $status  = $val->status;
                                $in_date = true;
                            }
                        }
                        if ( $in_date ) {
                            if ( $status != 'available' || $room < $number_room ) {
                                return false;
                            }
                        } else {
                            if ( $default_state != 'available' || $room < $number_room ) {
                                return false;
                            }
                        }
                    }

                    return true;
                } else {
                    return false;
                }
            }

            static function _get_full_ordered_new( $room_id, $start, $end )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return '';

                $hotel_id = intval( get_post_meta( $room_id, 'room_parent', true ) );
                if ( !empty( $hotel_id ) ) {
                    $key_post_type = "st_hotel";
                } else {
                    $key_post_type = "hotel_room";
                }

                global $wpdb;
                $sql    = "
				SELECT  
				room_origin,
				check_in_timestamp,
				check_out_timestamp,
				room_num_search as number_room
				FROM {$wpdb->prefix}st_order_item_meta
				WHERE room_origin = '{$room_id}'
				AND st_booking_post_type = '{$key_post_type}'
				AND check_in_timestamp >= {$start}
				AND check_out_timestamp <= {$end}
				AND `status` NOT IN ('trash', 'canceled')";
                $result = $wpdb->get_results( $sql, ARRAY_A );
                if ( is_array( $result ) && count( $result ) ) {
                    return $result;
                }

                return '';
            }

            static function _get_full_ordered( $room_id, $month, $month2, $year, $year2 )
            {
                $date1 = $month . '/' . '01' . '/' . $year;
                $date2 = strtotime( $year2 . '-' . $month2 . '-01' );
                $date2 = date( 'm/t/Y', $date2 );
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return '';

                $hotel_id = intval( get_post_meta( $room_id, 'room_parent', true ) );
                if ( !empty( $hotel_id ) ) {
                    $key_post_type = "st_hotel";
                } else {
                    $key_post_type = "hotel_room";
                }

                global $wpdb;
                $sql    = "
				SELECT  
				room_origin,
				check_in_timestamp,
				check_out_timestamp,
				room_num_search as number_room
				FROM {$wpdb->prefix}st_order_item_meta
				WHERE room_origin = '{$room_id}'
				AND st_booking_post_type = '{$key_post_type}'
				AND (
					(
						STR_TO_DATE('{$date1}', '%m/%d/%Y') < STR_TO_DATE(check_in, '%m/%d/%Y')
						AND STR_TO_DATE('{$date2}', '%m/%d/%Y') > STR_TO_DATE(check_out, '%m/%d/%Y')
					)
					OR (
						STR_TO_DATE('{$date1}', '%m/%d/%Y') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
						AND STR_TO_DATE(check_out, '%m/%d/%Y')
					)
					OR (
						STR_TO_DATE('{$date2}', '%m/%d/%Y') BETWEEN STR_TO_DATE(check_in, '%m/%d/%Y')
						AND STR_TO_DATE(check_out, '%m/%d/%Y')
					)
				)
				AND `status` NOT IN ('trash', 'canceled')";
                $result = $wpdb->get_results( $sql, ARRAY_A );
                if ( is_array( $result ) && count( $result ) ) {
                    return $result;
                }

                return '';
            }

            static function _get_min_max_date_ordered_new( $room_id, $start, $end )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return '';
                global $wpdb;
                $hotel_id = intval( get_post_meta( $room_id, 'room_parent', true ) );
                if ( !empty( $hotel_id ) ) {
                    $key_post_type = "st_hotel";
                } else {
                    $key_post_type = "hotel_room";
                }
                $sql = "SELECT 
				MIN(check_in_timestamp) as min_date,
				MAX(check_out_timestamp) as max_date
				FROM {$wpdb->prefix}st_order_item_meta
				WHERE room_origin = '{$room_id}'
				AND st_booking_post_type = '{$key_post_type}'
				AND check_in_timestamp >= {$start}
				AND check_out_timestamp <= {$end}
				AND status NOT IN ('trash', 'canceled')";

                $result = $wpdb->get_row( $sql, ARRAY_A );

                if ( is_array( $result ) && count( $result ) )
                    return $result;

                return '';
            }

            static function _get_min_max_date_ordered( $room_id, $year, $year2 )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) return '';
                global $wpdb;
                $hotel_id = intval( get_post_meta( $room_id, 'room_parent', true ) );
                if ( !empty( $hotel_id ) ) {
                    $key_post_type = "st_hotel";
                } else {
                    $key_post_type = "hotel_room";
                }
                $sql = "SELECT 
				MIN(check_in_timestamp) as min_date,
				MAX(check_out_timestamp) as max_date
				FROM {$wpdb->prefix}st_order_item_meta
				WHERE room_origin = '{$room_id}'
				AND st_booking_post_type = '{$key_post_type}'
				AND (YEAR(FROM_UNIXTIME(check_in_timestamp)) = {$year}
				OR YEAR(FROM_UNIXTIME(check_out_timestamp)) = {$year2})
				AND status NOT IN ('trash', 'canceled')";

                $result = $wpdb->get_row( $sql, ARRAY_A );

                if ( is_array( $result ) && count( $result ) )
                    return $result;

                return '';
            }

            static function _get_disable_date()
            {
                $list_date               = [];
                $list_date_fist_half_day = [];
                $list_date_last_half_day = [];
                if ( !TravelHelper::checkTableDuplicate( 'st_hotel' ) ) {
                    echo json_encode( $list_date );
                    die();
                }
                $room_id     = STInput::request( 'room_id' );
                $room_origin = TravelHelper::post_origin( $room_id );

                $hotel_id = intval( get_post_meta( $room_origin, 'room_parent', true ) );

                if ( empty( $hotel_id ) )
                    $hotel_id = $room_origin;

                $allow_full_day = get_post_meta( $hotel_id, 'allow_full_day', true );
                if ( !$allow_full_day || $allow_full_day == '' ) $allow_full_day = 'on';
                $year = STInput::request( 'year' );
                if ( empty( $year ) ) $year = date( 'Y' );

                $month = STInput::request( 'month' );
                if ( empty( $month ) ) $month = date( 'm' );

                $year1  = $year;
                $month1 = $month - 1;
                if ( $month == 1 ) {
                    $month1 = 12;
                    $year1  -= 1;
                }

                $year2  = $year;
                $month2 = $month + 1;
                if ( $month == 12 ) {
                    $month2 = 1;
                    $year2  += 1;
                }

                $month  = sprintf( "%02d", $month );
                $month2 = sprintf( "%02d", $month2 );

                $startDate = new DateTime( $year1 . '-' . $month1 . '-25' );
                $endDate   = new DateTime( $year2 . '-' . $month2 . '-15' );

                $result      = HotelHelper::_get_full_ordered_new( $room_origin, $startDate->getTimestamp(), $endDate->getTimestamp() );
                $number_room = get_post_meta( $room_origin, 'number_room', true );
                $min_max     = HotelHelper::_get_min_max_date_ordered_new( $room_origin, $startDate->getTimestamp(), $endDate->getTimestamp() );
                if ( is_array( $min_max ) && count( $min_max ) && is_array( $result ) && count( $result ) ) {
                    $disable             = [];
                    $array_fist_half_day = [];
                    $array_last_half_day = [];
                    for ( $i = intval( $min_max[ 'min_date' ] ); $i <= intval( $min_max[ 'max_date' ] ); $i = strtotime( '+1 day', $i ) ) {
                        $num_room           = 0;
                        $num_first_half_day = 0;
                        $num_last_half_day  = 0;
                        foreach ( $result as $key => $date ) {
                            if ( $allow_full_day == 'on' ) {
                                if ( $i >= intval( $date[ 'check_in_timestamp' ] ) && $i <= intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }
                            } else {
                                if ( $i > intval( $date[ 'check_in_timestamp' ] ) && $i < intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }
                                if ( $i == intval( $date[ 'check_in_timestamp' ] ) ) {
                                    $num_first_half_day += $date[ 'number_room' ];
                                }
                                if ( $i == intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_last_half_day += $date[ 'number_room' ];
                                }
                            }
                        }
                        $disable[ $i ]             = $num_room;
                        $array_fist_half_day[ $i ] = $num_first_half_day;
                        $array_last_half_day[ $i ] = $num_last_half_day;
                    }
                    if ( count( $disable ) ) {
                        foreach ( $disable as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date[] = date( 'd_m_Y', $key );
                        }
                    }
                    if ( count( $array_fist_half_day ) ) {
                        foreach ( $array_fist_half_day as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date_fist_half_day[] = date( 'd_m_Y', $key );

                        }
                    }
                    if ( count( $array_last_half_day ) ) {
                        foreach ( $array_last_half_day as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date_last_half_day[] = date( 'd_m_Y', $key );
                        }
                    }
                }
                $list_date_2 = AvailabilityHelper::_getDisableCustomDate( $room_origin, $month, $month2, $year, $year2, 'd_m_Y' );
                if ( is_array( $list_date_2 ) && count( $list_date_2 ) ) {
                    $list_date = array_merge( $list_date, $list_date_2 );
                }
                if ( !empty( $list_date_fist_half_day ) and !empty( $list_date_last_half_day ) ) {
                    foreach ( $list_date_fist_half_day as $k => $v ) {
                        foreach ( $list_date_last_half_day as $k2 => $v2 ) {
                            if ( $v == $v2 ) {
                                $list_date[] = $v;
                                unset( $list_date_fist_half_day[ $k ] );
                                unset( $list_date_last_half_day[ $k2 ] );
                            }
                        }

                    }
                }

                $data = [
                    'disable'       => $list_date,
                    'last_half_day' => $list_date_last_half_day,
                    'fist_half_day' => $list_date_fist_half_day,
                ];
                echo json_encode( $data );
                die();
            }

            public function _get_availability_hotel_room()
            {
                check_ajax_referer( 'st_frontend_security', 'security' );
                $events[ 'events' ] = [];
                $list_date          = [];
                $room_id            = STInput::request( 'post_id', '' );
                $check_in           = STInput::request( 'start', '' );
                $check_out          = STInput::request( 'end', '' );
                $room_origin        = TravelHelper::post_origin( $room_id );
                $hotel_id           = intval( get_post_meta( $room_origin, 'room_parent', true ) );

                $discount_type = get_post_meta( $room_id, 'discount_type_no_day', true );
                $discount      = get_post_meta( $room_id, 'discount_rate', true );

                if ( empty( $hotel_id ) ) {
                    $hotel_id = $room_id;
                }

                $allow_full_day = get_post_meta( $hotel_id, 'allow_full_day', true );
                if ( !$allow_full_day || $allow_full_day == '' ) $allow_full_day = 'on';

                $year = date( 'Y', strtotime($check_in) );
                if ( empty( $year ) ) $year = date( 'Y' );
                $year2 = date( 'Y', strtotime($check_out) );
                if ( empty( $year2 ) ) $year2 = date( 'Y' );

                $month = date( 'm', strtotime($check_in) );
                if ( empty( $month ) ) $month = date( 'm' );

                $month2 = date( 'm', strtotime($check_in) );
                if ( empty( $month2 ) ) $month2 = date( 'm' );


                //$result = HotelHelper::_get_full_ordered( $room_origin, $month, $month2, $year, $year2 );
                $result = HotelHelper::_get_full_ordered_new( $room_origin, strtotime($check_in), strtotime($check_out) );

                $number_room = get_post_meta( $room_id, 'number_room', true );
                //$min_max     = HotelHelper::_get_min_max_date_ordered( $room_origin, $year, $year2 );
                $min_max = HotelHelper::_get_min_max_date_ordered_new( $room_origin, strtotime($check_in), strtotime($check_out)  );

                $list_date_fist_half_day = [];
                $list_date_last_half_day = [];
                $array_fist_half_day     = [];
                $array_last_half_day     = [];

                if ( is_array( $min_max ) && count( $min_max ) && is_array( $result ) && count( $result ) ) {
                    $disable = [];
                    for ( $i = intval( $min_max[ 'min_date' ] ); $i <= intval( $min_max[ 'max_date' ] ); $i = strtotime( '+1 day', $i ) ) {
                        $num_room                = 0;
                        $num_room_first_half_day = 0;
                        $num_room_last_half_day  = 0;
                        foreach ( $result as $key => $date ) {
                            if ( $allow_full_day == 'on' ) {
                                if ( $i >= intval( $date[ 'check_in_timestamp' ] ) && $i <= intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }
                            } else {
                                if ( $i > intval( $date[ 'check_in_timestamp' ] ) && $i < intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room += $date[ 'number_room' ];
                                }

                                if ( $i == intval( $date[ 'check_in_timestamp' ] ) ) {
                                    $num_room_first_half_day += $date[ 'number_room' ];
                                }
                                if ( $i == intval( $date[ 'check_out_timestamp' ] ) ) {
                                    $num_room_last_half_day += $date[ 'number_room' ];
                                }
                            }
                        }
                        $disable[ $i ]             = $num_room;
                        $array_fist_half_day[ $i ] = $num_room_first_half_day;
                        $array_last_half_day[ $i ] = $num_room_last_half_day;
                    }
                    if ( count( $disable ) ) {
                        foreach ( $disable as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date[] = date( TravelHelper::getDateFormat(), $key );
                        }
                    }

                    if ( count( $array_fist_half_day ) ) {
                        foreach ( $array_fist_half_day as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date_fist_half_day[] = date( TravelHelper::getDateFormat(), $key );
                        }
                    }
                    if ( count( $array_last_half_day ) ) {
                        foreach ( $array_last_half_day as $key => $num_room ) {
                            if ( intval( $num_room ) >= $number_room )
                                $list_date_last_half_day[] = date( TravelHelper::getDateFormat(), $key );
                        }
                    }
                }

                $list_date_2 = AvailabilityHelper::_getDisableCustomDate( $room_origin, $month, $month2, $year, $year2 );

                $date1  = strtotime( $year . '-' . $month . '-01' );
                $date2  = strtotime( $year2 . '-' . $month2 . '-01' );
                $date2  = strtotime( date( 'Y-m-t', $date2 ) );
                $today  = strtotime( date( 'Y-m-d' ) );
                $return = [];

                $booking_period = intval( get_post_meta( $hotel_id, 'hotel_booking_period', true ) );

                $room_available  = ST_Hotel_Room_Availability::inst()
                    ->where( 'check_in >=', strtotime($check_in) )
                    ->where( 'check_out <=', strtotime($check_out) )
                    ->where( 'post_id', $room_origin )
                    ->where( 'status', 'available' )
                    ->get()->result();
                $data_price_room = [];
                if ( !empty( $room_available ) ) {
                    foreach ( $room_available as $kk => $vv ) {
                        $data_price_room[ $vv[ 'check_in' ] ] = st_apply_discount( $vv[ 'price' ], $discount_type, $discount );
                    }
                }

                for ( $i = $date1; $i <= $date2; $i = strtotime( '+1 day', $i ) ) {
                    $period = STDate::dateDiff( date( 'Y-m-d', $today ), date( 'Y-m-d', $i ) );
                    $d      = date( TravelHelper::getDateFormat(), $i );
                    if ( in_array( $d, $list_date ) or ( in_array( $d, $list_date_fist_half_day ) and in_array( $d, $list_date_last_half_day ) ) ) {
                        $return[]             = [
                            'start'  => date( 'Y-m-d', $i ),
                            'date'   => date( 'Y-m-d', $i ),
                            'day'    => date( 'd', $i ),
                            'status' => 'booked'
                        ];
                        $events[ 'events' ][] = [
                            'start'  => date( 'Y-m-d', $i ),
                            'end'    => date( 'Y-m-d', $i ),
                            'event'  => esc_html__( 'Booked', ST_TEXTDOMAIN ),
                            'status' => 'not_available'
                        ];
                    } else {
                        if ( $i < $today ) {
                            $events[ 'events' ][] = [
                                'start'  => date( 'Y-m-d', $i ),
                                'end'    => date( 'Y-m-d', $i ),
                                'event'  => esc_html__( 'Unavailable', ST_TEXTDOMAIN ),
                                'status' => 'not_available'
                            ];
                        } else {
                            if ( in_array( $d, $list_date_2 ) ) {
                                $events[ 'events' ][] = [
                                    'start'  => date( 'Y-m-d', $i ),
                                    'end'    => date( 'Y-m-d', $i ),
                                    'event'  => esc_html__( 'Unavailable', ST_TEXTDOMAIN ),
                                    'status' => 'not_available'
                                ];
                            } else {
                                if ( $period < $booking_period ) {
                                    $events[ 'events' ][] = [
                                        'start'  => date( 'Y-m-d', $i ),
                                        'end'    => date( 'Y-m-d', $i ),
                                        'event'  => esc_html__( 'Unavailable', ST_TEXTDOMAIN ),
                                        'status' => 'not_available'
                                    ];
                                } else if ( in_array( $d, $list_date_fist_half_day ) ) {
                                    $events[ 'events' ][] = [
                                        'start'  => date( 'Y-m-d', $i ),
                                        'end'    => date( 'Y-m-d', $i ),
                                        'event'  => ( isset( $data_price_room[ $i ] ) ? TravelHelper::format_money( $data_price_room[ $i ] ) : TravelHelper::format_money( 0 ) ),
                                        'status' => 'available'
                                    ];
                                } else if ( in_array( $d, $list_date_last_half_day ) ) {
                                    $events[ 'events' ][] = [
                                        'start'  => date( 'Y-m-d', $i ),
                                        'end'    => date( 'Y-m-d', $i ),
                                        'event'  => ( isset( $data_price_room[ $i ] ) ? TravelHelper::format_money( $data_price_room[ $i ] ) : TravelHelper::format_money( 0 ) ),
                                        'status' => 'available'
                                    ];
                                } else {
                                    $events[ 'events' ][] = [
                                        'start'  => date( 'Y-m-d', $i ),
                                        'end'    => date( 'Y-m-d', $i ),
                                        'event'  => ( isset( $data_price_room[ $i ] ) ? TravelHelper::format_money( $data_price_room[ $i ] ) : TravelHelper::format_money( 0 ) ),
                                        'status' => 'available'
                                    ];
                                }
                            }
                        }
                    }
                }

                echo json_encode( $events );
                die;
            }

            static function _getAllRoomHotelID( $hotel_id )
            {
                global $wpdb;
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $sql = "SELECT
						{$wpdb->prefix}posts.ID
					FROM
						{$wpdb->prefix}posts
					INNER JOIN {$wpdb->prefix}postmeta as mt on mt.post_id = {$wpdb->prefix}posts.ID and mt.meta_key = 'room_parent'
					JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
					AND t.element_type = 'post_hotel_room'
					JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
					AND l.active = 1
					where mt.meta_value = '{$hotel_id}'
					and post_type = 'hotel_room'
					and post_status = 'publish'
					AND t.language_code = '" . ICL_LANGUAGE_CODE . "'";
                } else {
                    $sql = "SELECT
						{$wpdb->prefix}posts.ID
					FROM
						{$wpdb->prefix}posts
					INNER JOIN {$wpdb->prefix}postmeta as mt on mt.post_id = {$wpdb->prefix}posts.ID and mt.meta_key = 'room_parent'
					where 
					mt.meta_value = '{$hotel_id}'
					and post_type = 'hotel_room'
					and post_status = 'publish'";
                }
                $rooms = $wpdb->get_col( $sql );

                return $rooms;
            }

            static function _getAllHotelID()
            {
                global $wpdb;
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $sql = "SELECT
						{$wpdb->prefix}posts.ID
					FROM
						{$wpdb->prefix}posts
					JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
					AND t.element_type = 'post_st_hotel'
					JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
					AND l.active = 1
					where post_type = 'st_hotel'
					and post_status = 'publish'
					AND t.language_code = '" . ICL_LANGUAGE_CODE . "'";
                } else {
                    $sql = "SELECT
						{$wpdb->prefix}posts.ID
					FROM
						{$wpdb->prefix}posts
					where 
					post_type = 'st_hotel'
					and post_status = 'publish'";
                }

                $results = $wpdb->get_col( $sql, 0 );

                return $results;
            }

            static function _getTotalRoom( $hotel_id )
            {
                global $wpdb;
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    $sql = "SELECT
						count({$wpdb->prefix}posts.ID) as num_room
					FROM
						{$wpdb->prefix}posts
					INNER JOIN {$wpdb->prefix}postmeta as mt on mt.post_id = {$wpdb->prefix}posts.ID and mt.meta_key = 'room_parent'
					JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
					AND t.element_type = 'post_hotel_room'
					JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
					AND l.active = 1

					where 
					mt.meta_value = '{$hotel_id}'
					and post_type = 'hotel_room'
					and post_status = 'publish'
					AND t.language_code = '" . ICL_LANGUAGE_CODE . "'";
                } else {
                    $sql = "SELECT
						count(ID) as num_room
					FROM
						{$wpdb->prefix}posts
					INNER JOIN {$wpdb->prefix}postmeta as mt on mt.post_id = {$wpdb->prefix}posts.ID and mt.meta_key = 'room_parent'
					where 
					mt.meta_value = '{$hotel_id}'
					and post_type = 'hotel_room'
					and post_status = 'publish'";
                }

                $results = $wpdb->get_var( $sql );

                return $results;
            }

            static function _hotelValidate( $check_in, $check_out, $adult_num, $child_num, $number_room )
            {
                $cant_book = [];
                $hotels    = HotelHelper::_getAllHotelID();
                if ( is_array( $hotels ) && count( $hotels ) ) {
                    foreach ( $hotels as $hotel ) {
                        $total_room           = HotelHelper::_getTotalRoom( $hotel );
                        $room_cant_book       = HotelHelper::_hotelValidateByID( $hotel, strtotime( $check_in ), strtotime( $check_out ), $adult_num, $child_num, $number_room );
                        $total_room_cant_book = count( $room_cant_book );
                        if ( $total_room <= $total_room_cant_book ) {
                            $cant_book[] = $hotel;
                        }
                    }
                }

                return $cant_book;
            }

            static function _hotelValidateByID( $hotel_id, $check_in, $check_out, $adult_num, $child_num, $number_room )
            {

                $cant_book = [];
                global $wpdb;
                $rooms = HotelHelper::_getAllRoomHotelID( $hotel_id );
                //Unique room
                //$rooms = array_unique($rooms);
                if ( is_array( $rooms ) && count( $rooms ) ) {
                    foreach ( $rooms as $room ) {
                        $default_state = get_post_meta( $room, 'default_state', true );
                        if ( !$default_state ) $default_state = 'available';

                        $number_room_ori = intval( get_post_meta( $room, 'number_room', true ) );
                        $room_price      = STPrice::getRoomPriceOnlyCustomPrice( $room, $check_in, $check_out, 1 );

                        if ( $room_price <= 0 ) {
                            $cant_book[] = $room;
                        } else {
                            $adult_number = intval( get_post_meta( $room, 'adult_number', true ) );
                            $child_number = intval( get_post_meta( $room, 'children_number', true ) );
                            if ( $adult_number < $adult_num || $child_number < $child_num ) { // overload people
                                $cant_book[] = $room;
                            } else {
                                $data_room = AvailabilityHelper::_getdataHotel( $room, $check_in, $check_out );

                                if ( is_array( $data_room ) && count( $data_room ) ) {
                                    $start = $check_in;
                                    $end   = $check_out;
                                    for ( $i = $start; $i <= $end; $i = strtotime( '+1 day', $i ) ) {
                                        $in_date  = false;
                                        $status   = 'available';
                                        $num_room = 0;
                                        foreach ( $data_room as $key => $val ) {
                                            if ( $i == $val->check_in && $i == $val->check_out ) { //in date
                                                $status = $val->status;
                                                if ( !$in_date ) $in_date = true;
                                            }
                                        }
                                        if ( $in_date ) {
                                            if ( $status != 'available' ) {
                                                $cant_book[] = $room;
                                                break;
                                            }
                                        } else {
                                            if ( $default_state == 'available' ) {
                                                if ( $number_room > $number_room_ori ) {
                                                    $cant_book[] = $room;
                                                    break;
                                                }
                                            } else {
                                                $cant_book[] = $room;
                                                break;
                                            }
                                        }
                                    }
                                } else { // dont have custom price

                                    if ( $default_state == 'available' ) {
                                        if ( $number_room > $number_room_ori ) {
                                            $cant_book[] = $room;
                                        }
                                    } else {
                                        $cant_book[] = $room;
                                    }
                                }
                            }
                        }
                    }
                }
                $room_full_ordered = HotelHelper::_get_room_cant_book_by_id( $hotel_id, date( 'Y-m-d', $check_in ), date( 'Y-m-d', $check_out ), $number_room );
                if ( is_array( $room_full_ordered ) && count( $room_full_ordered ) ) {
                    $cant_book = array_unique( array_merge( $cant_book, $room_full_ordered ) );
                }

                return $cant_book;
            }

            /**
             *
             *
             * Update 1.2.4
             */
            static function get_minimum_price_hotel( $hotel_id )
            {
                if ( empty( $hotel_id ) ) $hotel_id = get_the_ID();
                $hotel_id = TravelHelper::post_origin( $hotel_id, 'st_hotel' );

                if ( array_key_exists( $hotel_id, self::$priceData ) ) return self::$priceData[ $hotel_id ];

                $min_price = get_post_meta( $hotel_id, 'min_price', true );

                if ( (float)$min_price == 0 ) {
                    // remove in ver 1.2.4
                    global $wpdb;
                    //$rooms     = self::_getAllRoomHotelID( $hotel_id );
                    $min_price = 0;
                    $check_in  = STInput::request( 'start', '' );
                    $check_out = STInput::request( 'end', '' );
                    if ( empty( $check_in ) ) {
                        $check_in = date( 'm/d/Y' );
                    } else {
                        $check_in = TravelHelper::convertDateFormat( $check_in );
                    }
                    if ( !empty( $check_out ) ) {
                        $check_out = TravelHelper::convertDateFormat( $check_out );
                    }
                    $room_num_search = STInput::request( 'room_num_search', 1 );
                    if ( intval( $room_num_search ) <= 0 ) {
                        $room_num_search = 1;
                    }

//                    $room_full_ordered = HotelHelper::_get_room_cant_book_by_id( $hotel_id, date( 'Y-m-d', strtotime( $check_in ) ), date( 'Y-m-d', strtotime( $check_out ) ), $room_num_search );
//
//                    if ( is_array( $rooms ) && count( $rooms ) ) {
//                        foreach ( $rooms as $room ) {
//                            if ( !in_array( $room, $room_full_ordered ) ) {
//                                $price = STPrice::getRoomPriceOnlyCustomPrice( $room, strtotime( $check_in ), strtotime( $check_out ), $room_num_search );
//                                if ( $min_price == 0 && $price > 0 ) {
//                                    $min_price = $price;
//                                }
//                                if ( $min_price > 0 && $min_price > $price && $price > 0 ) {
//                                    $min_price = $price;
//                                }
//                            }
//
//                        }
//                    }
                    global $wpdb;
                    $whereNumber = "AND (number  - COALESCE(number_booked, 0)) >= %d";
                    if ( get_post_meta( $hotel_id, 'allow_full_day', true ) == 'off' ) {
                        $whereNumber = "AND (number  - COALESCE(number_booked, 0) + COALESCE(number_end, 0)) >= %d";
                    }

                    if ( !empty( $check_out ) ) $whereNumber .= $wpdb->prepare( " AND check_out <= %s ", strtotime( $check_out ) );
                    $sql = "
                        SELECT min(price) as min_price FROM {$wpdb->prefix}st_room_availability 
                        WHERE
                        parent_id = %d
                        AND check_in >= %s
                        {$whereNumber}
                        AND status = 'available'
                        LIMIT 1
                    ";


                    $row       = $wpdb->get_row( $wpdb->prepare( $sql, $hotel_id, strtotime( $check_in ), $room_num_search ) );
                    $min_price = $row->min_price;

                }

                self::$priceData[ $hotel_id ] = $min_price;


                return $min_price;
            }

            static function get_maximum_price_hotel( $hotel_id )
            {
                global $wpdb;
                $rooms     = self::_getAllRoomHotelID( $hotel_id );
                $min_price = 0;
                $check_in  = STInput::request( 'start', '' );
                $check_out = STInput::request( 'end', '' );
                if ( empty( $check_in ) ) {
                    $check_in = date( 'm/d/Y' );
                } else {
                    $check_in = TravelHelper::convertDateFormat( $check_in );
                }
                if ( empty( $check_out ) ) {
                    $check_out = date( 'm/d/Y', strtotime( "+1 day" ) );
                } else {
                    $check_out = TravelHelper::convertDateFormat( $check_out );
                }
                $room_num_search = STInput::request( 'room_num_search', 1 );
                if ( intval( $room_num_search ) <= 0 ) {
                    $room_num_search = 1;
                }
                $room_full_ordered = HotelHelper::_get_room_cant_book_by_id( $hotel_id, date( 'Y-m-d', strtotime( $check_in ) ), date( 'Y-m-d', strtotime( $check_out ) ), $room_num_search );

                if ( is_array( $rooms ) && count( $rooms ) ) {
                    foreach ( $rooms as $room ) {
                        if ( !in_array( $room, $room_full_ordered ) ) {
                            $price = STPrice::getRoomPriceOnlyCustomPrice( $room, strtotime( $check_in ), strtotime( $check_out ), $room_num_search );
                            if ( $min_price == 0 && $price > 0 ) {
                                $min_price = $price;
                            }
                            if ( $min_price > 0 && $min_price > $price && $price > 0 ) {
                                $min_price = $price;
                            }
                        }

                    }
                }

                return $min_price;

            }

            static function get_avg_price_hotel( $hotel_id )
            {

                if ( empty( $hotel_id ) ) $hotel_id = get_the_ID();
                $price = get_post_meta( $hotel_id, 'price_avg', true );

                return $price;

                // remove in ver 1.2.4
                /*global $wpdb;
                $rooms = self::_getAllRoomHotelID($hotel_id);
                $avg_price = 0;
                $check_in = STInput::request('start', '');
                $check_out = STInput::request('end', '');
                if(empty($check_in)){
                    $check_in = date('m/d/Y');
                }else{
                    $check_in = TravelHelper::convertDateFormat($check_in);
                }
                if(empty($check_out)){
                    $check_out = date('m/d/Y', strtotime("+1 day"));
                }else{
                    $check_out = TravelHelper::convertDateFormat($check_out);
                }
                $room_num_search = STInput::request('room_num_search', 1);
                if(intval($room_num_search) <= 0){
                    $room_num_search = 1;
                }
                $room_full_ordered = HotelHelper::_get_room_cant_book_by_id($hotel_id, date('Y-m-d',strtotime($check_in)), date('Y-m-d',strtotime($check_out)), $room_num_search);
                if(is_array($rooms) && count($rooms)){
                    $i = 0;
                    foreach($rooms as $room){
                        if(!in_array($room, $room_full_ordered)){
                            $price = STPrice::getRoomPriceOnlyCustomPrice($room, strtotime($check_in), strtotime($check_out), $room_num_search);
                            if($price > 0){
                                $avg_price += $price;
                            }
                        }
                        $i++;
                    }
                    $avg_price /= $i;
                }

                return $avg_price;*/
            }


            static function _get_query_where_validate( $where )
            {
                /*global $wpdb;
                //check hotel
                $where .= " AND $wpdb->9.ID in (
                SELECT $wpdb->postmeta.meta_value FROM
                $wpdb->postmeta
                WHERE $wpdb->postmeta.meta_key='room_parent'
                GROUP BY $wpdb->postmeta.meta_value
            )";*/
                return $where;
            }


        }

        $hotelhelper = new HotelHelper();
        $hotelhelper->init();
    }
?>