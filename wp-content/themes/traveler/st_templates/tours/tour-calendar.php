<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/21/2016
 * Time: 9:38 AM
 */
if( is_admin() ){
    $post_id = get_the_ID();
}else{
    $post_id = STInput::get('id','');
}
wp_enqueue_script('bulk-calendar' );
?>
<div id="form-bulk-edit" class="form-bulk-edit-activity-tour">
    <div class="form-container">
    <?php if( is_admin() ): ?>
        <div class="overlay">
            <span class="spinner is-active"></span>
        </div>
    <?php else: ?>
        <div class="overlay-form" style="display: none;"><i class="fa fa-refresh text-color"></i></div>
    <?php endif; ?>
        <div class="form-title">
            <h3 class="clearfix"><?php echo __('Bulk Price Edit', ST_TEXTDOMAIN); ?>
                <button style="float: right;" type="button" id="calendar-bulk-close" class="button button-small btn btn-default btn-sm"><?php echo __('Close',ST_TEXTDOMAIN); ?></button>
            </h3>
        </div>
        <div class="form-content clearfix">
            <h4 style="margin-bottom: 20px;"><?php echo __('Choose Date:', ST_TEXTDOMAIN); ?></h4>
            <div class="form-group">
                <div class="form-title">
                    <h4 class=""><input type="checkbox" class="check-all" data-name="day-of-week"> <?php echo __('Days Of Week', ST_TEXTDOMAIN); ?></h4>
                </div>
                <div class="form-content">
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Sunday" style="margin-right: 5px;"><?php echo __('Sunday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Monday" style="margin-right: 5px;"><?php echo __('Monday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Tuesday" style="margin-right: 5px;"><?php echo __('Tuesday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Wednesday" style="margin-right: 5px;"><?php echo __('Wednesday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Thursday" style="margin-right: 5px;"><?php echo __('Thursday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Friday" style="margin-right: 5px;"><?php echo __('Friday', ST_TEXTDOMAIN); ?></label>
                    <label class="block"><input type="checkbox" name="day-of-week[]" value="Saturday" style="margin-right: 5px;"><?php echo __('Saturday', ST_TEXTDOMAIN); ?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-title">
                    <h4 class=""><input type="checkbox" class="check-all" data-name="day-of-month"> <?php echo __('Days Of Month', ST_TEXTDOMAIN); ?></h4>
                </div>
                <div class="form-content">
                    <?php for( $i = 1; $i <= 31; $i ++):
                        if( $i == 1){
                            echo '<div>';
                        }
                        ?>
                        <label style="width: 40px;"><input type="checkbox" name="day-of-month[]" value="<?php echo esc_html($i); ?>" style="margin-right: 5px;"><?php echo esc_html($i); ?></label>

                        <?php
                        if( $i != 1 && $i % 5 == 0 ) echo '</div><div>';
                        if( $i == 31 ) echo '</div>';
                        ?>

                    <?php endfor; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-title">
                    <h4 class=""><input type="checkbox" class="check-all" data-name="months"> <?php echo __('Months', ST_TEXTDOMAIN); ?>(*)</h4>
                </div>
                <div class="form-content">
                    <?php
                    $months = array(
                        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                    );
                    foreach( $months as $key => $month ):
                        if( $key == 0 ){
                            echo '<div>';
                        }
                        ?>
                        <label style="width: 100px;"><input type="checkbox" name="months[]" value="<?php echo esc_html($month); ?>" style="margin-right: 5px;"><?php echo esc_html($month); ?></label>

                        <?php
                        if( $key != 0 && ($key + 1) % 2 == 0 ) echo '</div><div>';
                        if( $key + 1 == count( $months ) ) echo '</div>';
                        ?>

                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-title">
                    <h4 class=""><input type="checkbox" class="check-all" data-name="years"> <?php echo __('Years', ST_TEXTDOMAIN); ?>(*)</h4>
                </div>
                <div class="form-content">
                    <?php
                    $year = date('Y');
                    $j = $year -1 ;
                    for( $i = $year; $i <= $year + 2; $i ++ ):
                        if( $i == $year ){
                            echo '<div>';
                        }
                        ?>
                        <label style="width: 100px;"><input type="checkbox" name="years[]" value="<?php echo esc_html($i); ?>" style="margin-right: 5px;"><?php echo esc_html($i); ?></label>

                        <?php
                        if( $i != $year && ($i == $j + 2 ) ) { echo '</div><div>'; $j = $i; }
                        if( $i == $year + 2 ) echo '</div>';
                        ?>

                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="form-content clearfix">
            <div style="margin-bottom: 15px" class="row">
                <?php if(get_post_type($post_id) == 'st_tours'){ ?>
                    <div class="col-xs-12 col-sm-4">
                        <label class="block"><span><strong><?php echo __('Base Price', ST_TEXTDOMAIN); ?>: </strong></span>
                            <input class="form-control" type="text" value="0" name="price-bulk" id="base-price-bulk" placeholder="<?php echo __('Base price', ST_TEXTDOMAIN); ?>"></label>
                    </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-4">
                    <label class="block"><span><strong><?php echo __('Adult', ST_TEXTDOMAIN); ?>: </strong></span>
                    <input class="form-control" type="text" value="0" name="adult-price-bulk" id="adult-price-bulk" placeholder="<?php echo __('Adult', ST_TEXTDOMAIN); ?>"></label>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="block"><span><strong><?php echo __('Children', ST_TEXTDOMAIN); ?>: </strong></span>
                    <input class="form-control" type="text" value="0" name="children-price-bulk" id="children-price-bulk" placeholder="<?php echo __('Children', ST_TEXTDOMAIN); ?>"></label>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <label class="block"><span><strong><?php echo __('Infant', ST_TEXTDOMAIN); ?>: </strong></span>
                    <input class="form-control" type="text" value="0" name="infant-price-bulk" id="infant-price-bulk" placeholder="<?php echo __('Infant', ST_TEXTDOMAIN); ?>"></label>
                </div>
            </div>
            <?php if(get_post_type($post_id) == 'st_tours'){ ?>
                <input type="hidden" name="calendar_price_type" id="calendar_price_type" value="<?php echo STTour::get_price_type($post_id); ?>"/>
            <?php } ?>
            <!-- Start Time -->
                <div class="row bulk-starttime">
                    <div class="col-xs-12">
                        <div class="">
                            <label><strong><?php echo __('StartTime', ST_TEXTDOMAIN); ?></strong></label>
                        </div>

                        <div class="">
                            <div class="calendar-starttime-wraper starttime-origin">
                                <select class="calendar_starttime_hour" name="">
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
                                <span><i><?php echo __( 'hour', ST_TEXTDOMAIN ); ?></i></span>
                                <select class="calendar_starttime_minute" name="">
							        <?php
							        for ( $i = 0; $i < 60; $i ++ ) {
								        echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
							        }
							        ?>
                                </select>
                                <span><i><?php echo __( 'minute', ST_TEXTDOMAIN ); ?></i></span>
                                <?php if($time_format == '12h'){ ?>
                                    <select class="calendar_starttime_format" name="">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                <?php } ?>
                                <div class="calendar-remove-starttime" data-time-format="<?php echo esc_attr($time_format); ?>"><span class="dashicons dashicons-no-alt"></span></div>
                            </div>
                            <div id="calendar-add-starttime" class="calendar-add-starttime" data-time-format="<?php echo esc_attr($time_format); ?>"><span class="dashicons dashicons-plus"></span></div>
                        </div>
                    </div>
                </div><br />
            <!---->
            <div style="margin-bottom: 15px">
                <label class="block"><span><strong><?php echo __('Status', ST_TEXTDOMAIN); ?>: </strong></span></label>
                <select class="form-control" name="status" id="">
                    <option value="available"><?php echo __('Available', ST_TEXTDOMAIN); ?></option>
                    <option value="unavailable"><?php echo __('Unavailable', ST_TEXTDOMAIN); ?></option>
                </select>
            </div>
            <div style="margin-bottom: 15px">
                <input name="calendar_groupday" id="calendar_groupday" value="1" type="checkbox">
                <span class="ml5">Group day</span>
            </div>
            <input type="hidden" name="post-id" value="<?php echo esc_html($post_id); ?>">
            <div class="form-message" style="margin-top: 20px;"></div>
        </div>
        <div class="form-footer">
            <button type="button" id="calendar-bulk-save" class="button button-primary button-large btn btn-primary btn-sm"><?php echo __('Save',ST_TEXTDOMAIN); ?></button><!--
								<button type="button" id="calendar-bulk-cancel" class="button button-large"><?php echo __('Cancel',ST_TEXTDOMAIN); ?></button> -->
        </div>
    </div>
</div>