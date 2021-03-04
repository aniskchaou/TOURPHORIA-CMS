<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 19/06/2015
 * Time: 6:31 CH
 */

if(!function_exists('st_car_price_unit_title'))
{
    function st_car_price_unit_title($unit,$need='normal')
    {
        switch ($unit)
        {
            case "day":
            case "per_day":
                switch($need){
                    case "normal":return __('day',ST_TEXTDOMAIN); break;
                    case "plural":return __('days',ST_TEXTDOMAIN); break;
                }
                break;
            case "hour":
            case "per_hour":

            switch($need){
                case "normal":return __('hour',ST_TEXTDOMAIN); break;
                case "plural":return __('hours',ST_TEXTDOMAIN); break;
            }
            break;
            default:
                return $unit;
            break;

        }
    }
}