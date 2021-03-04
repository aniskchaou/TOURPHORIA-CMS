<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/04/2018
 * Time: 15:31 CH
 */

class ST_Cronjob_Log_Model extends ST_Model
{
    protected $table_name='st_cronjob_log';
    protected $table_version='1.0';
    protected $columns=array(
        'id'=>array(
            'AUTO_INCREMENT'=>1,
            'type'=>'INTEGER',
            'length'=>11
        ),
        'time'=>array(
            'type'=>'INTEGER',
            'length'=>11
        ),
        'action'=>array(
            'type'=>'varchar',
            'length'=>255
        ),
        'log'=>array(
            'type'=>'text',
        ),
    );

    protected static $_inst;

    public function __construct()
    {
        parent::__construct();
    }

    public function log($action,$log)
    {
        return $this->insert(array(
            'time'=>time(),
            'action'=>$action,
            'log'=>$log
        ));
    }

    public static function inst()
    {
        if(!self::$_inst) self::$_inst=new self();
        return self::$_inst;
    }


}

ST_Cronjob_Log_Model::inst();