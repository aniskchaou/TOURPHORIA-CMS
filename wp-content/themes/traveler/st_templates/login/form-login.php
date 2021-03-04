<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * form login
 *
 * Created by ShineTheme
 *
 */
$url_reset = st()->get_option('page_reset_password', '');
if( $url_reset ){
    $url_reset = get_permalink( $url_reset );
}else{
    $url_reset = wp_lostpassword_url();
}

$class_form='';
if(is_page_template('template-login.php')){
    $class_form = 'form-group-ghost';
}
    $btn_sing_in = get_post_meta(get_the_ID(),'btn_sing_in',true);
    if(empty($btn_sing_in))$btn_sing_in=__("Sign In",ST_TEXTDOMAIN);
?>
<form method="post" action="<?php echo esc_url(add_query_arg(array(
    'url'=>STInput::request('url')
)))?>">
    <?php
        global $status_error_login;
        echo balanceTags($status_error_login);

    ?>
    <div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
        <label for="field-login_name"><?php _e("User Name",ST_TEXTDOMAIN) ?></label>
        <i class="fa fa-user input-icon input-icon-show"></i>
        <input id="field-login_name" name="login_name" class="form-control" placeholder="<?php _e('e.g. johndoe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('login_name') ?>" />
    </div>
    <div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
        <label for="field-login_password"><?php st_the_language('password') ?></label>
        <i class="fa fa-lock input-icon input-icon-show"></i>
        <input id="field-login_password" name="login_password" class="form-control" type="password"  placeholder="<?php st_the_language('my_secret_password') ?>" />
    </div>
    <?php
    if(STRecaptcha::inst()->_is_check_allow_captcha()){
    ?>
        <div class="form-group">
            <label for="field-login_password"><?php echo esc_html__('Captcha', ST_TEXTDOMAIN) ?></label>
            <div class="content-captcha">
                <?php echo do_shortcode(STRecaptcha::inst()->get_captcha(get_the_ID())); ?>
            </div>
        </div>
    <?php } ?>

    <input class="btn btn-primary" name="dlf_submit" type="submit" value="<?php echo esc_html($btn_sing_in) ?>" />
    <?php
    if(!empty($status_error_login)){
        ?>
        <br>
        <a href="<?php echo esc_url( $url_reset ); ?>" title="<?php _e("Forget Password",ST_TEXTDOMAIN) ?>"><?php _e("Forget Password ?",ST_TEXTDOMAIN) ?></a>
    <?php
    }
    unset($status_error_login);
    ?>

    <div class="checkbox st_check_term_conditions mt20">
		<?php
		$page_privacy_policy = get_option('wp_page_for_privacy_policy');
		if(!empty($page_privacy_policy)){
			$page_privacy_policy_link = get_permalink($page_privacy_policy);
			?>
            <a href="<?php echo esc_html($page_privacy_policy_link); ?>"><?php echo __('Privacy Policy', ST_TEXTDOMAIN); ?></a>
			<?php
		}
		?>
    </div>
</form>