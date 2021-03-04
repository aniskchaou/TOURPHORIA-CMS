<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/26/2017
 * Version: 1.0
 */

wp_enqueue_script('magnific.js');
global $wp_query, $st_flight_search_query, $st_flight_search_return_query;

if(!empty($st_flight_search_query)){
    $query = $st_flight_search_query;
}else{
    $query = $wp_query;
}

$found_posts = $query->found_posts;
if(STInput::get('flight_type','one_way') == 'return' && $st_flight_search_return_query->found_posts == 0){
    $found_posts = 0;
}

if($found_posts == 0){
    $result_str = esc_html__('No Flight found', ST_TEXTDOMAIN);
}else{
    $result_str = sprintf(_n('%d Flight', '%d Flights',(int)$query->found_posts, ST_TEXTDOMAIN), $query->found_posts);
}


$origin = STInput::get('origin',false);
$destination = STInput::get('destination',false);
if($origin && $destination){
    $origin = explode('--', $origin);
    if(!empty($origin[1])){
        $from_id = get_tax_meta($origin[1],'location_id');
        $result_str .= esc_html__(' from ', ST_TEXTDOMAIN).get_the_title($from_id);
    }
    $destination = explode('--', $destination);
    if(!empty($destination[1])){
        $to_id = get_tax_meta($destination[1],'location_id');
        $result_str .= esc_html__(' to ', ST_TEXTDOMAIN).get_the_title($to_id);
    }
}
$start = STInput::get('start',false);
if(!empty($start)) {
    $str_start = strtotime(TravelHelper::convertDateFormat($start));
    $result_str .= esc_html__(' on ', ST_TEXTDOMAIN).date('M d', $str_start);
}
$passenger = STInput::get('passenger', false);
if(!empty($passenger)){
    $result_str .= esc_html__(' for ', ST_TEXTDOMAIN).$passenger._n(' passenger ', ' passengers ', (int)$passenger, ST_TEXTDOMAIN);
}

?>
<h3 class="booking-title"><?php echo esc_attr($result_str); ?>
    <small><a class="popup-text" href="#search-flight-dialog" data-effect="mfp-zoom-out"><?php echo esc_html__('Change search', ST_TEXTDOMAIN); ?></a></small>
</h3>
