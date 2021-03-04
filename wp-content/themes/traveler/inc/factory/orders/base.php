<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 1:49 PM
 */
abstract class ST_Base_Order
{
    protected $post;
    protected $order_id;

    public function __construct($post)
    {
        if($post instanceof WP_Post)
        {
            $this->order_id = $post->ID;
            $this->post = $post;
        }else{
            $this->order_id = $post;
            $this->post = new WP_Post($this->order_id);
        }
    }



    abstract function get_admin_edit_url();
}