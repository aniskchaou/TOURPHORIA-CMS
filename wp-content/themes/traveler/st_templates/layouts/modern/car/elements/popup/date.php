<?php
?>
<div class="st-popup popup-date hidden-lg hidden-md" data-date-format="<?php echo TravelHelper::getDateFormatMoment() ?>" data-time-format="hh:mm A" data-format="<?php echo TravelHelper::getDateFormatMoment() ?>, hh:mm A">
    <h3 class="popup-title">
        <?php echo __('Pick Up & Drop Off Date', ST_TEXTDOMAIN); ?>
        <span class="popup-close"><?php echo TravelHelper::getNewIcon('Ico_close', '#A0A9B2', '20px', '20px'); ?></span>
    </h3>
    <div class="popup-content">
        <input type="hidden" class="check-in-input" value="" name="pick-up-date">
        <input type="hidden" class="check-in-input-time" value="" name="pick-up-time">
        <input type="hidden" class="check-out-input" value="" name="drop-off-date">
        <input type="hidden" class="check-out-input-time" value="" name="drop-off-time">
        <input type="text" class="check-in-out" value="" name="date">
    </div>
</div>