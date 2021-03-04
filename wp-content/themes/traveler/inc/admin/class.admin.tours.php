<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAdminTours
     *
     * Created by ShineTheme
     *
     */
    $order_id = 0;
    if ( !class_exists( 'STAdminTours' ) ) {

        class STAdminTours extends STAdmin
        {

            static    $booking_page;
            static    $_table_version = "1.3.2";
            protected $post_type      = "st_tours";
            protected static $_inst;

            /**
             *
             *
             * @update 1.1.3
             * */
            function __construct()
            {
                add_action( 'init', [ $this, '_init_post_type' ], 8 );
                if ( !st_check_service_available( $this->post_type ) ) return;

                add_action( 'current_screen', [ $this, 'init_metabox' ] );

                /// add_action( 'save_post', array($this,'tours_update_location') );
                add_action( 'save_post', [ $this, 'tours_update_price_sale' ] );
                add_filter( 'manage_st_tours_posts_columns', [ $this, 'add_col_header' ], 10 );
                add_action( 'manage_st_tours_posts_custom_column', [ $this, 'add_col_content' ], 10, 2 );

                // ==========================================================================

                self::$booking_page = admin_url( 'edit.php?post_type=st_tours&page=st_tours_booking' );
                add_action( 'admin_menu', [ $this, 'new_menu_page' ] );

                //Check booking edit and redirect
                if ( self::is_booking_page() ) {
                    add_action( 'admin_enqueue_scripts', [ __CLASS__, 'add_edit_scripts' ] );
                    add_action( 'admin_init', [ $this, '_do_save_booking' ] );

                }

                if ( isset( $_GET[ 'send_mail' ] ) and $_GET[ 'send_mail' ] == 'success' ) {
                    self::set_message( __( 'Email sent', ST_TEXTDOMAIN ), 'updated' );
                }

                add_action( 'wp_ajax_st_room_select_ajax', [ __CLASS__, 'st_room_select_ajax' ] );
                add_action( 'save_post', [ $this, 'meta_update_sale_price' ], 10, 4 );
                add_action( 'save_post', [ $this, 'meta_update_min_price' ], 10, 4 );
                //parent::__construct();

                add_action( 'save_post', [ $this, '_update_list_location' ], 999999, 2 );
                add_action( 'save_post', [ $this, '_update_duplicate_data' ], 50, 2 );
                add_action( 'before_delete_post', [ $this, '_delete_data' ], 50 );

                add_action( 'wp_ajax_st_getInfoTour', [ __CLASS__, '_getInfoTour' ], 9999 );

                /**
                 *   since 1.2.4
                 *   auto create & update table st_tours
                 **/
                add_action( 'after_setup_theme', [ __CLASS__, '_check_table_tour' ] );

                /**
                 * @since 1.3.0
                 *        Bulk calendar
                 **/
                add_action( 'traveler_after_form_tour_calendar', [ $this, 'custom_traveler_after_form_tour_calendar' ] );
                add_action( 'traveler_after_form_submit_tour_calendar', [ $this, 'custom_traveler_after_form_submit_tour_calendar' ] );

                add_action('init', array($this, '__update_db_available_first_run'), 99);

	            add_action('st_availability_cronjob',array($this,'__cronjob_fill_availability'));
            }

	        public function __run_fill_old_order($key='')
	        {
		        $ids = [];
		        global $wpdb;
		        $table  = $wpdb->prefix . 'st_tour_availability';
		        $model=ST_Order_Item_Model::inst();
		        $orderItems=$model->where("st_booking_post_type in ('st_tours')",false,true)
		                          ->where( 'check_in_timestamp >= UNIX_TIMESTAMP(CURRENT_DATE)', false, true )
		                          ->where("STATUS NOT IN('canceled','trash')",false,true)->get()->result();

		        if(!empty($orderItems))
		        {
			        foreach($orderItems as $data)
			        {
				        if (!empty($data['origin_id']))
				        {
					        if(in_array($data['id'],$ids)) continue;
					        $ids[]=$data['id'];
					        $booked =  $data['adult_number'] + $data['child_number'] + $data['infant_number'];

					        $where=[
						        'post_id'=>$data['origin_id'],
						        'check_in'=>$data['check_in_timestamp'],
					        ];
					        $check=ST_Tour_Availability::inst()->where($where)->get(1)->row();
					        if($check)
					        {
						        $sql = $wpdb->prepare("UPDATE {$table} SET number_booked = IFNULL(number_booked, 0) + %d WHERE post_id = %d AND check_in = %s",$booked,$data['origin_id'],$data['check_in_timestamp']);
						        $wpdb->query( $sql );
					        }else{
						        for($i_d = $data['check_in_timestamp']; $i_d <= $data['check_out_timestamp']; $i_d = strtotime('+1 day', $i_d)){
							        $data_insert = [
								        'post_id' => $data['origin_id'],
								        'check_in' => $i_d,
								        'check_out' => $i_d,
								        'starttime' => '',
								        'count_starttime' => 1,
								        'number' => get_post_meta($data['origin_id'], 'max_people', true),
								        'price' => get_post_meta($data['origin_id'], 'base_price', true),
								        'adult_price' => get_post_meta($data['origin_id'], 'adult_price', true),
								        'child_price' => get_post_meta($data['origin_id'], 'child_price', true),
								        'infant_price' => get_post_meta($data['origin_id'], 'infant_price', true),
								        'status' => 'available',
								        'groupday' => 0,
								        'number_booked' => $booked,
								        'booking_period' => get_post_meta($data['origin_id'], 'tours_booking_period', true),
								        'is_base' => 0,
							        ];
							        ST_Tour_Availability::inst()->insert($data_insert);
						        }
					        }
				        }
			        }
		        }
	        }

	        public function __cronjob_fill_availability($offset = 0, $limit = -1, $day=null)
	        {
		        global $wpdb;
		        if(!$day){
			        $today=new DateTime(date('Y-m-d'));
			        $today->modify('+ 6 months');
			        $day=$today->modify('+ 1 day');
		        }
		        $table='st_tour_availability';
		        $post_type='st_tours';

		        $tours=new WP_Query(array(
			        'posts_per_page'=>$limit,
			        'post_type'=>$post_type,
			        'meta_key' => 'type_tour',
			        'meta_value' => 'daily_tour',
			        'offset' => $offset
		        ));
		        $insertBatch=[];
		        $ids=[];
		        while ($tours->have_posts())
		        {
			        $tours->the_post();
			        $adult_price = get_post_meta(get_the_ID(), 'adult_price', true);
			        if(empty($adult_price)) $adult_price = 0;
			        $child_price = get_post_meta(get_the_ID(), 'child_price', true);
			        if(empty($child_price)) $child_price = 0;
			        $infant_price = get_post_meta(get_the_ID(), 'infant_price', true);
			        if(empty($infant_price)) $infant_price = 0;
			        $base_price = get_post_meta(get_the_ID(), 'base_price', true);
			        if(empty($base_price)) $base_price = 0;
			        $max_people = get_post_meta(get_the_ID(), 'max_people', true);
			        if(empty($max_people)) $max_people = 0;
			        $booking_period = get_post_meta(get_the_ID(), 'tours_booking_period', true);
			        if(empty($booking_period)) $booking_period = 0;
			        $status='available';
			        $insertBatch[]=$wpdb->prepare("(%d,%d,%d,%s,%s,%s,%s,%s,%d,%d,%s,%d)",$day->getTimestamp(),$day->getTimestamp(),get_the_ID(),$status,$base_price, $adult_price, $child_price, $infant_price, 1, 0,$max_people,$booking_period);

			        $ids[]=get_the_ID();
		        }
		        if(!empty($insertBatch))
		        {
			        $wpdb->query("INSERT IGNORE INTO {$wpdb->prefix}{$table} (check_in,check_out,post_id,`status`,price,adult_price,child_price,infant_price,is_base,groupday,`number`,booking_period) VALUES ".implode(",\r\n",$insertBatch));
		        }

		        wp_reset_postdata();
	        }

            public function __update_db_available_first_run(){
            	//Fill old data
	            $key = 'st_tour_availability_fill_old_data';
	            if(empty(get_option($key))) {
		            $model_avail = ST_Availability_Model::inst()
		                                                ->where( 'post_type', 'st_tours' )
		                                                ->where( 'check_in >= UNIX_TIMESTAMP(CURRENT_DATE)', false, true )->get()->result();
		            if ( ! empty( $model_avail ) ) {
			            global $wpdb;
			            $table       = $wpdb->prefix . 'st_tour_availability';
			            $insertBatch = [];
			            $ids         = [];
			            $i           = 1;
			            foreach ( $model_avail as $k => $v ) {
				            $max_people = get_post_meta( $v['post_id'], 'max_people', true );
				            if ( empty( $max_people ) ) {
					            $max_people = 0;
				            }
				            $booking_period = get_post_meta( $v['post_id'], 'tours_booking_period', true );
				            if ( empty( $booking_period ) ) {
					            $booking_period = 0;
				            }
				            $insertBatch[] = $wpdb->prepare( "(%d,%s,%s,%s,%d,%d,%s,%s,%s,%s,%s,%d,%d,%d,%d)", $v['post_id'], $v['check_in'], $v['check_out'], $v['starttime'], $v['count_starttime'], $max_people, $v['price'], $v['adult_price'], $v['child_price'], $v['infant_price'], $v['status'], $v['groupday'], 0, $booking_period, 1 );
				            $i ++;
				            $ids[] = $v['id'];
			            }
			            if ( ! empty( $insertBatch ) ) {
				            $res = $wpdb->query( "INSERT IGNORE INTO {$table} (post_id, check_in, check_out, starttime, count_starttime, `number`, price, adult_price, child_price, infant_price, `status`, groupday, number_booked, booking_period, is_base) VALUES " . implode( ",\r\n", $insertBatch ) );
				            if ( $res ) {
					            $sql_delete = $wpdb->prepare("DELETE FROM {$wpdb->prefix}st_availability WHERE post_type=%s", 'st_tours');
					            $wpdb->query($sql_delete);
				            }
			            }
		            }
		            update_option( $key, 1 );
	            }

	            //Fill old starttime data
		        $key_st = 'st_tour_availability_fill_old_starttime_data';
	            if(empty(get_option($key_st))){
					$model_st_avail = ST_Availability_Model::inst()
						->where('post_type', 'st_starttime_tours')
						->where('check_in >= UNIX_TIMESTAMP(CURRENT_DATE)', false, true)
						->get()->result();
		            if ( ! empty( $model_st_avail ) ) {
			            global $wpdb;
			            foreach ( $model_st_avail as $k => $v ) {
				            $starttime_arr = explode($v['starttime']);
							ST_Tour_Availability::inst()
								->where('post_id', $v['post_id'])
								->where('check_in', $v['check_in'])
								->update(array(
									'starttime' => $v['starttime'],
									'count_starttime' => count($starttime_arr)
								));
				            $sql_delete = $wpdb->prepare("DELETE FROM {$wpdb->prefix}st_availability WHERE post_type=%s", 'st_starttime_tours');
				            $wpdb->query($sql_delete);
			            }
		            }

                    update_option( $key_st, 1 );
	            }
            }


            public function custom_traveler_after_form_tour_calendar()
            {
                echo balanceTags( st()->load_template( 'tours/tour-calendar', false ) );
            }

            public function custom_traveler_after_form_submit_tour_calendar()
            {
                echo '<button type="button" id="calendar-bulk-edit" class="option-tree-ui-button option-tree-ui-button traveler_after_form_submit_tour_calendar button button-primary button-large btn btn-primary btn-sm" style="float: right;">' . __( 'Bulk Edit', ST_TEXTDOMAIN ) . '</button>';
            }

            static function check_ver_working()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );

                return $dbhelper->check_ver_working( 'st_tours_table_version' );
            }

            static function _check_table_tour()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );
                $dbhelper->setTableName( 'st_tours' );
                $column = [
                    'post_id'              => [
                        'type'   => 'INT',
                        'length' => 11,
                    ],
                    'multi_location'       => [
                        'type' => 'text',
                    ],
                    'id_location'          => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'address'              => [
                        'type' => 'text',
                    ],
                    'price'                => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'sale_price'           => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'child_price'          => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'adult_price'          => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'infant_price'         => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'min_price'            => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'max_people'           => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'type_tour'            => [
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
                    'rate_review'          => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'duration_day'         => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'tours_booking_period' => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'is_sale_schedule'     => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'discount'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'sale_price_from'      => [
                        'type'   => 'date',
                        'length' => 255
                    ],
                    'sale_price_to'        => [
                        'type'   => 'date',
                        'length' => 255
                    ],
	                'price_type'        => [
			            'type'   => 'varchar',
			            'length' => 255
		            ]
                ];

                $column = apply_filters( 'st_change_column_st_tours', $column );

                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'st_tours_table_version' );

                return array_keys( $column );
            }

            static function _getInfoTour()
            {
                $tour_id  = intval( STInput::request( 'tour_id', '' ) );
                $result   = [
                    'type_tour'    => '',
                    'max_people'   => 0,
                    'adult_html'   => '',
                    'child_html'   => '',
                    'infant_html'  => '',
                    'child_price'  => '',
                    'adult_price'  => '',
                    'infant_price' => '',
                ];
                $duration = 0;
                if ( get_post_type( $tour_id ) == 'st_tours' ) {

                    $child_price              = get_post_meta( $tour_id, 'child_price', true );
                    $adult_price              = get_post_meta( $tour_id, 'adult_price', true );
                    $infant_price             = get_post_meta( $tour_id, 'infant_price', true );
                    $result[ 'child_price' ]  = $child_price;
                    $result[ 'adult_price' ]  = $adult_price;
                    $result[ 'infant_price' ] = $infant_price;

                    $type_tour = get_post_meta( $tour_id, 'type_tour', true );

                    $max_people = intval( get_post_meta( $tour_id, 'max_people', true ) );

                    $adult_html  = '<select name="adult_number" class="form-control" style="width: 100px">';
                    $child_html  = '<select name="child_number" class="form-control" style="width: 100px">';
                    $infant_html = '<select name="infant_number" class="form-control" style="width: 100px">';
                    for ( $i = 0; $i <= 20; $i++ ) {
                        $adult_html .= '<option value="' . $i . '">' . $i . '</option>';
                        $child_html .= '<option value="' . $i . '">' . $i . '</option>';
                        $infant_html .= '<option value="' . $i . '">' . $i . '</option>';
                    }
                    $adult_html .= '</select>';
                    $child_html .= '</select>';
                    $child_html .= '</select>';

                    if ( $type_tour && $type_tour == 'daily_tour' ) {
                        $html                  = "<select name='type_tour' class='form-control form-control-admin'>
                        <option value='daily_tour'>" . __( 'Daily Tour', ST_TEXTDOMAIN ) . "</option>
                    </select>";
                        $result[ 'type_tour' ] = $html;
                        $result[ 'tour_text' ] = $type_tour;
                        $duration              = get_post_meta( $tour_id, 'duration_day', true );
                    } elseif ( $type_tour && $type_tour == 'specific_date' ) {
                        $html                  = "<select name='type_tour' class='form-control form-control-admin'>
                        <option value='specific_date'>" . __( 'Specific Date', ST_TEXTDOMAIN ) . "</option>
                    </select>";
                        $result[ 'type_tour' ] = $html;
                        $result[ 'tour_text' ] = $type_tour;
                    }
                    $extras = get_post_meta( $tour_id, 'extra_price', true );
                    if ( is_array( $extras ) && count( $extras ) ):
                        $html_extra = '<table class="table">';
                        foreach ( $extras as $key => $val ):
                            $html_extra .= '
                    <tr>
                        <td width="80%">
                            <label for="' . $val[ 'extra_name' ] . '" class="ml20">' . $val[ 'title' ] . ' (' . TravelHelper::format_money( $val[ 'extra_price' ] ) . ')' . '</label>
                            <input type="hidden" name="extra_price[price][' . $val[ 'extra_name' ] . ']" value="' . $val[ 'extra_price' ] . '">
                            <input type="hidden" name="extra_price[title][' . $val[ 'extra_name' ] . ']" value="' . $val[ 'title' ] . '">
                        </td>
                        <td width="20%">
                            <select style="width: 100px" class="form-control" name="extra_price[value][' . $val[ 'extra_name' ] . ']" id="">';

                            $max_item = intval( $val[ 'extra_max_number' ] );
                            if ( $max_item <= 0 ) $max_item = 1;
                            for ( $i = 0; $i <= $max_item; $i++ ):
                                $html_extra .= '<option value="' . $i . '">' . $i . '</option>';
                            endfor;
                            $html_extra .= '
                            </select>
                        </td>
                    </tr>';
                        endforeach;
                        $html_extra .= '</table>';
                    endif;
                    $result[ 'extras' ]      = $html_extra;
                    $result[ 'max_people' ]  = ( $max_people == 0 ) ? __( 'Unlimited', ST_TEXTDOMAIN ) : $max_people;
                    $result[ 'adult_html' ]  = $adult_html;
                    $result[ 'child_html' ]  = $child_html;
                    $result[ 'infant_html' ] = $infant_html;
                    $result[ 'duration' ]    = $duration;
                }

                echo json_encode( $result );
                die();
            }

            function _do_save_booking()
            {
                $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : false;
                switch ( $section ) {
                    case "edit_order_item":
                        if ( $this->is_able_edit() ) {
                            if ( isset( $_POST[ 'submit' ] ) and $_POST[ 'submit' ] ) $this->_save_booking( STInput::get( 'order_item_id' ) );
                        }

                        break;
                    case 'resend_email_tours':
                        $this->_resend_mail();
                        break;
                }
            }

            public function _delete_data( $post_id )
            {
                if ( get_post_type( $post_id ) == 'st_tours' ) {
                    global $wpdb;
                    $table = $wpdb->prefix . 'st_tours';
                    $rs    = TravelHelper::deleteDuplicateData( $post_id, $table );
                    if ( !$rs )
                        return false;

                    return true;
                }
            }

            function _update_duplicate_data( $id, $data )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_tours' ) ) return;

                if ( get_post_type( $id ) == 'st_tours' ) {
                    $num_rows = TravelHelper::checkIssetPost( $id, 'st_tours' );

                    $location_str = get_post_meta( $id, 'multi_location', true );

                    $location_id = ''; // location_id

                    $address = get_post_meta( $id, 'address', true ); // address

                    $max_people           = get_post_meta( $id, 'max_people', true ); // maxpeople
                    $check_in             = get_post_meta( $id, 'check_in', true ); // check in
                    $check_out            = get_post_meta( $id, 'check_out', true ); // check out
                    $type_tour            = get_post_meta( $id, 'type_tour', true ); // check out
                    $duration_day         = get_post_meta( $id, 'duration_day', true ); // duration_day
                    $tours_booking_period = get_post_meta( $id, 'tours_booking_period', true ); // tours_booking_period
	                $tour_price_type = get_post_meta($id, 'tour_price_by', true);

                    $sale_price = get_post_meta( $id, 'sale_price', true ); // sale_price

					$base_price = get_post_meta($id, 'base_price', true);
                    $child_price  = get_post_meta( $id, 'child_price', true );
                    $adult_price  = get_post_meta( $id, 'adult_price', true );
                    $infant_price = get_post_meta( $id, 'infant_price', true );
                    $off_adult    = get_post_meta( $id, 'hide_adult_in_booking_form', true );
                    $off_child    = get_post_meta( $id, 'hide_children_in_booking_form', true );
                    $off_infant   = get_post_meta( $id, 'hide_infant_in_booking_form', true );
                    if ( $off_adult == "on" ) {
                        $adult_price = 0;
                    }
                    if ( $off_child == "on" ) {
                        $child_price = 0;
                    }
                    if ( $off_infant == "on" ) {
                        $infant_price = 0;
                    }
                    $min_price = get_post_meta( $id, 'min_price', true );

                    $discount         = get_post_meta( $id, 'discount', true );
                    $is_sale_schedule = get_post_meta( $id, 'is_sale_schedule', true );
                    $sale_from        = get_post_meta( $id, 'sale_price_from', true );
                    $sale_to          = get_post_meta( $id, 'sale_price_to', true );
                    if ( $is_sale_schedule == 'on' ) {
                        if ( $sale_from and $sale_from ) {
                            $today     = date( 'Y-m-d' );
                            $sale_from = date( 'Y-m-d', strtotime( $sale_from ) );
                            $sale_to   = date( 'Y-m-d', strtotime( $sale_to ) );
                            if ( ( $today >= $sale_from ) && ( $today <= $sale_to ) ) {

                            } else {

                                $discount = 0;
                            }

                        } else {
                            $discount = 0;
                        }
                    }
                    if ( $discount ) {
                        $sale_price = $sale_price - ( $sale_price / 100 ) * $discount;
                    }

                    $rate_review = STReview::get_avg_rate( $id ); // rate review

                    if ( $num_rows == 1 ) {
                        $data  = [
                            'multi_location'       => $location_str,
                            'id_location'          => $location_id,
                            'address'              => $address,
                            'type_tour'            => $type_tour,
                            'check_in'             => $check_in,
                            'check_out'            => $check_out,
                            'sale_price'           => $sale_price,
                            'child_price'          => $child_price,
                            'adult_price'          => $adult_price,
                            'infant_price'         => $infant_price,
                            'min_price'            => $min_price,
                            'max_people'           => $max_people,
                            'rate_review'          => $rate_review,
                            'duration_day'         => $duration_day,
                            'tours_booking_period' => $tours_booking_period,
                            'discount'             => $discount,
                            'sale_price_from'      => $sale_from,
                            'sale_price_to'        => $sale_to,
                            'is_sale_schedule'     => $is_sale_schedule,
	                        'price' => $base_price,
                            'price_type' => $tour_price_type,
                        ];
                        $where = [
                            'post_id' => $id
                        ];

                        TravelHelper::updateDuplicate( 'st_tours', $data, $where );
                    } elseif ( $num_rows == 0 ) {
                        $data = [
                            'post_id'              => $id,
                            'multi_location'       => $location_str,
                            'id_location'          => $location_id,
                            'address'              => $address,
                            'type_tour'            => $type_tour,
                            'check_in'             => $check_in,
                            'check_out'            => $check_out,
                            'sale_price'           => $sale_price,
                            'child_price'          => $child_price,
                            'adult_price'          => $adult_price,
                            'infant_price'         => $infant_price,
                            'min_price'            => $min_price,
                            'max_people'           => $max_people,
                            'rate_review'          => $rate_review,
                            'duration_day'         => $duration_day,
                            'tours_booking_period' => $tours_booking_period,
                            'discount'             => $discount,
                            'sale_price_from'      => $sale_from,
                            'sale_price_to'        => $sale_to,
                            'is_sale_schedule'     => $is_sale_schedule,
	                        'price' => $base_price,
	                        'price_type' => $tour_price_type,
                        ];

                        TravelHelper::insertDuplicate( 'st_tours', $data );
                    }

	                // Update Availability
	                $model=ST_Tour_Availability::inst();
	                $model->where('post_id',$id)
	                      ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", true, false)
	                      ->update(array(
		                'number'=>empty($max_people) ? 0 : $max_people,
		                'booking_period' => empty($tours_booking_period) ? 0 : $tours_booking_period
	                ));

	                $data_prices = $model->get_prices_by_id($id);
	                if(!empty($data_prices)) {
		                $data_price      = $data_prices[0];
		                if($tour_price_type == 'person'){
			                $adult_price_db  = $data_price['adult_price'];
			                $child_price_db  = $data_price['child_price'];
			                $infant_price_db = $data_price['infant_price'];
			                if ( $adult_price_db != $adult_price or $child_price_db != $child_price or $infant_price_db != $infant_price ) {
				                $model->where(array('post_id' => $id, 'is_base' => 1))
				                      ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", true, false)->update(array(
					                'adult_price'=>$adult_price,
					                'child_price' => $child_price,
					                'infant_price' => $infant_price,
				                ));
			                }
		                }else{
			                $base_price_db  = $data_price['price'];
			                if ( $base_price_db != $base_price) {
				                $model->where(array('post_id' => $id, 'is_base' => 1))
				                      ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", true, false)->update(array(
					                'price'=>$base_price
				                ));
			                }
		                }
	                }
                }
            }

            /**
             * @since 1.1.7
             **/
            function _update_list_location( $id, $data )
            {
                $location = STInput::request( 'multi_location', '' );
                if ( isset( $_REQUEST[ 'multi_location' ] ) ) {
                    if ( is_array( $location ) && count( $location ) ) {
                        $location_str = '';
                        foreach ( $location as $item ) {
                            if ( empty( $location_str ) ) {
                                $location_str .= $item;
                            } else {
                                $location_str .= ',' . $item;
                            }
                        }
                    } else {
                        $location_str = '';
                    }
                    update_post_meta( $id, 'multi_location', $location_str );
                    update_post_meta( $id, 'id_location', '' );
                }

            }

            /**
             * Init the post type
             *
             * @since 1.1.3
             * */
            function _init_post_type()
            {
                if ( !st_check_service_available( $this->post_type ) ) {
                    return;
                }

                if ( !function_exists( 'st_reg_post_type' ) ) return;
                // Tours ==============================================================
                $labels = [
                    'name'                  => __( 'Tours', ST_TEXTDOMAIN ),
                    'singular_name'         => __( 'Tour', ST_TEXTDOMAIN ),
                    'menu_name'             => __( 'Tours', ST_TEXTDOMAIN ),
                    'name_admin_bar'        => __( 'Tour', ST_TEXTDOMAIN ),
                    'add_new'               => __( 'Add New', ST_TEXTDOMAIN ),
                    'add_new_item'          => __( 'Add New Tour', ST_TEXTDOMAIN ),
                    'new_item'              => __( 'New Tour', ST_TEXTDOMAIN ),
                    'edit_item'             => __( 'Edit Tour', ST_TEXTDOMAIN ),
                    'view_item'             => __( 'View Tour', ST_TEXTDOMAIN ),
                    'all_items'             => __( 'All Tour', ST_TEXTDOMAIN ),
                    'search_items'          => __( 'Search Tour', ST_TEXTDOMAIN ),
                    'parent_item_colon'     => __( 'Parent Tour:', ST_TEXTDOMAIN ),
                    'not_found'             => __( 'No Tours found.', ST_TEXTDOMAIN ),
                    'not_found_in_trash'    => __( 'No Tours found in Trash.', ST_TEXTDOMAIN ),
                    'insert_into_item'      => __( 'Insert into Tour', ST_TEXTDOMAIN ),
                    'uploaded_to_this_item' => __( "Uploaded to this Tour", ST_TEXTDOMAIN ),
                    'featured_image'        => __( "Feature Image", ST_TEXTDOMAIN ),
                    'set_featured_image'    => __( "Set featured image", ST_TEXTDOMAIN )
                ];

                $args = [
                    'labels'             => $labels,
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'query_var'          => true,
                    'rewrite'            => [ 'slug' => get_option( 'tour_permalink', 'st_tour' ) ],
                    'capability_type'    => 'post',
                    'hierarchical'       => false,
                    'supports'           => [ 'author', 'title', 'editor', 'excerpt', 'thumbnail', 'comments' ],
                    'menu_icon'          => 'dashicons-palmtree-st'
                ];

                st_reg_post_type( 'st_tours', $args );

                $labels = [
                    'name'                       => __( 'Tour Categories', ST_TEXTDOMAIN ),
                    'singular_name'              => __( 'Tour Categories', ST_TEXTDOMAIN ),
                    'search_items'               => __( 'Search Tour Categories', ST_TEXTDOMAIN ),
                    'popular_items'              => __( 'Popular Tour Categories', ST_TEXTDOMAIN ),
                    'all_items'                  => __( 'All Tour Categories', ST_TEXTDOMAIN ),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => __( 'Edit Tour Categories', ST_TEXTDOMAIN ),
                    'update_item'                => __( 'Update Tour Categories', ST_TEXTDOMAIN ),
                    'add_new_item'               => __( 'Add New Tour Categories', ST_TEXTDOMAIN ),
                    'new_item_name'              => __( 'New Tour Type Name', ST_TEXTDOMAIN ),
                    'separate_items_with_commas' => __( 'Separate Tour Categories with commas', ST_TEXTDOMAIN ),
                    'add_or_remove_items'        => __( 'Add or remove Tour Categories', ST_TEXTDOMAIN ),
                    'choose_from_most_used'      => __( 'Choose from the most used Tour Categories', ST_TEXTDOMAIN ),
                    'not_found'                  => __( 'No Tour Categories.', ST_TEXTDOMAIN ),
                    'menu_name'                  => __( 'Tour Categories', ST_TEXTDOMAIN ),
                ];
                $args   = [
                    'hierarchical'      => true,
                    'labels'            => $labels,
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite'           => [ 'slug' => 'st_tour_type' ],
                ];

                st_reg_taxonomy( 'st_tour_type', 'st_tours', $args );
            }

            /**
             *
             *
             * @since  1.1.1
             * @update 1.1.2
             * */
            function init_metabox()
            {
                $screen = get_current_screen();
                if ( $screen->id != 'st_tours' ) {
                    return false;
                }

                //Room
                $this->metabox[] = [
                    'id'       => 'tour_metabox',
                    'title'    => __( 'Tour Setting', ST_TEXTDOMAIN ),
                    'desc'     => '',
                    'pages'    => [ 'st_tours' ],
                    'context'  => 'normal',
                    'priority' => 'high',
                    'fields'   => [
                        [
                            'label' => __( 'Location', ST_TEXTDOMAIN ),
                            'id'    => 'location_reneral_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'     => __( 'Tour location', ST_TEXTDOMAIN ),
                            'id'        => 'multi_location', // id_location
                            'type'      => 'list_item_post_type',
                            'desc'      => __( 'Select one or more location for your tour', ST_TEXTDOMAIN ),
                            'post_type' => 'location'
                        ],
                        [
                            'label' => __( 'Real tour address ', ST_TEXTDOMAIN ),
                            'id'    => 'address',
                            'type'  => 'address_autocomplete',
                            'desc'  => __( 'Input your tour address detail', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Location on map', ST_TEXTDOMAIN ),
                            'id'    => 'st_google_map',
                            'type'  => 'bt_gmap',
                            'std'   => 'off',
                        ],
                        [
                            'label'    => __( 'Properties near by', ST_TEXTDOMAIN ),
                            'id'       => 'properties_near_by',
                            'type'     => 'list-item',
                            'desc'     => __( 'Properties near by this hotel', ST_TEXTDOMAIN ),
                            'settings' => [
                                [
                                    'id'    => 'featured_image',
                                    'label' => __( 'Featured Image', ST_TEXTDOMAIN ),
                                    'type'  => 'upload',
                                ],
                                [
                                    'id'    => 'description',
                                    'label' => __( 'Description', ST_TEXTDOMAIN ),
                                    'type'  => 'textarea',
                                    'row'   => 5
                                ],
                                [
                                    'id'    => 'icon',
                                    'label' => __( 'Map icon', ST_TEXTDOMAIN ),
                                    'type'  => 'upload'
                                ],
                                [
                                    'id'    => 'map_lat',
                                    'label' => __( 'Map lat', ST_TEXTDOMAIN ),
                                    'type'  => 'text'
                                ],
                                [
                                    'id'    => 'map_lng',
                                    'label' => __( 'Map long', ST_TEXTDOMAIN ),
                                    'type'  => 'text'
                                ]
                            ]
                        ],
                        [
                            'label' => __( 'Street view mode', ST_TEXTDOMAIN ),
                            'id'    => 'enable_street_views_google_map',
                            'type'  => 'on-off',
                            'desc'  => __( 'Turn on/off street view mode for this location', ST_TEXTDOMAIN ),
                            'std'   => 'on'
                        ],
                        [
                            'label' => __( 'General', ST_TEXTDOMAIN ),
                            'id'    => 'room_reneral_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Set tour as feature', ST_TEXTDOMAIN ),
                            'id'    => 'is_featured',
                            'type'  => 'on-off',
                            'desc'  => __( 'Will show this tour with feature label or not', ST_TEXTDOMAIN ),
                            'std'   => 'off'
                        ],
                        [
                            'label'     => __( 'Tour single layout', ST_TEXTDOMAIN ),
                            'id'        => 'st_custom_layout',
                            'post_type' => 'st_layouts',
                            'desc'      => __( 'Select one tour single layout', ST_TEXTDOMAIN ),
                            'type'      => 'select',
                            'choices'   => st_get_layout( 'st_tours' )
                        ],

                        [
                            'label' => __( 'Tour gallery', ST_TEXTDOMAIN ),
                            'id'    => 'gallery',
                            'type'  => 'gallery',
                            'desc'  => __( 'Upload tour images to show to customers', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Tour video', ST_TEXTDOMAIN ),
                            'id'    => 'video',
                            'type'  => 'text',
                            'desc'  => __( 'Input youtube/vimeo url here', ST_TEXTDOMAIN )
                        ],

                        [
                            'label' => __( 'Contact information', ST_TEXTDOMAIN ),
                            'id'    => 'contact_info_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'   => __( 'Select contact info will show', ST_TEXTDOMAIN ),
                            'id'      => 'show_agent_contact_info',
                            'type'    => 'select',
                            'choices' => [

                                [
                                    'label' => __( "----Select----", ST_TEXTDOMAIN ),
                                    'value' => ''
                                ],
                                [
                                    'label' => __( "Use agent contact info", ST_TEXTDOMAIN ),
                                    'value' => 'user_agent_info'
                                ],
                                [
                                    'label' => __( "Use item info", ST_TEXTDOMAIN ),
                                    'value' => 'user_item_info'
                                ],
                            ],
                            'desc'    => __( 'Use info configuration in theme option || Use contact info of people who upload hotel || Use contact info in hotel detail', ST_TEXTDOMAIN ),
                        ],

                        [
                            'label' => __( 'Email address', ST_TEXTDOMAIN ),
                            'id'    => 'contact_email',
                            'type'  => 'text',
                            'desc'  => __( 'Email address', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Website address', ST_TEXTDOMAIN ),
                            'id'    => 'website',
                            'type'  => 'text',
                            'desc'  => __( 'Website. Ex: <em>http://domain.com</em>', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Phone', ST_TEXTDOMAIN ),
                            'id'    => 'phone',
                            'type'  => 'text',
                            'desc'  => __( 'Phone number', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Fax number', ST_TEXTDOMAIN ),
                            'id'    => 'fax',
                            'type'  => 'text',
                            'desc'  => __( 'Fax number', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Price settings', ST_TEXTDOMAIN ),
                            'id'    => 'price_number_tab',
                            'type'  => 'tab'
                        ],
	                    //Option price by...
	                    [
		                    'label'   => __( 'Show price by person/fixed', ST_TEXTDOMAIN ),
		                    'id'      => 'tour_price_by',
		                    'type'    => 'select',
		                    'choices' => [
			                    [
				                    'label' => __( "Price by person", ST_TEXTDOMAIN ),
				                    'value' => 'person'
			                    ],
			                    [
				                    'label' => __( "Price by fixed", ST_TEXTDOMAIN ),
				                    'value' => 'fixed'
			                    ],
			                    [
				                    'label' => __( "Fixed Departure", ST_TEXTDOMAIN ),
				                    'value' => 'fixed_depart'
			                    ],
		                    ],
		                    'desc'    => __( 'Show price by person or fixed.', ST_TEXTDOMAIN ),
	                    ],
	                    [
		                    'label'     => __( 'Start date', ST_TEXTDOMAIN ),
		                    'desc'      => __( 'Start date for fixed departure tour', ST_TEXTDOMAIN ),
		                    'id'        => 'start_date_fixed',
		                    'type'      => 'date-picker',
		                    'condition' => 'tour_price_by:is(fixed_depart)'
	                    ],

	                    [
		                    'label'     => __( 'End date', ST_TEXTDOMAIN ),
		                    'desc'      => __( 'End date for fixed departure tour', ST_TEXTDOMAIN ),
		                    'id'        => 'end_date_fixed',
		                    'type'      => 'date-picker',
		                    'condition' => 'tour_price_by:is(fixed_depart)'
	                    ],
	                    [
		                    'label'     => __( 'Base price', ST_TEXTDOMAIN ),
		                    'id'        => 'base_price',
		                    'type'      => 'text',
		                    'std'       => 0,
		                    'condition' => 'tour_price_by:is(fixed)'
	                    ],
                        [
                            'label'     => __( 'Adult price', ST_TEXTDOMAIN ),
                            'id'        => 'adult_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per adult', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => 'hide_adult_in_booking_form:is(off),tour_price_by:not(fixed)'
                        ],
                        [
                            'label'     => __( 'Fields list discount by adult number booking', ST_TEXTDOMAIN ),
                            'id'        => 'discount_by_adult',
                            'type'      => 'list-item',
                            'desc'      => __( 'Fields list discount by adult number booking', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'settings'  => [
                                [
                                    'id'    => 'key',
                                    'label' => __( 'Number of adult (From)', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ],
                                [
                                    'id'    => 'key_to',
                                    'label' => __( 'Number of adult (To)', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ],
                                [
                                    'id'    => 'value',
                                    'label' => __( 'Discount amount', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ]
                            ],
                            'condition' => 'hide_adult_in_booking_form:is(off),tour_price_by:not(fixed)'
                        ],

                        [
                            'label'     => __( 'Child price', ST_TEXTDOMAIN ),
                            'id'        => 'child_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per Child', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => "hide_children_in_booking_form:is(off),tour_price_by:not(fixed)"
                        ],
                        [
                            'label'     => __( 'Fields list discount by child number booking', ST_TEXTDOMAIN ),
                            'id'        => 'discount_by_child',
                            'type'      => 'list-item',
                            'desc'      => __( 'Fields list discount by child number booking', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'settings'  => [
                                [
                                    'id'    => 'key',
                                    'label' => __( 'Number of children (From)', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ],
                                [
                                    'id'    => 'key_to',
                                    'label' => __( 'Number of children (To)', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ],
                                [
                                    'id'    => 'value',
                                    'label' => __( 'Discount Amount', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ]
                            ],
                            'condition' => "hide_children_in_booking_form:is(off),tour_price_by:not(fixed)"
                        ],
                        [
                            'id'      => 'discount_by_people_type',
                            'label'   => __( 'Type of discount by people', ST_TEXTDOMAIN ),
                            'type'    => 'select',
                            'choices' => [
                                [
                                    'label' => __( 'Percent', ST_TEXTDOMAIN ),
                                    'value' => 'percent'
                                ],
                                [
                                    'label' => __( 'Amount', ST_TEXTDOMAIN ),
                                    'value' => 'amount'
                                ]
                            ],
                            'condition' => "tour_price_by:not(fixed)"
                        ],
                        [
                            'label'     => __( 'Infant price', ST_TEXTDOMAIN ),
                            'id'        => 'infant_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per infant', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => "hide_infant_in_booking_form:is(off),tour_price_by:not(fixed)"
                        ],
                        [
                            'label' => __( 'Disable adult booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_adult_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of adult in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
                            'condition' => "tour_price_by:not(fixed)"
                        ],
                        [
                            'label' => __( 'Disable child booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_children_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of child in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
                            'condition' => "tour_price_by:not(fixed)"
                        ],
                        [
                            'label' => __( 'Disable infant booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_infant_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of infant in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
                            'condition' => "tour_price_by:not(fixed)"
                        ],

                        [
                            'label'=>esc_html__('Disable "Adult Name Required"',ST_TEXTDOMAIN),
                            'type'=>'on-off',
                            'std'=>'off',
                            'id'=>'disable_adult_name'
                        ],

                        [
                            'label'=>esc_html__('Disable "Children Name Required"',ST_TEXTDOMAIN),
                            'type'=>'on-off',
                            'std'=>'off',
                            'id'=>'disable_children_name'
                        ],

                        [
                            'label'=>esc_html__('Disable "Infant Name Required"',ST_TEXTDOMAIN),
                            'type'=>'on-off',
                            'std'=>'off',
                            'id'=>'disable_infant_name'
                        ],
                        [
                            'label'    => __( 'Extra pricing', ST_TEXTDOMAIN ),
                            'id'       => 'extra_price',
                            'type'     => 'list-item',
                            'settings' => [
                                [
                                    'id'    => 'extra_name',
                                    'type'  => 'text',
                                    'std'   => 'extra_',
                                    'label' => __( 'Name of Item', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_max_number',
                                    'type'  => 'text',
                                    'std'   => '',
                                    'label' => __( 'Max of Number', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_price',
                                    'type'  => 'text',
                                    'std'   => '',
                                    'label' => __( 'Price', ST_TEXTDOMAIN ),
                                    'desc'  => __( 'per 1 Item', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_required',
                                    'type'  => 'on-off',
                                    'std'   => 'off',
                                    'label' => __( 'Required Extra', ST_TEXTDOMAIN ),
                                    'desc'  => __( '', ST_TEXTDOMAIN ),
                                ],
                            ],
                            'desc'     => __( 'You can define any extra service and price for with name, quantity, and price', ST_TEXTDOMAIN )

                        ],
                        [
                            'label' => __( 'Discount by percent', ST_TEXTDOMAIN ),
                            'id'    => 'discount',
                            'type'  => 'text',
                            'desc'  => __( 'Discount of this tour, by percent', ST_TEXTDOMAIN ),
                            'std'   => 0
                        ],
                        [
                            'label'   => __( 'Type of discount', ST_TEXTDOMAIN ),
                            'id'      => 'discount_type',
                            'type'    => 'select',
                            'choices' => [
                                [
                                    'label' => __( 'Percent', ST_TEXTDOMAIN ),
                                    'value' => 'percent',
                                ],
                                [
                                    'label' => __( 'Amount', ST_TEXTDOMAIN ),
                                    'value' => 'amount'
                                ]
                            ]
                        ],
                        [
                            'label' => __( 'Sale schedule', ST_TEXTDOMAIN ),
                            'id'    => 'is_sale_schedule',
                            'type'  => 'on-off',
                            'std'   => 'off',
                        ],
                        [
                            'label'     => __( 'Sale start date', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Sale start date', ST_TEXTDOMAIN ),
                            'id'        => 'sale_price_from',
                            'type'      => 'date-picker',
                            'condition' => 'is_sale_schedule:is(on)'
                        ],

                        [
                            'label'     => __( 'Sale end date', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Sale end date', ST_TEXTDOMAIN ),
                            'id'        => 'sale_price_to',
                            'type'      => 'date-picker',
                            'condition' => 'is_sale_schedule:is(on)'
                        ],
                        [
                            'id'      => 'deposit_payment_status',
                            'label'   => __( "Deposit payment options", ST_TEXTDOMAIN ),
                            'desc'    => __( 'You can select <code>Disallow Deposit</code>, <code>Deposit by percent</code>' ),
                            'type'    => 'select',
                            'choices' => [
                                [
                                    'value' => '',
                                    'label' => __( 'Disallow Deposit', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'percent',
                                    'label' => __( 'Deposit by percent', ST_TEXTDOMAIN )
                                ],
                                /*[
                                    'value' => 'amount',
                                    'label' => __( 'Deposit by amount', ST_TEXTDOMAIN )
                                ],*/
                            ]
                        ],
                        [
                            'label'     => __( 'Deposit payment amount', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Leave empty for disallow deposit payment', ST_TEXTDOMAIN ),
                            'id'        => 'deposit_payment_amount',
                            'type'      => 'text',
                            'condition' => 'deposit_payment_status:not()'
                        ],
                        [
                            'label' => __( 'Information', ST_TEXTDOMAIN ),
                            'id'    => 'st_info_tours_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'   => __( 'Tour type', ST_TEXTDOMAIN ),
                            'id'      => 'type_tour',
                            'type'    => 'select',
                            'desc'    => __( 'Select tour type. If you selected the \'Specific Date\' tour, you need to set price in \'Availability\' tab (required)', ST_TEXTDOMAIN ),
                            'choices' => [
                                [
                                    'value' => 'daily_tour',
                                    'label' => __( 'Daily tour', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'specific_date',
                                    'label' => __( 'Specific date', ST_TEXTDOMAIN )
                                ],
                            ]
                        ],
                        [
                            'label'     => __( 'Duration', ST_TEXTDOMAIN ),
                            'id'        => 'duration_day',
                            'type'      => 'text',
                            'desc'      => __( 'Enter tour duration. Example: <em>3 days 2 nights</em>', ST_TEXTDOMAIN ),
                            'std'       => '',
                            'condition' => 'type_tour:is(daily_tour)'
                        ],
                        [
                            'label'        => __( 'Minimum days to book before departure', ST_TEXTDOMAIN ),
                            'desc'         => __( 'Minimum days to book before departure', ST_TEXTDOMAIN ),
                            'id'           => 'tours_booking_period',
                            'type'         => 'numeric-slider',
                            'min_max_step' => '0,30,1',
                            'std'          => 0,
                        ],
                        [
                            'label' => __( 'Allow external booking', ST_TEXTDOMAIN ),
                            'id'    => 'st_tour_external_booking',
                            'type'  => 'on-off',
                            'std'   => "off",
                            'desc'  => __( 'You can set booking by an external link', ST_TEXTDOMAIN )
                        ],
                        [
                            'label'     => __( 'Tour external booking link ', ST_TEXTDOMAIN ),
                            'id'        => 'st_tour_external_booking_link',
                            'type'      => 'text',
                            'std'       => "",
                            'condition' => 'st_tour_external_booking:is(on)',
                            'desc'      => "<em>" . __( 'Notice: Must be http://...', ST_TEXTDOMAIN ) . "</em>",
                        ],
                        [
                            'label' => __( 'Min of people', ST_TEXTDOMAIN ),
                            'id'    => 'min_people',
                            'type'  => 'text',
                            'desc'  => __( 'Min of people', ST_TEXTDOMAIN ),
                            'std'   => '1',
                        ],

                        /**
                         * @updated 1.2.8
                         *          can set unlimited peope
                         **/
                        [
                            'label' => __( 'Max of people', ST_TEXTDOMAIN ),
                            'id'    => 'max_people',
                            'type'  => 'text',
                            'desc'  => __( 'Max No. People. Leave empty or enter \'0\' for unlimited', ST_TEXTDOMAIN ),
                            'std'   => '0',
                        ],
                        [
                            'id'       => 'tours_program',
                            'label'    => __( "Tour program", ST_TEXTDOMAIN ),
                            'type'     => 'list-item',
                            'settings' => [
                                [
                                    'id'    => 'desc',
                                    'label' => __( 'Description', ST_TEXTDOMAIN ),
                                    'type'  => 'textarea',
                                    'rows'  => '5',
                                ]
                            ]
                        ],

                        [
                            'label' => __( 'Availability', ST_TEXTDOMAIN ),
                            'id'    => 'availability_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Tour calendar', ST_TEXTDOMAIN ),
                            'id'    => 'st_tour_calendar',
                            'type'  => 'st_tour_calendar'
                        ],
                        /**
                         * Tour package(Hotel)
                         */
                        [
                            'label' => __( 'Tour package', ST_TEXTDOMAIN ),
                            'id'    => 'st_tour_package_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __('Setting Tour Packages', ST_TEXTDOMAIN),
                            'id' => 'st_tour_package',
                            'type' => 'st_tour_package',
                        ],
                        // End Tour package
                        [
                            'label' => __( 'Cancel booking', ST_TEXTDOMAIN ),
                            'id'    => 'st_cancel_booking_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Allow cancellation', ST_TEXTDOMAIN ),
                            'id'    => 'st_allow_cancel',
                            'type'  => 'on-off',
                            'std'   => 'off'
                        ],
                        [
                            'label'     => __( 'Number of days before the arrival', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Number of days before the arrival', ST_TEXTDOMAIN ),
                            'id'        => 'st_cancel_number_days',
                            'type'      => 'text',
                            'condition' => 'st_allow_cancel:is(on)'
                        ],
                        [
                            'label'        => __( 'Percent of total price', ST_TEXTDOMAIN ),
                            'desc'         => __( 'Percent of total price for the canceling', ST_TEXTDOMAIN ),
                            'id'           => 'st_cancel_percent',
                            'type'         => 'numeric-slider',
                            'min_max_step' => '0,100,1',
                            'condition'    => 'st_allow_cancel:is(on)'
                        ],
                        [
                            'label' => __( 'Ical Sysc', ST_TEXTDOMAIN ),
                            'id'    => 'ical_sys_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __('Ical URL', ST_TEXTDOMAIN),
                            'id' => 'ical_url',
                            'type' => 'ical',
                            'desc' => __('Enter an ical url and click Import button. All data will be updated and shown in the Availability tab', ST_TEXTDOMAIN)
                        ]
                    ]
                ];
                $data_paypment   = STPaymentGateways::get_payment_gateways();
                if ( !empty( $data_paypment ) and is_array( $data_paypment ) ) {
                    $this->metabox[ 0 ][ 'fields' ][] = [
                        'label' => __( 'Payment', ST_TEXTDOMAIN ),
                        'id'    => 'payment_detail_tab',
                        'type'  => 'tab'
                    ];
                    foreach ( $data_paypment as $k => $v ) {
                        $this->metabox[ 0 ][ 'fields' ][] = [
                            'label' => $v->get_name(),
                            'id'    => 'is_meta_payment_gateway_' . $k,
                            'type'  => 'on-off',
                            'desc'  => $v->get_name(),
                            'std'   => 'on'
                        ];
                    }
                }
                $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
                if ( !empty( $custom_field ) and is_array( $custom_field ) ) {
                    $this->metabox[ 0 ][ 'fields' ][] = [
                        'label' => __( 'Custom fields', ST_TEXTDOMAIN ),
                        'id'    => 'custom_field_tab',
                        'type'  => 'tab'
                    ];
                    foreach ( $custom_field as $k => $v ) {
                        $key                              = str_ireplace( '-', '_', 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                        $this->metabox[ 0 ][ 'fields' ][] = [
                            'label' => $v[ 'title' ],
                            'id'    => $key,
                            'type'  => $v[ 'type_field' ],
                            'desc'  => '<input value=\'[st_custom_meta key="' . $key . '"]\' type=text readonly />',
                            'std'   => $v[ 'default_field' ]
                        ];
                    }
                }


                parent::register_metabox( $this->metabox );
            }

            // from 1.2.4
            static function get_min_price( $post_id = null )
            {
                // if disable == 0ff, allow add to array
                if ( !$post_id ) $post_id = get_the_ID();
                $prices     = [];
                $off_adult  = get_post_meta( $post_id, 'hide_adult_in_booking_form', true );
                $off_child  = get_post_meta( $post_id, 'hide_children_in_booking_form', true );
                $off_infant = get_post_meta( $post_id, 'hide_infant_in_booking_form', true );
                if ( $off_adult != "on" ) $prices[] = get_post_meta( $post_id, 'adult_price', true );
                if ( $off_child != "on" ) $prices[] = get_post_meta( $post_id, 'child_price', true );
                if ( $off_infant != "on" ) $prices[] = get_post_meta( $post_id, 'infant_price', true );
                $discount = get_post_meta( $post_id, 'discount', true );
                if ( !empty( $discount ) ) {
                    return min( $prices ) * ( 100 - $discount ) / 100;
                }

                return min( $prices );
            }

            // from 1.2.4
            function meta_update_min_price( $post_id )
            {
                $min_price = self::get_min_price( $post_id );
                update_post_meta( $post_id, 'min_price', $min_price );
            }

            function meta_update_sale_price( $post_id )
            {
                if ( wp_is_post_revision( $post_id ) )
                    return;
                $post_type = get_post_type( $post_id );
                if ( $post_type == 'st_tours' ) {
                    $sale_price       = get_post_meta( $post_id, 'adult_price', true );
                    $discount         = get_post_meta( $post_id, 'discount', true );
                    $is_sale_schedule = get_post_meta( $post_id, 'is_sale_schedule', true );
                    if ( $is_sale_schedule == 'on' ) {
                        $sale_from = get_post_meta( $post_id, 'sale_price_from', true );
                        $sale_to   = get_post_meta( $post_id, 'sale_price_to', true );
                        if ( $sale_from and $sale_from ) {

                            $today     = date( 'Y-m-d' );
                            $sale_from = date( 'Y-m-d', strtotime( $sale_from ) );
                            $sale_to   = date( 'Y-m-d', strtotime( $sale_to ) );
                            if ( ( $today >= $sale_from ) && ( $today <= $sale_to ) ) {

                            } else {

                                $discount = 0;
                            }

                        } else {
                            $discount = 0;
                        }
                    }
                    if ( $discount ) {
                        $sale_price = $sale_price - ( $sale_price / 100 ) * $discount;
                    }
                    update_post_meta( $post_id, 'sale_price', $sale_price );
                }
            }

            function _resend_mail()
            {
                $order_item = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : false;

                $test = isset( $_GET[ 'test' ] ) ? $_GET[ 'test' ] : false;
                if ( $order_item ) {

                    $order = $order_item;

                    if ( $test ) {
                        global $order_id;
                        $order_id       = $order_item;
                        $email_to_admin = st()->get_option( 'email_for_admin', '' );
                        $email          = st()->load_template( 'email/header' );
	                    $email .= TravelHelper::_get_template_email($email, $email_to_admin);
                        $email .= st()->load_template( 'email/footer' );
                        echo( $email );
                        die;
                    }


                    if ( $order ) {
                        STCart::send_mail_after_booking( $order );
                    }
                }

                wp_safe_redirect( self::$booking_page . '&send_mail=success' );
            }

            static function st_room_select_ajax()
            {
                extract( wp_parse_args( $_GET, [
                    'room_parent' => '',
                    'post_type'   => '',
                    'q'           => ''
                ] ) );


                query_posts( [ 'post_type' => $post_type, 'posts_per_page' => 10, 's' => $q, 'meta_key' => 'room_parent', 'meta_value' => $room_parent ] );

                $r = [
                    'items' => [],
                ];
                while ( have_posts() ) {
                    the_post();
                    $r[ 'items' ][] = [
                        'id'          => get_the_ID(),
                        'name'        => get_the_title(),
                        'description' => ''
                    ];
                }

                wp_reset_query();

                echo json_encode( $r );
                die;

            }

            static function add_edit_scripts()
            {
                wp_enqueue_script( 'tour-booking', get_template_directory_uri() . '/js/admin/tour-booking.js', [ 'jquery', 'jquery-ui-datepicker' ], null, true );
                wp_enqueue_style( 'jjquery-ui.theme.min.css', get_template_directory_uri() . '/css/admin/jquery-ui.min.css' );

            }

            static function is_booking_page()
            {
                if ( is_admin()
                    and isset( $_GET[ 'post_type' ] )
                    and $_GET[ 'post_type' ] == 'st_tours'
                    and isset( $_GET[ 'page' ] )
                    and $_GET[ 'page' ] = 'st_tours_booking'
                ) return true;

                return false;
            }

            function new_menu_page()
            {
                //Add booking page
                add_submenu_page( 'edit.php?post_type=st_tours', __( 'Tour Booking', ST_TEXTDOMAIN ), __( 'Tour Booking', ST_TEXTDOMAIN ), 'manage_options', 'st_tours_booking', [ $this, '__tours_booking_page' ] );
            }

            function __tours_booking_page()
            {

                $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : false;

                if ( $section ) {
                    switch ( $section ) {
                        case "edit_order_item":
                            // show edit page
                            $this->edit_order_item();
                            break;
                    }
                } else {

                    $action = isset( $_POST[ 'st_action' ] ) ? $_POST[ 'st_action' ] : false;
                    switch ( $action ) {
                        case "delete":
                            $this->_delete_items();
                            break;
                    }
                    echo balanceTags( $this->load_view( 'tour/booking_index', false ) );
                }

            }

            function add_booking()
            {

                echo balanceTags( $this->load_view( 'tour/booking_edit', false, [ 'page_title' => __( 'Add new Tour Booking', ST_TEXTDOMAIN ) ] ) );
            }

            function _delete_items()
            {
                if ( empty( $_POST ) or !check_admin_referer( 'shb_action', 'shb_field' ) ) {
                    //// process form data, e.g. update fields
                    return;
                }
                $ids = isset( $_POST[ 'post' ] ) ? $_POST[ 'post' ] : [];
                if ( !empty( $ids ) ) {
                    foreach ( $ids as $id ){
                    	$status = get_post_meta($id, 'status', true);
                    	if(!empty($status)){
                    		if($status != 'canceled'){
								AvailabilityHelper::syncAvailabilityAfterCanceled($id);
		                    }
	                    }
	                    wp_delete_post( $id, true );
                        do_action('st_admin_delete_booking',$id);
                    }
                    die;
                }

                STAdmin::set_message( __( "Delete item(s) success", ST_TEXTDOMAIN ), 'updated' );

            }

            function edit_order_item()
            {
                $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : false;
                if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                    return false;
                }


                echo balanceTags( $this->load_view( 'tour/booking_edit' ) );
            }

            function _save_booking( $order_id )
            {
                if ( !check_admin_referer( 'shb_action', 'shb_field' ) ) die;
                if ( $this->_check_validate() ) {

                    $check_out_field = STCart::get_checkout_fields();

                    if ( !empty( $check_out_field ) ) {
                        foreach ( $check_out_field as $field_name => $field_desc ) {
                            if($field_name != 'st_note'){
                                update_post_meta( $order_id, $field_name, STInput::post( $field_name ) );
                            }
                        }
                    }

                    $item_data = [
                        'status' => $_POST[ 'status' ],
                    ];

                    foreach ( $item_data as $key => $value ) {
                        update_post_meta( $order_id, $key, $value );
                    }

                    if ( TravelHelper::checkTableDuplicate( 'st_tours' ) ) {
                        global $wpdb;

                        $table = $wpdb->prefix . 'st_order_item_meta';
                        $data  = [
                            'status' => $_POST[ 'status' ],
                        ];
                        $where = [
                            'order_item_id' => $order_id
                        ];
                        $wpdb->update( $table, $data, $where );
                    }

                    STCart::send_mail_after_booking( $order_id, true );

                    do_action('st_admin_edit_booking_status',$item_data['status'],$order_id);

                    wp_safe_redirect( self::$booking_page );
                }
            }

            function _check_validate()
            {
                $st_first_name = STInput::request( 'st_first_name', '' );
                if ( empty( $st_first_name ) ) {
                    STAdmin::set_message( __( 'The firstname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return false;
                }

                $st_last_name = STInput::request( 'st_last_name', '' );
                if ( empty( $st_last_name ) ) {
                    STAdmin::set_message( __( 'The lastname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return false;
                }

                $st_email = STInput::request( 'st_email', '' );
                if ( empty( $st_email ) ) {
                    STAdmin::set_message( __( 'The email field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return false;
                }

                $st_phone = STInput::request( 'st_phone', '' );
                if ( empty( $st_phone ) ) {
                    STAdmin::set_message( __( 'The phone field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return false;
                }


                return true;
            }

            static function get_price_person( $post_id = null )
            {
                if ( !$post_id ) $post_id = get_the_ID();

                $adult_price = get_post_meta( $post_id, 'adult_price', true );
                $child_price = get_post_meta( $post_id, 'child_price', true );

                $adult_price = apply_filters( 'st_apply_tax_amount', $adult_price );
                $child_price = apply_filters( 'st_apply_tax_amount', $child_price );

                $discount         = get_post_meta( $post_id, 'discount', true );
                $is_sale_schedule = get_post_meta( $post_id, 'is_sale_schedule', true );

                if ( $is_sale_schedule == 'on' ) {
                    $sale_from = get_post_meta( $post_id, 'sale_price_from', true );
                    $sale_to   = get_post_meta( $post_id, 'sale_price_to', true );
                    if ( $sale_from and $sale_from ) {

                        $today     = date( 'Y-m-d' );
                        $sale_from = date( 'Y-m-d', strtotime( $sale_from ) );
                        $sale_to   = date( 'Y-m-d', strtotime( $sale_to ) );
                        if ( ( $today >= $sale_from ) && ( $today <= $sale_to ) ) {

                        } else {

                            $discount = 0;
                        }

                    } else {
                        $discount = 0;
                    }
                }

                if ( $discount ) {
                    if ( $discount > 100 ) $discount = 100;

                    $adult_price_new = $adult_price - ( $adult_price / 100 ) * $discount;
                    $child_price_new = $child_price - ( $child_price / 100 ) * $discount;
                    $data            = [
                        'adult'     => $adult_price,
                        'adult_new' => $adult_price_new,
                        'child'     => $child_price,
                        'child_new' => $child_price_new,
                        'discount'  => $discount,

                    ];
                } else {
                    $data = [
                        'adult_new' => $adult_price,
                        'adult'     => $adult_price,
                        'child'     => $child_price,
                        'child_new' => $child_price,
                        'discount'  => $discount,
                    ];
                }


                return $data;
            }

            function get_price_by_tour( $tour_id )
            {
                if ( !empty( $tour_id ) && get_post_type( $tour_id ) == 'st_tours' ) {
                    $price            = floatval( get_post_meta( $tour_id, 'price', true ) );
                    $discount         = get_post_meta( $tour_id, 'discount', true );
                    $is_sale_schedule = get_post_meta( $tour_id, 'is_sale_schedule', true );

                    if ( $is_sale_schedule == 'on' ) {
                        $sale_from = get_post_meta( $tour_id, 'sale_price_from', true );
                        $sale_to   = get_post_meta( $tour_id, 'sale_price_to', true );
                        if ( $sale_from and $sale_from ) {

                            $today     = date( 'Y-m-d' );
                            $sale_from = date( 'Y-m-d', strtotime( $sale_from ) );
                            $sale_to   = date( 'Y-m-d', strtotime( $sale_to ) );
                            if ( ( $today >= $sale_from ) && ( $today <= $sale_to ) ) {

                            } else {

                                $discount = 0;
                            }

                        } else {
                            $discount = 0;
                        }
                    }
                    if ( $discount ) {
                        if ( $discount > 100 ) $discount = 100;

                        $price_new = $price - ( $price / 100 ) * $discount;

                        return $price_new;
                    } else {
                        return $price;
                    }
                }
            }

            function filter_price_by_person( $price_old, $number, $key = 1 )
            {
                $flag_return = false;

                $discount_by_adult = ( get_post_meta( STInput::request( 'item_id' ), 'discount_by_adult', true ) );
                $discount_by_child = ( get_post_meta( STInput::request( 'item_id' ), 'discount_by_child', true ) );

                if ( $key == 1 and is_array( $discount_by_adult ) and !empty( $discount_by_adult ) ) {
                    foreach ( $discount_by_adult as $key => $value ) {
                        if ( $number >= $value[ 'key' ] ) {
                            $flag_return = ( 1 - $value[ 'value' ] / 100 ) * $price_old;

                        }
                        if ( !$flag_return ) {
                            $flag_return = $price_old;
                        }
                    }

                    return $flag_return;
                }
                if ( $key == 2 and is_array( $discount_by_child ) and !empty( $discount_by_child ) ) {

                    foreach ( $discount_by_child as $key => $value ) {
                        if ( $number >= $value[ 'key' ] ) {
                            $flag_return = ( 1 - $value[ 'value' ] / 100 ) * $price_old;
                        }
                        if ( !$flag_return ) {
                            $flag_return = $price_old;
                        }
                    }

                    return $flag_return;
                }

                return $price_old;
            }

            function is_able_edit()
            {
                $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : false;
                if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                    wp_safe_redirect( self::$booking_page );
                    die;
                }

                return true;
            }


            /* Function  update ========================================================= */

            function tours_update_location( $post_id )
            {
                if ( wp_is_post_revision( $post_id ) )
                    return;
                $post_type = get_post_type( $post_id );

                if ( $post_type == 'st_tours' ) {
                    $location_id = get_post_meta( $post_id, 'id_location', true );
                    $ids_in      = [];
                    $parents     = get_posts( [ 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'location', 'post_parent' => $location_id ] );

                    $ids_in[] = $location_id;

                    foreach ( $parents as $child ) {
                        $ids_in[] = $child->ID;
                    }
                    $arg         = [
                        'post_type'  => 'st_tours',
                        'meta_query' => [
                            [
                                'key'            => 'id_location',
                                'posts_per_page' => '-1',
                                'value'          => $ids_in,
                                'compare'        => 'IN',
                            ],
                        ],
                    ];
                    $query       = new WP_Query( $arg );
                    $offer_tours = $query->post_count;

                    // get total review
                    $arg   = [
                        'post_type'      => 'st_tours',
                        'posts_per_page' => '-1',
                        'meta_query'     => [
                            [
                                'key'     => 'id_location',
                                'value'   => [ $location_id ],
                                'compare' => 'IN',
                            ],
                        ],
                    ];
                    $query = new WP_Query( $arg );
                    $total = 0;
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $total += get_comments_number();
                        }
                    }
                    // get car min price
                    $arg   = [
                        'post_type'      => 'st_tours',
                        'posts_per_page' => '1',
                        'order'          => 'ASC',
                        'meta_key'       => 'price',
                        'orderby'        => 'meta_value_num',
                        'meta_query'     => [
                            [
                                'key'     => 'id_location',
                                'value'   => [ $location_id ],
                                'compare' => 'IN',
                            ],
                        ],
                    ];
                    $query = new WP_Query( $arg );
                    if ( $query->have_posts() ) {
                        $query->the_post();
                        $price_min = get_post_meta( get_the_ID(), 'price', true );
                        update_post_meta( $location_id, 'review_st_tours', $total );
                        update_post_meta( $location_id, 'min_price_st_tours', $price_min );
                        update_post_meta( $location_id, 'offer_st_tours', $offer_tours );
                    }
                    wp_reset_postdata();

                }
            }

            function tours_update_price_sale( $post_id )
            {
                if ( wp_is_post_revision( $post_id ) )
                    return;
                $post_type = get_post_type( $post_id );

                if ( $post_type == 'st_tours' ) {
                    $discount = get_post_meta( $post_id, 'discount', true );
                    $price    = get_post_meta( $post_id, 'price', true );
                    if ( !empty( $discount ) ) {
                        $price_sale = (float)$price - (float)$price * ( (float)$discount / 100 );
                        update_post_meta( $post_id, 'price_sale', $price_sale );
                    }
                }
            }

            function add_col_header( $defaults )
            {

                $this->array_splice_assoc( $defaults, 2, 0, [
                    'tour_type'   => __( "Tour Type", ST_TEXTDOMAIN ),
                    'price'       => __( 'Price', ST_TEXTDOMAIN ),
                    'tour_layout' => __( 'Layout', ST_TEXTDOMAIN ),

                ] );

                return $defaults;
            }

            function array_splice_assoc( &$input, $offset, $length = 0, $replacement = [] )
            {
                $tail      = array_splice( $input, $offset );
                $extracted = array_splice( $tail, 0, $length );
                $input += $replacement + $tail;

                return $extracted;
            }

            function add_col_content( $column_name, $post_ID )
            {
                if ( $column_name == 'tour_layout' ) {
                    // show content of 'directors_name' column
                    $parent = get_post_meta( $post_ID, 'st_custom_layout', TRUE );

                    if ( $parent ) {
                        echo "<a href='" . get_edit_post_link( $parent ) . "'>" . get_the_title( $parent ) . "</a>";
                    } else {
                        echo __( 'Default', ST_TEXTDOMAIN );
                    }
                }
                if ( $column_name == 'tour_type' ) {
                    $type = get_post_meta( $post_ID, 'type_tour', true );
                    switch ( $type ) {
                        case 'daily_tour' :
                            echo __( "Daily Tour", ST_TEXTDOMAIN );
                            break;
                        case 'specific_date':
                            echo __( "Specific Date", ST_TEXTDOMAIN );
                            break;
                        default:
                            echo "none";
                            break;
                    }
                }
                if ( $column_name == 'price' ) {
                    $discount = get_post_meta( $post_ID, 'discount', true );

                    $price_adult = get_post_meta( $post_ID, 'adult_price', true );
                    $price_child = get_post_meta( $post_ID, 'child_price', true );
                    if ( !empty( $discount ) ) {
                        $is_sale_schedule = get_post_meta( $post_ID, 'is_sale_schedule', true );

                        $sale_adult = $price_adult - $price_adult * ( $discount / 100 );
                        $sale_child = $price_child - $price_child * ( $discount / 100 );
                        if ( $is_sale_schedule == "on" ) {
                            $sale_from = get_post_meta( $post_ID, 'sale_price_from', true );
                            $sale_from = mysql2date( 'd/m/Y', $sale_from );
                            $sale_to   = get_post_meta( $post_ID, 'sale_price_to', true );
                            $sale_to   = mysql2date( 'd/m/Y', $sale_to );
                            echo '<span> ' . __( "Adult Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_adult ) . '</span> <i class="fa fa-arrow-right"></i> <strong>' . TravelHelper::format_money( $sale_adult ) . '</strong><br>';
                            echo '<span>' . __( "Child Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_child ) . '</span> <i class="fa fa-arrow-right"></i> <strong>' . TravelHelper::format_money( $sale_child ) . '</strong><br>';
                            echo '<span>' . __( 'Discount rate', ST_TEXTDOMAIN ) . ' : ' . $discount . '%</span><br>';
                            echo '<span> ' . $sale_from . ' <i class="fa fa-arrow-right"></i> ' . $sale_to . '</span>';
                        } else {
                            echo '<span> ' . __( "Adult Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_adult ) . '</span> <i class="fa fa-arrow-right"></i> <strong>' . TravelHelper::format_money( $sale_adult ) . '</strong><br>';
                            echo '<span>' . __( "Child Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_child ) . '</span> <i class="fa fa-arrow-right"></i> <strong>' . TravelHelper::format_money( $sale_child ) . '</strong><br>';
                            echo '<span>' . __( 'Discount rate', ST_TEXTDOMAIN ) . ' : ' . $discount . '%</span><br>';
                        }
                    } else {
                        echo '<span> ' . __( "Adult Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_adult ) . '</span><br>';
                        echo '<span>' . __( "Child Price", ST_TEXTDOMAIN ) . ': ' . TravelHelper::format_money( $price_child ) . '</span>';
                    }
                }
            }


	        static function inst()
	        {
		        if ( !self::$_inst ) {
			        self::$_inst = new self();
		        }

		        return self::$_inst;
	        }
        }

	    STAdminTours::inst();
    }