<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field pick up form
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'typeahead.js' );

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
<div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">

    <label for="field-car-pickup-address"><?php echo esc_html($title)?></label>
    <i class="fa fa-map-marker input-icon input-icon-highlight"></i>
    <input id="field-car-pickup-address" name="pick-up" data-country="" value="<?php echo STInput::get('pick-up') ?>" class="typeahead_pick_up_address form-control <?php echo esc_attr($is_required) ?>" placeholder="<?php echo ($placeholder)?$placeholder: st_get_language('car_city_airport_or_us_zip_code')?>" type="text" />
</div>