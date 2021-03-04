<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field drop off to
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_style( 'st-select.css' );
wp_enqueue_script( 'st-select.js' );

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

$location_id=STInput::get('location_id_drop_off', '');
$location_name = STInput::request('drop-off', '');

$locations = TravelHelper::getListFullNameLocation('st_cars');

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-st-dropoff-to"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-select-wrapper">
        <input autocomplete="off" type="text" name="drop-off" value="<?php echo esc_html($location_name); ?>" class="form-control st-location-name <?php echo esc_attr($is_required); ?>" placeholder="<?php if($placeholder) echo $placeholder; ?>">
        <select id="field-st-dropoff-to" name="location_id_drop_off" class="st-location-id st-hidden <?php echo esc_attr($is_required) ?>" placeholder="<?php if($placeholder) echo esc_html($placeholder); ?>" tabindex="-1">
            <option value=""></option>
            <?php 
                if(is_array($locations) && count($locations)):
                    foreach($locations as $key => $value):
            ?>
            <option <?php selected($value->ID, $location_id); ?> value="<?php echo esc_html($value->ID); ?>"><?php echo esc_html($value->fullname); ?></option>
            <?php endforeach; endif; ?>
        </select>
        <div class="option-wrapper"></div>
    </div>
</div>