<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 21/07/2015
 * Time: 8:51 SA
 */
$default=array(
    'title'=>'',
    'placeholder'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}

if(!isset($field_size)) $field_size='lg';

$old_location=STInput::get('location_tax_id');
$name_location = STInput::get('location_tax_name');
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-hotel-location-tax"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-select-wrapper">
        <input type="hidden" name="location_tax_id" value="<?php echo esc_attr( $old_location); ?>">
        <input id="field-hotel-location-tax" type="text" name="location_tax_name" class="form-control st-select-input" value="<?php echo esc_attr( $name_location); ?>" autocomplete="off" placeholder="<?php echo ($placeholder)? $placeholder:false?>">
        <ul class="st-select-list"></ul>
        <i class="fa fa-circle-o-notch st-loading"></i>
    </div>
</div>