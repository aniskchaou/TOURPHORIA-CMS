<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/20/2018
 * Time: 1:39 PM
 */

class ST_Service_Factory
{
    protected static $_inst;

    protected static $_cachedInstances=[];

    public static function initial()
    {
        include_once 'services/base.php';
        include_once 'services/hotel.php';

        do_action('st_service_factory_initial');
    }

    /**
     * @param $post int|WP_Post
     * @return bool|ST_Base_Service|ST_Hotel_Service
     */
    public static function get($post)
    {
        if($post instanceof WP_Post)
        {
            $post_id=$post->ID;
        }else $post_id = $post;

        if(!isset(self::$_cachedInstances[$post_id])) self::$_cachedInstances[$post_id] = self::create($post_id);

        return self::$_cachedInstances[$post_id];

    }

    protected static function create($post_id)
    {
        switch (get_post_type($post_id))
        {
            case "st_hotel":
                return new ST_Hotel_Service($post_id);
                break;
        }
    }



}

ST_Service_Factory::initial();