<?php 
    //wp_enqueue_script('fullcalendar');
    //wp_enqueue_script('fullcalendar-lang');
    wp_enqueue_style( 'fullcalendar-css' );
    wp_enqueue_style( 'availability' );
    $rental_origin=get_the_ID();
    $rental_origin=TravelHelper::post_origin($rental_origin);
    $booking_period = intval( get_post_meta( $rental_origin, 'rentals_booking_period', true ) );
    $date=new DateTime();
    if($booking_period){
        $date->modify('+'.($booking_period+1).'day');
    }

    $post_id_data = '';
    if(isset($post_id) && !empty($post_id)){
        $post_id_data = $post_id;
    }else{
        $post_id_data = get_the_ID();
    }

    $rental_group_day = false;
    $enable_clear_selection = false;
    if(isset($select_date) && $select_date == 'group_day'){
        $rental_group_day = true;
	    $enable_clear_selection = true;
    }else{
        $rental_group_day = STRental::is_groupday($post_id_data);
    }
?>
 <div class="row calendar-wrapper mb20" data-period="<?php echo esc_attr($booking_period) ?>" data-post-id="<?php echo esc_attr($post_id_data); ?>">
    <div class="col-xs-12 calendar-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-content" data-start="<?php echo esc_attr($date->format('Y-m-d')) ?>">
        </div>
    </div>
    <div class="col-xs-12 mt10">
        <?php if($enable_clear_selection){ ?>
            <a href="#" id="clear-gdate-rental" class="clear-selection"><i class="fa fa-times"></i> <?php echo __('Clear selection', ST_TEXTDOMAIN); ?></a>
        <?php } ?>
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
            <?php if($rental_group_day): ?>
            <div class="item ">
                <span><a href="#" id="clear-gdate-rental"><i class="fa fa-times"></i> <?php echo __('Clear selection', ST_TEXTDOMAIN); ?></a></span>
            </div>
                <input type="hidden" id="rental_is_groupday" value="on"/>
            <?php endif; ?>
        </div>
    </div>
</div>