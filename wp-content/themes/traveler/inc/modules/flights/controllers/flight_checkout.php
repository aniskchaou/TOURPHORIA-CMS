<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/28/2017
 * Version: 1.0
 */

if(!class_exists('ST_Flight_Checkout')){
    class ST_Flight_Checkout{

        static $_inst;

        public function __construct()
        {

            add_action('wp_ajax_st_flight_add_to_cart', array($this, '_add_to_cart'));
            add_action('wp_ajax_nopriv_st_flight_add_to_cart', array($this, '_add_to_cart'));
        }

        function _add_to_cart(){
            $res = array(
                'status' => 0
            );

            $is_avalidate = false;

            $flight_type = STInput::post('flight_type', 'one_way');
            $price_class_depart = STInput::post('price_class_depart', 'eco_price');
            $price_class_return = STInput::post('price_class_return', 'eco_price');
            $depart_id = STInput::post('depart_id',false);
            $return_id = STInput::post('return_id',false);
            $passenger = STInput::post('passenger', 1);
            $depart_date = STInput::post('depart_date', 1);
            $return_date = STInput::post('return_date', 1);

            if(wp_verify_nonce(STInput::request('_wpnonce'),'st_search_flight')){

                if(empty($depart_id)){
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('Please choose a depart flight', ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }
                if(empty($return_id) && $flight_type == 'return'){
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('Please choose a return flight', ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }
                if(empty($depart_date)){
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('Please choose depart date', ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }
                if(empty($return_date)){
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('Please choose return date', ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }

                /**
                 * Validate Guest Name
                 *
                 * @since 2.1.2
                 * @author dannie
                 */
                if(!st_validate_guest_name($depart_id,$passenger,0,0))
                {
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('Please enter the Guest Name',ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }

                $is_avalidate = apply_filters('st_flight_check_validate_add_cart', true);

            }

            $business_depart = false;
            if($price_class_depart == 'business_price'){
                $business_depart = true;
            }
            $price_depart =  (float)ST_Flights_Controller::inst()->get_price_flight($depart_id,$depart_date, $business_depart);

            if($is_avalidate){

                $enable_tax_depart = get_post_meta((int)$depart_id, 'enable_tax', true);
                $vat_amount_depart = get_post_meta((int)$depart_id, 'vat_amount', true);

                if((float)$vat_amount_depart < 0 || $enable_tax_depart == 'no'){
                    $vat_amount_depart = 0;
                }
                $tax_price_depart = ((float)$vat_amount_depart * $price_depart)/100;
                if($enable_tax_depart != 'no' && $vat_amount_depart > 0){
                    $total_price_depart = $tax_price_depart + $price_depart;
                }else{
                    $total_price_depart = $price_depart;
                }

                if((float)$price_depart <= 0){
                    $res['status'] = 0;
                    $res['message'] = '<div class="st-alert">'.esc_html__('There was an error adding to the cart. Please contact to admin', ST_TEXTDOMAIN).'</div>';
                    wp_send_json($res);
                }

                $price_return = 0;
                if($flight_type == 'return') {
                    $business_return = false;
                    if($price_class_return == 'business_price'){
                        $business_return = true;
                    }
                    $price_return = (float)ST_Flights_Controller::inst()->get_price_flight($return_id, $return_date, $business_return);
                    if ((float)$price_depart <= 0) {
                        $res['status'] = 0;
                        $res['message'] = '<div class="st-alert">' . esc_html__('There was an error adding to the cart. Please contact to admin', ST_TEXTDOMAIN) . '</div>';
                        wp_send_json($res);
                    }
                }else{
                    $return_id = '';
                }

                $data = array(
                    'flight_type' => $flight_type,
                    'price_class_depart' => $price_class_depart,
                    'price_class_return' => $price_class_return,
                    'depart_id' => $depart_id,
                    'return_id' => $return_id,
                    'passenger' => $passenger,
                    'depart_date' => $depart_date,
                    'return_date' => $return_date,
                    'depart_price' => $price_depart,
                    'enable_tax_depart' => $enable_tax_depart,
                    'tax_percent_depart' => $vat_amount_depart,
                    'tax_price_depart' => $tax_price_depart,
                    'total_price_depart' => $total_price_depart,
                    'total_price' => $total_price_depart*((int)$passenger),
                    'depart_stop' => get_post_meta($depart_id, 'flight_type', true),
                    'return_stop' => get_post_meta($return_id, 'flight_type', true),
                    'depart_data_time' => st_flight_get_duration($depart_id, $depart_date),
                    'return_data_time' => st_flight_get_duration($return_id, $return_date),
                    'depart_data_location' => st_flight_get_info_stop($depart_id),
                    'return_data_location' => st_flight_get_info_stop($return_id),
                    'guest_title'=>STInput::post('guest_title'),
                    'guest_name'=>STInput::post('guest_name'),
                );

                if($flight_type == 'return' && (float)$price_return > 0){

                    $data['return_price'] = $price_return;
                    $enable_tax_return = get_post_meta((int)$return_id, 'enable_tax', true);
                    $vat_amount_return = get_post_meta((int)$return_id, 'vat_amount', true);
                    if((float)$vat_amount_return < 0 || $enable_tax_return == 'no'){
                        $vat_amount_return = 0;
                    }
                    $tax_price_return = ((float)$vat_amount_return*$price_return)/100;

                    $data['tax_percent_return'] = $vat_amount_return;
                    $data['enable_tax_return'] = $enable_tax_return;
                    if($enable_tax_return != 'no' && $tax_price_return > 0){
                        $total_price_return = $tax_price_return + $price_return;
                    }else{
                        $total_price_return = $price_return;
                    }

                    $data['tax_price_return'] = $tax_price_return;
                    $data['total_price_return'] = $total_price_return;

                    $data['total_price'] = ($total_price_depart + $total_price_return) * ((int)$passenger);
                }
                STCart::add_cart($depart_id,$passenger, $data['total_price'], $data);

                $res['status'] = 1;

                $cart_link = STCart::get_cart_link();
                $res['redirect'] = $cart_link;
                wp_send_json($res);

            }

            wp_send_json($res);
        }

        function get_cart_item_html($key){
            return st_flight_load_view('flights/cart-item-html',false, array('item_id' => $key));
        }

        static function inst(){
            if(!self::$_inst){
                self::$_inst = new self();
            }

            return self::$_inst;
        }
    }

    ST_Flight_Checkout::inst();
}