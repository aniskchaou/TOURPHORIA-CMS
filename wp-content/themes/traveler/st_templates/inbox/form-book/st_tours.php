<?php
wp_enqueue_script('custom_tour_inbox');
wp_enqueue_script('st-qtip');
$booking_data = $message_data['booking_data'];
$check_in = STInput::request('check_in', '');
$check_out = STInput::request('check_out', '');
$adult_number = STInput::request('adult_number');
$child_number = STInput::request('child_number');
$infant_number = STInput::request('infant_number');
$extra = STInput::request("extra_price");
$starttime_value = STInput::request('starttime_tour', '');
$hotel_selected = STInput::request('hotel_package', '');
$activity_selected = STInput::request('activity_package', '');
$car_selected = STInput::request('car_quantity', '');
$flight_selected = STInput::request('flight_package', '');
$controls = STInput::request('guest_name');
$guest_titles = STInput::request('guest_title');

$action = STInput::request('action', '');

if(empty($action)) {
	if ( ! empty( $booking_data ) ) {
		$booking_data = json_decode( $booking_data, true );
		if(isset($booking_data['check_in']))
            $check_in = $booking_data['check_in'];
		if ( isset( $booking_data['check_out'] ) ) {
			$check_out = $booking_data['check_out'];
		}
		if ( isset( $booking_data['adult_number'] ) ) {
			$adult_number = $booking_data['adult_number'];
		}
		if ( isset( $booking_data['child_number'] ) ) {
			$child_number = $booking_data['child_number'];
		}
		if ( isset( $booking_data['infant_number'] ) ) {
			$infant_number = $booking_data['infant_number'];
		}
		if ( isset( $booking_data['extra_price'] ) ) {
			$extra = $booking_data['extra_price'];
		}
		if ( isset( $booking_data['starttime_tour'] ) ) {
			$starttime_value = $booking_data['starttime_tour'];
		}
		if ( isset( $booking_data['hotel_package'] ) ) {
			$hotel_selected = $booking_data['hotel_package'];
		}
		if ( isset( $booking_data['activity_package'] ) ) {
			$activity_selected = $booking_data['activity_package'];
		}
		if ( isset( $booking_data['car_quantity'] ) ) {
			$car_selected = $booking_data['car_quantity'];
		}
		if ( isset( $booking_data['flight_package'] ) ) {
			$flight_selected = $booking_data['flight_package'];
		}
		$controls = isset($booking_data['guest_name']) ? $booking_data['guest_name'] : '';
		$guest_titles = isset($booking_data['guest_title']) ? $booking_data['guest_title'] : '';
	}
}

$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
$type_tour = get_post_meta($post_id, 'type_tour', true);
$max_people = get_post_meta($post_id, 'max_people', true);
$max_select = 0;
if ($max_people == '' || $max_people == '0' || !is_numeric($max_people)) {
	$max_select = 20;
} else {
	$max_select = $max_people;
}
$hotel_package = get_post_meta($post_id, 'tour_packages', true);
$hotel_package_custom = get_post_meta($post_id, 'tour_packages_custom', true);
$activity_package = get_post_meta($post_id, 'tour_packages_activity', true);
$activity_package_custom = get_post_meta($post_id, 'tour_packages_custom_activity', true);
$car_package = get_post_meta($post_id, 'tour_packages_car', true);
$car_package_custom = get_post_meta($post_id, 'tour_packages_custom_car', true);
$flight_package = get_post_meta($post_id, 'tour_packages_flight', true);
$flight_package_custom = get_post_meta($post_id, 'tour_packages_custom_flight', true);

$bg_thumb = '';
if(has_post_thumbnail($post_id)){
    $bg_thumb = get_the_post_thumbnail_url($post_id, 'full');
}else{
    $bg_thumb = get_template_directory_uri() . '/img/no-image.png';
}
?>
    <form id="form-booking-inpage" method="post" class="form-has-guest-name" action="#booking-request">
        <div class="st-inbox-form-book">
            <?php if(!empty($bg_thumb)){ ?>
                <a href="<?php echo get_the_permalink($post_id); ?>">
                    <div class="thumb" style="background-image: url('<?php echo esc_url($bg_thumb); ?>')"></div>
                </a>
            <?php } ?>
            <h3><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
            <div class="section">
                <div class="package-book-now-button">
                    <input type="hidden" name="action" value="tours_add_to_cart">
                    <input type="hidden" name="item_id" value="<?php echo esc_html($post_id); ?>">
                    <input type="hidden" name="type_tour" value="<?php echo esc_html($type_tour) ?>">
                    <div class="div_book">
                        <div class="booking-meta">
                            <div class="meta-item">
                                <div class="meta-title"><i class="fa fa-calendar"></i> <?php echo __('Trip date', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value"><a href="#list_tour_item" id="select-a-tour" class="btn btn-primary btn-sm"><?php echo __('Select date', ST_TEXTDOMAIN); ?></a></div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Departure date', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value"><input id="check_in" type="text" name="check_in"
                                                               value="<?php echo esc_html($check_in); ?>" readonly="readonly"
                                                               class="form-control" /></div>
                            </div>
                            <div class="meta-item" style="display: none">
                                <div class="meta-title"><?php echo __('Return date', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value"><input id="check_out" type="text" name="check_out"
                                                               value="<?php echo esc_html($check_out); ?>" readonly="readonly"
                                                               class="form-control" /></div>
                            </div>
                            <?php if (get_post_meta($post_id, 'hide_adult_in_booking_form', true) != 'on'): ?>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Adults', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select class="form-control adult_number" name="adult_number" required>
                                        <?php for ($i = 0; $i <= $max_select; $i++) {
                                            $is_select = '';
                                            if (!empty($adult_number)) {
                                                if($adult_number == $i) {
                                                    $is_select = 'selected="selected"';
                                                }
                                            }else{
                                                if($i == 1){
                                                    $is_select = 'selected="selected"';
                                                }
                                            }
                                            echo "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (get_post_meta($post_id, 'hide_children_in_booking_form', true) != 'on'): ?>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Children', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select class="form-control child_number" name="child_number" required>
                                        <?php for ($i = 0; $i <= $max_select; $i++) {
                                            $is_select = '';
                                            if ($child_number == $i) {
                                                $is_select = 'selected="selected"';
                                            }
                                            echo "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (get_post_meta($post_id, 'hide_infant_in_booking_form', true) != 'on'): ?>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Infant', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select class="form-control infant_number" name="infant_number" required>
                                        <?php for ($i = 0; $i <= $max_select; $i++) {
                                            $is_select = '';
                                            if ($infant_number == $i) {
                                                $is_select = 'selected="selected"';
                                            }
                                            echo "<option {$is_select} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>
                            <!--Starttime-->
                                <input type="hidden" data-starttime="<?php echo esc_attr($starttime_value); ?>"
                                       data-checkin="<?php echo esc_attr($check_in); ?>" data-checkout="<?php echo esc_attr($check_out); ?>"
                                       data-tourid="<?php echo esc_attr($post_id); ?>" id="starttime_hidden_load_form"/>
                                <div class="mt10 mb20"
                                     id="starttime_box" <?php echo empty($starttime_value) ? 'style="display: none;"' : ''; ?>>
                                    <label><?php echo __('Start time', ST_TEXTDOMAIN); ?></label>
                                    <select class="form-control st_tour_starttime" name="starttime_tour"
                                            id="starttime_tour"></select>
                                </div>
                            <!--End starttime-->
                            <!--Extra price-->
	                        <?php $extra_price = get_post_meta($post_id, 'extra_price', true); ?>
	                        <?php if (is_array($extra_price) && count($extra_price)): ?>
		                        <?php
		                        if (!empty($extra['value'])) {
			                        $extra_value = $extra['value'];
		                        }
		                        ?>
                                <label><?php echo __('Extra', ST_TEXTDOMAIN); ?></label>
                                <table class="table extra">
			                        <?php foreach ($extra_price as $key => $val): ?>
                                        <tr>
                                            <td width="75%">
                                                <label for="field-<?php echo esc_attr($val['extra_name']); ?>"
                                                       class="ml20 mt5"><?php echo esc_html($val['title']) . ' (' . TravelHelper::format_money($val['extra_price']) . ')'; ?>
							                        <?php
							                        if(isset($val['extra_required'])){
								                        if($val['extra_required'] == 'on') {
									                        echo '<small class="stour-required-extra" data-toggle="tooltip" data-placement="top" title="' . __('Required extra service', ST_TEXTDOMAIN) . '">(<span>*</span>)</small>';
								                        }
							                        }
							                        ?>
                                                </label>
                                                <input type="hidden"
                                                       name="extra_price[price][<?php echo esc_attr($val['extra_name']); ?>]"
                                                       value="<?php echo esc_html($val['extra_price']); ?>">
                                                <input type="hidden"
                                                       name="extra_price[title][<?php echo esc_attr($val['extra_name']); ?>]"
                                                       value="<?php echo esc_html($val['title']); ?>">
                                            </td>
                                            <td width="25%">
                                                <select style="width: 100px" class="form-control app"
                                                        name="extra_price[value][<?php echo esc_attr($val['extra_name']); ?>]"
                                                        id="field-<?php echo esc_attr($val['extra_name']); ?>">
							                        <?php
							                        $max_item = intval($val['extra_max_number']);
							                        if ($max_item <= 0) $max_item = 1;
							                        $start_i = 0;
							                        if(isset($val['extra_required'])) {
								                        if ($val['extra_required'] == 'on') {
									                        $start_i = 1;
								                        }
							                        }
							                        for ($i = $start_i; $i <= $max_item; $i++):
								                        $check = "";
								                        if (!empty($extra_value[$val['extra_name']]) and $i == $extra_value[$val['extra_name']]) {
									                        $check = "selected";
								                        }
								                        ?>
                                                        <option <?php echo esc_html($check) ?>
                                                                value="<?php echo esc_html($i); ?>"><?php echo esc_html($i); ?></option>
							                        <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>
			                        <?php endforeach; ?>
                                </table>
	                        <?php endif; ?>

                                <!-- Tour Package -->
		                        <?php if(STTour::_check_empty_package($hotel_package, $hotel_package_custom) || STTour::_check_empty_package($activity_package, $activity_package_custom) || STTour::_check_empty_package($car_package, $car_package_custom) || STTour::_check_empty_package($flight_package, $flight_package_custom)) { ?>
                                    <label><?php echo __('Tour Packages', ST_TEXTDOMAIN); ?></label>
                                    <div class="accordion stour-accor" id="">
				                        <?php
				                        if (STTour::_check_empty_package($hotel_package, $hotel_package_custom)) {
					                        $hotel_ids_selected = TravelHelper::get_ids_selected_tour_package($hotel_selected, 'hotel');
					                        ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseOne">
								                        <?php echo __('Select Hotel Package', ST_TEXTDOMAIN); ?>
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="accordion-body collapse">
                                                    <div class="accordion-inner">
                                                        <div class="sroom-extra-service st-tour-package">
                                                            <div class="">
                                                                <div class="extra-price">
                                                                    <table class="table" style="table-layout: fixed;">
												                        <?php if(is_object($hotel_package)){ ?>
													                        <?php if (!empty((array)$hotel_package)) { ?>
														                        <?php foreach ($hotel_package as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="" class="tour-package-hotel-check">
																	                        <?php
																	                        $hotel_package_data = new stdClass();
																	                        $hotel_package_data->hotel_name = trim(get_the_title($val->hotel_id));
																	                        $hotel_package_data->hotel_price = $val->hotel_price;
																	                        $hotel_package_data->hotel_star = intval( get_post_meta( $val->hotel_id, 'hotel_star', true ) );
																	                        ?>
                                                                                            <input id="field-<?php echo esc_attr($val->hotel_id); ?>"
                                                                                                   type="checkbox" class="i-check"
                                                                                                   name="hotel_package[<?php echo esc_attr($val->hotel_id); ?>][]"
                                                                                                   value="<?php echo htmlspecialchars(json_encode($hotel_package_data)); ?>" <?php echo in_array($val->hotel_id, $hotel_ids_selected) ? 'checked': ''; ?>/>
                                                                                            <label for="field-<?php echo esc_attr($val->hotel_id); ?>"
                                                                                                   class="ml20"><?php echo get_the_title($val->hotel_id) . ' (' . TravelHelper::format_money($val->hotel_price) . ')'; ?>
																		                        <?php
																		                        $star = get_post_meta( $val->hotel_id, 'hotel_star', true );
																		                        echo '<ul class="icon-list icon-group booking-item-rating-stars">';
																		                        echo TravelHelper::rate_to_string($star);
																		                        echo '</ul>';
																		                        ?>
                                                                                            </label>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
												                        <?php if(is_object($hotel_package_custom)){ ?>
													                        <?php if (!empty((array)$hotel_package_custom)) { ?>
														                        <?php foreach ($hotel_package_custom as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="100%" class="tour-package-hotel-check">
																	                        <?php
																	                        $hotel_package_data = new stdClass();
																	                        $hotel_package_data->hotel_name = trim($val->hotel_name);
																	                        $hotel_package_data->hotel_price = $val->hotel_price;
																	                        $hotel_package_data->hotel_star = $val->hotel_star;
																	                        ?>
                                                                                            <input id="hotel-custom-<?php echo 'custom_' . $key; ?>" type="checkbox"
                                                                                                   class="i-check" name="hotel_package[<?php echo 'custom_' . $key; ?>][]"
                                                                                                   value="<?php echo htmlspecialchars(json_encode($hotel_package_data)); ?>" <?php echo in_array('custom_' . $key, $hotel_ids_selected) ? 'checked': ''; ?>/>
                                                                                            <label for="hotel-custom-<?php echo esc_attr($key); ?>"
                                                                                                   class="ml20"><?php echo esc_html($val->hotel_name) . ' (' . TravelHelper::format_money($val->hotel_price) . ')'; ?>
																		                        <?php
																		                        $star = $val->hotel_star;
																		                        echo '<ul class="icon-list icon-group booking-item-rating-stars">';
																		                        echo TravelHelper::rate_to_string($star);
																		                        echo '</ul>';
																		                        ?>
                                                                                            </label>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
				                        <?php } ?>
				                        <?php
				                        if (STTour::_check_empty_package($activity_package, $activity_package_custom)) {
					                        $activity_ids_selected = TravelHelper::get_ids_selected_tour_package($activity_selected, 'hotel');
					                        ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo">
								                        <?php echo __('Select Activity Package', ST_TEXTDOMAIN); ?>
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="accordion-body collapse">
                                                    <div class="accordion-inner">

                                                        <div class="sroom-extra-service st-tour-package">
                                                            <div class="">
                                                                <div class="extra-price">
                                                                    <table class="table" style="table-layout: fixed;">
												                        <?php if(is_object($activity_package)){ ?>
													                        <?php if (!empty((array)$activity_package)) { ?>
														                        <?php foreach ($activity_package as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="" class="tour-package-hotel-check car-check">
																	                        <?php
																	                        $activity_package_data = new stdClass();
																	                        $activity_package_data->activity_name = trim(get_the_title($val->activity_id));
																	                        $activity_package_data->activity_price = $val->activity_price;
																	                        ?>
                                                                                            <input id="field-<?php echo esc_attr($val->activity_id); ?>"
                                                                                                   type="checkbox" class="i-check"
                                                                                                   name="activity_package[<?php echo esc_attr($val->activity_id); ?>][]"
                                                                                                   value="<?php echo htmlspecialchars(json_encode($activity_package_data)); ?>" <?php echo in_array($val->activity_id, $activity_ids_selected) ? 'checked': ''; ?>/>
                                                                                            <label for="field-<?php echo esc_attr($val->activity_id); ?>"
                                                                                                   class="ml20"><?php echo get_the_title($val->activity_id) . ' (' . TravelHelper::format_money($val->activity_price) . ')'; ?>
                                                                                            </label>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
												                        <?php if(is_object($activity_package_custom)){ ?>
													                        <?php if (!empty((array)$activity_package_custom)) { ?>
														                        <?php foreach ($activity_package_custom as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="100%" class="tour-package-hotel-check car-check">
																	                        <?php
																	                        $activity_package_data = new stdClass();
																	                        $activity_package_data->activity_name = trim($val->activity_name);
																	                        $activity_package_data->activity_price = $val->activity_price;
																	                        ?>
                                                                                            <input id="activity-custom-<?php echo esc_attr($key); ?>"
                                                                                                   type="checkbox" class="i-check"
                                                                                                   name="activity_package[<?php echo 'custom_' . $key; ?>][]"
                                                                                                   value="<?php echo htmlspecialchars(json_encode($activity_package_data)); ?>" <?php echo in_array('custom_' . $key, $activity_ids_selected) ? 'checked': ''; ?>/>
                                                                                            <label for="activity-custom-<?php echo esc_attr($key); ?>"
                                                                                                   class="ml20"><?php echo esc_html($val->activity_name) . ' (' . TravelHelper::format_money($val->activity_price) . ')'; ?>
                                                                                            </label>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
				                        <?php } ?>
				                        <?php
				                        if (STTour::_check_empty_package($car_package, $car_package_custom)) {
					                        $car_ids_selected = TravelHelper::get_ids_selected_tour_package($car_selected, 'car');
					                        ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseThree">
								                        <?php echo __('Select Car Package', ST_TEXTDOMAIN); ?>
                                                    </a>
                                                </div>
                                                <div id="collapseThree" class="accordion-body collapse">
                                                    <div class="accordion-inner">

                                                        <div class="sroom-extra-service st-tour-package">
                                                            <div class="">
                                                                <div class="extra-price">
                                                                    <table class="table" style="table-layout: fixed;">
												                        <?php if(is_object($car_package)){ ?>
													                        <?php if (!empty((array)$car_package)) { ?>
														                        <?php foreach ($car_package as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="80%" class="tour-package-hotel-check car-check">
                                                                                            <label for="field-<?php echo esc_attr($val->car_id); ?>"
                                                                                                   class="ml20"><?php echo get_the_title($val->car_id) . ' (' . TravelHelper::format_money($val->car_price) . ')'; ?>
                                                                                            </label>
                                                                                        </td>
                                                                                        <td width="20%">
                                                                                            <input type="hidden" name="car_name[<?php echo esc_attr($val->car_id); ?>][]"
                                                                                                   value="<?php echo trim(get_the_title($val->car_id)); ?>"/>
                                                                                            <input type="hidden" name="car_price[<?php echo esc_attr($val->car_id); ?>][]"
                                                                                                   value="<?php echo esc_html($val->car_price); ?>"/>
                                                                                            <select id="field-<?php echo esc_attr($val->car_id); ?>"
                                                                                                    style="width: 100px" class="form-control app"
                                                                                                    name="car_quantity[<?php echo esc_attr($val->car_id); ?>][]">
																		                        <?php
																		                        $car_quantity = $val->car_quantity;
																		                        for ($i = 0; $i <= $car_quantity; $i++) {
																			                        $selected = '';
																			                        if(!empty($car_ids_selected)) {
																				                        if ($i == $car_ids_selected[$val->car_id])
																					                        $selected = ' selected';
																			                        }
																			                        echo '<option value="' . $i . '" '. $selected .'>' . $i . '</option>';
																		                        }
																		                        ?>
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
												                        <?php if(is_object($car_package_custom)){ ?>
													                        <?php if (!empty((array)$car_package_custom)) { ?>
														                        <?php foreach ($car_package_custom as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="80%" class="tour-package-hotel-check car-check">
                                                                                            <label for="car-custom-<?php echo esc_attr($key); ?>"
                                                                                                   class="ml20"><?php echo esc_html($val->car_name) . ' (' . TravelHelper::format_money($val->car_price) . ')'; ?>
                                                                                            </label>
                                                                                        </td>
                                                                                        <td width="20%">
                                                                                            <input type="hidden" name="car_name[<?php echo esc_attr('custom_' . $key); ?>][]"
                                                                                                   value="<?php echo esc_html($val->car_name); ?>"/>
                                                                                            <input type="hidden" name="car_price[<?php echo esc_attr('custom_' . $key); ?>][]"
                                                                                                   value="<?php echo esc_html($val->car_price); ?>"/>
                                                                                            <select id="car-custom-<?php echo esc_attr($key); ?>"
                                                                                                    style="width: 100px" class="form-control app"
                                                                                                    name="car_quantity[<?php echo esc_attr('custom_' . $key); ?>][]">
																		                        <?php
																		                        $car_quantity = $val->car_quantity;
																		                        for ($i = 0; $i <= $car_quantity; $i++) {
																			                        $selected = '';
																			                        if(!empty($car_ids_selected)) {
																				                        if ($i == $car_ids_selected['custom_' . $key])
																					                        $selected = 'selected';
																			                        }
																			                        echo '<option value="' . $i . '" '. $selected .'>' . $i . '</option>';
																		                        }
																		                        ?>
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
														                        <?php endforeach; ?>
													                        <?php } } ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
				                        <?php } ?>
                                        <!--Flight package-->
	                                    <?php
	                                    if (STTour::_check_empty_package($flight_package, $flight_package_custom)) {
		                                    $flight_ids_selected = TravelHelper::get_ids_selected_tour_package($flight_selected, 'flight');
		                                    ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseFour">
					                                    <?php echo __('Select Flight Package', ST_TEXTDOMAIN); ?>
                                                    </a>
                                                </div>
                                                <div id="collapseFour" class="accordion-body collapse">
                                                    <div class="accordion-inner">
                                                        <div class="sroom-extra-service st-tour-package">
                                                            <div class="">
                                                                <div class="extra-price">
                                                                    <table class="table" style="table-layout: fixed;">
									                                    <?php if(is_object($flight_package)){ ?>
										                                    <?php if (!empty((array)$flight_package)) { ?>
											                                    <?php foreach ($flight_package as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="" class="tour-package-hotel-check">
														                                    <?php
														                                    $flight_package_data = new stdClass();

														                                    $flight_id = $val->flight_id;

														                                    $origin_iata = '';
														                                    $origin_name = '';
														                                    $destination_iata = '';
														                                    $destination_name = '';

														                                    $origin_id = get_post_meta($flight_id, 'origin', true);

														                                    if(!empty($origin_id) && $origin_id > 0){
															                                    $origin = get_term($origin_id, 'st_airport');
															                                    if(is_object($origin)){
																                                    $origin_iata = get_tax_meta($origin->term_id, 'iata_airport', true);
																                                    $origin_name = $origin->name;
															                                    }
														                                    }

														                                    $destination_id = get_post_meta($flight_id, 'destination', true);
														                                    if(!empty($destination_id) && $destination_id > 0){
															                                    $destination = get_term($destination_id, 'st_airport');
															                                    if(is_object($destination)){
																                                    $destination_iata = get_tax_meta($destination->term_id, 'iata_airport', true);
																                                    $destination_name = $destination->name;
															                                    }
														                                    }

														                                    $origin_res = '';
														                                    if(empty($origin_iata) and empty($origin_name)){
															                                    $origin_res = '—';
														                                    }else{
															                                    $origin_res = $origin_name . ' ('. $origin_iata .')';
														                                    }

														                                    $destination_res = '';
														                                    if(empty($destination_iata) and empty($destination_name)){
															                                    $destination_res = '—';
														                                    }else{
															                                    $destination_res = $destination_name . ' ('. $destination_iata .')';
														                                    }

														                                    $depart_time = get_post_meta($flight_id, 'departure_time', true);
														                                    $total_time = get_post_meta($flight_id, 'total_time', true);
														                                    $total_time_str = $total_time['hour'] . 'h' . $total_time['minute'] . 'm';

														                                    $flight_package_data->flight_origin = $origin_res;
														                                    $flight_package_data->flight_destination = $destination_res;
														                                    $flight_package_data->flight_departure_time = $depart_time;
														                                    $flight_package_data->flight_duration = $total_time_str;

														                                    $flight_package_data->flight_price_economy = $val->flight_price_economy;
														                                    $flight_package_data->flight_price_business = $val->flight_price_business;

														                                    $flight_package_data_economy = $flight_package_data_business = $flight_package_data;
														                                    ?>
                                                                                            <label for="activity-custom-<?php echo esc_attr($key); ?>"
                                                                                                   class="mt5"><?php echo esc_html($origin_res) . ' <i class="fa fa-long-arrow-right"></i> ' . $destination_res; ?>
                                                                                            </label>
                                                                                            <b><?php echo __('Departure time', ST_TEXTDOMAIN) ?>:</b> <?php echo esc_html($depart_time); ?><br />
                                                                                            <b><?php echo __('Duration', ST_TEXTDOMAIN) ?>:</b> <?php echo esc_html($total_time_str); ?>
                                                                                        </td>
                                                                                        <td>
		                                                                                    <?php $flight_package_data_economy->flight_price_type = 'economy'; ?>
	                                                                                        <?php echo __('Economy', ST_TEXTDOMAIN); ?><br />
                                                                                            <label class="ml20 mb10"><input type="radio" <?php echo in_array($flight_id . '_economy', $flight_ids_selected) ? 'checked' : ''; ?> class="i-check flight_package" name="flight_package[<?php echo esc_attr($flight_id); ?>][]" value="<?php echo htmlspecialchars(json_encode($flight_package_data_economy)); ?>"/><span class="mt2 d-i-b"> <?php echo TravelHelper::format_money($val->flight_price_economy); ?></span></label>
		                                                                                    <?php $flight_package_data_business->flight_price_type = 'business'; ?>
	                                                                                        <?php echo __('Business', ST_TEXTDOMAIN); ?><br />
                                                                                            <label class="ml20"><input type="radio" <?php echo in_array($flight_id . '_business', $flight_ids_selected) ? 'checked' : ''; ?> class="i-check flight_package" name="flight_package[<?php echo esc_attr($flight_id); ?>][]" value="<?php echo htmlspecialchars(json_encode($flight_package_data_business)); ?>"/><span class="mt2 d-i-b"> <?php echo TravelHelper::format_money($val->flight_price_business); ?></span></label>
                                                                                        </td>
                                                                                    </tr>
											                                    <?php endforeach; ?>
										                                    <?php } } ?>
									                                    <?php if(is_object($flight_package_custom)){ ?>
										                                    <?php if (!empty((array)$flight_package_custom)) { ?>
											                                    <?php foreach ($flight_package_custom as $key => $val): ?>
                                                                                    <tr class="extra-collapse-control extra-none">
                                                                                        <td width="100%" class="tour-package-hotel-check">
														                                    <?php
														                                    $flight_package_data = new stdClass();
														                                    $flight_package_data->flight_origin = $val->flight_origin;
														                                    $flight_package_data->flight_destination = $val->flight_destination;
														                                    $flight_package_data->flight_departure_time = $val->flight_departure_time;
														                                    $flight_package_data->flight_duration = $val->flight_duration;
														                                    $flight_package_data->flight_price_economy = $val->flight_price_economy;
														                                    $flight_package_data->flight_price_business = $val->flight_price_business;
														                                    $flight_package_data_economy = $flight_package_data_business = $flight_package_data;
														                                    ?>
                                                                                            <label for="activity-custom-<?php echo esc_attr($key); ?>"
                                                                                                   class="mt5"><?php echo esc_html($val->flight_origin) . ' <i class="fa fa-long-arrow-right"></i> ' . $val->flight_destination; ?>
                                                                                            </label>
                                                                                            <b><?php echo __('Departure time', ST_TEXTDOMAIN) ?>:</b> <?php echo esc_html($val->flight_departure_time); ?><br />
                                                                                            <b><?php echo __('Duration', ST_TEXTDOMAIN) ?>:</b> <?php echo esc_html($val->flight_duration); ?>
                                                                                        </td>
                                                                                        <td>
		                                                                                    <?php $flight_package_data_economy->flight_price_type = 'economy'; ?>
	                                                                                        <?php echo __('Economy', ST_TEXTDOMAIN); ?><br />
                                                                                            <label class="ml20 mb10"><input type="radio" <?php echo in_array($key . '_economy', $flight_ids_selected) ? 'checked' : ''; ?> class="i-check flight_package" name="flight_package[<?php echo esc_attr($key); ?>][]" value="<?php echo htmlspecialchars(json_encode($flight_package_data_economy)); ?>"/><span class="mt2 d-i-b"><?php echo TravelHelper::format_money($val->flight_price_economy); ?></span></label>
		                                                                                    <?php $flight_package_data_business->flight_price_type = 'business'; ?>
	                                                                                        <?php echo __('Business', ST_TEXTDOMAIN); ?><br />
                                                                                            <label class="ml20"><input type="radio" <?php echo in_array($key . '_business', $flight_ids_selected) ? 'checked' : ''; ?> class="i-check flight_package" name="flight_package[<?php echo esc_attr($key); ?>][]" value="<?php echo htmlspecialchars(json_encode($flight_package_data_business)); ?>"/><span class="mt2 d-i-b"> <?php echo TravelHelper::format_money($val->flight_price_business); ?></span></label>
                                                                                        </td>
                                                                                    </tr>
											                                    <?php endforeach; ?>
										                                    <?php } } ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
	                                    <?php } ?>
                                        <!--End Flight package-->
                                    </div>
		                        <?php } ?>
                                <!-- End Tour Package -->
                            <div class="guest_name_input hidden mb15 mt10" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-children="<?php echo get_post_meta($post_id,'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta($post_id,'disable_infant_name',true) ?>">
                                <label ><strong><?php esc_html_e('Guest Name',ST_TEXTDOMAIN) ?></strong> <span class="required">*</span></label>
                                <div class="guest_name_control">
			                        <?php
			                        if(!empty($controls) and is_array($controls))
			                        {
				                        foreach ($controls as $k=>$control){
					                        ?>
                                            <div class="control-item mb10">
                                                <select name="guest_title[]" class="form-control" >
                                                    <option value="mr" <?php selected('mr',isset($guest_titles[$k])?$guest_titles[$k]:'') ?>><?php esc_html_e('Mr',ST_TEXTDOMAIN) ?></option>
                                                    <option value="miss" <?php selected('miss',isset($guest_titles[$k])?$guest_titles[$k]:'') ?> ><?php esc_html_e('Miss',ST_TEXTDOMAIN) ?></option>
                                                    <option value="mrs" <?php selected('mrs',isset($guest_titles[$k])?$guest_titles[$k]:'') ?>><?php esc_html_e('Mrs',ST_TEXTDOMAIN) ?></option>
                                                </select>
						                        <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="%s">',sprintf(esc_html__('Guest %d name',ST_TEXTDOMAIN),$k+2),esc_attr($control));?>
                                            </div>
					                        <?php
				                        }
			                        }
			                        ?>
                                </div>
                                <script type="text/html" id="guest_name_control_item">
                                    <div class="control-item mb10">
                                        <select name="guest_title[]" class="form-control" >
                                            <option value="mr" ><?php esc_html_e('Mr',ST_TEXTDOMAIN) ?></option>
                                            <option value="miss"  ><?php esc_html_e('Miss',ST_TEXTDOMAIN) ?></option>
                                            <option value="mrs" ><?php esc_html_e('Mrs',ST_TEXTDOMAIN) ?></option>
                                        </select>
				                        <?php printf('<input class="form-control " placeholder="%s" name="guest_name[]" value="">',esc_html__('Guest %d name',ST_TEXTDOMAIN));?>
                                    </div>
                                </script>
                            </div>
                            <input type="hidden" name="adult_price" id="adult_price">
                            <input type="hidden" name="child_price" id="child_price">
                            <input type="hidden" name="infant_price" id="infant_price">
                            <div class="message_box mt10"></div>
                            <!--End extra price-->
                        </div>
                        <?php echo STTemplate::message(); ?>
                        <div class="div_btn_book_tour">
		                    <?php
		                    $tour_external_booking      = get_post_meta( $post_id, 'st_tour_external_booking', "off" );
		                    if ($st_is_booking_modal && $tour_external_booking == 'off') {
			                    ?>
                                <a data-target="#tour_booking_<?php echo esc_attr($post_id); ?>"
                                   class="btn btn-primary btn-st-add-cart"
                                   data-effect="mfp-zoom-out"><?php st_the_language('book_now') ?> <i
                                            class="fa fa-spinner fa-spin"></i></a>
		                    <?php } else { ?>
			                    <?php
			                    $tour_external_booking      = get_post_meta( $post_id, 'st_tour_external_booking', "off" );
			                    $tour_external_booking_link = get_post_meta( $post_id, 'st_tour_external_booking_link', true );
			                    $return = '';
			                    if ( $tour_external_booking == "on" and $tour_external_booking_link !== "" ) {
				                    if ( get_post_meta( $post_id, 'st_tour_external_booking_link', true ) ) {
					                    ob_start();
					                    ?>
                                        <a class='btn btn-primary'
                                           href='<?php echo get_post_meta( $post_id, 'st_tour_external_booking_link', true ) ?>'> <?php st_the_language( 'book_now' ) ?></a>
					                    <?php
					                    $return = ob_get_clean();
				                    }
			                    } else {
				                    $return = TravelerObject::get_book_btn($post_id);
			                    }
			                    echo esc_html($return);
                                ?>
		                    <?php } ?>
		                    <?php //echo st()->load_template('user/html/html_add_wishlist', null, array("title" => '', 'class' => '')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<div id="list_tour_item" data-type-tour="<?php echo esc_attr($type_tour); ?>"
     style="display: none; width: 500px; height: auto;">
    <div id="single-tour-calendar">
		<?php echo st()->load_template('tours/elements/tour_calendar','', array('post_id' => $post_id)); ?>
        <style>
            .qtip {
                max-width: 250px !important;
            }
        </style>
    </div>
</div>

<?php
if ($st_is_booking_modal) {
	?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="tour_booking_<?php echo esc_attr($post_id); ?>">
		<?php echo st()->load_template('tours/modal_booking'); ?>
    </div>
<?php } ?>