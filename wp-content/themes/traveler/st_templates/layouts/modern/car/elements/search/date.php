<?php
$pick_up_date = STInput::request('pick-up-date', date(TravelHelper::getDateFormat()));
$pick_up_time = STInput::request('pick-up-time', date('h:i A'));
$drop_off_date = STInput::request('drop-off-date', date(TravelHelper::getDateFormat()));
$drop_off_time = STInput::request('drop-off-time', date('h:i A'));
$date = STInput::request('date', date('d/m/Y h:i a') . '-' . date('d/m/Y h:i a', strtotime('+1 day')));
$has_icon = (isset($has_icon)) ? $has_icon : false;
?>
<div class="form-group form-date-field form-date-search form-date-car clearfix <?php if ($has_icon) echo ' has-icon '; ?>"
     data-format="<?php echo TravelHelper::getDateFormatMoment() ?>, hh:mm A" data-date-format="<?php echo TravelHelper::getDateFormatMoment() ?>" data-time-format="hh:mm A"
     data-timepicker="true" data-label-start-time="<?php echo __('Pick Up Time', ST_TEXTDOMAIN) ?>"
     data-label-end-time="<?php echo __('Return Time', ST_TEXTDOMAIN) ?>">
    <?php
    if ($has_icon) {
        echo TravelHelper::getNewIcon('ico_calendar_search_box');
    }
    ?>
    <div class="date-wrapper clearfix">
        <div class="check-in-wrapper">
            <label><?php echo __('Pick Up Time', ST_TEXTDOMAIN); ?></label>
            <div class="render check-in-render"><?php echo $pick_up_date . ', '. $pick_up_time; ?></div>
        </div>
        <div class="check-out-wrapper">
            <label><?php echo __('Return Time', ST_TEXTDOMAIN); ?></label>
            <div class="render check-out-render"><?php echo $drop_off_date.', '. $drop_off_time; ?></div>
            <span>
        </div>
    </div>
    <input type="hidden" class="check-in-input" value="<?php echo esc_attr($pick_up_date) ?>" name="pick-up-date">
    <input type="hidden" class="check-in-input-time" value="<?php echo esc_attr($pick_up_time) ?>" name="pick-up-time">
    <input type="hidden" class="check-out-input" value="<?php echo esc_attr($drop_off_date) ?>" name="drop-off-date">
    <input type="hidden" class="check-out-input-time" value="<?php echo esc_attr($drop_off_time) ?>"
           name="drop-off-time">
    <input type="text" class="check-in-out" value="<?php echo esc_attr($date); ?>" name="date">
</div>