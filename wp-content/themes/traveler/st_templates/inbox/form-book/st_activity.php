<?php
wp_enqueue_script('custom_activity_inbox');
wp_enqueue_script('st-qtip');
$booking_data = $message_data['booking_data'];
$check_in = STInput::request('check_in', '');
$check_out = STInput::request('check_out', '');
$adult_number = STInput::request('adult_number');
$child_number = STInput::request('child_number');
$infant_number = STInput::request('infant_number');
$extra = STInput::request("extra_price");
$starttime_value = STInput::request('starttime', '');
$controls = STInput::request('guest_name');
$guest_titles = STInput::request('guest_title');

$action = STInput::request('action', '');

if(empty($action)) {
	if ( ! empty( $booking_data ) ) {
		$booking_data = json_decode( $booking_data, true );
		if(!empty($booking_data['check_in']))
            $check_in = $booking_data['check_in'];
		if ( !empty( $booking_data['check_out'] ) ) {
			$check_out = $booking_data['check_out'];
		}
		if ( !empty( $booking_data['adult_number'] ) ) {
			$adult_number = $booking_data['adult_number'];
		}
		if ( !empty( $booking_data['child_number'] ) ) {
			$child_number = $booking_data['child_number'];
		}
		if ( !empty( $booking_data['infant_number'] ) ) {
			$infant_number = $booking_data['infant_number'];
		}
		if ( !empty( $booking_data['extra_price'] ) ) {
			$extra = $booking_data['extra_price'];
		}
		if ( !empty( $booking_data['starttime'] ) ) {
			$starttime_value = $booking_data['starttime'];
		}
		$controls = isset($booking_data['guest_name']) ? $booking_data['guest_name'] : '';
		$guest_titles = isset($booking_data['guest_title']) ? $booking_data['guest_title'] : '';
	}
}

$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
$type_activity = get_post_meta($post_id, 'type_activity', true);
$max_people = get_post_meta($post_id, 'max_people', true);
$max_select = 0;
if ($max_people == '' || $max_people == '0' || !is_numeric($max_people)) {
	$max_select = 20;
} else {
	$max_select = $max_people;
}

$bg_thumb = '';
if(has_post_thumbnail($post_id)){
    $bg_thumb = get_the_post_thumbnail_url($post_id, 'full');
}else{
    $bg_thumb = get_template_directory_uri() . '/img/no-image.png';
}
$activity_obj = get_post($post_id);
?>
<form id="form-booking-inpage" method="post" action="" class="activity_booking_form booking_modal_form form-has-guest-name"
              data-activity-type="<?php echo esc_attr($type_activity); ?>">
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
		                echo '<input type="hidden" name="st_activity"  value="' . $activity_obj->post_name . '">';
	                }
	                ?>
                    <input type="hidden" name="action" value="activity_add_to_cart">
                    <input type="hidden" name="item_id" value="<?php echo esc_html($post_id); ?>">
                    <input type="hidden" name="type_activity" value="<?php echo esc_html($type_activity) ?>">
                    <div class="div_book">
                        <div class="booking-meta">
                            <div class="meta-item">
                                <div class="meta-title"><i class="fa fa-calendar"></i> <?php echo __('Activity date', ST_TEXTDOMAIN) ?></div>
                                <div class="meta-value"><a  href="#list_activity_item" id="select-a-activity" class="btn btn-primary btn-sm"><?php echo __('Select date', ST_TEXTDOMAIN); ?></a></div>
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
                                   data-checkin="<?php echo esc_attr($check_in); ?>" data-checkout="<?php echo esc_attr($check_out); ?>" data-tourid="<?php echo esc_attr($post_id); ?>" id="starttime_hidden_load_form"/>
                            <div class="mt10 mb20 activity-starttime" <?php echo empty($starttime_value) ? 'style="display: none;"' : ''; ?>>
                                <label><?php echo __('Start time', ST_TEXTDOMAIN); ?></label>
                                <select class="form-control st_activity_starttime" name="starttime"></select>
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
                            <div class="message_box mt10"></div>
                            <!--End extra price-->
                            <div class="guest_name_input hidden mb15" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-children="<?php echo get_post_meta($post_id,'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta($post_id,'disable_infant_name',true) ?>">
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
                        </div>
                        <?php echo STTemplate::message(); ?>
                        <div class="div_btn_book_tour">
		                    <?php
		                    $activity_external_booking      = get_post_meta( $post_id, 'st_activity_external_booking', "off" );
		                    if ($st_is_booking_modal && $activity_external_booking == 'off') {
			                    ?>
                                <a data-target="#activity_booking_<?php echo esc_attr($post_id); ?>" onclick="return false"
                                   class="btn btn-primary btn-st-add-cart"
                                ><?php st_the_language('book_now') ?> <i class="fa fa-spinner fa-spin"></i></a>
		                    <?php } else { ?>
			                    <?php
			                    $activity_external_booking      = get_post_meta( $post_id, 'st_activity_external_booking', "off" );
			                    $activity_external_booking_link = get_post_meta( $post_id, 'st_activity_external_booking_link', true );
			                    $return = '';
			                    if ( $activity_external_booking == "on" and $activity_external_booking_link !== "" ) {
				                    if ( get_post_meta( $post_id, 'st_activity_external_booking_link', true ) ) {
					                    ob_start();
					                    ?>
                                        <a class='btn btn-primary'
                                           href='<?php echo get_post_meta( $post_id, 'st_activity_external_booking_link', true ) ?>'> <?php st_the_language( 'book_now' ) ?></a>
					                    <?php
					                    $return = ob_get_clean();
				                    }
			                    } else {
				                    $return = TravelerObject::get_book_btn($post_id);
			                    }
			                    echo esc_html($return);
                                ?>
		                    <?php } ?>
		                    <?php //echo st()->load_template('user/html/html_add_wishlist', null, array("title" => '', 'class' => '', 'post_id' => $post_id)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="list_activity_item" data-type-tour="" style="display: none; width: 500px; height: auto;">
        <div id="single-tour-calendar">
			<?php echo st()->load_template('activity/elements/activity_calendar', '', array('post_id' => $post_id)); ?>
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
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="activity_booking_<?php echo esc_attr($post_id); ?>">
		<?php echo st()->load_template('activity/modal_booking'); ?>
    </div>
<?php } ?>