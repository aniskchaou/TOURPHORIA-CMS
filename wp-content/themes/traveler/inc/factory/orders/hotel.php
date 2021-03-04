<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 1:52 PM
 */
class ST_Hotel_Order extends ST_Base_Order
{
    public function __construct($post)
    {
        parent::__construct($post);
    }

    public function get_admin_edit_url()
    {
        // TODO: Implement get_admin_edit_url() method.
    }
}