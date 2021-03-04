<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'ActivityHelper' ) ) {
        class ActivityHelper
        {
            public function init()
            {
                add_action( 'wp_ajax_st_get_disable_date_activity', [ __CLASS__, '_get_disable_date' ] );
                add_action( 'wp_ajax_nopriv_st_get_disable_date_activity', [ __CLASS__, '_get_disable_date' ] );
            }

            static function _get_activity_free_peple_by_time( $tour_id, $check_in, $start_time )
            {
                global $wpdb;
                if($start_time != '')
                    $starttime_cond = "AND starttime = '{$start_time}'";
                $sql = "SELECT
                origin_id AS activity_id,
				mt.max_people - SUM(adult_number + child_number + infant_number) AS free_people
			FROM
				{$wpdb->prefix}st_order_item_meta
			INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = origin_id
			WHERE
				origin_id = '{$tour_id}'
			AND 
			    check_in_timestamp = '{$check_in}'
			
			AND status NOT IN ('trash', 'canceled')
			" . $starttime_cond . "
			GROUP BY
				origin_id";

                $result = $wpdb->get_row( $sql, ARRAY_A );

                return $result;
            }

	        static function _get_free_peple( $activity_id, $check_in, $check_out)
	        {
		        $activity_id = TravelHelper::post_origin( $activity_id, 'st_tours' );
		        global $wpdb;
		        $table = $wpdb->prefix . 'st_activity_availability';
		        $sql = $wpdb->prepare( "SELECT post_id as activity_id, `number` as max_people, (count_starttime * CASE WHEN number > 0 THEN `number` else (number_booked + 1) END) - number_booked as free_people FROM {$table} WHERE post_id = %d AND check_in = %s AND check_out = %s", $activity_id, $check_in, $check_out);
		        $result = $wpdb->get_row( $sql, ARRAY_A );

		        return $result;
	        }

            static function _get_free_peple_by_time( $activity_id, $check_in, $check_out, $start_time, $order_item_id = '' )
            {
	            $activity_id = TravelHelper::post_origin( $activity_id, 'st_tours' );
	            $string_starttime = "";
	            if(!empty($start_time))
		            $string_starttime = " AND starttime = '{$start_time}' ";

	            global $wpdb;
	            $string = "";
	            if ( !empty( $order_item_id ) ) {
		            $string = " AND order_item_id NOT IN ('{$order_item_id}') ";
	            }
	            $sql = "SELECT
                    origin_id AS activity_id,
                    mt.max_people AS max_people,
                    mt.max_people - SUM(adult_number + child_number + infant_number) AS free_people
                FROM
                    {$wpdb->prefix}st_order_item_meta
                INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = origin_id
                WHERE
                    origin_id = '{$activity_id}'
                AND (
                        UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) = UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in_timestamp), '%Y-%m-%d')) AND
                        UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) = UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out_timestamp), '%Y-%m-%d'))
                )
              	{$string_starttime}
                AND status NOT IN ('trash', 'canceled')
                {$string}
                GROUP BY
                    origin_id";
	            $result = $wpdb->get_row( $sql, ARRAY_A );

	            return $result;
            }

            static function _get_activity_cant_order( $check_in )
            {
	            global $wpdb;
	            $sql = $wpdb->prepare("SELECT post_id FROM {$wpdb->prefix}st_activity_availability WHERE (STR_TO_DATE(DATE_FORMAT(FROM_UNIXTIME(check_in), %s), %s) = %s) AND (`status` = 'unavailable' OR number_booked >= (count_starttime * CASE WHEN number > 0 THEN `number` else (number_booked + 1) END) OR datediff(%s, DATE_FORMAT(NOW(), %s)) <= booking_period) GROUP BY post_id", '%Y-%m-%d', '%Y-%m-%d', $check_in, $check_in, '%Y-%m-%d');

	            $result    = $wpdb->get_col( $sql, 0 );
	            $list_date = [];
	            if ( is_array( $result ) && count( $result ) ) {
		            $list_date = $result;
	            }

	            return $list_date;
            }

            static function _get_free_peple_daily( $activity_id, $check_in, $order_item_id = '' )
            {
                $activity_id = apply_filters( 'st_get_post_id_origin', $activity_id );
                global $wpdb;
                $string = "";
                if ( !empty( $order_item_id ) ) {
                    $string = " AND order_item_id NOT IN ('{$order_item_id}') ";
                }
                $sql = "SELECT
                    origin_id AS activity_id,
                    mt.max_people AS max_people,
                    mt.max_people - SUM(adult_number + child_number + infant_number) AS free_people
                FROM
                    {$wpdb->prefix}st_order_item_meta
                INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = origin_id
                WHERE
                    origin_id = '{$activity_id}'
                AND status NOT IN ('trash', 'canceled')
                and mt.type_activity = 'daily_activity'
                AND (
                        STR_TO_DATE('{$check_in}', '%Y-%m-%d') = STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_in, '%m/%d/%Y')
                )
                {$string}
                GROUP BY
                    origin_id";

                $result = $wpdb->get_row( $sql, ARRAY_A );

                return $result;
            }

            static function _get_free_peple_special( $activity_id, $check_in, $check_out, $order_item_id = '' )
            {
                $activity_id = apply_filters( 'st_get_post_id_origin', $activity_id );
                global $wpdb;
                $string = "";
                if ( !empty( $order_item_id ) ) {
                    $string = " AND order_item_id NOT IN ('{$order_item_id}') ";
                }
                $sql    = "SELECT
                    activity_id AS activity_id,
                    mt.max_people AS max_people,
                    mt.max_people - SUM(adult_number + child_number + infant_number) AS free_people
                FROM
                    {$wpdb->prefix}st_order_item_meta
                INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = origin_id
                WHERE
                    origin_id = '{$activity_id}'
                AND status NOT IN ('trash', 'canceled')
                AND st_booking_post_type = 'st_activity'
                AND mt.type_activity = 'specific_date'
                AND (
                    (
                        STR_TO_DATE('{$check_in}', '%m/%d/%Y') < STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_in, '%m/%d/%Y')
                        AND STR_TO_DATE('{$check_out}', '%m/%d/%Y') > STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_out, '%m/%d/%Y')
                    )
                    OR (
                        STR_TO_DATE('{$check_in}', '%m/%d/%Y') BETWEEN STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_in, '%m/%d/%Y')
                        AND STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_out, '%m/%d/%Y')
                    )
                    OR (
                        STR_TO_DATE('{$check_out}', '%m/%d/%Y') BETWEEN STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_in, '%m/%d/%Y')
                        AND STR_TO_DATE({$wpdb->prefix}st_order_item_meta.check_out, '%m/%d/%Y')
                    )
                )
                {$string}
                GROUP BY
                    origin_id";
                $result = $wpdb->get_row( $sql, ARRAY_A );

                return $result;
            }

            static function _get_disable_date()
            {

                $disable = [];

                $activity_id = STInput::request( 'activity_id', '' );
                $activity_id = apply_filters( 'st_get_post_id_origin', $activity_id );
                if ( empty( $activity_id ) ) {
                    echo json_encode( $disable );
                    die();
                }
                $year = STInput::request( 'year', date( 'Y' ) );

                global $wpdb;

                $sql = "SELECT
                    origin_id as activity_id,
                    check_in_timestamp as check_in,
                    check_out_timestamp as check_out,
                    adult_number,
                    child_number,
                    infant_number
                    FROM
                        {$wpdb->prefix}st_order_item_meta
                    WHERE
                        st_booking_post_type = 'st_activity'
                    AND origin_id = '{$activity_id}'
                    AND status NOT IN ('trash', 'canceled')
                    AND YEAR (
                        FROM_UNIXTIME(check_in_timestamp)
                    ) = {$year}
                    AND YEAR (
                        FROM_UNIXTIME(check_out_timestamp)
                    ) = {$year}";

                $result = $wpdb->get_results( $sql, ARRAY_A );
                if ( is_array( $result ) && count( $result ) ) {
                    $list_date = [];
                    foreach ( $result as $key => $val ) {
                        $list_date[] = [
                            'check_in'      => $val[ 'check_in' ],
                            'check_out'     => $val[ 'check_out' ],
                            'adult_number'  => $val[ 'adult_number' ],
                            'child_number'  => $val[ 'child_number' ],
                            'infant_number' => $val[ 'infant_number' ],
                        ];
                    }
                }

                if ( isset( $list_date ) && count( $list_date ) ) {
                    $min_max = self::_get_minmax( $activity_id, $year );
                    if ( is_array( $min_max ) && count( $min_max ) ) {
                        $max_people = intval( get_post_meta( $activity_id, 'max_people', true ) );
                        for ( $i = intval( $min_max[ 'check_in' ] ); $i <= intval( $min_max[ 'check_out' ] ); $i = strtotime( '+1 day', $i ) ) {
                            $people = 0;
                            foreach ( $result as $key => $date ) {

                                if ( $i == intval( $date[ 'check_in' ] ) ) {
                                    $people += ( intval( $date[ 'adult_number' ] ) + intval( $date[ 'child_number' ] ) + intval( $date[ 'infant_number' ] ) );
                                }
                            }
                            if ( $people >= $max_people )
                                $disable[] = date( TravelHelper::getDateFormat(), $i );
                        }
                    }
                }
                if ( count( $disable ) ) {
                    echo json_encode( $disable );
                    die();
                }

                echo json_encode( $disable );
                die();
            }

            static function _get_minmax( $activity_id, $year )
            {
                global $wpdb;
                $activity_id = apply_filters( 'st_get_post_id_origin', $activity_id );
                $sql         = "SELECT
                MIN(check_in_timestamp) as check_in,
                MAX(check_out_timestamp) as check_out
                FROM
                    {$wpdb->prefix}st_order_item_meta
                WHERE
                    st_booking_post_type = 'st_activity'
                AND status NOT IN ('trash', 'canceled')
                AND origin_id = '{$activity_id}'
                AND YEAR (
                    FROM_UNIXTIME(check_in_timestamp)
                ) = {$year}
                AND YEAR (
                    FROM_UNIXTIME(check_out_timestamp)
                ) = {$year}";

                $min_max = $wpdb->get_row( $sql, ARRAY_A );

                return $min_max;
            }

            static function checkAvailableActivity( $activity_id, $check_in, $check_out )
            {
                $res  = ST_Activity_Availability::inst()
	                ->where('post_id', $activity_id)
	                ->where('check_in', $check_in)
	                ->where('check_out', $check_out)
	                ->where('status', 'available')
	                ->where("number_booked < (count_starttime * CASE WHEN number > 0 THEN `number` else (number_booked + 1) END)", true, false)
	                ->get(1)->result();

                if(count($res) > 0){
                	return true;
                }else{
	                return false;
                }
            }

	        static function _activityHasAvai(){
            	$data = ST_Activity_Availability::inst()
		            ->select('post_id')
		            ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", true, false)
		            ->where("status", 'available' )
		            ->where("number_booked < (count_starttime * CASE WHEN number > 0 THEN `number` else (number_booked + 1) END)", true, false)
		            ->groupby('post_id')
		            ->get()->result();

            	$data_id = "''";
            	if(!empty($data)){
            		$ids = array();
            		foreach ($data as $k => $v){
			            if(!in_array($v['post_id'], $ids))
            			    array_push($ids, $v['post_id']);
		            }
		            $data_id = implode(',', $ids);
	            }
	            return $data_id;
	        }

	        static function _activityValidate( $check_in, $check_out )
	        {
		        $data = ST_Activity_Availability::inst()
			        ->select('post_id')
			        //->where("(STR_TO_DATE(DATE_FORMAT(FROM_UNIXTIME(check_in), '%%Y-%%m-%%d'), '%%Y-%%m-%%d'))", $check_in)
			        ->where("CASE WHEN check_in = check_out THEN check_in BETWEEN {$check_in} AND {$check_out} ELSE
		                                        {$check_in} >= check_in AND ({$check_out} >= check_in AND {$check_out} <= check_out) END", null, true)
			        ->where("`status`", 'available')
			        ->where("number_booked < (count_starttime * CASE WHEN number > 0 THEN `number` else (number_booked + 1) END)", true, false)
			        ->get()->result();
		        $data_id = "''";
		        if(!empty($data)){
		        	$ids = array();
		        	foreach ($data as $k => $v){
				        $today     = date( 'Y-m-d' );
				        $booking_period = intval( get_post_meta( $v['post_id'], 'activity_booking_period', true ) );
				        $period         = STDate::dateDiff( $today, date('Y-m-d', $check_in) );
				        if ( $period >= $booking_period ) {
					        if(!in_array($v['post_id'], $ids))
					            array_push($ids, $v['post_id']);
				        }
			        }
			        if (!empty($ids))
			            $data_id = implode(',', $ids);
		        }
		        return $data_id;
	        }

	        static function getSeatAvailability($post_id, $start, $end){
		        $start = TravelHelper::convertDateFormat( $start );
		        $end   = TravelHelper::convertDateFormat( $end );
		        $query = ST_Activity_Availability::inst()
		                                     ->select('id, check_in, check_out, number, number_booked, status, groupday')
		                                     ->where('post_id', $post_id)
		                                     ->where('check_in >=', strtotime($start))
		                                     ->where('check_out <=', strtotime($end))
		                                     ->where('status', 'available')
		                                     ->get()->result();

		        $res = array();
		        if(!empty($query)){
			        foreach ($query as $k => $v){
				        $number_avail = '';
				        if($v['status'] != 'unavailable') {
					        $number = $v['number'];
					        if ( empty( $v['number'] ) ) {
						        $number = get_post_meta( $post_id, 'max_people', true );
					        }

					        if ( empty( $number ) or $number == '0' ) {
						        $number_avail = 'unlimited';
					        } else {
						        $number_booked = $v['number_booked'];
						        if ( empty( $number_booked ) ) {
							        $number_booked = 0;
						        }
						        $number_avail = $number - $number_booked;
					        }
				        }else{
					        $number_avail = 'unavailable';
				        }

				        $res[] = array(
					        'id' => $v['id'],
					        'check_in' => $v['check_in'],
					        'check_out' => $v['check_out'],
					        'number_avail' => $number_avail,
					        'groupday' => $v['groupday']
				        );
			        }
		        }
		        return $res;
	        }

        }

        $activityhelper = new ActivityHelper();
        $activityhelper->init();

    }
?>