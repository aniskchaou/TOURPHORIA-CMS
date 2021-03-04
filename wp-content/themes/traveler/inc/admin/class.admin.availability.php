<?php
    /**
     * @since 1.1.9
     **/
    if ( !class_exists( 'STAvailability' ) ) {
        class STAvailability
        {
            public $table                   = 'st_availability';
            public $column                  = [];
            public $st_upgrade_availability = 0;
            public $allow_version           = false;

            public function __construct()
            {
                add_action( 'st_traveler_do_upgrade_table', [ &$this, '_action_check_upgrade_availability' ] );
                add_action( 'after_setup_theme', [ &$this, '_check_table_availability' ], 10 );
                add_action( 'after_setup_theme', [ &$this, '_check_upgrade_availability' ], 50 );

                add_action('init',array($this,'__run_fill_old_order'), 999);

                add_action('admin_enqueue_scripts',array($this,'_add_scripts'));
                add_action('wp_ajax_st_sync_availability_process',array($this,'_sync_availability_process'));
            }
            public function _sync_availability_process()
            {
                $list_disable_service = st()->get_option('list_disabled_feature');
            	$post_types=['st_rental', 'st_activity', 'st_tours', 'hotel_room'];

                if(!empty($list_disable_service)){
                    foreach ($list_disable_service as $key => $value) {
                        $key_post_type = array_search($value, $post_types);
                        if($key_post_type !== false){
                            unset($post_types[$key_post_type]);
                        }
                        if($value == 'st_hotel'){
                            $key_post_type_hotel_room = array_search('hotel_room', $post_types);
                            if($key_post_type_hotel_room !== false){
                                unset($post_types[$key_post_type_hotel_room]);   
                            }
                        }
                    }
                }

            	$rs=[];
	            $stop=0;

            if(!empty($post_types)){
                $post_types = array_values($post_types);
            	if(!empty($_POST['step']))
	            {
	            	switch ($_POST['step']) {
			            case 1:
							echo json_encode($post_types[0]);
							die;
			            	break;
			            case 2:
			            	global $wpdb;
				            $post_type = $_POST['post_type'];
				            $sql_total = $wpdb->prepare("SELECT COUNT(*) as total FROM {$wpdb->posts} WHERE post_type = %s LIMIT 1", $post_type);
				            $total = $wpdb->get_var($sql_total);
				            wp_send_json(array(
					            'total' => $total
				            ));
							break;
			            case 3:
				            $offset = ! empty( $_POST['offset'] ) ? $_POST['offset'] : 0;
				            $index = isset( $_POST['index'] ) ? $_POST['index'] : 0;
				            $total = $_POST['total'];

				            if($offset>=$total and ($index+1)>=count($post_types)){
				            	$current_insert_date = date("Y-m-d h:m:s");
				            	update_option('st_last_sync_availability', $current_insert_date, 'no');

					            wp_send_json(array(
						            'stop'=>1,
									'last_sync' => get_option('st_last_sync_availability')
					            ));
				            }

							if(($offset)>=$total){
								$this->__run_fill_availability($post_types[$index], $offset, 10);
								$index+=1;
								$offset=0;
								global $wpdb;
								if($post_types[$index] == 'st_tours' or $post_types[$index] == 'st_activity'){
									$meta_key = 'type_activity';
									$meta_value = 'daily_activity';
									if($post_types[$index] == 'st_tours'){
										$meta_key = 'type_tour';
										$meta_value = 'daily_tour';
									}
									$sql_total = $wpdb->prepare("SELECT p.* FROM {$wpdb->posts} as p INNER JOIN {$wpdb->postmeta} as mt ON p.ID = mt.post_id AND mt.meta_key=%s WHERE post_type = %s AND mt.meta_value=%s GROUP BY ID", $meta_key, $post_types[$index], $meta_value);
									$wpdb->get_results($sql_total);
									$total = $wpdb->num_rows;
								}else{
									$sql_total = $wpdb->prepare("SELECT COUNT(*) as total FROM {$wpdb->posts} WHERE post_type = %s LIMIT 1", $post_types[$index]);
									$total = $wpdb->get_var($sql_total);
								}
							}

				            $this->__run_fill_availability($post_types[$index], $offset, 10);

				            wp_send_json(array(
				            	'offset' => $offset,
					            'total' => $total,
					            'post_type' => $post_types[$index],
					            'index' => $index,
					            'stop'=>$stop
				            ));
			            	break;
		            }
	            }
            }

            	wp_send_json($rs);
            }
            public function _add_scripts()
            {
            	if(!empty($_GET['page']) and $_GET['page']=='st_sync_availability')
            	wp_enqueue_script('st-sync-availability',get_template_directory_uri().'/js/admin/sync-availability.js',array('jquery'),null,true);
            }
            public function __run_fill_availability($post_type, $offset, $limit)
            {
                    $begin = new DateTime(date('Y-m-d'));
	                $end = new DateTime(date('Y-m-d'));
	                $end->modify('+6 months');
	                $end->modify('+1 day');
	                // Loop next 6 months  - 180 days
	                $interval = DateInterval::createFromDateString('1 day');
	                $period = new DatePeriod($begin, $interval, $end);

	                foreach ($period as $dt) {
	                	switch ($post_type){
			                case 'hotel_room':
				                STAdminRoom::inst()->__cronjob_fill_availability($offset, $limit, $dt );
			                	break;
			                case 'st_rental':
				                STAdminRental::inst()->__cronjob_fill_availability($offset, $limit, $dt);
				                break;
			                case 'st_tours':
				                STAdminTours::inst()->__cronjob_fill_availability($offset, $limit, $dt);
				                break;
			                case 'st_activity':
				                STAdminActivity::inst()->__cronjob_fill_availability($offset, $limit, $dt);
				                break;
		                }
	                }
            }

            public function __run_fill_old_order()
            {
                $date='2018_04_21';
                $post_types=['st_hotel','hotel_room', 'st_rental','st_tours', 'st_activity'];
                foreach ($post_types as $k => $v){
                    $key='st_run_fill_old_order_once_'.$v.'_'.$date;
                    if(get_option($key)) return;
                    switch ($v){
                        case 'st_hotel':
                        case 'hotel_room':
                            if(class_exists('STAdminRoom')) {
                                STAdminRoom::inst()->__run_fill_old_order($date);
                                update_option($key, 1);
                            }
                            break;
	                    case 'st_tours':
	                        if(class_exists('STAdminTours')) {
                                STAdminTours::inst()->__run_fill_old_order($date);
                                update_option($key, 1);
                            }
	                    	break;
	                    case 'st_activity':
	                        if(class_exists('STAdminActivity')) {
                                STAdminActivity::inst()->__run_fill_old_order($date);
                                update_option($key, 1);
                            }
		                    break;
                    }

                }
            }

            public function _action_check_upgrade_availability()
            {
                $this->st_upgrade_availability = 1;
                $this->allow_version           = true;
                $this->_check_table_availability();
                $this->_check_upgrade_availability();
            }

            public function _check_table_availability()
            {
                $dbhelper = new DatabaseHelper( '1.2.9' );
                $dbhelper->setTableName( $this->table );
                $column       = [
                    'id'           => [
                        'type'           => 'bigint',
                        'length'         => 9,
                        'AUTO_INCREMENT' => TRUE
                    ],
                    'post_id'      => [
                        'type' => 'INT',
                        'UNIQUE'=>true
                    ],
                    'post_type'    => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'check_in'     => [
                        'type'   => 'INT',
                        'length' => 11,
                        'UNIQUE'=>true
                    ],
                    'check_out'    => [
                        'type'   => 'INT',
                        'length' => 11
                    ],
                    'starttime' => [
                        'type' => 'varchar',
                        'length' => 255
                    ],
                    'count_starttime' => [
	                    'type' => 'INT',
	                    'length' => 11,
	                    'default' => 1
                    ],
                    'number'       => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'price'        => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'adult_price'  => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'child_price'  => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'infant_price' => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'status'       => [
                        'type'   => 'varchar',
                        'length' => 255
                    ],
                    'groupday'     => [
                        'type' => 'INT'
                    ],
                    'priority'     => [
                        'type' => 'INT'
                    ],
                    'number_booked' => [
	                    'type' => 'INT',
	                    'length' => 11,
	                    'default' => 0
                    ],
                    'parent_id' => [
	                    'type' => 'bigint',
	                    'length' => 9
                    ],
                    'allow_full_day' => [
	                    'type' => 'varchar',
	                    'length' => 10
                    ],
                    'number_end' => [
	                    'type' => 'INT',
	                    'length' => 11
                    ],
                    'booking_period' => [
	                    'type' => 'INT',
	                    'length' => 11
                    ],
	                'is_base' => [
	                	'type' => 'INT',
		                'length' => 2
	                ],
                    'adult_number'=>[
                        'type' => 'INT',
                        'length' => 11
                    ],
                    'child_number'=>[
                        'type' => 'INT',
                        'length' => 11
                    ],
                ];
                $this->column = $column;
                $dbhelper->setDefaultColums( $column );
                $dbhelper->check_meta_table_is_working( 'availability_table_version' );
            }

            public function _check_upgrade_availability()
            {
                $complete = get_option( 'st_upgrade_availability' );
                if ( !$complete || $complete == 0 || $this->st_upgrade_availability == 1 || $this->allow_version ) {
                    $this->_upgradeData();
                }
            }

            public function isset_table()
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {
                    return false;
                }

                return true;
            }

            public function _deleteTable()
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                $wpdb->query( "DROP TABLE {$table}" );
            }

            public function _upgradeData()
            {
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                if ( $this->allow_version ) {
                    if ( $this->isset_table() ) {
                        $this->_deleteTable();
                        $this->_check_table_availability();
                    }
                }

                $this->_insertCustomPriceHotelRoom();
                $this->_insertCustomPriceTour();
                $this->_insertCustomPriceActivity();

            }

            public function _insertCustomPriceHotelRoom()
            {
                $complete = 1;
                global $wpdb;
                $table = $wpdb->prefix . $this->table;
                $sql   = "
			SELECT
				{$wpdb->prefix}st_price.*
			FROM
				{$wpdb->prefix}st_price
			INNER JOIN {$wpdb->prefix}posts AS mt ON mt.ID = {$wpdb->prefix}st_price.post_id
			AND mt.post_type = 'hotel_room'";

                $results = $wpdb->get_results( $sql );
                if ( is_array( $results ) && count( $results ) ) {
                    foreach ( $results as $key => $val ) {
                        $data   = [
                            'post_id'   => $val->post_id,
                            'post_type' => 'hotel_room',
                            'check_in'  => strtotime( $val->start_date ),
                            'check_out' => strtotime( $val->end_date ),
                            'number'    => 1,
                            'price'     => $val->price,
                            'status'    => 'available',
                            'groupday'  => '0',
                            'priority'  => $val->priority
                        ];
                        $insert = $wpdb->insert( $table, $data );
                        if ( is_wp_error( $insert ) ) {
                            $complete = 0;
                            break;
                        }
                    }
                }
                update_option( 'st_upgrade_availability', $complete );
            }

            public function _insertCustomPriceTour()
            {
                $complete = 1;
                if ( TravelHelper::isset_table( 'st_tours' ) ) {

                    global $wpdb;
                    $table = $wpdb->prefix . $this->table;
                    $sql   = " SELECT
					post_id,
					adult_price,
					child_price,
					infant_price,
					check_in,
					check_out, type_tour
				FROM
					{$wpdb->prefix}st_tours
				WHERE
					type_tour = 'specific_date'";

                    $results = $wpdb->get_results( $sql );
                    if ( is_array( $results ) && count( $results ) ) {
                        foreach ( $results as $key => $val ) {
                            if ( !empty( $val->check_in ) && !empty( $val->check_out ) ) {
                                $data = [
                                    'post_id'      => $val->post_id,
                                    'post_type'    => 'st_tours',
                                    'check_in'     => strtotime( $val->check_in ),
                                    'check_out'    => strtotime( $val->check_out ),
                                    'number'       => 1,
                                    'adult_price'  => floatval( $val->adult_price ),
                                    'child_price'  => floatval( $val->child_price ),
                                    'infant_price' => floatval( $val->infant_price ),
                                    'status'       => 'available',
                                    'groupday'     => '1',
                                    'priority'     => 0
                                ];

                                $insert = $wpdb->insert( $table, $data );
                                if ( is_wp_error( $insert ) ) {
                                    $complete = 0;
                                    break;
                                }
                            }

                        }
                    }
                } else {
                    $complete = 0;
                }
                update_option( 'st_upgrade_availability', $complete );
            }

            public function _insertCustomPriceActivity()
            {
                $complete = 1;
                if ( TravelHelper::isset_table( 'st_activity' ) ) {

                    global $wpdb;
                    $table = $wpdb->prefix . $this->table;
                    $sql   = "
				SELECT
					post_id,
					adult_price,
					child_price,
					infant_price,
					check_in,
					check_out, type_activity
				FROM
					{$wpdb->prefix}st_activity
				WHERE
					type_activity = 'specific_date'";

                    $results = $wpdb->get_results( $sql );
                    if ( is_array( $results ) && count( $results ) ) {
                        foreach ( $results as $key => $val ) {
                            if ( !empty( $val->check_in ) && !empty( $val->check_out ) ) {
                                $data = [
                                    'post_id'      => $val->post_id,
                                    'post_type'    => 'st_activity',
                                    'check_in'     => strtotime( $val->check_in ),
                                    'check_out'    => strtotime( $val->check_out ),
                                    'number'       => 1,
                                    'adult_price'  => floatval( $val->adult_price ),
                                    'child_price'  => floatval( $val->child_price ),
                                    'infant_price' => floatval( $val->infant_price ),
                                    'status'       => 'available',
                                    'groupday'     => '1',
                                    'priority'     => 0
                                ];

                                $insert = $wpdb->insert( $table, $data );
                                if ( is_wp_error( $insert ) ) {
                                    $complete = 0;
                                    break;
                                }
                            }

                        }
                    }
                } else {
                    $complete = 0;
                }
                update_option( 'st_upgrade_availability', $complete );
            }
        }

        $st_avaibility = new STAvailability();
    }
?>