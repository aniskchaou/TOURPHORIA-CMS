<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 2/6/2017
 * Version: 1.0
 */
wp_enqueue_style( 'st-select.css' );
wp_enqueue_script( 'st-select.js' );
$default=array(
    'title'=>'',
    'placeholder'=>'',
    'is_required'=>'',
);
if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}

if($is_required == 'on'){
    $is_required = 'required';
}

if(!isset($field_size)) $field_size='lg';

$locale_default = st()->get_option('tp_locale_default','en');

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="location_destination"><?php echo esc_html( $title)?></label>
    <i class="fa fa-plane input-icon"></i>
    <div class="st-select-wrapper tp-flight-wrapper" >
        <input <?php echo esc_attr($is_required); ?> data-id="location_destination" type="text" data-locale="<?php echo esc_attr($locale_default); ?>" class="form-control tp-flight-location st-location-name" autocomplete="off" data-name="destination_iata" value="" placeholder="<?php echo esc_html( $placeholder ); ?>">
    </div>
</div>