<?php 
wp_enqueue_script( 'bootstrap-select-js' );
wp_enqueue_style( 'bootstrap-select-css' );

$default=array(
    'title'       =>'',
    'is_required' =>'off',
    'placeholder' => ''
);
if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if(empty($title)){
	$title = __('Transfer To', ST_TEXTDOMAIN);
}
if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset( $field_size ))
    $field_size = 'md';

$old_data = STInput::get('transfer_to','');

$data = TravelHelper::transferDestination();

$car_by_location = st()->get_option('car_transfer_by_location', 'off');
$class_car = 'car-by-location';
if($car_by_location == 'off'){
	$class_car = 'car-by-hotel';
}
if(!empty($data)):
	?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left form-group-transfer <?php echo esc_html($class_car); ?>">
	<label for="field-car-dropoff"><?php echo esc_html($title); ?></label>
	<select class="selectpicker transfer-selectpicker <?php echo esc_attr($is_required) ?>" name="transfer_to" data-live-search="true" data-html="true">
		<option value=""><?php echo __('---- Select Transfer ----', ST_TEXTDOMAIN); ?></option>
	<?php
    if($car_by_location == 'off') {
	    foreach ( $data as $point ):
		    $icon = '<i class="fa fa-building"></i>';
		    if ( $point['type'] == 'airport' ) {
			    $icon = '<i class="fa fa-fighter-jet"></i>';
		    }
		    $content = '
		<div class="media">
		  <div class="media-left">
		      ' . $icon . '
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading">' . $point['name'] . '</h4>
		    <p class="text-muted">' . $point['address'] . '</p>
		  </div>
		</div>
		';
		    ?>
            <option data-tokens="<?php echo esc_attr( strtolower( $point['name'] ) ); ?>"
                    data-content="<?php echo esc_attr( $content ); ?>"
                    value="<?php echo esc_attr( $point['id'] ); ?>" <?php selected( $old_data, $point['id'] ) ?>>
			    <?php echo esc_attr( $point['name'] ); ?>
            </option>
		    <?php
	    endforeach;
    }else{
	    foreach($data as $point):
		    $char = '';
		    if($point['level'] > 1){
			    for($i = 0; $i < $point['level']; $i++){
				    $char .= '-';
			    }
		    }
		    $icon = '<i class="fa fa-map-marker"></i>';
		    if($point['type'] == 'airport'){
			    $icon = '<i class="fa fa-fighter-jet"></i>';
		    }
		    $content = '
		<div class="media">
		  <div class="media-left">
		      '.$icon.'
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading">'. $char . ' ' . $point['name'].'</h4>
		  </div>
		</div>
		';
		    ?>
            <option data-tokens="<?php echo esc_attr(strtolower($point['name'])); ?>" data-content="<?php echo esc_attr($content); ?>" value="<?php echo esc_attr($point['id']); ?>" <?php selected($old_data, $point['id']) ?>>
			    <?php echo esc_attr($point['name']); ?>
            </option>
		    <?php
	    endforeach;
    }
	?>	
	</select>
</div>	
	<?php
endif;