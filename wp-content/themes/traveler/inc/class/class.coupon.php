<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STCoupon
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STCoupon' ) ) {
        class STCoupon extends TravelerObject
        {
            protected $post_type = 'st_coupon_code';

            function init()
            {
                parent::init();
                add_action( 'init', [ $this, '_add_metabox' ], 10 );

            }

            function _add_metabox()
            {
                $this->metabox[] = [
                    'id'       => 'st_coupon_metabox',
                    'title'    => __( 'Coupon Detail', ST_TEXTDOMAIN ),
                    'desc'     => '',
                    'pages'    => [ $this->post_type ],
                    'context'  => 'normal',
                    'priority' => 'high',
                    'fields'   => [
                        [
                            'label' => __( 'General', ST_TEXTDOMAIN ),
                            'id'    => 'general_tab',
                            'type'  => 'tab'
                        ]

                        , [
                            'id'      => 'discount_type',
                            'label'   => __( 'Select discount type', ST_TEXTDOMAIN ),
                            'type'    => 'select',
                            'desc'    => __( 'Select Discount Type', ST_TEXTDOMAIN ),
                            'choices' => [
                                [
                                    'value' => 'cart_amount',
                                    'label' => __( 'Cart discount', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'cart_percent',
                                    'label' => __( 'Cart % discount', ST_TEXTDOMAIN )
                                ],
                            ]
                        ],
                        [
                            'id'    => 'amount',
                            'label' => __( 'Input discount value', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Discount amount', ST_TEXTDOMAIN ),
                            'type'  => 'text',
                        ],
                        [
                            'id'    => 'expiry_date',
                            'label' => __( 'Expired date', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Select date to expired this discount', ST_TEXTDOMAIN ),
                            'type'  => 'date-picker',
                        ],
                        [
                            'id'    => 'restriction_tab',
                            'label' => __( 'Restriction', ST_TEXTDOMAIN ),
                            'type'  => 'tab',
                        ],
                        [
                            'id'    => 'minimum_spend',
                            'label' => __( 'Minimum spend', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Minimum spend', ST_TEXTDOMAIN ),
                            'type'  => 'text',
                        ],
                        [
                            'id'    => 'maximum_spend',
                            'label' => __( 'Maximum spend', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Maximum spend', ST_TEXTDOMAIN ),
                            'type'  => 'text',
                        ],
                        [
                            'id'    => 'include_products',
                            'label' => __( 'Select service apply for coupon', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Select service use and item apply for coupon', ST_TEXTDOMAIN ),
                            'type'  => 'product_select_ajax',
                        ],
                        [
                            'id'    => 'exclude_products',
                            'label' => __( 'Select service not apply for coupon', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Select service and item not apply for coupon', ST_TEXTDOMAIN ),
                            'type'  => 'product_select_ajax',
                        ],
                        [
                            'id'    => 'limit_per_coupon',
                            'label' => __( 'Limited for each coupon', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Input number of times use this coupon code. Set empty for use unlimited', ST_TEXTDOMAIN ),
                            'type'  => 'text',
                        ],
                        [
                            'id'    => 'limit_per_user',
                            'label' => __( 'Limited for user', ST_TEXTDOMAIN ),
                            'desc'  => __( 'Input number of times use this coupon for each user. Set empty for use unlimited', ST_TEXTDOMAIN ),
                            'type'  => 'text',
                        ],
                    ]
                ];
            }

            static function get_coupon_value( $coupon, $total = false, $cart_items = [], $customer_email = false, $check_in = null )
            {
                if ( !$total ) {

                    $total = STCart::get_total_with_out_tax_for_coupon();
                }


                if ( empty( $cart_items ) ) {
                    $cart_items = STCart::get_items();
                }


                //die;

                $coupon_object = get_page_by_title( $coupon, OBJECT, 'st_coupon_code' );

                if ( !$coupon_object ) return [
                    'status'  => 0,
                    'message' => __( 'Coupon Not Found', ST_TEXTDOMAIN )
                ];

                $discount_value = 0;

                $coupon_post_id = $coupon_object->ID;

                $discount_type = get_post_meta( $coupon_post_id, 'discount_type', true );

                //$booking_type_available = get_post_meta($coupon_post_id,'booking_type_available',true);

                $amount = get_post_meta( $coupon_post_id, 'amount', true );

                $expiry_date = get_post_meta( $coupon_post_id, 'expiry_date', true );

                $minimum_spend = get_post_meta( $coupon_post_id, 'minimum_spend', true );

                $maximum_spend = get_post_meta( $coupon_post_id, 'maximum_spend', true );

                $required_porduct = get_post_meta( $coupon_post_id, 'include_products', true );

                $exclude_products = get_post_meta( $coupon_post_id, 'exclude_products', true );

                $exclude_products_post_type = get_post_meta( $coupon_post_id, 'exclude_products-type', true );

                $limit_per_coupon = get_post_meta( $coupon_post_id, 'limit_per_coupon', true );

                $limit_per_user = get_post_meta( $coupon_post_id, 'limit_per_user', true );

                //Validate Expiry Date
                if ( $expiry_date ) {
                    $datediff = TravelHelper::dateCompare( date( 'Y-m-d' ), $expiry_date );
                    if ( $datediff <= 0 ) {
                        return [
                            'status'  => 0,
                            'message' => __( 'This coupon is expired', ST_TEXTDOMAIN )
                        ];
                    }
                }

                //Validate Minium Spend
                if ( $minimum_spend ) {
                    if ( $minimum_spend > $total ) {
                        return [
                            'status'  => 0,
                            'message' => sprintf( __( 'This coupon is only applicable for bills spent over %s', ST_TEXTDOMAIN ), TravelHelper::format_money( $minimum_spend ) )
                        ];
                    }
                }

                //Validate Maximum Spend
                if ( $maximum_spend ) {
                    if ( $maximum_spend < $total ) {
                        return [
                            'status'  => 0,
                            'message' => sprintf( __( 'This coupon is only applicable for bills spent less than %s', ST_TEXTDOMAIN ), TravelHelper::format_money( $maximum_spend ) )
                        ];
                    }
                }


                //Validate Required Product
                if ( $required_porduct ) {
                    $ids           = explode( ',', $required_porduct );
                    $products_name = [];
                    $check         = [];
                    foreach ( $ids as $key ) {
                        if ( self::_check_in_items( $key, $cart_items ) ) {
                            $check[] = 1;
                        }
                        $products_name[] = "<a class='dotted_bottom' href='" . get_permalink( $key ) . "' target='_blank'>" . get_the_title( $key ) . "</a>";
                    }
                    if ( empty( $check ) ) {
                        return [
                            'status'  => 0,
                            'message' => sprintf( __( 'This coupon is required %s in the cart', ST_TEXTDOMAIN ), implode( ', ', $products_name ) )
                        ];
                    }
                }

                //Validate Exclude Product
                if ( $exclude_products ) {
                    if($exclude_products_post_type != '-1') {
                        $ids = explode(',', $exclude_products);
                        $products_name = [];
                        $check = [];
                        foreach ($ids as $key) {
                            if (self::_check_in_items($key, $cart_items)) {
                                $check[] = 1;
                            }

                            $products_name[] = "<a class='dotted_bottom' href='" . get_permalink($key) . "' target='_blank'>" . get_the_title($key) . "</a>";
                        }

                        if (!empty($check)) {
                            return [
                                'status' => 0,
                                'message' => sprintf(__('This coupon is required %s NOT in the cart', ST_TEXTDOMAIN), implode(', ', $products_name))
                            ];
                        }
                    }
                }else{
                    if($exclude_products_post_type != '-1') {
                        $cart_data = array_shift($cart_items);
                        $current_post_type = $cart_data['data']['st_booking_post_type'];
                        $obj = get_post_type_object($current_post_type);
                        $obj_post_type_name = $obj->labels->singular_name;
                        if ($exclude_products_post_type == $current_post_type) {
                            return [
                                'status' => 0,
                                'message' => sprintf(__('This coupon is required of %s service NOT in the cart', ST_TEXTDOMAIN), $obj_post_type_name)
                            ];
                        }
                    }
                }

                //Validate Used Time
                $coupon_code = $coupon_object->post_title;
                if ( $limit_per_coupon ) {
                    global $wpdb;

                    $query      = "
                    SELECT  count({$wpdb->prefix}posts.ID) as total
                    FROM    {$wpdb->prefix}posts
                    join {$wpdb->prefix}postmeta on {$wpdb->prefix}postmeta.post_id = {$wpdb->prefix}posts.ID and {$wpdb->prefix}postmeta.meta_key = 'coupon_code' 
                    and {$wpdb->prefix}postmeta.meta_value = '{$coupon_code}'
                    WHERE  post_type = 'st_order'";
                    $result     = $wpdb->get_results( $query );
                    $count_used = 0;
                    if ( !empty( $result ) and is_array( $result ) ) {
                        foreach ( $result as $key => $value ) {
                            $count_used += $value->total;
                        }
                    }
                    if ( $count_used >= $limit_per_coupon ) {
                        return [
                            'status'  => 0,
                            'message' => __( 'This coupon is reach the limit of usage', ST_TEXTDOMAIN )
                        ];
                    }
                }

                // Validate Per User
                if ( $limit_per_user and ( is_user_logged_in() ) ) {
                    $q_arg = [
                        'post_type'  => 'st_order',
                        'meta_query' => [
                            'relation' => 'AND',
                            [
                                'key'     => 'coupon_code',
                                'value'   => $coupon_code,
                                'type'    => 'CHAR',
                                'compare' => '='
                            ],
                            [
                                'key'     => 'id_user',
                                'value'   => get_current_user_id(),
                                'compare' => '='
                            ]
                        ],
                    ];
                    $query = new WP_Query( $q_arg );

                    if ( $query->found_posts >= $limit_per_user ) {
                        return [
                            'status'  => 0,
                            'message' => __( 'This coupon is reach the limit of usage per user', ST_TEXTDOMAIN )
                        ];
                    }
                }

                if ( $amount ) {
                    switch ( $discount_type ) {
                        case "cart_percent":
                            if ( $amount < 100 )
                                $discount_value = ( $total / 100 ) * $amount;
                            else $discount_value = $total;
                            break;
                        default:
                            $discount_value = ( $amount > $total ) ? $total : $amount;
                            break;
                    }
                }

                $result = apply_filters( 'st_get_coupon_value', [ 'status' => 1, 'value' => $discount_value, 'coupon' => $coupon, 'total' => $total, 'cart_items' => $cart_items ] );

                return [
                    'status'  => $result[ 'status' ],
                    'value'   => isset( $result[ 'value' ] ) ? $result[ 'value' ] : 0,
                    'message' => isset( $result[ 'message' ] ) ? $result[ 'message' ] : 0,
                    'data'    => isset( $result[ 'data' ] ) ? $result[ 'data' ] : 0,
                ];


            }

            static function _get_product_discount( $amount, $products, $cart_items, $type = 'amount' )
            {
                $discount = 0;

                if ( !empty( $products ) ) {
                    foreach ( $products as $key ) {
                        if ( self::_check_in_items( $key, $cart_items ) ) {
                            if ( $type == 'amount' ) {
                                if ( $cart_items[ $key ][ 'price' ] > $amount ) {
                                    $discount += $amount;
                                } else {
                                    $discount += $cart_items[ $key ][ 'price' ];
                                }
                            } elseif ( $type == 'percent' ) {
                                if ( $amount > 100 ) {
                                    $amount = 100;
                                }

                                $discount += ( $cart_items[ $key ][ 'price' ] / 100 ) * $amount;
                            }
                        }
                    }
                }

                if ( !empty( $cart_items ) ) {
                    foreach ( $cart_items as $key => $value ) {
                        $booking_id = TravelerObject::get_orgin_booking_id( $key );

                        if ( in_array( $booking_id, $products ) ) {
                            if ( $type == 'amount' ) {
                                if ( $value[ 'price' ] > $amount ) {
                                    $discount += $amount;
                                } else {
                                    $discount += $value[ 'price' ];
                                }
                            } elseif ( $type == 'percent' ) {
                                if ( $amount > 100 ) {
                                    $amount = 100;
                                }

                                $discount += ( $value[ 'price' ] / 100 ) * $amount;
                            }
                        }
                    }
                }

                return $discount;
            }

            static function _check_in_items( $post_id, $cart_items )
            {
                foreach ( $cart_items as $key => $value ) {
                    if ( $post_id == $key ) return true;
                    else {
                        $hotel_id = get_post_meta( $key, 'room_parent', true );
                        if ( $hotel_id and $hotel_id == $post_id ) {
                            return true;
                        }
                    }


                }

                return false;
            }

            static function _check_post_type_items( $post_type, $cart_items, $start = false )
            {
                $return = $start;
                foreach ( $cart_items as $key => $value ) {
                    if ( get_post_type( $key ) == $post_type ) $return = true;
                    else {
                        if ( get_post_type( $key ) == 'hotel_room' ) {
                            if ( $post_type == 'st_hotel' ) $return = true;
                        } else {
                            $return = false;
                        }
                    }

                }

                return $return;
            }

            static function _get_metabox_booking_types()
            {
                $booking_types = STTraveler::booking_type();
                $r             = [];
                if ( !empty( $booking_types ) ) {
                    foreach ( $booking_types as $key => $value ) {
                        if ( post_type_exists( $value ) ) {
                            $post_type_obj = get_post_type_object( $value );
                            $r[]           = [
                                'label' => $post_type_obj->labels->singular_name,
                                'value' => $value
                            ];
                        }
                    }
                }

                return $r;
            }
        }

        $a = new STCoupon();
        $a->init();
    }
