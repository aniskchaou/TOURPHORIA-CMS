<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STReview
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STReview' ) ) {
        class STReview
        {

            protected static $reviewStatsData=[];
            protected static $reviewData=[];
        	protected static $rateData=[];
        	protected static $countComments=[];
            function __construct()
            {

            }

            function init()
            {
                //add_action('preprocess_comment' , array($this,'st_preprocess_comment_func')) ;
                add_action( 'comment_post', [ $this, 'save_comment_meta_data' ] );

                add_action( 'wp_ajax_like_review', [ $this, 'like_review' ] );
                add_action( 'wp_ajax_nopriv_like_review', [ $this, 'like_review' ] );
                add_action( 'init', [ $this, "insert_comment_user" ] );

                // from 1.2.3 filter for reviews when disable service
                if ( !is_admin() ) {
                    add_filter( 'comments_clauses', [ $this, 'st_comments_clauses' ], 10, 2 );
                    add_filter( 'wp_count_comments', [ $this, 'st_wp_count_comments' ], 10, 3 );
                }

                add_filter( 'notify_moderator', [ $this, '_check_notify_moderator' ] );
                add_filter( 'notify_post_author', [ $this, '_check_notify_post_author' ] );

                add_action( 'pre_comment_on_post', [ $this, '_check_pre_comment_on_post' ] );

            }

            /**
             *
             * @since 1.2.4
             * by quandq
             * dis email to admin
             */
            function _check_notify_moderator()
            {
                if ( current_user_can( 'manage_options' ) ) {
                    return false;
                }
                if ( st()->get_option( 'is_review_must_approved', 'on' ) == 'on' ) {
                    return true;
                } else {
                    return false;
                }
            }

            /**
             *
             * @since 1.2.4
             * by quandq
             * dis email to author
             */
            function _check_notify_post_author()
            {
                return true;
                if ( current_user_can( 'manage_options' ) ) {
                    return false;
                }
                if ( st()->get_option( 'is_review_must_approved', 'on' ) == 'on' ) {
                    return true;
                } else {
                    return false;
                }
            }

            function _check_pre_comment_on_post( $post_id )
            {

                if ( is_user_logged_in() == false ) {

                    global $wpdb;

                    $email = $_POST[ 'email' ];

                    $query = "SELECT count({$wpdb->comments}.comment_ID) from {$wpdb->comments} WHERE comment_post_ID = {$post_id} and  comment_author_email  = '{$email}'  and comment_approved != 'trash'";

                    $count = $wpdb->get_var( $query );

                    if ( $count > 0 and st()->get_option( 'review_once', 'on' ) == 'on' ) {

                        $url = get_the_permalink( $post_id );

                        wp_redirect( $url );

                        exit();

                    }
                }

            }


            /**
             *
             * @since 1.1.0
             *
             */

            function insert_comment_user()
            {

                if ( STInput::post( 'comment_post_ID' ) ) {
                    $user = new STUser_f();
                    $user->st_write_review();
                }
            }

            function like_review()
            {

                $comment_id = STInput::post( 'comment_ID' );

                if ( $this->find_by( $comment_id ) ) {

                    $comment_like_count = get_comment_meta( $comment_id, "_comment_like_count", true ); // comment like count

                    $data = [
                        'like_status' => true,
                        'message'     => __( 'You like this', ST_TEXTDOMAIN ),
                        'like_count'  => $comment_like_count
                    ];

                    //For logged user
                    if ( is_user_logged_in() ) {
                        $user_id = get_current_user_id(); // current user

                        $meta_COMMENTS = get_user_option( "_liked_comments", $user_id ); // comments ids from user meta

                        $meta_USERS = get_comment_meta( $comment_id, "_user_liked" ); // user ids from comment meta


                        $liked_COMMENTS = NULL; // setup array variable
                        $liked_USERS    = NULL; // setup array variable

                        if ( count( $meta_COMMENTS ) != 0 ) { // meta exists, set up values
                            $liked_COMMENTS = $meta_COMMENTS;
                        }

                        if ( !is_array( $liked_COMMENTS ) ) // make array just in case
                            $liked_COMMENTS = [];

                        if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
                            $liked_USERS = $meta_USERS[ 0 ];
                        }
                        if ( !is_array( $liked_USERS ) ) // make array just in case
                            $liked_USERS = [];

                        $liked_COMMENTS[ 'comment-' . $comment_id ] = $comment_id; // Add comment id to user meta array
                        $liked_USERS[ 'user-' . $user_id ]          = $user_id; // add user id to comment meta array
                        $user_likes                                 = count( $liked_COMMENTS ); // count user likes

                        if ( !$this->check_like( $comment_id ) ) { // like the comment

                            update_comment_meta( $comment_id, "_user_liked", $liked_USERS ); // Add user ID to comment meta
                            update_comment_meta( $comment_id, "_comment_like_count", ++$comment_like_count ); // +1 count comment meta
                            update_user_option( $user_id, "_liked_comments", $liked_COMMENTS ); // Add comment ID to user meta
                            update_user_option( $user_id, "_user_like_count", $user_likes ); // +1 count user meta


                            $data[ 'like_count' ] = $comment_like_count;

                        } else { // unlike the comment
                            $pid_key = array_search( $comment_id, $liked_COMMENTS ); // find the key
                            $uid_key = array_search( $user_id, $liked_USERS ); // find the key
                            unset( $liked_COMMENTS[ $pid_key ] ); // remove from array
                            unset( $liked_USERS[ $uid_key ] ); // remove from array
                            $user_likes = count( $liked_COMMENTS ); // recount user likes
                            update_comment_meta( $comment_id, "_user_liked", $liked_USERS ); // Remove user ID from comment meta
                            update_comment_meta( $comment_id, "_comment_like_count", --$comment_like_count ); // -1 count comment meta
                            update_user_option( $user_id, "_liked_comments", $liked_COMMENTS ); // Remove comment ID from user meta
                            update_user_option( $user_id, "_user_like_count", $user_likes ); // -1 count user meta


                            $data[ 'like_status' ] = false;
                            $data[ 'like_count' ]  = $comment_like_count;
                            $data[ 'message' ]     = false;
                        }


                    } else {
                        // user is not logged in (anonymous)
                        $ip        = STInput::ip_address(); // user IP address
                        $meta_IPS  = get_comment_meta( $comment_id, "_user_IP" ); // stored IP addresses
                        $liked_IPS = NULL; // set up array variable

                        if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
                            $liked_IPS = $meta_IPS[ 0 ];
                        }

                        if ( !is_array( $liked_IPS ) ) // make array just in case
                            $liked_IPS = [];

                        if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
                            $liked_IPS[ 'ip-' . $ip ] = $ip; // add IP to array

                        if ( !$this->check_like( $comment_id ) ) { // like the comment
                            update_comment_meta( $comment_id, "_user_IP", $liked_IPS ); // Add user IP to comment meta
                            update_comment_meta( $comment_id, "_comment_like_count", ++$comment_like_count ); // +1 count comment meta
                            $data[ 'like_count' ] = $comment_like_count;

                        } else { // unlike the comment
                            $ip_key = array_search( $ip, $liked_IPS ); // find the key
                            unset( $liked_IPS[ $ip_key ] ); // remove from array
                            update_comment_meta( $comment_id, "_user_IP", $liked_IPS ); // Remove user IP from comment meta
                            update_comment_meta( $comment_id, "_comment_like_count", --$comment_like_count ); // -1 count comment meta

                            $data[ 'like_status' ] = false;
                            $data[ 'like_count' ]  = $comment_like_count;
                            $data[ 'message' ]     = false;

                        }
                    }

                    echo json_encode( [
                        'status' => 1,
                        'data'   => $data
                    ] );


                } else {
                    echo json_encode( [
                        'status' => 0,
                        'error'  => [
                            'error_code'    => 'comment_not_exists',
                            'error_message' => __( 'Review does not exists', ST_TEXTDOMAIN )
                        ]
                    ] );
                }

                exit();


            }

            function check_like( $comment_id )
            { // test if user liked before
                if ( is_user_logged_in() ) { // user is logged in
                    $user_id     = get_current_user_id(); // current user
                    $meta_USERS  = get_comment_meta( $comment_id, "_user_liked" ); // user ids from comment meta
                    $liked_USERS = ""; // set up array variable

                    if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
                        $liked_USERS = $meta_USERS[ 0 ];
                    }

                    if ( !is_array( $liked_USERS ) ) // make array just in case
                        $liked_USERS = [];

                    if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
                        return true;
                    }

                    return false;

                } else { // user is anonymous, use IP address for voting

                    $meta_IPS = get_comment_meta( $comment_id, "_user_IP" ); // get previously voted IP address
                    $ip       = STInput::ip_address();

                    $liked_IPS = ""; // set up array variable

                    if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
                        $liked_IPS = $meta_IPS[ 0 ];
                    }

                    if ( !is_array( $liked_IPS ) ) // make array just in case
                        $liked_IPS = [];

                    if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
                        return true;
                    }

                    return false;
                }

            }


            function find_by( $comment_id = false, $key = 'comment_ID' )
            {
                if ( $comment_id and $key ) {
                    global $wpdb;

                    $query = "SELECT count({$wpdb->comments}.comment_ID) as total from {$wpdb->comments} WHERE 1=1 ";


                    $query .= " and {$key}='{$comment_id}'";

                    $count = $wpdb->get_var( $query );

                    return $count;
                }
            }

            /**
             * @since 1.1.0
             *
             */

            function check_anymous_user_email()
            {


                $current_email = STInput::request( 'email' );
                if ( !$current_email ) {
                    return false;
                }
                global $wpdb;
                $query = "SELECT count({$wpdb->comments}.comment_ID) from {$wpdb->comments} WHERE comment_author_email  = '{$current_email}'  ";

                $count = $wpdb->get_var( $query );
                if ( $count > 1 ) {
                    return false;
                }

                return true;

            }

            function save_comment_meta_data( $comment_id )
            {

                if ( ( isset( $_POST[ 'comment_title' ] ) ) && ( $_POST[ 'comment_title' ] != '' ) ) {
                    $title = wp_filter_nohtml_kses( $_POST[ 'comment_title' ] );
                    add_comment_meta( $comment_id, 'comment_title', $title );
                }

                if ( ( isset( $_POST[ 'comment_rate' ] ) ) && ( $_POST[ 'comment_rate' ] != '' ) ) {
                    $rate = wp_filter_nohtml_kses( $_POST[ 'comment_rate' ] );
                    if ( $rate > 5 ) {
                        //Max rate is 5
                        $rate = 5;
                    }
                    add_comment_meta( $comment_id, ' q', $rate );
                }

                $all_postype = st()->booking_post_type();

                $current_post_type = get_post_type( get_comment( $comment_id )->comment_post_ID );

                global $wpdb;
                $array = [ 'comment_type' => 'st_reviews', 'comment_approved' => 1 ];

                if ( st()->get_option( 'is_review_must_approved', 'on' ) == 'on' ) $array[ 'comment_approved' ] = 0;
                if ( is_super_admin() ) {
                    $array[ 'comment_approved' ] = 1;
                }

                $wpdb->update( $wpdb->comments, $array, [ 'comment_ID' => $comment_id ] );

                $comemntObj = get_comment( $comment_id );
                $post_id    = $comemntObj->comment_post_ID;

                $avg = STReview::get_avg_rate( $post_id );
                update_post_meta( $post_id, 'rate_review', $avg );


            }

            static function count_comment( $post_id = false, $comment_type = false )
            {

                if ( $post_id ) {
                    global $wpdb;

                    $query = 'SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' WHERE 1=1 ';


                    if ( $post_id ) {
                        $query .= ' AND comment_post_ID="' . sanitize_title_for_query( $post_id ) . '"';
                    }

                    if ( $comment_type ) {
                        $query .= ' AND comment_type="' . sanitize_title_for_query( $comment_type ) . '"';
                    }

                    $count = $wpdb->get_var( $query );


                    return $count;
                }
            }

            static function data_comment_author_page( $post_id = false, $comment_type = false )
            {

                if ( !empty($post_id) ) {
                    global $wpdb;

                    $query = 'SELECT comment_ID FROM ' . $wpdb->comments . ' WHERE 1=1 ';


                    if ( $post_id ) {
                        $query .= ' AND comment_post_ID IN (' . implode(',', $post_id) . ')';
                    }

                    if ( $comment_type ) {
                        $query .= ' AND comment_type="' . sanitize_title_for_query( $comment_type ) . '"';
                    }

                    $data = $wpdb->get_results( $query,ARRAY_A );


                    return $data;
                }
            }

            static function count_review( $post_id = false )
            {
                return self::count_comment( $post_id, "st_reviews" );
            }

            static function get_avg_rate( $post_id = false )
            {
                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }

                if ( $post_id ) {

                	if(array_key_exists($post_id,self::$rateData)) return self::$rateData[$post_id];

                    global $wpdb;

                    $query = "SELECT ROUND( AVG(meta_value),1 ) as avg_rate from {$wpdb->comments} join {$wpdb->commentmeta} on {$wpdb->comments}.comment_ID={$wpdb->commentmeta}.comment_ID where 1=1";

                    $query .= " and `comment_type`='st_reviews' ";
                    $query .= " and `comment_approved`=1 ";

                    $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";

                    $query .= "  and meta_key='comment_rate' ";


                    $rate= (float) $wpdb->get_var( $query );

                    self::$rateData[$post_id]=$rate;

                    return $rate;
                }

                return 0;
            }

            static function get_percent_recommend( $post_id = false, $min_rate = 3 )
            {
                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }

                if ( $post_id ) {

                    $total = get_comments_number( $post_id );

                    global $wpdb;

                    $query = "SELECT count({$wpdb->comments}.comment_ID) as total from {$wpdb->comments} join {$wpdb->commentmeta} on {$wpdb->comments}.comment_ID={$wpdb->commentmeta}.comment_ID where 1=1";

                    $query .= " and `comment_type`='st_reviews' ";

                    $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";

                    $query .= " and `comment_approved`=1 ";


                    $query .= " and meta_value>='" . sanitize_title_for_query( $min_rate ) . "'";


                    $query .= "  and meta_key='comment_rate' ";


                    $count = $wpdb->get_var( $query );

                    if ( !$total ) return 0;

                    $percent = round( ( $count / $total ) * 100 );

                    if ( $percent > 100 )
                        $percent = 100;

                    return $percent;
                }
            }

            static function count_review_by_rate( $post_id = false, $rate = '' )
            {
                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }
                if(array_key_exists($post_id .'_'. $rate,self::$reviewData)) return self::$reviewData[$post_id . '_' . $rate];

                if ( $post_id ) {

                    global $wpdb;

                    $query = "SELECT count({$wpdb->comments}.comment_ID) as total from {$wpdb->comments} join {$wpdb->commentmeta} on {$wpdb->comments}.comment_ID={$wpdb->commentmeta}.comment_ID where 1=1";

                    $query .= " and `comment_type`='st_reviews'";

                    $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";


                    $query .= " and meta_value>='" . sanitize_title_for_query( $rate ) . "'";
                    $query .= " and meta_value<'" . sanitize_title_for_query( $rate + 1 ) . "'";
                    $query .= " and `comment_approved`=1 ";

                    $query .= "  and meta_key='comment_rate' ";

                    $count = $wpdb->get_var( $query );

                    self::$reviewData[$post_id]=$count;

                    return $count;
                }
            }

            static function get_avg_stat( $post_id = false, $stat = false )
            {
                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }
                $key=$post_id.'_'.$stat;
                if(array_key_exists($key,self::$reviewStatsData)) return self::$reviewStatsData[$key];

                if ( $post_id and $stat ) {
                    $stat = sanitize_title( $stat );
                    global $wpdb;

                    $query = "SELECT avg({$wpdb->commentmeta}.meta_value) as avg_rate from {$wpdb->comments} join {$wpdb->commentmeta} on {$wpdb->comments}.comment_ID={$wpdb->commentmeta}.comment_ID where 1=1";

                    $query .= " and `comment_type`='st_reviews'";

                    $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";

                    $query .= " and `comment_approved`=1 ";

                    $query .= " and meta_key='st_stat_$stat' ";


                    $count = $wpdb->get_var( $query );

                    self::$reviewStatsData[$key]=$count;

                    return $count;
                }
            }

            static function user_booked( $post_id = false )
            {
                if ( !$post_id ) $post_id = get_the_ID();
                if ( !is_user_logged_in() ) {
                    return false;
                }
                $post_type = get_post_type( $post_id );

                $user_id = get_current_user_id();

                $allow_review = true;
                switch ( $post_type ) {
                    case "st_hotel":
                        //Search Order By Customer ID
                        $order = new STOrder();
                        $count = $order->check_user_booked( $user_id, $post_id, $post_type );

                        if ( $count < 1 ) {
                            $allow_review = FALSE;
                        }
                        break;

                    case "st_rental":
                        //Search Order By Customer ID
                        $order = new STOrder();
                        $count = $order->check_user_booked( $user_id, $post_id, $post_type );

                        if ( $count < 1 ) {
                            $allow_review = FALSE;
                        }
                        break;
                    case "st_cars":
                        //$allow_review= True;
                        $order = new STOrder();
                        $count = $order->check_user_booked( $user_id, $post_id, $post_type );
                        if ( $count < 1 ) {
                            $allow_review = FALSE;
                        }
                        break;
                    case "st_tours":
                    case "st_activity":
                        //Search Order By Customer ID
                        $order = new STOrder();
                        $count = $order->check_user_booked( $user_id, $post_id, $post_type );

                        if ( $count < 1 ) {
                            $allow_review = FALSE;
                        }
                        break;
                        break;


                    default:
                        $allow_review = FALSE;
                        break;
                }

                return $allow_review;


            }

            static function check_reviewed( $post_id = false )
            {

                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }
                if ( !is_user_logged_in() ) {
                    return false;
                } else {
                    if ( self::count_user_comment( $post_id ) >= 1 ) {
                        return true;
                    }
                }

                return false;
            }

            static function check_reviewable( $post_id = false )
            {
                if ( !$post_id ) {
                    $post_id = get_the_ID();
                }

                if ( self::count_user_comment( $post_id ) >= 1 ) {
                    return false;
                }

                $is_review_need_booked = self::is_review_need_booked();
                if ( $is_review_need_booked ) {
                    return self::user_booked( $post_id );
                } else {
                    return true;
                }

            }

            /**
             *
             * @since 1.1.0
             */

            static function check_review_without_login()
            {


                return apply_filters( 'st_is_review_need_booked', st()->get_option( 'review_without_login', "off" ) == "on" );

            }

            /**
             *
             * @since 1.1.0
             */

            static function is_review_need_booked()
            {

                return apply_filters( 'is_review_need_booked', st()->get_option( 'review_need_booked', 'on' ) == "on" );
            }

            /**
             *
             * @since  1.1.0
             * @update count all guest comment  and user comment
             *
             */
            static function count_all_comment( $post_id = false )
            {

                if ( !$post_id ) $post_id = get_the_ID();

                if(array_key_exists($post_id,self::$countComments)) return self::$countComments[$post_id];
                global $wpdb;
                $query = "SELECT count({$wpdb->comments}.comment_ID) as total from {$wpdb->comments}  where 1=1";

                $query .= " and `comment_type`='st_reviews'";

                $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";
                $query .= " and comment_approved=1";

                $count= $wpdb->get_var( $query );
                self::$countComments[$post_id]=$count;
                return $count;
            }

            static function count_user_comment( $post_id = false )
            {

                if ( !$post_id ) $post_id = get_the_ID();

                $user    = wp_get_current_user();
                $user_id = get_current_user_id();
                //$email=$user->user_email;


                global $wpdb;

                $query = "SELECT count({$wpdb->comments}.comment_ID) as total from {$wpdb->comments}  where 1=1";

                $query .= " and `comment_type`='st_reviews'";

                $query .= " and comment_post_ID='" . sanitize_title_for_query( $post_id ) . "'";
                //$query.=" and comment_author_email='".sanitize_email($email)."'";
                $query .= " and user_id='" . $user_id . "'";
                $query .= " and comment_approved=1";


                $count = $wpdb->get_var( $query );

                return $count;
            }

            // from 1.1.8
            static function comments_open( $post_id )
            {
                $post = get_post( $post_id, ARRAY_A );
                if ( !$post ) {
                    return false;
                }
                if ( $post[ 'comment_status' ] == 'open' ) {
                    return true;
                } else {
                    return false;
                }

            }

            /**
             * from 1.1.7
             */

            static function review_check( $item_id = null )
            {

                wp_reset_postdata();

                if ( !$item_id ) {
                    return;
                }


                if ( !is_user_logged_in() and st()->get_option( 'review_without_login' ) == "off" ) {
                    return "must_login";
                }

                if ( !self::comments_open( $item_id ) ) {
                    return "need_open";
                }

                if ( self::check_reviewed( $item_id ) and st()->get_option( 'review_once' ) == "on" ) {
                    return "reviewed";
                }

                if ( st()->get_option( 'review_need_booked' ) == 'on' ) {

                    $st_orders = new STOrder();
                    $user_id   = get_current_user_id();

                    if ( !$st_orders->check_user_booked2( $user_id, $item_id ) ) {
                        return "need_booked";
                    }
                    if ( !( $st_orders->check_booked_date( $item_id, $user_id ) ) ) {
                        return "wait_check_out_date";
                    }
                }

                return "true";

            }

            // from 1.2.3
            function st_comments_clauses( $sql )
            {
                global $wpdb;

                if ( strpos( $sql[ 'join' ], 'JOIN ' . $wpdb->posts ) === FALSE ) {
                    $st_comments_clauses = 'st_comments_clauses';
                    $sql[ 'join' ] .= " join {$wpdb->prefix}posts as st_comments_clauses on st_comments_clauses.ID = {$wpdb->prefix}comments.comment_post_ID ";
                } else {
                    $st_comments_clauses = $wpdb->posts;
                }

                if ( empty( $sql[ 'where' ] ) ) {
                    $sql[ 'where' ] .= " (1=1) ";
                } else {
                    $sql[ 'where' ] .= " ";
                }
                $option       = get_option( st_options_id() );
                $disable_list = isset( $option[ 'list_disabled_feature' ] ) ? $option[ 'list_disabled_feature' ] : [];
                if(!is_array($disable_list))
                	$disable_list = [];
                if ( in_array( 'st_hotel', $disable_list ) ) {
                    $disable_list[] = "hotel_room";
                }
                $disable_list[] = "rental_room";
                if ( !empty( $disable_list ) and is_array( $disable_list ) ) {
                    foreach ( $disable_list as $key => $item ) {
                        $disable_list[ $key ] = "'" . $item . "'";
                    }
                }
                $disable_list = implode( ',', $disable_list );
                if ( empty( $disable_list ) ) $disable_list = "''";
                $sql[ 'where' ] .= " AND " . $st_comments_clauses . ".post_type NOT IN ({$disable_list}) ";

                return $sql;
            }

            // from 1.2.3
            function st_wp_count_comments( $stats, $post_id )
            {
                if(is_page_template('template-flights-search.php')) return $stats;
                if ( 0 === $post_id ) {
                    global $wpdb;
                    // WC_Comments=> wp_count_comments
                    //$approved = array( '0' => 'moderated', '1' => 'approved', 'spam' => 'spam', 'trash' => 'trash', 'post-trashed' => 'post-trashed' );
                    $join = " join {$wpdb->prefix}posts as st_comments_clauses on st_comments_clauses.ID = {$wpdb->prefix}comments.comment_post_ID ";

                    $where        = " (1=1) and ";
                    $option       = get_option( st_options_id());
                    $disable_list = (isset( $option[ 'list_disabled_feature' ] ) and is_array($option[ 'list_disabled_feature' ])) ? $option[ 'list_disabled_feature' ] : [];
                    if ( in_array( 'st_hotel', $disable_list ) ) {
                        $disable_list[] = "hotel_room";
                    }
                    $disable_list[] = "rental_room";
                    if ( !empty( $disable_list ) and is_array( $disable_list ) ) {
                        foreach ( $disable_list as $key => $item ) {
                            $disable_list[ $key ] = "'" . $item . "'";
                        }
                    }

                    $disable_list = implode( ',', $disable_list );
                    if ( empty( $disable_list ) ) $disable_list = "''";
                    $where .= " st_comments_clauses.post_type NOT IN ({$disable_list}) ";
                    $sql     = "select  count(*) as count_all, comment_approved as status from {$wpdb->prefix}comments  {$join} WHERE {$where} GROUP BY comment_approved";
                    $results = $wpdb->get_results( $sql );
                    if ( !$stats ) $stats = (object) [ 'approved' => 1, 'trash' => 1, 'spam' => 1, 'moderated' => 1, 'total_comments' => 1, 'all' => 1 ];
                    if ( !empty( $results ) and is_array( $results ) ) {
                        foreach ( $results as $key => $value ) {
                            switch ( $value->status ) {
                                case '1':
                                    $stats->approved = intval( $value->count_all );
                                    break;
                                case 'trash':
                                    $stats->trash = intval( $value->count_all );
                                    break;
                                case 'spam':
                                    $stats->spam = intval( $value->count_all );
                                    break;
                                default:
                                    $stats->moderated = intval( $value->count_all );
                                    break;
                            }
                        }
                        $stats->all            = $stats->approved + $stats->moderated;
                        $stats->total_comments = $stats->approved + $stats->moderated;
                    }
                }

                return $stats;
            }

            static function get_review_stats($post_id = false){
                if(!$post_id) $post_id = get_the_ID();

                $post_type = get_post_type($post_id);
                $key = '';
                switch($post_type){
                    case "st_hotel":
                        $key = 'hotel_review_stats';
                        break;
                    case "st_rental":
                        $key = 'rental_review_stats';
                        break;
                    case "st_cars":
                        $key = 'car_review_stats';
                        break;
                    case "st_tours":
                        $key = 'tour_review_stats';
                        break;
                    case "st_activity":
                        $key = 'activity_review_stats';
                        break;
                }

                $list_star = st()->get_option($key);
                return $list_star;
            }

        }

        $a = new STReview();

        $a->init();
    }
