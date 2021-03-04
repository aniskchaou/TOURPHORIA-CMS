<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User setting info
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php STUser_f::get_title_account_setting() ?></h2>
</div>
<div class="row">
    <div class="col-md-8">
            <h4><?php st_the_language('user_personal_infomation') ?></h4>
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_display_name') ?></label>
                <i class="fa fa-user input-icon"></i>
                <div class="form-control"><?php echo esc_attr($data->display_name) ?></div>
            </div>
            <?php
            $is_check =  get_user_meta($data->ID , 'st_is_check_show_info' , true);
            if(!empty($is_check)){
            ?>
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_mail') ?></label>
                <i class="fa fa-envelope input-icon"></i>
                <div class="form-control"><?php echo esc_attr($data->user_email) ?></div>
            </div>
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_phone_number') ?></label>
                <i class="fa fa-phone input-icon"></i>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_phone' , true) ?></div>
            </div>
            <?php } ?>
            <div class="gap gap-small"></div>

            <h4>Location</h4>
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_home_airport') ?></label>
                <i class="fa fa-plane input-icon"></i>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_airport' , true) ?></div>
            </div>
            <div class="form-group">
                <label><?php st_the_language('user_street_address') ?></label>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_address' , true) ?></div>
            </div>
            <div class="form-group">
                <label><?php st_the_language('user_city') ?></label>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_city' , true) ?></div>
            </div>
            <div class="form-group">
                <label><?php st_the_language('user_state_province_region') ?></label>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_province' , true) ?></div>
            </div>
            <div class="form-group">
                <label><?php st_the_language('user_zip_code_postal_code') ?></label>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_zip_code' , true) ?></div>
            </div>
            <div class="form-group">
                <label><?php st_the_language('user_country') ?></label>
                <div class="form-control"><?php echo get_user_meta($data->ID , 'st_country' , true) ?></div>
            </div>
    </div>
</div>