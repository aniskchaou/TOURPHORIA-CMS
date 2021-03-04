<?php
extract($atts);
$room_parent = intval(get_post_meta(get_the_ID(), 'room_parent', true));
$check_in_time = get_post_meta($room_parent, 'check_in_time', true);
$check_out_time = get_post_meta($room_parent, 'check_out_time', true);
?>

<div class="helios-room-facilities-info">
    <div class="title">
        <?php echo esc_html($title) ?>
    </div>
    <div class="info">
        <div class="list-facilities number_2">
            <span class="icon-item">
                <span><?php echo __('Check In time', ST_TEXTDOMAIN) ?>: <strong><?php if($check_in_time) echo $check_in_time; ?></strong></span>
            </span>
            <span class="icon-item">
                <span><?php echo __('Check Out time', ST_TEXTDOMAIN) ?>: <strong><?php if($check_out_time) echo $check_out_time; ?></strong></span>
            </span>
        </div>
    </div>
</div>