<?php 
    wp_enqueue_script('fullcalendar');
    wp_enqueue_script('fullcalendar-lang');
    wp_enqueue_style( 'fullcalendar-css' );
    wp_enqueue_style( 'availability' );
$hotel_id=get_post_meta(get_the_ID(),'room_parent',true);
$booking_period = intval(get_post_meta($hotel_id, 'hotel_booking_period', TRUE));
$date= new DateTime();
if($booking_period){
    if($booking_period==1) $date->modify('+1 day');
    else $date->modify('+'.$booking_period.' days');
}
?>
 <div class="row calendar-wrapper mb20" data-post-id="<?php echo get_the_ID(); ?>">
    <div class="col-xs-12 calendar-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-content" data-start="<?php echo esc_attr($date->format('Y-m-d')) ?>">
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
            <div class="item still ">
                <span class="color"></span>
                <span>  <?php echo __('Still Available', ST_TEXTDOMAIN) ?></span>
            </div>
            <!-- <div class="item ">
                <span class="color bgr-main"></span>
                <span> <?php echo __('Selected', ST_TEXTDOMAIN) ?></span>
            </div> -->
        </div>
    </div>
</div>