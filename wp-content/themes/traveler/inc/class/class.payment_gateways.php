<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STPaymentGateways
     *
     * Created by ShineTheme
     *
     */

    if ( !class_exists( 'STPaymentGateways' ) ) {
        class STPaymentGateways
        {
            static $_payment_gateways = [];

            protected static $_gateways_inited = false;

            static function _init()
            {

//load abstract class
                STTraveler::load_libs( [
                    'abstract/class-abstract-payment-gateway'
                ] );
                add_action( 'init', [ __CLASS__, '_do_add_gateway_options' ] );
            }

            static function _do_add_gateway_options()
            {
                    add_filter( 'traveler_all_settings', [ __CLASS__, '_add_gateway_options' ] );
            }

            static function _add_gateway_options( $settings = [] )
            {

                $settings[] = [
                    'id'    => 'option_pmgateway',
                    'title' => __( '<i class="fa fa-money"></i> Payment Options', ST_TEXTDOMAIN ),
                    'settings'=>[__CLASS__,'__getOptions']
                ];

                return $settings;
            }
            public static function __getOptions()
            {
                $option_fields = [];

                $all = self::get_payment_gateways();
                if ( is_array( $all ) and !empty( $all ) ) {
                    foreach ( $all as $key => $value ) {
                        $field = $value->get_option_fields();

                        $default = [
                            [

                                'id'      => 'pm_gway_' . $key . '_tab',
                                'label'   => sprintf( __( '%s', ST_TEXTDOMAIN ), $value->get_name() ),
                                'type'    => 'tab',
                                'section' => 'option_pmgateway'
                            ],
                            [

                                'id'      => 'pm_gway_' . $key . '_enable',
                                'label'   => sprintf( __( 'Enable %s', ST_TEXTDOMAIN ), $value->get_name() ),
                                'type'    => 'on-off',
                                'std'     => $value->get_default_status() ? 'on' : 'off',
                                'section' => 'option_pmgateway'
                            ],

                        ];

                        $option_fields = array_merge( $option_fields, $default );

                        if ( $field and is_array( $field ) ) {
                            $option_fields = array_merge( $option_fields, $field );
                        }
                    }
                }

                return $option_fields;
            }

            protected static function init_default_gateways()
            {
                //load abstract class
                STTraveler::load_libs( [
                    'abstract/class-abstract-payment-gateway'
                ] );

                //Load default gateways
                self::_load_default_gateways();


                if ( class_exists( 'STGatewaySubmitform' ) ) {
                    self::$_payment_gateways['st_submit_form'] = new STGatewaySubmitform();
                }
                if ( class_exists( 'New_Payment' ) ) {
                    self::$_payment_gateways[ 'st_new_payment' ] = new New_Payment();
                }
            }

            static function get_payment_gateways()
            {
                if(!self::$_gateways_inited){
                    self::init_default_gateways();
                }
                $all = apply_filters( 'st_payment_gateways', self::$_payment_gateways );

                return $all;
            }

            /**
             *
             *
             * @since  1.0.1
             * @update 1.1.7
             */
            static function get_payment_gateways_html( $post_id = false )
            {

                $all = self::get_payment_gateways();
                if ( is_array( $all ) and !empty( $all ) ) {
                    $i         = 1;
                    $available = [];

                    foreach ( $all as $key => $value ) {
                        if ( method_exists( $value, 'is_available' ) and $value->is_available() ) {

                            if ( !$post_id ) {
                                $post_id = STCart::get_booking_id();
                            }

                            if ( $value->is_available( $post_id ) ) {
                                $available[ $key ] = $value;
                            }
                        }
                    }

                    if ( !empty( $available ) ) {
                        ?>
                        <div class="st-payment-tabs-wrap">
                            <ul class="st-payment-tabs clearfix">
                                <?php
                                    $i = 0;
                                    foreach ( $available as $key => $value ) {
                                        ?>
                                        <li class="payment-gateway payment-gateway-<?php echo esc_attr( $key ); ?> <?php echo ( !$i ) ? 'active' : false; ?>"
                                            data-gateway="<?php echo esc_attr( $key ) ?>">
                                            <label class="payment-gateway-wrap">
                                                <div class="logo">
                                                    <div class="h-center">
                                                        <?php printf( '<img src="%s" alt="%s">', $value->get_logo(), $value->get_name() ) ?>
                                                    </div>
                                                </div>
                                                <h4 class="gateway-name"><?php echo esc_html( $value->get_name() ); ?></h4>
                                                <input type="radio" class="i-radio payment-item-radio"
                                                       name="st_payment_gateway" <?php echo ( !$i ) ? 'checked' : false; ?>
                                                       value="<?php echo esc_attr( $key ) ?>">
                                            </label>
                                        </li>

                                        <?php
                                        $i++;
                                    }
                                ?>
                            </ul>
                            <div class="st-payment-tab-content">
                                <?php
                                    foreach ( $available as $key => $value ) {
                                        ?>
                                        <div class="st-tab-content" data-id="<?php echo esc_attr( $key ) ?>">
                                            <?php $value->html(); ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>

                        </div>
                        <?php
                    }
                }
            }
            static function get_payment_gateways_package_html( $post_id = false )
            {
                if(New_Layout_Helper::isNewLayout()) {
                    $all = self::get_payment_gateways();
                    if (is_array($all) and !empty($all)) {
                        $i = 1;
                        $available = [];

                        foreach ($all as $key => $value) {
                            if (method_exists($value, 'is_available') and $value->is_available()) {

                                if (!$post_id) {
                                    $post_id = STCart::get_booking_id();
                                }

                                if ($value->is_available($post_id)) {
                                    $available[$key] = $value;
                                }
                            }
                        }

                        if (!empty($available)) {
                            $i = 0;
                            foreach ($available as $key => $value) {
                                ?>
                                <div class="payment-item <?php echo (!$i) ? 'active' : false; ?> payment-gateway payment-gateway-wrapper payment-gateway-<?php echo esc_attr($key); ?>"
                                     id="payment-gateway payment-gateway-<?php echo esc_attr($key); ?>"
                                     data-gateway="<?php echo esc_attr($key) ?>">
                                    <div class="dropdown">
                                        <div class="st-icheck">
                                            <div class="st-icheck-item">
                                                <label>
                                                    <div class="check-payment">
                                                        <input type="radio" name="st_payment_gateway"
                                                               class="payment-item-radio" <?php echo (!$i) ? 'checked' : false; ?>
                                                               value="<?php echo esc_attr($key) ?>"/>
                                                        <span class="checkmark"></span>
                                                    </div>
                                                    <span class="payment-title"><?php echo $value->get_name(); ?></span>
                                                    <img src="<?php echo $value->get_logo(); ?>"
                                                         alt="<?php echo $value->get_name(); ?>"
                                                         class="<?php echo $key; ?>">
                                                </label>
                                            </div>
                                        </div>
                                        <?php if (!in_array($key, array('st_submit_form', 'st_paypal_adaptivepayment'))) { ?>
                                            <div class="dropdown-menu">
                                                <?php $value->html(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                    }
                }else{
                    $all = self::get_payment_gateways();
                    if (is_array($all) and !empty($all)) {
                        $i = 1;
                        $available = [];

                        foreach ($all as $key => $value) {
                            if (method_exists($value, 'is_available') and $value->is_available()) {

                                if (!$post_id) {
                                    $post_id = STCart::get_booking_id();
                                }

                                if ($value->is_available($post_id)) {
                                    $available[$key] = $value;
                                }
                            }
                        }

                        if (!empty($available)) {
                            $i = 0;
                            foreach ($available as $key => $value) {
                                ?>
                                <div class="payment-item <?php echo (!$i) ? 'active' : false; ?> payment-gateway payment-gateway-wrapper payment-gateway-<?php echo esc_attr($key); ?>"
                                     id="payment-gateway payment-gateway-<?php echo esc_attr($key); ?>"
                                     data-gateway="<?php echo esc_attr($key) ?>">
                                    <div class="dropdown">
                                        <div class="st-icheck">
                                            <div class="st-icheck-item">
                                                <label>
                                                    <div class="check-payment">
                                                        <input type="radio" name="st_payment_gateway"
                                                               class="payment-item-radio" <?php echo (!$i) ? 'checked' : false; ?>
                                                               value="<?php echo esc_attr($key) ?>"/>
                                                        <span class="checkmark"></span>
                                                    </div>
                                                    <span class="payment-title"><?php echo $value->get_name(); ?></span>
                                                    <img src="<?php echo $value->get_logo(); ?>"
                                                         alt="<?php echo $value->get_name(); ?>"
                                                         class="<?php echo $key; ?>">
                                                </label>
                                            </div>
                                        </div>
                                        <?php if (!in_array($key, array('st_submit_form', 'st_paypal_adaptivepayment'))) { ?>
                                            <div class="dropdown-menu">
                                                <?php $value->html(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                    }
                }
            }
            /**
             *
             *
             * @param      $id
             * @param bool $post_id
             *
             * @return mixed
             */
            static function get_gateway( $id, $post_id = false )
            {
                $all = self::get_payment_gateways();
                if ( isset( $all[ $id ] ) ) {
                    $value = $all[ $id ];
                    if ( method_exists( $value, 'is_available' ) and $value->is_available( $post_id ) ) {
                        return $value;
                    }
                }

            }

            static function get_gatewayname( $id )
            {
                $all = self::get_payment_gateways();
                if ( isset( $all[ $id ] ) ) {
                    $value = $all[ $id ];
                    if ( method_exists( $value, 'get_name' ) ) {
                        return $value->get_name();
                    } else return $id;
                }
            }


            /**
             * Check if a gateway is allow to show the booking infomation by gived gateway id
             *
             * @param bool|FALSE $id
             *
             * @return bool
             */
            static function gateway_success_page_validate( $id = false )
            {
                $status_url       = STInput::get( 'status', false );
                $all = self::get_payment_gateways();
                if ( isset( $all[ $id ] ) ) {
                    $value = $all[ $id ];
                    if ( method_exists( $value, 'get_name' ) ) {
                        if($status_url) {
                            $order_code = STInput::get('order_code');
                            $order_token_code = STInput::get('order_token_code');
                            if ($order_token_code) {
                                $order_code = STOrder::get_order_id_by_token($order_token_code);
                            }

                            $status = get_post_meta($order_code, 'status', true);

                            $result = true;

                            if ($status == 'incomplete') {
                                if ($value->is_check_complete_required()) {
                                    $r = $value->check_complete_purchase($order_code);
                                } else {
                                    $r = [
                                        'status' => true
                                    ];
                                }

                                if ($r) {
                                    if (isset($r['status'])) {
                                        if ($r['status']) {
                                            $result = true;
                                            update_post_meta($order_code, 'status', 'complete');
                                            $status = 'complete';

                                            STCart::send_mail_after_booking($order_code, true);
                                            do_action('st_booking_change_status', 'complete', $order_code, $value->getGatewayId());

                                        } elseif (isset($r['message']) and $r['message']) {
                                            $result = false;
                                            STTemplate::set_message($r['message'], 'danger');
                                        }

                                        if (isset($r['redirect_url']) and $r['redirect_url']) {
                                            echo "<script>window.location.href='" . $r['redirect_url'] . "'</script>";
                                            die;
                                        }
                                    }
                                }

                            }

                            if ($status == 'incomplete') {
                                $result = false;
                                STTemplate::set_message(__("Sorry! Your payment is incomplete.", ST_TEXTDOMAIN));
                            }
                        }else{
                            $result = false;
                            STTemplate::set_message(__("Sorry! Your payment is incomplete.", ST_TEXTDOMAIN));
                        }


                        return $result;
                    }

                } else {
                    STTemplate::set_message( __( 'Sorry! Your Payment Gateway is not valid', ST_TEXTDOMAIN ), 'danger' );
                }
            }


            /**
             * Process the check out
             *
             * @param $gateway
             * @param $order_id
             *
             * @return array
             */
            static function do_checkout( $gateway, $order_id )
            {
                $total = get_post_meta( $order_id, 'total_price', true );
                // check status complete first
                if ( get_post_meta( $order_id, 'status', true ) == 'complete' ) {
                    return [
                        'status'   => true,
                        'redirect' => STCart::get_success_link( $order_id )
                    ];
                }


                if ( !$gateway->stop_change_order_status() ) {
                    update_post_meta( $order_id, 'status', 'incomplete' );
                    do_action( 'st_booking_change_status', 'incomplete', $order_id, $gateway->getGatewayId() );
                }

                try {

                    $res = $gateway->do_checkout( $order_id );

                    if ( $res[ 'status' ] ) {
                        if ( !$gateway->is_check_complete_required() and !$gateway->stop_change_order_status() ) {

                            update_post_meta( $order_id, 'status', 'complete' );
                            STCart::send_mail_after_booking( $order_id, true );
                            do_action( 'st_booking_change_status', 'complete', $order_id, $gateway->getGatewayId() );

                        }
                        if ( !isset( $res[ 'redirect' ] ) or !$res[ 'redirect' ] ) {
                            $res[ 'redirect' ] = STCart::get_success_link( $order_id );
                        }
                    } else {
                        if ( !isset( $res[ 'message' ] ) ) {
                            $res[ 'message' ] = false;
                        } else {
                            $res[ 'message' ] = sprintf( __( '<br>Message: %s', ST_TEXTDOMAIN ), $res[ 'message' ] );
                        }
                        $res[ 'message' ] = sprintf( __( 'Your order has been made but we can not process the payment with %s. %s ', ST_TEXTDOMAIN ), $gateway->get_name(), $res[ 'message' ] );
                    }

                } catch ( Exception $e ) {
                    $res[ 'status' ]    = 0;
                    $message            = sprintf( __( '<br>Message: %s', ST_TEXTDOMAIN ), $e->getMessage() );
                    $res[ 'exception' ] = $e;
                    $res[ 'message' ]   = sprintf( __( 'Your order has been made but we can not process the payment with %s. %s', ST_TEXTDOMAIN ), $gateway->get_name(), $message );
                }


                $res[ 'step' ] = 'do_checkout';

                $res[ 'order_id' ] = (int)$order_id;

                return $res;
            }


            static function _load_default_gateways()
            {
                if ( !class_exists( 'Omnipay\Omnipay' ) ) return false;

                $path    = STTraveler::dir( 'gateways' );
                $results = scandir( $path );

                foreach ( $results as $result ) {
                    if ( $result === '.' or $result === '..' ) continue;
                    if ( is_dir( $path . '/' . $result ) ) {

                        $file = $path . '/' . $result . '/' . $result . '.php';
                        if ( file_exists( $file ) ) {
                            include_once $file;
                        }

                    }
                }
            }
        }

        STPaymentGateways::_init();
    }
