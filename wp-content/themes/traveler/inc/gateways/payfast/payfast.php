<?php
return;
use Omnipay\Omnipay;
if(!class_exists('ST_Payfast_Gateway'))
    {
        class ST_Payfast_Gateway extends STAbstactPaymentGateway
        {
			static private $_ints;

			private $default_status=TRUE;
			private $_gatewayObject=NULL;

			private $_gateway_id='st_payfast';

            function __construct()
            {
                add_filter('st_payment_gateway_st_payfast_name',array($this,'get_name'));
				try{
					// test stripe is ready in Omnipay
					$this->_gatewayObject=Omnipay::create('PayFast');

				}catch(Exception $e)
				{
					$this->default_status=FALSE;
				}

				// Payfast is only available with traveler-code version 1.3.2
				add_action('admin_notices',array($this,'_add_notices'));
				add_action('admin_init',array($this,'_dismis_notice'));
            }
			function _dismis_notice()
			{
				if(STInput::get('st_dismiss_payfast_notice'))
				{
					update_option('st_dismiss_payfast_notice',1);
				}

			}

			function _add_notices()
			{
				if(get_option('st_dismiss_payfast_notice')) return;

				if(class_exists('STTravelCode'))
				{
					if(isset(STTravelCode::$plugins_data['Version']))
					{
						$version=STTravelCode::$plugins_data['Version'];
						if(version_compare('1.3.2',$version,'>'))
						{
							$url=admin_url('plugin-install.php?tab=plugin-information&plugin=traveler-code&TB_iframe=true&width=753&height=350');
							?>
							<div class="error settings-error notice is-dismissible">
								<p class=""><strong><?php _e('Traveler Notice:',ST_TEXTDOMAIN) ?></strong></p>
								<p>
									<?php printf(__('<strong>PayFast</strong> require %s version %s or above. Your current is %s',ST_TEXTDOMAIN),'<strong><em>'.__('Traveler Code',ST_TEXTDOMAIN).'</em></strong>','<strong>1.3.2</strong>','<strong>'.$version.'</strong>'); ?>
								</p>
								<p>
									<a href="http://shinetheme.com/demosd/documentation/how-to-update-the-theme-2/" target="_blank"><?php _e('Learn how to update it',ST_TEXTDOMAIN)?></a>
									|
									<a href="<?php echo admin_url('index.php?st_dismiss_payfast_notice=1') ?>" class="dismiss-notice" target="_parent"><?php _e('Dismiss this notice',ST_TEXTDOMAIN)?></a>
								</p>
								<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Dismiss this notice',ST_TEXTDOMAIN)?>.</span></button>
							</div>
							<?php
						}
					}
				}
			}

            function html()
            {
                echo st()->load_template('gateways/payfast');
            }

            function do_checkout($order_id)
            {
                $pp=$this->get_authorize_url($order_id);

                if(isset($pp['redirect_form']) and $pp['redirect_form'])
                    $pp_link=$pp['redirect_form'];


                do_action('st_before_redirect_payfast');

                if(!isset($pp_link))
                {
                    return array(
                        'status'=>false,
                        'message'=>isset($pp['message'])?$pp['message']:false,
                        'data'=>isset($pp['data'])?$pp['data']:false,
                    );
                }

                if(!$pp_link)
                {
                    return array(
                        'status'=>false,
                        'message'=>__('Can not get PayFast Authorize URL.',ST_TEXTDOMAIN)
                    );
                }else{

                    return array(
                        'status' => true,
                        'redirect_form' => $pp_link
                    );
                }
            }
            function get_authorize_url($order_id)
            {
				$gateway = $this->_gatewayObject;
				$gateway->setMerchantId(st()->get_option('pay_fast_merchant_id'));
				$gateway->setMerchantKey(st()->get_option('pay_fast_merchant_key'));
				if (st()->get_option('pay_fast_enable_sandbox', 'on') == 'on') {
					$gateway->setTestMode(true);
				}

				$total = get_post_meta($order_id, 'total_price', true);
				$total=round((float)$total,2);
				$order_token_code = get_post_meta($order_id, 'order_token_code', TRUE);

				$purchase = array(
					'amount'      => (float)$total,
					'currency'    => TravelHelper::get_current_currency('name'),
					'description' => __('Traveler Booking',ST_TEXTDOMAIN),
					'returnUrl'   => $this->get_return_url($order_id),
					'cancelUrl'   => $this->get_cancel_url($order_id),
					'transactionId'=>$order_token_code,
					//'items'=>$this->get_line_items()
				);


				$response = $gateway->purchase(
					$purchase
				)->send();

				if ($response->isSuccessful()) {

					return array('status' => true);

				} elseif ($response->isRedirect()) {
					return array(
						'status'=>true,
						'redirect_form'=>$this->getRedirectForm($response)
					);
				} else {
					return array('status' => false, 'message' => $response->getMessage(), 'data' => $purchase);

				}
            }
			function getRedirectForm($res)
			{
				$hiddenFields='';
				foreach ($res->getRedirectData() as $key => $value) {
					$hiddenFields .= sprintf(
							'<input type="hidden" name="%1$s" value="%2$s" />',
							htmlentities($key, ENT_QUOTES, 'UTF-8', false),
							htmlentities($value, ENT_QUOTES, 'UTF-8', false)
						)."\n";
				}

				$url=htmlentities($res->getRedirectUrl(), ENT_QUOTES, 'UTF-8', false);

				return sprintf('<form action="%s" method="post" id="st_form_payfast_submit">

    						<script>document.getElementById(\'st_form_payfast_submit\').submit();</script>
							%s
						</form>',$url,$hiddenFields);
			}
            function is_available($item_id = false)
            {
				$result=false;
				if(st()->get_option('pm_gway_st_payfast_enable')=='on')
				{
					$result= true;
				}
				if($item_id)
				{
					$meta=get_post_meta($item_id,'is_meta_payment_gateway_st_payfast',true);
					if($meta=='off'){
						$result=false;
					}
				}

				return $result;
            }

            function get_name()
            {
                return "PayFast";
            }
            function _pre_checkout_validate()
            {
                return true;
            }

            function check_complete_purchase($order_id)
            {
				$total = get_post_meta($order_id, 'total_price', true);
				$total=round((float)$total,2);
				$gateway = $this->_gatewayObject;

				$gateway->setMerchantId(st()->get_option('pay_fast_merchant_id'));
				$gateway->setMerchantKey(st()->get_option('pay_fast_merchant_key'));
				$gateway->setPdtKey(st()->get_option('pay_fast_pdt_key'));
				if (st()->get_option('pay_fast_enable_sandbox', 'on') == 'on') {
					$gateway->setTestMode(true);
				}
				$order_token_code=get_post_meta($order_id,'order_token_code',true);


				$response = $gateway->completePurchase(
					array(
						'amount'      => (float)$total,
						'currency'    => TravelHelper::get_current_currency('name'),
						'description' => __('Traveler Booking', ST_TEXTDOMAIN),
						'returnUrl'   => $this->get_return_url($order_id),
						'cancelUrl'   =>$this->get_cancel_url($order_id),
						'transactionId'=>$order_token_code,
						//'items'=>$this->get_line_items()
					)
				)->send();


				if ($response->isSuccessful()) {
					$data=$response->getData();
					if(isset($data['email_address']))
					{
						update_post_meta($order_id,'st_payfast_buyer_email',$data['email_address']);
					}
					if(isset($data['merchant_id']))
					{
						update_post_meta($order_id,'st_payfast_merchant_id',$data['merchant_id']);
					}
					if(isset($data['pf_payment_id']))
					{
						update_post_meta($order_id,'st_payfast_pf_payment_id',$data['pf_payment_id']);
					}

					return array('status'=>true);

				} elseif ($response->isRedirect()) {
					//$response->redirect(); // this will automatically forward the customer
					return array('status' => false, 'redirect_url' => $response->getRedirectUrl(), 'func' => 'check_completePurchase');

				} else {
					// not successful
					return array('status' => false, 'message' => $response->getMessage());

				}
            }

            function get_option_fields()
            {
                return array(
                    array(
                        'id'            =>'pay_fast_merchant_id',
                        'label'         =>__('Merchant Id',ST_TEXTDOMAIN),
                        'type'          =>'text',
                        'section'       =>'option_pmgateway',
                        'desc'          =>__('Your Merchant Id',ST_TEXTDOMAIN),
                        'condition'     =>'pm_gway_st_payfast_enable:is(on)'
                    ),
                    array(
                        'id'            =>'pay_fast_merchant_key',
                        'label'         =>__('Merchant Key',ST_TEXTDOMAIN),
                        'type'          =>'text',
                        'section'       =>'option_pmgateway',
                        'desc'          =>__('Your Merchant Key',ST_TEXTDOMAIN),
                        'condition'     =>'pm_gway_st_payfast_enable:is(on)'
                    ),
                    array(
                        'id'            =>'pay_fast_enable_sandbox',
                        'label'         =>__('Enable Sandbox',ST_TEXTDOMAIN),
                        'type'          =>'on-off',
                        'section'       =>'option_pmgateway',
                        'std'           =>'on',
                        'desc'          =>__('Allow you to enable sandbox mod for testing',ST_TEXTDOMAIN),
                        'condition'     =>'pm_gway_st_payfast_enable:is(on)'
                    ),
                );
            }

            function get_default_status()
            {
                return $this->default_status;
            }

			function get_logo()
			{
				return get_template_directory_uri().'/img/gateway/pf-logo.png';
			}
			function getGatewayId()
			{
				return $this->_gateway_id;
			}
			function  is_check_complete_required()
			{
				return true;
			}

			static function instance()
			{
				if(!self::$_ints)
				{
					self::$_ints=new self();
				}
				return self::$_ints;
			}
            static function add_payment($payment)
            {
				$payment['st_payfast']=self::instance();
				return $payment;

            }

        }

        add_filter('st_payment_gateways',array('ST_Payfast_Gateway','add_payment'));
    }