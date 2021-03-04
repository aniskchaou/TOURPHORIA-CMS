<?php

/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Class TravelerObject
 *
 * Created by ShineTheme
 * @update     1.1.1
 *
 */
class TravelerObject
{
    public $min_price;

    protected $post_type = '';
    /**
     * @var string
     * @since 1.1.7
     */
    protected $template_folder = "";

    protected $metabox = [];

    protected $orderby = [];

    protected static $minMaxPrice = [];


    function init()
    {
        if (!$this->template_folder) {
            $this->template_folder = $this->post_type;
        }
        //Add Stats display for posted review
        add_action('admin_init', [$this, 'do_init_metabox']);
        add_action('st_review_stats_' . $this->post_type . '_content', [
            $this,
            'display_posted_review_stats'
        ]);

        /**
         * @since 1.1.7
         */
        add_action('st_wc_show_order_item_meta_' . $this->post_type, [$this, '_wc_order_item_meta'], 10, 3);

        /**
         * @since 1.3.0
         */
        add_filter('rewrite_rules_array', [$this, 'st_insert_rewrite_rules']);
        add_filter('query_vars', [$this, 'st_insert_query_vars']);
        add_action('wp_loaded', [$this, 'st_flush_rules']);

        add_action('pre_get_posts', [$this, 'change_author_get_posts'], 50);

        add_filter('script_loader_src', [$this, '_remove_script_version'], 50, 1);
        add_filter('style_loader_src', [$this, '_remove_script_version'], 50, 1);
    }

    public function _remove_script_version($src)
    {
        $parts = explode('?ver', $src);

        return $parts[0];
    }

    /**
     * @since 1.3.0
     **/

    public function st_flush_rules()
    {
        $rules = get_option('rewrite_rules');
        $slug = st()->get_option('slug_partner_page', 'page-user-setting');
        if (!isset($rules[$slug . '/([^/]+)?$']) || !isset($rules[$slug . '/([^/]+)/page/([0-9]{1,})?$'])) {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
        }
    }

    public function st_insert_rewrite_rules($rules)
    {
        $newrules = [];
        $slug = st()->get_option('slug_partner_page', 'page-user-setting');
        $newrules[$slug . '/([^/]+)?$'] = 'index.php?pagename=' . $slug . '&sc=$matches[1]';
        $newrules[$slug . '/([^/]+)/page/([0-9]{1,})?$'] = 'index.php?pagename=' . $slug . '&sc=$matches[1]&paged=$matches[2]';
        $newrules[$slug . '/([^/]+)/page/([0-9]{1,})?$'] = 'index.php?pagename=' . $slug . '&sc=$matches[1]&paged=$matches[2]';

        return $newrules + $rules;
    }

    public function st_insert_query_vars($vars)
    {
        array_push($vars, 'sc');

        return $vars;
    }

    public function change_author_get_posts($query)
    {
        $post_type = $query->get('post_type');
        if ($post_type == 'post') {
            $query->set('author', false);
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
        $type = "fa fa-building-o";

        return $type;
    }

    /**
     * @param $item_id
     * @param $item
     * @param $order
     *
     * @since 1.1.7
     */
    function _wc_order_item_meta($item_id, $item, $order)
    {
        echo $this->load_view('wc_order_item_meta', null, [
            'item_id' => $item_id,
            'item' => $item,
            'order' => $order
        ]);
        echo st()->load_template('woo/cart-meta-deposit', null, [
            'item_id' => $item_id,
            'item' => $item,
            'order' => $order
        ]);

    }

    function is_available()
    {
        return st_check_service_available($this->post_type);
    }

    /**
     *
     * @since 1.1.7
     *
     *
     */
    function load_view($view, $slug = false, $data = [])
    {
        $view = $this->template_folder . '/' . $view;

        return st()->load_template($view, $slug, $data);
    }

    /**
     *
     *
     * @update 1.1.4
     * */
    function _class_init()
    {


        add_action('save_post', [$this, 'update_avg_rate']);

        add_filter('post_class', [$this, 'change_post_class']);

        add_filter('pre_get_posts', [$this, '_admin_posts_for_current_author']);

        add_action('wp_ajax_st_top_ajax_search', [$this, '_top_ajax_search']);
        add_action('wp_ajax_nopriv_st_top_ajax_search', [$this, '_top_ajax_search']);


        add_action('st_single_breadcrumb', [$this, 'add_breadcrumb']);

        add_filter('wp_nav_menu_items', [$this, 'st_custom_menu_mobile_item'], 10, 2);


    }


    function _add_seach_filter($query)
    {
        if (STInput::get('item_name')) {
            $query->set('s', STInput::get('item_name'));
        }

        return $query;
    }

    /**
     *
     *
     * @since 1.1.3
     * */
    function add_breadcrumb($sep)
    {
        $bc_show_location_url = st()->get_option('bc_show_location_url', 'on');

        $location_id = get_post_meta(get_the_ID(), 'id_location', true);

        if (!$location_id) {
            $location_id = get_post_meta(get_the_ID(), 'location_id', true);
        }

        if (!$location_id) {
            $location_string = get_post_meta(get_the_ID(), 'multi_location', true);
            if (!is_array($location_string)) {
                $location_array = explode(",", $location_string);
            } elseif (is_array($location_string)) {
                $location_array = $location_string;
            }
            $location_id = [];
            if (is_array($location_array) and !empty($location_array)) {
                foreach ($location_array as $key => $value) {
                    $var = str_replace("_", "", $value);
                    $location_id[] = $var;
                }
            }
            $location_id = $location_id[0];
            // from 1.1.7 default get first location item child
        }

        if (is_singular('st_cars')) {
            $location_type = get_post_meta(get_the_ID(), 'location_type', true);
            if (!$location_type) $location_type = 'multi_location';

            if ($location_type == 'multi_location') {
                $location_string = get_post_meta(get_the_ID(), 'multi_location', true);
                if (!is_array($location_string)) {
                    $location_array = explode(",", $location_string);
                } elseif (is_array($location_string)) {
                    $location_array = $location_string;
                }
                $location_id = [];
                if (is_array($location_array) and !empty($location_array)) {
                    foreach ($location_array as $key => $value) {
                        $var = str_replace("_", "", $value);
                        $location_id[] = $var;
                    }
                }
                $location_id = $location_id[0];
            } elseif ($location_type == 'check_in_out') {
                $car = new STAdminCars();
                $locations = $car->get_data_location_from_to(get_the_ID());
                if (!empty($locations) && is_array($locations)) {
                    $location_id = (int)$locations[0]['location_from'];
                }
            }
        }

        $array = [];
        $parents = get_post_ancestors($location_id);
        if (!empty($parents) and is_array($parents)) {
            for ($i = count($parents) - 1; $i >= 0; $i--) {
                $value = $parents[$i];
                $link = get_home_url('/');
                if ($bc_show_location_url == 'on') {

                    $post_type = get_post_type();
                    $page_search = st_get_page_search_result($post_type);

                    if (!empty($page_search) and get_post_type($page_search) == 'page') {
                        $link = esc_url(add_query_arg([
                            'location_id' => $value,
                            'location_name' => get_the_title($value),
                        ], get_permalink($page_search)));
                    } else {
                        $link = esc_url(add_query_arg([
                            'post_type' => (!get_post_type()) ? 'st_hotel' : get_post_type(),
                            's' => '',
                            'location_id' => $value,
                            'location_name' => get_the_title($value)
                        ], $link));
                    }

                } else {
                    $link = get_permalink($value);
                }
                echo '<li><a href="' . $link . '">' . get_the_title($value) . '</a></li>';
            }
        }

        if ($location_id) {

            $link = get_home_url('/');

            if ($bc_show_location_url == 'on') {
                $post_type = get_post_type();
                $page_search = st_get_page_search_result($post_type);
                if (!empty($page_search) and get_post_type($page_search) == 'page') {
                    $link = esc_url(add_query_arg([
                        'location_id' => $location_id,
                        'location_name' => get_the_title($location_id)
                    ], get_permalink($page_search)));
                } else {
                    $link = esc_url(add_query_arg([
                        'post_type' => get_post_type(),
                        's' => '',
                        'location_id' => $location_id,
                        'location_name' => get_the_title($location_id)
                    ], $link));
                }

            } else {
                $link = get_permalink($location_id);
            }
            echo '<li><a href="' . $link . '">' . get_the_title($location_id) . '</a></li>';
        }


    }


    function _admin_posts_for_current_author($query)
    {
        if ($query->is_admin) {
            $post_type = $query->get('post_type');

            if (!current_user_can('manage_options') and (!is_string($post_type) or $post_type != 'location')) {
                global $user_ID;
                $query->set('author', $user_ID);
            }
        }

        return $query;
    }

    function _change_top_search($query)
    {
        $query->set('author', '');

        return $query;
    }

    function _top_ajax_search()
    {
        //Small security
        check_ajax_referer('st_search_security', 'security');
        //$search_header_onof = st()->get_option('search_header_onoff', 'on');
        $search_header_orderby = st()->get_option('search_header_orderby', 'none');
        $search_header_list = st()->get_option('search_header_list', 'post');
        $search_header_order = st()->get_option('search_header_order', 'ASC');
        $s = STInput::get('s');
        $arg = [
            'post_type' => $search_header_list,
            'posts_per_page' => 10,
            's' => $s,
            'suppress_filters' => false,
            'orderby' => $search_header_orderby,
            'order' => $search_header_order,
            'author' => false,
	        'post_status' => 'publish'
        ];

        global $sitepress;

        if (class_exists('SitePress') and STInput::get('lang')) {
            $sitepress->switch_lang(STInput::get('lang'));
        }

        add_filter('pre_get_posts', [$this, '_change_top_search']);

        $query = new WP_Query();
        $query->is_admin = false;
        $query->query($arg);
        $r = [];
        $r['x'] = $arg;

        remove_filter('pre_get_posts', [$this, '_change_top_search']);
        while ($query->have_posts()) {
            $query->the_post();
            $post_type = get_post_type(get_the_ID());
            $obj = get_post_type_object($post_type);

            $item = [
                'title' => html_entity_decode(get_the_title()),
                'id' => get_the_ID(),
                'type' => $obj->labels->singular_name,
                'url' => get_permalink(),
                'obj' => $obj
            ];

            if ($post_type == 'location') {
                $item['url'] = home_url(esc_url_raw('?s=&post_type=st_hotel&location_id=' . get_the_ID()));
            }

            $r['data'][] = $item;
        }

        wp_reset_query();
        echo json_encode($r);

        die();
    }

    function change_post_class($class)
    {
        return $class;
    }

    function update_avg_rate($post_id)
    {
        $avg = STReview::get_avg_rate($post_id);
        update_post_meta($post_id, 'rate_review', $avg);

        // clear near by cache
        $range = st()->get_option('hotel_nearby_range');
        $limit = 5;
        delete_transient('st_items_nearby_' . $post_id . '_' . $range . '_' . $limit);
        delete_transient('st_items_nearby_' . $post_id . '_20_' . $limit);
    }

    /**
     * @since 1.3.1
     **/
    function properties_near_by($post_id, $lat, $lng, $range = 20)
    {
        if (empty($lat) || empty($lng)) {
            return [];
        }
        global $wpdb;
        $sql = "SELECT
            properties.*,
            (
                3959 * acos(
                    cos(radians({$lat})) * cos(radians(properties.lat)) * cos(
                        radians(properties.lng) - radians({$lng})
                    ) + sin(radians(($lat))) * sin(radians(properties.lat))
                )
            ) AS distance
        FROM
            {$wpdb->prefix}st_properties AS properties
        WHERE
            post_id = {$post_id}
        HAVING
            distance <= {$range}";

        $results = $wpdb->get_results($sql, ARRAY_A);

        return $results;
    }

    /**
     *
     * $range in kilometer
     *
     *
     * */
    function get_near_by($post_id = false, $range = 20, $limit = 5)
    {
        if (!$post_id)
            $post_id = get_the_ID();
        // Remove in ver 2.0
        /*if ( false !== ( $value = get_transient( 'st_items_nearby_' . $post_id . '_' . $range . '_' . $limit ) ) )
            return $value;*/

        $map_lat = (float)get_post_meta($post_id, 'map_lat', true);
        $map_lng = (float)get_post_meta($post_id, 'map_lng', true);
        $post_type = get_post_type($post_id);

        $location_key = 'id_location';
        if ($post_type == 'st_rental') {
            $location_key = 'location_id';
        }
        $location_key = apply_filters('st_' . $post_type . '_location_id_metakey', $location_key);

        //$location_id = get_post_meta( $post_id , $location_key , true );

        //Search by Kilometer :6371
        //Miles: 3959
        global $wpdb;
        $where = " $wpdb->posts.ID = mt1.post_id
            and $wpdb->posts.ID=mt2.post_id
            AND mt1.meta_key = 'map_lat'
            and mt2.meta_key = 'map_lng'
            and $wpdb->posts.ID !=$post_id
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type = '{$this->post_type}'
            AND $wpdb->posts.post_date < NOW()";
        $where = TravelHelper::edit_where_wpml($where);
        $join = "";
        $join = TravelHelper::edit_join_wpml($join, $post_type);
        $querystr = "
            SELECT $wpdb->posts.*,( 6371 * acos( cos( radians({$map_lat}) ) * cos( radians( mt1.meta_value ) ) *
cos( radians( mt2.meta_value ) - radians({$map_lng}) ) + sin( radians({$map_lat}) ) *
sin( radians( mt1.meta_value ) ) ) ) AS distance
            FROM $wpdb->posts {$join} , $wpdb->postmeta as mt1,$wpdb->postmeta as mt2
            WHERE (1=1) and {$where }
            GROUP BY $wpdb->posts.ID HAVING distance<{$range}
            ORDER BY distance ASC
            LIMIT 0,{$limit}
         ";
        //echo $querystr ;
        $pageposts = $wpdb->get_results($querystr, OBJECT);
        //set_transient('st_items_nearby_' . $post_id . '_' . $range . '_' . $limit, $pageposts, 5 * HOUR_IN_SECONDS);

        return $pageposts;

    }

    function get_near_by_lat_lng($st_location = false, $lat = false, $lng = false, $post_type = [], $range = 20, $limit = 5)
    {
        $map_lat = (float)$lat;
        $map_lng = (float)$lng;
        //Search by Kilometer :6371
        //Miles: 3959
        if (!empty($post_type) and is_array($post_type)) {
            $data_post_type = "";
            foreach ($post_type as $k => $v) {
                $data_post_type .= "'" . $v . "',";
            }
            $data_post_type = substr($data_post_type, 0, -1);
            global $wpdb;
            $where = "$wpdb->posts.ID = mt1.post_id
            and $wpdb->posts.ID=mt2.post_id
            AND mt1.meta_key = 'map_lat'
            and mt2.meta_key = 'map_lng'
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type IN ({$data_post_type})
            AND $wpdb->posts.post_date < NOW()";
            $where = TravelHelper::edit_where_wpml($where);
            $where = TravelHelper::_st_get_where_location($st_location, $post_type, $where);
            $join = "";
            $join = TravelHelper::edit_join_wpml($join, $post_type);


            $querystr = "
            SELECT $wpdb->posts.*,( 6371 * acos( cos( radians({$map_lat}) ) * cos( radians( mt1.meta_value ) ) *
cos( radians( mt2.meta_value ) - radians({$map_lng}) ) + sin( radians({$map_lat}) ) *
sin( radians( mt1.meta_value ) ) ) ) AS distance
            FROM $wpdb->posts {$join}, $wpdb->postmeta as mt1,$wpdb->postmeta as mt2
            WHERE (1=1) and {$where}
            GROUP BY $wpdb->posts.ID HAVING distance<{$range}
            ORDER BY distance ASC
            LIMIT 0,{$limit}
         ";
            $pageposts = $wpdb->get_results($querystr, OBJECT);

            //set_transient( 'st_items_nearby_' . $post_id , $pageposts , 5 * HOUR_IN_SECONDS );
            return $pageposts;
        }

        return false;
    }


    function get_review_stats()
    {
        return [];
    }

    function display_posted_review_stats($comment_id)
    {

        if (get_post_type() == $this->post_type) {
            $data = $this->get_review_stats();

            $output[] = '<ul class="list booking-item-raiting-summary-list mt20">';

            if (!empty($data) and is_array($data)) {
                foreach ($data as $value) {
                    $key = $value['title'];


                    $stat_value = get_comment_meta($comment_id, 'st_stat_' . sanitize_title($value['title']), true);

                    $output[] = '
                    <li>
                        <div class="booking-item-raiting-list-title">' . $key . '</div>
                        <ul class="icon-group booking-item-rating-stars">';
                    for ($i = 1; $i <= 5; $i++) {
                        $class = '';
                        if ($i > $stat_value)
                            $class = 'text-gray';
                        $output[] = '<li><i class="fa fa-smile-o ' . $class . '"></i>';
                    }

                    $output[] = '
                        </ul>
                    </li>';
                }
            }

            $output[] = '</ul>';


            echo implode("\n", $output);
        }
    }

    function getOrderby()
    {
        $this->orderby = [
            'price_asc' => [
                'key' => 'price_asc',
                'name' => __('Price ', ST_TEXTDOMAIN) . ' (<i class="fa fa-long-arrow-down"></i>)'
            ],
            'price_desc' => [
                'key' => 'price_desc',
                'name' => __('Price ', ST_TEXTDOMAIN) . ' (<i class="fa fa-long-arrow-up"></i>)'
            ],
            'avg_rate' => [
                'key' => 'avg_rate',
                'name' => __('Review', ST_TEXTDOMAIN)
            ]
        ];

        return $this->orderby;
    }


    public function do_init_metabox()
    {
        $custom_metabox = $this->metabox;
        /**
         * Register our meta boxes using the
         * ot_register_meta_box() function.
         */
        if (function_exists('ot_register_meta_box')) {
            if (!empty($custom_metabox)) {
                foreach ($custom_metabox as $value) {
                    ot_register_meta_box($value);
                }
            }
        }
    }

    //Helper class
    static function get_last_booking_string($post_id = false)
    {
        if (!$post_id and !is_singular())
            return false;
        global $wpdb;

        $post_id = get_the_ID();
        $where = '';
        $join = '';

        $post_type = get_post_type($post_id);

        switch ($post_type) {


            default:
                $where .= "and meta_value in (
                    '{$post_id}'
                )";
                break;
        }


        $query = "SELECT * from " . $wpdb->postmeta . "
                {$join}
                where meta_key='item_id'
                {$where}

                order by meta_id desc
                limit 0,1";

        $data = $wpdb->get_results($query, OBJECT);

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                return human_time_diff(get_the_time('U', $value->post_id), current_time('timestamp'));
            }
        }


    }

    static function get_card($card_name)
    {
        $options = st()->get_option('booking_card_accepted', []);


        if (!empty($options)) {
            foreach ($options as $key) {
                if (sanitize_title_with_dashes($key['title']) == $card_name)
                    return $key;
            }
        }
    }

    static function get_orgin_booking_id($item_id)
    {
        if (get_post_type($item_id) == 'hotel_room') {
            if ($hotel_id = get_post_meta($item_id, 'room_parent', true)) {
                $item_id = $hotel_id;
            }
        }

        return apply_filters('st_orgin_booking_item_id', $item_id);
    }

    static function get_min_max_price_all_post_type(){
        $all_post_type = TravelHelper::get_all_post_type();
        $price_min = 0;
        $price_max = 500;
        if(!empty($all_post_type)){
            $data_min_max = [];
            foreach ($all_post_type as $k => $v){
                $data_min_max[] = self::get_min_max_price($v);
            }

            if(!empty($data_min_max)){
                $min = [];
                $max = [];
                foreach ($data_min_max as $kk => $vv){
                    $min[] = $vv['price_min'];
                    $max[] = $vv['price_max'];
                }

                if(!empty($min)){
                    $price_min = min($min);
                }

                if(!empty($max)){
                    $price_max = max($max);
                }
            }
        }
        return ['price_min' => $price_min, 'price_max' => $price_max];
    }

    static function get_min_max_price($post_type)
    {
        if ($post_type == 'car_transfer') {
            $minmax_price = STAdminCars::get_min_max_price_transfer();
            return [
                'price_min' => $minmax_price['min_price'],
                'price_max' => $minmax_price['max_price'],
            ];
        } else {
            if (empty($post_type) || !TravelHelper::checkTableDuplicate($post_type)) {
                return ['price_min' => 0, 'price_max' => 500];
            }

	        if(array_key_exists('min_max_' . $post_type, self::$minMaxPrice)){
		        $results = self::$minMaxPrice['min_max_' . $post_type];
	        }else{
		        global $wpdb;

		        $join = " join {$wpdb->posts} on {$wpdb->posts}.ID = {$wpdb->prefix}{$post_type}.post_id ";
		        $join = STLocation::edit_join_wpml($join, $post_type);

		        switch ($post_type) {
			        case "st_hotel":
					        $meta_key = st()->get_option('hotel_show_min_price', 'price_avg');
					        //if($meta_key == 'avg_price'){
						        $where = "where 1=1 and ( {$wpdb->posts}.post_status = 'publish' )";
						        $where = STLocation::edit_where_wpml($where);
						        $sql = "SELECT
                                min(CAST({$meta_key} AS DECIMAL)) AS min,
                                max(CAST({$meta_key} AS DECIMAL)) AS max
                            FROM
                                {$wpdb->prefix}{$post_type}
                            {$join}
                            {$where}";

                                $results = $wpdb->get_results($sql, OBJECT);
                            /*}else{
                                $query_price = ST_Hotel_Room_Availability::inst()
                                    ->select("min(CAST(price as DECIMAL)) AS min, max(CAST(price as DECIMAL)) AS max")
                                    ->where('status', 'available')
                                    ->where("check_in >= UNIX_TIMESTAMP(CURRENT_DATE)", null, true)
                                    ->get(false, false, OBJECT)->result();
                                $results = $query_price;
					        }*/
				        break;
			        case "hotel_room":
					        $where = "where 1=1 and ( {$wpdb->posts}.post_status = 'publish' )";
					        $where = STLocation::edit_where_wpml($where);
					        $show_only_room_by = st()->get_option('show_only_room_by');
					        if (!empty($show_only_room_by) and is_array($show_only_room_by) and !in_array('all', $show_only_room_by)) {
						        foreach ($show_only_room_by as $k => $v) {
							        $join .= "JOIN {$wpdb->postmeta} as st_mt{$k} ON {$wpdb->prefix}{$post_type}.post_id = st_mt{$k}.post_id";
							        $where .= " AND st_mt{$k}.meta_key = 'st_custom_item_api_type' and st_mt{$k}.meta_value='{$v}' ";
						        }
					        }
					        $sql = "SELECT
                                min(CAST( st_hotel_room_price AS DECIMAL)) AS min,
                                max(CAST( st_hotel_room_price AS DECIMAL)) AS max
                                FROM
                                (
                                    SELECT CASE
                                                WHEN  {$wpdb->prefix}{$post_type}.discount_rate != 0 AND {$wpdb->prefix}{$post_type}.discount_rate != ''
                                                THEN
                                                     CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount_rate AS DECIMAL)

                                                ELSE {$wpdb->prefix}{$post_type}.price

                                           END AS st_hotel_room_price
                                    FROM
                                    {$wpdb->prefix}{$post_type}
                                    {$join}
                                    {$where}
                                )as st_table_hotel_room";
					        $results = $wpdb->get_results($sql, OBJECT);
				        break;
			        case "st_rental":
					        $where = "where 1=1 and ( {$wpdb->posts}.post_status = 'publish' )";
					        $where = STLocation::edit_where_wpml($where);
					        $sql = "SELECT
                                min(CAST( st_rental_price AS DECIMAL)) AS min,
                                max(CAST( st_rental_price AS DECIMAL)) AS max
                                FROM
                                (
                                    SELECT CASE
                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on' AND {$wpdb->prefix}{$post_type}.discount_rate != 0 AND {$wpdb->prefix}{$post_type}.discount_rate != '' AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                THEN
                                                     CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount_rate AS DECIMAL)

                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount_rate != 0 AND {$wpdb->prefix}{$post_type}.discount_rate != ''
                                                THEN
                                                     CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount_rate AS DECIMAL)

                                                ELSE {$wpdb->prefix}{$post_type}.price

                                           END AS st_rental_price
                                    FROM
                                    {$wpdb->prefix}{$post_type}
                                    {$join}
                                    {$where}
                                )as st_table_rental";
					        $results = $wpdb->get_results($sql, OBJECT);
				        break;
			        case "st_cars":
					        $where = "where 1=1 and ( {$wpdb->posts}.post_status = 'publish' )";
					        $where = STLocation::edit_where_wpml($where);
					        $sql = "SELECT
                                min(CAST( st_cars_price AS DECIMAL)) AS min,
                                max(CAST( st_cars_price AS DECIMAL)) AS max
                                FROM
                                (
                                    SELECT CASE
                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != '' AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                THEN
                                                     CAST({$wpdb->prefix}{$post_type}.cars_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.cars_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                THEN
                                                     CAST({$wpdb->prefix}{$post_type}.cars_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.cars_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                ELSE {$wpdb->prefix}{$post_type}.cars_price

                                           END AS st_cars_price
                                    FROM
                                    {$wpdb->prefix}{$post_type}
                                    {$join}
                                    {$where}
                                )as st_table_cars";
					        $results = $wpdb->get_results($sql, OBJECT);
				        break;
			        case "st_tours":
					        $sql = "
                        select
                            min(CAST(st_{$post_type}_price AS DECIMAL)) AS min ,
                            max(CAST(st_{$post_type}_price AS DECIMAL)) AS max
                        from
                            (select
                                          CASE
                                                        WHEN {$wpdb->prefix}{$post_type}.adult_price != '0' and {$wpdb->prefix}{$post_type}.adult_price != ''
                                                                    THEN
                                                                    CASE
                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
                                                                                    AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                                    AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            ELSE {$wpdb->prefix}{$post_type}.adult_price
                                                                    END


                                                                    WHEN {$wpdb->prefix}{$post_type}.child_price != '0' and {$wpdb->prefix}{$post_type}.child_price != ''
                                                                    THEN
                                                                    CASE
                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
                                                                                    AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                                    AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            ELSE {$wpdb->prefix}{$post_type}.child_price
                                                                    END


                                                                    WHEN {$wpdb->prefix}{$post_type}.infant_price != '0' and {$wpdb->prefix}{$post_type}.infant_price != ''
                                                                    THEN
                                                                    CASE
                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
                                                                                    AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                                    AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                            THEN
                                                                                    CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                            ELSE {$wpdb->prefix}{$post_type}.infant_price
                                                                    END

                                                                    ELSE 0

                                                        END AS st_{$post_type}_price

                                         from {$wpdb->prefix}{$post_type}
                                         {$join}
                                         where (1=1 )
                                         and
                                            (
                                                {$wpdb->posts}.post_status = 'publish'
                                            )
                            ) as st_{$post_type}_price

                        ";
					        $results = $wpdb->get_results($sql, OBJECT);
				        break;
			        case "st_activity":
					        $sql = "
                    select
                        min(CAST(st_{$post_type}_price AS DECIMAL)) AS min ,
                        max(CAST(st_{$post_type}_price AS DECIMAL)) AS max
                    from
                        (select
                                      CASE
                                                    WHEN {$wpdb->prefix}{$post_type}.adult_price != '0' and {$wpdb->prefix}{$post_type}.adult_price != ''
                                                                THEN
                                                                CASE
    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
    																			AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																			AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.adult_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	ELSE {$wpdb->prefix}{$post_type}.adult_price
    															END


                                                                WHEN {$wpdb->prefix}{$post_type}.child_price != '0' and {$wpdb->prefix}{$post_type}.child_price != ''
                                                                THEN
                                                                CASE
    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
    																			AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																			AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.child_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	ELSE {$wpdb->prefix}{$post_type}.child_price
    															END


                                                                WHEN {$wpdb->prefix}{$post_type}.infant_price != '0' and {$wpdb->prefix}{$post_type}.infant_price != ''
                                                                THEN
                                                                CASE
    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
    																			AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																			AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
    																	THEN
    																			CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.infant_price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

    																	ELSE {$wpdb->prefix}{$post_type}.infant_price
    															END

                                                                ELSE 0

                                                    END AS st_{$post_type}_price

                                     from {$wpdb->prefix}{$post_type}
                                     {$join}
                                     where (1=1 )
                                     and
                                        (
                                            {$wpdb->posts}.post_status = 'publish'
                                        )
                        ) as st_{$post_type}_price

                    ";
					        $results = $wpdb->get_results($sql, OBJECT);
				        break;
		        }
		        self::$minMaxPrice['min_max_' . $post_type] = $results;
	        }
	        if (!empty($results[0]->min)) {
		        $price_min = $results[0]->min;
	        }
	        if (!empty($results[0]->max)) {
		        $price_max = $results[0]->max;
	        }
	        if (empty($price_max)) {
		        $price_max = 500;
	        } // default 0 500
	        if (empty($price_min)) {
		        $price_min = 0;
	        } // default 0
	        if ($price_max <= $price_min) {
		        $price_max = 2 * $price_min;
	        }
        }

        return ['price_min' => ceil($price_min), 'price_max' => ceil($price_max)];
    }

    static function get_list_location()
    {
        if (isset($_SESSION['list_location'])) {
            return $_SESSION['list_location'];
        }
        $getListFullNameLocation = TravelHelper::getListFullNameLocation();
        if (!empty($getListFullNameLocation) and is_array($getListFullNameLocation)) {
            $return = [];
            foreach ($getListFullNameLocation as $key => $value) {
                $return[] = ['title' => $value->post_title, 'id' => $value->ID];
            }

            return $return;
        }

        return false;
    }

    static function get_search_result_link($post_type = false)
    {
        $url = home_url('/');

        return apply_filters('st_' . $post_type . '_search_result_link', $url);
    }


    static function st_get_custom_price_by_date($post_id, $start_date = null, $price_type = 'default')
    {
        global $wpdb;
        if (!$post_id)
            $post_id = get_the_ID();
        if (empty($start_date))
            $start_date = date("Y-m-d");
        $rs = $wpdb->get_results("SELECT * FROM " . $wpdb->base_prefix . "st_price WHERE post_id=" . $post_id . " AND price_type='" . $price_type . "'  AND start_date <='" . $start_date . "' AND end_date >='" . $start_date . "' AND status=1 ORDER BY priority DESC LIMIT 1");
        if (!empty($rs)) {
            return $rs[0]->price;
        } else {
            return false;
        }
    }

    static function st_conver_info_price($info_price)
    {
        $list_info_price = '';
        if (!empty($info_price)) {
            $start = '';
            $end = '';
            $price = "";
            foreach ($info_price as $k => $v) {
                if (empty($price)) {
                    $start = $v['start'];
                    $end = $v['end'];
                    $price = $v['price'];
                    $list_info_price[$start] = [
                        'start' => $start,
                        'end' => $end,
                        'price' => $price,
                    ];
                }
                if ($price == $v['price']) {
                    $end = $v['end'];
                    $list_info_price[$start] = [
                        'start' => $start,
                        'end' => $end,
                        'price' => $price,
                    ];
                }
                if ($price != $v['price']) {
                    $start = $v['end'];
                    $end = $v['end'];
                    $price = $v['price'];

                    $list_info_price[$start] = [
                        'start' => $start,
                        'end' => $end,
                        'price' => $price,
                    ];

                }
            }
        }

        return $list_info_price;
    }

    /**
     * @since 1.1.1
     *
     *
     */
    static function get_book_btn($post_id = null)
    {
        if(!isset($post_id) or empty($post_id))
	        $post_id = get_the_ID();
        $class_room_btn = "";
        if (get_post_type($post_id) == "hotel_room") {
            $class_room_btn = "btn_hotel_booking";
        };
        ob_start();
        ?>
        <input type="submit" class=" btn btn-primary <?php echo esc_attr($class_room_btn); ?>"
               value="<?php esc_html_e('Book Now','traveler') ?>">
        <?php
        $book_now_btn = ob_get_clean();

        return $book_now_btn;
    }

    /**
     *
     *
     * @since 1.1.1
     *
     * @param int $room_id of booking item
     *
     * @return string type of reposit of booking item
     * */
    public function get_deposit_type($booking_id = null)
    {
        if (!$booking_id) {
            $booking_id = get_the_ID();
        }
        $status = get_post_meta($booking_id, 'deposit_payment_status', true);
        if ($status == 'amount') {
            $status = 'percent';
        }
        return $status;

    }

    /**
     *
     *
     * @since 1.1.1
     * */
    public function get_deposit_amount($booking_id = null)
    {
        if (!$booking_id) {
            $booking_id = get_the_ID();
        }

        return get_post_meta($booking_id, 'deposit_payment_amount', true);

    }

    /**
     *
     *
     * @since  1.1.1
     * @update 1.1.2
     * */
    public function get_deposit_money_amount($room_money, $booking_id = false)
    {
        if ($deposit_type = $this->get_deposit_type($booking_id) and $room_money) {
            $deposit_amount = $this->get_deposit_amount($booking_id);

            if ($deposit_amount) {
                switch ($deposit_type) {
                    case "percent":
                        $room_money = ($room_money / 100) * $deposit_amount;
                        break;

                    /*case 'amount':
                        $room_money = $deposit_amount;
                        break;*/

                }
            }

        }

        return $room_money;
    }

    /**
     *
     *
     * @since 1.1.1
     * */
    function _deposit_calculator($cart_data, $item_id)
    {
        if ($this->get_deposit_type($item_id) and $this->get_deposit_amount($item_id)) {

            $old_price = $cart_data['price'];

            $cart_data['price'] = $old_price;

            $cart_data['data']['deposit_money'] = [
                'type' => $this->get_deposit_type($item_id),
                'old_price' => $old_price,
                'amount' => $this->get_deposit_amount($item_id)
            ];
        }

        return $cart_data;
    }

    /**
     *
     *
     * @since 1.1.5
     * */
    static function _get_location_by_name($location_name)
    {
        if (empty($location_name))
            return $location_name;

        $ids = [];
        global $wpdb; //OR (" . $wpdb->posts . ".post_content LIKE '%" . $location_name . "%')


        if (defined('ICL_LANGUAGE_CODE')) {
            $query = "SELECT SQL_CALC_FOUND_ROWS  " . $wpdb->posts . ".ID
                FROM " . $wpdb->posts . "
                JOIN {$wpdb->prefix}icl_translations t ON {$wpdb->prefix}posts.ID = t.element_id
                AND t.element_type = 'post_location'
                JOIN {$wpdb->prefix}icl_languages l ON t.language_code = l. CODE
                AND l.active = 1
                WHERE 1=1
                AND t.language_code = '" . ICL_LANGUAGE_CODE . "'
                AND (((" . $wpdb->posts . ".post_title LIKE '%" . $location_name . "%') ))
                AND " . $wpdb->posts . ".post_type = 'location'
                AND ((" . $wpdb->posts . ".post_status = 'publish' OR " . $wpdb->posts . ".post_status = 'pending'))
                ORDER BY " . $wpdb->posts . ".post_title LIKE '%" . $location_name . "%' DESC, " . $wpdb->posts . ".post_date DESC LIMIT 0, 10";
        } else {
            $query = "SELECT SQL_CALC_FOUND_ROWS  " . $wpdb->posts . ".ID
                FROM " . $wpdb->posts . "
                WHERE 1=1
                AND (((" . $wpdb->posts . ".post_title LIKE '%" . $location_name . "%') ))
                AND " . $wpdb->posts . ".post_type = 'location'
                AND ((" . $wpdb->posts . ".post_status = 'publish' OR " . $wpdb->posts . ".post_status = 'pending'))
                ORDER BY " . $wpdb->posts . ".post_title LIKE '%" . $location_name . "%' DESC, " . $wpdb->posts . ".post_date DESC LIMIT 0, 10";
        }
        $data = $wpdb->get_results($query, OBJECT);
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $ids[] = $v->ID;
            }
        }

        return $ids;
    }

    /**
     * get current term by post id
     *
     *
     */
    static function get_term_list_by_id($post_id = null)
    {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        $list_taxonomy = st_list_taxonomy('st_tours');
        $array = [];
        if (!empty($list_taxonomy) and is_array($list_taxonomy)) {
            foreach ($list_taxonomy as $key => $value) {
                $array[$value] = (wp_get_post_terms($post_id, $value, []));
            }

        }

        return $array;
    }

    static function check_cancel_able($order_id)
    {
        global $wpdb;
        $return = FALSE;
        $user_id = get_current_user_id();

        $check_order = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}st_order_item_meta where user_id={$user_id} and  order_item_id=" . $order_id . " and `status`!='canceled' and `status`!='wc-canceled' LIMIT 0,1");
        if (!$check_order) {
            $return = FALSE;
        } else {
            $item_id = $check_order->st_booking_id;
            if ($check_order->room_id) $item_id = $check_order->room_id;
            $post_type = get_post_type($item_id);

            if (get_post_meta($item_id, 'st_allow_cancel', true) == 'on') {

                $days = (int)get_post_meta($item_id, 'st_cancel_number_days', true);
                if ($days >= 0) {
                    if (STDate::dateDiff(date('Y-m-d'), date('Y-m-d', strtotime($check_order->check_in))) > $days) {

                        $return = true;
                    } else {
                        $return = false;
                    }
                } else {
                    $return = true;
                }
            }

            $return = apply_filters('st_check_cancel_able_' . $post_type, $return, $order_id, $item_id);

        }

        return $return = apply_filters('st_check_cancel_able', $return, $order_id);

    }

    // from 1.1.9
    function _show_wc_cart_item_information_btn($cart_item_key = [])
    {
        //print balancetags("<br><p class ='btn btn-primary' data-toggle='collapse' data-target='#st_cart_item".md5(json_encode($cart_item_key))."'>".__("Details" , ST_TEXTDOMAIN)."</p>");
        print balancetags('<br><span data-hide = "' . __("Less", ST_TEXTDOMAIN) . ' <i class=&quot;fa fa-angle-up&quot;>" data-target= "#st_cart_item' . md5(json_encode($cart_item_key)) . '" data-toggle="collapse" class="_show_wc_cart_item_information_btn text-color booking-item-review-expand-more">' . __("More", ST_TEXTDOMAIN) . ' <i class="fa fa-angle-down"></i></span>');
    }


    function st_custom_menu_mobile_item($items, $args)
    {
        if ($args->theme_location == 'primary') {
            $html = st()->load_template('menu/mobile/login_select');
            $html .= st()->load_template('menu/mobile/language_select');
            $html .= st()->load_template('menu/mobile/currency_select');

            $sort_topbar_menu = st()->get_option('sort_topbar_menu', false);
            $hidden_topbar_onmobile = st()->get_option('hidden_topbar_in_mobile', 'on');
            $check = true;
            if($hidden_topbar_onmobile != 'on'){
	            if ($sort_topbar_menu) {
		            foreach ( $sort_topbar_menu as $key => $val ) {
			            if ($val['topbar_item'] == 'shopping_cart') {
			                $check = false;
			                break;
			            }
		            }
	            }
            }

            if($check){
	            $html .= st()->load_template("menu/mobile/shopping_cart", null, ['container' => "li", "class" => "top-user-area-shopping"]);
            }
            $items .= $html;

        }

        return $items;
    }

}

$a = new TravelerObject();
$a->_class_init();
