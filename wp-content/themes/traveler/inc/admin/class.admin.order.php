<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAdminOrder
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STAdminOrder' ) ) {

        class STAdminOrder extends STAdmin
        {
            function __construct()
            {
                parent::__construct();
                add_action( 'add_meta_boxes', [ $this, 'add_item_metabox' ] );


                add_action( 'admin_enqueue_scripts', [ $this, 'admin_queue_scripts' ] );

                add_action( 'wp_ajax_st_order_select', [ $this, 'st_order_select' ] );
                add_action( 'wp_ajax_save_order_item', [ $this, 'save_order_item' ] );

                add_action( 'wp_ajax_st_delete_order_item', [ $this, 'st_delete_order_item' ] );

                add_filter( 'woocommerce_attribute_label', [ $this, 'st_change_name_meta_order_item' ] );
            }

            function st_change_name_meta_order_item( $meta )
            {
                switch ( $meta ) {
                    case "_st_item_price":
                        $meta = __( "Item Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_ori_price":
                        $meta = __( "Ori Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_in":
                        $meta = __( "Check In", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_out":
                        $meta = __( "Check Out", ST_TEXTDOMAIN );
                        break;
                    case "_st_room_num_search":
                        $meta = __( "Room Number", ST_TEXTDOMAIN );
                        break;
                    case "_st_room_id":
                        $meta = __( "Room ID", ST_TEXTDOMAIN );
                        break;
                    case "_st_adult_number":
                        $meta = __( "Adult Number", ST_TEXTDOMAIN );
                        break;
                    case "_st_child_number":
                        $meta = __( "Child Number", ST_TEXTDOMAIN );
                        break;
                    case "_st_extra_price":
                        $meta = __( "Extra Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_commission":
                        $meta = __( "Commission", ST_TEXTDOMAIN );
                        break;
                    case "_st_discount_rate":
                        $meta = __( "Discount", ST_TEXTDOMAIN );
                        break;
                    case "_st_st_booking_post_type":
                        $meta = __( "Post Type", ST_TEXTDOMAIN );
                        break;
                    case "_st_st_booking_id":
                        $meta = __( "Booking ID", ST_TEXTDOMAIN );
                        break;
                    case "_st_sharing":
                        $meta = __( "Sharing", ST_TEXTDOMAIN );
                        break;
                    case "_st_duration_unit":
                        $meta = __( "Duration", ST_TEXTDOMAIN );
                        break;
                    case "_st_total_price":
                        $meta = __( "Total Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_user_id":
                        $meta = __( "User ID", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_in_time":
                        $meta = __( "Check In Time", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_out_time":
                        $meta = __( "Check Out Time", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_in_timestamp":
                        $meta = __( "Check In Timestamp", ST_TEXTDOMAIN );
                        break;
                    case "_st_check_out_timestamp":
                        $meta = __( "Check Out Timestamp", ST_TEXTDOMAIN );
                        break;
                    case "_st_location_id_pick_up":
                        $meta = __( "Pick Up ID", ST_TEXTDOMAIN );
                        break;
                    case "_st_location_id_drop_off":
                        $meta = __( "Drop Off ID", ST_TEXTDOMAIN );
                        break;
                    case "_st_pick_up":
                        $meta = __( "Pick Up", ST_TEXTDOMAIN );
                        break;
                    case "_st_drop_off":
                        $meta = __( "Drop Off", ST_TEXTDOMAIN );
                        break;
                    case "_st_sale_price":
                        $meta = __( "Sale Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_numberday":
                        $meta = __( "Number Day", ST_TEXTDOMAIN );
                        break;
                    case "_st_price_equipment":
                        $meta = __( "Price Equipment", ST_TEXTDOMAIN );
                        break;
                    case "_st_distance":
                        $meta = __( "Distance", ST_TEXTDOMAIN );
                        break;
                    case "_st_adult_price":
                        $meta = __( "Adult Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_child_price":
                        $meta = __( "Child Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_infant_price":
                        $meta = __( "Infant Price", ST_TEXTDOMAIN );
                        break;
                    case "_st_infant_number":
                        $meta = __( "Number Infant", ST_TEXTDOMAIN );
                        break;
                    case "_st_type_activity":
                        $meta = __( "Type Activity", ST_TEXTDOMAIN );
                        break;
                    case "_st_duration":
                        $meta = __( "Duration", ST_TEXTDOMAIN );
                        break;
                    case "_st_type_tour":
                        $meta = __( "Type Tour", ST_TEXTDOMAIN );
                        break;
                    case "daily_activity":
                        $meta = __( "Daily Activity", ST_TEXTDOMAIN );
                        break;
                    case "daily_tour":
                        $meta = __( "Daily Tour", ST_TEXTDOMAIN );
                        break;
                    case "st_hotel":
                        $meta = __( "Hotel", ST_TEXTDOMAIN );
                        break;
                    case "hotel_room":
                        $meta = __( "Room", ST_TEXTDOMAIN );
                        break;
                    case "st_rental":
                        $meta = __( "Rental", ST_TEXTDOMAIN );
                        break;
                    case "st_cars":
                        $meta = __( "Car", ST_TEXTDOMAIN );
                        break;
                    case "st_tours":
                        $meta = __( "Tours", ST_TEXTDOMAIN );
                        break;
                    case "st_activity":
                        $meta = __( "Activity", ST_TEXTDOMAIN );
                        break;
                    case "specific_date":
                        $meta = __( "Specific Date", ST_TEXTDOMAIN );
                        break;
	                case "_st_starttime":
		                $meta = __( "Start Time", ST_TEXTDOMAIN );
		                break;
	                case "_st_base_price":
		                $meta = __( "Base price", ST_TEXTDOMAIN );
		                break;
	                case "_st_price_type":
		                $meta = __( "Type price", ST_TEXTDOMAIN );
		                break;
	                case "_st_package_hotel_price":
		                $meta = __( "Hotel package price", ST_TEXTDOMAIN );
		                break;
	                case "_st_package_activity_price":
		                $meta = __( "Activity package price", ST_TEXTDOMAIN );
		                break;
	                case "_st_package_car_price":
		                $meta = __( "Car package price", ST_TEXTDOMAIN );
		                break;
                }

                return $meta;
            }

            function st_delete_order_item()
            {
                $id = isset( $_REQUEST[ 'id' ] ) ? $_REQUEST[ 'id' ] : false;

                if ( $id ) {
                    wp_delete_post( $id );
                }
                echo json_encode( [ 'status' => 1 ] );
                die;
            }

            function save_order_item()
            {
                $arg = $_REQUEST;

                $default = [
                    'item_id'     => '',
                    'item_type'   => '',
                    'item_id2'    => '',
                    'check_in'    => '',
                    'check_out'   => '',
                    'item_number' => '',
                    'item_price'  => '',
                    'order_id'    => '',
                ];

                $data = wp_parse_args( $arg, $default );
                extract( $data );

                if ( !$order_id ) {
                    echo json_encode( [
                        'status'  => 0,
                        'message' => __( 'Order ID must be specify', ST_TEXTDOMAIN )
                    ] );
                    die;
                }

                $item_main_id = $item_id;
                switch ( $item_type ) {
                    case "st_hotel":
                        $item_main_id = $item_id2;
                        break;

                }


                $post = [
                    'post_title'  => sprintf( __( 'Order #%s', ST_TEXTDOMAIN ), $order_id ) . ' - ' . get_the_title( $item_main_id ),
                    'post_type'   => 'st_order_item',
                    'post_status' => 'publish',
                ];

                $new_post = wp_insert_post( $post );

                if ( $new_post ) {
                    update_post_meta( $new_post, 'item_id', $item_main_id );
                    update_post_meta( $new_post, 'item_number', $item_number );
                    update_post_meta( $new_post, 'item_price', $item_price );
                    update_post_meta( $new_post, 'check_out', $check_out );
                    update_post_meta( $new_post, 'check_in', $check_in );
                    update_post_meta( $new_post, 'order_parent', $order_id );
                }

                echo json_encode( [ 'status' => 1, 'reload' => 1 ] );
                die;

            }

            function st_order_select()
            {
                $arg = $_REQUEST;

                $default = [
                    'posts_per_page' => 10,
                    'post_type'      => 'st_hotel',
                    'item_id'        => '',
                    'q'              => ''
                ];

                $data = wp_parse_args( $arg, $default );

                $query = [
                    'post_per_page' => $data[ 'posts_per_page' ],
                    'post_type'     => $data[ 'post_type' ],
                    's'             => $data[ 'q' ]
                ];
                $r     = [
                    'items'       => [],
                    'total_count' => 0
                ];

                if ( $data[ 'post_type' ] == 'hotel_room' and $data[ 'item_id' ] ) {
                    $query[ 'meta_key' ]   = 'room_parent';
                    $query[ 'meta_value' ] = $data[ 'item_id' ];
                }


                query_posts( $query );

                while ( have_posts() ) {
                    the_post();
                    $r[ 'items' ][] = [
                        'id'          => get_the_ID(),
                        'name'        => get_the_title(),
                        'description' => get_the_ID(),
                        'price'       => get_post_meta( get_the_ID(), 'price', true )
                    ];
                }
                wp_reset_query();

                echo json_encode( $r );
                die;
            }

            function admin_queue_scripts()
            {
                $screen = get_current_screen();

                if ( $screen->base == 'post' and $screen->post_type == 'st_order' ) {
                    wp_enqueue_script( 'select2' );

                    wp_enqueue_script( 'edit-orders', get_template_directory_uri() . '/js/admin/edit-order.js', [ 'jquery', 'jquery-ui-datepicker' ], null, true );


                }
            }

            function add_item_metabox()
            {
                $screens = [ 'st_order' ];

                foreach ( $screens as $screen ) {

                    add_meta_box(
                        'st_order_item_section',
                        __( 'Order Items', ST_TEXTDOMAIN ),
                        [ $this, 'metabox_call_back' ],
                        $screen
                    );
                }
            }

            function metabox_call_back( $post )
            {
                echo balanceTags( $this->load_view( 'orders/index', null, [ 'post' => $post ] ) );
            }
        }

        new STAdminOrder();
    }