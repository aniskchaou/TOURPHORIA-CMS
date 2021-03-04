<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 4:29 PM
 */

class ST_Inbox_Model extends ST_Model
{
    protected $ignore_create_table=true;
    protected $table_name='st_inbox';
    protected $table_key='id';

    protected static $_inst;

    public function __construct()
    {
        parent::__construct();
    }


    public function findInboxByPost($post_id)
    {
        return $this->where([
            'is_parent'=>0,
            'post_id'=>$post_id
        ])->get(1)->row();
    }

    public function create($post_id,$booking_data=[])
    {
        $post = get_post($post_id);

        $id =  $this->insert([
           'is_parent'=>0,
           'post_id'=>$post_id,
           'post_type'=>get_post_type($post_id),
           'from_user'=>get_current_user_id(),
           'to_user'=>$post->post_author,
            'created_at'=>time(),
            'modified_at'=>time(),
            'ip_address'=>STInput::ip_address(),
            'is_read'=>0,
            'booking_data'=>json_encode($booking_data)
        ]);

        return $id;
    }

    public static function inst()
    {
        if(!self::$_inst) self::$_inst=new self();
        return self::$_inst;
    }




}

ST_Inbox_Model::inst();