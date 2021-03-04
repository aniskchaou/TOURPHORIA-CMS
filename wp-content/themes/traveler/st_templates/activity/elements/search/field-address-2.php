<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field location
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'typeahead.js' );

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
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-st-address"><?php echo esc_html( $title)?></label>
    <i class="fa fa-map-marker input-icon"></i>
    <input  <?php echo esc_attr($is_required) ?> name="address" value="<?php echo STInput::request('address') ?>" class="typeahead_address form-control <?php echo esc_attr($is_required) ?>" placeholder="<?php echo isset($placeholder)? $placeholder: st_get_language('activity_or_us_zip_code')?>" type="text" />
</div>