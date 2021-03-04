<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/04/2018
 * Time: 14:46 CH
 */
add_action( 'vc_before_init', 'st_map_base_shortcodes');

function st_map_base_shortcodes()
{
    vc_map( array(
        "name" => __("ST About Icon", ST_TEXTDOMAIN),
        "base" => "st_about_icon",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'edit_field_class'=>'st_iconpicker vc_col-sm-12'
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("Icon color", ST_TEXTDOMAIN),
                "param_name" => "st_color_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3'
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("To Icon color", ST_TEXTDOMAIN),
                "param_name" => "st_to_color",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>'black'
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Position Icon", ST_TEXTDOMAIN),
                "param_name" => "st_pos_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Top',ST_TEXTDOMAIN)=>'top',
                    __('Left',ST_TEXTDOMAIN)=>'left',
                    __('Right',ST_TEXTDOMAIN)=>'right'
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Size Icon", ST_TEXTDOMAIN),
                "param_name" => "st_size_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Small',ST_TEXTDOMAIN)=>'box-icon-sm',
                    __('Medium',ST_TEXTDOMAIN)=>'box-icon-md',
                    __('Big',ST_TEXTDOMAIN)=>'box-icon-big'
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Text Align", ST_TEXTDOMAIN),
                "param_name" => "st_text_align",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Center',ST_TEXTDOMAIN)=>'text-center',
                    __('Left',ST_TEXTDOMAIN)=>'text-left',
                    __('Right',ST_TEXTDOMAIN)=>'text-right'
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Icon Box border", ST_TEXTDOMAIN),
                "param_name" => "st_border",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('No',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'box-icon-border',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Animation", ST_TEXTDOMAIN),
                "param_name" => "st_animation",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>'animate-icon-top-to-bottom'
            ),

            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Name", ST_TEXTDOMAIN),
                "param_name" => "st_name",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Link", ST_TEXTDOMAIN),
                "param_name" => "st_link",
                "description" =>"",
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Description", ST_TEXTDOMAIN),
                "param_name" => "st_description",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Accordion", ST_TEXTDOMAIN),
        "base" => "st_accordion",
        "as_parent" => array('only' => 'st_accordion_item'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Element style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Tour box style',ST_TEXTDOMAIN)=>'st_tour_ver',
                ),
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Accordion item", ST_TEXTDOMAIN),
        "base" => "st_accordion_item",
        "content_element" => true,
        "as_child" => array('only' => 'st_accordion'),
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Date time", ST_TEXTDOMAIN),
                "param_name" => "st_date",
                "description" =>"",
            ),
            array(
                "type" => "textarea_html",
                "heading" => __("Content", ST_TEXTDOMAIN),
                "param_name" => "content",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Alert", ST_TEXTDOMAIN),
        "base" => "st_alert",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Content Alert", ST_TEXTDOMAIN),
                "param_name" => "st_content",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12'
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Type Alert", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Success',ST_TEXTDOMAIN)=>'alert-success',
                    __('Info',ST_TEXTDOMAIN)=>'alert-info',
                    __('Warning',ST_TEXTDOMAIN)=>'alert-warning',
                    __('Danger',ST_TEXTDOMAIN)=>'alert-danger',
                )
            ),

        )
    ) );
    vc_map( array(
        "name" => __("ST All Post Type Search Results", ST_TEXTDOMAIN),
        "base" => "st_all_post_type_content_search",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>'Shinetheme',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number Items", ST_TEXTDOMAIN),
                "param_name" => "st_number",
                "description" =>"",
                "value" => 5,
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('List',ST_TEXTDOMAIN)=>'1',
                    __('Grid',ST_TEXTDOMAIN)=>'2',
                ),
            )
        )
    ) );
    vc_map( array(
        "name" => __("[Ajax] ST All Post Type Search Results", ST_TEXTDOMAIN),
        "base" => "st_all_post_type_content_search_ajax",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>'Shinetheme',
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number Items", ST_TEXTDOMAIN),
                "param_name" => "st_number",
                "description" =>"",
                "value" => 5,
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('List',ST_TEXTDOMAIN)=>'1',
                    __('Grid',ST_TEXTDOMAIN)=>'2',
                ),
            )
        )
    ) );
    vc_map( array(
        "name" => __("ST Search with background gallery", ST_TEXTDOMAIN),
        "base" => "st_bg_gallery",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "attach_images",
                "holder" => "div",
                "heading" => __("Images in", ST_TEXTDOMAIN),
                "param_name" => "st_images_in",
                "description" =>"",
            ),
            array(
                "type" => "attach_images",
                "holder" => "div",
                "heading" => __("Images not in", ST_TEXTDOMAIN),
                "param_name" => "st_images_not_in",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Effect Speed", ST_TEXTDOMAIN),
                "param_name" => "st_speed",
                "description" =>__('Example : 1200ms',ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>1200
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Columns", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" =>__('Example : 8',ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>8
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Rows", ST_TEXTDOMAIN),
                "param_name" => "st_row",
                "description" =>__('Example : 4',ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>4
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Opacity Background", ST_TEXTDOMAIN),
                "param_name" => "opacity",
                "description" =>__(" Enter value form 0 - 0.5 - 1 ",ST_TEXTDOMAIN),
                'value'=>'0.5'
            ),
            array(
                'type' => 'st_checkbox',
                'admin_label' => true,
                'heading' => __('Select Tabs Search', ST_TEXTDOMAIN),
                'param_name' => 'tabs_search',
                'description' => __('Please choose tab name to display in page', ST_TEXTDOMAIN),
                'stype' => 'get_option',
                'sparam' => 'search_tabs',
                'std' => 'all'
            )

        )
    ) );
    vc_map( array(
        "name" => __("ST Blog", ST_TEXTDOMAIN),
        "base" => "st_blog",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style",ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "value" => array(
                    __("Style one",ST_TEXTDOMAIN)=>"style1",
                    __("Style two",ST_TEXTDOMAIN)=>"style2",
                    __("Style three",ST_TEXTDOMAIN)=>"style3",
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number of Posts",ST_TEXTDOMAIN),
                "param_name" => "st_blog_number_post",
                "value" => '4',
                "description" => __("Post number",ST_TEXTDOMAIN)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Number post of row",ST_TEXTDOMAIN),
                "param_name" => "st_blog_style",
                "value" => '',
                "description" => __("Colums per row",ST_TEXTDOMAIN),
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Four',ST_TEXTDOMAIN)=>'4',
                    __('Three',ST_TEXTDOMAIN)=>'3',
                    __('Two',ST_TEXTDOMAIN)=>'2',
                ),
            ),
            array(
                "type" => "st_checkbox",
                "holder" => "div",
                "heading" => __("Category",ST_TEXTDOMAIN),
                "param_name" => "st_category",
                'stype' => 'list_tax_id',
                'sparam' => 'category',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Order",ST_TEXTDOMAIN),
                "param_name" => "st_blog_order",
                'value'=>array(
                    __('Asc',ST_TEXTDOMAIN)=>'asc',
                    __('Desc',ST_TEXTDOMAIN)=>'desc'
                ),
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Order By",ST_TEXTDOMAIN),
                "param_name" => "st_blog_orderby",
                "value" =>st_get_list_order_by(),
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("List IDs of posts", ST_TEXTDOMAIN),
                "param_name" => "st_ids",
                "description" =>__("Ids separated by commas",ST_TEXTDOMAIN),
                'value'=>"",
            ),
        )
    ) );
    vc_map(array(
        "name" => __("ST Breadcrumb", ST_TEXTDOMAIN),
        "base" => "st_breadcrumb",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
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
        "name" => __("ST Button", ST_TEXTDOMAIN),
        "base" => "st_button",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Text Button", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12'
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Link Buttons", ST_TEXTDOMAIN),
                "param_name" => "st_link",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Type Button", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Default',ST_TEXTDOMAIN)=>'btn-default',
                    __('Primary',ST_TEXTDOMAIN)=>'btn-primary',
                    __('Success',ST_TEXTDOMAIN)=>'btn-success',
                    __('Info',ST_TEXTDOMAIN)=>'btn-info',
                    __('Warning',ST_TEXTDOMAIN)=>'btn-warning',
                    __('Danger',ST_TEXTDOMAIN)=>'btn-danger',
                    __('Link',ST_TEXTDOMAIN)=>'btn-link',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Button size", ST_TEXTDOMAIN),
                "param_name" => "st_size",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Normal',ST_TEXTDOMAIN)=>'btn-normal',
                    __('Large',ST_TEXTDOMAIN)=>'btn-lg',
                    __('Small',ST_TEXTDOMAIN)=>'btn-sm',
                    __('Extra small',ST_TEXTDOMAIN)=>'btn-xs',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Ghost button", ST_TEXTDOMAIN),
                "param_name" => "st_ghost",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('No',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'btn-ghost',
                )
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Flickr", ST_TEXTDOMAIN),
        "base" => "st_flickr",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Number", ST_TEXTDOMAIN),
                "param_name" => "st_number",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("User", ST_TEXTDOMAIN),
                "param_name" => "st_user",
                "description" => ""
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Gallery", ST_TEXTDOMAIN),
        "base" => "st_gallery",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number of images", ST_TEXTDOMAIN),
                "param_name" => "st_number_image",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6 vc_col-md-6',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Number of Columns", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                'edit_field_class'=>'vc_col-sm-6 vc_col-md-6',
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Four',ST_TEXTDOMAIN)=>'4',
                    __('Three',ST_TEXTDOMAIN)=>'3',
                    __('Two',ST_TEXTDOMAIN)=>'2',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Animation effect", ST_TEXTDOMAIN),
                "param_name" => "st_effect",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6 vc_col-md-6',
                'value'=>array(
                    __('Default',ST_TEXTDOMAIN)=>'',
                    __('Zoom out',ST_TEXTDOMAIN)=>'mfp-zoom-out',
                    __('Zoom in',ST_TEXTDOMAIN)=>'mfp-zoom-in',
                    __('Fade',ST_TEXTDOMAIN)=>'mfp-fade',
                    __('Move horizontal',ST_TEXTDOMAIN)=>'mfp-move-horizontal',
                    __('Move from top',ST_TEXTDOMAIN)=>'mfp-move-from-top',
                    __('Newspaper',ST_TEXTDOMAIN)=>'mfp-newspaper',
                    __('3D unfold',ST_TEXTDOMAIN)=>'mfp-3d-unfold',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Show Image Title", ST_TEXTDOMAIN),
                "param_name" => "st_image_title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6 vc_col-md-6',
                'value'=>array(
                    __('--Select --',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'y',
                    __('No',ST_TEXTDOMAIN)=>'n',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon hover", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4 vc_col-md-4',
                'value'=>"fa-plus"
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Margin Item", ST_TEXTDOMAIN),
                "param_name" => "margin_item",
                'edit_field_class'=>'vc_col-sm-4 vc_col-md-4',
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Normal',ST_TEXTDOMAIN)=>'normal',
                    __('Full width',ST_TEXTDOMAIN)=>'full',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Image Size", ST_TEXTDOMAIN),
                "param_name" => "image_size",
                'edit_field_class'=>'vc_col-sm-4 vc_col-md-4',
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Thumbnail',ST_TEXTDOMAIN)=>'thumbnail',
                    __('Medium',ST_TEXTDOMAIN)=>'medium',
                    __('Large',ST_TEXTDOMAIN)=>'large',
                    __('Full',ST_TEXTDOMAIN)=>'full',
                ),
            ),
            array(
                "type" => "attach_images",
                "holder" => "div",
                "heading" => __("List Image", ST_TEXTDOMAIN),
                "param_name" => "st_images_in",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "attach_images",
                "holder" => "div",
                "heading" => __("Images not in", ST_TEXTDOMAIN),
                "param_name" => "st_images_not_in",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Gird", ST_TEXTDOMAIN),
        "base" => "st_gird",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("Color", ST_TEXTDOMAIN),
                "param_name" => "st_color",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>'#999'
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Size", ST_TEXTDOMAIN),
                "param_name" => "st_size",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('col-1',ST_TEXTDOMAIN)=>'col-md-1',
                    __('col-2',ST_TEXTDOMAIN)=>'col-md-2',
                    __('col-3',ST_TEXTDOMAIN)=>'col-md-3',
                    __('col-4',ST_TEXTDOMAIN)=>'col-md-4',
                    __('col-5',ST_TEXTDOMAIN)=>'col-md-5',
                    __('col-6',ST_TEXTDOMAIN)=>'col-md-6',
                    __('col-7',ST_TEXTDOMAIN)=>'col-md-7',
                    __('col-8',ST_TEXTDOMAIN)=>'col-md-8',
                    __('col-9',ST_TEXTDOMAIN)=>'col-md-9',
                    __('col-10',ST_TEXTDOMAIN)=>'col-md-10',
                    __('col-11',ST_TEXTDOMAIN)=>'col-md-11',
                    __('col-12',ST_TEXTDOMAIN)=>'col-md-12',
                )
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Icon", ST_TEXTDOMAIN),
        "base" => "st_icon",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Position Tooltip", ST_TEXTDOMAIN),
                "param_name" => "st_pos_tooltip",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('No',ST_TEXTDOMAIN)=>'none',
                    __('Top',ST_TEXTDOMAIN)=>'top',
                    __('Bottom',ST_TEXTDOMAIN)=>'bottom',
                    __('Left',ST_TEXTDOMAIN)=>'left',
                    __('Right',ST_TEXTDOMAIN)=>'right'
                )
            ),array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Tooltip", ST_TEXTDOMAIN),
                "param_name" => "st_tooltips",
                "description" =>__("Place your tooltip" , ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-6'
            ),

            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'edit_field_class'=>'st_iconpicker vc_col-sm-6'
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Text Content", ST_TEXTDOMAIN),
                "param_name" => "st_text_content",
                "description" =>__("Must be empty Icon to use this Param" .ST_TEXTDOMAIN),
                'edit_field_class'=>'st_iconpicker vc_col-sm-6'
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("Icon color", ST_TEXTDOMAIN),
                "param_name" => "st_color_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3'
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("To Icon color", ST_TEXTDOMAIN),
                "param_name" => "st_to_color",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>''
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Alignment", ST_TEXTDOMAIN),
                "param_name" => "st_aligment",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('No',ST_TEXTDOMAIN)=>'box-icon-none',
                    __('Left',ST_TEXTDOMAIN)=>'box-icon-left',
                    __('Right',ST_TEXTDOMAIN)=>'box-icon-right',
                    __('Center',ST_TEXTDOMAIN)=>'box-icon-center'
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Size Icon", ST_TEXTDOMAIN),
                "param_name" => "st_size_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Small',ST_TEXTDOMAIN)=>'box-icon-sm',
                    __('Medium',ST_TEXTDOMAIN)=>'box-icon-md',
                    __('Big',ST_TEXTDOMAIN)=>'box-icon-big',
                    __('Large',ST_TEXTDOMAIN)=>'box-icon-large',
                    __('Huge',ST_TEXTDOMAIN)=>'box-icon-huge',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Round Icon", ST_TEXTDOMAIN),
                "param_name" => "st_round",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('No',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'round',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Icon Box border", ST_TEXTDOMAIN),
                "param_name" => "st_border",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-3',
                'value'=>array(
                    __('No',ST_TEXTDOMAIN)=>'',
                    __('Normal',ST_TEXTDOMAIN)=>'box-icon-border',
                    __('Dashed',ST_TEXTDOMAIN)=>'box-icon-border-dashed',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Animation", ST_TEXTDOMAIN),
                "param_name" => "st_animation",
                "description" =>__("http://daneden.github.io/animate.css/",ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>''
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("CSS Display", ST_TEXTDOMAIN),
                "param_name" => "st_icon_display",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>array(
                    __('Block',ST_TEXTDOMAIN)=>'block',
                    __('Inline',ST_TEXTDOMAIN)=>'inline',
                    __('Inline-block',ST_TEXTDOMAIN)=>'inline-block',
                )
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Image Effect", ST_TEXTDOMAIN),
        "base" => "st_image_effect",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "heading" => __("image", ST_TEXTDOMAIN),
                "param_name" => "st_image",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Type Hover", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>array(
                    __('Simple Hover',ST_TEXTDOMAIN)=>'',
                    __('Icon',ST_TEXTDOMAIN)=>'icon',
                    __('Icon Group',ST_TEXTDOMAIN)=>'icon-group',
                    __('Title',ST_TEXTDOMAIN)=>'title',
                    __('Inner Full',ST_TEXTDOMAIN)=>'inner-full',
                    __('Inner Block',ST_TEXTDOMAIN)=>'inner-block',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Position Layout", ST_TEXTDOMAIN),
                "param_name" => "st_pos_layout",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("Top Left",ST_TEXTDOMAIN)     =>"-top-left",
                    __("Top Right",ST_TEXTDOMAIN)    =>"-top-right",
                    __("Bottom Left",ST_TEXTDOMAIN)  =>"-bottom-left",
                    __("Bottom Right",ST_TEXTDOMAIN) =>"-bottom-right",
                    __("Center",ST_TEXTDOMAIN)       =>"-center",
                    __("Center Top",ST_TEXTDOMAIN)   =>"-center-top",
                    __("Center Bottom",ST_TEXTDOMAIN)=>"-center-bottom",
                    __("Top",ST_TEXTDOMAIN)   =>"-top",
                    __("Bottom",ST_TEXTDOMAIN)=>"-bottom",
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Hover Hold", ST_TEXTDOMAIN),
                "param_name" => "st_hover_hold",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __("No",ST_TEXTDOMAIN)     =>"",
                    __("Yes",ST_TEXTDOMAIN)    =>"hover-hold",
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Url", ST_TEXTDOMAIN),
                "param_name" => "url",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Class Icon", ST_TEXTDOMAIN),
                "param_name" => "st_class_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Icon Group", ST_TEXTDOMAIN),
                "param_name" => "content",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>''
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Inbox Form", ST_TEXTDOMAIN),
        "base" => "st_inbox_form",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title Form", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12'
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Active Form", ST_TEXTDOMAIN),
                "param_name" => "active",
                'value'=>array(
                    esc_html__("No",ST_TEXTDOMAIN)=>'',
                    esc_html__("Yes",ST_TEXTDOMAIN)=>'active',
                ),
                'edit_field_class'=>'vc_col-sm-12'
            ),
        )
    ) );
    vc_map( array(
        "name"            => __( "ST Owner Listing" , ST_TEXTDOMAIN ) ,
        "base"            => "st_info_owner" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "heading"    => __( "Config show/hide avatar" , ST_TEXTDOMAIN ) ,
                "param_name" => "show_avatar" ,
                'value'      => array(
                    __( 'Show' , ST_TEXTDOMAIN ) => 'true' ,
                    __( 'Hide' , ST_TEXTDOMAIN )  => 'false' ,
                )
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "heading"    => __( "Config show/hide email, social icons" , ST_TEXTDOMAIN ) ,
                "param_name" => "show_social" ,
                'value'      => array(
                    __( 'Show' , ST_TEXTDOMAIN ) => 'true' ,
                    __( 'Hide' , ST_TEXTDOMAIN )  => 'false' ,
                )
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "heading"    => __( "Config show/hide: Member since" , ST_TEXTDOMAIN ) ,
                "param_name" => "show_member_since" ,
                'value'      => array(
                    __( 'Show' , ST_TEXTDOMAIN ) => 'true' ,
                    __( 'Hide' , ST_TEXTDOMAIN )  => 'false' ,
                )
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "heading"    => __( "Config show/hide: Short Description" , ST_TEXTDOMAIN ) ,
                "param_name" => "show_short_info" ,
                'value'      => array(
                    __( 'Show' , ST_TEXTDOMAIN ) => 'true' ,
                    __( 'Hide' , ST_TEXTDOMAIN )  => 'false' ,
                )
            ) ,
        )
    ) );
    vc_map( array(
        "name"            => __( "ST Last Minute Deal" , ST_TEXTDOMAIN ) ,
        "base"            => "st_last_minute_deal" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => array(
            array(
                "type"        => "st_dropdown" ,
                'admin_label' => true,
                "heading"     => __( "Post type" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_post_type" ,
                "description" => "" ,
                'stype' => 'list_post_type',
                'sparam' => false,
            ) ,
        )
    ) );
    vc_map( array(
        "name" => __("ST Lightbox", ST_TEXTDOMAIN),
        "base" => "st_lightbox",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Type Lightbox", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Image',ST_TEXTDOMAIN)=>'image',
                    __('Iframe',ST_TEXTDOMAIN)=>'iframe',
                    __('HTML',ST_TEXTDOMAIN)=>'html',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Animation effect", ST_TEXTDOMAIN),
                "param_name" => "st_effect",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('Default',ST_TEXTDOMAIN)=>'',
                    __('Zoom out',ST_TEXTDOMAIN)=>'mfp-zoom-out',
                    __('Zoom in',ST_TEXTDOMAIN)=>'mfp-zoom-in',
                    __('Fade',ST_TEXTDOMAIN)=>'mfp-fade',
                    __('Move horizontal',ST_TEXTDOMAIN)=>'mfp-move-horizontal',
                    __('Move from top',ST_TEXTDOMAIN)=>'mfp-move-from-top',
                    __('Newspaper',ST_TEXTDOMAIN)=>'mfp-newspaper',
                    __('3D unfold',ST_TEXTDOMAIN)=>'mfp-3d-unfold',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon hover", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>"fa-plus"
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "heading" => __("image", ST_TEXTDOMAIN),
                "param_name" => "st_image",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-2',
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Link Iframe", ST_TEXTDOMAIN),
                "param_name" => "st_link",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-10',
                'value'=>''
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>''
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Content html", ST_TEXTDOMAIN),
                "param_name" => "content",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>''
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST List of Location", ST_TEXTDOMAIN),
        "base" => "st_list_location",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("List IDs in Location", ST_TEXTDOMAIN),
                "param_name" => "st_ids",
                "description" =>__("Ids separated by commas",ST_TEXTDOMAIN),
                'value'=>"",
            ),
            array(
                "type" => "st_checkbox",
                "holder" => "div",
                "heading" => __("Location type", ST_TEXTDOMAIN),
                "param_name" => "st_location_type",
                "description" =>"",
                'stype' => 'list_location_terms',
                'sparam' => '',
            ),
            array(
                "type" => "st_dropdown",
                "holder" => "div",
                "heading" => __("Post type", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'stype' => 'list_post_type',
                'sparam' => false,
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Link To", ST_TEXTDOMAIN),
                "param_name" => "link_to",
                "description" =>__("Link To",ST_TEXTDOMAIN),
                'value'=>array(
                    __("Page Search",ST_TEXTDOMAIN)=>'page_search',
                    __("Single",ST_TEXTDOMAIN)=>'single'
                ),
                'edit_field_class'=>'vc_col-sm-6',
            ),

            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number Location", ST_TEXTDOMAIN),
                "param_name" => "st_number",
                "description" =>__("Number Location", ST_TEXTDOMAIN),
                'value'=>4,
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Show Only Featured Location", ST_TEXTDOMAIN),
                "param_name" => "is_featured",
                "description" =>__("Show Only Featured Location",ST_TEXTDOMAIN),
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("No",ST_TEXTDOMAIN)=>'no',
                    __("Yes",ST_TEXTDOMAIN)=>'yes',
                ),
                'edit_field_class'=>'vc_col-sm-6 clear',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Items per row", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" =>"",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Four',ST_TEXTDOMAIN)=>'4',
                    __('Three',ST_TEXTDOMAIN)=>'3',
                    __('Two',ST_TEXTDOMAIN)=>'2',
                ),
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style location",ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Normal',ST_TEXTDOMAIN)=>'normal',
                    __('Curved',ST_TEXTDOMAIN)=>'curved',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Show Logo",ST_TEXTDOMAIN),
                "param_name" => "st_show_logo",
                'edit_field_class'=>'vc_col-sm-6',
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'yes',
                    __('No',ST_TEXTDOMAIN)=>'no',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Logo Position",ST_TEXTDOMAIN),
                "param_name" => "st_logo_position",
                'edit_field_class'=>'vc_col-sm-6',
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Left',ST_TEXTDOMAIN)=>'left',
                    __('Right',ST_TEXTDOMAIN)=>'right',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Order By", ST_TEXTDOMAIN),
                "param_name" => "st_orderby",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>function_exists('st_get_list_order_by')? st_get_list_order_by(
                    array(
                        __('Sale',ST_TEXTDOMAIN) => 'sale' ,
                        __('Rate',ST_TEXTDOMAIN) => 'rate',
                        __('Min Price',ST_TEXTDOMAIN) => 'price',
                    )
                ):array(),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Order",ST_TEXTDOMAIN),
                "param_name" => "st_order",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Asc',ST_TEXTDOMAIN)=>'asc',
                    __('Desc',ST_TEXTDOMAIN)=>'desc'
                ),
                'edit_field_class'=>'vc_col-sm-6',
            ),
        )
    ) );
    vc_map( array(
        "name"     => __( "ST List Map New" , ST_TEXTDOMAIN ) ,
        "base"     => "st_list_map_new" ,
        "class"    => "" ,
        "icon"     => "icon-st" ,
        "category" => "Shinetheme" ,
        "params"   => array(
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Select Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_list_location" ,
                "description" => "" ,
                'stype' => 'list_location',
                'sparam' => '',
            ) ,
            array(
                "type"        => "checkbox" ,
                "holder"      => "div" ,
                "heading"     => __( "Type" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_type" ,
                "description" => "" ,
                'value'       => array(
                    __( 'All Post Type' , ST_TEXTDOMAIN ) => 'st_hotel,st_cars,st_tours,st_rental,st_activity' ,
                    __( 'Hotel' , ST_TEXTDOMAIN ) => 'st_hotel' ,
                    __( 'Car' , ST_TEXTDOMAIN )        => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )       => 'st_tours' ,
                    __( 'Rental' , ST_TEXTDOMAIN )     => 'st_rental' ,
                    __( 'Activities' , ST_TEXTDOMAIN ) => 'st_activity' ,
                ) ,
                'edit_field_class'=>'vc_col-sm-12',
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name" => "number" ,
                "value"      => 12 ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Zoom" , ST_TEXTDOMAIN ) ,
                "param_name" => "zoom" ,
                "value"      => 13 ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "class"       => "" ,
                "heading"     => __( "Map Height" , ST_TEXTDOMAIN ) ,
                "param_name"  => "height" ,
                "description" => "pixels" ,
                "value"       => 500 ,
                'edit_field_class'=>'vc_col-sm-3',
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
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "Range" , ST_TEXTDOMAIN ) ,
                "param_name"  => "range" ,
                "description" => "Km" ,
                "value"       => "20" ,
                'edit_field_class'=>'vc_col-sm-6',
            ) ,
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Style Map" , ST_TEXTDOMAIN ) ,
                "param_name"  => "style_map" ,
                "description" => "" ,
                'value'       => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Normal' , ST_TEXTDOMAIN )      => 'normal' ,
                    __( 'Midnight' , ST_TEXTDOMAIN )    => 'midnight' ,
                    __( 'Family Fest' , ST_TEXTDOMAIN ) => 'family_fest' ,
                    __( 'Open Dark' , ST_TEXTDOMAIN )   => 'open_dark' ,
                    __( 'Riverside' , ST_TEXTDOMAIN )   => 'riverside' ,
                    __( 'Ozan' , ST_TEXTDOMAIN )        => 'ozan' ,
                ) ,
                'edit_field_class'=>'vc_col-sm-6',
            ) ,
        )
    ) );
    vc_map(array(
        "name"                    => __("ST List Partner", ST_TEXTDOMAIN),
        "base"                    => "st_list_partner",
        "content_element"         => true,
        "show_settings_on_create" => true,
        "icon"                    => "icon-st",
        "category"                => "Shinetheme",
        "params"                  => array(
            array(
                'type'       => 'textfield',
                'param_name' => 'speed_slider',
                'holder'     => 'div',
                'heading'    => __('Speed of slider', ST_TEXTDOMAIN),
                'value'      => '3000',
            ),
            array(
                'heading'    => __('Auto play', ST_TEXTDOMAIN),
                'param_name' => 'autoplay',
                'type'       => 'checkbox',
                'value'      => array(
                    __('Yes', ST_TEXTDOMAIN) => 'yes',
                ),
            ),
        ),
    ));
    vc_map( array(
        "name" => __("ST List Review", ST_TEXTDOMAIN),
        "base" => "st_list_review",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Default' , ST_TEXTDOMAIN )        => 'html' ,
                    /* __( 'Tour box style' , ST_TEXTDOMAIN )       => 'st_tour_ver'*/
                ) ,
            ),
            array(
                "type" => "textfield",
                "heading" => __("Max Number", ST_TEXTDOMAIN),
                "param_name" => "number",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Max length", ST_TEXTDOMAIN),
                "param_name" => "st_max_len",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Location count rate ", ST_TEXTDOMAIN),
        "base" => "st_location_header_rate_count",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type"  =>"checkbox",
                "holder"=>"div",
                "heading"=>__("Post type select ?", ST_TEXTDOMAIN), //
                "param_name" => "post_type",
                "description" =>__("Select your post types which you want ?",ST_TEXTDOMAIN),
                "value" => array(
                    __('--- All ---',ST_TEXTDOMAIN)=>'all',
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                    __('Rental', ST_TEXTDOMAIN) => 'st_rental',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                )
            ),


        )
    ) );
    vc_map( array(
        "name" => __("ST Location statistical", ST_TEXTDOMAIN),
        "base" => "st_location_header_static",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type"  =>"checkbox",
                "holder"=>"div",
                "heading"=>__("Post type select ?", ST_TEXTDOMAIN), //
                "param_name" => "post_type",
                "description" =>__("Select your post types",ST_TEXTDOMAIN),
                "value" => array(
                    __('--- All ---',ST_TEXTDOMAIN)=>'all',
                    __('Hotel', ST_TEXTDOMAIN) => 'st_hotel',
                    __('Car', ST_TEXTDOMAIN) => 'st_cars',
                    __('Rental', ST_TEXTDOMAIN) => 'st_rental',
                    __('Activity', ST_TEXTDOMAIN) => 'st_activity',
                    __('Tour', ST_TEXTDOMAIN) => 'st_tours',
                )
            ),
            array(
                "type"  =>"checkbox",
                "holder"=>"div",
                "heading"=>__("Select star list ", ST_TEXTDOMAIN), //
                "param_name" => "star_list",
                "description" =>__("Select star list to static and show",ST_TEXTDOMAIN),
                "value" => array(
                    __('--- All ---<br>',ST_TEXTDOMAIN)=>'all',
                    __('<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (5)<br> ', ST_TEXTDOMAIN) => '5',
                    __('<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (4)<br> ', ST_TEXTDOMAIN) => '4',
                    __('<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (3)<br> ', ST_TEXTDOMAIN) => '3',
                    __('<i class="fa fa-star"></i><i class="fa fa-star"></i> (2) <br> ', ST_TEXTDOMAIN) => '2',
                    __('<i class="fa fa-star"></i> (1)  ', ST_TEXTDOMAIN) => '1',
                )
            ),
        )
    ) );
    vc_map(
        array(
            "name" => __("ST Gallery slider ", ST_TEXTDOMAIN),
            "base" => "st_location_slider",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>"Shinetheme",
            "params"    =>array(
                array(
                    "type"  =>"attach_images",
                    "holder"=>"div",
                    "heading"=>__("Gallery slider ", ST_TEXTDOMAIN), //
                    "param_name" => "st_location_list_image"

                )
            )
        )
    );
    $location_list_params = array(

        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Style", ST_TEXTDOMAIN),
            "param_name" => "st_location_style",
            "description" =>"Default style",
            'value'=> array(
                __('--Select --',ST_TEXTDOMAIN)=>'',
                __('List',ST_TEXTDOMAIN)=>'list',
                __('Grid',ST_TEXTDOMAIN)=>'grid')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("No. items per page", ST_TEXTDOMAIN),
            "param_name" => "st_location_num",
            "description" =>"Number of items shown",
            'value'=>4,
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order By", ST_TEXTDOMAIN),
            "param_name" => "st_location_orderby",
            "description" =>"",
            'value'=>st_get_list_order_by()
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => __("Order",ST_TEXTDOMAIN),
            "param_name" => "st_location_order",
            'value'=>array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __('Asc',ST_TEXTDOMAIN)=>'asc',
                __('Desc',ST_TEXTDOMAIN)=>'desc'
            ),
        )
    );
    vc_map(
        array(
            "name" => __("ST Location map", ST_TEXTDOMAIN),
            "base" => "st_location_map",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>"Shinetheme",
            'params'=> array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Number", ST_TEXTDOMAIN),
                    "param_name" => "map_spots",
                )
            )
        )
    );
    vc_map( array(
        "name"      => __("ST Google Map", ST_TEXTDOMAIN),
        "base"      => "st_google_map",
        "class"     => "",
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params"    => array(
            array(
                "type"      => "dropdown",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Type", ST_TEXTDOMAIN),
                "param_name"=> "type",
                "value"     => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Use Address',ST_TEXTDOMAIN)=>1,
                    __('User Latitude and Longitude',ST_TEXTDOMAIN)=>2,
                ),
                "description" => __("Address or using Latitude and Longitude", ST_TEXTDOMAIN)
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Address", ST_TEXTDOMAIN),
                "param_name"=> "address",
                "value"     => "",
                "description" => __("Address", ST_TEXTDOMAIN)
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Latitude", ST_TEXTDOMAIN),
                "param_name"=> "latitude",
                "value"     => "",
                "description" => __("Latitude, you can get it from  <a target='_blank' href='http://www.latlong.net/convert-address-to-lat-long.html'>here</a>", ST_TEXTDOMAIN)
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Longitude", ST_TEXTDOMAIN),
                "param_name"=> "longitude",
                "value"     => "",
                "description" => __("Longitude", ST_TEXTDOMAIN)
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Lightness", ST_TEXTDOMAIN),
                "param_name"=> "lightness",
                "value"     => 0,
                "description" => __("(a floating point value between -100 and 100) indicates the percentage change in brightness of the element.", ST_TEXTDOMAIN)
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Saturation", ST_TEXTDOMAIN),
                "param_name"=> "saturation",
                "value"     => "-100",
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Gamma", ST_TEXTDOMAIN),
                "param_name"=> "gama",
                "value"     => 0.5,
            ),
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Zoom", ST_TEXTDOMAIN),
                "param_name"=> "zoom",
                "value"     => 13,
            ),
            array(
                "type"      => "attach_image",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Custom Marker Icon", ST_TEXTDOMAIN),
                "param_name"=> "marker",
                "value"     => "",
                "description" => __("Custom Marker Icon", ST_TEXTDOMAIN)
            ),
        )));
    vc_map( array(
        'name'      => __('ST Room Map', ST_TEXTDOMAIN),
        'base'      => 'st_room_map',
        'class'     => '',
        'icon' => 'icon-st',
        'category'=>'Shinetheme',
        'params'    => array(
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
        ),
    ));
    vc_map( array(
        "name" => __("ST Progress Bar", ST_TEXTDOMAIN),
        "base" => "st_progress_bar",
        "as_parent" => array('only' => 'st_progress_bar_item'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Element style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    /*__('Tour box style (Vertical ) ',ST_TEXTDOMAIN)=>'vertical',
                __('Tour box style (Horizontal ) ',ST_TEXTDOMAIN)=>'horizontal',*/
                ),
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Progress Bar item", ST_TEXTDOMAIN),
        "base" => "st_progress_bar_item",
        "content_element" => true,
        "as_child" => array('only' => 'st_progress_bar'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
            ),
            /*array(
            "type" => "textarea_html",
            "heading" => __("Content", ST_TEXTDOMAIN),
            "param_name" => "content",
            "description" =>"",
        ),*/
            array(
                "type" => "textfield",
                "heading" => __("Value percentage", ST_TEXTDOMAIN),
                "param_name" => "value",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Promotion", ST_TEXTDOMAIN),
        "base" => "st_promotion",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon ", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'value'=>'fa-clock-o',
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Discount", ST_TEXTDOMAIN),
                "param_name" => "st_discount",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6',
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "heading" => __("Background Image", ST_TEXTDOMAIN),
                "param_name" => "st_bg_img",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("Background Color", ST_TEXTDOMAIN),
                "param_name" => "st_bg",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>'#002ca8'
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Opacity", ST_TEXTDOMAIN),
                "param_name" => "st_opacity",
                "description" =>__("Opacity : 0-100",ST_TEXTDOMAIN),
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>'50',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Sub", ST_TEXTDOMAIN),
                "param_name" => "st_sub",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Link", ST_TEXTDOMAIN),
                "param_name" => "st_link",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
            )
        )
    ) );
    vc_map( array(
        "name" => __("ST Rating Count", ST_TEXTDOMAIN),
        "base" => "st_rating_count",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Icon ", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"",
                'value'=>'fa-flag',
                'edit_field_class'=>'vc_col-sm-12',
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Search", ST_TEXTDOMAIN),
        "base" => "st_search",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                'admin_label' => true,
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style_search",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Style 1',ST_TEXTDOMAIN)=>'style_1',
                    __('Style 2',ST_TEXTDOMAIN)=>'style_2'
                ),
            ),
            array(
                "type" => "dropdown",
                "admin_label" => true,
                "heading" => __("Show box shadow", ST_TEXTDOMAIN),
                "param_name" => "st_box_shadow",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('No',ST_TEXTDOMAIN)=>'no',
                    __('Yes',ST_TEXTDOMAIN)=>'yes'
                ),
            ),
            array(
                "type" => "dropdown",
                "admin_label" => true,
                "heading" => __("Field size", ST_TEXTDOMAIN),
                "param_name" => "field_size",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Large',ST_TEXTDOMAIN)=>'lg',
                    __('Medium',ST_TEXTDOMAIN)=>'md'
                ),
            ),
            array(
                'type' => 'st_checkbox',
                'admin_label' => true,
                'heading' => __('Select Tabs Search', ST_TEXTDOMAIN),
                'param_name' => 'tabs_search',
                'description' => __('Please choose tab name to display in page', ST_TEXTDOMAIN),
                'stype' => 'get_option',
                'sparam' => 'search_tabs',
                'std' => 'all'
            )
        )
    ) );
    vc_map( array(
        "name"                    => __( "ST Search Filter" , ST_TEXTDOMAIN ) ,
        "base"                    => "st_search_filter" ,
        "as_parent"               => array( 'only' => 'st_filter_price,st_filter_rate,st_filter_hotel_rate,st_filter_taxonomy' ) ,
        "content_element"         => true ,
        "show_settings_on_create" => true ,
        "js_view"                 => 'VcColumnView' ,
        "icon"                    => "icon-st" ,
        "category"                => "Shinetheme" ,
        "params"                  => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "heading"    => __( "Style" , ST_TEXTDOMAIN ) ,
                "param_name" => "style" ,
                "value"      => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Dark' , ST_TEXTDOMAIN )  => 'dark' ,
                    __( 'Light' , ST_TEXTDOMAIN ) => 'light' ,
                ) ,
            ) ,
        )
    ) );
    vc_map( array(
        "name"            => __( "ST Filter Price" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_price" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "heading"    => __( "Post Type" , ST_TEXTDOMAIN ) ,
                "param_name" => "post_type" ,
                "value"      => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Hotel' , ST_TEXTDOMAIN )    => 'st_hotel' ,
                    __( 'Hotel Room' , ST_TEXTDOMAIN )    => 'hotel_room' ,
                    __( 'Rental' , ST_TEXTDOMAIN )   => 'st_rental' ,
                    __( 'Car' , ST_TEXTDOMAIN )      => 'st_cars' ,
                    __( 'Car Transfer' , ST_TEXTDOMAIN )      => 'car_transfer' ,
                    __( 'Tour' , ST_TEXTDOMAIN )     => 'st_tours' ,
                    __( 'Activity' , ST_TEXTDOMAIN ) => 'st_activity' ,
                    __( 'All Post Type' , ST_TEXTDOMAIN )    => 'all' ,
                ) ,
            ) ,
        )
    ) );
    vc_map( array(
        "name"            => __( "ST Filter Rate" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_rate" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title"
            )
        )
    ) );
    vc_map( array(
        "name"            => __( "ST Filter Hotel Star Rating" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_hotel_rate" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
        )
    ) );

    $param_taxonomy = array(
        array(
            "type"        => "textfield" ,
            "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
            "param_name"  => "title" ,
            "description" => "" ,
        ) ,
        array(
            "type"       => "dropdown" ,
            "holder"     => "div" ,
            "heading"    => __( "Post Type" , ST_TEXTDOMAIN ) ,
            "param_name" => "st_post_type" ,
            "value"      => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'Hotel' , ST_TEXTDOMAIN )    => 'st_hotel' ,
                __( 'Room Hotel' , ST_TEXTDOMAIN ) => 'hotel_room' ,
                __( 'Rental' , ST_TEXTDOMAIN )   => 'st_rental' ,
                __( 'Car' , ST_TEXTDOMAIN )      => 'st_cars' ,
                __( 'Tour' , ST_TEXTDOMAIN )     => 'st_tours' ,
                __( 'Activity' , ST_TEXTDOMAIN ) => 'st_activity' ,
            ) ,
        )
    );

    $list_post_type = array(
        __( 'Hotel' , ST_TEXTDOMAIN )    => 'st_hotel' ,
        __( 'Room Hotel' , ST_TEXTDOMAIN ) => 'hotel_room' ,
        __( 'Rental' , ST_TEXTDOMAIN )   => 'st_rental' ,
        __( 'Car' , ST_TEXTDOMAIN )      => 'st_cars' ,
        __( 'Tour' , ST_TEXTDOMAIN )     => 'st_tours' ,
        __( 'Activity' , ST_TEXTDOMAIN ) => 'st_activity' ,
    );
    foreach( $list_post_type as $k => $v ) {
        $_param         = array(
            "type"       => "st_dropdown" ,
            "holder"     => "div" ,
            "heading"    => sprintf(__("Taxonomy %s",ST_TEXTDOMAIN),$k),
            "param_name" => "taxonomy_" . $v ,
            'stype' => 'list_tax',
            'sparam' => $v,
            'dependency' => array(
                'element' => 'st_post_type' ,
                'value'   => array( $v )
            ) ,
        );
        $param_taxonomy[ ] = $_param;
    }

    vc_map( array(
        "name"            => __( "ST Filter Taxonomy" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_taxonomy" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter' ) ,
        "icon"            => "icon-st" ,
        "params"          => $param_taxonomy
    ) );
    vc_map( array(
        "name"                    => __( "[Ajax] ST Search Filter" , ST_TEXTDOMAIN ) ,
        "base"                    => "st_search_filter_ajax" ,
        "as_parent"               => array( 'only' => 'st_filter_price_ajax,st_filter_rate_ajax,st_filter_hotel_rate_ajax,st_filter_taxonomy_ajax' ) ,
        "content_element"         => true ,
        "show_settings_on_create" => true ,
        "js_view"                 => 'VcColumnView' ,
        "icon"                    => "icon-st" ,
        "category"                => "Shinetheme" ,
        "params"                  => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "heading"    => __( "Style" , ST_TEXTDOMAIN ) ,
                "param_name" => "style" ,
                "value"      => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Dark' , ST_TEXTDOMAIN )  => 'dark' ,
                    __( 'Light' , ST_TEXTDOMAIN ) => 'light' ,
                ) ,
            ) ,
        )
    ) );
    vc_map( array(
        "name"            => __( "[Ajax] ST Filter Price" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_price_ajax" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter_ajax' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "heading"    => __( "Post Type" , ST_TEXTDOMAIN ) ,
                "param_name" => "post_type" ,
                "value"      => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Hotel' , ST_TEXTDOMAIN )    => 'st_hotel' ,
                    __( 'Hotel Room' , ST_TEXTDOMAIN )    => 'hotel_room' ,
                    __( 'Rental' , ST_TEXTDOMAIN )   => 'st_rental' ,
                    __( 'Car' , ST_TEXTDOMAIN )      => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )     => 'st_tours' ,
                    __( 'Activity' , ST_TEXTDOMAIN ) => 'st_activity' ,
                    __( 'All Post Type' , ST_TEXTDOMAIN )    => 'all' ,
                ) ,
            ) ,
        )
    ) );
    vc_map( array(
        "name"            => __( "[Ajax] ST Filter Rate" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_rate_ajax" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter_ajax' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title"
            )
        )
    ) );
    vc_map( array(
        "name"            => __( "[Ajax] ST Filter Hotel Star Rating" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_hotel_rate_ajax" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter_ajax' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "title" ,
                "description" => "" ,
            ) ,
        )
    ) );
    vc_map( array(
        "name" => __("ST Simple Location", ST_TEXTDOMAIN),
        "base" => "st_simple_location",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Type", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Hotel',ST_TEXTDOMAIN)=>'st_hotel',
                    __('Car',ST_TEXTDOMAIN)=>'st_cars',
                    __('Tour',ST_TEXTDOMAIN)=>'st_tours',
                    __('Rental',ST_TEXTDOMAIN)=>'st_rental',
                    __('Activities',ST_TEXTDOMAIN)=>'st_activity',
                ),
            ),
            array(
                "type" => "st_post_type_location_2",
                "holder" => "div",
                "heading" => __("Select Location ", ST_TEXTDOMAIN),
                "param_name" => "st_list_location_2",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Single Search", ST_TEXTDOMAIN),
        "base" => "st_single_search",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title form search", ST_TEXTDOMAIN),
                "param_name" => "st_title_search",
                "description" =>"",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Select form search", ST_TEXTDOMAIN),
                "param_name" => "st_list_form",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Hotel',ST_TEXTDOMAIN)=>'hotel',
                    __('Rental',ST_TEXTDOMAIN)=>'rental',
                    __('Cars',ST_TEXTDOMAIN)=>'cars',
                    __('Activities',ST_TEXTDOMAIN)=>'activities',
                    __('Tours',ST_TEXTDOMAIN)=>'tours',
                    __('Hotel Room',ST_TEXTDOMAIN)=>'hotel_room',
                    __('All Post Type',ST_TEXTDOMAIN)=>'all-post-type'
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Form's direction", ST_TEXTDOMAIN),
                "param_name" => "st_direction",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Vertical form',ST_TEXTDOMAIN)=>'vertical',
                    __('Horizontal form',ST_TEXTDOMAIN)=>'horizontal'
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style_search",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Large',ST_TEXTDOMAIN)=>'style_1',
                    __('Normal',ST_TEXTDOMAIN)=>'style_2',
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Show box shadow", ST_TEXTDOMAIN),
                "param_name" => "st_box_shadow",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('No',ST_TEXTDOMAIN)=>'no',
                    __('Yes',ST_TEXTDOMAIN)=>'yes'
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Field Size", ST_TEXTDOMAIN),
                "param_name" => "field_size",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Large',ST_TEXTDOMAIN)=>'lg',
                    __('Normal',ST_TEXTDOMAIN)=>'sm',
                )
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Slide Location", ST_TEXTDOMAIN),
        "base" => "st_slide_location",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" =>"",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Explore type", ST_TEXTDOMAIN),
                "param_name" => "st_type",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Hotel',ST_TEXTDOMAIN)=>'st_hotel',
                    __('Car',ST_TEXTDOMAIN)=>'st_cars',
                    __('Tour',ST_TEXTDOMAIN)=>'st_tours',
                    __('Rental',ST_TEXTDOMAIN)=>'st_rental',
                    __('Activities',ST_TEXTDOMAIN)=>'st_activity',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Show Only Featured Location", ST_TEXTDOMAIN),
                "param_name" => "is_featured",
                "description" =>__("Show Only Featured Location",ST_TEXTDOMAIN),
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("No",ST_TEXTDOMAIN)=>'no',
                    __("Yes",ST_TEXTDOMAIN)=>'yes',
                ),
            ),
            array(
                "type" => "st_checkbox",
                "holder" => "div",
                "heading" => __("Location type", ST_TEXTDOMAIN),
                "param_name" => "st_location_type",
                "description" =>"",
                'stype' => 'list_location_terms',
                'sparam' => '',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Number Location", ST_TEXTDOMAIN),
                "param_name" => "st_number",
                "description" =>"",
                'value'=>4,
                'dependency' => array(
                    'element' => 'is_featured',
                    'value' => array( 'yes' )
                ),
            ),
            array(
                "type" => "st_post_type_location",
                "holder" => "div",
                "heading" => __("Select Location ", ST_TEXTDOMAIN),
                "param_name" => "st_list_location",
                "description" =>"",
                'dependency' => array(
                    'element' => 'is_featured',
                    'value' => array( 'no' )
                ),

            ),

            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style show ", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Text info center',ST_TEXTDOMAIN)=>'style_1',
                    __('Show Search Box',ST_TEXTDOMAIN)=>'style_2',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Effect", ST_TEXTDOMAIN),
                "param_name" => "effect",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('None',ST_TEXTDOMAIN)=>'false',
                    __('Fade',ST_TEXTDOMAIN)=>'fade',
                    __('Back Slide',ST_TEXTDOMAIN)=>'backSlide',
                    __('Go Down',ST_TEXTDOMAIN)=>'goDown',
                    __('Fade Up',ST_TEXTDOMAIN)=>'fadeUp',
                ),
            ),

            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Weather show ", ST_TEXTDOMAIN),
                "param_name" => "st_weather",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'yes',
                    __('No',ST_TEXTDOMAIN)=>'no',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Height", ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'st_style' ,
                    'value'   => 'style_1'
                ) ,
                "param_name" => "st_height",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Full height',ST_TEXTDOMAIN)=>'full',
                    __('Half height',ST_TEXTDOMAIN)=>'half',
                ),
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Link To", ST_TEXTDOMAIN),
                "param_name" => "link_to",
                "description" =>__("Link To",ST_TEXTDOMAIN),
                'value'=>array(
                    __("Page Search",ST_TEXTDOMAIN)=>'page_search',
                    __("Single",ST_TEXTDOMAIN)=>'single'
                ),
                'edit_field_class'=>'vc_col-sm-12',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Opacity Background", ST_TEXTDOMAIN),
                "param_name" => "opacity",
                "description" =>__(" Enter value form 0 - 0.5 - 1 ",ST_TEXTDOMAIN),
                'value'=>'0.5'
            ),
            array(
                'type' => 'st_checkbox',
                'admin_label' => true,
                'heading' => __('Select Tabs Search', ST_TEXTDOMAIN),
                'param_name' => 'tabs_search',
                'description' => __('Please choose tab name to display in page', ST_TEXTDOMAIN),
                'stype' => 'get_option',
                'sparam' => 'search_tabs',
                'std' => 'all'
            )
        )
    ) );
    vc_map(
        array(
            "name" => __("ST Testimonial Slide", ST_TEXTDOMAIN),
            "category"=>"Shinetheme",
            "base" => "st_slide_testimonial",
            "as_parent" => array('only' => 'st_testimonial_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "js_view" => 'VcColumnView',
            "icon" => "icon-st",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Effect", ST_TEXTDOMAIN),
                    "param_name" => "effect",
                    "description" =>"",
                    'value'=>array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('None',ST_TEXTDOMAIN)=>'false',
                        __('Fade',ST_TEXTDOMAIN)=>'fade',
                        __('Back Slide',ST_TEXTDOMAIN)=>'backSlide',
                        __('Go Down',ST_TEXTDOMAIN)=>'goDown',
                        __('Fade Up',ST_TEXTDOMAIN)=>'fadeUp',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Speed", ST_TEXTDOMAIN),
                    "param_name" => "st_speed",
                    "description" =>__("Ex : 500ms",ST_TEXTDOMAIN),
                    'value'=>'500'
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Auto Play Time", ST_TEXTDOMAIN),
                    "param_name" => "st_play",
                    "description" =>__("Set 0 to turn off autoplay",ST_TEXTDOMAIN),
                    'value'=>'4500'
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Show form", ST_TEXTDOMAIN),
                    "param_name" => "is_form",
                    "description" =>__("Yes to show form search",ST_TEXTDOMAIN),
                    'value'=>array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'yes',
                        __('No',ST_TEXTDOMAIN)=>'no',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Background", ST_TEXTDOMAIN),
                    "param_name" => "is_bgr",
                    "description" =>__("No to tranparent background",ST_TEXTDOMAIN),
                    'value'=>array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'yes',
                        __('No',ST_TEXTDOMAIN)=>'no',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Items in screen", ST_TEXTDOMAIN),
                    "param_name" => "items_per_row",
                    "description" =>__("Items number in a carousel item",ST_TEXTDOMAIN),
                    'value'=>array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('1',ST_TEXTDOMAIN)=>'1',
                        __('2',ST_TEXTDOMAIN)=>'2',
                        __('3',ST_TEXTDOMAIN)=>'3',
                        __('4',ST_TEXTDOMAIN)=>'4',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Navigation", ST_TEXTDOMAIN),
                    "param_name" => "navigation",
                    "description" =>__("No to hide navigation",ST_TEXTDOMAIN),
                    'value'=>array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('Yes',ST_TEXTDOMAIN)=>'true',
                        __('No',ST_TEXTDOMAIN)=>'false',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Opacity Background", ST_TEXTDOMAIN),
                    "param_name" => "opacity",
                    "description" =>__(" Enter value form 0 - 0.5 - 1 ",ST_TEXTDOMAIN),
                    'value'=>'0.5'
                ),
                array(
                    'type' => 'st_checkbox',
                    'admin_label' => true,
                    'heading' => __('Select Tabs Search', ST_TEXTDOMAIN),
                    'param_name' => 'tabs_search',
                    'description' => __('Please choose tab name to display in page', ST_TEXTDOMAIN),
                    'stype' => 'get_option',
                    'sparam' => 'search_tabs',
                    'std' => 'all'
                )
            )
        )
    );
    vc_map(
        array(
            "name" => __("Testimonial Item", ST_TEXTDOMAIN),
            "base" => "st_testimonial_item",
            "content_element" => true,
            "as_child" => array('only' => 'st_slide_testimonial'),
            "icon" => "icon-st",
            "params" => array(
                array(
                    "type" => "attach_image",
                    "holder" => "div",
                    "heading" => __("Avatar", ST_TEXTDOMAIN),
                    "param_name" => "st_avatar",
                    "description" =>"",
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Name", ST_TEXTDOMAIN),
                    "param_name" => "st_name",
                    "description" =>"",
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Sub", ST_TEXTDOMAIN),
                    "param_name" => "st_sub",
                    "description" =>"",
                ),
                array(
                    "type" => "textarea",
                    "holder" => "div",
                    "heading" => __("Description", ST_TEXTDOMAIN),
                    "param_name" => "st_desc",
                    "description" =>"",
                ),
                array(
                    "type" => "attach_image",
                    "holder" => "div",
                    "heading" => __("Background", ST_TEXTDOMAIN),
                    "param_name" => "st_bg",
                    "description" =>"",
                ),
            )
        )
    );
    vc_map( array(
        "name" => __("ST Tab", ST_TEXTDOMAIN),
        "base" => "st_tab",
        "as_parent" => array('only' => 'st_tab_item'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Element style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "description" =>"",
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __('Tour box style (Vertical ) ',ST_TEXTDOMAIN)=>'vertical',
                    __('Tour box style (Horizontal ) ',ST_TEXTDOMAIN)=>'horizontal',
                ),
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Tab item", ST_TEXTDOMAIN),
        "base" => "st_tab_item",
        "content_element" => true,
        "as_child" => array('only' => 'st_tab'),
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("icon", ST_TEXTDOMAIN),
                "param_name" => "st_icon",
                "description" =>"Example: fa fa-home". "<a href='https://fortawesome.github.io/Font-Awesome/icons/'> Read more</a>",
            ),
            array(
                "type" => "textarea_html",
                "heading" => __("Content", ST_TEXTDOMAIN),
                "param_name" => "content",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Team", ST_TEXTDOMAIN),
        "base" => "st_team",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Element style", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-12',
                'value'=>array(
                    __('--Default--',ST_TEXTDOMAIN)=>'',
                    __("Tour box style",ST_TEXTDOMAIN)     =>"st_tour_ver",
                )
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "heading" => __("Avatar", ST_TEXTDOMAIN),
                "param_name" => "st_avatar",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Name", ST_TEXTDOMAIN),
                "param_name" => "st_name",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Position", ST_TEXTDOMAIN),
                "param_name" => "st_position",
                "description" =>"",
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Social Effect ", ST_TEXTDOMAIN),
                "param_name" => "st_effect",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>array(
                    __("Hover",ST_TEXTDOMAIN)   =>"",
                    __("Hold",ST_TEXTDOMAIN)    =>"hover-hold",
                )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Position Social", ST_TEXTDOMAIN),
                "param_name" => "st_position_social",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-6',
                'value'=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("Top Left",ST_TEXTDOMAIN)     =>"-top-left",
                    __("Top Right",ST_TEXTDOMAIN)    =>"-top-right",
                    __("Bottom Left",ST_TEXTDOMAIN)  =>"-bottom-left",
                    __("Bottom Right",ST_TEXTDOMAIN) =>"-bottom-right",
                    __("Center",ST_TEXTDOMAIN)       =>"",
                    __("Center Top",ST_TEXTDOMAIN)   =>"-center-top",
                    __("Center Bottom",ST_TEXTDOMAIN)=>"-center-bottom",
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Facebook", ST_TEXTDOMAIN),
                "param_name" => "st_facebook",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Twitter", ST_TEXTDOMAIN),
                "param_name" => "st_twitter",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Google Plus", ST_TEXTDOMAIN),
                "param_name" => "st_google",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Instagram", ST_TEXTDOMAIN),
                "param_name" => "st_instagram",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("LinkedIn", ST_TEXTDOMAIN),
                "param_name" => "st_linkedin",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Youtube", ST_TEXTDOMAIN),
                "param_name" => "st_youtube",
                "description" =>"",
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Other Social Link", ST_TEXTDOMAIN),
                "param_name" => "st_other_social",
                "description" =>"Ex : ".htmlentities("<li><a href='#' class='fa fa-facebook box-icon-normal round'></a></li>").'<br>Social icons <a target="_blank"  href="http://fortawesome.github.io/Font-Awesome/icons/" >click here</a>',
            ),
            array(
                'type'  => 'textarea',
                'holder' => 'div',
                'heading'   => "Description",
                'param_name'    => 'st_description',
                'description'   => ''
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Testimonial", ST_TEXTDOMAIN),
        "base" => "st_testimonial",
        "content_element" => true,
        "icon" => "icon-st",
        "category"=>"Shinetheme",
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Style", ST_TEXTDOMAIN),
                "param_name" => "st_style",
                "description" =>"",
                "value"=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("Style 1",ST_TEXTDOMAIN)=>"style1",
                    __("Style 2",ST_TEXTDOMAIN)=>"style2"
                )
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "heading" => __("Avatar", ST_TEXTDOMAIN),
                "param_name" => "st_avatar",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "heading" => __("Text Color", ST_TEXTDOMAIN),
                "param_name" => "st_color",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => __("Testimonial color", ST_TEXTDOMAIN),
                "param_name" => "st_testimonial_color",
                "description" =>"",
                'edit_field_class'=>'vc_col-sm-4',
                'value'=>array(
                    __('No',ST_TEXTDOMAIN)=>'',
                    __('Yes',ST_TEXTDOMAIN)=>'testimonial-color',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Name", ST_TEXTDOMAIN),
                "param_name" => "st_name",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Sub", ST_TEXTDOMAIN),
                "param_name" => "st_sub",
                "description" =>"",
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => __("Description", ST_TEXTDOMAIN),
                "param_name" => "st_desc",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Text Slide", ST_TEXTDOMAIN),
        "base" => "st_text_slide",
        "category"=>"Shinetheme",
        "content_element" => true,
        "show_settings_on_create" => true,
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
            ),
            array(
                "type" => "textarea",
                "heading" => __("HTML Code", ST_TEXTDOMAIN),
                "param_name" => "st_html_code",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Show form search", ST_TEXTDOMAIN),
                "param_name" => "show_search",
                "value"=>array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __("Yes",ST_TEXTDOMAIN)=>'yes',
                    __("No",ST_TEXTDOMAIN)=>'no',
                )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Opacity Background", ST_TEXTDOMAIN),
                "param_name" => "opacity",
                "description" =>__(" Enter value form 0 - 0.5 - 1 ",ST_TEXTDOMAIN),
                'value'=>'0.5'
            ),
            array(
                "type" => "attach_images",
                "heading" => __("Background", ST_TEXTDOMAIN),
                "param_name" => "st_background",
            ),

            array(
                'type' => 'st_checkbox',
                'admin_label' => true,
                'heading' => __('Select Tabs Search', ST_TEXTDOMAIN),
                'param_name' => 'tabs_search',
                'description' => __('Please choose tab name to display in page', ST_TEXTDOMAIN),
                'stype' => 'get_option',
                'sparam' => 'search_tabs',
                'std' => 'all'
            )
        )
    ) );
    vc_map(array(
        "name"            => __( "ST Title" , ST_TEXTDOMAIN ) ,
        "base"            => "st_title" ,
        "icon"            => "icon-st" ,
        "category"        => 'Shinetheme',
        'params'    => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Heading", ST_TEXTDOMAIN),
                "param_name" => "heading",
                'edit_field_class'=>'vc_col-sm-12',
                "description" =>__("type 1 to H1", ST_TEXTDOMAIN),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Text align", ST_TEXTDOMAIN),
                "param_name" => "align",
                'edit_field_class'=>'vc_col-sm-12',
                "description" =>__("http://www.w3schools.com/cssref/pr_text_text-align.asp", ST_TEXTDOMAIN),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Color", ST_TEXTDOMAIN),
                "param_name" => "color",
                'edit_field_class'=>'vc_col-sm-12',
                "description" =>__("http://www.w3schools.com/cssref/css_colors.asp", ST_TEXTDOMAIN),
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => __("Font Weight", ST_TEXTDOMAIN),
                "param_name" => "font_weight",
                'edit_field_class'=>'vc_col-sm-12',

            ),
        ),
    ));
    vc_map( array(
        "name" => esc_html__("ST TravelPayouts API Widget", ST_TEXTDOMAIN),
        "base" => "st_tp_widgets",
        "content_element" => true,
        'description' => esc_html__('Get widgets from TravelPayouts API', ST_TEXTDOMAIN),
        "icon" => "icon-st",
        'category' => 'Shinetheme',
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Widget Type", ST_TEXTDOMAIN),
                "param_name" => "widget_type",
                'admin_label' => true,
                "description" => esc_html__('Select a widget type', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Widget popular routes', ST_TEXTDOMAIN) => 'popular-router',
                    esc_html__('Flights Map', ST_TEXTDOMAIN) => 'flights-map',
                    esc_html__('Hotels Map', ST_TEXTDOMAIN) => 'hotels-map',
                    esc_html__('Calendar Widget', ST_TEXTDOMAIN) => 'calendar',
                    esc_html__('Hotel Widget', ST_TEXTDOMAIN) => 'hotel',
                    esc_html__('Hotels Selections', ST_TEXTDOMAIN) => 'hotel-selections',
                ),
                'std' => 'popular-router'
            ),
            array(
                "type" => "st_tp_locations",
                "heading" => esc_html__("Default Origin", ST_TEXTDOMAIN),
                "param_name" => "pr_origin",
                "description" =>esc_html__('Find a origin', ST_TEXTDOMAIN),
                'location_type' => 'flight',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('calendar')
                )
            ),
            array(
                "type" => "st_tp_locations",
                "heading" => esc_html__("Default Destination", ST_TEXTDOMAIN),
                "param_name" => "pr_destination",
                "description" =>esc_html__('Find a destination', ST_TEXTDOMAIN),
                'location_type' => 'flight',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('popular-router','flights-map','calendar')
                )
            ),
            array(
                "type" => "st_tp_locations",
                "heading" => esc_html__("Hotel", ST_TEXTDOMAIN),
                "param_name" => "hotel_id",
                "description" =>esc_html__('Find a hotel', ST_TEXTDOMAIN),
                'location_type' => 'hotel_id',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel')
                )
            ),
            array(
                "type" => "st_tp_locations",
                "heading" => esc_html__("Location", ST_TEXTDOMAIN),
                "param_name" => "map_lat_lon",
                "description" =>esc_html__('Find a location', ST_TEXTDOMAIN),
                'location_type' => 'hotel_map',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotels-map')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Language', ST_TEXTDOMAIN),
                'param_name' => 'language',
                'description' => esc_html__('Select a language', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('popular-router','hotel','hotels-map')
                ),
                'value' => array(
                    esc_html__('Russian', ST_TEXTDOMAIN) => 'ru',
                    esc_html__('English (Great Britan)', ST_TEXTDOMAIN) => 'en',
                    esc_html__('Thai', ST_TEXTDOMAIN) => 'th',
                ),
                'std' => 'en'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Locale', ST_TEXTDOMAIN),
                'param_name' => 'language1',
                'description' => esc_html__('Select a locale', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('flights-map')
                ),
                'value' => array(
                    esc_html__('Deutsch (DE)', ST_TEXTDOMAIN) => 'de',
                    esc_html__('English', ST_TEXTDOMAIN) => 'en',
                    esc_html__('French', ST_TEXTDOMAIN) => 'fr',
                    esc_html__('Italian', ST_TEXTDOMAIN) => 'it',
                    esc_html__('Russian', ST_TEXTDOMAIN) => 'ru',
                    esc_html__('Thai', ST_TEXTDOMAIN) => 'th',
                ),
                'std' => 'en'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Language', ST_TEXTDOMAIN),
                'param_name' => 'language2',
                'description' => esc_html__('Select a language', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('calendar')
                ),
                'value' => array(
                    esc_html__('Deutsch (DE)', ST_TEXTDOMAIN) => 'de',
                    esc_html__('English', ST_TEXTDOMAIN) => 'en',
                    esc_html__('French', ST_TEXTDOMAIN) => 'fr',
                    esc_html__('Italian', ST_TEXTDOMAIN) => 'it',
                    esc_html__('Russian', ST_TEXTDOMAIN) => 'ru',
                    esc_html__('Thai', ST_TEXTDOMAIN) => 'th',
                    esc_html__('Spanish', ST_TEXTDOMAIN) => 'es',
                    esc_html__('Chinese', ST_TEXTDOMAIN) => 'zh',
                    esc_html__('Brazilian', ST_TEXTDOMAIN) => 'br',
                    esc_html__('Japanese', ST_TEXTDOMAIN) => 'ja',
                    esc_html__('Portuguese', ST_TEXTDOMAIN) => 'pt',
                    esc_html__('Polish', ST_TEXTDOMAIN) => 'pl',
                ),
                'std' => 'en'
            ),
            // Hotel selection
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Widget\'s layout', ST_TEXTDOMAIN),
                'param_name' => 'w_layout',
                'value' => array(
                    esc_html__('Full', ST_TEXTDOMAIN) => 'full',
                    esc_html__('Compact', ST_TEXTDOMAIN) => 'compact'
                ),
                'std' => 'full',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel-selections')
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Language', ST_TEXTDOMAIN),
                'param_name' => 'language3',
                'description' => esc_html__('Select a language', ST_TEXTDOMAIN),
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel-selections')
                ),
                'value' => array(
                    esc_html__('Deutsch (DE)', ST_TEXTDOMAIN) => 'de',
                    esc_html__('English', ST_TEXTDOMAIN) => 'en',
                    esc_html__('French', ST_TEXTDOMAIN) => 'fr',
                    esc_html__('Italian', ST_TEXTDOMAIN) => 'it',
                    esc_html__('Russian', ST_TEXTDOMAIN) => 'ru',
                    esc_html__('Thai', ST_TEXTDOMAIN) => 'th',
                    esc_html__('Chinese', ST_TEXTDOMAIN) => 'zh',
                    esc_html__('Japanese', ST_TEXTDOMAIN) => 'ja',
                ),
                'std' => 'en'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Max hotels in list', ST_TEXTDOMAIN),
                'param_name' => 'limit',
                'value' => array(
                    esc_html__('1', ST_TEXTDOMAIN) => '1',
                    esc_html__('2', ST_TEXTDOMAIN) => '2',
                    esc_html__('3', ST_TEXTDOMAIN) => '3',
                    esc_html__('4', ST_TEXTDOMAIN) => '4',
                    esc_html__('5', ST_TEXTDOMAIN) => '5',
                    esc_html__('6', ST_TEXTDOMAIN) => '6',
                    esc_html__('7', ST_TEXTDOMAIN) => '7',
                    esc_html__('8', ST_TEXTDOMAIN) => '8',
                    esc_html__('9', ST_TEXTDOMAIN) => '9',
                    esc_html__('10', ST_TEXTDOMAIN) => '10'
                ),
                'std' => '10',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel-selections')
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Direct Flights Only', ST_TEXTDOMAIN),
                'param_name' => 'direct',
                'value' => array(
                    esc_html__('Yes', ST_TEXTDOMAIN) => 'yes'
                ),
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('flights-map')
                ),
                'std' => 'yes'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Additional marker", ST_TEXTDOMAIN),
                "param_name" => "add_marker",
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel','hotels-map','hotel-selections')
                )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Map Controls', ST_TEXTDOMAIN),
                'param_name' => 'map_control',
                'value' => array(
                    esc_html__('Draggable', ST_TEXTDOMAIN) => 'drag',
                    esc_html__('Disable zoom', ST_TEXTDOMAIN) => 'disable_zoom',
                    esc_html__('Scroll wheel', ST_TEXTDOMAIN) => 'scroll',
                    esc_html__('Map styled', ST_TEXTDOMAIN) => 'map_styled'
                ),
                'std' => 'drag',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotels-map')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Map Zoom', ST_TEXTDOMAIN),
                'param_name' => 'map_zoom',
                'value' => '12',
                'std' => '12',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotels-map')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Marker Size', ST_TEXTDOMAIN),
                'param_name' => 'marker_size',
                'value' => '16',
                'std' => '16',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotels-map')
                )
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Color Schema', ST_TEXTDOMAIN),
                'param_name' => 'color_schema',
                'value' => '#00b1dd',
                'std' => '#00b1dd',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotels-map')
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Find By', ST_TEXTDOMAIN),
                'param_name' => 'find_by',
                'value' => array(
                    esc_html__('Hotels', ST_TEXTDOMAIN) => 'hotels',
                    esc_html__('City', ST_TEXTDOMAIN) => 'city'
                ),
                'std' => 'city',
                'dependency' => array(
                    'element' => 'widget_type',
                    'value' => array('hotel-selections')
                ),
            ),
            array(
                "type" => "st_tp_locations",
                "heading" => esc_html__("City", ST_TEXTDOMAIN),
                "param_name" => "city_data",
                "description" =>esc_html__('Find a city', ST_TEXTDOMAIN),
                'location_type' => 'city',
                'dependency' => array(
                    'element' => 'find_by',
                    'value' => array('city')
                )
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('List Hotels', ST_TEXTDOMAIN),
                'param_name' => 'list_hotel',
                'value' => '',
                'params' => array(
                    array(
                        "type" => "st_tp_locations",
                        "heading" => esc_html__("Hotel", ST_TEXTDOMAIN),
                        "param_name" => "s_hotel_id",
                        'location_type' => 'hotel_id'
                    ),
                ),
                'callbacks' => array(
                    'after_add' => 'vcChartParamAfterAddCallback'
                ),
                'dependency' => array(
                    'element' => 'find_by',
                    'value' => array('hotels')
                ),
            )

        )
    ) );
    vc_map( array(
        "name" => __("ST Twitter", ST_TEXTDOMAIN),
        "base" => "st_twitter",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Number", ST_TEXTDOMAIN),
                "param_name" => "st_twitter_number",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("User Twitter", ST_TEXTDOMAIN),
                "param_name" => "st_twitter_user",
                "description" => ""
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Color text", ST_TEXTDOMAIN),
                "param_name" => "st_color",
                "description" =>"",
            ),
        )
    ) );
    vc_map( array(
        "name" => __("ST Under construction", ST_TEXTDOMAIN),
        "base" => "st_under_construction",
        "content_element" => true,
        "icon" => "icon-st",
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Short description", ST_TEXTDOMAIN),
                "param_name" => "st_text",
                "description" =>"",
            ),
            array(
                "type" => "textfield",
                "heading" => __("End Date", ST_TEXTDOMAIN),
                "param_name" => "st_enddate",
                "description" =>"",
            ),

        )
    ) );


    vc_map( array(
        "name"            => __( "[Ajax] ST Filter Taxonomy" , ST_TEXTDOMAIN ) ,
        "base"            => "st_filter_taxonomy_ajax" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_search_filter_ajax' ) ,
        "icon"            => "icon-st" ,
        "params"          => $param_taxonomy
    ) );

// List HALFT MAP
    vc_map( array(
        "name"     => __( "ST List Half Map" , ST_TEXTDOMAIN ) ,
        "base"     => "st_list_half_map" ,
        "class"                   => "" ,
        "icon"                    => "icon-st" ,
        "category"                => "Shinetheme" ,
        "content_element"         => true ,
        "show_settings_on_create" => true ,
        "js_view"                 => 'VcColumnView' ,
        "as_parent"               => array(
            'only' => 'st_list_half_map_field_hotel,st_list_half_map_field_rental,st_list_half_map_field_car,st_list_half_map_field_tour,st_list_half_map_field_activity,st_list_half_map_field_range_km' ,
        ) ,
        "params"   => array(
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name" => "title" ,
                "value"      => '' ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Type" , ST_TEXTDOMAIN ) ,
                "param_name" => "type" ,
                "value"      => array(
                    __( "Normal" , ST_TEXTDOMAIN )      => 'normal' ,
                    __( "Use for Search Result Page" , ST_TEXTDOMAIN ) => 'page_search'
                ) ,
            ) ,
            array(
                "type"        => "st_post_type_location" ,
                "holder"      => "div" ,
                "heading"     => __( "Select Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_list_location" ,
                "description" => "" ,
                /*"value"       => $list_location_data ,*/
                "dependency"  =>
                    array(
                        "element" => "type" ,
                        "value"   => "normal"
                    ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Type" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_type" ,
                "description"      => "" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Hotel' , ST_TEXTDOMAIN )      => 'st_hotel' ,
                    __( 'Car' , ST_TEXTDOMAIN )        => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )       => 'st_tours' ,
                    __( 'Rental' , ST_TEXTDOMAIN )     => 'st_rental' ,
                    __( 'Activities' , ST_TEXTDOMAIN ) => 'st_activity' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Show Search Box" , ST_TEXTDOMAIN ) ,
                "param_name"       => "show_search_box" ,
                "description"      => "" ,
                'value'            => array(
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name"       => "number" ,
                "value"            => 12 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Zoom" , ST_TEXTDOMAIN ) ,
                "param_name"       => "zoom" ,
                "value"            => 13 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Map Position" , ST_TEXTDOMAIN ) ,
                "param_name"       => "map_position" ,
                "description"      => "Map Position" ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Left' , ST_TEXTDOMAIN )       => "left" ,
                    __( 'Right' , ST_TEXTDOMAIN )      => "right" ,
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Map Height" , ST_TEXTDOMAIN ) ,
                "param_name"       => "auto_height" ,
                "description"      => "" ,
                'value'            => array(
                    __("-- Select -- " , ST_TEXTDOMAIN) => '',
                    __( 'Auto' , ST_TEXTDOMAIN ) => 'auto' ,
                    __( 'Fixed' , ST_TEXTDOMAIN )  => 'fixed' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-12' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Value" , ST_TEXTDOMAIN ) ,
                "param_name"       => "height" ,
                "description"      => "pixels" ,
                "value"            => 500 ,
                'edit_field_class' => 'vc_col-sm-12' ,
                /*'dependency' => array(
                    'element' => 'auto_height',
                    'value' => array( 'auto' )
                ),*/
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Fit Bounds" , ST_TEXTDOMAIN ) ,
                "param_name"       => "fit_bounds" ,
                "description"      => "on|off" ,
                'value'            => array(
                    __( 'Off' , ST_TEXTDOMAIN ) => 'off' ,
                    __( 'On' , ST_TEXTDOMAIN )  => 'on' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-12' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Style Map" , ST_TEXTDOMAIN ) ,
                "param_name"       => "style_map" ,
                "description"      => "" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN )  => '' ,
                    __( 'Normal' , ST_TEXTDOMAIN )      => 'normal' ,
                    __( 'Midnight' , ST_TEXTDOMAIN )    => 'midnight' ,
                    __( 'Family Fest' , ST_TEXTDOMAIN ) => 'family_fest' ,
                    __( 'Open Dark' , ST_TEXTDOMAIN )   => 'open_dark' ,
                    __( 'Riverside' , ST_TEXTDOMAIN )   => 'riverside' ,
                    __( 'Ozan' , ST_TEXTDOMAIN )        => 'ozan' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-12' ,
            ) ,
        )
    ) );
    /*
 * HOTEL
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Hotel" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_hotel" ,
        "content_element" => true ,
        "admin_label"     => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_hotel" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_hotel',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );
    /*
 * RENTAL
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Rental" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_rental" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_rental" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_rental',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );
    /*
* CAR
* */
    vc_map( array(
        "name"            => __( "ST Search Field Car" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_car" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_cars" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_cars',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
* TOUR
* */
    vc_map( array(
        "name"            => __( "ST Search Field Tour" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_tour" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_tours" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_tours',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
* ACTIVITY
* */
    vc_map( array(
        "name"            => __( "ST Search Field Activity" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_activity" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_activity" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_activity',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
 * Range KM
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Range Kilometers" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_half_map_field_range_km" ,
        "content_element" => true ,
        "admin_label"     => true ,
        "as_child"        => array( 'only' => 'st_list_half_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Max Range Kilometers" , ST_TEXTDOMAIN ) ,
                "param_name"  => "max_range_km" ,
                "description" => __( "Kilometer" , ST_TEXTDOMAIN ) ,
                "value"       => 20 ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );

// END LIST HALF MAP---------------------------------------------------------------------------------------------

// ST List Map ---------------------------------------------------------------------------------------------
    vc_map( array(
        "name"                    => __( "ST List Map" , ST_TEXTDOMAIN ) ,
        "base"                    => "st_list_map" ,
        "class"                   => "" ,
        "icon"                    => "icon-st" ,
        "category"                => "Shinetheme" ,
        "content_element"         => true ,
        "show_settings_on_create" => true ,
        "js_view"                 => 'VcColumnView' ,
        "as_parent"               => array(
            'only' => 'st_list_map_field_hotel,st_list_map_field_rental,st_list_map_field_car,st_list_map_field_tour,st_list_map_field_activity,st_list_map_field_range_km' ,
        ) ,
        "params"                  => array(
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name" => "title" ,
                "value"      => '' ,
            ) ,
            array(
                "type"       => "dropdown" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Type" , ST_TEXTDOMAIN ) ,
                "param_name" => "type" ,
                "value"      => array(
                    __( "Normal" , ST_TEXTDOMAIN )      => 'normal' ,
                    __( "Use for Search Result Page" , ST_TEXTDOMAIN ) => 'page_search'
                ) ,
            ) ,
            array(
                "type"        => "st_post_type_location" ,
                "holder"      => "div" ,
                "heading"     => __( "Select Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_list_location" ,
                "description" => "" ,
                "dependency"  =>
                    array(
                        "element" => "type" ,
                        "value"   => "normal"
                    ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Post Type" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_type" ,
                "description"      => "" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Hotel' , ST_TEXTDOMAIN )      => 'st_hotel' ,
                    __( 'Car' , ST_TEXTDOMAIN )        => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )       => 'st_tours' ,
                    __( 'Rental' , ST_TEXTDOMAIN )     => 'st_rental' ,
                    __( 'Activities' , ST_TEXTDOMAIN ) => 'st_activity' ,
                    // __( 'All Post Type' , ST_TEXTDOMAIN ) => 'st_hotel,st_cars,st_tours,st_rental,st_activity' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Show Search Box" , ST_TEXTDOMAIN ) ,
                "param_name"       => "show_search_box" ,
                "description"      => "" ,
                'value'            => array(
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name"       => "number" ,
                "value"            => 12 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Zoom" , ST_TEXTDOMAIN ) ,
                "param_name"       => "zoom" ,
                "value"            => 13 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Fit Bounds" , ST_TEXTDOMAIN ) ,
                "param_name"       => "fit_bounds" ,
                "description"      => "on|off" ,
                'value'            => array(
                    __( 'Off' , ST_TEXTDOMAIN ) => 'off' ,
                    __( 'On' , ST_TEXTDOMAIN )  => 'on' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "class"            => "" ,
                "heading"          => __( "Map Height" , ST_TEXTDOMAIN ) ,
                "param_name"       => "height" ,
                "description"      => "pixels" ,
                "value"            => 500 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Style Map" , ST_TEXTDOMAIN ) ,
                "param_name"       => "style_map" ,
                "description"      => "" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN )  => '' ,
                    __( 'Normal' , ST_TEXTDOMAIN )      => 'normal' ,
                    __( 'Midnight' , ST_TEXTDOMAIN )    => 'midnight' ,
                    __( 'Family Fest' , ST_TEXTDOMAIN ) => 'family_fest' ,
                    __( 'Open Dark' , ST_TEXTDOMAIN )   => 'open_dark' ,
                    __( 'Riverside' , ST_TEXTDOMAIN )   => 'riverside' ,
                    __( 'Ozan' , ST_TEXTDOMAIN )        => 'ozan' ,
                ) ,
                'edit_field_class' => 'vc_col-sm-12 clear' ,
            ) ,
        )
    ) );

    /*
 * HOTEL
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Hotel" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_hotel" ,
        "content_element" => true ,
        "admin_label"     => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_hotel" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_hotel',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );
    /*
 * RENTAL
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Rental" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_rental" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_rental" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_rental',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );
    /*
* CAR
* */
    vc_map( array(
        "name"            => __( "ST Search Field Car" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_car" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_cars" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_cars',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
* TOUR
* */
    vc_map( array(
        "name"            => __( "ST Search Field Tour" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_tour" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_tours" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_tours',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
* ACTIVITY
* */
    vc_map( array(
        "name"            => __( "ST Search Field Activity" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_activity" ,
        "content_element" => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Placeholder" , ST_TEXTDOMAIN ) ,
                "param_name" => "placeholder" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Select field" ,
                "param_name"  => "st_select_field" ,
                "description" => __( "Select field" , ST_TEXTDOMAIN ) ,
                "value"       => TravelHelper::st_get_field_search( "st_activity" ) ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "heading"     => "Select taxonomy" ,
                "param_name"  => "st_select_taxonomy" ,
                "description" => __( "Select taxonomy" , ST_TEXTDOMAIN ) ,
                'stype' => 'list_post_tax',
                'sparam' => 'st_activity',
                'dependency'  => array(
                    'element' => 'st_select_field' ,
                    'value'   => array( 'taxonomy' )
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Field required" ,
                "param_name"  => "is_required" ,
                "description" => __( "Field required" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"off",
                    __("Yes",ST_TEXTDOMAIN)=>"on",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,

        )
    ) );
    /*
 * Range KM
 * */
    vc_map( array(
        "name"            => __( "ST Search Field Range Kilometers" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_map_field_range_km" ,
        "content_element" => true ,
        "admin_label"     => true ,
        "as_child"        => array( 'only' => 'st_list_map' ) ,
        "icon"            => "icon-st" ,
        "params"          => array(
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_title" ,
                "description" => __( "Title field" , ST_TEXTDOMAIN ) ,
            ) ,
            array(
                "type"        => "textfield" ,
                "heading"     => __( "Max Range Kilometers" , ST_TEXTDOMAIN ) ,
                "param_name"  => "max_range_km" ,
                "description" => __( "Kilometer" , ST_TEXTDOMAIN ) ,
                "value"       => 20 ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => "Advance fields" ,
                "param_name"  => "st_advance_field" ,
                "description" => __( "Advance fields" , ST_TEXTDOMAIN ) ,
                "value"       =>  array(
                    __("No",ST_TEXTDOMAIN)=>"no",
                    __("Yes",ST_TEXTDOMAIN)=>"yes",
                ) ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "heading"     => __( "Size Col" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_col" ,
                "description" => __( "Size Col" , ST_TEXTDOMAIN ) ,
                'value'       => array(
                    __( "1 column" , ST_TEXTDOMAIN )   => 'col-md-1' ,
                    __( "2 columns" , ST_TEXTDOMAIN )  => 'col-md-2' ,
                    __( "3 columns" , ST_TEXTDOMAIN )  => 'col-md-3' ,
                    __( "4 columns" , ST_TEXTDOMAIN )  => 'col-md-4' ,
                    __( "5 columns" , ST_TEXTDOMAIN )  => 'col-md-5' ,
                    __( "6 columns" , ST_TEXTDOMAIN )  => 'col-md-6' ,
                    __( "7 columns" , ST_TEXTDOMAIN )  => 'col-md-7' ,
                    __( "8 columns" , ST_TEXTDOMAIN )  => 'col-md-8' ,
                    __( "9 columns" , ST_TEXTDOMAIN )  => 'col-md-9' ,
                    __( "10 columns" , ST_TEXTDOMAIN ) => 'col-md-10' ,
                    __( "11 columns" , ST_TEXTDOMAIN ) => 'col-md-11' ,
                    __( "12 columns" , ST_TEXTDOMAIN ) => 'col-md-12' ,
                ) ,
            ) ,
        )
    ) );
// End ST List Map ---------------------------------------------------------------------------------------------

//------------------------ ST SEarch FOrm --------------------------------------------------
    vc_map( array(
        "name" => __("ST Search Form", ST_TEXTDOMAIN),
        "base" => "st_search_form",
        "as_parent" => array(
            'only' => 'st_search_field_hotel,st_search_field_rental,st_search_field_car,st_search_field_tour,st_search_field_activity',
        ),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        'params'=>array(
            array(
                "type" => "textfield",
                "heading" => __("Title Form", ST_TEXTDOMAIN),
                "param_name" => "st_title_form",
                "description" => __("Title Form",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Post Type", ST_TEXTDOMAIN),
                "param_name" => "st_post_type",
                "value" => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Hotel' , ST_TEXTDOMAIN ) => 'st_hotel' ,
                    __( 'Rental' , ST_TEXTDOMAIN )     => 'st_rental' ,
                    __( 'Car' , ST_TEXTDOMAIN )        => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )       => 'st_tours' ,
                    __( 'Activity' , ST_TEXTDOMAIN )   => 'st_activity' ,
                ) ,
            ),
            array(
                "type" => "textfield",
                "heading" => __("Button search text", ST_TEXTDOMAIN),
                "param_name" => "st_button_search",
                "description" => __("Button search text",ST_TEXTDOMAIN),
                "value"=>__("Search",ST_TEXTDOMAIN),
            ),
        )
    ) );

    /*
 * HOTEL
 * */
    vc_map( array(
        "name" => __("ST Search Field Hotel", ST_TEXTDOMAIN),
        "base" => "st_search_field_hotel",
        "content_element" => true,
        "as_child" => array('only' => 'st_search_form'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" => __("Title field",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" =>"Select field",
                "param_name" => "st_select_field",
                "description" => __("Select field",ST_TEXTDOMAIN),
                "value" =>TravelHelper::st_get_field_search("st_hotel"),
            ),
            array(
                "type" => "st_dropdown",
                "heading" =>"Select taxonomy",
                "param_name" => "st_select_taxonomy",
                "description" => __("Select taxonomy",ST_TEXTDOMAIN),
                'stype' => 'list_post_tax',
                'sparam' => 'st_hotel',
                'dependency' => array(
                    'element' => 'st_select_field',
                    'value' => array( 'taxonomy' )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Size Col", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" => __("Size Col",ST_TEXTDOMAIN),
                'value'=>array(
                    __("1 column",ST_TEXTDOMAIN)=>'col-md-1',
                    __("2 columns",ST_TEXTDOMAIN)=>'col-md-2',
                    __("3 columns",ST_TEXTDOMAIN)=>'col-md-3',
                    __("4 columns",ST_TEXTDOMAIN)=>'col-md-4',
                    __("5 columns",ST_TEXTDOMAIN)=>'col-md-5',
                    __("6 columns",ST_TEXTDOMAIN)=>'col-md-6',
                    __("7 columns",ST_TEXTDOMAIN)=>'col-md-7',
                    __("8 columns",ST_TEXTDOMAIN)=>'col-md-8',
                    __("9 columns",ST_TEXTDOMAIN)=>'col-md-9',
                    __("10 columns",ST_TEXTDOMAIN)=>'col-md-10',
                    __("11 columns",ST_TEXTDOMAIN)=>'col-md-11',
                    __("12 columns",ST_TEXTDOMAIN)=>'col-md-12',
                ),
            ),
        )
    ) );
    /*
 * RENTAL
 * */
    vc_map( array(
        "name" => __("ST Search Field Rental", ST_TEXTDOMAIN),
        "base" => "st_search_field_rental",
        "content_element" => true,
        "as_child" => array('only' => 'st_search_form'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" => __("Title field",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" =>"Select field",
                "param_name" => "st_select_field",
                "description" => __("Select field",ST_TEXTDOMAIN),
                "value" =>TravelHelper::st_get_field_search("st_rental"),
            ),
            array(
                "type" => "st_dropdown",
                "heading" =>"Select taxonomy",
                "param_name" => "st_select_taxonomy",
                "description" => __("Select taxonomy",ST_TEXTDOMAIN),
                'stype' => 'list_post_tax',
                'sparam' => 'st_rental',
                'dependency' => array(
                    'element' => 'st_select_field',
                    'value' => array( 'taxonomy' )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Size Col", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" => __("Size Col",ST_TEXTDOMAIN),
                'value'=>array(
                    __("1 column",ST_TEXTDOMAIN)=>'col-md-1',
                    __("2 columns",ST_TEXTDOMAIN)=>'col-md-2',
                    __("3 columns",ST_TEXTDOMAIN)=>'col-md-3',
                    __("4 columns",ST_TEXTDOMAIN)=>'col-md-4',
                    __("5 columns",ST_TEXTDOMAIN)=>'col-md-5',
                    __("6 columns",ST_TEXTDOMAIN)=>'col-md-6',
                    __("7 columns",ST_TEXTDOMAIN)=>'col-md-7',
                    __("8 columns",ST_TEXTDOMAIN)=>'col-md-8',
                    __("9 columns",ST_TEXTDOMAIN)=>'col-md-9',
                    __("10 columns",ST_TEXTDOMAIN)=>'col-md-10',
                    __("11 columns",ST_TEXTDOMAIN)=>'col-md-11',
                    __("12 columns",ST_TEXTDOMAIN)=>'col-md-12',
                ),
            ),
        )
    ) );
    /*
* CAR
* */
    vc_map( array(
        "name" => __("ST Search Field Car", ST_TEXTDOMAIN),
        "base" => "st_search_field_car",
        "content_element" => true,
        "as_child" => array('only' => 'st_search_form'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" => __("Title field",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" =>"Select field",
                "param_name" => "st_select_field",
                "description" => __("Select field",ST_TEXTDOMAIN),
                "value" =>TravelHelper::st_get_field_search("st_cars"),
            ),
            array(
                "type" => "st_dropdown",
                "heading" =>"Select taxonomy",
                "param_name" => "st_select_taxonomy",
                "description" => __("Select taxonomy",ST_TEXTDOMAIN),
                'stype' => 'list_post_tax',
                'sparam' => 'st_cars',
                'dependency' => array(
                    'element' => 'st_select_field',
                    'value' => array( 'taxonomy' )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Size Col", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" => __("Size Col",ST_TEXTDOMAIN),
                'value'=>array(
                    __("1 column",ST_TEXTDOMAIN)=>'col-md-1',
                    __("2 columns",ST_TEXTDOMAIN)=>'col-md-2',
                    __("3 columns",ST_TEXTDOMAIN)=>'col-md-3',
                    __("4 columns",ST_TEXTDOMAIN)=>'col-md-4',
                    __("5 columns",ST_TEXTDOMAIN)=>'col-md-5',
                    __("6 columns",ST_TEXTDOMAIN)=>'col-md-6',
                    __("7 columns",ST_TEXTDOMAIN)=>'col-md-7',
                    __("8 columns",ST_TEXTDOMAIN)=>'col-md-8',
                    __("9 columns",ST_TEXTDOMAIN)=>'col-md-9',
                    __("10 columns",ST_TEXTDOMAIN)=>'col-md-10',
                    __("11 columns",ST_TEXTDOMAIN)=>'col-md-11',
                    __("12 columns",ST_TEXTDOMAIN)=>'col-md-12',
                ),
            ),

        )
    ) );
    /*
* TOUR
* */
    vc_map( array(
        "name" => __("ST Search Field Tour", ST_TEXTDOMAIN),
        "base" => "st_search_field_tour",
        "content_element" => true,
        "as_child" => array('only' => 'st_search_form'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" => __("Title field",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" =>"Select field",
                "param_name" => "st_select_field",
                "description" => __("Select field",ST_TEXTDOMAIN),
                "value" =>TravelHelper::st_get_field_search("st_tours"),
            ),
            array(
                "type" => "st_dropdown",
                "heading" =>"Select taxonomy",
                "param_name" => "st_select_taxonomy",
                "description" => __("Select taxonomy",ST_TEXTDOMAIN),
                'stype' => 'list_post_tax',
                'sparam' => 'st_tours',
                'dependency' => array(
                    'element' => 'st_select_field',
                    'value' => array( 'taxonomy' )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Size Col", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" => __("Size Col",ST_TEXTDOMAIN),
                'value'=>array(
                    __("1 column",ST_TEXTDOMAIN)=>'col-md-1',
                    __("2 columns",ST_TEXTDOMAIN)=>'col-md-2',
                    __("3 columns",ST_TEXTDOMAIN)=>'col-md-3',
                    __("4 columns",ST_TEXTDOMAIN)=>'col-md-4',
                    __("5 columns",ST_TEXTDOMAIN)=>'col-md-5',
                    __("6 columns",ST_TEXTDOMAIN)=>'col-md-6',
                    __("7 columns",ST_TEXTDOMAIN)=>'col-md-7',
                    __("8 columns",ST_TEXTDOMAIN)=>'col-md-8',
                    __("9 columns",ST_TEXTDOMAIN)=>'col-md-9',
                    __("10 columns",ST_TEXTDOMAIN)=>'col-md-10',
                    __("11 columns",ST_TEXTDOMAIN)=>'col-md-11',
                    __("12 columns",ST_TEXTDOMAIN)=>'col-md-12',
                ),
            ),

        )
    ) );
    /*
* ACTIVITY
* */
    vc_map( array(
        "name" => __("ST Search Field Activity", ST_TEXTDOMAIN),
        "base" => "st_search_field_activity",
        "content_element" => true,
        "as_child" => array('only' => 'st_search_form'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", ST_TEXTDOMAIN),
                "param_name" => "st_title",
                "description" => __("Title field",ST_TEXTDOMAIN),
            ),
            array(
                "type" => "dropdown",
                "heading" =>"Select field",
                "param_name" => "st_select_field",
                "description" => __("Select field",ST_TEXTDOMAIN),
                "value" =>TravelHelper::st_get_field_search("st_activity"),
            ),
            array(
                "type" => "st_dropdown",
                "heading" =>"Select taxonomy",
                "param_name" => "st_select_taxonomy",
                "description" => __("Select taxonomy",ST_TEXTDOMAIN),
                'stype' => 'list_post_tax',
                'sparam' => 'st_activity',
                'dependency' => array(
                    'element' => 'st_select_field',
                    'value' => array( 'taxonomy' )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Size Col", ST_TEXTDOMAIN),
                "param_name" => "st_col",
                "description" => __("Size Col",ST_TEXTDOMAIN),
                'value'=>array(
                    __("1 column",ST_TEXTDOMAIN)=>'col-md-1',
                    __("2 columns",ST_TEXTDOMAIN)=>'col-md-2',
                    __("3 columns",ST_TEXTDOMAIN)=>'col-md-3',
                    __("4 columns",ST_TEXTDOMAIN)=>'col-md-4',
                    __("5 columns",ST_TEXTDOMAIN)=>'col-md-5',
                    __("6 columns",ST_TEXTDOMAIN)=>'col-md-6',
                    __("7 columns",ST_TEXTDOMAIN)=>'col-md-7',
                    __("8 columns",ST_TEXTDOMAIN)=>'col-md-8',
                    __("9 columns",ST_TEXTDOMAIN)=>'col-md-9',
                    __("10 columns",ST_TEXTDOMAIN)=>'col-md-10',
                    __("11 columns",ST_TEXTDOMAIN)=>'col-md-11',
                    __("12 columns",ST_TEXTDOMAIN)=>'col-md-12',
                ),
            ),

        )
    ) );
//------------------------ End ST SEarch FOrm --------------------------------------------------


// Activity
    if(st_check_service_available( 'st_activity' )){
        vc_map( array(
            "name"            => __( "ST Sum of Activity Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_activity_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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
        vc_map( array(
            "name"            => __( "ST Activity Detail Attribute" , ST_TEXTDOMAIN ) ,
            "base"            => "st_activity_detail_attribute" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
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
                array(
                    "type"        => "st_dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_activity',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Item Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "item_col" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        2                                  => 2 ,
                        3                                  => 3 ,
                        4                                  => 4 ,
                        5                                  => 5 ,
                        6                                  => 6 ,
                        7                                  => 7 ,
                        8                                  => 8 ,
                        9                                  => 9 ,
                        10                                 => 10 ,
                        11                                 => 11 ,
                        12                                 => 12 ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Activity Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_activiry_content_search" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_activity',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Activity Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_activiry_content_search_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_activity',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Detailed Activity Gallery" , ST_TEXTDOMAIN ) ,
            "base"            => "st_activity_detail_photo" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Slide' , ST_TEXTDOMAIN )      => 'slide' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                    ) ,
                )
            )
        ) );

        $params  = array(

            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "List IDs of Activity (Optional)" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                'admin_label' => true,
                "heading"          => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_number" ,
                "description"      => "" ,
                'value'            => 4 ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-3' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                    array(
                        __( 'Price' , ST_TEXTDOMAIN )         => 'sale' ,
                        __( 'Rate' , ST_TEXTDOMAIN )          => 'rate' ,
                        __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                        /*__( 'Discount rate' , ST_TEXTDOMAIN ) => 'discount'*/
                    )
                ) : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-3' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Item per row" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_of_row" ,
                'edit_field_class' => 'vc_col-sm-3' ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'One' , ST_TEXTDOMAIN ) => '1' ,
                    __( 'Four' , ST_TEXTDOMAIN )       => '4' ,
                    __( 'Three' , ST_TEXTDOMAIN )      => '3' ,
                    __( 'Two' , ST_TEXTDOMAIN )        => '2' ,
                ) ,
            ) ,
            array(
                "type"       => "dropdown" ,
                'admin_label' => true,
                "heading"    => __( "Only in Featured Location" , ST_TEXTDOMAIN ) ,
                "param_name" => "only_featured_location" ,
                "value"      => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'No' , ST_TEXTDOMAIN )         => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN )        => 'yes' ,
                ) ,
            ) ,
            array(
                "type"        => "st_list_location" ,
                'admin_label' => true,
                "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_location" ,
                "description" => __( "Location" , ST_TEXTDOMAIN ) ,
                "dependency"  =>
                    array(
                        "element" => "only_featured_location" ,
                        "value"   => "no"
                    ) ,
            ) ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_activity');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $params[] = array(
                    'type' => 'st_checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'stype' => 'list_terms',
                    'sparam' => $name,
                );
            }
        }

        vc_map( array(
            "name"            => __( "ST List of Activities" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_activity" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );

        $params  = array(
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"       => "title" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
                "param_name"       => "posts_per_page" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
                "param_name"  => "sort_taxonomy" ,
                "description" => "" ,
                'stype' => 'list_tax',
                'sparam' => 'st_activity',
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
        );
        $data_vc = STActivity::get_taxonomy_and_id_term_tour();
        $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
        vc_map( array(
            "name"            => __( "ST List activity related" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_activity_related" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );


        vc_map(
            array(
                "name" => __("ST Location list activity ", ST_TEXTDOMAIN),
                "base" => "st_location_list_activity",
                "content_element" => true,
                "icon" => "icon-st",
                "category"=>"Shinetheme",
                "params"    =>$location_list_params
            ));
    }
// End Activity


// ST CARS
    if(st_check_service_available('st_cars'))
    {
        vc_map( array(
            "name"            => __( "ST Cars Attribute" , ST_TEXTDOMAIN ) ,
            "base"            => "st_cars_attribute" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
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
                array(
                    "type"        => "st_dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_cars',
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Cars Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_cars_content_search" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Cars Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_cars_content_search_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ),
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Sum of Cars Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_cars_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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
        vc_map( array(
            "name"            => __( "ST Detailed Car Gallery" , ST_TEXTDOMAIN ) ,
            "base"            => "st_car_detail_photo" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Slide' , ST_TEXTDOMAIN )      => 'slide' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Cars Price " , ST_TEXTDOMAIN ) ,
            "base"            => "st_cars_price" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN )     => '' ,
                        __( 'Style 1 column' , ST_TEXTDOMAIN ) => '1' ,
                        __( 'Style 2 column' , ST_TEXTDOMAIN ) => '2'
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name" => __("ST Cruise Photo", ST_TEXTDOMAIN),
            "base" => "st_cruise_photo",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>'Shinetheme',
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

        $param = array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "List ID in Car" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "Number cars" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_number_cars" ,
                "description" => "" ,
                'value'       => 4 ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                    array(
                        __( 'Sale' , ST_TEXTDOMAIN )     => 'sale' ,
                        __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                    )
                ) : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Items per row" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_cars_of_row" ,
                'edit_field_class' => 'vc_col-sm-12' ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Four' , ST_TEXTDOMAIN )       => 4 ,
                    __( 'Three' , ST_TEXTDOMAIN )      => 3 ,
                    __( 'Two' , ST_TEXTDOMAIN )        => 2 ,
                ) ,
            ) ,
            array(
                "type"        => "st_list_location" ,
                'admin_label' => true,
                "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_location" ,
                "description" => __( "Location" , ST_TEXTDOMAIN )
            ) ,

        );

        $list_tax = TravelHelper::get_object_taxonomies_service('st_cars');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $param[] = array(
                    'type' => 'st_checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'stype' => 'list_terms',
                    'sparam' => $name,
                );
            }
        }

        vc_map( array(
            "name"            => __( "ST List of Cars" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_cars" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $param
        ) );

        $params  = array(
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
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
                "param_name"       => "posts_per_page" ,
                "description"      => "" ,
                "value"            => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
                "param_name"  => "sort_taxonomy" ,
                "description" => "" ,
                'stype' => 'list_tax',
                'sparam' => 'st_cars',
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
        );
        $data_vc = STCars::get_taxonomy_and_id_term_tour();
        $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
        vc_map( array(
            "name"            => __( "ST List cars related" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_car_related" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );


        vc_map(
            array(
                "name" => __("ST Location list car ", ST_TEXTDOMAIN),
                "base" => "st_location_list_car",
                "content_element" => true,
                "icon" => "icon-st",
                "category"=>"Shinetheme",
                "params"    =>$location_list_params
            ));


        vc_map( array(
            "name"            => __( "ST Car Transfer Search Result" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_car_transfer_result" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                )
            )
        ) );
    }
// End ST CARS


// ST Hotel
    if(st_check_service_available('st_hotel'))
    {
        vc_map( array(
            "name"            => __( "ST Hotel Detail Attribute" , ST_TEXTDOMAIN ) ,
            "base"            => "st_hotel_detail_attribute" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
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
                array(
                    "type"        => "st_dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_hotel',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Item Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "item_col" ,
                    "description" => "" ,
                    "value"       => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        2  => 2 ,
                        3  => 3 ,
                        4  => 4 ,
                        5  => 5 ,
                        6  => 6 ,
                        7  => 7 ,
                        8  => 8 ,
                        9  => 9 ,
                        10 => 10 ,
                        11 => 11 ,
                        12 => 12 ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Hotel Search Result" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_result" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_hotel',
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Hotel Search Result" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_result_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_hotel',
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Sum of Hotel Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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
        vc_map( array(
            "name"            => __( "ST Hotel List Room" , ST_TEXTDOMAIN ) ,
            "base"            => "st_hotel_list_room" ,
            "content_element" => true ,
            "category"        => "Shinetheme" ,
            "icon"            => "icon-st" ,
            "params"          => array(
                array(
                    "type"       => "dropdown" ,
                    "heading"    => __( "Rows" , ST_TEXTDOMAIN ) ,
                    "param_name" => "st_rows" ,
                    "value"      => array(
                        __( "--Select--" , ST_TEXTDOMAIN ) => "" ,
                        __( "1" , ST_TEXTDOMAIN )          => "1" ,
                        __( "2" , ST_TEXTDOMAIN )          => "2" ,
                        __( "3" , ST_TEXTDOMAIN )          => "3" ,
                        __( "4" , ST_TEXTDOMAIN )          => "4" ,
                        __( "5" , ST_TEXTDOMAIN )          => "5" ,
                        __( "6" , ST_TEXTDOMAIN )          => "6" ,
                    )
                ) ,
                array(
                    "type"       => "dropdown" ,
                    "heading"    => __( "Items in a row" , ST_TEXTDOMAIN ) ,
                    "param_name" => "st_items_in_row" ,
                    "value"      => array(
                        __( "--Select--" , ST_TEXTDOMAIN ) => "" ,
                        __( "1" , ST_TEXTDOMAIN )          => "1" ,
                        __( "2" , ST_TEXTDOMAIN )          => "2" ,
                        __( "3" , ST_TEXTDOMAIN )          => "3" ,
                        __( "4" , ST_TEXTDOMAIN )          => "4" ,
                        __( "6" , ST_TEXTDOMAIN )          => "6" ,
                    )
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "heading"     => __( "Show Title" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "is_title" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "--Select--" , ST_TEXTDOMAIN ) => "" ,
                        __( "Yes" , ST_TEXTDOMAIN )        => "yes" ,
                        __( "No" , ST_TEXTDOMAIN )         => "no" ,
                    )
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "heading"     => __( "Show Price" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "is_price" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "--Select--" , ST_TEXTDOMAIN ) => "" ,
                        __( "Yes" , ST_TEXTDOMAIN )        => "yes" ,
                        __( "No" , ST_TEXTDOMAIN )         => "no" ,
                    )
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "heading"     => __( "Show Facilities" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "is_facilities" ,
                    "description" => "" ,
                    "value"       => array(
                        __( "--Select--" , ST_TEXTDOMAIN ) => "" ,
                        __( "Yes" , ST_TEXTDOMAIN )        => "yes" ,
                        __( "No" , ST_TEXTDOMAIN )         => "no" ,
                    )
                ) ,

            )
        ) );
        vc_map( array(
            "name"            => __( "ST Detailed Hotel Gallery" , ST_TEXTDOMAIN ) ,
            "base"            => "st_hotel_detail_photo" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Slide' , ST_TEXTDOMAIN )      => 'slide' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Hotel Room Search Result" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_room_result" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'hotel_room',
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Hotel Room Search Result" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_room_result_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'hotel_room',
                ) ,
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Sum of Hotel Room Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_hotel_room_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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

        $params = array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "List ID in Hotel" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "Number hotel" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_number_ht" ,
                "description" => "" ,
                'value'       => 4 ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                    array(
                        __( 'Sale' , ST_TEXTDOMAIN )          => 'sale' ,
                        __( 'Rate' , ST_TEXTDOMAIN )          => 'rate' ,
                        __( 'Discount rate' , ST_TEXTDOMAIN ) => 'discount',
                        __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                    )
                ) : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                'admin_label' => true,
                "heading"     => __( "Style hotel" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_style_ht" ,
                "description" => "" ,
                'value'       => array(
                    __( '--Select--' , ST_TEXTDOMAIN )          => '' ,
                    __( 'Hot Deals' , ST_TEXTDOMAIN )           => 'hot-deals' ,
                    __( 'Grid' , ST_TEXTDOMAIN )                => 'grid' ,
                    __( 'Grid Style 2' , ST_TEXTDOMAIN )        => 'grid2' ,
                ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Items per row" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_ht_of_row" ,
                'edit_field_class' => 'vc_col-sm-12' ,
                "description"      => __( 'Noticed: the field "Items per row" only applicable to "Last Minute Deal" style' , ST_TEXTDOMAIN ) ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Four' , ST_TEXTDOMAIN )       => 4 ,
                    __( 'Three' , ST_TEXTDOMAIN )      => 3 ,
                    __( 'Two' , ST_TEXTDOMAIN )        => 2 ,
                ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Only in Featured Location" , ST_TEXTDOMAIN ) ,
                "param_name"       => "only_featured_location" ,
                'edit_field_class' => 'vc_col-sm-12' ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'No' , ST_TEXTDOMAIN )         => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN )        => 'yes' ,
                ) ,
            ) ,
            array(
                "type"        => "st_list_location" ,
                'admin_label' => true,
                "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_location" ,
                "description" => __( "Location" , ST_TEXTDOMAIN ) ,
                "dependency"  =>
                    array(
                        "element" => "only_featured_location" ,
                        "value"   => "no"
                    ) ,
            ) ,
        );

        $list_tax = TravelHelper::get_object_taxonomies_service('st_hotel');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $params[] = array(
                    'type' => 'st_checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'stype' => 'list_terms',
                    'sparam' => $name,
                );
            }
        }
        vc_map( array(
            "name"            => __( "ST List of Hotels" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_hotel" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );

        $params  = array(
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"       => "title" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "List ID in hotel" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
                "param_name"       => "posts_per_page" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
                "param_name"  => "sort_taxonomy" ,
                "description" => "" ,
                'stype' => 'list_tax',
                'sparam' => 'st_hotel',
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
        );
        $data_vc = STHotel::get_taxonomy_and_id_term_tour();
        $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
        vc_map( array(
            "name"            => __( "ST List hotel related" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_hotel_related" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );

        vc_map(
            array(
                "name" => __("ST Location list hotel ", ST_TEXTDOMAIN),
                "base" => "st_location_list_hotel",
                "content_element" => true,
                "icon" => "icon-st",
                "category"=>"Shinetheme",
                "params"    =>$location_list_params
            ));

    }
// End ST_HOtel

// ST REntal
    if(st_check_service_available('st_rental'))
    {
        vc_map( array(
            "name"            => __( "ST Rental Attribute" , ST_TEXTDOMAIN ) ,
            "base"            => "st_rental_attribute" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
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
                array(
                    "type"        => "st_dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_rental',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Item Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "item_col" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        2                                  => 2 ,
                        3                                  => 3 ,
                        4                                  => 4 ,
                        5                                  => 5 ,
                        6                                  => 6 ,
                        7                                  => 7 ,
                        8                                  => 8 ,
                        9                                  => 9 ,
                        10                                 => 10 ,
                        11                                 => 11 ,
                        12                                 => 12 ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Rental Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_rental_result" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                        __( 'List' , ST_TEXTDOMAIN )       => 'list' ,
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_rental',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Rental Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_rental_result_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                        __( 'List' , ST_TEXTDOMAIN )       => 'list' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_rental',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Rental Distance" , ST_TEXTDOMAIN ) ,
            "base"            => "st_rental_distance" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
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
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Item Size" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "item_col" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        2                                  => 2 ,
                        3                                  => 3 ,
                        4                                  => 4 ,
                        5                                  => 5 ,
                        6                                  => 6 ,
                        7                                  => 7 ,
                        8                                  => 8 ,
                        9                                  => 9 ,
                        10                                 => 10 ,
                        11                                 => 11 ,
                        12                                 => 12 ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Sum of Rental Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_rental_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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
        vc_map( array(
            "name"            => __( "ST Rental Photo" , ST_TEXTDOMAIN ) ,
            "base"            => "st_rental_photo" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Slide' , ST_TEXTDOMAIN )      => 'slide' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                    ) ,
                )
            )
        ) );


        $param = array(
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "List ID in Rental" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name"  => "number" ,
                "description" => "" ,
                'value'       => 4 ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                    array(
                        __( 'Sale' , ST_TEXTDOMAIN )     => 'sale' ,
                        __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                    )
                ) : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Asc' , ST_TEXTDOMAIN )        => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN )       => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Number of rows" , ST_TEXTDOMAIN ) ,
                "param_name"       => "number_of_row" ,
                'edit_field_class' => 'vc_col-sm-12' ,
                "value"            => array(
                    __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                    __( 'Four' , ST_TEXTDOMAIN )       => '4' ,
                    __( 'Three' , ST_TEXTDOMAIN )      => '3' ,
                    __( 'Two' , ST_TEXTDOMAIN )        => '2' ,
                ) ,
            ) ,
            array(
                "type"        => "st_list_location" ,
                'admin_label' => true,
                "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_location" ,
                "description" => __( "Location" , ST_TEXTDOMAIN ) ,
            ) ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_rental');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $param[] = array(
                    'type' => 'st_checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'stype' => 'list_terms',
                    'sparam' => $name,
                );
            }
        }

        vc_map( array(
            "name"            => __( "ST List of Rentals" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_rental" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $param
        ) );

        $params  = array(
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"       => "title" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
                "param_name"       => "posts_per_page" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
                "param_name"  => "sort_taxonomy" ,
                "description" => "" ,
                'stype' => 'list_tax',
                'sparam' => 'st_rental',
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
        );
        $data_vc = STRental::get_taxonomy_and_id_term_tour();
        $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
        vc_map( array(
            "name"            => __( "ST List Rental related" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_rental_related" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );


        vc_map(
        array(
            "name" => __("ST Location list rental ", ST_TEXTDOMAIN),
            "base" => "st_location_list_rental",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>"Shinetheme",
            "params"    =>$location_list_params
        ));
    }
// End ST Rental

// Tours
    if(st_check_service_available('st_tours'))
    {
        vc_map( array(
            "name"            => __( "ST Tour Detail Attribute" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_detail_attribute" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
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
                array(
                    "type"        => "st_dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_tours',
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Item col" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "item_col" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        12                                 => 12 ,
                        11                                 => 11 ,
                        10                                 => 10 ,
                        9                                  => 9 ,
                        8                                  => 8 ,
                        7                                  => 7 ,
                        6                                  => 6 ,
                        5                                  => 5 ,
                        4                                  => 4 ,
                        3                                  => 3 ,
                        2                                  => 2 ,

                    ) ,
                )
            )
        ) );
        vc_map(array(
            "name"            => __( "ST Tour Cards Accepted" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_card_accepted" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
        ));
        vc_map( array(
            "name"            => __( "ST Tour Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_content_search" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_tours',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "[Ajax] ST Tour Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_content_search_ajax" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'List' , ST_TEXTDOMAIN )       => '1' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => '2' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "OrderBy Default" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_orderby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '---None---' , ST_TEXTDOMAIN ) => '-1' ,
                        __( 'New' , ST_TEXTDOMAIN ) => 'new' ,
                        __( 'Random' , ST_TEXTDOMAIN )       => 'random' ,
                        __( 'Price' , ST_TEXTDOMAIN )       => 'price' ,
                        __( 'Featured' , ST_TEXTDOMAIN )       => 'featured' ,
                        __( 'Name' , ST_TEXTDOMAIN )       => 'name' ,
                    ) ,
                ) ,
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Sort By" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "st_sortby" ,
                    "description" => "" ,
                    "value"       => array(
                        __( 'Ascending' , ST_TEXTDOMAIN ) => 'asc' ,
                        __( 'Descending' , ST_TEXTDOMAIN )       => 'desc'
                    ) ,
                ) ,
                array(
                    "type"        => "st_checkbox" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Select Taxonomy Show" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "taxonomy" ,
                    "description" => "" ,
                    'stype' => 'list_tax',
                    'sparam' => 'st_tours',
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Sum of Tour Search Results" , ST_TEXTDOMAIN ) ,
            "base"            => "st_search_tour_title" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
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
                ),
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Is Ajax" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "is_ajax" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Yes' , ST_TEXTDOMAIN )      => '1' ,
                        __( 'No' , ST_TEXTDOMAIN )       => '0' ,
                    ) ,
                )
            )
        ) );
        vc_map( array(
            "name"            => __( "ST Detailed Tour Gallery" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_detail_photo" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
            "params"          => array(
                array(
                    "type"        => "dropdown" ,
                    "holder"      => "div" ,
                    "heading"     => __( "Style" , ST_TEXTDOMAIN ) ,
                    "param_name"  => "style" ,
                    "description" => "" ,
                    "value"       => array(
                        __( '--Select--' , ST_TEXTDOMAIN ) => '' ,
                        __( 'Slide' , ST_TEXTDOMAIN )      => 'slide' ,
                        __( 'Grid' , ST_TEXTDOMAIN )       => 'grid' ,
                    ) ,
                )
            )
        ) );
        vc_map(array(
            "name"            => __( "ST Tour Rewards" , ST_TEXTDOMAIN ) ,
            "base"            => "st_tour_rewards" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme' ,
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

        $params  = array(
            array(
                "type"             => "textfield" ,
                'admin_label' => true,
                "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"       => "title" ,
                "description"      => "" ,
                "value"            => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
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
            ) ,
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                'admin_label' => true,
                "heading"     => __( "Number tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_number_tour" ,
                "description" => "" ,
                'value'       => 4 ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                    array(
                        __( 'Price' , ST_TEXTDOMAIN )            => 'sale' ,
                        __( 'Rate' , ST_TEXTDOMAIN )             => 'rate' ,
                        __( 'Featured' , ST_TEXTDOMAIN ) => 'featured' ,
                        /*__( 'Discount rate' , ST_TEXTDOMAIN )    => 'discount' ,*/
                        //__( 'Last Minute Deal' , ST_TEXTDOMAIN ) => 'last_minute_deal' ,
                    )
                ) : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
            array(
                "type"        => "dropdown" ,
                'admin_label' => true,
                "heading"     => __( "Style Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_style" ,
                "description" => "" ,
                'value'       => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Style 1' , ST_TEXTDOMAIN ) => 'style_1' ,
                    __( 'Style 2' , ST_TEXTDOMAIN ) => 'style_2' ,
                    __( 'Style 3' , ST_TEXTDOMAIN ) => 'style_3' ,
                    __( 'Style 4' , ST_TEXTDOMAIN ) => 'style_4' ,
                ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Items per row" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_tour_of_row" ,
                'edit_field_class' => 'vc_col-sm-12' ,
                "description"=>__("only for style 1 , style 2 , style 3",ST_TEXTDOMAIN),
                "value"            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Four' , ST_TEXTDOMAIN )  => '4' ,
                    __( 'Three' , ST_TEXTDOMAIN ) => '3' ,
                    __( 'Two' , ST_TEXTDOMAIN )   => '2' ,
                ) ,
            ) ,
            array(
                "type"             => "dropdown" ,
                'admin_label' => true,
                "heading"          => __( "Only in Featured Location" , ST_TEXTDOMAIN ) ,
                "param_name"       => "only_featured_location" ,
                "value"            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                ) ,
            ) ,
            array(
                "type"        => "st_list_location" ,
                'admin_label' => true,
                "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_location" ,
                "description" => __( "Location" , ST_TEXTDOMAIN ) ,
                "dependency"    =>
                    array(
                        "element"   => "only_featured_location",
                        "value"     => "no"
                    ),
            ) ,
        );
        $list_tax = TravelHelper::get_object_taxonomies_service('st_tours');
        if( !empty( $list_tax ) ){
            foreach( $list_tax as $name => $label ){
                $params[] = array(
                    'type' => 'st_checkbox',
                    'heading' => $label,
                    'param_name' => 'taxonomies'.'--'.$name,
                    'stype' => 'list_terms',
                    'sparam' => $name,
                );
            }
        }

        vc_map( array(
            "name"            => __( "ST List Tour" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_tour" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );

        $params  = array(
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name"       => "title" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_ids" ,
                "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
                'value'       => "" ,
            ) ,
            array(
                "type"             => "textfield" ,
                "holder"           => "div" ,
                "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
                "param_name"       => "posts_per_page" ,
                "description"      => "" ,
                "value"            => "" ,
            ) ,
            array(
                "type"        => "st_dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
                "param_name"  => "sort_taxonomy" ,
                "description" => "" ,
                'stype' => 'list_tax',
                'sparam' => 'st_tours',
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_orderby" ,
                "description"      => "" ,
                'edit_field_class' => 'vc_col-sm-6' ,
                'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
            ) ,
            array(
                "type"             => "dropdown" ,
                "holder"           => "div" ,
                "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
                "param_name"       => "st_order" ,
                'value'            => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                    __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
                ) ,
                'edit_field_class' => 'vc_col-sm-6' ,
            ) ,
        );
        $data_vc = STTour::get_taxonomy_and_id_term_tour();
        $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
        vc_map( array(
            "name"            => __( "ST List Tour related" , ST_TEXTDOMAIN ) ,
            "base"            => "st_list_tour_related" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            "params"          => $params
        ) );


        vc_map(
            array(
                "name" => __("ST Location list tour ", ST_TEXTDOMAIN),
                "base" => "st_location_list_tour",
                "content_element" => true,
                "icon" => "icon-st",
                "category"=>"Shinetheme",
                "params"    =>$location_list_params
            )
        );


        vc_map(array(
            "name"            => __( "ST Tours Header" , ST_TEXTDOMAIN ) ,
            "base"            => "st_header" ,
            "icon"            => "icon-st" ,
            "category"        => 'Shinetheme',
            'params'    => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Heading size", ST_TEXTDOMAIN),
                    "param_name" => "heading_size",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('1',ST_TEXTDOMAIN)=>'1',
                        __('2',ST_TEXTDOMAIN)=>'2',
                        __('3',ST_TEXTDOMAIN)=>'3',
                        __('4',ST_TEXTDOMAIN)=>'4',
                        __('5',ST_TEXTDOMAIN)=>'5',
                        __('6',ST_TEXTDOMAIN)=>'6',
                    ),
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Font Weight", ST_TEXTDOMAIN),
                    "param_name" => "font_weight",
                    "description" =>"Example: bold<br> <a href='http://www.w3schools.com/cssref/pr_font_weight.asp'>Read More</a>",
                ),
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
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Extra Class", ST_TEXTDOMAIN),
                    "param_name" => "extra_class",
                    "description" =>__("Class for each patch",ST_TEXTDOMAIN),
                ),
            ),
        ));
    }
// End Tours

    if(st_check_service_available('st_rental') and st_check_service_available('hotel_room'))
    {
        vc_map( array(
            "name"            => __( "ST Custom Discount List" , ST_TEXTDOMAIN ) ,
            "base"            => "st_custom_discount_list" ,
            "content_element" => true ,
            "icon"            => "icon-st" ,
            "category"        => "Shinetheme" ,
            'show_settings_on_create' => false,
            'params'=>array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('There is no option in this element', ST_TEXTDOMAIN),
                    'param_name' => 'description_field',
                    'edit_field_class' => 'vc_column vc_col-sm-12 st_vc_hidden_input'
                )
            )
        ) );
    }


    vc_map(array(
        "name" => __("[Singel Hotel] Table Membership", ST_TEXTDOMAIN),
        "base" => "st_single_hotel_table",
        "icon" => "icon-st",
        "content_element" => true,
        "category" => "Shinetheme",
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Icon", ST_TEXTDOMAIN),
                "param_name" => "st_images_icon",
                "description" => "",
            ),
            array(
                'param_name'    => 'id_package',
                'type'          => 'dropdown',
                'value'         => st_get_packpage(), // here I'm stuck
                'heading'       => __('Choose package', ST_TEXTDOMAIN),
                'description'   => '',
                'holder'        => 'div',
            ),
            array(
                'param_name'    => 'sale_member',
                'type'          => 'textfield',
                'value'         => '', // here I'm stuck
                'heading'       => __('Enter number sale', ST_TEXTDOMAIN),
                'description'   => '',
                'holder'        => 'div',
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Support', ST_TEXTDOMAIN),
                'param_name' => 'list_support',
                'value' => '',
                'params' => array(
                    array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => __( "Support", ST_TEXTDOMAIN ),
                    "param_name" => "check",
                    "value" => __( "", ST_TEXTDOMAIN ),
                    "description" => __( "Enter description.", ST_TEXTDOMAIN )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Title item", ST_TEXTDOMAIN),
                        "param_name" => "title_items",
                        "description" => "",
                    ),
                ),
            )
        )
    ));


    vc_map(array(
        'name' => __('ST Title and content', ST_TEXTDOMAIN),
        'base' => 'st_title_line',
        'content_element' => true,
        'icon' => 'icon-st',
        "category" => "Shinetheme",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title text', ST_TEXTDOMAIN),
                'param_name' => 'header_title',
                'value' => __('Title text', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Content', ST_TEXTDOMAIN),
                'param_name' => 'content',
                'value' => ''
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Layout default", ST_TEXTDOMAIN),
                "param_name" => "layout_title",
                "value" => array(
                    __('Default', ST_TEXTDOMAIN) => 'st_default',
                    __('Center', ST_TEXTDOMAIN) => 'st_center',
                ),
                'std' => 'st_center'
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Style layout", ST_TEXTDOMAIN),
                "param_name" => "style_layout",
                "value" => array(
                    __('Title and line', ST_TEXTDOMAIN) => 'style-1',
                    __('Line and title', ST_TEXTDOMAIN) => 'style-2',
                    __('No line', ST_TEXTDOMAIN) => 'style-3',
                    __('Title line style 2', ST_TEXTDOMAIN) => 'style-4',
                    __('With icon', ST_TEXTDOMAIN) => 'style-5',
                ),
                'std' => 'style-1'
            ),
        )
    ));

    vc_map(array(
        'name' => __('ST Language & Currency', ST_TEXTDOMAIN),
        'base' => 'st_language_currency_new',
        'icon' => 'icon-st',
        'category' => 'Modern Layout',
        'params' => array(

        )
    ));
       
}
