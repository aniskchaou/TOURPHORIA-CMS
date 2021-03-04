<?php

/**
 *
 * Base Class Shortcode
 *
 * @package ST Framework
 *
 * @date 01.10.2014
 *
 * @version 1.0
 *
 * */

if(!class_exists('STBasedShortcode'))
{
    class STBasedShortcode
    {


        function __construct()
        {
            $className=get_class($this);

            $className=mb_strtolower($className);

            add_shortcode($className,array($this,'content'));

        }

        function content($attrs,$content=false)
        {

        }



    }
}

