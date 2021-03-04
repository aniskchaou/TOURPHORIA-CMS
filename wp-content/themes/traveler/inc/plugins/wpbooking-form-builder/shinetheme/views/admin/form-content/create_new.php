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
?>
<div id="menu-management-liquid">
    <div id="menu-management">
        <form method="post" enctype="multipart/form-data" action="" class="wb-form-builder-content">
            <div class="menu-edit ">
                <div id="nav-menu-header">
                    <div class="major-publishing-actions wp-clearfix">
                        <?php wp_nonce_field('wb-form-builder-create-new','create-new-form'); ?>
                        <label class="menu-name-label" for="menu-name"><?php echo esc_html__('Form Name',ST_TEXTDOMAIN)?></label>
                        <input name="form-name" id="form-name" type="text" class="form-name regular-text menu-item-textbox" value="">
                        <div class="publishing-action">
                            <input type="submit" name="create_form" id="save_form_header" class="button button-primary button-large wb-form-save" value="<?php echo esc_html__('Create Form',ST_TEXTDOMAIN); ?>">
                        </div>
                    </div>
                </div>
                <div id="post-body">
                    <div id="post-body-content" class="wp-clearfix">
                        <p class="post-body-plain"><?php echo wp_kses(__('Give your form a name, then click <strong>Create From</strong>.',ST_TEXTDOMAIN), array('strong' => array()))?></p>
                    </div>
                </div>
                <div id="nav-menu-footer">
                    <div class="major-publishing-actions wp-clearfix">
                        <div class="publishing-action">
                            <input type="submit" name="create_form" id="save_form_footer" class="button button-primary button-large wb-form-save" value="<?php echo esc_html__('Create form',ST_TEXTDOMAIN)?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

