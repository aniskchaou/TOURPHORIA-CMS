<?php
wp_enqueue_script('custom_rental_inbox');
wp_enqueue_script('st-qtip');
$booking_data = $message_data['booking_data'];
$start = STInput::request('start', '');
$end = STInput::request('end', '');
$adult_number = STInput::request('adult_number');
$child_number = STInput::request('child_number');
$extra = STInput::request("extra_price");
$controls = STInput::request('guest_name');
$guest_titles = STInput::request('guest_title');

$action = STInput::request('action', '');
if(empty($action)) {
	if ( ! empty( $booking_data ) ) {
		$booking_data = json_decode( $booking_data, true );
		if(!empty($booking_data['start']))
			$start = $booking_data['start'];
		if ( !empty( $booking_data['end'] ) ) {
			$end = $booking_data['end'];
		}
		if ( !empty( $booking_data['adult_number'] ) ) {
			$adult_number = $booking_data['adult_number'];
		}
		if ( !empty( $booking_data['child_number'] ) ) {
			$child_number = $booking_data['child_number'];
		}
		if ( !empty( $booking_data['extra_price'] ) ) {
			$extra = $booking_data['extra_price'];
		}
		$controls = isset($booking_data['guest_name']) ? $booking_data['guest_name'] : '';
		$guest_titles = isset($booking_data['guest_title']) ? $booking_data['guest_title'] : '';
	}
}

$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
$max_adult = get_post_meta($post_id, 'rental_max_adult', true);
$max_child = get_post_meta($post_id, 'rental_max_children', true);

$booking_period = get_post_meta($post_id, 'rentals_booking_period', true);
$rental_external_booking = get_post_meta($post_id, 'st_rental_external_booking', "off");

$bg_thumb = '';
if(has_post_thumbnail($post_id)){
	$bg_thumb = get_the_post_thumbnail_url($post_id, 'full');
}else{
	$bg_thumb = get_template_directory_uri() . '/img/no-image.png';
}
$rental_obj = get_post($post_id);
?>
	<form method="post" action="" id="form-booking-inpage" class="form-has-guest-name">
		<div class="st-inbox-form-book">
			<?php if(!empty($bg_thumb)){ ?>
				<a href="<?php echo get_the_permalink($post_id); ?>">
					<div class="thumb" style="background-image: url('<?php echo esc_url($bg_thumb); ?>')"></div>
				</a>
			<?php } ?>
			<h3><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
			<div class="section">
				<div class="package-book-now-button">
					<?php
					if (!get_option('permalink_structure')) {
						echo '<input type="hidden" name="st_rental"  value="' . $rental_obj->post_name . '">';
					}
					?>
					<input type="hidden" name="action" value="rental_add_cart">
					<input type="hidden" name="item_id" value="<?php echo esc_html($post_id); ?>">
					<div class="div_book">
						<div class="booking-meta">
							<div class="meta-item">
								<div class="meta-title"><i class="fa fa-calendar"></i> <?php echo __('Rental date', ST_TEXTDOMAIN) ?></div>
								<div class="meta-value"><a  href="#list_rental_item" id="select-a-rental" class="btn btn-primary btn-sm"><?php echo __('Select date', ST_TEXTDOMAIN); ?></a></div>
							</div>
							<div class="meta-item">
								<div class="meta-title"><?php echo __('Check in', ST_TEXTDOMAIN) ?></div>
								<div class="meta-value"><input id="field-rental-start" type="text" name="start"
								                               value="<?php echo esc_html($start); ?>" readonly="readonly"
								                               class="form-control" /></div>
							</div>
							<div class="meta-item">
								<div class="meta-title"><?php echo __('Check out', ST_TEXTDOMAIN) ?></div>
								<div class="meta-value"><input id="field-rental-end" type="text" name="end"
								                               value="<?php echo esc_html($end); ?>" readonly="readonly"
								                               class="form-control" /></div>
							</div>
							<div class="meta-item">
								<div class="meta-title"><?php echo __('Adults', ST_TEXTDOMAIN) ?></div>
								<div class="meta-value">
									<select class="form-control adult_number" name="adult_number" required>
										<?php for ($i = 0; $i <= $max_adult; $i++) {
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
							<div class="meta-item">
								<div class="meta-title"><?php echo __('Children', ST_TEXTDOMAIN) ?></div>
								<div class="meta-value">
									<select class="form-control child_number" name="child_number" required>
										<?php for ($i = 0; $i <= $max_child; $i++) {
											$is_select = '';
											if ($child_number == $i) {
												$is_select = 'selected="selected"';
											}
											echo "<option {$is_select} value='{$i}'>{$i}</option>";
										} ?>
									</select>
								</div>
							</div>
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
							<div class="message_box mt10"></div>
							<!--End extra price-->
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
						</div>
						<?php echo STTemplate::message(); ?>
						<div class="div_btn_book_tour">
							<?php if (!$st_is_booking_modal):
								?>
								<?php
								$rental_external_booking      = get_post_meta( $post_id, 'st_rental_external_booking', "off" );
								$rental_external_booking_link = get_post_meta( $post_id, 'st_rental_external_booking_link', true );
                                $return = '';
								if ( $rental_external_booking == "on" && $rental_external_booking_link !== "" ) {
									if ( get_post_meta( $post_id, 'st_rental_external_booking_link', true ) ) {
										ob_start();
										?>
                                        <a class='btn btn-primary' data-toggle="tooltip" data-placement="top"
                                           title="<?php echo __( 'External booking', ST_TEXTDOMAIN ); ?>"
                                           href='<?php echo get_post_meta( $post_id, 'st_rental_external_booking_link', true ) ?>'>
											<?php st_the_language( 'rental_book_now' ) ?>
                                        </a>
										<?php
										$return = ob_get_clean();
									}
								} else {
									$return = TravelerObject::get_book_btn($post_id);
								}
								echo esc_html($return);
                                ?>
							<?php else: ?>
								<?php if ($rental_external_booking == 'off') {
									?>
									<a href="#rental_booking_<?php echo esc_attr($post_id); ?>" onclick="return false"
									   class="btn btn-primary btn-st-add-cart"
									   data-target=#rental_booking_<?php echo esc_attr($post_id); ?>
									   data-effect="mfp-zoom-out"><?php st_the_language('rental_book_now') ?> <i
											class="fa fa-spinner fa-spin"></i></a>
									<?php
								} else {
									$rental_external_booking_link = get_post_meta($post_id, 'st_rental_external_booking_link', true);
									?>
									<a class='btn btn-primary' data-toggle="tooltip" data-placement="top"
									   title="<?php echo __('External booking', ST_TEXTDOMAIN); ?>"
									   href='<?php echo esc_url($rental_external_booking_link); ?>'>
										<?php st_the_language('rental_book_now') ?>
									</a>
									<?php
								}
								?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div id="list_rental_item" data-type-tour="" style="display: none; width: 500px; height: auto;">
		<div id="single-tour-calendar">
			<?php echo st()->load_template('vc-elements/st-rental/st_rental_calendar', null, array('post_id' => $post_id, 'select_date' => 'group_day')); ?>
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
	<div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="rental_booking_<?php echo esc_attr($post_id); ?>">
		<?php echo st()->load_template('rental/modal_booking'); ?>
	</div>

<?php } ?>