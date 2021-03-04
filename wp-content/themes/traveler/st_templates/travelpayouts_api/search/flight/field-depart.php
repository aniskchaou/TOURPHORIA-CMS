<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 2/6/2017
 * Version: 1.0
 */
$default=array(
    'title'=>'',
    'is_required'=>'',
    'placeholder'=> ''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if(!isset($field_size)) $field_size='lg';
if($is_required == 'on'){
    $is_required = 'required';
}

?>

<div data-tp-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange  form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="field-depart-date"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input <?php echo esc_attr($is_required) ?> placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control tp_depart_date <?php echo esc_attr($is_required) ?>" readonly value="" type="text" />
    <input type="hidden" name="depart_date" class="tp-date-from" value="">
</div>
