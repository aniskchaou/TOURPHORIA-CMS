<?php
wp_enqueue_script('bootstrap-datepicker.js');
wp_enqueue_script('bootstrap-datepicker-lang.js');

?>
<?php
$post_id = intval($_GET['id']);
$post_type = get_post_type($post_id);
?>
<span class="hidden st_partner_avaiablity <?php echo STInput::get('sc') ?> "></span>
<div class="row calendar-starttime-wrapper template-user" data-post-id="<?php echo esc_html($post_id); ?>">
    <div class="col-xs-12 col-md-12">
        <div class="calendar-starttime-form">
            <div class="row">
                <div class="col-xs-6 ">
                    <div class="form-group">
                        <label for="calendar_starttime_check_in"><?php echo __('Check In', ST_TEXTDOMAIN); ?></label>
                        <input readonly="readonly" type="text" class="form-control date-picker" name="calendar_starttime_check_in"
                               id="calendar_starttime_check_in">
                    </div>
                </div>
                <div class="col-xs-6 ">
                    <div class="form-group">
                        <label for="calendar_starttime_check_out"><?php echo __('Check Out', ST_TEXTDOMAIN); ?></label>
                        <input readonly="readonly" type="text" class="form-control date-picker"
                               name="calendar_starttime_check_out" id="calendar_starttime_check_out">
                    </div>
                </div>
            </div>

            <?php do_action('st_after_day_tour_calendar_frontend'); ?>

            <div class="form-group">
                <div class="calendar-starttime-wraper starttime-origin">
                    <select class="form-control calendar_starttime_hour" name="calendar_starttime_hour[]">
                        <?php
                        for ($i = 0; $i < 24; $i++) {
                            echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                        }
                        ?>
                    </select>
                    <span><i><?php echo __('hour', ST_TEXTDOMAIN); ?></i></span>
                    <select class="form-control calendar_starttime_minute" name="calendar_starttime_minute[]">
                        <?php
                        for ($i = 0; $i < 60; $i++) {
                            echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                        }
                        ?>
                    </select>
                    <span><i><?php echo __('minute', ST_TEXTDOMAIN); ?></i></span>
                    <div class="calendar-remove-starttime"><span class="dashicons dashicons-no-alt"></span></div>
                </div>
                <div id="calendar-add-starttime"><span class="dashicons dashicons-plus"></span></div>
            </div>

            <div class="row">
                <?php
                /* if($post_type== 'st_tours'){
                    $type = get_post_meta($post_id,'type_tour',true);
                }elseif($post_type == 'st_activity'){
                     $type = get_post_meta($post_id,'type_activity',true);
                } */
                ?>
            </div>

            <div class="form-group">
                <div class="form-message">
                    <p></p>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="calendar_starttime_post_id" value="<?php echo esc_attr($post_id); ?>">
                <input type="submit" id="calendar_starttime_submit" class="btn btn-primary" name="calendar_starttime_submit"
                       value="<?php echo __('Update', ST_TEXTDOMAIN); ?>">
                <?php do_action('traveler_after_form_submit_tour_starttime_calendar'); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-12 calendar-starttime-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-starttime-content"
             data-hide_adult="<?php echo get_post_meta($post_id, 'hide_adult_in_booking_form', true) ?>"
             data-hide_children="<?php echo get_post_meta($post_id, 'hide_children_in_booking_form', true) ?>"
             data-hide_infant="<?php echo get_post_meta($post_id, 'hide_infant_in_booking_form', true) ?>"
        >
        </div>
    </div>
    <?php do_action('traveler_after_form_tour_starttime_calendar'); ?>

</div>