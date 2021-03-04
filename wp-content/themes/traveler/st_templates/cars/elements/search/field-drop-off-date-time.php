<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field drop off date time
 *
 * Created by ShineTheme
 *
 */

wp_enqueue_script( 'bootstrap-timepicker.js' );

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
$title_date = __('Date',ST_TEXTDOMAIN);
$title_time =__('Time',ST_TEXTDOMAIN);
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
<div class="<?php  if($st_direction=='horizontal') echo 'row';?>" >
    <div class="col-md-<?php echo esc_attr($size) ?>">
        <div  class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
            
            <label for="field-st-dropoff-date"><?php echo esc_html( $title_date) ?></label>
            <i class="fa fa-calendar input-icon input-icon-highlight"></i>
            <input id="field-st-dropoff-date" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" value="<?php echo STInput::request('drop-off-date') ?>"  class="form-control drop-off-date <?php echo esc_attr($is_required) ?>" name="drop-off-date" type="text" />
        </div>
    </div>
    <div class="col-md-<?php echo esc_attr($size) ?>">
        <div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
            
            <label for="field-st-dropoff-time"><?php echo  esc_html($title_time)?></label>
            <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
            <input id="field-st-dropoff-time" name="drop-off-time"  class="time-pick form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('drop-off-time')?>" type="text" />
        </div>
    </div>
</div>