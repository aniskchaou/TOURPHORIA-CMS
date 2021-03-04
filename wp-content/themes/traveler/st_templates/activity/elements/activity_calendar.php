<?php 
    wp_enqueue_script('fullcalendar');
    wp_enqueue_script('fullcalendar-lang');
    wp_enqueue_style( 'fullcalendar-css' );
    wp_enqueue_style( 'availability' );

    $post_id_data = '';
    if(isset($post_id) && !empty($post_id)){
        $post_id_data = $post_id;
    }else{
        $post_id_data = get_the_ID();
    }

    $current_calendar_date = TravelHelper::get_current_available_calendar($post_id_data);
    $attribute_current_date = '';
    if($current_calendar_date)
        $attribute_current_date = 'data-current-date="'. $current_calendar_date .'"';
?>
<div class="row calendar-wrapper" data-post-id="<?php echo esc_html($post_id_data); ?>" <?php echo esc_html($current_calendar_date); ?>>
    <div class="col-xs-12 calendar-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-content"
             data-hide_adult="<?php echo get_post_meta($post_id_data,'hide_adult_in_booking_form',true) ?>"
             data-hide_children="<?php echo get_post_meta($post_id_data,'hide_children_in_booking_form',true) ?>"
             data-hide_infant="<?php echo get_post_meta($post_id_data,'hide_infant_in_booking_form',true) ?>"
             data-date-start="<?php echo AvailabilityHelper::_get_availability_date_srart($post_id_data); ?>"
            >
        </div>
    </div>
    <div class="col-xs-12 mt10">
        <div class="calendar-bottom">
            <div class="item ">
                <span class="color available"></span>
                <span> <?php echo __('Available', ST_TEXTDOMAIN) ?></span>
            </div>
            <div class="item cellgrey">
                <span class="color"></span>
                <span>  <?php echo __('Not Available', ST_TEXTDOMAIN) ?></span>
            </div>
            <div class="item ">
                <span class="color bgr-main"></span>
                <span> <?php echo __('Selected', ST_TEXTDOMAIN) ?></span>
            </div>
        </div>
    </div>
</div>