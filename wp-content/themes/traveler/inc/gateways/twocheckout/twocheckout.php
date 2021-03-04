<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/15/2015
 * Time: 3:19 PM
 */
return;
use Omnipay\Omnipay;

if ( ! class_exists( 'ST_TwoCheckout_Payment_Gateway' ) ) {
	class ST_TwoCheckout_Payment_Gateway extends STAbstactPaymentGateway {
		static private $_ints;
		private $default_status = true;
		private $_gatewayObject = null;
		private $_gateway_id = 'st_twocheckout';

		function __construct() {
			add_filter( 'st_payment_gateway_st_twocheckout_name', array( $this, 'get_name' ) );
			try {
				$this->_gatewayObject = Omnipay::create( 'TwoCheckoutPlus_Token' );

			} catch ( Exception $e ) {
				$this->default_status = false;
			}
			add_action( 'admin_notices', array( $this, '_add_notices' ) );
			add_action( 'admin_init', array( $this, '_dismis_notice' ) );
		}

		function _dismis_notice() {
			if ( STInput::get( 'st_dismiss_twocheckout_notice' ) ) {
				update_option( 'st_dismiss_twocheckout_notice', 1 );
			}

		}

		function _add_notices() {
			if ( get_option( 'st_dismiss_twocheckout_notice' ) ) {
				return;
			}

			if ( class_exists( 'STTravelCode' ) ) {
				if ( isset( STTravelCode::$plugins_data['Version'] ) ) {
					$version = STTravelCode::$plugins_data['Version'];
					if ( version_compare( '1.3.2', $version, '>' ) ) {
						$url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=traveler-code&TB_iframe=true&width=753&height=350' );
						?>
						<div class="error settings-error notice is-dismissible">
							<p class=""><strong><?php _e( 'Traveler Notice:', ST_TEXTDOMAIN ) ?></strong></p>
							<p>
								<?php printf( __( '<strong>TwoCheckout</strong> require %s version %s or above. Your current is %s', ST_TEXTDOMAIN ), '<strong><em>' . __( 'Traveler Code', ST_TEXTDOMAIN ) . '</em></strong>', '<strong>1.3.2</strong>', '<strong>' . $version . '</strong>' ); ?>
							</p>
							<p>
								<a href="http://shinetheme.com/demosd/documentation/how-to-update-the-theme-2/"
								   target="_blank"><?php _e( 'Learn how to update it', ST_TEXTDOMAIN ) ?></a>
								|
								<a href="<?php echo admin_url( 'index.php?st_dismiss_twocheckout_notice=1' ) ?>"
								   class="dismiss-notice"
								   target="_parent"><?php _e( 'Dismiss this notice', ST_TEXTDOMAIN ) ?></a>
							</p>
							<button type="button" class="notice-dismiss"><span
									class="screen-reader-text"><?php _e( 'Dismiss this notice', ST_TEXTDOMAIN ) ?>
									.</span></button>
						</div>
						<?php
					}
				}
			}
		}

		function get_option_fields() {
			return array(
				array(
					'id'        => 'twocheckout_account_number',
					'label'     => __( 'Account Number', ST_TEXTDOMAIN ),
					'type'      => 'text',
					'section'   => 'option_pmgateway',
					'desc'      => __( 'Account Number', ST_TEXTDOMAIN ),
					'condition' => 'pm_gway_st_twocheckout_enable:is(on)'
				),
				array(
					'id'        => 'twocheckout_public_key',
					'label'     => __( 'Public Key', ST_TEXTDOMAIN ),
					'type'      => 'text',
					'section'   => 'option_pmgateway',
					'desc'      => __( 'Public Key', ST_TEXTDOMAIN ),
					'condition' => 'pm_gway_st_twocheckout_enable:is(on)'
				),
				array(
					'id'        => 'twocheckout_private_key',
					'label'     => __( 'Private Key', ST_TEXTDOMAIN ),
					'type'      => 'text',
					'section'   => 'option_pmgateway',
					'desc'      => __( 'Private Key', ST_TEXTDOMAIN ),
					'condition' => 'pm_gway_st_twocheckout_enable:is(on)'
				),
				array(
					'id'        => 'twocheckout_enable_sandbox',
					'label'     => __( 'Enable Test Mode', ST_TEXTDOMAIN ),
					'type'      => 'on-off',
					'section'   => 'option_pmgateway',
					'std'       => 'on',
					'desc'      => __( 'Allow you to enable test mode', ST_TEXTDOMAIN ),
					'condition' => 'pm_gway_st_twocheckout_enable:is(on)'
				),
			);
		}

		function _pre_checkout_validate() {
			$validate=new STValidate();
			$validate->set_rules('st_twocheckout_card_name',__("Card Name",ST_TEXTDOMAIN),'required');
			$validate->set_rules('st_twocheckout_card_number',__("Card Number",ST_TEXTDOMAIN),'required');
			$validate->set_rules('st_twocheckout_card_expiry_month',__("Expiry Month",ST_TEXTDOMAIN),'required');
			$validate->set_rules('st_twocheckout_card_expiry_year',__("Expiry Year",ST_TEXTDOMAIN),'required');
			$validate->set_rules('st_twocheckout_card_code',__("Card Code",ST_TEXTDOMAIN),'required');

			if(!$validate->run())
			{
				STTemplate::set_message($validate->error_string());
				return FALSE;
			}
			return true;
		}

		function do_checkout( $order_id ) {
			if ( ! $this->is_available() ) {
				return
					[
						'status'            => 0,
						'complete_purchase' => 0,
						'error_type'        => 'card_validate',
						'error_fields'      => '',
					];
			}
			$gateway = $this->_gatewayObject;
			$gateway->setAccountNumber( st()->get_option( 'twocheckout_account_number', '' ) );
			$gateway->setPrivateKey( st()->get_option( 'twocheckout_private_key', '' ) );

			if ( st()->get_option( 'twocheckout_enable_sandbox', 'on' ) == 'on' ) {
				$gateway->setTestMode( true );
			}

			$total            = get_post_meta( $order_id, 'total_price', true );
			$total            = round( (float) $total, 2 );
			$order_token_code = get_post_meta( $order_id, 'order_token_code', true );

			$purchase = [
				'currency'      => TravelHelper::get_current_currency('name'),
				'transactionId' => esc_html__( 'Order:', ST_TEXTDOMAIN ) . ' ' . esc_attr( $order_id ) . '-' . esc_attr( $order_id ),
				'returnUrl'     => $this->get_return_url( $order_id )
			];


			$card                 = [
				'firstName'       => STInput::request( 'st_first_name', 'firstname' ),
				'lastName'        => STInput::request( 'st_last_name', 'lastname'),
				'email'           => STInput::request( 'st_email', 'email' ),
				'billingAddress1' => STInput::request( 'st_address', 'address1' ) != '' ? STInput::request( 'st_address', 'address1' ) : 'Address 1',
				'billingAddress2' => STInput::request( 'st_address2', 'address2' ) != '' ? STInput::request( 'st_address2', 'address2' ) : 'Address 2',
				'billingCity'     => STInput::request( 'st_city', 'city' )!= '' ? STInput::request( 'st_city', 'city' ) : 'City',
				'billingPostcode' => STInput::request( 'st_zip_code', 'zip_code' ) != '' ? STInput::request( 'st_zip_code', 'zip_code' ) : 'ZipCode',
				'billingState'    => STInput::request( 'st_province', 'state' ) != '' ? STInput::request( 'st_province', 'state' ) : 'State',
				'billingCountry'  => STInput::request( 'st_country', 'country' ) != '' ? STInput::request( 'st_country', 'country' ) : 'Country',
			];

			$purchase[ 'card' ]   = $card;
			$purchase[ 'token' ]  = sanitize_text_field(STInput::request('token'));
			$purchase[ 'amount' ] = number_format( (float)$total, 2, '.', '' );

			$response = $gateway->purchase( $purchase )->send();
			try {
				if ( $response->isSuccessful() ) {
					return array( 'status' => true, 'complete_purchase' => 1 );
				} elseif ( $response->isRedirect() ) {
					return array(
						'status'        => true,
						'redirect' => $response->getRedirectUrl()
					);
				} else {
					return array( 'status' => false, 'message' => $response->getMessage(), 'data' => $purchase, 'complete_purchase' => 0 );
				}
			} catch ( \Exception $e ) {
				return array( 'status' => false, 'message' => $response->getMessage(), 'data' => $purchase, 'complete_purchase' => 0 );
			}
		}

		function complete_purchase( $order_id )
		{
			return true;
		}

		function check_complete_purchase( $order_id ) {

		}

		function html() {
			echo st()->load_template( 'gateways/twocheckout' );
		}

		function get_name() {
			return __( 'TwoCheckout', ST_TEXTDOMAIN );
		}

		function get_default_status() {
			return $this->default_status;
		}

		function is_available( $item_id = false ) {
			if ( st()->get_option( 'pm_gway_st_twocheckout_enable' ) == 'off' ) {
				return false;
			} else {
				if ( ! st()->get_option( 'twocheckout_account_number' ) ) {
					return false;
				}
				if ( ! st()->get_option( 'twocheckout_public_key' ) ) {
					return false;
				}
				if ( ! st()->get_option( 'twocheckout_private_key' ) ) {
					return false;
				}
			}

			if ( $item_id ) {
				$meta = get_post_meta( $item_id, 'is_meta_payment_gateway_st_twocheckout', true );
				if ( $meta == 'off' ) {
					return false;
				}
			}

			return true;
		}

		function getGatewayId() {
			return $this->_gateway_id;
		}

		function is_check_complete_required() {
			return FALSE;
		}

		function get_logo() {
			return get_template_directory_uri() . '/img/gateway/tco-logo.png';
		}

		static function instance() {
			if ( ! self::$_ints ) {
				self::$_ints = new self();
			}

			return self::$_ints;
		}

		static function add_payment( $payment ) {
			$payment['st_twocheckout'] = self::instance();

			return $payment;
		}
	}

	add_filter( 'st_payment_gateways', array( 'ST_TwoCheckout_Payment_Gateway', 'add_payment' ) );
}