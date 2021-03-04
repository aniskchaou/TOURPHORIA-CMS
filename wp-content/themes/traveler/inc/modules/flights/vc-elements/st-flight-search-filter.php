<?php

if(class_exists( 'WPBakeryShortCodesContainer' ) and !class_exists( 'WPBakeryShortCode_st_flight_search_filter' )) {
    class WPBakeryShortCode_st_flight_search_filter extends WPBakeryShortCodesContainer
    {
        protected function content( $arg , $content = null )
        {
            $style = $title = '';
            $data = shortcode_atts( array(
                'title' => "" ,
                'style' => "" ,
            ) , $arg , 'st_flight_search_filter' );
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
if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_price' )) {
    class WPBakeryShortCode_st_flight_filter_price extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_price' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter/filter' , 'price' ). '</li>';
            return $html;
        }
    }
}
if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_stops' )) {
    class WPBakeryShortCode_st_flight_filter_stops extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_stops' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter/filter' , 'stops' ). '</li>';
            return $html;
        }
    }
}

if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_departure' )) {
    class WPBakeryShortCode_st_flight_filter_departure extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_departure' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter/filter' , 'departure' ). '</li>';
            return $html;
        }
    }
}

if(class_exists( 'WPBakeryShortCode' ) and !class_exists( 'WPBakeryShortCode_st_flight_filter_airlines' )) {
    class WPBakeryShortCode_st_flight_filter_airlines extends WPBakeryShortCode
    {
        protected function content( $arg , $content = null )
        {
            $title = '';
            $data = shortcode_atts( array(
                'title'     => "" ,
            ) , $arg , 'st_flight_filter_airlines' );
            extract( $data );
            $html = '<li><h5 class="booking-filters-title">' . $title . '</h5>' . st_flight_load_view( 'vc-elements/st-flight-search-filter/filter' , 'airlines' ). '</li>';
            return $html;
        }
    }
}

