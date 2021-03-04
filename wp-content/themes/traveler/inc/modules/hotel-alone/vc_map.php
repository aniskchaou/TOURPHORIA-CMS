<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/04/2018
 * Time: 14:18 CH
 */
add_action( 'vc_before_init', 'st_map_hotel_alone_shortcodes' );

function st_map_hotel_alone_shortcodes()
{
    vc_map(array(
        'name' => esc_html__('[Hotel Single] About', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_about',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Icon and information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1'=> array(
                        'title'=>esc_html__('Style 1',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir() .'/images/st-about/a-style-1.png',
                    ),
                    'style-2'=> array(
                        'title'=>esc_html__('Style 2',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir() . '/images/st-about/a-style-2.png',
                    )
                ),
                'w' => 'w320'
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', ST_TEXTDOMAIN),
                'param_name' => 'icon',
                'description' => esc_html__('Choose a icon', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter description', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Enter a link',ST_TEXTDOMAIN),
                'param_name' => 'link',
                'description' => esc_html__('Enter a link for element', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Banner Single Room',ST_TEXTDOMAIN),
        'base' => 'hotel_alone_banner_single_room',
        'description' => esc_html__('ST Banner Single Room',ST_TEXTDOMAIN),
        'icon' => 'icon-st',
        'category'    => array("Hotel Single") ,
        'params' => array(
            array(
                'type'        => 'radio_image' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Style Options' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'style' ,
                'std'         => 'style-1' ,
                'value'       => array(
                    'style-1' => array(
                        'title' => esc_html__( 'Style Slide' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-banner-single-room/style-1.png' ,
                    ) ,
                    'style-2' => array(
                        'title' => esc_html__( 'Style Image' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-banner-single-room/style-2.png' ,
                    ) ,
                )
            ) ,
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('#scroll',ST_TEXTDOMAIN),
                'param_name' => 'link_scroll',
                'description' => esc_html__('Enter a ID for scroll',ST_TEXTDOMAIN),
                'std' => '',
                'edit_field_class' => 'vc_column vc_col-sm-12'
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Blog',ST_TEXTDOMAIN),
        'base' => 'hotel_alone_blog',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('List blog', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Type',ST_TEXTDOMAIN),
                'param_name' => 'type',
                'value' => array(
                    esc_html__('Grid',ST_TEXTDOMAIN) => 'grid',
                    esc_html__('List',ST_TEXTDOMAIN) => 'list',
                    esc_html__('Carousel',ST_TEXTDOMAIN) => 'carousel',
                    esc_html__('Isotope',ST_TEXTDOMAIN) => 'isotope',
                ),
                'std' => 'grid'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Style 1',ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Style 2',ST_TEXTDOMAIN) => 'style-2',
                    esc_html__('Style Hotel activity',ST_TEXTDOMAIN) => 'style-activity',
                ),
                'std' => 'style-1',
                'dependency' => array(
                    'element' => 'type',
                    'value' => array('grid')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'carousel_style',
                'value' => array(
                    esc_html__('Style 1',ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Style 2',ST_TEXTDOMAIN) => 'style-2',
                ),
                'std' => 'style-1',
                'dependency' => array(
                    'element' => 'type',
                    'value' => array('carousel')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'isotope_style',
                'value' => array(
                    esc_html__('Style 1',ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Style 2',ST_TEXTDOMAIN) => 'style-2',
                ),
                'std' => 'style-1',
                'dependency' => array(
                    'element' => 'type',
                    'value' => array('isotope')
                )
            ),
            array(
                'type' => 'st_number',
                'admin_label' => true,
                'heading' => esc_html__('Number Post Items',ST_TEXTDOMAIN),
                'param_name' => 'number_items',
                'description' => esc_html__('Enter number post items',ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'st_checkbox',
                'heading' => esc_html__('Select Categories',ST_TEXTDOMAIN),
                'param_name' => 'select_category',
                'desc' => esc_html__('Check the box to choose category',ST_TEXTDOMAIN),
                'stype' => 'tax',
                'sparam' => false
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order By',ST_TEXTDOMAIN),
                'param_name' => 'order_by',
                'value' => array_flip(hotel_alone_get_order_list()),
                'std' => 'ID'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order',ST_TEXTDOMAIN),
                'param_name' => 'order',
                'value' => array(
                    esc_html__('Descending',ST_TEXTDOMAIN) => 'DESC',
                    esc_html__('Ascending',ST_TEXTDOMAIN) => 'ASC',
                ),
                'std' => 'DESC'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Load More',ST_TEXTDOMAIN),
                'param_name' => 'load_more',
                'desc' => esc_html__('Choose yes to show load more button in type isotope',ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Yes' ,ST_TEXTDOMAIN) => 'yes'
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => array('isotope')
                )
            ),
        )
    ));
    vc_map( array(
        'name'        => esc_html__( '[Hotel Single] ST Booking Room' , ST_TEXTDOMAIN ) ,
        'base'        => 'hotel_alone_booking_room' ,
        'description' => esc_html__( 'ST Booking Room' , ST_TEXTDOMAIN ) ,
        'icon'        => 'icon-st' ,
        'category'    => array('Hotel Single') ,
        'params'      => array(
            array(
                'type'        => 'radio_image' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Style Options' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'style' ,
                'std'         => 'style-1' ,
                'value'       => array(
                    'style-1' => array(
                        'title' => esc_html__( 'Style 1' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-booking-room/style-1.jpg' ,
                    ) ,
                    'style-2' => array(
                        'title' => esc_html__( 'Style 2' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-booking-room/style-2.jpg' ,
                    ) ,
                )
            ) ,
            array(
                'type'        => 'textfield' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Title' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'title' ,
                'description' => esc_html__( 'Enter a text for title' , ST_TEXTDOMAIN ) ,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2')
                )
            ) ,
            array(
                'type'        => 'textfield' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Reservation Hotline' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'phone' ,
                'description' => esc_html__( 'Reservation Hotline' , ST_TEXTDOMAIN ) ,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ) ,
            array(
                'type'       => 'param_group' ,
                'heading'    => esc_html__( 'Hotel Room Fields Search' , ST_TEXTDOMAIN ) ,
                'param_name' => 'hotel_room_fields' ,
                'params'     => array(
                    array(
                        'type'        => 'textfield' ,
                        'admin_label' => true ,
                        'heading'     => esc_html__( 'Label' , ST_TEXTDOMAIN ) ,
                        'param_name'  => 'label'
                    ) ,
                    array(
                        'type'       => 'dropdown' ,
                        'heading'    => esc_html__( 'Field Attribute' , ST_TEXTDOMAIN ) ,
                        'param_name' => 'field_attribute' ,
                        'value'      => hotel_alone_vc_convert_array( st_hotel_alone_get_search_fields_for_element() ) ,

                    ) ,
                    array(
                        'type'       => 'dropdown' ,
                        'heading'    => esc_html__( 'Layout Normal Size' , ST_TEXTDOMAIN ) ,
                        'param_name' => 'layout_size' ,
                        'value'      => array(
                            esc_html__( '1 column' , ST_TEXTDOMAIN )   => '1' ,
                            esc_html__( '2 columns' , ST_TEXTDOMAIN )  => '2' ,
                            esc_html__( '3 columns' , ST_TEXTDOMAIN )  => '3' ,
                            esc_html__( '4 columns' , ST_TEXTDOMAIN )  => '4' ,
                            esc_html__( '5 columns' , ST_TEXTDOMAIN )  => '5' ,
                            esc_html__( '6 columns' , ST_TEXTDOMAIN )  => '6' ,
                            esc_html__( '7 columns' , ST_TEXTDOMAIN )  => '7' ,
                            esc_html__( '8 columns' , ST_TEXTDOMAIN )  => '8' ,
                            esc_html__( '9 columns' , ST_TEXTDOMAIN )  => '9' ,
                            esc_html__( '10 columns' , ST_TEXTDOMAIN ) => '10' ,
                            esc_html__( '11 columns' , ST_TEXTDOMAIN ) => '11' ,
                            esc_html__( '12 columns' , ST_TEXTDOMAIN ) => '12' ,
                        ) ,
                        'std'        => '12'
                    ) ,
                ) ,
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ) ,
            ) ,
        )
    ) );
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Breadcrumb',ST_TEXTDOMAIN),
        'base' => 'hotel_alone_breadcrumb',
        'description' => esc_html__('ST Breadcrumb',ST_TEXTDOMAIN),
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Title Source',ST_TEXTDOMAIN),
                'param_name' => 'title_source',
                'description' => esc_html__('Select title source',ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Custom Title',ST_TEXTDOMAIN) => 'custom_title',
                    esc_html__('Post or page,... title',ST_TEXTDOMAIN) => 'get_title'
                ),
                'std' => 'custom_title'
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title',ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title',ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'title_source',
                    'value' => array('custom_title')
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Text Color',ST_TEXTDOMAIN),
                'param_name' => 'title_color',
                'description' => esc_html__('Choose color for text',ST_TEXTDOMAIN),
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('ST Clients', ST_TEXTDOMAIN),
        'base' => 'st_clients',
        'icon' => 'icon-st',
        'category' => 'Shinetheme',
        'description' => esc_html__('List clients', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('No of items', ST_TEXTDOMAIN),
                'param_name' => 'items',
                'description' => esc_html__('Number item to display in element', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('3 items', ST_TEXTDOMAIN) => 3,
                    esc_html__('4 items', ST_TEXTDOMAIN) => 4,
                ),
                'std' => 4
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('List Clients', ST_TEXTDOMAIN),
                'param_name' => 'list_clients',
                'value' => '',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'admin_label' => true,
                        'heading' => esc_html__('Logo', ST_TEXTDOMAIN),
                        'param_name' => 'logo',
                        'description' => esc_html__('Upload an image for logo', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link Social', ST_TEXTDOMAIN),
                        'param_name' => 'link',
                        'description' => esc_html__('Insert a link for client', ST_TEXTDOMAIN)
                    )
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )

        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Form Search Room',ST_TEXTDOMAIN),
        'base' => 'hotel_alone_form_search_room',
        'description' => esc_html__('ST Form Search Room',ST_TEXTDOMAIN),
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'params' => array(
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => esc_html__('Title',ST_TEXTDOMAIN),
                'param_name' => 'content',
                'description' => esc_html__('Enter a text for title',ST_TEXTDOMAIN),
            ),
            array(
                'type' 			=> 'st_dropdown',
                'class' 		=> '',
                'heading' => esc_html__( 'Select Hotel', ST_TEXTDOMAIN ),
                'param_name' => 'service_id',
                'stype' => 'post_type',
                'sparam' => 'st_hotel',
                'sautocomplete' => 'yes',
                'description' => esc_html__( 'Enter List of Hotels', ST_TEXTDOMAIN ),
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Hotel Room Fields Search', ST_TEXTDOMAIN),
                'param_name' => 'hotel_room_fields',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Label', ST_TEXTDOMAIN),
                        'param_name' => 'label'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Field Attribute', ST_TEXTDOMAIN),
                        'param_name' => 'field_attribute',
                        'value' => hotel_alone_vc_convert_array(st_hotel_alone_get_search_fields_for_element())

                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Layout Normal Size',ST_TEXTDOMAIN),
                        'param_name' => 'layout_size',
                        'value' => array(
                            esc_html__('1 column',ST_TEXTDOMAIN) => '1',
                            esc_html__('2 columns',ST_TEXTDOMAIN) => '2',
                            esc_html__('3 columns',ST_TEXTDOMAIN) => '3',
                            esc_html__('4 columns',ST_TEXTDOMAIN) => '4',
                            esc_html__('5 columns',ST_TEXTDOMAIN) => '5',
                            esc_html__('6 columns',ST_TEXTDOMAIN) => '6',
                            esc_html__('7 columns',ST_TEXTDOMAIN) => '7',
                            esc_html__('8 columns',ST_TEXTDOMAIN) => '8',
                            esc_html__('9 columns',ST_TEXTDOMAIN) => '9',
                            esc_html__('10 columns',ST_TEXTDOMAIN) => '10',
                            esc_html__('11 columns',ST_TEXTDOMAIN) => '11',
                            esc_html__('12 columns',ST_TEXTDOMAIN) => '12',
                        ),
                        'std' => '12'
                    ),
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ),
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Hotel Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_el_hotel_info',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Add info for hotel', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Hotel Logo', ST_TEXTDOMAIN),
                'param_name' => 'logo',
                'description' => esc_html__('Upload an image for logo of hotel', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sub Title', ST_TEXTDOMAIN),
                'param_name' => 'sub_title',
                'description' => esc_html__('Enter a text for sub title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Hotel Stars', ST_TEXTDOMAIN),
                'param_name' => 'star',
                'value' => array(
                    esc_html__('5 stars', ST_TEXTDOMAIN) => 5,
                    esc_html__('4 stars', ST_TEXTDOMAIN) => 4,
                    esc_html__('3 stars', ST_TEXTDOMAIN) => 3,
                    esc_html__('2 stars', ST_TEXTDOMAIN) => 2,
                    esc_html__('1 stars', ST_TEXTDOMAIN) => 1
                ),
                'std' => 5
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Reservation Hotline',ST_TEXTDOMAIN),
                'param_name' => 'hotline',
                'description' => esc_html__('Reservation Hotline', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter description', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('ST List Carousel Hotel Room', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_list_feature_hotel_room',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'params' => array(
            array(
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('List Style Options',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1'=> array(
                        'title'=>esc_html__('Style 1',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir() .'/images/st-list-feature-hotel-room/style-1.jpg',
                    ),
                    'style-2'=> array(
                        'title'=>esc_html__('Style 2',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-list-feature-hotel-room/style-2.jpg',
                    ),
                    'style-3'=> array(
                        'title'=>esc_html__('Style 3',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-list-feature-hotel-room/style-3.jpg',
                    ),
                ),
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter description', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' 			=> 'st_dropdown',
                'class' 		=> '',
                'heading' => esc_html__( 'Select Hotel', ST_TEXTDOMAIN ),
                'param_name' => 'service_id',
                'stype' => 'post_type',
                'sparam' => 'st_hotel',
                'description' => esc_html__( 'Enter List of Services', ST_TEXTDOMAIN ),
            ),

            array(
                'type' => 'st_checkbox',
                'heading' => esc_html__('Select Categories',ST_TEXTDOMAIN),
                'param_name' => 'select_category',
                'desc' => esc_html__('Check the box to choose category',ST_TEXTDOMAIN),
                'stype' => 'tax',
                'sparam' => 'room_type'
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Number Items',ST_TEXTDOMAIN),
                'param_name' => 'number_post',
                'description' => esc_html__('Number services', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('2 Item', ST_TEXTDOMAIN) => '2',
                    esc_html__('3 Item', ST_TEXTDOMAIN) => '3',
                    esc_html__('4 Item', ST_TEXTDOMAIN) => '4',
                    esc_html__('6 Item', ST_TEXTDOMAIN) => '6',
                ),
                'prefix' => esc_html__('service', ST_TEXTDOMAIN),
                'edit_field_class' => 'vc_column vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order By', ST_TEXTDOMAIN),
                'param_name' => 'order_by',
                'value' => hotel_alone_vc_convert_array(hotel_alone_get_order_list()),
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'std' => 'ID'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order', ST_TEXTDOMAIN),
                'param_name' => 'order',
                'value' => array(
                    esc_html__('ASC', ST_TEXTDOMAIN) => 'ASC',
                    esc_html__('DESC', ST_TEXTDOMAIN) => 'DESC'
                ),
                'std' => 'DESC',
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST List Offers',ST_TEXTDOMAIN),
        'base' => 'hotel_alone_list_offers',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('List offers', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1'=> array(
                        'title'=>esc_html__('Style 1',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-list-offers/o-style-1.png',
                    ),
                    'style-2'=> array(
                        'title'=>esc_html__('Style 2',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-list-offers/o-style-2.png',
                    ),
                    'style-3'=> array(
                        'title'=>esc_html__('Style 3',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-list-offers/o-style-3.png',
                    )
                ),
                'w' => 'w320'
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sub Title', ST_TEXTDOMAIN),
                'param_name' => 'sub_title',
                'description' => esc_html__('Enter a text for sub title', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter a text for description', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),

            array(
                'type' => 'param_group',
                "heading" => esc_html__("List Offer", ST_TEXTDOMAIN),
                "param_name" => "list_offfer",
                'value' =>'',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Offer Image', ST_TEXTDOMAIN),
                        'param_name' => 'image',
                        'description' => esc_html__('Image of this offer', ST_TEXTDOMAIN),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Name of offer', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                        'param_name' => 'desc',
                        'description' => esc_html__('Description to this offer', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'st_number',
                        'heading' => esc_html__('Price per person', ST_TEXTDOMAIN),
                        'param_name' => 'price',
                        'min' => 0,
                        'max' => 200,
                        'prefix' => ''
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link', ST_TEXTDOMAIN),
                        'param_name' => 'link',
                        'description' => esc_html__('Custom link of service', ST_TEXTDOMAIN)
                    )
                )
            ),

        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Related Room', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_related',
        'icon' => 'icon-st',
        'category' => array("Hotel Single","Single"),
        'description' => esc_html__('Related Room', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Number Items',ST_TEXTDOMAIN),
                'param_name' => 'number_post',
                'description' => esc_html__('Number services', ST_TEXTDOMAIN),
                'value' => '3',
                'prefix' => esc_html__('service', ST_TEXTDOMAIN),
                'edit_field_class' => 'vc_column vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Reservation Contact', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_reservation_contact',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Icon and information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter description', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Phone', ST_TEXTDOMAIN),
                'param_name' => 'phone',
                'description' => esc_html__('Enter a phone', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Email', ST_TEXTDOMAIN),
                'param_name' => 'email',
                'description' => esc_html__('Enter a email', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map( array(
        'name'        => esc_html__( '[Hotel Single] ST Reservation Content' , ST_TEXTDOMAIN ) ,
        'base'        => 'hotel_alone_reservation_content' ,
        'description' => esc_html__( 'ST Reservation Content' , ST_TEXTDOMAIN ) ,
        'icon'        => 'icon-st' ,
        'category'    => 'Hotel Single' ,
        'params'      => array(
            array(
                'type'        => 'st_dropdown' ,
                'class'       => '' ,
                'heading'     => esc_html__( 'Select Hotel' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'service_id' ,
                'stype' => 'post_type',
                'sparam' => 'st_hotel',
                'sautocomplete' => 'yes',
                'description' => esc_html__( 'Enter List of Services' , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                'type'        => 'radio_image' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Style Options' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'style' ,
                'std'         => 'style-1' ,
                'value'       => array(
                    'style-1' => array(
                        'title' => esc_html__( 'Style List' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-reservation-content/style-1.jpg' ,
                    ) ,
                    'style-2' => array(
                        'title' => esc_html__( 'Style Grid' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-reservation-content/style-2.jpg' ,
                    ) ,
                )
            ) ,
        )
    ) );
    vc_map( array(
        'name'        => esc_html__( '[Hotel Single] ST Reservation Room' , ST_TEXTDOMAIN ) ,
        'base'        => 'hotel_alone_reservation_room' ,
        'description' => esc_html__( 'ST Reservation Room' , ST_TEXTDOMAIN ) ,
        'icon'        => 'icon-st' ,
        'category'    => 'Hotel Single' ,
        'params'      => array(
            array(
                'type'        => 'textarea' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Title' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'content' ,
                'description' => esc_html__( 'Enter a text for title' , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                'type'        => 'st_dropdown' ,
                'class'       => '' ,
                'heading'     => esc_html__( 'Select Hotel' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'service_id' ,
                'stype' => 'post_type',
                'sparam' => 'st_hotel',
                'sautocomplete' => 'yes',
                'description' => esc_html__( 'Enter List of Services' , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                'type'       => 'param_group' ,
                'heading'    => esc_html__( 'Hotel Room Fields Search' , ST_TEXTDOMAIN ) ,
                'param_name' => 'hotel_room_fields' ,
                'params'     => array(
                    array(
                        'type'        => 'textfield' ,
                        'admin_label' => true ,
                        'heading'     => esc_html__( 'Label' , ST_TEXTDOMAIN ) ,
                        'param_name'  => 'label'
                    ) ,
                    array(
                        'type'       => 'dropdown' ,
                        'heading'    => esc_html__( 'Field Attribute' , ST_TEXTDOMAIN ) ,
                        'param_name' => 'field_attribute' ,
                        'value'      => hotel_alone_vc_convert_array(st_hotel_alone_get_search_fields_for_element()),

                    ) ,
                    array(
                        'type'       => 'dropdown' ,
                        'heading'    => esc_html__( 'Layout Normal Size' , ST_TEXTDOMAIN ) ,
                        'param_name' => 'layout_size' ,
                        'value'      => array(
                            esc_html__( '1 column' , ST_TEXTDOMAIN )   => '1' ,
                            esc_html__( '2 columns' , ST_TEXTDOMAIN )  => '2' ,
                            esc_html__( '3 columns' , ST_TEXTDOMAIN )  => '3' ,
                            esc_html__( '4 columns' , ST_TEXTDOMAIN )  => '4' ,
                            esc_html__( '5 columns' , ST_TEXTDOMAIN )  => '5' ,
                            esc_html__( '6 columns' , ST_TEXTDOMAIN )  => '6' ,
                            esc_html__( '7 columns' , ST_TEXTDOMAIN )  => '7' ,
                            esc_html__( '8 columns' , ST_TEXTDOMAIN )  => '8' ,
                            esc_html__( '9 columns' , ST_TEXTDOMAIN )  => '9' ,
                            esc_html__( '10 columns' , ST_TEXTDOMAIN ) => '10' ,
                            esc_html__( '11 columns' , ST_TEXTDOMAIN ) => '11' ,
                            esc_html__( '12 columns' , ST_TEXTDOMAIN ) => '12' ,
                        ) ,
                        'std'        => '12'
                    ) ,
                ) ,
                'callbacks'  => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ) ,
            ) ,
        )
    ) );
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Discount By Day Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_discount_by_day_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('Room Extra Service Information', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_extra_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room Extra Service Information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Other Facility Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_facility_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Number item/row ',ST_TEXTDOMAIN),
                'param_name' => 'number_of_row',
                'value' => array(
                    esc_html__('4 Item',ST_TEXTDOMAIN) => '4',
                    esc_html__('3 Item',ST_TEXTDOMAIN) => '3',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Check In/Out Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_in_out_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single","Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type'        => 'radio_image' ,
                'admin_label' => true ,
                'heading'     => esc_html__( 'Style Options' , ST_TEXTDOMAIN ) ,
                'param_name'  => 'style' ,
                'std'         => 'style-1' ,
                'value'       => array(
                    'style-1' => array(
                        'title' => esc_html__( 'Style 1' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-room-info/style-1.jpg' ,
                    ) ,
                    'style-2' => array(
                        'title' => esc_html__( 'Style 2' , ST_TEXTDOMAIN ) ,
                        'image' => st_hotel_alone_load_assets_dir() . '/images/st-room-info/style-2.jpg' ,
                    ) ,
                )
            ) ,
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Meta', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_meta',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Meta', ST_TEXTDOMAIN),
                'param_name' => 'meta',
                'description' => esc_html__('Select a meta', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Room Description', ST_TEXTDOMAIN) => 'room_description',
                ),
                'std' => 'room_description'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Room Taxonomy Info', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_room_taxonomy_info',
        'icon' => 'icon-st',
        'category' => array("Hotel Single"),
        'description' => esc_html__('Room information', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'st_dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Choose taxonomy ',ST_TEXTDOMAIN),
                'param_name' => 'choose_taxonomy',
                'stype' => 'tax',
                'sparam' => 'hotel_room',
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Number item/row ',ST_TEXTDOMAIN),
                'param_name' => 'number_of_row',
                'value' => array(
                    esc_html__('4 Item',ST_TEXTDOMAIN) => '4',
                    esc_html__('3 Item',ST_TEXTDOMAIN) => '3',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('ST Share', ST_TEXTDOMAIN),
        'base' => 'st_share',
        'icon' => 'icon-st',
        'category' => array("Shinetheme","Single"),
        'description' => esc_html__('Share Service', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Signature', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_signature',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Create signature', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Signature Image', ST_TEXTDOMAIN),
                'param_name' => 'sig_image',
                'description' => esc_html__('Upload an image', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Name', ST_TEXTDOMAIN),
                'param_name' => 'name',
                'description' => esc_html__('Enter a name', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Position', ST_TEXTDOMAIN),
                'param_name' => 'position',
                'description' => esc_html__('Enter position', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Signature Align', ST_TEXTDOMAIN),
                'param_name' => 'align',
                'description' => esc_html__('Select a align', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Left', ST_TEXTDOMAIN) => 'left',
                    esc_html__('Center', ST_TEXTDOMAIN) => 'center'
                ),
                'std' => 'style-1'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] Slider', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_slider',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Create slider',ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('Style Option',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1'=> array(
                        'title'=>esc_html__('Style 1',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir() .'/images/st-slide/style-1.jpg',
                    ),
                    'style-2'=> array(
                        'title'=>esc_html__('Style 2',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-slide/style-2.jpg',
                    ),
                    'style-3'=> array(
                        'title'=>esc_html__('Style 3',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-slide/style-3.jpg',
                    ),
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title',ST_TEXTDOMAIN),
                'param_name' => 'st_title',
                'description' => esc_html__('Input a text for title',ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1','style-2','style-3')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content',ST_TEXTDOMAIN),
                'param_name' => 'st_content',
                'description' => esc_html__('Input a text for sub title',ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1','style-2','style-3')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sub Title',ST_TEXTDOMAIN),
                'param_name' => 'st_sub_title',
                'description' => esc_html__('Input a text for sub title',ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link ViewMore',ST_TEXTDOMAIN),
                'param_name' => 'st_link_viewmore',
                'description' => esc_html__('Link ViewMore',ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2','style-3')
                )
            ),
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('List Feature Images',ST_TEXTDOMAIN),
                'param_name' => 'list_images',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1','style-2','style-3')
                )
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('#scroll',ST_TEXTDOMAIN),
                'param_name' => 'link_scroll',
                'description' => esc_html__('Enter a ID for scroll',ST_TEXTDOMAIN),
                'std' => '',
                'edit_field_class' => 'vc_column vc_col-sm-12',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1','style-2')
                )
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Text scroll 1',ST_TEXTDOMAIN),
                'param_name' => 'text_sroll_1',
                'description' => esc_html__('Enter a text for scroll',ST_TEXTDOMAIN),
                'std' => '',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2')
                )
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Text scroll 2',ST_TEXTDOMAIN),
                'param_name' => 'text_sroll_2',
                'description' => esc_html__('Enter a text for scroll',ST_TEXTDOMAIN),
                'std' => '',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2')
                )
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('ST Socials', ST_TEXTDOMAIN),
        'base' => 'st_socials',
        'icon' => 'icon-st',
        'category' => 'Shinetheme',
        'description' => esc_html__('List socials', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Align', ST_TEXTDOMAIN),
                'param_name' => 'align',
                'description' => esc_html__('Select a style', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Left', ST_TEXTDOMAIN) => 'text-left',
                    esc_html__('Center', ST_TEXTDOMAIN) => 'text-center',
                    esc_html__('Right', ST_TEXTDOMAIN) => 'text-right'
                ),
                'std' => 'text-left'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Follow us text', ST_TEXTDOMAIN),
                'param_name' => 'follow_us',
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 'yes'
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('List Socials', ST_TEXTDOMAIN),
                'param_name' => 'list_social',
                'value' => '',
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'admin_label' => true,
                        'heading' => esc_html__('Icon', ST_TEXTDOMAIN),
                        'param_name' => 'icon',
                        'description' => esc_html__('Choose a icon', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link Social', ST_TEXTDOMAIN),
                        'param_name' => 'link',
                        'description' => esc_html__('Insert a link for social', ST_TEXTDOMAIN)
                    )
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )

        )
    ));
    vc_map(array(
        'name' => esc_html__('ST Special Services', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_special_services',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('List our services', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1'=> array(
                        'title'=>esc_html__('Style 1 (carousel)',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-special-services/s-style-1.png',
                    ),
                    'style-2'=> array(
                        'title'=>esc_html__('Style 2',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-special-services/s-style-2.png',
                    ),
                    'style-3'=> array(
                        'title'=>esc_html__('Style 3',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-special-services/s-style-3.png',
                    ),
                    'style-4'=> array(
                        'title'=>esc_html__('Style 4',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-special-services/s-style-4.png',
                    ),
                    'style-5'=> array(
                        'title'=>esc_html__('Style 5',ST_TEXTDOMAIN),
                        'image'=>st_hotel_alone_load_assets_dir().'/images/st-special-services/s-style-5.png',
                    ),
                ),
                'w' => 'w320'
            ),
            array(
                'type' => 'param_group',
                "heading" => esc_html__("List Services", ST_TEXTDOMAIN),
                "param_name" => "list_style_1",
                'value' =>'',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Service Image', ST_TEXTDOMAIN),
                        'param_name' => 'image',
                        'description' => esc_html__('Image of this service', ST_TEXTDOMAIN),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Name of service', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                        'param_name' => 'desc',
                        'description' => esc_html__('Description to this service', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link', ST_TEXTDOMAIN),
                        'param_name' => 'link',
                        'description' => esc_html__('Custom link of service', ST_TEXTDOMAIN)
                    )
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )

            ),
            array(
                'type' => 'param_group',
                "heading" => esc_html__("List Services", ST_TEXTDOMAIN),
                "param_name" => "list_style_2",
                'value' =>'',
                'params' => array(
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__('Icon', ST_TEXTDOMAIN),
                        'param_name' => 'icon',
                        'description' => esc_html__('Choose a icon', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Service Image', ST_TEXTDOMAIN),
                        'param_name' => 'image',
                        'description' => esc_html__('Image of this service', ST_TEXTDOMAIN),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Name of service', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                        'param_name' => 'desc',
                        'description' => esc_html__('Description to this service', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__('Link', ST_TEXTDOMAIN),
                        'param_name' => 'link',
                        'description' => esc_html__('Custom link of service', ST_TEXTDOMAIN)
                    )
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2', 'style-3', 'style-4', 'style-5')
                )

            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('[Hotel Single] ST Testimonials', ST_TEXTDOMAIN),
        'base' => 'hotel_alone_testimonials',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Customer review', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'description' => esc_html__('Select a style', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Style 1 (full width)', ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Style 2 (small)', ST_TEXTDOMAIN) => 'style-2'
                ),
                'std' => 'style-1'
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Show Navigation', ST_TEXTDOMAIN),
                'param_name' => 'show_nav',
                'description' => esc_html__('Show navigation for slide',ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 1,
                    esc_html__('No', ST_TEXTDOMAIN) => 0
                ),
                'std' => 1
            ),
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Show Pagination', ST_TEXTDOMAIN),
                'param_name' => 'show_pagi',
                'description' => esc_html__('Show pagination for slide',ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 1,
                    esc_html__('No', ST_TEXTDOMAIN) => 0
                ),
                'std' => 1
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Version Style', ST_TEXTDOMAIN),
                'param_name' => 'v_style',
                'value' => array(
                    esc_html__('Light', ST_TEXTDOMAIN) => 'light',
                    esc_html__('Dark', ST_TEXTDOMAIN) => 'dark'
                ),
                'std' => 'light',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('List Reviews', ST_TEXTDOMAIN),
                'param_name' => 'lists',
                'value' => '',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Name', ST_TEXTDOMAIN),
                        'param_name' => 'name',
                        'description' => esc_html__('Name of customer', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Position', ST_TEXTDOMAIN),
                        'param_name' => 'position',
                        'description' => esc_html__('Position of customer', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Avatar', ST_TEXTDOMAIN),
                        'param_name' => 'avatar',
                        'description' => esc_html__('Upload avatar for customer', ST_TEXTDOMAIN)
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Content Review', ST_TEXTDOMAIN),
                        'param_name' => 'content_review',
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Review Stars',ST_TEXTDOMAIN),
                        'param_name' => 'stars',
                        'value' => array(
                            esc_html__('5 stars', ST_TEXTDOMAIN) => 5,
                            esc_html__('4 stars', ST_TEXTDOMAIN) => 4,
                            esc_html__('3 stars', ST_TEXTDOMAIN) => 3,
                            esc_html__('2 stars', ST_TEXTDOMAIN) => 2,
                            esc_html__('1 stars', ST_TEXTDOMAIN) => 1
                        ),
                        'std' => 5
                    )
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )

        )
    ));
    vc_map(array(
        'base' => 'hotel_alone_title',
        'name' => esc_html__('ST Title', ST_TEXTDOMAIN),
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Customize text', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'admin_label' => true,
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Sub Title', ST_TEXTDOMAIN),
                'param_name' => 'sub_title',
                'description' => esc_html__('Enter a sub title', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title Link', ST_TEXTDOMAIN),
                'param_name' => 'title_link'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Separator', ST_TEXTDOMAIN),
                'param_name' => 'separator',
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 'yes'
                ),
                'std' => 'yes'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Heading', ST_TEXTDOMAIN),
                'param_name' => 'heading',
                'std' => 'h3',
                'value' => array(
                    esc_html__('Heading 1', ST_TEXTDOMAIN) => 'h1',
                    esc_html__('Heading 2', ST_TEXTDOMAIN) => 'h2',
                    esc_html__('Heading 3', ST_TEXTDOMAIN) => 'h3',
                    esc_html__('Heading 4', ST_TEXTDOMAIN) => 'h4',
                    esc_html__('Heading 5', ST_TEXTDOMAIN) => 'h5',
                    esc_html__('Heading 6', ST_TEXTDOMAIN) => 'h6'
                )
            ),
            array(
                'type' => 'st_number',
                'heading' => esc_html__('Font Size(title)', ST_TEXTDOMAIN),
                'param_name' => 'title_font_size',
                'min' => 1,
                'max' => 200,
                'prefix' => 'px',
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
            array(
                'type' => 'st_number',
                'heading' => esc_html__('Line Height(title)', ST_TEXTDOMAIN),
                'param_name' => 'title_line_height',
                'min' => 1,
                'max' => 200,
                'prefix' => 'px',
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Font Weight(title)', ST_TEXTDOMAIN),
                'param_name' => 'title_font_weight',
                'std' => '400',
                'value' => array(
                    esc_html__('100' ,ST_TEXTDOMAIN) => 100,
                    esc_html__('200' ,ST_TEXTDOMAIN) => 200,
                    esc_html__('300' ,ST_TEXTDOMAIN) => 300,
                    esc_html__('400' ,ST_TEXTDOMAIN) => 400,
                    esc_html__('500' ,ST_TEXTDOMAIN) => 500,
                    esc_html__('600' ,ST_TEXTDOMAIN) => 600,
                    esc_html__('700' ,ST_TEXTDOMAIN) => 700,
                    esc_html__('800' ,ST_TEXTDOMAIN) => 800,
                    esc_html__('900' ,ST_TEXTDOMAIN) => 900,
                    esc_html__('Bold' ,ST_TEXTDOMAIN) => 'bold',
                    esc_html__('Normal' ,ST_TEXTDOMAIN) => 'normal',
                ),
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Text Align', ST_TEXTDOMAIN),
                'param_name' => 'text_align',
                'std' => 'center',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'value' => array(
                    esc_html__('Left' ,ST_TEXTDOMAIN) => 'left',
                    esc_html__('Center' ,ST_TEXTDOMAIN) => 'center',
                    esc_html__('Right' ,ST_TEXTDOMAIN) => 'right',
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', ST_TEXTDOMAIN),
                'param_name' => 'title_color',
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Font Style (title)', ST_TEXTDOMAIN),
                'param_name' => 'title_font_style',
                'std' => 'normal',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'value' => array(
                    esc_html__('Normal' ,ST_TEXTDOMAIN) => 'normal',
                    esc_html__('Italic' ,ST_TEXTDOMAIN) => 'italic',
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Title Font', ST_TEXTDOMAIN),
                'param_name' => 'title_font',
                'value' => array(
                    esc_html__('Playfair Display', ST_TEXTDOMAIN) => 'playfair',
                    esc_html__('Lato', ST_TEXTDOMAIN) => 'st_lato',
                    esc_html__('AmaticSC', ST_TEXTDOMAIN) => 'st_amatic'
                )
            ),
            array(
                'type' => 'st_number',
                'heading' => esc_html__('Margin Bottom', ST_TEXTDOMAIN),
                'param_name' => 'm_bottom',
                'value' => 0,
                'min' => 0,
                'prefix' => 'px',
                'edit_field_class' => 'vc_column vc_col-sm-6'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            ),
        )
    ));
    vc_map(array(
        'name' => esc_html__('ST Video', ST_TEXTDOMAIN),
        'base' => 'st_video',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('Play video in page', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'description' => esc_html__('Select a style', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Style 1', ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Style 2 (No Caption)', ST_TEXTDOMAIN) => 'style-2'
                ),
                'std' => 'style-1'
            ),
            array(
                'type' => 'textarea_html',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'content',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Youtube ID',ST_TEXTDOMAIN),
                'param_name' => 'link',
                'description' => esc_html__('Enter a video id for element. Ex: gdXDJ9TIcZQ', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', ST_TEXTDOMAIN),
                'param_name' => 'background_image'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', ST_TEXTDOMAIN),
                'param_name' => 'title_color',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Label Color', ST_TEXTDOMAIN),
                'param_name' => 'label_color',
                'edit_field_class' => 'vc_column vc_col-sm-6',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Overlay', ST_TEXTDOMAIN),
                'param_name' => 'overlay',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Enable Label Text', ST_TEXTDOMAIN),
                'param_name' => 'enable_label',
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 'yes'
                ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Height Element (px)', ST_TEXTDOMAIN),
                'param_name' => 'height',
                'description' => esc_html__('Input height for element',ST_TEXTDOMAIN),
                'value' => '800'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            )
        )
    ));
    vc_map( array(
        'name'        => esc_html__( 'ST Weather', ST_TEXTDOMAIN ),
        'base'        => 'st_weather',
        'icon'        => 'icon-st',
        'category'    => 'Shinetheme',
        'description' => esc_html__( 'Icon and information', ST_TEXTDOMAIN ),
        'params'      => array(
            array(
                'param_name' => 'location_id',
                'heading'    => esc_html__( 'Location', ST_TEXTDOMAIN ),
                'type'       => 'st_dropdown',
                'stype'=>'post_type',
                'sparam'=>'location'

            ),
            array(
                'type'       => 'checkbox',
                'heading'    => esc_html__( 'Show time now', ST_TEXTDOMAIN ),
                'param_name' => 'show_time',
                'value'      => array(
                    esc_html__( 'Yes', ST_TEXTDOMAIN ) => 'yes'
                ),
                'std'        => ''
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra Class', ST_TEXTDOMAIN ),
                'param_name'  => 'extra_class',
                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN )
            )
        )
    ) );
}
