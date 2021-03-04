<?php extract($args); ?>
<?php
    /* verify a description */
    $has_desc = $field_desc ? TRUE : FALSE;
    echo '<div class="format-setting type-post_select_ajax ' . ($has_desc ? 'has-desc' : 'no-desc') . '">';
    /* description */
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '';
    /* format setting inner wrapper */
    echo '<div class="format-setting-inner">';
    /* allow fields to be filtered */
    echo '<div class="option-tree-ui-' . $type . '-input-wrap">';
    ?>
<input type="hidden" name="st_custom_price_nonce" value="<?php echo esc_attr($st_custom_price_nonce) ?>"/>
<?php $data = STAdmin::st_get_all_price($post_id);?>
<div class="data_price">
    <?php if(!empty($data) and is_array($data)): ?>
        <?php foreach($data as $k=>$v){ $id_rand = rand();?>
            <div class="item">
                <div class="data">
                    <div class="form">
                        <label ><?php _e("Price:",ST_TEXTDOMAIN) ?> </label>
                        <input name="st_price[]" value="<?php echo esc_html($v->price) ?>" type="text">
                        <label ><?php _e("Priority:",ST_TEXTDOMAIN) ?> </label>
                        <input name="st_priority[]" value="<?php echo esc_html($v->priority) ?>" type="text" class="">
                    </div>
                    <div class="form">
                        <label ><?php _e("Start Date:",ST_TEXTDOMAIN) ?> </label>
                        <input dateFormat="yy-mm-dd" id="start_<?php echo esc_attr($id_rand) ?>" name="st_start_date[]" value="<?php echo esc_html($v->start_date) ?>" type="text" class="st_datepicker_price">
                        <label ><?php _e("End Date:",ST_TEXTDOMAIN) ?></label>
                        <input dateFormat="yy-mm-dd" id="end_<?php echo esc_attr($id_rand) ?>" name="st_end_date[]" value="<?php echo esc_html($v->end_date) ?>" type="text" class="st_datepicker_price">
                    </div>
                    <div>
                        <input name="st_price_type[]" value="default" type="hidden" class="">
                        <input name="st_status[]" value="1" type="hidden" class="">
                    </div>
                </div>
                <div class="control">
                    <button class="button button-danger btn_del_price" type="button" ><?php _e("Delete",ST_TEXTDOMAIN) ?></button>
                </div>
            </div>
        <?php } ?>
    <?php endif; ?>
</div>
<div class="nav" style="text-align: right">
    <button class="option-tree-list-item-add option-tree-ui-button button button-primary btn btn-primary btn_add_price" type="button" ><?php _e("Add Price",ST_TEXTDOMAIN) ?></button>
</div>
<div class="data_price_html">
    <div class="item">
        <div class="data">
            <div class="form">
                <label ><?php _e("Price:",ST_TEXTDOMAIN) ?> </label>
                <input name="st_price[]" value="" type="text">
                <label ><?php _e("Priority:",ST_TEXTDOMAIN) ?> </label>
                <input name="st_priority[]" value="" type="text" class="">
            </div>
            <div class="form">
                <label ><?php _e("Start Date:",ST_TEXTDOMAIN) ?> </label>
                <input id="start" name="st_start_date[]" value="" type="text" class="st_datepicker_price">
                <label ><?php _e("End Date:",ST_TEXTDOMAIN) ?></label>
                <input id="end" name="st_end_date[]" value="" type="text" class="st_datepicker_price">
            </div>
            <div>
                <input name="st_price_type[]" value="default" type="hidden" class="">
                <input name="st_status[]" value="1" type="hidden" class="">
            </div>
        </div>
        <div class="control">
            <button class="option-tree-list-item-add option-tree-ui-button button button-default btn btn-danger btn_del_price" type="button" ><?php _e("Delete",ST_TEXTDOMAIN) ?></button>
        </div>
    </div>
</div>
<?php
echo '</div>';
echo '</div>';
echo '</div>';