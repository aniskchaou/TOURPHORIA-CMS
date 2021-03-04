<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 04/06/2015
 * Time: 10:39 SA
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}

if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset( $field_size ))
    $field_size = 'md';
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="field-car-item-name"><?php echo balanceTags( $title)?></label>
    <i class="fa fa-sort-amount-asc input-icon"></i>
    <input id="field-car-item-name" name="item_name" value="<?php echo STInput::get('item_name') ?>" class="form-control <?php echo esc_attr($is_required) ?>" placeholder="<?php echo ($placeholder)? $placeholder:false?>" type="text" />
</div>