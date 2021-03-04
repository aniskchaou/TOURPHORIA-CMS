<?php
    /**
     * @since 1.1.8
     **/
    if ( !class_exists( 'STDuplicateData' ) ) {
        class STDuplicateData extends STAdmin
        {
            static $column_hotel;
            static $column_hotel_room;
            static $column_rental;
            static $column_activity;
            static $column_tour;
            static $column_car;
            static $_inst;

            public function __construct()
            {

                add_action( 'admin_menu', [ $this, '_register_duplicate_submenu_page' ], 50 );

	            add_action( 'admin_menu', [ $this, '_register_sysdata_submenu_page' ], 50 );

                add_action( 'admin_enqueue_scripts', [ $this, '_add_scripts' ] );

                add_action( 'wp_ajax_st_duplicate_ajax', [ $this, '_duplicate_ajax' ] );

                add_action( 'after_setup_theme', [ $this, '_create_table' ] );
            }

            public function _create_table()
            {
                $this->stCreateTable();
            }

            public function isset_table( $table_name = '' )
            {
                global $wpdb;
                $table = $wpdb->prefix . $table_name;
                if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table}'" ) != $table ) {
                    return false;
                }

                return true;
            }

            public function _add_scripts()
            {
                wp_register_script( 'st-duplicate', get_template_directory_uri() . '/js/st-duplicate.js', [ 'jquery' ], '1.1.8', true );
                $ajax_nonce = wp_create_nonce( "st_duplicate_string" );
                wp_localize_script( 'jquery', 'st_duplicate_string', [
                    'string' => $ajax_nonce
                ] );
            }

            public function _register_duplicate_submenu_page()
            {
                add_submenu_page( 'st_traveler_option', __( 'Upgrade Data', ST_TEXTDOMAIN ), __( 'Upgrade Data', ST_TEXTDOMAIN ), 'manage_options', 'st-upgrade-data', [ $this, '_st_duplicate_data_content' ] );
            }

	        public function _register_sysdata_submenu_page()
	        {
		        add_submenu_page( 'st_traveler_option', __( 'Sync Availability', ST_TEXTDOMAIN ), __( 'Sync Availability', ST_TEXTDOMAIN ), 'manage_options', 'st_sync_availability', [ $this, '_show_sync_page' ] );
	        }

	        public function _show_sync_page()
	        {
		        ?>
                <div class="" style="margin: 5px 15px 2px;">
		        <h2><?php echo __('Sync Availability', ST_TEXTDOMAIN); ?></h2>
		        <div class="st_sync_log"></div><br />
		        <button class="button button-primary st_btn_start_sync" data-text="<?php echo __('Sync Now', ST_TEXTDOMAIN); ?>" data-text-in="<?php echo __('Sync...', ST_TEXTDOMAIN); ?>"><?php echo __('Sync Now', ST_TEXTDOMAIN); ?></button><div class="st-sync-availability-note">
                        <?php
                        $last_sync_time = get_option('st_last_sync_availability');
                        if(!empty($last_sync_time)){
	                        echo __('Last Sync: ', ST_TEXTDOMAIN) . $last_sync_time;
                        }
                        ?>
                    </div>
                </div>
		        <?php
	        }

            public function _st_duplicate_data_content()
            {
                wp_enqueue_script( 'st-duplicate' );
                echo balanceTags( $this->load_view( 'duplicate_data/index', false ) );
            }

            public function _duplicate_ajax( $oneclick = false )
            {
                if ( ( isset( $_POST[ 'name' ] ) && $_POST[ 'name' ] == 'st_allow_duplicate' ) || $oneclick ) {

                    if ( $this->stDeleteTable() ) {

                        $this->stCreateTable();

                        if ( $this->stDuplicateData() ) {
                            update_option( 'st_duplicated_data', 'duplicated' );

                            do_action( 'st_traveler_do_upgrade_table' );

                            $result = [
                                'status' => 1,
                                'msg'    => 'Finished successfully!'
                            ];
                            echo json_encode( $result );

                        } else {
                            $result = [
                                'status' => 0,
                                'msg'    => 'An error has occurred during process (update new data). Please try again!'
                            ];
                            echo json_encode( $result );
                        }
                    } else {
                        $result = [
                            'status' => 0,
                            'msg'    => 'An error has occurred during process (delete draft data). Please try again!'
                        ];
                        echo json_encode( $result );
                    }
                }
                if ( !$oneclick ) {
                    die();
                }
            }

            public function stDeleteTable()
            {
                $post_types = [ 'st_hotel', 'hotel_room', 'st_rental', 'st_cars', 'st_tours', 'st_activity' ];
                foreach ( $post_types as $post_type ) {
                    $result = self::__stDeleteTable( $post_type );
                }
            }

            public function __stDeleteTable( $post_type )
            {
                global $wpdb;
                $table  = $wpdb->prefix . $post_type;
                $sql    = "DROP TABLE IF EXISTS {$table}";
                $result = $wpdb->query( $sql );

                return $result;
            }

            public function stCreateTable()
            {
                if(class_exists('STAdminHotel'))
                self::$column_hotel      = STAdminHotel::_check_table_hotel();

                if(class_exists('STAdminRental'))
                self::$column_rental     = STAdminRental::_check_table_rental();

                if(class_exists('STAdminCars'))
                self::$column_car        = STAdminCars::_check_table_car();

                if(class_exists('STAdminTours'))
                self::$column_tour       = STAdminTours::_check_table_tour();

                if(class_exists('STAdminActivity'))
                self::$column_activity   = STAdminActivity::_check_table_activity();

                if(class_exists('STAdminRoom'))
                self::$column_hotel_room = STAdminRoom::_check_table_hotel_room();

            }


            public function stDuplicateData()
            {
                $post_type = [
                    'st_hotel', 'hotel_room', 'st_rental', 'st_cars', 'st_tours', 'st_activity'
                ];
                $result    = true;
                foreach ( $post_type as $item ) {
                    $result = $this->_stDuplicateData( $item );
                    if ( $result == false ) return $result;
                }

                return $result;
            }

            public function get_meta_string( $column )
            {

                $meta = ' 1 = 1 ';

                if ( !empty( $column ) ) {
                    foreach ( $column as $key => $val ) {
                        if ( $key == 0 ) {
                            $meta .= " AND meta_key = '{$val}' ";
                        } else {
                            $meta .= " or meta_key = '{$val}' ";
                        }
                    }
                }

                return $meta;
            }

            /**
             * @updated 1.2.4
             **/
            public function _stDuplicateData( $post_type = 'st_hotel' )
            {
                global $wpdb;
                $sql_count = "
	          SELECT ID FROM {$wpdb->prefix}posts WHERE post_type='{$post_type}' GROUP BY ID
	        ";
                if ( $post_type == 'st_hotel' ) {
                    $sql = "SELECT
					ID
				FROM
					{$wpdb->prefix}posts
				WHERE
					post_type = 'st_hotel'";

                    $results = $wpdb->get_col( $sql, 0 );
                    if ( !empty( $results ) ) {
                        foreach ( $results as $hotel ) {
                            $sql = "UPDATE {$wpdb->prefix}postmeta
						SET {$wpdb->prefix}postmeta.meta_value = (
							SELECT
								price
							FROM
								(
									SELECT
										AVG(
											CAST(mt.meta_value AS UNSIGNED)
										) AS price
									FROM
										{$wpdb->prefix}posts AS post
									INNER JOIN {$wpdb->prefix}postmeta AS mt ON mt.post_id = post.ID
									AND mt.meta_key = 'price'
									INNER JOIN {$wpdb->prefix}postmeta AS mt1 ON mt1.post_id = post.ID
									AND mt1.meta_key = 'room_parent'
									WHERE
										mt1.meta_value = {$hotel}
								) AS price
						)
						WHERE
							{$wpdb->prefix}postmeta.meta_key = 'price_avg'
						AND {$wpdb->prefix}postmeta.post_id = {$hotel}";

                            $wpdb->query( $sql );

                            $sql = "UPDATE {$wpdb->prefix}postmeta
						SET {$wpdb->prefix}postmeta.meta_value = (
							SELECT
								price
							FROM
								(
									SELECT
										min(
											CASE
											WHEN mt2.meta_value != ''
											AND mt2.meta_value != 0 THEN
												CAST(mt.meta_value AS UNSIGNED) - (
													CAST(mt.meta_value AS UNSIGNED) * CAST(mt2.meta_value AS UNSIGNED) / 100
												)
											ELSE
												CAST(mt.meta_value AS UNSIGNED)
											END
										) AS price
									FROM
										{$wpdb->prefix}posts AS post
									INNER JOIN {$wpdb->prefix}postmeta AS mt ON mt.post_id = post.ID
									AND mt.meta_key = 'price'
									INNER JOIN {$wpdb->prefix}postmeta AS mt1 ON mt1.post_id = post.ID
									AND mt1.meta_key = 'room_parent'
									LEFT JOIN {$wpdb->prefix}postmeta AS mt2 ON mt2.post_id = post.ID
									AND mt2.meta_key = 'discount_rate'
									WHERE
										mt1.meta_value = 991
									AND post_type = 'hotel_room'
								) AS price
						)
						WHERE
							{$wpdb->prefix}postmeta.meta_key = 'min_price'
						AND {$wpdb->prefix}postmeta.post_id = {$hotel}";
                            $wpdb->query( $sql );
                        }
                        unset( $sql );
                    }
                    $meta = $this->get_meta_string( $this->column_hotel );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}postmeta, {$wpdb->prefix}posts
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='{$post_type}'
	                    and {$wpdb->prefix}posts.post_status='publish'
	                    and (
	                    {$meta}
	                    )
	            ";

                    $fields = $this->column_hotel;

                } elseif ( $post_type == 'st_rental' ) {

                    $meta = $this->get_meta_string( $this->column_rental );

                    $sql    = "
	            SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}postmeta, {$wpdb->prefix}posts
	                WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='{$post_type}'
	                    and {$wpdb->prefix}posts.post_status='publish'
	                    and (
	                    {$meta}
	                    )
	            ";
                    $fields = $this->column_rental;

                } elseif ( $post_type == 'st_cars' ) {
                    $meta   = $this->get_meta_string( $this->column_car );
                    $sql    = "
	            SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}postmeta, {$wpdb->prefix}posts
	                WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='{$post_type}'
	                    and {$wpdb->prefix}posts.post_status='publish'
	                    and (
	                    {$meta}
	                    )
	            ";
                    $fields = $this->column_car;
                } elseif ( $post_type == 'st_tours' ) {
                    $meta   = $this->get_meta_string( $this->column_tour );
                    $sql    = "
	            SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}postmeta, {$wpdb->prefix}posts
	                WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='{$post_type}'
	                    and {$wpdb->prefix}posts.post_status='publish'
	                    and (
	                    {$meta}
	                    )
	            ";
                    $fields = $this->column_tour;
                } elseif ( $post_type == 'st_activity' ) {
                    $meta   = $this->get_meta_string( $this->column_activity );
                    $sql    = "
	            SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}postmeta, {$wpdb->prefix}posts
	                WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='{$post_type}'
	                    and {$wpdb->prefix}posts.post_status='publish'
	                    and (
	                    {$meta}
	                    )
	            ";
                    $fields = $this->column_activity;
                }

                $number = 1000;
                $id     = $wpdb->get_col( $sql_count );
                $count  = count( $id );
                if ( $count > 0 ) {
                    $i = 0;
                    while ( $i <= $count ) {
                        $now = ( $i + $number );
                        if ( $now >= $count ) $now = $count;
                        $in = "";
                        for ( $j = $i; $j < $now; $j++ ) {
                            if ( empty( $in ) ) {
                                $in .= "'" . $id[ $j ] . "'";
                            } else {
                                $in .= ",'" . $id[ $j ] . "'";
                            }
                        }
                        $limit      = " AND ID IN ({$in})  ORDER BY ID";
                        $q          = $sql . $limit;
                        $result     = $wpdb->get_results( $q );
                        $list_value = [];
                        if ( is_array( $result ) && count( $result ) ) {
                            foreach ( $result as $val ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                        }
                        $this->_stSaveData( $post_type, $fields, $list_value );

                        $i += $number;
                    }
                }

                return true;

            }

            public function runUpdate( $post_type = 'hotel_room' )
            {

                global $wpdb;
                $posts_per_page = 10;
                if ( $post_type == 'hotel_room' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'hotel_room' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => 'st_hotel',
                            'step'      => 'update_table_post_type',
                            'page'      => ''
                        ];

                        return $returns;
                    }
                    $meta = self::get_meta_string( self::$column_hotel_room );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='hotel_room'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";

                    $fields = self::$column_hotel_room;
                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $key => $val ) {
                            if ( $val->meta_key == 'room_parent' and $val->meta_value != 0 ) {
                                $mutilocation = get_post_meta( $val->meta_value, 'multi_location', true );
                                update_post_meta( $val->post_id, 'multi_location', $mutilocation );
                                $list_value[ $val->post_id ][ 'multi_location' ] = $mutilocation;
                            }
                            $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                        }
                    }

                    $this->_stSaveData( 'hotel_room', $fields, $list_value );
                    $returns = [
                        'post_type' => 'st_hotel',
                        'step'      => 'update_table_post_type',
                        'page'      => ''
                    ];

                    return $returns;
                }
                if ( $post_type == 'st_hotel' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'st_hotel' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => 'st_rental',
                            'step'      => 'update_table_post_type',
                            'page'      => ''
                        ];

                        return $returns;
                    }

                    $sql = "UPDATE {$wpdb->prefix}postmeta
				SET {$wpdb->prefix}postmeta.meta_value = (
					SELECT
						avg(CAST(price AS UNSIGNED))
					FROM
						{$wpdb->prefix}hotel_room
					WHERE
						room_parent = {$wpdb->prefix}postmeta.post_id
				)
				WHERE
					{$wpdb->prefix}postmeta.meta_key = 'price_avg'";

                    $wpdb->query( $sql );
                    unset( $sql );

                    $meta = self::get_meta_string( self::$column_hotel );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID 
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='st_hotel'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";


                    $fields = self::$column_hotel;

                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $val ) {
                            $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                        }
                    }

                    $this->_stSaveData( 'st_hotel', $fields, $list_value );

                    $returns = [
                        'post_type' => 'st_rental',
                        'step'      => 'update_table_post_type',
                        'page'      => ''
                    ];

                    return $returns;
                }

                if ( $post_type == 'st_rental' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'st_rental' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => 'st_cars',
                            'step'      => 'update_table_post_type',
                            'page'      => ''
                        ];

                        return $returns;
                    }

                    $meta = self::get_meta_string( self::$column_rental );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID 
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='st_rental'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";


                    $fields = self::$column_rental;

                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $val ) {
                            $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                        }
                    }

                    $this->_stSaveData( 'st_rental', $fields, $list_value );

                    $returns = [
                        'post_type' => 'st_cars',
                        'step'      => 'update_table_post_type',
                        'page'      => ''
                    ];

                    return $returns;
                }
                if ( $post_type == 'st_cars' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'st_cars' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => 'st_tours',
                            'step'      => 'update_table_post_type',
                            'page'      => ''
                        ];

                        return $returns;
                    }
                    $meta = self::get_meta_string( self::$column_car );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID 
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='st_cars'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";

                    $fields = self::$column_car;

                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $val ) {
                            $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                        }
                    }

                    $this->_stSaveData( 'st_cars', $fields, $list_value );

                    $returns = [
                        'post_type' => 'st_tours',
                        'step'      => 'update_table_post_type',
                        'page'      => ''
                    ];

                    return $returns;
                }
                if ( $post_type == 'st_tours' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'st_tours' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => 'st_activity',
                            'step'      => 'update_table_post_type',
                            'page'      => ''
                        ];

                        return $returns;
                    }
                    $meta = self::get_meta_string( self::$column_tour );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID 
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='st_tours'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";

                    $fields = self::$column_tour;

                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $val ) {

                            if ( $val->meta_key == "adult_price" and get_post_meta( $val->post_id, 'hide_adult_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                            if ( $val->meta_key == "child_price" and get_post_meta( $val->post_id, 'hide_children_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                            if ( $val->meta_key == "infant_price" and get_post_meta( $val->post_id, 'hide_children_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }

                            if ( $val->meta_key != "adult_price" and $val->meta_key != "child_price" and $val->meta_key != "infant_price" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }

                        }
                    }
                    $this->_stSaveData( 'st_tours', $fields, $list_value );

                    $returns = [
                        'post_type' => 'st_activity',
                        'step'      => 'update_table_post_type',
                        'page'      => ''
                    ];

                    return $returns;
                }
                if ( $post_type == 'st_activity' ) {
                    $sql   = "SELECT count(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'st_activity' AND post_status IN ('publish', 'private')";
                    $total = (int) $wpdb->get_var( $sql );

                    if ( $total == 0 ) {
                        $returns = [
                            'post_type' => '',
                            'step'      => 'update_location_nested',
                            'page'      => ''
                        ];

                        return $returns;
                    }
                    $meta = self::get_meta_string( self::$column_activity );

                    $sql = "
	                SELECT {$wpdb->prefix}postmeta.post_id, {$wpdb->prefix}postmeta.meta_key, {$wpdb->prefix}postmeta.meta_value from {$wpdb->prefix}posts left join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID 
	                    WHERE {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID
	                    and {$wpdb->prefix}posts.post_type='st_activity'
	                    and {$wpdb->prefix}posts.post_status in ('publish', 'private')
	                    and (
	                    {$meta}
	                    )
	            ";

                    $fields = self::$column_activity;

                    $result = $wpdb->get_results( $sql );

                    $list_value = [];

                    if ( is_array( $result ) && count( $result ) ) {
                        foreach ( $result as $val ) {
                            if ( $val->meta_key == "adult_price" and get_post_meta( $val->post_id, 'hide_adult_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                            if ( $val->meta_key == "child_price" and get_post_meta( $val->post_id, 'hide_children_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                            if ( $val->meta_key == "infant_price" and get_post_meta( $val->post_id, 'hide_children_in_booking_form', true ) != "on" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }

                            if ( $val->meta_key != "adult_price" and $val->meta_key != "child_price" and $val->meta_key != "infant_price" ) {
                                $list_value[ $val->post_id ][ $val->meta_key ] = $val->meta_value;
                            }
                        }
                    }

                    $this->_stSaveData( 'st_activity', $fields, $list_value );

                    $returns = [
                        'post_type' => '',
                        'step'      => 'update_location_nested',
                        'page'      => '',
                        'reset_table' => 'reset'
                    ];

                    update_option( 'st_duplicated_data', 'completed' );

                    return $returns;
                }
            }

            public function get_progress( $total )
            {
                global $wpdb;

                $sql = "SELECT count(post_id) FROM (
				SELECT post_id FROM {$wpdb->prefix}st_hotel
				UNION 
				SELECT post_id FROM {$wpdb->prefix}st_rental
				UNION 
				SELECT post_id FROM {$wpdb->prefix}st_cars
				UNION 
				SELECT post_id FROM {$wpdb->prefix}st_activity
				UNION 
				SELECT post_id FROM {$wpdb->prefix}st_tours
			) as post_id
			";

                return (int) $wpdb->get_var( $sql ) / $total * 100;
            }

            public function _stSaveData( $post_type = '', $fields = [], $data = [] )
            {

                global $wpdb;
                $table = $wpdb->prefix . $post_type;

                $field  = implode( ',', $fields );
                $field  = '(' . $field . ')';
                $values = [];
                foreach ( $data as $key => $value ) {
                    $values[] = self::_stGetStringInsert( $fields, $key, $value );
                }
                if ( is_array( $values ) && count( $values ) ) {
                    $sql = "INSERT INTO {$table} {$field} VALUES " . implode( ',', $values ) . "";
                    $wpdb->query( $sql );
                }
            }

            static function _stGetStringInsert( $fields, $key, $data )
            {
                $string      = [];
                $string[ 0 ] = "'" . $key . "'";
                for ( $i = 1; $i < count( $fields ); $i++ ) {
                    $v            = esc_sql( self::_getKeyArray( $fields[ $i ], $data ) );
                    $string[ $i ] = "'" . $v . "'";
                }
                $return = '(' . implode( ',', $string ) . ')';

                return $return;
            }

            static function _getKeyArray( $key, $data )
            {
                if ( array_key_exists( $key, $data ) ) {
                    return $data[ $key ];
                } else {
                    return "";
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
    }
    STDuplicateData::inst();
