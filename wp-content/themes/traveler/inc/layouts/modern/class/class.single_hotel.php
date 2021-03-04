<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/25/2019
 * Time: 2:06 PM
 */
class ST_Single_Hotel extends TravelerObject{
    static $_inst;

    public function __construct(){
        add_action('wp_ajax_sts_filter_room_ajax', array($this, '__singleRoomFilterAjax'));
        add_action('wp_ajax_nopriv_sts_filter_room_ajax', array($this, '__singleRoomFilterAjax'));
    }

    public function getMaxPeopleSearchForm($key = false){
        $res = 20;
        switch ($key){
            case 'adult':
                $res = st()->get_option('st_hotel_alone_max_adult', 20);
                if(empty($res) || !is_numeric($res))
                    $res = 20;
                break;
            case 'child':
                $res = st()->get_option('st_hotel_alone_max_child', 20);
                if(empty($res) || !is_numeric($res))
                    $res = 20;
                break;
            default:
                $res = st()->get_option('st_hotel_alone_max_adult', 20);
                if(empty($res) || !is_numeric($res))
                    $res = 20;
                break;
        }

        return $res;
    }

    public function __singleRoomFilterAjax(){
        $this->checkSecurity();
        set_query_var('paged', STInput::get('page', 1));

        $layout_val = STInput::get('layout', 'list');

        $res = '<div class="st-loader"></div>';

        $this->setQueryRoomSearch();
        if (have_posts()) {
            if($layout_val == 'grid')
                $res .= '<div class="row">';
            while (have_posts()) {
                the_post();
                $res .= st()->load_template('layouts/modern/single_hotel/elements/loop/' . $layout_val);
            }
            if($layout_val == 'grid')
                $res .= '</div>';
            $res .= st()->load_template('layouts/modern/single_hotel/elements/pag');
        } else {
            $res .= st()->load_template('layouts/modern/single_hotel/elements/loop/none');
        }
        wp_reset_postdata();
        wp_reset_query();

        echo json_encode(array(
                'status' => true,
                'content' => $res
            ));
        die;
    }

    public function setQueryRoomSearch()
    {
        global $wp_query, $st_search_query;

        $this->startInjectQuery();

        $paged = get_query_var('paged') ? get_query_var('paged'): '1';

        $args = [
            'post_type'   => 'hotel_room',
            's'           => '',
            'post_status' => [ 'publish' ],
            'paged'       => $paged,
        ];

        query_posts( $args );

        $st_search_query = $wp_query;
        $this->endInjectQuery();
    }

    public function startInjectQuery(){
        add_action('pre_get_posts', array($this, '__changeSearchRoomArgs'));
        add_filter( 'posts_where', array($this, '__changeWhereQuery' ));
        add_action( 'posts_fields', array( $this, '__changePostField' ));
        add_filter( 'posts_join', array( $this, '__changeJoinQuery' ));
        add_filter('posts_groupby', array($this, '__changeGroupBy'));
    }

    public function endInjectQuery(){
        remove_action('pre_get_posts', array($this, '__changeSearchRoomArgs'));
        remove_filter( 'posts_where', array($this, '__changeWhereQuery' ));
        remove_action( 'posts_fields', array( $this, '__changePostField' ));
        remove_filter( 'posts_join', array( $this, '__changeJoinQuery' ));
        remove_filter('posts_groupby', array($this, '__changeGroupBy'));
    }

    public function __changeGroupBy( $groupby )
    {
        global $wpdb;
        if ( !$groupby or strpos( $wpdb->posts . '.ID', $groupby ) === false ) {
            $groupby .= $wpdb->posts . '.ID ';
        }
        return $groupby;
    }

    public function __changeSearchRoomArgs($query){
        $post_type = get_query_var( 'post_type' );
        if($post_type == 'hotel_room'){
            $query->set( 'author', '' );

            $posts_per_page = st()->get_option('st_hotel_alone_room_search_page_number', '6');
            if(!is_numeric($posts_per_page)){
                $posts_per_page = 6;
            }

            $query->set( 'posts_per_page', $posts_per_page );

            $term_id = STInput::get('term_id', '');
            $taxonomy_filtered = st()->get_option('st_hotel_alone_tax_in_room_page');
            if(!empty($taxonomy_filtered)) {
                if ($term_id != 'all') {
                    if (!empty($term_id)) {
                        $tax_query[] = [
                            [
                                'taxonomy' => $taxonomy_filtered,
                                'field' => 'id',
                                'terms' => $term_id,
                            ],
                        ];
                        $query->set('tax_query', $tax_query);
                    }
                }
            }
        }
    }

    public function __changeWhereQuery($where){
        global $wpdb;
        $check_in = STInput::get('check_in');
        $check_out = STInput::get('check_out');

        $hotel_parent = st()->get_option('hotel_alone_assign_hotel');

        $sql = $wpdb->prepare( ' AND parent_id = %d ', $hotel_parent );

        $adult_number = STInput::get('adult_num_search', 0);
        if(intval($adult_number) < 0) $adult_number = 0;

        $child_number = STInput::get('children_num_search', 0);
        if(intval($child_number) < 0) $child_number = 0;

        if(!empty($check_in) && !empty($check_out)) {
            $check_in = strtotime(TravelHelper::convertDateFormat($check_in));
            $check_out = strtotime(TravelHelper::convertDateFormat($check_out));

            //$allow_full_day = get_post_meta( $hotel_parent, 'allow_full_day', true );
            //$whereNumber = " AND check_in <= %d AND (number  - IFNULL(number_booked, 0)) >= 0";
            //if ( $allow_full_day == 'off' ) {
                $whereNumber = "AND check_in < %d AND (number  - IFNULL(number_booked, 0) + IFNULL(number_end, 0)) >= 0";
            //}

            $sql2 = "
                        AND check_in >= %d
                        {$whereNumber}
                        AND status = 'available'
                        AND adult_number>=%d
                        AND child_number>=%d
                    ";
            $sql  .= $wpdb->prepare( $sql2, $check_in, $check_out, $adult_number, $child_number );

            /*$res_room = ST_Hotel_Room_Availability::inst()
                ->select('post_id')
                ->where('check_in >=', $check_in)
                ->where('check_out <=', $check_out)
                ->where( "(status = 'unavailable' OR IFNULL(adult_number, 0) < {$adult_number} OR IFNULL(child_number, 0) < {$child_number} OR (CASE WHEN number > 0 THEN IFNULL(number, 0) - IFNULL(number_booked, 0) <= 0 END ) )", null, true )
                ->groupby('post_id')
                ->get()->result();

            $res = [];
            if(!empty($res_room)){
                foreach ($res_room as $k => $v){
                    if(!in_array($v['post_id'], $res))
                        array_push($res, $v['post_id']);
                }
            }

            if(!empty($res)){
                $list_unavailable_room = implode(',', $res);
                $where .= " AND {$wpdb->prefix}posts.ID NOT IN ($list_unavailable_room)";
            }*/
        }
        $where .= $sql;

        return $where;
    }

    public function __changeJoinQuery($join){
        global $wpdb;
        $table = $wpdb->prefix . 'st_room_availability';
        $table2 = $wpdb->prefix . 'hotel_room';
        $join .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";
        return $join;
    }

    public function __changePostField($fields){
        $fields .= ', SUM(CAST(tb.price AS DECIMAL)) as st_price, (IFNULL(number, 0) - IFNULL(number_booked, 0)) as remaining_number';
        return $fields;
    }

    static function inst(){
        if ( !self::$_inst ) {
            self::$_inst = new self();
        }
        return self::$_inst;
    }
}

ST_Single_Hotel::inst();