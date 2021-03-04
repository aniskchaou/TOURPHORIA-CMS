<?php
    /**
     * @package    WordPress
     * @subpackage Traveler
     * @since      1.0
     *
     * Class STAbstactPaymentGateway
     *
     * Created by ShineTheme
     *
     */
    if ( !class_exists( 'STAbstactPaymentGateway' ) ) {
        abstract class STAbstactPaymentGateway
        {
            private $_gatewayObject = null;

            /**
             *
             * Return current gateway object
             * @return null
             */
            function get_gateway()
            {
                return $this->_gatewayObject;
            }

            /**
             * Render html for checkout page
             *
             *
             * */
            abstract function html();

            /**
             * Handle checkout action after create the order
             *
             *
             * */
            abstract function do_checkout( $order_id );


            /**
             * Return if current gateway is available
             *
             * @update 1.1.7
             * */
            abstract function is_available( $item_id = FALSE );

            /**
             * Get Payment Gateway Name
             *
             *
             * */
            abstract function get_name();

            /**
             * Get Payment Logo Image
             *
             *
             * */
            abstract function get_logo();

            /**
             * _pre_checkout_validate
             *
             *
             * */
            abstract function _pre_checkout_validate();

            /**
             * Get Theme Options param
             *
             *
             * */

            abstract function get_option_fields();

            /**
             *
             * Get Default Gateway Status
             *
             *
             * */
            abstract function get_default_status();


            /**
             * Return method GET/POST of the gateway
             * @return string
             */
            function get_method()
            {
                return "GET";
            }

            /**
             * Return status of check required
             * @return mixed
             */
            abstract function is_check_complete_required();

            /**
             * If yes, changing order status will be happen in gateway class. If you dont know what it is, please dont try to change
             * Normal use for non-payment class
             * @return bool
             */
            function stop_change_order_status()
            {
                return false;
            }

            /**
             * Check complete purchase after redirect from 3rd gateway to origin site
             *
             * @param $order_id
             *
             * @return mixed
             */
            abstract function check_complete_purchase( $order_id );

            /**
             * Get the gateway id
             * @return string
             */
            abstract function getGatewayId();

            function get_cancel_url( $order_id )
            {
                $order_token_code = get_post_meta( $order_id, 'order_token_code', TRUE );
                if ( !$order_token_code ) {
                    $array = [
                        'gateway_name' => $this->getGatewayId(),
                        'order_code'   => $order_id,
                        'status'       => FALSE
                    ];
                } else {
                    $array = [
                        'gateway_name'     => $this->getGatewayId(),
                        'order_token_code' => $order_token_code,
                        'status'           => FALSE
                    ];

                }

                return add_query_arg( $array, STCart::get_success_link() );
            }

            function get_return_url( $order_id )
            {

                $order_token_code = get_post_meta( $order_id, 'order_token_code', TRUE );
                if ( !$order_token_code ) {
                    $array = [
                        'gateway_name' => $this->getGatewayId(),
                        'order_code'   => $order_id,
                        'status'       => TRUE
                    ];
                } else {
                    $array = [
                        'gateway_name'     => $this->getGatewayId(),
                        'order_token_code' => $order_token_code,
                        'status'           => TRUE
                    ];

                }

                return add_query_arg( $array, STCart::get_success_link() );

            }

        }
    }
