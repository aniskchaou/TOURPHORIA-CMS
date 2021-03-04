<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field pick up date time
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );  
wp_enqueue_script( 'bootstrap-timepicker.js' );

$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=> '',
);
if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}

$title_date = 'Date';
$title_time ='Time';
$title = explode(',',$title);
if(!empty($title[0])){
    $title_date = $title[0] ;
}
if(!empty($title[1])){
    $title_time = $title[1] ;
}
$size=6;
if(!empty($st_direction)){
    if($st_direction!='horizontal'){
        $size='x';
    }
}else{
    $st_direction = 'horizontal';
}
if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset( $field_size ))
    $field_size = 'md';


?>
<div class="<?php  if($st_direction=='horizontal') echo 'row';?>">
    <div class="col-md-<?php echo esc_attr($size) ?>">
        <div  class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left"  data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>">
            <label for="field-car-pickup-date"><?php echo esc_html( $title_date)?></label>
            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
            <input id="field-car-pickup-date" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" value="<?php echo STInput::request('pick-up-date') ?>"  class="form-control pick-up-date <?php echo esc_attr($is_required) ?>" name="pick-up-date" type="text" />
        </div>
    </div>
    <div class="col-md-<?php echo esc_attr($size) ?>">
        <div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
            <label for="field-car-pickup-time"><?php echo esc_html($title_time)?></label>
            <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
            <input id="field-car-pickup-time" name="pick-up-time" class="time-pick form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('pick-up-time')?>" type="text" />
        </div>
    </div>
</div>


