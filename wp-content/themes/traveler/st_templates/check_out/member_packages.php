<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.3.1
 */
$userdata = get_userdata( get_current_user_id() );

?>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group form-group-icon-left form-group-filled">                
                <label for="field-st_first_name"><?php echo __('First Name', ST_TEXTDOMAIN) ?><span class="require">*</span> </label>
                <i class="fa fa-user input-icon"></i>                
                <input class="form-control required" id="field-st_first_name" value="<?php echo STInput::post('st_first_name', $userdata->first_name); ?>" name="st_first_name" placeholder="<?php echo __('First Name', ST_TEXTDOMAIN) ?>" type="text">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group form-group-icon-left form-group-filled">                
                <label for="field-st_last_name"><?php echo __('Last Name', ST_TEXTDOMAIN) ?><span class="require">*</span> </label>
                <i class="fa fa-user input-icon"></i>                
                <input class="form-control required" id="field-st_last_name" value="<?php echo STInput::post('st_last_name', $userdata->last_name); ?>" name="st_last_name" placeholder="<?php echo __('Last Name', ST_TEXTDOMAIN) ?>" type="text">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group form-group-icon-left form-group-filled">                
                <label for="field-st_email"><?php echo __('Email', ST_TEXTDOMAIN) ?><span class="require">*</span> </label>
                <i class="fa fa-envelope input-icon"></i>                
                <input class="form-control required" id="field-st_email" value="<?php echo STInput::post('st_email', $userdata->user_email); ?>" name="st_email" placeholder="<?php echo __('Email', ST_TEXTDOMAIN) ?>" type="text">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group form-group-icon-left form-group-filled">                
                <label for="field-st_phone"><?php echo __('Phone', ST_TEXTDOMAIN) ?><span class="require">*</span> </label>
                <i class="fa fa-phone input-icon"></i>                
                <input class="form-control required" id="field-st_phone" value="<?php echo STInput::post('st_phone', get_user_meta(get_current_user_id(), 'st_phone', true)); ?>" name="st_phone" placeholder="<?php echo __('Phone', ST_TEXTDOMAIN) ?>" type="text">
            </div>
        </div>
    </div>
    <?php if(defined('ICL_LANGUAGE_CODE') and ICL_LANGUAGE_CODE ): ?>
        <input type="hidden" name="lang" value="<?php echo esc_attr(ICL_LANGUAGE_CODE) ?>">
    <?php endif;?>

	<div class="payment_gateways">
		<?php STPackages::get_payment_gateways_html(); ?>
	</div>
	<div class="clearfix">
		<div class="row">
			<div class="col-sm-6">
				<?php if(st()->get_option('booking_enable_captcha','on')=='on'){
					$code=STCoolCaptcha::get_code();
					?>
					<div class="form-group captcha_box" >
						<label for="field-hotel-captcha"><?php st_the_language('captcha')?></label>
						<img alt="<?php echo TravelHelper::get_alt_image(); ?>" src="<?php echo STCoolCaptcha::get_captcha_url($code) ?>" align="captcha code" class="captcha_img">
						<input id="field-hotel-captcha" type="text" name="<?php echo esc_attr($code) ?>" value="" class="form-control">
						<input type="hidden" name="st_security_key" value="<?php echo esc_attr($code) ?>">
					</div>
				<?php }?>
			</div>
		</div>
	</div>
	<?php echo STCart::get_default_checkout_fields('st_check_term_conditions');?>

    <input type="hidden" name="action" value="st_checkout_package">
    <input id="st_submit_member_package" type="submit" class="btn btn-primary btn-st-big" name="st_submit_member_package" value="<?php echo __('Submit', ST_TEXTDOMAIN); ?>">
    <div class="mt20">
        <?php echo STTemplate::message(); ?>
    </div>