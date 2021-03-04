<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/04/2018
 * Time: 15:31 CH
 */

class ST_Availability_Model extends ST_Model
{
    protected $ignore_create_table=true;
    protected $table_name='st_availability';
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

ST_Availability_Model::inst();