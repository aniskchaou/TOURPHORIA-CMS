<?php
wp_enqueue_script('custom_car_inbox');
$booking_data = $message_data['booking_data'];
$pick_up_date = '';
$pick_up_time = '';
$drop_off_time = '';
$drop_off_date = '';
$pick_up = '';
$drop_off = '';
$location_id_pick_up = '';
$location_id_drop_off = '';
$selected_equipments = '';
if(!empty($booking_data)){
    $booking_data = json_decode($booking_data, true);
	$pick_up_date = isset($booking_data['pick-up-date']) ? $booking_data['pick-up-date'] : '';
	$drop_off_date = isset($booking_data['drop-off-date']) ? $booking_data['drop-off-date'] : '';
	$pick_up_time         = isset($booking_data['pick-up-time']) ? $booking_data['pick-up-time'] : '';
	$drop_off_time        = isset($booking_data['drop-off-time']) ? $booking_data['drop-off-time'] : '';
	$pick_up              = isset($booking_data['pick-up']) ? $booking_data['pick-up'] : '';
	$location_id_drop_off = isset($booking_data['location_id_drop_off']) ? $booking_data['location_id_drop_off'] : '';
	$drop_off             = isset($booking_data['drop-off']) ? $booking_data['drop-off'] : '';
	$location_id_pick_up  = isset($booking_data['location_id_pick_up']) ? $booking_data['location_id_pick_up'] : '';
	$selected_equipments = $booking_data['selected_equipments'];
}

$st_is_booking_modal = apply_filters('st_is_booking_modal',false);
$car = new STCars();
$field_list=$car->get_search_fields_box();
$field_type=$car->get_search_fields_name();
///// get Date Time
if(isset($_GET['pick-up-date'])) {
	$pick_up_date = TravelHelper::convertDateFormat( STInput::request( 'pick-up-date' ) );
	if ( empty( $pick_up_date ) ) {
		$pick_up_date = date( 'm/d/Y', strtotime( "now" ) );
	}
	$drop_off_date = TravelHelper::convertDateFormat( STInput::request( 'drop-off-date' ) );
	if ( empty( $drop_off_date ) ) {
		$drop_off_date = date( 'm/d/Y', strtotime( "+1 day" ) );
	}
	$pick_up_time         = STInput::request( 'pick-up-time', '12:00 PM' );
	$drop_off_time        = STInput::request( 'drop-off-time', '12:00 PM' );
	$pick_up              = STInput::request( 'pick-up', '' );
	if(!empty(STInput::request( 'location_id_drop_off', '' )))
	    $location_id_drop_off = STInput::request( 'location_id_drop_off', '' );
	$drop_off             = STInput::request( 'drop-off', '' );
	if(!empty(STInput::request( 'location_id_pick_up', '' )))
	    $location_id_pick_up  = STInput::request( 'location_id_pick_up', '' );
	$selected_equipments = STInput::request('selected_equipments');
}
$arr_equip_title = array();
$selected_equipments_data = $selected_equipments;
if(!empty($selected_equipments)){
    $selected_equipments = json_decode(wp_unslash($selected_equipments), true);
    if(!empty($selected_equipments)){
        foreach ($selected_equipments as $ke => $ve){
            $arr_equip_title[$ve['title']] = array(
              'number' => $ve['number_item']
            );
            //array_push($arr_equip_title, $ve['title']);
        }
    }
}
$start = TravelHelper::convertDateFormat($pick_up_date).' '.$pick_up_time;
$start = strtotime($start);
$end = TravelHelper::convertDateFormat($drop_off_date).' '.$drop_off_time;
$end = strtotime($end);
$time=STCars::get_date_diff($start,$end);

if(!empty($location_id_pick_up)) {
	$address_pick_up = get_the_title( $location_id_pick_up );
} else {
	$address_pick_up = $pick_up;
}
if(!empty($location_id_drop_off)) {
	$address_drop_off = get_the_title( $location_id_drop_off );
}elseif(!empty($drop_off)){
	$address_drop_off = $drop_off;
}else{
	$address_drop_off=$address_pick_up;
}

$car_unit_price = st()->get_option('cars_price_unit', 'day');
$car_data_type = '';
if($car_unit_price == 'day' || $car_unit_price == 'hour'){
	$enable_equipment_by_unit = st()->get_option('equipment_by_unit', 'off');
	if($enable_equipment_by_unit == 'on'){
		$car_data_type = ' data-equip="on"';
	}
}

$booking_period = get_post_meta($post_id, 'cars_booking_period', true);
if(empty($booking_period)) $booking_period = 0;
$date= new DateTime();
if($booking_period){
	if($booking_period==1) $date->modify('+1 day');
	else $date->modify('+'.$booking_period.' days');
}

///// get Price
$info_price = STCars::get_info_price($post_id,$start,$end);
$cars_price = $info_price['price'];
$count_sale = $info_price['discount'];
$price_origin = $info_price['price_origin'];
$list_price = $info_price['list_price'];
?>
    <form  id="form-booking-inpage" method="post" class="car_booking_form"  <?php echo esc_attr($car_data_type); ?>>
	    <?php
	    $current_rate = 1;
	    $current      = TravelHelper::get_current_currency('name');
	    $default      = TravelHelper::get_default_currency('name');
	    if($current != $default) {
		    $current_rate = TravelHelper::get_current_currency('rate');
	    }
	    ?>
        <input type="hidden" name="price_rate" value="<?php echo esc_html($current_rate)?>">
		<div class="st-inbox-form-book booking-item-price-calc" data-car-id="<?php echo esc_attr($post_id); ?>">
			<div class="section">
				<div class="package-book-now-button">
					<input type="hidden" name="action" value="cars_add_to_cart">
					<input type="hidden" name="item_id" value="<?php echo esc_html($post_id); ?>">
					<div class="div_book">
						<div class="booking-meta">
                            <?php
                            $pick_up_data = '<h5>' . st_get_language( 'car_pick_up' ) . ':</h5>
                                <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i>' . $address_pick_up . '</p>
                                <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i>' . $pick_up_date . '</p>
                                <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i>' . $pick_up_time . '</p>';

                            $drop_off_data = '   <h5>' . st_get_language( 'car_drop_off' ) . ':</h5>
                                <p><i class="fa fa-map-marker box-icon-inline box-icon-gray"></i>' . $address_drop_off . '</p>
                                <p><i class="fa fa-calendar box-icon-inline box-icon-gray"></i>' . $drop_off_date . '</p>
                                <p><i class="fa fa-clock-o box-icon-inline box-icon-gray"></i>' . $drop_off_time . '</p>';

                            $logo = get_post_meta( $post_id , 'cars_logo' , true );
                            if(is_numeric($logo)){
	                            $logo = wp_get_attachment_url($logo);
                            }
                            if(!empty( $logo )) {
	                            $logo = '<img src="' . bfi_thumb( $logo , array( 'width'  => '120' ,
	                                                                             'height' => '120'
		                            ) ) . '" alt="logo" />';
                            }
                            $about = get_post_meta( $post_id , 'cars_about' , true );
                            if(!empty( $about )) {
	                            $about = ' <h5>' . st_get_language( 'car_about' ) . '</h5>
                                <p>' . get_post_meta( $post_id , 'cars_about' , true ) . '</p>';
                            }

                            echo '<div class="booking-item-deails-date-location border-main">
                                <ul>
                                    <li class="text-center">
                                        ' . $logo . '
                                    </li>
                                    <li>
                                        <p class="f-20 text-center">' . get_post_meta( $post_id , 'cars_name' , true ) . '</p>
                                    </li>                           
                                    <li>
                                        ' . $about . '
                                    </li>
                                    <li>' . $pick_up_data . '</li>
                                    <li>' . $drop_off_data . '</li>
                                </ul>
                                <a href="#search-dialog" data-effect="mfp-zoom-out" class="btn btn-primary popup-text" href="#">' . st_get_language( 'change_location_and_date' ) . '</a>
                            </div>';
                            ?>

							<label class="mb10 mt20"><?php echo __('Equipments', ST_TEXTDOMAIN); ?></label>
							<div class="car-equipment">
								<?php $list = get_post_meta($post_id,'cars_equipment_list',true);
								?>
								<?php
								if(!empty($list)){
									foreach($list as $k=>$v){
									    $check_e = '';
									    $number_check = 1;
									    if(in_array($v['title'], array_keys($arr_equip_title))) {
                                            $check_e = 'checked';
                                            $number_check = $arr_equip_title[$v['title']]['number'];
                                        }
										$v['cars_equipment_list_price'] = apply_filters('st_apply_tax_amount',$v['cars_equipment_list_price']);

										$price_unit = isset($v['price_unit'])? $v['price_unit']: '';
										$price_max = isset($v['cars_equipment_list_price_max'])? $v['cars_equipment_list_price_max']: '';

										$price_unit_html='';
										switch($price_unit)
										{
											case "per_hour":
												$price_unit_html=__('/hour',ST_TEXTDOMAIN);
												$time_per_unit =STCars::get_date_diff($start,$end, $price_unit);
												break;
											case "per_day":
												$price_unit_html=__('/day',ST_TEXTDOMAIN);
												$time_per_unit =STCars::get_date_diff($start,$end, $price_unit);
												break;
											default:
												$price_unit_html='';
												$time_per_unit = '1';
												break;
										}
										echo '<div class="equipment-list clearfix">';
										//Add price convert equipment
										echo '<div class="checkbox">
	                            <label>
                                <input '. $check_e .' class="i-check equipment" data-price-max="'.$price_max.'" data-number-unit="'. $time_per_unit .'" data-price-unit="'.$price_unit.'" data-title="'.$v['title'].'" data-price="'. $v['cars_equipment_list_price'] . '" data-convert-price="'. TravelHelper::convert_money_from_to($v['cars_equipment_list_price']) .'" type="checkbox" />'.$v['title'].'
                                <span class="pull-right">'.TravelHelper::format_money($v['cars_equipment_list_price']).''.$price_unit_html.'</span></label>
	                       </div>';
										if( !empty($v['cars_equipment_list_number']) && (int) $v['cars_equipment_list_number'] > 1){
											echo '<select class="pull-right" name="number_equipment">';
											$numbers = (int) $v['cars_equipment_list_number'];
											for($i = 1; $i <= $numbers; $i++){
											    $check_item = '';
											    if($i == $number_check)
											        $check_item = 'selected';
												echo '<option value ="'.$i.'" '. $check_item .'>'.$i.'</option>';
											}
											echo '</select>';
										}
										echo '</div>';
									}
								}
								?>
								<div class="cars_equipment_display"></div>
							</div>
						</div>
                        <div class="message_box mt10"></div>
						<?php echo STTemplate::message(); ?>
						<div class="div_btn_book_tour">
							<?php
							$car_external_booking = get_post_meta($post_id, 'st_car_external_booking', "off");
							if($st_is_booking_modal && $car_external_booking == 'off'){
								?>
                                <a href="#car_booking_<?php echo esc_attr($post_id); ?>" class="btn btn-primary btn-st-add-cart" onclick="return false" data-target=#car_booking_<?php echo esc_attr($post_id); ?>  data-effect="mfp-zoom-out" ><?php st_the_language('book_now') ?> <i class="fa fa-spinner fa-spin"></i></a>
							<?php }else{ ?>
								<?php
								$car_external_booking = get_post_meta($post_id, 'st_car_external_booking', "off");
								$car_external_booking_link = get_post_meta($post_id, 'st_car_external_booking_link', true);
								$return = '';
								if ($car_external_booking == "on" && $car_external_booking_link !== "") {
									if (get_post_meta($post_id, 'st_car_external_booking_link', true)) {
										ob_start();
										?>
                                        <a class='btn btn-primary'
                                           href='<?php echo get_post_meta($post_id, 'st_car_external_booking_link', true) ?>'> <?php st_the_language('book_now') ?></a>
										<?php
										$return = ob_get_clean();
									}
								} else {
									$return = TravelerObject::get_book_btn($post_id);
								}
								echo esc_html($return);
                                ?>
							<?php } ?>
							<?php //echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>"")) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	    <?php
	    if(!$pick_up and $location_id_pick_up) $pick_up=get_the_title($location_id_pick_up);
	    if(!$drop_off and $location_id_drop_off) $drop_off=get_the_title($location_id_drop_off);
	    $data = array(
		    'price_cars'=>$cars_price,
		    "pick_up"=>$pick_up,
		    "location_id_pick_up"=>$location_id_pick_up,
		    "drop_off"=>$drop_off,
		    "location_id_drop_off"=>$location_id_drop_off,
		    'date_time'=>array(
			    "pick_up_date"=>$pick_up_date,
			    "pick_up_time"=>$pick_up_time,
			    "drop_off_date"=>$drop_off_date,
			    "drop_off_time"=>$drop_off_time,
			    "total_time"=>$time
		    ),
	    );
	    ?>

        <input type="hidden" name="location_id_pick_up" class="" value="<?php echo esc_html($location_id_pick_up); ?>">
        <input type="hidden" name="location_id_drop_off" class="" value="<?php echo esc_html($location_id_drop_off); ?>">

        <input type="hidden" name="check_in" class="" value="<?php echo date('m/d/Y',$start) ?>">
        <input type="hidden" name="check_in_timestamp" class="" value="<?php echo esc_attr($start) ?>">
        <input type="hidden" name="check_out" class="" value="<?php echo date('m/d/Y',$end) ?>">
        <input type="hidden" name="check_out_timestamp" class="" value="<?php echo esc_attr($end) ?>">
        <input type="hidden" name="county_pick_up" class="county_pick_up" data-address="<?php echo esc_attr($pick_up) ?>" value=''>
        <input type="hidden" name="county_drop_off" class="county_drop_off" data-address="<?php echo esc_attr($drop_off) ?>" value=''>

        <input type="hidden" name="item_id" value='<?php echo esc_html($post_id); ?>'>

        <input type="hidden" name="action" value='cars_add_to_cart'>
        <input type="hidden" name="data_price_cars"  class="data_price_cars" value='<?php echo json_encode($data) ?>'>
        <?php
        //$tt = json_decode(wp_unslash($selected_equipments_data), true);
        ?>
        <input type="hidden" name="selected_equipments" value="<?php //echo json_encode($tt); ?>" class="st_selected_equipments">
	    <?php
	    if(!empty($field_list) and is_array($field_list))
	    {
		    foreach($field_list as $key=>$value){
			    if(isset($field_type[$value['field_atrribute']]))
			    {
				    $field_name=isset($field_type[$value['field_atrribute']]['field_name'])?$field_type[$value['field_atrribute']]['field_name']:false;

				    if($field_name)
				    {
					    if(is_array($field_name) and !empty($field_name))
					    {
						    foreach($field_name as $k){
							    echo "<input name='{$k}' type='hidden' value='".STInput::request($k)."'>";
						    }
					    }
				    }
				    if(is_string($field_name))
				    {
					    switch($field_name){
						    case "pick-up":
							    echo "<input name='{$field_name}' type='hidden' value='".$pick_up."'>";
							    break;
						    case "drop-off":
							    echo "<input name='{$field_name}' type='hidden' value='".$drop_off."'>";
							    break;
						    case "location_?":
							    echo "<input name='{$field_name}' type='hidden' value='".STInput::request('location_id')."'>";
							    break;
						    case "pick-up-date":
							    echo "<input name='{$field_name}' type='hidden' value='".$pick_up_date."'>";
							    break;
						    case "pick-up-time":
							    echo "<input name='{$field_name}' type='hidden' value='".$pick_up_time."'>";
							    break;
						    case "drop-off-date":
							    echo "<input name='{$field_name}' type='hidden' value='".$drop_off_date."'>";
							    break;
						    case "drop-off-time":
							    echo "<input name='{$field_name}' type='hidden' value='".$drop_off_time."'>";
							    break;
						    default:
							    echo "<input name='{$field_name}' type='hidden' value='".STInput::request($field_name)."'>";
							    break;
					    }
				    }
			    }
		    }
	    }
	    ?>
	</form>

	<div id="list_rental_item" data-type-tour="" style="display: none; width: 500px; height: auto;">
		<div id="single-tour-calendar">
			<?php echo st()->load_template('vc-elements/st-rental/st_rental_calendar', null, array('post_id' => $post_id, 'select_date' => 'group_day')); ?>
			<style>
				.qtip {
					max-width: 250px !important;
				}
			</style>
		</div>
	</div>

<?php
if($st_is_booking_modal){?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="car_booking_<?php echo esc_attr($post_id); ?>">
		<?php echo st()->load_template('cars/modal_booking');?>
    </div>
<?php }?>

<div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog" data-period="<?php echo esc_attr($date->format(TravelHelper::getDateFormat())) ?>" data-booking-period="<?php echo esc_attr($booking_period); ?>">
	<?php echo st()->load_template('cars/change-search-form');?>
</div>
