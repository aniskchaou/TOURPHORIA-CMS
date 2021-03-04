<?php
/**
 * @since 1.1.9
 **/
if (!class_exists('AvailabilityHelper')) {
    class AvailabilityHelper
    {
        public function __construct()
        {
            if (is_admin()) {
                add_action('wp_ajax_st_get_availability_hotel', [&$this, '_get_availability_hotel']);
                add_action('wp_ajax_st_get_availability_rental', [&$this, '_get_availability_rental']);
                add_action('wp_ajax_st_get_availability_flight', [&$this, '_get_availability_flight']);

                add_action('wp_ajax_st_get_availability_tour', [&$this, '_get_availability_tour']);
                add_action('wp_ajax_st_get_availability_activity', [&$this, '_get_availability_activity']);

                add_action('wp_ajax_st_get_availability_tour_frontend', [&$this, '_get_availability_tour_frontend']);
                add_action('wp_ajax_nopriv_st_get_availability_tour_frontend', [&$this, '_get_availability_tour_frontend']);

                add_action('wp_ajax_st_get_availability_activity_frontend', [&$this, '_get_availability_activity_frontend']);
                add_action('wp_ajax_nopriv_st_get_availability_activity_frontend', [&$this, '_get_availability_activity_frontend']);

                add_action('wp_ajax_st_add_custom_price', [&$this, '_add_custom_price']);
                add_action('wp_ajax_st_add_custom_price_rental', [&$this, '_add_custom_price_rental']);
                add_action('wp_ajax_st_add_custom_price_flight', [&$this, '_add_custom_price_flight']);
                add_action('wp_ajax_st_add_custom_price_tour', [&$this, '_add_custom_price_tour']);

                add_action('wp_ajax_st_add_custom_price_activity', [&$this, '_add_custom_price_activity']);


                add_action('wp_ajax_traveler_calendar_bulk_edit_form', [$this, 'traveler_calendar_bulk_edit_form']);

                add_action('wp_ajax_st_get_starttime_tour_frontend', [&$this, '_get_starttime_tour_frontend']);
                add_action('wp_ajax_nopriv_st_get_starttime_tour_frontend', [&$this, '_get_starttime_tour_frontend']);

                add_action('wp_ajax_st_get_starttime_activity_frontend', [&$this, '_get_starttime_activity_frontend']);
                add_action('wp_ajax_nopriv_st_get_starttime_activity_frontend', [&$this, '_get_starttime_activity_frontend']);
            }
        }

        static function _get_starttime_activity_frontend()
        {
            $post_id = STInput::request('activity_id', '');
            $post_id = TravelHelper::post_origin($post_id, 'st_activity');
            $check_in = trim(STInput::request('check_in', ''));
            $check_out = STInput::request('check_out', '');
            $re_format_check_in = strtotime(date("Y-m-d", strtotime(TravelHelper::convertDateFormat($check_in))));
            $re_format_check_out = strtotime(date("Y-m-d", strtotime(TravelHelper::convertDateFormat($check_out))));


            if ($check_out != '') {
                $starttime_data = self::_get_starttime_activity_by_date($post_id, $re_format_check_in, $re_format_check_out);
            } else {
                $starttime_data = self::_get_starttime_activity_by_date($post_id, $re_format_check_in, $re_format_check_in);
            }

            $result_data = [];

            if (!empty($starttime_data)) {
                foreach ($starttime_data as $item) {
                    $result_data = explode(', ', $item->starttime);
                }
            }

            $disable_option = [];

            $max_people = intval(get_post_meta($post_id, 'max_people', true));

            if (!empty($result_data)) {
                foreach ($result_data as $item) {
                    if ($max_people == '' || $max_people == '0' || !is_numeric($max_people)) {
                        array_push($disable_option, '-1');
                    } else {
                        if ($check_out != '') {
                            $result = ActivityHelper::_get_free_peple_by_time($post_id, $re_format_check_in, $re_format_check_out, $item);
                        } else {
                            $result = ActivityHelper::_get_free_peple_by_time($post_id, $re_format_check_in, $re_format_check_in, $item);
                        }
                        if (is_array($result) && count($result)) {
                            if ($result['max_people'] != '' && $result['free_people'] != '') {
                                $free_people = intval($result['free_people']);
                                if ($free_people == '0') {
                                    array_push($disable_option, '0');
                                } else {
                                    array_push($disable_option, $free_people);
                                }
                            } else {
                                array_push($disable_option, $max_people);
                            }
                        } else {
                            array_push($disable_option, $max_people);
                        }
                    }
                }
            }

            $data = [
                'check' => $disable_option,
                'data' => $result_data
            ];

            echo json_encode($data);
            die;
        }

        public static function _get_starttime_activity_by_date($post_id, $check_in, $check_out)
        {
            global $wpdb;

            $sql = $wpdb->prepare("SELECT `starttime` FROM {$wpdb->prefix}st_activity_availability WHERE post_id = %d AND check_in = %s AND check_out = %s", $post_id, $check_in, $check_out);
            $results = $wpdb->get_results($sql);

            return $results;
        }


        static function _get_availability_date_srart($post_id)
        {
            $date = date("Y-m", strtotime('today')) . '-01';
            if (!empty($post_id)) {
                $post_type = get_post_type($post_id);
                $is_get_date = false;
                if ($post_type == 'st_activity') {
                    $type_activity = get_post_meta($post_id, 'type_activity', true);
                    if ($type_activity == "specific_date") {
                        $is_get_date = true;
                    }
                }
                if ($post_type == 'st_tours') {
                    $type_activity = get_post_meta($post_id, 'type_tour', true);
                    if ($type_activity == "specific_date") {
                        $is_get_date = true;
                    }
                }
                if ($is_get_date == true) {
                    $today = strtotime('today');
                    global $wpdb;
                    $sql = "SELECT check_in
                    FROM
                    {$wpdb->prefix}st_availability
                    WHERE 
                    post_id = {$post_id} 
                    AND check_in >= {$today}
                    AND `status` = 'available'
                    ORDER BY check_in ASC
                    LIMIT 1 ";
                    $results = $wpdb->get_row($sql);
                    if (!empty($results->check_in)) {
                        $date = date("Y-m", $results->check_in) . '-01';
                    }
                }

            }

            return $date;
        }

        static function _get_check_out_by_groupday($tour_id, $check_in)
        {
            global $wpdb;
            $sql = "SELECT
			  	  `check_out_timestamp`
			FROM
				{$wpdb->prefix}st_order_item_meta
			WHERE
				st_booking_id = '{$tour_id}'
			AND
				check_in_timestamp = '{$check_in}'
			AND 
			    st_booking_post_type = 'st_tours'";

            $result = $wpdb->get_results($sql);

            if (!empty($result)) {
                return $result[0]->check_out_timestamp;
            } else {
                return '';
            }

        }

        static function _get_in_out_by_group_day($tour_id)
        {
            global $wpdb;
            $sql = "SELECT
                `post_id`,
				`check_in`,
				`check_out`
			FROM
				{$wpdb->prefix}st_availability
			WHERE
				post_id = '{$tour_id}'
			AND
				groupday = 1
			AND 
			    post_type = 'st_tours'";

            $results = $wpdb->get_results($sql);

            return $results;
        }

        static function _get_free_peple_by_time($tour_id, $check_in, $check_out, $start_time, $order_item_id = '')
        {
            global $wpdb;
            $sql = "SELECT
				st_booking_id AS tour_id,
				mt.max_people AS max_people,
				mt.max_people - SUM(adult_number + child_number + infant_number) AS free_people
			FROM
				{$wpdb->prefix}st_order_item_meta
			INNER JOIN {$wpdb->prefix}st_tours AS mt ON mt.post_id = st_booking_id
			WHERE
				st_booking_id = '{$tour_id}'
			AND 
			    check_out_timestamp = '{$check_in}'
			AND starttime = '{$start_time}'
			AND status NOT IN ('trash', 'canceled')
			
			GROUP BY
				st_booking_id";

            $result = $wpdb->get_row($sql, ARRAY_A);

            return $result;
        }

        public static function _get_starttime_tour_by_date($post_id, $check_in)
        {
            global $wpdb;

            $sql = $wpdb->prepare("SELECT `starttime` FROM {$wpdb->prefix}st_tour_availability WHERE post_id = %d AND check_in = %s", $post_id, $check_in);
            $results = $wpdb->get_results($sql);

            return $results;
        }

        public function _get_starttime_tour_frontend()
        {
            $post_id = STInput::request('tour_id', '');
            $post_id = TravelHelper::post_origin($post_id, 'st_tours');
            $check_in = STInput::request('check_in', '');
            $check_out = STInput::request('check_out', '');
            $re_format_check_in = strtotime(date("Y-m-d", strtotime(TravelHelper::convertDateFormat($check_in))));
            $re_format_check_out = strtotime(date("Y-m-d", strtotime(TravelHelper::convertDateFormat($check_out))));

            $starttime_data = self::_get_starttime_tour_by_date($post_id, $re_format_check_in);

            $result_data = [];
            if (!empty($starttime_data)) {
                foreach ($starttime_data as $item) {
                    $result_data = explode(', ', $item->starttime);
                }
            }

            $disable_option = [];
            $max_people = intval(get_post_meta($post_id, 'max_people', true));

            foreach ($result_data as $item) {
                if ($max_people == '' || $max_people == '0' || !is_numeric($max_people)) {
                    array_push($disable_option, '-1');
                } else {
                    if ($check_out != '') {
                        $result = TourHelper::_get_free_peple_by_time($post_id, $re_format_check_in, $re_format_check_out, $item);
                    } else {
                        $result = TourHelper::_get_free_peple_by_time($post_id, $re_format_check_in, $re_format_check_in, $item);
                    }
                    if (is_array($result) && count($result)) {
                        $free_people = intval($result['free_people']);
                        if ($free_people == '0') {
                            array_push($disable_option, '0');
                        } else {
                            array_push($disable_option, $free_people);
                        }
                    } else {
                        array_push($disable_option, $max_people);
                    }
                }
            }

            $data = [
                'check' => $disable_option,
                'data' => $result_data
            ];

            echo json_encode($data);
            die;
        }

        public function traveler_calendar_bulk_edit_form()
        {
            $post_id = (int)STInput::post('post_id', 0);
            if ($post_id > 0) {

                if (isset($_POST['all_days']) && !empty($_POST['all_days'])) {

                    $data = STInput::post('data', '');
                    $all_days = STInput::post('all_days', '');
                    $posts_per_page = (int)STInput::post('posts_per_page', '');
                    $current_page = (int)STInput::post('current_page', '');
                    $total = (int)STInput::post('total', '');

                    if ($current_page > ceil($total / $posts_per_page)) {

                        echo json_encode([
                            'status' => 1,
                            'message' => '<div class="text-success">' . __('Added successful.', ST_TEXTDOMAIN) . '</div>'
                        ]);
                        die;
                    } else {
                        $return = $this->insert_calendar_bulk($data, $posts_per_page, $total, $current_page, $all_days, $post_id);
                        echo json_encode($return);
                        die;
                    }
                }

                $day_of_week = STInput::post('day-of-week', '');
                $day_of_month = STInput::post('day-of-month', '');

                $array_month = [
                    'January' => '1',
                    'February' => '2',
                    'March' => '3',
                    'April' => '4',
                    'May' => '5',
                    'June' => '6',
                    'July' => '7',
                    'August' => '8',
                    'September' => '9',
                    'October' => '10',
                    'November' => '11',
                    'December' => '12',
                ];

                $months = STInput::post('months', '');

                $years = STInput::post('years', '');

                $price = STInput::post('price_bulk', 0);
                $adult_price = STInput::post('adult-price_bulk', 0);
                $children_price = STInput::post('children-price_bulk', 0);
                $infant_price = STInput::post('infant-price_bulk', 0);

                if ($price == '')
                    $price = 0;
                if ($adult_price == '')
                    $adult_price = 0;
                if ($children_price == '')
                    $children_price = 0;
                if ($infant_price == '')
                    $infant_price = 0;

                $start_time_arr = STInput::request('starttime', '');
                $start_time_str = '';
                if (isset($start_time_arr) && !empty($start_time_arr))
                    $start_time_str = implode(', ', $start_time_arr);

                if (!is_numeric($price) || !is_numeric($adult_price) || !is_numeric($children_price) || !is_numeric($infant_price)) {
                    echo json_encode([
                        'status' => 0,
                        'message' => '<div class="text-error">' . __('The price field is not a number.', ST_TEXTDOMAIN) . '</div>'
                    ]);
                    die;
                }
                $price = (float)$price;
                $adult_price = (float)$adult_price;
                $children_price = (float)$children_price;
                $infant_price = (float)$infant_price;

                $status = STInput::post('status', 'available');

                $group_day = STInput::post('calendar_groupday', 0);

                /*  Start, End is a timestamp */
                $all_years = [];
                $all_months = [];
                $all_days = [];

                if (!empty($years)) {

                    sort($years, 1);

                    foreach ($years as $year) {
                        $all_years[] = $year;
                    }

                    if (!empty($months)) {

                        foreach ($months as $month) {
                            foreach ($all_years as $year) {
                                $all_months[] = $month . ' ' . $year;
                            }
                        }

                        if (!empty($day_of_week) && !empty($day_of_month)) {
                            // Each day in month
                            foreach ($day_of_month as $day) {
                                // Each day in week
                                foreach ($day_of_week as $day_week) {
                                    // Each month year
                                    foreach ($all_months as $month) {
                                        $time = strtotime($day . ' ' . $month);

                                        if (date('l', $time) == $day_week) {
                                            $all_days[] = $time;
                                        }
                                    }
                                }
                            }
                        } elseif (empty($day_of_week) && empty($day_of_month)) {
                            foreach ($all_months as $month) {
                                for ($i = strtotime('first day of ' . $month); $i <= strtotime('last day of ' . $month); $i = strtotime('+1 day', $i)) {
                                    $all_days[] = $i;
                                }
                            }
                        } elseif (empty($day_of_week) && !empty($day_of_month)) {

                            foreach ($day_of_month as $day) {
                                foreach ($all_months as $month) {
                                    $month_tmp = trim($month);
                                    $month_tmp = explode(' ', $month);

                                    //$num_day = date('t', mktime(0, 0, 0, $array_month[ $month_tmp[ 0 ] ], 1, $month_tmp[ 1 ]));
                                    $num_day = cal_days_in_month(CAL_GREGORIAN, $array_month[$month_tmp[0]], $month_tmp[1]);

                                    if ($day <= $num_day) {
                                        $all_days[] = strtotime($day . ' ' . $month);
                                    }
                                }
                            }
                        } elseif (!empty($day_of_week) && empty($day_of_month)) {
                            foreach ($day_of_week as $day) {
                                foreach ($all_months as $month) {
                                    for ($i = strtotime('first ' . $day . ' of ' . $month); $i <= strtotime('last ' . $day . ' of ' . $month); $i = strtotime('+1 week', $i)) {
                                        $all_days[] = $i;
                                    }
                                }
                            }
                        }


                        if (!empty($all_days)) {
                            $posts_per_page = 10;

                            if ($group_day == 1) {
                                $all_days = $this->change_allday_to_group($all_days);
                            }

                            $total = count($all_days);

                            $current_page = 1;

                            $data = [
                                'post_id' => $post_id,
                                'status' => $status,
                                'groupday' => $group_day,
                                'price' => $price,
                                'adult_price' => $adult_price,
                                'children_price' => $children_price,
                                'infant_price' => $infant_price,
                            ];

                            if ($start_time_str != '')
                                $data['starttime'] = $start_time_str;

                            $return = $this->insert_calendar_bulk($data, $posts_per_page, $total, $current_page, $all_days, $post_id);

                            echo json_encode($return);
                            die;
                        }
                    } else {
                        echo json_encode([
                            'status' => 0,
                            'message' => '<div class="text-error">' . __('The months field is required.', ST_TEXTDOMAIN) . '</div>'
                        ]);
                        die;
                    }

                } else {
                    echo json_encode([
                        'status' => 0,
                        'message' => '<div class="text-error">' . __('The years field is required.', ST_TEXTDOMAIN) . '</div>'
                    ]);
                    die;
                }
            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => '<div class="text-error">' . __('The room field is required.', ST_TEXTDOMAIN) . '</div>'
                ]);
                die;
            }
        }

        public function change_allday_to_group($all_days = [])
        {
            $return_tmp = [];
            $return = [];

            foreach ($all_days as $item) {
                $month = date('m', $item);
                if (!isset($return_tmp[$month])) {
                    $return_tmp[$month]['min'] = $item;
                    $return_tmp[$month]['max'] = $item;
                } else {
                    if ($return_tmp[$month]['min'] > $item) {
                        $return_tmp[$month]['min'] = $item;
                    }
                    if ($return_tmp[$month]['max'] < $item) {
                        $return_tmp[$month]['max'] = $item;
                    }
                }
            }

            foreach ($return_tmp as $key => $val) {
                $return[] = [
                    'min' => $val['min'],
                    'max' => $val['max'],
                ];
            }

            return $return;
        }

        public function insert_calendar_bulk($data, $posts_per_page, $total, $current_page, $all_days, $post_id)
        {
            $post_type = get_post_type($post_id);
            $table = '';
            switch ($post_type) {
                case 'st_tours':
                    $table = 'st_tour_availability';
                    break;
                case 'st_activity':
                    $table = 'st_activity_availability';
                    break;
                case 'hotel_room':
                    $table = 'st_room_availability';
                    break;
                case 'st_rental':
                    $table = 'st_rental_availability';
                    break;
            }

            $start = ($current_page - 1) * $posts_per_page;

            $end = ($current_page - 1) * $posts_per_page + $posts_per_page - 1;

            if ($end > $total - 1) $end = $total - 1;

            if ($data['groupday'] == 0) {
                for ($i = $start; $i <= $end; $i++) {

                    $data['start'] = $all_days[$i];
                    $data['end'] = $all_days[$i];

                    /*  Delete old item */
                    $result = $this->traveler_get_availability($post_id, $all_days[$i], $all_days[$i], $table);

                    $split = $this->traveler_split_availability($result, $all_days[$i], $all_days[$i]);

                    if (isset($split['delete']) && !empty($split['delete'])) {
                        foreach ($split['delete'] as $item) {
                            $this->traveler_delete_availability($item['id'], $table);
                        }
                    }
                    /*  .End */

                    if (!isset($data['starttime']))
                        $data['starttime'] = '';

                    $this->traveler_insert_availability($data['post_id'], $data['start'], $data['end'], $data['price'], $data['adult_price'], $data['children_price'], $data['infant_price'], $data['starttime'], $data['status'], $data['groupday'], $table);
                }
            } else {
                for ($i = $start; $i <= $end; $i++) {
                    $data['start'] = $all_days[$i]['min'];
                    $data['end'] = $all_days[$i]['max'];
                    /*  Delete old item */
                    $result = $this->traveler_get_availability($post_id, $all_days[$i]['min'], $all_days[$i]['max'], $table);
                    $split = $this->traveler_split_availability($result, $all_days[$i]['min'], $all_days[$i]['max']);
                    if (isset($split['delete']) && !empty($split['delete'])) {
                        foreach ($split['delete'] as $item) {
                            $this->traveler_delete_availability($item['id'], $table);
                        }
                    }
                    /*  .End */

                    if (!isset($data['starttime']))
                        $data['starttime'] = '';

                    $this->traveler_insert_availability($data['post_id'], $data['start'], $data['end'], $data['price'], $data['adult_price'], $data['children_price'], $data['infant_price'], $data['starttime'], $data['status'], $data['groupday'], $table);
                }
            }


            $next_page = (int)$current_page + 1;

            $progress = ($current_page / $total) * 100;

            $return = [
                'all_days' => $all_days,
                'current_page' => $next_page,
                'posts_per_page' => $posts_per_page,
                'total' => $total,
                'status' => 2,
                'data' => $data,
                'progress' => $progress,
                'post_id' => $post_id,
            ];

            return $return;
        }

        public function traveler_delete_availability($id = '', $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;

            $table = $wpdb->prefix . $table;

            $wpdb->delete(
                $table,
                [
                    'id' => $id
                ]
            );

        }

        public function traveler_insert_availability($post_id = '', $check_in = '', $check_out = '', $price = '', $adult_price = '', $children_price = '', $infant_price = '', $starttime = '', $status = '', $group_day = '', $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;

            if ($group_day == 1) {
                $data_insert = [
                    'post_id' => $post_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'price' => $price,
                    'adult_price' => $adult_price,
                    'child_price' => $children_price,
                    'infant_price' => $infant_price,
                    'status' => $status,
                    'groupday' => 1,
                ];
                if ($table == 'st_rental_availability' || $table == 'st_room_availability') {
                    unset($data_insert['adult_price']);
                    unset($data_insert['child_price']);
                    unset($data_insert['infant_price']);
                }
                if ($table == 'st_room_availability') {
                    $parent_id = get_post_meta($post_id, 'room_parent', true);
                    unset($data_insert['groupday']);
                    $data_insert['post_type'] = 'hotel_room';
                    $data_insert['number'] = get_post_meta($post_id, 'number_room', true);
                    $data_insert['allow_full_day'] = get_post_meta($post_id, 'allow_full_day', true);
                    $data_insert['booking_period'] = get_post_meta($parent_id, 'hotel_booking_period', true);
                    $data_insert['adult_number'] = get_post_meta($post_id, 'adult_number', true);
                    $data_insert['child_number'] = get_post_meta($post_id, 'children_number', true);
                    $data_insert['is_base'] = 0;
                    $data_insert['parent_id'] = $parent_id;
                }
                if ($table == 'st_tour_availability' or $table == 'st_activity_availability')
                    $data_insert['starttime'] = $starttime;
                $wpdb->insert(
                    $wpdb->prefix . $table,
                    $data_insert
                );
            } else {
                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $data_insert = [
                        'post_id' => $post_id,
                        'check_in' => $i,
                        'check_out' => $i,
                        'price' => $price,
                        'adult_price' => $adult_price,
                        'child_price' => $children_price,
                        'infant_price' => $infant_price,
                        'status' => $status,
                        'groupday' => 0,
                    ];

                    if ($table == 'st_rental_availability' || $table == 'st_room_availability') {
                        unset($data_insert['adult_price']);
                        unset($data_insert['child_price']);
                        unset($data_insert['infant_price']);
                    }
                    if ($table == 'st_room_availability') {
                        $parent_id = get_post_meta($post_id, 'room_parent', true);
                        unset($data_insert['groupday']);
                        $data_insert['post_type'] = 'hotel_room';
                        $data_insert['number'] = get_post_meta($post_id, 'number_room', true);
                        $data_insert['allow_full_day'] = get_post_meta($post_id, 'allow_full_day', true);
                        $data_insert['booking_period'] = get_post_meta($parent_id, 'hotel_booking_period', true);
                        $data_insert['adult_number'] = get_post_meta($post_id, 'adult_number', true);
                        $data_insert['child_number'] = get_post_meta($post_id, 'children_number', true);
                        $data_insert['is_base'] = 0;
                        $data_insert['parent_id'] = $parent_id;
                    }
                    if ($table == 'st_tour_availability' or $table == 'st_activity_availability')
                        $data_insert['starttime'] = $starttime;
                    $wpdb->insert(
                        $wpdb->prefix . $table,
                        $data_insert
                    );
                }
            }


            return (int)$wpdb->insert_id;
        }

        public function traveler_get_availability($post_id = '', $check_in = '', $check_out = '', $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;

            $table = $wpdb->prefix . $table;

            $sql = "SELECT * FROM {$table} WHERE post_id = {$post_id} AND ( ( CAST( check_in AS UNSIGNED ) >= CAST( {$check_in} AS UNSIGNED) AND CAST( check_in AS UNSIGNED ) <= CAST( {$check_out} AS UNSIGNED ) ) OR ( CAST( check_out AS UNSIGNED ) >= CAST( {$check_in} AS UNSIGNED ) AND ( CAST( check_out AS UNSIGNED ) <= CAST( {$check_out} AS UNSIGNED ) ) ) )";

            $result = $wpdb->get_results($sql, ARRAY_A);

            $return = [];

            if (!empty($result)) {
                foreach ($result as $item) {
                    $return[] = [
                        'id' => $item['id'],
                        'post_id' => $item['post_id'],
                        'check_in' => date('Y-m-d', $item['check_in']),
                        'check_out' => date('Y-m-d', strtotime('+1 day', $item['check_out'])),
                        'price' => (float)$item['price'],
                        'adult_price' => isset($item['adult_price']) ? (float)$item['adult_price'] : '',
                        'children_price' => isset($item['child_price']) ? (float)$item['child_price'] : '',
                        'infant_price' => isset($item['infant_price']) ? (float)$item['infant_price'] : '',
                        'status' => $item['status'],
                        'groupday' => isset($item['groupday']) ? $item['groupday'] : '',
                    ];
                    if ($table == 'st_tour_availability' or $table == 'st_activity_availability')
                        $return['starttime'] = $item['starttime'];
                }
            }

            return $return;
        }

        public function traveler_split_availability($result = [], $check_in = '', $check_out = '')
        {
            $return = [];

            if (!empty($result)) {
                foreach ($result as $item) {
                    $check_in = (int)$check_in;
                    $check_out = (int)$check_out;

                    if (isset($item['start']) && isset($item['start'])) {
                        $start = strtotime($item['start']);
                        $end = strtotime('-1 day', strtotime($item['end']));

                        if ($start < $check_in && $end >= $check_in) {
                            $return['insert'][] = [
                                'post_id' => $item['post_id'],
                                'check_in' => strtotime($item['check_in']),
                                'check_out' => strtotime('-1 day', $check_in),
                                'price' => (float)$item['price'],
                                'status' => $item['status'],
                                'groupday' => $item['groupday'],
                            ];
                        }

                        if ($start <= $check_out && $end > $check_out) {
                            $return['insert'][] = [
                                'post_id' => $item['post_id'],
                                'check_in' => strtotime('+1 day', $check_out),
                                'check_out' => strtotime('-1 day', strtotime($item['check_out'])),
                                'price' => (float)$item['price'],
                                'status' => $item['status'],
                                'groupday' => $item['groupday'],
                            ];
                        }
                    }

                    $return['delete'][] = [
                        'id' => $item['id']
                    ];
                }
            }

            return $return;
        }

        public function _get_availability_hotel()
        {
            $results = [];
            $post_id = STInput::request('post_id', '');
            $post_id = TravelHelper::post_origin($post_id);
            $check_in = STInput::request('start', '');
            $check_out = STInput::request('end', '');
            $price_ori = floatval(get_post_meta($post_id, 'price', true));
            $default_state = get_post_meta($post_id, 'default_state', true);
            $number_room = intval(get_post_meta($post_id, 'number_room', true));

            if (get_post_type($post_id) == 'hotel_room') {
                $data = self::_getdataHotel($post_id, $check_in, $check_out);

                for ($i = intval($check_in); $i <= intval($check_out); $i = strtotime('+1 day', $i)) {
                    $in_date = false;
                    if (is_array($data) && count($data)) {
                        foreach ($data as $key => $val) {
                            if ($i >= intval($val->check_in) && $i <= intval($val->check_out)) {
                                $status = $val->status;
                                if ($status != 'unavailable') {
                                    $item = [
                                        'price' => floatval($val->price),
                                        'start' => date('Y-m-d', $i),
                                        'title' => get_the_title($post_id),
                                        'item_id' => $val->id,
                                        'status' => $val->status,
                                    ];
                                } else {
                                    unset($item);
                                }
                                if (!$in_date)
                                    $in_date = true;
                            }
                        }
                    }
                    if (isset($item)) {
                        $results[] = $item;
                        unset($item);
                    }
                    if (!$in_date && ($default_state == 'available' || !$default_state)) {
                        $item_ori = [
                            'price' => $price_ori,
                            'start' => date('Y-m-d', $i),
                            'title' => get_the_title($post_id),
                            'number' => $number_room,
                            'status' => 'available'
                        ];
                        $results[] = $item_ori;
                        unset($item_ori);
                    }
                    if (!$in_date) {
                        $parent_id = get_post_meta($post_id, 'room_parent', true);
                        ST_Hotel_Room_Availability::inst()->insertOrUpdate([
                            'post_id' => $post_id,
                            'check_in' => $i,
                            'check_out' => $i,
                            'status' => (!$default_state or $default_state == 'available') ? 'available' : 'unavailable',
                            'is_base' => 1,
                            'price' => $price_ori,
                            'post_type' => 'hotel_room',
                            'parent_id' => $parent_id
                        ]);
                    }


                }
            }

            echo json_encode($results);
            die();
        }

        protected function apply_discount($price, $type = 'percent', $amount = '', $booking_date = '', $is_sale_schedule = 'off', $from_date = '', $to_date = '')
        {
            return st_apply_discount($price, $type, $amount, $booking_date, $is_sale_schedule, $from_date, $to_date);

        }

        public function _get_availability_rental()
        {
            $results = [];
            $rental_id = STInput::request('post_id', '');
            $check_in = STInput::request('start', '');
            $check_out = STInput::request('end', '');
            $base_price = floatval(get_post_meta($rental_id, 'price', true));
            $number_room = intval(get_post_meta($rental_id, 'number_room', true));
            $discount_type = get_post_meta($rental_id, 'discount_type_no_day', true);
            $discount = get_post_meta($rental_id, 'discount_rate', true);
            $is_sale_schedule = get_post_meta($rental_id, 'is_sale_schedule', true);
            $sale_price_from = get_post_meta($rental_id, 'sale_price_from', true);
            $sale_price_to = get_post_meta($rental_id, 'sale_price_to', true);

            if (get_post_type($rental_id) == 'st_rental') {
                if ($base_price < 0) $base_price = 0;
                $data_rental = self::_getdataRentalEachDate($rental_id, $check_in, $check_out);
                if (is_array($data_rental) && count($data_rental)) {
                    foreach ($data_rental as $key => $val) {
                        if ($val->status == 'available') {
                            if (intval($val->groupday) == 1) {
                                $results[] = [
                                    'title' => get_the_title($rental_id),
                                    'start' => date('Y-m-d', $val->check_in),
                                    'end' => date('Y-m-d', strtotime('+1 day', $val->check_out)),
                                    //'price'  => $this->apply_discount($val->price,$discount_type,$discount,$val->check_in,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to)),
                                    'price' => round($val->price, 2),
                                    'status' => 'available'
                                ];
                            } else {
                                for ($i = $val->check_in; $i <= $val->check_out; $i = strtotime('+1 day', $i)) {
                                    $results[] = [
                                        'title' => get_the_title($rental_id),
                                        'start' => date('Y-m-d', $i),
                                        //'price'  => $this->apply_discount($val->price,$discount_type,$discount,$i,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to)),
                                        'price' => round($val->price, 2),
                                        'status' => 'available',
                                    ];
                                }
                            }
                        }
                    }

                    for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                        $in_item = false;
                        foreach ($data_rental as $key => $val) {
                            if ($i >= $val->check_in && $i <= $val->check_out) {
                                $in_item = true;
                                break;
                            }
                        }

                        if (!$in_item) {
                            $results[] = [
                                'title' => get_the_title($rental_id),
                                'start' => date('Y-m-d', $i),
                                //'price'  => $this->apply_discount($base_price,$discount_type,$discount,$i,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to)),
                                'price' => round($base_price, 2),
                                'status' => 'available',
                            ];

                            ST_Rental_Availability::inst()->insertOrUpdate([
                                'post_id' => $rental_id,
                                'check_in' => $i,
                                'check_out' => $i,
                                'status' => 'available',
                                'is_base' => 1,
                                //'price'=>$this->apply_discount($base_price,$discount_type,$discount,$i,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to))
                                'price' => round($base_price, 2)
                            ]);
                        }
                    }
                } else {
                    for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                        $results[] = [
                            'title' => get_the_title($rental_id),
                            'start' => date('Y-m-d', $i),
                            //'price'  => $this->apply_discount($base_price,$discount_type,$discount,$i,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to)),
                            'price' => round($base_price, 2),
                            'status' => 'available'
                        ];

                        ST_Rental_Availability::inst()->insertOrUpdate([
                            'post_id' => $rental_id,
                            'check_in' => $i,
                            'check_out' => $i,
                            'status' => 'available',
                            'is_base' => 1,
                            //'price'=>$this->apply_discount($base_price,$discount_type,$discount,$i,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to))
                            'price' => round($base_price, 2)
                        ]);
                    }
                }
            }
            echo json_encode($results);
            die();
        }

        public function _get_availability_flight()
        {
            $return = [];
            $post_id = STInput::request('post_id', '');
            $post_id = TravelHelper::post_origin($post_id);
            $check_in = STInput::request('start', '');
            $check_out = STInput::request('end', '');

            if (get_post_type($post_id) == 'st_flight') {

                $availability = ST_Flight_Availability_Models::inst()
                    ->where('start_date >=', $check_in)
                    ->where('end_date <=', $check_out)
                    ->where('post_id', $post_id)
                    ->where('status', 'available')
                    ->groupby('start_date')
                    ->get()->result();

                if (!empty($availability)) {
                    foreach ($availability as $key => $val) {
                        $return[] = [
                            'eco_price' => floatval($val['eco_price']),
                            'business_price' => floatval($val['business_price']),
                            'start' => date('Y-m-d', $val['start_date']),
                            'title' => get_the_title($post_id),
                            'item_id' => $val['id'],
                            'status' => $val['status'],
                        ];
                    }
                }
            }
            wp_send_json($return);
        }

        /**
         * @todo Get Availability Tour for Admin, So don need to apply discount price there
         */
        public function _get_availability_tour()
        {
            $return = [];
            $tour_id = STInput::request('tour_id', '');

            $tour_id = TravelHelper::post_origin($tour_id);

            $check_in = STInput::request('start', '');
            $check_out = STInput::request('end', '');


//                $discount_type=get_post_meta($tour_id,'discount_type',true);
//                $discount=get_post_meta($tour_id,'discount',true);
//                $is_sale_schedule=get_post_meta($tour_id,'is_sale_schedule',true);
//                $sale_price_from=get_post_meta($tour_id,'sale_price_from',true);
//                $sale_price_to=get_post_meta($tour_id,'sale_price_to',true);


            if (get_post_type($tour_id) == 'st_tours') {

                $availability = ST_Tour_Availability::inst()
                    ->where('check_in >=', $check_in)
                    ->where('check_in <=', $check_out)
                    ->where('post_id', $tour_id)
                    ->where('status', 'available')
                    ->groupby('check_in')
                    ->get()->result();

                if (!empty($availability)) {
                    foreach ($availability as $key => $val) {
                        $status = $val['status'];

//                            $val['price']=st_apply_discount($val['price'],$discount_type,$discount,$val['check_in'],$is_sale_schedule,$sale_price_from,$sale_price_to);
//                            $val['adult_price']=st_apply_discount($val['adult_price'],$discount_type,$discount,$val['check_in'],$is_sale_schedule,$sale_price_from,$sale_price_to);
//                            $val['child_price']=st_apply_discount($val['child_price'],$discount_type,$discount,$val['check_in'],$is_sale_schedule,$sale_price_from,$sale_price_to);
//                            $val['infant_price']=st_apply_discount($val['infant_price'],$discount_type,$discount,$val['check_in'],$is_sale_schedule,$sale_price_from,$sale_price_to);
//
                        if (intval($val['groupday']) == 1) {
                            $return[] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'date' => date('Y-m-d', $val['check_in']),
                                'day' => date('d', $val['check_in']),
                                'end' => date('Y-m-d', strtotime('+1 day', $val['check_out'])),
                                'date_end' => date('d', $val['check_out']),
                                'status' => $status,
                                'base_price' => ((float)$val['price'] < 0) ? 0 : (float)$val['price'],
                                'adult_price' => ((float)$val['adult_price'] < 0) ? 0 : (float)$val['adult_price'],
                                'child_price' => ((float)$val['child_price'] < 0) ? 0 : (float)$val['child_price'],
                                'infant_price' => ((float)$val['infant_price'] < 0) ? 0 : (float)$val['infant_price'],
                                'starttime' => $val['starttime'],
                            ];

                        } else {
                            $return[] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'date' => date('Y-m-d', $val['check_in']),
                                'day' => date('d', $val['check_in']),
                                'status' => $status,
                                'base_price' => ((float)$val['price'] < 0) ? 0 : (float)$val['price'],
                                'adult_price' => ((float)$val['adult_price'] < 0) ? 0 : (float)$val['adult_price'],
                                'child_price' => ((float)$val['child_price'] < 0) ? 0 : (float)$val['child_price'],
                                'infant_price' => ((float)$val['infant_price'] < 0) ? 0 : (float)$val['infant_price'],
                                'starttime' => $val['starttime'],
                            ];
                        }
                    }
                }
            }
            echo json_encode($return);
            die();
        }

        public function _get_availability_activity()
        {
            $return = [];
            $activity_id = STInput::request('activity_id', '');
            $activity_id = TravelHelper::post_origin($activity_id);

            $check_in = STInput::request('start', '');
            $check_out = STInput::request('end', '');

            if (get_post_type($activity_id) == 'st_activity') {

                $availability = ST_Activity_Availability::inst()
                    ->where('check_in >=', $check_in)
                    ->where('check_in <=', $check_out)
                    ->where('post_id', $activity_id)
                    ->where('status', 'available')
                    ->groupby('check_in')
                    ->get()->result();

                if (!empty($availability)) {
                    foreach ($availability as $key => $val) {
                        $status = $val['status'];

                        if (intval($val['groupday']) == 1) {
                            $return[] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'date' => date('Y-m-d', $val['check_in']),
                                'day' => date('d', $val['check_in']),
                                'end' => date('Y-m-d', strtotime('+1 day', $val['check_out'])),
                                'date_end' => date('d', $val['check_out']),
                                'status' => $status,
                                'adult_price' => ((float)$val['adult_price'] < 0) ? 0 : (float)$val['adult_price'],
                                'child_price' => ((float)$val['child_price'] < 0) ? 0 : (float)$val['child_price'],
                                'infant_price' => ((float)$val['infant_price'] < 0) ? 0 : (float)$val['infant_price'],
                                'starttime' => $val['starttime'],
                            ];

                        } else {
                            $return[] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'date' => date('Y-m-d', $val['check_in']),
                                'day' => date('d', $val['check_in']),
                                'status' => $status,
                                'adult_price' => ((float)$val['adult_price'] < 0) ? 0 : (float)$val['adult_price'],
                                'child_price' => ((float)$val['child_price'] < 0) ? 0 : (float)$val['child_price'],
                                'infant_price' => ((float)$val['infant_price'] < 0) ? 0 : (float)$val['infant_price'],
                                'starttime' => $val['starttime'],
                            ];
                        }
                    }
                }
            }
            echo json_encode($return);
            die();
        }

        public function _get_availability_tour_frontend()
        {
            check_ajax_referer('st_frontend_security', 'security');
            $tour_id = STInput::request('tour_id', '');
            $tour_id = TravelHelper::post_origin($tour_id, 'st_tours');
            $check_in = strtotime(STInput::request('start', ''));
            $check_out = strtotime(STInput::request('end', ''));

            $discount_type = get_post_meta($tour_id, 'discount_type', true);
            $discount = get_post_meta($tour_id, 'discount', true);
            $is_sale_schedule = get_post_meta($tour_id, 'is_sale_schedule', true);
            $sale_price_from = get_post_meta($tour_id, 'sale_price_from', true);
            $sale_price_to = get_post_meta($tour_id, 'sale_price_to', true);
            $events['events'] = [];

            if (get_post_type($tour_id) == 'st_tours') {

                $tour_type = get_post_meta($tour_id, 'tour_price_by', true);

                $booking_period = intval(get_post_meta($tour_id, 'tours_booking_period', true));

                $return = [];
                $dateRanges = [];

                $newCheckIn = strtotime('+ ' . $booking_period . ' day', strtotime(date('Y-m-d')));

                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $dateRanges[$i] = $i;
                }

                $availability = ST_Tour_Availability::inst()
                    ->where('check_in >=', $newCheckIn)
                    ->where('check_in <=', $check_out)
                    ->where('post_id', $tour_id)
                    ->groupby('check_in')
                    ->get()->result();

                if (!empty($availability)) {
                    foreach ($availability as $key => $val) {
                        $status = $val['status'];
                        if ($val['number'] > 0) {
                            if ($val['count_starttime'] > 1) {
                                if ((($val['number'] * $val['count_starttime']) - $val['number_booked']) <= 0) $status = 'disabled';
                            } else {
                                if (($val['number'] - $val['number_booked']) <= 0) $status = 'disabled';
                            }
                        }

                        $val['price'] = st_apply_discount($val['price'], $discount_type, $discount, $val['check_in'], $is_sale_schedule, $sale_price_from, $sale_price_to);
                        $val['adult_price'] = st_apply_discount($val['adult_price'], $discount_type, $discount, $val['check_in'], $is_sale_schedule, $sale_price_from, $sale_price_to);
                        $val['child_price'] = st_apply_discount($val['child_price'], $discount_type, $discount, $val['check_in'], $is_sale_schedule, $sale_price_from, $sale_price_to);
                        $val['infant_price'] = st_apply_discount($val['infant_price'], $discount_type, $discount, $val['check_in'], $is_sale_schedule, $sale_price_from, $sale_price_to);

                        if ($status == 'unavailable') {
                            $status = 'not_available';
                        }
                        $hideA = get_post_meta($tour_id, 'hide_adult_in_booking_form', true);
                        $hideC = get_post_meta($tour_id, 'hide_children_in_booking_form', true);
                        $hideI = get_post_meta($tour_id, 'hide_infant_in_booking_form', true);
                        if (intval($val['groupday']) == 1) {
                            $has_starttime = false;
                            for ($i = $val['check_in']; $i <= $val['check_out']; $i = strtotime('+1 day', $i)) {
                                unset($dateRanges[$i]);
                            }
                            $ev = __('Price: ', ST_TEXTDOMAIN) . ((float)$val['price'] > 0) ? TravelHelper::format_money($val['price']) : __('Free', ST_TEXTDOMAIN);
                            if (!empty($val['starttime'])) {
                                $ev .= '<i class="fa fa-clock-o"></i> ' . $val['starttime'];
                                $has_starttime = true;
                            }
                            if ($tour_type != 'fixed') {
                                $ev = '';
                                if ($hideA != 'on') {
                                    $ev = __('Adult: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['adult_price']) . '<br/>';
                                }

                                if ($hideC != 'on') {
                                    $ev .= __('Child: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['child_price']) . '<br/>';
                                }

                                if ($hideI != 'on') {
                                    $ev .= __('Infant: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['infant_price']) . '<br/>';
                                }
                                if (!empty($val['starttime'])) {
                                    $ev .= '<i class="fa fa-clock-o"></i> ' . $val['starttime'];
                                }
                            }

                            $events['events'][] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'end' => date('Y-m-d', $val['check_out']),
                                'event' => $ev,
                                'status' => $status,
                                'has_starttime' => $has_starttime,
                                'group' => 1
                            ];

                        } else {
                            $has_starttime = false;
                            unset($dateRanges[$val['check_in']]);
                            $ev = __('Price: ', ST_TEXTDOMAIN) . ((float)$val['price'] > 0) ? TravelHelper::format_money($val['price']) : __('Free', ST_TEXTDOMAIN);
                            if (!empty($val['starttime'])) {
                                $ev .= '<i class="fa fa-clock-o"></i>' . $val['starttime'];
                                $has_starttime = true;
                            }
                            if ($tour_type != 'fixed') {
                                $ev = '';
                                if ($hideA != 'on') {
                                    $ev = __('Adult: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['adult_price']) . '<br/>';
                                }
                                if ($hideC != 'on') {
                                    $ev .= __('Child: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['child_price']) . '<br/>';
                                }
                                if ($hideI != 'on') {
                                    $ev .= __('Infant: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['infant_price']) . '<br/>';
                                }
                                if (!empty($val['starttime'])) {
                                    $ev .= '<i class="fa fa-clock-o"></i>' . $val['starttime'];
                                }
                            }
                            $events['events'][] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'end' => date('Y-m-d', $val['check_in']),
                                'event' => $ev,
                                'status' => $status,
                                'has_starttime' => $has_starttime,
                                'group' => 0
                            ];
                        }
                    }
                }
                if (!empty($dateRanges)) {
                    foreach ($dateRanges as $date) {
                        $events['events'][] = [
                            'start' => date('Y-m-d', $date),
                            'end' => date('Y-m-d', $date),
                            'event' => __('Unavailable', ST_TEXTDOMAIN),
                            'status' => 'not_available'
                        ];
                    }
                }
            }
            echo json_encode($events);
            die();
        }

        public function _get_availability_activity_frontend()
        {
            $activity_id = STInput::request('tour_id', '');
            $activity_id = TravelHelper::post_origin($activity_id, 'st_activity');
            $check_in = strtotime(STInput::request('start', ''));
            $check_out = strtotime(STInput::request('end', ''));

            $events['events'] = [];

            if (get_post_type($activity_id) == 'st_activity') {
                $booking_period = intval(get_post_meta($activity_id, 'activity_booking_period', true));

                $return = [];
                $dateRanges = [];

                $newCheckIn = strtotime('+ ' . $booking_period . ' day', strtotime(date('Y-m-d')));

                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $dateRanges[$i] = $i;
                }

                $availability = ST_Activity_Availability::inst()
                    ->where('check_in >=', $newCheckIn)
                    ->where('check_in <=', $check_out)
                    ->where('post_id', $activity_id)
                    ->groupby('check_in')
                    ->get()->result();

                if (!empty($availability)) {
                    foreach ($availability as $key => $val) {
                        unset($dateRanges[$val['check_in']]);
                        $status = $val['status'];
                        if ($status == 'unavailable') {
                            $status = 'not_available';
                        }
                        if ($val['number'] > 0) {
                            if ($val['count_starttime'] > 1) {
                                if ((($val['number'] * $val['count_starttime']) - $val['number_booked']) <= 0) $status = 'disabled';
                            } else {
                                if (($val['number'] - $val['number_booked']) <= 0) $status = 'disabled';
                            }
                        }
                        $hideA = get_post_meta($activity_id, 'hide_adult_in_booking_form', true);
                        $hideC = get_post_meta($activity_id, 'hide_children_in_booking_form', true);
                        $hideI = get_post_meta($activity_id, 'hide_infant_in_booking_form', true);
                        if (intval($val['groupday']) == 1) {
                            $has_starttime = false;
                            unset($dateRanges[$val['check_out']]);
                            $ev = '';
                            if ($hideA != 'on') {
                                $ev = __('Adult: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['adult_price']) . '<br/>';
                            }
                            if ($hideC != 'on') {
                                $ev .= __('Child: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['child_price']) . '<br/>';
                            }
                            if ($hideI != 'on') {
                                $ev .= __('Infant: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['infant_price']) . '<br/>';
                            }


                            if (!empty($val['starttime'])) {
                                $ev .= '<i class="fa fa-clock-o"></i> ' . $val['starttime'];
                                $has_starttime = true;
                            }

                            $events['events'][] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'end' => date('Y-m-d', $val['check_out']),
                                'event' => $ev,
                                'status' => $status,
                                'has_starttime' => $has_starttime,
                                'group' => 1
                            ];

                        } else {
                            $has_starttime = false;
                            $ev = '';
                            if ($hideA != 'on') {
                                $ev = __('Adult: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['adult_price']) . '<br/>';
                            }
                            if ($hideC != 'on') {
                                $ev .= __('Child: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['child_price']) . '<br/>';
                            }
                            if ($hideI != 'on') {
                                $ev .= __('Infant: ', ST_TEXTDOMAIN) . TravelHelper::format_money($val['infant_price']) . '<br/>';

                            }

                            if (!empty($val['starttime'])) {
                                $ev .= '<i class="fa fa-clock-o"></i> ' . $val['starttime'];
                                $has_starttime = true;
                            }

                            $events['events'][] = [
                                'start' => date('Y-m-d', $val['check_in']),
                                'end' => date('Y-m-d', $val['check_in']),
                                'event' => $ev,
                                'status' => $status,
                                'has_starttime' => $has_starttime,
                                'group' => 0
                            ];
                        }
                    }
                }

                if (!empty($dateRanges)) {
                    foreach ($dateRanges as $date) {
                        $events['events'][] = [
                            'start' => date('Y-m-d', $date),
                            'end' => date('Y-m-d', $date),
                            'event' => __('Unavailable', ST_TEXTDOMAIN),
                            'status' => 'not_available'
                        ];
                    }
                }
            }
            echo json_encode($events);
            die();
        }

        static function _get_activity_starttime_by_date($activity_id, $check_in)
        {
            global $wpdb;
            $sql = "SELECT
				        starttime
                        FROM
                            {$wpdb->prefix}st_availability
                        WHERE
                            post_id = '{$activity_id}'
                        AND
                            check_in = '{$check_in}'
                        AND 
                            post_type = 'st_activity'";

            $result = $wpdb->get_results($sql);

            if (!empty($result)) {
                return $result[0]->starttime;
            } else {
                return '';
            }
        }

        static function _get_tour_cant_order($tour_id, $check_in, $max_people = 0)
        {
            if (!TravelHelper::checkTableDuplicate('st_tours')) return '';
            global $wpdb;
            $sql = "
					SELECT
						post_id,
						number_booked
					FROM
						{$wpdb->prefix}st_availability
					WHERE
						post_id = {$tour_id}
					AND 
						post_type = 'st_tours'
					AND (
						check_in = {$check_in}
						)
					AND number_booked >= (SELECT 
                        CASE WHEN LENGTH(starttime) != 'null' THEN (SUM(ROUND ((LENGTH(starttime) - LENGTH(REPLACE(starttime, ', ', ''))) / LENGTH(', '))) + 1) * {$max_people} ELSE {$max_people} END
					FROM {$wpdb->prefix}st_availability
					WHERE post_id = {$tour_id}
					AND check_in = {$check_in}
					AND post_type = 'st_tours')
					";
            $result = $wpdb->get_col($sql, 0);
            $list_date = [];
            if (is_array($result) && count($result)) {
                $list_date = $result;
            }

            return $list_date;
        }

        static function _get_activity_cant_order($activity_id, $check_in, $max_people = 0)
        {
            if (!TravelHelper::checkTableDuplicate('st_activity')) return '';
            global $wpdb;

            $sql = "SELECT
				st_booking_id AS tour_id,
				SUM(
					(
						adult_number + child_number + infant_number
					)
				) AS booked
			FROM
				{$wpdb->prefix}st_order_item_meta
			WHERE
				st_booking_id = '{$activity_id}'
			AND st_booking_post_type = 'st_activity'
			AND (
				STR_TO_DATE('{$check_in}', '%m/%d/%Y') = STR_TO_DATE(check_in, '%m/%d/%Y')
			)
			AND `status` NOT IN ('trash', 'canceled')
			HAVING
				{$max_people} - SUM(
					(
						adult_number + child_number + infant_number
					)
				) <= 0";

            $result = $wpdb->get_col($sql, 0);
            $list_date = [];
            if (is_array($result) && count($result)) {
                $list_date = $result;
            }

            return $list_date;
        }

        static function _getdataHotel($post_id, $check_in, $check_out)
        {
            global $wpdb;
            $sql = "
			SELECT
				`id`,
				`post_id`,
				`post_type`,
				`check_in`,
				`check_out`,
				`number`,
				`price`,
				`status`
			FROM
				{$wpdb->prefix}st_room_availability
			WHERE
			post_id = %d
			AND post_type='hotel_room'
			AND check_in >=%d and check_in <=%d";
            $results = $wpdb->get_results($wpdb->prepare($sql, [$post_id, $check_in, $check_out]));

            return $results;
        }

        static function _getdataRental($post_id, $check_in, $check_out)
        {


            global $wpdb;

            $where = "
                and check_in >=%d
                and check_in <=%d";
            if (get_post_meta($post_id, 'allow_full_day', true) != 'off') {
                $where = "
                        and check_in >= %d
                        and check_in < %d";
            }

            $sql = "
                SELECT
                    `id`,
                    `post_id`,
                    `check_in`,
                    `check_out`,
                    `number`,
                    `price`,
                    `status`
                FROM
                    {$wpdb->prefix}st_rental_availability
                WHERE
                post_id = %s
                {$where}
                ";
            $results = $wpdb->get_results($wpdb->prepare($sql, [$post_id, $check_in, $check_out]));

            return $results;
        }


        static function _getdataFlight($post_id, $check_in, $check_out)
        {
            global $wpdb;
            $sql = "
			SELECT
				`id`,
				`post_id`,
				`start_date`,
				`end_date`,
				`eco_price`,
				`business_price`,
				`status`
			FROM
				{$wpdb->prefix}st_flight_availability
			WHERE
			post_id = {$post_id}
			AND
			(
				(
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) < UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`start_date`), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) > UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`end_date`), '%Y-%m-%d'))
				)
				OR (
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`start_date`), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`end_date`), '%Y-%m-%d'))
				)
				OR (
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`start_date`), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(`end_date`), '%Y-%m-%d'))
				)
			)";
            $results = $wpdb->get_results($sql);

            return $results;
        }

        static function _getdataTourEachDate($tour_id, $check_in, $check_out)
        {
            global $wpdb;

            $sql = "
			SELECT
				`id`,
				`post_id`,
				`check_in`,
				`check_out`,
				`price`,
				`adult_price`,
				`child_price`,
				`infant_price`,
				`starttime`,
				`status`,
				`groupday`,
				`number`,
				`booking_period`,
				`number_booked`
			FROM
				{$wpdb->prefix}st_tour_availability
			WHERE
				post_id = '{$tour_id}'
			AND (
				(
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) < UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) > UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
				)
				OR (
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
				)
				OR (
					UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
					AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
				)
			)";
            $results = $wpdb->get_results($sql);

            return $results;
        }

        static function _getdataRentalEachDate($rental_id, $check_in, $check_out)
        {
            global $wpdb;

            $sql = "
			SELECT
				`id`,
				`post_id`,
				`check_in`,
				`check_out`,
				`price`,
				`status`,
				`priority`,
				`groupday`
			FROM
				{$wpdb->prefix}st_rental_availability
			WHERE
				post_id = %d
			AND
			 check_in >= %d
			 AND check_in <= %d";
            $results = $wpdb->get_results($wpdb->prepare($sql, $rental_id, $check_in, $check_out));

            return $results;
        }

        static function _getdataActivityEachDate($activity_id, $check_in, $check_out)
        {
            global $wpdb;

            $sql = "
                SELECT
                    `id`,
                    `post_id`,
                    `check_in`,
                    `check_out`,
                    `adult_price`,
                    `child_price`,
                    `infant_price`,
                    `starttime`,
                    `status`,
                    `groupday`
                FROM
                    {$wpdb->prefix}st_activity_availability
                WHERE
                    post_id = '{$activity_id}'
                AND (
                    (
                        UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) < UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
                        AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) > UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
                    )
                    OR (
                        UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_in}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
                        AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
                    )
                    OR (
                        UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME('{$check_out}'), '%Y-%m-%d')) BETWEEN UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d'))
                        AND UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d'))
                    )
                )";
            $results = $wpdb->get_results($sql);

            return $results;
        }

        static function _getDisableCustomDate($room_id, $month, $month2, $year, $year2, $date_format = false)
        {
            $date1 = $year . '-' . $month . '-01';
            $date2 = strtotime($year2 . '-' . $month2 . '-01');
            $date2 = date('Y-m-t', $date2);
            $date_time_format = TravelHelper::getDateFormat();
            if (!empty($date_format)) {
                $date_time_format = $date_format;
            }
            global $wpdb;
            $sql = "
                    SELECT
                        `check_in`,
                        `check_out`,
                        `number`,
                        `status`,
                        `priority`
                    FROM
                        {$wpdb->prefix}st_room_availability
                    WHERE
                        post_id = {$room_id}
        
                    AND (
                        (
                            '{$date1}' < DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
                            AND '{$date2}' > DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
                        )
                        OR (
                            '{$date1}' BETWEEN DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
                            AND DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
                        )
                        OR (
                            '$date2' BETWEEN DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
                            AND DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
                        )
                    )";

            $results = $wpdb->get_results($sql);
            $default_state = get_post_meta($room_id, 'default_state', true);

            if (!$default_state) $default_state = 'available';
            $list_date = [];

            $start = strtotime($date1);
            $end = strtotime($date2);
            if (is_array($results) && count($results)) {
                for ($i = $start; $i <= $end; $i = strtotime('+1 day', $i)) {
                    $in_date = false;
                    foreach ($results as $key => $val) {
                        $status = $val->status;
                        if ($i == $val->check_in && $i == $val->check_out) {
                            if ($status == 'unavailable') {
                                $date = $i;
                            } else {
                                unset($date);
                            }
                            if (!$in_date) {
                                $in_date = true;
                            }
                        }
                    }

                    if ($in_date && isset($date)) {
                        $list_date[] = date($date_time_format, $date);
                        unset($date);
                    } else {
                        if (!$in_date && $default_state == 'not_available') {
                            $list_date[] = date($date_time_format, $i);
                            unset($in_date);
                        }
                    }
                }
            } else {
                if ($default_state == 'not_available') {
                    for ($i = $start; $i <= $end; $i = strtotime('+1 day', $i)) {
                        $list_date[] = date($date_time_format, $i);
                    }
                }
            }

            return $list_date;
        }

        static function _getDisableCustomDateRental($rental_id, $month, $month2, $year, $year2, $date_format = false)
        {
            $date1 = $year . '-' . $month . '-01';
            $date2 = strtotime($year2 . '-' . $month2 . '-01');
            $date2 = date('Y-m-t', $date2);
            $date_time_format = TravelHelper::getDateFormat();
            if (!empty($date_format)) {
                $date_time_format = $date_format;
            }
            global $wpdb;
            $sql = "
			SELECT
				`check_in`,
				`check_out`,
				`number`,
				`status`
			FROM
				{$wpdb->prefix}st_rental_availability
			WHERE
				post_id = {$rental_id}

			AND (
				(
					'{$date1}' < DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
					AND '{$date2}' > DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
				)
				OR (
					'{$date1}' BETWEEN DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
					AND DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
				)
				OR (
					'$date2' BETWEEN DATE_FORMAT(FROM_UNIXTIME(check_in), '%Y-%m-%d')
					AND DATE_FORMAT(FROM_UNIXTIME(check_out), '%Y-%m-%d')
				)
			)";
            $results = $wpdb->get_results($sql);

            $list_date = [];

            $start = strtotime($date1);
            $end = strtotime($date2);

            if (is_array($results) && count($results)) {
                for ($i = $start; $i <= $end; $i = strtotime('+1 day', $i)) {
                    foreach ($results as $key => $val) {
                        $status = $val->status;
                        if ($i == $val->check_in && $i == $val->check_out) {
                            if ($status == 'unavailable') {
                                $list_date[] = date($date_time_format, $i);
                            } else {
                                unset($date);
                            }
                        } else {
                            if ($status == 'unavailable') {
                                for ($id = $val->check_in; $id <= $val->check_out; $id = strtotime('+1 day', $id)) {
                                    $list_date[] = date($date_time_format, $id);
                                }
                            }
                        }
                    }
                }
            }

            return $list_date;
        }

        public function _add_custom_price()
        {
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $status = STInput::request('calendar_status', 'available');
            if ($status == 'available') {
                if (filter_var($_POST['calendar_price'], FILTER_VALIDATE_FLOAT) === false) {
                    echo json_encode([
                        'type' => 'error',
                        'status' => 0,
                        'message' => __('The price field is not a number.', ST_TEXTDOMAIN)
                    ]);
                    die();
                }
            }
            $price = floatval(STInput::request('calendar_price', ''));
            $post_id = STInput::request('calendar_post_id', '');
            $post_id = TravelHelper::post_origin($post_id);

            $parent_id = get_post_meta($post_id, 'room_parent', true);

            for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                $data = [
                    'post_id' => $post_id,
                    'post_type' => 'hotel_room',
                    'check_in' => $i,
                    'check_out' => $i,
                    'price' => $price,
                    'status' => $status,
                    'parent_id' => $parent_id,
                    'is_base' => 0
                ];
                ST_Hotel_Room_Availability::inst()->insertOrUpdate($data);
            }

            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN)
            ]);
            die();
        }

        public function _add_custom_price_rental()
        {
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $status = STInput::request('calendar_status', 'available');
            if ($status == 'available') {
                if (filter_var($_POST['calendar_price'], FILTER_VALIDATE_FLOAT) === false) {
                    echo json_encode([
                        'type' => 'error',
                        'status' => 0,
                        'message' => __('The price field is not a number.', ST_TEXTDOMAIN)
                    ]);
                    die();
                }
            }
            $calendar_price = floatval(STInput::request('calendar_price', 0));

            if ($calendar_price < 0) $calendar_price = 0;

            $post_id = STInput::request('calendar_post_id', '');
            $groupday = STInput::request('calendar_groupday', '');

            ST_Rental_Availability::inst()->checkBeforeUpdate($post_id, $check_in);

            ST_Rental_Availability::inst()->checkRemoveDuplicateBeforeUpdate($post_id, $check_in, $check_out);

            if ($groupday == '1') {
                if (intval($check_in) - intval($check_out) == 0) {
                    $groupday = 0;
                } else {
                    for ($i = strtotime('+1 day', $check_in); $i <= $check_out; $i = strtotime('+1 day', $i)) {
                        ST_Rental_Availability::inst()->checkInDelete($post_id, $i);
                    }
                }
                $data = [
                    'post_id' => $post_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'price' => $calendar_price,
                    'status' => $status,
                    'is_base' => 0,
                    'groupday' => $groupday
                ];
                ST_Rental_Availability::inst()->insertOrUpdate($data);
            } else {
                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $data = [
                        'post_id' => $post_id,
                        'check_in' => $i,
                        'check_out' => $i,
                        'price' => $calendar_price,
                        'status' => $status,
                        'is_base' => 0,
                        'groupday' => 0
                    ];
                    ST_Rental_Availability::inst()->insertOrUpdate($data);
                }
            }

            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN),
                'price' => $calendar_price
            ]);
            die();
        }

        public function _add_custom_price_rental_old()
        {
            global $wpdb;
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $status = STInput::request('calendar_status', 'available');
            if ($status == 'available') {
                if (filter_var($_POST['calendar_price'], FILTER_VALIDATE_FLOAT) === false) {
                    echo json_encode([
                        'type' => 'error',
                        'status' => 0,
                        'message' => __('The price field is not a number.', ST_TEXTDOMAIN)
                    ]);
                    die();
                }
            }
            $price = floatval(STInput::request('calendar_price', ''));
            $post_id = STInput::request('calendar_post_id', '');

            for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                $hotels = self::_getdataRental($post_id, $i, $i);
                if (is_array($hotels) && count($hotels)) {
                    foreach ($hotels as $key => $val) {
                        if ($i == $val->check_in && $i == $val->check_out) {
                            $data = [
                                'price' => $price,
                                'status' => $status,
                            ];
                            $where = [
                                'id' => $val->id
                            ];
                            self::_updateData($where, $data);
                        } else {
                            $data = [
                                'post_id' => $post_id,
                                'post_type' => 'st_rental',
                                'check_in' => $i,
                                'check_out' => $i,
                                'price' => $price,
                                'status' => $status,
                            ];
                            self::_insertData($data);
                        }
                    }
                } else {
                    $data = [
                        'post_id' => $post_id,
                        'post_type' => 'st_rental',
                        'check_in' => $i,
                        'check_out' => $i,
                        'price' => $price,
                        'status' => $status,
                    ];
                    self::_insertData($data);
                }
            }

            for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {

            }
            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN)
            ]);
            die();
        }

        //Flight
        public function _add_custom_price_flight()
        {
            global $wpdb;
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $price = STInput::request('calendar_price', '');

            $status = STInput::request('calendar_status', 'available');
            if ($status == 'available') {
                $price = STInput::request('calendar_price', '');
                if (filter_var($price['economy'], FILTER_VALIDATE_FLOAT) === false) {
                    echo json_encode([
                        'type' => 'error',
                        'status' => 0,
                        'message' => __('The economy price field is not a number.', ST_TEXTDOMAIN)
                    ]);
                    die();
                }
                if (filter_var($price['business'], FILTER_VALIDATE_FLOAT) === false) {
                    echo json_encode([
                        'type' => 'error',
                        'status' => 0,
                        'message' => __('The business price field is not a number.', ST_TEXTDOMAIN)
                    ]);
                    die();
                }
            }
            $eco_price = floatval($price['economy']);
            $business_price = floatval($price['business']);
            $post_id = STInput::request('calendar_post_id', '');
            $post_id = TravelHelper::post_origin($post_id);

            for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                $hotels = self::_getdataFlight($post_id, $i, $i);
                if (is_array($hotels) && count($hotels)) {
                    foreach ($hotels as $key => $val) {
                        if ($i == $val->start_date && $i == $val->end_date) {
                            $data = [
                                'eco_price' => $eco_price,
                                'business_price' => $business_price,
                                'status' => $status,
                            ];
                            $where = [
                                'id' => $val->id
                            ];
                            self::_updateDataFlight($where, $data);
                        } else {
                            $data = [
                                'post_id' => $post_id,
                                'start_date' => $i,
                                'end_date' => $i,
                                'eco_price' => $eco_price,
                                'business_price' => $business_price,
                                'status' => $status,
                            ];
                            self::_insertDataFlight($data);
                        }
                    }
                } else {
                    $data = [
                        'post_id' => $post_id,
                        'start_date' => $i,
                        'end_date' => $i,
                        'eco_price' => $eco_price,
                        'business_price' => $business_price,
                        'status' => $status,
                    ];
                    self::_insertDataFlight($data);
                }
            }

            for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {

            }
            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN)
            ]);
            die();
        }

        public function _add_custom_price_tour()
        {
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $status = STInput::request('calendar_status', 'available');

            $adult_price = floatval(STInput::request('calendar_adult_price', 0));
            $child_price = floatval(STInput::request('calendar_child_price', 0));
            $infant_price = floatval(STInput::request('calendar_infant_price', 0));
            $base_price = floatval(STInput::request('calendar_base_price', 0));

            if ($adult_price < 0) $adult_price = 0;
            if ($child_price < 0) $child_price = 0;
            if ($infant_price < 0) $infant_price = 0;
            if ($base_price < 0) $base_price = 0;

            $post_id = STInput::request('calendar_post_id', '');

            $post_id = TravelHelper::post_origin($post_id);

            $groupday = STInput::request('calendar_groupday', '');

            $start_hour = STInput::request('calendar_starttime_hour', '');
            $start_minute = STInput::request('calendar_starttime_minute', '');
            $time_format = st()->get_option('time_format', '24h');
            if ($time_format == '12h') {
                $start_format = STInput::request('calendar_starttime_format', '');
            }

            $start_time = [];
            $start_time_str = '';
            $count_starttime = 1;
            if (!empty($start_hour) && !empty($start_minute)) {
                foreach ($start_hour as $k => $v) {
                    if ($time_format == '24h') {
                        array_push($start_time, $v . ':' . $start_minute[$k]);
                    } else {
                        array_push($start_time, $v . ':' . $start_minute[$k] . ' ' . $start_format[$k]);
                    }
                }
                if (!empty($start_time)) {
                    $start_time = array_unique($start_time);
                    sort($start_time);
                    if (!empty($start_time)) {
                        $start_time_str = implode(', ', array_filter($start_time));
                        $count_starttime = count($start_time);
                    }
                }
            }

            $max_people = get_post_meta($post_id, 'max_people', true);
            if (empty($max_people)) $max_people = 0;
            $booking_period = get_post_meta($post_id, 'tours_booking_period', true);
            if (empty($booking_period)) $booking_period = 0;

            ST_Tour_Availability::inst()->checkBeforeUpdate($post_id, $check_in);

            if ($groupday == '1') {
                if (intval($check_in) - intval($check_out) == 0) {
                    $groupday = 0;
                } else {
                    for ($i = strtotime('+1 day', $check_in); $i <= $check_out; $i = strtotime('+1 day', $i)) {
                        ST_Tour_Availability::inst()->checkInDelete($post_id, $i);
                    }
                }
                $data = [
                    'post_id' => $post_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'price' => $base_price,
                    'adult_price' => $adult_price,
                    'child_price' => $child_price,
                    'infant_price' => $infant_price,
                    'status' => $status,
                    'groupday' => $groupday,
                    'is_base' => 0,
                    'number' => $max_people,
                    'booking_period' => $booking_period,
                    'count_starttime' => $count_starttime,
                    'starttime' => trim($start_time_str),
                ];
                ST_Tour_Availability::inst()->insertOrUpdate($data);
            } else {
                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $data = [
                        'post_id' => $post_id,
                        'check_in' => $i,
                        'check_out' => $i,
                        'price' => $base_price,
                        'adult_price' => $adult_price,
                        'child_price' => $child_price,
                        'infant_price' => $infant_price,
                        'status' => $status,
                        'groupday' => 0,
                        'is_base' => 0,
                        'number' => $max_people,
                        'booking_period' => $booking_period,
                        'count_starttime' => $count_starttime,
                        'starttime' => trim($start_time_str),
                    ];
                    ST_Tour_Availability::inst()->insertOrUpdate($data);
                }
            }
            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN)
            ]);
            die();
        }

        public function _add_custom_price_activity()
        {
            $check_in = STInput::request('calendar_check_in', '');
            $check_out = STInput::request('calendar_check_out', '');
            if (empty($check_in) || empty($check_out)) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check in or check out field is not empty.', ST_TEXTDOMAIN)
                ]);
                die();
            }
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            if ($check_in > $check_out) {
                echo json_encode([
                    'type' => 'error',
                    'status' => 0,
                    'message' => __('The check out is later than the check in field.', ST_TEXTDOMAIN)
                ]);
                die();
            }

            $status = STInput::request('calendar_status', 'available');

            $adult_price = floatval(STInput::request('calendar_adult_price', ''));
            $child_price = floatval(STInput::request('calendar_child_price', ''));
            $infant_price = floatval(STInput::request('calendar_infant_price', ''));
            $post_id = STInput::request('calendar_post_id', '');
            $post_id = TravelHelper::post_origin($post_id);
            $groupday = STInput::request('calendar_groupday', '');

            $start_hour = STInput::request('calendar_starttime_hour', '');
            $start_minute = STInput::request('calendar_starttime_minute', '');
            $time_format = st()->get_option('time_format', '24h');
            if ($time_format == '12h') {
                $start_format = STInput::request('calendar_starttime_format', '');
            }

            $start_time = [];
            $start_time_str = '';
            $count_starttime = 1;
            if (!empty($start_hour) && !empty($start_minute)) {
                foreach ($start_hour as $k => $v) {
                    if ($time_format == '24h') {
                        array_push($start_time, $v . ':' . $start_minute[$k]);
                    } else {
                        array_push($start_time, $v . ':' . $start_minute[$k] . ' ' . $start_format[$k]);
                    }
                }
                if (!empty($start_time)) {
                    $start_time = array_unique($start_time);
                    sort($start_time);
                    if (!empty($start_time)) {
                        $start_time_str = implode(', ', array_filter($start_time));
                        $count_starttime = count($start_time);
                    }
                }
            }

            $max_people = get_post_meta($post_id, 'max_people', true);
            if (empty($max_people)) $max_people = 0;
            $booking_period = get_post_meta($post_id, 'activity_booking_period', true);
            if (empty($booking_period)) $booking_period = 0;

            ST_Activity_Availability::inst()->checkBeforeUpdate($post_id, $check_in);

            if ($groupday == '1') {
                if (intval($check_in) - intval($check_out) == 0) {
                    $groupday = 0;
                } else {
                    for ($i = strtotime('+1 day', $check_in); $i <= $check_out; $i = strtotime('+1 day', $i)) {
                        ST_Activity_Availability::inst()->checkInDelete($post_id, $i);
                    }
                }
                $data = [
                    'post_id' => $post_id,
                    'check_in' => $check_in,
                    'check_out' => $check_out,
                    'adult_price' => $adult_price,
                    'child_price' => $child_price,
                    'infant_price' => $infant_price,
                    'status' => $status,
                    'groupday' => $groupday,
                    'is_base' => 0,
                    'number' => $max_people,
                    'booking_period' => $booking_period,
                    'count_starttime' => $count_starttime,
                    'starttime' => trim($start_time_str),
                ];
                ST_Activity_Availability::inst()->insertOrUpdate($data);
            } else {
                for ($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)) {
                    $data = [
                        'post_id' => $post_id,
                        'check_in' => $i,
                        'check_out' => $i,
                        'adult_price' => $adult_price,
                        'child_price' => $child_price,
                        'infant_price' => $infant_price,
                        'status' => $status,
                        'groupday' => 0,
                        'is_base' => 0,
                        'number' => $max_people,
                        'booking_period' => $booking_period,
                        'count_starttime' => $count_starttime,
                        'starttime' => trim($start_time_str),
                    ];
                    ST_Activity_Availability::inst()->insertOrUpdate($data);
                }
            }
            echo json_encode([
                'type' => 'success',
                'status' => 1,
                'message' => __('Successfully', ST_TEXTDOMAIN)
            ]);
            die();
        }

        static function _insertData($data = [], $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;
            $table = $wpdb->prefix . $table;
            $wpdb->insert($table, $data);
        }

        static function _insertDataFlight($data = [])
        {
            global $wpdb;
            $table = $wpdb->prefix . 'st_flight_availability';
            $wpdb->insert($table, $data);
        }

        static function _updateData($where = [], $data = [], $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;
            $table = $wpdb->prefix . $table;
            $wpdb->update($table, $data, $where);
        }

        static function _updateDataFlight($where = [], $data = [])
        {
            global $wpdb;
            $table = $wpdb->prefix . 'st_flight_availability';
            $wpdb->update($table, $data, $where);
        }

        static function _deleteData($id, $table = null)
        {
            if (empty($table))
                $table = 'st_availability';
            global $wpdb;
            $table = $wpdb->prefix . $table;
            $where = [
                'id' => $id
            ];
            $wpdb->delete($table, $where);
        }

        static function _deleteDataFlight($id)
        {
            global $wpdb;
            $table = $wpdb->prefix . 'st_flight_availability';
            $where = [
                'id' => $id
            ];
            $wpdb->delete($table, $where);
        }

        /**
         * @param $data is array, has ('check_in', 'check_out') object field
         **/
        static function getMinMaxFromData($data = [])
        {
            $minmax = [
                'min' => 0,
                'max' => 0
            ];
            if (is_array($data) && count($data)) {
                foreach ($data as $key => $val) {
                    if ($minmax['min'] == 0) $minmax['min'] = intval($val->$check_in);
                    if ($minmax['min'] > intval($val->check_in)) $minmax['min'] = intval($val->check_in);
                    if ($minmax['min'] > intval($val->check_out)) $minmax['min'] = intval($val->check_out);
                    if ($minmax['max'] == 0) $minmax['max'] = intval($val->$check_in);
                    if ($minmax['max'] < intval($val->check_in)) $minmax['max'] = intval($val->check_in);
                    if ($minmax['max'] < intval($val->check_out)) $minmax['max'] = intval($val->check_out);
                }
            }

            return $minmax;
        }

        /* Available activity by month */
        public static function get_current_availability($post_id, $max_people)
        {
            global $wpdb;
            $where_book_limit = '';
            if ($max_people > 0) {
                $where_book_limit = " AND number_booked < number * count_starttime ";
            }

            $table = $wpdb->prefix . 'st_tour_availability';
            $post_type = get_post_type($post_id);
            $booking_period = intval(get_post_meta($post_id, 'tours_booking_period', true));

            if ($post_type != 'st_tours') {
                $table = $wpdb->prefix . 'st_activity_availability';
                $booking_period = intval(get_post_meta($post_id, 'activity_booking_period', true));
            }

            $newCheckIn = strtotime('+ ' . $booking_period . ' day', strtotime(date('Y-m-d')));

            $sql = "
                    SELECT check_in
                    FROM 
                    	{$table}
                    WHERE
                    	post_id = {$post_id}
                  		{$where_book_limit}                  		
                  	AND 
                  		status = 'available'
                  	AND 
                  		check_in >= {$newCheckIn}
                  	ORDER BY 
                  		check_in ASC
                  	LIMIT 1";

            $results = $wpdb->get_col($sql, 0);
            if (!empty($results)) {
                return date('Y-m-d', $results[0]);
            } else {
                return date('Y-m-d');
            }
        }

        public static function syncAvailabilityOrder($data)
        {
            if ($data['st_booking_id']) {
                global $wpdb;
                $post_type = $data['st_booking_post_type'];
                $table = $wpdb->prefix . 'st_availability';

                switch ($post_type) {
                    case 'st_tours':
                    case 'st_activity':
                        $table = $wpdb->prefix . 'st_tour_availability';
                        if ($post_type == 'st_activity') {
                            $table = $wpdb->prefix . 'st_activity_availability';
                        }
                        $booked = ($data['adult_number'] + $data['child_number'] + $data['infant_number']);
                        $sql = $wpdb->prepare("UPDATE {$table} SET number_booked = IFNULL(number_booked, 0) + %d WHERE post_id = %d AND check_in = %s", $booked, $data['st_booking_id'], $data['check_in_timestamp']);
                        $wpdb->query($sql);
                        break;
                    case "st_hotel":
                    case "hotel_room":
                        $table = $wpdb->prefix . 'st_room_availability';
                        if (!empty($data['room_origin'])) {
                            $booked = !empty($data['room_num_search']) ? intval($data['room_num_search']) : 1;

                            $booked_temp = $booked;

                            for ($i = $data['check_in_timestamp']; $i <= $data['check_out_timestamp']; $i = strtotime('+1 day', $i)) {
                                /*if($i > $data['check_in_timestamp'] and $i < $data['check_out_timestamp'] and get_post_meta($data['st_booking_id'],'allow_full_day',true) != 'off'){
                                        $booked = $booked * 2;
                                    }else{
                                        $booked = $booked_temp;
                                    }*/
                                $sql = $wpdb->prepare("UPDATE {$table} SET number_booked = IFNULL(number_booked, 0) + %d WHERE post_id = %d AND check_in = %s", $booked, $data['room_origin'], $i);
                                $wpdb->query($sql);
                            }

                            // Check allowed to set Number End
                            if (get_post_meta($data['st_booking_id'], 'allow_full_day', true) != 'off') {
                                for ($i = $data['check_in_timestamp']; $i <= $data['check_out_timestamp']; $i = strtotime('+1 day', $i)) {
                                    $sql = $wpdb->prepare("UPDATE {$table} SET number_end = IFNULL(number_end, 0) + %d WHERE post_id = %d AND check_in = %s", $booked, $data['room_origin'], $i);
                                    $wpdb->query($sql);
                                }
                            }

                        }

                        break;
                }

            }
            //  update set number_booked=number_booked+2
        }

        public static function syncAvailabilityAfterCanceled($order_id)
        {
            if ($order_id) {
                global $wpdb;
                $table = $wpdb->prefix . 'st_availability';
                $model = ST_Order_Item_Model::inst();
                $order_item = $model->where('order_item_id', $order_id)->get(1)->row();
                $post_id = $order_item['origin_id'];
                $post_type = $order_item['st_booking_post_type'];
                switch ($post_type) {
                    case 'st_tours':
                    case 'st_activity':
                        $table = $wpdb->prefix . 'st_tour_availability';
                        if ($post_type == 'st_activity') {
                            $table = $wpdb->prefix . 'st_activity_availability';
                        }

                        $adult_number = $order_item['adult_number'];
                        $child_number = $order_item['child_number'];
                        $infant_number = $order_item['infant_number'];

                        $number_had_boooked = $adult_number + $child_number + $infant_number;
                        $sql = $wpdb->prepare("UPDATE {$table} SET number_booked = number_booked - %d WHERE post_id = %d AND check_in = %s", $number_had_boooked, $post_id, $order_item['check_in_timestamp']);
                        $wpdb->query($sql);
                        break;
                    case 'st_hotel':
                    case 'hotel_room':
                        $number = $order_item['room_num_search'];
                        $post_id = $order_item['room_origin'];

                        $sql = $wpdb->prepare("UPDATE {$table} SET number_booked = number_booked - %d WHERE post_id = %d AND check_in = %s", $number, $post_id, $order_item['check_in_timestamp']);
                        $wpdb->query($sql);

                        // Set Start End
                        $sql = $wpdb->prepare("UPDATE {$table} SET number_end = number_end - %d WHERE post_id = %d AND check_in = %s", $number, $post_id, $order_item['check_out_timestamp']);
                        $wpdb->query($sql);
                        break;

                }
            }
        }
    }

    new AvailabilityHelper();
}