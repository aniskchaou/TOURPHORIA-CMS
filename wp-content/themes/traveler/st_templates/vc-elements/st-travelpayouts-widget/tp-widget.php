<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/15/2017
 * Version: 1.0
 */
$marker = st()->get_option('tp_marker', '124778');
$currency_default = st()->get_option('tp_currency_default','usd');

$use_whitelabel = st()->get_option('tp_redirect_option', 'off');

switch($widget_type){
    case 'popular-router':
        $location = 'BKK';
        if(!empty($pr_destination['location_id'])){
            $location = $pr_destination['location_id'];
        }
        if(empty($language)){
            $language = 'en';
        }
        $page_id = st()->get_option('tp_whitelabel_page','');

        if(empty($page_id)){
            $host = st()->get_option('tp_whitelabel', 'hydra.aviasales.ru');
        }else{
            $host = esc_url(get_the_permalink($page_id).'#/flights');
            $host = str_replace(array('http://','https://','/','#'),array('','','%2F','%23'),$host);
        }

        if($use_whitelabel == 'off'){
            $host = 'hydra.aviasales.ru';
        }

        echo '<script async src="//www.travelpayouts.com/weedle/widget.js?width=400px&marker='.$marker.'&host='.$host.'&locale='.$language.'&currency='.$currency_default.'&destination='.$location.'" charset="UTF-8"></script>';
        break;
    case 'flights-map':
        $location = 'PAR';
        if(!empty($pr_destination['location_id'])){
            $location = $pr_destination['location_id'];
        }
        if(empty($language1)){
            $language1 = 'en';
        }
        if($direct == 'yes'){
            $direct = 'true';
        }else{
            $direct = 'false';
        }
        $domain = st()->get_option('tp_whitelabel', 'map.jetradar.com');
        if($domain != 'map.jetradar.com'){
            $domain = $domain.'/map';
        }

        if($use_whitelabel == 'off'){
            $domain = 'map.jetradar.com';
        }

        echo '<iframe src="//maps.avs.io/flights/?auto_fit_map=true&hide_sidebar=true&hide_reformal=true&disable_googlemaps_ui=true&zoom=5&show_filters_icon=true&redirect_on_click=true&small_spinner=true&hide_logo=false&direct='.$direct.'&lines_type=TpLines&cluster_manager=TpWidgetClusterManager&marker='.$marker.'.map&show_tutorial=false&locale='.$language1.'&currency='.$currency_default.'&host='.$domain.'&origin_iata='.$location.'" width="100%" height="450" scrolling="no" frameborder="0"></iframe>';
        break;
    case 'calendar':
        $page_id = st()->get_option('tp_whitelabel_page','');
        if(empty($page_id)){
            $host = st()->get_option('tp_whitelabel', 'jetradar.com%2Fsearches%2Fnew');
        }else{
            $host = esc_url(get_the_permalink($page_id).'#/flights');
            $host = str_replace(array('http://','https://','/','#'),array('','','%2F','%23'),$host);
        }

        if($use_whitelabel == 'off'){
            $host = 'jetradar.com%2Fsearches%2Fnew';
        }

        $location1 = 'HAN';
        if(!empty($pr_origin['location_id'])){
            $location1 = $pr_origin['location_id'];
        }

        $location2 = 'BKK';
        if(!empty($pr_destination['location_id'])){
            $location2 = $pr_destination['location_id'];
        }

        echo '<div class="calendar-widget"><script charset="utf-8" src="//www.travelpayouts.com/calendar_widget/iframe.js?marker='.$marker.'.&origin='.$location1.'&destination='.$location2.'&currency='.$currency_default.'&searchUrl='.$host.'&one_way=false&only_direct=false&locale='.esc_attr($language2).'&period=year&range=7%2C14&width=800" async></script></div>';
        break;
    case 'hotels-map':

        $lat_lon = 'lat=21.188273091358273&lng=105.87235119628907';
        if(!empty($map_lat_lon['hotel_map'])){
            $lat_lon = $map_lat_lon['hotel_map'];
        }

        $page_id = st()->get_option('tp_whitelabel_page','');
        if(empty($page_id)){
            $host = st()->get_option('tp_whitelabel', '');
            if(!empty($host)){
                $host = $host.'%2Fhotels';
            }else{
                $host = 'hotellook.com';
            }
        }else{
            $host = esc_url(get_the_permalink($page_id).'#/hotels');
            $host = str_replace(array('http://','https://','/','#'),array('','','%2F','%23'),$host);
        }

        if($use_whitelabel == 'off'){
            $host = 'hotellook.com';
        }

        $drag = $disable_zoom = $scroll = $map_styled = 'false';

        if(strpos($map_control, 'drag') !== false){
            $drag = 'true';
        }

        if(strpos($map_control, 'disable_zoom') !== false){
            $disable_zoom = 'true';
        }
        if(strpos($map_control, 'scroll') !== false){
            $scroll = 'true';
        }
        if(strpos($map_control, 'map_styled') !== false){
            $map_styled = 'true';
        }
        echo '<iframe src="//maps.avs.io/hotels?color='.str_replace('#','%23',$color_schema).'&locale='.esc_attr($language).'&marker='.$marker.'.'.$add_marker.'hotelsmap&changeflag=0&draggable='.$drag.'&map_styled='.$map_styled.'&map_color='.str_replace('#','%23',$color_schema).'&contrast_color=%23FFFFFF&disable_zoom='.$disable_zoom.'&base_diameter='.((int)($marker_size)).'&scrollwheel='.$scroll.'&host='.$host.'&'.$lat_lon.'&zoom='.((int)$map_zoom).'" height="450px" width="100%"  scrolling="no" frameborder="0"></iframe>';
        break;
    case 'hotel':
        $page_id = st()->get_option('tp_whitelabel_page','');
        if(empty($page_id)){
            $host = st()->get_option('tp_whitelabel', '');
            if(!empty($host)){
                $host = $host.'%2Fhotels';
            }else{
                $host = 'hotellook.com%2Fsearch';
            }
        }else{
            $host = esc_url(get_the_permalink($page_id).'#/hotels');
            $host = str_replace(array('http://','https://','/','#'),array('','','%2F','%23'),$host);
        }

        if($use_whitelabel == 'off'){
            $host = 'hotellook.com%2Fsearch';
        }

        $id = '361687';
        if(!empty($hotel_id['h_id'])){
            $id = $hotel_id['h_id'];
        }

        echo '<div class="hotel-widget"><script charset="utf-8" async src="//www.travelpayouts.com/chansey/iframe.js?hotel_id='.$id.'&locale='.esc_attr($language).'&host='.$host.'&marker='.$marker.'.'.$add_marker.'&currency='.$currency_default.'&width=500"></script></div>';
        break;
    case 'hotel-selections':
        if ($language3 == 'ru') {
            $language3 = '';
        } else {
            $language3 = '_' . $language3;
        }
        $page_id = st()->get_option('tp_whitelabel_page', '');
        if (empty($page_id)) {
            $host = st()->get_option('tp_whitelabel', '');
            if (!empty($host)) {
                $host = $host . '%2Fhotels';
            } else {
                $host = 'search.hotellook.com';
            }
        } else {
            $host = esc_url(get_the_permalink($page_id) . '#/hotels');
            $host = str_replace(array('http://', 'https://'), array('', ''), $host);
            $host = urlencode($host);
        }

        if($use_whitelabel == 'off'){
            $host = 'search.hotellook.com';
        }

        if($find_by == 'city'){
            $city_id = '14115';
            if(!empty($city_data['city_id'])){
                $city_id = $city_data['city_id'];
            }

            $categories = '';
            if(!empty($city_data['city_avail']) && count($city_data['city_avail']) > 0){
                $categories = 'categories=';
                foreach($city_data['city_avail'] as $key => $value){
                    $categories .= $value.'%2C';
                    if($key == count($city_data['city_avail']) - 1){
                        $categories .= $value;
                    }
                }
            }

            echo '<script async src="//www.travelpayouts.com/blissey/scripts'.$language3.'.js?'.($categories).'&id='.$city_id.'&type='.$w_layout.'&currency='.$currency_default.'&width=800&host='.$host.'&marker='.$marker.'.'.$add_marker.'&limit='.$limit.'" charset="UTF-8"></script>';
        }


        if($find_by == 'hotels'){
            if(!empty($list_hotel)) {

                $hotels = vc_param_group_parse_atts($list_hotel);
                if(is_array($hotels)){
                    $i = 0;
                    foreach($hotels as $key => $val){
                        parse_str(urldecode($val['s_hotel_id']), $hotel);
                        if(!empty($hotel['h_id'])){
                            if($i == 0){
                                $ids = $hotel['h_id'];
                            }else{
                                $ids .= '%2C'.$hotel['h_id'];
                            }

                            $i++;
                        }
                    }
                }

                echo '<script async src="//www.travelpayouts.com/blissey/scripts' . $language3 . '.js?type=' . $w_layout . '&currency=' . $currency_default . '&width=800&host=' . $host . '&marker=' . $marker . '.' . $add_marker . '&ids='.$ids.'&limit=' . $limit . '" charset="UTF-8"></script>';
            }
        }
        break;
}