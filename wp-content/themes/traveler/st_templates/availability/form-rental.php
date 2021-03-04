<?php 
    wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
?>
<?php $post_id = intval($_GET['id']); ?>

<div class="row calendar-wrapper template-user" data-post-id="<?php echo esc_html($post_id); ?>">
    <div class="col-xs-12 col-md-8 calendar-wrapper-inner">
        <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
        <div class="calendar-content">            
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="calendar-form">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="calendar_check_in"><?php echo __('Check In', ST_TEXTDOMAIN); ?></label>
                        <input readonly="readonly" type="text" class="form-control date-picker" placeholder="<?php echo __('Check In', ST_TEXTDOMAIN); ?>" name="calendar_check_in" id="calendar_check_in">
                    </div> 
                </div>
                <div class="col-sn-12 col-xs-12">
                    <div class="form-group">
                    <label for="calendar_check_out"><?php echo __('Check Out', ST_TEXTDOMAIN); ?></label>
                    <input readonly="readonly" type="text" class="form-control date-picker" placeholder="<?php echo __('Check Out', ST_TEXTDOMAIN); ?>" name="calendar_check_out" id="calendar_check_out">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="calendar_price"><?php echo __('Price', ST_TEXTDOMAIN); ?></label>
                        <input type="text" name="calendar_price" id="calendar_price" placeholder="<?php echo __('Price', ST_TEXTDOMAIN); ?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="calendar_status"><?php echo __('Status', ST_TEXTDOMAIN); ?></label>
                        <select name="calendar_status" id="calendar_status" class="form-control">
                            <option value="available"><?php echo __('Available', ST_TEXTDOMAIN); ?></option>
                            <option value="unavailable"><?php echo __('Unavailble', ST_TEXTDOMAIN); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-message">
                    <p class="text-danger"></p>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="calendar_post_id" value="<?php echo esc_html($post_id); ?>">
                <input type="submit" id="calendar_submit" class="btn btn-primary" name="calendar_submit" value="<?php echo __('Add New', ST_TEXTDOMAIN); ?>">
                <?php do_action('traveler_after_form_submit_rental_calendar'); ?>
            </div>
        </div>
    </div>
    <?php do_action('traveler_after_form_rental_calendar'); ?>
</div>