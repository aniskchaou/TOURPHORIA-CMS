<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 8:33 AM
 */
return array(
    'add' => array(
        'hotel' => array(
            'tabs' => apply_filters('st_partner_hotel_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'facility',
                        'label' => __('2. Facilities', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'policy',
                        'label' => __('5. Policy', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_hotel_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '6',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Property Star', ST_TEXTDOMAIN),
                                    'name' => 'hotel_star',
                                    'col' => '6',
                                    'plh' => '',
                                    'options' => array(
                                        '5' => '5',
                                        '4' => '4',
                                        '3' => '3',
                                        '2' => '2',
                                        '1' => '1',
                                    ),
                                    'required' => true
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Property Logo', ST_TEXTDOMAIN),
                                    'name' => 'id_logo',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('DETAIL CONTACT', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Select contact info will show', ST_TEXTDOMAIN),
                                    'name' => 'show_agent_contact_info',
                                    'col' => '4',
                                    'plh' => '',
                                    'options' => array(
                                        '-1' => __('Select', ST_TEXTDOMAIN),
                                        'user_agent_info' => __('Use Agent Contact Info', ST_TEXTDOMAIN),
                                        'user_item_info' => __('Use Item Info', ST_TEXTDOMAIN),
                                    ),
                                    'required' => false
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Email', ST_TEXTDOMAIN),
                                    'name' => 'email',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Website', ST_TEXTDOMAIN),
                                    'name' => 'website',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => false
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Phone', ST_TEXTDOMAIN),
                                    'name' => 'phone',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Fax', ST_TEXTDOMAIN),
                                    'name' => 'fax',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => false
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Video', ST_TEXTDOMAIN),
                                    'name' => 'video',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => false
                                )
                            )
                        ),

                       /* array(
                            'type' => 'group',
                            'label' => __('LAYOUT', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Hotel Detail Layout', ST_TEXTDOMAIN),
                                    'name' => 'st_custom_layout',
                                    'col' => '4',
                                    'plh' => '',
                                    'options' => st_convert_array_for_partner_field(st_get_layout('st_hotel')),
                                    'required' => false
                                ),
                            )
                        ),*/

                        array(
                            'type' => 'group',
                            'label' => __('BOOK SETTING', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Book before number of day', ST_TEXTDOMAIN),
                                    'name' => 'hotel_booking_period',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => true,
                                    'std' => '0'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Minimum stay', ST_TEXTDOMAIN),
                                    'name' => 'min_book_room',
                                    'col' => '4',
                                    'plh' => '',
                                    'required' => false,
                                    'std' => '0'
                                )
                            )
                        ),

                        array(
                            'type' => 'group',
                            'label' => __('PRICE SETTING', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Set auto calculation average price', ST_TEXTDOMAIN),
                                    'name' => 'is_auto_caculate',
                                    'col' => '4',
                                    'plh' => '',
                                    'options' => array(
                                        'on' => __('Yes', ST_TEXTDOMAIN),
                                        'off' => __('No', ST_TEXTDOMAIN)
                                    ),
                                    'required' => false
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Average price', ST_TEXTDOMAIN),
                                    'name' => 'price_avg',
                                    'col' => '4',
                                    'required' => false,
                                    //'operator' => 'or',
                                    'condition' => 'is_auto_caculate:is(off)'
                                )
                            )
                        ),
                    ),
                    'facility' => apply_filters('st_partner_hotel_facility', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'map',
                            'label' => '',
                            'name' => 'st_map',
                            'col' => '12',
                            'plh' => '',
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Properties near by', ST_TEXTDOMAIN),
                            'name' => 'properties_near_by',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'property-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[featured_image]'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'property-item[description]',
                                    'rows' => 5
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Icon Map', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lat', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lat]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lng', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lng]'
                                ),
                            )
                        )
                    ),
                    'policy' => array(
                        array(
                            'type' => 'list-item',
                            'label' => __('ADD A POLICY', ST_TEXTDOMAIN),
                            'name' => 'hotel_policy',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add A Policy', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'policy_title'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'policy_description',
                                    'rows' => 5
                                ),
                            )
                        )
                    )
                )
            ),
        ),
        'room' => array(
            'tabs' => apply_filters('st_partner_hotel_room_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'facility',
                        'label' => __('2. Facilities', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'prices',
                        'label' => __('3. Price', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_hotel_room_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '6',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Select the hotel own this room', ST_TEXTDOMAIN),
                                    'name' => 'room_parent',
                                    'col' => '6',
                                    'plh' => '',
                                    'required' => false,
                                    'options' => st_get_list_hotels('st_hotel'),
                                ),
                                /*array(
                                    'type' => 'select',
                                    'label' => __('Room Detail Layout', ST_TEXTDOMAIN),
                                    'name' => 'st_custom_layout',
                                    'col' => '4',
                                    'plh' => '',
                                    'options' => st_convert_array_for_partner_field(st_get_layout('hotel_room')),
                                    'required' => false
                                ),*/
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of this room', ST_TEXTDOMAIN),
                            'name' => 'number_room',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of Adults', ST_TEXTDOMAIN),
                            'name' => 'adult_number',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of Children', ST_TEXTDOMAIN),
                            'name' => 'children_number',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of Beds', ST_TEXTDOMAIN),
                            'name' => 'bed_number',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Room Footage (square feet)', ST_TEXTDOMAIN),
                            'name' => 'room_footage',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('External Booking', ST_TEXTDOMAIN),
                            'name' => 'st_room_external_booking',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('External booking URL', ST_TEXTDOMAIN),
                            'name' => 'st_room_external_booking_link',
                            'col' => '4',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'st_room_external_booking:is(on)'
                        ),
                    ),
                    'facility' => apply_filters('st_partner_hotel_room_facility', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'prices' => array(
                        array(
                            'type' => 'select',
                            'label' => __('Allow customer can booking full day', ST_TEXTDOMAIN),
                            'name' => 'allow_full_day',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'on' => __('On', ST_TEXTDOMAIN),
                                'off' => __('Off', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Pricing', ST_TEXTDOMAIN),
                            'name' => 'price',
                            'col' => '4',
                            'plh' => '',
                            'required' => true,
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by No.Days', ST_TEXTDOMAIN),
                            'name' => 'discount_by_day',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. days', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[number_day]',
                                    'plh' => __('Enter No. days will be discounted', ST_TEXTDOMAIN)
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[discount]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Discount type. This only use for discount by number of days.', ST_TEXTDOMAIN),
                            'name' => 'discount_type_no_day',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'percent' => __('Percent(%)', ST_TEXTDOMAIN),
                                'fixed' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Discount rating', ST_TEXTDOMAIN),
                            'name' => 'discount_rate',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Deposit options. ', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_status',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                '' => __('Disallow Deposit', ST_TEXTDOMAIN),
                                'percent' => __('Deposit by percent', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Deposit Payment Amount', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_amount',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'deposit_payment_status:is(percent)'
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Extra pricing', ST_TEXTDOMAIN),
                            'name' => 'extra_price',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'extra[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_name]',
                                    'std' => 'extra_'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Max Of Number', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_max_number]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_price]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Allow Cancel', ST_TEXTDOMAIN),
                            'name' => 'st_allow_cancel',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of days before the arrival', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_number_days',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'st_allow_cancel:is(on)',
                            'clear' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Percent of total price', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_percent',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'st_allow_cancel:is(on)'
                        ),
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                    ),
                )
            )
        ),
        'tour' => array(
            'tabs' => apply_filters('st_partner_tour_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'info',
                        'label' => __('2. Info', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'prices',
                        'label' => __('3. Price', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_tour_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Choose which contact info will be shown?', ST_TEXTDOMAIN),
                            'name' => 'show_agent_contact_info',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                '' => __('Select', ST_TEXTDOMAIN),
                                'user_agent_info' => __('Use agent contact Info', ST_TEXTDOMAIN),
                                'user_item_info' => __('Use item info', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Contact email addresses', ST_TEXTDOMAIN),
                            'name' => 'contact_email',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Website', ST_TEXTDOMAIN),
                            'name' => 'website',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Phone', ST_TEXTDOMAIN),
                            'name' => 'phone',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Fax', ST_TEXTDOMAIN),
                            'name' => 'fax',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Video', ST_TEXTDOMAIN),
                            'name' => 'video',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                    ),
                    'info' => apply_filters('st_partner_tour_info', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'prices' => array(
                        array(
                            'type' => 'select',
                            'label' => __('Show price by', ST_TEXTDOMAIN),
                            'name' => 'tour_price_by',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'person' => __('Price by person', ST_TEXTDOMAIN),
                                'fixed' => __('Price by fixed', ST_TEXTDOMAIN),
                                'fixed_depart' => __('Fixed departure', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Start date', ST_TEXTDOMAIN),
                            'name' => 'start_date_fixed',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'condition' => 'tour_price_by:is(fixed_depart)',
                            'required' => true
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('End date', ST_TEXTDOMAIN),
                            'name' => 'end_date_fixed',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'condition' => 'tour_price_by:is(fixed_depart)',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Adult price', ST_TEXTDOMAIN),
                            'name' => 'adult_price',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Child price', ST_TEXTDOMAIN),
                            'name' => 'child_price',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Infant price', ST_TEXTDOMAIN),
                            'name' => 'infant_price',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Base price', ST_TEXTDOMAIN),
                            'name' => 'base_price',
                            'col' => '4',
                            'plh' => '',
                            'condition' => 'tour_price_by:is(fixed)',
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Hide adult on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_adult_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'clear' => true,
                            'required' => false,
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Hide child on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_children_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Hide infant on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_infant_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'condition' => 'tour_price_by:is(person),tour_price_by:is(fixed_depart)',
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by Adults', ST_TEXTDOMAIN),
                            'name' => 'discount_by_adult',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'clear' => true,
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_title'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Adult (From)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_key',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Adult (To)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_key_to',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Percentage of discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_value',
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by children', ST_TEXTDOMAIN),
                            'name' => 'discount_by_child',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_title'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Children (From)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_key',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Children (To)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_key_to',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Percentage of discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_value',
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Type of discount by people', ST_TEXTDOMAIN),
                            'name' => 'discount_by_people_type',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'percent' => __('Percent', ST_TEXTDOMAIN),
                                'amount' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Extra', ST_TEXTDOMAIN),
                            'name' => 'extra_price',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true,
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'extra[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_name]',
                                    'std' => 'extra_'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Max of number', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_max_number]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_price]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Discount Rate', ST_TEXTDOMAIN),
                            'name' => 'discount',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Type of discount', ST_TEXTDOMAIN),
                            'name' => 'discount_type',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'percent' => __('Percent', ST_TEXTDOMAIN),
                                'amount' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Sale Schedule', ST_TEXTDOMAIN),
                            'name' => 'is_sale_schedule',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale start date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_from',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('is_sale_schedule:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale end date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_to',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('is_sale_schedule:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Deposit payment options', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_status',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                '' => __('Disallow Deposit', ST_TEXTDOMAIN),
                                'percent' => __('Deposit By Percent', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Deposit amount', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_amount',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('deposit_payment_status:is(percent)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Allow Cancel', ST_TEXTDOMAIN),
                            'name' => 'st_allow_cancel',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of days before the arrival', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_number_days',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('st_allow_cancel:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Percent of total price', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_percent',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('st_allow_cancel:is(on)'),
                            'required' => true,
                        ),
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'map',
                            'label' => '',
                            'name' => 'st_map',
                            'col' => '12',
                            'plh' => '',
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Properties near by', ST_TEXTDOMAIN),
                            'name' => 'properties_near_by',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'property-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[featured_image]'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'property-item[description]',
                                    'rows' => 5
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Icon Map', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lat', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lat]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lng', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lng]'
                                ),
                            )
                        )
                    ),
                )
            )
        ),
        'activity' => array(
            'tabs' => apply_filters('st_partner_activity_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'info',
                        'label' => __('2. Info', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'prices',
                        'label' => __('3. Price', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_activity_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Choose which contact info will be shown?', ST_TEXTDOMAIN),
                            'name' => 'show_agent_contact_info',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                '' => __('Select', ST_TEXTDOMAIN),
                                'user_agent_info' => __('Use agent contact Info', ST_TEXTDOMAIN),
                                'user_item_info' => __('Use item info', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Email', ST_TEXTDOMAIN),
                            'name' => 'contact_email',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Website', ST_TEXTDOMAIN),
                            'name' => 'contact_web',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Phone', ST_TEXTDOMAIN),
                            'name' => 'contact_phone',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Fax', ST_TEXTDOMAIN),
                            'name' => 'contact_fax',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Video', ST_TEXTDOMAIN),
                            'name' => 'video',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                    ),
                    'info' => apply_filters('st_partner_activity_info', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'prices' => array(
                        array(
                            'type' => 'text',
                            'label' => __('Adult price', ST_TEXTDOMAIN),
                            'name' => 'adult_price',
                            'col' => '4',
                            'plh' => '',
                            'required' => true,
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Child price', ST_TEXTDOMAIN),
                            'name' => 'child_price',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Infant price', ST_TEXTDOMAIN),
                            'name' => 'infant_price',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),

                        array(
                            'type' => 'select',
                            'label' => __('Hide adult on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_adult_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'clear' => true,
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Hide child on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_children_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Hide infant on booking form', ST_TEXTDOMAIN),
                            'name' => 'hide_infant_in_booking_form',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by Adults', ST_TEXTDOMAIN),
                            'name' => 'discount_by_adult',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'clear' => true,
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_title'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Adult (From)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_key',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Adult (To)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_key_to',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Percentage of discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_adult_value',
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by children', ST_TEXTDOMAIN),
                            'name' => 'discount_by_child',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_title'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Children (From)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_key',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No. Children (To)', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_key_to',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Percentage of discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_child_value',
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Type of discount by people', ST_TEXTDOMAIN),
                            'name' => 'discount_by_people_type',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'percent' => __('Percent', ST_TEXTDOMAIN),
                                'amount' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Extra', ST_TEXTDOMAIN),
                            'name' => 'extra_price',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true,
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'extra[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_name]',
                                    'std' => 'extra_'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Max of number', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_max_number]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_price]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Discount Rate', ST_TEXTDOMAIN),
                            'name' => 'discount',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Type of discount', ST_TEXTDOMAIN),
                            'name' => 'discount_type',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'percent' => __('Percent', ST_TEXTDOMAIN),
                                'amount' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Sale Schedule', ST_TEXTDOMAIN),
                            'name' => 'is_sale_schedule',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale start date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_from',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('is_sale_schedule:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale end date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_to',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('is_sale_schedule:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Deposit payment options', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_status',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                '' => __('Disallow Deposit', ST_TEXTDOMAIN),
                                'percent' => __('Deposit By Percent', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Deposit amount', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_amount',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('deposit_payment_status:is(percent)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Allow Cancel', ST_TEXTDOMAIN),
                            'name' => 'st_allow_cancel',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of days before the arrival', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_number_days',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('st_allow_cancel:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Percent of total price', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_percent',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('st_allow_cancel:is(on)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Best Price Guarantee', ST_TEXTDOMAIN),
                            'name' => 'best-price-guarantee',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('Off', ST_TEXTDOMAIN),
                                'on' => __('On', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Best Price Guarantee Text', ST_TEXTDOMAIN),
                            'name' => 'best-price-guarantee-text',
                            'col' => '4',
                            'plh' => '',
                            'condition' => __('best-price-guarantee:is(on)'),
                            'required' => true,
                        ),
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'map',
                            'label' => '',
                            'name' => 'st_map',
                            'col' => '12',
                            'plh' => '',
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Properties near by', ST_TEXTDOMAIN),
                            'name' => 'properties_near_by',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'property-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[featured_image]'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'property-item[description]',
                                    'rows' => 5
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Icon Map', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lat', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lat]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lng', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lng]'
                                ),
                            )
                        )
                    ),
                )
            )
        ),
        'car' => array(
            'tabs' => apply_filters('st_partner_car_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'info',
                        'label' => __('2. Info', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'prices',
                        'label' => __('3. Price', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_car_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Manufacture logo', ST_TEXTDOMAIN),
                            'name' => 'cars_logo',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'multi' => false,
                            'output' => 'url'
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Car Manufacturer Name', ST_TEXTDOMAIN),
                            'name' => 'cars_name',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true,
                            'required' => true
                        ),
                    ),
                    'info' => apply_filters('st_partner_car_info', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'prices' => array(
                        array(
                            'type' => 'select',
                            'label' => __('Car Types', ST_TEXTDOMAIN),
                            'name' => 'car_type',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'normal' => __('Normal', ST_TEXTDOMAIN),
                                'car_transfer' => __('Car Transfer', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Price Type', ST_TEXTDOMAIN),
                            'name' => 'price_type',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'condition' => 'car_type:is(car_transfer)',
                            'options' => array(
                                'distance' => __('By Distance', ST_TEXTDOMAIN),
                                'fixed' => __('By Fixed', ST_TEXTDOMAIN),
                                'passenger' => __('By Passenger', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Passengers', ST_TEXTDOMAIN),
                            'name' => 'num_passenger',
                            'col' => '4',
                            'plh' => '',
                            'condition' => 'car_type:is(car_transfer)',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Price', ST_TEXTDOMAIN),
                            'name' => 'cars_price',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'required' => true
                        ),

                        array(
                            'type' => 'list-item',
                            'label' => __('Journey', ST_TEXTDOMAIN),
                            'name' => 'journey',
                            'col' => '8',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'condition' => 'car_type:is(car_transfer)',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'journey_title'
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Transfer from', ST_TEXTDOMAIN),
                                    'name' => 'journey_transfer_from',
                                    'options' => st_convert_destination_car_transfer()
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Transfer to', ST_TEXTDOMAIN),
                                    'name' => 'journey_transfer_to',
                                    'options' => st_convert_destination_car_transfer()
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'journey_price',
                                ),
                                array(
                                    'type' => 'checkbox',
                                    'label' => __('Return', ST_TEXTDOMAIN),
                                    'name' => 'journey_return',
                                    'options' => array(
                                        'yes' => 'Return'
                                    )
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Custom Price', ST_TEXTDOMAIN),
                            'name' => 'is_custom_price',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'price_by_date' => __('Price by Date', ST_TEXTDOMAIN),
                                'price_by_number' => __('Price by number of day/hour', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Price by date', ST_TEXTDOMAIN),
                            'name' => 'price_by_date',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'condition' => 'is_custom_price:is(price_by_date)',
                            'fields' => array(
                                array(
                                    'type' => 'datepicker',
                                    'label' => __('Start date', ST_TEXTDOMAIN),
                                    'name' => 'st_start_date'
                                ),
                                array(
                                    'type' => 'datepicker',
                                    'label' => __('End date', ST_TEXTDOMAIN),
                                    'name' => 'st_end_date',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'st_price',
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Price by number', ST_TEXTDOMAIN),
                            'name' => 'price_by_number_of_day_hour',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'condition' => 'is_custom_price:is(price_by_number)',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'st_title'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Number start', ST_TEXTDOMAIN),
                                    'name' => 'st_number_start',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Number end', ST_TEXTDOMAIN),
                                    'name' => 'st_number_end',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'st_price_by_number',
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Extra', ST_TEXTDOMAIN),
                            'name' => 'extra_price',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'extra[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_name]',
                                    'std' => 'extra_'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Max of number', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_max_number]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_price]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Discount rate', ST_TEXTDOMAIN),
                            'name' => 'discount',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true,
                            'std' => '0',
                            'required' => false
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Create sale schedule', ST_TEXTDOMAIN),
                            'name' => 'is_sale_schedule',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale start date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_from',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'is_sale_schedule:is(on)',
                            'required' => true
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale end date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_to',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'is_sale_schedule:is(on)',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of cars for rent', ST_TEXTDOMAIN),
                            'name' => 'number_car',
                            'col' => '6',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Deposit payment options', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_status',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                '' => __('Disallow Deposit', ST_TEXTDOMAIN),
                                'percent' => __('Deposit By Percent', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Deposit amount', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_amount',
                            'col' => '6',
                            'plh' => '',
                            'condition' => __('deposit_payment_status:is(percent)'),
                            'required' => true,
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Allow Cancel', ST_TEXTDOMAIN),
                            'name' => 'st_allow_cancel',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of days before the arrival', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_number_days',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'st_allow_cancel:is(on)',
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Percent of total price', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_percent',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'st_allow_cancel:is(on)'
                        ),
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'cars_address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'map',
                            'label' => '',
                            'name' => 'st_map',
                            'col' => '12',
                            'plh' => '',
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Properties near by', ST_TEXTDOMAIN),
                            'name' => 'properties_near_by',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'property-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[featured_image]'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'property-item[description]',
                                    'rows' => 5
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Icon Map', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lat', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lat]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lng', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lng]'
                                ),
                            )
                        )
                    ),
                )
            )
        ),
        'rental' => array(
            'tabs' => apply_filters('st_partner_rental_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'info',
                        'label' => __('2. Info', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'prices',
                        'label' => __('3. Price', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'locations',
                        'label' => __('4. Locations', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_rental_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Numbers', ST_TEXTDOMAIN),
                            'name' => 'rental_number',
                            'col' => '4',
                            'plh' => '',
                            'clear' => true,
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Max of Adult', ST_TEXTDOMAIN),
                            'name' => 'rental_max_adult',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Max of Children', ST_TEXTDOMAIN),
                            'name' => 'rental_max_children',
                            'col' => '4',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Allow booking full day', ST_TEXTDOMAIN),
                            'name' => 'allow_full_day',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'on' => __('On', ST_TEXTDOMAIN),
                                'off' => __('Off', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Booking Period', ST_TEXTDOMAIN),
                            'name' => 'rentals_booking_period',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Minimum stay', ST_TEXTDOMAIN),
                            'name' => 'rentals_booking_min_day',
                            'col' => '4',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('External Booking', ST_TEXTDOMAIN),
                            'name' => 'st_rental_external_booking',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('External booking URL', ST_TEXTDOMAIN),
                            'name' => 'st_rental_external_booking_link',
                            'col' => '4',
                            'plh' => '',
                            'required' => true,
                            'condition' => 'st_rental_external_booking:is(on)'
                        ),
                    ),
                    'info' => apply_filters('st_partner_rental_info', array()),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'prices' => array(
                        array(
                            'type' => 'text',
                            'label' => __('Price', ST_TEXTDOMAIN),
                            'name' => 'price',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'required' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Discount Rate', ST_TEXTDOMAIN),
                            'name' => 'discount_rate',
                            'col' => '4',
                            'plh' => '',
                            'operator' => 'or',
                            'required' => false
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Create sale schedule', ST_TEXTDOMAIN),
                            'name' => 'is_sale_schedule',
                            'col' => '4',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale start date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_from',
                            'col' => '4',
                            'plh' => '',
                            'condition' => 'is_sale_schedule:is(on)',
                            'required' => true
                        ),
                        array(
                            'type' => 'datepicker',
                            'label' => __('Sale end date', ST_TEXTDOMAIN),
                            'name' => 'sale_price_to',
                            'col' => '4',
                            'plh' => '',
                            'condition' => 'is_sale_schedule:is(on)',
                            'required' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Deposit payment options', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_status',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                '' => __('Disallow Deposit', ST_TEXTDOMAIN),
                                'percent' => __('Deposit By Percent', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Deposit amount', ST_TEXTDOMAIN),
                            'name' => 'deposit_payment_amount',
                            'col' => '6',
                            'plh' => '',
                            'condition' => __('deposit_payment_status:is(percent)'),
                            'required' => false,
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Extra', ST_TEXTDOMAIN),
                            'name' => 'extra_price',
                            'col' => '6',
                            'plh' => '',
                            'clear' => true,
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'extra[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_name]',
                                    'std' => 'extra_'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Max of number', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_max_number]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Price', ST_TEXTDOMAIN),
                                    'name' => 'extra[extra_price]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Discount by number of days', ST_TEXTDOMAIN),
                            'name' => 'discount_by_day',
                            'col' => '6',
                            'plh' => '',
                            'text_add' => __('Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[title]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('No.days', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[number_day]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Discount', ST_TEXTDOMAIN),
                                    'name' => 'discount_by_day[discount]',
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Discount Type', ST_TEXTDOMAIN),
                            'name' => 'discount_type_no_day',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'percent' => __('Percent (%)', ST_TEXTDOMAIN),
                                'fixed' => __('Amount', ST_TEXTDOMAIN),
                            ),
                        ),

                        array(
                            'type' => 'select',
                            'label' => __('Allow Cancel', ST_TEXTDOMAIN),
                            'name' => 'st_allow_cancel',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'options' => array(
                                'off' => __('No', ST_TEXTDOMAIN),
                                'on' => __('Yes', ST_TEXTDOMAIN),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Number of days before the arrival', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_number_days',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'st_allow_cancel:is(on)',
                            'clear' => true
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Percent of total price', ST_TEXTDOMAIN),
                            'name' => 'st_cancel_percent',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'st_allow_cancel:is(on)'
                        )
                    ),
                    'locations' => array(
                        array(
                            'type' => 'multi_location',
                            'label' => __('Property Location', ST_TEXTDOMAIN),
                            'name' => 'multi_location',
                            'col' => '6',
                            'plh' => __('SELECT LOCATION', ST_TEXTDOMAIN),
                            'required' => true
                        ),
                        array(
                            'type' => 'address_autocomplete',
                            'label' => __('Real property address', ST_TEXTDOMAIN),
                            'name' => 'address',
                            'col' => '6',
                            'plh' => __('Address', ST_TEXTDOMAIN),
                            'required' => true,
                            'clear' => true
                        ),
                        array(
                            'type' => 'map',
                            'label' => '',
                            'name' => 'st_map',
                            'col' => '12',
                            'plh' => '',
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Properties near by', ST_TEXTDOMAIN),
                            'name' => 'properties_near_by',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'property-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[featured_image]'
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'property-item[description]',
                                    'rows' => 5
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Icon Map', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'property-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lat', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lat]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Lng', ST_TEXTDOMAIN),
                                    'name' => 'property-item[map_lng]'
                                ),
                            )
                        ),
                        array(
                            'type' => 'list-item',
                            'label' => __('Distance', ST_TEXTDOMAIN),
                            'name' => 'distance_closest',
                            'col' => '12',
                            'plh' => '',
                            'text_add' => __('+ Add New', ST_TEXTDOMAIN),
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Title', ST_TEXTDOMAIN),
                                    'name' => 'rdistance-item[title]'
                                ),
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured Image', ST_TEXTDOMAIN),
                                    'output' => 'url',
                                    'name' => 'rdistance-item[icon]'
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Name position', ST_TEXTDOMAIN),
                                    'name' => 'rdistance-item[name]',
                                ),
                                array(
                                    'type' => 'text',
                                    'label' => __('Distance', ST_TEXTDOMAIN),
                                    'name' => 'rdistance-item[distance]',
                                ),
                            )
                        )
                    ),
                )
            )
        ),
        'rental_room' => array(
            'tabs' => apply_filters('st_partner_rental_room_tabs',
                array(
                    array(
                        'name' => 'basic_info',
                        'label' => __('1. BASIC INFO', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'photos',
                        'label' => __('3. Photos', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'facility',
                        'label' => __('2. Facility', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_rental_room_content',
                array(
                    'basic_info' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PERSONAL INFORMATION', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'text',
                                    'label' => __('Property Name', ST_TEXTDOMAIN),
                                    'name' => 'st_title',
                                    'col' => '6',
                                    'plh' => '',
                                    'required' => true
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Select Rental', ST_TEXTDOMAIN),
                                    'name' => 'room_parent',
                                    'col' => '6',
                                    'plh' => '',
                                    'required' => true,
                                    'options' => st_get_list_hotels('st_rental'),
                                ),
                                array(
                                    'type' => 'editor',
                                    'label' => __('Description', ST_TEXTDOMAIN),
                                    'name' => 'st_content',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                ),
                                array(
                                    'type' => 'textarea',
                                    'label' => __('Short Intro', ST_TEXTDOMAIN),
                                    'name' => 'st_desc',
                                    'col' => '12',
                                    'clear' => true,
                                    'plh' => '',
                                    'required' => true,
                                    'rows' => 6
                                )
                            )
                        )
                    ),
                    'photos' => array(
                        array(
                            'type' => 'group',
                            'label' => __('PROPERTY IMAGE', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'upload',
                                    'label' => __('Featured image', ST_TEXTDOMAIN),
                                    'name' => 'id_featured_image',
                                    'col' => '12',
                                    'plh' => '',
                                    'required' => true,
                                    'multi' => false
                                ),
                            )
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Gallery', ST_TEXTDOMAIN),
                            'name' => 'id_gallery',
                            'col' => '12',
                            'plh' => '',
                            'required' => true,
                            'multi' => true
                        )
                    ),
                    'facility' => apply_filters('st_partner_rental_room_facility', array()),
                )
            )
        ),
        'flight' => array(
            'tabs' => apply_filters('st_partner_flight_tabs',
                array(
                    array(
                        'name' => 'general',
                        'label' => __('1. General', ST_TEXTDOMAIN)
                    ),
                    array(
                        'name' => 'tax_option',
                        'label' => __('2. Tax Options', ST_TEXTDOMAIN)
                    ),
                )
            ),
            'content' => apply_filters('st_partner_flight_content',
                array(
                    'general' => array(
                        array(
                            'type' => 'text',
                            'label' => __('Name of flight', ST_TEXTDOMAIN),
                            'name' => 'st_title',
                            'col' => '6',
                            'plh' => '',
                            'required' => true
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Airline Company', ST_TEXTDOMAIN),
                            'name' => 'airline',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'options' => st_get_list_taxonomy('st_airline'),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Origin', ST_TEXTDOMAIN),
                            'name' => 'origin',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'clear' => true,
                            'options' => st_get_list_taxonomy('st_airport'),
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Destination', ST_TEXTDOMAIN),
                            'name' => 'destination',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'options' => st_get_list_taxonomy('st_airport'),
                        ),
                        array(
                            'type' => 'timepicker',
                            'label' => __('Departure time', ST_TEXTDOMAIN),
                            'name' => 'departure_time',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'options' => st_get_list_taxonomy('st_airport'),
                        ),
                        array(
                            'type' => 'group',
                            'label' => __('Total time', ST_TEXTDOMAIN),
                            'col' => '12',
                            'fields' => array(
                                array(
                                    'type' => 'select',
                                    'label' => __('Hour(s)', ST_TEXTDOMAIN),
                                    'name' => 'total_time[hour]',
                                    'col' => '3',
                                    'plh' => '',
                                    'required' => true,
                                    'options' => st_get_list_flight_time('hour'),
                                ),
                                array(
                                    'type' => 'select',
                                    'label' => __('Minute(s)', ST_TEXTDOMAIN),
                                    'name' => 'total_time[minute]',
                                    'col' => '3',
                                    'plh' => '',
                                    'required' => true,
                                    'options' => st_get_list_flight_time('minute'),
                                ),
                            )
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Flight Type', ST_TEXTDOMAIN),
                            'name' => 'flight_type',
                            'col' => '6',
                            'plh' => '',
                            'required' => true,
                            'options' => array(
                                'direct' => __('Direct', ST_TEXTDOMAIN),
                                'one_stop' => __('One stop', ST_TEXTDOMAIN),
                                'two_stops' => __('Two stops', ST_TEXTDOMAIN),
                            )
                        ),
                    ),
                    'tax_option' => array(
                        array(
                            'type' => 'text',
                            'label' => __('Max Ticket', ST_TEXTDOMAIN),
                            'name' => 'max_ticket',
                            'col' => '6',
                            'plh' => '',
                            'required' => false
                        ),
                        array(
                            'type' => 'select',
                            'label' => __('Enable Tax', ST_TEXTDOMAIN),
                            'name' => 'enable_tax',
                            'col' => '6',
                            'plh' => '',
                            'required' => false,
                            'clear' => true,
                            'options' => array(
                                'no' => __('No', ST_TEXTDOMAIN),
                                'yes_not_included' => __('Yes, Not included', ST_TEXTDOMAIN),
                            )
                        ),
                        array(
                            'type' => 'text',
                            'label' => __('Tax Percent (%)', ST_TEXTDOMAIN),
                            'name' => 'vat_amount',
                            'col' => '6',
                            'plh' => '',
                            'condition' => 'enable_tax:is(yes_not_included)',
                            'required' => false
                        ),
                    ),
                )
            )
        )
    )
);
