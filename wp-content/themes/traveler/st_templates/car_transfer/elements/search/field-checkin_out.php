<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field check in
 *
 * Created by ShineTheme
 *
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
$title = explode(',', $title);

if(!isset($field_size)) $field_size='lg';

if($is_required == 'on'){
    $is_required = 'required';
}
?>
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="row">
			<div class="col-xs-7">
                <label for="field-transfer-checkin"><?php echo __('Arrival Date', ST_TEXTDOMAIN); ?></label>
				<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange  form-group-icon-left">
				    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
				    <input id="field-transfer-checkin" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control checkin_transfer <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('start') ?>" name="start" type="text" />
				</div>
			</div>
			<div class="col-xs-5">
                <label for="field-transfer-checkin"><?php echo __('Time', ST_TEXTDOMAIN); ?></label>
				<div class="form-group form-group-icon-left">
				    <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
				    <input id="field-start-time" name="start-time"  class="time-pick form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::request('start-time') ?>" type="text"  />
				</div>
			</div>
		</div>
	</div>
	<?php 
		$roundtrip = STInput::get('roundtrip', '');
	?>
	<div class="col-xs-12 col-sm-6 form-group-transfer-end">
		<div class="row">
			<div class="col-xs-7">
                <label for="field-transfer-checkout"><?php echo __('Departure Date', ST_TEXTDOMAIN); ?></label>
				<div data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange form-group-icon-left">
				    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
				    <input id="field-transfer-checkout" readonly placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control checkout_hotel <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::get('end') ?>" name="end" type="text" />
				</div>
			</div>
			<div class="col-xs-5">
                <label for="field-transfer-checkout"><?php echo __('Time', ST_TEXTDOMAIN); ?></label>
				<div class="form-group form-group-icon-left">
				    <i class="fa fa-clock-o input-icon input-icon-highlight"></i>
				    <input id="field-end-time" name="end-time"  class="time-pick form-control <?php echo esc_attr($is_required) ?>" value="<?php echo STInput::request('end-time') ?>" type="text"  />
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
	
		<div class="roundtrip form-group ml20">
		    <label for="roundtrip" class="">
		    	<input <?php if($roundtrip == 'roundtrip' ) echo 'checked'; ?> type="checkbox" name="roundtrip" value="roundtrip" id="roundtrip" class="roudtrip checkbox-roundtrip i-check"> <?php echo __('Book a roundtrip', ST_TEXTDOMAIN); ?>
		    </label>
		</div>
	</div>
</div>

