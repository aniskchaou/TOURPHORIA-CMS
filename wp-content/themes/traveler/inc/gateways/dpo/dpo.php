<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 15-10-2018
     * Time: 10:19 AM
     * Since: 1.0.0
     * Updated: 1.0.0
     */
return;
    if ( !class_exists( 'ST_DPO_Payment_Gateway' ) ) {
        class ST_DPO_Payment_Gateway extends STAbstactPaymentGateway
        {
            private $default_status = true;
            private $_gateway_id = 'st_dpo';

            public function __construct()
            {
                add_filter( 'st_payment_gateway_st_dpo_name', [ $this, 'get_name' ] );
            }

            function get_default_status()
            {
                return $this->default_status;
            }

            function get_name()
            {
                return __( 'DPO', ST_TEXTDOMAIN );
            }

            function _pre_checkout_validate()
            {
                return true;
            }

            function get_option_fields()
            {
                return [
                    [
                        'id'        => 'dpo_company_token',
                        'label'     => __( 'Company Token', ST_TEXTDOMAIN ),
                        'type'      => 'text',
                        'section'   => 'option_pmgateway',
                        'desc'      => __( 'Company Token', ST_TEXTDOMAIN ),
                        'condition' => 'pm_gway_st_dpo_enable:is(on)'
                    ],
                    [
                        'id'        => 'dpo_3g_url',
                        'label'     => esc_html__( '3G URL', ST_TEXTDOMAIN ),
                        'type'      => 'text',
                        'desc'      => esc_html__( '3G URL', ST_TEXTDOMAIN ),
                        'section'   => 'option_pmgateway',
                        'condition' => 'pm_gway_st_dpo_enable:is(on)'
                    ],
                    [
                        'id'        => 'dpo_service_type',
                        'label'     => esc_html__( 'Service Type', ST_TEXTDOMAIN ),
                        'type'      => 'text',
                        'desc'      => esc_html__( 'Service Type', ST_TEXTDOMAIN ),
                        'section'   => 'option_pmgateway',
                        'condition' => 'pm_gway_st_dpo_enable:is(on)'
                    ],
                    [
                        'id'        => 'dpo_ptl_type',
                        'label'     => esc_html__( 'PTL Type (Optional)', ST_TEXTDOMAIN ),
                        'type'      => 'select',
                        'choices'   => [
                            [
                                'label' => esc_html__( 'Select', ST_TEXTDOMAIN ),
                                'value' => ''
                            ],
                            [
                                'label' => esc_html__( 'Minutes', ST_TEXTDOMAIN ),
                                'value' => 'minutes'
                            ],
                            [
                                'label' => esc_html__( 'Hours', ST_TEXTDOMAIN ),
                                'value' => 'hours'
                            ],
                        ],
                        'section'   => 'option_pmgateway',
                        'condition' => 'pm_gway_st_dpo_enable:is(on)'
                    ],
                    [
                        'id'        => 'dpo_ptl',
                        'label'     => esc_html__( 'PTL (Optional)', ST_TEXTDOMAIN ),
                        'type'      => 'text',
                        'desc'      => esc_html__( 'PTL (Optional)', ST_TEXTDOMAIN ),
                        'section'   => 'option_pmgateway',
                        'condition' => 'pm_gway_st_dpo_enable:is(on)'
                    ],
                ];
            }

            function do_checkout( $order_id )
            {
                $response = $this->before_payment( $order_id );
                if ( $response === false ) {

                    return [
                        'status'  => false,
                        'message' => __( 'Can not create payment URL.', ST_TEXTDOMAIN )
                    ];

                } else {
                    $xml = new SimpleXMLElement( $response );

                    if ( $xml->Result[ 0 ] != '000' ) {

                        return [
                            'status'  => false,
                            'message' => __( 'Payment error code: ' . $xml->Result[ 0 ] . ', ' . $xml->ResultExplanation[ 0 ], ST_TEXTDOMAIN )
                        ];
                    }
                    $paymnetURL = trim( st()->get_option( 'dpo_3g_url' ) ) . "/pay.php?ID=" . $xml->TransToken[ 0 ];

                    return [
                        'redirect' => $paymnetURL,
                        'status'   => true
                    ];
                }

            }

            public function before_payment( $order_id )
            {
                $total = get_post_meta( $order_id, 'total_price', true );
                $total = round( (float)$total, 2 );

                $param = [
                    'order_id'   => $order_id,
                    'amount'     => '<PaymentAmount>' . number_format( (float)$total, 2, '.', '' ) . '</PaymentAmount>',
                    'first_name' => '<customerFirstName>' . STInput::request( 'st_first_name', 'firstname' ) . '</customerFirstName>',
                    'last_name'  => '<customerLastName>' . STInput::request( 'st_last_name', 'lastname' ) . '</customerLastName>',
                    'phone'      => '<customerPhone>' . STInput::request( 'st_phone', '0123456789' ) . '</customerPhone>',
                    'email'      => '<customerEmail>' . STInput::request( 'st_email', 'email' ) . '</customerEmail>',
                    'address'    => '<customerAddress>' . STInput::request( 'st_address', 'address' ) . '</customerAddress>',
                    'city'       => '<customerCity>' . STInput::request( 'st_city', 'city' ) . '</customerCity>',
                    'zipcode'    => '<customerZip>' . STInput::request( 'st_zip_code', 'zipcode' ) . '</customerZip>',
                    'country'    => '<customerCountry>' . substr( STInput::request( 'st_country', 'country' ), 0, 2 ) . '</customerCountry>',
                    'ptl_type'   => ( st()->get_option( 'dpo_ptl_type' ) == 'minutes' ) ? '<PTLtype>minutes</PTLtype>' : "",
                    'ptl'        => ( !empty( st()->get_option( 'dpo_ptl_type' ) ) ) ? '<PTL>' . st()->get_option( 'dpo_ptl_type' ) . '</PTL>' : "",
                    'currency'   => TravelHelper::get_current_currency( 'name' )
                ];
                $response = $this->create_send_xml_request( $param, $order_id );

                return $response;
            }

            public function create_send_xml_request( $param, $order_id )
            {
                $company_token = st()->get_option( 'dpo_company_token' );
                $returnURL     = $this->get_return_url( $order_id );
                $cancelURL     = $this->get_cancel_url( $order_id );
                $booking_id    = get_post_meta( $order_id, 'st_booking_id', true );
                $service       = '<Service>
								<ServiceType>' . st()->get_option( 'dpo_service_type' ) . '</ServiceType>
								<ServiceDescription>' . get_the_title( $booking_id ) . '</ServiceDescription>
								<ServiceDate>' . current_time( 'Y/m/d H:i' ) . '</ServiceDate>
							</Service>';

                $input_xml = '<?xml version="1.0" encoding="utf-8"?>
					<API3G>
						<CompanyToken>' . $company_token . '</CompanyToken>
						<Request>createToken</Request>
						<Transaction>' . $param[ "first_name" ] .
                    $param[ "last_name" ] .
                    $param[ "phone" ] .
                    $param[ "email" ] .
                    $param[ "address" ] .
                    $param[ "city" ] .
                    $param[ "zipcode" ] .
                    $param[ "country" ] .
                    $param[ "amount" ] . '
							<PaymentCurrency>' . $param[ "currency" ] . '</PaymentCurrency>
							<CompanyRef>' . $param[ "order_id" ] . '</CompanyRef>
							<RedirectURL>' . htmlspecialchars( $returnURL ) . '</RedirectURL>
							<BackURL>' . htmlspecialchars( $cancelURL ) . '</BackURL>
							<CompanyRefUnique>0</CompanyRefUnique>
							' . $param[ "ptl_type" ] .
                    $param[ "ptl" ] . '
						</Transaction>
						<Services>' . $service . '</Services>
					</API3G>';
                $response = $this->createCURL( $input_xml );

                return $response;
            }

            public function createCURL( $input_xml )
            {

                $url = trim( st()->get_option( 'dpo_3g_url' ) ) . "/API/v6/";

                $ch = curl_init();

                curl_setopt( $ch, CURLOPT_URL, $url );
                curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt( $ch, CURLOPT_SSLVERSION, 6 );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: text/xml' ] );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $input_xml );

                $response = curl_exec( $ch );

                curl_close( $ch );

                return $response;
            }

            function complete_purchase( $order_id )
            {
                return true;
            }

            function check_complete_purchase( $order_id )
            {
                $transactionToken = $_GET[ 'TransactionToken' ];

                if ( !isset( $transactionToken ) ) {
                    return [
                        'status'  => false,
                        'message' => __( 'Transaction Token error, please contact support center', ST_TEXTDOMAIN )
                    ];
                }

                //get verify token response from 3g
                $response = $this->verifytoken( $transactionToken );
                if ( $response ) {
                    if ( $response->Result[ 0 ] == '000' ) {
                        return [
                            'status' => true
                        ];
                    } else {

                        $error_code = $response->Result[ 0 ];
                        $error_desc = $response->ResultExplanation[ 0 ];

                        return [
                            'status'  => false,
                            'message' => __( 'Payment Failed: ', ST_TEXTDOMAIN ) . $error_code . ', ' . $error_desc
                        ];
                    }
                } else {
                    return [
                        'status'  => false,
                        'message' => __( ' Varification error: Unable to connect to the payment gateway, please try again', ST_TEXTDOMAIN )
                    ];
                }
            }

            public function verifytoken( $transactionToken )
            {

                $input_xml = '<?xml version="1.0" encoding="utf-8"?>
						<API3G>
						  <CompanyToken>' . st()->get_option( 'dpo_company_token' ) . '</CompanyToken>
						  <Request>verifyToken</Request>
						  <TransactionToken>' . $transactionToken . '</TransactionToken>
						</API3G>';

                $response = $this->createCURL( $input_xml );

                if ( $response !== false ) {
                    $xml = new SimpleXMLElement( $response );

                    return $xml;
                }

                return false;
            }

            function is_available( $item_id = false )
            {
                if ( st()->get_option( 'pm_gway_st_dpo_enable' ) == 'off' ) {
                    return false;
                } else {
                    if ( !st()->get_option( 'dpo_company_token', '' ) ) {
                        return false;
                    }
                }

                if ( $item_id ) {
                    $meta = get_post_meta( $item_id, 'is_meta_payment_gateway_st_dpo', true );
                    if ( $meta == 'off' ) {
                        return false;
                    }
                }

                return true;
            }

            function getGatewayId()
            {
                return $this->_gateway_id;
            }

            function is_check_complete_required()
            {
                return true;
            }

            public function stop_change_order_status(){
                return false;
            }

            function get_logo()
            {
                return get_template_directory_uri() . '/img/gateway/dpo.png';
            }

            function html()
            {
                echo st()->load_template( 'gateways/dpo' );
            }

            public static function get_inst()
            {
                static $instance;
                if ( is_null( $instance ) ) {
                    $instance = new self();
                }

                return $instance;
            }

            public static function add_payment( $payment )
            {
                $payment[ 'st_dpo' ] = self::get_inst();

                return $payment;
            }
        }

        add_filter( 'st_payment_gateways', [ 'ST_DPO_Payment_Gateway', 'add_payment' ] );
    }