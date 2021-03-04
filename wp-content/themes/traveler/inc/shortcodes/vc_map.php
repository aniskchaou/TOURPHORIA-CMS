<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/30/2018
 * Time: 2:01 PM
 */
add_action( 'vc_before_init', 'st_map_general_shortcodes' );
add_action( 'vc_before_init', 'st_map_tour_shortcodes' );
//add_action( 'vc_before_init', 'st_map_rental_shortcodes' );
add_action( 'vc_before_init', 'st_map_rental_room_shortcodes' );
add_action( 'vc_before_init', 'st_map_hotel_shortcodes' );
add_action( 'vc_before_init', 'st_map_car_shortcodes' );
add_action( 'vc_before_init', 'st_map_activity_shortcodes' );
add_action( 'vc_before_init', 'st_map_single_hotel' );



function st_map_activity_shortcodes()
{
    if(!st_check_service_available( 'st_activity' )) return;

    vc_map(
        array(
            'name' => __("ST Activity Thumbnail", ST_TEXTDOMAIN),
            'base' => 'st_thumbnail_activity',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Booking Form", ST_TEXTDOMAIN),
            'base' => 'st_form_book',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Excerpt", ST_TEXTDOMAIN),
            'base' => 'st_excerpt_activity',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Content", ST_TEXTDOMAIN),
            'base' => 'st_activity_content',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Detailed Activity Map", ST_TEXTDOMAIN),
            'base' => 'st_activity_detail_map',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => true,
            'params'=>array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "range" ,
                    "description" => "Km" ,
                    "value"       => "20" ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "number" ,
                    "description" => "" ,
                    "value"       => "12" ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Show Circle" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "show_circle" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "No" , ST_TEXTDOMAIN )  => "no" ,
                        __( "Yes" , ST_TEXTDOMAIN ) => "yes"
                    ) ,
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Review Summary", ST_TEXTDOMAIN),
            'base' => 'st_activity_detail_review_summary',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Detailed Activity Review", ST_TEXTDOMAIN),
            'base' => 'st_activity_detail_review_detail',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Review", ST_TEXTDOMAIN),
            'base' => 'st_activity_review',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => true,
            'params'=>array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title" ,
                    "description" => "" ,
                    "value"       => "",
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "font_size" ,
                    "description" => "" ,
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ),
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Video", ST_TEXTDOMAIN),
            'base' => 'st_activity_video',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Activity Nearby", ST_TEXTDOMAIN),
            'base' => 'st_activity_nearby',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Activity',
            'show_settings_on_create' => true,
            'params'=>array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title" ,
                    "description" => "" ,
                    "value"       => "",
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "font_size" ,
                    "description" => "" ,
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ),
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Activity Show Discount' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_activity_show_discount' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Activity' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );


}

function st_map_car_shortcodes()
{
    if(!st_check_service_available( 'st_cars' )) return;
    vc_map(
        array(
            'name'                    => __( "ST Car Thumbnail" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_thumbnail_cars' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Car Excerpt" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_excerpt_cars' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'            => __( "ST Detailed Car Location" , ST_TEXTDOMAIN ) ,
            'base'            => 'st_detail_date_location_cars' ,
            'content_element' => true ,
            'icon'            => 'icon-st' ,
            'category'        => 'Car' ,
            'params'          => array(
                array(
                    'type'       => 'textfield' ,
                    'heading'    => __( 'Drop Off' , ST_TEXTDOMAIN ) ,
                    'param_name' => 'drop-off' ,
                    'value'      => ''
                ) ,
                array(
                    'type'       => 'textfield' ,
                    'heading'    => __( 'Pick Up' , ST_TEXTDOMAIN ) ,
                    'param_name' => 'pick-up' ,
                    'value'      => ''
                ) ,
                array(
                    'type'       => 'textfield' ,
                    'heading'    => __( 'Location ID Drop Off' , ST_TEXTDOMAIN ) ,
                    'param_name' => 'location_id_drop_off' ,
                    'value'      => ''
                ) ,
                array(
                    'type'       => 'textfield' ,
                    'heading'    => __( 'Location ID Pick Up' , ST_TEXTDOMAIN ) ,
                    'param_name' => 'location_id_pick_up' ,
                    'value'      => ''
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Car Video" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_video' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Car - Write Review Form" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Detailed Car Map" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_cars_detail_map' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "range" ,
                    "description" => "Km" ,
                    "value"       => "20" ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "number" ,
                    "description" => "" ,
                    "value"       => "12" ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Show Circle" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "show_circle" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "No" , ST_TEXTDOMAIN )  => "no" ,
                        __( "Yes" , ST_TEXTDOMAIN ) => "yes"
                    ) ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Detailed Car Review' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_detail_review_detail' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Car  detail review summary" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_detail_review_summary' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Car Show Discount' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_show_discount' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Car Show Distance' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_car_show_distance' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Car' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map( array(
        "name"            => __( "ST Sum of Car Transfer Search Results" , ST_TEXTDOMAIN ) ,
        "base"            => "st_search_car_transfer_title" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Transfer" ,
        "params"          => array(
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Search Modal" , ST_TEXTDOMAIN ) ,
                "param_name"  => "search_modal" ,
                "description" => "" ,
                "value"       => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Yes' , ST_TEXTDOMAIN )        => '1' ,
                    __( 'No' , ST_TEXTDOMAIN )         => '0' ,
                ) ,
            )
        )
    ) );


}
function st_map_general_shortcodes()
{
    vc_map(
        array(
            'name'                    => __( "ST Post Data" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_post_data' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Shinetheme' ,
            'show_settings_on_create' => true ,
            "params"                  => array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title" ,
                    "description" => "" ,
                    "value"       => "",
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "font_size" ,
                    "description" => "" ,
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ),
                    'edit_field_class'=>'vc_col-sm-6',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Data Type" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "field" ,
                    "description" => "" ,
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "Title" , ST_TEXTDOMAIN )   => 'title' ,
                        __( "Content" , ST_TEXTDOMAIN ) => 'content' ,
                        __( "Excerpt" , ST_TEXTDOMAIN ) => 'excerpt' ,
                        __( "Thumbnail" , ST_TEXTDOMAIN ) => 'thumbnail' ,
                    )
                ) ,

                array(
                    'type'        => 'dropdown',
                    'holder'      => "div" ,
                    'heading'     => __("Thumbnail size " , ST_TEXTDOMAIN),
                    'param_name'  => "thumb_size",
                    'description' => "",
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "Thumbnail" , ST_TEXTDOMAIN ) => 'thumbnail' ,
                        __( "Medium" , ST_TEXTDOMAIN ) => 'medium' ,
                        __( "Large" , ST_TEXTDOMAIN ) => 'large' ,
                        __( "Full" , ST_TEXTDOMAIN ) => 'full' ,
                    ),
                    'dependency'    => array(
                        'element'   => "field",
                        'value'     => 'thumbnail'
                    )
                ),

            ) ,
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Partner Info" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_partner_info' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => __('Shinetheme', ST_TEXTDOMAIN) ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Partner Average Rating" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_partner_average_rating' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => __('Shinetheme', ST_TEXTDOMAIN) ,
            'params'=>array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Partner Contact Form" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_partner_contact_form' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => __('Shinetheme', ST_TEXTDOMAIN) ,
            'params'=>array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Partner List Services" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_partner_list_service' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => __('Shinetheme', ST_TEXTDOMAIN) ,
            'params'=>array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Post per page of service" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "post_per_page_service" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Post per page of review" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "post_per_page_review" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
            )
        )
    );

    $list_tabs = array(
        esc_html__('All') => 'all',
        esc_html__('Avatar') => 'avatar',
        esc_html__('Email') => 'email',
        esc_html__('Phone') => 'phone',
        esc_html__('Email PayPal') => 'email_paypal',
        esc_html__('Home Airport') => 'home_airport',
        esc_html__('Address') => 'address'
    );
    vc_map(
        array(
            'name'                    => __( "ST Partner Info (Single Post)" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_partner_info_in_post' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => __('Shinetheme', ST_TEXTDOMAIN) ,
            'params'=>array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ),
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Avatar type" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "avatar_type" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "Square" , ST_TEXTDOMAIN ) => 'square' ,
                        __( "Circle" , ST_TEXTDOMAIN ) => 'circle' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Layout" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "format_column" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "1 Column" , ST_TEXTDOMAIN ) => '1' ,
                        __( "2 Column" , ST_TEXTDOMAIN ) => '2' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    'type' => 'checkbox',
                    'admin_label' => true,
                    'heading' => __('Select Information Display', ST_TEXTDOMAIN),
                    'param_name' => 'display_info',
                    'description' => __('Please choose information to display in page', ST_TEXTDOMAIN),
                    'value' => $list_tabs,
                    'std' => 'all'
                )
            )
        )
    );
    vc_map(array(
        "name" => __("Custom menu", ST_TEXTDOMAIN),
        "base" => "st_custom_menu",
        "content_element" => true,
        "icon" => "icon-st",
        "category" => "Content",
        'show_settings_on_create' => true,
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ),
            array(
                "type" => "st_dropdown",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "menu",
                'stype' => 'list_terms',
                'sparam' => 'nav_menu',
            ),
        )
    ));
    vc_map(array(
        'name' => __('ST Cancellation Data', ST_TEXTDOMAIN),
        'base' => 'st_cancellation',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Rental',
        'show_settings_on_create' => true,
        'params' => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
                "value" => "",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Font Size", ST_TEXTDOMAIN),
                "param_name" => "font_size",
                "description" => "",
                "value" => array(
                    __('--Select--', ST_TEXTDOMAIN) => '',
                    __("H1", ST_TEXTDOMAIN) => '1',
                    __("H2", ST_TEXTDOMAIN) => '2',
                    __("H3", ST_TEXTDOMAIN) => '3',
                    __("H4", ST_TEXTDOMAIN) => '4',
                    __("H5", ST_TEXTDOMAIN) => '5',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    vc_map(array(
        'name' => esc_html__('[Ajax] ST Flight Search Result', ST_TEXTDOMAIN),
        'base' => 'st_flight_search_results_ajax',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class'
            )
        )
    ));
}

function st_map_hotel_shortcodes()
{
    if(!st_check_service_available( 'st_hotel' )) return;
    vc_map(array(
        'name'                    => __('ST Hotel Room Header',ST_TEXTDOMAIN),
        'base'                    => 'st_hotel_room_header',
        'content_element'         => true,
        'icon'                    => 'icon-st',
        'category'                => 'Hotel',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));
    vc_map(array(
        'name' => __('Hotel Room Facility', ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_facility',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => true,
        'params' => array(
            array(
                'type' => 'st_checkbox',
                'heading' => __('Choose taxonomies', ST_TEXTDOMAIN),
                'param_name' => 'choose_taxonomies',
                'description' => __('Will be shown in layout', ST_TEXTDOMAIN),
                'stype' => 'list_tax',
                'sparam' => 'hotel_room'
            )
        )
    ));
    vc_map(array(
        'name' => __('Hotel Room Description', ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_description',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => true,
        'title'	=>__('Description' , ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => __('Title in layout', ST_TEXTDOMAIN),
            )
        )
    ));

    vc_map(array(
        'name' => __('Hotel Room Amenities', ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_amenities',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => true,
        'title'	=>__('Amenities' , ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => __('Title in layout', ST_TEXTDOMAIN),
            )
        )
    ));

    vc_map(array(
        'name' => __('Hotel Room Space', ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_space',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => true,
        'title'	=>__('The Space' , ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', ST_TEXTDOMAIN),
                'param_name' => 'title',
                'description' => __('Title in layout', ST_TEXTDOMAIN),
            )
        )
    ));

    vc_map(array(
        'name' => __('Hotel Room Content', ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_content',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map( array(
        "name" => __("ST Hotel Room Gallery", ST_TEXTDOMAIN),
        "base" => "st_hotel_room_gallery",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>'Hotel',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "description" =>"",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Slide',ST_TEXTDOMAIN)=>'slide',
                    __('Grid',ST_TEXTDOMAIN)=>'grid',
                ),
            )
        )
    ) );
    vc_map(array(
        'name' => __('ST Hotel Room Sidebar',ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_sidebar',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show sidebar?', ST_TEXTDOMAIN),
                'param_name' => 'show_sidebar',
                'value' => array(
                    esc_html__( '---- Select ----', ST_TEXTDOMAIN ) => '',
                    esc_html__( 'Fixed on Top', ST_TEXTDOMAIN ) => 'fixed_top',
                    esc_html__( 'Scroll', ST_TEXTDOMAIN ) => 'scroll',
                ),
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map(array(
        'name' => __('ST Room Hotel Review',ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_review',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map(array(
        'name' => __('ST Room Hotel Calendar',ST_TEXTDOMAIN),
        'base' => 'st_hotel_room_calendar',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Hotel',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map(
        array(
            'name'                    => __( "ST Hotel Header" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_header' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Show Location ?", ST_TEXTDOMAIN),
                    "param_name" => "is_location",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'1',
                        __('No',ST_TEXTDOMAIN)=>'2',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Show contact", ST_TEXTDOMAIN),
                    "param_name" => "is_contact",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'1',
                        __('No',ST_TEXTDOMAIN)=>'2',
                    ),
                ),
            )
        )
    );

    vc_map(
        array(
            'name'            => __( "ST Hotel Star" , ST_TEXTDOMAIN ) ,
            'base'            => 'st_hotel_star' ,
            'content_element' => true ,
            'icon'            => 'icon-st' ,
            'category'        => 'Hotel' ,
            'params'          => array(
                array(
                    "type"        => "textfield" ,
                    "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title" ,
                    'admin_label' => true ,
                    'std'         => 'Hotel Star'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Hotel Video' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_video' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'            => __( 'ST Hotel Price' , ST_TEXTDOMAIN ) ,
            'base'            => 'st_hotel_price' ,
            'icon'            => 'icon-st' ,
            'category'        => 'Hotel' ,
            "content_element" => true ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'            => __( 'ST Hotel Policy' , ST_TEXTDOMAIN ) ,
            'base'            => 'st_hotel_policy' ,
            'icon'            => 'icon-st' ,
            'category'        => 'Hotel' ,
            "content_element" => true ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'            => __( 'ST Hotel Logo' , ST_TEXTDOMAIN ) ,
            'base'            => 'st_hotel_logo' ,
            'content_element' => true ,
            'icon'            => 'icon-st' ,
            'category'        => 'Hotel' ,
            'params'          => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    'type'       => 'dropdown' ,
                    'heading'    => __( 'Thumbnail Size' , ST_TEXTDOMAIN ) ,
                    'param_name' => 'thumbnail_size' ,
                    'value'      => array(
                        'Full'      => 'full' ,
                        'Large'     => 'large' ,
                        'Medium'    => 'medium' ,
                        'Thumbnail' => 'thumbnail'
                    )
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Add Hotel Review' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_add_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Hotel Nearby' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_nearby' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__('Style 1', ST_TEXTDOMAIN) => 'style-1',
                        esc_html__('Style 2', ST_TEXTDOMAIN) => 'style-2'
                    ),
                    'std' => 'style-1'
                ),
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( "H1" , ST_TEXTDOMAIN )         => '1' ,
                        __( "H2" , ST_TEXTDOMAIN )         => '2' ,
                        __( "H3" , ST_TEXTDOMAIN )         => '3' ,
                        __( "H4" , ST_TEXTDOMAIN )         => '4' ,
                        __( "H5" , ST_TEXTDOMAIN )         => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Hotel Review' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( "H1" , ST_TEXTDOMAIN )         => '1' ,
                        __( "H2" , ST_TEXTDOMAIN )         => '2' ,
                        __( "H3" , ST_TEXTDOMAIN )         => '3' ,
                        __( "H4" , ST_TEXTDOMAIN )         => '4' ,
                        __( "H5" , ST_TEXTDOMAIN )         => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Detailed List of Hotel Rooms' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_detail_list_rooms' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'            => __( 'ST Detailed Hotel Card Accept' , ST_TEXTDOMAIN ) ,
            'base'            => 'st_hotel_detail_card_accept' ,
            'content_element' => true ,
            'icon'            => 'icon-st' ,
            'category'        => 'Hotel' ,
            "params"          => array(
                // add params same as with any other content element
                array(
                    "type"        => "textfield" ,
                    "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title" ,
                    "description" => "" ,
                ) ,
            )
        )
    );


    vc_map(
        array(
            'name'                    => __( 'ST Hotel Rooms Available' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_detail_search_room' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "admin_label"           => true ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "admin_label"           => true ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( "H1" , ST_TEXTDOMAIN )         => '1' ,
                        __( "H2" , ST_TEXTDOMAIN )         => '2' ,
                        __( "H3" , ST_TEXTDOMAIN )         => '3' ,
                        __( "H4" , ST_TEXTDOMAIN )         => '4' ,
                        __( "H5" , ST_TEXTDOMAIN )         => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "heading"          => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "style" ,
                    "description"      => "" ,
                    "value"            => array(
                        __( "Horizontal" , ST_TEXTDOMAIN )         => 'horizon' ,
                        __( "Vertical" , ST_TEXTDOMAIN )         => 'vertical' ,
                        __( "Vertical 2" , ST_TEXTDOMAIN )         => 'style_3' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Detailed Hotel Review' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_detail_review_detail' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Hotel Review Summary' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_detail_review_summary' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Detailed Hotel Map' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_detail_map' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "range" ,
                    "description" => "Km" ,
                    "value"       => "20" ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "number" ,
                    "description" => "" ,
                    "value"       => "12" ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Show Circle" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "show_circle" ,
                    "description" => "" ,
                    "value"       => array(
                        __("No",ST_TEXTDOMAIN)=>"no",
                        __("Yes",ST_TEXTDOMAIN)=>"yes"
                    ) ,
                ) ,
            )
        )
    );

    vc_map(array(
        'name' => esc_html__('ST Hotel Map And Gallery',ST_TEXTDOMAIN),
        'base' => 'st_hotel_map_gallery',
        'category' => '[ST] Single Hotel',
        'icon' => 'icon-st',
        'description' => esc_html__('Display map and gallery in hotel single',ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Style',ST_TEXTDOMAIN),
                'param_name' => 'style',
                'description' => esc_html__('Select a style',ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Full Map', ST_TEXTDOMAIN) => 'full_map',
                    esc_html__('Half Map', ST_TEXTDOMAIN) => 'half_map'
                ),
                'std' => 'full_map',
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'heading' => esc_html__('Number Image',ST_TEXTDOMAIN),
                'param_name' => 'num_image',
                'description' => esc_html__('Max image for gallery',ST_TEXTDOMAIN),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Map Style', ST_TEXTDOMAIN),
                'param_name' => 'map_style',
                'description' => esc_html__('Select a style for map', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Normal', ST_TEXTDOMAIN) => 'style_normal',
                    esc_html__('Midnight', ST_TEXTDOMAIN) => 'style_midnight',
                    esc_html__('Icy Blue', ST_TEXTDOMAIN) => 'style_icy_blue',
                    esc_html__('Family Fest', ST_TEXTDOMAIN) => 'style_family_fest',
                    esc_html__('Open Dark', ST_TEXTDOMAIN) => 'style_open_dark',
                    esc_html__('Riverside', ST_TEXTDOMAIN) => 'style_riverside',
                    esc_html__('Ozan', ST_TEXTDOMAIN) => 'style_ozan'
                ),
                'std' => 'style_icy_blue'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', ST_TEXTDOMAIN)
            ),
        )
    ));

    vc_map( array(
        "name"            => esc_html__( "ST Hotel Title - Address" , ST_TEXTDOMAIN ) ,
        "base"            => "st_hotel_title_address" ,
        "icon"            => "icon-st" ,
        "category"        => '[ST] Single Hotel',
        'content_element'         => true ,
        'description' => esc_html__('Display title and address', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Content Align','oceaus'),
                'param_name' => 'align',
                'description' => esc_html__('Select align content','oceaus'),
                'value' => array(
                    esc_html__('Center','oceaus') => 'text-center',
                    esc_html__('Left','oceaus') => 'text-left'
                )
            ),
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );

    vc_map(array(
        'name' => esc_html__('ST Hotel Review Score List','oceaus'),
        'base' => 'st_hotel_review_score_list',
        'category' => '[ST] Single Hotel',
        'icon' => 'icon-st',
        'description' => esc_html__('Display list reviews score','oceaus'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'oceaus'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'oceaus')
            ),
        )
    ));

    vc_map( array(
        "name"            => esc_html__( "ST Hotel Tabs Content" , ST_TEXTDOMAIN ) ,
        "base"            => "st_hotel_tabs_content" ,
        "icon"            => "icon-st" ,
        "category"        => '[ST] Single Hotel',
        'content_element'         => true ,
        'description' => esc_html__('Display tabs content', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Display Tabs', ST_TEXTDOMAIN),
                'param_name' => 'display_tabs',
                'description' => esc_html__('Select tabs to show in single', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Overview', ST_TEXTDOMAIN) => 'overview',
                    esc_html__('Facilities', ST_TEXTDOMAIN) => 'facilities',
                    esc_html__('Policies & FAQ', ST_TEXTDOMAIN) => 'policies_fqa',
                    esc_html__('Reviews', ST_TEXTDOMAIN) => 'reviews',
                    esc_html__('Gallery', ST_TEXTDOMAIN) => 'gallery',
                    esc_html__('Check Availability', ST_TEXTDOMAIN) => 'check_availability',
                ),
                'std' => 'overview,facilities,policies_fqa,reviews,gallery,check_availability'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Tab Align','oceaus'),
                'param_name' => 'tab_align',
                'value' => array(
                    esc_html__('Center','oceaus') => '',
                    esc_html__('Left','oceaus') => 'text-left'
                ),
                'std' => ''
            ),
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );

    vc_map(array(
        'name' => esc_html__('ST Information','oceaus'),
        'base' => 'st_hotel_more_info',
        'category' => array('Shinetheme','[ST] Single Hotel'),
        'icon' => 'icon-st',
        'description' => esc_html__('More information for accommodation single','oceaus'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'admin_label' => true,
                'heading' => esc_html__('Style','oceaus'),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Normal','oceaus') => 'style-1',
                    esc_html__('More Icon','oceaus') => 'style-2'
                )
            ),
            array(
                "type" => "iconpicker",
                "heading" => esc_html__("Icon", 'oceaus'),
                "param_name" => "icon",
                "description" => esc_html__("Icon", 'oceaus'),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style-2')
                )
            ),
            array(
                'type' => 'textfield',
                'admin_label' => true,
                'param_name' => 'title',
                'heading' => esc_html__('Title','oceaus')
            ),
            array(
                'type' => 'textarea_html',
                'param_name' => 'content',
                'heading' => esc_html__('Content','oceaus')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'oceaus'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'oceaus')
            ),
        )
    ));

    vc_map(
        array(
            'name'                    => __( "ST Hotel Share" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_hotel_share' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Hotel' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                    'param_name' => 'extra_class'
                )
            )
        )
    );

    vc_map( array(
        "name"            => esc_html__( "ST Hotel Contact Info" , ST_TEXTDOMAIN ) ,
        "base"            => "st_hotel_contact_info" ,
        "icon"            => "icon-st" ,
        "category"        => '[ST] Single Hotel',
        'content_element'         => true ,
        'description' => esc_html__('Display Contact Info', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );
    

}
function st_map_tour_shortcodes()
{
    if(!st_check_service_available( 'st_tours' )) return;

    vc_map(
        array(
            'name'                    => __( "ST Tour Thumbnail" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_thumbnail_tours' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Excerpt" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_excerpt_tour' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Content" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_content' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Info" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_info_tours' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "value"       => array(
                        __( "--Select--" , ST_TEXTDOMAIN )  => "" ,
                        __( "Style 1" , ST_TEXTDOMAIN ) => "1",
                        __( "Style 2" , ST_TEXTDOMAIN ) => "2"
                    ) ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Title 1" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title1" ,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array( '2' )
                    ),
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Title 2" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "title2" ,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array( '2' )
                    ),
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array( '2' )
                    ),
                ) ,
            )

        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Detailed Tour Map" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_map' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "range" ,
                    "description" => "Km" ,
                    "value"       => "20" ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "number" ,
                    "description" => "" ,
                    "value"       => "12" ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Show Circle" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "show_circle" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "No" , ST_TEXTDOMAIN )  => "no" ,
                        __( "Yes" , ST_TEXTDOMAIN ) => "yes"
                    ) ,
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Review Summary" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_review_summary' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Detailed Tour Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_review_detail' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Program" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_program' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Share" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_share' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                    'param_name' => 'style',
                    'description' => esc_html__('Select a style', ST_TEXTDOMAIN),
                    'value' => array(
                        esc_html__('Style 1', ST_TEXTDOMAIN) => 'style-1',
                        esc_html__('Style 2', ST_TEXTDOMAIN) => 'style-2'
                    ),
                    'std' => 'style-1'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra Class', ST_TEXTDOMAIN),
                    'param_name' => 'extra_class'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Price" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_price' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Video" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_video' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( "ST Tour Nearby" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_nearby' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__('Style 1', ST_TEXTDOMAIN) => 'style-1',
                        esc_html__('Style 2', ST_TEXTDOMAIN) => 'style-2'
                    ),
                    'std' => 'style-1'
                ),
                array(
                    "type"             => "textfield" ,
                    'admin_label' => true,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style-1')
                    )
                ) ,
                array(
                    "type"             => "dropdown" ,
                    'admin_label' => true,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('style-1')
                    )
                ) ,
            )
        )
    );

    vc_map(
        array(
            'name'                    => __( 'ST Tour Show Discount' , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_show_discount' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map( array(
        "name"            => esc_html__( "ST Tour Gallery Map" , ST_TEXTDOMAIN ) ,
        "base"            => "st_tour_gallery_map" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => 'Tour',
        'description' => esc_html__('Display gallery image and map', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                'admin_label' => true,
                'param_name' => 'style',
                'description' => esc_html__('Select a style', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Default', ST_TEXTDOMAIN) => 'style-1',
                    esc_html__('Half Map', ST_TEXTDOMAIN) => 'half_map'
                ),
                'std' => 'default'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Map Style', ST_TEXTDOMAIN),
                'param_name' => 'map_style',
                'description' => esc_html__('Select a style for map', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Normal', ST_TEXTDOMAIN) => 'style_normal',
                    esc_html__('Midnight', ST_TEXTDOMAIN) => 'style_midnight',
                    esc_html__('Icy Blue', ST_TEXTDOMAIN) => 'style_icy_blue',
                    esc_html__('Family Fest', ST_TEXTDOMAIN) => 'style_family_fest',
                    esc_html__('Open Dark', ST_TEXTDOMAIN) => 'style_open_dark',
                    esc_html__('Riverside', ST_TEXTDOMAIN) => 'style_riverside',
                    esc_html__('Ozan', ST_TEXTDOMAIN) => 'style_ozan'
                ),
                'std' => 'style_icy_blue'
            )
        )
    ) );

    vc_map( array(
        "name"            => esc_html__( "ST Tour Title - Address" , ST_TEXTDOMAIN ) ,
        "base"            => "st_tour_title_address" ,
        "icon"            => "icon-st" ,
        "category"        => 'Tour',
        'content_element'         => true ,
        'description' => esc_html__('Display title and address', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );


    vc_map( array(
        "name"            => esc_html__( "ST Tour List Info" , ST_TEXTDOMAIN ) ,
        "base"            => "st_tour_list_info" ,
        "icon"            => "icon-st" ,
        "category"        => 'Tour',
        'content_element'         => true ,
        'description' => esc_html__('Display list tour info', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );

    vc_map( array(
        "name"            => esc_html__( "ST Tour Tabs Content" , ST_TEXTDOMAIN ) ,
        "base"            => "st_tour_tabs_content" ,
        "icon"            => "icon-st" ,
        "category"        => 'Tour',
        'content_element'         => true ,
        'description' => esc_html__('Display tabs content', ST_TEXTDOMAIN),
        "params"          => array(
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Display Tabs', ST_TEXTDOMAIN),
                'param_name' => 'display_tabs',
                'description' => esc_html__('Select tabs to show in single', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Overview', ST_TEXTDOMAIN) => 'overview',
                    esc_html__('Itinerary', ST_TEXTDOMAIN) => 'itinerary',
                    esc_html__('FAQ & Reviews', ST_TEXTDOMAIN) => 'review',
                    esc_html__('Gallery', ST_TEXTDOMAIN) => 'gallery',
                    esc_html__('Prices & Payment', ST_TEXTDOMAIN) => 'payment',
                    esc_html__('Request To Book', ST_TEXTDOMAIN) => 'request',
                ),
                'std' => 'overview,itinerary,review,gallery,payment,request'
            ),
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => esc_html__( "Extra Class" , ST_TEXTDOMAIN ) ,
                "param_name"  => "extra_class" ,
                "description" => ""
            ) ,
        )
    ) );
}

function st_map_rental_room_shortcodes()
{
    if(!st_check_service_available( 'st_rental' )) return;

    vc_map(
        array(
            'name'                    => __( "ST Detailed Rental Map" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_map' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => true,
            'params'=>array(
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "range" ,
                    "description" => "Km" ,
                    "value"       => "20" ,
                ) ,
                array(
                    "type"        => "textfield" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "number" ,
                    "description" => "" ,
                    "value"       => "12" ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Show Circle" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "show_circle" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "No" , ST_TEXTDOMAIN )  => "no" ,
                        __( "Yes" , ST_TEXTDOMAIN ) => "yes"
                    ) ,
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Review Summary" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_review_summary' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Detailed Rental Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_review_detail' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Nearby" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_nearby' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
                array(
                    "type"             => "textfield" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "title" ,
                    "description"      => "" ,
                    "value"            => "" ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
                array(
                    "type"             => "dropdown" ,
                    "holder"           => "div" ,
                    "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
                    "param_name"       => "font_size" ,
                    "description"      => "" ,
                    "value"            => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                        __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                        __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                        __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                        __( "H5" , ST_TEXTDOMAIN ) => '5' ,
                    ) ,
                    'edit_field_class' => 'vc_col-sm-6' ,
                ) ,
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Add Rental Rental Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_add_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Price" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_price' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Video" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_video' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Header" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_header' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Show Location ?", ST_TEXTDOMAIN),
                    "param_name" => "is_location",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'1',
                        __('No',ST_TEXTDOMAIN)=>'2',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Show contact", ST_TEXTDOMAIN),
                    "param_name" => "is_contact",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'1',
                        __('No',ST_TEXTDOMAIN)=>'2',
                    ),
                ),
            )
        )
    );
    vc_map(
        array(
            'name'                    => __( "ST Rental Book Form" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_rental_book_form' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Rental' ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );
    vc_map(array(
        'name' => __('ST Rental Calendar',ST_TEXTDOMAIN),
        'base' => 'st_rental_calendar',
        'content_element' => true,
        'icon' => 'icon-st',
        'category' => 'Rental',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));



    vc_map(array(
        'name'                    => __('ST Rental Room Header',ST_TEXTDOMAIN),
        'base'                    => 'st_rental_room_header',
        'content_element'         => true,
        'icon'                    => 'icon-st',
        'category'                => 'Rental',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map(array(
        'name'                    => __('ST Rental Room Content',ST_TEXTDOMAIN),
        'base'                    => 'st_rental_room_content',
        'content_element'         => true,
        'icon'                    => 'icon-st',
        'category'                => 'Rental',
        'show_settings_on_create' => false,
        'params'=>array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                'param_name' => 'description_field',
                'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
            )
        )
    ));

    vc_map( array(
        "name" => __("ST Rental Room Gallery", ST_TEXTDOMAIN),
        "base" => "st_rental_room_gallery",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>'Rental',
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "description" =>"",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Slide',ST_TEXTDOMAIN)=>'slide',
                    __('Grid',ST_TEXTDOMAIN)=>'grid',
                ),
            )
        )
    ) );

    vc_map(array(
        'name' => __('ST List Rental Room',ST_TEXTDOMAIN),
        'base' => 'st_list_rental_room',
        'content_element' => true,
        'show_settings_on_create' => true,
        'icon' => 'icon-st',
        'category' => 'Rental',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Header text', ST_TEXTDOMAIN),
                'param_name' => 'header_title',
                'value' => __('Rental Room List', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Posts per page',ST_TEXTDOMAIN),
                'param_name' => 'post_per_page',
                'value' => 12
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Order by', ST_TEXTDOMAIN),
                'param_name' => 'order_by',
                'value' => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('none',ST_TEXTDOMAIN) => 'none',
                    __('ID',ST_TEXTDOMAIN) => 'ID',
                    __('Name',ST_TEXTDOMAIN) => 'name',
                    __('Date',ST_TEXTDOMAIN) => 'date',
                    __('Random',ST_TEXTDOMAIN) => 'rand'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Order',ST_TEXTDOMAIN),
                'param_name' => 'order',
                'value' => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Ascending',ST_TEXTDOMAIN) => 'asc',
                    __('Descending',ST_TEXTDOMAIN) => 'desc'
                )
            ),
        ),

    ));

    vc_map(array(
        'name' => __('ST Related Rental Room',ST_TEXTDOMAIN),
        'base' => 'st_related_rental_room',
        'content_element' => true,
        'show_settings_on_create' => true,
        'icon' => 'icon-st',
        'category' => 'Rental',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Header text', ST_TEXTDOMAIN),
                'param_name' => 'header_title',
                'value' => __('Related Rental Room', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Number of room', ST_TEXTDOMAIN),
                'param_name' => 'number_of_room',
                'value' => 5
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Show Excerpt', ST_TEXTDOMAIN),
                'param_name' => 'show_excerpt',
                'value' => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Yes', ST_TEXTDOMAIN) => 'yes',
                    __('No', ST_TEXTDOMAIN) => 'no'
                ),
                'std' => 'no'
            )
        )
    ));

    vc_map(
        array(
            'name' => __("ST Rental Room Review", ST_TEXTDOMAIN),
            'base' => 'st_rental_room_review',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Rental',
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        )
    );

    vc_map(
        array(
            'name' => __("ST Rental Room Facility", ST_TEXTDOMAIN),
            'base' => 'st_rental_room_facility',
            'content_element' => true,
            'icon' => 'icon-st',
            'category' => 'Hotel',
            'show_settings_on_create' => true,
            'params' => array(
                array(
                    'type' => 'st_checkbox',
                    'heading' => __('Choose taxonomies', ST_TEXTDOMAIN),
                    'param_name' => 'choose_taxonomies',
                    'description' => __('Will be shown in layout', ST_TEXTDOMAIN),
                    'stype' => 'tax_rental',
                    'sparam' => false
                )
            )
        )
    );

}
function st_map_single_hotel(){
    // if(!st_check_service_available( 'st_hotel' )) return;
   
} 