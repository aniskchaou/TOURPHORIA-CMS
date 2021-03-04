<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 9:16 AM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$plh = isset($data['plh']) ? $data['plh'] : '';
$rows = (isset($data['rows']) && !empty($data['rows'])) ? $data['rows'] : '5';

$name_input = esc_attr($data['name']);
if(isset($list)){
    $name_input = esc_attr($data['name']) . '[]';
}

$value_std = '';
if(!empty($post_id)){
    if(!isset($list_val) || empty($list_val)) {
        $value_std = get_post_meta($post_id, $name_input, true);
        $post = get_post($post_id);
        if ($name_input == 'st_desc') {
            $value_std = $post->post_excerpt;
        }
        if ($name_input == 'st_content') {
            $value_std = stripslashes($post->post_content);;
        }
    }else{
        $value_std = $list_val;
    }
}
?>
<div class="form-group st-field-<?php echo esc_attr($data['name']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <textarea rows="<?php echo esc_html($rows); ?>" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_html($name_input); ?>" class="st-partner-field form-control" placeholder="<?php echo esc_html($plh); ?>"><?php echo esc_attr($value_std); ?></textarea>
    <div class="st_field_msg"></div>
</div>

