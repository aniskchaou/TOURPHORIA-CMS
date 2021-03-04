<?php
return;
if(!class_exists('STGatewayPaypal_AdaptivePayment'))
{
    class STGatewayPaypal_AdaptivePayment extends STAbstactPaymentGateway
    {
        private $_gateway_id = 'st_paypal_adaptivepayment';

        function __construct()
        {
            add_filter('st_payment_gateway_st_paypal_adaptivepayment_name',array($this,'get_name'));
            add_action('st_schedule_to_execute_delay_payment_for_secondary_receivers',array($this,'_execute_delay_payment_on_scheduled'),10,1);
            add_action('init',array($this,'_handling_admin_execute_delay_payment_on_scheduled'),10);
            add_action('st_traveler_after_name_payment_method',array($this,'_add_info_after_name_payment_method'),10,1);
            add_action('st_traveler_after_name_payment_method_partner',array($this,'_add_info_after_name_payment_method_partner'),10,1);
            add_action( 'admin_notices', [$this,'_admin_notice'],10,1 );

            add_action('wp_ajax_st_refund_via_paypal_adaptive', array( $this, '_handling_refund') );
        }

        function _add_info_after_name_payment_method( $order_id )
        {
            $payment_mode   = get_post_meta( $order_id , 'st_payment_mode' , true );
            $payment_method = get_post_meta( $order_id , 'payment_method' , true );
            if($payment_method == $this->_gateway_id and !empty( $payment_mode )) {
                echo "<br>";
                echo "<b>" . esc_html__( "Type: " , ST_TEXTDOMAIN ) . "</b>";
                if("parallel" == $payment_mode) {
                    echo esc_html__( 'Parallel' , ST_TEXTDOMAIN );
                } elseif('chained' == $payment_mode) {
                    echo esc_html__( 'Chained' , ST_TEXTDOMAIN );
                } else {
                    echo esc_html__( 'Delayed Chained' , ST_TEXTDOMAIN );
                }
                $st_is_split_payment_receive = get_post_meta( $order_id , 'st_is_split_payment_receive' , true );
                if("delayed_chained" == $payment_mode) {
                    echo "<br>";
                    if($st_is_split_payment_receive == "yes") {
                        $status = '<span class="status_split_complete">' . esc_html__( "Complete" , ST_TEXTDOMAIN ) . "</span>";
                    } else {
                        $status = '<span class="status_split_pending">' . esc_html__( "AwaitingPay" , ST_TEXTDOMAIN ) . "</span>";
                    }
                    echo "<b>" . esc_html__( "Status: " , ST_TEXTDOMAIN ) . "</b>" . $status;
                }
                if("delayed_chained" == $payment_mode and $st_is_split_payment_receive != "yes") {
                    echo "<br>";
                    $url = add_query_arg( 'st_execute_delay_payment' , $order_id );
                    echo '<a href="' . esc_url( $url ) . '">' . esc_html__( "Pay Now" , ST_TEXTDOMAIN ) . '</a>';
                }
            }
        }

        function _add_info_after_name_payment_method_partner( $order_id )
        {
            $payment_mode   = get_post_meta( $order_id , 'st_payment_mode' , true );
            $payment_method = get_post_meta( $order_id , 'payment_method' , true );
            if($payment_method == $this->_gateway_id and !empty( $payment_mode )) {
                echo "<br>";
                if("parallel" == $payment_mode) {
                    echo esc_html__( '- Parallel' , ST_TEXTDOMAIN );
                } elseif('chained' == $payment_mode) {
                    echo esc_html__( '- Chained' , ST_TEXTDOMAIN );
                } else {
                    echo esc_html__( '- Delayed Chained' , ST_TEXTDOMAIN );
                }
                $st_is_split_payment_receive = get_post_meta( $order_id , 'st_is_split_payment_receive' , true );
                if("delayed_chained" == $payment_mode) {
                    echo "<br>";
                    if($st_is_split_payment_receive == "yes") {
                        $status = '<span class="status_split_complete">' . esc_html__( "- Complete" , ST_TEXTDOMAIN ) . "</span>";
                    } else {
                        $status = '<span class="status_split_pending">' . esc_html__( "- AwaitingPay" , ST_TEXTDOMAIN ) . "</span>";
                    }
                    echo $status;
                }
            }
        }

        function _pre_checkout_validate()
        {
            return true;
        }

        function html()
        {
            echo st()->load_template( 'gateways/paypal_adaptivepayment' );
        }

        function check_complete_purchase( $order_id )
        {
            if($order_id and false !== get_post_status( $order_id )) {
                $response       = $this->_perform_pay_call( $order_id , 'PaymentDetails' );
                $payment_status = $response->status; // status of payment
                if($payment_status == 'COMPLETED' || $payment_status == 'PROCESSING' || $payment_status == 'INCOMPLETE') {
                    // check payment status
                    $payment_mode = get_post_meta( $order_id , 'st_payment_mode' , true );
                    $delay_period = get_post_meta( $order_id , 'st_delay_period' , true );
                    if($payment_mode == 'parallel' || $payment_mode == 'chained') {
                        update_post_meta( $order_id , 'st_is_split_payment_receive' , 'yes' );
                    }
                    //payment order details of delayed_chained
                    if($payment_mode == 'delayed_chained' && $delay_period > 0 && $payment_status == 'INCOMPLETE') {
                        update_post_meta( $order_id , 'st_is_split_payment_receive' , 'no' );
                        $timestamp = time() + (int)( $delay_period * 86400 );

                        //$timestamp = time() + (int)( $delay_period * 60 );
                        //$timestamp = time() + 60;
                        $this->_trigger_cron_event_to_schedule_delay_payment( $order_id , $timestamp );
                    }
                    return [ 'status' => true ];

                } else {
                    return [ 'status'  => false ,
                             'message' => __( 'Acknowledgement Received Payment Failed' , ST_TEXTDOMAIN )
                    ];
                }
            } else {
                return [ 'status' => false , 'message' => __( 'Order Code is not exists' , ST_TEXTDOMAIN ) ];
            }
        }

        function do_checkout( $order_id )
        {
            $apiUserAccount = st()->get_option( 'paypal_adaptivepayment_email' );
            $apiUserName    = st()->get_option( 'paypal_adaptivepayment_api_username' );
            $apiPass        = st()->get_option( 'paypal_adaptivepayment_api_password' );
            $apiSignature   = st()->get_option( 'paypal_adaptivepayment_api_signature' );
            $application_id = st()->get_option( 'paypal_adaptivepayment_application_id' );

            if(st()->get_option( 'paypal_adaptivepayment_enable_sandbox' , 'on' ) == 'on') {
                $paypal_pay_action_url           = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
                $paypal_pay_auth_without_key_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
            } else {
                $paypal_pay_action_url           = "https://svcs.paypal.com/AdaptivePayments/Pay";
                $paypal_pay_auth_without_key_url = "https://www.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=";
            }
            $ipnNotificationUrl = esc_url_raw( add_query_arg( array( 'ipn'         => 'set' ,
                                                                     'self_custom' => $order_id
            ) , site_url( '/' ) ) );
            $headers_array      = array(
                "X-PAYPAL-SECURITY-USERID"      => $apiUserName ,
                "X-PAYPAL-SECURITY-PASSWORD"    => $apiPass ,
                "X-PAYPAL-SECURITY-SIGNATURE"   => $apiSignature ,
                "X-PAYPAL-APPLICATION-ID"       => $application_id ,
                "X-PAYPAL-REQUEST-DATA-FORMAT"  => "NV" ,
                "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON" ,
            );
            $payment_mode       = st()->get_option( 'paypal_adaptivepayment_payment_mode' );
            if("parallel" == $payment_mode) {
                $memo          = 'Paypal Adaptive Parallel Payment';
                $paymentfeesby = st()->get_option( 'paypal_adaptivepayment_payment_parallel_fees' );
            } elseif('chained' == $payment_mode) {
                $memo          = 'Paypal Adaptive Chained Payment';
                $paymentfeesby = st()->get_option( 'paypal_adaptivepayment_payment_chained_fees' );
            } else {
                $memo          = 'Paypal Adaptive Delayed Chained Payment';
                $paymentfeesby = st()->get_option( 'paypal_adaptivepayment_payment_chained_fees' );
            }
            $total_payout                = get_post_meta( $order_id , 'total_price' , true );
            $ori_price                   = get_post_meta( $order_id , 'ori_price' , true );// Not deposit
            $booking_fee_price = get_post_meta( $order_id, 'booking_fee_price', true );
            if(!empty($booking_fee_price)){
                $ori_price = $ori_price + $booking_fee_price;
            }
            $total_payout                = round( (float)$total_payout , 2 );
            $ori_price                   = round( (float)$ori_price , 2 );
            $currency                    = TravelHelper::get_current_currency( 'name' );
            $booking_currency_conversion = st()->get_option( 'booking_currency_conversion' );
            if(!empty( $booking_currency_conversion )) {
                foreach( $booking_currency_conversion as $k => $v ) {
                    if($v[ 'name' ] == $currency) {
                        $total_payout = $total_payout / $v[ 'rate' ];
                        $total_payout = round( (float)$total_payout , 2 );

                        $ori_price = $ori_price / $v[ 'rate' ];
                        $ori_price = round( (float)$ori_price , 2 );
                        $currency  = "USD";
                    }
                }
            }
            //setting default and primary user datas
            $data_purchase = array(
                'actionType'                    => "PAY" ,
                'feesPayer'                     => $paymentfeesby ,
                'returnUrl'                     => $this->get_return_url( $order_id ) ,
                'cancelUrl'                     => $this->get_cancel_url( $order_id ) ,
                'custom'                        => $order_id ,
                'memo'                          => $memo ,
                'ipnNotificationUrl'            => $ipnNotificationUrl ,
                'requestEnvelope.errorLanguage' => 'en_US' ,
                'currencyCode'                  => $currency ,
                'description'                   => sprintf( __( '%s Booking' , ST_TEXTDOMAIN ) , get_bloginfo( 'title' ) ) ,
            );
            $is_partner    = false;
            $item_id       = get_post_meta( $order_id , 'item_id' , true );
            $g_post        = get_post( $item_id );
            $partner_id    = $g_post->post_author;
            $current_user  = get_userdata( $partner_id );
            if(!empty( $current_user->roles ) and in_array( 'partner' , $current_user->roles )) {
                $is_partner = true;
            }
            $commission     = get_post_meta( $order_id , 'commission' , true );
            $account_paypal = get_user_meta( $partner_id , 'st_paypal_email' , true );
            $is_pay_partner = false;
            if($is_partner) {
                $admin_price = ( $ori_price / 100 ) * (float)$commission;
                $parter_price   = $total_payout - $admin_price;
                if( $parter_price > 0 AND $admin_price > 0 ){
                    $is_pay_partner = true;
                    if($payment_mode == "parallel") {
                        $data_purchase[ 'actionType' ]                      = "PAY";
                        $data_purchase[ 'receiverList.receiver(0).amount' ] = $admin_price;
                        $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
                        $data_purchase[ 'receiverList.receiver(1).amount' ] = $parter_price;
                        $data_purchase[ 'receiverList.receiver(1).email' ]  = $account_paypal;
                    } elseif($payment_mode == "chained" or $payment_mode == "delayed_chained") {
                        $parter_price                                        = $total_payout - ( $total_payout / 100 ) * (float)$commission;
                        $data_purchase[ 'receiverList.receiver(0).amount' ]  = $total_payout;
                        $data_purchase[ 'receiverList.receiver(0).email' ]   = $apiUserAccount;
                        $data_purchase[ 'receiverList.receiver(0).primary' ] = 'true';
                        $data_purchase[ 'receiverList.receiver(1).amount' ]  = $parter_price;
                        $data_purchase[ 'receiverList.receiver(1).email' ]   = $account_paypal;
                        $data_purchase[ 'receiverList.receiver(1).primary' ] = 'false';
                        if($payment_mode == "delayed_chained") {
                            $data_purchase[ 'actionType' ] = "PAY_PRIMARY";
                        }
                    }
                }
                // for admin
                if($parter_price <= 0 and $admin_price > 0){
                    $payment_mode                                       = "parallel";
                    $paymentfeesby                                      = "EACHRECEIVER";
                    $data_purchase[ 'actionType' ]                      = "PAY";
                    $data_purchase[ 'feesPayer' ]                       = $paymentfeesby;
                    $data_purchase[ 'receiverList.receiver(0).amount' ] = $total_payout;
                    $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
                }
                // for partner
                if($admin_price <= 0 and $parter_price > 0){
                    $payment_mode                                       = "parallel";
                    $paymentfeesby                                      = "EACHRECEIVER";
                    $data_purchase[ 'actionType' ]                      = "PAY";
                    $data_purchase[ 'feesPayer' ]                       = $paymentfeesby;
                    $data_purchase[ 'receiverList.receiver(0).amount' ] = $total_payout;
                    $data_purchase[ 'receiverList.receiver(0).email' ]  = $account_paypal;
                }

            } else {
                $payment_mode                                       = "parallel";
                $paymentfeesby                                      = "EACHRECEIVER";
                $data_purchase[ 'actionType' ]                      = "PAY";
                $data_purchase[ 'feesPayer' ]                       = $paymentfeesby;
                $data_purchase[ 'receiverList.receiver(0).amount' ] = $total_payout;
                $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
            }
            $pay_result = $this->get_cURL_adaptive_split_response( $paypal_pay_action_url , $headers_array , $data_purchase );
            if($pay_result) {
                $jso = json_decode( $pay_result );
                if("Success" == $jso->responseEnvelope->ack) {
                    @$payment_url = $paypal_pay_auth_without_key_url . $jso->payKey;
                    update_post_meta( $order_id , 'st_payKey' , $jso->payKey );
                    update_post_meta( $order_id , 'st_payment_mode' , $payment_mode );
                    update_post_meta( $order_id , 'st_delay_period' , st()->get_option( 'paypal_adaptivepayment_delay_chained_period' , 1 ) );
                    update_post_meta( $order_id , 'st_feesPayer' , $paymentfeesby );
                    if($is_pay_partner) {
                        update_post_meta( $order_id , 'st_is_split_payment' , 'yes' );
                    } else {
                        update_post_meta( $order_id , 'st_is_split_payment' , 'no' );
                    }
                    update_post_meta( $order_id , 'st_is_split_payment_receive' , 'no' );
                    update_post_meta( $order_id , 'st_order_recievers' , $data_purchase );
                    //redirect to paypal
                    return array(
                        'status'   => true ,
                        'redirect' => $payment_url
                    );
                } else {
                    return array(
                        'status'  => false ,
                        'message' => $jso->error[ 0 ]->message ,
                        'data'    => '' ,
                    );
                }
            } else {
                return array(
                    'status'  => false ,
                    'message' => __( 'Sorry, Something went wrong' , ST_TEXTDOMAIN ) ,
                    'data'    => '' ,
                );
            }
        }


        function get_name()
        {
            return __( 'Paypal Adaptive' , ST_TEXTDOMAIN );
        }

        function is_available( $item_id = false )
        {
            if(!class_exists( 'STGatewayPaypal_AdaptivePayment' )) {
                return false;
            }
            $result = false;
            if(st()->get_option( 'pm_gway_st_paypal_adaptivepayment_enable' ) == 'on') {
                $result = true;
            }
            if($item_id) {
                $meta = get_post_meta( $item_id , 'is_meta_payment_gateway_st_paypal_adaptivepayment' , true );
                if($meta == 'off') {
                    $result = false;
                }
            }
            return $result;
        }

        function get_option_fields()
        {
            return array(
                array(
                    'id'      => 'paypal_adaptivepayment_email' ,
                    'label'   => __( 'Paypal Email' , ST_TEXTDOMAIN ) ,
                    'type'    => 'text' ,
                    'section' => 'option_pmgateway' ,
                    'desc'    => __( 'Your Payal Email Account' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_payment_mode' ,
                    'label'   => __( "Payment Mode" , ST_TEXTDOMAIN ) ,
                    'type'    => 'select' ,
                    'choices' => array(
                        array(
                            'value' => 'parallel' ,
                            'label' => __( 'Parallel' , ST_TEXTDOMAIN )

                        ) ,
                        array(
                            'value' => 'chained' ,
                            'label' => __( 'Chained' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => 'delayed_chained' ,
                            'label' => __( 'Delayed Chained' , ST_TEXTDOMAIN )
                        ) ,
                    ) ,
                    'section' => 'option_pmgateway' ,
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,

                array(
                    'id'      => 'paypal_adaptivepayment_payment_parallel_fees' ,
                    'label'   => __( "Payment Parallel Fees by" , ST_TEXTDOMAIN ) ,
                    'type'    => 'select' ,
                    'choices' => array(
                        array(
                            'value' => 'SENDER' ,
                            'label' => __( 'Sender' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => 'EACHRECEIVER' ,
                            'label' => __( 'Each Receiver' , ST_TEXTDOMAIN )
                        ) ,
                    ) ,
                    'section' => 'option_pmgateway' ,
                    'condition' => 'paypal_adaptivepayment_payment_mode:is(parallel),pm_gway_' . $this->_gateway_id . '_enable:is(on)' ,
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_payment_chained_fees' ,
                    'label'   => __( "Payment Chained Fees by" , ST_TEXTDOMAIN ) ,
                    'type'    => 'select' ,
                    'choices' => array(
                        array(
                            'value' => 'PRIMARYRECEIVER' ,
                            'label' => __( 'Primary Receiver' , ST_TEXTDOMAIN )
                        ) ,
                        array(
                            'value' => 'EACHRECEIVER' ,
                            'label' => __( 'Each Receiver' , ST_TEXTDOMAIN )
                        ) ,
                    ) ,
                    'section' => 'option_pmgateway' ,
                    'condition' => 'paypal_adaptivepayment_payment_mode:not(parallel),pm_gway_' . $this->_gateway_id . '_enable:is(on)' ,
                ) ,
                array(
                    'id'           => 'paypal_adaptivepayment_delay_chained_period' ,
                    'label'        => __( 'No. of Days to Execute Payment to Receiver' , ST_TEXTDOMAIN ) ,
                    'std'          => '90' ,
                    'type'         => 'text' ,
                    'section'      => 'option_pmgateway' ,
                    'min' => '1',
                    'max' => '90',
                    'step' => '1',
                    'condition' => 'paypal_adaptivepayment_payment_mode:is(delayed_chained),pm_gway_' . $this->_gateway_id . '_enable:is(on)' ,
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_enable_sandbox' ,
                    'label'   => __( 'Paypal Enable Sandbox' , ST_TEXTDOMAIN ) ,
                    'type'    => 'on-off' ,
                    'section' => 'option_pmgateway' ,
                    'std'     => 'on' ,
                    'desc'    => __( 'Allow you to enable sandbox mod for testing' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_api_username' ,
                    'label'   => __( 'Paypal API Username' , ST_TEXTDOMAIN ) ,
                    'type'    => 'text' ,
                    'section' => 'option_pmgateway' ,
                    'desc'    => __( 'Your Paypal API Username' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_api_password' ,
                    'label'   => __( 'Paypal API Password' , ST_TEXTDOMAIN ) ,
                    'type'    => 'text' ,
                    'section' => 'option_pmgateway' ,
                    'desc'    => __( 'Your Paypal API Password' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_api_signature' ,
                    'label'   => __( 'Paypal API Signature' , ST_TEXTDOMAIN ) ,
                    'type'    => 'text' ,
                    'section' => 'option_pmgateway' ,
                    'desc'    => __( 'Your Paypal API Signature' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                ) ,
                array(
                    'id'      => 'paypal_adaptivepayment_application_id' ,
                    'label'   => __( 'Application ID' , ST_TEXTDOMAIN ) ,
                    'type'    => 'text' ,
                    'section' => 'option_pmgateway' ,
                    'desc'    => __( 'Your Paypal API Signature' , ST_TEXTDOMAIN ),
                    'condition' => 'pm_gway_' . $this->_gateway_id . '_enable:is(on)'
                )
            );
        }

        function get_default_status()
        {
            return true;
        }

        function is_check_complete_required()
        {
            return true;
        }

        function get_logo()
        {
            return get_template_directory_uri() . '/img/gateway/pp-logo.png';
        }

        function getGatewayId()
        {
            return $this->_gateway_id;
        }

        function _perform_pay_call( $orderid , $action )
        {
            // $action : ExecutePayment - PaymentDetails
            $apiUserName    = st()->get_option( 'paypal_adaptivepayment_api_username' );
            $apiPass        = st()->get_option( 'paypal_adaptivepayment_api_password' );
            $apiSignature   = st()->get_option( 'paypal_adaptivepayment_api_signature' );
            $application_id = st()->get_option( 'paypal_adaptivepayment_application_id' );
            $payKey         = get_post_meta( $orderid , 'st_payKey' , true );
            $headers_array  = array(
                "X-PAYPAL-SECURITY-USERID"      => $apiUserName ,
                "X-PAYPAL-SECURITY-PASSWORD"    => $apiPass ,
                "X-PAYPAL-SECURITY-SIGNATURE"   => $apiSignature ,
                "X-PAYPAL-APPLICATION-ID"       => $application_id ,
                "X-PAYPAL-REQUEST-DATA-FORMAT"  => "NV" ,
                "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON" ,
            );
            $data_array     = array(
                'payKey'                        => $payKey ,
                'requestEnvelope.errorLanguage' => 'en_US' ,
            );
            if(st()->get_option( 'paypal_adaptivepayment_enable_sandbox' , 'on' ) == 'on') {
                $pay_result = $this->get_cURL_adaptive_split_response( 'https://svcs.sandbox.paypal.com/AdaptivePayments/' . $action , $headers_array , $data_array );
            } else {
                $pay_result = $this->get_cURL_adaptive_split_response( 'https://svcs.paypal.com/AdaptivePayments/' . $action , $headers_array , $data_array );
            }
            $response = json_decode( $pay_result );
            return $response;
        }

        function _trigger_cron_event_to_schedule_delay_payment( $orderid , $timestamp )
        {
            if($timestamp >= 0) {
                if(!wp_next_scheduled( 'st_schedule_to_execute_delay_payment_for_secondary_receivers' , array( $orderid ) )) {
                    wp_schedule_single_event( $timestamp , 'st_schedule_to_execute_delay_payment_for_secondary_receivers' , array( $orderid ) );
                }
            }
        }

        function _handling_admin_execute_delay_payment_on_scheduled()
        {
            $order_id   = STInput::request( 'st_execute_delay_payment' );
            $is_checked = false;
            if(current_user_can( 'manage_options' )) {
                $is_checked = true;
            }
            $st_payKey       = get_post_meta( $order_id , 'st_payKey' , true );
            $st_payment_mode = get_post_meta( $order_id , 'st_payment_mode' , true );
            if(!empty( $order_id ) and $is_checked and !empty( $st_payKey ) and $st_payment_mode == "delayed_chained") {
                $this->_execute_delay_payment_on_scheduled( $order_id );
            }
        }


        function _handling_refund(){
            $res  = array(
                'status' => 'false',
                'message' => '',
            );
            $order_id   = STInput::request( 'order_id' );
            $is_checked = false;
            if(current_user_can( 'manage_options' )) {
                $is_checked = true;
            }
            $cancel_data = get_post_meta( $order_id, 'cancel_data', true);
            $st_payment_refund = get_post_meta( $order_id, 'st_payment_refund', true);
            if($is_checked and !empty($cancel_data) and $st_payment_refund != 'yes'){
                $ori_price                   = get_post_meta( $order_id , 'ori_price' , true );// Not deposit
                $booking_fee_price = get_post_meta( $order_id, 'booking_fee_price', true );
                if(!empty($booking_fee_price)){
                    $ori_price = $ori_price + $booking_fee_price;
                }
                $ori_price                   = round( (float)$ori_price , 2 );
                $currency                    = TravelHelper::get_current_currency( 'name' );
                $booking_currency_conversion = st()->get_option( 'booking_currency_conversion' );
                if(!empty( $booking_currency_conversion )) {
                    foreach( $booking_currency_conversion as $k => $v ) {
                        if($v[ 'name' ] == $currency) {
                            $ori_price = $ori_price / $v[ 'rate' ];
                            $ori_price = round( (float)$ori_price , 2 );
                            $currency  = "USD";
                        }
                    }
                }
                // Check Partner
                $is_partner    = false;
                $item_id       = get_post_meta( $order_id , 'item_id' , true );
                $g_post        = get_post( $item_id );
                $partner_id    = $g_post->post_author;
                $current_user  = get_userdata( $partner_id );
                if(!empty( $current_user->roles ) and in_array( 'partner' , $current_user->roles )) {
                    $is_partner = true;
                }
                $account_paypal = get_user_meta( $partner_id , 'st_paypal_email' , true );
                // Configs
                $apiUserAccount = st()->get_option( 'paypal_adaptivepayment_email' );
                $apiUserName    = st()->get_option( 'paypal_adaptivepayment_api_username' );
                $apiPass        = st()->get_option( 'paypal_adaptivepayment_api_password' );
                $apiSignature   = st()->get_option( 'paypal_adaptivepayment_api_signature' );
                $application_id = st()->get_option( 'paypal_adaptivepayment_application_id' );
                $payKey         = get_post_meta( $order_id , 'st_payKey' , true );
                $headers_array  = array(
                    "X-PAYPAL-SECURITY-USERID"      => $apiUserName ,
                    "X-PAYPAL-SECURITY-PASSWORD"    => $apiPass ,
                    "X-PAYPAL-SECURITY-SIGNATURE"   => $apiSignature ,
                    "X-PAYPAL-APPLICATION-ID"       => $application_id ,
                    "X-PAYPAL-REQUEST-DATA-FORMAT"  => "NV" ,
                    "X-PAYPAL-RESPONSE-DATA-FORMAT" => "JSON" ,
                );
                $data_purchase     = array(
                    'payKey'                        => $payKey ,
                    'requestEnvelope.errorLanguage' => 'en_US' ,
                    'currencyCode'                  => $currency ,
                );
                if($is_partner) {
                    $commission   = get_post_meta( $order_id , 'commission' , true );
                    $admin_price  = ( $ori_price / 100 ) * (float)$commission;
                    $partner_price = $ori_price - $admin_price;
                    // Admin - Partner Refund Price
                    $percent_refund_buyer  = 100 - $cancel_data[ 'cancel_percent' ];
                    if( $partner_price > 0 AND $admin_price > 0 ){
                        $amount_admin_refund   = $admin_price / 100 * $percent_refund_buyer;
                        $amount_partner_refund = $partner_price / 100 * $percent_refund_buyer;
                        $data_purchase[ 'receiverList.receiver(0).amount' ] = $cancel_data['refunded'];
                        $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
                        $data_purchase[ 'receiverList.receiver(1).amount' ] = $amount_partner_refund;
                        $data_purchase[ 'receiverList.receiver(1).email' ]  = $account_paypal;

                        $st_payment_mode = get_post_meta( $order_id , 'st_payment_mode' , true );
                        if($st_payment_mode == "delayed_chained") {
                            $this->_execute_delay_payment_on_scheduled( $order_id );
                        }
                        update_post_meta( $order_id , 'amount_admin_refund' , $amount_admin_refund );
                        update_post_meta( $order_id , 'amount_partner_refund' , $amount_partner_refund );
                    }
                    // for admin
                    if($partner_price <= 0 and $admin_price > 0){
                        // Partner Refund
                        $data_purchase[ 'receiverList.receiver(0).amount' ] = $cancel_data['refunded'];
                        $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
                        update_post_meta( $order_id , 'amount_partner_refund' , $cancel_data['refunded'] );
                    }
                    // for partner
                    if($admin_price <= 0 and $partner_price > 0){
                        // Admin Refund
                        $data_purchase[ 'receiverList.receiver(0).amount' ] = $cancel_data['refunded'];
                        $data_purchase[ 'receiverList.receiver(0).email' ]  = $account_paypal;
                        update_post_meta( $order_id , 'amount_admin_refund' , $cancel_data['refunded'] );
                    }
                }else{
                    // Admin Refund
                    $data_purchase[ 'receiverList.receiver(0).amount' ] = $cancel_data['refunded'];
                    $data_purchase[ 'receiverList.receiver(0).email' ]  = $apiUserAccount;
                    update_post_meta( $order_id , 'amount_admin_refund' , $cancel_data['refunded'] );
                }
                if(st()->get_option( 'paypal_adaptivepayment_enable_sandbox' , 'on' ) == 'on') {
                    $pay_result = $this->get_cURL_adaptive_split_response( 'https://svcs.sandbox.paypal.com/AdaptivePayments/Refund' , $headers_array , $data_purchase );
                } else {
                    $pay_result = $this->get_cURL_adaptive_split_response( 'https://svcs.paypal.com/AdaptivePayments/Refund' , $headers_array , $data_purchase );
                }
                $response = json_decode( $pay_result );
                if($response->responseEnvelope->ack == "Success"){
                    update_post_meta( $order_id , 'st_payment_refund' , 'yes' );
                    $res['status'] = 'true';
                    $res['message'] = esc_html__("Refund success",ST_TEXTDOMAIN);
                    echo json_encode($res);
                    wp_die();
                }else{
                    $res['status'] = 'false';
                    $res['message'] = $response->error[ 0 ]->message;
                    echo json_encode($res);
                    wp_die();
                }
            }
            if($st_payment_refund == "yes"){
                $res['status'] = 'true';
                $res['message'] = esc_html__("You paid for the buyer",ST_TEXTDOMAIN);
                echo json_encode($res);
                wp_die();
            }
        }

        function _execute_delay_payment_on_scheduled( $order_id = false )
        {
            if(!empty( $order_id )) {
                //PaymentDetails
                //ExecutePayment
                $pay_respon = $this->_perform_pay_call( $order_id , 'ExecutePayment' );
                if($pay_respon->responseEnvelope->ack == "Failure") {
                    global $st_paypal_adaptivepayment_admin_notice;
                    $st_paypal_adaptivepayment_admin_notice[ 'status' ] = 'error';
                    $message                                            = sprintf( esc_html__( "This order #%s cannot execute payment for partner" , ST_TEXTDOMAIN ) , $order_id );
                    $message .= "<br>" . esc_html__( "Message: " , ST_TEXTDOMAIN ) . $pay_respon->error[ 0 ]->message;
                    $st_paypal_adaptivepayment_admin_notice[ 'message' ] = $message;
                } else {
                    global $st_paypal_adaptivepayment_admin_notice;
                    $st_paypal_adaptivepayment_admin_notice[ 'status' ]  = 'success ';
                    $message                                             = sprintf( esc_html__( "This order #%s is executed payment for partner" , ST_TEXTDOMAIN ) , $order_id );
                    $st_paypal_adaptivepayment_admin_notice[ 'message' ] = $message;
                }
                $pay_respon_detail = $this->_perform_pay_call( $order_id , 'PaymentDetails' );
                if($pay_respon_detail->status == "COMPLETED") {
                    update_post_meta( $order_id , 'st_is_split_payment_receive' , 'yes' );
                }
            }
        }

        function _admin_notice()
        {
            global $st_paypal_adaptivepayment_admin_notice;
            if(!empty( $st_paypal_adaptivepayment_admin_notice ) and is_array( $st_paypal_adaptivepayment_admin_notice )) {
                ?>
                <div
                    class="notice notice-<?php echo esc_html( $st_paypal_adaptivepayment_admin_notice[ 'status' ] ) ?> is-dismissible">
                    <p><?php echo balanceTags( $st_paypal_adaptivepayment_admin_notice[ 'message' ] ); ?></p>
                </div>
                <?php
            }
        }

        function get_cURL_adaptive_split_response( $url , $headers_array , $data_array )
        {
            $ch = curl_init();
            curl_setopt( $ch , CURLOPT_URL , $url );
            curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
            curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , false );
            curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , false );
            curl_setopt( $ch , CURLOPT_SSLVERSION , 6 );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , http_build_query( $data_array ) );
            if(!empty( $headers_array )) {
                $headers = array();
                foreach( $headers_array as $name => $value ) {
                    $headers[] = "{$name}: $value";
                }
                curl_setopt( $ch , CURLOPT_HTTPHEADER , $headers );
            } else {
                curl_setopt( $ch , CURLOPT_HEADER , false );
            }
            $response = curl_exec( $ch );
            curl_close( $ch );
            return $response;
        }
    }
}

