<?php 
    wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 
?>
<?php 
    $post_id = intval($_GET['id']);
    $post_type = get_post_type( $post_id );
?>
<span class="hidden st_partner_avaiablity <?php echo STInput::get('sc') ?> "></span>
<div class="row calendar-wrapper template-user" data-post-id="<?php echo esc_html($post_id); ?>">
    <div class="col-xs-12 col-md-12">
        <div class="calendar-form">
            <div class="row">
                <div class="col-xs-6 ">
                    <div class="form-group">
                        <label for="calendar_check_in"><?php echo __('Check In', ST_TEXTDOMAIN); ?></label>
                        <input readonly="readonly" type="text" class="form-control date-picker" name="calendar_check_in" id="calendar_check_in">
                    </div>
                </div>
                <div class="col-xs-6 ">
                    <div class="form-group">
                        <label for="calendar_check_out"><?php echo __('Check Out', ST_TEXTDOMAIN); ?></label>
                        <input readonly="readonly" type="text" class="form-control date-picker" name="calendar_check_out" id="calendar_check_out">
                    </div>
                </div>
            </div>
            
                <?php do_action('st_after_day_tour_calendar_frontend'); ?>
            <?php if($post_type == 'st_tours'){ ?>
            <div class="row tour-calendar-price-fixed">
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="calendar_base_price"><?php echo __('Base Price', ST_TEXTDOMAIN); ?></label>
                        <input type="text" name="calendar_base_price" id="calendar_base_price" class="form-control number">
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row <?php echo $post_type == 'st_tours' ? 'tour-calendar-price-person' : ''; ?>">
                <div class="col-xs-4 <?php if(get_post_meta($post_id,'hide_adult_in_booking_form',true) == 'on') echo 'hide' ?>">
                    <div class="form-group">
                        <label for="calendar_adult_price"><?php echo __('Adult Price', ST_TEXTDOMAIN); ?></label>
                        <input type="text" name="calendar_adult_price" id="calendar_adult_price" class="form-control number">
                    </div>
                </div>
                <div class="col-xs-4 <?php if(get_post_meta($post_id,'hide_children_in_booking_form',true) == 'on') echo 'hide' ?>">
                    <div class="form-group ">
                        <label for="calendar_child_price"><?php echo __('Child Price', ST_TEXTDOMAIN); ?></label>
                        <input type="text" name="calendar_child_price" id="calendar_child_price" class="form-control number">
                    </div>
                </div>
                <div class="col-xs-4 <?php if(get_post_meta($post_id,'hide_infant_in_booking_form',true) == 'on') echo 'hide' ?>">
                    <div class="form-group ">
                        <label for="calendar_infant_price"><?php echo __('Infant Price', ST_TEXTDOMAIN); ?></label>
                        <input type="text" name="calendar_infant_price" id="calendar_infant_price" class="form-control number">
                    </div>
                </div>
            </div>

            <?php if($post_type == 'st_tours'){ ?>
                <input type="hidden" name="calendar_price_type" id="calendar_price_type" value="<?php echo STTour::get_price_type($post_id); ?>"/>
            <?php } ?>
            <!-- StartTime -->
            <div class="row partner-starttime">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label><strong><?php echo __('StartTime', ST_TEXTDOMAIN); ?></strong></label>
                    </div>

                    <div class="form-group">
                        <div class="calendar-starttime-wraper starttime-origin">
                            <select class="calendar_starttime_hour form-control" name="">
                                <?php
                                $time_format = st()->get_option('time_format', '24h');
                                if($time_format == '24h'){
                                    for ( $i = 0; $i < 24; $i ++ ) {
                                        echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                                    }
                                }else{
                                    for ( $i = 1; $i < 13; $i ++ ) {
                                        echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <span><i><?php echo __( 'hour', ST_TEXTDOMAIN ); ?></i></span>&nbsp;
                            <select class="calendar_starttime_minute form-control" name="">
                                <?php
                                for ( $i = 0; $i < 60; $i ++ ) {
                                    echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                                }
                                ?>
                            </select>
                            <span><i><?php echo __( 'minute', ST_TEXTDOMAIN ); ?></i></span>
                            <?php if($time_format == '12h'){ ?>
                                <select class="calendar_starttime_format form-control" name="">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            <?php } ?>
                            <div class="calendar-remove-starttime" data-time-format="<?php echo esc_html($time_format); ?>"><span class="dashicons dashicons-no-alt"></span></div>
                        </div>
                        <div id="calendar-add-starttime" class="calendar-add-starttime" data-time-format="<?php echo esc_html($time_format); ?>"><span class="dashicons dashicons-plus"></span></div>
                    </div>
                </div>
            </div>
            <!-- End StartTime -->
            <div class="row">
                <div class="col-xs-6  ">
                    <div class="form-group ">
                        <label for="calendar_status"><?php echo __('Status', ST_TEXTDOMAIN); ?></label>
                        <select name="calendar_status" id="calendar_status" class="form-control">
                            <option value="available"><?php echo __('Available', ST_TEXTDOMAIN); ?></option>
                            <option value="unavailable"><?php echo __('Unavailble', ST_TEXTDOMAIN); ?></option>
                        </select>
                    </div>
                </div>
                <?php 
                    if($post_type== 'st_tours'){
                        $type = get_post_meta($post_id,'type_tour',true);
                    }elseif($post_type == 'st_activity'){
                         $type = get_post_meta($post_id,'type_activity',true);
                    }
                ?>
                <div class="col-xs-6">
                    <div class="form-group mt5" style="<?php if($type != 'specific_date'){echo 'display: none;';} ?>">
                        <label for="calendar_groupday"><?php echo __('Group day', ST_TEXTDOMAIN); ?></label>
                        <div class="ml20">
                            <input type="checkbox" name="calendar_groupday" id="calendar_groupday" class="i-check" value="1"><span class="ml5"><?php echo __('Group day', ST_TEXTDOMAIN); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-message">
                    <p></p>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="calendar_post_id" value="<?php echo esc_attr($post_id); ?>">
                <input type="submit" id="calendar_submit" class="btn btn-primary" name="calendar_submit" value="<?php echo __('Update', ST_TEXTDOMAIN); ?>">
                <?php do_action('traveler_after_form_submit_tour_calendar'); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-12 calendar-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-content"
             data-hide_adult="<?php echo get_post_meta($post_id,'hide_adult_in_booking_form',true) ?>"
             data-hide_children="<?php echo get_post_meta($post_id,'hide_children_in_booking_form',true) ?>"
             data-hide_infant="<?php echo get_post_meta($post_id,'hide_infant_in_booking_form',true) ?>"
            >
        </div>
    </div>
<?php do_action('traveler_after_form_tour_calendar'); ?>

</div>