<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STLocation
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STLocation' ) ) {
        class STLocation extends TravelerObject
        {
            static $_inst;

            public $post_type = 'location';

            function init()
            {

                parent::init();
                add_action( 'init', [
                    $this,
                    'init_metabox'
                ], 9 );

                add_action( 'wp_ajax_st_search_location', [
                    $this,
                    'search_location'
                ] );
                add_action( 'wp_ajax_nopriv_st_search_location', [
                    $this,
                    'search_location'
                ] );
                add_action( 'widgets_init', [
                    $this,
                    'add_sidebar'
                ] );
                add_action( 'wp_enqueue_scripts', [
                    __CLASS__,
                    'get_list_post_type'
                ] );
                add_action( 'admin_enqueue_scripts', [
                    $this,
                    'admin_script'
                ] );

                add_action( 'save_post', [ $this, 'save_location' ], 55, 2 );

                add_action( 'template_redirect', [ $this, '__paginationTemplateRedirect' ], 0 );
            }

            public function __paginationTemplateRedirect()
            {
                if ( is_singular( 'location' ) ) {
                    global $wp_query;
                    $page = ( int )$wp_query->get( 'page' );
                    if ( $page > 1 ) {
                        $wp_query->set( 'page', 1 );
                        $wp_query->set( 'paged', $page );
                    }
                    remove_action( 'template_redirect', 'redirect_canonical' );
                }
            }

            public function save_location( $post_id, $post_object )
            {
                if ( get_post_type( $post_id ) == 'location' ) {

                    update_option( 'st_allow_save_location', 'allow' );

                    update_option( 'st_allow_save_cache_location', 'allow' );

                }
            }

            /**@from 1.1.9 */
            public function admin_script()
            {
                wp_enqueue_script( 'location-admin', get_template_directory_uri() . '/js/admin/location-admin.js', [ 'jquery' ] );
            }

            static public function get_post_type_list_active()
            {
                $array = [];
                if ( st_check_service_available( 'st_cars' ) ) {
                    $array[] = 'st_cars';
                }
                if ( st_check_service_available( 'st_hotel' ) ) {
                    $array[] = 'st_hotel';
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $array[] = 'st_tours';
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $array[] = 'st_rental';
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $array[] = 'st_activity';
                }
                if ( st_check_service_available( 'hotel_room' ) ) {
                    $array[] = 'hotel_room';
                }

                return $array;
            }

            static function get_opt_list()
            {
                $array =
                    [
                        [
                            'value' => 'information',
                            'label' => __( "Information", ST_TEXTDOMAIN )
                        ],
                        [
                            'value' => 'st_map',
                            'label' => __( "Map", ST_TEXTDOMAIN )
                        ]
                    ];
                if ( st_check_service_available( 'st_cars' ) ) {
                    $array[] = [
                        'value' => 'st_cars',
                        'label' => __( 'Car', ST_TEXTDOMAIN )
                    ];
                }
                if ( st_check_service_available( 'st_hotel' ) ) {
                    $array[] = [
                        'value' => 'st_hotel',
                        'label' => __( 'Hotel', ST_TEXTDOMAIN )
                    ];
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $array[] = [
                        'value' => 'st_tours',
                        'label' => __( 'Tour', ST_TEXTDOMAIN )
                    ];
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $array[] = [
                        'value' => 'st_rental',
                        'label' => __( 'Rental', ST_TEXTDOMAIN )
                    ];
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $array[] = [
                        'value' => 'st_activity',
                        'label' => __( 'Activity', ST_TEXTDOMAIN )
                    ];
                }

                return $array;
            }

            /**
             * @since 1.1.9
             **/
            static function get_opt_list_std()
            {
                $array = [
                    [
                        'title'     => __( "Information", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa fa-info",
                        'tab_type'  => "information",
                    ],
                    [
                        'title'              => __( "Map", ST_TEXTDOMAIN ),
                        'tab_icon_'          => "fa fa-map-marker",
                        'tab_type'           => "st_map",
                        'map_height'         => "500",
                        'map_spots'          => "500",
                        'map_location_style' => "normal",
                    ]
                ];
                if ( st_check_service_available( 'st_cars' ) ) {
                    $array[] = [
                        'title'     => __( "Car", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa fa-car",
                        'tab_type'  => "st_cars",
                    ];
                }
                if ( st_check_service_available( 'st_hotel' ) ) {
                    $array[] = [
                        'title'     => __( "Hotel", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa fa-building-o",
                        'tab_type'  => "st_hotel",
                    ];
                }
                if ( st_check_service_available( 'st_tours' ) ) {
                    $array[] = [
                        'title'     => __( "Tour", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa fa-flag-o",
                        'tab_type'  => "st_tours",
                    ];
                }
                if ( st_check_service_available( 'st_activity' ) ) {
                    $array[] = [
                        'title'     => __( "Activity", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa fa-bolt",
                        'tab_type'  => "st_activity",
                    ];
                }
                if ( st_check_service_available( 'st_rental' ) ) {
                    $array[] = [
                        'title'     => __( "Rental", ST_TEXTDOMAIN ),
                        'tab_icon_' => "fa-home",
                        'tab_type'  => "st_rental",
                    ];
                }

                return $array;
            }

            function get_featured_ids( $arg = [] )
            {
                $default = [
                    'posts_per_page' => 10,
                    'post_type'      => 'location'
                ];

                extract( wp_parse_args( $arg, $default ) );

                $ids = [];

                $query = [
                    'posts_per_page' => $posts_per_page,
                    'post_type'      => $post_type,
                    'meta_key'       => 'is_featured',
                    'meta_value'     => 'on'
                ];
                $q     = new WP_Query( $query );

                while ( $q->have_posts() ) {
                    $q->the_post();
                    $ids[] = get_the_ID();
                }
                wp_reset_postdata();

                return $ids;
            }

            function search_location()
            {
                //Small security
                check_ajax_referer( 'st_search_security', 'security' );

                $s   = STInput::get( 's' );
                $arg = [
                    'post_type'      => 'location',
                    'posts_per_page' => 10,
                    's'              => $s
                ];

                if ( $s ) {
                }

                global $wp_query;

                query_posts( $arg );
                $r = [];

                while ( have_posts() ) {
                    the_post();

                    $r[ 'data' ][] = [
                        'title' => get_the_title(),
                        'id'    => get_the_ID(),
                        'type'  => __( 'Location', ST_TEXTDOMAIN )
                    ];
                }
                wp_reset_query();
                echo json_encode( $r );

                die();
            }

            function init_metabox()
            {
                $metabox = [
                    'id'       => 'st_location',
                    'title'    => __( 'Location Setting', ST_TEXTDOMAIN ),
                    'pages'    => [ 'location' ],
                    'context'  => 'normal',
                    'priority' => 'high',
                    'fields'   => [
                        [
                            'label' => __( 'Location settings', ST_TEXTDOMAIN ),
                            'id'    => 'location_tab',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Feature image', ST_TEXTDOMAIN ),
                            'id'    => 'logo',
                            'type'  => 'upload',
                            'desc'  => __( 'Upload feature image for this location', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Set this location as feature', ST_TEXTDOMAIN ),
                            'id'    => 'is_featured',
                            'type'  => 'on-off',
                            'desc'  => __( 'Set this location as feature', ST_TEXTDOMAIN ),
                            'std'   => 'off'
                        ],
                        [
                            'label'   => __( 'Select country', ST_TEXTDOMAIN ),
                            'id'      => 'location_country',
                            'type'    => 'select',
                            'choices' => TravelHelper::_get_location_country(),
                            'desc'    => __( 'This is the country of this location', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Input zipcode', ST_TEXTDOMAIN ),
                            'id'    => 'zipcode',
                            'type'  => 'text',
                            'desc'  => __( 'This is the zipcode of this location', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Location on map', ST_TEXTDOMAIN ),
                            'id'    => 'st_google_map',
                            'type'  => 'bt_gmap',
                            'desc'  => __( 'This is the location on map', ST_TEXTDOMAIN )
                        ],
                        [
                            'label' => __( 'Location content', ST_TEXTDOMAIN ),
                            'id'    => 'location_content',
                            'type'  => 'tab'
                        ],
                        [
                            'label' => __( 'Build content for this location', ST_TEXTDOMAIN ),
                            'id'    => 'st_location_use_build_layout',
                            'type'  => 'on-off',
                            'desc'  => __( 'Allow you can build content, layout, information for this location like the way you want' ),
                            'std'   => 'off'
                        ],
                        [
                            'label'     => "<strong>" . __( "Use gallery ", ST_TEXTDOMAIN ) . "</strong>",
                            'id'        => "is_gallery",
                            'type'      => "on-off",
                            'std'       => "on",
                            'condition' => "st_location_use_build_layout:is(on)",
                        ],
                        [
                            'label'     => __( 'Gallery style', ST_TEXTDOMAIN ),
                            'id'        => 'location_gallery_style',
                            'condition' => 'is_gallery:is(on)st_location_use_build_layout:is(on)',
                            'type'      => 'select',
                            'desc'      => __( 'Select your location style', ST_TEXTDOMAIN ),
                            'choices'   => [
                                [
                                    'value' => '',
                                    'label' => __( '--- Select ---', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '1',
                                    'label' => __( 'Fotorama stage', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '2',
                                    'label' => __( 'Fotorama stage without nav', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '3',
                                    'label' => __( 'Light box gallery', ST_TEXTDOMAIN )
                                ]
                            ]
                        ],
                        [
                            'label'     => __( 'Light box images per row', ST_TEXTDOMAIN ),
                            'id'        => 'image_count',
                            'type'      => 'select',
                            'desc'      => __( 'Choose your count num', ST_TEXTDOMAIN ),
                            'condition' => 'location_gallery_style:is(3)is_gallery:is(on)st_location_use_build_layout:is(on)',
                            'choices'   => [
                                [
                                    'value' => '',
                                    'label' => __( ' --- Select ---', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '3',
                                    'label' => __( '3 images', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '4',
                                    'label' => __( '4 images', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '6',
                                    'label' => __( '6 images', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => '12',
                                    'label' => __( '12 images', ST_TEXTDOMAIN )
                                ]
                            ]
                        ],
                        [
                            'label'     => __( 'Gallery', ST_TEXTDOMAIN ),
                            'id'        => 'st_gallery',
                            'type'      => 'gallery',
                            'condition' => 'is_gallery:is(on)st_location_use_build_layout:is(on)',
                        ],
                        [
                            'label'     => "<strong>" . __( "Use tabs ", ST_TEXTDOMAIN ) . "</strong>",
                            'id'        => "is_tabs",
                            'type'      => "on-off",
                            'std'       => "on",
                            'condition' => "st_location_use_build_layout:is(on)st_location_use_build_layout:is(on)",
                        ],
                        [
                            'id'        => __( "tab_position", ST_TEXTDOMAIN ),
                            'label'     => "Tab navigation position",
                            'condition' => "is_tabs:is(on)st_location_use_build_layout:is(on)",
                            'choices'   => [
                                [
                                    'value' => '',
                                    'label' => __( ' --- Select ---', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'top',
                                    'label' => __( 'Top', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'right',
                                    'label' => __( 'Right', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'left',
                                    'label' => __( 'Left', ST_TEXTDOMAIN )
                                ]
                            ],
                            'type'      => "select",
                            'std'       => "Top",
                        ],
                        [
                            'label'     => __( "Tab items", ST_TEXTDOMAIN ),
                            'id'        => 'location_tab_item',
                            'type'      => 'list-item',
                            'desc'      => __( 'Add new item to create new tab', ST_TEXTDOMAIN ),
                            'condition' => 'is_tabs:is(on)st_location_use_build_layout:is(on)st_location_use_build_layout:is(on)',
                            'std'       => self::get_opt_list_std(),
                            'settings'  => [
                                [
                                    'id'    => 'tab_icon_',
                                    'label' => __( 'Tab icon', ST_TEXTDOMAIN ),
                                    'type'  => 'text',
                                    'std'   => 'fa fa-info'
                                ],
                                [
                                    'id'      => 'tab_type',
                                    'label'   => __( "Type", ST_TEXTDOMAIN ),
                                    'type'    => 'select',
                                    'choices' => self::get_opt_list(),
                                    'std'     => 'st_cars'
                                ],
                                [
                                    'id'        => 'map_height',
                                    'label'     => __( 'Map height', ST_TEXTDOMAIN ),
                                    'type'      => 'text',
                                    'condition' => 'tab_type:is(st_map)',
                                    'std'       => '500'
                                ],
                                [
                                    'id'        => 'map_spots',
                                    'label'     => __( 'Maxium number of spots', ST_TEXTDOMAIN ),
                                    'type'      => 'text',
                                    'condition' => 'tab_type:is(st_map)',
                                    'std'       => '500'
                                ],
                                [
                                    'label'     => __( 'Map style', ST_TEXTDOMAIN ),
                                    'id'        => 'map_location_style',
                                    'type'      => 'select',
                                    'condition' => 'tab_type:is(st_map)',
                                    'std'       => 'normal',
                                    'choices'   => [
                                        [
                                            'value' => 'normal',
                                            'label' => __( 'Normal', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'midnight',
                                            'label' => __( 'Midnight', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'family_fest',
                                            'label' => __( 'Family fest', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'open_dark',
                                            'label' => __( 'Open dark', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'riverside',
                                            'label' => __( 'River side', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'ozan',
                                            'label' => __( 'Ozan', ST_TEXTDOMAIN )
                                        ],
                                    ]
                                ],
                                [
                                    'id'        => 'information_content',
                                    'label'     => __( "Select Information content tab" ),
                                    'type'      => 'select',
                                    'choices'   => [
                                        [
                                            'value' => 'content',
                                            'label' => __( 'Use current location content', ST_TEXTDOMAIN )
                                        ],
                                        [
                                            'value' => 'posts',
                                            'label' => __( "Use Post", ST_TEXTDOMAIN ),
                                        ],
                                        [
                                            'value' => 'child_tab',
                                            'label' => __( "Use Child Tabs", ST_TEXTDOMAIN ),
                                        ],
                                    ],
                                    'std'       => 'content',
                                    'condition' => "tab_type:is(information)",
                                ],
                                [
                                    'id'        => "hight_light_posts",
                                    'label'     => __( "Select post", ST_TEXTDOMAIN ),
                                    'type'      => 'post-select',
                                    'condition' => "information_content:is(posts)",
                                    'std'       => 1
                                ],
                                [
                                    'id'        => "tab_item_key",
                                    'label'     => __( "Tab item Key", ST_TEXTDOMAIN ),
                                    'type'      => 'text',
                                    'condition' => "information_content:is(child_tab)",
                                    'desc'      => "type as same as items in child tab for working properly"
                                ],
                            ]
                        ],
                        [
                            'label' => __( "Child tabs", ST_TEXTDOMAIN ),
                            'id'    => "infor_child_tab",
                            'type'  => "tab",
                        ],
                        [
                            'label'     => __( 'Child tab position', ST_TEXTDOMAIN ),
                            'id'        => 'info_location_tab_item_position',
                            'type'      => 'select',
                            'condition' => "st_location_use_build_layout:is(on)",
                            'choices'   => [
                                [
                                    'value' => '',
                                    'label' => __( ' --- Select ---', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'top',
                                    'label' => __( 'Top', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'right',
                                    'label' => __( 'Right', ST_TEXTDOMAIN )
                                ],
                                [
                                    'value' => 'left',
                                    'label' => __( 'Left', ST_TEXTDOMAIN )
                                ]
                            ],
                            'std'       => 'top'
                        ],
                        [
                            'label'     => __( 'Child tab items', ST_TEXTDOMAIN ),
                            'id'        => 'info_tab_item',
                            'type'      => 'list-item',
                            'desc'      => __( 'Add new item for location information tab', ST_TEXTDOMAIN ),
                            'condition' => "st_location_use_build_layout:is(on)is_tabs:is(on)",
                            'settings'  => [
                                [
                                    'id'          => 'post_info_select',
                                    'label'       => __( 'Post from', ST_TEXTDOMAIN ),
                                    'type'        => 'post_select',
                                    'post_type'   => 'post',
                                    'std'         => 1,
                                    'placeholder' => __( 'Select a post', ST_TEXTDOMAIN )
                                ],
                                [
                                    'id'    => "tab_item_key",
                                    'type'  => "text",
                                    'label' => __( "Tab item key", ST_TEXTDOMAIN ),
                                    'desc'  => __( "type a key as same as ", ST_TEXTDOMAIN ) . "<strong>" . __( "Tab item key", ST_TEXTDOMAIN ) . "</strong>" . __( " tab item key", ST_TEXTDOMAIN ),
                                ],
                            ],
                        ]
                    ]
                ];

                $this->metabox[] = $metabox;


            }

            function add_sidebar()
            {
                register_sidebar( [
                    'name'          => __( 'Location sidebar ', ST_TEXTDOMAIN ),
                    'id'            => 'location-sidebar',
                    'description'   => __( 'Widgets in this area will be show information in current Location', ST_TEXTDOMAIN ),
                    'before_title'  => '<h4>',
                    'after_title'   => '</h4>',
                    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                    'after_widget'  => '</div>'
                ] );
            }

            static function get_info_by_post_type( $location_id = false, $post_type = null )
            {
                if ( !$post_type ) {
                    return false;
                }

                if ( !$location_id )
                    $location_id = get_the_ID();

                $num_rows = 0;
                global $wpdb;
                $comment_num = 0;

                $ns = new Nested_set();
                $ns->setControlParams( $wpdb->prefix . 'st_location_nested' );
                $locations      = self::get_children_location( $location_id );
                $where_location = "";
                if ( !empty( $locations ) ) {
                    $where_location .= " AND location_from IN (";
                    $string         = implode( ',', $locations );
                    $where_location .= $string . ")";
                }
                $where = TravelHelper::edit_where_wpml( '', $post_type );
                $join  = TravelHelper::edit_join_wpml( '', $post_type );

                /* Join availability */
                $join_availability = '';
                switch ( $post_type ) {
                    case 'st_activity':
                        $join_availability_table = $wpdb->prefix . 'st_activity_availability';
                        break;
                    case 'st_tours':
                        $join_availability_table = $wpdb->prefix . 'st_tour_availability';
                        break;
                    case 'st_rental':
                        $join_availability_table = $wpdb->prefix . 'st_rental_availability';
                        break;
                    default:
                        $join_availability_table = "";
                        break;
                }

                if ( !empty( $join_availability_table ) )
                    $join_availability = "INNER JOIN {$join_availability_table} ON {$wpdb->prefix}posts.ID = {$join_availability_table}.post_id AND {$join_availability_table}.status = 'available' AND {$join_availability_table}.check_in >= UNIX_TIMESTAMP(CURRENT_DATE) AND ({$join_availability_table}.number  - IFNULL({$join_availability_table}.number_booked, 0)) > 0";


                $query = "SELECT
                sum(_select.count_comment) AS count_comment,
                count(_select.post_id) AS post_id
            FROM
                (
                    SELECT
                        count_comment,
                        post_id
                    FROM
                        (
                            SELECT
                                {$wpdb->prefix}{$post_type}.post_id,
                                count({$wpdb->prefix}comments.comment_ID) AS count_comment
                            FROM
                                {$wpdb->prefix}{$post_type}
                            INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}posts.ID = {$wpdb->prefix}{$post_type}.post_id
                            {$join_availability}
                            {$join}
                            JOIN {$wpdb->prefix}st_location_relationships ON {$wpdb->prefix}st_location_relationships.post_id = {$wpdb->prefix}{$post_type}.post_id
                            {$where_location}
                            LEFT JOIN {$wpdb->prefix}comments ON {$wpdb->prefix}comments.comment_post_ID = {$wpdb->prefix}{$post_type}.post_id
                            AND `comment_type` = 'st_reviews'
                            AND comment_approved = 1
                            WHERE
                                {$wpdb->prefix}posts.post_status IN ('publish')
                                {$where}
                            GROUP BY
                                {$wpdb->prefix}{$post_type}.post_id
                        ) AS count_comment_table
                ) AS _select";

                $rs = $wpdb->get_row( $query );

                $comment_num = $rs->count_comment;
                $num_rows    = $rs->post_id;


                $min_max_price = self::get_min_max_price_location( $post_type, $location_id );


//                $comment_num = get_post_meta($location_id,'_'.$post_type.'_comment_count',true);
//                $num_rows = get_post_meta($location_id,'_'.$post_type.'_offer_count',true);
//                $min_max_price =[
//                    'price_min'=>get_post_meta($location_id,'_'.$post_type.'_min_price',true),
//                    'detail'=>[
//                        'item_has_min_price'=>get_post_meta($location_id,'_'.$post_type.'_min_price_post_id',true)
//                    ]
//                ];

                if ( $num_rows > 1 ) {
                    $name = self::get_post_type_name( $post_type );
                } else {
                    $name = self::get_post_type_name( $post_type, true );
                }

                return [
                    'post_type'      => $post_type,
                    'post_type_name' => $name,
                    'reviews'        => $comment_num,
                    'offers'         => $num_rows,
                    'min_max_price'  => $min_max_price
                ];

            }

            static function get_top_attractions( $post_type = false )
            {
                if ( empty( $post_type ) ) return;
                $offer = [];
                global $wpdb;
                $where = " where (1=1)  ";
                $where = self::edit_where_wpml( $where, $post_type );
                $join  = "";
                $join  = self::edit_join_wpml( $join, $post_type, true );
                if ( $post_type == 'st_tours' ) {
                    $tour = new STTour();
                    if ( $tour->is_available() and TravelHelper::checkTableDuplicate( 'st_tours' ) ) {
                        $sql     = "SELECT * FROM {$wpdb->prefix}{$post_type} {$join} {$where}";
                        $results = $wpdb->get_results( $sql );
                        if ( !empty( $results ) and is_array( $results ) ) {
                            foreach ( $results as $row ) {
                                $multilocation = explode( ',', $row->multi_location );
                                if ( !empty( $multilocation ) and is_array( $multilocation ) ) {
                                    foreach ( $multilocation as $location ) {
                                        $location = str_replace( "_", "", $location );
                                        if ( !array_key_exists( $location, $offer ) ) {
                                            $offer[ $location ] = 1;
                                        } else {
                                            $offer[ $location ] += 1;
                                        }
                                    }
                                }
                            }
                        }
                        if ( !empty( $offer ) ) return $offer;
                    }
                }

                return false;
            }

            /**
             * @package    Wordpress
             * @subpackage traveler
             * @since      1.1.3
             *
             */
            static function get_post_type_name( $post_type, $is_single = null )
            {
                ob_start();

                if ( $is_single ) {
                    if ( $post_type == "st_cars" ) {
                        st_the_language( "car" );
                    }
                    if ( $post_type == "st_tours" ) {
                        st_the_language( "tour" );
                    }
                    if ( $post_type == "st_rental" ) {
                        st_the_language( "rental" );
                    }
                    if ( $post_type == "st_activity" ) {
                        st_the_language( "activity" );
                    }
                    if ( $post_type == "st_hotel" ) {
                        st_the_language( "hotel" );
                    }
                } else {
                    if ( $post_type == "st_cars" ) {
                        st_the_language( "cars" );
                    }
                    if ( $post_type == "st_tours" ) {
                        st_the_language( "tours" );
                    }
                    if ( $post_type == "st_rental" ) {
                        st_the_language( "rentals" );
                    }
                    if ( $post_type == "st_activity" ) {
                        st_the_language( "activities" );
                    }
                    if ( $post_type == "st_hotel" ) {
                        st_the_language( "hotels" );
                    }
                }
                $return = ob_get_clean();

                return $return;
            }

            // from 1.1.9
            static function get_location_terms()
            {
                $return = [];
                $array  = ( get_object_taxonomies( 'location', 'array' ) );
                if ( !empty( $array ) and is_array( $array ) ) {
                    foreach ( $array as $tax => $value ) {
                        $terms = get_terms( $tax, $args = [
                            'hide_empty' => false,
                        ] );
                        if ( !empty( $terms ) and is_array( $terms ) ) {
                            foreach ( $terms as $key => $values ) {
                                $return[] = $values;
                            }
                        }
                    }
                }

                return $return;
            }

            public static function get_min_max_price_location( $post_type, $location_id )
            {

                if ( empty( $post_type ) || !TravelHelper::checkTableDuplicate( $post_type ) ) {
                    return [ 'price_min' => 0, 'price_max' => 500 ];
                }
                if ( $post_type == 'st_rental' ) {
                    $location_text = 'location_id';
                }
                $return      = [ 'price_min' => 0, 'price_max' => 500, 'detail' => [ 'item_has_min_price' => 1 ] ];
                $is_st_table = true;
                // for hotel
                if ( $post_type == 'st_hotel' ) {
                    $meta_key = st()->get_option( 'hotel_show_min_price', 'avg_price' );
                    if ( $meta_key == 'avg_price' ) $meta_key = "price_avg";
                    $results = self::query_location( $post_type, $meta_key, $is_st_table, $location_id );
                    if ( !empty( $results ) and is_array( $results ) ) {
                        $return[ 'price_min' ]                      = ( (float)$results[ 0 ]->price > 0 ) ? (float)$results[ 0 ]->price : 0;
                        $return[ 'detail' ][ 'item_has_min_price' ] = $results[ 0 ]->post_id;
                    }
                }
                if ( $post_type == 'st_tours' or $post_type == 'st_activity' ) {
                    // adult price
                    $min_results = self::query_location( $post_type, 'min_price', $is_st_table, $location_id );
                    if ( !empty( $min_results ) and is_array( $min_results ) ) {
                        $return[ 'price_min' ]                      = ( (float)$min_results[ 0 ]->st_price > 0 ) ? (float)$min_results[ 0 ]->st_price : 0;
                        $return[ 'detail' ][ 'item_has_min_price' ] = $min_results[ 0 ]->post_id;
                    }
                }
                if ( $post_type == 'st_cars' or $post_type == "st_rental" ) {
                    $results = self::query_location( $post_type, 'min_price', $is_st_table, $location_id );
                    if ( !empty( $results ) and is_array( $results ) ) {
                        $return[ 'price_min' ]                      = ( (float)$results[ 0 ]->price > 0 ) ? (float)$results[ 0 ]->price : 0;
                        $return[ 'detail' ][ 'item_has_min_price' ] = $results[ 0 ]->post_id;
                    }
                }

                return $return;
            }

            /**
             * @updated 1.2.4
             **/
            static function query_location( $post_type, $key, $is_st_table, $location_id = null )
            {
                if ( empty( $location_id ) ) return false;
                global $wpdb;
                $locations = self::get_children_location( $location_id );
                if ( in_array( $post_type, [ 'st_tours', 'st_activity' ] ) ) {
                    $string_location = implode( ',', $locations );

                    $sql_temp = "CASE
                                    WHEN {$wpdb->prefix}{$post_type}.adult_price > 0 and {$wpdb->prefix}{$post_type}.adult_price != ''
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

                                        WHEN {$wpdb->prefix}{$post_type}.child_price > 0 and {$wpdb->prefix}{$post_type}.child_price != ''
                                        THEN CASE
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
                                        WHEN {$wpdb->prefix}{$post_type}.infant_price > 0 and {$wpdb->prefix}{$post_type}.infant_price != ''
                                        THEN CASE
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
                                    END";

                    $sql_main = "";

                    if ( $post_type == 'st_tours' ) {
                        $sql_main = "
									CASE WHEN {$wpdb->prefix}{$post_type}.price_type = 'fixed' THEN
										  								CASE
                                                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule = 'on'
                                                                                        AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                                        AND {$wpdb->prefix}{$post_type}.sale_price_from <= CURDATE() AND {$wpdb->prefix}{$post_type}.sale_price_to >= CURDATE()
                                                                                THEN
                                                                                        CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                                WHEN {$wpdb->prefix}{$post_type}.is_sale_schedule != 'on' AND {$wpdb->prefix}{$post_type}.discount != 0 AND {$wpdb->prefix}{$post_type}.discount != ''
                                                                                THEN
                                                                                        CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) - ( CAST({$wpdb->prefix}{$post_type}.price AS DECIMAL) / 100 ) * CAST({$wpdb->prefix}{$post_type}.discount AS DECIMAL)

                                                                                ELSE {$wpdb->prefix}{$post_type}.price
                                                                        END
									ELSE(
									" . $sql_temp . "
									) END";
                    } else {
                        $sql_main = $sql_temp;
                    }
                    $sql          = "select {$wpdb->prefix}{$post_type}.post_id as post_id, (
									" . $sql_main . ") AS st_price
                from {$wpdb->prefix}{$post_type}";
                    $current_lang = 'en';
                    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                        $current_lang = ICL_LANGUAGE_CODE;
                    }
                    if ( !empty( $string_location ) ) {
                        $sql .= " INNER JOIN {$wpdb->prefix}st_location_relationships as l on l.post_id = {$wpdb->prefix}{$post_type}.post_id and location_from IN ({$string_location}) ";
                        $sql = $sql . " INNER JOIN {$wpdb->prefix}st_location_nested as ln on ln.location_id = l.location_from and ln.`language` = '{$current_lang}'";
                    }
                    $sql .= " INNER JOIN {$wpdb->prefix}posts as post on post.ID = {$wpdb->prefix}{$post_type}.post_id
                where post.post_status in ('private', 'publish') ORDER BY cast(st_price as UNSIGNED) asc";

                    $results = $wpdb->get_results( $sql, OBJECT );

                    return $results;
                }

                if ( $post_type == 'st_cars' ) {
                    $string_location = implode( ',', $locations );
                    $sql             = "SELECT
                    {$wpdb->prefix}st_cars.post_id,
                    (CASE
                            WHEN cars_price != 0 AND cars_price != '' THEN
                                CASE
                                    WHEN is_sale_schedule = 'on' AND discount != 0 AND discount != '' AND sale_price_from <= CURDATE() AND sale_price_to >= CURDATE()
                                    THEN CAST(cars_price AS UNSIGNED) - ( CAST(cars_price AS UNSIGNED) * CAST(discount AS UNSIGNED) / 100)
                                    WHEN is_sale_schedule != 'on' AND discount != 0 AND discount != ''
                                    THEN CAST(cars_price AS UNSIGNED) - ( CAST(cars_price AS UNSIGNED) * CAST(discount AS UNSIGNED) / 100)
                                    ELSE CAST(cars_price AS UNSIGNED)
                                END 
                            ELSE 0
                    END) as price
                FROM
                    {$wpdb->prefix}st_cars";

                    $current_lang = 'en';
                    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                        $current_lang = ICL_LANGUAGE_CODE;
                    }
                    if ( !empty( $string_location ) ) {
                        $sql .= " INNER JOIN {$wpdb->prefix}st_location_relationships as l on l.post_id = {$wpdb->prefix}{$post_type}.post_id and location_from IN ({$string_location}) ";
                        $sql = $sql . " INNER JOIN {$wpdb->prefix}st_location_nested as ln on ln.location_id = l.location_from and ln.`language` = '{$current_lang}'";
                    }
                    $sql     .= " ORDER BY cast(price as UNSIGNED) asc";
                    $results = $wpdb->get_results( $sql, OBJECT );

                    return $results;

                }

                if ( $post_type == 'st_rental' ) {
                    $string_location = implode( ',', $locations );
                    $sql             = "SELECT
                    {$wpdb->prefix}st_rental.post_id,
                    (CASE
                            WHEN price != 0 AND price != '' THEN
                                CASE
                                    WHEN is_sale_schedule = 'on' AND discount_rate != 0 AND discount_rate != '' AND sale_price_from <= CURDATE() AND sale_price_to >= CURDATE()
                                    THEN CAST(price AS UNSIGNED) - ( CAST(price AS UNSIGNED) * CAST(discount_rate AS UNSIGNED) / 100)
                                    WHEN is_sale_schedule != 'on' AND discount_rate != 0 AND discount_rate != ''
                                    THEN CAST(price AS UNSIGNED) - ( CAST(price AS UNSIGNED) * CAST(discount_rate AS UNSIGNED) / 100)
                                    ELSE CAST(price AS UNSIGNED)
                                END 
                            ELSE 0
                    END ) as price
                FROM
                    {$wpdb->prefix}st_rental";


                    $current_lang = 'en';
                    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                        $current_lang = ICL_LANGUAGE_CODE;
                    }
                    if ( !empty( $string_location ) ) {
                        $sql .= " INNER JOIN {$wpdb->prefix}st_location_relationships as l on l.post_id = {$wpdb->prefix}{$post_type}.post_id and location_from IN ({$string_location}) ";
                        $sql = $sql . " INNER JOIN {$wpdb->prefix}st_location_nested as ln on ln.location_id = l.location_from and ln.`language` = '{$current_lang}'";
                    }
                    $sql     .= " ORDER BY cast(price as UNSIGNED) asc";
                    $results = $wpdb->get_results( $sql, OBJECT );

                    return $results;

                }

                if ( $post_type == 'st_hotel' ) {
                    $string_location = implode( ',', $locations );

                    $sql = "SELECT
                        {$wpdb->prefix}st_hotel.post_id,
                        CAST({$key} AS UNSIGNED) as price
                    FROM
                        {$wpdb->prefix}st_hotel 
                    INNER JOIN {$wpdb->prefix}posts as post on (post.ID = {$wpdb->prefix}st_hotel .post_id AND post.post_status in ('private', 'publish') ) ";

                    $current_lang = 'en';
                    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                        $current_lang = ICL_LANGUAGE_CODE;
                    }
                    if ( !empty( $string_location ) ) {
                        $sql .= " INNER JOIN {$wpdb->prefix}st_location_relationships as l on l.post_id = {$wpdb->prefix}{$post_type}.post_id and location_from IN ({$string_location}) ";
                        $sql = $sql . " INNER JOIN {$wpdb->prefix}st_location_nested as ln on ln.location_id = l.location_from and ln.`language` = '{$current_lang}'";
                    }

                    $sql .= "
                WHERE
                    {$key} <> '' ORDER BY cast(price as UNSIGNED) asc";

                    $results = $wpdb->get_results( $sql, OBJECT );

                    return $results;
                }
            }

            static function get_children_location( $location_id = null )
            {
                if ( empty( $location_id ) ) return false;
                global $wpdb;
                $ns = new Nested_set();
                $ns->setControlParams( $wpdb->prefix . 'st_location_nested' );
                $locations = [];
                $node      = $ns->getNodeWhere( "location_id = " . $location_id );
                if ( !empty( $node ) ) {
                    $leftval     = (int)$node[ 'left_key' ];
                    $rightval    = (int)$node[ 'right_key' ];
                    $node_childs = $ns->getNodesWhere( "left_key >= " . $leftval . " AND right_key <= " . $rightval );
                    if ( !empty( $node_childs ) ) {
                        foreach ( $node_childs as $item ) {
                            $locations[] = (int)$item[ 'location_id' ];
                        }
                    } else {
                        $locations[] = (int)$node[ 'location_id' ];
                    }
                }

                return $locations;
            }

            static function scrop_thumb( $image )
            {
                $return = '<img src="' . esc_url( $image ) . '" style="width: 100%" alt = "' . TravelHelper::get_alt_image() . '" >';

                return apply_filters( 'location_item_crop_thumb', $return );
            }

            /**
             * @since 1.1.3
             * get location information
             *
             */

            static function get_slider( $gallery_array )
            {
                $return        = "";
                $gallery_array = explode( ',', $gallery_array );
                $return        .= '<div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">';
                if ( is_array( $gallery_array ) and !empty( $gallery_array ) ) {
                    foreach ( $gallery_array as $key => $value ) {
                        $return .= wp_get_attachment_image( $value, [
                            800,
                            600,
                        ] );
                    }
                }
                $return .= '</div>';

                return $return;
            }

            /**
             * @since 1.1.3
             * static rate by location and rate
             * return array(1=>xx , 2=> xyz , 3=>sss  , 4=>ssss, 5+>ksfs)
             **/
            static function get_rate_count( $star_array, $post_type_array )
            {
                global $wpdb;

                if ( !$star_array ) {
                    $star_array = [
                        5,
                        4,
                        3,
                        2,
                        1
                    ];
                }
                if ( !$post_type_array ) {
                    $post_type_array = [
                        'st_cars',
                        'st_hotel',
                        'st_rental',
                        'st_tours',
                        'st_activity'
                    ];
                }
                $post_type_list_sql = "";


                if ( !empty( $post_type_array ) and is_array( $post_type_array ) ) {
                    $post_type_list_sql .= " and ( ";
                    foreach ( $post_type_array as $key => $value ) {
                        if ( $key == 0 ) {
                            $post_type_list_sql .= "soifjsf .post_type = '{$value}' ";
                        } else {
                            $post_type_list_sql .= " or soifjsf .post_type = '{$value}' ";
                        }
                    }
                    $post_type_list_sql .= " ) ";
                }


                $return = [];

                $location_id = get_the_ID();
                if ( !empty( $location_id ) ) {
                    $where = TravelHelper::_st_get_where_location( $location_id, [ 'st_cars', 'st_tours', 'st_rental', 'st_activity', 'st_hotel' ], "" );
                }

                if ( is_array( $star_array ) and !empty( $star_array ) ) {
                    foreach ( $star_array as $key => $value ) {
                        $star = $value;
                        $sql  = "
                        SELECT {$wpdb->commentmeta}.comment_id as count_rate FROM {$wpdb->commentmeta}
                        join {$wpdb->comments}  on {$wpdb->commentmeta} .comment_id = {$wpdb->comments} .comment_ID
                        join {$wpdb->posts} as soifjsf on {$wpdb->comments} .comment_post_ID = soifjsf .ID
                        where {$wpdb->commentmeta} .meta_key = 'comment_rate' and {$wpdb->commentmeta} .meta_value = {$star}
                        and soifjsf .comment_status  = 'open'
                        and soifjsf .post_status = 'publish'
                            " . $post_type_list_sql . "

                        AND soifjsf.ID IN (
                            SELECT
                                {$wpdb->posts}.ID
                            FROM
                                {$wpdb->posts}

                            where
                            1=1
                            $where
                        )
                        and {$wpdb->comments} .comment_approved = 1
                        GROUP BY {$wpdb->commentmeta} .comment_id";

                        $results = $wpdb->get_results( $sql, OBJECT );
                        if ( $results ) {
                            $return[ $star ] = count( $results );
                        }

                    }
                }

                return $return;

            }

            /**
             * widget location statistical
             * since 1.1.5
             *
             */
            static function location_widget3( $instance )
            {
                global $wpdb;
                $style   = $instance[ 'style' ];
                $add_sql = "";
                if ( !$style ) {
                    $add_sql = " order by {$wpdb->posts}.ID DESC";
                }
                if ( $style == 'latest' ) {
                    $add_sql = " order by {$wpdb->posts}.post_date_gmt DESC ";
                }
                if ( $style == 'famous' ) {
                    return self::get_famous_location( $instance );
                }

                if ( !$instance[ 'location' ] ) {
                    $instance[ 'location' ] = get_the_ID();
                }
                $add_where = " ";


                if ( !empty( $instance[ 'location' ] ) ) {
                    $add_where = TravelHelper::_st_get_where_location( $instance[ 'location' ], [ $instance[ 'post_type' ] ], $add_where );
                }

                $join  = " join {$wpdb->postmeta} on {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID    ";
                $join  = self::edit_join_wpml( $join, $instance[ 'post_type' ] );
                $where = "{$add_where}";
                $where = self::edit_where_wpml( $where );
                $sql   = "
                select {$wpdb->posts}.ID from {$wpdb->posts} 
                {$join}                
                where 
                   1=1
                   {$where}
                
                ";
                $sql   .= "
                and {$wpdb->posts}.post_status = 'publish'
                and {$wpdb->posts}.post_type = '{$instance['post_type']}' 
                group by {$wpdb->posts}.ID ";
                $sql   .= $add_sql;
                $sql   .= " limit 0 ,{$instance['count']}
                ";

                $results = $wpdb->get_results( $sql, OBJECT );

                return $results;
            }

            /**
             * @since 1.1.6
             *
             *
             */
            static function get_famous_location( $instance )
            {
                global $wpdb;
                $item_post_type = $instance[ 'post_type' ];
                $location_id    = $instance[ 'location' ];
                $count          = $instance[ 'count' ];
                $join           = "
                INNER JOIN {$wpdb->postmeta} as mt1 ON mt1.post_id={$wpdb->posts}.ID AND mt1.meta_key='item_post_type' AND mt1.meta_value='{$item_post_type}' 
            ";
                $where          = "
                {$wpdb->postmeta}.meta_value 
                            in (
                                select post_id 
                                from {$wpdb->postmeta} 
                                where ({$wpdb->postmeta}.meta_key = 'id_location' or {$wpdb->postmeta}.meta_key = 'location_id') 
                                and {$wpdb->postmeta}.meta_value= '{$location_id}') 
            ";
                $sql            = "
                 SELECT count({$wpdb->postmeta}.meta_value) as count , {$wpdb->postmeta}.meta_value as ID
                    FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID={$wpdb->postmeta}.post_id AND {$wpdb->postmeta}.meta_key='item_id'
                    {$join}
                    WHERE 
                        {$where}
                    and {$wpdb->posts}.post_status = 'publish' 
                    group by  {$wpdb->postmeta}.meta_value
                    order by count({$wpdb->postmeta}.meta_value) DESC
             
                ";
                $results        = $wpdb->get_results( $sql, OBJECT );

                $return = [];
                if ( !empty( $results ) and is_array( $results ) ) {
                    foreach ( $results as $key => $value ) {
                        if ( $key <= ( $count - 1 ) ) {
                            $return[] = $value;
                        }
                    }
                }

                return $return;
            }

            /**
             * @since 1.1.6
             *
             *
             */
            static function round_count_reviews( $reviews_num )
            {
                if ( !$reviews_num ) {
                    return;
                }
                if ( $reviews_num >= 1000 and $reviews_num < 1000000 ) {
                    $reviews_num = ( round( $reviews_num / 1000 ) ) . "." . "000+ ";
                }
                if ( $reviews_num >= 1000000 ) {
                    $reviews_num = ( round( $reviews_num / 1000000 ) ) . "." . "000.000+ ";
                }

                return $reviews_num;
            }

            /**
             * @since 1.1.6
             * create a list post type in this location .
             * to gmap3
             */
            static function get_list_post_type()
            {

                if ( !is_singular( 'location' ) ) {
                    return;
                }

                global $wpdb;
                $list_post_active = self::get_post_type_list_active();
                $post_type_sql    = " and ( ";
                if ( is_array( $list_post_active ) and !empty( $list_post_active ) ) {
                    foreach ( $list_post_active as $key => $value ) {
                        if ( $key != 0 ) {
                            $post_type_sql .= " or {$wpdb->posts}.post_type = '{$value}' ";
                        } else {
                            $post_type_sql .= " {$wpdb->posts}.post_type = '{$value}' ";
                        }
                    }
                }
                $post_type_sql .= " ) ";
                $location_id   = get_the_ID();

                $sql     = "
                select ID , post_title, post_type   from {$wpdb->posts} , {$wpdb->postmeta} 
                where {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                and {$wpdb->postmeta}.meta_key = 'id_location' 
                and {$wpdb->postmeta}.meta_value = '{$location_id}' 
                and {$wpdb->posts}.post_status = 'publish' 
                ";
                $sql     .= $post_type_sql;
                $sql     .= "
                group by ID";
                $results = $wpdb->get_results( $sql, OBJECT );

                $list_post_type = [];
                if ( is_array( $results ) and !empty( $results ) ) {
                    foreach ( $results as $key => $value ) {
                        $array_flag[ 'ID' ]        = $value->ID;
                        $array_flag[ 'lat' ]       = get_post_meta( $value->ID, 'map_lat', true );
                        $array_flag[ 'lng' ]       = get_post_meta( $value->ID, 'map_lng', true );
                        $array_flag[ 'link' ]      = get_permalink( $value->ID );
                        $array_flag[ 'post_type' ] = $value->post_type;
                        $list_post_type[]          = $array_flag;
                    }
                }
                $data_zoom_l = get_post_meta( get_the_ID(), 'map_zoom', true );

                if ( !$data_zoom_l ) {
                    $data_zoom_l = 15;
                }
                $current_location = [
                    'title'             => get_the_title(),
                    'map_lat'           => get_post_meta( get_the_ID(), 'map_lat', true ),
                    'map_lng'           => get_post_meta( get_the_ID(), 'map_lng', true ),
                    'location_map_zoom' => $data_zoom_l
                ];

                wp_localize_script( 'jquery', 'current_location', $current_location );
            }

            /**
             * from 1.1.8
             */
            static function edit_where_wpml( $where, $post_type = null )
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    global $wpdb;
                    $current_language = ICL_LANGUAGE_CODE;
                    $where            .= " AND t.language_code = '{$current_language}' ";
                }

                return $where;
            }

            /**
             * from 1.1.8
             */
            static function edit_join_wpml( $join, $post_type, $is_st_table = null )
            {
                if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
                    global $wpdb;
                    $on = "{$wpdb->posts}.ID";
                    if ( !empty( $is_st_table ) ) {
                        $on = "{$wpdb->prefix}{$post_type}.post_id";
                    }
                    $join .= "
                join {$wpdb->prefix}icl_translations as  t ON {$on} = t.element_id
                AND t.element_type = 'post_{$post_type}'
                JOIN {$wpdb->prefix}icl_languages as  l ON t.language_code = l.CODE
                AND l.active = 1 ";
                }

                return $join;
            }

            static function count_services( $location_id, $service_type = '' )
            {
                global $wpdb;
                $table = $wpdb->prefix . 'st_location_relationships';
                $sql   = "SELECT count(id) FROM {$table} WHERE 1=1 AND location_from = {$location_id}";
                if ( !empty( $service_type ) ) {
                    $sql .= " AND post_type IN ({$service_type})";
                }

                return (int)$wpdb->get_var( $sql );
            }


            static function inst()
            {
                if ( !self::$_inst ) {
                    self::$_inst = new self();
                }

                return self::$_inst;
            }

        }

        STLocation::inst()->init();
    }

// for location single 
    if ( !class_exists( 'st_location' ) ) {
        class st_location
        {
            static function _get_query_join( $join )
            {
                if ( !empty( $_SESSION[ 'el_post_type' ] ) ) {
                    $post_type = $_SESSION[ 'el_post_type' ];
                    if ( !TravelHelper::checkTableDuplicate( $post_type ) ) return $join;
                    global $wpdb;
                    $table = $wpdb->prefix . $post_type;
                    $join  .= " INNER JOIN {$table} as tb ON {$wpdb->prefix}posts.ID = tb.post_id";
                }

                return $join;
            }

            static function _get_query_where( $where )
            {
                if ( !empty( $_SESSION[ 'el_post_type' ] ) ) {
                    $post_type = $_SESSION[ 'el_post_type' ];
                    if ( !TravelHelper::checkTableDuplicate( $post_type ) ) return $where;
                    global $wpdb;
                    $location_id = get_the_ID();
                    if ( !empty( $location_id ) ) {
                        if ( is_array( $post_type ) ) {
                            $data_post_type = [];
                            foreach ( $post_type as $k => $v ) {
                                $data_post_type[] = $v;
                            }
                            $where = TravelHelper::_st_get_where_location( $location_id, $data_post_type, $where );
                        } else {
                            $where = TravelHelper::_st_get_where_location( $location_id, [ $post_type ], $where );
                        }

                    }
                }

                return $where;
            }
        }
    }