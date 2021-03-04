<?php
/**
 * Created by ShineTheme.
 * User: Nasanji
 * Date: 12/21/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$form_data = ST_Form_Builder_Models::inst()->get_data($form_id);

if(!empty($form_data)){
?>
<div id="menu-management-liquid">
    <div id="menu-management">
        <form id="update-nav-menu" class="wb-update-form" method="post" enctype="multipart/form-data">
            <div class="menu-edit ">
                <div id="nav-menu-header">
                    <div class="major-publishing-actions wp-clearfix">
                        <label class="menu-name-label" for="menu-name"><?php echo esc_html__('Form Name',ST_TEXTDOMAIN)?></label>
                        <input type="hidden" name="action" value="edit" />
                        <input type="hidden" name="form_id" value="<?php echo esc_attr($form_id);?>">
                        <?php
                        wp_nonce_field('wb_update_form_builder', 'wb_form_nonce');
                        $title = '';
                        if(!empty($form_data['name'])){
                            $title = $form_data['name'];
                        }
                        ?>
                        <input name="form-name" type="text" class="menu-name regular-text menu-item-textbox" value="<?php echo esc_html($title); ?>">
                        <div class="publishing-action">
                            <input type="submit" name="save_form" id="save_form_header" class="button button-primary button-large wb-form-save" value="<?php echo esc_html__('Save Form',ST_TEXTDOMAIN); ?>">
                        </div>
                    </div>
                </div>
                <div id="post-body">
                    <div class="wp-clearfix">
                        <h3><?php echo esc_html__('Form Content',ST_TEXTDOMAIN); ?></h3>
                        <?php
                        $data_items = unserialize($form_data['meta']);
                        $drag_hidden = $new_hidden = '';
                        if(!empty($data_items) && is_array($data_items) && count($data_items) > 0){
                            $new_hidden = 'fb_hidden';
                        }else{
                            $drag_hidden = 'fb_hidden';
                        }
                        ?>
                        <div class="drag-instructions post-body-plain <?php echo esc_attr($drag_hidden); ?>">
                            <p><?php echo esc_html__('Drag each item into the order you prefer. Click the blue icon on the right of the item to reveal additional configuration options.',ST_TEXTDOMAIN)?></p>
                        </div>
                        <div id="form-instructions" class="post-body-plain <?php echo esc_attr($new_hidden); ?>">
                            <p><?php echo esc_html__('Add form items from the column on the left.',ST_TEXTDOMAIN)?></p>
                        </div>
                        <ul class="menu form ui-sortable" id="form-to-edit">
                            <!--items here-->
                            <?php
                            $data_item_types = unserialize($form_data['data_type']);
                            if(!empty($data_items) && is_array($data_items) && count($data_items) > 0){
                                $inti = 0;
                                foreach($data_items as $key => $value){
                                    $field = WB_Form_Builder_Controller::inst()->get_field($data_item_types[$key]);
                                    if(!empty($field)) {
                                        $html = '<li class="wb-form-item menu-item menu-item-edit-inactive">
                                        <div class="menu-item-bar">
                                        <input type="hidden" name="field_type['.$inti.']" value="' . $data_item_types[$key] . '">
                                        <input type="hidden" name="item_data['.$inti.'][field_type]" value="'.$data_item_types[$key].'">
                                            <div class="menu-item-handle form-item-handle ui-sortable-handle">
                                                <span class="item-title">
                                                    <span class="form-item-title">' . esc_attr($value['title']) . '</span>
                                                    <span class="error-message fb_hidden"></span>
                                                </span>
                                                <span class="item-controls">
                                                    <span class="item-type">' . $field->get_info('title') . '</span>
                                                    <a class="item-edit" title="'.esc_html__('Setting',ST_TEXTDOMAIN).'" href="#"></a>
                                                    <a class="wb-item-delete item-delete" title="'.esc_html__('Delete',ST_TEXTDOMAIN).'" href="#"><i class="dashicons dashicons-no"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="menu-item-settings wp-clearfix">';
                                        $field_settings = $field->get_field_settings();
                                        if (!empty($field_settings) && is_array($field_settings)) {
                                            foreach ($field_settings as $k => $v) {
                                                $html .= wb_form_builder_field_setting($v, 'edit', $inti, $value);
                                            }
                                            $html .= '<div class="menu-item-actions description-wide submitbox">
                                                <a class="item-delete submitdelete deletion" href="#">' . esc_html__('Remove', ST_TEXTDOMAIN) . '</a>
                                                <span class="meta-sep hide-if-no-js"> | </span>
                                                <a class="item-cancel submitcancel hide-if-no-js" href="#">' . esc_html__('Cancel', ST_TEXTDOMAIN) . '</a>
                                            </div>';
                                            $html .= '</div>';
                                        }
                                        $html .= '</li>';
                                        echo do_shortcode($html);
                                    }
                                    $inti++;
                                }
                            }
                            ?>
                        </ul>
                        <div class="wb-form-note">
                            <div>
                            <?php echo wp_kses(__('To send notification email to your customers after they finished booking, required entering the name field to be <strong>"st_email"</strong>  or just simply select the mail user in the user group.',ST_TEXTDOMAIN),array('strong' => array()))?>
                                </div>
                        </div>
                        <div class="menu-settings">

                            <h3><?php echo esc_html__('Form Settings',ST_TEXTDOMAIN)?></h3>

                            <fieldset class="menu-settings-group auto-add-pages">
                                <legend class="menu-settings-group-name howto"><?php echo esc_html__('Use this form for checkout?',ST_TEXTDOMAIN)?></legend>
                                <div class="menu-settings-input checkbox-input">
                                    <?php
                                        $use_for_checkout = get_option('wb_form_use_for_checkout','');
                        
                                    ?>
                                    <input type="checkbox" name="use_form_checkout" <?php checked($use_for_checkout, $form_id)?> id="use_form_checkout" value="1"> <label for="auto-add-pages"><?php echo esc_html__('Yes',ST_TEXTDOMAIN)?></label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div id="nav-menu-footer">
                    <div class="major-publishing-actions wp-clearfix wb-edit-footer-action">
                        <span class="delete-action">
                            <?php
                            $duplicate_url = add_query_arg(array(
                                'action' => 'duplicate',
                                'form' => $form_id,
                                '_wpnonce' => wp_create_nonce('wb-duplicate-form')
                            ), admin_url('admin.php?page=wb_page_form_builder'));
                            ?>
                            <a class="submitduplicate form-duplicate" href="<?php echo esc_url($duplicate_url); ?>" ><?php echo esc_html__('Duplicate Form',ST_TEXTDOMAIN)?></a>&nbsp;|&nbsp;
                        </span>
                        <span class="delete-action">
                            <?php
                            $delete_url = add_query_arg(array(
                                'action' => 'delete',
                                'form' => $form_id,
                                '_wpnonce' => wp_create_nonce('wb-delete-field-form')
                            ), admin_url('admin.php?page=wb_page_form_builder'));
                            ?>
                            <a class="submitdelete menu-delete form-delete" href="<?php echo esc_url($delete_url); ?>"><?php echo esc_html__('Delete Form',ST_TEXTDOMAIN)?></a>
                        </span>
                        <div class="publishing-action">
                            <input type="submit" name="save_form" id="save_form_footer" class="button button-primary button-large wb-form-save" value="<?php echo esc_html__('Save Form',ST_TEXTDOMAIN)?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>