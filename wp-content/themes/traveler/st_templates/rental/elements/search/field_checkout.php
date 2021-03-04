<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field check out
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' ); 

$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=> ''
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
<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
    <label for="field-rental-checkout"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input id="field-rental-checkout" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('end') ?>" name="end" type="text" />
</div>