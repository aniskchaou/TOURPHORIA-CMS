<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/21/2018
 * Time: 9:50 AM
 */

class ST_User_Message
{
    protected static $_inst;


    public function __construct()
    {
    }



    public static function inst()
    {
        if ( !self::$_inst ) {
            self::$_inst = new self();
        }

        return self::$_inst;
    }
}

ST_User_Message::inst();