<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/14/2018
 * Time: 8:24 AM
 */

if(!class_exists('ST_Order'))
{
    class ST_Order{

        protected static $cachedInstances=[];

        protected $data;

        protected $order_id=false;

        public function __construct($order_id=false)
        {
            $this->order_id=$order_id;
        }

        /**
         * @todo Get Type of Order: normal_booking or woocommerce
         *
         * @return string
         */
        public function getType()
        {

        }


        /**
         * @todo Check if current order is using Woocommerce Checkout
         *
         * @return bool
         */
        public function isWoocommerceCheckout()
        {
            return $this->getType()=='woocommerce'?true:false;
        }

        /**
         * @return WC_Order
         */
        public function getWoocommerceOrder()
        {
            global $wpdb;

            return new WC_Order($this->order_id);
        }


        /**
         * @todo Get total amount
         *
         * @return float
         */
        public function getTotal()
        {
            if ($this->isWoocommerceCheckout()) {
                global $wpdb;
                $querystr = "SELECT meta_value FROM  " . $wpdb->prefix . "woocommerce_order_itemmeta
                                    WHERE
                                    1=1
                                    AND order_item_id = '{$this->order_id}'
                                    AND (
                                        meta_key = '_line_total'
                                        OR meta_key = '_line_tax'
                                        OR meta_key = '_st_booking_fee_price'
                                    )
                                    ";
                $price = $wpdb->get_results($querystr, OBJECT);
                $data_price = 0;
                if (!empty($price)) {
                    foreach ($price as $k => $v) {
                        $data_price += $v->meta_value;
                    }
                }
                return $data_price;
            } else {
                return $this->getMeta('total_price');
            }
        }

        public function getMeta($key)
        {
            return get_post_meta($this->order_id,$key,true);
        }

        public function getItems()
        {
            global $wpdb;
            if($this->isWoocommerceCheckout())
            {
                if($order=$this->getWoocommerceOrder())
                {
                    return $order->get_items();
                }
                return [];
            }

            return $wpdb->get_results($wpdb->prepare("SELECT * from {$wpdb->prefix}st_order_item_meta"));

        }

        /**
         * @param $order_id
         * @return mixed|ST_Order
         */
        protected static function inst($order_id)
        {
            if(!isset(self::$cachedInstances[$order_id])) self::$cachedInstances[$order_id]=new self($order_id);
            return self::$cachedInstances[$order_id];
        }

    }
}