<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13/04/2018
 * Time: 15:23 CH
 */
class ST_Posts_Model extends ST_Model
{
    protected $ignore_create_table=true;
    protected $table_name='posts';
    protected $table_key='ID';

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

ST_Posts_Model::inst();