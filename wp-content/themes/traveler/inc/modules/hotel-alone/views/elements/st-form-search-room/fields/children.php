<?php $value = STInput::get($field_attribute,'0'); ?>
<div class="helios-form-control col-md-<?php echo esc_attr($layout_size); ?> col-sm-<?php echo esc_attr($layout_size); ?> col-xs-6 item-search datepicker-field helios-form-<?php echo esc_attr($field_attribute); ?>">
    <div class="item-search-content helios-options-number">
        <?php if(!empty($label)){ ?>
            <label><?php echo esc_attr($label)?></label>
        <?php } ?>
        <div class="options">
            <div class="day">
                <input class="helios-input helios-number" min="0" max="99" type="number" name="<?php echo esc_attr($field_attribute); ?>" value="<?php echo esc_html($value) ?>" placeholder="0">
            </div>
            <div class="month">
                <i class="fa fa-angle-up"></i>
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
    </div>
</div>