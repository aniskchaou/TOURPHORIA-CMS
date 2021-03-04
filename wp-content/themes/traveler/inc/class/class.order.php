<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STOrder
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STOrder' ) ) {
        class STOrder extends TravelerObject
        {

            function init()
            {
                parent::init();
                $this->init_metabox();

            }


            function count_order( $where = false )
            {
                global $wpdb;

                $query = "SELECT count({$wpdb->posts}.ID) as total from {$wpdb->posts} join {$wpdb->postmeta} on {$wpdb->posts}.ID={$wpdb->postmeta}.post_id where 1=1";

                $query .= " and `post_type`='st_order' ";

                $query .= $where;

                $count = $wpdb->get_var( $query );

                return $count;
            }

            /** from 1.1.8 */
            function check_booked_date( $item_id, $user_id = null )
            {

                $today = strtotime( date( 'Y-m-d' ) ); //1441065600
                if ( !$user_id ) $user_id = get_current_user_id();

                global $wpdb;

                $sql = "
                select count(id) as count from {$wpdb->prefix}st_order_item_meta
                where (1=1)
                and 
                    user_id = {$user_id}
                and 
                    (status = 'complete' or status = 'wc-completed' or status = 'completed' )
                and 
                    st_booking_id = {$item_id}
                and 
                    (check_out_timestamp < {$today} and check_out_timestamp !=0 )
                ";

                $results = $wpdb->get_results( $sql, OBJECT );

                wp_reset_postdata();

                return ( $results[ 0 ]->count );
            }

            // from 1.1.8
            function check_user_booked2( $user_id, $item_id )
            {

                global $wpdb;
                $sql     = "select count(id) as count from {$wpdb->prefix}st_order_item_meta
            where (1=1)
            and user_id = {$user_id}
            and 
                    (status = 'complete' or status = 'wc-completed' or status = 'completed' )
            and st_booking_id = {$item_id}
            ";
                $results = $wpdb->get_results( $sql, OBJECT );

                wp_reset_postdata();

                return ( $results[ 0 ]->count );
            }

            function check_user_booked( $user_id, $item_id, $post_type = null )
            {
                global $wpdb;
                $where = '';
                $join  = '';

                $where .= " and {$wpdb->postmeta}.meta_key='item_id' and  {$wpdb->postmeta}.meta_value={$item_id}";

                $query = "SELECT count({$wpdb->posts}.ID) as total from {$wpdb->posts}
                join {$wpdb->postmeta} on {$wpdb->posts}.ID={$wpdb->postmeta}.post_id
                join {$wpdb->postmeta} as tbl2 on tbl2.post_id={$wpdb->posts}.ID
                join {$wpdb->postmeta} as tbl3 on tbl3.post_id={$wpdb->posts}.ID
                {$join}
                where 1=1";

                $query .= " and `post_type`='st_order' ";
                $query .= " and {$wpdb->posts}.post_status='publish'";
                $query .= $where;

                $query .= " 
                and tbl2.meta_key='id_user' AND tbl2.meta_value='{$user_id}'
                and tbl3.meta_key='status' AND tbl3.meta_value='complete'
                ";
                $count = $wpdb->get_var( $query );

                return $count;
            }

            function init_metabox()
            {

                //Room
                $this->metabox[] = [
                    'id'       => 'order_metabox',
                    'title'    => __( 'Order Setting', ST_TEXTDOMAIN ),
                    'desc'     => '',
                    'pages'    => [ 'st_order' ],
                    'context'  => 'normal',
                    'priority' => 'high',
                    'fields'   => [

                        [
                            'label' => __( 'General', ST_TEXTDOMAIN ),
                            'id'    => 'order_reneral_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Total Price', ST_TEXTDOMAIN ),
                            'id'    => 'total_price',
                            'type'  => 'text',
                        ],


                        [
                            'label' => __( 'Customer', ST_TEXTDOMAIN ),
                            'id'    => 'id_user',
                            'type'  => 'user_select_ajax',
                        ],
                        [
                            'label' => __( 'Request Booking', ST_TEXTDOMAIN ),
                            'id'    => 'st_o_note',
                            'type'  => 'textarea_simple'
                        ],
                        [
                            'label'   => __( 'Payment Method', ST_TEXTDOMAIN ),
                            'id'      => 'payment_method',
                            'type'    => 'select',
                            'choices' => [
                                [
                                    'label' => __( 'Paypal', ST_TEXTDOMAIN ),
                                    'value' => 'paypal',

                                ],
                                [
                                    'label' => __( 'Submit Form', ST_TEXTDOMAIN ),
                                    'value' => 'submit_form',

                                ]
                            ],
                            'std'     => 'submit_form'
                        ],

                    ]
                ];
            }

            static function get_order_id_by_token( $token )
            {
                global $wpdb;

                $query = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='order_token_code' AND meta_value=%s LIMIT 0,1";

                $r = $wpdb->get_var( $wpdb->prepare( $query, $token ) );

                return $r;
            }


        }

        $a = new STOrder();
        $a->init();

    }