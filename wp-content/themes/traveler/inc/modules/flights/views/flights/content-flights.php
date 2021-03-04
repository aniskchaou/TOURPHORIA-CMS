<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/16/2017
 * Version: 1.0
 */
global $wp_query, $st_flight_search_query, $st_flight_search_return_query;
wp_enqueue_script('magnific.js');

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
echo '<div class="st-booking-list">';
if($has_post_depart){
    $has_post = true;
    if(!empty($location_from) && !empty($location_to)){
?>
    <div class="departure-title">
        <h4 class="title"><?php echo esc_html__('Departure', ST_TEXTDOMAIN)?> <?php echo get_the_title($location_from).' ('.$origin_iata.')' ?>
        <?php echo esc_html__('to', ST_TEXTDOMAIN); ?>
            <?php echo get_the_title($location_to).' ('.$destination_iata.')'; ?>
        </h4>
        <i class="fa fa-fighter-jet icon-flight"></i>
    </div>
<?php } ?>
<ul class="booking-list  depart st-booking-list-flight" data-flight_type="<?php echo ($on_way?'on_way':'return'); ?>">
    <?php
    while($query->have_posts()){
        $query->the_post();
        $start = STInput::get('start', '');
        $data_time = st_flight_get_duration(get_the_ID());
        $flight_type = get_post_meta(get_the_ID(),'flight_type', true);
        $stop_info = st_flight_get_info_stop(get_the_ID());

	    $external = get_post_meta(get_the_ID(), 'st_flight_external_booking', true);
	    $external_link = 'none';
	    if(isset($external) && $external == 'on'){
		    $external_link = esc_url(get_post_meta(get_the_ID(), 'st_flight_external_booking_link', true));
		    if($external_link == ''){
			    $external_link = 'none';
		    }
	    }
    ?>
    <li data-external="<?php echo esc_html($external); ?>" data-external-link="<?php echo $external_link; ?>" data-external-text="<?php echo esc_html('External Booking', ST_TEXTDOMAIN); ?>">
        <div class="booking-item-container">
            <div class="booking-item flight-item-<?php echo esc_attr(get_the_ID())?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="booking-item-airline-logo">
                            <?php
                            $airline = get_post_meta(get_the_ID(), 'airline', true);
                            if(!empty($airline)) {
                                $air_object = get_term_by('id', $airline, 'st_airline');
                                if (!empty($air_object->name)) {
                                    $air_logo = get_tax_meta($airline, 'airline_logo');
                                    echo wp_get_attachment_image($air_logo, array(0, 50));
                                    ?>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <?php
                    $type = array(
                        'direct' => esc_html__('non-stop', ST_TEXTDOMAIN),
                        'one_stop' => esc_html__('one stop', ST_TEXTDOMAIN),
                        'two_stops' => esc_html__('two stops', ST_TEXTDOMAIN),
                    );
                    ?>
                    <div class="col-md-12">
                        <div class="booking-item-flight-details">
                            <div class="booking-item-departure">
                                <h5><?php echo !empty($data_time['depart_time'])?strtoupper($data_time['depart_time']):''; ?></h5>
                                <p class="booking-item-date"><?php echo !empty($data_time['depart_date'])?strtoupper($data_time['depart_date']):''; ?></p>
                            </div>
                            <div class="booking-item-arrival">
                                <h5><?php echo !empty($data_time['arrive_time'])?strtoupper($data_time['arrive_time']):''; ?></h5>
                                <p class="booking-item-date"><?php echo !empty($data_time['arrive_date'])?strtoupper($data_time['arrive_date']):''; ?></p>
                            </div>
                            <div class="flight-layovers">
                                <div class="header duration"><?php echo !empty($data_time['total_time'])?strtoupper($data_time['total_time']):''; ?></div>

                                <div class="flight-line">
                                    <div class="origin">
                                        <div class="origin-iata">
                                            <?php
                                            echo esc_attr($origin_iata);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="destination">
                                        <div class="destination-iata">
                                            <?php
                                            echo esc_attr($destination_iata);
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if($flight_type == 'one_stop'){
                                        ?>
                                        <div class="stop">
                                            <div class="iata-stop">
                                                <?php
                                                $stop1 = get_post_meta(get_the_ID(), 'airport_stop', true);
                                                $stop1_iata = get_tax_meta($stop1 , 'iata_airport');
                                                echo esc_attr($stop1_iata);
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($flight_type == 'two_stops'){
                                        ?>
                                        <div class="stop1">
                                            <div class="iata-stop1">
                                                <?php
                                                $stop1 = get_post_meta(get_the_ID(), 'airport_stop_1', true);
                                                $stop1_iata = get_tax_meta($stop1 , 'iata_airport');
                                                echo esc_attr($stop1_iata);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="stop2">
                                            <div class="iata-stop2">
                                                <?php
                                                $stop2 = get_post_meta(get_the_ID(), 'airport_stop_2', true);
                                                $stop2_iata = get_tax_meta($stop2 , 'iata_airport');
                                                echo esc_attr($stop2_iata);
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if($flight_type == 'direct'){
                                    echo '<div class="footer">'.esc_html__('Direct Flight', ST_TEXTDOMAIN).'</div>';
                                 } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $price_eco_flight = ST_Flights_Controller::inst()->get_price_flight(get_the_ID(), strtotime(TravelHelper::convertDateFormat($start)), false);
                    $price_buss_flight = ST_Flights_Controller::inst()->get_price_flight(get_the_ID(), strtotime(TravelHelper::convertDateFormat($start)), true);

                    $enable_tax = get_post_meta(get_the_ID(),'enable_tax',true);
                    $vat_amount = get_post_meta(get_the_ID(),'vat_amount',true);
                    ?>
                    <div class="col-md-12 text-center st-flight-price">
                        <?php if($price_eco_flight > 0){ ?>
                        <div class="eco-price st-cal-flight-depart">
                            <span class="booking-item-price"><?php echo TravelHelper::format_money($price_eco_flight); ?></span><span>/<?php echo esc_html__('person', ST_TEXTDOMAIN); ?></span>
                            <p class="booking-item-flight-class"><?php echo esc_html__('Class', ST_TEXTDOMAIN)?>: <?php echo esc_html__('Economy', ST_TEXTDOMAIN)?></p>
                            <input  data-external="<?php echo esc_html($external); ?>" class="st-choose-flight-depart i-radio" data-tax="<?php echo esc_attr($enable_tax); ?>" data-tax_amount="<?php echo esc_attr($vat_amount); ?>" data-flight_type="depart" type="radio" data-post_id="<?php echo get_the_ID(); ?>" data-price="<?php echo esc_attr($price_eco_flight); ?>" data-business="0" name="flight1" value="<?php echo esc_attr(get_the_ID()); ?>">
                        </div>
                        <?php }
                        if($price_buss_flight > 0){
                        ?>
                        <div class="bus-price st-cal-flight-depart">
                            <span class="booking-item-price"><?php echo TravelHelper::format_money($price_buss_flight); ?></span><span>/<?php echo esc_html__('person', ST_TEXTDOMAIN); ?></span>
                            <p class="booking-item-flight-class"><?php echo esc_html__('Class', ST_TEXTDOMAIN)?>: <?php echo esc_html__('Business', ST_TEXTDOMAIN)?></p>
                            <input  data-external="<?php echo esc_html($external); ?>" class="st-choose-flight-depart i-radio" data-tax="<?php echo esc_attr($enable_tax); ?>" data-tax_amount="<?php echo esc_attr($vat_amount); ?>" data-flight_type="depart" type="radio" data-post_id="<?php echo get_the_ID(); ?>" data-price="<?php echo esc_attr($price_buss_flight); ?>" data-business="1" name="flight1" value="<?php echo esc_attr(get_the_ID()); ?>">
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
<!--        flight detail       -->
            <div class="booking-item-details">
                <div class="row">
                    <div class="col-md-8">
                        <p><?php echo esc_html__('Flight Details', ST_TEXTDOMAIN); ?></p>
                        <?php
                        if($flight_type == 'direct'){
                            echo '<h5 class="list-title">'.get_the_title(st_flight_get_airport_meta('location_from')).' ('.st_flight_get_airport_meta('iata_from').') '.esc_html__('to', ST_TEXTDOMAIN).' '.get_the_title(st_flight_get_airport_meta('location_to')).' ('.st_flight_get_airport_meta('iata_to').')</h5>';
                            $airline = get_post_meta(get_the_ID(),'airline', true);
                            ?>
                            <ul class="list">
                                <?php
                                echo '<li>'.$stop_info['airline_name'].'</li>';
                                echo '<li>'.sprintf(esc_html__('Depart %s Return %s', ST_TEXTDOMAIN), $data_time['depart_time'], $data_time['arrive_time']).'</li>';
                                echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.($data_time['total_time']).'</li>';
                                ?>
                            </ul>
                            <?php
                        }
                        if($flight_type == 'one_stop'){
                            echo '<h5 class="list-title">'.get_the_title($stop_info['origin_location']).' ('.$stop_info['origin_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].')</h5>';
                            echo '<ul class="list">';
                            echo '<li>'.$stop_info['airline_name'].'</li>';
                            echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['depart_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time'].'</li>';
                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['arrival_stop'].'</li>';
                            echo '</ul>';

                            echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].') '.$data_time['st_stopover_time'].'</h5>';

                            echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['destination_location']).' ('.$stop_info['destination_iata'].')</h5>';
                            echo '<ul class="list">';
                            echo '<li>'.$stop_info['airline_stop_name'].'</li>';
                            echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrive_time'].'</li>';
                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop'].'</li>';
                            echo '</ul>';
                        }
                        if($flight_type == 'two_stops'){
                            echo '<h5 class="list-title">'.get_the_title($stop_info['origin_location']).' ('.$stop_info['origin_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].')</h5>';
                            echo '<ul class="list">';
                            echo '<li>'.$stop_info['airline_name'].'</li>';
                            echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['depart_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time_1'].'</li>';
                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['arrival_stop_1'].'</li>';
                            echo '</ul>';

                            echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].') '.$data_time['st_stopover_time_1'].'</h5>';

                            echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_2_location']).' ('.$stop_info['airport_stop_2_iata'].')</h5>';
                            echo '<ul class="list">';
                            echo '<li>'.$stop_info['airline_stop_1_name'].'</li>';
                            echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time_1'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time_2'].'</li>';
                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop_1'].'</li>';
                            echo '</ul>';

                            echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_2_location']).' ('.$stop_info['airport_stop_2_iata'].') '.$data_time['st_stopover_time_2'].'</h5>';

                            echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_2_location']).' ('.$stop_info['airport_stop_2_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['destination_location']).' ('.$stop_info['destination_iata'].')</h5>';
                            echo '<ul class="list">';
                            echo '<li>'.$stop_info['airline_stop_2_name'].'</li>';
                            echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time_2'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrive_time'].'</li>';
                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop_2'].'</li>';
                            echo '</ul>';
                        }
                        ?>


                        <?php
                        if (!empty($data_time['total_time'])) {
                            ?>
                            <p><?php echo esc_html__('Total trip time', ST_TEXTDOMAIN); ?>
                                : <?php echo esc_attr($data_time['total_time']); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </li>
        <?php } ?>
</ul>
    <div class="row">
        <?php
            TravelHelper::paging_flight($query);
        ?>

    </div>
<?php } ?>

<?php
//Query 2
if(!$on_way) {
    ?>
    <?php
    if ($has_post_return) {
        ?>
        <div class="departure-title">
            <h4 class="title"><?php echo esc_html__('Return', ST_TEXTDOMAIN) ?>
                <?php echo get_the_title($location_to) . ' (' . $destination_iata . ')'; ?>
                <?php echo esc_html__('to', ST_TEXTDOMAIN); ?>
                <?php echo get_the_title($location_from) . ' (' . $origin_iata . ')' ?>
            </h4>
            <i class="fa fa-fighter-jet icon-flight"></i>
        </div>
        <ul class="booking-list return st-booking-list-flight"
            data-flight_type="<?php echo($on_way ? 'on_way' : 'return'); ?>">
            <?php
            while ($query2->have_posts()) {
                $query2->the_post();
                $end = STInput::get('end', '');
                $str_end = strtotime(TravelHelper::convertDateFormat($end));
                $data_time = st_flight_get_duration(get_the_ID(),$str_end);
                $flight_type = get_post_meta(get_the_ID(),'flight_type', true);
                $stop_info = st_flight_get_info_stop(get_the_ID());

	            $external = get_post_meta(get_the_ID(), 'st_flight_external_booking', true);
	            $external_link = 'none';
	            if(isset($external) && $external == 'on'){
		            $external_link = esc_url(get_post_meta(get_the_ID(), 'st_flight_external_booking_link', true));
		            if($external_link == ''){
			            $external_link = 'none';
		            }
	            }
                ?>
                <li data-external="<?php echo esc_html($external); ?>" data-external-link="<?php echo $external_link; ?>"  data-external-text="<?php echo esc_html('External Booking', ST_TEXTDOMAIN); ?>">
                    <div class="booking-item-container">
                        <div class="booking-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="booking-item-airline-logo">
                                        <?php
                                        $airline = get_post_meta(get_the_ID(), 'airline', true);
                                        if(!empty($airline)) {
                                            $air_object = get_term_by('id', $airline, 'st_airline');
                                            if (!empty($air_object->name)) {
                                                $air_logo = get_tax_meta($airline, 'airline_logo');
                                                echo wp_get_attachment_image($air_logo, array(0, 50));
                                                ?>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                                <?php
                                $type = array(
                                    'direct' => esc_html__('non-stop', ST_TEXTDOMAIN),
                                    'one_stop' => esc_html__('one stop', ST_TEXTDOMAIN),
                                    'two_stops' => esc_html__('two stops', ST_TEXTDOMAIN),
                                );
                                ?>
                                <div class="col-md-12">
                                    <div class="booking-item-flight-details">
                                        <div class="booking-item-departure">
                                            <h5><?php echo !empty($data_time['depart_time'])?strtoupper($data_time['depart_time']):''; ?></h5>
                                            <p class="booking-item-date"><?php echo !empty($data_time['depart_date'])?strtoupper($data_time['depart_date']):''; ?></p>
                                        </div>
                                        <div class="booking-item-arrival">
                                            <h5><?php echo !empty($data_time['arrive_time'])?strtoupper($data_time['arrive_time']):''; ?></h5>
                                            <p class="booking-item-date"><?php echo !empty($data_time['arrive_date'])?strtoupper($data_time['arrive_date']):''; ?></p>
                                        </div>
                                        <div class="flight-layovers">
                                            <div class="header duration"><?php echo !empty($data_time['total_time'])?strtoupper($data_time['total_time']):''; ?></div>

                                            <div class="flight-line">
                                                <div class="origin">
                                                    <div class="origin-iata">
                                                        <?php
                                                        echo esc_attr($destination_iata);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="destination">
                                                    <div class="destination-iata">
                                                        <?php
                                                        echo esc_attr($origin_iata);
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                if($flight_type == 'one_stop'){
                                                    ?>
                                                    <div class="stop">
                                                        <div class="iata-stop">
                                                            <?php
                                                            $stop1 = get_post_meta(get_the_ID(), 'airport_stop', true);
                                                            $stop1_iata = get_tax_meta($stop1 , 'iata_airport');
                                                            echo esc_attr($stop1_iata);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if($flight_type == 'two_stops'){
                                                    ?>
                                                    <div class="stop1">
                                                        <div class="iata-stop1">
                                                            <?php
                                                            $stop1 = get_post_meta(get_the_ID(), 'airport_stop_1', true);
                                                            $stop1_iata = get_tax_meta($stop1 , 'iata_airport');
                                                            echo esc_attr($stop1_iata);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="stop2">
                                                        <div class="iata-stop2">
                                                            <?php
                                                            $stop2 = get_post_meta(get_the_ID(), 'airport_stop_2', true);
                                                            $stop2_iata = get_tax_meta($stop2 , 'iata_airport');
                                                            echo esc_attr($stop2_iata);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if($flight_type == 'direct'){
                                                echo '<div class="footer">'.esc_html__('Direct Flight', ST_TEXTDOMAIN).'</div>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $price_eco_flight = ST_Flights_Controller::inst()->get_price_flight(get_the_ID(), strtotime(TravelHelper::convertDateFormat($start)), false);
                                $price_buss_flight = ST_Flights_Controller::inst()->get_price_flight(get_the_ID(), strtotime(TravelHelper::convertDateFormat($start)), true);

                                $enable_tax = get_post_meta(get_the_ID(),'enable_tax',true);
                                $vat_amount = get_post_meta(get_the_ID(),'vat_amount',true);
                                ?>

                                <div class="col-md-12 text-center st-flight-price">
                                    <?php if($price_eco_flight > 0){ ?>
                                    <div class="eco-price st-cal-flight-return">
                                        <span class="booking-item-price"><?php echo TravelHelper::format_money($price_eco_flight); ?></span><span>/<?php echo esc_html__('person', ST_TEXTDOMAIN); ?></span>
                                        <p class="booking-item-flight-class"><?php echo esc_html__('Class', ST_TEXTDOMAIN)?>: <?php echo esc_html__('Economy', ST_TEXTDOMAIN)?></p>
                                        <input data-external="<?php echo esc_html($external); ?>" class="st-choose-flight-depart i-radio" data-tax="<?php echo esc_attr($enable_tax); ?>" data-tax_amount="<?php echo esc_attr($vat_amount); ?>" data-flight_type="depart" type="radio" data-post_id="<?php echo get_the_ID(); ?>" data-price="<?php echo esc_attr($price_eco_flight); ?>" data-business="0" name="flight2" value="<?php echo esc_attr(get_the_ID()); ?>">
                                    </div>
                                    <?php }
                                    if($price_buss_flight > 0){
                                    ?>
                                    <div class="bus-price st-cal-flight-return">
                                        <span class="booking-item-price"><?php echo TravelHelper::format_money($price_buss_flight); ?></span><span>/<?php echo esc_html__('person', ST_TEXTDOMAIN); ?></span>
                                        <p class="booking-item-flight-class"><?php echo esc_html__('Class', ST_TEXTDOMAIN)?>: <?php echo esc_html__('Business', ST_TEXTDOMAIN)?></p>
                                        <input data-external="<?php echo esc_html($external); ?>" class="st-choose-flight-depart i-radio" data-tax="<?php echo esc_attr($enable_tax); ?>" data-tax_amount="<?php echo esc_attr($vat_amount); ?>" data-flight_type="depart" type="radio" data-post_id="<?php echo get_the_ID(); ?>" data-price="<?php echo esc_attr($price_buss_flight); ?>" data-business="1" name="flight2" value="<?php echo esc_attr(get_the_ID()); ?>">
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
<!--                        flight detail-->

                        <div class="booking-item-details">
                            <div class="row">
                                <div class="col-md-8">
                                    <p><?php echo esc_html__('Flight Details', ST_TEXTDOMAIN); ?></p>
                                    <?php
                                    if($flight_type == 'direct'){
                                        echo '<h5 class="list-title">'.get_the_title(st_flight_get_airport_meta('location_from')).' ('.st_flight_get_airport_meta('iata_from').') '.esc_html__('to', ST_TEXTDOMAIN).' '.get_the_title(st_flight_get_airport_meta('location_to')).' ('.st_flight_get_airport_meta('iata_to').')</h5>';
                                        $airline = get_post_meta(get_the_ID(),'airline', true);
                                        ?>
                                        <ul class="list">
                                            <?php
                                            echo '<li>'.$stop_info['airline_name'].'</li>';
                                            echo '<li>'.sprintf(esc_html__('Depart %s Return %s', ST_TEXTDOMAIN), $data_time['depart_time'], $data_time['arrive_time']).'</li>';
                                            echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.($data_time['total_time']).'</li>';
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    if($flight_type == 'one_stop'){
                                        echo '<h5 class="list-title">'.get_the_title($stop_info['origin_location']).' ('.$stop_info['origin_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].')</h5>';
                                        echo '<ul class="list">';
                                        echo '<li>'.$stop_info['airline_name'].'</li>';
                                        echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['depart_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time'].'</li>';
                                        echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['arrival_stop'].'</li>';
                                        echo '</ul>';

                                        echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].') '.$data_time['st_stopover_time'].'</h5>';

                                        echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_location']).' ('.$stop_info['airport_stop_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['destination_location']).' ('.$stop_info['destination_iata'].')</h5>';
                                        echo '<ul class="list">';
                                        echo '<li>'.$stop_info['airline_stop_name'].'</li>';
                                        echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrive_time'].'</li>';
                                        echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop'].'</li>';
                                        echo '</ul>';
                                    }
                                    if($flight_type == 'two_stops'){
                                        echo '<h5 class="list-title">'.get_the_title($stop_info['origin_location']).' ('.$stop_info['origin_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].')</h5>';
                                        echo '<ul class="list">';
                                        echo '<li>'.$stop_info['airline_name'].'</li>';
                                        echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['depart_time'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time_1'].'</li>';
                                        echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['arrival_stop_1'].'</li>';
                                        echo '</ul>';

                                        echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].') '.$data_time['st_stopover_time_1'].'</h5>';

                                        echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_1_location']).' ('.$stop_info['airport_stop_1_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['airport_stop_2_location']).' ('.$stop_info['airport_stop_2_iata'].')</h5>';
                                        echo '<ul class="list">';
                                        echo '<li>'.$stop_info['airline_stop_1_name'].'</li>';
                                        echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time_1'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrival_stop_time_2'].'</li>';
                                        echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop_1'].'</li>';
                                        echo '</ul>';

                                        echo ' <h5>'.esc_html__('Stopover', ST_TEXTDOMAIN).' '.$stop_info['airport_stop_2_location'].' ('.$stop_info['airport_stop_2_iata'].') '.$data_time['st_stopover_time_2'].'</h5>';

                                        echo '<h5 class="list-title">'.get_the_title($stop_info['airport_stop_2_location']).' ('.$stop_info['airport_stop_2_iata'].') '.esc_html__('to',ST_TEXTDOMAIN).' '.get_the_title($stop_info['destination_location']).' ('.$stop_info['destination_iata'].')</h5>';
                                        echo '<ul class="list">';
                                        echo '<li>'.$stop_info['airline_stop_2_name'].'</li>';
                                        echo '<li>'.esc_html__('Depart', ST_TEXTDOMAIN).' '.$data_time['departure_stop_time_2'].' '.esc_html__('Return', ST_TEXTDOMAIN).' '.$data_time['arrive_time'].'</li>';
                                        echo '<li>'.esc_html__('Duration', ST_TEXTDOMAIN).': '.$data_time['departure_stop_2'].'</li>';
                                        echo '</ul>';
                                    }
                                    ?>


                                    <?php
                                    if (!empty($data_time['total_time'])) {
                                        ?>
                                        <p><?php echo esc_html__('Total trip time', ST_TEXTDOMAIN); ?>
                                            : <?php echo esc_attr($data_time['total_time']); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="row">
            <?php
            TravelHelper::paging_flight($query2, 'paged2', 'paged1');
        ?>
        </div>
    <?php }
}?>
<p class="text-right"><?php echo esc_html__('Not what you\'re looking for?', ST_TEXTDOMAIN); ?> <a class="popup-text" href="#search-flight-dialog" data-effect="mfp-zoom-out"><?php echo esc_html__('Try your search again', ST_TEXTDOMAIN)?></a>
</p>

    </div>
    <?php if ($has_post_depart) { ?>
        <div class="st-flight-booking st-sticky">
            <div class="flight-booking">
                <form class="booking-flight-form" method="post" action="#">
                    <h4 class="flight-title"><?php echo esc_html__('Flight Information', ST_TEXTDOMAIN); ?></h4>
                    <div class="your-booking-content">
                        <h5 class="title"><?php echo esc_html__('Departure Flight', ST_TEXTDOMAIN) ?></h5>
                        <div class="caption">
                            <p><strong><?php echo esc_html__('From: ', ST_TEXTDOMAIN); ?></strong>
                                <?php
                                $location_id = get_tax_meta($from_id, 'location_id');
                                $from_iata = get_tax_meta($from_id, 'iata_airport');
                                $from = get_the_title($location_id) . ' (' . $from_iata . ') ';
                                echo esc_attr($from);
                                ?>
                            </p>
                            <p><strong><?php echo esc_html__('To: ', ST_TEXTDOMAIN); ?></strong>
                                <?php
                                $location_id = get_tax_meta($to_id, 'location_id');
                                $to_iata = get_tax_meta($to_id, 'iata_airport');
                                $to = get_the_title($location_id) . ' (' . $to_iata . ') ';
                                echo esc_attr($to);
                                ?>
                            </p>
                            <p><strong>
                                    <?php echo esc_html__('Departure Date: ', ST_TEXTDOMAIN); ?></strong>
                                <?php
                                $str_start = strtotime(TravelHelper::convertDateFormat($depart_date));
                                $start_date = date(get_option('date_format'), $str_start);
                                echo esc_attr($start_date);
                                ?>
                            </p>
                            <div class="st-booking-select-depart hidden">
                                <p class="fare"><strong>
                                        <?php echo esc_html__('Fare: ', ST_TEXTDOMAIN); ?></strong>
                                    <span class="price"></span>
                                </p>
                                <p class="tax"><strong>
                                        <?php echo esc_html__('Tax: ', ST_TEXTDOMAIN); ?></strong>
                                    <span class="price"></span>
                                </p>
                                <p class="total"><strong>
                                        <?php echo esc_html__('Total: ', ST_TEXTDOMAIN); ?></strong>
                                    <span class="price"></span>
                                </p>
                            </div>
                        </div>
                        <?php
                        if (!$on_way) {
                            ?>
                            <h5 class="title"><?php echo esc_html__('Return Flight', ST_TEXTDOMAIN) ?></h5>
                            <div class="caption">
                                <p><strong><?php echo esc_html__('From: ', ST_TEXTDOMAIN);
                                        ?>
                                    </strong>
                                    <?php
                                    $location_id = get_tax_meta($to_id, 'location_id');
                                    $to_iata = get_tax_meta($to_id, 'iata_airport');
                                    $to = get_the_title($location_id) . ' (' . $to_iata . ') ';
                                    echo esc_attr($to);
                                    ?>
                                </p>
                                <p><strong><?php echo esc_html__('To: ', ST_TEXTDOMAIN);
                                        ?>
                                    </strong>
                                    <?php
                                    $location_id = get_tax_meta($from_id, 'location_id');
                                    $from_iata = get_tax_meta($from_id, 'iata_airport');
                                    $from = get_the_title($location_id) . ' (' . $from_iata . ') ';
                                    echo esc_attr($from);
                                    ?>
                                </p>
                                <p><strong>
                                        <?php echo esc_html__('Return Date: ', ST_TEXTDOMAIN);
                                        ?>
                                    </strong>
                                    <?php
                                    $str_end = strtotime(TravelHelper::convertDateFormat($return_date));
                                    $end_date = date(get_option('date_format'), $str_end);
                                    echo esc_attr($end_date);
                                    ?>
                                </p>
                                <div class="st-booking-select-return hidden">
                                    <p class="fare"><strong>
                                            <?php echo esc_html__('Fare: ', ST_TEXTDOMAIN); ?></strong>
                                        <span class="price"></span>
                                    </p>
                                    <p class="tax"><strong>
                                            <?php echo esc_html__('Tax: ', ST_TEXTDOMAIN); ?></strong>
                                        <span class="price"></span>
                                    </p>
                                    <p class="total"><strong>
                                            <?php echo esc_html__('Total: ', ST_TEXTDOMAIN); ?></strong>
                                        <span class="price"></span>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="passengers"><?php echo esc_html__('Number of passengers: ', ST_TEXTDOMAIN); ?> <span
                                class="count-p"><?php echo esc_attr($passenger); ?></span></div>
                        <div class="st-flight-total-price">
                            <p><?php echo esc_html__('Grand Total', ST_TEXTDOMAIN); ?>: <span class="price"><?php echo TravelHelper::format_money(0); ?></span></p>
                        </div>
                        <?php wp_nonce_field('st_search_flight');
                        ?>
                        <input type="hidden" name="action" value="st_flight_add_to_cart">
                        <input type="hidden" name="flight_type" value="<?php echo esc_attr($f_type); ?>">
                        <input type="hidden" name="price_class_depart" value="">
                        <input type="hidden" name="price_class_return" value="">
                        <input type="hidden" name="depart_id" value="">
                        <input type="hidden" name="return_id" value="">
                        <input type="hidden" name="passenger" value="<?php echo esc_attr($passenger); ?>">
                        <?php
                        $str_start = strtotime(TravelHelper::convertDateFormat($depart_date));
                        $str_end = strtotime(TravelHelper::convertDateFormat($return_date));
                        ?>
                        <input type="hidden" name="depart_date" value="<?php echo esc_attr($str_start); ?>">
                        <input type="hidden" name="return_date" value="<?php echo esc_attr($str_end); ?>">
                        <div class="flight-message">

                        </div
                        <div class="st-book-now">
                            <button class="btn btn-primary flight-book-now" type="submit" ><?php echo esc_html__('Book Now', ST_TEXTDOMAIN); ?><i class="fa fa-spinner fa-spin"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
}?>

<?php echo '</div>';?>