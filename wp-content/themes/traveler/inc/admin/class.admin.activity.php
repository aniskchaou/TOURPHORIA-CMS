<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAdminActivity
     *
     * Created by ShineTheme
     *
     */
    $order_id = 0;
    if ( !class_exists( 'STAdminActivity' ) ) {
        class STAdminActivity extends STAdmin
        {

            static    $booking_page;
            static    $_table_version = "1.3.0";
            protected $post_type      = "st_activity";
	        protected static $_inst;

            /**
             *
             *
             * @update 1.1.3
             * */
            function __construct()
            {

                add_action( 'init', [ $this, 'init_post_type' ], 8 );

                if ( !st_check_service_available( $this->post_type ) ) return;

                //Add metabox
                add_action( 'current_screen', [ $this, 'init_metabox' ] );

                add_filter( 'manage_st_activity_posts_columns', [ $this, 'add_col_header' ], 10 );
                add_action( 'manage_st_activity_posts_custom_column', [ $this, 'add_col_content' ], 10, 2 );


                //===============================================================

                self::$booking_page = admin_url( 'edit.php?post_type=st_activity&page=st_activity_booking' );


                add_action( 'admin_menu', [ $this, 'add_menu_page' ] );

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

                add_action( 'wp_ajax_st_getInfoActivity', [ __CLASS__, '_getInfoActivity' ], 9999 );

                /**
                 *   since 1.2.4
                 *   auto create & update table st_activity
                 **/
                add_action( 'after_setup_theme', [ __CLASS__, '_check_table_activity' ] );

                /**
                 * @since 1.3.0
                 *        Bulk calendar
                 **/
                add_action( 'traveler_after_form_activity_calendar', [ $this, 'custom_traveler_after_form_activity_calendar' ] );
                add_action( 'traveler_after_form_submit_activity_calendar', [ $this, 'custom_traveler_after_form_submit_activity_calendar' ] );

	            add_action('init', array($this, '__update_db_available_first_run'), 99);
	            add_action('st_availability_cronjob',array($this,'__cronjob_fill_availability'));
            }

	        public function __cronjob_fill_availability($offset = 0, $limit = -1, $day=null)
	        {
		        global $wpdb;
		        if(!$day){
			        $today=new DateTime(date('Y-m-d'));
			        $today->modify('+ 6 months');
			        $day=$today->modify('+ 1 day');
		        }
		        $table='st_activity_availability';
		        $post_type='st_activity';

		        $tours=new WP_Query(array(
			        'posts_per_page'=>$limit,
			        'post_type'=>$post_type,
			        'meta_key' => 'type_activity',
			        'meta_value' => 'daily_activity',
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
			        $max_people = get_post_meta(get_the_ID(), 'max_people', true);
			        if(empty($max_people)) $max_people = 0;
			        $booking_period = get_post_meta(get_the_ID(), 'activity_booking_period', true);
			        if(empty($booking_period)) $booking_period = 0;
			        $status='available';
			        $insertBatch[]=$wpdb->prepare("(%d,%d,%d,%s,%s,%s,%s,%d,%d,%d,%d)",$day->getTimestamp(),$day->getTimestamp(),get_the_ID(),$status, $adult_price, $child_price, $infant_price, 1, 0,$max_people,$booking_period);

			        $ids[]=get_the_ID();
		        }
		        if(!empty($insertBatch))
		        {
			        $wpdb->query("INSERT IGNORE INTO {$wpdb->prefix}{$table} (check_in,check_out,post_id,`status`,adult_price,child_price,infant_price,is_base,groupday,`number`,booking_period) VALUES ".implode(",\r\n",$insertBatch));
		        }

		        wp_reset_postdata();
	        }

	        public function __run_fill_old_order($key='')
	        {
	        	$ids = [];
		        global $wpdb;
		        $table  = $wpdb->prefix . 'st_activity_availability';
		        $model=ST_Order_Item_Model::inst();
		        $orderItems=$model->where("st_booking_post_type in ('st_activity')",false,true)
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
					        $check=ST_Activity_Availability::inst()->where($where)->get(1)->row();

					        if($check){
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
								        'adult_price' => get_post_meta($data['origin_id'], 'adult_price', true),
								        'child_price' => get_post_meta($data['origin_id'], 'child_price', true),
								        'infant_price' => get_post_meta($data['origin_id'], 'infant_price', true),
								        'status' => 'available',
								        'groupday' => 0,
								        'number_booked' => $booked,
								        'booking_period' => get_post_meta($data['origin_id'], 'activity_booking_period', true),
								        'is_base' => 0,
							        ];
							        ST_Activity_Availability::inst()->insert($data_insert);
						        }
					        }
				        }
			        }
		        }
	        }

	        public function __update_db_available_first_run(){
		        //Fill old data
		        $key = 'st_activity_availability_fill_old_data';
		        if(empty(get_option($key))) {
			        $model_avail = ST_Availability_Model::inst()
			                                            ->where( 'post_type', 'st_activity' )
			                                            ->where( 'check_in >= UNIX_TIMESTAMP(CURRENT_DATE)', false, true )->get()->result();
			        if ( ! empty( $model_avail ) ) {
				        global $wpdb;
				        $table       = $wpdb->prefix . 'st_activity_availability';
				        $insertBatch = [];
				        $ids         = [];
				        $i           = 1;
				        foreach ( $model_avail as $k => $v ) {
					        $max_people = get_post_meta( $v['post_id'], 'max_people', true );
					        if ( empty( $max_people ) ) {
						        $max_people = 0;
					        }
					        $booking_period = get_post_meta( $v['post_id'], 'activity_booking_period', true );
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
						        $sql_delete = $wpdb->prepare("DELETE FROM {$wpdb->prefix}st_availability WHERE post_type=%s", 'st_activity');
						        $wpdb->query($sql_delete);
					        }
				        }
			        }
			        update_option( $key, 1 );
		        }
	        }

            public function custom_traveler_after_form_activity_calendar()
            {
                echo balanceTags( st()->load_template( 'tours/tour-calendar', false ) );
            }

            public function custom_traveler_after_form_submit_activity_calendar()
            {
                echo '<button type="button" id="calendar-bulk-edit" class="option-tree-ui-button button button-primary button-large btn btn-primary btn-sm" style="float: right;">' . __( 'Bulk Edit', ST_TEXTDOMAIN ) . '</button>';
            }

            static function check_ver_working()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );

                return $dbhelper->check_ver_working( 'st_activity_table_version' );
            }

            static function _check_table_activity()
            {
                $dbhelper = new DatabaseHelper( self::$_table_version );
                $dbhelper->setTableName( 'st_activity' );
                $column = [
                    'post_id'                 => [
                        'type'   => 'INT',
                        'length' => 11,
                    ],
                    'multi_location'          => [
                        'type' => 'text',
                    ],
                    'id_location'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'address'                 => [
                        'type' => 'text',
                    ],
                    'price'                   => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'sale_price'              => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'child_price'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'adult_price'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'infant_price'            => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'min_price'               => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'type_activity'           => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_in'                => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_out'               => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'rate_review'             => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'activity_booking_period' => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'max_people'              => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'duration'                => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'is_sale_schedule'        => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'discount'                => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'sale_price_from'         => [
                        'type'   => 'date',
                        'length' => 255
                    ],
                    'sale_price_to'           => [
                        'type'   => 'date',
                        'length' => 255
                    ],
                ];

                $column = apply_filters( 'st_change_column_st_activity', $column );

                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'st_activity_table_version' );

                return array_keys( $column );
            }

            static function _getInfoActivity()
            {
                $activity_id = intval( STInput::request( 'activity_id', '' ) );
                $result      = [
                    'type_activity' => '',
                    'max_people'    => 0,
                    'adult_html'    => '',
                    'child_html'    => '',
                    'infant_html'   => '',
                ];
                $duration    = '';
                if ( get_post_type( $activity_id ) == 'st_activity' ) {
                    $type_activity = get_post_meta( $activity_id, 'type_activity', TRUE );
                    $max_people    = intval( get_post_meta( $activity_id, 'max_people', TRUE ) );

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

                    if ( $type_activity && $type_activity == 'daily_activity' ) {
                        $html                      = "<select name='type_activity' class='form-control form-control-admin'>
                        <option value='daily_activity'>" . __( 'Daily Activity', ST_TEXTDOMAIN ) . "</option>
                    </select>";
                        $result[ 'type_activity' ] = $html;
                        $result[ 'activity_text' ] = $type_activity;
                        $duration                  = get_post_meta( $activity_id, 'duration', TRUE );
                    } elseif ( $type_activity && $type_activity == 'specific_date' ) {
                        $html = "<select name='type_activity' class='form-control form-control-admin'>
                        <option value='specific_date'>" . __( 'Specific Date', ST_TEXTDOMAIN ) . "</option>
                    </select>";

                        $result[ 'type_activity' ] = $html;
                        $result[ 'activity_text' ] = $type_activity;
                    }
                    $extras = get_post_meta( $activity_id, 'extra_price', true );
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
                $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : FALSE;
                switch ( $section ) {
                    case "edit_order_item":
                        $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;
                        if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                            return FALSE;
                        }
                        if ( isset( $_POST[ 'submit' ] ) and $_POST[ 'submit' ] ) $this->_save_booking( $item_id );
                        break;
                    case 'resend_email_activity':
                        $this->_resend_mail();
                        break;
                }
            }

            function _update_duplicate_data( $id, $data )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_activity' ) ) return;

                if ( get_post_type( $id ) == 'st_activity' ) {
                    $num_rows = TravelHelper::checkIssetPost( $id, 'st_activity' );

                    $location_str = get_post_meta( $id, 'multi_location', true );

                    $location_id = ''; // multi location

                    $address                 = get_post_meta( $id, 'address', true );
                    $price                   = get_post_meta( $id, 'price', true ); // removed
                    $type_activity           = get_post_meta( $id, 'type_activity', true );
                    $check_in                = get_post_meta( $id, 'check_in', true );
                    $check_out               = get_post_meta( $id, 'check_out', true );
                    $activity_booking_period = get_post_meta( $id, 'activity_booking_period', true );
                    $max_people              = get_post_meta( $id, 'max_people', true );
                    $duration                = get_post_meta( $id, 'duration', true );

                    $sale_price = get_post_meta( $id, 'price', true );


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
                            'multi_location'          => $location_str,
                            'id_location'             => $location_id,
                            'address'                 => $address,
                            'price'                   => $price, // removed
                            'type_activity'           => $type_activity,
                            'check_in'                => $check_in,
                            'check_out'               => $check_out,
                            'sale_price'              => $sale_price,
                            'child_price'             => $child_price,
                            'adult_price'             => $adult_price,
                            'infant_price'            => $infant_price,
                            'min_price'               => $min_price,
                            'rate_review'             => $rate_review,
                            'activity_booking_period' => $activity_booking_period,
                            'max_people'              => $max_people,
                            'duration'                => $duration,
                            'discount'                => $discount,
                            'sale_price_from'         => $sale_from,
                            'sale_price_to'           => $sale_to,
                            'is_sale_schedule'        => $is_sale_schedule,
                        ];
                        $where = [
                            'post_id' => $id
                        ];
                        TravelHelper::updateDuplicate( 'st_activity', $data, $where );
                    } elseif ( $num_rows == 0 ) {
                        $data = [
                            'post_id'                 => $id,
                            'multi_location'          => $location_str,
                            'id_location'             => $location_id,
                            'address'                 => $address,
                            'price'                   => $price,
                            'type_activity'           => $type_activity,
                            'check_in'                => $check_in,
                            'check_out'               => $check_out,
                            'sale_price'              => $sale_price,
                            'child_price'             => $child_price,
                            'adult_price'             => $adult_price,
                            'infant_price'            => $infant_price,
                            'min_price'               => $min_price,
                            'rate_review'             => $rate_review,
                            'activity_booking_period' => $activity_booking_period,
                            'max_people'              => $max_people,
                            'duration'                => $duration,
                            'discount'                => $discount,
                            'sale_price_from'         => $sale_from,
                            'sale_price_to'           => $sale_to,
                            'is_sale_schedule'        => $is_sale_schedule,
                        ];
                        TravelHelper::insertDuplicate( 'st_activity', $data );
                    }
                    //Update meta to st_availability when save post
	                $model=ST_Activity_Availability::inst();
	                $model->where('post_id',$id)
	                      ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", true, false)
	                      ->update(array(
		                'number'=> empty($max_people) ? 0 : $max_people,
		                'booking_period' => empty($activity_booking_period) ? 0 : $activity_booking_period
	                ));

	                $data_prices = $model->get_prices_by_id($id);
	                if(!empty($data_prices)) {
		                $data_price      = $data_prices[0];
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
	                }
                }
            }

            public function _delete_data( $post_id )
            {
                if ( get_post_type( $post_id ) == 'st_activity' ) {
                    global $wpdb;
                    $table = $wpdb->prefix . 'st_activity';
                    $rs    = TravelHelper::deleteDuplicateData( $post_id, $table );
                    if ( !$rs )
                        return false;

                    return true;
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
             *
             *
             *
             * */
            function init_post_type()
            {
                if ( !st_check_service_available( $this->post_type ) ) {
                    return;
                }

                if ( !function_exists( 'st_reg_post_type' ) ) return;
                // Activity ==============================================================

                $labels = [
                    'name'                  => __( 'Activity', ST_TEXTDOMAIN ),
                    'singular_name'         => __( 'Activity', ST_TEXTDOMAIN ),
                    'menu_name'             => __( 'Activity', ST_TEXTDOMAIN ),
                    'name_admin_bar'        => __( 'Activity', ST_TEXTDOMAIN ),
                    'add_new'               => __( 'Add New', ST_TEXTDOMAIN ),
                    'add_new_item'          => __( 'Add New Activity', ST_TEXTDOMAIN ),
                    'new_item'              => __( 'New Activity', ST_TEXTDOMAIN ),
                    'edit_item'             => __( 'Edit Activity', ST_TEXTDOMAIN ),
                    'view_item'             => __( 'View Activity', ST_TEXTDOMAIN ),
                    'all_items'             => __( 'All Activity', ST_TEXTDOMAIN ),
                    'search_items'          => __( 'Search Activity', ST_TEXTDOMAIN ),
                    'parent_item_colon'     => __( 'Parent Activity:', ST_TEXTDOMAIN ),
                    'not_found'             => __( 'No Activity found.', ST_TEXTDOMAIN ),
                    'not_found_in_trash'    => __( 'No Activity found in Trash.', ST_TEXTDOMAIN ),
                    'insert_into_item'      => __( 'Insert into Activity', ST_TEXTDOMAIN ),
                    'uploaded_to_this_item' => __( "Uploaded to this Activity", ST_TEXTDOMAIN ),
                    'featured_image'        => __( "Feature Image", ST_TEXTDOMAIN ),
                    'set_featured_image'    => __( "Set featured image", ST_TEXTDOMAIN )
                ];

                $args = [
                    'labels'             => $labels,
                    'public'             => true,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'query_var'          => true,
                    'rewrite'            => [ 'slug' => get_option( 'activity_permalink', 'st_activity' ) ],
                    'capability_type'    => 'post',
                    'hierarchical'       => false,
                    'supports'           => [ 'author', 'title', 'editor', 'excerpt', 'thumbnail', 'comments' ],
                    'menu_icon'          => 'dashicons-tickets-alt-st'
                ];
                st_reg_post_type( 'st_activity', $args );
            }

            /**
             *
             *
             * @since 1.1.1
             * */
            function init_metabox()
            {
                $screen = get_current_screen();
                if ( $screen->id != 'st_activity' ) {
                    return false;
                }
                $this->metabox[] = [
                    'id'       => 'activity_metabox',
                    'title'    => __( 'Activity Setting', ST_TEXTDOMAIN ),
                    'pages'    => [ 'st_activity' ],
                    'context'  => 'normal',
                    'priority' => 'high',
                    'fields'   => [
                        [
                            'label' => __( 'Location', ST_TEXTDOMAIN ),
                            'id'    => 'location_reneral_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'     => __( 'Activity location', ST_TEXTDOMAIN ),
                            'id'        => 'multi_location', // id_location
                            'type'      => 'list_item_post_type',
                            'post_type' => 'location',
                            'desc'      => __( 'Select one or more location for your activity', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Real activity address ', ST_TEXTDOMAIN ),
                            'id'    => 'address',
                            'type'  => 'address_autocomplete',
                            'desc'  => __( 'Input your activity address detail', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Location on map', ST_TEXTDOMAIN ),
                            'id'    => 'st_google_map',
                            'type'  => 'bt_gmap',
                            'std'   => 'off',
                            'desc'  => __( 'Select one location on map to see latiture and longiture', ST_TEXTDOMAIN )
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
                            'desc'  => __( 'Turn on/off streetview mode for this location', ST_TEXTDOMAIN ),
                            'std'   => 'on'
                        ],
                        [
                            'label' => __( 'General', ST_TEXTDOMAIN ),
                            'id'    => 'room_reneral_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Set activity as feature', ST_TEXTDOMAIN ),
                            'id'    => 'is_featured',
                            'type'  => 'on-off',
                            'desc'  => __( 'Will show this activity with feature label or not', ST_TEXTDOMAIN ),
                            'std'   => 'off'
                        ],
                        [
                            'label'     => __( 'Activity single layout', ST_TEXTDOMAIN ),
                            'id'        => 'st_custom_layout',
                            'post_type' => 'st_layouts',
                            'desc'      => __( 'Select one activity single layout', ST_TEXTDOMAIN ),
                            'type'      => 'select',
                            'choices'   => st_get_layout( 'st_activity' )
                        ],

                        [
                            'label' => __( 'Activity gallery', ST_TEXTDOMAIN ),
                            'id'    => 'gallery',
                            'type'  => 'gallery',
                            'desc'  => __( 'Upload activity images to show to customers', ST_TEXTDOMAIN )
                        ],

                        [
                            'label' => __( 'Activity video', ST_TEXTDOMAIN ),
                            'id'    => 'video',
                            'type'  => 'text',
                            'desc'  => __( 'Input youtube/vimeo url here', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Contact information', ST_TEXTDOMAIN ),
                            'id'    => 'agent_tab',
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
                            'label' => __( 'Website', ST_TEXTDOMAIN ),
                            'id'    => 'contact_web',
                            'type'  => 'text',
                            'desc'  => __( 'Website address', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Phone', ST_TEXTDOMAIN ),
                            'id'    => 'contact_phone',
                            'type'  => 'text',
                            'desc'  => __( 'Phone number', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Fax number', ST_TEXTDOMAIN ),
                            'id'    => 'contact_fax',
                            'type'  => 'text',
                            'desc'  => __( 'Fax number', ST_TEXTDOMAIN ),
                        ],

                        [
                            'label' => __( 'Info settings', ST_TEXTDOMAIN ),
                            'id'    => 'activity_time_number_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'   => __( 'Activity type', ST_TEXTDOMAIN ),
                            'id'      => 'type_activity',
                            'type'    => 'select',
                            'desc'    => __( 'Activity type', ST_TEXTDOMAIN ),
                            'choices' => [
                                [
                                    'value' => 'specific_date',
                                    'label' => __( 'Specific Date', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'daily_activity',
                                    'label' => __( 'Daily Activity', ST_TEXTDOMAIN )
                                ],
                            ]
                        ],
                        [
                            'label'     => __( 'Duration', ST_TEXTDOMAIN ),
                            'id'        => 'duration',
                            'type'      => 'text',
                            'condition' => 'type_activity:is(daily_activity)',
                            'desc'      => __( 'The total time to take each activity package', ST_TEXTDOMAIN ),
                        ],

                        [
                            'label'        => __( 'Booking period', ST_TEXTDOMAIN ),
                            'id'           => 'activity_booking_period',
                            'type'         => 'numeric-slider',
                            'min_max_step' => '0,30,1',
                            'std'          => 0,
                            'desc'         => __( 'Booking time period prior to arrival.', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Activity time', ST_TEXTDOMAIN ),
                            'id'    => 'activity-time',
                            'type'  => 'text',
                            'desc'  => __( 'The departure time of an activity', ST_TEXTDOMAIN ),
                        ],
                        [
                            'label' => __( 'Max number of people', ST_TEXTDOMAIN ),
                            'id'    => 'max_people',
                            'type'  => 'text',
                            'desc'  => __( 'Max number of people. Leave empty or enter \'0\' for unlimited', ST_TEXTDOMAIN ),
                            'std'   => '1',
                        ],
                        [
                            'label' => __( 'Venue facilities', ST_TEXTDOMAIN ),
                            'id'    => 'venue-facilities',
                            'type'  => 'text',
                            'desc'  => __( 'The facilities that customer may experience during activities', ST_TEXTDOMAIN ),
                        ],

                        [
                            'label' => __( 'Price setting', ST_TEXTDOMAIN ),
                            'id'    => 'price_number_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label'     => __( 'Adult price', ST_TEXTDOMAIN ),
                            'id'        => 'adult_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per adult', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => "hide_adult_in_booking_form:is(off)"
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
                                    'label' => __( 'Value percent of discount', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ]
                            ],
                            'condition' => "hide_adult_in_booking_form:is(off)"
                        ],
                        [
                            'label'     => __( 'Child price', ST_TEXTDOMAIN ),
                            'id'        => 'child_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per child', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => "hide_children_in_booking_form:is(off)"
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
                                    'label' => __( 'Value percent of discount', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                ]
                            ],
                            'condition' => "hide_children_in_booking_form:is(off)"
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
                            ]
                        ],
                        [
                            'label'     => __( 'Infant price', ST_TEXTDOMAIN ),
                            'id'        => 'infant_price',
                            'type'      => 'text',
                            'desc'      => __( 'Price per infant', ST_TEXTDOMAIN ),
                            'std'       => 0,
                            'condition' => "hide_infant_in_booking_form:is(off)"
                        ],
                        [
                            'label' => __( 'Disable adult booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_adult_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of adult in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
                        ],
                        [
                            'label' => __( 'Disable children booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_children_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of child in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
                        ],
                        [
                            'label' => __( 'Disable infant booking', ST_TEXTDOMAIN ),
                            'id'    => 'hide_infant_in_booking_form',
                            'type'  => 'on-off',
                            'desc'  => __( 'Hide No of infant in booking form', ST_TEXTDOMAIN ),
                            'std'   => 'off',
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
                            'label'    => __( 'Extra price', ST_TEXTDOMAIN ),
                            'id'       => 'extra_price',
                            'type'     => 'list-item',
                            'settings' => [
                                [
                                    'id'    => 'extra_name',
                                    'type'  => 'text',
                                    'std'   => 'extra_',
                                    'label' => __( 'Name of item', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_max_number',
                                    'type'  => 'text',
                                    'std'   => '',
                                    'label' => __( 'Max of number', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_price',
                                    'type'  => 'text',
                                    'std'   => '',
                                    'label' => __( 'Price', ST_TEXTDOMAIN ),
                                    'desc'  => __( 'per 1 item', ST_TEXTDOMAIN ),
                                ],
                                [
                                    'id'    => 'extra_required',
                                    'type'  => 'on-off',
                                    'std'   => 'off',
                                    'label' => __( 'Required Extra', ST_TEXTDOMAIN ),
                                    'desc'  => __( '', ST_TEXTDOMAIN ),
                                ],
                            ]

                        ],
                        [
                            'label' => __( 'Discount', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Discount', ST_TEXTDOMAIN ),
                            'id'    => 'discount',
                            'type'  => 'text',
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
                            'label'     => __( 'Sale price date from', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Sale price date from', ST_TEXTDOMAIN ),
                            'id'        => 'sale_price_from',
                            'type'      => 'date-picker',
                            'condition' => 'is_sale_schedule:is(on)'
                        ],

                        [
                            'label'     => __( 'Sale price date to', ST_TEXTDOMAIN ),
                            'desc'      => __( 'Sale price date to', ST_TEXTDOMAIN ),
                            'id'        => 'sale_price_to',
                            'type'      => 'date-picker',
                            'condition' => 'is_sale_schedule:is(on)'
                        ],

                        [
                            'label' => __( 'Best price guarantee', ST_TEXTDOMAIN ),
                            'id'    => 'best-price-guarantee',
                            'type'  => 'on-off',
                            'std'   => 'off'
                        ],
                        [
                            'label'     => __( 'Best price guarantee text', ST_TEXTDOMAIN ),
                            'id'        => 'best-price-guarantee-text',
                            'type'      => 'textarea',
                            'rows'      => '2',
                            'condition' => 'best-price-guarantee:is(on)',
                        ],
                        [
                            'label' => __( 'Activity external booking', ST_TEXTDOMAIN ),
                            'id'    => 'st_activity_external_booking',
                            'type'  => 'on-off',
                            'std'   => "off",
                        ],
                        [
                            'label'     => __( 'Activity external booking', ST_TEXTDOMAIN ),
                            'id'        => 'st_activity_external_booking_link',
                            'type'      => 'text',
                            'std'       => "",
                            'condition' => 'st_activity_external_booking:is(on)',
                            'desc'      => "<em>" . __( 'Notice: Must be http://...', ST_TEXTDOMAIN ) . "</em>",
                        ],

                        [
                            'id'      => 'deposit_payment_status',
                            'label'   => __( "Deposit payment options", ST_TEXTDOMAIN ),
                            'desc'    => __( 'You can select <code>Disallow Deposit</code>, <code>Deposit by percent</code>, <code>Deposit by amount</code>' ),
                            'type'    => 'select',
                            'choices' => [
                                [
                                    'value' => '',
                                    'label' => __( 'Disallow deposit', ST_TEXTDOMAIN )
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
                            'label' => __( 'Availability', ST_TEXTDOMAIN ),
                            'id'    => 'availability_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Activity calendar', ST_TEXTDOMAIN ),
                            'id'    => 'st_activity_calendar',
                            'type'  => 'st_activity_calendar'
                        ],
                        [
                            'label' => __( 'Cancel booking', ST_TEXTDOMAIN ),
                            'id'    => 'st_cancel_booking_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Allow cancelation', ST_TEXTDOMAIN ),
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
                $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
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
                if ( $post_type == 'st_activity' ) {
                    $sale_price       = get_post_meta( $post_id, 'price', TRUE );
                    $discount         = get_post_meta( $post_id, 'discount', TRUE );
                    $is_sale_schedule = get_post_meta( $post_id, 'is_sale_schedule', TRUE );
                    if ( $is_sale_schedule == 'on' ) {
                        $sale_from = get_post_meta( $post_id, 'sale_price_from', TRUE );
                        $sale_to   = get_post_meta( $post_id, 'sale_price_to', TRUE );
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
                $order_item = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;

                $test = isset( $_GET[ 'test' ] ) ? $_GET[ 'test' ] : FALSE;
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
                wp_enqueue_script( 'activity-booking', get_template_directory_uri() . '/js/admin/activity-booking.js', [ 'jquery', 'jquery-ui-datepicker' ], null, TRUE );
                wp_enqueue_style( 'jjquery-ui.theme.min.css', get_template_directory_uri() . '/css/admin/jquery-ui.min.css' );

            }

            static function is_booking_page()
            {
                if ( is_admin()
                    and isset( $_GET[ 'post_type' ] )
                    and $_GET[ 'post_type' ] == 'st_activity'
                    and isset( $_GET[ 'page' ] )
                    and $_GET[ 'page' ] = 'st_activity_booking'
                ) return TRUE;

                return FALSE;
            }

            function add_menu_page()
            {
                //Add booking page
                add_submenu_page( 'edit.php?post_type=st_activity', __( 'Activity Booking', ST_TEXTDOMAIN ), __( 'Activity Booking', ST_TEXTDOMAIN ), 'manage_options', 'st_activity_booking', [ $this, '__activity_booking_page' ] );
            }

            function __activity_booking_page()
            {

                $section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : FALSE;

                if ( $section ) {
                    switch ( $section ) {
                        case "edit_order_item":
                            $this->edit_order_item();
                            break;
                    }
                } else {

                    $action = isset( $_POST[ 'st_action' ] ) ? $_POST[ 'st_action' ] : FALSE;
                    switch ( $action ) {
                        case "delete":
                            $this->_delete_items();
                            break;
                    }
                    echo balanceTags( $this->load_view( 'activity/booking_index', FALSE ) );
                }

            }

            function add_booking()
            {

                echo balanceTags( $this->load_view( 'activity/booking_edit', FALSE, [ 'page_title' => __( 'Add new Activity Booking', ST_TEXTDOMAIN ) ] ) );
            }

            function _delete_items()
            {

                if ( empty( $_POST ) or !check_admin_referer( 'shb_action', 'shb_field' ) ) {
                    //// process form data, e.g. update fields
                    return;
                }
                $ids = isset( $_POST[ 'post' ] ) ? $_POST[ 'post' ] : [];
                if ( !empty( $ids ) ) {
                    foreach ( $ids as $id )
                        wp_delete_post( $id, TRUE );

                }

                STAdmin::set_message( __( "Delete item(s) success", ST_TEXTDOMAIN ), 'updated' );

            }

            function edit_order_item()
            {
                $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;
                if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                    return FALSE;
                }
                if ( isset( $_POST[ 'submit' ] ) and $_POST[ 'submit' ] ) $this->_save_booking( $item_id );

                echo balanceTags( $this->load_view( 'activity/booking_edit' ) );
            }

            function _save_booking( $order_id )
            {
                if ( !check_admin_referer( 'shb_action', 'shb_field' ) ) die( 'shb_action' );
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
                        'status' => $_POST[ 'status' ]
                    ];

                    foreach ( $item_data as $key => $value ) {
                        update_post_meta( $order_id, $key, $value );
                    }

                    if ( TravelHelper::checkTableDuplicate( 'st_activity' ) ) {
                        global $wpdb;

                        $table = $wpdb->prefix . 'st_order_item_meta';
                        $data  = [
                            'status' => $_POST[ 'status' ]
                        ];

                        $where = [
                            'order_item_id' => $order_id
                        ];
                        $wpdb->update( $table, $data, $where );
                    }

                    STCart::send_mail_after_booking( $order_id, TRUE );

                    do_action('st_admin_edit_booking_status',$item_data['status'],$order_id);

                    wp_safe_redirect( self::$booking_page );
                }

            }

            function _check_validate()
            {
                $st_first_name = STInput::request( 'st_first_name', '' );
                if ( empty( $st_first_name ) ) {
                    STAdmin::set_message( __( 'The firstname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return FALSE;
                }

                $st_last_name = STInput::request( 'st_last_name', '' );
                if ( empty( $st_last_name ) ) {
                    STAdmin::set_message( __( 'The lastname field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return FALSE;
                }

                $st_email = STInput::request( 'st_email', '' );
                if ( empty( $st_email ) ) {
                    STAdmin::set_message( __( 'The email field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return FALSE;
                }

                $st_phone = STInput::request( 'st_phone', '' );
                if ( empty( $st_phone ) ) {
                    STAdmin::set_message( __( 'The phone field is not empty.', ST_TEXTDOMAIN ), 'danger' );

                    return FALSE;
                }


                return true;

            }

            function is_able_edit()
            {
                $item_id = isset( $_GET[ 'order_item_id' ] ) ? $_GET[ 'order_item_id' ] : FALSE;
                if ( !$item_id or get_post_type( $item_id ) != 'st_order' ) {
                    wp_safe_redirect( self::$booking_page );
                    die;
                }

                return TRUE;
            }

            function add_col_header( $defaults )
            {

                $this->array_splice_assoc( $defaults, 2, 0, [
                    'activity_type'   => __( "Activity Type", ST_TEXTDOMAIN ),
                    'price'           => __( 'Price', ST_TEXTDOMAIN ),
                    'activity_layout' => __( 'Layout', ST_TEXTDOMAIN ),
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
                if ( $column_name == 'activity_layout' ) {
                    // show content of 'directors_name' column
                    $parent = get_post_meta( $post_ID, 'st_custom_layout', TRUE );

                    if ( $parent ) {
                        echo "<a href='" . get_edit_post_link( $parent ) . "'>" . get_the_title( $parent ) . "</a>";
                    } else {
                        echo __( 'Default', ST_TEXTDOMAIN );
                    }
                }
                if ( $column_name == 'activity_type' ) {
                    $type = get_post_meta( $post_ID, 'type_activity', TRUE );
                    switch ( $type ) {
                        case 'daily_activity' :
                            echo __( "Daily Activity", ST_TEXTDOMAIN );
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
                    $discount    = get_post_meta( $post_ID, 'discount', TRUE );
                    $price_adult = get_post_meta( $post_ID, 'adult_price', TRUE );
                    $price_child = get_post_meta( $post_ID, 'child_price', TRUE );
                    if ( !empty( $discount ) ) {
                        $is_sale_schedule = get_post_meta( $post_ID, 'is_sale_schedule', TRUE );
                        $sale_adult       = $price_adult - $price_adult * ( $discount / 100 );
                        $sale_child       = $price_child - $price_child * ( $discount / 100 );
                        if ( $is_sale_schedule == "on" ) {
                            $sale_from = get_post_meta( $post_ID, 'sale_price_from', TRUE );
                            $sale_from = mysql2date( 'd/m/Y', $sale_from );
                            $sale_to   = get_post_meta( $post_ID, 'sale_price_to', TRUE );
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

        STAdminActivity::inst();
    }

