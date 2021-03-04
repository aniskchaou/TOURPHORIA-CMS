<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 9:15 AM
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
$validator= STUser_f::$validator;
$name_input = esc_attr($data['name']);
if(isset($list)){
    $name_input = esc_attr($data['name']) . '[]';
}

wp_enqueue_script('st-partner-address_autocomplete');
wp_enqueue_style('st-partner-address_autocomplete');

if(!empty($post_id)){
    $default = get_post_meta($post_id, $data['name'], true);
}

?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <input type="text" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($name_input); ?>" class="st-partner-field form-control" placeholder="<?php echo esc_html($plh); ?>" value="<?php echo esc_html($default); ?>" data-condition="<?php echo $condition; ?>" data-operator="<?php echo $operator; ?>" autocomplete="off"/>
    <div class="st_field_msg"></div>
</div>
