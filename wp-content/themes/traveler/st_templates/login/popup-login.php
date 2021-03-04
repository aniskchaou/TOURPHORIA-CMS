<?php
/**
 * Created by ShineTheme.
 * User: NAZUMI
 * Date: 9/26/2016
 * Version: 1.0
 */
$url_reset = st()->get_option('page_reset_password', '');
if( $url_reset ){
    $url_reset = get_permalink( $url_reset );
}else{
    $url_reset = wp_lostpassword_url();
}
?>
<div class="modal fade login_popup" id="login_popup" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="smallModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo esc_html__('Sign In',ST_TEXTDOMAIN)?></h4>
            </div>
            <div class="modal-body">
                <form class="st_login_form_popup" method="post" action="<?php echo esc_url(add_query_arg(array(
                    'url'=>STInput::request('url')
                )))?>">
                    <div class="notice_login"></div>
                    <div class="form-group form-group-icon-left">
                        <label for="pop-login_name"><?php _e("User Name",ST_TEXTDOMAIN) ?></label>
                        <i class="fa fa-user input-icon input-icon-show"></i>
                        <input id="pop-login_name" name="login_name" class="form-control" placeholder="<?php _e('e.g. johndoe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('login_name') ?>" />
                    </div>
                    <div class="form-group form-group-icon-left">
                        <label for="pop-login_password"><?php st_the_language('password') ?></label>
                        <i class="fa fa-lock input-icon input-icon-show"></i>
                        <input id="pop-login_password" name="login_password" class="form-control" type="password"  placeholder="<?php st_the_language('my_secret_password') ?>" />
                    </div>
                    <?php
                    $btn_sing_in = get_post_meta(get_the_ID(),'btn_sing_in',true);
                    if(empty($btn_sing_in)){
                        $btn_sing_in = __("Sign In",ST_TEXTDOMAIN);
                    }
                    ?>
                    <div class="btn-submit-form">
                    <input class="btn btn-primary btn-login-popup" name="login_submit" type="submit" value="<?php echo esc_attr($btn_sing_in) ?>" />
                        <img  alt="loading" src="<?php echo esc_url(ST_TRAVELER_URI.'/img/ajax-login.gif')?>">
                    </div>
                    <br>
                    <a class="popup_forget_pass" href="<?php echo esc_url( $url_reset ); ?>" title="<?php _e("Forget Password",ST_TEXTDOMAIN) ?>"><?php _e("Forget Password ?",ST_TEXTDOMAIN) ?></a>
                    <div class="checkbox st_check_term_conditions">
		                <?php
		                $page_privacy_policy = get_option('wp_page_for_privacy_policy');
		                if(!empty($page_privacy_policy)){
			                $page_privacy_policy_link = get_permalink($page_privacy_policy);
			                ?>
                            <a href="<?php echo esc_html($page_privacy_policy_link); ?>" ><?php echo __('Privacy Policy', ST_TEXTDOMAIN); ?></a>
			                <?php
		                }
		                ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
