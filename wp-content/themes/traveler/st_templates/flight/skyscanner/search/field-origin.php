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

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="ss_location_origin"><?php echo esc_html( $title)?></label>
    <i class="fa fa-plane input-icon"></i>
    <div class="st-select-wrapper ss-flight-wrapper" >
        <input <?php echo esc_html($is_required); ?> id="ss_location_origin" type="text" class="form-control ss-flight-location" autocomplete="off" data-value="" data-name="ss_origin" value="" placeholder="<?php echo esc_html( $placeholder ); ?>">
    </div>
</div>