<?php
/**
 * Created by wpbooking
 * Developer: nasanji
 * Date: 12/20/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$form_id = WB_Form_Builder_Input::get('form');
$form_model = ST_Form_Builder_Models::inst();

if(!$form_id){
    $form_id = get_option('wb_form_use_for_checkout', 0);
    if(empty($form_id)){
        $form_id = $form_model->get_first_form_id();
    }
}
?>
<div class="nav-menus-php">
    <div class="wrap">
        <h1><?php echo esc_html__('Form Builder', ST_TEXTDOMAIN)?></h1>
        <?php
        //message
        if(WB_Form_Builder_Input::get('form') == 'error'){
            echo wb_get_admin_message(true);
        }
        if(WB_FB_Session::get('delete') == 'success'){
            echo wb_get_admin_message(true);
            WB_FB_Session::destroy('delete');
        }
        if(WB_Form_Builder::inst()->get('update') == 'success'){
            echo wb_get_admin_message(true);
        }
        if(WB_FB_Session::get('duplicate') == 'success'){
            echo wb_get_admin_message(true);
            WB_FB_Session::destroy('duplicate');
        }
        ?>
        <div class="fb_hidden error error-form-validate"></div>
        <?php do_action('wb_form_builder_after_title', $form_id) ?>
        <div id="nav-menus-frame" class="wp-clearfix">
            <?php
            do_action('wb_form_builder_content_form', $form_id);
            ?>
        </div>
    </div>
</div>