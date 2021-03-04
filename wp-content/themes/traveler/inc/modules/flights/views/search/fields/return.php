<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );

$default=array(
    'title'=>'',
    'is_required'=>'',
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


<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange  form-group-<?php echo esc_attr($field_size)?> form-group-icon-left flight-input">
    <label for="field-flight-end"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input id="field-flight-end" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('end') ?>" name="end" type="text" />
</div>
