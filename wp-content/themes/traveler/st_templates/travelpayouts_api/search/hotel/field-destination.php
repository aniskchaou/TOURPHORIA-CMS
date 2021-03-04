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
    <i class="fa fa-building input-icon"></i>
    <div class="st-select-wrapper tp-hotel-wrapper" >
        <input <?php echo esc_attr($is_required); ?> id="location_destination_h" type="text" data-text="<?php echo esc_html__('hotel(s)', ST_TEXTDOMAIN); ?>" data-locale="<?php echo esc_attr($locale_default); ?>" class="form-control tp-hotel-destination" autocomplete="off" data-name="destination" value="" placeholder="<?php echo esc_html( $placeholder ); ?>">
    </div>
</div>