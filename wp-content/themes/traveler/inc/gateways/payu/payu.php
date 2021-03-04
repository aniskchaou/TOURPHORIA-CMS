<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/15/2015
 * Time: 3:19 PM
 */
return;
use Omnipay\Omnipay;

if (!class_exists('ST_Payu_Payment_Gateway')) {
    class ST_Payu_Payment_Gateway extends STAbstactPaymentGateway
    {
        static private $_ints;
        private $default_status = true;
        private $_gatewayObject = null;
        private $_gateway_id = 'st_payu';

        function __construct()
        {
            add_filter('st_payment_gateway_st_payu_name', array($this, 'get_name'));
            try {
                $this->_gatewayObject = Omnipay::create('PayUBiz');

            } catch (Exception $e) {
                $this->default_status = false;
            }
            add_action('admin_notices', array($this, '_add_notices'));
            add_action('admin_init', array($this, '_dismis_notice'));
        }

        function _dismis_notice()
        {
            if (STInput::get('st_dismiss_payu_notice')) {
                update_option('st_dismiss_payu_notice', 1);
            }

        }

        function _add_notices()
        {
            if (get_option('st_dismiss_payu_notice')) {
                return;
            }

            if (class_exists('STTravelCode')) {
                if (isset(STTravelCode::$plugins_data['Version'])) {
                    $version = STTravelCode::$plugins_data['Version'];
                    if (version_compare('1.3.2', $version, '>')) {
                        $url = admin_url('plugin-install.php?tab=plugin-information&plugin=traveler-code&TB_iframe=true&width=753&height=350');
                        ?>
                        <div class="error settings-error notice is-dismissible">
                            <p class=""><strong><?php _e('Traveler Notice:', ST_TEXTDOMAIN) ?></strong></p>
                            <p>
                                <?php printf(__('<strong>Payu</strong> require %s version %s or above. Your current is %s', ST_TEXTDOMAIN), '<strong><em>' . __('Traveler Code', ST_TEXTDOMAIN) . '</em></strong>', '<strong>1.3.2</strong>', '<strong>' . $version . '</strong>'); ?>
                            </p>
                            <p>
                                <a href="http://shinetheme.com/demosd/documentation/how-to-update-the-theme-2/"
                                   target="_blank"><?php _e('Learn how to update it', ST_TEXTDOMAIN) ?></a>
                                |
                                <a href="<?php echo admin_url('index.php?st_dismiss_payu_notice=1') ?>"
                                   class="dismiss-notice"
                                   target="_parent"><?php _e('Dismiss this notice', ST_TEXTDOMAIN) ?></a>
                            </p>
                            <button type="button" class="notice-dismiss"><span
                                        class="screen-reader-text"><?php _e('Dismiss this notice', ST_TEXTDOMAIN) ?>
                                    .</span></button>
                        </div>
                        <?php
                    }
                }
            }
        }

        function get_option_fields()
        {
            return array(
                array(
                    'id' => 'payu_merchant_id',
                    'label' => __('Merchant ID', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Payu Merchant ID', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_payu_enable:is(on)'
                ),
                array(
                    'id' => 'payu_salt_key',
                    'label' => __('Salt Key', ST_TEXTDOMAIN),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Your Payu Salt Key', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_payu_enable:is(on)'
                ),
                array(
                    'id' => 'payu_enable_sandbox',
                    'label' => __('Enable Test Mode', ST_TEXTDOMAIN),
                    'type' => 'on-off',
                    'section' => 'option_pmgateway',
                    'std' => 'on',
                    'desc' => __('Allow you to enable test mode', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_payu_enable:is(on)'
                ),
            );
        }

        function _pre_checkout_validate()
        {
            return true;
        }

        function do_checkout($order_id)
        {
            $gateway = $this->_gatewayObject;
            $gateway->setKey(st()->get_option('payu_merchant_id', ''));
            $gateway->setSalt(st()->get_option('payu_salt_key', ''));

            if (st()->get_option('payu_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
            }

            $total = get_post_meta($order_id, 'total_price', true);
            $total = round((float)$total, 2);
            $order_token_code = get_post_meta($order_id, 'order_token_code', true);

            $purchase = [
                'name' => STInput::request('st_first_name'),
                'email' => STInput::request('st_email'),
                'phone' => STInput::request('st_phone'),
                'amount' => number_format((float)$total, 2, '.', ''),
                'product' => 'Order',
                'transactionId' => $order_token_code,
                'failureUrl' => $this->get_cancel_url($order_id),
                'returnUrl' => $this->get_return_url($order_id),
                'cancelUrl' => $this->get_cancel_url($order_id)
            ];

            $response = $gateway->purchase($purchase)->send();
            if ($response->isSuccessful()) {
                return ['status' => true];
            } elseif ($response->isRedirect()) {
                return ['status' => true, 'redirect_form' => $this->getRedirectForm($response)];
            } else {
                return ['status' => false, 'message' => $response->getMessage(), 'data' => $response];
            }
        }

        public function getRedirectForm($res)
        {
            $hiddenFields = '';
            foreach ($res->getRedirectData() as $key => $value) {
                $hiddenFields .= sprintf(
                        '<input type="hidden" name="%1$s" value="%2$s" />',
                        htmlentities($key, ENT_QUOTES, 'UTF-8', false),
                        htmlentities($value, ENT_QUOTES, 'UTF-8', false)
                    ) . "\n";
            }

            $url = htmlentities($res->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false);

            return sprintf('<form action="%s" method="post" id="st_form_payu_submit">

    						<script>document.getElementById(\'st_form_payu_submit\').submit();</script>
							%s
						</form>', $url, $hiddenFields);
        }


        function check_complete_purchase($order_id)
        {
        }

        function html()
        {
            echo st()->load_template('gateways/payu');
        }

        function get_name()
        {
            return __('Payu', ST_TEXTDOMAIN);
        }

        function get_default_status()
        {
            return $this->default_status;
        }

        function is_available($item_id = false)
        {
            if (st()->get_option('pm_gway_st_payu_enable') == 'off') {
                return false;
            } else {
                if (!st()->get_option('payu_merchant_id')) {
                    return false;
                }
                if (!st()->get_option('payu_salt_key')) {
                    return false;
                }
            }

            if ($item_id) {
                $meta = get_post_meta($item_id, 'is_meta_payment_gateway_st_payu', true);
                if ($meta == 'off') {
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

        function get_logo()
        {
            return get_template_directory_uri() . '/img/gateway/pu-logo.png';
        }

        static function instance()
        {
            if (!self::$_ints) {
                self::$_ints = new self();
            }

            return self::$_ints;
        }

        static function add_payment($payment)
        {
            $payment['st_payu'] = self::instance();

            return $payment;
        }
    }

    add_filter('st_payment_gateways', array('ST_Payu_Payment_Gateway', 'add_payment'));
}