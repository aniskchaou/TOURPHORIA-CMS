<?php
/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Class STCars
 *
 * Created by ShineTheme
 *
 */

if (!class_exists('STCars')) {
    class STCars extends TravelerObject
    {
        static $_inst;

        public $post_type = "st_cars";
        /**
         * @var string
         * @since 1.1.7
         */
        protected $template_folder = 'cars';

        function __construct($hotel_id = false)
        {
            $this->hotel_id = $hotel_id;


        }

        public function __get($name){

            switch ($name){
                case "orderby":
                    return [
                        'new' => [
                            'key' => 'new',
                            'name' => __('New', ST_TEXTDOMAIN)
                        ],
                        'price_asc' => [
                            'key' => 'price_asc',
                            'name' => __('Price ', ST_TEXTDOMAIN) . ' (<i class="fa fa-long-arrow-up"></i>)'
                        ],
                        'price_desc' => [
                            'key' => 'price_desc',
                            'name' => __('Price ', ST_TEXTDOMAIN) . ' (<i class="fa fa-long-arrow-down"></i>)'
                        ],
                        'name_a_z' => [
                            'key' => 'name_a_z',
                            'name' => __('Name (A-Z)', ST_TEXTDOMAIN)
                        ],
                        'name_z_a' => [
                            'key' => 'name_z_a',
                            'name' => __('Name (Z-A)', ST_TEXTDOMAIN)
                        ],

                    ];
                    break;
            }
        }


        /**
         * @since 1.1.7
         *
         * @param $type
         *
         * @return string
         */
        function _get_post_type_icon($type)
        {
            return "fa fa-car";
        }

        /**
         *
         * @since 1.1.3
         * */
        static function get_cart_item_total($key, $cart_item)
        {
            $number = $cart_item['number'];

            $check_in_timestamp = $cart_item['data']['check_in_timestamp'];
            $check_out_timestamp = $cart_item['data']['check_out_timestamp'];

            $time = STCars::get_date_diff($check_in_timestamp, $check_out_timestamp);

            if (!$time) $time = 1;

            $info_price = STCars::get_info_price($key);
            $cars_price = $info_price['price'];

            $total_price = $cars_price * $time;


            if (!empty($cart_item['data']['selected_equipments'])) {
                $selected_equipments = $cart_item['data']['selected_equipments'];
                foreach ($selected_equipments as $v) {
                    switch ($v->price_unit) {
                        case "day":
                        case "per_day":
                            $day = STCars::get_date_diff($check_in_timestamp, $check_out_timestamp, $v->price_unit);
                            $total_price += $v->price * $day;
                            break;
                        case "hour":
                        case "per_hour":

                            $hour = STCars::get_date_diff($check_in_timestamp, $check_out_timestamp, $v->price_unit);
                            $total_price += $v->price * $hour;
                            break;
                        default:
                            $total_price += $v->price;
                            break;
                    }
                }
            }

            return $total_price * $number;
        }

        /**
         *
         * @update 1.1.3
         *
         * */
        function init()
        {

            if (!$this->is_available()) return;

            parent::init();


            //Filter change layout of cars detail if choose in metabox
            add_filter('st_cars_detail_layout', [$this, 'custom_cars_layout']);

            // price cars
            add_action('wp_ajax_st_price_cars', [$this, 'st_price_cars_func']);
            add_action('wp_ajax_nopriv_st_price_cars', [$this, 'st_price_cars_func']);

            //custom search cars template
            add_filter('template_include', [$this, 'choose_search_template']);
            //add Widget Area
            add_action('widgets_init', [$this, 'add_sidebar']);
            //Sidebar Pos for SEARCH
            add_filter('st_cars_sidebar', [$this, 'change_sidebar']);

            // ajax add_type_widget
            add_action('wp_ajax_add_type_widget', [$this, 'add_type_widget_func']);
            add_action('wp_ajax_nopriv_add_type_widget', [$this, 'add_type_widget_func']);

            // ajax load_list_taxonomy
            add_action('wp_ajax_load_list_taxonomy', [$this, 'load_list_taxonomy_func']);
            add_action('wp_ajax_nopriv_load_list_taxonomy', [$this, 'load_list_taxonomy_func']);

            //Filter the search hotel
            //add_action('pre_get_posts',array($this,'change_search_cars_arg'));


            //$this->init_metabox();

            add_action('wp', [$this, 'cars_add_to_cart'], 20);

            // add_filter( 'posts_where' , array( $this , '_alter_search_query' ) );

            add_action('st_after_checkout_fields', [$this, 'add_checkout_fields']);

            //add_filter( 'st_checkout_form_validate' , array( $this , 'add_validate_fields' ) );

            add_action('st_after_save_order_item', [$this, 'save_extra_fields'], 10, 3);

            //Save car Review Stats
            add_action('comment_post', [$this, 'st_cars_save_review_stats']);

            //Reduce total stats of posts after comment_delete
            add_action('delete_comment', [$this, 'st_cars_save_post_review_stats']);

            // Change cars review arg
            add_filter('st_cars_wp_review_form_args', [$this, 'comment_args'], 10, 2);


            add_action('wp_enqueue_scripts', [$this, 'add_script']);

            add_filter('st_search_preload_page', [$this, '_change_preload_search_title']);

            //add_action('st_after')

            //add_filter('st_data_custom_price',array($this,'_st_data_custom_price'));

            // Woocommerce cart item information
            add_action('st_wc_cart_item_information_st_cars', [$this, '_show_wc_cart_item_information']);
            add_action('st_wc_cart_item_information_btn_st_cars', [$this, '_show_wc_cart_item_information_btn']);

            add_action('st_before_cart_item_st_cars', [$this, '_show_wc_cart_post_type_icon']);

            //add_filter( 'st_add_to_cart_item_st_cars' , array( $this , '_deposit_calculator' ) , 10 , 2 );

            /**
             * Filter Class Icon
             *
             * @since 1.4.7
             *
             * author: quandq
             */
            add_filter('st_post_type_' . $this->post_type . '_icon', [$this, '_change_icon']);

            //xsearch Load post cars filter ajax
            add_action('wp_ajax_st_filter_cars_ajax', [$this, 'st_filter_cars_ajax']);
            add_action('wp_ajax_nopriv_st_filter_cars_ajax', [$this, 'st_filter_cars_ajax']);
            add_filter('car_external_booking_submit', array($this, '__addSendMessageButton'));
        }

        public function __addSendMessageButton($return){
	        $res = '';
	        if(st_owner_post()) {
		        $post_id = get_the_ID();
		        if ( STInput::request( 'post_id' ) ) {
			        $post_id = STInput::request( 'post_id' );
		        }
		        $car_external_booking = get_post_meta( $post_id, 'st_car_external_booking', "off" );

		        if ( $car_external_booking == 'off' ) {
			        $res = st_button_send_message(get_the_ID());
		        }
	        }
	        return $return.$res;
        }

        public function st_filter_cars_ajax()
        {
            $page_number = STInput::get('page');
            $st_style = STInput::get('layout');
            $orderby = STInput::get('orderby');

            global $wp_query , $st_search_query ;

            $cars = $this;
	        $cars->alter_search_query();

            set_query_var('paged', $page_number);

            $paged = $page_number;

            $args = array
            (
                'post_type' => 'st_cars' ,
                's'         => '' ,
                'post_status' => array('publish'),
                'paged'     => $paged
            );

            query_posts($args);

            $st_search_query = $wp_query;

            if($wp_query->max_num_pages < $paged){
                $result = array(
                    'content' => '<h3 class="ajax-filter-not-found">'. __('No car found', ST_TEXTDOMAIN) .'</h3>',
                    'pag' => '',
                    'count' => '',
                    'page' => 1
                );
                echo json_encode($result);
                die;
            }

            if($orderby == 'featured') {
                $st_search_query->set('meta_key', 'is_featured');
                $st_search_query->set('orderby', 'meta_value');
                $st_search_query->set('order', 'DESC');
            }
	        $cars->remove_alter_search_query();
            $current_page = get_query_var('paged' );

            $total_posts =  $wp_query->found_posts;

            if( $total_posts == 0  && $current_page >= 2){
                global $wp_rewrite;
                $link = add_query_arg();
                if ($wp_rewrite->using_permalinks()){
                    $link = preg_replace("/page\/(\d)\//", "page/1/", $link);
                }else{
                    $link = add_query_arg('paged', 1);
                }
                wp_redirect( $link );
            }

            if($st_search_query){
                $query=$st_search_query;
            }else $query=$wp_query;

            ob_start();

            $content="";
            if($query->have_posts()) {
                while( $query->have_posts() ) {
                    $query->the_post();
                    if($st_style == '1'){
                        $content .=st()->load_template('cars/elements/loop/loop-1');
                    }
                    if($st_style == '2'){
                        $content .=  st()->load_template('cars/elements/loop/loop-2');
                    }
                }
            }else{
                //echo '<div class="alert alert-warning">'.__("There are no available cars for this location, time and/or date you selected.",ST_TEXTDOMAIN).'</div>';
            }

            if($st_style == '1'){
                echo '<ul class="booking-list loop-cars style_list">'.$content.'</ul>';
            }
            if($st_style == '2'){
                echo '<div class="row row-wrap">'.$content.'</div>';
            }

            if(!$query->found_posts){
                echo '<h3 class="ajax-filter-not-found">'. __('No car found', ST_TEXTDOMAIN) .'</h3>';
            }

            $ajax_filter_content = ob_get_contents();
            ob_clean();
            ob_end_flush();

            ob_start();
            ?>
            <p>
                <small><?php echo balanceTags($cars->get_result_string())?>. &nbsp;&nbsp;
                    <?php
                    if($query->found_posts):
                        set_query_var('paged', $page_number);
                        esc_html_e('Showing','traveler');
                        if(get_query_var( 'paged' )) {
                            $page = get_query_var( 'paged' );
                        } else if(get_query_var( 'page' )) {
                            $page = get_query_var( 'page' );
                        } else {
                            $page = 1;
                        }

                        $posts_per_page=get_query_var('posts_per_page');
                        if(!$page) $page=1;

                        $last=$posts_per_page*($page);

                        if($last>$query->found_posts) $last=$query->found_posts;
                        echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                    endif;
                    ?>
                </small>
            </p>
            <div class="row">
                <?php
                TravelHelper::paging($query); ?>
            </div>
            <?php
            $ajax_filter_pag = ob_get_contents();
            ob_clean();
            ob_end_flush();

            $count = balanceTags($cars->get_result_string());

            $result = array(
                'content' => $ajax_filter_content,
                'pag' => $ajax_filter_pag,
                'count' => $count,
                'page' => $page_number
            );

            echo json_encode($result);
            die;
        }

        function _change_icon($icon)
        {
            return $icon = 'fa-car';
        }

        function get_near_by($post_id = false, $range = 20, $limit = 5)
        {
            $this->post_type = 'st_cars';

            return parent::get_near_by($post_id, $range, $limit = 5);
        }

        /**
         *
         *
         *
         *
         * */
        function _show_wc_cart_post_type_icon()
        {
            echo '<span class="booking-item-wishlist-title"><i class="fa fa-car"></i> ' . __('car', ST_TEXTDOMAIN) . ' <span></span></span>';
        }

        /**
         *
         * Show cart item information for hotel booking
         *
         * @since 1.1.1
         * */

        function _show_wc_cart_item_information($st_booking_data = [])
        {
            echo st()->load_template('cars/wc_cart_item_information', false, ['st_booking_data' => $st_booking_data]);
        }

        function _st_data_custom_price()
        {
            return ['title' => 'Price Custom Settings', 'post_type' => 'st_cars'];
        }

        function _change_preload_search_title($return)
        {
            if (get_query_var('post_type') == 'st_cars' || is_page_template('template-cars-search.php')) {
                $return = __(" Cars in %s", ST_TEXTDOMAIN);

                if (STInput::get('location_id')) {
                    $return = sprintf($return, get_the_title(STInput::get('location_id')));
                } elseif (STInput::get('location_name')) {
                    $return = sprintf($return, STInput::get('location_name'));
                } elseif (STInput::get('pick-up')) {
                    $rs = STInput::get('pick-up');
                    if (STInput::get('drop-off')) {
                        $rs .= __(" to ", ST_TEXTDOMAIN) . STInput::get('drop-off');
                    }
                    $return = sprintf($return, $rs);
                } else {
                    $return = __(" Cars", ST_TEXTDOMAIN);
                }

                $return .= '...';
            }


            return $return;
        }

        function _is_slot_available($post_id, $check_in, $check_out)
        {
            $check_in = date('Y-m-d H:i:s', strtotime($check_in));
            $check_out = date('Y-m-d H:i:s', strtotime($check_out));

            global $wpdb;

            $query = "
                SELECT count(booked_id) as total_booked from (
                SELECT st_meta6.meta_value as booked_id ,st_meta2.meta_value as check_in,st_meta3.meta_value as check_out
                                         FROM {$wpdb->posts}
                                                JOIN {$wpdb->postmeta}  as st_meta2 on st_meta2.post_id={$wpdb->posts}.ID and st_meta2.meta_key='check_in'
                                                JOIN {$wpdb->postmeta}  as st_meta3 on st_meta3.post_id={$wpdb->posts}.ID and st_meta3.meta_key='check_out'
                                                JOIN {$wpdb->postmeta}  as st_meta6 on st_meta6.post_id={$wpdb->posts}.ID and st_meta6.meta_key='item_id'
                                                JOIN {$wpdb->postmeta}  as st_meta7 on st_meta7.post_id={$wpdb->posts}.ID and st_meta7.meta_key='status'
                                                WHERE {$wpdb->posts}.post_type='st_order'
                                                AND st_meta6.meta_value={$post_id}
                                                 AND st_meta7.meta_value='complete'
                                          GROUP BY {$wpdb->posts}.id HAVING  (

                                                    ( CAST(st_meta2.meta_value AS DATE)<'{$check_in}' AND  CAST(st_meta3.meta_value AS DATE)>'{$check_in}' )
                                                    OR ( CAST(st_meta2.meta_value AS DATE)>='{$check_in}' AND  CAST(st_meta2.meta_value AS DATE)<='{$check_out}'))) as object_booked
                ";


            $total_booked = (int)$wpdb->get_var($query);

            $total = (int)get_post_meta($post_id, 'number_car', true);

            if ($total > $total_booked)
                return true;
            else return false;

        }


        /**
         *
         *
         * @update 1.1.3
         * */
        function add_script()
        {
            if (is_singular('st_cars')) {
                // add js validate for change location and date
                // Validate required field
                $change_location_date_box = $this->get_search_fields_box();
                $field_types = $this->get_search_fields_name();

                $q = [];

                if (!empty($change_location_date_box) and is_array($change_location_date_box)) {
                    foreach ($change_location_date_box as $key => $value) {
                        if (!empty($value['is_required']) and $value['is_required'] == 'on' and isset($field_types[$value['field_atrribute']])) {
                            $field_name = isset($field_types[$value['field_atrribute']]['field_name']) ? $field_types[$value['field_atrribute']]['field_name'] : false;

                            if ($field_name) {
                                if (is_array($field_name)) {
                                    if (!empty($field_name)) {
                                        foreach ($field_name as $v) {
                                            $q[] = $v;
                                        }
                                    }
                                }

                                if (is_string($field_name)) {
                                    $q[] = $field_name;
                                }
                            }
                        }
                    }
                }

                wp_localize_script('jquery', 'st_car_booking_validate', ['required' => $q]);
                wp_localize_script('jquery', 'st_single_car', [
                    'check_booking_days_included' => self::check_booking_days_included()
                ]);
            }
        }

        function save_extra_fields($order_id, $key, $value)
        {
            if (STInput::post('driver_name')) {
                update_post_meta($order_id, 'driver_name', STInput::post('driver_name'));
            }
            if (STInput::post('driver_age')) {
                update_post_meta($order_id, 'driver_age', STInput::post('driver_age'));
            }

        }

        /**
         *
         *
         * @since 1.0.9
         * */
        function _check_booking_period($validate)
        {

            if ($this->check_is_car_booking()) {
                $car_id = '';

                $today = strtotime(date('m/d/Y'));
                $pick_up = $today;

                $cart = STCart::get_cart_item();
            }


            return $validate;

        }

        function add_validate_fields($validate)
        {
            if ($this->check_is_car_booking()) {
                $validator = new STValidate();

                $validator->set_rules([
                    [
                        'field' => 'driver_name',
                        'label' => 'Driver\'s Name',
                        'rules' => 'required|trim|strip_tags'
                    ],
                    [
                        'field' => 'driver_age',
                        'label' => 'Driver\'s Age',
                        'rules' => 'required|trim|strip_tags'
                    ]
                ]);

                if (!$validator->run()) {
                    $validate = false;
                    STTemplate::set_message($validator->error_string(), 'danger');
                }
            }

            return $validate;
        }

        function check_is_car_booking()
        {
            $item = STCart::get_cart_item();
            if (isset($item['key']) and get_post_type($item['key']) == 'st_cars') {
                return true;
            }

            return false;
        }

        function add_checkout_fields()
        {
            $st_is_booking_modal = apply_filters('st_is_booking_modal', false);
            if ($st_is_booking_modal and is_singular('st_cars')) {
                echo st()->load_template('cars/checkout_fields');
            } elseif (!$st_is_booking_modal and $this->check_is_car_booking()) {
                echo st()->load_template('cars/checkout_fields');
            }


        }

        /**
         * @return array
         */
        public function getOrderby()
        {
            return $this->__get('orderby');
        }


        function cars_add_to_cart()
        {
            if (STInput::post('action') == 'cars_add_to_cart') {
                if ($this->do_add_to_cart()) {
                    $link = STCart::get_cart_link();
                    $link = apply_filters('st_car_added_cart_redirect_link', $link);
                    wp_safe_redirect($link);
                    die;
                }
            }
        }

        function get_location_from_to($post_id)
        {
            global $wpdb;
            $table = $wpdb->prefix . 'st_location_relationships';

            $sql = "SELECT location_from, location_to FROM {$table} WHERE post_id = {$post_id} AND location_type = 'location_from_to'";

            $results = $wpdb->get_results($sql, ARRAY_A);

            return $results;
        }

        /**
         * @since  1.0.9
         * @update 1.1.3
         **/
        function do_add_to_cart()
        {

            $pass_validate = true;

            $item_id = STInput::request('item_id', '');
            if ($item_id <= 0 || get_post_type($item_id) != 'st_cars') {
                STTemplate::set_message(__('This car is not available.', ST_TEXTDOMAIN), 'danger');
                $pass_validate = FALSE;

                return false;
            }

            $post_origin = TravelHelper::post_origin($item_id, 'st_cars');

            $number = 1;

            // Validate required field
            if (!isset($_POST['booking_by']) || $_POST['booking_by'] != 'partner') {
                $change_location_date_box = $this->get_search_fields_box();
                $field_types = $this->get_search_fields_name();

                if (!empty($change_location_date_box)) {
                    $message = '';
                    foreach ($change_location_date_box as $key => $value) {
                        if (isset($field_types[$value['field_atrribute']]) and $value['is_required'] == 'on') {
                            $field_name = isset($field_types[$value['field_atrribute']]['field_name']) ? $field_types[$value['field_atrribute']]['field_name'] : false;

                            if ($field_name) {
                                if (is_array($field_name)) {
                                    foreach ($field_name as $v) {
                                        if (!STInput::request($v)) {
                                            $message .= sprintf(__('%s is required', ST_TEXTDOMAIN), $value['title']) . '<br>';
                                            $pass_validate = false;
                                        }
                                    }
                                } elseif (is_string($field_name)) {

                                    if (!STInput::request($field_name)) {
                                        $message .= sprintf(__('%s is required', ST_TEXTDOMAIN), $value['title']) . '<br>';
                                        $pass_validate = false;
                                    }
                                }

                            }
                        }
                    }

                    if ($message) {
                        $message = substr($message, 0, -4);
                        STTemplate::set_message($message, 'danger');
                    }
                }
            }

            $check_in = '';
            $check_in_n = '';
            $check_in_time = '';
            if (isset($_REQUEST['pick-up-date']) && !empty($_REQUEST['pick-up-date'])) {
                $check_in = TravelHelper::convertDateFormat($_REQUEST['pick-up-date']);
                $check_in_n = $check_in;
            }
            if (isset($_REQUEST['pick-up-time']) && !empty($_REQUEST['pick-up-time'])) {
                $check_in .= ' ' . $_REQUEST['pick-up-time'];
                $check_in_time = $_REQUEST['pick-up-time'];
            }

            $check_in = date('Y-m-d H:i:s', strtotime($check_in));

            $check_out = '';
            $check_out_n = '';
            $check_out_time = '';
            if (isset($_REQUEST['drop-off-date']) && !empty($_REQUEST['drop-off-date'])) {
                $check_out = TravelHelper::convertDateFormat($_REQUEST['drop-off-date']);
                $check_out_n = $check_out;
            }
            if (isset($_REQUEST['drop-off-time']) && !empty($_REQUEST['drop-off-time'])) {
                $check_out .= ' ' . $_REQUEST['drop-off-time'];
                $check_out_time = $_REQUEST['drop-off-time'];
            }

            $check_out = date('Y-m-d H:i:s', strtotime($check_out));

            $location_id_pick_up = STInput::request('location_id_pick_up', '');
            $location_id_drop_off = STInput::request('location_id_drop_off', '');

            $pick_up = get_the_title($location_id_pick_up);
            $drop_off = !empty($location_id_drop_off) ? get_the_title($location_id_drop_off) : $pick_up;
            if (isset($_REQUEST['location_id_pick_up']) && !empty($_REQUEST['location_id_pick_up']) && isset($_REQUEST['location_id_drop_off']) && !empty($_REQUEST['location_id_drop_off'])) {

                /*$location_type = get_post_meta( $item_id, 'location_type', true);
                if( !$location_type ) $location_type = 'multi_location';

                if( $location_type == 'multi_location'){*/
                $locations = get_post_meta($item_id, 'multi_location', true);
                if (empty($locations)) {
                    STTemplate::set_message(__('This car is not set location data.', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if (!empty($locations) && !is_array($locations)) {
                    $locations = explode(',', $locations);
                }

                $location_id_pick_up = intval(STInput::request('location_id_pick_up', '0'));
                $location_id_drop_off = intval(STInput::request('location_id_drop_off', '0'));

                $pickup_country = get_post_meta($location_id_pick_up, 'location_country', true);
                $dropoff_country = get_post_meta($location_id_drop_off, 'location_country', true);

                $in_location = false;
                $location_without_s = [];
                foreach ($locations as $location) {
                    $location = str_replace("_", "", $location);
                    array_push($location_without_s, $location);

                    /**
                     * Remove this check
                     * @version 2.2.1
                     */
                    /*$country = get_post_meta($location, 'location_country', true);
                    if ($pickup_country == $country && $dropoff_country == $country) {
                        $in_location = true;
                        break;
                    }*/
                    /**
                     * End remove this check
                     */

                }

                //Check car with current location
                if(!empty($location_without_s)){
                    if(!in_array($location_id_pick_up, $location_without_s)){
                        STTemplate::set_message(__('The pickup location is not match with car location.', ST_TEXTDOMAIN), 'danger');
                        $pass_validate = false;

                        return false;
                    }
                }

                //if (!$in_location) {
                //    STTemplate::set_message(sprintf(__('This car is not lease in %s.', ST_TEXTDOMAIN), get_the_title($location_id_pick_up)), 'danger');

                //    $pass_validate = false;

                 //   return false;
                //}
                if (!$pickup_country) {
                    STTemplate::set_message(__('The \'country\' field not set for the \'' . get_the_title($location_id_pick_up) . '\'', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if (!$dropoff_country) {
                    STTemplate::set_message(__('The \'country\' field not set for \'' . get_the_title($location_id_drop_off) . '\'', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if ($pickup_country != $dropoff_country) {
                    STTemplate::set_message(__('The country is not same', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }

                $unit = st()->get_option('cars_price_unit', 'day');
                if ($unit == "distance" and $location_id_pick_up == $location_id_drop_off) {
                    STTemplate::set_message(__('Pick-up and Drop-off must be difference.', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;

                }
            }

            if (!empty($_REQUEST['st_country_up']) && !empty($_REQUEST['st_country_off'])) {
                global $wpdb;

                $st_country = $wpdb->get_var("SELECT country FROM {$wpdb->prefix}st_glocation WHERE post_id = {$item_id} LIMIT 0,1");

                $st_country_up = sanitize_title(STInput::request('st_country_up', ''));
                $st_country_off = sanitize_title(STInput::request('st_country_off', ''));

                if (($st_country != $st_country_up) || ($st_country != $st_country_off) || ($st_country_up != $st_country_off)) {
                    STTemplate::set_message(__('The country is not same', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }

            }
            $number_distance = STPrice::getDistanceByCar($location_id_pick_up, $location_id_drop_off);

            $today = date('m/d/Y');


            $booking_period = intval(get_post_meta($post_origin, 'cars_booking_period', true));
            $booking_min_day = intval(get_post_meta($post_origin, 'cars_booking_min_day', true));
            $booking_min_hour = intval(get_post_meta($post_origin, 'cars_booking_min_hour', true));

            if (empty($booking_period) || $booking_period <= 0) $booking_period = 0;
            $check_in_timestamp = '';
            $check_out_timestamp = '';
            if (!empty($check_in_n) && !empty($check_out_n)) {
                $period = STDate::dateDiff($today, $check_in_n);

                $compare = TravelHelper::dateCompare($today, $check_in_n);
                $check_in_timestamp = strtotime($check_in);
                $check_out_timestamp = strtotime($check_out);

                if ($check_in_timestamp - $check_out_timestamp >= 0) {
                    STTemplate::set_message(__('The drop off datetime is later than the pick up datetime.', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if ($compare < 0) {
                    STTemplate::set_message(__('You can not set check-in date in the past', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if ($period < $booking_period) {
                    STTemplate::set_message(sprintf(__('This car allow minimum booking is %d day(s)', ST_TEXTDOMAIN), $booking_period), 'danger');
                    $pass_validate = false;

                    return false;
                }
                $unit = st()->get_option('cars_price_unit', 'day');
                if ($unit == 'day' and $booking_min_day and $booking_min_day > self::get_date_diff($check_in_timestamp, $check_out_timestamp)) {
                    STTemplate::set_message(sprintf(__('Please book at least %d day(s) in total', ST_TEXTDOMAIN), $booking_min_day), 'danger');
                    $pass_validate = false;

                    return false;
                }
                if ($unit == 'hour' and $booking_min_hour and $booking_min_hour > self::get_date_diff($check_in_timestamp, $check_out_timestamp)) {
                    STTemplate::set_message(sprintf(__('Please book at least %d hour(s) in total', ST_TEXTDOMAIN), $booking_min_hour), 'danger');
                    $pass_validate = false;

                    return false;
                }


            }
            if ($check_in_timestamp > 0 && $check_out_timestamp > 0) {
                if (!CarHelper::_get_car_cant_order_by_id($post_origin, $check_in_timestamp, $check_out_timestamp)) {
                    STTemplate::set_message(__('This car is full order', ST_TEXTDOMAIN), 'danger');
                    $pass_validate = false;

                    return false;
                }
            }

            $selected_equipments = json_decode(str_ireplace("\\", '', STInput::request('selected_equipments', '')));
            $selected_destination = json_decode(str_ireplace("\\", '', STInput::request('selected_destination', '')));
            $info_price = STCars::get_info_price($post_origin, strtotime($check_in), strtotime($check_out));
            $price_unit = $info_price['price'];
            $item_price = floatval(get_post_meta($post_origin, 'cars_price', true));
            if ($item_price < 0) $item_price = 0;

            $price_equipment = STPrice::getPriceEuipmentCar($selected_equipments, $check_in_timestamp, $check_out_timestamp);
            $price_destination = STPrice::getPriceEuipmentCar($selected_destination, $check_in_timestamp, $check_out_timestamp);
            $sale_price = STPrice::getSaleCarPrice($post_origin, $item_price, strtotime($check_in), strtotime($check_out), $location_id_pick_up, $location_id_drop_off);
            $car_sale_price = STPrice::get_car_price_by_number_of_day_or_hour($post_origin, $item_price, strtotime($check_in), strtotime($check_out));
            $discount_rate = STPrice::get_discount_rate($post_origin, strtotime($check_in));
            $numberday = $numberday = STCars::get_date_diff(strtotime($check_in), strtotime($check_out), st()->get_option('cars_price_unit', 'day'));
            $data = [
                'check_in' => $check_in_n,
                'check_out' => $check_out_n,
                'check_in_time' => $check_in_time,
                'check_out_time' => $check_out_time,
                'check_in_timestamp' => strtotime($check_in),
                'check_out_timestamp' => strtotime($check_out),
                'location_id_pick_up' => $location_id_pick_up,
                'location_id_drop_off' => $location_id_drop_off,
                'pick_up' => STInput::request('st_google_location_pickup', $pick_up),
                'drop_off' => STInput::request('st_google_location_dropoff', $drop_off),
                'ori_price' => $sale_price + $price_equipment,
                'item_price' => $item_price,
                'sale_price' => $car_sale_price,
                'numberday' => $numberday,
                'price_equipment' => $price_equipment,
                'data_equipment' => $selected_equipments,
                'price_destination' => $price_destination,
                'data_destination' => $selected_destination,
                'commission' => TravelHelper::get_commission($item_id),
                'discount_rate' => $discount_rate,
                'distance' => $number_distance
            ];
            $pass_validate = apply_filters('st_car_add_cart_validate', $pass_validate, $item_id, $number, $price_unit, $data);

            if ($pass_validate) {
                STCart::add_cart($item_id, $number, $price_equipment + $sale_price, $data);
            }

            return $pass_validate;

        }


        function get_cart_item_html($item_id = false)
        {
            return st()->load_template('cars/cart_item_html', null, ['item_id' => $item_id]);
        }

        /**
         * Change location and date box
         *
         *
         * */
        function get_search_fields_box()
        {
            $fields = st()->get_option('car_search_fields_box');

            return $fields;
        }

        function get_search_fields()
        {
            $fields = st()->get_option('car_search_fields');

            return $fields;
        }

        function _get_join_query($join)
        {
            if (!TravelHelper::checkTableDuplicate('st_cars')) return $join;

            global $wpdb;

            $table = $wpdb->prefix . 'st_cars';

            $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";

            return $join;
        }

        public function get_where_location_from_to($pickup, $dropoff, $where)
        {
            global $wpdb;
            $table_nested = $wpdb->prefix . 'st_location_nested';
            $ns = new Nested_set();
            $ns->setControlParams($table_nested);
            $locations = [];

            $node = $ns->getNodeWhere("location_id = " . (int)$pickup);

            if (!empty($node)) {
                $leftval = (int)$node['left_key'];
                $rightval = (int)$node['right_key'];
                $node_childs = $ns->getNodesWhere("left_key >= " . $leftval . " AND right_key <= " . $rightval);
                if (!empty($node_childs)) {
                    foreach ($node_childs as $item) {
                        $locations[] = (int)$item['location_id'];
                    }
                } else {
                    $locations[] = (int)$node['location_id'];
                }
            }
            $where_location = "";
            if (!empty($locations)) {
                $where_location .= " AND location_from IN (";
                $string = "";
                foreach ($locations as $location) {

                    $string .= "'" . $location . "',";
                }
                $string = substr($string, 0, -1);
                $where_location .= $string . ")";
            }

            $string = " AND {$wpdb->prefix}posts.ID IN (SELECT DISTINCT
                {$wpdb->prefix}st_location_relationships.post_id
                FROM
                    {$wpdb->prefix}st_location_relationships
                LEFT JOIN {$wpdb->prefix}postmeta AS mt ON (
                    mt.post_id = {$wpdb->prefix}st_location_relationships.post_id
                    AND mt.meta_key = 'location_type'
                )
                WHERE
                    ((
                        mt.post_id IS NULL
                        {$where_location}
                    )
                OR (
                    (
                        (
                            mt.meta_value = 'multi_location'
                            AND location_from = {$pickup}
                            AND location_type = 'multi_location'
                        )
                        OR (
                            mt.meta_value = 'check_in_out'
                            AND location_from = {$pickup}
                            AND location_to = {$dropoff}
                            AND location_type = 'location_from_to'
                        )
                    )
                ))
            AND post_type = 'st_cars')";

            $where .= $string;

            return $where;
        }

        function _get_where_query($where)
        {

            if (!TravelHelper::checkTableDuplicate('st_cars')) return $where;

            global $wpdb, $st_search_args;
            if (!$st_search_args) $st_search_args = $_REQUEST;
            /**
             * Merge data with element args with search args
             * @since  1.2.5
             * @author quandq
             */


            if (!empty($st_search_args['st_location'])) {
                if (empty($st_search_args['only_featured_location']) or $st_search_args['only_featured_location'] == 'no')
                    $st_search_args['location_id_pick_up'] = $st_search_args['st_location'];
            }
            if (isset($st_search_args['location_id_pick_up']) && !empty($st_search_args['location_id_pick_up'])) {
                $pickup = $st_search_args['location_id_pick_up'];
                $where = TravelHelper::_st_get_where_location($pickup, ['st_cars'], $where);
            } elseif (isset($st_search_args['location_id']) && !empty($st_search_args['location_id'])) {
                $pickup = $st_search_args['location_id'];
                $where = TravelHelper::_st_get_where_location($pickup, ['st_cars'], $where);
            } elseif (isset($_REQUEST['location_id']) && !empty($_REQUEST['location_id'])) {
                $location_id = (int)STInput::request('location_id', '');
                $where = TravelHelper::_st_get_where_location($location_id, ['st_cars'], $where);
            } elseif (!empty($_REQUEST['location_name'])) {
                $location_name = STInput::request('location_name', '');

                $ids_location = TravelerObject::_get_location_by_name($location_name);

                if (!empty($ids_location) && is_array($ids_location)) {
                    $where .= TravelHelper::_st_get_where_location($ids_location, ['st_hotel'], $where);
                } else {
                    $where .= " AND (tb.address LIKE '%{$location_name}%'";
                    $where .= " OR {$wpdb->prefix}posts.post_title LIKE '%{$location_name}%')";
                }
            }

            if (isset($_REQUEST['item_name']) && !empty($_REQUEST['item_name'])) {
                $item_name = STInput::request('item_name', '');
                $where .= " AND {$wpdb->prefix}posts.post_title LIKE '%{$item_name}%'";
            }

            if (isset($_REQUEST['item_id']) && !empty($_REQUEST['item_id'])) {
                $item_id = STInput::request('item_id', '');
                $where .= " AND ({$wpdb->prefix}posts.ID = '{$item_id}')";
            }
            if (isset($_REQUEST['pick-up-date']) && isset($_REQUEST['drop-off-date']) && !empty($_REQUEST['pick-up-date']) && !empty($_REQUEST['drop-off-date'])) {
                $pick_up_date = TravelHelper::convertDateFormat(STInput::request('pick-up-date'));

                $drop_off_date = TravelHelper::convertDateFormat(STInput::request('drop-off-date'));
                $pick_up_time = "";
                $drop_off_time = "";
                if (isset($_REQUEST['pick-up-time']) && !empty($_REQUEST['pick-up-time']))
                    $pick_up_time = STInput::request('pick-up-time', '12:00 PM');
                if (isset($_REQUEST['drop-off-time']) && !empty($_REQUEST['drop-off-time']))
                    $drop_off_time = STInput::request('drop-off-time', '12:00 PM');

                $check_in = $pick_up_date . ' ' . $pick_up_time;
                $check_in = strtotime(urldecode($check_in));

                $check_out = $drop_off_date . ' ' . $drop_off_time;
                $check_out = strtotime(urldecode($check_out));

                $list_date = CarHelper::_get_car_cant_order($check_in, $check_out);

                $where .= " AND ({$wpdb->posts}.ID NOT IN ({$list_date}))";

                $today = date('Y-m-d');
                $check_in = date('Y-m-d', $check_in);

                $period = STDate::dateDiff($today, $check_in);
                $where .= " AND (CAST(tb.cars_booking_period AS UNSIGNED) <= {$period})";
            }

            if (isset($_REQUEST['range']) and isset($_REQUEST['location_id_pick_up'])) {
                $range = STInput::get('range', '0;5');
                $rangeobj = explode(';', $range);
                $range_min = $rangeobj[0];
                $range_max = $rangeobj[1];
                $location_id = STInput::request('location_id_pick_up');
                $post_type = get_query_var('post_type');
                $map_lat = (float)get_post_meta($location_id, 'map_lat', true);
                $map_lng = (float)get_post_meta($location_id, 'map_lng', true);
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
             * Change Where for Element List
             * @since  1.2.5
             * @author quandq
             */

            if (!empty($st_search_args['only_featured_location']) and !empty($st_search_args['featured_location'])) {
                $featured = $st_search_args['featured_location'];
                if ($st_search_args['only_featured_location'] == 'yes' and is_array($featured)) {

                    if (is_array($featured) && count($featured)) {
                        $where .= " AND (";
                        $where_tmp = "";
                        foreach ($featured as $item) {
                            if (empty($where_tmp)) {
                                $where_tmp .= " tb.multi_location LIKE '%_{$item}_%'";
                            } else {
                                $where_tmp .= " OR tb.multi_location LIKE '%_{$item}_%'";
                            }
                        }
                        $featured = implode(',', $featured);
                        $where_tmp .= " OR tb.id_location IN ({$featured})";
                        $where .= $where_tmp . ")";
                    }
                }
            }

            return $where;
        }

        /**
         * @since 1.2.0
         */
        function get_unavailable_activity($check_in, $check_out = '', $adult_number = 1, $children_number = 0)
        {
            $check_in = strtotime($check_in);
            $check_out = strtotime($check_out);
            global $wpdb;
            $query = "SELECT
					post_id,
					{$wpdb->prefix}st_tours.max_people,
					{$wpdb->prefix}st_order_item_meta.adult_number+{$wpdb->prefix}st_order_item_meta.child_number+{$wpdb->prefix}st_order_item_meta.infant_number as total_booked
				FROM
					{$wpdb->prefix}st_tours
				JOIN {$wpdb->prefix}st_order_item_meta ON {$wpdb->prefix}st_tours.post_id = {$wpdb->prefix}st_order_item_meta.st_booking_id
				AND {$wpdb->prefix}st_order_item_meta.st_booking_post_type = 'st_tours'
				WHERE
					1 = 1
				AND
					(
						(
							{$wpdb->prefix}st_order_item_meta.check_in_timestamp <= {$check_in}
							AND {$wpdb->prefix}st_order_item_meta.check_out_timestamp >= {$check_out}
						)
						OR (
							{$wpdb->prefix}st_order_item_meta.check_in_timestamp >= {$check_in}
							AND {$wpdb->prefix}st_order_item_meta.check_in_timestamp <= {$check_out}
						)
					)
				OR post_id IN (
					SELECT
						post_id
					FROM
						{$wpdb->prefix}st_availability
					WHERE
						1 = 1
					AND (
						check_in >= {$check_in}
						AND check_out <= {$check_out}
						AND `status` = 'unavailable'
					)
					AND post_type='st_rental'
				)
				GROUP BY post_id
				HAVING total_booked < {$wpdb->prefix}st_tours.max_people
				LIMIT 0,500";
            $res = $wpdb->get_results($query, ARRAY_A);

            $r = [];
            if (!is_wp_error($res)) {
                foreach ($res as $key => $value) {
                    $r[] = $value['post_id'];
                }
            }

            return $r;

        }

        /**
         * @update 1.1.8
         */
        function _get_where_query_tab_location($where)
        {
            $location_id = get_the_ID();
            if (!TravelHelper::checkTableDuplicate('st_cars')) return $where;
            if (!empty($location_id)) {
                $where = TravelHelper::_st_get_where_location($location_id, ['st_cars'], $where);
            }

            return $where;
        }

        function alter_search_query()
        {
            add_action('pre_get_posts', [$this, 'change_search_cars_arg']);
            add_filter('posts_where', [$this, '_get_where_query']);
            add_filter('posts_join', [$this, '_get_join_query']);
            add_filter('posts_orderby', [$this, '_get_order_by_query']);
            add_filter('posts_fields', [$this, '_get_select_query']);
            add_filter('posts_clauses', [$this, '_get_query_clauses']);
        }

        function remove_alter_search_query()
        {
            remove_action('pre_get_posts', [$this, 'change_search_cars_arg']);
            remove_filter('posts_where', [$this, '_get_where_query']);
            remove_filter('posts_join', [$this, '_get_join_query']);
            remove_filter('posts_orderby', [$this, '_get_order_by_query']);
            remove_filter('posts_fields', [$this, '_get_select_query']);
            remove_filter('posts_clauses', [$this, '_get_query_clauses']);
        }

        /**
         *
         *
         * @since 1.2.4
         */
        function _get_query_clauses($clauses)
        {
            if (STAdminCars::check_ver_working() == false) return $clauses;
            $post_type = get_query_var('post_type');
            if ($post_type == 'st_cars') {
                global $wpdb;
                if (isset($_REQUEST['price_range'])) {
                    if (empty($clauses['groupby'])) {
                        $clauses['groupby'] = $wpdb->posts . ".ID";
                    }
                    $price = STInput::get('price_range', '0;0');
                    $priceobj = explode(';', $price);

                    $priceobj[0] = TravelHelper::convert_money_to_default($priceobj[0]);
                    $priceobj[1] = TravelHelper::convert_money_to_default($priceobj[1]);

                    $min_range = $priceobj[0];
                    $max_range = $priceobj[1];
                    $clauses['groupby'] .= " HAVING CAST(st_cars_price AS DECIMAL) >= {$min_range} AND CAST(st_cars_price AS DECIMAL) <= {$max_range}";
                }
            }

            return $clauses;
        }

        /**
         *
         *
         * @since 1.2.4
         */
        function _get_select_query($query)
        {
            if (STAdminCars::check_ver_working() == false) return $query;
            $post_type = get_query_var('post_type');

            if ($post_type == 'st_cars') {
                $query .= ",CASE
                                WHEN tb.is_sale_schedule = 'on'
                                                    AND tb.discount != 0 AND tb.discount != ''
                                                    AND tb.sale_price_from <= CURDATE() AND tb.sale_price_to >= CURDATE()
                                THEN
                                                    CAST(tb.cars_price AS DECIMAL) - ( CAST(tb.cars_price AS DECIMAL) / 100 ) * CAST(tb.discount AS DECIMAL)

                                WHEN tb.is_sale_schedule != 'on' AND tb.discount != 0 AND tb.discount != ''
                                THEN
                                                    CAST(tb.cars_price AS DECIMAL) - ( CAST(tb.cars_price AS DECIMAL) / 100 ) * CAST(tb.discount AS DECIMAL)

                                ELSE tb.cars_price

                           END AS st_cars_price";
            }

            return $query;
        }

        // since 1.2.3
        function _get_order_by_query($orderby)
        {
            if ($check = STInput::get('orderby')) {
                global $wpdb;
                switch ($check) {
                    case "price_asc":
                        $orderby = ' CAST(st_cars_price as DECIMAL) asc';
                        break;
                    case "price_desc":
                        $orderby = ' CAST(st_cars_price as DECIMAL) desc';
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
         *
         *
         * @update 1.1.1
         * */
        function change_search_cars_arg($query)
        {
            /**
             * Global Search Args used in Element list and map display
             * @since 1.2.5
             */
            global $st_search_args;
            if (!$st_search_args) $st_search_args = $_REQUEST;
            if(empty( $_REQUEST[ 'isajax' ] )) {
                if (is_admin() and empty($_REQUEST['is_search_map'])) return $query;
            }
            $post_type = get_query_var('post_type');
            if ($post_type == 'st_cars') {

                $query->set('author', '');
                if (STInput::get('item_name')) {
                    $query->set('s', STInput::get('item_name'));
                }

                $has_tax_in_element = [];
                if (is_array($st_search_args)) {
                    foreach ($st_search_args as $key => $val) {
                        if (strpos($key, 'taxonomies--') === 0 && !empty($val)) {
                            $has_tax_in_element[$key] = $val;
                        }
                    }
                }

                if (!empty($has_tax_in_element)) {
                    $tax_query = [];
                    foreach ($has_tax_in_element as $tax => $value) {
                        $tax_name = str_replace('taxonomies--', '', $tax);
                        if (!empty($value)) {
                            $value = explode(',', $value);
                            $tax_query[] = [
                                'taxonomy' => $tax_name,
                                'terms' => $value,
                                'operator' => 'IN',
                            ];
                        }

                    }
                    if (!empty($tax_query)) {
                        $query->set('tax_query', $tax_query);
                    }
                }

                $tax = STInput::get('taxonomy');
                if (!empty($tax) and is_array($tax)) {
                    $tax_query = [];
                    foreach ($tax as $key => $value) {
                        if ($value) {
                            $value = explode(',', $value);
                            if (!empty($value) and is_array($value)) {
                                foreach ($value as $k => $v) {
                                    if (!empty($v)) {
                                        $ids[] = $v;
                                    }
                                }
                            }
                            if (!empty($ids)) {
                                $tax_query[] = [
                                    'taxonomy' => $key,
                                    'terms' => $ids,
                                    //'COMPARE'=>"IN",
                                    'operator' => 'AND',
                                ];
                            }
                            $ids = [];
                        }
                    }
                    $query->set('tax_query', $tax_query);
                }

                $is_featured = st()->get_option('is_featured_search_car', 'off');
                if (!empty($is_featured) and $is_featured == 'on' and empty($st_search_args['st_orderby'])) {
                    $query->set('meta_key', 'is_featured');
                    $query->set('orderby', 'meta_value');
                    $query->set('order', 'DESC');
                }
                if ($is_featured == 'off' and STInput::get('orderby') and empty($st_search_args['st_orderby'])) {
                    //Default Sorting
                    $query->set('orderby', 'modified');
                    $query->set('order', 'desc');
                }

                $meta_query[] = [
                    'key' => 'number_car',
                    'value' => 0,
                    'compare' => ">",
                    'type ' => "NUMERIC",
                ];

                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'car_type',
                        'compare' => 'NOT EXISTS'
                    ),
                    array(
                        'key' => 'car_type',
                        'value' => 'normal'
                    )
                );

                /**
                 * Post In and Post Order By from Element
                 * @since  1.2.4
                 * @author dungdt
                 */
                if (!empty($st_search_args['st_ids'])) {
                    $query->set('post__in', explode(',', $st_search_args['st_ids']));
                    $query->set('orderby', 'post__in');
                }

                if (!empty($st_search_args['st_orderby']) and $st_orderby = $st_search_args['st_orderby']) {
                    if ($st_orderby == 'sale') {
                        $query->set('meta_key', 'cars_price');
                        $query->set('orderby', 'meta_value_num');
                    }
                    if ($st_orderby == 'featured') {
                        $query->set('meta_key', 'is_featured');
                        $query->set('orderby', 'meta_value');
                        $query->set('order', 'DESC');
                    }
                }
                if (!empty($st_search_args['sort_taxonomy']) and $sort_taxonomy = $st_search_args['sort_taxonomy']) {
                    if (isset($st_search_args["id_term_" . $sort_taxonomy])) {
                        $id_term = $st_search_args["id_term_" . $sort_taxonomy];
                        $tax_query[] = [
                            [
                                'taxonomy' => $sort_taxonomy,
                                'field' => 'id',
                                'terms' => explode(',', $id_term),
                                'include_children' => false
                            ],
                        ];
                    }
                }


                if (!empty($meta_query)) {
                    $query->set('meta_query', $meta_query);
                }
                if (!empty($tax_query)) {
                    $query->set('tax_query', $tax_query);
                }

            }
        }

        function add_type_widget_func()
        {
            $data_type = $_REQUEST['data_type'];
            $data_value = $_REQUEST['data_value'];
            $data_json = $_REQUEST['data_json'];
            $data_title_filter = $_REQUEST['title_filter'];

            $data_text = '<div><h4> - ' . $data_title_filter . '</h4></div>';

            if ($data_type == 'price') {
                $data_value == 'price';
            }

            if (!empty($data_json)) {

                $tmp_json = $data_json['data_json'];
                array_push($tmp_json, [
                    'title' => $data_title_filter,
                    'type' => $data_type,
                    'value' => $data_value
                ]);

                $data_return = [
                    'data_html' => $data_text,
                    'data_json' => $tmp_json
                ];

            } else {
                $tmp_json = [
                    [
                        'title' => $data_title_filter,
                        'type' => $data_type,
                        'value' => $data_value
                    ]
                ];
                $data_return = [
                    'data_html' => $data_text,
                    'data_json' => $tmp_json
                ];

            }
            echo json_encode($data_return);
            die();
        }

        function choose_search_template($template)
        {
            global $wp_query;
            $post_type = get_query_var('post_type');
            if ($wp_query->is_search && $post_type == 'st_cars') {
                return locate_template('search-cars.php');  //  redirect to archive-search.php
            }

            return $template;
        }

        function add_sidebar()
        {
            register_sidebar([
                'name' => __('Cars Search Sidebar 1', ST_TEXTDOMAIN),
                'id' => 'cars-sidebar',
                'description' => __('Widgets in this area will be shown on Cars', ST_TEXTDOMAIN),
                'before_title' => '<h4>',
                'after_title' => '</h4>',
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
            ]);

            register_sidebar([
                'name' => __('Cars Search Sidebar 2', ST_TEXTDOMAIN),
                'id' => 'cars-sidebar-2',
                'description' => __('Widgets in this area will be shown on Cars', ST_TEXTDOMAIN),
                'before_title' => '<h4>',
                'after_title' => '</h4>',
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
            ]);

        }

        function change_sidebar($sidebar = false)
        {
            return st()->get_option('cars_sidebar_pos', 'left');
        }


        function st_price_cars_func()
        {

            $price_total_item = $_REQUEST['price_total_item'];

            $form_data = STInput::request('form_data');
            $selected_equipments = $form_data['selected_equipments'];

            $check_in_timestamp = $form_data['check_in_timestamp'];
            $check_out_timestamp = $form_data['check_out_timestamp'];

            $car_item = $form_data['item_id'];

            $info_price = STCars::get_info_price($car_item);
            $cars_price = $info_price['price'];

            $price_total = self::get_rental_price($cars_price, $check_in_timestamp, $check_out_timestamp);


            $total_equipment_price = 0;
            //Equipment Caculator

            $selected_equipments = json_decode($selected_equipments);

            if (!empty($selected_equipments) and is_array($selected_equipments)) {
                foreach ($selected_equipments as $key => $value) {
                    switch ($value['price_unit']) {
                        case "per_day":
                            $diff = STDate::timestamp_diff_day($check_in_timestamp, $check_out_timestamp);
                            if (!$diff)
                                $diff = 1;
                            $total_equipment_price += (float)$value['price'] * $diff;

                            break;
                        case "per_hour":

                            $diff = STDate::timestamp_diff($check_in_timestamp, $check_out_timestamp);
                            if (!$diff)
                                $diff = 1;
                            $total_equipment_price += (float)$value['price'] * $diff;

                            break;
                        default:
                            $total_equipment_price += (float)$value['price'];
                            break;
                    }
                }
            }


            $price_total += $total_equipment_price;
            echo json_encode([
                'price_total_number' => $price_total,
                'price_total_text' => TravelHelper::format_money($price_total),
                'price_total_item_number' => $total_equipment_price,
                'price_total_item_text' => TravelHelper::format_money($total_equipment_price),
            ]);
            die();
        }

        function custom_cars_layout($old_layout_id)
        {
            if (is_singular('st_cars')) {
                $meta = get_post_meta(get_the_ID(), 'st_custom_layout', true);

                if ($meta) {
                    return $meta;
                }
            }

            return $old_layout_id;
        }

        function get_result_string()
        {
            global $wp_query, $st_search_query, $wpdb;
            if ($st_search_query) {
                $query = $st_search_query;
            } else $query = $wp_query;

            $result_string = $p1 = $p2 = $p3 = $p4 = '';
            if ($query->found_posts) {
                if ($query->found_posts > 1) {
                    $p1 = esc_html($query->found_posts) . __(' cars ', ST_TEXTDOMAIN);
                } else {
                    $p1 = esc_html($query->found_posts) . __(' car ', ST_TEXTDOMAIN);
                }
            } else {
                $p1 = __('No car found', ST_TEXTDOMAIN);
            }


            $location_id = STInput::get('location_id_pick_up');
            if (!$location_id) {
                $location_id = STInput::get('location_id');
            }
            if ($location_id and $location = get_post($location_id)) {
                $p2 = sprintf(__(' in %s', ST_TEXTDOMAIN), get_the_title($location_id));
            } else {
                if (!empty($_REQUEST['pick-up'])) {
                    $p2 = sprintf(__(' in %s', ST_TEXTDOMAIN), STInput::request('pick-up'));
                }
                if (empty($_REQUEST['pick-up']) and !empty($_REQUEST['location_name'])) {
                    $p2 = sprintf(__(' in %s', ST_TEXTDOMAIN), STInput::request('location_name'));
                }
            }

            if (!empty($_REQUEST['st_google_location_pickup'])) {
                $p2 = sprintf(__(' in %s', ST_TEXTDOMAIN), STInput::request('st_google_location_pickup', ''));
            }
            $start = TravelHelper::convertDateFormat(STInput::get('pick-up-date'));
            $end = TravelHelper::convertDateFormat(STInput::get('drop-off-date'));

            $start = strtotime($start);

            $end = strtotime($end);

            if ($start and $end) {
                $p3 = __(' on ', ST_TEXTDOMAIN) . date_i18n('M d', $start) . ' - ' . date_i18n('M d', $end);
            }

            if ($adult_number = STInput::get('adult_number')) {
                if ($adult_number > 1) {
                    $p4 = sprintf(__(' for %s adults', ST_TEXTDOMAIN), $adult_number);
                } else {

                    $p4 = sprintf(__(' for %s adult', ST_TEXTDOMAIN), $adult_number);
                }

            }

            // check Right to left
            if (st()->get_option('right_to_left') == 'on' || is_rtl()) {

                return $p1 . ' ' . $p4 . ' ' . $p3 . ' ' . $p2;
            }

            return esc_html($p1 . ' ' . $p2 . ' ' . $p3 . ' ' . $p4);

        }


        /**
         *
         *
         * @update 1.1.1
         * */
        static function get_search_fields_name()
        {
            return [/*
                'google_map_location' => array(
                    'value' => 'google_map_location',
                    'label' => __('Google Map Location', ST_TEXTDOMAIN)
                ),*/
                'location' => [
                    'value' => 'location',
                    'label' => __('Location', ST_TEXTDOMAIN),
                    'field_name' => 'pick-up'
                ],
                'list_location' => [
                    'value' => 'list_location',
                    'label' => __('Location list', ST_TEXTDOMAIN),
                    'field_name' => 'location_?'
                ],

                'pick-up-date' => [
                    'value' => 'pick-up-date',
                    'label' => __('Pick-up Date', ST_TEXTDOMAIN),
                    'field_name' => 'pick-up-date'
                ],
                'drop-off-time' => [
                    'value' => 'drop-off-time',
                    'label' => __('Drop-off Time', ST_TEXTDOMAIN),
                    'field_name' => 'drop-off-time'
                ],
                'drop-off-date' => [
                    'value' => 'drop-off-date',
                    'label' => __('Drop-off Date', ST_TEXTDOMAIN),
                    'field_name' => 'drop-off-date'
                ],
                'pick-up-time' => [
                    'value' => 'pick-up-time',
                    'label' => __('Pick-up Time', ST_TEXTDOMAIN),
                    'field_name' => 'pick-up-time'
                ],
                'pick-up-date-time' => [
                    'value' => 'pick-up-date-time',
                    'label' => __('Pick-up Date Time', ST_TEXTDOMAIN),
                    'field_name' => ['pick-up-date', 'pick-up-time']
                ],
                'drop-off-date-time' => [
                    'value' => 'drop-off-date-time',
                    'label' => __('Drop-off Date Time', ST_TEXTDOMAIN),
                    'field_name' => ['drop-off-date', 'drop-off-time']
                ],
                'taxonomy' => [
                    'value' => 'taxonomy',
                    'label' => __('Taxonomy', ST_TEXTDOMAIN),
                ],
                'item_name' => [
                    'value' => 'item_name',
                    'label' => __('Car Name', ST_TEXTDOMAIN),
                    'field_name' => 's'
                ],
                'list_name' => [
                    'value' => 'list_name',
                    'label' => __('List Name', ST_TEXTDOMAIN)
                ],
                'price_slider' => [
                    'value' => 'price_slider',
                    'label' => __('Price slider', ST_TEXTDOMAIN),
                    'field_name' => 's'
                ]

            ];
        }

        function _alter_search_query($where)
        {
            global $wp_query;
            if (is_search()) {
                $post_type = $wp_query->query_vars['post_type'];

                if ($post_type == 'st_cars') {
                    //Alter From NOW
                    global $wpdb;

                    $check_in = STInput::get('pick-up-date');
                    $check_out = STInput::get('drop-off-date');


                    //Alter WHERE for check in and check out
                    if ($check_in and $check_out) {
                        $check_in = @date('Y-m-d H:i:s', strtotime(TravelHelper::convertDateFormat($check_in)));
                        $check_out = @date('Y-m-d H:i:s', strtotime(TravelHelper::convertDateFormat($check_out)));

                        $check_in = esc_sql($check_in);
                        $check_out = esc_sql($check_out);


                        $where .= " AND $wpdb->posts.ID NOT IN
                            (
                                SELECT booked_id FROM (
                                    SELECT count(st_meta6.meta_value) as total_booked, st_meta5.meta_value as total,st_meta6.meta_value as booked_id ,st_meta2.meta_value as check_in,st_meta3.meta_value as check_out
                                         FROM {$wpdb->posts}
                                                JOIN {$wpdb->postmeta}  as st_meta2 on st_meta2.post_id={$wpdb->posts}.ID and st_meta2.meta_key='check_in'
                                                JOIN {$wpdb->postmeta}  as st_meta3 on st_meta3.post_id={$wpdb->posts}.ID and st_meta3.meta_key='check_out'
                                                JOIN {$wpdb->postmeta}  as st_meta6 on st_meta6.post_id={$wpdb->posts}.ID and st_meta6.meta_key='item_id'
                                                JOIN {$wpdb->postmeta}  as st_meta5 on st_meta5.post_id=st_meta6.meta_value and st_meta5.meta_key='number_car'
                                                WHERE {$wpdb->posts}.post_type='st_order'
                                        GROUP BY st_meta6.meta_value HAVING total<=total_booked AND (

                                                    ( CAST(st_meta2.meta_value AS DATE)<'{$check_in}' AND  CAST(st_meta3.meta_value AS DATE)>'{$check_in}' )
                                                    OR ( CAST(st_meta2.meta_value AS DATE)>='{$check_in}' AND  CAST(st_meta2.meta_value AS DATE)<='{$check_out}' )

                                        )
                                ) as item_booked
                            )

                    ";
                    }
                }
            }

            return $where;
        }

        static function get_price_car_by_order_item($id_item = null)
        {
            if (empty($id_item))
                $id_item = get_the_ID();


            return get_post_meta($id_item, 'price_total', true);
        }


        static function get_info_price($post_id = null, $date_start = false, $date_end = false, $pick_up = false, $drop_off = false)
        {

            if (!$post_id) $post_id = get_the_ID();
            $price_origin = get_post_meta($post_id, 'cars_price', true);
            $list_price = [];
            $price = $price_origin;
            $is_custom_price = get_post_meta($post_id, 'is_custom_price', true);
            if (empty($is_custom_price)) $is_custom_price = 'price_by_number';
            $unit = st()->get_option('cars_price_unit', 'day');
            ///////////////////////////////////////
            /////////// Price By Distance ///////////
            ///////////////////////////////////////
            if ($unit == "distance") {
                $number_distance = STPrice::getDistanceByCar($pick_up, $drop_off);
                $price = $price_origin * $number_distance;
            }
            ///////////////////////////////////////
            /////////// Price By Date /////////////
            ///////////////////////////////////////
            if ($is_custom_price == 'price_by_number' and $unit != "distance") {
                if (!empty($date_start) and !empty($date_end)) {
                    $price = self::get_rental_price_by_number_of_day_or_hour($post_id, $price_origin, $date_start, $date_end);
                } else {
                    $price = $price_origin;
                }
            }
            ///////////////////////////////////////
            /////////// Price By Date /////////////
            ///////////////////////////////////////
            if ($is_custom_price == 'price_by_date' and $unit != "distance") {
                if (!empty($date_start) and !empty($date_end)) {
                    $unit = st()->get_option('cars_price_unit', 'day');
                    if ($unit == 'day') {
                        $one_day = (60 * 60 * 24);
                    } elseif ($unit == 'hour') {
                        $one_day = (60 * 60);
                    }
                    $total = 0;
                    $str_start_date = ($date_start);
                    $str_end_date = ($date_end);
                    $number_days = STCars::get_date_diff($str_start_date, $str_end_date);
                    for ($i = 1; $i <= $number_days; $i++) {
                        $data_date = date("Y-m-d", $str_start_date + ($one_day * $i) - $one_day);
                        $tmp_date = date("Y-m-d H:i:s", $str_start_date + ($one_day * $i) - $one_day);
                        $price_tmp = TravelerObject::st_get_custom_price_by_date($post_id, $data_date);
                        if (empty($price_tmp)) {
                            $price_tmp = $price;
                        }
                        $is_sale = STPrice::_check_car_sale_schedule_by_date($post_id, $data_date);
                        if (!empty($is_sale)) {
                            $price_tmp = $price_tmp - ($price_tmp * ($is_sale / 100));
                        }
                        $list_price[$data_date] = [
                            'start' => $tmp_date,
                            'end' => $tmp_date,
                            'price' => apply_filters('st_apply_tax_amount', $price_tmp)
                        ];
                        $total += $price_tmp;
                    }
                } else {
                    $price = TravelerObject::st_get_custom_price_by_date($post_id);
                    if (empty($price)) {
                        $price = $price_origin;
                    }
                }
            }

            $discount = get_post_meta($post_id, 'discount', true);
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if ($is_sale_schedule == 'on') {
                $sale_from = get_post_meta($post_id, 'sale_price_from', true);
                $sale_to = get_post_meta($post_id, 'sale_price_to', true);
                if ($sale_from and $sale_from) {
                    $today = date('Y-m-d');
                    $sale_from = date('Y-m-d', strtotime($sale_from));
                    $sale_to = date('Y-m-d', strtotime($sale_to));
                    if (($today >= $sale_from) && ($today <= $sale_to)) {

                    } else {
                        $discount = 0;
                    }
                } else {
                    $discount = 0;
                }
            }
            if ($discount) {
                if ($discount > 100) $discount = 100;
                $new_price = $price - ($price / 100) * $discount;
            } else {
                $new_price = $price;
            }

            $data = [
                'price' => apply_filters('st_apply_tax_amount', $new_price),
                'price_origin' => apply_filters('st_apply_tax_amount', $price_origin),
                'discount' => $discount,
                'is_custom_price' => $is_custom_price,
                'list_price' => $list_price,
            ];

            return apply_filters('st_car_info_price', $data, $post_id);
        }

        static function get_rental_price_by_number_of_day_or_hour($post_id, $price, $date_start = false, $date_end = false)
        {
            $date_driff = STCars::get_date_diff($date_start, $date_end);
            if (!$post_id) $post_id = get_the_ID();
            $price_by_number_of_day_hour = get_post_meta($post_id, 'price_by_number_of_day_hour', true);
            if (!empty($price_by_number_of_day_hour) and is_array($price_by_number_of_day_hour)) {
                foreach ($price_by_number_of_day_hour as $k => $v) {
                    if ($date_driff >= $v['number_start'] and $date_driff <= $v['number_end']) {
                        $price = $v['price'];
                    }
                }
            }

            return $price;
        }

        static function get_info_price_by_date($post_id = null, $start)
        {

            if (!$post_id)
                $post_id = get_the_ID();
            $price = get_post_meta($post_id, 'cars_price', true);
            $new_price = 0;

            $discount = get_post_meta($post_id, 'discount', true);
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);

            if ($is_sale_schedule == 'on') {

                $sale_from = get_post_meta($post_id, 'sale_price_from', true);
                $sale_to = get_post_meta($post_id, 'sale_price_to', true);
                if ($sale_from and $sale_from) {

                    $today = date('Y-m-d', strtotime($start));
                    $sale_from = date('Y-m-d', strtotime($sale_from));
                    $sale_to = date('Y-m-d', strtotime($sale_to));
                    if (($today >= $sale_from) && ($today <= $sale_to)) {

                    } else {

                        $discount = false;
                    }

                } else {
                    $discount = false;
                }
            }
            if ($discount) {

                if ($discount > 100) $discount = 100;

                $new_price = $price - ($price / 100) * $discount;
                $data = [
                    'price' => apply_filters('st_apply_tax_amount', $new_price),
                    'price_old' => apply_filters('st_apply_tax_amount', $price),
                    'discount' => $discount,
                ];

            } else {

                $new_price = $price;
                $data = [
                    'price' => apply_filters('st_apply_tax_amount', $new_price),
                    'discount' => $discount,
                ];
            }

            return apply_filters('st_car_info_price', $data, $post_id);
        }

        static function get_rental_price($price, $start, $end, $unit = false)
        {

            $diff_number = self::get_date_diff($start, $end, $unit);
            $rental_price = $price * $diff_number;
            $rental_price = apply_filters('st_car_rental_price', $rental_price, $price, $start, $end, $unit);

            return $rental_price;

        }

        static function check_booking_days_included()
        {
            return (st()->get_option('booking_days_included', "off") == "on");
        }

        static function get_date_diff($start, $end, $unit = false)
        {
            if (!$unit)
                $unit = self::get_price_unit();

            $format = '%H';
            $datediff = STDate::timestamp_diff($start, $end);
            switch ($unit) {
                case "day":
                    $diff_number = TravelHelper::time_to_date($datediff);
                    if($start == $end && self::check_booking_days_included())
                        $diff_number = 0;
                    break;
                case "per_day":
                    $diff_number = TravelHelper::time_to_date($datediff);
                    break;
                case "hour":
                    $diff_number = ceil($datediff);
                    break;
                case "per_hour":
                    $diff_number = ceil($datediff);
                    break;
                default:
                    $diff_number = $datediff;
                    break;
            }
            if ($diff_number < 0)
                $diff_number = 0;
            if (self::check_booking_days_included()) {
                $diff_number += 1;
            }

            return $diff_number;
        }


        /**
         * Remove check if $need=value
         *
         * @update 1.1.3
         * */
        static function get_price_unit($need = 'value')
        {
            $unit = st()->get_option('cars_price_unit', 'day');
            $return = false;

            if ($need == 'label') {
                $all = self::get_option_price_unit();

                if (!empty($all)) {
                    foreach ($all as $key => $value) {
                        if ($value['value'] == $unit) {
                            if ($unit == "distance") {
                                $return = st()->get_option('cars_price_by_distance', 'kilometer');
                            } else {
                                $return = $value['label'];
                            }
                        }
                    }
                } else {
                    if ($unit == "distance") {
                        $return = st()->get_option('cars_price_by_distance', 'kilometer');
                    } else {
                        $return = $unit;
                    }
                }
            } elseif ($need == 'plural') {
                switch ($unit) {
                    case "hour":
                        $return = __("hours", ST_TEXTDOMAIN);
                        break;
                    case "day":
                        $return = __("days", ST_TEXTDOMAIN);
                        break;
                    case "distance":
                        if (st()->get_option('cars_price_by_distance', 'kilometer') == "kilometer") {
                            $return = __("kilometers", ST_TEXTDOMAIN);
                        } else {
                            $return = __("miles", ST_TEXTDOMAIN);
                        }
                        break;
                }

            } else {
                if ($unit == "distance") {
                    $return = st()->get_option('cars_price_by_distance', 'kilometer');
                } else {
                    $return = $unit;
                }
            }

            return apply_filters('st_get_price_unit', $return, $need);
        }

        /**
         *
         *
         *
         *
         * @since 1.0.9
         * */

        static function get_price_unit_by_unit_id($unit, $need = 'value')
        {
            switch ($need) {
                case "value":
                    if ($unit == "distance") {
                        return st()->get_option('cars_price_by_distance', 'kilometer');
                    } else {
                        return $unit;
                    }
                    //return $unit;
                    break;

                case "label":
                    $all = self::get_option_price_unit();

                    if (!empty($all)) {
                        foreach ($all as $key => $value) {
                            if ($value['value'] == $unit) {
                                if ($unit == "distance") {
                                    return st()->get_option('cars_price_by_distance', 'kilometer');
                                } else {
                                    return $value['label'];
                                }
                            }
                        }
                    }
                    break;

                case "plural":
                    switch ($unit) {
                        case "hour":
                            return __("hours", ST_TEXTDOMAIN);
                            break;
                        case "day":
                            return __("days", ST_TEXTDOMAIN);
                            break;
                        case "distance":
                            if (st()->get_option('cars_price_by_distance', 'kilometer') == "kilometer") {
                                return __("kilometers", ST_TEXTDOMAIN);
                            } else {
                                return __("miles", ST_TEXTDOMAIN);
                            }
                    }
                    break;

                default:
                    if ($unit == "distance") {
                        return st()->get_option('cars_price_by_distance', 'kilometer');
                    } else {
                        return $unit;
                    }
                    break;
            }

        }

        static function get_option_price_unit()
        {
            return apply_filters('st_car_price_units', [
                    [
                        'value' => 'day',
                        'label' => __('Day', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'hour',
                        'label' => __('Hour', ST_TEXTDOMAIN)
                    ],
                    [
                        'value' => 'distance',
                        'label' => __('Distance', ST_TEXTDOMAIN)
                    ],
                ]
            );
        }

        static function get_owner_email($car_id)
        {
            $theme_option = st()->get_option('partner_show_contact_info');
            $metabox = get_post_meta($car_id, 'show_agent_contact_info', true);

            $use_agent_info = FALSE;

            if ($theme_option == 'on') $use_agent_info = true;
            if ($metabox == 'user_agent_info') $use_agent_info = true;
            if ($metabox == 'user_item_info') $use_agent_info = FALSE;

            if ($use_agent_info) {
                $post = get_post($car_id);
                if ($post) {
                    return get_the_author_meta('user_email', $post->post_author);
                }

            }

            return get_post_meta($car_id, 'cars_email', true);
        }

        static function get_taxonomy_and_id_term_car()
        {
            $list_taxonomy = st_list_taxonomy('st_cars');
            $list_id_vc = [];
            $param = [];
            $list_value = [];
            foreach ($list_taxonomy as $k => $v) {
                $term = get_terms($v);
                if (!empty($term) and is_array($term)) {
                    foreach ($term as $key => $value) {
                        $list_value[$value->name] = $value->term_id;
                    }
                    $param[] = [
                        "type" => "checkbox",
                        "holder" => "div",
                        "heading" => $k,
                        "param_name" => "id_term_" . $v,
                        "value" => $list_value,
                        'dependency' => [
                            'element' => 'sort_taxonomy',
                            'value' => [$v]
                        ],
                    ];
                    $list_value = "";
                    $list_id_vc["id_term_" . $v] = "";
                }
            }

            return [
                "list_vc" => $param,
                'list_id_vc' => $list_id_vc
            ];
        }

        function st_cars_save_review_stats($comment_id)
        {
            $comemntObj = get_comment($comment_id);
            $post_id = $comemntObj->comment_post_ID;

            if (get_post_type($post_id) == 'st_cars') {
                $all_stats = $this->get_review_stats();
                $st_review_stats = STInput::post('st_review_stats');

                if (!empty($all_stats) and is_array($all_stats)) {
                    $total_point = 0;
                    foreach ($all_stats as $key => $value) {
                        if (isset($st_review_stats[$value['title']])) {
                            $total_point += $st_review_stats[$value['title']];
                            //Now Update the Each Stat Value
                            update_comment_meta($comment_id, 'st_stat_' . sanitize_title($value['title']), $st_review_stats[$value['title']]);
                        }
                    }

                    $avg = round($total_point / count($all_stats), 1);

                    //Update comment rate with avg point
                    $rate = wp_filter_nohtml_kses($avg);
                    if ($rate > 5) {
                        //Max rate is 5
                        $rate = 5;
                    }
                    update_comment_meta($comment_id, 'comment_rate', $rate);
                    //Now Update the Stats Value
                    update_comment_meta($comment_id, 'st_review_stats', $st_review_stats);
                }


            }


            if (STInput::post('comment_rate')) {
                update_comment_meta($comment_id, 'comment_rate', STInput::post('comment_rate'));

            }
            //review_stats
            $avg = STReview::get_avg_rate($post_id);

            update_post_meta($post_id, 'rate_review', $avg);
        }

        function st_cars_save_post_review_stats($comment_id)
        {
            /*since 1.1.0*/
            $comemntObj = get_comment($comment_id);
            $post_id = $comemntObj->comment_post_ID;

            $avg = STReview::get_avg_rate($post_id);
            update_post_meta($post_id, 'rate_review', $avg);
        }

        function get_review_stats()
        {
            $review_stat = st()->get_option('car_review_stats');

            return $review_stat;
        }

        function comment_args($comment_form, $post_id = false)
        {
            /*since 1.1.0*/

            if (!$post_id)
                $post_id = get_the_ID();
            if (get_post_type($post_id) == 'st_cars') {
                $stats = $this->get_review_stats();

                if ($stats and is_array($stats)) {
                    $stat_html = '<ul class="list booking-item-raiting-summary-list stats-list-select">';

                    foreach ($stats as $key => $value) {
                        $stat_html .= '<li class=""><div class="booking-item-raiting-list-title">' . $value['title'] . '</div>
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
                                                <input type="hidden" class="st_review_stats" value="0" name="st_review_stats[' . $value['title'] . ']">
                                                    </li>';
                    }
                    $stat_html .= '</ul>';


                    $comment_form['comment_field'] = "
                        <div class='row'>
                            <div class=\"col-sm-8\">
                    ";
                    $comment_form['comment_field'] .= '<div class="form-group">
                                            <label>' . __('Review Title', ST_TEXTDOMAIN) . '</label>
                                            <input class="form-control" type="text" name="comment_title">
                                        </div>';

                    $comment_form['comment_field'] .= '<div class="form-group">
                                            <label>' . __('Review Text', ST_TEXTDOMAIN) . '</label>
                                            <textarea name="comment" id="comment" class="form-control" rows="6"></textarea>
                                        </div>
                                        </div><!--End col-sm-8-->
                                        ';

                    $comment_form['comment_field'] .= '<div class="col-sm-4">' . $stat_html . '</div></div><!--End Row-->';
                }
            }

            return $comment_form;
        }

        /**
         * @since  1.1.1
         * @update 1.1.2
         * filter hook car_external_booking_submit
         */
        public static function car_external_booking_submit()
        {

            $post_id = get_the_ID();
            if (STInput::request('post_id')) {
                $post_id = STInput::request('post_id');
            }

            $car_external_booking = get_post_meta($post_id, 'st_car_external_booking', "off");
            $car_external_booking_link = get_post_meta($post_id, 'st_car_external_booking_link', true);
            if ($car_external_booking == "on" && $car_external_booking_link !== "") {
                if (get_post_meta($post_id, 'st_car_external_booking_link', true)) {
                    ob_start();
                    ?>
                    <a class='btn btn-primary'
                       href='<?php echo get_post_meta($post_id, 'st_car_external_booking_link', true) ?>'> <?php esc_html_e('Book Now','traveler') ?></a>
                    <?php
                    $return = ob_get_clean();
                }
            } else {
                $return = TravelerObject::get_book_btn();
            }

            return apply_filters('car_external_booking_submit', $return);
        }

        /**
         *
         *
         * @since 1.1.3
         * */
        static function get_equipment_line_item($price, $unit, $start_timestamp, $end_timestamp)
        {

            switch ($unit) {
                case "per_day":
                    $diff = STCars::get_date_diff($start_timestamp, $end_timestamp);
                    if (!$diff)
                        $diff = 1;

                    return (float)$price * $diff;

                    break;
                case "per_hour":

                    $diff = STCars::get_date_diff($start_timestamp, $end_timestamp);
                    if (!$diff)
                        $diff = 1;

                    return (float)$price * $diff * 24;

                    break;
                default:
                    return (float)$price;
                    break;
            }
        }

        /** from 1.1.7*/
        static function get_taxonomy_and_id_term_tour()
        {
            $list_taxonomy = st_list_taxonomy('st_cars');
            $list_id_vc = [];
            $param = [];
            foreach ($list_taxonomy as $k => $v) {
                    $param[] = [
                        "type" => "st_checkbox",
                        "holder" => "div",
                        "heading" => $k,
                        "param_name" => "id_term_" . $v,
                        'stype' => 'list_terms',
                        'sparam' => $v,
                        'dependency' => [
                            'element' => 'sort_taxonomy',
                            'value' => [$v]
                        ],
                    ];
                    $list_value = "";
                    $list_id_vc["id_term_" . $v] = "";
            }

            return [
                "list_vc" => $param,
                'list_id_vc' => $list_id_vc
            ];
        }

        static function get_list_car_by_location_or_address($locations, $address){
            $location_ids = implode(',', $locations);
            global $wpdb;
            $select = "";
            $where = "";
            $group_by = " GROUP BY {$wpdb->prefix}posts.ID ";
            $order_by = " ORDER BY {$wpdb->prefix}postmeta.meta_value DESC ";
            $limit = "";

            $select .= "SELECT SQL_CALC_FOUND_ROWS {$wpdb->prefix}posts.ID 
                                FROM {$wpdb->prefix}posts 
                                INNER JOIN {$wpdb->prefix}postmeta 
                                ON ( {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id ) 
                                INNER JOIN {$wpdb->prefix}st_cars as tb ON {$wpdb->prefix}posts.ID = tb.post_id ";

            $where .= " WHERE 1=1 ";
            $user_id = get_current_user_id();
            if( !is_super_admin( $user_id ) ){
                $where .= " AND {$wpdb->prefix}posts.post_author IN ({$user_id}) ";
            }
            $where .= " AND {$wpdb->prefix}posts.post_type = 'st_cars' AND {$wpdb->prefix}posts.post_status = 'publish' ";
            if(!empty($locations)){
                $where .= " AND {$wpdb->prefix}posts.ID IN (SELECT post_id FROM {$wpdb->prefix}st_location_relationships WHERE 1=1 AND location_from IN ({$location_ids}) AND post_type IN ('st_cars')) ";
            }else{
                if($address != ''){
                    $where .= " AND (tb.address LIKE '%{$address}%' ";
                    $where .= " OR {$wpdb->prefix}posts.post_title LIKE '%{$address}%') ";
                }
            }

            $sql = "
                         {$select}
                         {$where}
                         {$group_by}
                         {$order_by}
                         {$limit}
                        ";
            $res = $wpdb->get_results($sql, ARRAY_A);
            return $res;
        }

        static function get_instance()
        {
            if (!self::$_inst) {
                self::$_inst = new self();
            }

            return self::$_inst;
        }
    }

    st()->car = STCars::get_instance();
    st()->car->init();
};
