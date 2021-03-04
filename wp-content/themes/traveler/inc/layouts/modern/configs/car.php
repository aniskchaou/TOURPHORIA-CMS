<?php
if(!class_exists('ST_Traveler_Modern_Car_Configs')){
    class ST_Traveler_Modern_Car_Configs{
        static $_inst;

        function __construct()
        {
            add_action( 'admin_init', array($this, 'customMetaBoxSearchResultPage') );
        }

        function customMetaBoxSearchResultPage(){

            $meta_data_box = array(
                'id' => 'st_car_search_result_options',
                'title' => esc_html__('Car Search Result Settings', ST_TEXTDOMAIN),
                'desc' => '',
                'pages' => array('page'),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'id' => 'layout_car_tab',
                        'label' => esc_html__('General', ST_TEXTDOMAIN),
                        'type' => 'tab',
                    ),
                    array(
                        'id' => 'rs_layout_car',
                        'label' => esc_html__('Choose layout for page', ST_TEXTDOMAIN),
                        'desc' => '',
                        'type' => 'radio-image',
                        'section' => 'layout_car_tab',
                        'std' => '1',
                        'choices' => array(
                            array(
                                'value' => '1',
                                'label' => esc_html__('Sidebar Layout', ST_TEXTDOMAIN),
                                'src' =>  get_template_directory_uri() . '/v2/images/layouts/tour_rs_layout_1.png',
                            ),
                            array(
                                'value' => '2',
                                'label' => esc_html__('Topbar Layout', ST_TEXTDOMAIN),
                                'src' =>  get_template_directory_uri() . '/v2/images/layouts/tour_rs_layout_2.png'
                            ),
                        )
                    ),
                    array(
                        'id'          => 'rs_style_car',
                        'label'       => __( 'Style default', ST_TEXTDOMAIN),
                        'desc'        => __( 'Select default style to display in the search result page', ST_TEXTDOMAIN),
                        'std'         => 'grid',
                        'type'        => 'select',
                        'section'     => 'layout_car_tab',
                        'condition' => 'rs_layout_car:is(1)',
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
                    array(
                        'id' => 'filter_car_tab',
                        'label' => esc_html__('Filter', ST_TEXTDOMAIN),
                        'type' => 'tab',
                    ),
                    array(
                        'id'          => 'rs_filter_car',
                        'label'       => __( 'Create filter option', ST_TEXTDOMAIN),
                        'desc' => __('Create filter option for search page result', ST_TEXTDOMAIN),
                        'type'        => 'list-item',
                        'section'     => 'filter_car_tab',
                        'std' => array(
                            array(
                                'title' => 'Filter Price',
                                'rs_filter_type' => 'price',
                                'rs_filter_type_taxonomy' => 'hotel_theme'
                            ),
                            array(
                                'title' => 'Categories',
                                'rs_filter_type' => 'taxonomy',
                                'rs_filter_type_taxonomy' => 'st_category_cars'
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
                                'choices'     => st_get_post_taxonomy('st_cars')
                            ),
                        )
                    ),
                )
            );

            if(function_exists('ot_register_meta_box')) {
                ot_register_meta_box($meta_data_box);
            }
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }

    }
    ST_Traveler_Modern_Car_Configs::inst();
}