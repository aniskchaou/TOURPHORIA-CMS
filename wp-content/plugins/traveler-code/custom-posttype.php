<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 11/13/14
 * Time: 9:09 AM
 */

if(!function_exists('st_add_sc_param'))
{
    function st_add_sc_param($s1,$s2)
    {
        vc_add_shortcode_param($s1,$s2);
    }
}
if(!function_exists('st_reg_post_type'))
{
    function st_reg_post_type($name,$args=array())
    {
        register_post_type($name,$args);
    }
}
if(!function_exists('st_reg_taxonomy'))
{
    function st_reg_taxonomy($name,$objects='',$args=array())
    {
        register_taxonomy($name,$objects,$args);
    }
}
if(!function_exists('st_reg_shortcode'))
{
    function st_reg_shortcode($tag , $func)
    {
        add_shortcode($tag , $func);
    }
}
if(!function_exists('st_list_taxonomy'))
{
    function st_list_taxonomy($post_type='post'){

        $all=get_object_taxonomies($post_type,'objects');


        $result=array();

        $result[__('--Select--',ST_TEXTDOMAIN)]=false;

        if(!empty($all))
        {
            foreach($all as $key=>$value)
            {
                $result[$value->label]=$value->name;
            }
        }

        return $result;
    }
}