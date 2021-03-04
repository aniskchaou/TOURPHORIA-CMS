<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field check out
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 

$default=array(
    'title'=>'',
    'is_required'=>'on',
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
<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange  st-flight-to-field form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
    <label for="field-hotel-checkout"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input  readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control <?php echo esc_attr($is_required) ?> checkout_hotel" value="<?php echo STInput::get('dd2') ?>" name="dd2" type="text" />
    <input type="hidden" name="d2" class="st-flight-to" value=""> 
</div>