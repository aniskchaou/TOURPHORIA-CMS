<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field drop off time
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-timepicker.js' );

$default=array(
    'title'=>'',
    'is_required'=>'on',
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
<div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
    <label for="field-st-dropoff-time"><?php echo esc_html( $title) ?></label>
    <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
    <input id="field-st-dropoff-time" name="drop-off-time"  class="time-pick form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::request('drop-off-time') ?>" type="text"  />
</div>