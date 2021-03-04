<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/16/2017
 * Version: 1.0
 */
global $wp_query, $st_flight_search_query, $st_flight_search_return_query;
wp_enqueue_script('magnific.js');
wp_enqueue_script('filter-ajax-flights.js');
if(!empty($st_flight_search_query)){
    $query = $st_flight_search_query;
}else{
    $query = $wp_query;
}

if(!empty($st_flight_search_return_query)){
    $query2 = $st_flight_search_return_query;
}else{
    $query2 = $wp_query;
}

$has_post_depart = false;
$has_post_return = false;

$f_type = STInput::get('flight_type', false);
if((int)$query2->found_posts > 0 && $f_type == 'return'){
    $has_post_return = true;
}

//var_dump($query->request);

if((int)$query->found_posts > 0){
    if($f_type == 'return'){
        if($has_post_return)
            $has_post_depart = true;
    }else{
        $has_post_depart = true;
    }
}

if(!$has_post_depart){
    $has_post_return = false;
}

$return_date = STInput::get('end');
$depart_date = STInput::get('start');
$origin = STInput::get('origin');
$destination = STInput::get('destination');
$passenger = STInput::get('passenger');
$business = STInput::get('business', false);
$from_id = $to_id = '';
$origin_iata = $destination_iata = '';
if(!empty(explode('--', $origin)[1])){
    $origin_iata = explode('--', $origin)[0];
    $from_id = explode('--', $origin)[1];
}
if(!empty(explode('--', $destination)[1])){
    $destination_iata = explode('--', $destination)[0];
    $to_id = explode('--', $destination)[1];
}
$location_from = get_tax_meta($from_id, 'location_id');
$location_to = get_tax_meta($to_id, 'location_id');
$on_way = true;
if($f_type == 'return'){
    $on_way = false;
}
echo '<div class="st-flight-booking-result">';
?>

<div class="ajax-filter-cover">
    <div class="ajax-filter-loading">
        <img src="<?php echo get_template_directory_uri(); ?>/img/loading-filter-ajax.gif"
             alt="<?php echo __('Loading tours', ST_TEXTDOMAIN); ?>"/>
    </div>
    <div id="ajax-filter-content"></div>
</div>

<?php echo '</div>';?>