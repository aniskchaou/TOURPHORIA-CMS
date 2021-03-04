<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field check in
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 

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

<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange  form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="field-hotel-checkin"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input id="field-hotel-checkin" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control checkin_hotel <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('dd1') ?>" name="dd1" type="text" />
    <input type="hidden" name="d1" class="st-flight-from" value=""> 
</div>
