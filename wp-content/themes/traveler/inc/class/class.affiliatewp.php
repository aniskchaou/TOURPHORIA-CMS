<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 11:20 AM
 */

if(class_exists('Affiliate_WP_Base'))
{
    class ST_AffiliateWP extends Affiliate_WP_Base
    {

        public function init()
        {
            $this->context = 'travelertheme';

            add_action('st_booking_change_status', array($this, 'mark_referral_complete'), 10,3);
            add_action('st_booking_cancel_order_item', array($this, 'revoke_referral_on_refund'), 10);

            // Admin Edit Booking
            add_action('st_admin_edit_booking_status',array($this,'admin_edit_booking_status'),10,2);
            add_action('st_admin_delete_booking',array($this,'revoke_referral_on_refund'));


            add_filter('affwp_referral_reference_column', array($this, 'reference_link'), 10, 2);

        }


        function mark_referral_complete($status,$order_id,$gateway_id)
        {
            if($status!='complete') return;

            $amount = get_post_meta($order_id, 'total_price', TRUE);

            if ($this->was_referred()) {
//
//
//                $tax = STPrice::getTotalPriceWithTaxInOrder($amount,$order_id);
//
//                if (affiliate_wp()->settings->get('exclude_tax')) {
//                    $amount -= $data['total_tax'];
//                }

                $reference = $order_id;
                $affiliate_id = affiliate_wp()->tracking->get_affiliate_id();

                $referral_total = $this->calculate_referral_amount($amount, $reference, 0, $affiliate_id);
                $this->insert_pending_referral($referral_total, $reference, '', null, ['affiliate_id' => $affiliate_id]);
            }
        }

        function admin_edit_booking_status($status,$order_id)
        {
            if($status!='complete') $this->revoke_referral_on_refund($order_id);
        }

        function revoke_referral_on_refund($booking_id)
        {
            if (!affiliate_wp()->settings->get('revoke_on_refund')) {
                return;
            }
            $this->reject_referral($booking_id);
        }


        public function reference_link($reference = 0, $referral)
        {

            if (empty($referral->context) || 'travelertheme' != $referral->context) {
                return $reference;
            }


            switch ($post_type = get_post_meta($reference,'item_post_type',true))
            {
                case "st_cars":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_car_booking',
                        'car_type'=>'normal',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;
                case "st_hotel":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_hotel_booking',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;
                case "st_rental":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_rental_booking',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;
                case "st_tours":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_tours_booking',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;
                case "st_activity":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_activity_booking',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;
                case "st_flight":
                    $url = add_query_arg([
                        'post_type'=>$post_type,
                        'page'=>'st_flight_booking',
                        'section'=>'edit_order_item',
                        'order_item_id'=>$reference,

                    ],admin_url('edit.php'));
                    break;

            }

            return '<a target="_blank" href="' . esc_url($url) . '">' . $reference . '</a>';
        }

        public static function reference_link_frontend($referral,$reference_id)
        {
            if($referral!='travelertheme') return $reference_id;

            $st_booking_id = get_post_meta($reference_id,'st_booking_id',true);

            if(!get_post($st_booking_id)) return $reference_id;

            $url = get_permalink($st_booking_id);

            return '<a target="_blank" href="' . esc_url($url) . '">' . get_the_title($st_booking_id) . '</a>';

        }


        static function getGeneralData()
        {
            global $wpdb;
            $tabl_name = 'wp_affiliate_wp_affiliates';

            return $wpdb->get_row( $wpdb->prepare("SELECT * FROM $tabl_name WHERE user_id  = %d"  ,get_current_user_id()));
        }


    }

    new ST_AffiliateWP();
}
