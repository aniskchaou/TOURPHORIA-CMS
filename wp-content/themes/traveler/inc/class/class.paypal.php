<?php
/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * Class STPaypal
 *
 * Created by ShineTheme
 *
 */

use Omnipay\Omnipay;

if (class_exists('STTravelCode') and !class_exists('STPaypal')) {
    class STPaypal
    {
        protected $clientId = "AcYQMRB0jNn39D-u39i-p2LukpPAkgw19FtK1jIdb_jj7l99OFCncBJa3KLQ";
        protected $clientSecret = "EAEO1xC3u-V9eZWTutjmu4QLpFPMlo3KWdaF2LrcDc2-13B8PXafeT4vXjW9";
        protected $apiUserName = 'dungdt-facilitator_api1.shinetheme.com';
        protected $apiPass = 'RBKANUDGJN6KY7WQ';
        protected $apiSignature = 'AfVov5Hs6Z8rseCCA0HGxV1Ckbn2A6QjaKYGlaqCMlAelXy7AjQDTQZR';


        public $debug = false;

        function __construct()
        {
            $this->apiUserName = st()->get_option('paypal_api_username');
            $this->apiPass = st()->get_option('paypal_api_password');
            $this->apiSignature = st()->get_option('paypal_api_signature');
            $this->liveurl = 'https://www.paypal.com/cgi-bin/webscr';
            $this->testurl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }

        function test_authorize()
        {
            //Check cart is not empty

            if (STCart::check_cart() and STPrice::getTotal()) {
                $gateway = Omnipay::create('PayPal_Express');
                $gateway->setUsername(st()->get_option('paypal_api_username'));
                $gateway->setPassword(st()->get_option('paypal_api_password'));
                $gateway->setSignature(st()->get_option('paypal_api_signature'));
                if (st()->get_option('paypal_enable_sandbox', 'on') == 'on') {
                    $gateway->setTestMode(true);
                }

                $purchase = [
                    'amount' => STCart::getPriceByLineItems(),
                    'currency' => TravelHelper::get_current_currency('name'),
                    'description' => sprintf(__('%s Booking', ST_TEXTDOMAIN), get_bloginfo('title')),
                    'returnUrl' => add_query_arg([
                        'gateway_name' => 'st_paypal',
                        'status' => 'success'
                    ], STCart::get_success_link()),
                    'cancelUrl' => add_query_arg([
                        'gateway_name' => 'st_paypal',
                        'status' => 'error'
                    ], STCart::get_success_link()),
                    'taxAmount' => 0
                ];

                $response = $gateway->purchase(
                    $purchase
                )->send();

                if ($response->isSuccessful()) {

                    return ['status' => true];

                } elseif ($response->isRedirect()) {

                    return ['status' => false, 'redirect_url' => $response->getRedirectUrl(), ''];
                } else {
                    return ['status' => false, 'message' => $response->getMessage(), 'data' => $purchase];

                }
            } else {

                return ['status' => false, 'message' => __('Your cart is currently empty', ST_TEXTDOMAIN)];
            }
        }

        function get_authorize_url($order_id = false, $purchase)
        {
            $gateway = Omnipay::create('PayPal_Express');
            $gateway->setUsername(st()->get_option('paypal_api_username'));
            $gateway->setPassword(st()->get_option('paypal_api_password'));
            $gateway->setSignature(st()->get_option('paypal_api_signature'));
            if (st()->get_option('paypal_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
            }


            $response = $gateway->purchase(
                $purchase
            )->send();


            if ($response->isSuccessful()) {

                return ['status' => true];

            } elseif ($response->isRedirect()) {
                return ['status' => false, 'redirect_url' => $response->getRedirectUrl()];
            } else {
                return ['status' => false, 'message' => $response->getMessage(), 'data' => $purchase];

            }
        }


        function getItems($order_id)
        {
            $all_items = [];

            if (!$line_items = $this->get_line_items()) {
                //If can not show line itemss
                //Show all
                $args[] = [
                    'name' => __('Travel Order', ST_TEXTDOMAIN),
                    'quantity' => 1,
                    'price' => STPrice::getTotal()
                ];

                $all_items = $args;

            } else {
                $all_items = $line_items;
            }

            return $all_items;
        }

        function completePurchase($purchase)
        {
            $gateway = Omnipay::create('PayPal_Express');
            $gateway->setUsername($this->apiUserName);
            $gateway->setPassword($this->apiPass);
            $gateway->setSignature($this->apiSignature);
            if (st()->get_option('paypal_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
            }

            return $gateway->completePurchase($purchase)->send();
        }

        function check_completePurchase($order_id = false)
        {

            //Check cart is not empty
            if ($order_id and false !== get_post_status($order_id)) {
                $total = get_post_meta($order_id, 'total_price', true);

                $gateway = Omnipay::create('PayPal_Express');
                $gateway->setUsername($this->apiUserName);
                $gateway->setPassword($this->apiPass);
                $gateway->setSignature($this->apiSignature);
                if (st()->get_option('paypal_enable_sandbox', 'on') == 'on') {
                    $gateway->setTestMode(true);
                }

                $amount = TravelHelper::convert_money($total);

                $order_token_code = get_post_meta($order_id, 'order_token_code', true);

                if (!$order_token_code) {
                    $array = [
                        'gateway_name' => 'st_paypal',
                        'order_code' => $order_id,
                        'status' => 'success'
                    ];
                    $array_error = [
                        'gateway_name' => 'st_paypal',
                        'order_code' => $order_id,
                        'status' => 'error'
                    ];
                } else {
                    $array = [
                        'gateway_name' => 'st_paypal',
                        'order_token_code' => $order_token_code,
                        'status' => 'success'
                    ];

                    $array_error = [
                        'gateway_name' => 'st_paypal',
                        'order_token_code' => $order_token_code,
                        'status' => 'error'
                    ];
                }

                $response = $gateway->completePurchase(
                    [
                        'amount' => (float)$amount,
                        'currency' => TravelHelper::get_current_currency('name'),
                        'description' => __('Traveler Booking', ST_TEXTDOMAIN),
                        'returnUrl' => add_query_arg($array, STCart::get_success_link()),
                        'cancelUrl' => add_query_arg($array_error, STCart::get_success_link())
                    ]
                )->send();


                if ($response->isSuccessful()) {

                    $data = $response->getData();
                    $data2 = $gateway->fetchCheckout(['transactionReference' => $data['TOKEN']])->send();
                    $transaction_data = $data2->getData();

                    //Try to create user and create new orders with paypal transaction detail
                    return STGatewayPaypal::paypal_checkout($transaction_data, $order_id);
                    //return true;

                } elseif ($response->isRedirect()) {
                    //$response->redirect(); // this will automatically forward the customer
                    return ['status' => false, 'redirect_url' => $response->getRedirectUrl(), 'func' => 'check_completePurchase'];
//                    return ;
                } else {
                    // not successful
                    return ['status' => false, 'message' => $response->getMessage()];

                }

            } else {
                // not successful
                return ['status' => false, 'message' => __('Order Code is not exists', ST_TEXTDOMAIN)];

            }

        }

        /**
         * @param $order_id
         * @return array
         */
        public function check_complete_purchase_package_member($order_id)
        {
            $admin_packages = STAdminPackages::get_inst();
            $order = $admin_packages->get('*', $order_id);

            $currency = TravelHelper::get_current_currency('name');

            $total = (float)$order->package_price;

            $booking_currency_conversion = st()->get_option('booking_currency_conversion');
            if (!empty($booking_currency_conversion)) {
                foreach ($booking_currency_conversion as $k => $v) {
                    if ($v['name'] == $currency) {
                        $total = $total / $v['rate'];
                        $total = round((float)$total, 2);
                        $currency = "USD";
                    }
                }
            }

            $purchase = [
                'amount' => $total,
                'currency' => $currency,
                'description' => __('Member Package', ST_TEXTDOMAIN),
                'returnUrl' => $admin_packages->get_return_url($order_id),
                'cancelUrl' => $admin_packages->get_cancel_url($order_id),
            ];

            $response = $this->completePurchase($purchase);

            if ($response->isSuccessful()) {
                return array(
                    'status' => true
                );
            } elseif ($response->isRedirect()) {
                return array('status' => false, 'redirect_url' => $response->getRedirectUrl(), 'func' => 'check_completePurchase');
            } else {
                return array('status' => false, 'message' => $response->getMessage());

            }
        }

        function handle_link($link1, $link2)
        {
            global $wp_rewrite;
            if ($wp_rewrite->permalink_structure == '') {
                return $link1 . '&' . $link2;
            } else {
                return $link1 . '?' . $link2;
            }
        }

    }

}