<?php

if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_flight_search_filter_ajax' )) {
    class WPBakeryShortCode_st_flight_search_filter_ajax extends WPBakeryShortCodesContainer
    {
        protected function content( $arg , $content = null )
        {
            $style = $title = '';
            $data = shortcode_atts( array(
                'title' => "" ,
                'style' => "" ,
            ) , $arg , 'st_flight_search_filter_ajax' );
            extract( $data );
            $content = do_shortcode( $content );
            if($style == 'dark') {
                $class_side_bar = 'booking-filters text-white';
            } else {
                $class_side_bar = 'booking-filters booking-filters-white';
            }
            $html = '<aside class="st-elements-filters ' . $class_side_bar . '">
                        <h3>' . $title . '</h3>
                        <ul class="list booking-filters-list">' . $content . '</ul>
                    </aside>';
            return $html;
        }
    }
}
if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_price_ajax' )) {
    class WPBakeryShortCode_st_flight_filter_price_ajax extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_price_ajax' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter-ajax/filter' , 'price' ). '</li>';
            return $html;
        }
    }
}
if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_stops_ajax' )) {
    class WPBakeryShortCode_st_flight_filter_stops_ajax extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_stops_ajax' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter-ajax/filter' , 'stops' ). '</li>';
            return $html;
        }
    }
}

if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_departure_ajax' )) {
    class WPBakeryShortCode_st_flight_filter_departure_ajax extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_departure_ajax' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter-ajax/filter' , 'departure' ). '</li>';
            return $html;
        }
    }
}

if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_airlines_ajax' )) {
    class WPBakeryShortCode_st_flight_filter_airlines_ajax extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_airlines_ajax' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter-ajax/filter' , 'airlines' ). '</li>';
            return $html;
        }
    }
}

