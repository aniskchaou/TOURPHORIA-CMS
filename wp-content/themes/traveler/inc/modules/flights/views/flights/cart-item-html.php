<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/30/2017
 * Version: 1.0
 */
$cart = STCart::get_carts();
if(!empty($cart) && is_array($cart)) {
    foreach ($cart as $key => $val) {
        if (!empty($val['data'] && is_array($val['data']))) {
            $depart_data_location = $val['data']['depart_data_location'];
            $depart_data_time = $val['data']['depart_data_time'];
            ?>
            <header class="clearfix">
                <h5 class="mb0"><?php echo get_the_title($depart_data_location['origin_location']); ?> - <?php echo get_the_title($depart_data_location['destination_location']); ?></h5>
            </header>
            <ul class="booking-item-payment-details">

                <li>
                    <h5><?php echo esc_html__('Flight Details', ST_TEXTDOMAIN); ?></h5>
                    <div class="booking-item-payment-flight">
                        <?php
                        if($val['data']['depart_stop'] == 'direct'){
                        ?>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="booking-item-flight-details">
                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                        <h5><?php echo esc_attr($val['data']['depart_data_time']['depart_time']); ?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($val['data']['depart_data_time']['depart_date']); ?></p>
                                        <p class="booking-item-destination">
                                            <?php
                                            echo esc_attr($depart_data_location['origin_location_full']);
                                            ?>
                                            (<?php echo esc_html($depart_data_location['origin_iata']); ?>)</p>
                                    </div>
                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                        <h5><?php echo esc_attr($val['data']['depart_data_time']['arrive_time']); ?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($val['data']['depart_data_time']['arrive_date']); ?></p>
                                        <p class="booking-item-destination"><?php echo esc_html($depart_data_location['destination_location_full']); ?> (<?php echo esc_html($depart_data_location['destination_iata']); ?>)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="booking-item-flight-duration">
                                    <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                    <h5><?php echo esc_html($depart_data_time['total_time'])?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        if($val['data']['depart_stop'] == 'one_stop'){
                        ?>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="booking-item-flight-details">
                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                        <h5><?php echo esc_attr(strtoupper($depart_data_time['depart_time'])); ?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($depart_data_time['depart_date']); ?></p>
                                        <p class="booking-item-destination"><?php echo esc_html($depart_data_location['origin_location_full']); ?> (<?php echo esc_html($depart_data_location['origin_iata']); ?>)</p>
                                    </div>
                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                        <h5><?php echo esc_attr($depart_data_time['arrival_stop_time']); ?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($depart_data_time['arrival_stop_date']); ?></p>
                                        <p class="booking-item-destination"><?php echo esc_html($depart_data_location['airport_stop_location_full']); ?> (<?php echo esc_html($depart_data_location['airport_stop_iata']); ?>)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="booking-item-flight-duration">
                                    <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                    <h5><?php echo esc_html($depart_data_time['arrival_stop'])?></h5>
                                </div>
                            </div>
                        </div>
                        <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($depart_data_time['st_stopover_time'])?> <?php echo get_the_title($depart_data_location['airport_stop_location'])?></p>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="booking-item-flight-details">
                                    <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                        <h5><?php echo esc_html($depart_data_time['departure_stop_time'])?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($depart_data_time['departure_stop_date']); ?></p>
                                        <p class="booking-item-destination"><?php echo esc_attr($depart_data_location['airport_stop_location_full'])?> (<?php echo esc_attr($depart_data_location['airport_stop_iata'])?>)</p>
                                    </div>
                                    <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                        <h5><?php echo esc_html($depart_data_time['arrive_time'])?></h5>
                                        <p class="booking-item-date"><?php echo esc_attr($depart_data_time['arrive_date']); ?></p>
                                        <p class="booking-item-destination"><?php echo esc_html($depart_data_location['destination_location_full']); ?> (<?php echo esc_html($depart_data_location['destination_iata']); ?>)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="booking-item-flight-duration">
                                    <p><?php echo esc_html__('Duration', ST_TEXTDOMAIN)?></p>
                                    <h5><?php echo esc_html($depart_data_time['departure_stop'])?></h5>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        <?php if($val['data']['depart_stop'] == 'two_stops'){
                            ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="booking-item-flight-details">
                                        <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                            <h5><?php echo esc_attr(strtoupper($depart_data_time['depart_time'])); ?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['depart_date']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_html($depart_data_location['origin_location_full']); ?> (<?php echo esc_html($depart_data_location['origin_iata']); ?>)</p>
                                        </div>
                                        <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                            <h5><?php echo esc_attr($depart_data_time['arrival_stop_time_1']); ?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['arrival_stop_date_1']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_html($depart_data_location['airport_stop_1_location_full']); ?> (<?php echo esc_html($depart_data_location['airport_stop_1_iata']); ?>)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="booking-item-flight-duration">
                                        <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                        <h5><?php echo esc_html($depart_data_time['arrival_stop_1'])?></h5>
                                    </div>
                                </div>
                            </div>
                            <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($depart_data_time['st_stopover_time_1'])?> <?php echo get_the_title($depart_data_location['airport_stop_1_location'])?></p>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="booking-item-flight-details">
                                        <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                            <h5><?php echo esc_attr(strtoupper($depart_data_time['departure_stop_time_1'])); ?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['departure_stop_date_1']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_html($depart_data_location['airport_stop_1_location_full']); ?> (<?php echo esc_html($depart_data_location['airport_stop_1_iata']); ?>)</p>
                                        </div>
                                        <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                            <h5><?php echo esc_attr($depart_data_time['arrival_stop_time_2']); ?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['arrival_stop_date_2']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_html($depart_data_location['airport_stop_2_location_full']); ?> (<?php echo esc_html($depart_data_location['airport_stop_2_iata']); ?>)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="booking-item-flight-duration">
                                        <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                        <h5><?php echo esc_html($depart_data_time['arrival_stop_2'])?></h5>
                                    </div>
                                </div>
                            </div>
                            <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($depart_data_time['st_stopover_time_2'])?> <?php echo get_the_title($depart_data_location['airport_stop_2_location'])?></p>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="booking-item-flight-details">
                                        <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                            <h5><?php echo esc_html($depart_data_time['departure_stop_time_2'])?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['departure_stop_date_2']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_attr($depart_data_location['airport_stop_2_location_full'])?> (<?php echo esc_attr($depart_data_location['airport_stop_2_iata'])?>)</p>
                                        </div>
                                        <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                            <h5><?php echo esc_html($depart_data_time['arrive_time'])?></h5>
                                            <p class="booking-item-date"><?php echo esc_attr($depart_data_time['arrive_date']); ?></p>
                                            <p class="booking-item-destination"><?php echo esc_html($depart_data_location['destination_location_full']); ?> (<?php echo esc_html($depart_data_location['destination_iata']); ?>)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="booking-item-flight-duration">
                                        <p><?php echo esc_html__('Duration', ST_TEXTDOMAIN)?></p>
                                        <h5><?php echo esc_html($depart_data_time['departure_stop'])?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </li>
                <!--    passengers-->
                <li>
                    <h5><?php echo esc_html__('Flight', ST_TEXTDOMAIN); ?>
                        (<?php echo sprintf(_n('%d Passenger', '%d Passengers', $val['data']['passenger'], ST_TEXTDOMAIN), $val['data']['passenger']) ?>
                        )</h5>
                    <ul class="booking-item-payment-price">
                        <li>
                            <p class="booking-item-payment-price-title"><?php echo sprintf(_n('%d Passenger', '%d Passengers', $val['data']['passenger'], ST_TEXTDOMAIN), $val['data']['passenger']) ?></p>
                            <p class="booking-item-payment-price-amount"><?php echo TravelHelper::format_money($val['data']['depart_price']); ?>
                                <small>/<?php echo esc_html__('per passenger', ST_TEXTDOMAIN) ?></small>
                            </p>
                        </li>
                        <?php if($val['data']['enable_tax_depart'] == 'yes_not_included')?>
                        <li>
                            <p class="booking-item-payment-price-title"><?php echo esc_html__('Taxes', ST_TEXTDOMAIN) ?></p>
                            <p class="booking-item-payment-price-amount"><?php echo TravelHelper::format_money($val['data']['tax_price_depart']); ?>
                                <small>/<?php echo esc_html__('per passenger', ST_TEXTDOMAIN) ?></small>
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php
            if($val['data']['flight_type'] == 'return'){
                //return
                $return_data_location = $val['data']['return_data_location'];
                $return_data_time = $val['data']['return_data_time'];
                ?>
                <header class="clearfix">
                    <h5 class="mb0"><?php echo get_the_title($return_data_location['origin_location']); ?> - <?php echo get_the_title($return_data_location['destination_location']); ?></h5>
                </header>
                <ul class="booking-item-payment-details">
                    <li>
                        <h5><?php echo esc_html__('Flight Details', ST_TEXTDOMAIN); ?></h5>
                        <div class="booking-item-payment-flight">
                            <?php
                            if($val['data']['return_stop'] == 'direct'){
                                ?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_attr($return_data_time['depart_time']); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['depart_date']); ?></p>
                                                <p class="booking-item-destination">
                                                    <?php
                                                    echo esc_attr($return_data_location['origin_location_full']);
                                                    ?>
                                                    (<?php echo esc_html($return_data_location['origin_iata']); ?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_attr($return_data_time['arrive_time']); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrive_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['destination_location_full']); ?> (<?php echo esc_html($return_data_location['destination_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                            <h5><?php echo esc_html($return_data_time['total_time'])?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            if($val['data']['return_stop'] == 'one_stop'){
                                ?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_attr(strtoupper($return_data_time['depart_time'])); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['depart_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['origin_location_full']); ?> (<?php echo esc_html($return_data_location['origin_iata']); ?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_attr($return_data_time['arrival_stop_time']); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrival_stop_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['airport_stop_location_full']); ?> (<?php echo esc_html($return_data_location['airport_stop_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                            <h5><?php echo esc_html($return_data_time['arrival_stop'])?></h5>
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($return_data_time['st_stopover_time'])?> <?php echo get_the_title($return_data_location['airport_stop_location'])?></p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_html($return_data_time['departure_stop_time'])?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['departure_stop_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_attr($return_data_location['airport_stop_location_full'])?> (<?php echo esc_attr($return_data_location['airport_stop_iata'])?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_html($return_data_time['arrive_time'])?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrive_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['destination_location_full']); ?> (<?php echo esc_html($return_data_location['destination_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_html__('Duration', ST_TEXTDOMAIN)?></p>
                                            <h5><?php echo esc_html($return_data_time['departure_stop'])?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php

                            if($val['data']['return_stop'] == 'two_stops'){
                                ?>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_attr(strtoupper($return_data_time['depart_time'])); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['depart_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['origin_location_full']); ?> (<?php echo esc_html($return_data_location['origin_iata']); ?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_attr($return_data_time['arrival_stop_time_1']); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrival_stop_date_1']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['airport_stop_1_location_full']); ?> (<?php echo esc_html($return_data_location['airport_stop_1_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                            <h5><?php echo esc_html($return_data_time['arrival_stop_1'])?></h5>
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($return_data_time['st_stopover_time_1'])?> <?php echo get_the_title($return_data_location['airport_stop_1_location'])?></p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_attr(strtoupper($return_data_time['departure_stop_time_1'])); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['departure_stop_date_1']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['airport_stop_1_location_full']); ?> (<?php echo esc_html($return_data_location['airport_stop_1_iata']); ?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_attr($return_data_time['arrival_stop_time_2']); ?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrival_stop_date_2']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['airport_stop_2_location_full']); ?> (<?php echo esc_html($return_data_location['airport_stop_2_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_attr('Duration', ST_TEXTDOMAIN) ?></p>
                                            <h5><?php echo esc_html($return_data_time['arrival_stop_2'])?></h5>
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo esc_html__('STOP', ST_TEXTDOMAIN); ?> <?php echo esc_attr($return_data_time['st_stopover_time_2'])?> <?php echo get_the_title($return_data_location['airport_stop_2_location'])?></p>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="booking-item-flight-details">
                                            <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                <h5><?php echo esc_html($return_data_time['departure_stop_time_2'])?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['departure_stop_date_2']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_attr($return_data_location['airport_stop_2_location_full'])?> (<?php echo esc_attr($return_data_location['airport_stop_2_iata'])?>)</p>
                                            </div>
                                            <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                <h5><?php echo esc_html($return_data_time['arrive_time'])?></h5>
                                                <p class="booking-item-date"><?php echo esc_attr($return_data_time['arrive_date']); ?></p>
                                                <p class="booking-item-destination"><?php echo esc_html($return_data_location['destination_location_full']); ?> (<?php echo esc_html($return_data_location['destination_iata']); ?>)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="booking-item-flight-duration">
                                            <p><?php echo esc_html__('Duration', ST_TEXTDOMAIN)?></p>
                                            <h5><?php echo esc_html($return_data_time['departure_stop'])?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                    <!--    passengers-->
                    <li>
                        <h5><?php echo esc_html__('Flight', ST_TEXTDOMAIN); ?>
                            (<?php echo sprintf(_n('%d Passenger', '%d Passengers', $val['data']['passenger'], ST_TEXTDOMAIN), $val['data']['passenger']) ?>
                            )</h5>
                        <ul class="booking-item-payment-price">
                            <li>
                                <p class="booking-item-payment-price-title"><?php echo sprintf(_n('%d Passenger', '%d Passengers', $val['data']['passenger'], ST_TEXTDOMAIN), $val['data']['passenger']) ?></p>
                                <p class="booking-item-payment-price-amount"><?php echo TravelHelper::format_money($val['data']['return_price']); ?>
                                    <small>/<?php echo esc_html__('per passenger', ST_TEXTDOMAIN) ?></small>
                                </p>
                            </li>
                            <?php if($val['data']['enable_tax_return'] == 'yes_not_included')?>
                            <li>
                                <p class="booking-item-payment-price-title"><?php echo esc_html__('Taxes', ST_TEXTDOMAIN) ?></p>
                                <p class="booking-item-payment-price-amount"><?php echo TravelHelper::format_money($val['data']['tax_price_return']); ?>
                                    <small>/<?php echo esc_html__('per passenger', ST_TEXTDOMAIN) ?></small>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php
            }
            $price_with_tax = $val['data']['total_price'];
            if(!empty($val['data']['booking_fee_price'])){
                $price_with_tax = $price_with_tax + $val['data']['booking_fee_price'];
                ?>
                <p class="booking-item-payment-total booking-fee"><?php echo esc_html__('Fee', ST_TEXTDOMAIN) ?>
                    <span class="float-right"><?php echo TravelHelper::format_money($val['data']['booking_fee_price']); ?></span>
                </p>
            <?php } ?>


            <p class="booking-item-payment-total booking-total"><?php echo esc_html__('Total trip', ST_TEXTDOMAIN) ?>
                <span class="float-right"><?php echo TravelHelper::format_money($price_with_tax); ?></span>
            </p>
        <?php }
    }
}?>