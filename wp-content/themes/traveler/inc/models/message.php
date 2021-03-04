<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 2:05 PM
 */
class ST_Message_Model extends ST_Model
{
    protected $ignore_create_table=true;
    protected $table_name='st_message';
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

ST_Message_Model::inst();