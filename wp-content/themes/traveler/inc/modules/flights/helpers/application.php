<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */
if(!function_exists('st_flight_load_view')) {
    function st_flight_load_view($slug, $name = false, $data = array())
    {
        if (is_array($data))
            extract($data);

        if ($name) {
            $slug = $slug . '-' . $name;
        }

        $template_dir = 'inc/modules/flights/views';

        //Find template in folder st_templates/
        $template = locate_template($template_dir . '/' . $slug . '.php');

        //If file not found
        if (is_file($template)) {
            ob_start();

            include $template;

            $data = @ob_get_clean();

            return $data;
        }

        return false;
    }
}

if(!function_exists('st_flight_get_airport_text')){
    function st_flight_get_airport_text($airport_id, $airport_name = false, $search = true){

        if(!empty($airport_id)){
            if(!$airport_name){
                $term_object = get_term_by('id',$airport_id,'st_airport');
                if(!empty($term_object->name)){
                    $airport_name = $term_object->name;
                }
            }
            $value_text = $airport_name;
            $iata_airport = get_tax_meta($airport_id , 'iata_airport');
            $location_id = get_tax_meta($airport_id , 'location_id');
            if(!empty($location_id)){
                if($search) {
                    $value_text = get_the_title($location_id);
                    $country = get_post_meta($location_id, 'location_country', true);
                    if ($country) {
                        $value_text .= ', ' . TravelHelper::_get_location_country(false)[$country];
                    }
                    $value_text .= ' (' . $airport_name . ')';
                }else{
                    $value_text .= ', '.get_the_title($location_id);
                    $country = get_post_meta($location_id, 'location_country', true);
                    if ($country) {
                        $value_text .= ', ' . TravelHelper::_get_location_country(false)[$country];
                    }
                }
            }
            if($search) {
                $value_text .= ' - ' . $iata_airport;
            }else{
                $value_text .= ' ('.$iata_airport.')';
            }

            return $value_text;
        }

        return false;
    }
}

if(!function_exists('st_flight_convert_time_to_str')) {
    function st_flight_convert_time_to_str($t)
    {
        if(empty($t)){
            return false;
        }
        $time_value = date('H:i', strtotime($t));
        $h = !empty(explode(':', $time_value)[0])?explode(':', $time_value)[0]:0;
        $i = !empty(explode(':', $time_value)[1])?explode(':', $time_value)[1]:0;
        $str_time = (int)$h * 60 * 60 + (int)$i * 60;

        return $str_time;

    }
}

if(!function_exists('st_flight_get_airline_popular')){
    function st_flight_get_airline_popular($number){

        $args = array(
            'orderby'           => 'count',
            'order'             => 'ASC',
            'hide_empty'        => true,
            'number' => $number
        );
        $airlines = get_terms('st_airline', $args);

        if(!empty($airlines) && count($airlines) > 0){
            $arr = array();
            foreach($airlines as $key => $val){
                if(!empty($val->name)){
                    $arr[$val->term_id] = $val->name;
                }
            }

            return $arr;
        }
        return false;
    }
}

if(!function_exists('st_flight_get_airport_meta')){
    function st_flight_get_airport_meta($need){
        $iata_from = get_post_meta(get_the_ID(), 'origin', true);
        $location_from = get_tax_meta($iata_from ,'location_id');
        $iata_from_id = get_tax_meta($iata_from, 'iata_airport');
        $iata_to = get_post_meta(get_the_ID(), 'destination', true);
        $iata_to_id = get_tax_meta($iata_to, 'iata_airport');
        $location_to = get_tax_meta($iata_to,'location_id');
        switch($need){
            case 'iata_from':
                return $iata_from_id;
                break;
            case 'iata_to':
                return $iata_to_id;
                break;
            case 'location_to':
                return $location_to;
                break;
            case 'location_from':
                return $location_from;
                break;
        }
    }
}

if(!function_exists('st_flight_get_full_location')){
    function st_flight_get_full_location($location_id){
        $full_location = get_the_title($location_id);
        $country_id = get_post_meta($location_id, 'location_country', true);
        if(!empty($country_id)){
            $full_location .= ', '.TravelHelper::_get_location_country(false)[$country_id];
        }

        return $full_location;
    }
}

if(!function_exists('st_flight_get_info_stop')){
    function st_flight_get_info_stop($post_id){
        $data = array(
            'airline' => '',
            'airline_name' => '',
            'origin' => '',
            'origin_location' => '',
            'origin_iata' => '',
            'destination' => '',
            'destination_location' => '',
            'destination_iata' => '',
            'airline_stop' => '',
            'airline_stop_name' => '',
            'airport_stop' => '',
            'airport_stop_location' => '',
            'airport_stop_iata' => '',
            'airline_stop_1' => '',
            'airline_stop_1_name' => '',
            'airport_stop_1' => '',
            'airport_stop_1_location' => '',
            'airport_stop_1_iata' => '',
            'airline_stop_2' => '',
            'airline_stop_2_name' => '',
            'airport_stop_2' => '',
            'airport_stop_2_location' => '',
            'airport_stop_2_iata' => ''
        );
        if(empty($post_id)){
            return false;
        }

        $airline = get_post_meta($post_id, 'airline', true);
        $origin = get_post_meta($post_id, 'origin', true);
        $destination = get_post_meta($post_id, 'destination', true);

        $data['airline'] = $airline;
        if(!empty($airline)){
            $airline_obj = get_term_by('id', $airline, 'st_airline');
            if(!empty($airline_obj->name)){
                $data['airline_name'] = $airline_obj->name;
            }
        }
        $data['origin'] = $origin;
        if(!empty($origin)){
            $location_id = get_tax_meta($origin, 'location_id');
            $data['origin_location'] = ($location_id);
            $data['origin_location_full'] = st_flight_get_full_location($location_id);
            $data['origin_iata'] = get_tax_meta($origin, 'iata_airport');
        }
        $data['destination'] = $destination;
        if(!empty($destination)){
            $location_id = get_tax_meta($destination, 'location_id');
            $data['destination_location'] = ($location_id);
            $data['destination_location_full'] = st_flight_get_full_location($location_id);
            $data['destination_iata'] = get_tax_meta($destination, 'iata_airport');
        }

        $flight_type = get_post_meta($post_id, 'flight_type', true);

        if($flight_type == 'one_stop'){
            $airline_stop = get_post_meta($post_id, 'airline_stop', true);
            $data['airline_stop'] = $airline_stop;
            if(!empty($airline_stop)){
                $airline_obj = get_term_by('id', $airline_stop,'st_airline');
                if(!empty($airline_obj->name)){
                    $data['airline_stop_name'] = $airline_obj->name;
                }
            }
            if(empty($data['airline_stop_name'])){
                $data['airline_stop'] = $data['airline'];
                $data['airline_stop_name'] = $data['airline_name'];
            }

            $airport_stop = get_post_meta($post_id, 'airport_stop', true);
            $data['airport_stop'] = $airport_stop;

            if(!empty($airport_stop)){
                $location_id = get_tax_meta($airport_stop, 'location_id');
                $data['airport_stop_location'] = ($location_id);
                $data['airport_stop_location_full'] = st_flight_get_full_location($location_id);
                $data['airport_stop_iata'] = get_tax_meta($airport_stop, 'iata_airport');
            }
        }

        if($flight_type == 'two_stops'){
            //Stop 1
            $airline_stop_1 = get_post_meta($post_id, 'airline_stop_1', true);
            $data['airline_stop_1'] = $airline_stop_1;
            if(!empty($airline_stop_1)){
                $airline_obj = get_term_by('id', $airline_stop_1,'st_airline');
                if(!empty($airline_obj->name)){
                    $data['airline_stop_1_name'] = $airline_obj->name;
                }
            }
            if(empty($data['airline_stop_1_name'])){
                $data['airline_stop_1'] = $data['airline'];
                $data['airline_stop_1_name'] = $data['airline_name'];
            }

            $airport_stop_1 = get_post_meta($post_id, 'airport_stop_1', true);
            $data['airport_stop_1'] = $airport_stop_1;
            if(!empty($airport_stop_1)){
                $location_id = get_tax_meta($airport_stop_1, 'location_id');
                $data['airport_stop_1_location'] = ($location_id);
                $data['airport_stop_1_location_full'] = st_flight_get_full_location($location_id);
                $data['airport_stop_1_iata'] = get_tax_meta($airport_stop_1, 'iata_airport');
            }

            //Stop 2
            $airline_stop_2 = get_post_meta($post_id, 'airline_stop2', true);
            $data['airline_stop_2'] = $airline_stop_2;
            if(!empty($airline_stop_2)){
                $airline_obj = get_term_by('id', $airline_stop_2,'st_airline');
                if(!empty($airline_obj->name)){
                    $data['airline_stop_2_name'] = $airline_obj->name;
                }
            }
            if(empty($data['airline_stop_2_name'])){
                $data['airline_stop_2'] = $data['airline'];
                $data['airline_stop_2_name'] = $data['airline_name'];
            }

            $airport_stop_2 = get_post_meta($post_id, 'airport_stop_2', true);
            $data['airport_stop_2'] = $airport_stop_2;
            if(!empty($airport_stop_2)){
                $location_id = get_tax_meta($airport_stop_2, 'location_id');
                $data['airport_stop_2_location'] = ($location_id);
                $data['airport_stop_2_location_full'] = st_flight_get_full_location($location_id);
                $data['airport_stop_2_iata'] = get_tax_meta($airport_stop_2, 'iata_airport');
            }

        }

        return $data;

    }
}



if(!function_exists('st_flight_get_duration')){
    function st_flight_get_duration($post_id, $_start = false){
        if(empty($post_id)) return false;

        $data = array();

        $flight_type = get_post_meta($post_id,'flight_type', true);
        $departure_time = get_post_meta($post_id, 'departure_time', true);
        $data['depart_time'] = $departure_time;
        if($_start){
            $str_start = $_start;
        }else{
            $start = STInput::get('start', '');
            $str_start = strtotime(TravelHelper::convertDateFormat($start).' '.$departure_time);
        }
        $str_depart = strtotime($departure_time);

        $start_date = date('D, M d', $str_start);
        $data['depart_date'] = $start_date;

        if($flight_type == 'direct'){
            $total_time = get_post_meta($post_id, 'total_time', true);
            $hour = !empty($total_time['hour'])?$total_time['hour']:0;
            $minute = !empty($total_time['minute'])?$total_time['minute']:0;

            $data['total_time'] = sprintf(esc_html__('%sh %sm','mytravel'), $hour, $minute);

            $str_depart += $hour * 60*60 + $minute * 60;

            $arrive = date('h:i A', $str_depart);
            $data['arrive_time'] = $arrive;
            $str_end = $str_start + $hour * 60*60 + $minute * 60;
            $end_date = date('D, M d', $str_end);
            $data['arrive_date'] = $end_date;
        }

        if($flight_type == 'one_stop'){
            $arrival_stop = get_post_meta($post_id, 'arrival_stop', true);
            $st_stopover_time = get_post_meta($post_id, 'st_stopover_time', true);
            $departure_stop = get_post_meta($post_id, 'departure_stop', true);

            $data['arrival_stop'] = sprintf(esc_html__('%sh %sm','mytravel'), $arrival_stop['hour'], $arrival_stop['minute']);
            $data['st_stopover_time'] = sprintf(esc_html__('%sh %sm','mytravel'), $st_stopover_time['hour'], $st_stopover_time['minute']);
            $data['departure_stop'] = sprintf(esc_html__('%sh %sm','mytravel'), $departure_stop['hour'], $departure_stop['minute']);

            $total_time = $arrival_stop['hour']*60 + $arrival_stop['minute'] + $st_stopover_time['hour']*60 + $st_stopover_time['minute'] + $departure_stop['hour']*60 + $departure_stop['minute'];
            $total_time_str = $arrival_stop['hour']*60*60 + $arrival_stop['minute']*60 + $st_stopover_time['hour']*60*60 + $st_stopover_time['minute']*60 + $departure_stop['hour']*60*60 + $departure_stop['minute']*60;

            $data['total_time'] = sprintf(esc_html__('%dh %dm','mytravel'), intval($total_time/60), (int)$total_time%60);

            $str_arrival_stop_time = $str_depart + $arrival_stop['hour']*60*60 + $arrival_stop['minute']*60;
            $data['arrival_stop_time'] = date('h:i A', $str_arrival_stop_time);
            $str_arrival_stop_date = $str_start + $arrival_stop['hour']*60*60 + $arrival_stop['minute']*60;
            $data['arrival_stop_date'] = date('D, M d', $str_arrival_stop_date);

            $str_depart_stop_time = $str_arrival_stop_time + $st_stopover_time['hour']*60*60 + $st_stopover_time['minute']*60;
            $data['departure_stop_time'] = date('h:i A', $str_depart_stop_time);
            $str_depart_stop_date = $str_arrival_stop_date + $st_stopover_time['hour']*60*60 + $st_stopover_time['minute']*60;
            $data['departure_stop_date'] = date('D, M d', $str_depart_stop_date);

            $str_depart += $total_time_str;
            $arrive = date('h:i A', $str_depart);
            $data['arrive_time'] = $arrive;

            $str_end = $str_start + $total_time_str;
            $end_date = date('D, M d', $str_end);
            $data['arrive_date'] = $end_date;
        }

        if($flight_type == 'two_stops'){
            $arrival_stop_1 = get_post_meta($post_id, 'arrival_stop_1', true);
            $st_stopover_time_1 = get_post_meta($post_id, 'st_stopover_time_1', true);
            $arrival_stop_2 = get_post_meta($post_id, 'arrival_stop_2', true); //time from stop 1 => stop 2
            $st_stopover_time_2 = get_post_meta($post_id, 'st_stopover_time_2', true);
            $departure_stop_2 = get_post_meta($post_id, 'departure_stop_2', true);

            $data['arrival_stop_1'] = sprintf(esc_html__('%sh %sm','mytravel'), $arrival_stop_1['hour'], $arrival_stop_1['minute']);
            $data['st_stopover_time_1'] = sprintf(esc_html__('%sh %sm','mytravel'), $st_stopover_time_1['hour'], $st_stopover_time_1['minute']);
            $data['arrival_stop_2'] = sprintf(esc_html__('%sh %sm','mytravel'), $arrival_stop_2['hour'], $arrival_stop_2['minute']);
            $data['st_stopover_time_2'] = sprintf(esc_html__('%sh %sm','mytravel'), $st_stopover_time_2['hour'], $st_stopover_time_2['minute']);
            $data['departure_stop_2'] = sprintf(esc_html__('%sh %sm','mytravel'), $departure_stop_2['hour'], $departure_stop_2['minute']);

            $total_time = $arrival_stop_1['hour']*60 + $arrival_stop_1['minute'] + $st_stopover_time_1['hour']*60 + $st_stopover_time_1['minute'] + $arrival_stop_2['hour']*60 + $arrival_stop_2['minute'] + $st_stopover_time_2['hour']*60 + $st_stopover_time_2['minute'] + $departure_stop_2['hour']*60 + $departure_stop_2['minute'];

            $data['total_time'] = sprintf(esc_html__('%sh %sm','mytravel'), intval($total_time/60), (int)$total_time%60);

            $total_time_str = $arrival_stop_1['hour']*60*60 + $arrival_stop_1['minute']*60 + $st_stopover_time_1['hour']*60*60 + $st_stopover_time_1['minute']*60 + $arrival_stop_2['hour']*60*60 + $arrival_stop_2['minute']*60 + $st_stopover_time_2['hour']*60*60 + $st_stopover_time_2['minute']*60 + $departure_stop_2['hour']*60*60 + $departure_stop_2['minute']*60;

            $str_arrival_stop_time_1 = $str_depart + $arrival_stop_1['hour']*60*60 + $arrival_stop_1['minute']*60;
            $data['arrival_stop_time_1'] = date('h:i A', $str_arrival_stop_time_1);
            $str_arrival_stop_date_1 = $str_start + $arrival_stop_1['hour']*60*60 + $arrival_stop_1['minute']*60;
            $data['arrival_stop_date_1'] = date('D, M d', $str_arrival_stop_date_1);

            $str_depart_stop_time_1 = $str_arrival_stop_time_1 + $st_stopover_time_1['hour']*60*60 + $st_stopover_time_1['minute']*60;
            $data['departure_stop_time_1'] = date('h:i A', $str_depart_stop_time_1);
            $str_depart_stop_date_1 = $str_arrival_stop_date_1 + $st_stopover_time_1['hour']*60*60 + $st_stopover_time_1['minute']*60;
            $data['departure_stop_date_1'] = date('D, M d', $str_depart_stop_date_1);

            $str_arrival_stop_time_2 = $str_depart_stop_time_1 + $arrival_stop_2['hour']*60*60 + $arrival_stop_2['minute']*60;
            $data['arrival_stop_time_2'] = date('h:i A', $str_arrival_stop_time_2);
            $str_arrival_stop_date_2 = $str_depart_stop_date_1 + $arrival_stop_1['hour']*60*60 + $arrival_stop_1['minute']*60;
            $data['arrival_stop_date_2'] = date('D, M d', $str_arrival_stop_date_2);

            $str_depart_stop_time_2 = $str_arrival_stop_time_2 + $st_stopover_time_2['hour']*60*60 + $st_stopover_time_2['minute']*60;
            $data['departure_stop_time_2'] = date('h:i A', $str_depart_stop_time_2);
            $str_depart_stop_date_2 = $str_arrival_stop_date_1 + $st_stopover_time_2['hour']*60*60 + $st_stopover_time_2['minute']*60;
            $data['departure_stop_date_2'] = date('D, M d', $str_depart_stop_date_2);

            $str_depart += $total_time_str;
            $arrive = date('h:i A', $str_depart);
            $data['arrive_time'] = $arrive;

            $str_end = $str_start + $total_time_str;
            $end_date = date('D, M d', $str_end);
            $data['arrive_date'] = $end_date;

        }

        return $data;
    }
}