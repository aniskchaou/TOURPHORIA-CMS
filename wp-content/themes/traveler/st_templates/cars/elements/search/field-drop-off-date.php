<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field drop off date
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
if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset( $field_size ))
    $field_size = 'md';
?>
<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
    
    <label for="field-st-dropoff-date"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input id="field-st-dropoff-date" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>"  value="<?php echo STInput::request('drop-off-date') ?>" class="form-control drop-off-date car_drop-off-date <?php echo esc_attr($is_required) ?>" name="drop-off-date" type="text" />
</div>