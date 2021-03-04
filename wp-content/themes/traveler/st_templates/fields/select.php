<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 9:35 AM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$value_std = '';
if(!empty($post_id)){
    if(!isset($list_val) || empty($list_val)) {
        $value_std = get_post_meta($post_id, $data['name'], true);
        if($data['name'] == 'total_time[hour]'){
            $meta_data = get_post_meta($post_id, 'total_time', true);
            $value_std = $meta_data['hour'];
        }
        if($data['name'] == 'total_time[minute]'){
            $meta_data = get_post_meta($post_id, 'total_time', true);
            $value_std = $meta_data['minute'];
        }
    }else{
        $value_std = $list_val;
    }
}


$name_input = esc_attr($data['name']);
if(isset($list)){
    $name_input = esc_attr($data['name']) . '[]';
}

$condition = isset($data['condition']) ? $data['condition'] : '';
$operator = isset($data['operator']) ? $data['operator'] : 'or';
?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <select id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($name_input); ?>" class="st-partner-field form-control" data-condition="<?php echo esc_attr($condition); ?>" data-operator="<?php echo esc_attr($operator); ?>">
        <?php
        if(!empty($data['options'])){
            foreach ($data['options'] as $k => $v){
                $selected = '';
                if($value_std == $k)
                    $selected = 'selected';
                echo '<option value="'. $k .'" '. $selected .'>'. $v .'</option>';
            }
        }
        ?>
    </select>
</div>