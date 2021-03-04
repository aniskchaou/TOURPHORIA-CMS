<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 2:06 PM
 */

class ST_Message_Factory
{
    protected static $_inst;

    protected static $_cachedInstances=[];

    public static function initial()
    {
        include_once 'message/message.php';

        do_action('st_message_factory_initial');
    }

    /**
     * @todo Get Instance of ST_Message by Message ID or ...
     *
     * @param $message int|array
     * @return bool|ST_Message
     */
    public static function get($message)
    {
        if(is_array($message))
        {
            $id=$message['id'];
        }else $id = $message;

        if(!isset(self::$_cachedInstances[$id])) self::$_cachedInstances[$id] = self::create($id);

        return self::$_cachedInstances[$id];

    }

    /**
     * @todo Get Single Message by Args
     *
     * @param array $args
     * @return bool|ST_Message
     */
    public static function findOne($args = [])
    {
        $query = self::query($args);
        $row = $query->get(1)->row();

        if(empty($row)) return false;
        else{
            return self::get($row);
        }
    }

    /**
     * @todo Query All Messages
     *
     * @params $args array
     * @return ST_Message[]
     */
    public static function findAll($args=[])
    {
        $args = wp_parse_args($args,[
            'limit'=>20,
            'page'=>1
        ]);

        $page = max(1,$args['page']);

        $query = self::query($args);


        $rows = $query->get($args['limit'],($page-1)*$args['limit'])->result();

        $res = [];
        if(!empty($rows))
        {
            foreach ($rows as $row)
            {
                $res[]=self::get($row);
            }
        }

        return $res;
    }

    /**
     * @todo Generate Query Model
     *
     * @param $args
     * @return ST_Message_Model
     */
    protected static function query($args)
    {
        $args = wp_parse_args($args,[
            'limit'=>20,
            'page'=>1
        ]);

        $page = max(1,$args['page']);

        $query=ST_Message_Model::inst();

        $query->orderby('created_at','desc');

        if(!empty($args['status']))
        {
            $query->where('status');
        }

        if(!empty($args['author_id']))
        {
            $query->where('author_id');
        }
        if(!empty($args['customer_id']))
        {
            $query->where('customer_id');
        }

        return $query;
    }

    /**
     * @todo Get Total of FOUND_ROWS() in prev query
     *
     * @return int
     */
    public static function getTotal()
    {
        return ST_Message_Model::inst()->get_total();
    }


    protected static function create($id)
    {
       return new ST_Message($id);
    }



}

ST_Message_Factory::initial();