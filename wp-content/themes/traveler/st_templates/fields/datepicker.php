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
$value_std = '';

if (!empty($post_id)) {
    if(!isset($list_val) || empty($list_val)) {
        $value_std = get_post_meta($post_id, $name_input, true);
        if ($name_input == 'st_title') {
            $value_std = get_the_title($post_id);
        }
    }else{
        $value_std = $list_val;
    }
}else{
    $value_std = $default;
}
if(!empty($value_std)){
    $value_std = date(TravelHelper::getDateFormat(), strtotime($value_std));
}
?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <input type="text" value="<?php echo esc_attr($value_std); ?>" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($name_input); ?>" class="st-partner-field form-control partner-date" placeholder="<?php echo esc_html($plh); ?>" data-condition="<?php echo esc_attr($condition); ?>" data-operator="<?php echo esc_attr($operator); ?>" data-format="<?php echo TravelHelper::getDateFormatJs(); ?>" autocomplete="off"/>
    <div class="st_field_msg"></div>
</div>
