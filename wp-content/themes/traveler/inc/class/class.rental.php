<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STRental
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STRental' ) ) {
        class STRental extends TravelerObject
        {

            static $_instance = false;

            protected $post_type = 'st_rental';
            /**
             * @var string
             * @since 1.1.7
             */
            protected $template_folder = 'rental';

            function __construct()
            {
                $this->orderby = [
                    'new'        => [
                        'key'  => 'new',
                        'name' => __( 'New', ST_TEXTDOMAIN )
                    ],
                    'price_asc'  => [
                        'key'  => 'price_asc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ) . ' (<i class="fa fa-long-arrow-up"></i>)'
                    ],
                    'price_desc' => [
                        'key'  => 'price_desc',
                        'name' => __( 'Price ', ST_TEXTDOMAIN ) . ' (<i class="fa fa-long-arrow-down"></i>)'
                    ],
                    'name_a_z'   => [
                        'key'  => 'name_a_z',
                        'name' => __( 'Name (A-Z)', ST_TEXTDOMAIN )
                    ],
                    'name_z_a'   => [
                        'key'  => 'name_z_a',
                        'name' => __( 'Name (Z-A)', ST_TEXTDOMAIN )
                    ],
                ];
            }

            /**
             * @return array
             */
            public function getOrderby()
            {
                return $this->orderby;
            }

            /**
             * @since 1.1.7
             *
             * @param $type
             *
             * @return string
             */
            function _get_post_type_icon( $type )
            {
                return "fa fa-home";
            }

            /**
             *
             *
             * @update 1.1.3
             * */
            function init()
            {

                if ( !$this->is_available() )
                    return;
                parent::init();


                //Filter change layout of rental detail if choose in metabox
                add_filter( 'rental_single_layout', [ $this, 'custom_rental_layout' ] );

                add_filter( 'template_include', [ $this, 'choose_search_template' ] );

                //add Widget Area
                add_action( 'widgets_init', [ $this, 'add_sidebar' ] );

                //Sidebar Pos for SEARCH
                add_filter( 'st_rental_sidebar', [ $this, 'change_sidebar' ] );

                //Filter the search hotel

                //add_action('pre_get_posts',array($this,'change_search_arg'));

                add_action( 'save_post', [ $this, 'update_sale_price' ] );

                add_action( 'wp', [ $this, 'add_to_cart' ], 20 );

                add_filter( 'st_search_preload_page', [ $this, '_change_preload_search_title' ] );


                //Save Rental Review Stats
                add_action( 'comment_post', [ $this, 'save_review_stats' ] );

                //        Change rental review arg
                add_filter( 'st_rental_wp_review_form_args', [ $this, 'comment_args' ], 10, 2 );

                // Woocommerce cart item information
                add_action( 'st_wc_cart_item_information_st_rental', [ $this, '_show_wc_cart_item_information' ] );
                add_action( 'st_wc_cart_item_information_btn_st_rental', [ $this, '_show_wc_cart_item_information_btn' ] );
                add_action( 'st_before_cart_item_st_rental', [ $this, '_show_wc_cart_post_type_icon' ] );


                add_filter( 'st_add_to_cart_item_st_rental', [ $this, '_deposit_calculator' ], 10, 2 );

                // add_filter('st_data_custom_price',array($this,'_st_data_custom_price'));
                /**
                 * Filter Class Icon
                 *
                 * @since 1.4.7
                 *
                 * author: quandq
                 */
                add_filter( 'st_post_type_' . $this->post_type . '_icon', [ $this, '_change_icon' ] );

                //xsearch Load post tour filter ajax
                add_action( 'wp_ajax_st_filter_rental_ajax', [ $this, 'st_filter_rental_ajax' ] );
                add_action( 'wp_ajax_nopriv_st_filter_rental_ajax', [ $this, 'st_filter_rental_ajax' ] );
	            add_filter('rental_external_booking_submit', array($this, '__addSendMessageButton'));
            }

            public function __addSendMessageButton($return){
	            $res = '';
	            if(st_owner_post()) {
		            $post_id = get_the_ID();
		            if ( STInput::request( 'post_id' ) ) {
			            $post_id = STInput::request( 'post_id' );
		            }
		            $rental_external_booking = get_post_meta( $post_id, 'st_rental_external_booking', "off" );
		            if ( $rental_external_booking == 'off' ) {
			            $res = st_button_send_message($post_id);
		            }
	            }
	            return $res.$return;
            }

            public function st_filter_rental_ajax()
            {
                $page_number = STInput::get( 'page' );
                $st_style    = STInput::get( 'layout' );
                $orderby     = STInput::get( 'orderby' );
                $jcategory   = STInput::get( 'jcategory' );

                global $wp_query, $st_search_query;

                $rental = $this;
                $rental->alter_search_query();

                set_query_var( 'paged', $page_number );

                $paged = $page_number;

                $args = [
                    'post_type'   => 'st_rental',
                    's'           => '',
                    'post_status' => [ 'publish' ],
                    'paged'       => $paged,
                ];

                query_posts( $args );

                $st_search_query = $wp_query;
                if ( $orderby == 'featured' ) {
                    $st_search_query->set( 'meta_key', 'is_featured' );
                    $st_search_query->set( 'orderby', 'meta_value' );
                    $st_search_query->set( 'order', 'DESC' );
                }
                $rental->remove_alter_search_query();

                $current_page = get_query_var( 'paged' );
                $total_posts  = $wp_query->found_posts;
                if ( $total_posts == 0 && $current_page >= 2 ) {
                    global $wp_rewrite;
                    $link = add_query_arg();
                    if ( $wp_rewrite->using_permalinks() ) {
                        $link = preg_replace( "/page\/(\d)\//", "page/1/", $link );
                    } else {
                        $link = add_query_arg( 'paged', 1 );
                    }
                    wp_redirect( $link );
                }
                if ( $st_search_query ) {
                    $query = $st_search_query;
                } else $query = $wp_query;

                ob_start();

                if ( $st_style == '1' ) {
                    if ( $query->have_posts() ) {
                        echo '<ul class="booking-list loop-rental style_list">';
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            echo st()->load_template( 'rental/loop', 'list', [ 'taxonomy' => $jcategory ] );
                        }
                        echo "</ul>";
                    }

                } else {
                    ?>
                    <div class="row row-wrap st_fix_clear style_box">
                        <?php
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                echo st()->load_template( 'rental/loop', 'grid', [ 'taxonomy' => $jcategory ] );
                            }
                        ?>
                    </div>
                    <?php
                }

                if ( !$query->found_posts ) {
                    echo '<h3 class="ajax-filter-not-found">' . __( 'No rental found', ST_TEXTDOMAIN ) . '</h3>';
                }

                $ajax_filter_content = ob_get_contents();
                ob_clean();
                ob_end_flush();

                ob_start();
                //Content Pagination
                ?>
                <p>
                    <small><?php echo balanceTags( $rental->get_result_string() ) ?>. &nbsp;&nbsp;
                        <?php
                            if ( $query->found_posts ):
                                esc_html_e('Showing','traveler');
                                $page           = get_query_var( 'paged' );
                                $posts_per_page = get_query_var( 'posts_per_page' );
                                if ( !$page ) $page = 1;

                                $last = $posts_per_page * ( $page );

                                if ( $last > $query->found_posts ) $last = $query->found_posts;
                                echo ' ' . ( $posts_per_page * ( $page - 1 ) + 1 ) . ' - ' . $last;
                            endif;
                        ?>
                    </small>
                </p>
                <div class="row">
                    <?php
                        TravelHelper::paging( $query ); ?>
                </div>
                <?php
                $ajax_filter_pag = ob_get_contents();
                ob_clean();
                ob_end_flush();

                $count = balanceTags( $rental->get_result_string() );

                $result = [
                    'content' => $ajax_filter_content,
                    'pag'     => $ajax_filter_pag,
                    'count'   => $count,
                    'page'    => $page_number
                ];

                echo json_encode( $result );
                die;
            }

            function _change_icon( $icon )
            {
                return $icon = 'fa-home';
            }


            function _st_data_custom_price()
            {
                return [ 'title' => 'Price Custom Settings', 'post_type' => 'st_rental' ];
            }

            /**
             *
             *
             *
             * @since 1.1.1
             * */

            function _show_wc_cart_item_information( $st_booking_data = [] )
            {
                echo st()->load_template( 'rental/wc_cart_item_information', false, [ 'st_booking_data' => $st_booking_data ] );
            }

            /**
             *
             *
             *
             * @since 1.1.1
             * */

            function _show_wc_cart_post_type_icon()
            {
                echo '<span class="booking-item-wishlist-title"><i class="fa fa-home"></i> ' . __( 'rental', ST_TEXTDOMAIN ) . ' <span></span></span>';
            }

            function comment_args( $comment_form, $post_id = false )
            {
                if ( !$post_id )
                    $post_id = get_the_ID();
                if ( get_post_type( $post_id ) == 'st_rental' ) {
                    $stats = $this->get_review_stats();

                    if ( $stats and is_array( $stats ) ) {
                        $stat_html = '<ul class="list booking-item-raiting-summary-list stats-list-select">';

                        foreach ( $stats as $key => $value ) {
                            $stat_html .= '<li class=""><div class="booking-item-raiting-list-title">' . $value[ 'title' ] . '</div>
                                                    <ul class="icon-group booking-item-rating-stars">
                                                    <li class=""><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li class=""><i class="fa fa-smile-o"></i>
                                                    </li>
                                                    <li><i class="fa fa-smile-o"></i>
                                                    </li>
                                                </ul>
                                                <input type="hidden" class="st_review_stats" value="0" name="st_review_stats[' . $value[ 'title' ] . ']">
                                                    </li>';
                        }
                        $stat_html .= '</ul>';


                        $comment_form[ 'comment_field' ] = "
                        <div class='row'>
                            <div class=\"col-sm-8\">
                    ";
                        $comment_form[ 'comment_field' ] .= '<div class="form-group">
                                            <label>' . __( 'Review Title', ST_TEXTDOMAIN ) . '</label>
                                            <input class="form-control" type="text" name="comment_title">
                                        </div>';

                        $comment_form[ 'comment_field' ] .= '<div class="form-group">
                                            <label>' . __( 'Review Text', ST_TEXTDOMAIN ) . '</label>
                                            <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
                                        </div>
                                        </div><!--End col-sm-8-->
                                        ';

                        $comment_form[ 'comment_field' ] .= '<div class="col-sm-4">' . $stat_html . '</div></div><!--End Row-->';
                    }
                }

                return $comment_form;
            }

            function save_review_stats( $comment_id )
            {

                $comemntObj = get_comment( $comment_id );
                $post_id    = $comemntObj->comment_post_ID;

                if ( get_post_type( $post_id ) == 'st_rental' ) {
                    $all_stats       = $this->get_review_stats();
                    $st_review_stats = STInput::post( 'st_review_stats' );

                    if ( !empty( $all_stats ) and is_array( $all_stats ) ) {
                        $total_point = 0;
                        foreach ( $all_stats as $key => $value ) {
                            if ( isset( $st_review_stats[ $value[ 'title' ] ] ) ) {
                                $total_point += $st_review_stats[ $value[ 'title' ] ];
                                //Now Update the Each Stat Value
                                update_comment_meta( $comment_id, 'st_stat_' . sanitize_title( $value[ 'title' ] ), $st_review_stats[ $value[ 'title' ] ] );
                            }
                        }

                        $avg = round( $total_point / count( $all_stats ), 1 );

                        //Update comment rate with avg point
                        $rate = wp_filter_nohtml_kses( $avg );
                        if ( $rate > 5 ) {
                            //Max rate is 5
                            $rate = 5;
                        }
                        update_comment_meta( $comment_id, 'comment_rate', $rate );
                        //Now Update the Stats Value
                        update_comment_meta( $comment_id, 'st_review_stats', $st_review_stats );
                    }


                }
                //Class hotel do the rest
            }

            function _alter_search_query( $where )
            {
                global $wp_query;
                if ( is_search() ) {
                    $post_type = $wp_query->query_vars[ 'post_type' ];

                    if ( $post_type == 'st_rental' ) {
                        //Alter From NOW
                        global $wpdb;

                        $check_in  = TravelHelper::convertDateFormat( STInput::get( 'start' ) );
                        $check_out = TravelHelper::convertDateFormat( STInput::get( 'end' ) );


                        //Alter WHERE for check in and check out
                        if ( $check_in and $check_out ) {
                            $check_in  = @date( 'Y-m-d H:i:s', strtotime( $check_in ) );
                            $check_out = @date( 'Y-m-d H:i:s', strtotime( $check_out ) );

                            $check_in  = esc_sql( $check_in );
                            $check_out = esc_sql( $check_out );


//                        $where .= " AND $wpdb->posts.ID NOT IN
//                            (
//                                SELECT booked_id FROM (
//                                    SELECT count(st_meta6.meta_value) as total_booked, st_meta5.meta_value as total,st_meta6.meta_value as booked_id ,st_meta2.meta_value as check_in,st_meta3.meta_value as check_out
//                                         FROM {$wpdb->posts}
//                                                JOIN {$wpdb->postmeta}  as st_meta2 on st_meta2.post_id={$wpdb->posts}.ID and st_meta2.meta_key='check_in'
//                                                JOIN {$wpdb->postmeta}  as st_meta3 on st_meta3.post_id={$wpdb->posts}.ID and st_meta3.meta_key='check_out'
//                                                JOIN {$wpdb->postmeta}  as st_meta6 on st_meta6.post_id={$wpdb->posts}.ID and st_meta6.meta_key='item_id'
//                                                JOIN {$wpdb->postmeta}  as st_meta5 on st_meta5.post_id=st_meta6.meta_value and st_meta5.meta_key='rental_number'
//                                                WHERE {$wpdb->posts}.post_type='st_order'
//                                        GROUP BY st_meta6.meta_value HAVING total<=total_booked AND (
//
//                                                    ( CAST(st_meta2.meta_value AS DATE)<'{$check_in}' AND  CAST(st_meta3.meta_value AS DATE)>'{$check_in}' )
//                                                    OR ( CAST(st_meta2.meta_value AS DATE)>='{$check_in}' AND  CAST(st_meta2.meta_value AS DATE)<='{$check_out}' )
//
//                                        )
//                                ) as item_booked
//                            )
//
//                    ";
                        }
                    }
                }

                return $where;
            }

            function _change_preload_search_title( $return )
            {
                if ( get_query_var( 'post_type' ) == 'st_rental' || is_page_template( 'template-rental-search.php' ) ) {
                    $return = __( " Rentals in %s", ST_TEXTDOMAIN );

                    if ( STInput::get( 'location_id' ) ) {
                        $return = sprintf( $return, get_the_title( STInput::get( 'location_id' ) ) );
                    } elseif ( STInput::get( 'location_name' ) ) {
                        $return = sprintf( $return, STInput::get( 'location_name' ) );
                    } elseif ( STInput::get( 'address' ) ) {
                        $return = sprintf( $return, STInput::get( 'address' ) );
                    } else {
                        $return = __( " Rentals", ST_TEXTDOMAIN );
                    }

                    $return .= '...';
                }


                return $return;
            }

            function get_cart_item_html( $item_id )
            {
                return st()->load_template( 'rental/cart_item_html', null, [ 'item_id' => $item_id ] );
            }

            /**
             * @since 1.1.0
             **/
            function add_to_cart()
            {
                if ( STInput::request( 'action' ) == 'rental_add_cart' ) {
                    if ( $this->do_add_to_cart() ) {
                        $link = STCart::get_cart_link();
                        wp_safe_redirect( $link );
                        die;
                    }
                }
            }

            function do_add_to_cart()
            {
                $form_validate = true;

                $item_id = intval( STInput::request( 'item_id', '' ) );
                if ( $item_id <= 0 || get_post_type( $item_id ) != 'st_rental' ) {
                    STTemplate::set_message( __( 'This rental is not available.', ST_TEXTDOMAIN ), 'danger' );
                    $form_validate = false;

                    return false;
                }

                $rental_origin = (int)TravelHelper::post_origin( $item_id, 'st_rental' );

                $check_in = STInput::request( 'start', '' );
                if ( empty( $check_in ) ) {
                    STTemplate::set_message( __( 'The check in field is required.', ST_TEXTDOMAIN ), 'danger' );
                    $form_validate = false;

                    return false;
                }
                $check_in = TravelHelper::convertDateFormat( $check_in );

                $check_out = STInput::request( 'end', '' );
                if ( empty( $check_out ) ) {
                    STTemplate::set_message( __( 'The check out field is required.', ST_TEXTDOMAIN ), 'danger' );
                    $form_validate = false;

                    return false;
                }
                $check_out = TravelHelper::convertDateFormat( $check_out );

	            if ( strtotime( $check_out ) - strtotime( $check_in ) <= 0 ) {
		            STTemplate::set_message( __( 'The check-out is later than the check-in.', ST_TEXTDOMAIN ), 'danger' );
		            $form_validate = false;
	            }

                $today = date( 'm/d/Y' );

                $booking_period = get_post_meta( $rental_origin, 'rentals_booking_period', true );
                if ( empty( $booking_period ) || $booking_period <= 0 ) $booking_period = 0;

                $period          = STDate::dateDiff( $today, $check_in );
                $compare         = TravelHelper::dateCompare( $today, $check_in );
                $booking_min_day = intval( get_post_meta( $rental_origin, 'rentals_booking_min_day', true ) );

                if ( $compare < 0 ) {
                    STTemplate::set_message( __( 'You can not set check-in date in the past', ST_TEXTDOMAIN ), 'danger' );
                    $form_validate = false;

                    return false;
                }

                if ( $period < $booking_period ) {
                    STTemplate::set_message( sprintf( __( 'This rental required minimum booking is %d day(s) before return', ST_TEXTDOMAIN ), $booking_period ), 'danger' );
                    $form_validate = false;

                    return false;
                }
                if ( $booking_min_day ) {
                    $booking_min_day_diff = STDate::dateDiff( $check_in, $check_out );
                    if ( $booking_min_day_diff < $booking_min_day ) {
                        STTemplate::set_message( sprintf( __( 'Please book at least %d day(s) in total', ST_TEXTDOMAIN ), $booking_min_day ), 'danger' );
                        $form_validate = false;

                        return false;
                    }
                }
                $adult_number = intval( STInput::request( 'adult_number', '' ) );
                $child_number = intval( STInput::request( 'child_number', '' ) );

                $max_adult    = intval( get_post_meta( $rental_origin, 'rental_max_adult', true ) );
                $max_children = intval( get_post_meta( $rental_origin, 'rental_max_children', true ) );

                if ( $adult_number > $max_adult ) {
                    STTemplate::set_message( sprintf( __( 'A maximum number of adult(s): %d', ST_TEXTDOMAIN ), $max_adult ), 'danger' );
                    $form_validate = false;

                    return false;
                }

                if ( $child_number > $max_children ) {
                    STTemplate::set_message( sprintf( __( 'A maximum number of children: %d', ST_TEXTDOMAIN ), $max_children ), 'danger' );
                    $form_validate = false;

                    return false;
                }

                $number_room = intval( get_post_meta( $rental_origin, 'rental_number', true ) );

                $check_in_tmp  = date( 'Y-m-d', strtotime( $check_in ) );
                $check_out_tmp = date( 'Y-m-d', strtotime( $check_out ) );

                if ( !RentalHelper::check_day_cant_order( $rental_origin, $check_in_tmp, $check_out_tmp, 1 ) ) {
                    STTemplate::set_message( sprintf( __( 'This rental is not available from %s to %s.', ST_TEXTDOMAIN ), $check_in_tmp, $check_out_tmp ), 'danger' );
                    $form_validate = false;

                    return false;
                }

                if ( !RentalHelper::_check_room_available( $rental_origin, $check_in_tmp, $check_out_tmp ) ) {
                    STTemplate::set_message( __( 'This rental is not available.', ST_TEXTDOMAIN ), 'danger' );
                    $form_validate = false;

                    return false;
                }

	            if ( !RentalHelper::_check_has_groupday( $rental_origin, $check_in_tmp, $check_out_tmp ) ) {
		            STTemplate::set_message( __( 'This rental is not available.', ST_TEXTDOMAIN ), 'danger' );
		            $form_validate = false;

		            return false;
	            }

                /**
                 * Validate Guest Name
                 *
                 * @since 2.1.2
                 * @author dannie
                 */
                $partner_create_booking = STInput::request('add_booking_partner_field');
                if(!st_validate_guest_name($rental_origin,$adult_number,$child_number,0) && empty($partner_create_booking))
                {
                    STTemplate::set_message(esc_html__('Please enter the Guest Name',ST_TEXTDOMAIN), 'danger');
                    $pass_validate = FALSE;

                    return FALSE;
                }

                $item_price    = STPrice::getRentalPriceOnlyCustomPrice( $rental_origin, strtotime( $check_in ), strtotime( $check_out ) );
                $extras        = STInput::request( 'extra_price', [] );
                $numberday     = STDate::dateDiff( $check_in, $check_out );
                $extra_price   = STPrice::getExtraPrice( $rental_origin, $extras, 1, $numberday );
                $price_sale    = STPrice::getSalePrice( $rental_origin, strtotime( $check_in ), strtotime( $check_out ) );
                $discount_rate = STPrice::get_discount_rate( $rental_origin, strtotime( $check_in ) );
                $data          = [
                    'item_price'    => $item_price,
                    'ori_price'     => $price_sale + $extra_price,
                    'check_in'      => $check_in,
                    'check_out'     => $check_out,
                    'adult_number'  => $adult_number,
                    'child_number'  => $child_number,
                    'extras'        => $extras,
                    'extra_price'   => $extra_price,
                    'commission'    => TravelHelper::get_commission( $item_id ),
                    'discount_rate' => $discount_rate,
                    'guest_title'=>STInput::post('guest_title'),
                    'guest_name'=>STInput::post('guest_name'),
                ];
                if ( $form_validate )
                    $form_validate = apply_filters( 'st_rental_add_cart_validate', $form_validate );

                if ( $form_validate ) {
                    STCart::add_cart( $item_id, 1, $item_price, $data );
                }

                return $form_validate;

            }

            function _add_cart_check_available( $post_id = false, $data = [] )
            {
                if ( !$post_id or get_post_status( $post_id ) != 'publish' ) {
                    STTemplate::set_message( __( 'Rental doese not exists', ST_TEXTDOMAIN ), 'danger' );

                    return false;
                }

                $validator = new STValidate();

                $validator->set_rules( 'start', __( 'Check in', ST_TEXTDOMAIN ), 'required' );
                $validator->set_rules( 'end', __( 'Check out', ST_TEXTDOMAIN ), 'required' );

                if ( !$validator->run() ) {
                    STTemplate::set_message( $validator->error_string(), 'danger' );

                    return false;
                }

                $check_in  = date( 'Y-m-d H:i:s', strtotime( STInput::post( 'start' ) ) );
                $check_out = date( 'Y-m-d H:i:s', strtotime( STInput::post( 'end' ) ) );

                return true;

            }


            function update_sale_price( $post_id )
            {
                if ( get_post_type( $post_id ) == $this->post_type ) {
                    $price = STRental::get_price( $post_id );
                    update_post_meta( $post_id, 'sale_price', $price );
                }
            }

            function get_search_fields()
            {
                $fields = st()->get_option( 'rental_search_fields' );

                return $fields;
            }

            function get_search_adv_fields()
            {
                $fields = st()->get_option( 'rental_advance_search_fields' );

                return $fields;
            }

            /**
             *
             *
             * @update 1.1.1
             * */
            static function get_search_fields_name()
            {
                return [
                    'location'      => [
                        'value' => 'location',
                        'label' => __( 'Location', ST_TEXTDOMAIN )
                    ],
                    'list_location' => [
                        'value' => 'list_location',
                        'label' => __( 'Location List', ST_TEXTDOMAIN )
                    ],
                    'checkin'       => [
                        'value' => 'checkin',
                        'label' => __( 'Check in', ST_TEXTDOMAIN )
                    ],
                    'checkout'      => [
                        'value' => 'checkout',
                        'label' => __( 'Check out', ST_TEXTDOMAIN )
                    ],
                    'room_num'      => [
                        'value' => 'room_num',
                        'label' => __( 'Room(s)', ST_TEXTDOMAIN )
                    ],
                    'adult'         => [
                        'value' => 'adult',
                        'label' => __( 'Adult', ST_TEXTDOMAIN )
                    ],
                    'children'      => [
                        'value' => 'children',
                        'label' => __( 'Children', ST_TEXTDOMAIN )
                    ],
                    'taxonomy'      => [
                        'value' => 'taxonomy',
                        'label' => __( 'Taxonomy', ST_TEXTDOMAIN )
                    ],
                    'item_name'     => [
                        'value' => 'item_name',
                        'label' => __( 'Rental Name', ST_TEXTDOMAIN )
                    ],
                    'list_name'     => [
                        'value' => 'list_name',
                        'label' => __( 'List Name', ST_TEXTDOMAIN )
                    ],
                    'price_slider'  => [
                        'value' => 'price_slider',
                        'label' => __( 'Price slider ', ST_TEXTDOMAIN )
                    ]

                ];
            }

            function _get_join_query( $join )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_rental' ) ) return $join;

                global $wpdb;

                $table = $wpdb->prefix . 'st_rental';

                $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";

                return $join;
            }

            /**
             * @update 1.1.8
             *
             */
            function _get_where_query_tab_location( $where )
            {
                $location_id = get_the_ID();
                if ( !TravelHelper::checkTableDuplicate( 'st_rental' ) ) return $where;
                if ( !empty( $location_id ) ) {
                    $where = TravelHelper::_st_get_where_location( $location_id, [ 'st_rental' ], $where );
                }

                return $where;
            }

            function _get_where_query( $where )
            {
                if ( !TravelHelper::checkTableDuplicate( 'st_rental' ) ) return $where;

                global $wpdb, $st_search_args;
                if ( !$st_search_args ) $st_search_args = $_REQUEST;
                /**
                 * Merge data with element args with search args
                 * @since  1.2.5
                 * @author quandq
                 */
                if ( !empty( $st_search_args[ 'st_location' ] ) ) {
                    if ( empty( $st_search_args[ 'only_featured_location' ] ) or $st_search_args[ 'only_featured_location' ] == 'no' )
                        $st_search_args[ 'location_id' ] = $st_search_args[ 'st_location' ];
                }
                if ( isset( $st_search_args[ 'location_id' ] ) && !empty( $st_search_args[ 'location_id' ] ) ) {
                    $location_id = $st_search_args[ 'location_id' ];
                    $where       = TravelHelper::_st_get_where_location( $location_id, [ 'st_rental' ], $where );
                } elseif ( isset( $_REQUEST[ 'location_name' ] ) && !empty( $_REQUEST[ 'location_name' ] ) ) {
                    $location_name = STInput::request( 'location_name', '' );

                    $ids_location = TravelerObject::_get_location_by_name( $location_name );

                    if ( !empty( $ids_location ) && is_array( $ids_location ) ) {
                        $where .= TravelHelper::_st_get_where_location( $ids_location, [ 'st_hotel' ], $where );
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

                $check_in = STInput::get( 'start', '' );
                if ( empty( $check_in ) ) {
                    $check_in = date( 'Y-m-d' );
                } else {
                    $check_in = date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $check_in ) ) );
                }
                $check_out = STInput::get( 'end', '' );

                if ( empty( $check_out ) ) {
                    $check_out = date( 'Y-m-d', strtotime( '+1 day', strtotime( $check_in ) ) );
                } else {
                    $check_out = date( 'Y-m-d', strtotime( TravelHelper::convertDateFormat( $check_out ) ) );
                }

                if ( !empty( $check_in ) && !empty( $check_out ) ) {

                    $today = date( 'm/d/Y' );

                    $period = STDate::dateDiff( $today, $check_in );

                    $adult_number = STInput::get( 'adult_number', 0 );
                    if ( intval( $adult_number ) < 0 ) $adult_number = 0;

                    $children_number = STInput::get( 'children_num', 0 );
                    if ( intval( $children_number ) < 0 ) $children_number = 0;
                    $list_rental = $this->get_unavailable_rental( $check_in, $check_out );

                    if ( is_array( $list_rental ) and !empty( $list_rental ) ) {
                        $list_rental = implode( ',', $list_rental );
                        $where .= " AND {$wpdb->posts}.ID NOT IN ({$list_rental})";
                    }
                    $where .= " AND CAST(tb.rentals_booking_period AS UNSIGNED) <= {$period}";

                }
                if ( $star = STInput::get( 'star_rate' ) ) {
                    $stars    = STInput::get( 'star_rate', 1 );
                    $stars    = explode( ',', $stars );
                    $all_star = [];
                    if ( !empty( $stars ) && is_array( $stars ) ) {
                        foreach ( $stars as $val ) {
                            for ( $i = $val; $i < $val + 0.9; $i += 0.1 ) {
                                if ( $i ) {
                                    $all_star[] = $i;
                                }
                            }
                        }
                    }

                    $list_star = implode( ',', $all_star );
                    if ( $list_star ) {
                        $where .= " AND (tb.rate_review IN ({$list_star}))";
                    }
                }

                if ( $price = STInput::get( 'price_range' ) ) {
                    $priceobj = explode( ';', $price );

                    $priceobj[ 0 ] = TravelHelper::convert_money_to_default( $priceobj[ 0 ] );
                    $where .= " AND (tb.sale_price >= {$priceobj[0]})";
                    if ( isset( $priceobj[ 1 ] ) ) {

                        $priceobj[ 1 ] = TravelHelper::convert_money_to_default( $priceobj[ 1 ] );
                        $where .= " AND (tb.sale_price <= {$priceobj[1]})";
                    }
                }
                if ( $adult_number = STInput::get( 'adult_number' ) ) {
                    $where .= " AND tb.rental_max_adult>= {$adult_number}";
                }
                if ( $child_number = STInput::get( 'child_number' ) ) {
                    $where .= " AND tb.rental_max_children>= {$child_number}";
                }
                if ( isset( $_REQUEST[ 'range' ] ) and isset( $_REQUEST[ 'location_id' ] ) ) {
                    $range       = STInput::get( 'range', '0;5' );
                    $rangeobj    = explode( ';', $range );
                    $range_min   = $rangeobj[ 0 ];
                    $range_max   = $rangeobj[ 1 ];
                    $location_id = STInput::request( 'location_id' );
                    $post_type   = get_query_var( 'post_type' );
                    $map_lat     = (float)get_post_meta( $location_id, 'map_lat', true );
                    $map_lng     = (float)get_post_meta( $location_id, 'map_lng', true );
                    global $wpdb;
                    $where .= "
                AND $wpdb->posts.ID IN (
                        SELECT ID FROM (
                            SELECT $wpdb->posts.*,( 6371 * acos( cos( radians({$map_lat}) ) * cos( radians( mt1.meta_value ) ) *
                                            cos( radians( mt2.meta_value ) - radians({$map_lng}) ) + sin( radians({$map_lat}) ) *
                                            sin( radians( mt1.meta_value ) ) ) ) AS distance
                                                FROM $wpdb->posts, $wpdb->postmeta as mt1,$wpdb->postmeta as mt2
                                                WHERE $wpdb->posts.ID = mt1.post_id
                                                and $wpdb->posts.ID=mt2.post_id
                                                AND mt1.meta_key = 'map_lat'
                                                and mt2.meta_key = 'map_lng'
                                                AND $wpdb->posts.post_status = 'publish'
                                                AND $wpdb->posts.post_type = '{$post_type}'
                                                AND $wpdb->posts.post_date < NOW()
                                                GROUP BY $wpdb->posts.ID HAVING distance >= {$range_min} and distance <= {$range_max}
                                                ORDER BY distance ASC
                        ) as st_data
	            )";
                }
                /**
                 * @since 1.3.1
                 *        Remove search by number of rental room
                 **/

                /**
                 * Change Where for Element List
                 * @since  1.2.5
                 * @author quandq
                 */
                if ( !empty( $st_search_args[ 'only_featured_location' ] ) and !empty( $st_search_args[ 'featured_location' ] ) ) {
                    $featured = $st_search_args[ 'featured_location' ];
                    if ( $st_search_args[ 'only_featured_location' ] == 'yes' and is_array( $featured ) ) {

                        if ( is_array( $featured ) && count( $featured ) ) {
                            $where .= " AND (";
                            $where_tmp = "";
                            foreach ( $featured as $item ) {
                                if ( empty( $where_tmp ) ) {
                                    $where_tmp .= " tb.multi_location LIKE '%_{$item}_%'";
                                } else {
                                    $where_tmp .= " OR tb.multi_location LIKE '%_{$item}_%'";
                                }
                            }
                            $featured = implode( ',', $featured );
                            $where_tmp .= " OR tb.id_location IN ({$featured})";
                            $where .= $where_tmp . ")";
                        }
                    }
                }

                return $where;

            }

            function get_unavailable_rental( $check_in, $check_out )
            {
                $check_in  = strtotime( $check_in );
                $check_out = strtotime( $check_out );



                $res = ST_Rental_Availability::inst()
                    ->select('post_id')
                    ->where('check_in >=', $check_in)
                    ->where('check_out <=', $check_out)
                    ->where("(status = 'unavailable' OR (number - number_booked <= 0))", null, true)
                    ->groupby('post_id')
                    ->get()->result();

                $list = [];
                if(!empty($res)){
                    foreach ($res as $k => $v){
                        array_push($list, $v['post_id']);
                    }
                }
                return $list;
                /*global $wpdb;
                $query = "SELECT
					post_id
				FROM
					{$wpdb->prefix}st_rental
				WHERE
					1 = 1
				AND post_id IN (
					SELECT
						post_id
					FROM
						{$wpdb->prefix}st_rental_availability
					WHERE
						1 = 1
					AND (
						check_in >= {$check_in}
						AND check_out <= {$check_out}
						AND `status` = 'unavailable'
					)
					AND post_type='st_rental'
				)
				OR post_id IN (
					SELECT
						st_booking_id
					FROM
						(
							SELECT
								st_booking_id,
								COUNT(DISTINCT id) AS total_booked,
								{$wpdb->prefix}postmeta.meta_value
							FROM
								{$wpdb->prefix}st_order_item_meta
							JOIN {$wpdb->prefix}postmeta ON {$wpdb->prefix}postmeta.post_id = st_booking_id
							AND {$wpdb->prefix}postmeta.meta_key = 'rental_number'
							WHERE
								(
                                    (
                                        {$check_in} < CAST(check_in_timestamp AS UNSIGNED)
                                        AND {$check_out} > CAST(check_out_timestamp AS UNSIGNED)
                                    )
                                    OR (
                                        {$check_in} BETWEEN CAST(check_in_timestamp AS UNSIGNED)
                                        AND CAST(check_out_timestamp AS UNSIGNED)
                                    )
                                    OR (
                                        {$check_out} BETWEEN CAST(check_in_timestamp AS UNSIGNED)
                                        AND CAST(check_out_timestamp AS UNSIGNED)
                                    )
                                )
							AND st_booking_post_type = 'st_rental'
							AND STATUS NOT IN (
								'trash',
								'canceled',
								'wc-cancelled'
							)
							GROUP BY
								st_booking_id
							HAVING
								total_booked >= {$wpdb->prefix}postmeta.meta_value
						) AS available_table
				)
				";

                $res = $wpdb->get_col( $query, 0 );

                $r = [];
                if ( !is_wp_error( $res ) && !empty( $res ) ) {
                    $r = $res;
                }

                return $r;*/
            }

            function alter_search_query()
            {
                add_action( 'pre_get_posts', [ $this, 'change_search_arg' ] );
                add_filter( 'posts_where', [ $this, '_get_where_query' ] );
                add_filter( 'posts_join', [ $this, '_get_join_query' ] );
                add_filter( 'posts_orderby', [ $this, '_get_order_by_query' ] );
                add_filter( 'posts_fields', [ $this, '_get_select_query' ] );
                add_filter( 'posts_clauses', [ $this, '_get_query_clauses' ] );
            }

            function remove_alter_search_query()
            {
                remove_action( 'pre_get_posts', [ $this, 'change_search_arg' ] );
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
                if ( STAdminRental::check_ver_working() == false ) return $clauses;
                $post_type = get_query_var( 'post_type' );
                if ( $post_type == 'st_rental' ) {
                    global $wpdb;
                    if ( isset( $_REQUEST[ 'price_range' ] ) ) {
                        if ( empty( $clauses[ 'groupby' ] ) ) {
                            $clauses[ 'groupby' ] = $wpdb->posts . ".ID";
                        }
                        $price         = STInput::get( 'price_range', '0;0' );
                        $priceobj      = explode( ';', $price );
                        $priceobj[ 0 ] = TravelHelper::convert_money_to_default( $priceobj[ 0 ] );
                        $priceobj[ 1 ] = TravelHelper::convert_money_to_default( $priceobj[ 1 ] );
                        $min_range     = $priceobj[ 0 ];
                        $max_range     = $priceobj[ 1 ];
                        $clauses[ 'groupby' ] .= " HAVING CAST(st_rental_price AS DECIMAL) >= {$min_range} AND CAST(st_rental_price AS DECIMAL) <= {$max_range}";
                    }
                }

                return $clauses;
            }

            /**
             *
             *
             * @since 1.2.4
             */
            function _get_select_query( $query )
            {
                if ( STAdminRental::check_ver_working() == false ) return $query;
                $post_type = get_query_var( 'post_type' );
                if ( $post_type == 'st_rental' ) {
                    $query .= ",CASE
                                WHEN tb.is_sale_schedule = 'on'
                                                    AND tb.discount_rate != 0 AND tb.discount_rate != ''
                                                    AND tb.sale_price_from <= CURDATE() AND tb.sale_price_to >= CURDATE()
                                THEN
                                                    CAST(tb.price AS DECIMAL) - ( CAST(tb.price AS DECIMAL) / 100 ) * CAST(tb.discount_rate AS DECIMAL)
                                WHEN tb.is_sale_schedule != 'on' AND tb.discount_rate != 0 AND tb.discount_rate != ''
                                THEN
                                                    CAST(tb.price AS DECIMAL) - ( CAST(tb.price AS DECIMAL) / 100 ) * CAST(tb.discount_rate AS DECIMAL)
                                ELSE tb.price

                           END AS st_rental_price";
                }

                return $query;
            }

            /**
             *  since 1.2.4
             */
            static function _get_order_by_query( $orderby )
            {
                if ( $check = STInput::get( 'orderby' ) ) {
                    global $wpdb;
                    switch ( $check ) {
                        case "price_asc":
                            $orderby = ' CAST(st_rental_price as DECIMAL) asc';
                            break;
                        case "price_desc":
                            $orderby = ' CAST(st_rental_price as DECIMAL) desc';
                            break;
                        case "name_a_z":
                            $orderby = $wpdb->posts . '.post_title';
                            break;
                        case "name_z_a":
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

            /**
             * Add query meta max adult, children
             * @since 1.1.0
             **/
            function change_search_arg( $query )
            {
                if ( empty( $_REQUEST[ 'isajax' ] ) ) {
                    if ( is_admin() and empty( $_REQUEST[ 'is_search_map' ] ) ) return $query;
                }

                /**
                 * Global Search Args used in Element list and map display
                 * @since 1.2.5
                 */
                global $st_search_args;
                if ( !$st_search_args ) $st_search_args = $_REQUEST;

                $post_type = get_query_var( 'post_type' );

                $meta_query = [];

                if ( $post_type == 'st_rental' ) {
                    $query->set( 'author', '' );

                    if ( STInput::get( 'item_name' ) ) {
                        $query->set( 's', STInput::get( 'item_name' ) );
                    }


                    $has_tax_in_element = [];
                    if ( is_array( $st_search_args ) ) {
                        foreach ( $st_search_args as $key => $val ) {
                            if ( strpos( $key, 'taxonomies--' ) === 0 && !empty( $val ) ) {
                                $has_tax_in_element[ $key ] = $val;
                            }
                        }
                    }

                    if ( !empty( $has_tax_in_element ) ) {
                        $tax_query = [];
                        foreach ( $has_tax_in_element as $tax => $value ) {
                            $tax_name = str_replace( 'taxonomies--', '', $tax );
                            if ( !empty( $value ) ) {
                                $value       = explode( ',', $value );
                                $tax_query[] = [
                                    'taxonomy' => $tax_name,
                                    'terms'    => $value,
                                    'operator' => 'IN',
                                ];
                            }

                        }
                        if ( !empty( $tax_query ) ) {
                            $query->set( 'tax_query', $tax_query );
                        }
                    }

                    $tax = STInput::get( 'taxonomy' );
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

                    $is_featured = st()->get_option( 'is_featured_search_rental', 'off' );
                    if ( !empty( $is_featured ) and $is_featured == 'on' and empty( $st_search_args[ 'st_orderby' ] ) ) {
                        $query->set( 'meta_key', 'is_featured' );
                        $query->set( 'orderby', 'meta_value' );
                        $query->set( 'order', 'DESC' );
                    }

                    /**
                     * Post In and Post Order By from Element
                     * @since  1.2.5
                     * @author quandq
                     */
                    if ( !empty( $st_search_args[ 'st_ids' ] ) ) {
                        $query->set( 'post__in', explode( ',', $st_search_args[ 'st_ids' ] ) );
                        $query->set( 'orderby', 'post__in' );
                    }
                    if ( !empty( $st_search_args[ 'st_orderby' ] ) and $st_orderby = $st_search_args[ 'st_orderby' ] ) {
                        if ( $st_orderby == 'sale' ) {
                            $query->set( 'meta_key', 'total_sale_number' );
                            $query->set( 'orderby', 'meta_value_num' );
                        }
                        if ( $st_orderby == 'rate' ) {
                            $query->set( 'meta_key', 'rate_review' );
                            $query->set( 'orderby', 'meta_value' );
                        }
                        if ( $st_orderby == 'discount' ) {
                            $query->set( 'meta_key', 'discount_rate' );
                            $query->set( 'orderby', 'meta_value_num' );
                        }
                    }
                    if ( !empty( $st_search_args[ 'sort_taxonomy' ] ) and $sort_taxonomy = $st_search_args[ 'sort_taxonomy' ] ) {
                        if ( isset( $st_search_args[ "id_term_" . $sort_taxonomy ] ) ) {
                            $id_term     = $st_search_args[ "id_term_" . $sort_taxonomy ];
                            $tax_query[] = [
                                [
                                    'taxonomy'         => $sort_taxonomy,
                                    'field'            => 'id',
                                    'terms'            => explode( ',', $id_term ),
                                    'include_children' => false
                                ],
                            ];
                        }
                    }


                    if ( !empty( $meta_query ) ) {
                        $query->set( 'meta_query', $meta_query );
                    }

                    if ( !empty( $tax_query ) ) {
                        $query->set( 'tax_query', $tax_query );
                    }
                }
            }


            function change_sidebar()
            {
                return st()->get_option( 'rental_sidebar_pos', 'left' );
            }

            function choose_search_template( $template )
            {
                global $wp_query;
                $post_type = get_query_var( 'post_type' );
                if ( $wp_query->is_search && $post_type == 'st_rental' ) {
                    return locate_template( 'search-rental.php' );  //  redirect to archive-search.php
                }

                return $template;
            }

            function add_sidebar()
            {
                register_sidebar( [
                    'name'          => __( 'Rental Search Sidebar 1', ST_TEXTDOMAIN ),
                    'id'            => 'rental-sidebar',
                    'description'   => __( 'Widgets in this area will be shown on Rental', ST_TEXTDOMAIN ),
                    'before_title'  => '<h4>',
                    'after_title'   => '</h4>',
                    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                    'after_widget'  => '</div>',
                ] );

                register_sidebar( [
                    'name'          => __( 'Rental Search Sidebar 2', ST_TEXTDOMAIN ),
                    'id'            => 'rental-sidebar-2',
                    'description'   => __( 'Widgets in this area will be shown on Rental', ST_TEXTDOMAIN ),
                    'before_title'  => '<h4>',
                    'after_title'   => '</h4>',
                    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                    'after_widget'  => '</div>',
                ] );


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
                        $p1 = sprintf( __( '%s vacation rentals ', ST_TEXTDOMAIN ), $query->found_posts );
                    } else {
                        $p1 = sprintf( __( '%s vacation rental ', ST_TEXTDOMAIN ), $query->found_posts );
                    }
                } else {
                    $p1 = __( 'No rental found', ST_TEXTDOMAIN );
                }

                $location_id = STInput::get( 'location_id' );

                if ( $location_id and $location = get_post( $location_id ) ) {
                    $p2 = sprintf( __( ' in %s', ST_TEXTDOMAIN ), get_the_title( $location_id ) );
                } elseif ( STInput::request( 'location_name' ) ) {
                    $p2 = sprintf( __( ' in %s', ST_TEXTDOMAIN ), STInput::request( 'location_name' ) );
                } elseif ( STInput::request( 'address' ) ) {
                    $p2 = sprintf( __( ' in %s', ST_TEXTDOMAIN ), STInput::request( 'address' ) );
                }
                if ( STInput::request( 'st_google_location', '' ) != '' ) {
                    $p2 = sprintf( __( ' in %s', ST_TEXTDOMAIN ), esc_html( STInput::request( 'st_google_location', '' ) ) );
                }

                $start = TravelHelper::convertDateFormat( STInput::get( 'start' ) );
                $end   = TravelHelper::convertDateFormat( STInput::get( 'end' ) );

                $start = strtotime( $start );

                $end = strtotime( $end );

                if ( $start and $end ) {
                    $p3 = __( ' on ', ST_TEXTDOMAIN ) . date_i18n( 'M d', $start ) . ' - ' . date_i18n( 'M d', $end );
                }

                if ( $adult_number = STInput::get( 'adult_number' ) ) {
                    if ( $adult_number > 1 ) {
                        $p4 = sprintf( __( ' for %s adults', ST_TEXTDOMAIN ), $adult_number );
                    } else {

                        $p4 = sprintf( __( ' for %s adult', ST_TEXTDOMAIN ), $adult_number );
                    }

                }

                // check Right to left
                if ( st()->get_option( 'right_to_left' ) == 'on' || is_rtl() ) {

                    return $p1 . ' ' . $p4 . ' ' . $p3 . ' ' . $p2;
                }

                return esc_html( $p1 . ' ' . $p2 . ' ' . $p3 . ' ' . $p4 );
            }


            function custom_rental_layout( $old_layout_id = false )
            {
                if ( is_singular( 'st_rental' ) ) {
                    $meta = get_post_meta( get_the_ID(), 'custom_layout', true );

                    if ( $meta ) {
                        return $meta;
                    }
                }

                return $old_layout_id;
            }

            function get_near_by( $post_id = false, $range = 20, $limit = 5 )
            {
                $this->post_type = 'st_rental';

                return parent::get_near_by( $post_id, $range, $limit );
            }

            function get_review_stats()
            {
                $review_stat = st()->get_option( 'rental_review_stats' );

                return $review_stat;
            }

            function get_custom_fields()
            {
                return st()->get_option( 'rental_custom_fields', [] );
            }

            static function get_price( $post_id = false )
            {
                if ( !$post_id )
                    $post_id = get_the_ID();
                $post_id = TravelHelper::post_origin( $post_id, 'st_rental' );

                $price     = get_post_meta( $post_id, 'price', true );
                $price     = apply_filters( 'st_apply_tax_amount', $price );
                $new_price = 0;

                $discount         = get_post_meta( $post_id, 'discount_rate', true );
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
                    if ( $discount > 100 )
                        $discount = 100;

                    $new_price = $price - ( $price / 100 ) * $discount;
                } else {
                    $new_price = $price;
                }

                return $new_price;

            }

            static function get_orgin_price( $post_id = false )
            {
                if ( !$post_id )
                    $post_id = get_the_ID();

                $price = get_post_meta( $post_id, 'price', true );


                return $price = apply_filters( 'st_apply_tax_amount', $price );


            }

            static function is_sale( $post_id = false )
            {
                if ( !$post_id )
                    $post_id = get_the_ID();
                $discount         = get_post_meta( $post_id, 'discount_rate', true );
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
                    return true;
                }

                return false;
            }

            function change_post_class( $class )
            {
                if ( self::is_sale() ) {
                    $class[] = 'is_sale';
                }

                return $class;
            }


            static function get_owner_email( $item_id )
            {
                $theme_option = st()->get_option( 'partner_show_contact_info' );
                $metabox      = get_post_meta( $item_id, 'show_agent_contact_info', true );

                $use_agent_info = false;

                if ( $theme_option == 'on' ) $use_agent_info = true;
                if ( $metabox == 'user_agent_info' ) $use_agent_info = true;
                if ( $metabox == 'user_item_info' ) $use_agent_info = false;

                if ( $use_agent_info ) {
                    $post = get_post( $item_id );
                    if ( $post ) {
                        return get_the_author_meta( 'user_email', $post->post_author );
                    }

                }

                return get_post_meta( $item_id, 'agent_email', true );
            }

            /**
             *
             *
             * @since 1.0.9
             * */
            function is_available()
            {
                return st_check_service_available( $this->post_type );
            }

            public static function rental_external_booking_submit()
            {
                /*
                 * since 1.1.1
                 * filter hook rental_external_booking_submit
                */
                $post_id = get_the_ID();
                if ( STInput::request( 'post_id' ) ) {
                    $post_id = STInput::request( 'post_id' );
                }

                $rental_external_booking      = get_post_meta( $post_id, 'st_rental_external_booking', "off" );
                $rental_external_booking_link = get_post_meta( $post_id, 'st_rental_external_booking_link', true );

                if ( $rental_external_booking == "on" && $rental_external_booking_link !== "" ) {
                    if ( get_post_meta( $post_id, 'st_rental_external_booking_link', true ) ) {
                        ob_start();
                        ?>
                        <a class='btn btn-primary' data-toggle="tooltip" data-placement="top"
                           title="<?php echo __( 'External booking', ST_TEXTDOMAIN ); ?>"
                           href='<?php echo get_post_meta( $post_id, 'st_rental_external_booking_link', true ) ?>'>
                            <?php esc_html_e('Book Now','traveler') ?>
                        </a>
                        <?php
                        $return = ob_get_clean();
                    }
                } else {
                    $return = TravelerObject::get_book_btn();
                }

                return apply_filters( 'rental_external_booking_submit', $return );
            }

            static function listTaxonomy()
            {
                $terms = get_object_taxonomies( 'rental_room', 'objects' );
                if ( !is_wp_error( $terms ) and !empty( $terms ) ) {
                    foreach ( $terms as $key => $val ) {
                        $listTaxonomy[ $val->labels->name ] = $key;
                    }

                    return $listTaxonomy;
                }

            }

            /** from 1.1.7*/
            static function get_taxonomy_and_id_term_tour()
            {
                $list_taxonomy = st_list_taxonomy( 'st_rental' );
                $list_id_vc    = [];
                $param         = [];
                foreach ( $list_taxonomy as $k => $v ) {
                        $param[]                       = [
                            "type"       => "st_checkbox",
                            "holder"     => "div",
                            "heading"    => $k,
                            "param_name" => "id_term_" . $v,
                            'stype' => 'list_terms',
                            'sparam' => $v,
                            'dependency' => [
                                'element' => 'sort_taxonomy',
                                'value'   => [ $v ]
                            ],
                        ];
                        $list_value                    = "";
                        $list_id_vc[ "id_term_" . $v ] = "";
                }

                return [
                    "list_vc"    => $param,
                    'list_id_vc' => $list_id_vc
                ];
            }

            static function is_groupday($post_id){
	            if(empty($post_id))
		            $post_id = get_the_ID();

	            $check = get_post_meta($post_id, 'allow_group_day', true);
	            if(empty($check)){
		            return false;
	            }else{
	                if($check == 'on'){
	                    return true;
                    }else{
	                    return false;
                    }
                }
            }

            static function inst()
            {
                if ( !self::$_instance ) {
                    self::$_instance = new self();
                }

                return self::$_instance;
            }
        }

        STRental::inst()->init();
    }
