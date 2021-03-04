<?php
wp_enqueue_script('bootstrap-datepicker.js');
wp_enqueue_script('bootstrap-datepicker-lang.js');
wp_enqueue_script('custom_hotel_room_inbox');

$booking_data = $message_data['booking_data'];

$extra = '';
$room_id = '';
$check_in = '';
$check_out = '';
$adult_number = '';
$child_number = '';
$infant_number = '';
$room_num_search = '';
$controls = '';
$guest_titles = '';
if(!empty($booking_data)){
    $booking_data = json_decode($booking_data, true);
	$extra = isset($booking_data['extra_price']) ? $booking_data['extra_price'] : '';
    $room_id = isset($booking_data['room_id']) ? $booking_data['room_id'] : '';
    $check_in = isset($booking_data['check_in']) ? $booking_data['check_in'] : '';
	$check_out = isset($booking_data['check_out']) ? $booking_data['check_out'] : '';
	$adult_number = isset($booking_data['adult_number']) ? $booking_data['adult_number'] : '';
	$child_number = isset($booking_data['child_number']) ? $booking_data['child_number'] : '';
	$infant_number = isset($booking_data['infant_number']) ? $booking_data['infant_number'] : '';
    $room_num_search = isset($booking_data['room_num_search']) ? $booking_data['room_num_search'] : '';
	$controls = isset($booking_data['guest_name']) ? $booking_data['guest_name'] : '';
	$guest_titles = isset($booking_data['guest_title']) ? $booking_data['guest_title'] : '';
}

if (!empty($_REQUEST['check_in'])) {
	$check_in = STInput::request('check_in');
	$check_out = STInput::request('check_out');
	$adult_number = STInput::request('adult_number');
	$child_number = STInput::request('child_number');
	$infant_number = STInput::request('infant_number');
	$room_num_search = STInput::request('room_num_search');
	$extra = STInput::request("extra_price");
	$controls = STInput::request('guest_name');
	$guest_titles = STInput::request('guest_title');
}

$item_id = $post_id;
if (empty($item_id)) {
	$item_id = $room_id;
}

$booking_period = intval(get_post_meta($item_id, 'hotel_booking_period', TRUE));
$date= new DateTime();
if($booking_period){
	if($booking_period==1) $date->modify('+1 day');
	else $date->modify('+'.($booking_period).' days');
}

$bg_thumb = '';
if(has_post_thumbnail($room_id)){
	$bg_thumb = get_the_post_thumbnail_url($room_id, 'full');
}else{
	$bg_thumb = get_template_directory_uri() . '/img/no-image.png';
}

$num_room = intval(get_post_meta($room_id, 'number_room', true));
$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
$external = STRoom::get_external_url($room_id);
?>
    <form id="form-booking-inpage" class="single-room-form form-has-guest-name" method="post">
        <div class="st-inbox-form-book">
			<?php if(!empty($bg_thumb)){ ?>
                <a href="<?php echo get_the_permalink($room_id); ?>">
                    <div class="thumb" style="background-image: url('<?php echo esc_url($bg_thumb); ?>')"></div>
                </a>
			<?php } ?>
            <h3><a href="<?php echo get_the_permalink($room_id); ?>"><?php echo get_the_title($room_id); ?></a></h3>
            <div class="section">
                <div class="package-book-now-button">
					<?php
					if (!get_option('permalink_structure')) {
						echo '<input type="hidden" name="st_rental"  value="' . $rental_obj->post_name . '">';
					}
					?>
                    <input type="hidden" name="action" value="rental_add_cart">
                    <input type="hidden" name="item_id" value="<?php echo esc_html($post_id); ?>">
                    <div class="div_book" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>">
                        <div class="booking-meta">
                            <div class="meta-item">
                                <div class="meta-title"><i class="fa fa-calendar"></i> <?php echo __('Check in', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <input
                                            data-post-id="<?php echo esc_attr($room_id); ?>"
                                            placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>"
                                            class="form-control checkin_hotel"
                                            value="<?php echo esc_html($check_in); ?>"
                                            name="check_in"
                                            readonly
                                            type="text">
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-title"><i class="fa fa-calendar"></i> <?php echo __('Check out', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <input
                                            data-post-id="<?php echo esc_attr($room_id); ?>"
                                            placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>"
                                            class="form-control checkout_hotel"
                                            value="<?php echo esc_html($check_out); ?>"
                                            name="check_out"
                                            readonly
                                            type="text">
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Room(s)', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select name="room_num_search" class="form-control room_num_search">
	                                    <?php
	                                    if (!$num_room || $num_room < 0)
		                                    $num_room = 9;
	                                    for ($i = 1; $i <= $num_room; $i++):?>
                                            <option <?php selected($i, $room_num_search, 1); ?>
                                                    value='<?php echo esc_html($i); ?>'><?php echo esc_html($i); ?></option>
	                                    <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Adults', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select name="adult_number" class="form-control adult_number">
	                                    <?php
	                                    $max = intval(get_post_meta($room_id, 'adult_number', true));
	                                    if ($max <= 0) {
		                                    $max = 1;
	                                    }
	                                    for ($i = 1; $i <= $max; $i++):
		                                    $select = selected($i, $adult_number); ?>
                                            <option <?php echo esc_html($select); ?> value='<?php echo esc_html($i); ?>'><?php echo esc_html($i); ?></option>
	                                    <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-title"><?php echo __('Children', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value">
                                    <select name="child_number" class="form-control child_number">
	                                    <?php
	                                    $max = intval(get_post_meta($room_id, 'children_number', true));
	                                    for ($i = 0; $i <= $max; $i++):
		                                    $select = selected($i, $child_number); ?>
                                            <option <?php echo esc_html($select); ?> value='<?php echo esc_html($i); ?>'><?php echo esc_html($i); ?></option>
	                                    <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <!--Extra price-->
							<?php $extra_price = get_post_meta($room_id, 'extra_price', true); ?>
							<?php if (is_array($extra_price) && count($extra_price)): ?>
								<?php
								if (!empty($extra['value'])) {
									$extra_value = $extra['value'];
								}
								?>
                                <label><?php echo __('Extra', ST_TEXTDOMAIN); ?></label>
                                <div class="extra-price">
                                    <table class="table" style="table-layout: fixed;">
										<?php $inti = 0; ?>
										<?php foreach ($extra_price as $key => $val): ?>
                                            <tr class="<?php echo ($inti > 4) ? 'extra-collapse-control extra-none' : '' ?>">
                                                <td width="70%">
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
                                                    <input type="hidden" name="extra_price[price][<?php echo esc_attr($val['extra_name']); ?>]"
                                                           value="<?php echo esc_html($val['extra_price']); ?>">
                                                    <input type="hidden" name="extra_price[title][<?php echo esc_attr($val['extra_name']); ?>]"
                                                           value="<?php echo esc_html($val['title']); ?>">
                                                </td>
                                                <td>
                                                    <select style="width: 100px" class="form-control app"
                                                            name="extra_price[value][<?php echo esc_attr($val['extra_name']); ?>]"
                                                            id="field-<?php echo esc_attr($val['extra_name']); ?>" data-extra-price="<?php echo esc_attr($val['extra_price']); ?>">
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
											<?php $inti++; endforeach; ?>
										<?php if (count($extra_price) > 5) {
											echo '<tr><td colspan="2" class="extra-collapse text-center"><a href="#"><i class="fa fa-angle-double-down"></i></a></td></tr>';
										} ?>
                                    </table>
                                </div>
							<?php endif; ?>

                            <div class="guest_name_input hidden mb15" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-children="<?php echo get_post_meta($room_id,'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta($room_id,'disable_infant_name',true) ?>">
                                <label ><?php esc_html_e('Guest Name',ST_TEXTDOMAIN) ?> <span class="required">*</span></label>
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

                            <div class="message_box mt10"></div>
                            <!--End extra price-->
                        </div>
						<?php echo STTemplate::message(); ?>
                        <div class="div_btn_book_tour">
	                        <?php
	                        $st_is_woocommerce_checkout = apply_filters('st_is_woocommerce_checkout', false);
	                        if ($external) { ?>
                                <a class=" btn btn-primary btn_hotel_booking"
                                   href="<?php echo esc_url($external); ?>"><?php echo __('Book Now', ST_TEXTDOMAIN); ?></a>
	                        <?php } else {
		                        if ($st_is_booking_modal && !$st_is_woocommerce_checkout) {
			                        ?>
                                    <a class=" btn btn-primary btn-st-add-cart" data-effect="mfp-zoom-out" onclick="return false"
                                       data-target="#hotel_booking_<?php echo esc_attr($room_id); ?>"
                                       type="submit"><?php echo __('Book Now', ST_TEXTDOMAIN); ?> <i class="fa fa-spinner fa-spin"></i></a>
		                        <?php } else { ?>
                                    <input class=" btn btn-primary btn_hotel_booking"
                                           value="<?php echo __('Book Now', ST_TEXTDOMAIN); ?>" type="submit">
		                        <?php };
	                        }
	                        ?>
                        </div>
                        <input name="action" value="hotel_add_to_cart" type="hidden">
                        <input name="item_id" value="<?php echo esc_html($item_id); ?>" type="hidden">
                        <input name="room_id" value="<?php echo esc_html($room_id); ?>" type="hidden">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php if ($st_is_booking_modal) { ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="hotel_booking_<?php echo esc_attr($room_id); ?>">
		<?php echo st()->load_template('hotel/modal_booking'); ?>
    </div>
<?php } ?>