<?php
/**
 * Created by ShineTheme.
 * User: NAZUMI
 * Date: 9/26/2016
 * Version: 1.0
 */
wp_enqueue_script( 'user.js' );

?>

<div class="modal fade register_popup" id="register_popup" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="smallModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo esc_html__('Register',ST_TEXTDOMAIN)?></h4>
            </div>
            <div class="modal-body">
                <?php
                $btn_register = get_post_meta(get_the_ID(),'btn_register',true);
                if(empty($btn_register))$btn_register=__("Register",ST_TEXTDOMAIN);
                ?>
                <form class="register_form register_form_popup" method="post" action="<?php echo esc_url(add_query_arg(array( 'url'=>STInput::request('url') )))?>" >
                    <div class="notice_register"></div>
                    <div class="row <?php if(st()->get_option( 'partner_enable_feature' ) == 'off'){ echo "hidden" ;} ?>">
                        <div class="col-md-12">
                            <div class="form-group form-group-icon-left">
                                <label><?php _e("Select User Type",ST_TEXTDOMAIN) ?></label>
                            </div>
                        </div>
                        <div class="col-md-6 mt20">
                            <div class="checkbox checkbox-lg">
                                <label>
                                    <input class="i-check register_as" type="radio" name="register_as" <?php if(STInput::request('register_as',"normal") == "normal") echo "checked"?> value="normal"  /><?php _e("Normal User",ST_TEXTDOMAIN) ?></label>
                                    <p class="text-muted"><?php echo __('Used for booking services', ST_TEXTDOMAIN); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mt20">
                            <div class="checkbox checkbox-lg">
                                <label>
                                    <input class="i-check register_as" type="radio" name="register_as" <?php if(STInput::request('register_as') == "partner") echo "checked"?> value="partner" /><?php _e("Partner",ST_TEXTDOMAIN) ?></label>
                                    <p class="text-muted"><?php echo __('Used for upload and booking services', ST_TEXTDOMAIN); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt20 data_field">
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left">
                                <label for="field-user_name"><?php _e("User Name",ST_TEXTDOMAIN) ?><span class="color-red"> (*)</span></label>
                                <i class="fa fa-user input-icon input-icon-show"></i>
                                <input id="field-user_name" name="user_name" class="form-control" placeholder="<?php _e('e.g. johndoe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('user_name') ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left">
                                <label for="field-password"><?php st_the_language('password') ?><span class="color-red"> (*)</span></label>
                                <i class="fa fa-lock input-icon input-icon-show"></i>
                                <input id="field-password" name="password" class="form-control" type="password" placeholder="<?php _e('my secret password',ST_TEXTDOMAIN)?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt20 data_field">
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left">
                                <label for="field-email"><?php st_the_language('email') ?><span class="color-red"> (*)</span></label>
                                <i class="fa fa-envelope input-icon input-icon-show"></i>
                                <input id="field-email" name="email" class="form-control" placeholder="<?php _e('e.g. johndoe@gmail.com',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('email') ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-icon-left">
                                <label for="field-full_name"><?php st_the_language('full_name') ?></label>
                                <i class="fa fa-user input-icon input-icon-show"></i>
                                <input id="field-full_name" name="full_name" class="form-control" placeholder="<?php _e('e.g. John Doe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('full_name') ?>" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="checkbox st_check_term_conditions mt20">
	                    <?php
	                    $page_privacy_policy = get_option('wp_page_for_privacy_policy');
	                    $page_privacy_policy_link = '#';
	                    if(!empty($page_privacy_policy)){
		                    $page_privacy_policy_link = get_permalink($page_privacy_policy);
	                    }
	                    ?>
                        <label>
                            <input class="i-check term_condition" name="term_condition" type="checkbox" <?php if(STInput::post('term_condition')==1) echo 'checked'; ?>/><?php echo  st_get_language('i_have_read_and_accept_the').'<a target="_blank" href="'.get_the_permalink(st()->get_option('page_terms_conditions')).'"> '.st_get_language('terms_and_conditions').'</a> and <a href="'. esc_url($page_privacy_policy_link) .'" target="_blank">'. __('Privacy Policy', ST_TEXTDOMAIN) .'</a>';?>
                        </label>
                    </div>

                    <div class="text-center mt20 btn-submit-form">
                        <input name="btn_reg" class="btn btn-primary btn-lg" type="hidden" value="register">
                        <input type="hidden" name="action" value="st_registration_popup">
                        <button class="btn btn-primary btn-lg" type="submit" ><?php echo esc_html($btn_register) ?></button>
                        <img  alt="loading" src="<?php echo esc_url(ST_TRAVELER_URI.'/img/ajax-login.gif')?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>