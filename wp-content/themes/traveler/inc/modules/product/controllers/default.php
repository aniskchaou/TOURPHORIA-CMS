<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/20/15
 * Time: 3:08 PM
 */

if(!class_exists('ST_Product_Controller'))
{
    class ST_Product_Controller extends ST_Abstract_Front_Controller
    {
        function __construct()
        {
            parent::__construct(array(
                'post_type'         =>'product',
                'module_file'       =>__FILE__
            ));

            add_action('woocommerce_before_shop_loop_item_title',array($this,'_show_new_ribbon'));
            add_action('woocommerce_before_single_product_summary',array($this,'_show_new_ribbon'));

            add_filter('st_is_new_product',array($this,'_filter_is_new_product'));

            add_filter('st_shop_product_style',array($this,'_shop_product_style'));
            add_filter('woocommerce_short_description',array($this,'_limit_short_description'));
        }

        function _limit_short_description($e)
        {
            return TravelHelper::cutnchar($e,200);
        }
        function _shop_product_style()
        {
            $style=st()->get_option('shop_default_list_view','grid');

            if(STInput::get('view_style'))
            {
                $style=STInput::get('view_style');
            }
            return $style;
        }
        function _filter_is_new_product($post_id=false)
        {
            if(!$post_id) $post_id=get_the_ID();
            if(!$post_id) return false;
            if(get_post_meta($post_id,'set_new_product',true)=='on' )
            {
                return true;
            }else{
                return false;
            }
        }

        function _show_new_ribbon()
        {
            echo balanceTags($this->load_view('new_product_ribbon'));
        }
    }
    new ST_Product_Controller();
}