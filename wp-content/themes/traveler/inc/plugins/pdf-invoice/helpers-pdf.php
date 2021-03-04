<?php
// Instanciation of inherited class
if(!function_exists('wb_pdf_invoice_create_invoices')){
    function st_pdf_invoice_create_invoices($order_id,$order_data){
        if(empty($order_id)){
            return FALSE;
        }

	    $lang = get_locale();
        if(empty($lang))
        	$lang = 'other';
        $fontFamily = 'dejavusans';
        if($lang == 'th')
        	$fontFamily = 'thsarabun';

        global $title;
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $title = esc_html__('Invoice-',ST_TEXTDOMAIN).$order_id;
        $pdf->SetTitle($title);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255));
        // set font
        $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 17 : 11));
        $pdf->AddPage();
        $blog_name = get_bloginfo('name');
        if(!empty($logo = st()->get_option('invoice_logo'))){
            $pdf->writeHTML('<img src="'.$logo.'" height="50" />', false, false, false, false, 'C');
            $pdf->Ln();
            $pdf->SetFont($fontFamily, 'B', ($lang == 'th' ? 24 : 18));
            $pdf->Cell(40, 8, html_entity_decode($blog_name), 0, 0, 'L');
            $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 17 : 11));
            $pdf->Ln();
        }else {
            $pdf->SetFont($fontFamily, 'B', ($lang == 'th' ? 24 : 18));
            $pdf->Cell(40, 8, html_entity_decode($blog_name), 0, 0, 'L');
            $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 17 : 11));
            $pdf->Ln();
        }
        $pdf->SetTextColor(34,209,109);
	    $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 18 : 11));
        $pdf->Cell(40, 8, esc_html__('Invoice', ST_TEXTDOMAIN));
        $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 21 : 15));
        $pdf->SetTextColor(30,30,30);
        $pdf->Cell(150, 8, esc_html__('ID Invoice #', ST_TEXTDOMAIN).$order_id,0,0,'R');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont($fontFamily, '', ($lang == 'th' ? 16 : 11));
        $form_to = st_pdf_invoices_information_form_to($order_id,$order_data);
        $pdf->writeHTML($form_to);
        $service_type = $order_data->st_booking_post_type;
        $post_type_name = '';
        $c_type_name                  = get_post_type_object( $service_type );
        if(!empty($c_type_name->labels->singular_name)){
            $post_type_name                  = $c_type_name->labels->singular_name;
        }
        $pdf->Cell(40, 10, html_entity_decode(sprintf(esc_html__('YOUR ORDER %s',ST_TEXTDOMAIN),strtoupper($post_type_name))), 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFillColor(255,248,245);
        $pdf->SetTextColor(255,153,102);
        $pdf->SetDrawColor(255,231,219);
        //Order information
        st_pdf_invoices_create_service_information($pdf, $order_id , $order_data);
        st_pdf_invoices_create_price_information($pdf, $order_id , $order_data);
        $pdf->Cell(190,0, '', '', 'T');
        $pdf->Ln();
        $data_status =  STUser_f::_get_all_order_statuses();
        if(!empty($status_string = $data_status[$order_data->status])){
            if( isset( $order_data->cancel_refund_status ) && $order_data->cancel_refund_status == 'pending'){
                $status_string = __('Cancelling', ST_TEXTDOMAIN);
            }
        }
        $pdf->Cell(190, 10, html_entity_decode(esc_html__('Booking status: ',ST_TEXTDOMAIN)). $status_string, 0, 0, 'R');
        $pdf->Ln();
        $pdf->SetTextColor(30,30,30);
        $pdf->Cell(0, 10, html_entity_decode(esc_html__('ADDITIONAL INFO',ST_TEXTDOMAIN)), 0, 0, 'L');
        $pdf->Ln();
        $add_info_html = '<p>';
        if($order_data->type == "normal_booking") {
            $add_info_html .= esc_html__( ' Method of Payment: ' , ST_TEXTDOMAIN ) . STPaymentGateways::get_gatewayname( get_post_meta( $order_id , 'payment_method' , true ) ) . '<br>';
        }
        if($order_data->type == "woocommerce") {
            $st_woo = NEW ST_Woocommerce();
            $post_order_id = $st_woo->find_order_by_order_item_id($order_id);
            $payment_gateway = wc_get_payment_gateway_by_order( $post_order_id );
            $add_info_html .= esc_html__( ' Method of Payment: ' , ST_TEXTDOMAIN ) . $payment_gateway->get_title() . '<br>';
        }
        $add_info_html .= esc_html__(' Booking Date: ',ST_TEXTDOMAIN).date(get_option('date_format'), strtotime($order_data->created)).'<br>';
        $add_info_html .= esc_html__(' Invoice Date: ',ST_TEXTDOMAIN).date(get_option('date_format')).'<br>';
        if(!empty($re_number = st()->get_option('invoice_registration_number',''))) {
            $add_info_html .= esc_html__(' Vendor Company Registration #: ', ST_TEXTDOMAIN) . $re_number .'<br>';
        }
        if(!empty($tax_number = st()->get_option('invoice_tax_vat_number',''))) {
            $add_info_html .= esc_html__(' Tax / VAT Number #: ', ST_TEXTDOMAIN) . $tax_number .'<br>';
        }
        $add_info_html .= '</p>';
        $pdf->writeHTML($add_info_html);
        $pdf->Ln();
	    ob_clean();
        $pdf->Output('invoice-'.$order_id.'.pdf','I');
    }
}
if(!function_exists('wb_pdf_invoices_information_form_to')){
    function st_pdf_invoices_information_form_to($order_id,$order_data){
        $full_name = $email = $address  = $phone = $postcode_zip = $fist_name = $last_name = "";
        if($order_data->type == "normal_booking"){
            if(!empty($c_email = get_post_meta($order_id,'st_email',true))){
                $email = $c_email.'<br>';
            }
            if(!empty($c_fist_name = get_post_meta($order_id,'st_first_name',true))){
                $fist_name = $c_fist_name;
            }
            if(!empty($c_last_name = get_post_meta($order_id,'st_last_name',true))){
                $last_name = $c_last_name;
            }
            $full_name = $fist_name.' '.$last_name.'<br>';

            if(!empty($c_phone = get_post_meta($order_id,'st_phone',true))){
                $phone = esc_html__("Tel: ").$c_phone.'<br>';
            }
            if(!empty($c_address = get_post_meta($order_id,'st_address',true))){
                $address = $c_address.'<br>';
            }
            if(!empty($c_postcode_zip = get_post_meta($order_id,'st_zip_code',true))){
                $postcode_zip = esc_html__("ZIP Code: ").$c_postcode_zip;
            }
        }
        if($order_data->type == "woocommerce"){
            $st_woo = NEW ST_Woocommerce();
            $post_order_id = $st_woo->find_order_by_order_item_id($order_id);
            if(!empty($c_email = get_post_meta($post_order_id,'_billing_email',true))){
                $email = $c_email.'<br>';
            }
            if(!empty($c_fist_name = get_post_meta($post_order_id,'_billing_first_name',true))){
                $fist_name = $c_fist_name;
            }
            if(!empty($c_last_name = get_post_meta($post_order_id,'_billing_last_name',true))){
                $last_name = $c_last_name;
            }
            $full_name = $fist_name.' '.$last_name.'<br>';

            if(!empty($c_phone = get_post_meta($post_order_id,'_billing_phone',true))){
                $phone = esc_html__("Tel: ").$c_phone.'<br>';
            }
            if(!empty($c_address = get_post_meta($post_order_id,'_billing_address_1',true))){
                $address = $c_address.'<br>';
            }
            if(!empty($c_postcode_zip = get_post_meta($post_order_id,'_billing_postcode',true))){
                $postcode_zip = esc_html__("ZIP Code: ").$c_postcode_zip;
            }
        }
        $form_html = '';
        if(!empty($company_name = st()->get_option('invoice_company_name', ''))){
            $form_html .= $company_name.'<br>';
        }
        if(!empty($company_address = st()->get_option('invoice_address', ''))){
            $form_html .= $company_address.'<br>';
        }
        if(!empty($c_phone = st()->get_option('invoice_phone_number', ''))){
            $form_html .= esc_html__("Tel: ").$c_phone.'<br>';
        }
        if(!empty($zip_code = st()->get_option('invoice_zpc', ''))){
            $form_html .= esc_html__("ZIP Code: ").$zip_code.'<br>';
        }
        $form_to = '<table style="line-height: 1.7">
                        <tr>
                            <th style="font-weight: bold">'.esc_html__('From:', ST_TEXTDOMAIN).' </th>
                            <th style="font-weight: bold">'.esc_html__('To:', ST_TEXTDOMAIN).' </th>
                        </tr>
                        <tr>
                            <td>'.$form_html.'</td>
                            <td>'.($full_name).($email).($address).($phone).($postcode_zip).'</td>
                        </tr>
                    </table>';
        return $form_to;
    }
}
if(!function_exists('st_pdf_invoices_create_price_information')) {
    function st_pdf_invoices_create_price_information($pdf, $order_id , $order_data){
        $pdf->SetTextColor(30, 30, 30);
        if($order_data->type == "normal_booking"){
            $st_booking_id = $order_data->st_booking_id;
            $data_price = get_post_meta( $order_id , 'data_prices' , true);
            $currency = get_post_meta($order_id, 'currency', true);
            switch(get_post_type($st_booking_id)){
                case "st_hotel":
                case "hotel_room":
                    $_st_room_num_search = $order_data->room_num_search;
                    $pdf->Cell(95, 10, esc_html__("Room Number",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, sprintf(esc_html__("%s room(s)"),$_st_room_num_search), '', 0, 'R');
                    $pdf->Ln();
                    $discount = get_post_meta($order_id , 'discount_rate' , true);
                    $item_price = get_post_meta($order_id , 'item_price' , true);
                    $diff= $order_data->check_out_timestamp - $order_data->check_in_timestamp;
                    $diff = $diff / (60 * 60 * 24);
                    if(!empty($discount)){
                        $pdf->Cell(95, 10, esc_html__("Room Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price,$currency)." x ".$diff." x ".$_st_room_num_search." = ".TravelHelper::format_money_from_db($item_price*$_st_room_num_search*$diff,$currency), '', 0, 'R');
                        $pdf->Ln();
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, "-".$discount."%  ", '', 0, 'R');
                    } else if($data_price['sale_price'] != $data_price['origin_price']){
                        $pdf->Cell(95, 10, esc_html__("Room Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($data_price['origin_price'],$currency)." -> ".TravelHelper::format_money_from_db($data_price['sale_price'],$currency), '', 0, 'R');
                    } else {
                        $pdf->Cell(95, 10, esc_html__("Room Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($data_price['sale_price'],$currency) , '', 0, 'R');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price,$currency)." x ".$diff." x ".$_st_room_num_search." = ".TravelHelper::format_money_from_db($item_price*$_st_room_num_search*$diff,$currency), '', 0, 'R');

                    }
                    $pdf->Ln();
                    break;
                case "st_rental":
                    $item_price = $data_price['origin_price'];
                    $item_price_sale = $data_price['sale_price'];
                    $discount = get_post_meta($order_id , 'discount_rate' , true);
                    if(!empty($discount)){
                        $pdf->Cell(95, 10, esc_html__("Rental Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price,$currency), '', 0, 'R');
                        $pdf->Ln();
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, "-".$discount."%  ", '', 0, 'R');
                    } else if($item_price != $item_price_sale){
                        $pdf->Cell(95, 10, esc_html__("Rental Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price,$currency)." -> ".TravelHelper::format_money_from_db($item_price_sale,$currency), '', 0, 'R');
                    } else {
                        $pdf->Cell(95, 10, esc_html__("Rental Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price,$currency) , '', 0, 'R');
                    }
                    $pdf->Ln();
                    break;
                case "st_cars":
                    $item_id = get_post_meta($order_id, 'item_id', true);
                    $item_price = get_post_meta($order_id , 'item_price' , true);
                    $discount = get_post_meta($order_id , 'discount_rate' , true);
                    if($item_id != 'car_transfer') {
                        $numberday = STCars::get_date_diff($order_data->check_in_timestamp, $order_data->check_out_timestamp, get_post_meta($order_id, 'duration_unit', true));
                        if (!empty($discount)) {
                            $pdf->Cell(95, 10, esc_html__("Car Price", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_price, $currency) . " x " . $numberday . " = " . TravelHelper::format_money_from_db($item_price * $numberday, $currency), '', 0, 'R');
                            $pdf->Ln();
                            $pdf->Cell(95, 10, esc_html__("Discount", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, "-" . $discount . "% ", '', 0, 'R');
                        } else if ($data_price['origin_price'] != $data_price['sale_price']) {
                            $pdf->Cell(95, 10, esc_html__("Car Price", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, TravelHelper::format_money_from_db($data_price['origin_price'], $currency) . " -> " . TravelHelper::format_money_from_db($data_price['sale_price'], $currency), '', 0, 'R');
                        } else {
                            $pdf->Cell(95, 10, esc_html__("Car Price", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, TravelHelper::format_money_from_db($data_price['sale_price'], $currency), '', 0, 'R');
                        }
                    }else{
                        $item_base_price = get_post_meta($order_id , 'base_price' , true);
                        $item_extra_price = get_post_meta($order_id, 'extra_price', true);
                        $pdf->Cell(95, 10, esc_html__("Car Price", ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_base_price, $currency), '', 0, 'R');
                        if(!empty($item_extra_price)){
                            $pdf->Ln();
                            $pdf->Cell(95, 10, esc_html__("Extra Price", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, TravelHelper::format_money_from_db($item_extra_price, $currency), '', 0, 'R');
                        }
                        if (!empty($discount)) {
                            $pdf->Ln();
                            $pdf->Cell(95, 10, esc_html__("Discount", ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, "-" . $discount . "% ", '', 0, 'R');
                        }
                    }
                    $pdf->Ln();
                    break;
                case 'st_tours':
                case 'st_activity':
                    $_st_adult_price = get_post_meta($order_id , 'adult_price' , true);
                    $_st_adult_number = get_post_meta($order_id , 'adult_number' , true);
                    $_st_child_price = get_post_meta($order_id , 'child_price' , true);
                    $_st_child_number = get_post_meta($order_id , 'child_number' , true);
                    $_st_infant_price = get_post_meta($order_id , 'infant_price' , true);
                    $_st_infant_number = get_post_meta($order_id , 'infant_number' , true);
                    $discount = get_post_meta($order_id , 'discount_rate' , true);
                    if(!empty($_st_adult_price) and !empty($_st_adult_number)){
                        $pdf->Cell(95, 10, esc_html__("Adult Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_adult_number." x ".TravelHelper::format_money_from_db($_st_adult_price,$currency)." = ".TravelHelper::format_money_from_db($_st_adult_price*$_st_adult_number,$currency), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($_st_child_price) and !empty($_st_child_number)){
                        $pdf->Cell(95, 10, esc_html__("Child Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_child_number." x ".TravelHelper::format_money_from_db($_st_child_price,$currency)." = ".TravelHelper::format_money_from_db($_st_child_price*$_st_child_number,$currency), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($_st_infant_price) and !empty($_st_infant_number)){
                        $pdf->Cell(95, 10, esc_html__("Infant Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_infant_number." x ".TravelHelper::format_money_from_db($_st_infant_price,$currency)." = ".TravelHelper::format_money_from_db($_st_infant_price*$_st_infant_number,$currency), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($discount)){
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, "-".$discount."% ", '', 0, 'R');
                        $pdf->Ln();
                    }
                    break;
                case 'st_flight':
                    $price_type = array(
                        'eco_price' => esc_html__('Economy class', ST_TEXTDOMAIN),
                        'business_price' => esc_html__('Business class', ST_TEXTDOMAIN)
                    );
                    $depart_price = get_post_meta($order_id, 'depart_price', true);
                    $price_class_depart = get_post_meta($order_id, 'price_class_depart', true);
                    $tax_depart = get_post_meta($order_id, 'enable_tax_depart', true);
                    $tax_price_depart = get_post_meta($order_id, 'tax_price_depart', true);
                    $passenger = get_post_meta($order_id, 'passenger', true);
                    $flight_type = get_post_meta($order_id, 'flight_type', true);
                    $pdf->Cell(95, 10, esc_html__("Departure Price (".$price_type[$price_class_depart].')',ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, TravelHelper::format_money_from_db($depart_price,$currency), '', 0, 'R');
                    $pdf->Ln();
                    if($tax_depart == 'yes_not_included' && $tax_price_depart > 0){
                        $pdf->Cell(95, 10, esc_html__("Departure Tax",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($tax_price_depart, $currency), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if($flight_type == 'return'){
                        $return_price = get_post_meta($order_id, 'return_price', true);
                        $price_class_return = get_post_meta($order_id, 'price_class_return', true);
                        $pdf->Cell(95, 10, esc_html__("Return Price (".$price_type[$price_class_return].')',ST_TEXTDOMAIN), 'T');
                        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($return_price, $currency), 'T', 0, 'R');
                        $pdf->Ln();
                        $tax_return = get_post_meta($order_id, 'enable_tax_return', true);
                        $tax_price_return = get_post_meta($order_id, 'tax_price_return', true);
                        if($tax_return == 'yes_not_included' && $tax_price_return > 0){
                            $pdf->Cell(95, 10, esc_html__("Return Tax",ST_TEXTDOMAIN), '');
                            $pdf->Cell(95, 10, TravelHelper::format_money_from_db($tax_price_return, $currency), '', 0, 'R');
                            $pdf->Ln();
                        }
                    }

                    $pdf->Cell(95, 10, esc_html__("Passenger",ST_TEXTDOMAIN), 'T');
                    $pdf->Cell(95, 10, $passenger, 'T', 0, 'R');
                    $pdf->Ln();
                    break;
            }

            //extra
            $item_id = get_post_meta($order_id, 'item_id', true);
            if($item_id != 'car_transfer'){
                $extra_price = floatval(get_post_meta($order_id, 'extra_price', true));
                if(!empty($extra_price)){
                    $pdf->Cell(95, 10, esc_html__("Extra Price"), '');
                    $pdf->Cell(95, 10, TravelHelper::format_money_from_db($extra_price,$currency), '', 0, 'R');
                    $pdf->Ln();
                }
            }
            //Tour Package
            $hotel_package = get_post_meta($order_id, 'package_hotel', true);
            $hotel_package_price = floatval(get_post_meta($order_id, 'package_hotel_price', true));
            if(!empty($hotel_package)){
                $pdf->Cell(95, 10, esc_html__("Hotel Package Price"), '');
                $pdf->Cell(95, 10, TravelHelper::format_money_from_db($hotel_package_price,$currency), '', 0, 'R');
                $pdf->Ln();
            }

            $activity_package = get_post_meta($order_id, 'package_activity', true);
            $activity_package_price = floatval(get_post_meta($order_id, 'package_activity_price', true));
            if(!empty($activity_package)){
                $pdf->Cell(95, 10, esc_html__("Activity Package Price"), '');
                $pdf->Cell(95, 10, TravelHelper::format_money_from_db($activity_package_price,$currency), '', 0, 'R');
                $pdf->Ln();
            }

            $car_package = get_post_meta($order_id, 'package_car', true);
            $car_package_price = floatval(get_post_meta($order_id, 'package_car_price', true));
            if(!empty($car_package)){
                $pdf->Cell(95, 10, esc_html__("Car Package Price"), '');
                $pdf->Cell(95, 10, TravelHelper::format_money_from_db($car_package_price,$currency), '', 0, 'R');
                $pdf->Ln();
            }

	        $flight_package = get_post_meta($order_id, 'package_flight', true);
	        $flight_package_price = floatval(get_post_meta($order_id, 'package_flight_price', true));
	        if(!empty($flight_package)){
		        $pdf->Cell(95, 10, esc_html__("Flight Package Price"), '');
		        $pdf->Cell(95, 10, TravelHelper::format_money_from_db($flight_package_price,$currency), '', 0, 'R');
		        $pdf->Ln();
	        }
            /*$extras = wc_get_order_item_meta($order_id, '_st_extras', true);
            if(!empty($extras) and isset($extras['value']) && is_array($extras['value']) && count($extras['value'])){
                $pdf->Cell(95, 10, esc_html__("Extra:"), '');
                $pdf->Ln();
                foreach($extras['value'] as $name => $number){
                    $price_item = floatval($extras['price'][$name]);
                    if($price_item <= 0) $price_item = 0; $number_item = intval($extras['value'][$name]);
                    if($number_item <= 0) $number_item = 0;
                    if($number_item > 0){
                        $pdf->Cell(95, 10, html_entity_decode(" + ".esc_html($extras['title'][$name]). " - ".$number_item . __(' item(s)', ST_TEXTDOMAIN)), '');
                        $pdf->Cell(95, 10, wc_price($price_item,array( 'currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                }
            }*/
            if(get_post_type($st_booking_id) != 'st_flight') {
                $_st_price_equipment = get_post_meta($order_id, 'price_equipment', true);
                if (!empty($_st_price_equipment)) {
                    $pdf->Cell(95, 10, esc_html__("Equipment Price"), '');
                    $pdf->Cell(95, 10, TravelHelper::format_money_from_db($_st_price_equipment, $currency), '', 0, 'R');
                    $pdf->Ln();
                }

                $subtotal = get_post_meta($order_id, 'ori_price', true);
                $pdf->Cell(95, 10, esc_html__("Subtotal", ST_TEXTDOMAIN), 'T');
                $pdf->Cell(95, 10, TravelHelper::format_money_from_db($subtotal, $currency), 'T', 0, 'R');
                $pdf->Ln();

                $coupon_price = isset($data_price['coupon_price']) ? $data_price['coupon_price'] : 0;
                if (!empty($coupon_price)) {
                    $pdf->Cell(95, 10, esc_html__('Coupon', ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, " -" . TravelHelper::format_money_from_db($coupon_price, $currency), '', 0, 'R');
                    $pdf->Ln();
                }
                $tax = intval(get_post_meta($order_id, 'st_tax_percent', true));
                if (!empty($tax) or $tax == 0) {
                    $pdf->Cell(95, 10, esc_html__("Tax",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, $tax . ' %', '', 0, 'R');
                    $pdf->Ln();
                }
            }
            $price_with_tax = isset($data_price['price_with_tax']) ? $data_price['price_with_tax'] : 0;
            $total_price = isset($data_price['total_price']) ? $data_price['total_price'] : 0;
            $total_order = $order_data->total_order;
            $deposit_price = isset($data_price['deposit_price']) ? $data_price['deposit_price'] : 0;
            $booking_fee_price = isset($data_price['booking_fee_price']) ? $data_price['booking_fee_price'] : 0;
            $deposit_status = get_post_meta($order_id, 'deposit_money', true);
            if(is_array($deposit_status) && !empty($deposit_status['type']) && floatval($deposit_status['amount']) > 0){
                if(!empty($booking_fee_price)){
                    $total_order = $total_order - $booking_fee_price;
                }
                $price_with_tax = STPrice::getTotalPriceWithTaxInOrder($total_order,$order_id);
                $pdf->Cell(95, 10, esc_html__('Total', ST_TEXTDOMAIN), '');
                $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($price_with_tax,$currency)), '', 0, 'R');
                $pdf->Ln();
                $pdf->Cell(95, 10, esc_html__('Deposit', ST_TEXTDOMAIN), '');
                $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($deposit_price,$currency)), '', 0, 'R');
                $pdf->Ln();
                if(!empty($booking_fee_price)){
                    $pdf->Cell(95, 10, esc_html__('Fee', ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($booking_fee_price,$currency)), '', 0, 'R');
                    $pdf->Ln();
                }
                $pdf->Cell(95, 10, esc_html__('Pay Amount', ST_TEXTDOMAIN), 'T');
                $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($total_price,$currency)), 'T', 0, 'R');
                $pdf->Ln();
            }else{
                if(!empty($booking_fee_price)){
                    $pdf->Cell(95, 10, esc_html__('Fee', ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($booking_fee_price,$currency)), '', 0, 'R');
                    $pdf->Ln();
                }
                $pdf->Cell(95, 10, esc_html__('Pay Amount', ST_TEXTDOMAIN), 'T');
                $pdf->Cell(95, 10, (TravelHelper::format_money_from_db($price_with_tax + $booking_fee_price,$currency)), 'T', 0, 'R');
                $pdf->Ln();
            }
        }
        if($order_data->type == "woocommerce"){
            $st_booking_id = $order_data->st_booking_id;
            $st_woo = NEW ST_Woocommerce();
            $post_order_id = $st_woo->find_order_by_order_item_id($order_data->order_item_id);
            $order = wc_get_order( $post_order_id );
            switch(get_post_type($st_booking_id)){
                case "st_hotel":
                case "hotel_room":
                    $_st_room_num_search = wc_get_order_item_meta($order_id , '_st_room_num_search' , true);
                    $pdf->Cell(95, 10, esc_html__("Room Number",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, sprintf(esc_html__("%s room(s)"),$_st_room_num_search), '', 0, 'R');
                    $pdf->Ln();
                    $item_price = wc_get_order_item_meta($order_id , '_st_item_price' , true);
                    $discount = wc_get_order_item_meta($order_id , '_st_discount_rate' , true);
                    $diff= $order_data->check_out_timestamp - $order_data->check_in_timestamp;
                    $diff = $diff / (60 * 60 * 24);
                    $pdf->Cell(95, 10, esc_html__("Room Price",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, wc_price($item_price,array( 'currency' => $order->get_currency()))." x ".$diff." x ".$_st_room_num_search." = ".wc_price($item_price*$diff*$_st_room_num_search,array( 'currency' => $order->get_currency())), '', 0, 'R');
                    if(!empty($discount)){
                        $pdf->Ln();
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, "-".$discount."%  ", '', 0, 'R');
                    }
                    $pdf->Ln();
                    break;
                case 'st_rental':
                    $item_price = wc_get_order_item_meta($order_id , '_st_item_price' , true);
                    $discount = wc_get_order_item_meta($order_id , '_st_discount_rate' , true);
                    $pdf->Cell(95, 10, esc_html__("Rental Price",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, wc_price($item_price,array( 'currency' => $order->get_currency())), '', 0, 'R');
                    $pdf->Ln();
                    if(!empty($discount)){
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, "-".$discount."%  ", '', 0, 'R');
                        $pdf->Ln();
                    }
                    break;
                case 'st_cars':
                    $item_price = wc_get_order_item_meta($order_id , '_st_item_price' , true);
                    $discount = wc_get_order_item_meta($order_id , '_st_discount_rate' , true);
                    $numberday = STCars::get_date_diff( $order_data->check_in_timestamp, $order_data->check_out_timestamp, get_post_meta($order_id , 'duration_unit' , true) );
                    $pdf->Cell(95, 10, esc_html__("Car Price",ST_TEXTDOMAIN), '');
                    $pdf->Cell(95, 10, wc_price($item_price,array( 'currency' => $order->get_currency()))." x ".$numberday." = ".wc_price($item_price*$numberday,array( 'currency' => $order->get_currency())), '', 0, 'R');
                    if(!empty($discount)) {
                        $pdf->Ln();
                        $pdf->Cell( 95 , 10 , esc_html__( "Discount" , ST_TEXTDOMAIN ) , '' );
                        $pdf->Cell( 95 , 10 , "-" . $discount . "% " , '' , 0 , 'R' );
                    }
                    $pdf->Ln();
                    break;
                case 'st_tours':
                case 'st_activity':
                    $_st_adult_price = wc_get_order_item_meta($order_id , '_st_adult_price' , true);
                    $_st_adult_number = wc_get_order_item_meta($order_id , '_st_adult_number' , true);
                    $_st_child_price = wc_get_order_item_meta($order_id , '_st_child_price' , true);
                    $_st_child_number = wc_get_order_item_meta($order_id , '_st_child_number' , true);
                    $_st_infant_price = wc_get_order_item_meta($order_id , '_st_infant_price' , true);
                    $_st_infant_number = wc_get_order_item_meta($order_id , '_st_infant_number' , true);
                    $discount = wc_get_order_item_meta($order_id , '_st_discount_rate' , true);
                    if(!empty($_st_adult_price) and !empty($_st_adult_number) ){
                        $pdf->Cell(95, 10, esc_html__("Adult Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_adult_number." x ".wc_price($_st_adult_price,array( 'currency' => $order->get_currency()))." = ".wc_price($_st_adult_price*$_st_adult_number,array( 'currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($_st_child_price) and !empty($_st_child_number) ){
                        $pdf->Cell(95, 10, esc_html__("Child Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_child_number." x ".wc_price($_st_child_price,array( 'currency' => $order->get_currency()))." = ".wc_price($_st_child_price*$_st_child_number,array( 'currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($_st_infant_price) and !empty($_st_infant_number) ){
                        $pdf->Cell(95, 10, esc_html__("Infant Price",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $_st_infant_number." x ".wc_price($_st_infant_price,array( 'currency' => $order->get_currency()))." = ".wc_price($_st_infant_price*$_st_infant_number,array( 'currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                    if(!empty($discount)){
                        $pdf->Cell(95, 10, esc_html__("Discount",ST_TEXTDOMAIN), '');
                        $pdf->Cell(95, 10, $discount."% ", '', 0, 'R');
                        $pdf->Ln();
                    }

                    break;
            }
            //extra
            /*$extras = wc_get_order_item_meta($order_id, '_st_extras', true);
            if(!empty($extras) and isset($extras['value']) && is_array($extras['value']) && count($extras['value'])){
                $pdf->Cell(95, 10, esc_html__("Extra:"), '');
                $pdf->Ln();
                foreach($extras['value'] as $name => $number){
                    $price_item = floatval($extras['price'][$name]);
                    if($price_item <= 0) $price_item = 0; $number_item = intval($extras['value'][$name]);
                    if($number_item <= 0) $number_item = 0;
                    if($number_item > 0){
                        $pdf->Cell(95, 10, html_entity_decode(" + ".esc_html($extras['title'][$name]). " - ".$number_item . __(' item(s)', ST_TEXTDOMAIN)), '');
                        $pdf->Cell(95, 10, wc_price($price_item,array( 'currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                }
            }*/
            $extra_price = wc_get_order_item_meta($order_id , '_st_extra_price' , true);
            if(!empty($extra_price)){
                $pdf->Cell(95, 10, esc_html__("Extra Price"), '');
                $pdf->Cell(95, 10, wc_price($extra_price,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }
            //Tour Package
            $hotel_package = wc_get_order_item_meta($order_id , '_st_package_hotel', true);
            $hotel_package_price = floatval(wc_get_order_item_meta($order_id , '_st_package_hotel_price', true));
            if(!empty($hotel_package)){
                $pdf->Cell(95, 10, esc_html__("Hotel Package Price"), '');
                $pdf->Cell(95, 10, wc_price($hotel_package_price,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }

            $activity_package = wc_get_order_item_meta($order_id , '_st_package_activity', true);
            $activity_package_price = floatval(wc_get_order_item_meta($order_id , '_st_package_activity_price', true));
            if(!empty($activity_package)){
                $pdf->Cell(95, 10, esc_html__("Activity Package Price"), '');
                $pdf->Cell(95, 10, wc_price($activity_package_price,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }

            $car_package = wc_get_order_item_meta($order_id , '_st_package_car', true);
            $car_package_price = floatval(wc_get_order_item_meta($order_id , '_st_package_car_price', true));
            if(!empty($car_package)){
                $pdf->Cell(95, 10, esc_html__("Car Package Price"), '');
                $pdf->Cell(95, 10, wc_price($car_package_price,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }
            //End Tour package
            $_st_price_equipment = wc_get_order_item_meta($order_id , '_st_price_equipment' , true);
            if(!empty($_st_price_equipment)){
                $pdf->Cell(95, 10, esc_html__("Equipment Price"), '');
                $pdf->Cell(95, 10, wc_price($_st_price_equipment,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }

            $sub_total = $order->get_subtotal();
            $pdf->Cell(95, 10, esc_html__("Sub Total"), '');
            $pdf->Cell(95, 10, wc_price($sub_total,array( 'currency' => $order->get_currency())), '', 0, 'R');
            $pdf->Ln();

            $tax = $order->get_total_tax();
            if(!empty($tax) or $tax == 0){
                $pdf->Cell(95, 10, esc_html__("Tax"), '');
                $pdf->Cell(95, 10, wc_price($tax,array( 'currency' => $order->get_currency())), '', 0, 'R');
                $pdf->Ln();
            }

            $ij = 0;
            foreach ( $order->get_items() as $key => $item ) {
                $fee_price = wc_get_order_item_meta( $key, '_st_booking_fee_price' );
                if ($fee_price > 0){
                    if($ij == 0) {
                        $pdf->Cell(95, 10, esc_html__("Fee"), '');
                        $pdf->Cell(95, 10, wc_price($fee_price, array('currency' => $order->get_currency())), '', 0, 'R');
                        $pdf->Ln();
                    }
                    $ij++;
                }
            }

            $pdf->Cell(95, 10, esc_html__('Pay Amount', ST_TEXTDOMAIN), 'T');
            $pdf->Cell(95, 10, wc_price(STUser_f::_get_order_total_price($order_id,true),array( 'currency' => $order->get_currency())), 'T', 0, 'R');
            $pdf->Ln();
        }
    }
}
if(!function_exists('st_pdf_invoices_create_service_information')) {
    function st_pdf_invoices_create_service_information($pdf, $order_id , $order_data){
        $service_type = $order_data->st_booking_post_type;
        $date_format = TravelHelper::getDateFormat();
        switch($service_type){
            case 'st_hotel':
                $post_id = $order_data->st_booking_id;
                $pdf->Cell(190, 15, html_entity_decode(esc_attr(get_the_title($post_id))), '', 0, 'L', true);
                $pdf->Ln();
                $pdf->SetTextColor(30, 30, 30);
                $pdf->SetFillColor(255, 255, 255);
                //room
                $room_id= $order_data->room_id;
                if(!empty($room_id)){
                    $pdf->Cell(95, 10, html_entity_decode(esc_html__("Room Name: ",ST_TEXTDOMAIN).get_the_title($room_id)));
                    $pdf->Ln(10);
                }
                //Date
                if (!empty($order_data->check_in_timestamp)) {
                    $start_date = date_i18n($date_format, $order_data->check_in_timestamp);
                    $end_date = date_i18n($date_format, $order_data->check_out_timestamp);
                    $diff= $order_data->check_out_timestamp - $order_data->check_in_timestamp;
                    $diff = $diff / (60 * 60 * 24);
                    $pdf->Cell(95, 8, esc_html__('From: ', ST_TEXTDOMAIN) . $start_date. esc_html__(' - To: ',ST_TEXTDOMAIN).$end_date, '', 0, 'L', true);
                    $pdf->Cell(95, 8, sprintf(esc_html__("%s night(s)"),$diff), '', 0, 'R');
                    $pdf->Ln();
                }
                break;
            case 'hotel_room':
            case 'st_rental':
                $post_id = $order_data->st_booking_id;
                $pdf->Cell(190, 15, html_entity_decode(esc_attr(get_the_title($post_id))), '', 0, 'L', true);
                $pdf->Ln();
                $pdf->SetTextColor(30, 30, 30);
                $pdf->SetFillColor(255, 255, 255);
                $address=get_post_meta($post_id,'address',true);
                if(!empty($address)){
                    $pdf->Cell(190, 10, html_entity_decode(esc_html__("Address: ",ST_TEXTDOMAIN).$address));
                    $pdf->Ln(10);
                }
                if (!empty($order_data->check_in_timestamp)) {
                    $start_date = date_i18n($date_format, $order_data->check_in_timestamp);
                    $end_date = date_i18n($date_format, $order_data->check_out_timestamp);
                    $diff= $order_data->check_out_timestamp - $order_data->check_in_timestamp;
                    $diff = $diff / (60 * 60 * 24);
                    $pdf->Cell(95, 8, esc_html__('From: ', ST_TEXTDOMAIN) . $start_date. esc_html__(' - To: ',ST_TEXTDOMAIN).$end_date, 'T', 0, 'L', true);
                    $pdf->Cell(95, 8, sprintf(esc_html__("%s night(s)"),$diff), 'T', 0, 'R');
                    $pdf->Ln();
                }

                break;
            case 'st_tours':
            case 'st_activity':
                $post_id = $order_data->st_booking_id;
	            $_st_tour_price_by = get_post_meta($order_id, 'price_type', true);

                $pdf->Cell(190, 15, html_entity_decode(esc_attr(get_the_title($post_id))), '', 0, 'L', true);
                $pdf->Ln();
                $pdf->SetTextColor(30, 30, 30);
                $pdf->SetFillColor(255, 255, 255);

                //
	            if($service_type == 'st_tours' and $_st_tour_price_by == 'fixed_depart') {
			        $tour_type_price = __( 'Fixed Departure', ST_TEXTDOMAIN );

			        $pdf->Cell( 190, 15, html_entity_decode( esc_attr( $tour_type_price ) ), '', 0, 'L', true );
			        $pdf->Ln();
	            }
                //Date
                if (!empty($order_data->check_in_timestamp)) {
                    $start_date = TourHelper::getDayFromNumber(date('N', $order_data->check_in_timestamp)) . ' ' . date_i18n($date_format, $order_data->check_in_timestamp);
                    $end_date = TourHelper::getDayFromNumber(date('N', $order_data->check_out_timestamp)) . ' ' . date_i18n($date_format, $order_data->check_out_timestamp);
                    $pdf->Cell(190, 8, esc_html__('From: ', ST_TEXTDOMAIN) . $start_date. esc_html__(' - To: ',ST_TEXTDOMAIN).$end_date, '', 0, 'L', true);
                    $pdf->Ln();
                    if(($service_type == 'st_tours' || $service_type == 'st_activity') && trim($order_data->starttime) != ''){
	                    $pdf->Cell(190, 8, esc_html__('Start Time: ', ST_TEXTDOMAIN) . $order_data->starttime);
	                    $pdf->Ln();
                    }
                }
                $address=get_post_meta($post_id,'address',true);
                if(!empty($address)){
                    $pdf->Cell(190, 10, html_entity_decode(esc_html__("Address: ",ST_TEXTDOMAIN).$address));
                    $pdf->Ln(10);
                }
                break;
            case 'st_cars':
                $post_id = $order_data->st_booking_id;
                $pdf->Cell(190, 15, html_entity_decode(esc_attr(get_the_title($post_id))), '', 0, 'L', true);
                $pdf->Ln();
                $pdf->SetTextColor(30, 30, 30);
                $pdf->SetFillColor(255, 255, 255);
                $pickup = $dropoff = '';
                if($order_data->type == "woocommerce"){
                    $pickup=wc_get_order_item_meta($order_id,'_st_pick_up',true);
                    $dropoff=wc_get_order_item_meta($order_id,'_st_drop_off',true);
                    $unit =  wc_get_order_item_meta($order_id , '_st_duration_unit' , true);
                }
                if($order_data->type == "normal_booking"){
                    $pickup=get_post_meta($order_id,'pick_up',true);
                    $dropoff=get_post_meta($order_id,'drop_off',true);
                    $unit =  get_post_meta($order_id , 'duration_unit' , true);
                }


                $unit_lable = '';
                switch ( $unit ) {
                    case "hour":
                        $unit_lable = __( "hours", ST_TEXTDOMAIN );
                        break;
                    case "day":
                        $unit_lable = __( "days", ST_TEXTDOMAIN );
                        break;
                    case "distance":
                        if ( st()->get_option( 'cars_price_by_distance', 'kilometer' ) == "kilometer" ) {
                            $unit_lable = __( "kilometers", ST_TEXTDOMAIN );
                        } else {
                            $unit_lable = __( "miles", ST_TEXTDOMAIN );
                        }
                        break;
                }


                $numberday = STCars::get_date_diff( $order_data->check_in_timestamp, $order_data->check_out_timestamp, $unit );

                $pdf->Cell(190, 8, esc_html__('Pick-up: ', ST_TEXTDOMAIN) . $pickup, '', 0, 'L', true);
                $pdf->Ln();
                $pdf->Cell(190, 8, esc_html__('Drop-off: ', ST_TEXTDOMAIN) . $dropoff, '', 0, 'L', true);
                $pdf->Ln();


                //Date
                if (!empty($order_data->check_in_timestamp)) {
                    $format=TravelHelper::getDateFormat();
                    $start_date = date_i18n($format.' '.get_option('time_format'), $order_data->check_in_timestamp);
                    $end_date = date_i18n($format.' '.get_option('time_format'), $order_data->check_out_timestamp);
                    $pdf->Cell(190, 8, esc_html__('Pick-up Time: ', ST_TEXTDOMAIN) . $start_date, '', 0, 'L', true);
                    $pdf->Ln();
                    $pdf->Cell(95, 8, esc_html__('Drop-off Time: ', ST_TEXTDOMAIN) . $end_date, '', 0, 'L', true);
                    $pdf->Cell(95, 8,$numberday.' '.$unit_lable, '', 0, 'R', true);
                    $pdf->Ln();
                }
                break;
            case 'st_flight':
                $raw_data = json_decode($order_data->raw_data);
                $title = '';
                if(!empty($raw_data->depart_data_location->origin_location_full) && !empty($raw_data->depart_data_location->destination_location_full)) {
                    $title .= $raw_data->depart_data_location->origin_location_full . ' ('. $raw_data->depart_data_location->origin_iata . ') - ' . $raw_data->depart_data_location->destination_location_full .' ('. $raw_data->depart_data_location->destination_iata.')';
                }
                $pdf->Cell(190, 15, html_entity_decode($title), '', 0, 'L', true);
                $pdf->Ln();
                $pdf->SetTextColor(30, 30, 30);
                $pdf->SetFillColor(255, 255, 255);
                if (!empty($order_data->check_in_timestamp)) {
                    $start_date = date_i18n($date_format, $order_data->check_in_timestamp);
                    $end_date = date_i18n($date_format, $order_data->check_out_timestamp);
                    $date_html = esc_html__('Departure Date: ', ST_TEXTDOMAIN).$start_date;
                    if(!empty($end_date)){
                        $date_html .= esc_html__(' - Return Date: ',ST_TEXTDOMAIN).$end_date;
                    }
                    $pdf->Cell(190, 8, $date_html, '', 0, 'L', true);
                    $pdf->Ln();
                }
                if(!empty($raw_data->depart_data_time->depart_time)){
                    $pdf->Cell(190, 8, esc_html__('Departure Time: ', ST_TEXTDOMAIN).$raw_data->depart_data_time->depart_time, '', 0, 'L', true);
                    $pdf->Ln();
                }
                if(!empty($raw_data->return_data_time->depart_time)){
                    $pdf->Cell(190, 8, esc_html__('Return Time: ', ST_TEXTDOMAIN).$raw_data->return_data_time->depart_time, '', 0, 'L', true);
                    $pdf->Ln();
                }
                break;
        }
    }
}

