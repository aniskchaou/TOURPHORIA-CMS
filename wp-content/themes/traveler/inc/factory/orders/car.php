<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 1:53 PM
 */

class ST_Car_Model extends ST_Base_Order
{
    public function __construct($post)
    {
        parent::__construct($post);
    }

    public function get_admin_edit_url()
    {
        // TODO: Implement get_admin_edit_url() method.
        return add_query_arg([
            'post_type'=>'st_cars',
            'page'=>'st_car_booking',
            'car_type'=>'normal',
            'section'=>'edit_order_item',
            'order_item_id'=>$this->order_id,

        ],admin_url('edit.php'));
    }

    public function get_items()
    {

    }
}