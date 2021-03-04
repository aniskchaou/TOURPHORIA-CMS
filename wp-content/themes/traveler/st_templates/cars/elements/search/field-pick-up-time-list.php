<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field pick up time
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
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
?>
<div class="form-group form-group-<?php echo esc_attr($field_size) ?> form-group-icon-left">
    
    <label for="field-car-pickup-timelist"><?php echo esc_html($title)?></label>
    <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
    <select id="field-car-pickup-timelist" name="pick-up-time" class="form-control <?php echo esc_attr($is_required) ?>">
        <option <?php if(STInput::request('pick-up-time') == '12:00 AM') echo 'selected'; ?> value="12:00 AM"><?php _e("Midnight",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '12:30 AM') echo 'selected'; ?> value="12:30 AM"><?php _e("12:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '01:00 AM') echo 'selected'; ?> value="01:00 AM"><?php _e("1:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '01:30 AM') echo 'selected'; ?> value="01:30 AM"><?php _e("1:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '02:00 AM') echo 'selected'; ?> value="02:00 AM"><?php _e("2:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '02:30 AM') echo 'selected'; ?> value="02:30 AM"><?php _e("2:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '03:00 AM') echo 'selected'; ?> value="03:00 AM"><?php _e("3:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '03:30 AM') echo 'selected'; ?> value="03:30 AM"><?php _e("3:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '04:00 AM') echo 'selected'; ?> value="04:00 AM"><?php _e("4:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '04:30 AM') echo 'selected'; ?> value="04:30 AM"><?php _e("4:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '05:00 AM') echo 'selected'; ?> value="05:00 AM"><?php _e("5:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '05:30 AM') echo 'selected'; ?> value="05:30 AM"><?php _e("5:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '06:00 AM') echo 'selected'; ?> value="06:00 AM"><?php _e("6:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '06:30 AM') echo 'selected'; ?> value="06:30 AM"><?php _e("6:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '07:00 AM') echo 'selected'; ?> value="07:00 AM"><?php _e("7:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '07:30 AM') echo 'selected'; ?> value="07:30 AM"><?php _e("7:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '08:00 AM') echo 'selected'; ?> value="08:00 AM"><?php _e("8:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '08:30 AM') echo 'selected'; ?> value="08:30 AM"><?php _e("8:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '09:00 AM') echo 'selected'; ?> value="09:00 AM"><?php _e("9:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '09:30 AM') echo 'selected'; ?> value="09:30 AM"><?php _e("9:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '10:00 AM') echo 'selected'; ?> value="10:00 AM"><?php _e("10:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '10:30 AM') echo 'selected'; ?> value="10:30 AM"><?php _e("10:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '11:00 AM') echo 'selected'; ?> value="11:00 AM"><?php _e("11:00 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '11:30 AM') echo 'selected'; ?> value="11:30 AM"><?php _e("11:30 AM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '12:00 PM') echo 'selected'; ?> value="12:00 PM"><?php _e("Noon",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '12:30 PM') echo 'selected'; ?> value="12:30 PM"><?php _e("12:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '01:00 PM') echo 'selected'; ?> value="01:00 PM"><?php _e("1:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '01:30 PM') echo 'selected'; ?> value="01:30 PM"><?php _e("1:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '02:00 PM') echo 'selected'; ?> value="02:00 PM"><?php _e("2:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '02:30 PM') echo 'selected'; ?> value="02:30 PM"><?php _e("2:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '03:00 PM') echo 'selected'; ?> value="03:00 PM"><?php _e("3:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '03:30 PM') echo 'selected'; ?> value="03:30 PM"><?php _e("3:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '04:00 PM') echo 'selected'; ?> value="04:00 PM"><?php _e("4:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '04:30 PM') echo 'selected'; ?> value="04:30 PM"><?php _e("4:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '05:00 PM') echo 'selected'; ?> value="05:00 PM"><?php _e("5:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '05:30 PM') echo 'selected'; ?> value="05:30 PM"><?php _e("5:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '06:00 PM') echo 'selected'; ?> value="06:00 PM"><?php _e("6:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '06:30 PM') echo 'selected'; ?> value="06:30 PM"><?php _e("6:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '07:00 PM') echo 'selected'; ?> value="07:00 PM"><?php _e("7:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '07:30 PM') echo 'selected'; ?> value="07:30 PM"><?php _e("7:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '08:00 PM') echo 'selected'; ?> value="08:00 PM"><?php _e("8:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '08:30 PM') echo 'selected'; ?> value="08:30 PM"><?php _e("8:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '09:00 PM') echo 'selected'; ?> value="09:00 PM"><?php _e("9:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '09:30 PM') echo 'selected'; ?> value="09:30 PM"><?php _e("9:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '10:00 PM') echo 'selected'; ?> value="10:00 PM"><?php _e("10:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '10:30 PM') echo 'selected'; ?> value="10:30 PM"><?php _e("10:30 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '11:00 PM') echo 'selected'; ?> value="11:00 PM"><?php _e("11:00 PM",ST_TEXTDOMAIN) ?></option>
        <option <?php if(STInput::request('pick-up-time') == '11:30 PM') echo 'selected'; ?> value="11:30 PM"><?php _e("11:30 PM",ST_TEXTDOMAIN) ?></option>
    </select>
</div>