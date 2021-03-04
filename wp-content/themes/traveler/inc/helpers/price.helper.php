<?php
if(!class_exists('STPrice')){
    class STPrice{
        public function __construct(){

        }
        static function checkIncludeTax(){
            if(st()->get_option('tax_enable','off') == 'on' && st()->get_option('st_tax_include_enable', 'off') == 'off'){
                return false;
            }
            if(st()->get_option('tax_enable','off') == 'on' && st()->get_option('st_tax_include_enable', 'off') == 'on'){
                return true;
            }
            if(st()->get_option('tax_enable','off') == 'off'){
                return false;
            }
        }
        static function checkSale($post_id = ''){
            $post_id = intval($post_id);
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
            if($is_sale_schedule == 'on')
                return true;
            return false;
        }
        static function getTax(){
            if(st()->get_option('tax_enable','off') == 'on'){
                $tax = floatval(st()->get_option('tax_value',0));
                if($tax <= 0) $tax = 0;
                if($tax > 100) $tax = 100;
                return $tax;
            }
            return 0;
        }
        /**
         *@since 1.1.8
         *@param $price float
         **/
        static function getPriceWithTax($price = 0, $tax = false){
            $price = floatval($price);
            if($price < 0) $price = 0;
            if(!$tax){
                $tax = 0;
                if(st()->get_option('tax_enable','off') == 'on' && st()->get_option('st_tax_include_enable', 'off') == 'off'){

                    $tax = floatval(st()->get_option('tax_value',0));
                }
            }
            $price = $price + ($price / 100) * $tax;
            return $price;
        }

        /**
         *@since 1.1.8
         *	Only use for activity
         **/
        static function getPriceByPeople($activity_id = '', $check_in = '', $check_out = '', $adult_number = 0, $child_number = 0, $infant_number = 0){
            $total_price = 0;

            $activity_id = intval($activity_id);

            $groupday = STPrice::getGroupDay($check_in, $check_out);

            $adult_price = floatval(get_post_meta($activity_id, 'adult_price', true));
            if($adult_price < 0) $adult_price = 0;

            $child_price = floatval(get_post_meta($activity_id, 'child_price', true));
            if($child_price < 0) $child_price = 0;

            $infant_price = floatval(get_post_meta($activity_id, 'infant_price', true));
            if($infant_price < 0) $infant_price = 0;

            $discount_by_adult = get_post_meta($activity_id, 'discount_by_adult', true);
            $discount_by_child = get_post_meta($activity_id, 'discount_by_child', true);

            $total_adult_price = 0;
            if(is_array($discount_by_adult) && count($discount_by_adult)){
                $discount_by_adult = self::sortPricePeople($discount_by_adult);
                $people_ori = 0;
                foreach($discount_by_adult as $key => $val){
                    $people = intval($val['key']);
                    $price = floatval($val['value']);
                    while($adult_number - $people >= 0 && $people_ori != $people){
                        $adult_number -= $people;
                        $total_adult_price += ($adult_price - ($adult_price * ($price / 100))) * $people;
                    }
                    $people_ori = $people;
                }
            }
            if($adult_number > 0){
                for($i = 1; $i <= $adult_number; $i++)
                    $total_adult_price += $adult_price;
            }

            $total_child_price = 0;
            if(is_array($discount_by_child) && count($discount_by_child)){
                $discount_by_child = self::sortPricePeople($discount_by_child);
                $people_ori = 0;
                foreach($discount_by_child as $key => $val){
                    $people = intval($val['key']);
                    $price = floatval($val['value']);
                    while($child_number - $people >= 0 && $people_ori != $people){
                        $child_number -= $people;
                        $total_child_price += ($child_price - ($child_price * ($price / 100))) * $people;
                    }
                    $people_ori = $people;
                }
            }

            if($child_number > 0){
                for($i = 1; $i <= $child_number; $i++)
                    $total_child_price += $child_price;
            }
            
            $total_price = $total_adult_price + $total_child_price + ($infant_number * $infant_price);
            $data = array(
                'adult_price' => $total_adult_price,
                'child_price' => $total_child_price,
                'infant_price' => ($infant_number * $infant_price),
                'total_price' => $total_price
            );
            return $data;

        }
        /**
         *@since 1.1.9
         * use for tour
         **/
        static function getPeoplePrice($tour_id, $check_in, $check_out){
            $data_price = array(
                'adult_price' => 0,
                'child_price' => 0,
                'infant_price' => 0
            );
            $type = get_post_type($tour_id);
            if($type == 'st_tours'){
				$res = ST_Tour_Availability::inst()
					->where('post_id', $tour_id)
					->where('check_in', $check_in)
					->where('check_out', $check_out)
					->where('status', 'available')
					->get()->result();
            }elseif($type == 'st_activity'){
				$res =ST_Activity_Availability::inst()
					->where('post_id', $tour_id)
					->where('check_in', $check_in)
					->where('check_out', $check_out)
					->where('status', 'available')
					->get()->result();
            }

	        if(!empty($res)){
		        $data_price['adult_price'] = $res[0]['adult_price'];
		        $data_price['child_price'] = $res[0]['child_price'];
		        $data_price['infant_price'] = $res[0]['infant_price'];
	        }

            return $data_price;
        }
        
        static function getPriceByPeopleTour($tour_id = '', $check_in = '', $check_out = '', $adult_number = 0, $child_number = 0, $infant_number = 0){
            $tour_id = intval($tour_id);

            $post_type = get_post_type($tour_id);

            if($post_type == 'st_tours'){
                $tour_price_by = get_post_meta($tour_id, 'tour_price_by', true);
                if($tour_price_by == 'person') {
                    $people_price = self::getPeoplePrice( $tour_id, $check_in, $check_out );
                    $adult_price  = $people_price['adult_price'];
                    $child_price  = $people_price['child_price'];
                    $infant_price = $people_price['infant_price'];
                }else{
                    $adult_price  = get_post_meta($tour_id, 'adult_price', true);
                    $child_price  = get_post_meta($tour_id, 'child_price', true);
                    $infant_price = get_post_meta($tour_id, 'infant_price', true);
                }
            }else{
                $people_price = self::getPeoplePrice($tour_id, $check_in, $check_out);
                $adult_price = $people_price['adult_price'];
                $child_price = $people_price['child_price'];
                $infant_price = $people_price['infant_price'];
            }
            
            if( $adult_price < 0 ) $adult_price = 0;
            if( $child_price < 0 ) $child_price = 0;
            if( $infant_price < 0 ) $infant_price = 0;

            $discount_by_adult = get_post_meta($tour_id, 'discount_by_adult', true);
            $discount_by_child = get_post_meta($tour_id, 'discount_by_child', true);
            $discount_type = get_post_meta( $tour_id, 'discount_by_people_type', true);
            if( !$discount_type) $discount_type = 'percent';
            $total_adult_price = 0;

            if(is_array($discount_by_adult) && count($discount_by_adult)){
                $discount_by_adult = self::sortPricePeople($discount_by_adult);
                foreach($discount_by_adult as $key => $val){
                    if(!empty($val['key'])){
                        $people_from = intval($val['key']);
                        $people_to = (isset($val['key_to'])) ? intval($val['key_to']) : $people_from;
                        $price = floatval($val['value']);
                        while(($adult_number >= $people_from && $adult_number <= $people_to || ($adult_number >= $people_to) ) && $people_from > 0 && $people_to > 0 && $people_from <= $people_to ){
                            $people = $adult_number;
                            if($adult_number >= $people_to){
                                $adult_number -= $people_to;
                                $people = $people_to;
                            }elseif($adult_number == $people_from){
                                $adult_number -= $people_from;
                                $people = $people_from;
                            }else{
                                $adult_number -= $adult_number;
                            }
                            switch ($discount_type) {
                                case 'amount':
                                    $total_adult_price += ($adult_price * $people) - $price ;
                                    break;
                                default:
                                    $total_adult_price += ($adult_price * $people) - ($adult_price * $people * $price / 100);
                                    break;
                            }
                        }
                    }
                }
            }

            if($adult_number > 0){
                for($i = 1; $i <= $adult_number; $i++)
                    $total_adult_price += $adult_price;
            }

            $total_child_price = 0;
            if(is_array($discount_by_child) && count($discount_by_child)){
                $discount_by_child = self::sortPricePeople($discount_by_child);
                foreach($discount_by_child as $key => $val){
                    if(!empty($val['key'])){
                        $people_from = intval($val['key']);
                        $people_to = (isset($val['key_to'])) ? intval($val['key_to']) : $people_from;
                        $price = floatval($val['value']);
                        while(($child_number >= $people_from && $child_number <= $people_to || ($child_number >= $people_to) ) && $people_from > 0 && $people_to > 0 && $people_from <= $people_to ){
                            $people = $child_number;
                            if($child_number >= $people_to){
                                $child_number -= $people_to;
                                $people = $people_to;
                            }elseif($child_number == $people_from){
                                $child_number -= $people_from;
                                $people = $people_from;
                            }else{
                                $child_number -= $child_number;
                            }
                            switch ($discount_type) {
                                case 'amount':
                                    $total_child_price += ($child_price  * $people) - $price;
                                    break;
                                
                                default:
                                    $total_child_price += ($child_price - ($child_price * ($price / 100))) * $people;
                                    break;
                            }
                        }
                    }
                }
            }
            $infant_price = (float) $infant_price;

            if($child_number > 0){
                for($i = 1; $i <= $child_number; $i++)
                    $total_child_price += $child_price;
            }
            $total_price = $total_adult_price + $total_child_price + ($infant_number * $infant_price);
            $data = array(
                'adult_price' => $total_adult_price,
                'child_price' => $total_child_price,
                'infant_price' => ($infant_number * $infant_price),
                'total_price' => $total_price
            );
            return $data;

        }

	    static function getFixedPrice($tour_id, $check_in, $check_out){
		    $data_price = array(
			    'base_price' => 0,
		    );

		    $res = ST_Tour_Availability::inst()
                       ->where('post_id', $tour_id)
                       ->where('check_in', $check_in)
                       ->where('check_out', $check_out)
                       ->where('status', 'available')
                       ->get()->result();
		    if(!empty($res)){
			    $data_price['base_price'] = $res[0]['price'];
		    }

		    return $data_price;
	    }

	    static function getPriceByFixedTour($tour_id = '', $check_in = '', $check_out = ''){
		    $total_price = 0;

		    $tour_id = intval($tour_id);

		    $fixed_price = self::getFixedPrice($tour_id, $check_in, $check_out);
		    if(!empty($fixed_price))
		        $total_price = $fixed_price['base_price'];

		    if( $total_price < 0 ) $total_price = 0;

		    $data = array(
			    'total_price' => $total_price
		    );
		    return $data;

	    }

        static function sortPricePeople($data = array()){
            usort($data, function($a, $b){
                if( $a['key'] == $b['key']){
                    return 0;
                }
                return ($a['key'] > $b['key']) ? -1 : 1;
            });
            return $data;
        }

        static function getSaleActivitySalePrice($post_id = '', $price = '', $tour_type = '', $check_in = ''){
            $total_price = 0;

            $price = floatval($price);
            if($tour_type == 'daily_tour' || $tour_type == 'daily_activity'){
                $check_in = $check_in;
            }else{
                $check_in = strtotime(date('Y-m-d'));
            }

            $discount_rate = floatval(get_post_meta($post_id,'discount',true));
            if($discount_rate < 0) $discount_rate = 0;
            if($discount_rate > 100) $discount_rate = 100;
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
            if($is_sale_schedule == 'on'){
                $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
                $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));

                if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
                    if($check_in >= $sale_from && $check_in <= $sale_to){
                        $total_price = $price - ($price * ($discount_rate / 100));
                    }else{
                        $total_price = $price;
                    }
                }
            }else{
                $total_price = $price - ($price * ($discount_rate / 100));
            }
            return $total_price;
        }
        static function get_discount_rate($post_id = '', $check_in = ''){
            $post_type = get_post_type($post_id);
            $discount_text = 'discount' ;
            if($post_type =='st_hotel' or $post_type =='st_rental' or $post_type =='hotel_room') $discount_text = 'discount_rate';
	        $tour_price_by = '';
            if($post_type == 'st_tours'){
	            $tour_price_by = get_post_meta($post_id, 'tour_price_by', true);
            }
            $discount_type = get_post_meta( $post_id, 'discount_type' , true );
            $discount_rate = floatval(get_post_meta($post_id,$discount_text,true));
            if($discount_rate < 0) $discount_rate = 0;
            if($discount_rate > 100 && $discount_type == 'percent') $discount_rate = 100;
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
            if($is_sale_schedule == 'on'){
            	if($post_type == 'st_tours'){
					if($tour_price_by != 'fixed_depart'){
						$sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
						$sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));
						if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
							if($check_in >= $sale_from && $check_in <= $sale_to){
								return $discount_rate ;
							}else {
								return 0 ;
							}
						}
					}
	            }else{
		            $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
		            $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));
		            if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
			            if($check_in >= $sale_from && $check_in <= $sale_to){
				            return $discount_rate ;
			            }else {
				            return 0 ;
			            }
		            }
	            }

            }else{
                return $discount_rate;
            }
        }
        static function getSaleTourSalePrice($post_id = '', $price = '', $tour_type = '', $check_in = ''){

            $filtered_price = apply_filters('st_get_sale_tour_sale_price',null,$post_id,$price,$tour_type,$check_in);

            if($filtered_price != null) return $filtered_price;

            $total_price = $price;

	        $tour_price_by = get_post_meta($post_id, 'tour_price_by', true);

            $price = floatval($price);

            $discount_type = get_post_meta( $post_id, 'discount_type', true);
            if( !$discount_type ) $discount_type = 'percent';

            $discount_rate = floatval(get_post_meta($post_id,'discount',true));
            if($discount_rate < 0) $discount_rate = 0;
            if($discount_rate > 100 && $discount_type == 'percent') $discount_rate = 100;


            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
            if($is_sale_schedule == 'on' && $tour_price_by != 'fixed_depart'){
                $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
                $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));

                if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
                    if($check_in >= $sale_from && $check_in <= $sale_to){
                        switch ($discount_type) {
                            case 'amount':
                                $total_price = $price - $discount_rate;
                                break;
                            
                            default:
                                $total_price = $price - ($price * ($discount_rate / 100));
                                break;
                        }
                        
                    }else{
                        $total_price = $price;
                    }
                }
            }else{
                switch ($discount_type) {
                    case 'amount':
                        $total_price = $price - $discount_rate;
                        break;
                    
                    default:
                        $total_price = $price - ($price * ($discount_rate / 100));
                        break;
                }
            }
            return $total_price;
        }

        static function getDistanceByCar($pick_up = "",$drop_off = ""){
            $lat_pick_up = get_post_meta($pick_up,'map_lat',true);
            $lng_pick_up = get_post_meta($pick_up,'map_lng',true);
            $lat_drop_off = get_post_meta($drop_off,'map_lat',true);
            $lng_drop_off = get_post_meta($drop_off,'map_lng',true);
            if(!empty($lat_pick_up) and !empty($lng_pick_up) and !empty($lat_drop_off) and !empty($lng_drop_off) ){
                $url=add_query_arg(array(
                    'units'=>'metric',
                    'language'=>'fr-FR',
                    'origins'=>"{$lat_pick_up},{$lng_pick_up}",
                    'destinations'=>"{$lat_drop_off},{$lng_drop_off}",
                ),'https://maps.googleapis.com/maps/api/distancematrix/json');
                $data = wp_remote_fopen($url);
                $data = json_decode($data);
                if(!empty($data->rows[0]->elements[0]->distance->text)){
                    $value = $data->rows[0]->elements[0]->distance->value;
                    $value = $value/1000;
                    $units = st()->get_option("cars_price_by_distance","kilometer");
                    if($units == "mile"){
                        $value = $value * 0.62137;
                    }
                    $value = number_format($value);
                    return $value;
                }else{
                    return 1;
                }
            }else{
                return 1;
            }
        }

        static function getSaleCarPrice($post_id = '', $price = '', $check_in = '', $check_out = '',$pick_up = false , $drop_off=false){
            $post_id = intval($post_id);
            $is_custom_price = get_post_meta($post_id,'is_custom_price',true);
            if(empty($is_custom_price))$is_custom_price = 'price_by_number';
            $unit = st()->get_option('cars_price_unit', 'day');
            ///////////////////////////////////////
            /////////// Price By Distance ///////////
            ///////////////////////////////////////
            if($unit == "distance"){
                $number_distance = self::getDistanceByCar($pick_up,$drop_off);
                if(preg_match("/^[0-9,]+$/", $number_distance)){
                    $number_distance = str_replace(',', '', $number_distance);
                }
                $total_price = $price * $number_distance;

                $discount_rate = floatval(get_post_meta($post_id,'discount',true));
                if($discount_rate < 0) $discount_rate = 0;
                if($discount_rate > 100) $discount_rate = 100;
                $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
                if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
                if($is_sale_schedule == 'on'){
                    $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
                    $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));
                    if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
                        $total_price = $total_price - ($total_price * ($discount_rate / 100));
                    }
                }else{
                    $total_price = $total_price - ($total_price * ($discount_rate / 100));
                }
                return $total_price;
            }
            ///////////////////////////////////////
            /////////// Price By Number ///////////
            ///////////////////////////////////////
            if($is_custom_price == 'price_by_number'){
                if(!empty($check_in) and !empty($check_out)){
                    $price = self::get_car_price_by_number_of_day_or_hour($post_id,$price,$check_in,$check_out);
                }
                // price discount
                $total_price = 0;
                if(get_post_type($post_id) == 'st_cars'){
                    $discount_rate = floatval(get_post_meta($post_id,'discount',true));
                    if($discount_rate < 0) $discount_rate = 0;
                    if($discount_rate > 100) $discount_rate = 100;

                    $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
                    if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';

                    $groupday = self::getGroupDayCar($check_in, $check_out);
                    $unit = st()->get_option('cars_price_unit', 'day');
                    $numberday = STCars::get_date_diff( $check_in , $check_out , $unit);

                    if($is_sale_schedule == 'on'){
                        $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
                        $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));
                        $today=strtotime('today');

                        if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){

                            foreach($groupday as $key => $date){
                                if(self::checkBetween($date, $sale_from, $sale_to)){
                                    $total_price += $price - ($price * ($discount_rate / 100));
                                }else{

                                    $total_price += $price;
                                }
                            }


                        }else
                        {
                            $total_price = ($price) * $numberday;
                        }
                    }else{

                        $total_price = ($price - ($price * ($discount_rate / 100))) * $numberday;
                    }
                }
                return $total_price;
            }
            ///////////////////////////////////////
            /////////// Price By Date /////////////
            ///////////////////////////////////////
            if($is_custom_price = 'price_by_date'){
                $total = 0;
                if($check_in and $check_out){
                    $unit = st()->get_option('cars_price_unit', 'day');
                    if($unit == 'day'){
                        $one_day = (60 * 60 * 24);
                    }elseif($unit == 'hour'){
                        $one_day = (60 * 60 );
                    }

                    $number_days = STCars::get_date_diff($check_in,$check_out);
                    for($i=1;$i<=$number_days;$i++){
                        $data_date = date("Y-m-d",$check_in + ($one_day * $i) - $one_day );
                        //$tmp = date("Y-m-d H:i:s",$check_in + ($one_day * $i) - $one_day );
                        $price_tmp = TravelerObject::st_get_custom_price_by_date($post_id , $data_date);
                        if(empty($price_tmp)){
                            $price_tmp = $price;
                        }
                        $is_sale = self::_check_car_sale_schedule_by_date($post_id,$data_date);
                        if(!empty($is_sale)){
                            $price_tmp = $price_tmp - ($price_tmp * ($is_sale / 100));
                        }
                        $total += $price_tmp;
                    }
                }
                return $total;
            }
        }
        static  function _check_car_sale_schedule_by_date($post_id,$date){
            $discount         = get_post_meta( $post_id , 'discount' , true );
            $is_sale_schedule = get_post_meta( $post_id , 'is_sale_schedule' , true );
            if($is_sale_schedule == 'on') {
                $sale_from = get_post_meta( $post_id , 'sale_price_from' , true );
                $sale_to   = get_post_meta( $post_id , 'sale_price_to' , true );
                if($sale_from and $sale_from) {
                    $today     = $date;
                    $sale_from = date( 'Y-m-d' , strtotime( $sale_from ) );
                    $sale_to   = date( 'Y-m-d' , strtotime( $sale_to ) );
                    if(( $today >= $sale_from ) && ( $today <= $sale_to )) {
                        //$discount         = get_post_meta( $post_id , 'discount' , true );
                    } else {
                        $discount = 0;
                    }
                } else {
                    $discount = 0;
                }
            }
            return $discount;
        }
        static function get_car_price_by_number_of_day_or_hour( $post_id , $price , $date_start = false , $date_end=false   ){
            $date_driff = STCars::get_date_diff($date_start,$date_end);
            if(!$post_id)$post_id = get_the_ID();
            $price_by_number_of_day_hour = get_post_meta($post_id , 'price_by_number_of_day_hour',true);
            if(!empty($price_by_number_of_day_hour) and is_array($price_by_number_of_day_hour)){
                foreach($price_by_number_of_day_hour as $k=>$v){
                    if( $date_driff >= $v['number_start'] and  $date_driff <= $v['number_end'] ){
                        $price = $v['price'];
                    }
                }
            }
            return $price;
        }
        static function convert_array_date_custom_price_by_date( $list_price ){
            if(empty($list_price)) return false;
            $array_list = array();
            $price_tmp=0;
            $key=0;
            foreach($list_price as $k=>$v){
                $date_start = $v['start'];
                $date_end = $v['end'];
                $price = $v['price'];
                if($price_tmp != $price){
                    $array_list[$key] = array(
                        'start' => $date_start,
                        'end' => $date_end,
                        'price' => $price,
                    );
                    $price_tmp = $price;
                    $key++;
                }
                if($price_tmp == $price){
                    if(!empty($array_list[$key-1]['end'])){
                        $array_list[$key-1]['end'] = $date_end;
                    }
                }
            }
            return $array_list;
        }
        static function getSale($post_id, $check_in, $check_out){
            $sale = false;
            $groupday = STPrice::getGroupDay($check_in, $check_out);
            $discount_rate = floatval(get_post_meta($post_id,'discount',true));
            if($discount_rate < 0) $discount_rate = 0;
            if($discount_rate > 100) $discount_rate = 100;

            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
            if($is_sale_schedule == 'on'){
                $sale_from = intval(strtotime(get_post_meta($post_id, 'sale_price_from',true)));
                $sale_to = intval(strtotime(get_post_meta($post_id, 'sale_price_to',true)));
                if($sale_from > 0 && $sale_to > 0 && $sale_from < $sale_to){
                    foreach($groupday as $key => $date){
                        if(self::checkBetween($date, $sale_from, $sale_to)){
                            $sale = $discount_rate;
                        }
                    }
                }
            }else{
                $sale = $discount_rate;
            }

            return $sale;
        }
        /**
         *@since 1.1.8
         *	Not use for hotel room. See 'getRoomPrice' function
         **/
        static function getSalePrice($post_id = '', $check_in = '', $check_out = ''){

            global $wpdb;

            $post_id = intval($post_id);
            $default_state = get_post_meta($post_id, 'default_state', true);
            if(!$default_state) $default_state = 'available';
            $total_price = 0;
            /**
            *@since 1.2.8
            **/
            $sale_by_day = array();
            $sale_count_date = 0;

            if(get_post_type($post_id) == 'st_rental'){

                $price_ori = floatval(get_post_meta($post_id, 'price', true));

                if($price_ori < 0) $price_ori = 0;
                $discount_rate = floatval(get_post_meta($post_id,'discount_rate',true));

                if($discount_rate < 0) $discount_rate = 0;
                if($discount_rate > 100) $discount_rate = 100;

                $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
                if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';
                // Price with custom price
	            $rental_origin_id = TravelHelper::post_origin($post_id);
                $custom_price = AvailabilityHelper::_getdataRental($rental_origin_id, $check_in, $check_out);

	            $in_sale = false;
				if(!empty($custom_price)){
					if(count($custom_price) == 1){
						foreach($custom_price as $key => $date){
							$price_tmp = 0;
							$in_date = false;

							$price = $date->price;
							if(!$in_date) $in_date = true;

							if($is_sale_schedule == 'on'){
								$sale_from = strtotime(get_post_meta($post_id, 'sale_price_from',true));
								$sale_to = strtotime(get_post_meta($post_id, 'sale_price_to',true));
								if($sale_from > 0 && $sale_to > 0 && $sale_from <= $sale_to){
									if(self::checkBetween($date->check_in, $sale_from, $sale_to)){
										$in_sale = true;
									}else{
										$in_sale = false;
									}
								}
							}else{
								$in_sale = true;
							}
							if($in_date){
								if($status = 'available'){
									if($in_sale){
										$price_tmp = $price - ($price * ($discount_rate / 100));
									}else{
										$price_tmp = $price;
									}
								}
							}else{
								if($default_state == 'available'){
									if($in_sale){
										$price_tmp = $price_ori - ($price_ori * ($discount_rate / 100));
									}else{
										$price_tmp = $price_ori;
									}
								}

							}
							$total_price += $price_tmp;
							$sale_by_day[] = $price_tmp;

						}
						$convert = self::convert_sale_price_by_day( $post_id );

						if( !empty( $convert ) ){
							$total_price = 0;

							$total_day = STDate::dateDiff(date('Y-m-d', $check_in), date('Y-m-d', $check_out));
							$discount_type = get_post_meta( $post_id, 'discount_type_no_day', true);
							if( !$discount_type ){ $discount_type = 'percent'; }

							foreach( $convert as $key => $discount ){
								if( $total_day - $key >= 0 ){
									$price = 0;
									for( $i = 0; $i < $key; $i++ ){
										$price += $sale_by_day[ $i ];
									}
									if( $discount_type == 'percent' ){
										$price  -= $price * ($discount / 100 );
									}else{
										$price -= $discount;
									}
									$total_price += $price;
									$total_day -= $key;
									$sale_by_day = array_slice( $sale_by_day, $key);
								}
							}
							if( $total_day > 0 ){
								for( $i = 0; $i < count( $sale_by_day ); $i++ ){
									$total_price += $sale_by_day[ $i ];
								}
							}
							return $total_price;
						}
					}else{
						$groupday = STPrice::getGroupDay($check_in, $check_out);
						if(is_array($groupday) && count($groupday)){
							foreach($groupday as $key => $date){
								$price_tmp = 0;
								$in_date = false;
								foreach($custom_price as $key => $val){
									if($date[0] >= $val->check_in && $date[0] <= $val->check_out){
										$status = $val->status;
										$price = floatval($val->price);
										if(!$in_date) $in_date = true;
									}
								}

								if($is_sale_schedule == 'on'){
									$sale_from = strtotime(get_post_meta($post_id, 'sale_price_from',true));
									$sale_to = strtotime(get_post_meta($post_id, 'sale_price_to',true));
									if($sale_from > 0 && $sale_to > 0 && $sale_from <= $sale_to){
										if(self::checkBetween($date, $sale_from, $sale_to)){
											$in_sale = true;
										}else{
											$in_sale = false;
										}
									}
								}else{
									$in_sale = true;
								}
								if($in_date){
									if($status = 'available'){
										if($in_sale){
											$price_tmp = $price - ($price * ($discount_rate / 100));
										}else{
											$price_tmp = $price;
										}
									}
								}else{
									if($default_state == 'available'){
										if($in_sale){
											$price_tmp = $price_ori - ($price_ori * ($discount_rate / 100));
										}else{
											$price_tmp = $price_ori;
										}
									}

								}
								$total_price += $price_tmp;
								$sale_by_day[] = $price_tmp;

							}
							$convert = self::convert_sale_price_by_day( $post_id );

							if( !empty( $convert ) ){
								$total_price = 0;

								$total_day = STDate::dateDiff(date('Y-m-d', $check_in), date('Y-m-d', $check_out));
								$discount_type = get_post_meta( $post_id, 'discount_type_no_day', true);
								if( !$discount_type ){ $discount_type = 'percent'; }

								foreach( $convert as $key => $discount ){
									if( $total_day - $key >= 0 ){
										$price = 0;
										for( $i = 0; $i < $key; $i++ ){
											$price += $sale_by_day[ $i ];
										}
										if( $discount_type == 'percent' ){
											$price  -= $price * ($discount / 100 );
										}else{
											$price -= $discount;
										}
										$total_price += $price;
										$total_day -= $key;
										$sale_by_day = array_slice( $sale_by_day, $key);
									}
								}
								if( $total_day > 0 ){
									for( $i = 0; $i < count( $sale_by_day ); $i++ ){
										$total_price += $sale_by_day[ $i ];
									}
								}
								return $total_price;
							}
						}
					}
				}else{
					$total_price = $price_ori;
				}
                return $total_price;
            }

            return 0;
        }

        static function getPriceEuipmentCar($data = array(),$check_in_timestamp, $check_out_timestamp){
            /**
             * Re calc price equipment by range day
             */
            $car_unit_price = st()->get_option('cars_price_unit', '');
            $number_range_unit = 1;
            if($car_unit_price == 'day' || $car_unit_price == 'hour'){
                $enable_equipment_by_unit = st()->get_option('equipment_by_unit', 'off');
                if($enable_equipment_by_unit == 'on'){
                    $number_range_unit = STCars::get_date_diff($check_in_timestamp,$check_out_timestamp);
                }
            }
            $total_price = 0;
            if(is_array($data) && count($data)){
                foreach($data as $key => $val){
                    if(is_object($val)){
                        $price = floatval($val->price);
                        if($price < 0) $price = 0;
                        $time_number=STCars::get_date_diff($check_in_timestamp,$check_out_timestamp,$val->price_unit);
                        if(!empty($val->price_unit)){
                            $price = $price*$time_number;
                        }
                        if($price > $val->price_max and $val->price_max > 0){
                            $price = $val->price_max;
                        }
                        $total_price += ($price * (int) $val->number_item);
                    }else{
                        $price = floatval($val['price']);
                        if($price < 0) $price = 0;
                        $time_number=STCars::get_date_diff($check_in_timestamp,$check_out_timestamp,$val['price_unit']);
                        if(!empty($val['price_unit'])){
                            $price = $price*$time_number;
                        }
                        if($price > $val['price_max'] and $val['price_max'] > 0){
                            $price = $val['price_max'];
                        }
                        $total_price += ($price * (int) $val['number_item']);
                    }
                }
            }
            return $total_price * $number_range_unit;
        }
        static function getPriceEuipmentCarAdmin($data = array()){
            $total_price = 0;
            if(is_array($data) && count($data)){
                foreach($data as $key => $val){
                    $price = preg_replace("/.*(--)/", "", $val);
                    $price = intval($price);
                    if($price < 0) $price = 0;
                    $total_price += $price;
                }
            }
            return $total_price;
        }

        static function convertEquipmentToOject($selected_equipments = array()){
            $list = array();
            if(is_array($selected_equipments) && count($selected_equipments)){
                foreach($selected_equipments as $key => $val){
                    $arr = explode('--', $val);
                    $title = isset($arr[0]) ? trim($arr[0]) : '';
                    $price = isset($arr[1]) ? floatval($arr[1]) : 0;
                    $list[$key] = new stdClass();
                    $list[$key]->title = $title;
                    $list[$key]->price = $price;
                }
            }
            return $list;
        }
        static function getTotal($div_room = false, $disable_coupon = false){
            $cart = STCart::get_carts();
            $total = 0;

            if(is_array($cart) && count($cart)){
                foreach($cart as $key => $val){
                    $post_id = intval($key);
                    if(!isset($val['data']['deposit_money'])){
                        $val['data']['deposit_money'] = array();
                    }
                    if(get_post_type($post_id) == 'st_hotel' or get_post_type($post_id) == 'hotel_room'){
                        $room_id = intval($val['data']['room_id']);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $number_room = intval($val['number']);
                        $numberday = STDate::dateDiff($check_in, $check_out);

                        $sale_price = STPrice::getRoomPrice($room_id, strtotime($check_in), strtotime($check_out), $number_room);
                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STPrice::getExtraPrice($room_id, $extras, $number_room, $numberday);

                        $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price);
                        if(!$disable_coupon) {
                            $price_coupon = STPrice::getCouponPrice();
                            $price_with_tax -= $price_coupon;
                        }

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total = $deposit_price;
                        }else{
                            $total = $price_with_tax;
                        }
                        if($div_room){
                            $total /= $number_room;
                        }
                    }

                    if(get_post_type($post_id) == 'st_rental'){
                        $rental_id = intval($key);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $item_price = STPrice::getRentalPriceOnlyCustomPrice($rental_id, strtotime($check_in), strtotime($check_out));
                        $numberday = STDate::dateDiff($check_in, $check_out);
                        
                        $sale_price = STPrice::getSalePrice($rental_id, strtotime($check_in), strtotime($check_out));

                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STPrice::getExtraPrice($rental_id, $extras, 1, $numberday);

                        $price_with_tax = STPrice::getPriceWithTax($sale_price + $extra_price);
                        if(!$disable_coupon) {
                            $price_coupon = STPrice::getCouponPrice();
                            $price_with_tax -= $price_coupon;
                        }

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total = $deposit_price;
                        }else{
                            $total = $price_with_tax;
                        }
                    }
                    if(get_post_type($post_id) == 'st_activity'){
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $adult_number = intval($val['data']['adult_number']);
                        $child_number = intval($val['data']['child_number']);
                        $infant_number = intval($val['data']['infant_number']);
                        $data_prices = self::getPriceByPeopleTour($post_id, strtotime($check_in), strtotime($check_out), $adult_number, $child_number, $infant_number);
                        $origin_price = floatval($data_prices['total_price']);

                        $type_activity = $val['data']['type_activity'];

                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STActivity::inst()->geExtraPrice($extras);

                        $sale_price = STPrice::getSaleTourSalePrice($post_id, $origin_price, $type_activity, strtotime($check_in));

                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price);
                        if(!$disable_coupon) {
                            $coupon_price = self::getCouponPrice();
                            $price_with_tax -= $coupon_price;
                        }
                        
                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total = $deposit_price;
                        }else{
                            $total = $price_with_tax;
                        }
                    }

                    if(get_post_type($post_id) == 'st_tours'){
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $adult_number = intval($val['data']['adult_number']);
                        $child_number = intval($val['data']['child_number']);
                        $infant_number = intval($val['data']['infant_number']);

                        $price_type = STTour::get_price_type($post_id);
                        if($price_type == 'person' or $price_type == 'fixed_depart') {
	                        $data_prices = self::getPriceByPeopleTour( $post_id, strtotime( $check_in ), strtotime( $check_out ), $adult_number, $child_number, $infant_number );
                        }else{
	                        $data_prices = self::getPriceByFixedTour($post_id, strtotime( $check_in ), strtotime( $check_out ));
                        }
                        $origin_price = floatval($data_prices['total_price']);

                        $tour_type = $val['data']['type_tour'];

                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STTour::geExtraPrice($extras);

                        $hotel_packages = isset($val['data']['package_hotel']) ? $val['data']['package_hotel'] : array();
                        $hotel_package_price = STTour::_get_hotel_package_price($hotel_packages);

                        $activity_packages = isset($val['data']['package_activity']) ? $val['data']['package_activity'] : array();
                        $activity_package_price = STTour::_get_activity_package_price($activity_packages);

                        $car_packages = isset($val['data']['package_car']) ? $val['data']['package_car'] : array();
                        $car_package_price = STTour::_get_car_package_price($car_packages);

	                    $flight_packages = isset($val['data']['package_flight']) ? $val['data']['package_flight'] : array();
	                    $flight_package_price = STTour::_get_flight_package_price($flight_packages);

                        $sale_price = STPrice::getSaleTourSalePrice($post_id, $origin_price, $tour_type, strtotime($check_in));

                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price + $hotel_package_price + $activity_package_price + $car_package_price + $flight_package_price);
                        if(!$disable_coupon) {
                            $coupon_price = self::getCouponPrice();
                            $price_with_tax -= $coupon_price;
                        }
                        
                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total = $deposit_price;
                        }else{
                            $total = $price_with_tax;
                        }
                    }
                    if(get_post_type($post_id) == 'st_cars'){
                        $car_id = intval($key);
                        $item_price = floatval(get_post_meta($car_id, 'cars_price', true));
                        $check_in_timestamp = $val['data']['check_in_timestamp'];
                        $check_out_timestamp = $val['data']['check_out_timestamp'];
                        $item_price = floatval($val['data']['item_price']);
                        $price_equipment = floatval($val['data']['price_equipment']);
                        $unit = st()->get_option('cars_price_unit', 'day');
                        $numberday = STCars::get_date_diff( $check_in_timestamp , $check_out_timestamp , $unit);
                        if($unit == "distance"){
                            $origin_price = $item_price * $val['data']['distance'];
                        }else{
                            $origin_price = $item_price * $numberday;
                        }

                        $sale_price = STPrice::getSaleCarPrice($car_id, $item_price,  $check_in_timestamp, $check_out_timestamp,$val['data']['location_id_pick_up'],$val['data']['location_id_drop_off']);
                        
                        $price_with_tax = STPrice::getPriceWithTax($sale_price + $price_equipment);
                        if(!$disable_coupon) {
                            $coupon_price = self::getCouponPrice();
                            $price_with_tax -= $coupon_price;
                        }

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total = $deposit_price;
                        }else{
                            $total = $price_with_tax;
                        }
                    }

                    //Flight
                    if(get_post_type($post_id) == 'st_flight' && !empty($val['data']['total_price'])){
                        $total = $val['data']['total_price'];
                    }
                    if(!empty($val['data']['booking_fee_price'])){
                        $total = $total + $val['data']['booking_fee_price'];
                    }
                    if($key == 'car_transfer'){
                        $sale_price = $val['data']['sale_price'];
                        $total = STPrice::getPriceWithTax($sale_price);
                    }
                }
            }
            return TravelHelper::convert_money($total, false, false);
        }

        static function getDataPrice(){
            $cart = STCart::get_carts();
            $data_price = array(
                'origin_price' => '',
                'sale_price' => '',
                'coupon_price' => '',
                'total_price' => '',
                'deposit_price' => '',
                'booking_fee_price' => '',
            );
            $origin_price = $sale_price = $coupon_price = $total_price = $deposit_price = $booking_fee_price = 0;
            if(is_array($cart) && count($cart)){
                foreach($cart as $key => $val){
                    if(!empty($val['data']['booking_fee_price'])){
                        $booking_fee_price = $val['data']['booking_fee_price'];
                    }
                    if(!isset($val['data']['deposit_money'])){
                        $val['data']['deposit_money'] = array();
                    }
                    if(get_post_type($key) == 'st_hotel'){
                        $room_id = intval($val['data']['room_id']);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $number_room = intval($val['number']);
                        $numberday = STDate::dateDiff($check_in, $check_out);
                        $origin_price = self::getRoomPriceOnlyCustomPrice($room_id, strtotime($check_in), strtotime($check_out), $number_room);
                        $sale_price = self::getRoomPrice($room_id, strtotime($check_in), strtotime($check_out), $number_room);
                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STPrice::getExtraPrice($room_id, $extras, $number_room, $numberday);
                        $coupon_price = self::getCouponPrice();
                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price);
                        $price_with_tax -= $coupon_price;
                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }
                    }
                    if(get_post_type($key) == 'hotel_room'){
                        $room_id = intval($val['data']['room_id']);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $number_room = intval($val['number']);
                        $numberday = STDate::dateDiff($check_in, $check_out);

                        $origin_price = self::getRoomPriceOnlyCustomPrice($room_id, strtotime($check_in), strtotime($check_out), $number_room);
                        $sale_price = self::getRoomPrice($room_id, strtotime($check_in), strtotime($check_out), $number_room);
                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STPrice::getExtraPrice($room_id, $extras, $number_room, $numberday);
                        $coupon_price = self::getCouponPrice();

                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price);
                        $price_with_tax -= $coupon_price;
                        
                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }
                    }
                    if(get_post_type($key) == 'st_rental'){
                        $rental_id = intval($key);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];

                        $numberday = STDate::dateDiff($check_in, $check_out);

                        $origin_price = STPrice::getRentalPriceOnlyCustomPrice($rental_id, strtotime($check_in), strtotime($check_out));

                        $sale_price = STPrice::getSalePrice($rental_id, strtotime($check_in), strtotime($check_out));

                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STPrice::getExtraPrice($rental_id, $extras, 1, $numberday);

                        $coupon_price = self::getCouponPrice();

                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price);

                        $price_with_tax -= $coupon_price;

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }
                    }
                    if(get_post_type($key) == 'st_tours'){
                        $post_id = intval($key);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $adult_number = intval($val['data']['adult_number']);
                        $child_number = intval($val['data']['child_number']);
                        $infant_number = intval($val['data']['infant_number']);
                        $price_type = STTour::get_price_type($post_id);
                        if($price_type == 'person' or $price_type == 'fixed_depart') {
	                        $data_prices = self::getPriceByPeopleTour( $post_id, strtotime( $check_in ), strtotime( $check_out ), $adult_number, $child_number, $infant_number );
                        }else{
	                        $data_prices = self::getPriceByFixedTour( $post_id, strtotime( $check_in ), strtotime( $check_out ) );
                        }
                        $origin_price = floatval($data_prices['total_price']);
                        if(get_post_type($post_id) == 'st_tours'){
                            $tour_type = $val['data']['type_tour'];
                        }elseif(get_post_type($post_id) == 'st_activity'){
                            $tour_type = $val['data']['type_activity'];
                        }
                        $sale_price = STPrice::getSaleTourSalePrice($post_id, $origin_price, $tour_type, strtotime($check_in));
                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STTour::geExtraPrice($extras);
                        //Hotel package
                        $hotel_packages = isset($val['data']['package_hotel']) ? $val['data']['package_hotel'] : array();
                        $hotel_package_price = STTour::_get_hotel_package_price($hotel_packages);
                        $activity_packages = isset($val['data']['package_activity']) ? $val['data']['package_activity'] : array();
                        $activity_package_price = STTour::_get_activity_package_price($activity_packages);
                        $car_packages = isset($val['data']['package_car']) ? $val['data']['package_car'] : array();
                        $car_package_price = STTour::_get_car_package_price($car_packages);
	                    $flight_packages = isset($val['data']['package_flight']) ? $val['data']['package_flight'] : array();
	                    $flight_package_price = STTour::_get_flight_package_price($flight_packages);

                        $coupon_price = self::getCouponPrice();
                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price + $hotel_package_price + $activity_package_price + $car_package_price + $flight_package_price);
                        $price_with_tax -= $coupon_price;

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }

	                    if($price_type == 'person') {
		                    $data_price['adult_price']  = $data_prices['adult_price'];
		                    $data_price['child_price']  = $data_prices['child_price'];
		                    $data_price['infant_price'] = $data_prices['infant_price'];
	                    }
	                    $data_price['price_type'] = $price_type;
                    }
                    if(get_post_type($key) == 'st_activity'){
                        $post_id = intval($key);
                        $check_in = $val['data']['check_in'];
                        $check_out = $val['data']['check_out'];
                        $adult_number = intval($val['data']['adult_number']);
                        $child_number = intval($val['data']['child_number']);
                        $infant_number = intval($val['data']['infant_number']);
                        $data_prices = self::getPriceByPeopleTour($post_id, strtotime($check_in), strtotime($check_out), $adult_number, $child_number, $infant_number);
                        $origin_price = floatval($data_prices['total_price']);
	                    if(get_post_type($post_id) == 'st_tours'){
		                    $tour_type = $val['data']['type_tour'];
	                    }elseif(get_post_type($post_id) == 'st_activity'){
		                    $tour_type = $val['data']['type_activity'];
	                    }
                        $sale_price = STPrice::getSaleTourSalePrice($post_id, $origin_price, $tour_type, strtotime($check_in));
                        $extras = isset($val['data']['extras']) ? $val['data']['extras'] : array();
                        $extra_price = STTour::geExtraPrice($extras);

                        $coupon_price = self::getCouponPrice();

                        $price_with_tax = self::getPriceWithTax($sale_price + $extra_price);
                        $price_with_tax -= $coupon_price;

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }

                        $data_price['adult_price'] = $data_prices['adult_price'];
                        $data_price['child_price'] = $data_prices['child_price'];
                        $data_price['infant_price'] = $data_prices['infant_price'];
                    }
                    if(get_post_type($key) == 'st_cars'){
                        $post_id = intval($key);
                        $check_in_timestamp = $val['data']['check_in_timestamp'];
                        $check_out_timestamp = $val['data']['check_out_timestamp'];
                        $item_price = floatval($val['data']['item_price']);
                        $price_equipment = floatval($val['data']['price_equipment']);
                        $unit = st()->get_option('cars_price_unit', 'day');
                        $numberday = STCars::get_date_diff( $check_in_timestamp , $check_out_timestamp , $unit);
                        $data_price['distance'] = st()->get_option('cars_price_by_distance','kilometer');
                        if($unit == "distance"){
                            $origin_price = $item_price * $val['data']['distance'];
                            $data_price['number_distance'] = $val['data']['distance'];
                        }else{
                            $origin_price = $item_price * $numberday;
                        }


                        $sale_price = STPrice::getSaleCarPrice($post_id, $item_price,  $check_in_timestamp, $check_out_timestamp,$val['data']['location_id_pick_up'],$val['data']['location_id_drop_off']);
                        
                        $coupon_price = self::getCouponPrice();

                        $price_with_tax = STPrice::getPriceWithTax($sale_price + $price_equipment);
                        $price_with_tax -= $coupon_price;

                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }
                        $data_price['price_equipment'] = $price_equipment;
                        $data_price['unit'] = $unit;
                    }
                    if(get_post_type($key) == 'st_flight'){
                        $total_price = $val['data']['total_price'];
                        $origin_price = $val['data']['depart_price'];
                        $sale_price = $val['data']['depart_price'];
                        $data_price['return_price'] = $val['data']['return_price'];
                        $coupon_price = '';
                        $deposit_price = '';
                    }
                    if($key == 'car_transfer'){
                        $origin_price = $val['data']['ori_price'];
                        $sale_price = $val['data']['sale_price'];
                        $price_with_tax = STPrice::getPriceWithTax($sale_price);
                        $coupon_price = self::getCouponPrice();
                        $price_with_tax -= $coupon_price;
                        $deposit_price = self::getDepositPrice($val['data']['deposit_money'], $price_with_tax);
                        if(isset($val['data']['deposit_money'])){
                            $total_price = $deposit_price;
                        }else{
                            $total_price = $price_with_tax;
                        }
                    }
                }
            }

            $data_price['origin_price'] = $origin_price;
            $data_price['sale_price'] = $sale_price;
            $data_price['coupon_price'] = $coupon_price;
            $data_price['price_with_tax'] = $total_price;
            $data_price['total_price_with_tax'] = $price_with_tax ; // tong order gom thue chua tru deposit
            $data_price['total_price'] = $total_price + $booking_fee_price;
            $data_price['deposit_price'] = $deposit_price;
            $data_price['booking_fee_price'] = $booking_fee_price;

            return $data_price;
        }
        static function getDepositPrice($deposit = array(), $price_with_tax = '',  $price_coupon = ''){
            $price_with_tax = floatval($price_with_tax);
            $price_coupon = floatval($price_coupon);

            $deposit_price = $price_with_tax;

            if(isset($deposit['type']) && isset($deposit['amount']) && floatval($deposit['amount']) > 0){
                if($deposit['type'] == 'percent'){
                    $de_price = floatval($deposit['amount']);
                    $deposit_price = $deposit_price * ($de_price / 100);
                }elseif($deposit['type'] == 'amount'){
                    $de_price = floatval($deposit['amount']);
                    $deposit_price = $de_price;
                }
            }

            return $deposit_price;
        }

        static function getDepositData($post_id = '', $cart_data = array()){
            $cart_data['data']['deposit_money'] = array(
                'type' => '',
                'amount' => ''
            );
            $post_id = intval($post_id);
            $status = get_post_meta( $post_id , 'deposit_payment_status' , true );
            if(!$status) $status = '';

            if(!empty($status)){
                if($status == 'amount'){
                    $status = 'percent';
                }
                $amount = floatval(get_post_meta($post_id , 'deposit_payment_amount' , true ));
                if($amount < 0) $amount = 0;
                if($amount > 100) $amount = 100;

                $cart_data['data']['deposit_money'] = array(
                    'type' => $status,
                    'amount' => $amount
                );
            }

            return $cart_data;
        }

        static function getCouponPrice(){
            if(STCart::use_coupon()){
                $price_coupon = floatval(STCart::get_coupon_amount());
                if($price_coupon < 0) $price_coupon = 0;

                return $price_coupon;
            }
            return 0;
        }

        /**
         *@since 1.1.8
         *	Only use for hotel room
         **/
        static function getRoomPriceOnlyCustomPrice($room_id = '', $check_in = '', $check_out = '', $number_room = 1){
            $room_id = intval($room_id);
            $default_state = get_post_meta($room_id, 'default_state', true);
            if(!$default_state) $default_state = 'available';

            $hotel_id = get_post_meta($room_id, 'room_parent', true);

            if(get_post_type($room_id) == 'hotel_room'){
                $price_ori = floatval(get_post_meta($room_id, 'price', true));
                if($price_ori < 0) $price_ori = 0;

                $total_price = 0;
                $custom_price = AvailabilityHelper::_getdataHotel($room_id, $check_in, $check_out);

                $price_key = 0;
                for($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)){
                    if(is_array($custom_price) && count($custom_price)){
                        $in_date = false;
                        $price = 0;
                        $status = 'available';
                        foreach($custom_price as $key => $val){
                            if($i >= $val->check_in && $i <= $val->check_out){
                                $status = $val->status;
                                $price = floatval($val->price);
                                if(!$in_date) $in_date = true;
                            }
                        }
                        if($in_date){
                            if($status == 'available'){

                                $price_key = floatval($price);
                            }
                        }else{
                            if($default_state == 'available'){
                                $price_key = $price_ori;
                            }
                        }
                    }else{
                        if($default_state == 'available'){
                            $price_key = $price_ori;
                        }
                    }
                    if($i < $check_out){
                        $total_price += $price_key;

                    }
                }

                return $total_price * $number_room;
            }
            return 0;
        }
        static function convert_sale_price_by_day( $room_id ){
            $convert = array();
            $list_sale_date = get_post_meta($room_id, 'discount_by_day', true);
            if( !empty( $list_sale_date ) && is_array( $list_sale_date ) ){
                foreach( $list_sale_date as $key => $item ){
                    if( !empty( $item['number_day']) && !empty( $item['discount']) ){
                        $convert[ (int)$item['number_day'] ] = (float)$item['discount'];
                    }
                }
            }
            krsort($convert);
            return $convert;
        }

        static function getRentalPriceOnlyCustomPrice($rental_id = '', $check_in = '', $check_out = ''){
            $rental_id = intval($rental_id);

            $discount_type=get_post_meta($rental_id,'discount_type_no_day',true);
            $discount=get_post_meta($rental_id,'discount_rate',true);
            $is_sale_schedule=get_post_meta($rental_id,'is_sale_schedule',true);
            $sale_price_from=get_post_meta($rental_id,'sale_price_from',true);
            $sale_price_to=get_post_meta($rental_id,'sale_price_to',true);

            if(get_post_type($rental_id) == 'st_rental'){
                $price_ori = floatval(get_post_meta($rental_id, 'price', true));
                if($price_ori < 0) $price_ori = 0;

                $total_price = 0;
                $rental_origin_id = TravelHelper::post_origin($rental_id);
                $custom_price = AvailabilityHelper::_getdataRental($rental_origin_id, $check_in, $check_out);

                if(!empty($custom_price)){
                	if(count($custom_price) == 1){
		                $total_price = $custom_price[0]->price;
	                }else{
		                $price_key = 0;
		                for($i = $check_in; $i <= $check_out; $i = strtotime('+1 day', $i)){
			                if(is_array($custom_price) && count($custom_price)){
				                $in_date = false;
				                $price = 0;
				                $status = 'available';
				                foreach($custom_price as $key => $val){
					                if($i >= $val->check_in && $i <= $val->check_out){
						                $status = $val->status;
						                $price = floatval($val->price);
						                if(!$in_date) $in_date = true;
					                }
				                }
				                if($in_date){
					                if($status == 'available'){

						                $price_key = floatval($price);
					                }
				                }else{
					                $price_key = $price_ori;
				                }
			                }else{
				                $price_key = $price_ori;
			                }
			                if($i < $check_out){
				                $total_price += $price_key;
			                }
		                }
	                }
                }else{
                	$total_price = $price_ori;
                }
                //return st_apply_discount($total_price,$discount_type,$discount,$check_in,$is_sale_schedule,strtotime($sale_price_from),strtotime($sale_price_to));
	            return $total_price;
            }
            return 0;
        }
        static function showRoomPriceInfo($room_id = '', $check_in = '', $check_out = ''){
            $room_id = intval($room_id);
            $price_ori = floatval(get_post_meta($room_id, 'price', true));
            if($price_ori < 0) $price_ori = 0;

            $default_state = get_post_meta($room_id, 'default_state', true);
            if(!$default_state) $default_state = 'available';

            $price_ori = floatval(get_post_meta($room_id, 'price', true));
            if($price_ori < 0) $price_ori = 0;
            $html = '<table width="100%">
				<tr>
					<th style="text-align: center" bgcolor="#CCC">'.__('From', ST_TEXTDOMAIN).' - '.__('To', ST_TEXTDOMAIN).'</th>
					<th style="text-align: center" bgcolor="#CCC">'.__('Price', ST_TEXTDOMAIN).'</th>
				</tr>
			';
            if(get_post_type($room_id) == 'hotel_room'){

                $custom_price = AvailabilityHelper::_getdataHotel($room_id, $check_in, $check_out);
                $groupday = STPrice::getGroupDay($check_in, $check_out);
                foreach($groupday as $key => $date){
                    $status = 'available';
                    $price = 0;
                    $in_date = false;
                    $price_tmp = 0;
                    if(is_array($custom_price) && count($custom_price)){
                        foreach($custom_price as $key => $val){
                            if($date[0] == $val->check_in){
                                $status = $val->status;
                                $price = floatval($val->price);
                                if(!$in_date) $in_date = true;
                            }
                            if($in_date){
                                if($status == 'available'){
                                    $price_tmp = $price;
                                }
                            }else{
                                if($default_state == 'available'){
                                    $price_tmp = $price_ori;
                                }
                            }
                        }
                    }else{
                        if($default_state == 'available'){
                            $price_tmp = $price_ori;
                        }
                    }

                    $html .= '
						<tr>
							<td width="60%" style="border-bottom: 1px dashed #CCC">'.
                        date(TravelHelper::getDateFormat(), $date[0]).' <i class="fa fa-arrow-right "></i> '.date(TravelHelper::getDateFormat(), $date[1]).
                        '</td>
							<td width="40%" style="border-bottom: 1px dashed #CCC; text-align: right">'.
                        TravelHelper::format_money($price_tmp)
                        .'</td>
						</tr>
					';
                }
            }
            $html .= '</table>';
            return $html;
        }
        static function showRentalPriceInfo($rental_id = '', $check_in = '', $check_out = ''){
            $rental_id = intval($rental_id);
            $price_ori = floatval(get_post_meta($rental_id, 'price', true));
            if($price_ori < 0) $price_ori = 0;

            $default_state = 'available';

            $price_ori = floatval(get_post_meta($rental_id, 'price', true));
            if($price_ori < 0) $price_ori = 0;
            $html = '<table width="100%">
                <tr>
                    <th style="text-align: center" bgcolor="#CCC">'.__('From', ST_TEXTDOMAIN).' - '.__('To', ST_TEXTDOMAIN).'</th>
                    <th style="text-align: center" bgcolor="#CCC">'.__('Price', ST_TEXTDOMAIN).'</th>
                </tr>
            ';
            if(get_post_type($rental_id) == 'st_rental'){

                $custom_price = AvailabilityHelper::_getdataRental($rental_id, $check_in, $check_out);
                if(!empty($custom_price)){
                	if(count($custom_price) == 1){
		                $html .= '
                        <tr>
                            <td width="60%" style="border-bottom: 1px dashed #CCC">'.
		                         date(TravelHelper::getDateFormat(), $custom_price[0]->check_in).' <i class="fa fa-arrow-right "></i> '.date(TravelHelper::getDateFormat(), $custom_price[0]->check_out).
		                         '</td>
                            <td width="40%" style="border-bottom: 1px dashed #CCC; text-align: right">'.
		                         TravelHelper::format_money($custom_price[0]->price)
		                         .'</td>
                        </tr>
                    ';
	                }else{
		                $groupday = STPrice::getGroupDay($check_in, $check_out);
		                foreach($groupday as $key => $date){
			                $status = 'available';
			                $price = 0;
			                $in_date = false;
			                $price_tmp = 0;
			                if(is_array($custom_price) && count($custom_price)){
				                foreach($custom_price as $key => $val){
					                if($date[0] == $val->check_in){
						                $status = $val->status;
						                $price = floatval($val->price);
						                if(!$in_date) $in_date = true;
					                }
					                if($in_date){
						                if($status == 'available'){
							                $price_tmp = $price;
						                }
					                }else{
						                if($default_state == 'available'){
							                $price_tmp = $price_ori;
						                }
					                }
				                }
			                }else{
				                if($default_state == 'available'){
					                $price_tmp = $price_ori;
				                }
			                }

			                $html .= '
                        <tr>
                            <td width="60%" style="border-bottom: 1px dashed #CCC">'.
			                         date(TravelHelper::getDateFormat(), $date[0]).' <i class="fa fa-arrow-right "></i> '.date(TravelHelper::getDateFormat(), $date[1]).
			                         '</td>
                            <td width="40%" style="border-bottom: 1px dashed #CCC; text-align: right">'.
			                         TravelHelper::format_money($price_tmp)
			                         .'</td>
                        </tr>
                    ';
		                }
	                }
                }
            }
            $html .= '</table>';
            return $html;
        }
        /**
         *@since 1.1.8
         *@param $room_id int
         *@param $check_in timestamp
         *@param $check_out timestamp
         **/
        static function getRoomPrice($room_id = '', $check_in = '', $check_out = '', $number_room = 1){
	        $room_id = intval($room_id);
	        $default_state = get_post_meta($room_id, 'default_state', true);
	        if(!$default_state) $default_state = 'available';

	        $total_price = 0;
	        /**
	         *@since 1.2.8
	         *   sale by number day
	         **/
	        $sale_by_day = array();
	        $sale_count_date = 0;

	        if(get_post_type($room_id) == 'hotel_room'){

		        $price_ori = floatval(get_post_meta($room_id, 'price', true));

		        if($price_ori < 0) $price_ori = 0;

		        $discount_rate = floatval(get_post_meta($room_id,'discount_rate',true));

		        if($discount_rate < 0) $discount_rate = 0;
		        if($discount_rate > 100) $discount_rate = 100;

		        $is_sale_schedule = get_post_meta($room_id, 'is_sale_schedule', true);
		        if($is_sale_schedule == false || empty($is_sale_schedule)) $is_sale_schedule = 'off';

		        // Price wiht custom price
		        $custom_price = AvailabilityHelper::_getdataHotel($room_id, $check_in, $check_out);

		        $groupday = STPrice::getGroupDay($check_in, $check_out);

		        if(is_array($groupday) && count($groupday)){
			        foreach($groupday as $key => $date){
				        $price_tmp = 0;
				        $status = 'available';
				        $priority = 0;
				        $in_date = false;
				        foreach($custom_price as $key => $val){
					        if($date[0] >= $val->check_in && $date[0] <= $val->check_out){
						        $status = $val->status;
						        $price = floatval($val->price);
						        if(!$in_date) $in_date = true;
					        }
				        }

				        if($in_date){
					        if($status = 'available'){
						        $price_tmp = $price;
					        }
				        }else{
					        if($default_state == 'available'){
						        $price_tmp = $price_ori;
					        }
				        }

				        $total_price += $price_tmp;
				        $sale_by_day[] = $price_tmp;

			        }

			        $convert = self::convert_sale_price_by_day( $room_id );

			        $discount_type = get_post_meta( $room_id, 'discount_type_no_day', true);
			        if( !$discount_type ){ $discount_type = 'percent'; }

			        if( !empty( $convert ) ){
				        $total_price = 0;

				        $total_day = STDate::dateDiff(date('Y-m-d', $check_in), date('Y-m-d', $check_out));

				        while( !empty( $convert ) ){
					        foreach( $convert as $key => $discount ){
						        if( $total_day - $key >= 0 ){
							        $price = 0;
							        for( $i = 0; $i < $key; $i++ ){
								        $price += $sale_by_day[ $i ];
							        }
							        if( $discount_type == 'percent' ){
								        $price  -= $price * ($discount / 100 );
							        }else{
								        $price -= $discount;
							        }

							        $total_price += $price;
							        $total_day -= $key;
							        $sale_by_day = array_slice( $sale_by_day, $key );
							        break;
						        }else{
							        unset( $convert[ $key ] );
						        }
					        }

				        }
				        if( $total_day > 0 ){
					        for( $i = 0; $i < count( $sale_by_day ); $i++ ){
						        $total_price += $sale_by_day[ $i ];
					        }
				        }
				        $total_price  = $total_price * $number_room;
				        $total_price -= $total_price * ( $discount_rate / 100 );
				        return $total_price;
			        }
		        }
		        $total_price  = $total_price * $number_room;
		        $total_price -= $total_price * ($discount_rate / 100);
		        return $total_price;
	        }
	        return 0;
        }

        static function getExtraPrice($room_id = '', $extra_price = array(), $number_room = 0, $numberday = 0){
            $total_price = 0;
            $price_unit = get_post_meta($room_id, 'extra_price_unit', true);
            if(!$price_unit) $price_unit = 'perday';
            if(isset($extra_price['value']) && is_array($extra_price['value']) && count($extra_price['value'])){
                foreach($extra_price['value'] as $name => $number){
                    $price_item = floatval($extra_price['price'][$name]);
                    if($price_item <= 0) $price_item = 0;
                    $number_item = intval($extra_price['value'][$name]);
                    if($number_item <= 0) $number_item = 0;
                    $total_price += $price_item * $number_item;
                }
            }
            if($price_unit == 'perday'){
                return $total_price * $numberday * $number_room;
            }elseif($price_unit == 'fixed'){
                return $total_price * $number_room;
            }
        }
        static function checkBetween($date = array(), $in = '', $out = ''){
            foreach($date as $val){
                if($val >= $in && $val <= $out){
                    return true;
                }
            }
            return false;
        }
        static function getGroupDay($start = '', $end = ''){
            $list = array();
            for($i = $start; $i <= $end; $i = strtotime('+1 day', $i)){
                $next = strtotime('+1 day', $i);
                if($next <= $end){
                    $list[] = array($i, $next);
                }
            }
            return $list;
        }

        static function getGroupDayCar($start = '', $end = ''){
            $list = array();
            $unit = st()->get_option('cars_price_unit', 'day');
            if($unit == 'day'){
                $numberday_ori = ($end - $start) / (60 * 60 * 24);
                $numberday = ceil(($end - $start) / (60 * 60 * 24));
            }elseif($unit == 'hour'){
                $numberday_ori = ($end - $start) / (60 * 60);
                $numberday = ceil(($end - $start) / (60 * 60));
            }
            //$numberday = STCars::get_date_diff( $check_in_timestamp , $check_out_timestamp , $unit);


            if($unit == 'day' && $numberday <= 0){
                $end = strtotime('+1 day', $start);
            }elseif($unit == 'hour' && $numberday <= 0){
                $end = strtotime('+1 hour', $start);
            }
            if($unit == 'day'){
                for($i = $start; $i <= $end; $i = strtotime('+1 day', $i)){
                    $next = strtotime('+1 day', $i);
                    if($i < $end){
                        $list[] = array($i, $next);
                    }
                    if($i == $end && $numberday > $numberday_ori){
                        $list[] = array($i, $next);
                    }
                }
                if(st()->get_option('booking_days_included')=='on')
                {
                    $list[]=array($start,$start);
                }
            }elseif($unit == 'hour'){

                for($i = $start; $i <= $end; $i = strtotime('+1 hour', $i)){
                    $next = strtotime('+1 hour', $i);
                    if($i < $end){
                        $list[] = array($i, $next);
                    }
                    if($i == $end && $numberday > $numberday_ori){
                        $list[] = array($i, $next);
                    }

                }
                if(st()->get_option('booking_days_included')=='on')
                {
                    $list[]=array($start,$start);
                }
            }
            return $list;
        }
        static function _getListRoomCustomPrice($room_id = '', $check_in = '', $check_out = ''){
            global $wpdb;

            $room_id = intval($room_id);

            if(get_post_type($room_id) == 'hotel_room'){
                $sql = "SELECT
					price,
					start_date AS check_in,
					end_date AS check_out,
					priority
				FROM
					{$wpdb->prefix}st_price
				WHERE
					post_id = '{$room_id}'
				AND (
					(
						'{$check_in}' < STR_TO_DATE(start_date, '%Y-%m-%d')
						AND '{$check_out}' > STR_TO_DATE(end_date, '%Y-%m-%d')
					)
					OR (
						'{$check_in}' BETWEEN STR_TO_DATE(start_date, '%Y-%m-%d')
						AND STR_TO_DATE(end_date, '%Y-%m-%d')
					)
					OR (
						'{$check_out}' BETWEEN STR_TO_DATE(start_date, '%Y-%m-%d')
						AND STR_TO_DATE(end_date, '%Y-%m-%d')
					)
				)";
                $results = $wpdb->get_results($sql, ARRAY_A);
                return $results;
            }else{
                return null;
            }
        }
        static function getPriceRoom($room_id = ''){
            if(empty($room_id)) $room_id = get_the_ID();
            $price = get_post_meta( $room_id , 'price' , true) ;
            $discount=get_post_meta($room_id,'discount_rate',true);

            $data = array(
                'price_origine'=>$price,
                'price_sale'=>$price,
                'discount'=>0,
            );
            if($discount) {
                if($discount > 100) $discount = 100;
                $price_new = $price - ( $price / 100 ) * $discount;
                $data['price_sale'] = $price_new;
                $data['discount'] = $discount;
            }

            return $data;
        }

        static function getTotalPriceWithTaxInOrder($price = 0, $order_id){
            $price = floatval($price);
            if($price < 0) $price = 0;
            $st_tax_percent = get_post_meta($order_id , 'st_tax_percent' , true);
            $st_is_tax_included_listing_page = get_post_meta($order_id , 'st_is_tax_included_listing_page' , true);
            if($st_is_tax_included_listing_page == 'off' and !empty($st_tax_percent) ){
                $price = $price + ($price / 100) * $st_tax_percent;
            }
            return $price;
        }

        static function getRentalSalePrice($post_id){
			if(empty($post_id)) return 0;
	        $orgin_price = get_post_meta($post_id, 'price', true);
	        if (empty($orgin_price))
	        	$orgin_price = 0;
	        $discount_rate = get_post_meta($post_id, 'discount_rate', true);
	        if(!empty($discount_rate)) {
		        if ( $discount_rate < 0 ) {
			        $discount_rate = 0;
		        }
		        if ( $discount_rate > 100 ) {
			        $discount_rate = 100;
		        }
		        if($discount_rate > 0){
		        	$sale_price = $orgin_price - (($orgin_price * $discount_rate)/100);
		        	return $sale_price;
		        }else{
		        	return $orgin_price;
		        }
	        }else{
	        	return $orgin_price;
	        }

        }

        static function get_info_price( $post_id = null )
        {

            /**
             * @since 1.2.5
             * filter hook get_price_html
             * author quandq
             */
            if ( !$post_id )
                $post_id = get_the_ID();
            $prices    = self::get_price_person( $post_id );
            $price_old = $price_new = 0;
            if ( !empty( $prices[ 'adult' ] ) ) {
                $price_old = $prices[ 'adult' ];
                $price_new = $prices[ 'adult_new' ];
            } elseif ( !empty( $prices[ 'child' ] ) ) {
                $price_old = $prices[ 'child' ];
                $price_new = $prices[ 'child_new' ];
            } elseif ( !empty( $prices[ 'infant' ] ) ) {
                $price_old = $prices[ 'infant' ];
                $price_new = $prices[ 'infant_new' ];
            }

            return [ 'price_old' => $price_old, 'price_new' => $price_new, 'discount' => $prices[ 'discount' ] ];
        }

        static function get_price_person( $post_id = null )
        {

            if ( !$post_id ) $post_id = get_the_ID();
            $adult_price  = (float) get_post_meta( $post_id, 'adult_price', true );
            $child_price  = (float) get_post_meta( $post_id, 'child_price', true );
            $infant_price = (float) get_post_meta( $post_id, 'infant_price', true );

            if ( $adult_price < 0 ) $adult_price = 0;
            if ( $child_price < 0 ) $child_price = 0;
            if ( $infant_price < 0 ) $infant_price = 0;

            /*$adult_price = apply_filters('st_apply_tax_amount',$adult_price);
            $child_price = apply_filters('st_apply_tax_amount',$child_price);
            $infant_price = apply_filters('st_apply_tax_amount',$infant_price);*/

            $discount         = get_post_meta( $post_id, 'discount', true );
            $is_sale_schedule = get_post_meta( $post_id, 'is_sale_schedule', true );

            if ( $is_sale_schedule == 'on' ) {
                $sale_from = get_post_meta( $post_id, 'sale_price_from', true );
                $sale_to   = get_post_meta( $post_id, 'sale_price_to', true );
                if ( $sale_from and $sale_from ) {

                    $today     = date( 'Y-m-d' );
                    $sale_from = date( 'Y-m-d', strtotime( $sale_from ) );
                    $sale_to   = date( 'Y-m-d', strtotime( $sale_to ) );
                    if ( ( $today >= $sale_from ) && ( $today <= $sale_to ) ) {

                    } else {

                        $discount = 0;
                    }

                } else {
                    $discount = 0;
                }
            }

            if ( $discount ) {
                if ( $discount > 100 ) $discount = 100;

                $adult_price_new  = $adult_price - ( $adult_price / 100 ) * $discount;
                $child_price_new  = $child_price - ( $child_price / 100 ) * $discount;
                $infant_price_new = $infant_price - ( $infant_price / 100 ) * $discount;
                $data             = [
                    'adult'      => $adult_price,
                    'adult_new'  => $adult_price_new,
                    'child'      => $child_price,
                    'child_new'  => $child_price_new,
                    'infant'     => $infant_price,
                    'infant_new' => $infant_price_new,
                    'discount'   => $discount,

                ];
            } else {
                $data = [
                    'adult_new'  => $adult_price,
                    'adult'      => $adult_price,
                    'child'      => $child_price,
                    'child_new'  => $child_price,
                    'infant'     => $infant_price,
                    'infant_new' => $infant_price,
                    'discount'   => $discount,
                ];
            }

            $off_adult  = get_post_meta( $post_id, 'hide_adult_in_booking_form', true );
            $off_child  = get_post_meta( $post_id, 'hide_children_in_booking_form', true );
            $off_infant = get_post_meta( $post_id, 'hide_infant_in_booking_form', true );

            if ( $off_adult == "on" ) {
                unset ( $data[ 'adult' ] );
                unset ( $data[ 'adult_new' ] );
            }
            if ( $off_child == "on" ) {
                unset ( $data[ 'child' ] );
                unset ( $data[ 'child_new' ] );
            }
            if ( $off_infant == "on" ) {
                unset ( $data[ 'infant' ] );
                unset ( $data[ 'infant_new' ] );
            }

            return $data;
        }
    }
}
new STPrice();
