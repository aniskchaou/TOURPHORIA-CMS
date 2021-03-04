<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental form book
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('bootstrap-datepicker.js');
wp_enqueue_script('bootstrap-datepicker-lang.js');

if (!isset($field_size)) $field_size = '';

$adult_max = intval(get_post_meta(get_the_ID(), 'rental_max_adult', true));
$child_max = intval(get_post_meta(get_the_ID(), 'rental_max_children', true));

echo STTemplate::message();
global $post;

//check is booking with modal
$st_is_booking_modal = apply_filters('st_is_booking_modal', false);
$booking_period = get_post_meta(get_the_ID(), 'rentals_booking_period', true);
$rental_external_booking = get_post_meta(get_the_ID(), 'st_rental_external_booking', "off");

$date= new DateTime();
if($booking_period){
    $date->modify('+'.($booking_period+1).' day');
}


?>
    <form method="post" action="" id="form-booking-inpage" class="form-has-guest-name">
        <?php
        if (!get_option('permalink_structure')) {
            echo '<input type="hidden" name="st_rental"  value="' . st_get_the_slug() . '">';
        }
        ?>
        <input type="hidden" name="action" value="rental_add_cart">
        <input type="hidden" name="item_id" value="<?php the_ID() ?>">

        <div class="booking-item-dates-change" data-booking-period="<?php echo esc_attr($booking_period); ?>" data-period="<?php echo esc_attr($date->format(TravelHelper::getDateFormat())) ?>"
             data-post-id="<?php echo get_the_ID(); ?>">
            <div class="message_box mb10"></div>
            <div class="input-daterange" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="field-rental-start"><?php st_the_language('rental_check_in') ?></label>
                            <i class="fa fa-calendar input-icon"></i>
                            <input readonly id="field-rental-start" required="required"
                                   placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>"
                                   value="<?php echo STInput::post('start', STInput::get('start')); ?>"
                                   class="form-control required checkin_rental" name="start" type="text"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-icon-left">
                            <label for="field-rental-end"><?php st_the_language('rental_check_out') ?></label>
                            <i class="fa fa-calendar input-icon"></i>
                            <input readonly id="field-rental-end" required="required"
                                   placeholder="<?php echo TravelHelper::getDateFormatJs(__("Select date", ST_TEXTDOMAIN)); ?>"
                                   value="<?php echo STInput::post('end', STInput::get('end')); ?>"
                                   class="form-control required checkout_rental" name="end" type="text"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <?php

                    $old = STInput::post('adult_number', STInput::get('adult_number', 1));
                    if (!$old) $old = 1;

                    ?>
                    <div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-select-plus">
                        <label for="field-rental-adult"><?php st_the_language('rental_adult') ?></label>
                        <div class="btn-group btn-group-select-num <?php if ($old >= 4 || $adult_max < 4) echo 'hidden'; ?>"
                             data-toggle="buttons">
                            <?php
                            if ($adult_max <= 0) $adult_max = 1;

                            for ($i = 1; $i <= 4; $i++):
                                $name = '' . $i;
                                if ($i == 4) {
                                    $name = '' . $i . '+';
                                }
                                ?>
                                <label class="btn btn-primary <?php echo ($old == $i) ? 'active' : false; ?>">
                                    <input type="radio" value="<?php echo esc_html($i); ?>"
                                           name="options"/><?php echo esc_html($name); ?>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <select id="field-rental-adult"
                                class="form-control adult_number required <?php if ($old < 4 && $adult_max >= 4) echo 'hidden'; ?>"
                                name="adult_number">
                            <?php
                            for ($i = 1; $i <= $adult_max; $i++) {
                                echo "<option " . selected($i, $old, false) . " value='{$i}'>{$i}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <?php
                    $old = STInput::post('child_number', STInput::get('child_number', 0));;
                    ?>
                    <div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-select-plus">
                        <label for="field-rental-children"><?php st_the_language('rental_children') ?></label>
                        <div class="btn-group btn-group-select-num  <?php if ($old >= 3 || $child_max < 3) echo 'hidden'; ?>"
                             data-toggle="buttons">
                            <?php
                            if ($child_max <= 0) $child_max = 1;

                            for ($i = 1; $i <= 4; $i++):
                                $name = '' . $i;
                                if ($i == 4) {
                                    $name = '' . ($i - 1) . '+';
                                }
                                ?>
                                <label class="btn btn-primary <?php echo ($old == $i) ? 'active' : false; ?>">
                                    <input type="radio" value="<?php echo esc_html($i); ?>"
                                           name="options"/><?php echo esc_html($name); ?>
                                </label>
                            <?php endfor; ?>
                        </div>
                        <select id="field-rental-children"
                                class="form-control child_number required <?php if ($old < 3 && $child_max >= 3) echo 'hidden'; ?>"
                                name="child_number">
                            <?php
                            for ($i = 0; $i <= $child_max; $i++) {
                                echo "<option " . selected($i, $old, false) . " value='{$i}'>{$i}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    $extra_price = get_post_meta(get_the_ID(), 'extra_price', true);
                    ?>
                    <?php if (is_array($extra_price) && count($extra_price)): ?>
                        <?php $extra = STInput::request("extra_price");
                        if (!empty($extra['value'])) {
                            $extra_value = $extra['value'];
                        }
                        ?>
                        <label><?php echo __('Extra', ST_TEXTDOMAIN); ?></label>
                        <table class="table">
                            <?php foreach ($extra_price as $key => $val): ?>
                                <tr>
                                    <td width="80%">
                                        <label for="<?php echo esc_attr($val['extra_name']); ?>"
                                               class="ml20"><?php echo esc_html($val['title']) . ' (' . TravelHelper::format_money($val['extra_price']) . ')'; ?>
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
                                    <td width="20%">
                                        <select style="width: 100px" class="form-control app"
                                                name="extra_price[value][<?php echo esc_attr($val['extra_name']); ?>]" id="">
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
                </div>
            </div>
            <div class="guest_name_input hidden mb15 mt10" data-placeholder="<?php esc_html_e('Guest %d name',ST_TEXTDOMAIN) ?>" data-hide-adult="<?php echo get_post_meta(get_the_ID(),'disable_adult_name',true) ?>" data-hide-children="<?php echo get_post_meta(get_the_ID(),'disable_children_name',true) ?>" data-hide-infant="<?php echo get_post_meta(get_the_ID(),'disable_infant_name',true) ?>">
                <label ><strong><?php esc_html_e('Guest Name',ST_TEXTDOMAIN) ?></strong> <span class="required">*</span></label>
                <div class="guest_name_control">
                    <?php
                    $controls = STInput::request('guest_name');
                    $guest_titles = STInput::request('guest_title');
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
        <div class="gap gap-small"></div>
        <?php if (!$st_is_booking_modal):
            ?>
            <?php echo STRental::rental_external_booking_submit(); ?>
        <?php else: ?>
            <?php if ($rental_external_booking == 'off') {
                if(st_owner_post()) {
	                echo st_button_send_message(get_the_ID());
                }
                ?>
                <a href="#rental_booking_<?php the_ID() ?>" onclick="return false"
                   class="btn btn-primary btn-st-add-cart"
                   data-target=#rental_booking_<?php the_ID() ?>
                   data-effect="mfp-zoom-out"><?php st_the_language('rental_book_now') ?> <i
                            class="fa fa-spinner fa-spin"></i></a>
                <?php
            } else {
                $rental_external_booking_link = get_post_meta(get_the_ID(), 'st_rental_external_booking_link', true);
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
    </form>
<?php
if ($st_is_booking_modal) {
    ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="rental_booking_<?php the_ID() ?>">
        <?php echo st()->load_template('rental/modal_booking'); ?>
    </div>

<?php } ?>