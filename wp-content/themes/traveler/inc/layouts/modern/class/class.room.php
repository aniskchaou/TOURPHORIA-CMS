<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STRoom
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STRoom' ) ) {
        class STRoom extends TravelerObject
        {

            static    $_inst;
            protected $orderby;
            protected $post_type       = 'hotel_room';
            protected $template_folder = 'hotel-room';

            function __construct( $hotel_id = FALSE )
            {
                $this->orderby = [
                    'new'         => [
                        'key'  => 'New',
                        'name' => __( 'Date', ST_TEXTDOMAIN )
                    ],
                    'price_asc'  => [
                        'key'  => 'price_asc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ).' (<i class="fa fa-long-arrow-down"></i>)'
                    ],
                    'price_desc' => [
                        'key'  => 'price_desc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ).' (<i class="fa fa-long-arrow-up"></i>)'
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

            }

            function init()
            {
                if ( !st_check_service_available( 'hotel_room' ) ) return;

                parent::init();

                //add_filter('st_data_custom_price',array($this,'_st_data_custom_price'));

                //custom search hotel template
                add_filter( 'template_include', [ $this, 'choose_search_template' ] );

                add_filter( 'st_search_preload_page', [ $this, '_change_preload_search_title' ] );


                // Woocommerce cart item information
                add_action( 'st_wc_cart_item_information_hotel_room', [ $this, '_show_wc_cart_item_information' ] );

                add_action( 'st_before_cart_item_hotel_room', [ $this, '_show_wc_cart_post_type_icon' ] );

                //xsearch Load post hotel room filter ajax
                add_action('wp_ajax_st_filter_hotel_room_ajax', [$this, 'st_filter_hotel_room_ajax']);
                add_action('wp_ajax_nopriv_st_filter_hotel_room_ajax', [$this, 'st_filter_hotel_room_ajax']);
            }

            public function st_filter_hotel_room_ajax(){
	            $taxonomy = STInput::get('taxonomy');
                $page_number = STInput::get('page');
                $style = STInput::get('layout');
                $orderby = STInput::get('orderby');
                $jcategory = STInput::get('jcategory');

                global $wp_query , $st_search_query;

                $room = STRoom::inst();
                $room->alter_search_query();

                set_query_var('paged', $page_number);

                if(get_query_var( 'paged' )) {
                    $paged = get_query_var( 'paged' );
                } else if(get_query_var( 'page' )) {
                    $paged = get_query_var( 'page' );
                } else {
                    $paged = 1;
                }

                $paged = $page_number;

                $args = array
                (
                    'post_type' => 'hotel_room',
                    's' => '',
                    'post_status' => array('publish'),
                    'paged' => $paged
                );

	            if(!empty($taxonomy)){
		            foreach ($taxonomy as $k => $v){
		                if(trim($v) != '') {
                            $tax_qry[] = [
                                'taxonomy' => $k,
                                'field' => 'term_id',
                                'terms' => explode(',', rtrim($v, ',')),
                            ];
                        }
		            }
		            if ($tax_qry) :
			            $args['tax_query'] = $tax_qry;
		            endif;
	            }

                query_posts($args);

                $st_search_query = $wp_query;
                if($orderby == 'featured') {
                    $st_search_query->set('meta_key', 'is_featured');
                    $st_search_query->set('orderby', 'meta_value');
                    $st_search_query->set('order', 'DESC');
                }
                $room->remove_alter_search_query();
                global $wp_query;
                $current_page = get_query_var('paged' );
                $total_posts =  $wp_query->found_posts;
                if( $total_posts == 0 && $current_page >= 2){
                    global $wp_rewrite;
                    $link = add_query_arg();
                    if ($wp_rewrite->using_permalinks()){
                        $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
                    }else{
                        $link = add_query_arg('paged', 1);
                    }
                    wp_redirect( $link );
                }

                global $wp_query, $st_search_query;

                if ($st_search_query) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                ob_start();
                if (!isset($style)) $style = '1';
                if ($style == '1') {
                    if ($query->have_posts()) {
                        echo '<ul class="booking-list loop-hotel style_list">';
                        while ($query->have_posts()) {
                            $query->the_post();
                            echo st()->load_template('hotel-room/loop','list',array('taxonomy' => $jcategory));
                        }
                        echo "</ul>";
                    }
                } else {
                    ?>
                    <div class="row row-wrap loop_hotel loop_grid_hotel style_box">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            echo st()->load_template('hotel-room/loop','grid',array('taxonomy' => $jcategory));
                        }
                        ?>
                    </div>
                    <?php
                }

                if($query->found_posts == 0){
                    echo '<h3 class="ajax-filter-not-found">'. __('No room found', ST_TEXTDOMAIN) .'</h3>';
                }

                $ajax_filter_content = ob_get_contents();
                ob_clean();
                ob_end_flush();

                //Pagination
                ob_start();
                ?>
                <p>
                    <small>
                        <?php
                        set_query_var('paged', $page_number);
                        if( is_rtl() || st()->get_option('right_to_left') == 'on'):
                            ?>
                            <?php
                            if(!empty($st_search_query)){
                                $wp_query = $st_search_query;
                            }
                            if($wp_query->found_posts):
                                esc_html_e('Showing','traveler');
                                $page=get_query_var('paged');
                                $posts_per_page=get_query_var('posts_per_page');
                                if(!$page) $page=1;

                                $last=$posts_per_page*($page);


                                if($last>$wp_query->found_posts) $last=$wp_query->found_posts;
                                echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                            endif;
                            ?>
                            .&nbsp;&nbsp;<?php echo balanceTags($room->get_result_string())?>

                        <?php else: ?>
                            <?php echo balanceTags($room->get_result_string())?>. &nbsp;&nbsp;
                            <?php
                            if(!empty($st_search_query)){
                                $wp_query = $st_search_query;
                            }
                            if($wp_query->found_posts):
                                esc_html_e('Showing','traveler');
                                $page=get_query_var('paged');
                                $posts_per_page=get_query_var('posts_per_page');
                                if(!$page) $page=1;

                                $last=$posts_per_page*($page);


                                if($last>$wp_query->found_posts) $last=$wp_query->found_posts;
                                echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                            endif;
                            ?>
                        <?php endif; ?>
                    </small>
                </p>
                <div class="row">
                    <?php
                    TravelHelper::paging(); ?>
                </div>
                <?php
                $ajax_filter_pag = ob_get_contents();
                ob_clean();
                ob_end_flush();

                $count = balanceTags($room->get_result_string());
                $result = array(
                    'content' => $ajax_filter_content,
                    'pag' => $ajax_filter_pag,
                    'count' => $count,
                    'page' => $page_number
                );

                echo json_encode($result);
                die;
            }

            /**
             *
             * Show cart item information for hotel booking
             *
             * @since 1.2.6
             * */

            function _show_wc_cart_item_information( $st_booking_data = [] )
            {
                echo st()->load_template( 'hotel-room/wc_cart_item_information', FALSE, [ 'st_booking_data' => $st_booking_data ] );
            }

            /**
             *
             *
             * @since 1.2.6
             * */
            function _show_wc_cart_post_type_icon()
            {
                echo '<span class="booking-item-wishlist-title"><i class="fa fa-building-o"></i> ' . __( 'room', ST_TEXTDOMAIN ) . ' <span></span></span>';
            }

            function alter_search_query()
            {
                add_action( 'pre_get_posts', [ $this, 'change_search_hotel_arg' ] );
                add_filter( 'posts_where', [ $this, '_get_where_query' ] );
                add_filter( 'posts_join', [ $this, '_get_join_query' ] );
                add_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
                add_filter( 'posts_fields', [ $this, '_get_select_query' ] );
                add_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
            }

            function remove_alter_search_query()
            {
                remove_action( 'pre_get_posts', [ $this, 'change_search_hotel_arg' ] );
                remove_filter( 'posts_where', [ $this, '_get_where_query' ] );
                remove_filter( 'posts_join', [ $this, '_get_join_query' ] );
                remove_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
                remove_filter( 'posts_fields', [ $this, '_get_select_query' ] );
                remove_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
            }

            /**
             *
             *
             * @since 1.2.4
             */
            function _get_query_clauses( $clauses )
            {
                if ( STAdminCars::check_ver_working() == false ) return $clauses;
                $post_type = get_query_var( 'post_type' );
                if ( $post_type == 'hotel_room' ) {
                    global $wpdb;
                    if ( isset( $_REQUEST[ 'price_range' ] ) ) {
                        if ( empty( $clauses[ 'groupby' ] ) ) {
                            $clauses[ 'groupby' ] = $wpdb->posts . ".ID";
                        }
                        $price    = STInput::get( 'price_range', '0;0' );
                        $priceobj = explode( ';', $price );

                        $priceobj[ 0 ] = TravelHelper::convert_money_to_default( $priceobj[ 0 ] );
                        $priceobj[ 1 ] = TravelHelper::convert_money_to_default( $priceobj[ 1 ] );

                        $min_range = $priceobj[ 0 ];
                        $max_range = $priceobj[ 1 ];
                        $clauses[ 'groupby' ] .= " HAVING CAST(st_hotel_room_price AS DECIMAL) >= {$min_range} AND CAST(st_hotel_room_price AS DECIMAL) <= {$max_range}";
                    }
                }

                return $clauses;
            }

            /**
             *
             *
             * @since 1.2.6
             */
            function _get_join_query( $join )
            {
                if ( !TravelHelper::checkTableDuplicate( 'hotel_room' ) ) return $join;
                global $wpdb;

                $table = $wpdb->prefix . 'hotel_room';

                $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";

                return $join;
            }

            /**
             *
             *
             * @since 1.2.6
             */
            function _get_select_query( $query )
            {
                if ( STAdminCars::check_ver_working() == false ) return $query;
                $post_type = get_query_var( 'post_type' );
                if ( $post_type == 'hotel_room' ) {
                    $query .= ",CASE
                                WHEN tb.discount_rate != 0 AND tb.discount_rate != ''
                                THEN
                                                    CAST(tb.price AS DECIMAL) - ( CAST(tb.price AS DECIMAL) / 100 ) * CAST(tb.discount_rate AS DECIMAL)

                                ELSE tb.price

                           END AS st_hotel_room_price";
                }

                return $query;
            }

            function _get_where_query( $where )
            {
                if ( !TravelHelper::checkTableDuplicate( 'hotel_room' ) ) return $where;

                global $wpdb, $st_search_args;
                if ( !$st_search_args ) $st_search_args = $_REQUEST;
                /**
                 * Merge data with element args with search args
                 * @since  1.2.6
                 * @since  1.2.6
                 * @author quandq
                 */

                if ( !empty( $st_search_args[ 'st_location' ] ) ) {
                    if ( empty( $st_search_args[ 'only_featured_location' ] ) or $st_search_args[ 'only_featured_location' ] == 'no' )
                        $st_search_args[ 'location_id' ] = $st_search_args[ 'st_location' ];
                }

                if ( isset( $st_search_args[ 'location_id' ] ) && !empty( $st_search_args[ 'location_id' ] ) ) {
                    $location_id = $st_search_args[ 'location_id' ];

                    $where = TravelHelper::_st_get_where_location( $location_id, [ 'hotel_room' ], $where );
                } elseif ( isset( $_REQUEST[ 'location_name' ] ) && !empty( $_REQUEST[ 'location_name' ] ) ) {
                    $location_name = STInput::request( 'location_name', '' );

                    $ids_location = TravelerObject::_get_location_by_name( $location_name );

                    if ( !empty( $ids_location ) && is_array( $ids_location ) ) {
                        $where .= TravelHelper::_st_get_where_location( $ids_location, [ 'hotel_room' ], $where );
                    } else {
                        $where .= " AND (tb.address LIKE '%{$location_name}%'";
                        $where .= " OR {$wpdb->prefix}posts.post_title LIKE '%{$location_name}%')";
                    }
                }

                if ( isset( $_REQUEST[ 'item_name' ] ) && !empty( $_REQUEST[ 'item_name' ] ) ) {
                    $item_name = STInput::request( 'item_name', '' );
                    $where .= " AND {$wpdb->prefix}posts.post_title LIKE '%{$item_name}%'";
                }

                if ( isset( $_REQUEST[ 'item_id' ] ) and !empty( $_REQUEST[ 'item_id' ] ) ) {
                    $item_id = STInput::request( 'item_id', '' );
                    $where .= " AND ({$wpdb->prefix}posts.ID = '{$item_id}')";
                }


                if ( isset( $_GET[ 'start' ] ) && !empty( $_GET[ 'start' ] ) && isset( $_GET[ 'end' ] ) && !empty( $_GET[ 'end' ] ) ) {
                    $check_in  = date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $_GET[ 'start' ] ) ) );
                    $check_out = date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $_GET[ 'end' ] ) ) );

                    $today = date( 'm/d/Y' );

                    $period = STDate::dateDiff( $today, $check_in );

                    $adult_number = STInput::get( 'adult_number', 0 );
                    if ( intval( $adult_number ) < 0 ) $adult_number = 0;

                    $children_number = STInput::get( 'children_num', 0 );
                    if ( intval( $children_number ) < 0 ) $children_number = 0;

                    $number_room = STInput::get( 'room_num_search', 0 );
                    if ( intval( $number_room ) < 0 ) $number_room = 0;

                    $list_hotel = $this->get_unavailability_room( $check_in, $check_out, $adult_number, $children_number, $number_room );


                    if ( !is_array( $list_hotel ) || count( $list_hotel ) <= 0 ) {
                        $list_hotel = "''";
                    } else {
                        $list_hotel = implode( ',', $list_hotel );
                        $where .= " AND {$wpdb->prefix}posts.ID NOT IN ({$list_hotel}) ";
                    }

                    //$where .= " AND CAST(tb.hotel_booking_period AS UNSIGNED) <= {$period}";

                }
                if ( isset( $_GET[ 'room_num_search' ] ) ) {

                    //$where.=" AND {$wpdb->prefix}posts.ID NOT IN ({$list_hotel}) ";

                }

                return $where;
            }

            /**
             * @since 1.2.0
             */
            function get_unavailability_room( $check_in, $check_out, $adult_number, $children_number, $number_room = 1 )
            {
                global $wpdb;
                $check_in  = strtotime( $check_in );
                $check_out = strtotime( $check_out );

                $having             = FALSE;
                $having_number_room = false;

                if ( $adult_number ) {
                    $having .= "adult_number>={$adult_number}";
                }
                if ( $children_number ) {
                    $having .= " AND children_number>={$children_number}";
                }


                if ( $number_room ) {
                    $having_number_room .= "{$wpdb->prefix}postmeta.meta_value - total_booked < {$number_room}";
                }

                if ( $having ) {
                    $having = 'Having ' . $having;
                }
                if ( $having_number_room ) {
                    $having_number_room = 'Having ' . $having_number_room;
                }
                $query = "SELECT
					ID,
					{$wpdb->prefix}postmeta.meta_value as adult_number,
					st_meta1.meta_value as children_number
				FROM
					{$wpdb->posts}
				JOIN {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id={$wpdb->prefix}posts.ID and {$wpdb->prefix}postmeta.meta_key='adult_number'
				JOIN {$wpdb->prefix}postmeta as st_meta1 on st_meta1.post_id={$wpdb->prefix}posts.ID and st_meta1.meta_key='children_number'
				where 1=1
				AND post_type='hotel_room'

				AND {$wpdb->prefix}posts.ID IN
				(
					SELECT room_id from(
						SELECT
					room_id,
					COUNT(id) AS total_booked,
					{$wpdb->prefix}postmeta.meta_value
				FROM
					{$wpdb->prefix}st_order_item_meta
				JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}postmeta.post_id = room_id
				AND {$wpdb->prefix}postmeta.meta_key = 'number_room'
				WHERE
					1 = 1
				AND (
					(
						check_in_timestamp <= {$check_in}
						AND check_out_timestamp >= {$check_in}
					)
					OR (
						check_in_timestamp >= {$check_in}
						AND check_in_timestamp <= {$check_out}
					)
				)
				AND st_booking_post_type = 'hotel_room'
				AND STATUS NOT IN (
					'trash',
					'canceled',
					'wc-cancelled'
				)
				GROUP BY
					room_id
					{$having_number_room}

					) as booked_table
				)

				OR {$wpdb->prefix}posts.ID IN
				(
					SELECT
							post_id
						FROM
							{$wpdb->prefix}st_room_availability
						WHERE
							1 = 1
						AND (
							check_in >= {$check_in}
							AND check_out <= {$check_out}
							AND `status` = 'unavailable'
						)
						AND post_type='hotel_room'
				)


				GROUP BY {$wpdb->prefix}posts.ID
				{$having}
				";
                $res   = $wpdb->get_results( $query, ARRAY_A );
                if ( !is_wp_error( $res ) ) {
                    $r = [];
                    foreach ( $res as $key => $value ) {
                        $r[] = $value[ 'ID' ];
                    }

                    return $r;
                }

            }

            /**
             * since 1.2.4
             *
             *
             */
            function _get_order_by_query( $orderby )
            {
                if ( $check = STInput::get( 'orderby' ) ) {
                    global $wpdb;
                    switch ( $check ) {
                        case "price_asc":
                            $orderby = ' CAST(st_hotel_room_price as DECIMAL) asc';
                            break;
                        case "price_desc":
                            $orderby = ' CAST(st_hotel_room_price as DECIMAL) desc';
                            break;
                        case "name_asc":
                            $orderby = $wpdb->posts . '.post_title';
                            break;
                        case "name_desc":
                            $orderby = $wpdb->posts . '.post_title desc';
                            break;
                        case "rand":
                            $orderby = ' rand()';
                            break;
                        case "new":
                            $orderby = $wpdb->posts . '.post_modified desc';
                            break;
                    }
                }

                return $orderby;
            }

            function get_cart_item_html( $item_id = FALSE )
            {
                return st()->load_template( 'layouts/modern/hotel_room/elements/cart-item', null, [ 'item_id' => $item_id ] );
            }

            function change_search_hotel_arg( $query )
            {
                if(empty( $_REQUEST[ 'isajax' ] )) {
                    if (is_admin() and empty($_REQUEST['is_search_map'])) return $query;
                }

                /**
                 * Global Search Args used in Element list and map display
                 * @since 1.2.6
                 */
                global $st_search_args;
                if ( !$st_search_args ) $st_search_args = $_REQUEST;

                $post_type = get_query_var( 'post_type' );

                if ( $post_type == 'hotel_room' ) {
                    $query->set( 'author', '' );

                    if ( STInput::get( 'item_name' ) ) {
                        $query->set( 's', STInput::get( 'item_name' ) );
                    }
                    $tax = STInput::request( 'taxonomy_hotel_room' );

                    if ( !empty( $tax ) and is_array( $tax ) ) {
                        $tax_query = [];
                        foreach ( $tax as $key => $value ) {
                            if ( $value ) {
                                $value = explode( ',', $value );
                                if ( !empty( $value ) and is_array( $value ) ) {
                                    foreach ( $value as $k => $v ) {
                                        if ( !empty( $v ) ) {
                                            $ids[] = $v;
                                        }
                                    }
                                }
                                if ( !empty( $ids ) ) {
                                    $tax_query[] = [
                                        'taxonomy' => $key,
                                        'terms'    => $ids,
                                        //'COMPARE'=>"IN",
                                        'operator' => 'AND',
                                    ];
                                }
                                $ids = [];
                            }
                        }
                        $query->set( 'tax_query', $tax_query );
                    }

                    if ( !empty( $_REQUEST[ 'room_num_search' ] ) ) {
                        $number       = STInput::request( 'room_num_search' );
                        $meta_query[] = [
                            'key'     => 'number_room',
                            'value'   => $number,
                            'compare' => '>=',
                            'type'    => 'NUMERIC'
                        ];
                    }
                    if ( !empty( $_REQUEST[ 'adult_number' ] ) ) {
                        $number       = STInput::request( 'adult_number' );
                        $meta_query[] = [
                            'key'     => 'adult_number',
                            'value'   => $number,
                            'compare' => '>=',
                            'type'    => 'NUMERIC'
                        ];
                    }
                    if ( !empty( $_REQUEST[ 'children_number' ] ) ) {
                        $number       = STInput::request( 'children_number' );
                        $meta_query[] = [
                            'key'     => 'children_number',
                            'value'   => $number,
                            'compare' => '>=',
                            'type'    => 'NUMERIC'
                        ];
                    }

                    $show_only_room_by = st()->get_option( 'show_only_room_by' );
                    if ( !empty( $show_only_room_by ) and is_array( $show_only_room_by ) and !in_array( 'all', $show_only_room_by ) ) {
                        foreach ( $show_only_room_by as $k => $v ) {
                            $meta_query[] = [
                                'key'     => 'st_custom_item_api_type',
                                'value'   => $v,
                                'compare' => '=',
                            ];
                        }

                    }

                    $is_featured = st()->get_option( 'is_featured_search_hotel_room', 'off' );
                    if ( $is_featured == 'on' and empty( $st_search_args[ 'st_orderby' ] ) ) {
                        $query->set( 'meta_key', 'is_featured' );
                        $query->set( 'orderby', 'meta_value' );
                        $query->set( 'order', 'DESC' );
                    }

                    if ( !empty( $meta_query ) ) {
                        $query->set( 'meta_query', $meta_query );
                    }

                    if ( !empty( $tax_query ) ) {
                        $query->set( 'tax_query', $tax_query );
                    }
                }
            }

            /**
             * @since 1.2.6
             * @return text
             */
            function _change_preload_search_title( $return )
            {
                if ( get_query_var( 'post_type' ) == 'hotel_room' or get_query_var( 'post_type' ) == 'hotel-room' ) {

                    $return = __( " Rooms in %s", ST_TEXTDOMAIN );

                    if ( STInput::get( 'location_id' ) ) {
                        $return = sprintf( $return, get_the_title( STInput::get( 'location_id' ) ) );
                    } elseif ( STInput::get( 'location_name' ) ) {
                        $return = sprintf( $return, STInput::get( 'location_name' ) );
                    } elseif ( STInput::get( 'address' ) ) {
                        $return = sprintf( $return, STInput::get( 'address' ) );
                    } else {
                        $return = __( " Rooms", ST_TEXTDOMAIN );
                    }


                    $return .= '...';
                }

                return $return;
            }

            /**
             * @since 1.2.6
             * @return array
             */
            public function getOrderby()
            {
                return $this->orderby;
            }

            /**
             *
             *
             * @since 1.2.6
             * */
            function choose_search_template( $template )
            {
                global $wp_query;
                $post_type = get_query_var( 'post_type' );
                if ( $wp_query->is_search && $post_type == 'hotel_room' ) {
                    return locate_template( 'search-hotel_room.php' );  //  redirect to archive-search.php
                }

                return $template;
            }

            /**
             *
             *
             *
             *
             * @update 1.2.6
             * */
            static function get_search_fields_name()
            {
                return [
                    'location'     => [
                        'value' => 'location',
                        'label' => __( 'Location', ST_TEXTDOMAIN )
                    ],
                    'checkin'      => [
                        'value' => 'checkin',
                        'label' => __( 'Check in', ST_TEXTDOMAIN )
                    ],
                    'checkout'     => [
                        'value' => 'checkout',
                        'label' => __( 'Check out', ST_TEXTDOMAIN )
                    ],
                    'adult'        => [
                        'value' => 'adult',
                        'label' => __( 'Adult', ST_TEXTDOMAIN )
                    ],
                    'children'     => [
                        'value' => 'children',
                        'label' => __( 'Children', ST_TEXTDOMAIN )
                    ],
                    'taxonomy'     => [
                        'value' => 'taxonomy',
                        'label' => __( 'Taxonomy', ST_TEXTDOMAIN )
                    ],
                    'item_name'    => [
                        'value' => 'item_name',
                        'label' => __( 'Room Name', ST_TEXTDOMAIN )
                    ],
                    'price_slider' => [
                        'value' => 'price_slider',
                        'label' => __( 'Price slider', ST_TEXTDOMAIN )
                    ],
                    'room_num'     => [
                        'value' => 'room_num',
                        'label' => __( 'Room(s)', ST_TEXTDOMAIN )
                    ]
                ];
            }

            function get_search_fields()
            {
                $fields = st()->get_option( 'room_search_fields' );

                return $fields;
            }

            function get_search_adv_fields()
            {
                $fields = st()->get_option( 'hotel_room_search_advance' );

                return $fields;
            }

            function _st_data_custom_price()
            {
                return [ 'title' => __( 'Price Custom Settings', ST_TEXTDOMAIN ), 'post_type' => 'hotel_room' ];
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
                        $p1 = sprintf( __( '%s rooms', ST_TEXTDOMAIN ), $query->found_posts );
                    } else {
                        $p1 = sprintf( __( '%s room', ST_TEXTDOMAIN ), $query->found_posts );
                    }
                } else {
                    $p1 = __( 'No room found', ST_TEXTDOMAIN );
                }

                $location_id = STInput::get( 'location_id' );
                if ( $location_id and $location = get_post( $location_id ) ) {
                    $p2 = sprintf( __( 'in %s', ST_TEXTDOMAIN ), get_the_title( $location_id ) );
                } elseif ( STInput::request( 'location_name' ) ) {
                    $p2 = sprintf( __( 'in %s', ST_TEXTDOMAIN ), STInput::request( 'location_name' ) );
                } elseif ( STInput::request( 'address' ) ) {
                    $p2 = sprintf( __( 'in %s', ST_TEXTDOMAIN ), STInput::request( 'address' ) );
                }

                if ( STInput::request( 'st_google_location', '' ) != '' ) {
                    $p2 .= sprintf( __( ' in %s', ST_TEXTDOMAIN ), esc_html( STInput::request( 'st_google_location', '' ) ) );
                }
                $start = TravelHelper::convertDateFormat( STInput::get( 'start' ) );
                $end   = TravelHelper::convertDateFormat( STInput::get( 'end' ) );

                $start = strtotime( $start );

                $end = strtotime( $end );

                if ( $start and $end ) {
                    $p3 = sprintf( __( 'on %s', ST_TEXTDOMAIN ), date_i18n( 'M d', $start ) . ' - ' . date_i18n( 'M d', $end ) );
                }

                if ( $adult_num = STInput::get( 'adult_number' ) ) {
                    if ( $adult_num > 1 ) {
                        $p4 = sprintf( __( 'for %s adults', ST_TEXTDOMAIN ), $adult_num );
                    } else {

                        $p4 = sprintf( __( 'for %s adult', ST_TEXTDOMAIN ), $adult_num );
                    }

                }

                // check Right to left
                if ( st()->get_option( 'right_to_left' ) == 'on' ) {

                    return $p4 . ' ' . $p3 . ' ' . $p2 . ' ' . $p1;
                }

                return esc_html( $p1 . ' ' . $p2 . ' ' . $p3 . ' ' . $p4 );

            }


            function _alter_search_query( $where )
            {
                if ( is_admin() ) return $where;
                global $wp_query, $wpdb;
                $post_type = '';
                if ( isset( $wp_query->query_vars[ 'post_type' ] ) and is_string( $wp_query->query_vars[ 'post_type' ] ) ) {
                    $post_type = $wp_query->query_vars[ 'post_type' ];

                }

                if ( $post_type == 'hotel_room' ) {
                    // Check Woocommerce Booking
                    $st_is_woocommerce_checkout = apply_filters( 'st_is_woocommerce_checkout', false );

                    if ( STInput::request( 'start' ) and STInput::request( 'end' ) ) {

                        $check_in   = strtotime( STInput::request( 'start' ) );
                        $check_out  = strtotime( STInput::request( 'end' ) );
                        $table_name = $wpdb->prefix . 'st_order_item_meta';

                        if ( $st_is_woocommerce_checkout ) {
                            $where_type = " AND type='woocommerce'";
                        } else {

                            $where_type = " AND type='normal_booking'";
                        }

                        $where_add = " AND {$wpdb->posts}.ID NOT IN (SELECT room_id FROM (
                                        SELECT
                                            room_id,SUM(room_num_search) as total_booked_number,{$wpdb->postmeta}.meta_value
                                        FROM
                                            {$table_name}
                                        JOIN {$wpdb->postmeta} ON {$wpdb->postmeta}.post_id = {$table_name}.room_id and {$wpdb->postmeta}.meta_key='number_room'
                                        AND st_booking_post_type = 'st_hotel'
                                        WHERE (check_in_timestamp<{$check_in} AND check_out_timestamp>{$check_in}) OR
                                        (check_in_timestamp>={$check_in} AND check_in_timestamp<={$check_out})
                                        {$where_type}
                                        GROUP BY room_id
                                         HAVING total_booked_number>={$wpdb->postmeta}.meta_value

                            ) as room_booked2 )";

                        // Woocommerce Booking
                        if ( $st_is_woocommerce_checkout ) {
                            // Woocommerce check Query
                            $where_add = "";
                        }
                        $where .= $where_add;
                    }
                }

                return $where;
            }

            static function get_room_price( $room_id = false, $start_date, $end_date )
            {

                if ( !$room_id ) $room_id = get_the_ID();
                $list_price = [];

                $price       = 0;
                $number_days = 0;
                if ( $start_date and $end_date ) {
                    $one_day        = ( 60 * 60 * 24 );
                    $str_start_date = strtotime( $start_date );
                    $str_end_date   = strtotime( $end_date );
                    $number_days    = ( $str_end_date - $str_start_date ) / $one_day;

                    $total = 0;
                    for ( $i = 1; $i <= $number_days; $i++ ) {
                        $data_date    = date( "Y-m-d", $str_start_date + ( $one_day * $i ) );
                        $date_tmp     = date( "Y-m-d", strtotime( $data_date ) - ( $one_day ) );
                        $data_price   = get_post_meta( $room_id, 'price', true );
                        $price_custom = TravelerObject::st_get_custom_price_by_date( $room_id, $data_date );
                        if ( $price_custom ) $data_price = $price_custom;
                        $list_price[ $data_date ] = [
                            'start' => $date_tmp,
                            'end'   => $data_date,
                            'price' => apply_filters( 'st_apply_tax_amount', $data_price )
                        ];
                        $total += $data_price;
                    }
                    $price = $total;
                }
                /** get custom price by date **/
                /** get custom price by date **/
                $data_price = [
                    'discount'   => false,
                    'price'      => apply_filters( 'st_apply_tax_amount', $price ),
                    'info_price' => $list_price,
                    'number_day' => $number_days,
                ];

                if ( $price > 0 ) {
                    $discount_rate = get_post_meta( $room_id, 'discount_rate', true );
                    if ( $discount_rate > 100 ) {
                        $discount_rate = 100;
                    }

                    if ( $discount_rate ) {
                        $data_price = [
                            'discount'   => true,
                            'price'      => apply_filters( 'st_apply_tax_amount', $price - ( $price / 100 ) * $discount_rate ),
                            'price_old'  => apply_filters( 'st_apply_tax_amount', $price ),
                            'info_price' => $list_price,
                            'number_day' => $number_days,
                        ];
                    }
                }

                return $data_price;
            }

            public static function get_external_url( $post_id = null )
            {
                if ( !$post_id ) $post_id = get_the_ID();
                $is_external = get_post_meta( $post_id, 'st_room_external_booking', "off" );
                $link        = get_post_meta( $post_id, 'st_room_external_booking_link', true );
                if ( $is_external == 'on' and $link ) {
                    return $link;
                }

                return false;
            }

            /**
             *
             *
             * @since 1.2.6
             * */
            public static function get_external_url_new( $post_id = null )
            {
                if ( !$post_id ) $post_id = get_the_ID();
                $is_external = st()->get_option( 'booking_room_by', 'on' );
                $link        = get_post_meta( $post_id, 'st_room_external_booking_link', true );
                if ( $is_external == 'on' and $link ) {
                    return $link;
                }

                return false;
            }

            static function inst()
            {
                if ( !self::$_inst ) {
                    self::$_inst = new self();
                }

                return self::$_inst;
            }
        }

        STRoom::inst()->init();
    }