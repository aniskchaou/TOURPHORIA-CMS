<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/28/2019
 * Time: 1:33 PM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$plh = isset($data['plh']) ? $data['plh'] : '';
$default = '';
if(isset($data['std']))
    $default = $data['std'];

$condition = isset($data['condition']) ? $data['condition'] : '';
$operator = isset($data['operator']) ? $data['operator'] : 'or';

$value_std = '';
if (!empty($post_id)) {
    $value_std = get_post_meta($post_id, $data['name'], true);
}

?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <input type="text" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="st-partner-field form-control" placeholder="<?php echo esc_html($plh); ?>" value="<?php echo esc_html($value_std); ?>" data-condition="<?php echo esc_attr($condition); ?>" data-operator="<?php echo esc_html($operator); ?>" data-provide="timepicker" data-template="dropdown" data-minute-step="15"/>
</div>
