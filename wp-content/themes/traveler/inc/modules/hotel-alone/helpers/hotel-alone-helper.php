<?php
if (!class_exists('Hotel_Alone_Helper')) {
    class Hotel_Alone_Helper
    {
	    static $_inst;
	    public $asset_url;

	    public $inline_css;
	    public $current_css_id;
	    public $prefix_class = "st_";

	    function __construct()
	    {
		    $this->set_css_id();
		    add_action('wp_footer', array($this, '_action_footer_css'));
		    if(is_admin()) {
			    add_action('admin_footer', array($this, '_action_footer_css'));
		    }

		    $this->asset_url = st_hotel_alone_load_assets_dir();

            add_action( 'wp_ajax_ajax_search_room_hotel_alone', array($this, 'ajax_search_room_hotel_alone') );
            add_action( 'wp_ajax_nopriv_ajax_search_room_hotel_alone', array($this, 'ajax_search_room_hotel_alone') );

	    }

        function ajax_search_room_hotel_alone(){
            if ( STInput::post( 'room_search' ) ) {
                if ( !wp_verify_nonce( STInput::post( 'room_search' ), 'room_search' ) ) {
                    $result = [
                        'status' => 0,
                        'data'   => "",
                    ];
                    echo json_encode( $result );
                    die;
                }
                $result = [
                    'status' => 1,
                    'data'   => "",
                ];
                if ( empty( $hotel_id ) ) $hotel_id = STInput::request( 'hotel_id', 0 );
                $room_data = $this->search_room_by_id( $hotel_id );

                $style = STInput::request('helios-style', 'style-1');

                if(!empty($room_data)){
                    if($room_data['status']){
                        $query = $room_data['data'];
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $result[ 'data' ] .= st_hotel_alone_load_view( 'elements/st-reservation-content/style/' . $style, false );
                            }
                            $result[ 'pagination' ] = hotel_alone_pagination_room( $query );
                        } else {
                            $result = [
                                'status'         => 0,
                                'data'           => '',
                                'message'        => esc_html__( 'Our system does not find any rooms from your searching. You can change search feature now.', ST_TEXTDOMAIN ),
                                'status_message' => 'default',
                            ];
                            echo json_encode( $result );
                            die;
                        }
                    }else{
                        $result = [
                            'status'         => 0,
                            'data'           => '',
                            'message'        => $room_data['message']
                        ];
                        echo json_encode( $result );
                        die;
                    }
                }
                wp_reset_query();
                echo json_encode( $result );
                wp_die();
            }
        }

        function _alter_search_query_ajax($where)
        {
            global $wpdb;
            $hotel_id = 9861;

            if (STInput::request('start') and STInput::request('end')) {
                $check_in = date('Y-m-d', strtotime(TravelHelper::convertDateFormat(STInput::request('start'))));
                $check_out = date('Y-m-d', strtotime(TravelHelper::convertDateFormat(STInput::request('end'))));
                $adult_num = STInput::request('adult_number', 0);
                $child_num = STInput::request('child_number', 0);
                $number_room = STInput::request('room_num_search', 0);

                $list = HotelHelper::_hotelValidateByID($hotel_id, strtotime($check_in), strtotime($check_out), $adult_num, $child_num, $number_room);
                if (!is_array($list) || count($list) <= 0) {
                    $list = "''";
                } else {
                    $list = implode(',', $list);
                }
                $where .= " AND {$wpdb->prefix}posts.ID NOT IN ({$list})";
            }

            return $where;
        }

        function search_room($param = [])
        {
            $hotel_id = $param['service_id'];

            $arg = array(
                'post_type'      => 'hotel_room',
                'posts_per_page' => $param['number_post'],
                'post_status'    => 'publish',
                'meta_key'=>'room_parent',
                'meta_value'=>$hotel_id,
                'orderby' => $param['order_by'],
                'order' => $param['order'],
            );

            $check = (explode(",",$param['select_category']));
            if(!in_array('_0_',$check) and !empty($param['select_category']))
            {
                $arg['tax_query'][]=array(
                    'taxonomy'=>'room_type',
                    'field'  =>'slug',
                    'terms'=>explode(",",$param['select_category'])
                );
            }
            global $wp_query;
            query_posts($arg);
        }

	    function url($file = false)
	    {
		    return $this->asset_url . '/' . $file;
	    }

	    function build_css($string = false, $effect = false)
	    {
		    $this->current_css_id++;
		    $this->inline_css .= "
                ." . $this->prefix_class . $this->current_css_id . $effect . "{
                    {$string}
                }
        ";
		    return $this->prefix_class . $this->current_css_id;
	    }

	    function add_css($string = false)
	    {
		    $this->inline_css .= $string;

	    }

	    function _action_footer_css()
	    {
		    ?>
		    <style id="stassets_footer_css">
			    <?php echo ($this->inline_css);?>
		    </style>
		    <?php
	    }

	    function reset_css(){
		    $this->inline_css = '';
	    }

        function set_css_id(){
            if(hotel_alone_is_ajax()){
                $this->current_css_id = time() + 3600;
            }else{
                $this->current_css_id = time();
            }
        }

        function get_weather_html($location_id, $style = false, $both = false){
            $weather = TravelHelper::get_location_temp($location_id);
            $temp_format = st()->get_option('st_weather_temp_unit', 'c');
            if(!empty($weather)) {
                if($style == 'style-1' && $both = true){
                    ?>
                    <div class="st-weather">
                        <span class="icon-weather"><?php echo balanceTags($weather['icon']); ?></span>
                        <span class="score-weather"><?php echo balanceTags($weather['temp']) ?><sup>o</sup> C &nbsp;&nbsp;|&nbsp;&nbsp;  <?php echo balanceTags($weather['temp_k']) ?><sup>o</sup> F</span>
                    </div>
                    <?php
                }else {
                    ?>
                    <div class="w-detail">
                        <span class="icon"><?php echo balanceTags($weather['icon']); ?></span>
                        <span><?php echo balanceTags($weather['temp']) ?>
                            <sup>o</sup><span><?php echo esc_html(strtoupper($temp_format)); ?></span><span
                                    class="status"><?php echo esc_attr(get_the_title($location_id)); ?></span></span>
                    </div>
                    <?php
                }
            }

        }

        function search_room_by_id( $hotel_id = false )
        {
            if ( empty( $hotel_id ) ) $hotel_id = get_the_ID();

            $check_in  = STInput::request( 'checkin_m' ) . "/" . STInput::request( 'checkin_d' ) . "/" . STInput::request( 'checkin_y' );
            $check_out = STInput::request( 'checkout_m' ) . "/" . STInput::request( 'checkout_d' ) . "/" . STInput::request( 'checkout_y' );

            if ( $check_in == '//' ) $check_in = '';
            if ( $check_out == '//' ) $check_out = '';

            if($check_in != '' && $check_out != '') {
                $today = date('m/d/Y');
                $date_diff = STDate::dateDiff($check_in, $check_out);
                $booking_period = intval(get_post_meta($hotel_id, 'hotel_booking_period', TRUE));
                $period = STDate::dateDiff($today, $check_in);

                $is_minimum_stay = true;
                $minimun_stay = intval(get_post_meta($hotel_id, 'min_book_room', TRUE));
                if ($minimun_stay && $date_diff < $minimun_stay) {
                    $is_minimum_stay = false;
                }

                if ($booking_period && $period < $booking_period) {
                    $result = [
                        'status' => false,
                        'message' => sprintf(__('This hotel allow minimum booking is %d day(s)', ST_TEXTDOMAIN), $booking_period),
                        'data' => ''
                    ];
                    return $result;
                }

                if ($date_diff < 1) {
                    $result = [
                        'status' => false,
                        'data' => "",
                        'message' => __('Make sure your check-out date is at least 1 day after check-in.', ST_TEXTDOMAIN),
                    ];
                    return $result;
                }

                if(!$is_minimum_stay){
                    $result = [
                        'status' => false,
                        'data' => "",
                        'message' => sprintf(__('Please book at least %d day(s) in total.', ST_TEXTDOMAIN), $minimun_stay),
                    ];
                    return $result;
                }
            }

            $page          = STInput::request( 'wpbooking_paged' );

            $arg = [
                'post_type' => 'hotel_room',
                'posts_per_page' => '4',
                'paged'          => $page,
                'meta_value'=>$hotel_id,
                'meta_key'=>'room_parent',
                'post__not_in' => array()
            ];

            if($check_in != '' && $check_out != '') {
                $check_in_valid = date('Y-m-d', strtotime($check_in));
                $check_out_vaild = date('Y-m-d', strtotime($check_out));
                $adult_num = STInput::request('adults', 0);
                $child_num = STInput::request('children', 0);
                $number_room = STInput::request('room_number', 0);
                $list = HotelHelper::_hotelValidateByID($hotel_id, strtotime($check_in_valid), strtotime($check_out_vaild), $adult_num, $child_num, $number_room);
                $list = array_unique($list);
                if (is_array($list) && count($list) > 0) {
                    $arg['post__not_in'] = $list;
                }
            }

            $query = new WP_Query($arg);

            if($query->post_count > 0){
                $result = [
                    'status' => true,
                    'data' => $query,
                    'message' => '',
                ];
            }else{
                $result = [
                    'status' => false,
                    'data' => $query,
                    'message' => esc_html__( 'Our system does not find any rooms from your searching. You can change search feature now.', ST_TEXTDOMAIN ),
                ];
            }
            return $result;
        }

        function seach_room_hotel_activity_by_id($hotel_id = false, $number){
            if ( empty( $hotel_id ) ) $hotel_id = get_the_ID();

            $check_in  = STInput::request( 'checkin_m' ) . "/" . STInput::request( 'checkin_d' ) . "/" . STInput::request( 'checkin_y' );
            $check_out = STInput::request( 'checkout_m' ) . "/" . STInput::request( 'checkout_d' ) . "/" . STInput::request( 'checkout_y' );

            if ( $check_in == '//' ) $check_in = '';
            if ( $check_out == '//' ) $check_out = '';

            if($check_in != '' && $check_out != '') {
                $today = date('m/d/Y');
                $date_diff = STDate::dateDiff($check_in, $check_out);
                $booking_period = intval(get_post_meta($hotel_id, 'hotel_booking_period', TRUE));
                $period = STDate::dateDiff($today, $check_in);

                $is_minimum_stay = true;
                $minimun_stay = intval(get_post_meta($hotel_id, 'min_book_room', TRUE));
                if ($minimun_stay && $date_diff < $minimun_stay) {
                    $is_minimum_stay = false;
                }

                if ($booking_period && $period < $booking_period) {
                    $result = [
                        'status' => false,
                        'message' => sprintf(__('This hotel allow minimum booking is %d day(s)', ST_TEXTDOMAIN), $booking_period),
                        'data' => ''
                    ];
                    return $result;
                }

                if ($date_diff < 1) {
                    $result = [
                        'status' => false,
                        'data' => "",
                        'message' => __('Make sure your check-out date is at least 1 day after check-in.', ST_TEXTDOMAIN),
                    ];
                    return $result;
                }

                if(!$is_minimum_stay){
                    $result = [
                        'status' => false,
                        'data' => "",
                        'message' => sprintf(__('Please book at least %d day(s) in total.', ST_TEXTDOMAIN), $minimun_stay),
                    ];
                    return $result;
                }
            }

            $page          = STInput::request( 'wpbooking_paged' );

            $arg = [
                'post_type' => 'hotel_room',
                'posts_per_page' =>$number,
                'paged'          => $page,
                'meta_value'=>$hotel_id,
                'meta_key'=>'room_parent',
                'post__not_in' => array()
            ];

            if($check_in != '' && $check_out != '') {
                $check_in_valid = date('Y-m-d', strtotime($check_in));
                $check_out_vaild = date('Y-m-d', strtotime($check_out));
                $adult_num = STInput::request('adults', 0);
                $child_num = STInput::request('children', 0);
                $number_room = STInput::request('room_number', 0);
                $list = HotelHelper::_hotelValidateByID($hotel_id, strtotime($check_in_valid), strtotime($check_out_vaild), $adult_num, $child_num, $number_room);
                $list = array_unique($list);
                if (is_array($list) && count($list) > 0) {
                    $arg['post__not_in'] = $list;
                }
            }

            $query = new WP_Query($arg);

            if($query->post_count > 0){
                $result = [
                    'status' => true,
                    'data' => $query,
                    'message' => '',
                ];
            }else{
                $result = [
                    'status' => false,
                    'data' => $query,
                    'message' => esc_html__( 'Our system does not find any rooms from your searching. You can change search feature now.', ST_TEXTDOMAIN ),
                ];
            }
            return $result;
        }

        public function _get_number_room_left_on( $hotel_id = '', $room_id, $check_in = '', $check_out = '')
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
				";
            $results = $wpdb->get_results($sql, ARRAY_A);
            $max_room = get_post_meta($room_id, 'number_room', true);
            if(!empty($results)){
                foreach ($results as $key => $val){
                    if($val['room_id'] == $room_id){
                        if(isset($val['free_room'])){
                            $max_room = $val['free_room'];
                        }
                    }
                }
            }
            return $max_room;
        }

	    static function inst()
	    {
		    if (empty(self::$_inst)) {
			    self::$_inst = new self();
		    }

		    return self::$_inst;
	    }
    }

	Hotel_Alone_Helper::inst();

	if (!function_exists('Hotel_Alone_Helper')) {
		function Hotel_Alone_Helper()
		{
			return Hotel_Alone_Helper::inst();
		}
	}
}