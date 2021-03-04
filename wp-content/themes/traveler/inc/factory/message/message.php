<?php
/**
 * Created by PhpStorm.
 * User: Dannie
 * Date: 8/23/2018
 * Time: 2:07 PM
 */
class ST_Message
{
    protected $message;
    protected $id;

    public function __construct($message)
    {
        if (is_array($message)) {
            $this->id = $message['id'];
            $this->message = $message;
        } else {
            $this->id = $message;
            $this->message = ST_Message_Model::inst()->find($message);
        }
    }


    /**
     * @todo Get Service Object of current Post
     *
     *
     * @return bool|ST_Base_Service|ST_Hotel_Service
     */
    public function getService()
    {
        if ($id = $this->getServiceID())
        {
            return ST_Service_Factory::get($id);
        }
        return false;

    }

    /**
     * @todo Get Current Service ID of Message
     *
     * @return bool|int
     */
    public function getServiceID()
    {
        return empty($this->message['post_id'])?$this->message['post_id']:false;
    }


    public function getDetailUrl()
    {
        return add_query_arg([
            'sc'=>'my-hotel',
            'message_id'=>$this->id,
        ]);
    }

    public function getMetaInfo()
    {
        $res=[];
        return $res;
    }
}