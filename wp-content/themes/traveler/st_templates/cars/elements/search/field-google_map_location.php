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

$st_google_location_pickup = STInput::request('st_google_location_pickup', '');
$st_locality_up = STInput::request('st_locality_up', '');
$st_sublocality_level_1_up = STInput::request('st_sub_up', '');
$st_administrative_area_level_1_up = STInput::request('st_admin_area_up', '');
$st_country_up = STInput::request('st_country_up', '');

$st_google_location_dropoff = STInput::request('st_google_location_dropoff', '');
$st_locality_off = STInput::request('st_locality_off', '');
$st_sublocality_level_1_off = STInput::request('st_sub_off', '');
$st_administrative_area_level_1_off = STInput::request('st_admin_area_off', '');
$st_country_off = STInput::request('st_country_off', '');

$title_pickup = '';
$title_dropoff = '';
if(!empty($title)){
    $title = explode(',',$title);
    $title_pickup = $title[0];
    if(isset($title[1])){
        $title_dropoff = $title[1];
    }
}
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-st-address"><?php echo esc_html( $title_pickup)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-google-location-wrapper pickup">
    	<input id="st_google_location_pickup" autocomplete="off" type="text" class="st_google_location form-control <?php echo esc_attr($is_required) ?>" name="st_google_location_pickup" value="<?php echo esc_attr($st_google_location_pickup); ?>">
    	<input type="hidden" name="st_locality_up" value="<?php echo esc_attr($st_locality_up); ?>">
    	<input type="hidden" name="st_sub_up" value="<?php echo esc_attr($st_sublocality_level_1_up); ?>">
    	<input type="hidden" name="st_admin_area_up" value="<?php echo esc_attr($st_administrative_area_level_1_up); ?>">
    	<input type="hidden" name="st_country_up" value="<?php echo esc_attr($st_country_up); ?>">
    </div>
</div>
<div class="form-group">
    <a href="#" class="diff-location"><?php echo __('Different Location'); ?></a>
    <a href="#" class="same-location hide"><?php echo __('Same Location'); ?></a>
</div>
<div class="form-group hide form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="field-st-address"><?php echo esc_html( $title_dropoff)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-google-location-wrapper dropoff">
        <input id="st_google_location_dropoff" autocomplete="off" type="text" class="st_google_location form-control <?php echo esc_attr($is_required) ?>" name="st_google_location_dropoff" value="<?php echo esc_attr($st_google_location_dropoff); ?>">
        <input type="hidden" name="st_locality_off" value="<?php echo esc_attr($st_locality_off); ?>">
        <input type="hidden" name="st_sub_off" value="<?php echo esc_attr($st_sublocality_level_1_off); ?>">
        <input type="hidden" name="st_admin_area_off" value="<?php echo esc_attr($st_administrative_area_level_1_off); ?>">
        <input type="hidden" name="st_country_off" value="<?php echo esc_attr($st_country_off); ?>">
    </div>
</div>