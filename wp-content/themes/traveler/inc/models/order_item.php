<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/04/2018
 * Time: 14:08 CH
 */
class ST_Order_Item_Model extends ST_Model
{
    protected $ignore_create_table=true;
    protected $table_name='st_order_item_meta';
    protected $table_key='id';

    protected static $_inst;

    public function __construct()
    {
        parent::__construct();
    }


    public static function inst()
    {
        if(!self::$_inst) self::$_inst=new self();
        return self::$_inst;
    }



}

ST_Order_Item_Model::inst();