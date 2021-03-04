<?php
add_action('vc_before_init', 'loadVCMapNewLayout');

function loadVCMapNewLayout()
{
    vc_map(array(
        'name' => esc_html__('ST Video', ST_TEXTDOMAIN),
        'base' => 'st_video_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'description' => esc_html__('Play video in page', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textarea',
                'admin_label' => true,
                'heading' => esc_html__('Title', ST_TEXTDOMAIN),
                'param_name' => 'label_video',
                'description' => esc_html__('Enter a text for title', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-1')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Youtube ID', ST_TEXTDOMAIN),
                'param_name' => 'link',
                'description' => esc_html__('Enter a video id for element. Ex: gdXDJ9TIcZQ', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', ST_TEXTDOMAIN),
                'param_name' => 'background_image'
            ),
        )
    ));

    vc_map([
        'name' => __('ST List of Related Services', ST_TEXTDOMAIN),
        'base' => 'st_list_of_related_services_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Service', ST_TEXTDOMAIN),
                'param_name' => 'service',
                'value' => [
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                ],
                'std' => 'st_hotel'
            ],
            [
                'type' => 'textfield',
                'param_name' => 'ids',
                'heading' => __('Service ID', ST_TEXTDOMAIN),
                'description' => __('Ids separated by commas. Example: 123,456', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'textfield',
                'param_name' => 'posts_per_page',
                'heading' => __('Number of Items', ST_TEXTDOMAIN),
                'description' => __('-1 for unlimited', ST_TEXTDOMAIN),
                'std' => 4
            ]
        ]
    ]);

    vc_map([
        "name" => __("ST FAQs", ST_TEXTDOMAIN),
        "base" => "st_faq_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_faq',
                'value' => '',
                'params' => array(
                    [
                        "type" => "textfield",
                        "heading" => __("Title", ST_TEXTDOMAIN),
                        "param_name" => "title",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Content", ST_TEXTDOMAIN),
                        "param_name" => "content",
                    ],
                ),
            ]
        )
    ]);

    vc_map([
        "name" => __("ST About Team", ST_TEXTDOMAIN),
        "base" => "st_about_us_team_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_team',
                'value' => '',
                'params' => array(
                    [
                        "type" => "attach_image",
                        "heading" => __("Photo", ST_TEXTDOMAIN),
                        "param_name" => "photo",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Name", ST_TEXTDOMAIN),
                        "param_name" => "name",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Position", ST_TEXTDOMAIN),
                        "param_name" => "position",
                        "description" => "",
                    ],
                    [
                        'type' => 'param_group',
                        'heading' => esc_html__('Social', ST_TEXTDOMAIN),
                        'param_name' => 'list_social',
                        'value' => '',
                        'params' => array(
                            [
                                "type" => "iconpicker",
                                "heading" => __("Icon", ST_TEXTDOMAIN),
                                "param_name" => "icon",
                                "description" => "",
                            ],
                            [
                                "type" => "vc_link",
                                "heading" => __("Link to", ST_TEXTDOMAIN),
                                "param_name" => "link",
                                "description" => "",
                            ],
                        ),
                    ]
                ),
            ]
        )
    ]);

    vc_map([
        "name" => __("ST About Us Gallery", ST_TEXTDOMAIN),
        "base" => "st_about_us_gallery_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            [
                "type" => "attach_images",
                "heading" => __("Gallery", ST_TEXTDOMAIN),
                "param_name" => "images",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ],
            [
                "type" => "vc_link",
                "heading" => __("Link to", ST_TEXTDOMAIN),
                "param_name" => "link",
                "description" => "",
            ],
        )
    ]);

    vc_map([
        "name" => __("ST About Us Information", ST_TEXTDOMAIN),
        "base" => "st_about_us_info_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            [
                "type" => "attach_image",
                "heading" => __("Image", ST_TEXTDOMAIN),
                "param_name" => "image",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Name", ST_TEXTDOMAIN),
                "param_name" => "name",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Position", ST_TEXTDOMAIN),
                "param_name" => "position",
                "description" => "",
            ],
            [
                "type" => "textarea",
                "heading" => __("More Information", ST_TEXTDOMAIN),
                "param_name" => "more_info",
                "description" => "",
            ],
        )
    ]);

    vc_map([
        "name" => __("ST About Us Statistic", ST_TEXTDOMAIN),
        "base" => "st_about_us_statistic",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_statistic',
                'value' => '',
                'params' => array(
                    [
                        "type" => "textfield",
                        "heading" => __("Main text", ST_TEXTDOMAIN),
                        "param_name" => "main_text",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Sub text", ST_TEXTDOMAIN),
                        "param_name" => "sub_text",
                        "description" => "",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Description", ST_TEXTDOMAIN),
                        "param_name" => "desc",
                        "description" => "",
                    ],
                ),
            )
        )
    ]);

    vc_map([
        "name" => __("ST Contact Info", ST_TEXTDOMAIN),
        "base" => "st_contact_info_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => [
            [
                "type" => "attach_image",
                "heading" => __("Background Image", ST_TEXTDOMAIN),
                "param_name" => "contact_bg",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Company Name", ST_TEXTDOMAIN),
                "param_name" => "company_name",
                "description" => "",
            ],
            [
                "type" => "textarea_html",
                "heading" => __("Company Info", ST_TEXTDOMAIN),
                "param_name" => "content",
                "description" => "",
            ],
        ]
    ]);

    vc_map([
        "name" => __("ST Contact Map", ST_TEXTDOMAIN),
        "base" => "st_contact_map_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => [
            [
                "type" => "textfield",
                "heading" => __("Lat", ST_TEXTDOMAIN),
                "param_name" => "lat",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Lng", ST_TEXTDOMAIN),
                "param_name" => "lng",
                "description" => "",
            ],
        ]
    ]);

    vc_map([
        'name' => __('ST Search Form', ST_TEXTDOMAIN),
        'base' => 'st_search_form_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'dropdown',
                'heading' => __('Search Form Type', ST_TEXTDOMAIN),
                'param_name' => 'form_type',
                'value' => [
                    __('Single service', ST_TEXTDOMAIN) => 'single',
                    __('Mix services', ST_TEXTDOMAIN) => 'mix',
                ],
                'std' => 'single'
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Service', ST_TEXTDOMAIN),
                'param_name' => 'service',
                'value' => [
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Rental', ST_TEXTDOMAIN) => 'st_rental',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                ],
                'std' => 'st_hotel',
                'dependency' => array(
                    'element' => 'form_type',
                    'value' => array('single')
                ),
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Search items', ST_TEXTDOMAIN),
                'param_name' => 'service_items',
                'value' => '',
                'dependency' => array(
                    'element' => 'form_type',
                    'value' => array('mix')
                ),
                'params' => apply_filters('st_mixed_search_form_group_fields', array(
                    [
                        "type" => "textfield",
                        "heading" => __("Tab title", ST_TEXTDOMAIN),
                        "param_name" => "tab_title",
                    ],
                    [
                        "type" => "dropdown",
                        "heading" => __("Service", ST_TEXTDOMAIN),
                        "param_name" => "tab_service",
                        'value' => apply_filters('st_mixed_search_form_tab', [
                            __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                            __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                            __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                        ]),
                    ],
                ))
            ],
            [
                'type' => 'textfield',
                'heading' => __('Heading', ST_TEXTDOMAIN),
                'param_name' => 'heading'
            ],
            [
                'type' => 'textfield',
                'heading' => __('Description', ST_TEXTDOMAIN),
                'param_name' => 'description'
            ],
            [
                "type" => "dropdown",
                "heading" => __("Heading align", ST_TEXTDOMAIN),
                "param_name" => "heading_align",
                'value' => [
                    __('Center', ST_TEXTDOMAIN) => 'center',
                    __('Left', ST_TEXTDOMAIN) => 'left',
                    __('Right', ST_TEXTDOMAIN) => 'right',
                ],
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => array(
                    __('Normal', ST_TEXTDOMAIN) => 'normal',
                    __('Slider', ST_TEXTDOMAIN) => 'slider',
                ),
                'std' => 'normal'
            ],
            [
                "type" => "attach_images",
                "heading" => __("Slider images", ST_TEXTDOMAIN),
                "param_name" => "images",
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('slider')
                ),
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Featured Item', ST_TEXTDOMAIN),
                'param_name' => 'feature_item',
                'value' => '',
                'dependency' => array(
                    'element' => 'service',
                    'value' => array('st_rental')
                ),
                'params' => array(
                    [
                        "type" => "textfield",
                        "heading" => __("Heading", ST_TEXTDOMAIN),
                        "param_name" => "heading",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Description", ST_TEXTDOMAIN),
                        "param_name" => "description",
                    ],
                ),
            ],
        ]
    ]);
    vc_map([
        'name' => __('ST Car Types', ST_TEXTDOMAIN),
        'base' => 'st_car_type_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
        ]
    ]);
    vc_map([
        'name' => __('ST Featured Item', ST_TEXTDOMAIN),
        'base' => 'st_featured_item_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'attach_image',
                'heading' => __('Icon', ST_TEXTDOMAIN),
                'param_name' => 'icon'
            ],
            [
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title'
            ],
            [
                'type' => 'textarea',
                'heading' => __('Description', ST_TEXTDOMAIN),
                'param_name' => 'desc'
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Styles', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => [
                    __('Icon in Top', ST_TEXTDOMAIN) => 'icon_top',
                    __('Icon in Left', ST_TEXTDOMAIN) => 'icon_left',
                ],
                'std' => 'icon_left'
            ]
        ]
    ]);

    vc_map([
        'name' => __('ST Offer Item', ST_TEXTDOMAIN),
        'base' => 'st_offer_item_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'attach_image',
                'heading' => __('Background', ST_TEXTDOMAIN),
                'param_name' => 'background'
            ],
            [
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title'
            ],
            [
                'type' => 'textfield',
                'heading' => __('Sub Title', ST_TEXTDOMAIN),
                'param_name' => 'sub_title'
            ],
            [
                'type' => 'vc_link',
                'heading' => __('Link', ST_TEXTDOMAIN),
                'param_name' => 'link'
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => [
                    __('With featured label', ST_TEXTDOMAIN) => 'featured',
                    __('With icon', ST_TEXTDOMAIN) => 'icon',
                ],
                'std' => 'icon'
            ],
            [
                'type' => 'textfield',
                'heading' => __('Featured text', ST_TEXTDOMAIN),
                'param_name' => 'featured_text',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('featured')
                )
            ],
            [
                "type" => "attach_image",
                "heading" => __("Icon", ST_TEXTDOMAIN),
                "param_name" => "icon",
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('icon')
                )
            ],
        ]
    ]);

    vc_map([
        'name' => __('ST List of Services', ST_TEXTDOMAIN),
        'base' => 'st_list_of_services_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'dropdown',
                'heading' => __('Service', ST_TEXTDOMAIN),
                'param_name' => 'service',
                'value' => [
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Rental', ST_TEXTDOMAIN) => 'st_rental',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                ],
                'std' => 'st_hotel'
            ],
            [
                'type' => 'textfield',
                'param_name' => 'ids',
                'heading' => __('Service ID', ST_TEXTDOMAIN),
                'description' => __('Ids separated by commas. Example: 123,456', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'textfield',
                'param_name' => 'posts_per_page',
                'heading' => __('Number of Items', ST_TEXTDOMAIN),
                'description' => __('-1 for unlimited', ST_TEXTDOMAIN),
                'std' => 8
            ]
        ]
    ]);

    vc_map([
        'name' => __('ST Rental Types', ST_TEXTDOMAIN),
        'base' => 'st_rental_amenities',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'textfield',
                'param_name' => 'posts_per_page',
                'heading' => __('Number of Items', ST_TEXTDOMAIN),
                'description' => __('0 for unlimited', ST_TEXTDOMAIN),
                'std' => 6
            ]
        ]
    ]);


    vc_map([
        'name' => __('ST List of Multi Services', ST_TEXTDOMAIN),
        'base' => 'st_list_of_multi_services_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                "type" => "textfield",
                "heading" => __("Heading", ST_TEXTDOMAIN),
                "param_name" => "heading",
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_services',
                'value' => '',
                'params' => array(
                    [
                        "type" => "textfield",
                        "heading" => __("Name of service", ST_TEXTDOMAIN),
                        "param_name" => "name",
                    ],
                    [
                        'type' => 'dropdown',
                        'heading' => __('Service', ST_TEXTDOMAIN),
                        'param_name' => 'service',
                        'value' => [
                            __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                            __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                            __('Activity', ST_TEXTDOMAIN) => 'st_activity'
                        ],
                        'std' => 'st_hotel'
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Service ID", ST_TEXTDOMAIN),
                        "param_name" => "ids",
                    ]
                ),
            ],
            [
                'type' => 'textfield',
                'param_name' => 'posts_per_page',
                'heading' => __('Number of Items', ST_TEXTDOMAIN),
                'description' => __('-1 for unlimited', ST_TEXTDOMAIN),
                'std' => 8
            ]
        ]
    ]);

    vc_map([
        'name' => __('ST List of Destinations', ST_TEXTDOMAIN),
        'base' => 'st_list_of_destinations_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [
            [
                'type' => 'checkbox',
                'heading' => __('Service', ST_TEXTDOMAIN),
                'param_name' => 'service',
                'value' => [
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Rental', ST_TEXTDOMAIN) => 'st_rental',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                ],
                'std' => 'st_hotel'
            ],
            [
                'type' => 'textfield',
                'param_name' => 'ids',
                'heading' => __('Destination ID', ST_TEXTDOMAIN),
                'description' => __('Ids separated by commas. Example: 123,456', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'textfield',
                'param_name' => 'posts_per_page',
                'heading' => __('Number of Items', ST_TEXTDOMAIN),
                'description' => __('-1 for unlimited', ST_TEXTDOMAIN),
                'std' => 8
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => [
                    __('Layout 1', ST_TEXTDOMAIN) => 'normal',
                    __('Layout 2 (Masonry)', ST_TEXTDOMAIN) => 'masonry',
                    __('Layout 3', ST_TEXTDOMAIN) => 'layout3',
                    __('Layout 4', ST_TEXTDOMAIN) => 'layout4',
                    __('Layout 5', ST_TEXTDOMAIN) => 'layout5',
                    __('Layout 6', ST_TEXTDOMAIN) => 'layout6',
                ],
                'std' => 'normal'
            ],
        ]
    ]);

    vc_map([
        'name' => __('ST Language & Currency', ST_TEXTDOMAIN),
        'base' => 'st_language_currency_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => [

        ]
    ]);

    vc_map([
        "name" => __("ST Testimonial", ST_TEXTDOMAIN),
        "base" => "st_testimonial_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Modern Layout",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_team',
                'value' => '',
                'params' => array(
                    [
                        "type" => "attach_image",
                        "heading" => __("Avatar", ST_TEXTDOMAIN),
                        "param_name" => "avatar",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Name", ST_TEXTDOMAIN),
                        "param_name" => "name",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Rating", ST_TEXTDOMAIN),
                        "param_name" => "rating",
                        "description" => "",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Content", ST_TEXTDOMAIN),
                        "param_name" => "content",
                        "description" => "",
                    ]
                ),
            ],
            [
                "type" => "dropdown",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => [
                    __('Default', ST_TEXTDOMAIN) => '',
                    __('Style 1', ST_TEXTDOMAIN) => 'style-1',
                    __('Style 2', ST_TEXTDOMAIN) => 'style-2',
                ],
                'std' => 'style-1'
            ],
        )
    ]);

    /*Ngothoai*/
    vc_map([
        'name' => __('ST Text And Button', ST_TEXTDOMAIN),
        'base' => 'st_text_and_button',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'textfield',
                'heading' => __('Title text', ST_TEXTDOMAIN),
                'param_name' => 'header_title',
                'value' => __('Title text', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'textarea',
                'heading' => __('Content', ST_TEXTDOMAIN),
                'param_name' => 'st_content_ht',
                'value' => ''
            ],
            [
                'type' => 'textfield',
                'heading' => __('Text button', ST_TEXTDOMAIN),
                'param_name' => 'text_button_ht',
                'value' => '',
            ],
            [
                'type' => 'textfield',
                'heading' => __('Url button', ST_TEXTDOMAIN),
                'param_name' => 'url_button_ht',
                'value' => '#',
            ],
            [
                "type" => "dropdown",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => [
                    __('Default', ST_TEXTDOMAIN) => '',
                    __('Style 1', ST_TEXTDOMAIN) => 'style-1',
                    __('Style 2', ST_TEXTDOMAIN) => 'style-2',
                ],
                'std' => 'style-1'
            ],
        )
    ]);
    vc_map([
        'name' => __('ST Title and content', ST_TEXTDOMAIN),
        'base' => 'st_title_line',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'textfield',
                'heading' => __('Title text', ST_TEXTDOMAIN),
                'param_name' => 'header_title',
                'value' => __('Title text', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'textarea_html',
                'heading' => __('Content', ST_TEXTDOMAIN),
                'param_name' => 'content',
                'value' => ''
            ],
            [
                "type" => "dropdown",
                "heading" => __("Layout default", ST_TEXTDOMAIN),
                "param_name" => "layout_title",
                "value" => [
                    __('Default', ST_TEXTDOMAIN) => 'st_default',
                    __('Center', ST_TEXTDOMAIN) => 'st_center',
                ],
                'std' => 'st_center'
            ],
            [
                "type" => "dropdown",
                "heading" => __("Style layout", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => [
                    __('Title and line', ST_TEXTDOMAIN) => 'style-1',
                    __('Line and title', ST_TEXTDOMAIN) => 'style-2',
                    __('No line', ST_TEXTDOMAIN) => 'style-3',
                    __('Title line style 2', ST_TEXTDOMAIN) => 'style-4',
                    __('With icon', ST_TEXTDOMAIN) => 'style-5',
                ],
                'std' => 'style-1'
            ],
        )
    ]);
    vc_map([
        'name' => __('ST Box Item Text', ST_TEXTDOMAIN),
        'base' => 'st_box_item_text',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Box title', ST_TEXTDOMAIN),
                'param_name' => 'box_title',
                'value' => __('', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textarea',
                'heading' => __('Box content', ST_TEXTDOMAIN),
                'param_name' => 'box_content',
                'value' => __('', ST_TEXTDOMAIN)
            ),
        )
    ]);
    vc_map([
        'name' => __('ST Box Item Icon', ST_TEXTDOMAIN),
        'base' => 'st_box_item_icon',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'textfield',
                'heading' => __('Box title', ST_TEXTDOMAIN),
                'param_name' => 'box_title',
                'value' => __('', ST_TEXTDOMAIN)
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Social', ST_TEXTDOMAIN),
                'param_name' => 'list_social',
                'value' => '',
                'params' => array(
                    [
                        "type" => "iconpicker",
                        "heading" => __("Icon", ST_TEXTDOMAIN),
                        "param_name" => "icon",
                        "description" => "",
                    ],
                    [
                        "type" => "vc_link",
                        "heading" => __("Link to", ST_TEXTDOMAIN),
                        "param_name" => "link",
                        "description" => "",
                    ],
                ),
            ]
        )
    ]);

    vc_map([
        'name' => esc_html__('[Hotel Single] ST List Room Hotel', ST_TEXTDOMAIN),
        'base' => 'hotel_activity_list_room',
        'description' => esc_html__('[Hotel Single] ST List Room Hotel', ST_TEXTDOMAIN),
        'icon' => 'icon-st',
        'category' => '[New] Hotel Single',
        'params' => array(
            [
                'type' => 'st_dropdown',
                'class' => '',
                'heading' => esc_html__('Select Hotel', ST_TEXTDOMAIN),
                'param_name' => 'service_id',
                'stype' => 'post_type',
                'sparam' => 'st_hotel',
                'sautocomplete' => 'yes',
                'description' => esc_html__('Enter List of Services', ST_TEXTDOMAIN),
            ],
            [
                'type' => 'textfield',
                'heading' => __('Number show', ST_TEXTDOMAIN),
                'param_name' => 'number_show_room',
                'value' => __('', ST_TEXTDOMAIN),
                'description' => esc_html__('Enter number show room, example -1 for show all', ST_TEXTDOMAIN),
            ],
            [
                'type' => 'radio_image',
                'admin_label' => true,
                'heading' => esc_html__('Style Options', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'std' => 'style-1',
                'value' => array(
                    'style-1' => array(
                        'title' => esc_html__('Style List', ST_TEXTDOMAIN),
                        'image' => function_exists('st_hotel_alone_load_assets_dir') ? st_hotel_alone_load_assets_dir() . '/images/st-reservation-content/style-1.jpg' : '',
                    ),
                )
            ],
        )
    ]);


    vc_map([
        'name' => __('ST Room Item', ST_TEXTDOMAIN),
        'base' => 'st_room_item',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'st_dropdown',
                'class' => '',
                'heading' => esc_html__('Select Room', ST_TEXTDOMAIN),
                'param_name' => 'room_id',
                'stype' => 'post_type',
                'sparam' => 'hotel_room',
                'sautocomplete' => 'yes',
                'description' => esc_html__('Select Room of Services', ST_TEXTDOMAIN),
            ],
        )
    ]);

    vc_map([
        'name' => __('ST Service New', ST_TEXTDOMAIN),
        'base' => 'st_service_icon_slider',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => [
                    __('Style 1', ST_TEXTDOMAIN) => 'style-1',
                    __('Style 2', ST_TEXTDOMAIN) => 'style-2',
                ],
                'std' => 'style-1'
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Social', ST_TEXTDOMAIN),
                'param_name' => 'list_service',
                'value' => '',
                'params' => array(
                    [
                        "type" => "attach_image",
                        "heading" => __("Icon Image", ST_TEXTDOMAIN),
                        "param_name" => "icon",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Name service", ST_TEXTDOMAIN),
                        "param_name" => "name_service",
                        "description" => "",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Content service", ST_TEXTDOMAIN),
                        "param_name" => "content_service",
                        "description" => "",
                    ],
                    [
                        "type" => "vc_link",
                        "heading" => __("Link to", ST_TEXTDOMAIN),
                        "param_name" => "link",
                        "description" => "",
                    ],
                ),
            ]
        )
    ]);

    vc_map([
        'name' => __('ST Instagram', ST_TEXTDOMAIN),
        'base' => 'st_instagram',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                "type" => "textfield",
                "heading" => __("Token Key access token", ST_TEXTDOMAIN),
                "param_name" => "token_api",
                "description" => "Enter code token Instagram: link : https://instagram.pixelunion.net/",
            ],
            [
                "type" => "textfield",
                "heading" => __("UserID Instagram", ST_TEXTDOMAIN),
                "param_name" => "user_id",
                "description" => "Enter user id Instagram",
            ],
        )
    ]);
    vc_map([
        'name' => __('ST Icon image - text', ST_TEXTDOMAIN),
        'base' => 'iconimg_text',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                "type" => "attach_image",
                "heading" => __("Image icon", ST_TEXTDOMAIN),
                "param_name" => "image_icon",
                "description" => "Upload image icon: 32px x 32px",
            ],
            [
                "type" => "textfield",
                "heading" => __("Text", ST_TEXTDOMAIN),
                "param_name" => "text_icon",
                "description" => "Enter text",
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => [
                    __('Style 1', ST_TEXTDOMAIN) => 'style-1',
                    __('Style 2', ST_TEXTDOMAIN) => 'style-2',
                ],
                'std' => 'style-1'
            ],
        )
    ]);
    vc_map([
        'name' => __('ST Filter Activity', ST_TEXTDOMAIN),
        'base' => 'st_filter_activity',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array()
    ]);
    vc_map([
        'name' => __('ST Slider Hotel', ST_TEXTDOMAIN),
        'base' => 'st_slider_activity',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'textfield',
                'param_name' => 'speed_slider',
                'heading' => __('Speed slider', ST_TEXTDOMAIN),
                'description' => __('Input time (number) in milliseconds.', ST_TEXTDOMAIN),
                'std' => 3000
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Add slider', ST_TEXTDOMAIN),
                'param_name' => 'list_slider',
                'value' => '',
                'params' => array(
                    [
                        "type" => "attach_image",
                        "heading" => __("Image", ST_TEXTDOMAIN),
                        "param_name" => "image",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Title", ST_TEXTDOMAIN),
                        "param_name" => "title_slider",
                        "description" => "",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Content slider", ST_TEXTDOMAIN),
                        "param_name" => "content_slider",
                        "description" => "",
                    ],
                    [
                        "type" => "vc_link",
                        "heading" => __("Link to", ST_TEXTDOMAIN),
                        "param_name" => "link",
                        "description" => "",
                    ],
                ),
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style_gallery',
                'value' => [
                    __('Style 1', ST_TEXTDOMAIN) => 'style1',
                    __('Style 2', ST_TEXTDOMAIN) => 'style2',
                ],
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Text animation', ST_TEXTDOMAIN),
                'param_name' => 'text_animation',
                'value' => [
                    __('Style 1', ST_TEXTDOMAIN) => 'text-normal',
                    __('Style 2', ST_TEXTDOMAIN) => 'text-hoz',
                    __('Style 3', ST_TEXTDOMAIN) => 'text-rotate',
                    __('Style 4', ST_TEXTDOMAIN) => 'text-up',
                ],
                'dependency' => array(
                    'element' => 'style_gallery',
                    'value' => array('style2')
                )
            ],
        )
    ]);


    vc_map([
        'name' => __('ST Gallery Hotel', ST_TEXTDOMAIN),
        'base' => 'st_gallery_hotel_single',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'dropdown',
                'heading' => __('Style', ST_TEXTDOMAIN),
                'param_name' => 'style_gallery',
                'value' => [
                    __('Grid', ST_TEXTDOMAIN) => 'grid-style',
                    __('Slider', ST_TEXTDOMAIN) => 'slider',
                    __('Masonry', ST_TEXTDOMAIN) => 'masonry',
                ],
            ],
            [
                'type' => 'dropdown',
                'heading' => __('Column', ST_TEXTDOMAIN),
                'param_name' => 'colums_gallery',
                'value' => [
                    __('Select', ST_TEXTDOMAIN) => '3-colum',
                    __('1 Column', ST_TEXTDOMAIN) => '1-colum',
                    __('2 Columns', ST_TEXTDOMAIN) => '2-colum',
                    __('3 Columns', ST_TEXTDOMAIN) => '3-colum',
                    __('4 Columns', ST_TEXTDOMAIN) => '4-colum',
                    __('5 Columns', ST_TEXTDOMAIN) => '5-colum',
                ],
            ],
            [
                "type" => "attach_images",
                "heading" => __("Images", ST_TEXTDOMAIN),
                "param_name" => "images_gallery",
                "description" => "Choose all image gallery",
            ],
        )
    ]);

    vc_map([
        "name" => __("Tab List menu", ST_TEXTDOMAIN),
        "base" => "st_hotel_tab",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                'type' => 'param_group',
                'heading' => esc_html__('Tab items', ST_TEXTDOMAIN),
                'param_name' => 'st_item_tab',
                'value' => '',
                'params' => array(
                    [
                        "type" => "textfield",
                        "heading" => __("Name tab", ST_TEXTDOMAIN),
                        "param_name" => "st_name_tab",
                        "description" => "",
                    ],
                    [
                        "type" => "param_group",
                        "heading" => __("Item content", ST_TEXTDOMAIN),
                        "param_name" => "st_item_content_tab",
                        'value' => '',
                        'params' => array(
                            [
                                "type" => "textfield",
                                "heading" => __("Title", ST_TEXTDOMAIN),
                                "param_name" => "st_title",
                                "description" => "",
                            ],
                            [
                                "type" => "attach_image",
                                "heading" => __("Image", ST_TEXTDOMAIN),
                                "param_name" => "st_image",
                                "description" => "",
                            ],
                            [
                                "type" => "textarea",
                                "heading" => __("Content", ST_TEXTDOMAIN),
                                "param_name" => "st_content",
                                "description" => "",
                            ],
                            [
                                "type" => "textfield",
                                "heading" => __("Price", ST_TEXTDOMAIN),
                                "param_name" => "st_price",
                                "description" => "",
                            ],
                        ),
                    ],
                ),
            ]
        )
    ]);


    vc_map([
        "name" => __("[Hotel Single]ST Testimonial", ST_TEXTDOMAIN),
        "base" => "st_testimonial_single",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ],
            [
                "type" => "attach_image",
                "heading" => __("Image icon", ST_TEXTDOMAIN),
                "param_name" => "icon_image",
                "description" => "",
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('List items', ST_TEXTDOMAIN),
                'param_name' => 'list_testimonial',
                'value' => '',
                'params' => array(
                    [
                        "type" => "attach_image",
                        "heading" => __("Avatar", ST_TEXTDOMAIN),
                        "param_name" => "avatar",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Name", ST_TEXTDOMAIN),
                        "param_name" => "name",
                        "description" => "",
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Work", ST_TEXTDOMAIN),
                        "param_name" => "job",
                        "description" => "",
                    ],
                    [
                        "type" => "textarea",
                        "heading" => __("Content", ST_TEXTDOMAIN),
                        "param_name" => "content",
                        "description" => "",
                    ]
                ),
            ]
        )
    ]);
    vc_map([
        "name" => __("[Hotel Single]Button scroll Down", ST_TEXTDOMAIN),
        "base" => "st_scroll_single",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "attach_image",
                "heading" => __("Image icon", ST_TEXTDOMAIN),
                "param_name" => "icon_scroll",
                "description" => "",
            ],

        )
    ]);
    vc_map([
        "name" => __("[Hotel Single]ST Map", ST_TEXTDOMAIN),
        "base" => "st_single_map",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Lat map", ST_TEXTDOMAIN),
                "param_name" => "latmap",
                "description" => "",
            ],
            [
                "type" => "textfield",
                "heading" => __("Long map", ST_TEXTDOMAIN),
                "param_name" => "longmap",
                "description" => "",
            ],
            [
                "type" => "attach_image",
                "heading" => __("Location icon", ST_TEXTDOMAIN),
                "param_name" => "icon_local",
                "description" => "",
            ],
        )
    ]);

    vc_map([
        'name' => __('ST Hotel Timeline', ST_TEXTDOMAIN),
        'base' => 'st_timeline',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "[New] Hotel Single",
        'params' => array(
            [
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'timeline_title',
                'value' => '',
            ],
            [
                "type" => "attach_image",
                "heading" => __("Image", ST_TEXTDOMAIN),
                "param_name" => "image_timeline",
                'value' => '',
                "description" => "Upload image Min width 500px and min height 500px",
            ],
            [
                'type' => 'textarea_html',
                'heading' => __('Content', ST_TEXTDOMAIN),
                'param_name' => 'content',
                'value' => ''
            ],
            [
                "type" => "dropdown",
                "heading" => __("Style layout", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => [
                    __('Left', ST_TEXTDOMAIN) => 'left',
                    __('Right', ST_TEXTDOMAIN) => 'right',
                    __('Center', ST_TEXTDOMAIN) => 'center',
                ],
                'std' => 'left'
            ],
        )
    ]);
    vc_map([
        "name" => __("[Singel Hotel] Slider single", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_slider",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "dropdown",
                "heading" => __("Choose colum", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => [
                    __('Default', ST_TEXTDOMAIN) => '',
                    __('1', ST_TEXTDOMAIN) => 'one',
                    __('2', ST_TEXTDOMAIN) => 'two',
                    __('3', ST_TEXTDOMAIN) => 'three',
                    __('4', ST_TEXTDOMAIN) => 'four',
                ],
                'default' => 'one'
            ],
            [
                "type" => "attach_images",
                "heading" => __("Choose all image slider", ST_TEXTDOMAIN),
                "param_name" => "st_images_slider",
                "description" => "",
            ],
        )
    ]);
    vc_map([
        "name" => __("[Singel Hotel] Team", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_team",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "attach_image",
                "heading" => __("Image", ST_TEXTDOMAIN),
                "param_name" => "st_images_team",
                "description" => "",
            ],
            [
                'type' => 'textfield',
                'heading' => __('Name', ST_TEXTDOMAIN),
                'param_name' => 'st_team_name',
                'value' => '',
            ],
            [
                'type' => 'textfield',
                'heading' => __('Work', ST_TEXTDOMAIN),
                'param_name' => 'st_team_work',
                'value' => '',
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Social', ST_TEXTDOMAIN),
                'param_name' => 'list_social',
                'value' => '',
                'params' => array(
                    [
                        "type" => "iconpicker",
                        "heading" => __("Icon", ST_TEXTDOMAIN),
                        "param_name" => "icon",
                        "description" => "",
                    ],
                    [
                        "type" => "vc_link",
                        "heading" => __("Link to", ST_TEXTDOMAIN),
                        "param_name" => "link",
                        "description" => "",
                    ],
                ),
            ]
        )
    ]);
    vc_map([
        "name" => __("[Singel Hotel] Popup Gallery Single", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_gallery",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "attach_images",
                "heading" => __("Choose all image gallery", ST_TEXTDOMAIN),
                "param_name" => "st_images_gallery",
                "description" => "",
            ],
        )
    ]);
    vc_map([
        "name" => __("[Singel Hotel] Popup Video Single", ST_TEXTDOMAIN),
        "base" => "st_video_popup",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Link video youtube", ST_TEXTDOMAIN),
                "param_name" => "st_video_pupop",
                "description" => "",
            ],
            [
                "type" => "attach_images",
                "heading" => __("Choose all image video", ST_TEXTDOMAIN),
                "param_name" => "st_images_video",
                "description" => "",
            ],
        )
    ]);
    vc_map([
        'name' => esc_html__('[Hotel Single] ST Blog Single', ST_TEXTDOMAIN),
        'base' => 'hotel_activity_blog',
        'icon' => 'icon-st',
        'category' => 'Hotel Single',
        'description' => esc_html__('List blog', ST_TEXTDOMAIN),
        'params' => array(
            [
                'type' => 'dropdown',
                'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Default', ST_TEXTDOMAIN) => '',
                    esc_html__('Tab', ST_TEXTDOMAIN) => 'style-1',
                ),
            ],
            [
                'type' => 'st_checkbox',
                'heading' => esc_html__('Select Categories', ST_TEXTDOMAIN),
                'param_name' => 'select_category',
                'desc' => esc_html__('Check the box to choose category', ST_TEXTDOMAIN),
                'stype' => 'tax',
                'sparam' => false
            ],
            [
                'type' => 'dropdown',
                'heading' => esc_html__('Order By', ST_TEXTDOMAIN),
                'param_name' => 'order_by',
                'value' => function_exists('hotel_alone_get_order_list') ? array_flip(hotel_alone_get_order_list()) : '',
                'std' => 'ID'
            ],
            [
                'type' => 'dropdown',
                'heading' => esc_html__('Order', ST_TEXTDOMAIN),
                'param_name' => 'order',
                'value' => array(
                    esc_html__('Descending', ST_TEXTDOMAIN) => 'DESC',
                    esc_html__('Ascending', ST_TEXTDOMAIN) => 'ASC',
                ),
                'std' => 'DESC'
            ],
            [
                "type" => "textfield",
                "heading" => __("Number item", ST_TEXTDOMAIN),
                "param_name" => "number_items",
                "description" => "",
            ],
        )
    ]);


    vc_map([
        "name" => __("[Singel Hotel] Table Membership", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_table",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "attach_image",
                "heading" => __("Icon", ST_TEXTDOMAIN),
                "param_name" => "st_images_icon",
                "description" => "",
            ],
            [
                'param_name'    => 'id_package',
                'type'          => 'dropdown',
                'value'         => st_get_packpage(), // here I'm stuck
                'heading'       => __('Choose package', ST_TEXTDOMAIN),
                'description'   => '',
                'holder'        => 'div',
            ],
            [
                'param_name'    => 'sale_member',
                'type'          => 'textfield',
                'value'         => '', // here I'm stuck
                'heading'       => __('Enter number sale', ST_TEXTDOMAIN),
                'description'   => '',
                'holder'        => 'div',
            ],
            [
                'type' => 'param_group',
                'heading' => esc_html__('Support', ST_TEXTDOMAIN),
                'param_name' => 'list_support',
                'value' => '',
                'params' => array(
                    [
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => __( "Support", ST_TEXTDOMAIN ),
                    "param_name" => "check",
                    "value" => __( "", ST_TEXTDOMAIN ),
                    "description" => __( "Enter description.", ST_TEXTDOMAIN )
                    ],
                    [
                        "type" => "textfield",
                        "heading" => __("Title item", ST_TEXTDOMAIN),
                        "param_name" => "title_items",
                        "description" => "",
                    ],
                ),
            ]
        )
    ]);

    vc_map([
        "name" => __("Checkout package", ST_TEXTDOMAIN),
        "base" => "st_checkout_package_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            
        )
    ]);
    vc_map([
        "name" => __("Success checkout Package", ST_TEXTDOMAIN),
        "base" => "st_success_checkout_package_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array()
    ]);
    /**
     * VC Map for Single Hotel
     */
    vc_map([
        "name" => __("[Singel Hotel] List of Rooms", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_list_of_room_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "dropdown",
                "heading" => __("Type of page", ST_TEXTDOMAIN),
                "param_name" => "type_of_page",
                "value" => array(
                    __('List of rooms page', ST_TEXTDOMAIN) => 'list_page',
                    __('Search result page', ST_TEXTDOMAIN) => 'search_page',
                ),
            ],


            [
                "type" => "dropdown",
                "heading" => __("Layout default", ST_TEXTDOMAIN),
                "param_name" => "layout",
                "value" => array(
                    __('List', ST_TEXTDOMAIN) => 'list',
                    __('Grid', ST_TEXTDOMAIN) => 'grid',
                ),
            ],
        )
    ]);

    vc_map([
        "name" => __("[Singel Hotel] Check Availability Form", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_check_availability_new",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "[New] Hotel Single",
        "params" => array(
            [
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
            ],
        )
    ]);

    vc_map(array(
        'name' => esc_html__('[ST] Half Slider', ST_TEXTDOMAIN),
        'base' => 'st_half_slider',
        'icon' => 'icon-st',
        'category' => 'Tour Modern',
        'params' => array(
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Heading', ST_TEXTDOMAIN),
                'param_name' => 'heading',
                'description' => esc_html__('Enter a text for heading', ST_TEXTDOMAIN),
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Description', ST_TEXTDOMAIN),
                'param_name' => 'description',
                'description' => esc_html__('Enter a text for description', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('URL', ST_TEXTDOMAIN),
                'param_name' => 'link'
            ),
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('Gallery', ST_TEXTDOMAIN),
                'param_name' => 'gallery'
            ),
        )
    ));
}