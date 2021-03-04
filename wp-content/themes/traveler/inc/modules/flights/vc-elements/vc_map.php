<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/30/2018
 * Time: 2:44 PM
 */
add_action( 'vc_before_init', 'st_map_flights_shortcodes' );

function st_map_flights_shortcodes()
{

    vc_map(array(
        'name' => esc_html__('ST Flight Destinations', ST_TEXTDOMAIN),
        'base' => 'st_flight_destinations',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                "type" => "st_post_type_location",
                "heading" => __("List IDs in Location", ST_TEXTDOMAIN),
                "param_name" => "st_ids",
                "description" =>__("Ids separated by commas",ST_TEXTDOMAIN),
                'value'=>"",
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'column',
                'admin_label' => true,
                'heading' => esc_html__('No Of Columns', ST_TEXTDOMAIN),
                'description' => esc_html__('Choose column to display element', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('3 columns', ST_TEXTDOMAIN) => 'col-md-4',
                    esc_html__('4 columns', ST_TEXTDOMAIN) => 'col-md-3'
                ),
                'std' => 'col-md-3'
            )
        )
    ));
    vc_map(array(
        "name" => esc_html__("ST Flight Search Filter", ST_TEXTDOMAIN),
        "base" => "st_flight_search_filter",
        "as_parent" => array('only' => 'st_flight_filter_price,st_flight_filter_stops,st_flight_filter_departure,st_flight_filter_airlines'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        "category" => esc_html__('Flights', ST_TEXTDOMAIN),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "value" => array(
                    esc_html__('--Select--', ST_TEXTDOMAIN) => '',
                    esc_html__('Dark', ST_TEXTDOMAIN) => 'dark',
                    esc_html__('Light', ST_TEXTDOMAIN) => 'light',
                ),
            ),
        )
    ));
    vc_map(array(
        "name" => esc_html__("ST Flight Filter Price", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_price",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));

    vc_map(array(
        "name" => esc_html__("ST Flight Filter Stops", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_stops",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));
    vc_map(array(
        "name" => esc_html__("ST Flight Filter Departure Time", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_departure",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));
    vc_map(array(
        "name" => esc_html__("ST Flight Filter Airlines", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_airlines",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));

    vc_map(array(
        "name" => esc_html__("[Ajax] ST Flight Search Filter", ST_TEXTDOMAIN),
        "base" => "st_flight_search_filter_ajax",
        "as_parent" => array('only' => 'st_flight_filter_price_ajax,st_flight_filter_stops_ajax,st_flight_filter_departure_ajax,st_flight_filter_airlines_ajax'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "js_view" => 'VcColumnView',
        "icon" => "icon-st",
        "category" => esc_html__('Flights', ST_TEXTDOMAIN),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => "",
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Style", ST_TEXTDOMAIN),
                "param_name" => "style",
                "value" => array(
                    esc_html__('--Select--', ST_TEXTDOMAIN) => '',
                    esc_html__('Dark', ST_TEXTDOMAIN) => 'dark',
                    esc_html__('Light', ST_TEXTDOMAIN) => 'light',
                ),
            ),
        )
    ));
    vc_map(array(
        "name" => esc_html__("[Ajax] ST Flight Filter Price", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_price_ajax",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter_ajax'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));

    vc_map(array(
        "name" => esc_html__("[Ajax] ST Flight Filter Stops", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_stops_ajax",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter_ajax'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));
    vc_map(array(
        "name" => esc_html__("[Ajax] ST Flight Filter Departure Time", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_departure_ajax",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter_ajax'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));
    vc_map(array(
        "name" => esc_html__("[Ajax] ST Flight Filter Airlines", ST_TEXTDOMAIN),
        "base" => "st_flight_filter_airlines_ajax",
        "content_element" => true,
        "as_child" => array('only' => 'st_flight_search_filter_ajax'),
        "icon" => "icon-st",
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", ST_TEXTDOMAIN),
                "param_name" => "title",
                "description" => ""
            )
        )
    ));

    vc_map(array(
        'name' => esc_html__('ST Flight Search Result', ST_TEXTDOMAIN),
        'base' => 'st_flight_search_results',
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

    vc_map(array(
        'name' => esc_html__('ST Single Search Flights', ST_TEXTDOMAIN),
        'base' => 'st_single_search_flights',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                'type' => 'textfield',
                'param_name' => 'title',
                'heading' => esc_html__('Title Form', ST_TEXTDOMAIN),
                'admin_label' => true,
                'description' => esc_html__('Add a text for title form', ST_TEXTDOMAIN)
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'admin_label' => true,
                'heading' => esc_html__('Style', ST_TEXTDOMAIN),
                'description' => esc_html__('Choose a style', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('Default', ST_TEXTDOMAIN) => 'default',
                    esc_html__('Small', ST_TEXTDOMAIN) => 'small'
                ),
                'std' => 'default'
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'search_type',
                'heading' => esc_html__('Search Type', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('One-Way', ST_TEXTDOMAIN) => 'one_way',
                    esc_html__('Return', ST_TEXTDOMAIN) => 'return',
                    esc_html__('Both', ST_TEXTDOMAIN) => 'both',
                ),
                'std' => 'both'
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'box_shadow',
                'heading' => esc_html__('Show Box Shadow', ST_TEXTDOMAIN),
                'value' => array(
                    esc_html__('No', ST_TEXTDOMAIN) => 'no',
                    esc_html__('Yes', ST_TEXTDOMAIN) => 'yes',
                ),
                'std' => 'no'
            ),
        )
    ));

    vc_map(array(
        'name' => esc_html__('ST Sum Of Flight Search Results', ST_TEXTDOMAIN),
        'base' => 'st_sum_of_flight_search_result',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", ST_TEXTDOMAIN),
                "param_name" => "extra_class",
                'value'=>"",
            )
        )
    ));

    vc_map(array(
        'name' => esc_html__('[Ajax] ST Sum Of Flight Search Results', ST_TEXTDOMAIN),
        'base' => 'st_sum_of_flight_search_result_ajax',
        'icon' => 'icon-st',
        'category' => esc_html__('Flights', ST_TEXTDOMAIN),
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", ST_TEXTDOMAIN),
                "param_name" => "extra_class",
                'value'=>"",
            )
        )
    ));

}