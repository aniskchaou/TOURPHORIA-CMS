<?php
if( is_admin() ){
    $post_id = get_the_ID();
}else{
    $post_id = STInput::get('id','');
}

wp_enqueue_script('bulk-starttime-calendar' );
?>
<div id="form-bulk-starttime-edit">
    <div class="form-container">
    <?php if( is_admin() ): ?>
        <div class="overlay">
            <span class="spinner is-active"></span>
        </div>
    <?php else: ?>
        <div class="overlay-form" style="display: none;"><i class="fa fa-refresh text-color"></i></div>
    <?php endif; ?>
        <div class="form-title">
            <h3 class="clearfix"><?php echo __('Bulk Start Time Edit', ST_TEXTDOMAIN); ?>
                <button style="float: right;" type="button" id="calendar-bulk-starttime-close" class="button button-small btn btn-default btn-sm"><?php echo __('Close',ST_TEXTDOMAIN); ?></button>
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
            <div style="margin-bottom: 15px" class="">
                <?php
                //XKEI Add starttime new into bulk form
                ?>
                <h4 style="margin-bottom: 20px;"><?php echo __('Start Time:', ST_TEXTDOMAIN); ?></h4>
                <div class="calendar-bulk-starttime-wraper starttime-origin">
                    <select class="calendar_bulk_starttime_hour" name="calendar_bulk_starttime_hour[]">
                        <?php
                        for ( $i = 0; $i < 24; $i ++ ) {
                            echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                        }
                        ?>
                    </select>
                    <span><i><?php echo __( 'hour', ST_TEXTDOMAIN ); ?></i></span>
                    <select class="calendar_bulk_starttime_minute" name="calendar_bulk_starttime_minute[]">
                        <?php
                        for ( $i = 0; $i < 60; $i ++ ) {
                            echo '<option value="' . (($i < 10) ? ('0' . $i) : $i) . '">' . (($i < 10) ? ('0' . $i) : $i) . '</option>';
                        }
                        ?>
                    </select>
                    <span><i><?php echo __( 'minute', ST_TEXTDOMAIN ); ?></i></span>
                </div>
                <div id="calendar-add-bulk-starttime"><span class="dashicons dashicons-plus"></span></div>
            </div>

            <input type="hidden" name="post-id" value="<?php echo esc_html($post_id); ?>">
            <div class="form-message" style="margin-top: 20px;"></div>
        </div>
        <div class="form-footer">
            <button type="button" id="calendar-bulk-starttime-save" class="button button-primary button-large btn btn-primary btn-sm"><?php echo __('Save',ST_TEXTDOMAIN); ?></button><!--
								<button type="button" id="calendar-bulk-cancel" class="button button-large"><?php echo __('Cancel',ST_TEXTDOMAIN); ?></button> -->
        </div>
    </div>
</div>