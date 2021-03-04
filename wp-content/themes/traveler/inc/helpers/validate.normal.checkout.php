<?php 
/**
*@since 1.1.8
**/
if(!class_exists('ValidateNormalCheckout')){
	class ValidateNormalCheckout{
		public function __construct(){

			
		}
		static function get_cart_data($cart,$post_type){
			$data = array();
			if($post_type == 'st_hotel'){
				foreach($cart as $key => $val){
					if($val['data']['st_booking_post_type'] == 'st_hotel'){
						$data= array(
							'room_id' => $val['data']['room_id'],
							'check_in' => strtotime($val['data']['check_in']),
							'check_out' => strtotime($val['data']['check_out']),
							'room_num_search' => $val['data']['room_num_search']
						);
					}
				}
			}
			if($post_type == 'hotel_room'){
				foreach($cart as $key => $val){
					if($val['data']['st_booking_post_type'] == 'hotel_room'){
						$data= array(
							'room_id' => $val['data']['room_id'],
							'check_in' => strtotime($val['data']['check_in']),
							'check_out' => strtotime($val['data']['check_out']),
							'room_num_search' => $val['data']['room_num_search']
						);
					}
				}
			}

			if($post_type == 'st_rental'){
				foreach($cart as $key => $val){
					if($val['data']['st_booking_post_type'] == 'st_rental'){
						$data = array(
							'rental_id' => $key,
							'check_in' => strtotime($val['data']['check_in']),
							'check_out' => strtotime($val['data']['check_out'])
						);
					}
				}
			}

			return $data;
		}

		static function _validate_cart_hotel($data){
			if(is_array($data) && count($data)){
				$room_id = $data['room_id'];
				$hotel_id = get_post_meta($room_id,'room_parent', true);

				$allow_full_day = get_post_meta($hotel_id, 'allow_full_day', true);
				if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

				$result = ValidateWooCheckout::_get_order_hotel($data['room_id'], $data['check_in'], $data['check_out']);
				
				$total_room = intval(get_post_meta($data['room_id'], 'number_room', true));
				if($total_room <= 0) $total_room = 0;
				for($i = $data['check_in']; $i <= $data['check_out']; $i = strtotime('+1 day', $i)){
					$number_room = 0;
					$number_room_cart = intval($data['room_num_search']);
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
						if($number_room_cart + $number_room > $total_room){
							$free_room = $total_room - $number_room;

							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['room_id']), $free_room, date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}else{
						if($number_room_cart > $total_room){
							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['room_id']), ($total_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}
				}
			}	
			return true;

		}

		static function _validate_cart_hotel_room($data){
			if(is_array($data) && count($data)){
				$room_id = $data['room_id'];

				$allow_full_day = get_post_meta($room_id, 'allow_full_day', true);
				if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

				$result = ValidateWooCheckout::_get_order_hotel_room($data['room_id'], $data['check_in'], $data['check_out']);

				$total_room = intval(get_post_meta($data['room_id'], 'number_room', true));
				if($total_room <= 0) $total_room = 0;
				for($i = $data['check_in']; $i <= $data['check_out']; $i = strtotime('+1 day', $i)){
					$number_room = 0;
					$number_room_cart = intval($data['room_num_search']);
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
						if($number_room_cart + $number_room > $total_room){
							$free_room = $total_room - $number_room;

							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('The <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['room_id']), $free_room, date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}else{
						if($number_room_cart > $total_room){
							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> room has only %s room(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['room_id']), ($total_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}
				}
			}
			return true;
		}

		static function _validate_cart_rental($data){
			if(is_array($data) && count($data)){
				$result = ValidateWooCheckout::_get_order_rental($data['rental_id'], $data['check_in'], $data['check_out']);
				$total_rental = intval(get_post_meta($data['rental_id'], 'rental_number', true));

				$allow_full_day = get_post_meta($data['rental_id'], 'allow_full_day', true);
				if(!$allow_full_day || $allow_full_day == '') $allow_full_day = 'on';

				if($total_rental <= 0) $total_rental = 0;
				for($i = $data['check_in']; $i <= $data['check_out']; $i = strtotime('+1 day', $i)){
					$number_room = 0;
					$number_room_cart = 1;
					if(is_array($result) && count($result)){
						foreach($result as $item){
							/*if($i >= intval($item['check_in_timestamp']) && $i <= intval($item['check_out_timestamp'])){
								$number_room += 1;
							}*/
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
						if($number_room_cart + $number_room > $total_rental){
							$free_room = $total_rental - $number_room;
							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> rental has only %s rental(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['rental_id']), ($free_room), date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}else{
						if($number_room_cart > $total_rental){
							$_SESSION['flash_validate_checkout'] = '<p class="bg-danger" style="padding: 10px 5px">'.sprintf(__('This <b>%s</b> rental has only %s rental(s) available on <b>%s</b>.',ST_TEXTDOMAIN), get_the_title($data['rental_id']), ($total_rental), date(TravelHelper::getDateFormat(),$i)).'</p>';
							return false;
						}
					}
				}
			}
			return true;
		}
	}

	new ValidateNormalCheckout();
}