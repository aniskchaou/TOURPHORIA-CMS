<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field adult
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'is_required'=>'',
);
if($is_required == 'on'){
    $is_required = 'required';
}

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}

if(!isset($field_size)) $field_size='lg';

$old=STInput::get('adult_number');
?>
<div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-select-plus">
    <label for=""><?php echo esc_html($title)?></label>
    
    <select class="form-control select-flight-trip" <?php echo esc_html($is_required); ?>>
        <option value="1"><?php echo __('Return', ST_TEXTDOMAIN) ?></option>
        <option value="0"><?php echo __('One Way', ST_TEXTDOMAIN) ?></option>
    </select>
</div>