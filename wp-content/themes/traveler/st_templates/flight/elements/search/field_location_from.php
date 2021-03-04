<?php
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
wp_enqueue_script('select-flight' );

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">

    <label for="location_from"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <div class="st-select-wrapper st-flight-wrapper" >
        <input <?php echo esc_html($is_required); ?> id="location_from" type="text" class="form-control custom-flight-location st-location-name" autocomplete="off" data-name="<?php echo esc_html( $location_from ); ?>" value="" placeholder="<?php echo esc_html( $placeholder ); ?>">
    </div>
</div>