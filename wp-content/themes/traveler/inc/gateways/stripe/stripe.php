<?php
return;
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/15/2015
 * Time: 3:19 PM
 */
use Omnipay\Omnipay;

if (!class_exists('ST_Stripe_Payment_Gateway')) {
	class ST_Stripe_Payment_Gateway extends STAbstactPaymentGateway
	{
		private $default_status = TRUE;

		private $_gatewayObject = null;

		private $_gateway_id = 'st_stripe';

		function __construct()
		{
			add_filter('st_payment_gateway_st_stripe', array($this, 'get_name'));
			try {
				$this->_gatewayObject = Omnipay::create('Stripe');
			} catch (Exception $e) {
				$this->default_status = FALSE;
			}

			add_action('admin_notices', array($this, '_add_notices'));
			add_action('admin_init', array($this, '_dismis_notice'));
            add_action('wp_enqueue_scripts', array($this, '_load_scripts'));

		}

		function _load_scripts(){
			wp_register_style('stripe-css', ST_TRAVELER_URI . '/css/stripe.css');
			if(st()->get_option('stripe_enable_token'))
            {
                wp_enqueue_style('stripe-css');
                wp_enqueue_script('stripe-api','https://js.stripe.com/v3/');
            }
		}

		function _dismis_notice()
		{
			if (STInput::get('st_dismiss_stripe_notice')) {
				update_option('st_dismiss_stripe_notice', 1);
			}

		}

		function _add_notices()
		{
			if (get_option('st_dismiss_stripe_notice')) return;

			if (class_exists('STTravelCode')) {
				if (isset(STTravelCode::$plugins_data['Version'])) {
					$version = STTravelCode::$plugins_data['Version'];
					if (version_compare('1.3.2', $version, '>')) {
						$url = admin_url('plugin-install.php?tab=plugin-information&plugin=traveler-code&TB_iframe=true&width=753&height=350');
						?>
						<div class="error settings-error notice is-dismissible">
							<p class=""><strong><?php _e('Traveler Notice:', ST_TEXTDOMAIN) ?></strong></p>

							<p>
								<?php printf(__('<strong>Stripe</strong> require %s version %s or above. Your current is %s', ST_TEXTDOMAIN), '<strong><em>' . __('Traveler Code', ST_TEXTDOMAIN) . '</em></strong>', '<strong>1.3.2</strong>', '<strong>' . $version . '</strong>'); ?>
							</p>

							<p>
								<a href="http://shinetheme.com/demosd/documentation/how-to-update-the-theme-2/"
								   target="_blank"><?php _e('Learn how to update it', ST_TEXTDOMAIN) ?></a>
								|
								<a href="<?php echo admin_url('index.php?st_dismiss_stripe_notice=1') ?>"
								   class="dismiss-notice"
								   target="_parent"><?php _e('Dismiss this notice', ST_TEXTDOMAIN) ?></a>
							</p>
							<button type="button" class="notice-dismiss"><span
									class="screen-reader-text"><?php _e('Dismiss this notice', ST_TEXTDOMAIN) ?>.</span>
							</button>
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
                    'id'        => 'stripe_publish_key',
                    'label'     => __('Publishable Key', ST_TEXTDOMAIN),
                    'type'      => 'text',
                    'section'   => 'option_pmgateway',
                    'desc'      => __('Your Stripe Publishable Key', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_stripe_enable:is(on),stripe_enable_token:is(on)'
                ),
				array(
					'id'        => 'stripe_secret_key',
					'label'     => __('Secret Key', ST_TEXTDOMAIN),
					'type'      => 'text',
					'section'   => 'option_pmgateway',
					'desc'      => __('Your Stripe Secret Key', ST_TEXTDOMAIN),
					'condition' => 'pm_gway_st_stripe_enable:is(on)'
				),
				array(
					'id'        => 'stripe_enable_sandbox',
					'label'     => __('Enable Sandbox Mode', ST_TEXTDOMAIN),
					'type'      => 'on-off',
					'section'   => 'option_pmgateway',
					'std'       => 'on',
					'desc'      => __('Allow you to enable sandbox mode for testing', ST_TEXTDOMAIN),
					'condition' => 'pm_gway_st_stripe_enable:is(on)'
				),
                array(
                    'id'        => 'stripe_test_publish_key',
                    'label'     => __('Test Publishable Key', ST_TEXTDOMAIN),
                    'type'      => 'text',
                    'section'   => 'option_pmgateway',
                    'desc'      => __('Your Stripe Test Publishable Key for Sandbox mode', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_stripe_enable:is(on),stripe_enable_sandbox:is(on),stripe_enable_token:is(on)'
                ),
				array(
					'id'        => 'stripe_test_secret_key',
					'label'     => __('Test Secret Key', ST_TEXTDOMAIN),
					'type'      => 'text',
					'section'   => 'option_pmgateway',
					'desc'      => __('Your Stripe Test Secret Key for Sandbox mode', ST_TEXTDOMAIN),
					'condition' => 'pm_gway_st_stripe_enable:is(on),stripe_enable_sandbox:is(on)'
				),
                array(
                    'id'        => 'stripe_enable_token',
                    'label'     => __('Enable Creative UI Form (Using Token)', ST_TEXTDOMAIN),
                    'type'      => 'on-off',
                    'section'   => 'option_pmgateway',
                    'std'       => 'off',
                    'desc'      => __('Allow you to use token for stripe. Read more about it https://stripe.com/docs/stripe-js/elements/quickstart', ST_TEXTDOMAIN),
                    'condition' => 'pm_gway_st_stripe_enable:is(on)'
                ),
//                array(
//                    'id'        => 'stripe_enable_creative_ui_form',
//                    'label'     => __('Enable Creative UI Form', ST_TEXTDOMAIN),
//                    'type'      => 'on-off',
//                    'section'   => 'option_pmgateway',
//                    'std'       => 'off',
//                    'desc'      => __('Read more about it https://stripe.com/docs/stripe-js/elements/quickstart', ST_TEXTDOMAIN),
//                    'condition' => 'pm_gway_st_stripe_enable:is(on)'
//                ),

			);
		}

		function _pre_checkout_validate()
		{
			$validate=new STValidate();
            $enable_token = st()->get_option('stripe_enable_token', 'off');
            if($enable_token == 'on'){
                $validate->set_rules('token_stripe',__("Stripe Token",ST_TEXTDOMAIN),'required');
//                $validate->set_rules('st_stripe_card_zipcode',__("Zip Code",ST_TEXTDOMAIN),'required');
            }else{
                $validate->set_rules('st_stripe_card_number',__("Card Number",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_stripe_card_expiry_month',__("Expiry Month",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_stripe_card_expiry_year',__("Expiry Year",ST_TEXTDOMAIN),'required');
                $validate->set_rules('st_stripe_card_code',__("Card Code",ST_TEXTDOMAIN),'required');
            }

			if(!$validate->run())
			{
				STTemplate::set_message($validate->error_string());
				return FALSE;
			}


			return true;
		}

		function do_checkout($order_id)
		{
			$pp = $this->get_authorize_url($order_id);

			if (isset($pp['redirect_form']) and $pp['redirect_form'])
				$pp_link = $pp['redirect_form'];

			do_action('st_before_redirect_stripe');



			if ($pp['status']) {
				return array(
					'status'  => true,
				);
			}else{
				return array(
					'status'  => FALSE,
					'message' => isset($pp['message']) ? $pp['message'] : FALSE,
					'data'    => isset($pp['data']) ? $pp['data'] : FALSE,
					'error_step'=>'after_get_authorize_url',
					'raw_response'=>$pp
				);
			}
		}

		function get_authorize_url($order_id)
		{
			$gateway = $this->_gatewayObject;
			$gateway->setApiKey(st()->get_option('stripe_secret_key'));
			if (st()->get_option('stripe_enable_sandbox', 'on') == 'on') {
				$gateway->setApiKey(st()->get_option('stripe_test_secret_key'));
			}

            $total = get_post_meta($order_id, 'total_price', TRUE);
            $total=round((float)$total,2);

            $enable_token = st()->get_option('stripe_enable_token', 'off');
			if($enable_token == 'on'){
                $token = STInput::post('token_stripe');
                $purchase = array(
                    'amount'        => (float)$total,
                    'currency'      => TravelHelper::get_current_currency('name'),
                    'description'   => __('Traveler Booking', ST_TEXTDOMAIN),
                    'token' => $token,
                );
            }else{
                $cardData = array(
                    'number'      => STInput::post('st_stripe_card_number'),
                    'expiryMonth' => STInput::post('st_stripe_card_expiry_month'),
                    'expiryYear'  => STInput::post('st_stripe_card_expiry_year'),
                    'cvv'         => STInput::post('st_stripe_card_code')
                );

                $purchase = array(
                    'amount'        => (float)$total,
                    'currency'      => TravelHelper::get_current_currency('name'),
                    'description'   => __('Traveler Booking', ST_TEXTDOMAIN),
                    'card'          => $cardData
                );
            }

			try{
				$response = $gateway->purchase(
					$purchase
				)->send();


			}catch(Exception $e){
				return array(
					'status'=>FALSE,
					'message'=>$e->getMessage(),
					'error_step'=>'Try catch Stripe Purchase '
				);
			}

			if ($response->isSuccessful()) {

				return array('status' => TRUE);

			} elseif ($response->isRedirect()) {
				return array(
					'status'   => TRUE,
					'redirect' => STCart::get_success_link()
				);
			} else {
				return array('status' => FALSE, 'message' => $response->getMessage(), 'data' => $response);

			}
		}

		function  check_complete_purchase($order_id)
		{

		}

		function html()
		{
            $strip_creative_ui=st()->get_option('stripe_enable_token');
		    if($strip_creative_ui=='on'){
                echo st()->load_template('gateways/stripe_creative');
            }else{
                echo st()->load_template('gateways/stripe');
            }

		}

		function get_name()
		{
			return __('Stripe', ST_TEXTDOMAIN);
		}

		function get_default_status()
		{
			return $this->default_status;
		}

		function is_available($item_id = FALSE)
		{
			if (st()->get_option('pm_gway_st_stripe_enable') == 'off') {
				return FALSE;
			}

			$stripe_secret_key = st()->get_option('stripe_secret_key');
			$stripe_enable_sandbox = st()->get_option('stripe_enable_sandbox');
			$stripe_test_secret_key = st()->get_option('stripe_test_secret_key');

			if ($stripe_enable_sandbox == 'on') {
				if (!$stripe_test_secret_key) return FALSE;

			} elseif (!$stripe_secret_key) {
				return FALSE;
			}

			if ($item_id) {
				$meta = get_post_meta($item_id, 'is_meta_payment_gateway_st_stripe', TRUE);
				if ($meta == 'off') {
					return FALSE;
				}
			}

			return TRUE;
		}

		function getGatewayId()
		{
			return $this->_gateway_id;
		}

		function is_check_complete_required()
		{
			return FALSE;
		}

		function get_logo()
		{
			return ST_TRAVELER_URI.'/img/gateway/sp-logo.png';
		}

	}
}