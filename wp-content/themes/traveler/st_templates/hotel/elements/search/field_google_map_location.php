<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.2.0
 *
 * Activity element search address
 *
 * Created by ShineTheme
 *
 */
return ;
$default=array(
    'title'=>'',
    'is_required'=>'on',

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

$st_google_location = STInput::request('st_google_location', '');
$st_locality = STInput::request('st_locality', '');
$st_sublocality_level_1 = STInput::request('st_sub', '');
$st_administrative_area_level_1 = STInput::request('st_admin_area', '');
$st_country = STInput::request('st_country', '');
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-st-address"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-google-location-wrapper">
        <input id="st_google_location" autocomplete="off" type="text" class="st_google_location form-control <?php echo esc_attr($is_required) ?>" name="st_google_location" value="<?php echo esc_attr($st_google_location); ?>">
        <input type="hidden" name="st_locality" value="<?php echo esc_attr($st_locality); ?>">
        <input type="hidden" name="st_sub" value="<?php echo esc_attr($st_sublocality_level_1); ?>">
        <input type="hidden" name="st_admin_area" value="<?php echo esc_attr($st_administrative_area_level_1); ?>">
        <input type="hidden" name="st_country" value="<?php echo esc_attr($st_country); ?>">
    </div>
</div>