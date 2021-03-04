<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 12/23/2016
 * Version: 1.0
 */

$disable = '';
if(WB_Form_Builder_Input::get('action') == 'create_new' || !$form_id){
    $disable = 'metabox-holder-disabled';
}
$groups = WB_Form_Builder_Controller::inst()->get_group();

?>
<div id="menu-settings-column" class="metabox-holder <?php echo esc_attr($disable); ?>">
    <div class="clear"></div>
    <form id="nav-menu-meta" class="nav-menu-meta" method="post" enctype="multipart/form-data">
        <div id="side-sortables" class="accordion-container">
            <ul class="outer-border">
                <?php
                if($groups) {
                    foreach ($groups as $key => $group) {
                        switch($key){
                            case 'basic':
                                ?>
                                <li class="control-section accordion-section add-form-fields open">
                                    <h3 class="accordion-section-title hndle"><?php echo esc_html__('Basic fields', ST_TEXTDOMAIN) ?></h3>
                                    <div class="accordion-section-content" style="display: block">
                                        <div class="inside">
                                            <div class="posttypediv">
                                                <div class="tabs-panel">
                                                    <input type="hidden" name="field_select" class="field_select" value="">
                                                    <ul class="categorychecklist form-no-clear form-list-field">
                                                        <?php
                                                        foreach($group as $field_id => $field){
                                                            ?>
                                                            <li>
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="form-item-checkbox" name="<?php echo esc_attr($field_id); ?>" value="<?php echo esc_attr($field_id); ?>"> <?php echo esc_attr($field->get_info('title')); ?>
                                                                </label>
                                                            </li>
                                                            <?php

                                                        }
                                                        ?>

                                                    </ul>
                                                </div><!-- /.tabs-panel -->
                                                <p class="button-controls wp-clearfix">
                                                <span class="list-controls">
                                                    <a href="#" class="select-all-builder"
                                                       role="button"><?php echo esc_html__('Select All', ST_TEXTDOMAIN) ?></a>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="submit" class="button submit-add-to-form right"
                                                           value="<?php echo esc_html__('Add to form', ST_TEXTDOMAIN); ?>"
                                                           name="add-taxonomy-menu-item">
                                                </span>
                                                </p>

                                            </div><!-- /.taxonomydiv -->
                                        </div><!-- .inside -->
                                    </div><!-- .accordion-section-content -->
                                </li>
                                <?php
                                break;
                            case 'user':
                                ?>
                                <li class="control-section accordion-section add-form-fields">
                                    <h3 class="accordion-section-title hndle"><?php echo esc_html__('User fields', ST_TEXTDOMAIN) ?></h3>
                                    <div class="accordion-section-content ">
                                        <div class="inside">
                                            <div class="posttypediv">
                                                <div class="tabs-panel">
                                                    <input type="hidden" name="field_select" class="field_select" value="">
                                                    <ul class="categorychecklist form-no-clear form-list-field">
                                                        <?php
                                                        foreach($group as $field_id => $field){
                                                            ?>
                                                            <li>
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="form-item-checkbox" name="<?php echo esc_attr($field_id); ?>" value="<?php echo esc_attr($field_id); ?>"> <?php echo esc_attr($field->get_info('title')); ?>
                                                                </label>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div><!-- /.tabs-panel -->
                                                <p class="button-controls wp-clearfix">
                                                <span class="list-controls">
                                                    <a href="#" class="select-all-builder"
                                                       role="button"><?php echo esc_html__('Select All', ST_TEXTDOMAIN) ?></a>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="submit" class="button submit-add-to-form right"
                                                           value="<?php echo esc_html__('Add to form', ST_TEXTDOMAIN); ?>"
                                                           name="add-taxonomy-menu-item">
                                                    <span class="spinner"></span>
                                                </span>
                                                </p>

                                            </div><!-- /.taxonomydiv -->
                                        </div><!-- .inside -->
                                    </div><!-- .accordion-section-content -->
                                </li>
                                <?php
                                break;
                            case 'advance':
                                ?>
                                <li class="control-section accordion-section add-form-fields">
                                    <h3 class="accordion-section-title hndle"><?php echo esc_html__('Advance fields', ST_TEXTDOMAIN) ?></h3>
                                    <div class="accordion-section-content ">
                                        <div class="inside">
                                            <div class="posttypediv">
                                                <div class="tabs-panel">
                                                    <input type="hidden" name="field_select" class="field_select" value="">
                                                    <ul class="categorychecklist form-no-clear form-list-field">
                                                        <?php
                                                        foreach($group as $field_id => $field){
                                                            ?>
                                                            <li>
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="form-item-checkbox" name="<?php echo esc_attr($field_id); ?>" value="<?php echo esc_attr($field_id); ?>"> <?php echo esc_attr($field->get_info('title')); ?>
                                                                </label>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>

                                                    </ul>
                                                </div><!-- /.tabs-panel -->
                                                <p class="button-controls wp-clearfix">
                                                <span class="list-controls">
                                                    <a href="#" class="select-all-builder"
                                                       role="button"><?php echo esc_html__('Select All', ST_TEXTDOMAIN) ?></a>
                                                </span>

                                                <span class="add-to-menu">
                                                    <input type="submit" class="button submit-add-to-form right"
                                                           value="<?php echo esc_html__('Add to form', ST_TEXTDOMAIN); ?>"
                                                           name="add-taxonomy-menu-item">
                                                    <span class="spinner"></span>
                                                </span>
                                                </p>

                                            </div><!-- /.taxonomydiv -->
                                        </div><!-- .inside -->
                                    </div><!-- .accordion-section-content -->
                                </li>
                                <?php
                                break;
                        }}
                }?>
            </ul>
        </div>
    </form>
</div>