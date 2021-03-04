<?php
$date_now = strtotime('now + 1day');
$check_out = '';
if(Helios_Input()->get('checkout_d') && Helios_Input()->get('checkout_m') && Helios_Input()->get('checkout_y')) {
    $date = new DateTime(Helios_Input()->get('checkout_d') . '-' . Helios_Input()->get('checkout_m') . '-' . Helios_Input()->get('checkout_y'));
    $check_out = $date->format(get_option('date_format'));
}
if(empty($check_in)){
    $check_out = date(get_option('date_format'), $date_now);
}
?>
<div class="helios-form-control col-md-<?php echo esc_attr($layout_size); ?> col-sm-<?php echo esc_attr($layout_size); ?> col-xs-6 item-search datepicker-field helios-form-<?php echo esc_attr($field_attribute); ?>">
    <div class="item-search-content">
        <?php if(!empty($label)){ ?>
            <label><?php echo esc_attr($label)?></label>
        <?php } ?>
        <div class="options cursor">
            <div class="day">
                00
            </div>
            <div class="month">
                <span><?php esc_html_e("Month","heliospress") ?></span>
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
        <input type="hidden" class="checkout_d" name="checkout_d" value="<?php echo Helios_Input()->get('checkout_d',date('j', $date_now))?>" />
        <input type="hidden" class="checkout_m" name="checkout_m" value="<?php echo Helios_Input()->get('checkout_m',date('n', $date_now))?>" />
        <input type="hidden" class="checkout_y" name="checkout_y" value="<?php echo Helios_Input()->get('checkout_y',date('Y', $date_now))?>" />
        <input type="text"  name="checkout" class="wpbooking-date-end helios-input" readonly value="<?php echo esc_html($check_out) ?>">
    </div>
</div>