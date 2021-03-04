<?php
if(!class_exists('ST_Traveler_Modern_Hotel_Configs')){
    class ST_Traveler_Modern_Hotel_Configs{
        static $_inst;

        function __construct()
        {
            add_action( 'admin_init', array($this, 'customMetaBoxSearchResultPage') );
        }

        function customMetaBoxSearchResultPage(){

            $meta_data_box = array(
                'id' => 'st_hotel_search_result_options',
                'title' => esc_html__('Hotel Search Result Settings', ST_TEXTDOMAIN),
                'desc' => '',
                'pages' => array('page'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'id' => 'layout_tab',
                        'label' => esc_html__('General', ST_TEXTDOMAIN),
                        'type' => 'tab',
                    ),
                    array(
                        'id' => 'rs_layout',
                        'label' => esc_html__('Choose layout for page', ST_TEXTDOMAIN),
                        'desc' => '',
                        'type' => 'radio-image',
                        'section' => 'layout_tab',
                        'std' => '1',
                        'choices' => array(
                            array(
                                'value' => '1',
                                'label' => esc_html__('Layout Full Map', ST_TEXTDOMAIN),
                                'src' =>  get_template_directory_uri() . '/v2/images/layouts/rs_layout_1.png',
                            ),
                            array(
                                'value' => '2',
                                'label' => esc_html__('Layout Half Map', ST_TEXTDOMAIN),
                                'src' =>  get_template_directory_uri() . '/v2/images/layouts/rs_layout_2.png'
                            ),
                            array(
                                'value' => '3',
                                'label' => esc_html__('Popup Map', ST_TEXTDOMAIN),
                                'src' =>  get_template_directory_uri() . '/v2/images/layouts/rs_layout_3.png'
                            ),
                        )
                    ),
                    array(
                        'id'          => 'rs_style',
                        'label'       => __( 'Style default', ST_TEXTDOMAIN),
                        'desc'        => __( 'Select defaul style to display in the search result page', ST_TEXTDOMAIN),
                        'std'         => 'grid',
                        'type'        => 'select',
                        'section'     => 'layout_tab',
                        'choices'     => array(
                            array(
                                'value'       => 'grid',
                                'label'       => __( 'Grid', ST_TEXTDOMAIN),
                            ),
                            array(
                                'value'       => 'list',
                                'label'       => __( 'List', ST_TEXTDOMAIN),
                            ),
                        )
                    ),
                    /*array(
                        'id'          => 'rs_map_room',
                        'label'       => __( 'Map zoom', ST_TEXTDOMAIN),
                        'desc'        => __( 'Set map zoom in search result page', ST_TEXTDOMAIN),
                        'std'         => '13',
                        'type'        => 'numeric-slider',
                        'min_max_step' => '1, 20, 1',
                        'section'     => 'layout_tab',
                    ),*/
                    array(
                        'id' => 'filter_tab',
                        'label' => esc_html__('Filter', ST_TEXTDOMAIN),
                        'type' => 'tab',
                    ),
                    array(
                        'id'          => 'rs_filter',
                        'label'       => __( 'Create filter option', ST_TEXTDOMAIN),
                        'desc' => __('Create filter option for search page result', ST_TEXTDOMAIN),
                        'type'        => 'list-item',
                        'section'     => 'filter_tab',
                        'std' => array(
                            array(
                                'title' => 'Filter Price',
                                'rs_filter_type' => 'price',
                                'rs_filter_type_taxonomy' => 'hotel_theme'
                            ),
                            array(
                                'title' => 'Review Score',
                                'rs_filter_type' => 'review_score',
                                'rs_filter_type_taxonomy' => 'hotel_theme'
                            ),
                            array(
                                'title' => 'Hotel Star',
                                'rs_filter_type' => 'hotel_star',
                                'rs_filter_type_taxonomy' => 'hotel_theme'
                            ),
                            array(
                                'title' => 'Facilities',
                                'rs_filter_type' => 'taxonomy',
                                'rs_filter_type_taxonomy' => 'hotel_facilities'
                            ),
                            array(
                                'title' => 'Hotel Theme',
                                'rs_filter_type' => 'taxonomy',
                                'rs_filter_type_taxonomy' => 'hotel_theme'
                            ),
                        ),
                        'settings'    => array(
                            array(
                                'id'          => 'rs_filter_type',
                                'label'       => __( 'Filter item', ST_TEXTDOMAIN),
                                'std'         => 'price',
                                'type'        => 'select',
                                'choices'     => array(
                                    array(
                                        'value'       => 'price',
                                        'label'       => __( 'Price', ST_TEXTDOMAIN),
                                    ),
                                    array(
                                        'value'       => 'review_score',
                                        'label'       => __( 'Review score', ST_TEXTDOMAIN),
                                    ),
                                    array(
                                        'value'       => 'hotel_star',
                                        'label'       => __( 'Hotel star', ST_TEXTDOMAIN),
                                    ),
                                    array(
                                        'value'       => 'taxonomy',
                                        'label'       => __( 'Taxonomy', ST_TEXTDOMAIN),
                                    ),
                                )
                            ),
                            array(
                                'id'          => 'rs_filter_type_taxonomy',
                                'label'       => __( 'Taxonomy select', ST_TEXTDOMAIN),
                                'std'         => '',
                                'type'        => 'select',
                                'condition' => 'rs_filter_type:is(taxonomy)',
                                'choices'     => st_get_post_taxonomy('st_hotel')
                            ),
                        )
                    ),
                )
            );

            if(function_exists('ot_register_meta_box')) {
                ot_register_meta_box($meta_data_box);
            }

            /*if(isset($_GET['post']))
                $post_id = $_GET['post'];

            $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
            if ($template_file == 'template-hotel-search.php') {
                ot_register_meta_box( $meta_data_box );
            }*/
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }

    }
    ST_Traveler_Modern_Hotel_Configs::inst();
}