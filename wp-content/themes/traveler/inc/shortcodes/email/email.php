<?php
/**
*@since 1.1.9
**/
/*   Shortcode for customer infomation */
if(!function_exists( 'st_email_booking_booker_name' )) {
    function st_email_booking_booker_name(){
        global $order_id;
        if($order_id){
            $booker_id = intval(get_post_meta($order_id,'id_user',true));
            $user_info = get_userdata($booker_id);
            if($user_info){
                return $user_info->first_name. ' '.$user_info->last_name;
            }else{
                return __('Admin', ST_TEXTDOMAIN);
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_booker_name' , 'st_email_booking_booker_name' );

if(!function_exists( 'st_email_booking_first_name' )) {
    function st_email_booking_first_name(){
        global $order_id;
        if($order_id){
            $first_name = get_post_meta($order_id,'st_first_name',true);
            return $first_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_first_name' , 'st_email_booking_first_name' );

if(!function_exists( 'st_email_booking_last_name' )) {
    function st_email_booking_last_name(){
        global $order_id;
        if($order_id){
            $last_name = get_post_meta($order_id,'st_last_name',true);

            return $last_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_last_name' , 'st_email_booking_last_name' );

if(!function_exists( 'st_email_booking_email' )) {
    function st_email_booking_email(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_email',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_email' , 'st_email_booking_email' );

if(!function_exists( 'st_email_booking_phone' )) {
    function st_email_booking_phone(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_phone',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_phone' , 'st_email_booking_phone' );

if(!function_exists( 'st_email_booking_address' )) {
    function st_email_booking_address(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_address',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_address' , 'st_email_booking_address' );

if(!function_exists( 'st_email_booking_city' )) {
    function st_email_booking_city(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_city',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_city' , 'st_email_booking_city' );

if(!function_exists( 'st_email_booking_province' )) {
    function st_email_booking_province(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_province',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_province' , 'st_email_booking_province' );

if(!function_exists( 'st_email_booking_zip_code' )) {
    function st_email_booking_zip_code(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_zip_code',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_zip_code' , 'st_email_booking_zip_code' );

if(!function_exists( 'st_email_booking_apt_unit' )) {
	function st_email_booking_apt_unit(){
		global $order_id;
		if($order_id){
			return get_post_meta($order_id,'st_apt_unit',true);
		}
		return '';
	}
}
st_reg_shortcode( 'st_email_booking_apt_unit' , 'st_email_booking_apt_unit' );

//Custom field with form builder
if(!function_exists( 'st_email_booking_custom_field' )) {
	function st_email_booking_custom_field($attr = [], $content = null){
		global $order_id;
		if($order_id){
			if(!empty($attr)){
				if(isset($attr['field_name'])){
					$form_data = get_post_meta($order_id, 'wb_form_for_order', true);
					$field_value = get_post_meta($order_id, $attr['field_name'], true);
					if(isset($form_data[$attr['field_name']])){
						$type_custom_field = $form_data[$attr['field_name']]['type'];
						switch ($type_custom_field){
							case 'text':
							case 'email':
							case 'number':
							case 'textarea':
								return $field_value;
								break;
							case 'radio':
							case 'dropdown':
								if(isset($form_data[$attr['field_name']]['option_value'])){
									$radio_options = $form_data[$attr['field_name']]['option_value'];
									if(!empty($radio_options)){
										if(isset($radio_options[$field_value])){
											return $radio_options[$field_value];
										}
									}
								}
								break;
							case 'checkbox':
								if($field_value == 1){
									return __('Yes', ST_TEXTDOMAIN);
								}else{
									return __('No', ST_TEXTDOMAIN);
								}
								break;
							case 'country_dropdown':
								if(!empty($field_value)){
									$list_country = wb_list_country();
									return esc_html($list_country[$field_value]);
								}
								break;
							case 'post_select':
								if(!empty($field_value)){
									return get_the_title($field_value);
								}
								break;
							case 'image_upload':
								if(!empty($field_value)){
									$size_image = 'thumbnail';
									$size_image = apply_filters('st_form_builder_custommer_image_size', $size_image);
									$type = get_post_mime_type($field_value);
									$text_info = '';
									switch ($type) {
										case 'application/zip':
										case 'application/javascript':
											$text_info .= '<i class="fa fa-download" aria-hidden="true"></i> <a download href="'. wp_get_attachment_url($field_value) .'">'. __('Download file', ST_TEXTDOMAIN) .'</a> ';
											break;
										default:
											break;
									}
									return $text_info . wp_get_attachment_image($field_value, $size_image, true);
								}
								break;
							default:
								return $field_value;
								break;
						}
					}
				}
			}
		}
		return '';
	}
}
st_reg_shortcode( 'st_email_booking_custom_field' , 'st_email_booking_custom_field' );

if(!function_exists( 'st_email_booking_country' )) {
    function st_email_booking_country(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id,'st_country',true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_country' , 'st_email_booking_country' );

if(!function_exists('st_email_booking_field')){
    function st_email_booking_field($atts, $content = false){
        global $order_id;
        $atts = shortcode_atts( array(
                'id' => ''
            ), $atts, 'st_email_booking_field' );
        extract($atts);
        if(!empty($id)){
            if(!empty($order_id)){
                $field_meta = get_post_meta($order_id, $id, true);
                if(!empty($field_meta)){
                    $form_builder = get_post_meta( $order_id, 'wb_form_for_order', true );
                    if(!empty($form_builder)){
                        if(!empty($form_builder[$id]['type'])){
                            switch($form_builder[$id]['type']){
                                case 'country_dropdown':
                                    $list_country = wb_list_country();
                                
                                    return esc_html($list_country[$field_meta]);
                                    break;
                                case 'post_select':
                                    return get_the_title($field_meta);
                                    break;
                                case 'taxonomy_select':
                                    $term = get_term_by('id', $field_meta, $value['taxonomy']);
                                    if(!empty($term->name)){
                                        return esc_html($term->name);
                                    }
                                    break;
                                case 'image_upload':
                                    $size_image = 'thumbnail';
                                    $size_image = apply_filters('st_form_builder_custommer_image_size', $size_image);
                                    return wp_get_attachment_image($field_meta, $size_image, true);
                                    break;
                                case 'radio':
                                case 'dropdown':
                                    return $value['option_value'][$field_meta];
                                    break;
                                case 'checkbox':
                                    if(!empty($field_meta)){
                                        return $value['title'];
                                    }
                                    break;
                                default:
                                    return $field_meta;
                                    break;
                            }
                        }
                
                    }else{
                        return $field_meta;
                    }
                }
            }
        }
        return '';
    }
}

st_reg_shortcode('st_email_booking_field','st_email_booking_field');

/*  .End Shortcode for customer infomation */
if(!function_exists( 'st_email_booking_thumbnail' )) {
    function st_email_booking_thumbnail(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id, 'item_id', true);
            if($item_id == 'car_transfer'){
                $item_id = get_post_meta($order_id, 'car_id', true);
            }
            $image = wp_get_attachment_url(get_post_thumbnail_id($item_id));
            if($image){
                return '<a href="'.get_the_permalink($item_id).'" target="_blank"><img alt="thumbnail" src="'.$image.'" data style="display: block; height: auto; width: 100%; max-width: 100%;"></a>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_thumbnail' , 'st_email_booking_thumbnail' );

if(!function_exists( 'st_email_booking_id' )) {
    function st_email_booking_id(){
        global $order_id;
        if($order_id){
            return $order_id;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_id' , 'st_email_booking_id' );

if(!function_exists( 'st_email_booking_date' )) {
    function st_email_booking_date(){
        global $order_id;
        if($order_id){
            return get_the_time(TravelHelper::getDateFormat(),$order_id);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_date' , 'st_email_booking_date' );

if(!function_exists( 'st_email_booking_note' )) {
    function st_email_booking_note(){
        global $order_id;
        if($order_id){
            return get_post_meta($order_id, 'st_note', true);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_note' , 'st_email_booking_note' );

//if(!function_exists( 'st_email_booking_payment_method' )) {
//    function st_email_booking_payment_method(){
//        global $order_id;
//        if($order_id){
//            return STPaymentGateways::get_gatewayname(get_post_meta($order_id,'payment_method',true));
//        }
//        return '';
//    }
//}
//st_reg_shortcode( 'st_email_booking_payment_method' , 'st_email_booking_payment_method' );

if(!function_exists( 'st_email_booking_item_name' )) {
    function st_email_booking_item_name(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            return get_the_title($item_id);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_name' , 'st_email_booking_item_name' );

if(!function_exists( 'st_email_booking_item_link' )) {
    function st_email_booking_item_link(){
        global $order_id;
        $return_data = '';
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
	        if($item_id == 'car_transfer'){
		        $item_id = get_post_meta($order_id, 'car_id', true);
		        $transfer_from = get_post_meta( $order_id, 'pick_up',true );
		        $transfer_to = get_post_meta( $order_id, 'drop_off',true );
		        $return_data = '<a style="text-decoration: unset; color: #666;" href="'.get_the_permalink($item_id).'" title="">'.get_the_title($item_id).'</a><br/>
                    <span style="font-size: 13px">'. $transfer_from .' <strong>-></strong> '.$transfer_to.'</span>
                ';
	        }else{
		        $post_type = get_post_type($item_id);
		        switch ($post_type){
			        case 'st_flight':
				        $flight_type = get_post_meta($order_id, 'flight_type', true);
				        $depart_data_location = get_post_meta($order_id, 'depart_data_location', true);
				        $depart_data_time     = get_post_meta( $order_id, 'depart_data_time', true );
				        if(!empty($depart_data_location)){
					        $return_data = __('Booking flight: ', ST_TEXTDOMAIN) . $depart_data_location['origin_location_full'].' ('.$depart_data_location['origin_iata'].') - '.$depart_data_location['destination_location_full'].' ('.$depart_data_location['destination_iata'].') ' . __('at ', ST_TEXTDOMAIN) . $depart_data_time['depart_time'] . ' ' . $depart_data_time['depart_date'];
				        }
				        if($flight_type == 'return'){
					        $return_data .= esc_html__(' (Return)', ST_TEXTDOMAIN);
				        }
				        break;
			        default:
				        $return_data = '<a style="text-decoration: unset; color: #666;" href="'.get_the_permalink($item_id).'" title="">'.get_the_title($item_id).'</a>';
				        break;
		        }
	        }
        }
        return $return_data;
    }
}
st_reg_shortcode( 'st_email_booking_item_link' , 'st_email_booking_item_link' );

if(!function_exists('st_email_booking_car_transfer_info')){
	function st_email_booking_car_transfer_info(){
		global $order_id;
		$return_data = '';
		if($order_id) {
			$item_id     = get_post_meta( $order_id, 'item_id', true );
			if ( $item_id == 'car_transfer' ) {
				$roundtrip = get_post_meta($order_id, 'roundtrip', true);
				$passenger = get_post_meta($order_id, 'passenger', true);
				$time = get_post_meta($order_id, 'distance', true);
				$check_in = get_post_meta($order_id, 'check_in', true);
				$check_out = get_post_meta($order_id, 'check_out', true);
				$check_in_time = get_post_meta($order_id, 'check_in_time', true);
				$check_out_time = get_post_meta($order_id, 'check_out_time', true);
                $extras = get_post_meta($order_id, 'extras', true);
                $currency = get_post_meta($order_id, 'currency', true);

				$return_data .= '<table>';

				$return_data .= '<tr>';
				$return_data .= '<td>';
				$return_data .= __('Passengers', ST_TEXTDOMAIN) . ': ';
				$return_data .= '</td>';
				$return_data .= '<td>';
				$return_data .= $passenger;
				$return_data .= '</td>';
				$return_data .= '</tr>';

				if(!empty($time)) {
					$return_data .= '<tr>';
					$return_data .= '<td>';
					$return_data .= __( 'Estimated Time', ST_TEXTDOMAIN ) . ': ';
					$return_data .= '</td>';
					$return_data .= '<td>';
					$hour = ( $time[ 'hour' ] >= 2 ) ? $time[ 'hour' ] . ' ' . esc_html__( 'hours', ST_TEXTDOMAIN ) : $time[ 'hour' ] . ' ' . esc_html__( 'hour', ST_TEXTDOMAIN );
					$minute = ( $time[ 'minute' ] >= 2 ) ? $time[ 'minute' ] . ' ' . esc_html__( 'minutes', ST_TEXTDOMAIN ) : $time[ 'minute' ] . ' ' . esc_html__( 'minute', ST_TEXTDOMAIN );
					$return_data .= esc_attr( $hour ) . ' ' . esc_attr( $minute ) . ' - ' . $time['distance'] . __('Km', ST_TEXTDOMAIN);
					$return_data .= '</td>';
					$return_data .= '</tr>';
				}

				$return_data .= '<tr>';
				$return_data .= '<td>';
				$return_data .= __('Arrival Date', ST_TEXTDOMAIN) . ': ';
				$return_data .= '</td>';
				$return_data .= '<td>';
				$return_data .= date(TravelHelper::getDateFormat(), strtotime($check_in)) . date(' H:i:s', strtotime($check_in_time));
				$return_data .= '</td>';
				$return_data .= '</tr>';

				if(!empty($roundtrip)){
					$return_data .= '<tr>';
					$return_data .= '<td>';
					$return_data .= __('Departure Date', ST_TEXTDOMAIN) . ': ';
					$return_data .= '</td>';
					$return_data .= '<td>';
					$return_data .= date(TravelHelper::getDateFormat(), strtotime($check_out)) . date(' H:i:s', strtotime($check_out_time));
					$return_data .= '</td>';
					$return_data .= '</tr>';
				}

				if(!empty($extras) and is_array($extras)){
                    $return_data .= '<tr>';
                    $return_data .= '<td>';
                    $return_data .= __('Extra Services', ST_TEXTDOMAIN) . ': ';
                    $return_data .= '</td>';
                    $return_data .= '<td>';
                    foreach ($extras as $ek => $ev){
                        $return_data .= $ev['title'] . ' ('. TravelHelper::format_money_from_db($ev['price'], $currency) .') x ' . $ev['number'] . '<br />';
                    }
                    $return_data .= '</td>';
                    $return_data .= '</tr>';
                }

				$return_data .= '</table>';
			}
		}
		return $return_data;
	}
}
st_reg_shortcode( 'st_email_booking_car_transfer_info' , 'st_email_booking_car_transfer_info' );


if(!function_exists( 'st_email_booking_number_item' )) {
    function st_email_booking_number_item($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Number of Item:', ST_TEXTDOMAIN),
            ), $atts);
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $number = intval(get_post_meta($order_id, 'item_number', true));
            if($post_type == 'st_hotel' or $post_type == 'hotel_room'){
                $html = '<div style="text-align: center; padding: 10px 0px; font-weight: bold; border-left: solid 1px #666; border-right: solid 1px #666; border-bottom: solid 1px #666;">
                        <span style="text-align: left; width: 48%; display: inline-block; padding-left: 10px;">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 50%; display: inline-block;">
                             '.$number.' item(s)
                        </span>
                        </div>
                ';
                return $html;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_number_item' , 'st_email_booking_number_item' );
if(!function_exists('st_email_booking_posttype')){
    function st_email_booking_posttype(){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $name = '';
            switch ($post_type) {
                case 'st_hotel':
                    $name = __('Hotel', ST_TEXTDOMAIN);
                    break;
                case 'st_rental':
                    $name = __('Rental', ST_TEXTDOMAIN);
                    break;
                case 'st_cars':
                    $name = __('Car', ST_TEXTDOMAIN);
                    break;
                case 'st_tours':
                    $name = __('Tour', ST_TEXTDOMAIN);
                    break;
                case 'st_activity':
                    $name = __('Activity', ST_TEXTDOMAIN);
                    break;
                default:
                    $name = '';
                    break;
            }
            return $name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_posttype' , 'st_email_booking_posttype' );
if(!function_exists( 'st_email_booking_check_in' )) {
    function st_email_booking_check_in(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta( $order_id, 'item_id', true );
            if($item_id == 'car_transfer'){
                return date(TravelHelper::getDateFormat() . ' H:i:s', get_post_meta($order_id,'check_in_timestamp',true));
            }else{
                return date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
            }
            
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_in' , 'st_email_booking_check_in' );

if(!function_exists( 'st_email_booking_check_out' )) {
    function st_email_booking_check_out(){
        global $order_id;
        if($order_id){

            $item_id = get_post_meta( $order_id, 'item_id', true );
            if($item_id == 'car_transfer'){
                return date(TravelHelper::getDateFormat() . ' H:i:s', get_post_meta($order_id,'check_out_timestamp',true));
            }else{
                return date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_out' , 'st_email_booking_check_out' );

if(!function_exists( 'st_email_booking_check_in_out_time' )) {
    function st_email_booking_check_in_out_time($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Time', ST_TEXTDOMAIN),
            ), $atts);
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            $check_in_time = get_post_meta($order_id, 'check_in_timestamp', true);
            $check_out_time = get_post_meta($order_id, 'check_out_timestamp', true);
            $number = intval(get_post_meta($order_id, 'item_number'));
            if($post_type && $post_type == 'st_cars' && $check_in_time && $check_out_time){
                $html = '
                <table width="100%">
                    <tr>
                        <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><strong>'.date('H:i:s A',$check_in_time).' - '.date('H:i:s A',$check_out_time).'</strong></td>
                    </tr>
                </table>
                ';
                return $html;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_check_in_out_time' , 'st_email_booking_check_in_out_time' );

/**
 * @since 2.0.0
 * - Add shortcode display starttime in tour booking email
 */
if (!function_exists('st_email_booking_start_time')) {
    function st_email_booking_start_time()
    {
        global $order_id;
        if ($order_id) {
            $starttime_value = get_post_meta($order_id, 'starttime', true);
            if ($starttime_value != '') {
                return get_post_meta($order_id, 'starttime', true);
            } else {
                return '_';
            }
        }
        return '';
    }
}
st_reg_shortcode('st_email_booking_start_time', 'st_email_booking_start_time');
//End Add shortcode display starttime in tour booking email

// pickup 
// drop off
// driver
if (!function_exists('st_email_pick_up_from')){
    function st_email_pick_up_from($atts=array()){
        global $order_id;
        if (!$order_id) return "";
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $pick_up = get_post_meta($order_id , 'pick_up' , true);
            return __('From', ST_TEXTDOMAIN).' '.$pick_up;
        }
    }
}
st_reg_shortcode ( 'st_email_pick_up_from', 'st_email_pick_up_from');

if (!function_exists('st_email_drop_off_to')){
    function st_email_drop_off_to($atts=array()){
        global $order_id;
        if (!$order_id) return "";
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $drop_off = get_post_meta($order_id , 'drop_off' , true);
            return ' - '.__('To', ST_TEXTDOMAIN).' '.$drop_off;
        }
    }
}
st_reg_shortcode ( 'st_email_drop_off_to', 'st_email_drop_off_to');

if (!function_exists('st_email_car_driver')){
    function st_email_car_driver($atts=array()){
        global $order_id;
        if (!$order_id) return "";
        $post_type = get_post_meta($order_id , 'st_booking_post_type' ,true);
        if ($post_type =='st_cars'){
            $driver_name = get_post_meta($order_id , 'driver_name' , true );
            $driver_age = get_post_meta($order_id , 'driver_age' , true );
            $return =  __("Driver name" , ST_TEXTDOMAIN).": ".$driver_name."<br/>";
            $return .=  __("Driver age" , ST_TEXTDOMAIN).": ".$driver_age;
            return $return ;
        }
    }
}
st_reg_shortcode ( 'st_email_car_driver', 'st_email_car_driver');


if (!function_exists('st_check_in_out_title')) {
    function st_check_in_out_title($atts = array()){
        global $order_id;
        if (!$order_id) return "";
        $post_id = trim(get_post_meta($order_id, 'item_id', true));
        $tour_price_type = get_post_meta($order_id, 'price_type', true);
        $post_type = get_post_type($post_id );
        if ($post_type == 'st_hotel' or $post_type == 'st_rental') return __("Check in - out: " , ST_TEXTDOMAIN);
        if ($post_type == 'st_cars') return __("Pick-up from - Drop-off to: " , ST_TEXTDOMAIN) ;
        if ($post_type == 'st_tours') {
            if($tour_price_type == 'fixed_depart'){
                return __('Fixed Departure', ST_TEXTDOMAIN);
            }else{
	            $tour_type = get_post_meta($order_id , 'type_tour',  true);
	            if (!empty($tour_type) and $tour_type == 'daily_tour') {
		            return __("Departure date: " , ST_TEXTDOMAIN);
	            }
	            return __("Departure date - Return date: " , ST_TEXTDOMAIN);
            }
        }
        if($post_type == 'st_activity'){
            $activity_type = get_post_meta($order_id , 'type_activity',  true);
            if (!empty($activity_type) and $activity_type == 'daily_activity') {
                return __("From: " , ST_TEXTDOMAIN);
            }
            return __("From - To: " , ST_TEXTDOMAIN);
        }
    }
}
st_reg_shortcode( 'st_check_in_out_title' , 'st_check_in_out_title' );
if (!function_exists('st_check_in_out_value')) {
    function st_check_in_out_value(){
        global $order_id;
        if (!$order_id) return "";
        $post_id = trim(get_post_meta($order_id, 'item_id', true));
        $post_type = get_post_type($post_id );
        $return = "";
        if($order_id){
            if($post_type == 'st_tours'){
                $tour_price_type = get_post_meta($order_id, 'price_type', true);

                if($tour_price_type == 'fixed_depart'){
                    $return .= __('Start date', ST_TEXTDOMAIN) . ': ';
	                $return .= TourHelper::getDayFromNumber(date('N', strtotime(get_post_meta($order_id,'check_in',true)))) . ' ' . date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true))) . '<br />';
	                $return .= __('End date', ST_TEXTDOMAIN) . ': ';
	                $return .= TourHelper::getDayFromNumber(date('N', strtotime(get_post_meta($order_id,'check_out',true)))) . ' ' . date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
                }else{
	                //$duration_unit = get_post_meta($order_id, 'duration_unit', true);
	                //if(empty($duration_unit)) $duration_unit = 'day';
	                $tour_type = get_post_meta($order_id, 'type_tour', true);
	                if($tour_type == 'daily_tour'){
		                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
		                $return.="<br/>";
		                $duration = get_post_meta($order_id , 'duration' , true);
		                //$duration = $duration;
		                //$nums = array(1,2,3,4,5,6,7,8,9,0);
		                //$duration_unit =  str_replace($nums, '', $duration_unit);
		                $return.=__("Duration: " , ST_TEXTDOMAIN) .$duration;
	                }else{

		                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
		                $return.= " - ";
		                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
	                }
                }
            }
            if($post_type == 'st_activity'){
                $activity_type = get_post_meta($order_id, 'type_activity', true);
                //$duration_unit = get_post_meta($order_id, 'duration_unit', true);
                if($activity_type == 'daily_activity'){
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
                    $return.="<br/>";
                    $duration = get_post_meta($order_id , 'duration' , true);
                    $return.=__("Duration: " , ST_TEXTDOMAIN) .$duration;
                }else{
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)));
                    $return.= " - ";
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)));
                }
            }
            if ($post_type =='st_hotel' or $post_type =='hotel_room' or $post_type =='hotel_room' or $post_type =='st_rental'){
                $day = '';
                $check_in = get_post_meta($order_id,'check_in',true);
                $check_out = get_post_meta($order_id,'check_out',true);

                $diff = STDate::dateDiff($check_in, $check_out);

                $day .= ($diff >= 2)? ' ('.$diff.' '.__("days", ST_TEXTDOMAIN).')' : '('.$diff.' '.__("day", ST_TEXTDOMAIN).')';

                return date(TravelHelper::getDateFormat(), strtotime( $check_in ) ) . ' - '. date(TravelHelper::getDateFormat(), strtotime( $check_out ) ). $day;
                
            }
            if( $post_type == 'st_cars'){
                $unit = st()->get_option('cars_price_unit');

                $start = explode(" ", get_post_meta($order_id,'check_in',true));

                $start = $start[0];
                $start = strtotime($start.' '.get_post_meta($order_id,'check_in_time',true));


                $end = explode(" ", get_post_meta($order_id,'check_out',true));
                $end = $end[0];

                $end = strtotime($end.' '.get_post_meta($order_id,'check_out_time',true));
                $time=STCars::get_date_diff($start,$end);

                $label = '';
                if($unit == 'hour'){
                    if($time > 1){
                        $label = __('hours', ST_TEXTDOMAIN);
                    }else{
                        $label = __('hour', ST_TEXTDOMAIN);
                    }
                }elseif($unit == 'day'){
                    if($time > 1){
                        $label = __('days', ST_TEXTDOMAIN);
                    }else{
                        $label = __('day', ST_TEXTDOMAIN);
                    }
                }elseif($unit == 'distance' and  $post_type =='st_cars'){
                    $time = get_post_meta($order_id,'distance',true);
                    if($time > 1){
                        $label =  STCars::get_price_unit_by_unit_id($unit,'plural');
                    }else{
                        $label =  STCars::get_price_unit_by_unit_id($unit,'label');
                    }

                }

                $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_in',true)))." ".get_post_meta($order_id,'check_in_time',true);
                $return.= " - ";


                if($unit == 'distance' and  $post_type =='st_cars'){
                    $pick_up = get_post_meta($order_id,'pick_up',true);
                    $drop_off = get_post_meta($order_id,'drop_off',true);
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)))." ".get_post_meta($order_id,'check_out_time',true).'';
                    $return.= "<br> ".$pick_up." - ".$drop_off." ( {$time} {$label} )";
                }else{
                    $return.= date(TravelHelper::getDateFormat(), strtotime(get_post_meta($order_id,'check_out',true)))." ".get_post_meta($order_id,'check_out_time',true);
                    if(!empty($time) and !empty($label)){
                        $return .= ' ('.$time.' '.$label.')';
                    }
                }
            }
        }
        return $return ;

    }
}
st_reg_shortcode('st_check_in_out_value', 'st_check_in_out_value');
if(!function_exists( 'st_email_booking_item_price' )) {
    function st_email_booking_item_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Item Price:', ST_TEXTDOMAIN),
            ), $atts);

            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );

            if($post_type && ($post_type != 'st_tours' && $post_type != 'st_activity')){
                $currency = get_post_meta($order_id, 'currency', true);
                //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $item_price = floatval(get_post_meta($order_id,'item_price',true));
                $html = '
                        <span style="text-align: left; width: 48%; display: inline-block; padding-left: 10px;">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 50%; display: inline-block;">
                             '.TravelHelper::format_money_from_db($item_price, $currency).'
                        </span>
                ';
                return $html;
            }else{
                return '';
            }

        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_price' , 'st_email_booking_item_price' );

if(!function_exists( 'st_email_booking_origin_price' )) {
    function st_email_booking_origin_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $origin_price = isset($data_price['origin_price']) ? floatval($data_price['origin_price']) : 0;

            $origin = TravelHelper::format_money_from_db($origin_price, $currency);

            $post_type = get_post_meta($order_id, 'item_post_type', true);

            if($post_type == 'st_flight'){
                $depart_price = get_post_meta($order_id, 'depart_price', true);
                $flight_type = get_post_meta($order_id, 'flight_type', true);
                if($flight_type == 'return'){
                    $return_price = get_post_meta($order_id, 'return_price', true);
                    $origin = esc_html__('Depart Price: ', ST_TEXTDOMAIN).TravelHelper::format_money_from_db($depart_price, $currency);
                    $origin .= '<br>'.esc_html__('Return Price: ', ST_TEXTDOMAIN).TravelHelper::format_money_from_db($return_price, $currency);
                }else{
                    $origin = TravelHelper::format_money_from_db($depart_price, $currency);
                }
            }
            return $origin;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_origin_price' , 'st_email_booking_origin_price' );

if(!function_exists( 'st_email_booking_sale_price' )) {
    function st_email_booking_sale_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $sale_price = isset($data_price['sale_price']) ? floatval($data_price['sale_price']) : 0;
            $sale = TravelHelper::format_money_from_db($sale_price, $currency);

            $post_type = get_post_meta($order_id, 'item_post_type', true);
            if($post_type == 'st_flight'){
                $sale = esc_html__('No sale', ST_TEXTDOMAIN);
            }

            return $sale;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_sale_price' , 'st_email_booking_sale_price' );

if(!function_exists( 'st_email_booking_tax' )) {
    function st_email_booking_tax(){
        global $order_id;
        if($order_id){
            $tax = intval(get_post_meta($order_id, 'st_tax_percent', true));
            $tax_percent = $tax.' %';

            $post_type = get_post_meta($order_id, 'item_post_type', true);
            if($post_type == 'st_flight'){
                $tax_percent_depart = get_post_meta($order_id, 'tax_percent_depart', true);
                $flight_type = get_post_meta($order_id, 'flight_type', true);
                if($flight_type == 'return'){
                    $tax_percent_return = get_post_meta($order_id, 'tax_percent_return', true);
                    $tax_percent = esc_html__('Tax Depart: ', ST_TEXTDOMAIN).$tax_percent_depart.' %';
                    $tax_percent .= '<br>'.esc_html__('Tax Return: ', ST_TEXTDOMAIN).$tax_percent_return.' %';
                }else{
                    $tax_percent = $tax_percent_depart. ' %';
                }
            }

            return $tax_percent;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_tax' , 'st_email_booking_tax' );

if(!function_exists( 'st_email_booking_price_with_tax' )) {
    function st_email_booking_price_with_tax(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;

            $price_with_tax = TravelHelper::format_money_from_db($price_with_tax, $currency);

            $post_type = get_post_meta($order_id, 'item_post_type', true);

            if($post_type == 'st_flight'){
                $depart_price = get_post_meta($order_id, 'total_price_depart', true);
                $flight_type = get_post_meta($order_id, 'flight_type', true);
                if($flight_type == 'return'){
                    $return_price = get_post_meta($order_id, 'total_price_return', true);
                    $price_with_tax = esc_html__('Depart Total: ', ST_TEXTDOMAIN).TravelHelper::format_money_from_db($depart_price, $currency);
                    $price_with_tax .= '<br>'.esc_html__('Return Total: ', ST_TEXTDOMAIN).TravelHelper::format_money_from_db($return_price, $currency);
                }else{
                    $price_with_tax = TravelHelper::format_money_from_db($depart_price, $currency);
                }
            }

            return $price_with_tax;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_price_with_tax' , 'st_email_booking_price_with_tax' );

if(!function_exists( 'st_email_booking_deposit_price' )) {
    function st_email_booking_deposit_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Deposit Price', ST_TEXTDOMAIN),
            ), $atts);

            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
            $deposit_status = get_post_meta($order_id, 'deposit_money', true);
            if(is_array($deposit_status) && !empty($deposit_status['type'])){
                $html = '
                        <span style="text-align: left; width: 48%; display: inline-block; padding-left: 10px;">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 48%; display: inline-block;">
                             '.TravelHelper::format_money_from_db($deposit_price, $currency).'
                        </span>
                ';
                return $html;
            }
            else {
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_deposit_price' , 'st_email_booking_deposit_price' );

if(!function_exists( 'st_email_booking_total_price' )) {
    function st_email_booking_total_price(){
        global $order_id;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0 ;
            return TravelHelper::format_money_from_db($total_price, $currency);
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_total_price' , 'st_email_booking_total_price' );

if(!function_exists( 'st_email_booking_fee_price' )) {
    function st_email_booking_fee_price(){
        global $order_id;
        $total_price = 0;
        if($order_id){
            $currency = get_post_meta($order_id, 'currency', true);
            $booking_fee_price = get_post_meta($order_id, 'booking_fee_price', true);
            if(!empty($booking_fee_price)){
                $total_price =  TravelHelper::format_money_from_db($booking_fee_price, $currency);
            }
        }
        return $total_price;
    }
}
st_reg_shortcode( 'st_email_booking_fee_price' , 'st_email_booking_fee_price' );

if(!function_exists('st_email_booking_pay_later')){
    function st_email_booking_pay_later($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Pay Later', ST_TEXTDOMAIN),
            ), $atts);
            $currency = get_post_meta($order_id, 'currency', true);
            $rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $data_price = get_post_meta($order_id, 'data_prices', true);
            if(!$data_price) $data_price = array();
            $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;

            $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0 ;

            if( $price_with_tax > $total_price ){
                $html = '
                        <span style="text-align: left; width: 48%; display: inline-block; padding-left: 10px;">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 48%; display: inline-block;">
                             '.TravelHelper::format_money_from_db($price_with_tax - $total_price, $currency, $rate).'
                        </span>
                ';
                return $html;
            }

            return '';

        }
    }
}
st_reg_shortcode( 'st_email_booking_pay_later' , 'st_email_booking_pay_later' );

/* Hotel */
if(!function_exists( 'st_email_booking_room_name' )) {
    function st_email_booking_room_name($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Room Name', ST_TEXTDOMAIN),
            ),$atts);
            $room_id = get_post_meta($order_id,'room_id',true);
            if($room_id){
                if(!empty($data['tag'])){
                    return "<div style='text-align: center; padding: 10px 0px; font-weight: bold; border-left: solid 1px #666; border-right: solid 1px #666; border-bottom: solid 1px #666;'><{$data['tag']} style='display: {$data['display']}'>".$data['title']."</{$data['tag']}>".' '.get_the_title($room_id).'</div>';
                }else{
                    //return $data['title'].'<a href="'.get_the_permalink($room_id).'" target="_bank">'.get_the_title($room_id).'</a>';
                    return '<div style="text-align: center; padding: 10px 0px; font-weight: bold; border-left: solid 1px #666; border-right: solid 1px #666; border-bottom: solid 1px #666;">
                        <span style="text-align: left; width: 48%; display: inline-block; padding-left: 0px;">
                        '.$data['title'].'
                        </span>
                        <span style="text-align: right; width: 50%; display: inline-block;color:#cc3333">
                        <a style="text-decoration: none ;color:#cc3333" href="'.get_the_permalink($room_id).'" target="_bank">'.get_the_title($room_id).'</a>
                        </span>
                        </div>
                        ';
                }
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_room_name' , 'st_email_booking_room_name' );

if(!function_exists( 'st_email_booking_extra_items' )) {
    function st_email_booking_extra_items($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Extra Items', ST_TEXTDOMAIN),
            ),$atts);
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $extras = get_post_meta($order_id, 'extras', true);
            $html = '';
            $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && $extra_price > 0):
                $html = '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}'>".$data['title']."</{$data['tag']}>";
                }else{
                    $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">'.$data['title']."</span></td></tr>";
                }
                    foreach($extras['value'] as $name => $number):
                        $price_item = floatval($extras['price'][$name]);
                        if($price_item <= 0) $price_item = 0;
                        $number_item = intval($extras['value'][$name]);
                        if($number_item <= 0) $number_item = 0;
                        if($number_item > 0){
                            $html .= '<tr>
                                         <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                              <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;"> - '.$extras['title'][$name].'</span>
                                              <span style="text-align: right; display: inline-block; width: 35%;"><span style="font-weight:300">'.$number_item.' '.__('item(s)', ST_TEXTDOMAIN).'</span> x '.TravelHelper::format_money_from_db($price_item, $currency).'</span>
                                         </td>
                                      </tr>';
                        }
                endforeach;
                $html .= '</table>';
            endif;
            return $html;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_extra_items' , 'st_email_booking_extra_items' );

//Tour package services
if(!function_exists( 'st_email_booking_package' )) {
    function st_email_booking_package($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Package service', ST_TEXTDOMAIN),
            ),$atts);
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $hotel_packages = get_post_meta( $order_id, 'package_hotel', true );
            $hotel_package_price = get_post_meta( $order_id, 'package_hotel_price', true );

            $activity_packages = get_post_meta( $order_id, 'package_activity', true );
            $activity_package_price = get_post_meta( $order_id, 'package_activity_price', true );

            $car_packages = get_post_meta( $order_id, 'package_car', true );
            $car_package_price = get_post_meta( $order_id, 'package_car_price', true );

	        $flight_packages = get_post_meta( $order_id, 'package_flight', true );
	        $flight_package_price = get_post_meta( $order_id, 'package_flight_price', true );
            $html = '';
            if ( is_array( $hotel_packages ) && count( $hotel_packages ) ):
                $html .= '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}'>". __('Hotel Package', ST_TEXTDOMAIN) ."</{$data['tag']}>";
                }else{
                    $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">Hotel Package</span></td></tr>';
                }
                foreach ( $hotel_packages as $key => $val ):
                    $price = $val->hotel_price;

                        $html .= '<tr>
                                         <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                              <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;"> - ' . esc_html($val->hotel_name) . '</span>
                                              <span style="text-align: right; display: inline-block; width: 35%;">'.TravelHelper::format_money_from_db($price, $currency).'</span>
                                         </td>
                                      </tr>';

                endforeach;
                $html .= '</table>';
            endif;

            if ( is_array( $activity_packages ) && count( $activity_packages ) ):
                $html .= '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}'>". __('Activity Package', ST_TEXTDOMAIN) ."</{$data['tag']}>";
                }else{
                    $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">Activity Package</span></td></tr>';
                }
                foreach ( $activity_packages as $key => $val ):
                    $price = $val->activity_price;

                    $html .= '<tr>
                                         <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                              <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;"> - ' . esc_html($val->activity_name) . '</span>
                                              <span style="text-align: right; display: inline-block; width: 35%;">'.TravelHelper::format_money_from_db($price, $currency).'</span>
                                         </td>
                                      </tr>';

                endforeach;
                $html .= '</table>';
            endif;

            if ( is_array( $car_packages ) && count( $car_packages ) ):
                $html .= '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';
                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}'>". __('Car Package', ST_TEXTDOMAIN) ."</{$data['tag']}>";
                }else{
                    $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">Car Package</span></td></tr>';
                }
                foreach ( $car_packages as $key => $val ):
                    $price = $val->car_price;

                    $html .= '<tr>
                                         <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                              <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;"> - ' . esc_html($val->car_name) . '</span>
                                              <span style="text-align: right; display: inline-block; width: 35%;">'. TravelHelper::format_money_from_db( $price, $currency ) . ' x ' . $val->car_quantity.'</span>
                                         </td>
                                      </tr>';

                endforeach;
                $html .= '</table>';
            endif;

	        if ( is_array( $flight_packages ) && count( $flight_packages ) ):
		        $html .= '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';
		        if(!empty($data['tag'])){
			        $html .= "<{$data['tag']} style='display : {$data['display']}'>". __('Flight Package', ST_TEXTDOMAIN) ."</{$data['tag']}>";
		        }else{
			        $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">Flight Package</span></td></tr>';
		        }
		        foreach ( $flight_packages as $key => $val ):
			        $name_flight_package = __('Origin/Destination', ST_TEXTDOMAIN) . ': ' . $val->flight_origin . ' / ' . $val->flight_destination . '<br />';
		            $flight_depart_time = __('Departure time', ST_TEXTDOMAIN) . ': ' . $val->flight_departure_time . '<br />';
			        $flight_duration = __('Duration', ST_TEXTDOMAIN) . ': ' . $val->flight_duration;
			        $price_flight_package = '';
			        if($val->flight_price_type == 'business'){
				        $price_flight_package = TravelHelper::format_money_from_db($val->flight_price_business, $currency) . ' (' . __('BUSINESS', ST_TEXTDOMAIN) . ')';
			        }else{
				        $price_flight_package = TravelHelper::format_money_from_db($val->flight_price_economy, $currency) . ' (' . __('ECONOMY', ST_TEXTDOMAIN) . ')';
			        }

			        $html .= '<tr>
                                         <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                              <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;">' . $name_flight_package . $flight_depart_time . $flight_duration . '</span>
                                              <span style="text-align: right; display: inline-block; width: 35%;">' . $price_flight_package . '</span>
                                         </td>
                                      </tr>';

		        endforeach;
		        $html .= '</table>';
	        endif;

            return $html;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_package' , 'st_email_booking_package' );
//End tour package servies

if(!function_exists( 'st_email_booking_extra_price' )) {
    function st_email_booking_extra_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Extra Price', ST_TEXTDOMAIN),
            ), $atts);
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $extras = get_post_meta($order_id, 'extras', true);
            $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
            if(isset($extras['value']) && is_array($extras['value']) && count($extras['value']) && $extra_price > 0){
                /*$html = "
                <table width='100%'><tr>
                    <td width='50%''>
                        <strong>{$data['title']}</strong>
                    </td>
                    <td width='50%'>".TravelHelper::format_money_from_db($extra_price, $currency, $rate)."</td>
                </tr></table";*/

                $html = '<div style="padding-top: 10px; padding-bottom: 10px; ">
                <span style="display: inline-block; padding-bottom: 10px;">
                   '.$data['title'].':
                </span>
                <span style="padding-top: 5px; float: right;">
                    <strong>'.TravelHelper::format_money_from_db($extra_price, $currency).'</strong>
                </span>
                </div>
                ';

                /*$html = '
                <table style="width: 100%;">
                    <tbody><tr>
                      <td style="width: 50%;"><strong>'.$data['title'].'</strong></td>
                      <td style="width: 50%;"> '.TravelHelper::format_money_from_db($extra_price, $currency).'</td>
                    </tr>
                  </tbody></table>';*/

                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_extra_price' , 'st_email_booking_extra_price' );

if(!function_exists( 'st_email_booking_package_price' )) {
    function st_email_booking_package_price($atts = array()){
        global $order_id;
        $html = '';
        if($order_id){
            $hotel_packages = get_post_meta( $order_id, 'package_hotel', true );
            $hotel_package_price = get_post_meta( $order_id, 'package_hotel_price', true );

            $activity_packages = get_post_meta( $order_id, 'package_activity', true );
            $activity_package_price = get_post_meta( $order_id, 'package_activity_price', true );

            $car_packages = get_post_meta( $order_id, 'package_car', true );
            $car_package_price = get_post_meta( $order_id, 'package_car_price', true );

            $currency = get_post_meta($order_id, 'currency', true);

            if ( is_array( $hotel_packages ) && count( $hotel_packages ) ){
                $html .= '<div style="padding-top: 10px; padding-bottom: 10px; ">
                <span style="display: inline-block; padding-bottom: 10px;">'. __('Hotel package: ', ST_TEXTDOMAIN) .'</span>
                <span style="padding-top: 5px; float: right;">
                    <strong>'.TravelHelper::format_money_from_db($hotel_package_price, $currency).'</strong>
                </span>
                </div>';
            }
            if ( is_array( $activity_packages ) && count( $activity_packages ) ){
                $html .= '<div style="padding-top: 10px; padding-bottom: 10px; ">
                <span style="display: inline-block; padding-bottom: 10px;">'. __('Activity package: ', ST_TEXTDOMAIN) .'</span>
                <span style="padding-top: 5px; float: right;">
                    <strong>'.TravelHelper::format_money_from_db($activity_package_price, $currency).'</strong>
                </span>
                </div>';
            }
            if ( is_array( $car_packages ) && count( $car_packages ) ){
                $html .= '<div style="padding-top: 10px; padding-bottom: 10px; ">
                <span style="display: inline-block; padding-bottom: 10px;">'. __('Car package: ', ST_TEXTDOMAIN) .'</span>
                <span style="padding-top: 5px; float: right;">
                    <strong>'.TravelHelper::format_money_from_db($car_package_price, $currency).'</strong>
                </span>
                </div>';
            }

        }
        return $html;
    }
}
st_reg_shortcode( 'st_email_booking_package_price' , 'st_email_booking_package_price' );

/*  Use for Car */

if(!function_exists( 'st_email_booking_equipments' )) {
    function st_email_booking_equipments($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts( array(
                'tag' => '',
                'display' => 'inline-block',
                'title' => __('Equipments', ST_TEXTDOMAIN),
            ),$atts);

            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $equipment = get_post_meta($order_id, 'data_equipment', true);
            $html = '';
            if(is_array($equipment) && count($equipment)):

                $html = '<table width="100%" border="1px" style="color: #666;	border-collapse: collapse; margin-top: -1px">';

                if(!empty($data['tag'])){
                    $html .= "<{$data['tag']} style='display : {$data['display']}; border-bottom: 1px dashed #CCC'>".$data['title']."</{$data['tag']}>";
                }else{
                    $html .= '<tr><td style="padding: 10px; font-weight: bold;"><span style="text-align: left; width: 48%; display: inline-block; padding-left: 13px;">'.$data['title']."</span></td></tr>";

                }
                foreach($equipment as $key => $value):
                    $price = floatval($value->price);
                    if($price < 0) $price = 0;
                    $html .= '<tr>
                                     <td style="padding: 10px; font-weight: bold; border-top-style: dashed;">
                                          <span style="text-align: left; width: 48%; display: inline-block; padding-left: 150px;"> - '.$value->title.'</span>
                                          <span style="text-align: right; display: inline-block; width: 35%;">'.TravelHelper::format_money_from_db($price, $currency);
                    if( (int) $value->number_item < 2){
                        $value->number_item = 1;
                    }

                    $html .= ' (x'.  (int) $value->number_item . ')';
                                          $html .='</span>
                                     </td>
                                  </tr>';
                endforeach;

                $html .= '</table>';

            endif;

            return $html;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_equipments' , 'st_email_booking_equipments' );

if(!function_exists( 'st_email_booking_equipment_price' )) {
    function st_email_booking_equipment_price($atts = array()){
        global $order_id;
        if($order_id){
            $data = shortcode_atts(array(
                'title' => __('Equipments Price', ST_TEXTDOMAIN),
            ), $atts);
            $currency = get_post_meta($order_id, 'currency', true);
            //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
            $equipment = get_post_meta($order_id, 'data_equipment', true);
            $equipment_price = floatval(get_post_meta($order_id, 'price_equipment', true));
            if(is_array($equipment) && count($equipment)){
               /* $html = "
                <table width='100%'><tr>
                    <td width='50%''>
                        <strong>{$data['title']}</strong>
                    </td>
                    <td width='50%'>".TravelHelper::format_money_from_db($equipment_price, $currency)."</td>
                </tr></table";*/

                $html = '<div style="padding-top: 10px; padding-bottom: 10px; ">
                <span style="display: inline-block; padding-bottom: 10px;">
                   '.$data['title'].':
                </span>
                <span style="padding-top: 5px; float: right;">
                    <strong>'.TravelHelper::format_money_from_db($equipment_price, $currency).'</strong>
                </span>
                </div>
                ';

                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_equipment_price' , 'st_email_booking_equipment_price' );

/*  Tour - Activity */
if(!function_exists( 'st_email_booking_adult_info' )) {
    function st_email_booking_adult_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity' || $post_type =="st_hotel"  || $post_type == 'hotel_room'){
                $data = shortcode_atts(array(
                    'title' => __('No. Adult(s)', ST_TEXTDOMAIN),
                ), $atts);
                $adult = intval(get_post_meta($order_id, 'adult_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $adult_price = floatval(get_post_meta($order_id, 'adult_price', true));

                $data_price = get_post_meta($order_id, 'data_price', true);
                if(!empty($data_price['adult_price'])){
                    $adult_price = $data_price['adult_price']/$adult;
                }

                $discount = get_post_meta($post_id, 'discount', true);
                if($discount > 0) $adult_price = $adult_price - ($adult_price*($discount/100));

                $adult_price_html = ' x '. TravelHelper::format_money_from_db($adult_price, $currency);
                if($post_type =="st_hotel" || $post_type == 'hotel_room') $adult_price_html ="";
                $html = '
                <table width="100%">
                    <tr>
                        <td style="border-bottom: 1px dashed #ccc; text-align: left; padding-left: 20px;">'.$data['title'].'</td>
                        <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;">
                            <p>'.$adult.' '.__('adult(s)', ST_TEXTDOMAIN).$adult_price_html.'</p>
                        </td>
                    </tr>
                </table>
                ';
                return $html;
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_adult_info' , 'st_email_booking_adult_info' );


if(!function_exists( 'st_email_booking_children_info' )) {
    function st_email_booking_children_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity' || $post_type =="st_hotel" || $post_type == 'hotel_room'){
                $data = shortcode_atts(array(
                    'title' => __('No. Child(s)', ST_TEXTDOMAIN),
                ), $atts);
                $children = intval(get_post_meta($order_id, 'child_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $child_price = floatval(get_post_meta($order_id, 'child_price', true));

                $data_price = get_post_meta($order_id, 'data_price', true);
                if(!empty($data_price['child_price'])){
                    $child_price = $data_price['child_price']/$children;
                }

                $discount = get_post_meta($post_id, 'discount', true);
                if($discount > 0) $child_price = $child_price - ($child_price*($discount/100));

                $child_price_html = ' x '.TravelHelper::format_money_from_db($child_price, $currency);
                if ($post_type =="st_hotel" || $post_type == 'hotel_room') $child_price_html = "";
                if($children > 0 ){
                    $html = '
                    <table width="100%">
                        <tr>
                            <td style="border-bottom: 1px dashed #ccc; text-align: left; padding-left: 20px;">'.$data['title'].'</td>
                            <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;">
                                <p>'.$children.' '.__('children', ST_TEXTDOMAIN).$child_price_html.'</p>
                            </td>
                        </tr>
                    </table>
                    ';
                    return $html;
                }
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_children_info' , 'st_email_booking_children_info' );

if(!function_exists( 'st_email_booking_infant_info' )) {
    function st_email_booking_infant_info($atts = array()){
        global $order_id;
        if($order_id){
            $post_id = trim(get_post_meta($order_id, 'item_id', true));
            $post_type = get_post_type($post_id );
            if($post_type == 'st_tours' || $post_type == 'st_activity'|| $post_type =="st_hotel" || $post_type == 'hotel_room'){
                $data = shortcode_atts(array(
                    'title' => __('No. Infant', ST_TEXTDOMAIN),
                ), $atts);
                $infant = intval(get_post_meta($order_id, 'infant_number', true));

                $currency = get_post_meta($order_id, 'currency', true);
                //$rate = floatval(get_post_meta($order_id,'currency_rate', true));
                $infant_price = floatval(get_post_meta($order_id, 'infant_price', true));

                $data_price = get_post_meta($order_id, 'data_price', true);
                if(!empty($data_price['infant_price'])){
                    $infant_price = $data_price['infant_price']/$infant;
                }

                $discount = get_post_meta($post_id, 'discount', true);
                if($discount > 0) $infant_price = $infant_price - ($infant_price*($discount/100));

                $infant_price_html = ' x '.TravelHelper::format_money_from_db($infant_price, $currency);
                if ($post_type =="st_hotel") $child_price_html = "";
                if($infant > 0){
                    $html = '
                    <table width="100%">
                        <tr>
                            <td style="border-bottom: 1px dashed #ccc; text-align: left; padding-left: 20px;">'.$data['title'].'</td>
                            <td style="text-align: right; border-bottom: 1px dashed #CCC; padding-right: 10px;"><p>'.$infant.' '.__('infant', ST_TEXTDOMAIN).$infant_price_html.'</p></td>
                        </tr>
                    </table>
                    ';
                    return $html;
                }
            }else{
                return '';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_infant_info' , 'st_email_booking_infant_info' );

/* Email for confirm*/
if(!function_exists('st_email_confirm_link')){
    function st_email_confirm_link(){
        global $confirm_link;
        if($confirm_link){
            return $confirm_link;
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_confirm_link' , 'st_email_confirm_link' );

/*  Approved email */
if(!function_exists('st_approved_email_item_type')){
    function st_approved_email_item_type(){
        global $author_approved, $post_approved;

        $post_type = '';
        if(!empty($post_approved)){
            switch (get_post_type($post_approved->ID)) {
                case 'st_hotel':
                    $post_type = __('Hotel', ST_TEXTDOMAIN);
                    break;
                case 'st_rental':
                    $post_type = __('Rental', ST_TEXTDOMAIN);
                    break;
                case 'st_tours':
                    $post_type = __('Tour', ST_TEXTDOMAIN);
                    break;
                case 'st_activity':
                    $post_type = __('Activity', ST_TEXTDOMAIN);
                    break;
                case 'st_cars':
                    $post_type = __('Car', ST_TEXTDOMAIN);
                    break;
                case 'hotel_room':
                    $post_type = __('Hotel Room', ST_TEXTDOMAIN);
                    break;
                case 'rental_room':
                    $post_type = __('Rental Room', ST_TEXTDOMAIN);
                    break;
            }
        }
        return $post_type;
    }
}
st_reg_shortcode( 'st_approved_email_item_type' , 'st_approved_email_item_type' );

if(!function_exists('st_approved_email_item_name')){
    function st_approved_email_item_name(){
        global $author_approved, $post_approved;

        if(!empty($post_approved->post_title)){
            return $post_approved->post_title;
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_name' , 'st_approved_email_item_name' );

if(!function_exists('st_approved_email_admin_name')){
    function st_approved_email_admin_name(){
        global $author_approved, $post_approved;
        $user_info = get_userdata($author_approved);
        if(!empty($user_info->user_login)){
            return $user_info->user_login;
        }
    }
}
st_reg_shortcode( 'st_approved_email_admin_name' , 'st_approved_email_admin_name' );

if(!function_exists('st_approved_email_date')){
    function st_approved_email_date(){
        global $author_approved, $post_approved;
        $date = get_post_modified_time( TravelHelper::getDateFormat(), true, $post_approved->ID);
        return $date;
    }
}
st_reg_shortcode( 'st_approved_email_date' , 'st_approved_email_date' );

if(!function_exists('st_approved_email_item_link')){
    function st_approved_email_item_link(){
        global $author_approved, $post_approved;
        if(!empty($post_approved->ID)){
            return get_the_permalink($post_approved->ID);
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_link' , 'st_approved_email_item_link' );

if(!function_exists('st_approved_email_item_name')){
    function st_approved_email_item_name(){
        global $author_approved, $post_approved;
        if(!empty($post_approved->post_title)){
            return $post_approved->post_title;
        }
    }
}
st_reg_shortcode( 'st_approved_email_item_name' , 'st_approved_email_item_name' );

///////////////////////////////////////////
///// New 1.2.1 ///////////////////////////
///////////////////////////////////////////


if(!function_exists( 'st_email_booking_item_address' )) {
    function st_email_booking_item_address(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            $post_type = get_post_type($item_id);
            $address = get_post_meta($item_id,'address',true);
            if($post_type == 'st_cars'){
                $address = get_post_meta($item_id,'cars_address',true);
            }
            if(!empty($address)){
                return '<table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong>'.__("Address",ST_TEXTDOMAIN).': </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                '.$address.'
                            </td>
                        </tr>
                    </table>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_address' , 'st_email_booking_item_address' );

if(!function_exists('st_email_booking_flight_extra_info')){
	function st_email_booking_flight_extra_info(){
		global $order_id;
		$return_data = '';
		if($order_id){
			$post_type_order = get_post_type($order_id, 'item_post_type', true);
			if($post_type_order == 'st_flight') {
				$passenger          = get_post_meta( $order_id, 'passenger', true );
				$flight_stop        = get_post_meta( $order_id, 'depart_stop', true );
				$depart_date        = get_post_meta( $order_id, 'depart_date', true );
				$price_class_depart = get_post_meta( $order_id, 'price_class_depart', true );
				$flight_type        = get_post_meta( $order_id, 'flight_type', true );
				$depart_id          = get_post_meta( $order_id, 'depart_id', true );
				$depart_duration    = get_post_meta( $depart_id, 'total_time', true );
				$return_data        .= '<table>';
				$return_data        .= '<tr>';
				switch ( $flight_type ) {
					case 'return':
						$return_data .= '<td>' . __( 'Flight type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Return', ST_TEXTDOMAIN ) . '</td>';
						break;
					default:
						$return_data .= '<td>' . __( 'Flight type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'One way', ST_TEXTDOMAIN ) . '</td>';
						break;
				}
				$return_data .= '</tr>';
				$return_data .= '<tr>';
				$return_data .= '<td>' . __( 'Number of passengers: ', ST_TEXTDOMAIN ) . '</td><td>' . $passenger . '</td>';
				$return_data .= '</tr>';
				if ( $flight_type == 'return' ) {
					$return_data .= '<tr>';
					$return_data .= '<td colspan="2"><b>' . __( '*Departure information', ST_TEXTDOMAIN ) . '</b></td>';
					$return_data .= '</tr>';
				}
				$return_data .= '<tr>';
				switch ( $flight_stop ) {
					case 'direct':
						$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Direct flight', ST_TEXTDOMAIN ) . '</td>';
						break;
					case 'one_stop':
						$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'One Stop', ST_TEXTDOMAIN ) . '</td>';
						break;
					case 'two_stops':
						$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Two Stops', ST_TEXTDOMAIN ) . '</td>';
						break;
				}
				$return_data .= '</tr>';
				$return_data .= '<tr>';
				$return_data .= '<td>' . __( 'Departure date: ', ST_TEXTDOMAIN ) . '</td><td>' . @date( TravelHelper::getDateFormat(), $depart_date ) . '</td>';
				$return_data .= '</tr>';
				$return_data .= '<tr>';
				switch ( $price_class_depart ) {
					case 'eco_price':
						$return_data .= '<td>' . __( 'Departure class: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Economy', ST_TEXTDOMAIN ) . '</td>';
						break;
					case 'business_price':
						$return_data .= '<td>' . __( 'Departure class: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Business', ST_TEXTDOMAIN ) . '</td>';
						break;
				}
				$return_data .= '</tr>';
				if ( ! empty( $depart_duration ) ) {
					$return_data .= '<tr>';
					$return_data .= '<td>' . __( 'Duration: ', ST_TEXTDOMAIN ) . '</td><td>' . $depart_duration['hour'] . ' ' . __( 'hour', ST_TEXTDOMAIN ) . ' ' . $depart_duration['minute'] . ' ' . __( 'minute', ST_TEXTDOMAIN ) . '</td>';
					$return_data .= '</tr>';
				}
				$return_data .= '<tr>';
				if ( $flight_type == 'return' ) {
					$return_id          = get_post_meta( $order_id, 'return_id', true );
					$return_duration    = get_post_meta( $return_id, 'total_time', true );
					$return_data        .= '<tr>';
					$return_data        .= '<td colspan="2"><b>' . __( '*Return information', ST_TEXTDOMAIN ) . '</b></td>';
					$return_data        .= '</tr>';
					$flight_stop_return = get_post_meta( $order_id, 'return_stop', true );
					$return_data        .= '<tr>';
					switch ( $flight_stop_return ) {
						case 'direct':
							$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Direct flight', ST_TEXTDOMAIN ) . '</td>';
							break;
						case 'one_stop':
							$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'One Stop', ST_TEXTDOMAIN ) . '</td>';
							break;
						case 'two_stops':
							$return_data .= '<td>' . __( 'Stops type: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Two Stops', ST_TEXTDOMAIN ) . '</td>';
							break;
					}
					$return_data        .= '</tr>';
					$return_date        = get_post_meta( $order_id, 'return_date', true );
					$price_class_return = get_post_meta( $order_id, 'price_class_return', true );
					$return_data        .= '<tr>';
					$return_data        .= '<td>' . __( 'Return date: ', ST_TEXTDOMAIN ) . '</td><td>' . @date( TravelHelper::getDateFormat(), $return_date ) . '</td>';
					$return_data        .= '</tr>';
					$return_data        .= '<tr>';
					switch ( $price_class_return ) {
						case 'eco_price':
							$return_data .= '<td>' . __( 'Return class: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Economy', ST_TEXTDOMAIN ) . '</td>';
							break;
						case 'business_price':
							$return_data .= '<td>' . __( 'Return class: ', ST_TEXTDOMAIN ) . '</td><td>' . __( 'Business', ST_TEXTDOMAIN ) . '</td>';
							break;
					}
					$return_data .= '</tr>';
					if ( ! empty( $return_duration ) ) {
						$return_data .= '<tr>';
						$return_data .= '<td>' . __( 'Duration: ', ST_TEXTDOMAIN ) . '</td><td>' . $return_duration['hour'] . ' ' . __( 'hour', ST_TEXTDOMAIN ) . ' ' . $return_duration['minute'] . ' ' . __( 'minute', ST_TEXTDOMAIN ) . '</td>';
						$return_data .= '</tr>';
					}
				}
				$return_data .= '</table>';
			}
		}
		return $return_data;
	}
}
st_reg_shortcode( 'st_email_booking_flight_extra_info' , 'st_email_booking_flight_extra_info' );

if(!function_exists( 'st_email_booking_item_website' )) {
    function st_email_booking_item_website(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            $post_type = get_post_type($item_id);
            $website = get_post_meta($item_id,'website',true);
            if($post_type == 'st_cars'){
                $website = get_post_meta($item_id,'cars_website',true);
            }
            if($post_type == 'st_activity'){
                $website = get_post_meta($item_id,'contact_website',true);
            }
            if($post_type == 'st_hotel'){
                $theme_option=st()->get_option('partner_show_contact_info');
                $metabox=get_post_meta($item_id,'show_agent_contact_info',true);
                $use_agent_info=FALSE;
                if($theme_option=='on') $use_agent_info=true;
                if($metabox=='user_agent_info') $use_agent_info=true;
                if($metabox=='user_item_info') $use_agent_info=FALSE;
                $obj_hotel = get_post( $item_id );
                $user_id = $obj_hotel->post_author;
                if($use_agent_info){
                    $website = get_the_author_meta('user_url',$user_id);
                }else{
                    $website = get_post_meta($item_id,'website',true);
                }
            }

            if(!empty($website)){
                return '<table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong>'.__("Website",ST_TEXTDOMAIN).': </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                <span style="text-decoration: underline;">'.$website.'</span>
                            </td>
                        </tr>
                    </table>';
            }


        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_website' , 'st_email_booking_item_website' );

if(!function_exists( 'st_email_booking_item_email' )) {
    function st_email_booking_item_email(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            $post_type = get_post_type($item_id);
            $email = get_post_meta($item_id,'email',true);
            if($post_type == 'st_cars'){
                $email = get_post_meta($item_id,'cars_email',true);
            }
            if($post_type == 'st_activity' or $post_type == 'st_tours'){
                $email = get_post_meta($item_id,'contact_email',true);
            }
            if($post_type == 'st_hotel'){
                $theme_option=st()->get_option('partner_show_contact_info');
                $metabox=get_post_meta($item_id,'show_agent_contact_info',true);
                $use_agent_info=FALSE;
                if($theme_option=='on') $use_agent_info=true;
                if($metabox=='user_agent_info') $use_agent_info=true;
                if($metabox=='user_item_info') $use_agent_info=FALSE;
                $obj_hotel = get_post( $item_id );
                $user_id = $obj_hotel->post_author;
                if($use_agent_info){
                    $email = get_the_author_meta('user_email',$user_id);
                }else{
                    $email = get_post_meta($item_id,'email',true);
                }
            }
            if( $post_type == 'hotel_room' ){
                $author = get_post_field( 'post_author', $item_id );
                $author_info = get_user_by( 'ID',$author );
                $email = $author_info->user_email;
            } 
            if(!empty($email)){
                return '<table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong>'.__("Email",ST_TEXTDOMAIN).': </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                <span style="text-decoration: underline;">'.$email.'</span>
                            </td>
                        </tr>
                    </table>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_email' , 'st_email_booking_item_email' );

if(!function_exists( 'st_email_booking_item_phone' )) {
    function st_email_booking_item_phone(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            $post_type = get_post_type($item_id);
            $phone = get_post_meta($item_id,'phone',true);
            if($post_type == 'st_cars'){
                $phone = get_post_meta($item_id,'cars_phone',true);
            }
            if($post_type == 'st_activity'){
                $phone = get_post_meta($item_id,'contact_phone',true);
            }
            if($post_type == 'st_hotel'){
                $theme_option=st()->get_option('partner_show_contact_info');
                $metabox=get_post_meta($item_id,'show_agent_contact_info',true);
                $use_agent_info=FALSE;
                if($theme_option=='on') $use_agent_info=true;
                if($metabox=='user_agent_info') $use_agent_info=true;
                if($metabox=='user_item_info') $use_agent_info=FALSE;
                $obj_hotel = get_post( $item_id );
                $user_id = $obj_hotel->post_author;
                if($use_agent_info){
                    $phone = get_user_meta($user_id,'st_phone',true);
                }else{
                    $phone = get_post_meta($item_id,'phone',true);
                }
            }
            if(!empty($phone)){
                return '<table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong>'.__("Phone",ST_TEXTDOMAIN).': </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                <span style="text-decoration: underline;">'.$phone.'</span>
                            </td>
                        </tr>
                    </table>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_phone' , 'st_email_booking_item_phone' );

if(!function_exists( 'st_email_booking_item_fax' )) {
    function st_email_booking_item_fax(){
        global $order_id;
        if($order_id){
            $item_id = get_post_meta($order_id,'item_id',true);
            $post_type = get_post_type($item_id);
            $fax = get_post_meta($item_id,'fax',true);
            if($post_type == 'st_cars'){
                $fax = get_post_meta($item_id,'cars_fax',true);
            }
            if($post_type == 'st_activity'){
                $fax = get_post_meta($item_id,'contact_fax',true);
            }
            if(!empty($fax)){
                return '<table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong>'.__("Fax",ST_TEXTDOMAIN).': </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                <span style="text-decoration: underline;">'.$fax.'</span>
                            </td>
                        </tr>
                    </table>';
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_item_fax' , 'st_email_booking_item_fax' );


if(!function_exists( 'st_email_booking_status' )) {
    function st_email_booking_status(){
        global $order_id;
        if($order_id){
            $html = get_post_meta($order_id,'status',true);
            return '<span style="text-transform: capitalize;">'.$html.'</span>';
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_status' , 'st_email_booking_status' );

if(!function_exists( 'st_email_booking_payment_method' )) {
    function st_email_booking_payment_method(){
        global $order_id;
        if($order_id){
            $html = get_post_meta($order_id,'payment_method',true);
            return '<span style="text-transform: capitalize;">'.$html.'</span>';
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_payment_method' , 'st_email_booking_payment_method' );

if(!function_exists( 'st_email_booking_url_booking_history' )) {
    function st_email_booking_url_booking_history(){
        global $order_id;
        if($order_id){
            $page_id = st()->get_option('page_my_account_dashboard');
            if(!empty($page_id)){
                $url = add_query_arg(array('sc'=>'booking-history'),get_the_permalink($page_id));
                return $url;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_url_booking_history' , 'st_email_booking_url_booking_history' );

if(!function_exists( 'st_email_booking_url_download_invoice' )) {
    function st_email_booking_url_download_invoice(){
        global $order_id;
        if($order_id){
            $page_id = st()->get_option('page_my_account_dashboard');
            if(!empty($page_id)){
                $url = add_query_arg(
                    array(
                        'sc'=>'booking-history',
                        'st_download'=>$order_id
                    )
                    ,get_the_permalink($page_id)
                );
                return $url;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_url_download_invoice' , 'st_email_booking_url_download_invoice' );

if(!function_exists( 'st_email_package_partner_name' )) {
    function st_email_package_partner_name(){
        global $pack_orderdata;
        if($pack_orderdata){
            $partner_info = unserialize($pack_orderdata->partner_info);

            return esc_attr($partner_info['firstname'] ). ' '. $partner_info['lastname'];
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_partner_name' , 'st_email_package_partner_name' );

if(!function_exists( 'st_email_package_partner_email' )) {
    function st_email_package_partner_email(){
        global $pack_orderdata;
        if($pack_orderdata){
            $partner_info = unserialize($pack_orderdata->partner_info);

            return esc_attr($partner_info['email'] );
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_partner_email' , 'st_email_package_partner_email' );

if(!function_exists( 'st_email_package_partner_phone' )) {
    function st_email_package_partner_phone(){
        global $pack_orderdata;
        if($pack_orderdata){
            $partner_info = unserialize($pack_orderdata->partner_info);

            return esc_attr($partner_info['phone'] );
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_partner_phone' , 'st_email_package_partner_phone' );

if(!function_exists( 'st_email_package_name' )) {
    function st_email_package_name(){
        global $pack_orderdata;
        if($pack_orderdata){

            return esc_attr($pack_orderdata->package_name);
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_name' , 'st_email_package_name' );

if(!function_exists( 'st_email_package_price' )) {
    function st_email_package_price(){
        global $pack_orderdata;
        if($pack_orderdata){

            return TravelHelper::format_money_raw($pack_orderdata->package_price, '$');
        }

        return '';
    }
}

st_reg_shortcode( 'st_email_package_price' , 'st_email_package_price' );

if(!function_exists( 'st_email_package_commission' )) {
    function st_email_package_commission(){
        global $pack_orderdata;
        if($pack_orderdata){

            return esc_attr($pack_orderdata->package_commission). '%';
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_commission' , 'st_email_package_commission' );

if(!function_exists( 'st_email_package_time' )) {
    function st_email_package_time(){
        global $pack_orderdata;
        if($pack_orderdata){
            $cls_packages = STAdminPackages::get_inst();
            return $cls_packages->convert_item($pack_orderdata->package_time, true);
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_time' , 'st_email_package_time' );

if(!function_exists( 'st_email_package_upload' )) {
    function st_email_package_upload(){
        global $pack_orderdata;
        if($pack_orderdata){
            $cls_packages = STAdminPackages::get_inst();
            return $cls_packages->convert_item($pack_orderdata->package_item_upload, false);
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_upload' , 'st_email_package_upload' );

if(!function_exists( 'st_email_package_featured' )) {
    function st_email_package_featured(){
        global $pack_orderdata;
        if($pack_orderdata){
            $cls_packages = STAdminPackages::get_inst();
            return $cls_packages->convert_item($pack_orderdata->package_item_featured, false);
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_featured' , 'st_email_package_featured' );

if(!function_exists( 'st_email_package_description' )) {
    function st_email_package_description(){
        global $pack_orderdata;
        if($pack_orderdata && isset($pack_orderdata->package_item_description)){
            return do_shortcode($pack_orderdata->package_item_description );
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_description' , 'st_email_package_description' );

if(!function_exists( 'st_email_package_services' )) {
    function st_email_package_services(){
        global $pack_orderdata;
        if($pack_orderdata){
            $cls_packages = STAdminPackages::get_inst();
            return $cls_packages->paser_list_services($pack_orderdata->package_services, false);
        }

        return '';
    }
}
st_reg_shortcode( 'st_email_package_services' , 'st_email_package_services' );

///////////////////////////////////////////
///// for email template  default /////////d
///////////////////////////////////////////

if(!function_exists('st_default_email_template_admin_')){
    function st_default_email_template_admin_(){
        $logo = st()->get_option('logo',get_template_directory_uri().'/img/logo-invert.png');
        $footer_menu = '<ul style="list-style: none; text-align: center;">
            <li style="display: inline-block;"><a href="#">'.__("About us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("Contact us", ST_TEXTDOMAIN) .'</a> |</li>
            <li style="display: inline-block;"><a href="#">'.__("News", ST_TEXTDOMAIN) .'</a> |</li>
            </ul>';
        $social_icon = '<a href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/eb_face.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/eb_yo.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/eb_tw.png" alt="" width="35" height="35" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6293" src="'.get_template_directory_uri().'/img/email/eb_p.png" alt="" width="35" height="34" /></a>
            <a style="margin: 5px;" href="'.site_url().'"><img class="alignnone wp-image-6294" src="'.get_template_directory_uri().'/img/email/eb_in.png" alt="" width="35" height="35" /></a>';

        return '
        <table id="header" class="wrapper" border="0" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr bgcolor="#FFF">
            <td style="padding: 20px 10px;" width="20%"><a href="'.site_url().'">
                <img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="logo" width="110" height="40" /></a></td>
            <td style="padding: 20px 10px;">
            <h3 style="text-align: right;">'.get_bloginfo('title').'</h3>
            <p style="text-align: right;">'.get_bloginfo('description').'</p>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-infomation" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 20px 10px; background: #ED8323;">
            <h1 style="text-align: left; color: #fff;">'.__("Booking Information" , ST_TEXTDOMAIN).'</h1>
            </td>
            </tr>
            </tbody>
            </table>
            <table id="booking-content" class="wrapper" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr id="title">
            <td style="padding: 10px;">
            <h3>Hi Administrator,</h3>
            <h4>[st_email_booking_first_name] [st_email_booking_last_name] '.__("booked your system" , ST_TEXTDOMAIN).'.</h4>
            <h4>'.__("Below are customer\'s booking details:" , ST_TEXTDOMAIN).'</h4>
            <h3><strong>'.__("Booking Code: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_id]</h3>
            </td>
            </tr>
            <tr>
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding: 0 5px;">
            <div style="width: 66.6666%; float: left;">
            <table style="border-right: 1px solid #CCC;" width="95%">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Customer Information" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("First name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_first_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Last name:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Email:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_email]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Phone: " , ST_TEXTDOMAIN).'</strong>[st_email_booking_phone]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("City:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_city]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Address line 1:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Country:" , ST_TEXTDOMAIN).'</strong> [st_email_booking_country]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p><strong>'.__("Special Requirements:" , ST_TEXTDOMAIN).'</strong></p>
            <p>[st_email_booking_note]</p>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            <div style="width: 33.3334%; float: left;">
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td>
            <h3><strong>'.__("Shipped to:" , ST_TEXTDOMAIN).'</strong></h3>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_first_name] [st_email_booking_last_name]</p>
            </td>
            </tr>
            <tr>
            <td>
            <p>[st_email_booking_address]</p>
            </td>
            </tr>
            <tr>
            <td>
            <h3><strong>'.__("Date: " , ST_TEXTDOMAIN).'</strong> [st_email_booking_date]</h3>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            <tr>
            <td style="padding: 30px 5px 10px 5px;">
            <table id="item" style="-webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -ms-border-radius: 3px 3px 0 0; -o-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; border: 1px solid #CCC;" width="100%" cellspacing="0">
            <tbody>
            <tr>
            <th style="padding: 10px 5px; background: #EFEFEF;" align="left">'.__("Item" , ST_TEXTDOMAIN).'</th>
            </tr>
            <tr style="background: #FFF;">
            <td>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-left: 10px; padding-top: 10px; padding-bottom: 15px;" width="50%">
            <h3>[st_email_booking_item_link]</h3>
            <p>&nbsp;</p>
            <p>[st_email_booking_thumbnail]</p>
            </td>
            <td style="padding: 10px 0; text-align: right; padding-right: 10px;" width="50%"> </td>
            </tr>
            <tr>
            <td style="padding-left: 10px; border-bottom: 1px dashed #CCC;" colspan="2">
            <p>[st_email_booking_room_name tag="" title="'.__("Room Name: " , ST_TEXTDOMAIN).'"]</p>
            </td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_number_item]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_item_price] [st_email_booking_adult_info] [st_email_booking_children_info] [st_email_booking_infant_info]</td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;">[st_check_in_out_title]</td>
            <td class="" style="text-align: right; padding-right: 10px;">[st_check_in_out_value]</td>
            </tr>
            <tr>
            <td colspan="2"> </td>
            </tr>
            <tr>
            <td class="" style="padding-left: 10px;" colspan="2">[st_email_booking_extra_items title="'.__("Extra" , ST_TEXTDOMAIN).'"] [st_email_booking_equipments title="'.__("Equipments" , ST_TEXTDOMAIN).'"]</td>
            </tr>
            <tr>
            <td style="border-top: 2px solid #CCC; padding-left: 10px;"> </td>
            <td style="border-top: 2px solid #CCC; text-align: right; padding-right: 10px;">
            <table width="100%">
            <tbody>
            <tr>
            <td width="50%"><strong>'.__("Origin Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_origin_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Sale Price" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_sale_price]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_extra_price] [st_email_booking_equipment_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Tax" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_tax]</td>
            </tr>
            <tr>
            <td width="50%">
            <p><strong>Total Price <em>'.__("(with tax)" , ST_TEXTDOMAIN).'</em></strong></p>
            </td>
            <td width="50%">[st_email_booking_price_with_tax]</td>
            </tr>
            <tr>
            <td colspan="2">[st_email_booking_deposit_price]</td>
            </tr>
            <tr>
            <td width="50%"><strong>'.__("Pay Amount" , ST_TEXTDOMAIN).'</strong></td>
            <td width="50%">[st_email_booking_total_price]</td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            <table width="100%" cellspacing="0">
            <tbody>
            <tr>
            <td style="padding-top: 30px;" align="center">
            <a href="'.site_url().'"><img class="alignnone wp-image-7442 size-full" src="'.$logo.'" alt="" width="110" height="40" /></a>
            </td>
            </tr>
            <tr>
            <td style="padding-bottom: 30px; border-bottom: 1px solid #CCC;" align="center">'.$social_icon.'</td>
            </tr>
            <tr>
            <td style="padding-top: 20px;" align="center">
            <p>'.get_bloginfo('title').' | '.get_bloginfo('description').'</p>
            <p>Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
            '.$footer_menu.'
            </td>
            </tr>
            </tbody>
            </table>
        ';
    }
}

if(!function_exists('st_default_email_template_admin')){
    function st_default_email_template_admin(){
        return st()->load_template('email/templates/st_default_email_template_admin');
    }
}

if(!function_exists('st_default_email_header_template')){
	function st_default_email_header_template(){
		return st()->load_template('email/templates/st_default_email_header_template');
	}
}

if(!function_exists('st_default_email_footer_template')){
	function st_default_email_footer_template(){
		return st()->load_template('email/templates/st_default_email_footer_template');
	}
}

if(!function_exists('st_default_email_template_partner')){
    function st_default_email_template_partner(){
        return st()->load_template('email/templates/st_default_email_template_partner');
    }
}
if(!function_exists('st_default_email_template_partner_expired_date')){
    function st_default_email_template_partner_expired_date(){
        return st()->load_template('email/templates/st_default_email_template_partner_expired_date');
    }
}
if(!function_exists('st_default_email_template_customer')){
    function st_default_email_template_customer(){
        return st()->load_template('email/templates/st_default_email_template_customer');
    }
}
if(!function_exists('st_default_email_template_notification_depature_customer')){
    function st_default_email_template_notification_depature_customer(){
        return st()->load_template('email/templates/st_default_email_template_notification_depature_customer');
    }
}
if(!function_exists('get_email_confirm_template')){
    function get_email_confirm_template(){
        return st()->load_template('email/templates/get_email_confirm_template');

    }
}
if(!function_exists('get_email_approved_template')){
    function get_email_approved_template(){
        return st()->load_template('email/templates/get_email_approved_template');
    }
}


/*   Shortcode for Partner infomation */

if(!function_exists( '_st_info_full_name' )) {
    function _st_info_full_name(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->display_name;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_full_name' , '_st_info_full_name' );

if(!function_exists( '_st_info_user_name' )) {
    function _st_info_user_name(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->nickname;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_name' , '_st_info_user_name' );

if(!function_exists( '_st_info_user_email' )) {
    function _st_info_user_email(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return $user_data->user_email;
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_email' , '_st_info_user_email' );

if(!function_exists( '_st_info_user_date_create' )) {
    function _st_info_user_date_create(){
        global $st_user_id;
        if($st_user_id){
            $user_data = get_userdata( $st_user_id );
            return date_i18n("d/m/Y",strtotime($user_data->user_registered));
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_date_create' , '_st_info_user_date_create' );

if(!function_exists( '_st_info_user_certificates' )) {
    function _st_info_user_certificates(){
        global $st_user_id;
        if($st_user_id){
            $html ="";
            $data = get_user_meta($st_user_id , "st_certificates" ,  true);
            if(!empty($data)){
                $html .= '<table style="width:60%;color:#666">';
                $i = 1;
                foreach($data as $k=>$v){
                    if($i == 1 or $i == 3 or $i == 5){
                        $html .= "<tr>";
                    }
                    $html .= '<td><img src="'.get_template_directory_uri().'/img/email/check.png" > '.$v['name'].'</td>';
                    $i++;
                }
                $html .= "</table>";
            }
            return balanceTags($html);
        }
        return '';
    }
}
st_reg_shortcode( 'st_info_user_certificates' , '_st_info_user_certificates' );

if(!function_exists( '_st_url_info_user' )) {
    function _st_url_info_user(){
        global $st_user_id;
        if($st_user_id){
            $url = admin_url("user-edit.php?user_id=".$st_user_id);
            return $url;
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_info_user' , '_st_url_info_user' );


if(!function_exists( '_st_url_list_user_partner' )) {
    function _st_url_list_user_partner(){
        global $st_user_id;
        if($st_user_id){
            $user_data = new WP_User( $st_user_id );
            $user__permission = array_shift($user_data->roles);
            $url = admin_url("admin.php?page=st-users-list-partner-menu");
            if($user__permission == "partner"){
                $url = admin_url("admin.php?page=st-users-list-partner-menu&st_tab=partner_update");
            }
            return $url;
        }
    }
}
st_reg_shortcode( 'st_url_list_user_partner' , '_st_url_list_user_partner' );

if(!function_exists( '_st_is_partner_register' )) {
    function _st_is_partner_register($attr,$content){
        global $st_user_id;
        if($st_user_id){
            $user_data = new WP_User( $st_user_id );
            $user__permission = array_shift($user_data->roles);
            if($user__permission == "subscriber"  or $user__permission == "Subscriber"){
                 return $content;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_is_partner_register' , '_st_is_partner_register' );

if(!function_exists( '_st_is_partner_update' )) {
    function _st_is_partner_update($attr,$content){
        global $st_user_id;
        if($st_user_id){
            $user_data = new WP_User( $st_user_id );
            $user__permission = array_shift($user_data->roles);
            if($user__permission == "partner"){
                return $content;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_is_partner_update' , '_st_is_partner_update' );

if(!function_exists( '_st_url_update_certificates' )) {
    function _st_url_update_certificates(){
        global $st_user_id;
        if($st_user_id){
            $page_id = st()->get_option('page_my_account_dashboard');
            if(!empty($page_id)){
                $url = add_query_arg(array('sc'=>'certificate'),get_the_permalink($page_id));
                return $url;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_update_certificates' , '_st_url_update_certificates' );


if(!function_exists( '_st_url_partner_dashboard' )) {
    function _st_url_partner_dashboard(){
        $page_id = st()->get_option('page_my_account_dashboard');
        if(!empty($page_id)){
            $url = get_the_permalink($page_id);
            return $url;
        }
        return '';
    }
}
st_reg_shortcode( 'st_url_partner_dashboard' , '_st_url_partner_dashboard' );

if(!function_exists( '_st_partner_amount' )) {
    function _st_partner_amount(){
        global $st_user_id;
        global $st_withdrawal_id;
        if(!empty($st_withdrawal_id)){
            global $wpdb;
            $sql = "SELECT * FROM {$wpdb->prefix}st_withdrawal
                WHERE 1=1
                AND user_id = {$st_user_id}
                AND ID = {$st_withdrawal_id}
            ";
            $rs = $wpdb->get_row($sql);
            if(!empty($rs->price)) {
                return TravelHelper::format_money($rs->price);
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_partner_amount' , '_st_partner_amount' );


if(!function_exists( '_st_partner_payment_method' )) {
    function _st_partner_payment_method(){
        global $st_user_id;
        global $st_withdrawal_id;
        if(!empty($st_withdrawal_id)){
            global $wpdb;
            $sql = "SELECT * FROM {$wpdb->prefix}st_withdrawal
                WHERE 1=1
                AND user_id = {$st_user_id}
                AND ID = {$st_withdrawal_id}
            ";
            $rs = $wpdb->get_row($sql);
            if(!empty($rs->payout)) {
                return ucwords($rs->payout);
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_partner_payment_method' , '_st_partner_payment_method' );

if(!function_exists( '_st_url_admin_withdrawal' )) {
    function _st_url_admin_withdrawal(){
        return admin_url("admin.php?page=st-users-partner-withdrawal-menu");
    }
}
st_reg_shortcode( 'st_url_admin_withdrawal' , '_st_url_admin_withdrawal' );
if(!function_exists( '_st_partner_payment_info' )) {
    function _st_partner_payment_info(){
        global $st_user_id;
        global $st_withdrawal_id;
        if(!empty($st_withdrawal_id)){
            global $wpdb;
            $sql = "SELECT * FROM {$wpdb->prefix}st_withdrawal
                WHERE 1=1
                AND user_id = {$st_user_id}
                AND ID = {$st_withdrawal_id}
            ";
            $rs = $wpdb->get_row($sql);
            if(!empty($rs->payout)) {
                return $rs->data_payout;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_partner_payment_info' , '_st_partner_payment_info' );

st_reg_shortcode( 'st_url_admin_withdrawal' , '_st_url_admin_withdrawal' );
if(!function_exists( '_st_date_payout_this_month' )) {
    function _st_date_payout_this_month(){
        $day = st()->get_option('partner_date_payout_this_month');
        if(!empty($day)){
            $this_month = date('Y-m-'.$day);
            $this_month = date_i18n(TravelHelper::getDateFormat(),strtotime($this_month));
            return $this_month;
        }
        return '';
    }
}
st_reg_shortcode( 'st_date_payout_this_month' , '_st_date_payout_this_month' );

if(!function_exists( '_st_content_message_cancel' )) {
    function _st_content_message_cancel(){
        global $st_user_id;
        global $st_withdrawal_id;
        if(!empty($st_withdrawal_id)){
            global $wpdb;
            $sql = "SELECT * FROM {$wpdb->prefix}st_withdrawal
                WHERE 1=1
                AND user_id = {$st_user_id}
                AND ID = {$st_withdrawal_id}
            ";
            $rs = $wpdb->get_row($sql);
            if(!empty($rs->message)) {
                return $rs->message;
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_content_message_cancel' , '_st_content_message_cancel' );

/**
*@since 1.2.8
**/
if( !function_exists('st_email_has_refund') ){
    function st_email_has_refund(){
        global $cancel_order_id, $cancel_cancel_data;
        $template = st()->load_template('user/cancel-booking/email', 'has-refund', array( 'order_id' => $cancel_order_id,'cancel_data' => $cancel_cancel_data ) );

        return $template;
    }
st_reg_shortcode( 'st_email_has_refund' , 'st_email_has_refund' );
}

if( !function_exists('st_email_has_refund_for_partner') ){
    function st_email_has_refund_for_partner(){
        global $cancel_order_id, $cancel_cancel_data;
        $template = st()->load_template('user/cancel-booking/email', 'has-refund-for-partner', array( 'order_id' => $cancel_order_id,'cancel_data' => $cancel_cancel_data ) );

        return $template;
    }
    st_reg_shortcode( 'st_email_has_refund_for_partner' , 'st_email_has_refund_for_partner' );
}

if( !function_exists('st_email_cancel_booking_success') ){
    function st_email_cancel_booking_success(){
        global $cancel_order_id, $cancel_cancel_data;
        $template = st()->load_template('user/cancel-booking/email', 'success', array( 'order_id' => $cancel_order_id,'cancel_data' => $cancel_cancel_data ) );

        return $template;
    }
st_reg_shortcode( 'st_email_cancel_booking_success' , 'st_email_cancel_booking_success' );
}
if( !function_exists('st_email_cancel_booking_username') ){
    function st_email_cancel_booking_username(){
        global $cancel_order_id, $cancel_cancel_data;
        $first_name = get_post_meta($cancel_order_id, 'st_first_name', true );
        $last_name = get_post_meta($cancel_order_id, 'st_last_name', true );

        return $first_name . ' '. $last_name;
    }
    st_reg_shortcode( 'st_email_cancel_booking_username' , 'st_email_cancel_booking_username' );
}

/* 2.0.3 Email template for partner expire date */
if( !function_exists('st_email_partner_name') ){
    function st_email_partner_name(){
        global $expire_partner_id;
        $udata = get_userdata( $expire_partner_id );
        return $udata->user_nicename;
    }
    st_reg_shortcode( 'st_email_partner_name' , 'st_email_partner_name' );
}
if( !function_exists('st_email_partner_package_name') ){
    function st_email_partner_package_name(){
        global $expire_partner_id;
        $cls_package = STPackages::get_inst();
        $order = $cls_package->get_order_package_by("partner = {$expire_partner_id}");
        $package_name = '';
        if ($order) {
            $package_name = esc_attr($order->package_name);
        }
        return $package_name;
    }
    st_reg_shortcode( 'st_email_partner_package_name' , 'st_email_partner_package_name' );
}
if( !function_exists('st_email_partner_package_price') ){
    function st_email_partner_package_price(){
        global $expire_partner_id;
        $cls_package = STPackages::get_inst();
        $order = $cls_package->get_order_package_by("partner = {$expire_partner_id}");
        $package_price = '';
        if ($order) {
            $currency = get_post_meta($order->id, 'currency', true);
            $currency = (isset($currency['symbol'])) ? $currency['symbol'] : '';
            $package_price = TravelHelper::format_money_raw($order->package_price, $currency);
        }
        return $package_price;
    }
    st_reg_shortcode( 'st_email_partner_package_price' , 'st_email_partner_package_price' );
}
if( !function_exists('st_email_partner_package_date_register') ){
    function st_email_partner_package_date_register(){
        global $expire_partner_id;
        $udata = get_userdata( $expire_partner_id );
        return esc_html(date_i18n(get_option('date_format') . " " . get_option('time_format'), strtotime($udata->user_registered)));
    }
    st_reg_shortcode( 'st_email_partner_package_date_register' , 'st_email_partner_package_date_register' );
}
if( !function_exists('st_email_partner_package_date_expired') ){
    function st_email_partner_package_date_expired(){
        global $expire_partner_id;
        $cls_package = STPackages::get_inst();
        $order = $cls_package->get_order_package_by("partner = {$expire_partner_id}");
        $created = (int)$order->created;
        $time = $order->package_time;
        if ($time == 'unlimited') {
            $expiration = esc_html__('Unlimited', ST_TEXTDOMAIN);
        } else {
            $expiration = date('Y-m-d', strtotime('+' . (int)$time . ' days', $created));
            $expiration = date_i18n(get_option('date_format'), strtotime($expiration));
        }
        return esc_attr($expiration);
    }
    st_reg_shortcode( 'st_email_partner_package_date_expired' , 'st_email_partner_package_date_expired' );
}
if( !function_exists('st_email_partner_package_number_expired') ){
    function st_email_partner_package_number_expired(){
        global $expire_partner_id;
        $cls_package = STPackages::get_inst();
        $order = $cls_package->get_order_package_by("partner = {$expire_partner_id}");
        $date_now = date('Y-m-d');
        $countdown_string = '';
        $created = (int)$order->created;
        $time = $order->package_time;
        if ($time == 'unlimited') {
            $countdown_string = esc_html__('Unlimited', ST_TEXTDOMAIN);
        } else {
            $expiration = date('Y-m-d', strtotime('+' . (int)$time . ' days', $created));
            $date_diff = STDate::dateDiff($date_now, $expiration);
            $countdown_string = $date_diff . esc_html__(' day(s)', ST_TEXTDOMAIN);
        }
        return $countdown_string;
    }
    st_reg_shortcode( 'st_email_partner_package_number_expired' , 'st_email_partner_package_number_expired' );
}
/* End email.... */

/* 2.0.3 Email template for customer to notificate departure date */
if( !function_exists('st_email_order_customer_name') ){
    function st_email_order_customer_name(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        if($data){
            $post_id = $data->wc_order_id;
            if ($post_id) {
                $name = get_post_meta($post_id, 'st_first_name', true);
                if (!empty($name)) {
                    $name .= " " . get_post_meta($post_id, 'st_last_name', true);
                }
                if (!$name) {
                    $name = get_post_meta($post_id, 'st_name', true);

                }
                if (!$name) {
                    $name = get_post_meta($post_id, 'st_email', true);
                }
                if (!$name) {
                    $name = get_post_meta($post_id, '_billing_first_name', true);
                    $name .= " " . get_post_meta($post_id, '_billing_last_name', true);
                }
                return esc_html($name);
            }
        }
        return '';
    }
    st_reg_shortcode( 'st_email_order_customer_name' , 'st_email_order_customer_name' );
}

if( !function_exists('st_email_order_booking_id') ){
    function st_email_order_booking_id(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        if($data){
            return '#' . $data->wc_order_id;
        }
        return '';
    }
    st_reg_shortcode( 'st_email_order_booking_id' , 'st_email_order_booking_id' );
}

if( !function_exists('st_email_order_service_name') ){
    function st_email_order_service_name(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        $item_id = $data->st_booking_id;
        if ($item_id) {
            if ($item_id) {
                return "<a href='" . get_the_permalink($item_id) . "' target='_blank'>" . get_the_title($item_id) . "</a>";
            }
        }
        return '';
    }
    st_reg_shortcode( 'st_email_order_service_name' , 'st_email_order_service_name' );
}

if( !function_exists('st_email_order_create_date') ){
    function st_email_order_create_date(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        $format = TravelHelper::getDateFormat();
        return date_i18n($format, strtotime($data->created));
    }
    st_reg_shortcode( 'st_email_order_create_date' , 'st_email_order_create_date' );
}

if( !function_exists('st_email_order_departure_date') ){
    function st_email_order_departure_date(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        $format = TravelHelper::getDateFormat();
        $date = $data->check_in;
        if($date){
            $format = TravelHelper::getDateFormat();
            return date($format, strtotime($date));
        }
        return '';
    }
    st_reg_shortcode( 'st_email_order_departure_date' , 'st_email_order_departure_date' );
}

if( !function_exists('st_email_order_countdown_day') ){
    function st_email_order_countdown_day(){
        global $st_order_id;
        $data = STUser_f::get_history_bookings_by_id($st_order_id);
        $date_now = date('Y-m-d');
        $expiration = date('Y-m-d', strtotime($data->check_in));
        $date_diff = STDate::dateDiff($date_now, $expiration);
        return $date_diff;
    }
    st_reg_shortcode( 'st_email_order_countdown_day' , 'st_email_order_countdown_day' );
}
/* End email */

if( !function_exists('get_email_has_refund_template')){
    function get_email_has_refund_template(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-bottom: 20px; font-size: 20px;"><strong style="font-size: 30px;">Hello Administrator</strong>,</td>
            </tr>
            <tr>
            <td><span style="text-decoration: underline;">You have a request for cancel booking. Below are the details:</span></td>
            </tr>
            <tr>
            <td colspan="2" style="padding-top: 30px;">
            [st_email_has_refund]
</td>
</tr>
            </tbody>
            </table>
            
           <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}
if( !function_exists('get_email_has_refund_for_partner_template')){
    function get_email_has_refund_for_partner_template(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-bottom: 20px; font-size: 20px;"><strong style="font-size: 30px;">Hello Partner</strong>,</td>
            </tr>
            <tr>
            <td><span style="text-decoration: underline;">You have a request for cancel booking. Below are the details:</span></td>
            </tr>
            <tr>
            <td colspan="2" style="padding-top: 30px;">
            [st_email_has_refund_for_partner]
</td>
</tr>
            </tbody>
            </table>
            
            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}
if( !function_exists('get_email_cancel_booking_success_template')){
    function get_email_cancel_booking_success_template(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-bottom: 20px; font-size: 20px;"><strong style="font-size: 30px;">Hello [st_email_cancel_booking_username]</strong>,</td>
            </tr>
            <tr>
            <td><span style="text-decoration: underline;">Admin have completed your cancel booking. You can see the detail below:</span></td>
            </tr>
           <tr>
           <td style="padding-top: 40px;" colspan="2">[st_email_cancel_booking_success]</td>
</tr>
            </tbody>
            </table>
            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}
if( !function_exists('get_email_cancel_booking_success_for_partner_template')){
    function get_email_cancel_booking_success_for_partner_template(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
            <table id="" class="wrapper" style="padding-top: 50px;padding-bottom: 50px; padding-left: 25px; padding-right: 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding-bottom: 20px; font-size: 20px;"><strong style="font-size: 24px;">Hello Partner</strong>,</td>
            </tr>
            <tr>
            <td><span style="text-decoration: underline;">Admin have completed cancel booking of your customer . You can see the detail below:</span></td>
            </tr>
            <tr>
           <td style="padding-top: 40px;" colspan="2">[st_email_cancel_booking_success]</td>
</tr>
            </tbody>
            </table>
            
            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}
if(!function_exists('st_default_email_template_for_admin_partner')){
    function st_default_email_template_for_admin_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
        return '
           <div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" width="90%" cellspacing="0" align="center"  style=" padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" >
            <tbody>
            <tr>


            <td style="padding-bottom: 0px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,
            </td>
            </tr>
            <tr>
            <td>
                [st_is_partner_register]Have a new user register as <strong style="color:#5191FA">Partner</strong>. Please check info below:[/st_is_partner_register]
                [st_is_partner_update]Have a new user update certificates as <strong style="color:#5191FA">Partner</strong>. Please check info below:[/st_is_partner_update]
            </td>
            </tr>
            <tr>
            <td style="padding-top: 20px; font-size: 30px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 28px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_info_user]" target="_blank"  style="
                        background-color: #666;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
                  <a href="[st_url_list_user_partner]" target="_blank"  style="
                  background-color: #5192FA;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    VIEW ALL REQUEST
                 </a>

            </td>
            </tr>

            </tbody>
            </table>

           <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_default_email_register_user_normal_template_for_admin')){
    function st_default_email_register_user_normal_template_for_admin(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
        return '
           <div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,
            </td>
            </tr>
            <tr>
            <td>
               Have a new user register as <strong style="color:#5192FA">Normal</strong>. Please check info below:
            </td>
            </tr>
            <tr>
            <td style="padding-top: 40px; font-size: 30px; font-weight: 600;">
                User Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                </table>
            </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_info_user]" target="_blank"  style="
                        background-color: #5192FA;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
            </td>
            </tr>

            </tbody>
            </table>

            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_default_email_template_for_resend_admin_partner')){
    function st_default_email_template_for_resend_admin_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>


            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,


            </td>
            </tr>
            <tr>
            <td>
                [st_is_partner_register]Have one user register as partner has been updated information , please check for approve[/st_is_partner_register]
                [st_is_partner_update]Have one user partner update certificates has been updated information , please check for approve[/st_is_partner_update]
            </td>
            </tr>
            <tr>
            <td style="padding-top: 10px; font-size: 20px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 28px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_info_user]" target="_blank" style="
                        background-color: #5192FA;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
            </td>
            </tr>

            </tbody>
            </table>

           <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}

if(!function_exists('st_default_email_template_for_customer_partner')){
    function st_default_email_template_for_customer_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>


             <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>
                Thank you for your registing as <strong style="color:#5192FA">Partner</strong>. Please check info below:
            </td>
            </tr>
            <tr>
            <td style="padding-top: 40px; font-size: 30px; font-weight: 600;">
                Partner Information
            </td>
            </tr>

            <tr>
            <td style="padding-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; color:#666" border="1">
                    <tr>
                        <td style="padding: 20px 30px;">
                        Full Name:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ;border-color:#000">
                        [st_info_full_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Username:
                        </td>
                        <td style="padding: 20px 30px; color:#5191FA ">
                        [st_info_user_name]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Email:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_email]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px;">
                        Register Date:
                        </td>
                        <td style="padding: 20px 30px; ">
                        [st_info_user_date_create]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 30px; position: relative;">
                            <span  style="position: absolute; top: 20px;" >Services Registration:</span>
                        </td>
                        <td style="padding: 20px 30px; ">
                             [st_info_user_certificates]
                        </td>
                    </tr>
                </table>
            </td>

            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                 Please wait until the administrator <strong>approved</strong> your account !

            </td>
            </tr>

            </tbody>
            </table>

           <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}


if(!function_exists('st_default_email_template_for_customer_approved_partner')){
    function st_default_email_template_for_customer_approved_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';
        return '
            <div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>

                [st_is_partner_register]Congraturation! Your account ready approved as Partner. You can upload content as service register[/st_is_partner_register]
                [st_is_partner_update]Your new certificate approved. You can add new item for your content[/st_is_partner_update]


            </td>
            </tr>



            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                <a href="#">
                     IF YOU NEED ANY HELP PLEASE CONTACT WITH US HERE
                </a>
            </td>
            </tr>
             <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; ;">
                 <a href="[st_url_partner_dashboard]" target="_blank" style="
                        background-color: #5192FA;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 30px;
    text-decoration: none;" >
                    STARTING NOW
                 </a>


            </td>
            </tr>

            </tbody>
            </table>

           <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}

if(!function_exists('st_default_email_template_for_customer_cancel_partner')){
    function st_default_email_template_for_customer_cancel_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,


            </td>
            </tr>
            <tr>
            <td>

                [st_is_partner_register]Sorry! Your account is <strong>not</strong> ready approved as Partner. You should update your information again for match with our requirement[/st_is_partner_register]
                [st_is_partner_update]Sorry! Certificates for service that you have updated invalid to approved[/st_is_partner_update]



            </td>
            </tr>
            <tr>
            <td  style="padding-bottom: 20px; padding-top: 19px; font-size: 16px;">
                <a href="#">
                     IF YOU NEED ANY HELP PLEASE CONTACT WITH US HERE
                </a>
            </td>
            </tr>
             <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; ;">
                  <a href="[st_url_update_certificates]" target="_blank" style="
                        background-color: #5192FA;
    border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 30px;
    text-decoration: none;" >
                    UPDATE NOW
                 </a>


            </td>
            </tr>

            </tbody>
            </table>

          <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}

if(!function_exists('st_default_admin_new_request_withdrawal')){
    function st_default_admin_new_request_withdrawal(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,
            </td>
            </tr>
            <tr>
            <td>
                Today <strong>[st_info_full_name]</strong> has been withdrawal <strong>[st_partner_amount]</strong> via <strong>[st_partner_payment_method]</strong>

            </td>
            </tr>
            <tr>
                <td>
                    This info will be save and continue processing
                </td>
            </tr>

            <tr>
            <td  style="padding-bottom: 20px; font-size: 20px; padding-top: 50px; text-align: center;">
                 <a href="[st_url_admin_withdrawal]" target="_blank"  style=" background-color: #5192FA;border-radius: 5px;
    color: #fff;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    margin-left: 10px;
    padding: 10px 30px;
    text-decoration: none;" >
                    CHECK NOW
                 </a>
            </td>
            </tr>

            </tbody>
            </table>

            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_default_send_admin_approved_withdrawal')){
    function st_default_send_admin_approved_withdrawal(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">Administrator</strong>,
            </td>
            </tr>
            <tr>
            <td>
                Billing team had been processed payment to [st_info_full_name] total [st_partner_amount]
            </td>
            </tr>

            </tbody>
            </table>

            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}

if(!function_exists('st_default_send_user_approved_withdrawal')){
    function st_default_send_user_approved_withdrawal(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,
            </td>
            </tr>
            <tr>
            <td>

                We have processed your payout request with <strong>[st_partner_amount]</strong> via <strong>[st_partner_payment_method]</strong>


            </td>
            </tr>
            <tr>
            <td>

                Your amount was sent to <strong>[st_partner_payment_info]</strong>
            </td>
             </tr>
            <tr>
             <td>
             <br>
                Happy Spending!
            </td>
            </tr>

            </tbody>
            </table>

            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_default_send_user_new_request_withdrawal')){
    function st_default_send_user_new_request_withdrawal(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,
            </td>
            </tr>
            <tr>
            <td>
                We just letting you know that we got your request to payout <strong>[st_partner_amount]</strong> via <strong>[st_partner_payment_method]</strong> to <strong>[st_partner_payment_info]</strong>
                <br>
            </td>
            </tr>
            <tr>
            <td>
                 You can cancel this request any time before [st_date_payout_this_month] here :
                  <br>
            </td>
             </tr>
             <tr>
            <td>
                 We will complete this request on the [st_date_payout_this_month] , but it can take up to 7 days to appear in your account. A second confirmation email will be sent at this time.
                  <br>
                  Regards

            </td>
             </tr>

            </tbody>
            </table>

            <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_default_send_user_cancel_withdrawal')){
    function st_default_send_user_cancel_withdrawal(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
            <tbody>
            <tr>


            <td style="padding-bottom: 20px; font-size: 20px;">
            Hello <strong style="font-size: 25px;">[st_info_full_name]</strong>,
            </td>
            </tr>

             <tr>
            <td>

                 Request your Payment Failed due to: <br>
                 [st_content_message_cancel]
                  <br>
                  Regards

            </td>
             </tr>

            </tbody>
            </table>

             <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>
        ';
    }
}
if(!function_exists('st_email_member_packages_admin')){
    function st_email_member_packages_admin(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
        <tbody>
        <tr>
        <td style="padding-bottom: 20px; font-size: 20px;">Hello <strong style="font-size: 25px;">Administrator</strong>,</td>
        </tr>
        <tr>
        <td><span id="result_box" class="short_text" lang="en">There is a membership package <span class="">should be verified:</span></span>
        <h4 style="margin-top: 20px;">Membership Package Infomation:</h4>
        </td>
        </tr>
        <tr>
        <td>
        <table style="margin-top: 10px; width: 100%; border: 1px solid #CCC; border-collapse: collapse; border-spacing: 0;">
        <tbody>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Membership Package</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_name]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Price</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_price]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Time Available</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_time]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Commission</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_commission]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">No. Items can upload</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_upload]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">No. Items can set featured</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_featured]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Descriptions</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_description]</td>
        </tr>
        </tbody>
        </table>
        <h4 style="margin-top: 20px;">Partner Infomation:</h4>
        <table style="margin-top: 10px; width: 100%; border: 1px solid #CCC; border-collapse: collapse; border-spacing: 0;">
        <tbody>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Fullname</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_name]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Email</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_email]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Phone</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_phone]</td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
         <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}

if(!function_exists('st_email_member_packages_partner')){
    function st_email_member_packages_partner(){
        $logo = st()->get_option('logo_new',get_template_directory_uri().'/img/traveler_logo_white.png');
        if(empty($logo)){
            $logo = st()->get_option('logo',get_template_directory_uri().'/img/traveler_logo_white.png');
        }
        $social_icon = '
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6292" src="'.get_template_directory_uri().'/img/email/social/social-f.png" alt="eb_face" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6296" src="'.get_template_directory_uri().'/img/email/social/social-t.png" alt="" width="35" height="35" /></a>
            <a style="margin: 10px;display: inline-block;" href="'.site_url().'"><img class="alignnone wp-image-6295" src="'.get_template_directory_uri().'/img/email/social/social-ins.png" alt="" width="35" height="35" /></a>
            ';

        return '<div style="background: #dfdfdf; padding: 30px 50px;"><table id="booking-infomation" class="wrapper" style="width: 1000px; font-family: Poppins, sans-serif !important;" width="90%" cellspacing="0" align="center">
            <tbody>
            <tr>
            <td style="padding: 30px 25px; background: #5192FA;" width="20%"><a href="'. site_url().'"> <img class="alignnone wp-image-7442 size-full" src="'. $logo .'" alt="logo" width="110" height="40" /> </a></td>
            <td style="background: #5192FA none repeat scroll 0 0; color: #fff; font-size: 17px; padding: 30px 45px; text-align: right;" width="80%"><a style="color: #fff; padding-left: 12px; text-decoration: none;" href="#">Hotel</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Rental</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Car</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Tour</a> <a style="color: #fff; padding-left: 20px; text-decoration: none;" href="#">Activity</a></td>
            </tr>
            </tbody>
            </table>
			
			
            <table id="" class="wrapper" style="padding: 50px 25px; width: 1000px; color: #666;font-family: Poppins, sans-serif !important; background: #fff" width="90%;" cellspacing="0" align="center">
        <tbody>
        <tr>
        <td style="padding-bottom: 20px; font-size: 20px;">Hello <strong style="font-size: 25px;">[st_email_package_partner_name]</strong>,</td>
        </tr>
        <tr>
        <td><span id="result_box" class="short_text" lang="en">You have registed a member package. There are your infomation below:</span>
        <h4 style="margin-top: 20px;">Membership Package Infomation:</h4>
        </td>
        </tr>
        <tr>
        <td>
        <table style="margin-top: 10px; width: 100%; border: 1px solid #CCC; border-collapse: collapse; border-spacing: 0;">
        <tbody>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Membership Package</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_name]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Price</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_price]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Time Available</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_time]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Commission</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_commission]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">No. Items can upload</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_upload]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">No. Items can set featured</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_featured]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Descriptions</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_description]</td>
        </tr>
        </tbody>
        </table>
        <h4 style="margin-top: 20px;">Partner Infomation:</h4>
        <table style="margin-top: 10px; width: 100%; border: 1px solid #CCC; border-collapse: collapse; border-spacing: 0;">
        <tbody>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Fullname</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_name]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Email</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_email]</td>
        </tr>
        <tr>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">Phone</td>
        <td style="border: 1px solid #CCC; padding: 15px 20px;">[st_email_package_partner_phone]</td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table style="color: #818181; width: 1000px;font-family: Poppins, sans-serif !important;" width="100%" cellspacing="0" align="center">
            <tbody>
            <tr style="background: #F5F5F5;">
                <td style="width: 60%;padding: 25px;">
    <span style="margin-bottom: 13px;display: inline-block;line-height: 23px;font-size: 15px;">Booking, reviews and advices on hotels, resorts, flights,<br />vacation rentals, travel packages, and lots more!</span><br />
    <a href="#" style="color: #333; text-decoration: none">About Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">Contact Us</a><span style="position: relative; top: -1px; font-size: 15px;"> &nbsp;|&nbsp; </span>
    <a href="#" style="color: #333; text-decoration: none">News</a>            
    </td>
                <td style="width: 60%;padding: 25px; text-align: right">
                '. $social_icon .'
</td>
            </tr>
            </tbody>
            </table></div>';
    }
}



if(!function_exists( 'st_email_booking_guest_name' )) {
    function st_email_booking_guest_name(){
        global $order_id;
        if($order_id){
            $guest_name = get_post_meta($order_id,'guest_name',true);
            $guest_title = get_post_meta($order_id,'guest_title',true);

            if(!empty($guest_name) and is_array($guest_name)){
                ob_start();
                ?>
                <table style="margin-left: -3px;">
                        <tr>
                            <td style="padding-top: 10px;">
                                <strong><?php esc_html_e("Guest Name",ST_TEXTDOMAIN) ?>: </strong>
                            </td>
                            <td style="padding-top: 10px;" colspan="2">
                                <span style="text-decoration: underline;">
                                    <?php
                                    $html = [];
                                    foreach ($guest_name as $k=>$name){
                                        $str = isset($guest_title[$k])?st_guest_title_to_text($guest_title[$k]).' ':'';
                                        $str.=$name;
                                        $html[] = $str;
                                    }
                                    echo implode(', ',$html);
                                    ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                <?php

                return ob_get_clean();
            }
        }
        return '';
    }
}
st_reg_shortcode( 'st_email_booking_guest_name' , 'st_email_booking_guest_name' );