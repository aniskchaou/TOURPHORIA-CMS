<?php
    /*
    * @since 1.2.0
    */
    if ( !class_exists( 'STCarTransfer' ) ) {
        class STCarTransfer extends TravelerObject
        {
            static $_inst;
            static $_instance;

            protected $orderby;
            public $post_type = "car_transfer";

            function __construct()
            {
                $this->orderby = [
                    'ID'         => [
                        'key'  => 'ID',
                        'name' => __( 'Date', ST_TEXTDOMAIN )
                    ],
                    'price_asc'  => [
                        'key'  => 'price_asc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ) . ' (<i class="fa fa-long-arrow-down"></i>)'
                    ],
                    'price_desc' => [
                        'key'  => 'price_desc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ) . ' (<i class="fa fa-long-arrow-up"></i>)'
                    ],
                    'name_asc'   => [
                        'key'  => 'name_asc',
                        'name' => __( 'Name (A-Z)', ST_TEXTDOMAIN )
                    ],
                    'name_desc'  => [
                        'key'  => 'name_desc',
                        'name' => __( 'Name (Z-A)', ST_TEXTDOMAIN )
                    ],

                ];

                add_action( 'wp_ajax_add_to_cart_transfer', [ $this, 'add_to_cart' ] );
                add_action( 'wp_ajax_nopriv_add_to_cart_transfer', [ $this, 'add_to_cart' ] );

                add_action('st_wc_cart_item_information_car_transfer', [$this, '_show_wc_cart_item_information']);

                add_filter('st_post_type_' . $this->post_type . '_icon', [$this, '_change_icon']);

            }

            function _get_post_type_icon($type)
            {
                return "fa fa-car";
            }
            function _change_icon($icon)
            {
                return $icon = 'fa fa-car';
            }


            function _show_wc_cart_item_information($st_booking_data = [])
            {
                echo st()->load_template('car_transfer/wc_cart_item_information', false, ['st_booking_data' => $st_booking_data]);
            }

            public function init()
            {
                parent::init();
            }

            function get_cart_item_html( $item_id = false )
            {
                return st()->load_template( 'car_transfer/cart_item_html', null, [ 'item_id' => $item_id ] );
            }

            public function add_to_cart()
            {

                $car_id = (int)STInput::post( 'car_id' );
                if ( get_post_type( $car_id ) != 'st_cars' ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'This car is invalid', ST_TEXTDOMAIN )
                    ] );
                    die;
                }
                $check_in      = '';
                $check_in_n    = '';
                $check_in_time = '';
                if ( STInput::post( 'start', '' ) != '' ) {
                    $check_in   = TravelHelper::convertDateFormat( STInput::post( 'start', '' ) );
                    $check_in_n = $check_in;
                }
                if ( STInput::post( 'start-time', '' ) != '' ) {
                    $check_in .= ' ' . STInput::post( 'start-time', '' );
                    $check_in_time = STInput::post( 'start-time', '' );
                }

                $check_out      = '';
                $check_out_n    = '';
                $check_out_time = '';
                if ( STInput::post( 'end', '' ) != '' ) {
                    $check_out   = TravelHelper::convertDateFormat( STInput::post( 'end', '' ) );
                    $check_out_n = $check_out;
                }
                if ( STInput::post( 'end-time', '' ) != '' ) {
                    $check_out .= ' ' . STInput::post( 'end-time', '' );
                    $check_out_time = STInput::post( 'end-time', '' );
                }

                $check_out = date( 'Y-m-d H:i:s', strtotime( $check_out ) );

                $transfer_from = (int)STInput::post( 'transfer_from' );
                $transfer_to   = (int)STInput::post( 'transfer_to' );
                $passengers    = (int)STInput::post( 'passengers' );
                $roundtrip     = STInput::post( 'roundtrip', '' );

                if ( empty( $check_in ) || empty( $check_out ) ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'Start or End date is invalid', ST_TEXTDOMAIN )
                    ] );
                    die;
                }

                $transfer = $this->get_transfer( $car_id, $transfer_from, $transfer_to );

                if ( !$transfer ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'Destinations is invalid', ST_TEXTDOMAIN )
                    ] );
                    die;
                }

                if ( $passengers <= 0 ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'Minimum of passenger is 1', ST_TEXTDOMAIN )
                    ] );
                    die;
                }

                if ( $passengers > (int)$transfer->passenger ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => sprintf( __( 'Maximum of Passenger is %s', ST_TEXTDOMAIN ), (int)$transfer->passgenger )
                    ] );
                    die;
                }

                $distance = $this->get_driving_distance( $transfer_from, $transfer_to, $roundtrip );
                if ( empty( $distance ) || empty( $distance[ 'distance' ] ) ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'Can not book this transfer.', ST_TEXTDOMAIN )
                    ] );
                    die;
                }

                $today = date( 'm/d/Y' );

                $compare = TravelHelper::dateCompare( $today, $check_in_n );

                if ( $compare < 0 ) {
                    echo json_encode( [
                        'status'  => 0,
                        'class'   => 'mt20 alert alert-danger',
                        'message' => __( 'Please check your departure date and arrival date again', ST_TEXTDOMAIN )
                    ] );
                    die;

                }

                $discount_rate = STPrice::get_discount_rate( $car_id, strtotime( $check_in ) );

                $item_price = $this->get_transfer_total_price( $car_id, $transfer_from, $transfer_to, $roundtrip, $passengers );

                $data = [
                    'check_in'            => $check_in_n,
                    'check_out'           => $check_out_n,
                    'check_in_time'       => $check_in_time,
                    'check_out_time'      => $check_out_time,
                    'check_in_timestamp'  => strtotime( $check_in ),
                    'check_out_timestamp' => strtotime( $check_out ),
                    'transfer_from'       => $transfer_from,
                    'transfer_to'         => $transfer_to,
                    'pick_up'             => $this->get_transfer_name( $transfer_from ),
                    'drop_off'            => $this->get_transfer_name( $transfer_to ),
                    'base_price' => $item_price['base_price'],
                    'ori_price'           => $item_price[ 'total_price' ],
                    'item_price'          => $item_price[ 'total_price' ],
                    'sale_price'          => $item_price[ 'sale_price' ],
                    'passenger'           => $passengers,
                    'roundtrip'           => $roundtrip,
                    'numberday'           => 1,
                    'price_equipment'     => 0,
                    'data_equipment'      => [],
                    'price_destination'   => [],
                    'data_destination'    => $this->get_routes( $transfer_from, $transfer_to, $roundtrip ),
                    'commission'          => TravelHelper::get_commission( $car_id ),
                    'discount_rate'       => $discount_rate,
                    'distance'            => $this->get_driving_distance( $transfer_from, $transfer_to, $roundtrip ),
                    'car_id'              => $car_id,
                    'extras' => $item_price['extras_data'],
                    'extra_price' => $item_price['extra_price']
                ];

                STCart::add_cart( 'car_transfer', 1, $item_price[ 'sale_price' ], $data );

                $link = STCart::get_cart_link();

                echo json_encode(
                    [
                        'status'   => 1,
                        'redirect' => $link
                    ]
                );
                die;
            }

            public function get_extras_data(){
                $data = STInput::post('extra_price', '');
                $extras = [];
                if(isset($data['title']) and !empty($data['title'])){
                    foreach ($data['title'] as $k => $v){
                        if($data['value'][$k] > 0) {
                            $extras[] = array(
                                'title' => $v,
                                'number' => $data['value'][$k],
                                'price' => $data['price'][$k],
                            );
                        }
                    }
                }
                return $extras;
            }

            public function get_transfer_total_price( $car_id, $transfer_from, $transfer_to, $roundtrip, $passengers )
            {
                $price_type  = get_post_meta( $car_id, 'price_type', true );
                $transfer    = $this->get_transfer( $car_id, $transfer_from, $transfer_to );
                $price       = (float)$transfer->price;
                $total_price = 0;

                switch ( $price_type ) {
                    case 'distance':
                        $distance    = $this->get_driving_distance( $transfer_from, $transfer_to, $roundtrip );
                        $total_price = (float)$distance[ 'distance' ] * $price;
                        break;
                    case 'fixed':
                        if($roundtrip == 'roundtrip'){
                            $total_price = $price * 2;
                        }else{
                            $total_price = $price;
                        }
                        break;
                    case 'passenger':
                        $total_price = $price * $passengers;
                        break;
                }

                $base_price = $total_price;

                $extras = $this->get_extras_data();
                $price_extra = 0;
                if(!empty($extras)){
                    foreach ($extras as $k => $v){
                        if((int)$v['number'] > 0){
                            $price_extra += ((int)$v['number'] * (float)$v['price']);
                        }
                    }
                }

                $total_price+=$price_extra;
                $sale_price    = $total_price;
                $discount_rate = floatval( get_post_meta( $car_id, 'discount', true ) );

                if ( $discount_rate < 0 ) $discount_rate = 0;
                if ( $discount_rate > 100 ) $discount_rate = 100;

                $is_sale_schedule = get_post_meta( $car_id, 'is_sale_schedule', true );

                if ( $is_sale_schedule == false || empty( $is_sale_schedule ) ) $is_sale_schedule = 'off';

                if ( $is_sale_schedule == 'on' ) {
                    $sale_from = intval( strtotime( get_post_meta( $car_id, 'sale_price_from', true ) ) );
                    $sale_to   = intval( strtotime( get_post_meta( $car_id, 'sale_price_to', true ) ) );
                    if ( $sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to ) {
                        $sale_price = $total_price - ( $total_price * ( $discount_rate / 100 ) );
                    }
                } else {
                    $sale_price = $total_price - ( $total_price * ( $discount_rate / 100 ) );
                }

                return [
                    'base_price' => $base_price,
                    'total_price' => $total_price,
                    'sale_price'  => $sale_price,
                    'extra_price' => $price_extra,
                    'extras_data' => $extras,
                ];
            }

            public function getOrderby()
            {
                return $this->orderby;
            }

            function get_search_fields()
            {
                $fields = st()->get_option( 'car_transfer_search_fields' );

                return $fields;
            }

            static function get_search_fields_name()
            {
                return [
                    'transfer_from' => [
                        'value' => 'transfer_from',
                        'label' => __( 'From', ST_TEXTDOMAIN )
                    ],
                    'transfer_to'   => [
                        'value' => 'transfer_to',
                        'label' => __( 'To', ST_TEXTDOMAIN )
                    ],
                    'passenger'     => [
                        'value' => 'passenger',
                        'label' => __( 'Passengers', ST_TEXTDOMAIN )
                    ],
                    'checkin_out'   => [
                        'value' => 'checkin_out',
                        'label' => __( 'Date', ST_TEXTDOMAIN )
                    ],
                ];
            }

            function get_result_string()
            {
                global $wp_query, $st_search_query;
                if ( $st_search_query ) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                $result_string = $p1 = $p2 = $p3 = $p4 = '';
                if ( $query->found_posts ) {
                    if ( $query->found_posts > 1 ) {
                        $p1 = esc_html( $query->found_posts ) . __( ' cars ', ST_TEXTDOMAIN );
                    } else {
                        $p1 = esc_html( $query->found_posts ) . __( ' car ', ST_TEXTDOMAIN );
                    }
                } else {
                    $p1 = __( 'No car found', ST_TEXTDOMAIN );
                }
                $transfer_from = STInput::get( 'transfer_from' );
                $transfer_to   = STInput::get( 'transfer_to' );

                if ( $transfer_from and $transfer_to ) {
                    $p2 = sprintf( __( ' from %s to %s', ST_TEXTDOMAIN ), $this->get_transfer_name( $transfer_from ), $this->get_transfer_name( $transfer_to ) );
                }
                $start = TravelHelper::convertDateFormat( STInput::get( 'start' ) );
                $end   = TravelHelper::convertDateFormat( STInput::get( 'end' ) );
                $start = strtotime( $start );
                $end   = strtotime( $end );

                if ( $start and $end ) {
                    $p3 .= __( ' on ', ST_TEXTDOMAIN ) . date_i18n( 'M d', $start );
                    if(STInput::get('roundtrip', '') == 'roundtrip'){
	                    $p3 .= ' - ' . date_i18n( 'M d', $end );
                    }
                }
                // check Right to left
                if ( st()->get_option( 'right_to_left' ) == 'on' || is_rtl() ) {
                    return $p1 . ' ' . ' ' . $p3 . ' ' . $p2;
                }

                return esc_html( $p1 . ' ' . $p2 . ' ' . $p3 . ' ' . $p4 );
            }

            public function get_transfer_name( $transfer_id )
            {
            	$car_transfer_by_location = st()->get_option('car_transfer_by_location', 'off');
            	if($car_transfer_by_location == 'off') {
		            if ( get_post_type( $transfer_id ) == 'st_hotel' ) {
			            return get_the_title( $transfer_id );
		            } else {
			            $terms = get_term_by( 'id', $transfer_id, 'st_airport' );
			            if ( ! empty( $terms ) ) {
				            return $terms->name;
			            }
		            }
	            }else{
            		if(!empty($transfer_id)){
            			return get_the_title($transfer_id);
		            }
	            }

                return '';
            }

            public function get_transfer_by_id( $transfer_id )
            {
                global $wpdb;
                $sql = "SELECT * FROM {$wpdb->prefix}st_journey_car WHERE 1=1 AND (transfer_from = {$transfer_id} OR transfer_to = {$transfer_id}) LIMIT 1";

                return $wpdb->get_row( $sql );
            }

            public function get_transfer( $car_id, $from, $to )
            {
                global $wpdb;
                $sql = "SELECT * FROM {$wpdb->prefix}st_journey_car WHERE 1=1 AND post_id = {$car_id} AND ((transfer_from = {$from} AND transfer_to = {$to}) OR(transfer_from = {$to} AND transfer_to = {$from}) ) LIMIT 1";

                return $wpdb->get_row( $sql );
            }

            public function get_search_results()
            {
                $paged = get_query_var( 'paged', '1' );
                $args  = [
                    'post_type'   => 'st_cars',
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'paged'       => $paged,
                    'post_status' => [ 'publish', 'private' ]
                ];
                add_filter( 'posts_where', [ $this, 'post_where' ] );
                add_filter( 'posts_join', [ $this, 'post_join' ] );
                add_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
                add_filter( 'posts_fields', [ $this, 'posts_fields' ] );
                add_filter( 'posts_groupby', [ $this, 'posts_groupby' ] );

                $query = new WP_Query( $args );

                remove_filter( 'posts_where', [ $this, 'post_where' ] );
                remove_filter( 'posts_join', [ $this, 'post_join' ] );
                remove_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
                remove_filter( 'posts_fields', [ $this, 'posts_fields' ] );

                return $query;
            }

            public function posts_fields( $fields )
            {
                $fields .= ', journey.*';

                return $fields;
            }

            public function posts_groupby( $groupby )
            {
                global $wpdb;
                $groupby = $wpdb->posts . '.ID';

                return $groupby;
            }

            public function post_where( $where )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_journey_car';

                $transfer_from = (int)STInput::get( 'transfer_from', '' );
                $transfer_to   = (int)STInput::get( 'transfer_to', '' );
                $start         = STInput::get( 'start', '' );
                $end           = STInput::get( 'end', '' );
                $roundtrip     = STInput::get( 'roundtrip', '' );
                $passengers    = (int)STInput::get( 'passengers', 0 );

                if ( !empty( $transfer_from ) && !empty( $transfer_to ) ) {
                    if ( $roundtrip == 'roundtrip' ) {
                        $where .= " AND (journey.transfer_from = {$transfer_from} AND journey.transfer_to = {$transfer_to}) ";
                    } else {
                        $where .= " AND ((journey.transfer_from = {$transfer_from} AND journey.transfer_to = {$transfer_to}) OR (journey.transfer_from = {$transfer_to} AND journey.transfer_to = {$transfer_from})) ";
                    }
                }

                if ( $price_range = STInput::request( 'price_range' ) ) {

                    $price_obj = explode( ';', $price_range );

                    $price_obj[ 0 ] = TravelHelper::convert_money_to_default( $price_obj[ 0 ] );
                    $price_obj[ 1 ] = TravelHelper::convert_money_to_default( $price_obj[ 1 ] );

                    if ( !isset( $price_obj[ 1 ] ) ) {
                        $price_from = 0;
                        $price_to   = $price_obj[ 0 ];
                    } else {
                        $price_from = $price_obj[ 0 ];
                        $price_to   = $price_obj[ 1 ];
                    }

                    $where .= "AND (CAST(journey.price as DECIMAL(15,6)) BETWEEN {$price_from} AND {$price_to}) ";
                }

                return $where;
            }

            public function post_join( $join )
            {
                global $wpdb;

                $join .= " INNER JOIN {$wpdb->prefix}st_journey_car as journey ON ({$wpdb->posts}.ID = journey.post_id) ";

                return $join;
            }

            public function _get_order_by_query( $orderby )
            {
                if ( $check = STInput::get( 'orderby' ) ) {
                    global $wpdb;
                    switch ( $check ) {
                        case "price_asc":
                            $orderby = ' CAST(journey.price as DECIMAL) asc';
                            break;
                        case "price_desc":
                            $orderby = ' CAST(journey.price as DECIMAL) desc';
                            break;
                        case "name_asc":
                            $orderby = $wpdb->posts . '.post_title';
                            break;
                        case "name_desc":
                            $orderby = $wpdb->posts . '.post_title desc';
                            break;
                        case "new":
                            $orderby = $wpdb->posts . '.post_modified desc';
                            break;
                    }
                }

                return $orderby;
            }

            public function get_transfer_unit( $car_id )
            {
                $transfer_unit = get_post_meta( $car_id, 'price_type', true );
                switch ( $transfer_unit ) {
                    case 'distance':
                        return __( 'km', ST_TEXTDOMAIN );
                        break;
                    case 'fixed':
                        return __( 'journey', ST_TEXTDOMAIN );
                        break;
                    case 'passenger':
                        return __( 'passenger', ST_TEXTDOMAIN );
                        break;
                    default:
                        return __( 'km', ST_TEXTDOMAIN );
                        break;
                }
            }

            public function get_latlng_transfer( $transfer_id )
            {
                $return = [
                    'lat' => 0,
                    'lng' => 0
                ];

                $car_transfer_by_location = st()->get_option('car_transfer_by_location', 'off');
                if($car_transfer_by_location == 'off') {
	                if ( get_post_type( $transfer_id ) == 'st_hotel' ) {
		                global $wpdb;
		                $result = $wpdb->get_row( "SELECT map_lat, map_lng from {$wpdb->prefix}st_hotel WHERE post_id = {$transfer_id}" );
		                if ( $result ) {
			                $return = [
				                'lat' => $result->map_lat,
				                'lng' => $result->map_lng
			                ];
		                }
	                } else {
		                $lat = (float) get_term_meta( $transfer_id, 'map_lat', true );
		                $lng = (float) get_term_meta( $transfer_id, 'map_lng', true );
		                if ( $lat && $lng ) {
			                $return = [
				                'lat' => $lat,
				                'lng' => $lng
			                ];
		                }
	                }
                }else{
	                $map_lat = get_post_meta($transfer_id, 'map_lat', true);
	                $map_lng = get_post_meta($transfer_id, 'map_lng', true);
	                $return = [
		                'lat' => !empty($map_lat) ? $map_lat : 0,
		                'lng' => !empty($map_lng) ? $map_lng : 0
	                ];
                }

                return $return;
            }

            public function get_routes( $transfer_from, $transfer_to, $roundtrip )
            {
                $route = [];
                if ( $transfer_from && $transfer_to ) {
                    $route_from           = $this->get_latlng_transfer( $transfer_from );
                    $route_to             = $this->get_latlng_transfer( $transfer_to );
                    $route[ 'roundtrip' ] = $roundtrip;
                    $route[ 'routes' ][]  = [
                        'origin'      => [
                            'lat'   => $route_from[ 'lat' ],
                            'lng'   => $route_from[ 'lng' ],
                            'title' => 'A'
                        ],
                        'destination' => [
                            'lat'   => $route_to[ 'lat' ],
                            'lng'   => $route_to[ 'lng' ],
                            'title' => 'B'
                        ]
                    ];
                    if ( $roundtrip == 'roundtrip' ) {
                        $route[ 'routes' ][] = [
                            'origin'      => [
                                'lat'   => $route_to[ 'lat' ],
                                'lng'   => $route_to[ 'lng' ],
                                'title' => 'B'
                            ],
                            'destination' => [
                                'lat'   => $route_from[ 'lat' ],
                                'lng'   => $route_from[ 'lng' ],
                                'title' => 'A'
                            ]
                        ];
                    }
                }

                return $route;
            }

            public function get_driving_distance( $transfer_from, $transfer_to, $roundtrip )
            {
                $routes = $this->get_routes( $transfer_from, $transfer_to, $roundtrip );
                $return = [ 'distance' => 0, 'time' => '', 'hour' => 0, 'minute' => 0 ];
                if ( !empty( $routes ) ) {
                    $dist = $time = 0;
                    foreach ( $routes[ 'routes' ] as $key => $route ) {
                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . $route[ 'origin' ][ 'lat' ] . "," . $route[ 'origin' ][ 'lng' ] . "&destinations=" . $route[ 'destination' ][ 'lat' ] . "," . $route[ 'destination' ][ 'lng' ] . "&mode=driving&language=en-US&key=" . st()->get_option( 'google_api_key', '' );

                        $response   = wp_remote_get( $url );
                        $response_a = json_decode( wp_remote_retrieve_body( $response ), true );

                        if ( !empty($response_a['rows']) and  $response_a[ 'rows' ][ 0 ][ 'elements' ][ 0 ][ 'status' ] == 'OK' ) {
                            $dist += (float)$response_a[ 'rows' ][ 0 ][ 'elements' ][ 0 ][ 'distance' ][ 'value' ];
                            $time += (float)$response_a[ 'rows' ][ 0 ][ 'elements' ][ 0 ][ 'duration' ][ 'value' ];
                        }
                    }
                    $dist   = round( ( $dist / 1000 ), 2 );
                    $hour   = (int)( $time / ( 60 * 60 ) );
                    $minute = (int)( ( $time / ( 60 * 60 ) - $hour ) * 60 );
                    $return = [
                        'distance' => $dist,
                        'time'     => $time,
                        'hour'     => $hour,
                        'minute'   => $minute,
                    ];

                    return $return;
                }

                return $return;
            }

            static function inst()
            {
                if ( !self::$_inst ) {
                    self::$_inst = new self();
                }

                return self::$_inst;
            }
        }

        STCarTransfer::inst()->init();
    }