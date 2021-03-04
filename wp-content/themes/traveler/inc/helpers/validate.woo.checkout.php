<?php 
/**
*@since 1.1.8
**/
if(!class_exists('ValidateWooCheckout')){
	class ValidateWooCheckout{
		public function init(){

		}

		static function get_cart_data($cart, $post_type){
			$data = array();
			if($post_type == 'st_hotel' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'st_hotel'){

						$data[$val['st_booking_data']['room_id']]['date'][] = array(
							'check_in' => strtotime($val['st_booking_data']['check_in']),
							'check_out' => strtotime($val['st_booking_data']['check_out']),
						);
						if(!isset($data[$val['st_booking_data']['room_id']]['min']) && !isset($data[$val['st_booking_data']['room_id']]['max'])){
							$data[$val['st_booking_data']['room_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							$data[$val['st_booking_data']['room_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
						}else{
							if($data[$val['st_booking_data']['room_id']]['min'] > strtotime($val['st_booking_data']['check_in'])){
								$data[$val['st_booking_data']['room_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							}
							if($data[$val['st_booking_data']['room_id']]['max'] < strtotime($val['st_booking_data']['check_out'])){
								$data[$val['st_booking_data']['room_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
							}
						}
						$data[$val['st_booking_data']['room_id']]['room_num_search'][] = $val['st_booking_data']['room_num_search'];
					}
				}
			}
			if($post_type == 'hotel_room' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'hotel_room'){

						$data[$val['st_booking_data']['room_id']]['date'][] = array(
							'check_in' => strtotime($val['st_booking_data']['check_in']),
							'check_out' => strtotime($val['st_booking_data']['check_out']),
						);
						if(!isset($data[$val['st_booking_data']['room_id']]['min']) && !isset($data[$val['st_booking_data']['room_id']]['max'])){
							$data[$val['st_booking_data']['room_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							$data[$val['st_booking_data']['room_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
						}else{
							if($data[$val['st_booking_data']['room_id']]['min'] > strtotime($val['st_booking_data']['check_in'])){
								$data[$val['st_booking_data']['room_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							}
							if($data[$val['st_booking_data']['room_id']]['max'] < strtotime($val['st_booking_data']['check_out'])){
								$data[$val['st_booking_data']['room_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
							}
						}
						$data[$val['st_booking_data']['room_id']]['room_num_search'][] = $val['st_booking_data']['room_num_search'];
					}
				}
			}

			if($post_type == 'st_rental' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'st_rental'){

						$data[$val['st_booking_data']['st_booking_id']]['date'][] = array(
							'check_in' => strtotime($val['st_booking_data']['check_in']),
							'check_out' => strtotime($val['st_booking_data']['check_out'])
						);

						if(!isset($data[$val['st_booking_data']['st_booking_id']]['min']) && !isset($data[$val['st_booking_data']['st_booking_id']]['max'])){
							$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
						}else{
							if($data[$val['st_booking_data']['st_booking_id']]['min'] > strtotime($val['st_booking_data']['check_in'])){
								$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							}
							if($data[$val['st_booking_data']['st_booking_id']]['max'] < strtotime($val['st_booking_data']['check_out'])){
								$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
							}
						}
					}
				}
			}

			if($post_type == 'st_tours' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'st_tours'){
						$data[$val['st_booking_data']['st_booking_id']]['date'][] = array(
							'check_in' => strtotime($val['st_booking_data']['check_in']),
							'check_out' => strtotime($val['st_booking_data']['check_out']),
						);
						$data[$val['st_booking_data']['st_booking_id']]['type_tour'] = $val['st_booking_data']['type_tour'];
						$data[$val['st_booking_data']['st_booking_id']]['people'][] = intval($val['st_booking_data']['adult_number']) + intval($val['st_booking_data']['child_number']) + intval($val['st_booking_data']['infant_number']);
						if(!isset($data[$val['st_booking_data']['st_booking_id']]['min']) && !isset($data[$val['st_booking_data']['st_booking_id']]['max'])){
							$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
						}else{
							if($data[$val['st_booking_data']['st_booking_id']]['min'] > strtotime($val['st_booking_data']['check_in'])){
								$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							}
							if($data[$val['st_booking_data']['st_booking_id']]['max'] < strtotime($val['st_booking_data']['check_out'])){
								$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
							}
						}
					}
				}
			}

			if($post_type == 'st_activity' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'st_activity'){
						$data[$val['st_booking_data']['st_booking_id']]['date'][] = array(
							'check_in' => strtotime($val['st_booking_data']['check_in']),
							'check_out' => strtotime($val['st_booking_data']['check_out']),
						);
						$data[$val['st_booking_data']['st_booking_id']]['type_activity'] = $val['st_booking_data']['type_activity'];
						$data[$val['st_booking_data']['st_booking_id']]['people'][] = intval($val['st_booking_data']['adult_number']) + intval($val['st_booking_data']['child_number']) + intval($val['st_booking_data']['infant_number']);
						if(!isset($data[$val['st_booking_data']['st_booking_id']]['min']) && !isset($data[$val['st_booking_data']['st_booking_id']]['max'])){
							$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
						}else{
							if($data[$val['st_booking_data']['st_booking_id']]['min'] > strtotime($val['st_booking_data']['check_in'])){
								$data[$val['st_booking_data']['st_booking_id']]['min'] = strtotime($val['st_booking_data']['check_in']);
							}
							if($data[$val['st_booking_data']['st_booking_id']]['max'] < strtotime($val['st_booking_data']['check_out'])){
								$data[$val['st_booking_data']['st_booking_id']]['max'] = strtotime($val['st_booking_data']['check_out']);
							}
						}
					}
				}
			}

			if($post_type == 'st_cars' && count($cart)){
				foreach($cart as $key => $val){
					if($val['st_booking_data']['st_booking_post_type'] == 'st_cars'){
						$data[$val['st_booking_data']['st_booking_id']]['date'][] = array(
							'check_in' => $val['st_booking_data']['check_in_timestamp'],
							'check_out' => $val['st_booking_data']['check_out_timestamp'],
						);
						if(!isset($data[$val['st_booking_data']['st_booking_id']]['min']) && !isset($data[$val['st_booking_data']['st_booking_id']]['max'])){
							$data[$val['st_booking_data']['st_booking_id']]['min'] = $val['st_booking_data']['check_in_timestamp'];
							$data[$val['st_booking_data']['st_booking_id']]['max'] = $val['st_booking_data']['check_out_timestamp'];
						}else{
							if($data[$val['st_booking_data']['st_booking_id']]['min'] > $val['st_booking_data']['check_in_timestamp']){
								$data[$val['st_booking_data']['st_booking_id']]['min'] = $val['st_booking_data']['check_in_timestamp'];
							}
							if($data[$val['st_booking_data']['st_booking_id']]['max'] < $val['st_booking_data']['check_out_timestamp']){
								$data[$val['st_booking_data']['st_booking_id']]['max'] = $val['st_booking_data']['check_out_timestamp'];
							}
						}
					}
				}
			}

			return $data;
		}

		static function check_validate_hotel($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$room_id = $key;
					$hotel_id = get_post_meta($room_id,'room_parent', true);

					$allow_full_day = get_post_meta($hotel_id, 'allow_full_day', true);
					if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

					$total_room = intval(get_post_meta($key, 'number_room', true));
					if($total_room <= 0) $total_room = 0;

					$result = ValidateWooCheckout::_get_order_hotel($key, $val['min'], $val['max']);


					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$number_room = 0;
						$number_room_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($allow_full_day == 'on'){
									if($i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
										$number_room += $item['number_room'];
									}
								}else{
									if($i > intval($item['check_in_timestamp']) && $i < intval($item['check_out_timestamp'])){
										$number_room += $item['number_room'];
									}
								}
								
							}
							foreach($val['date'] as $key => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += $val['room_num_search'][$key];
								}
							}

							if($number_room_cart + $number_room > $total_room){
								$free_room = $total_room - $number_room;

								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($room_id), $free_room, date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}else{
							$number_room_cart = 0;
							foreach($val['date'] as $key => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += $val['room_num_search'][$key];
								}
							}
							
							if($number_room_cart > $total_room){
								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($room_id), ($total_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}
					}
				}
			}
			return true;
		}

		static function check_validate_hotel_room($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$room_id = $key;


					$allow_full_day = get_post_meta($room_id, 'allow_full_day', true);
					if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

					$total_room = intval(get_post_meta($key, 'number_room', true));
					if($total_room <= 0) $total_room = 0;

					$result = ValidateWooCheckout::_get_order_hotel_room($key, $val['min'], $val['max']);

					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$number_room = 0;
						$number_room_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($allow_full_day == 'on'){
									if($i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
										$number_room += $item['number_room'];
									}
								}else{
									if($i > intval($item['check_in_timestamp']) && $i < intval($item['check_out_timestamp'])){
										$number_room += $item['number_room'];
									}
								}

							}
							foreach($val['date'] as $key => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += $val['room_num_search'][$key];
								}
							}

							if($number_room_cart + $number_room > $total_room){
								$free_room = $total_room - $number_room;

								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($room_id), $free_room, date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}else{
							$number_room_cart = 0;
							foreach($val['date'] as $key => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += $val['room_num_search'][$key];
								}
							}

							if($number_room_cart > $total_room){
								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($room_id), ($total_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}
					}
				}
			}
			return true;
		}

		static function _get_order_hotel($room_id, $check_in, $check_out){
			global $wpdb;
			
			$sql = "SELECT
			room_id,
			check_in_timestamp,
			check_out_timestamp,
			room_num_search as number_room
			FROM
				{$wpdb->prefix}st_order_item_meta
			WHERE
				st_booking_post_type = 'st_hotel'
			AND room_id = '{$room_id}'	
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";

			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}
		static function _get_order_hotel_room($room_id, $check_in, $check_out){
			global $wpdb;

			$sql = "SELECT
			room_id,
			check_in_timestamp,
			check_out_timestamp,
			room_num_search as number_room
			FROM
				{$wpdb->prefix}st_order_item_meta
			WHERE
				st_booking_post_type = 'hotel_room' AND room_id = '{$room_id}'
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";


			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}

		static function check_validate_rental($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$rental_id = $key;
					$total_room = intval(get_post_meta($key, 'rental_number', true));
					if($total_room <= 0) $total_room = 0;

					$result = self::_get_order_rental($key, $val['min'], $val['max']);

					$allow_full_day = get_post_meta($rental_id, 'allow_full_day', true);
					if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$number_room = 0;
						$number_room_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($allow_full_day == 'on'){
									if($i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
										$number_room += 1;
									}
								}else{
									if($i > intval($item['check_in_timestamp']) && $i < intval($item['check_out_timestamp'])){
										$number_room += 1;
									}
								}

							}
							foreach($val['date'] as $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += 1;
								}
							}

							if($number_room_cart + $number_room > $total_room){
								$free_room = $total_room - $number_room;

								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> rental has only %s rental(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($rental_id), $free_room, date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}else{
							$number_room_cart = 0;
							foreach($val['date'] as $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_room_cart += 1;
								}
							}
							if($number_room_cart > $total_room){
								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> rental has only %s rental(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($rental_id), ($total_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}
					}
				}
			}
			return true;
		}

		static function _get_order_rental($rental_id, $check_in, $check_out){
			global $wpdb;
			
			$sql = "SELECT
			room_id,
			check_in_timestamp,
			check_out_timestamp,
			room_num_search as number_room
			FROM
				{$wpdb->prefix}st_order_item_meta
			WHERE
				st_booking_post_type = 'st_rental'
			AND st_booking_id = '{$rental_id}'	
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";
			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}

		static function check_validate_tour($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$tour_id = $key;
					$max_people = intval(get_post_meta($tour_id, 'max_people', true));
					if($max_people <= 0) $max_people = 0;

					$result = self::_get_order_tours($key, $val['min'], $val['max'], $val['type_tour']);
					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$people = 0;
						$people_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($val['type_tour'] == 'specific_date' && $i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
									$people += intval($item['people']);
								}
								if($val['type_tour'] == 'daily_tour' && $i == intval($item['check_in_timestamp'])){
									$people += intval($item['people']);
								}
							}
							foreach($val['date'] as $k => $date){
								if($val['type_tour'] == 'specific_date' && $i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$people_cart += intval($val['people'][$k]);
								}
								if($val['type_tour'] == 'daily_tour' && $i == intval($date['check_in'])){
									$people_cart += intval($val['people'][$k]);
								}
							}

							if( $max_people > 0 ){
								if($people_cart + $people > $max_people){
									$free_people = $max_people - $people;

									$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> tour has only %s people available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($tour_id), $free_people, date(TravelHelper::getDateFormat(),$i)).'</p>';
									return false;
								}
							}
							
						}else{
							$people_cart = 0;
							foreach($val['date'] as $k => $date){
								if($val['type_tour'] == 'specific_date' && $i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$people_cart += intval($val['people'][$k]);
								}
								if($val['type_tour'] == 'daily_tour' && $i == intval($date['check_in'])){
									$people_cart += intval($val['people'][$k]);
								}
							}

							if( $max_people > 0 ){
								if($people_cart > $max_people){
									$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> tour has only %s people available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($tour_id), ($max_people), date(TravelHelper::getDateFormat(),$i)).'</p>';
									return false;
								}
							}
							
						} 

					}
				}
			}
			return true;
		}


		static function _get_order_tours($tour_id, $check_in, $check_out, $tour_type = 'daily_tour'){
			global $wpdb;

			$sql = "SELECT
			check_in_timestamp,
			check_out_timestamp,
			adult_number + child_number + infant_number as people
			FROM
				{$wpdb->prefix}st_order_item_meta
			INNER JOIN {$wpdb->prefix}st_tours AS mt ON mt.post_id = st_booking_id
			WHERE mt.type_tour = '{$tour_type}'
			AND
				st_booking_post_type = 'st_tours'
			AND st_booking_id = '{$tour_id}'	
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";
			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}

		static function check_validate_activity($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$activity_id = $key;
					$max_people = intval(get_post_meta($activity_id, 'max_people', true));
					if($max_people <= 0) $max_people = 0;

					$result = self::_get_order_activity($key, $val['min'], $val['max'], $val['type_activity']);
					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$people = 0;
						$people_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($val['type_activity'] == 'specific_date' && $i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
									$people += intval($item['people']);
								}
								if($val['type_activity'] == 'daily_activity' && $i == intval($item['check_in_timestamp'])){
									$people += intval($item['people']);
								}
							}
							foreach($val['date'] as $k => $date){
								if($val['type_activity'] == 'specific_date' && $i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$people_cart += intval($val['people'][$k]);
								}
								if($val['type_activity'] == 'daily_activity' && $i == intval($date['check_in'])){
									$people_cart += intval($val['people'][$k]);
								}
							}
							if($people_cart + $people > $max_people){
								$free_people = $max_people - $people;

								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> activity has only %s people(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($activity_id), $free_people, date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}else{
							$people_cart = 0;
							foreach($val['date'] as $k => $date){
								if($val['type_activity'] == 'specific_date' && $i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$people_cart += intval($val['people'][$k]);
								}
								if($val['type_activity'] == 'daily_activity' && $i == intval($date['check_in'])){
									$people_cart += intval($val['people'][$k]);
								}
							}
                            if( $max_people > 0 ){
                                if($people_cart > $max_people){
                                    $_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> activity has only %s people(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($activity_id), ($max_people), date(TravelHelper::getDateFormat(),$i)).'</p>';
                                    return false;
                                }
                            }
						} 

					}
				}
			}
			return true;
		}


		static function _get_order_activity($activity_id, $check_in, $check_out, $activity_type = 'daily_tactivity'){
			global $wpdb;

			$sql = "SELECT
			check_in_timestamp,
			check_out_timestamp,
			adult_number + child_number + infant_number as people
			FROM
				{$wpdb->prefix}st_order_item_meta
			INNER JOIN {$wpdb->prefix}st_activity AS mt ON mt.post_id = st_booking_id
			WHERE mt.type_activity = '{$activity_type}'
			AND
				st_booking_post_type = 'st_activity'
			AND st_booking_id = '{$activity_id}'	
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";
			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}

		static function check_validate_car($data){
			if(is_array($data) && count($data)){
				foreach($data as $key => $val){
					$car_id = $key;
					$max_car = intval(get_post_meta($car_id, 'number_car', true));
					if($max_car <= 0) $max_car = 0;

					$result = self::_get_order_car($key, $val['min'], $val['max']);
					for($i = intval($val['min']); $i <= intval($val['max']); $i = strtotime('+1 day', $i) ){
						$number_car = 0;
						$number_car_cart = 0;
						if(is_array($result) && count($result)){
							foreach($result as $item){
								if($i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
									$number_car += 1;
								}
							}
							foreach($val['date'] as $k => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_car_cart += 1;
								}
							}
							if($number_car_cart + $number_car > $max_car){
								$free_car = $max_car - $number_car;

								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> car has only %s item(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($car_id), $free_car, date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						}else{
							$number_car_cart = 0;
							foreach($val['date'] as $k => $date){
								if($i >= intval($date['check_in']) && $i <= intval($date['check_out'])){
									$number_car_cart += 1;
								}
							}
							if($number_car_cart > $max_car){
								$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> car has only %s item(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($car_id), ($max_car), date(TravelHelper::getDateFormat(),$i)).'</p>';
								return false;
							}
						} 

					}
				}
			}
			return true;
		}

		static function _get_order_car($car_id, $check_in, $check_out){
			global $wpdb;

			$sql = "SELECT
			check_in_timestamp,
			check_out_timestamp
			FROM
				{$wpdb->prefix}st_order_item_meta
			INNER JOIN {$wpdb->prefix}st_cars AS mt ON mt.post_id = st_booking_id
			WHERE
				st_booking_post_type = 'st_cars'
			AND st_booking_id = '{$car_id}'	
			AND (
				(
					{$check_in} < check_in_timestamp AND
					{$check_out} > check_out_timestamp
				)
				OR (
					{$check_in} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
				OR (
					{$check_out} BETWEEN check_in_timestamp
					AND check_out_timestamp
				)
			)
			AND status NOT IN ('trash', 'canceled')";
			$result = $wpdb->get_results($sql, ARRAY_A);

			return $result;
		}

	}
	$validateWoocheckout = new ValidateWooCheckout();
	$validateWoocheckout->init();
}
?>