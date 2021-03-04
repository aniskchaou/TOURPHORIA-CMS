<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/04/2018
 * Time: 13:53 CH
 */
class ST_Hotel_Room_Availability extends ST_Model
{
    protected $table_version='1.1';
    protected $table_name='st_room_availability';

    protected static $_inst;

    public function __construct()
    {
        $this->columns=[
            'id'           => [
                'type'           => 'bigint',
                'length'         => 9,
                'AUTO_INCREMENT' => TRUE
            ],
            'post_id'      => [
                'type' => 'INT',
                'UNIQUE'=>true
            ],
            'check_in'     => [
                'type'   => 'INT',
                'length' => 11,
                'UNIQUE'=>true
            ],
            'check_out'    => [
                'type'   => 'INT',
                'length' => 11
            ],
            'number'       => [
                'type'   => 'varchar',
                'length' => 255
            ],
            'post_type'       => [
	            'type'   => 'varchar',
	            'length' => 255
            ],
            'price'        => [
                'type'   => 'varchar',
                'length' => 255
            ],
            'status'       => [
                'type'   => 'varchar',
                'length' => 255
            ],
            'priority'     => [
                'type' => 'INT'
            ],
            'number_booked' => [
                'type' => 'INT',
                'length' => 11,
                'default' => 0
            ],
            'parent_id' => [
                'type' => 'bigint',
                'length' => 9
            ],
            'allow_full_day' => [
                'type' => 'varchar',
                'length' => 10
            ],
            'number_end' => [
                'type' => 'INT',
                'length' => 11
            ],
            'booking_period' => [
                'type' => 'INT',
                'length' => 11
            ],
            'is_base' => [
                'type' => 'INT',
                'length' => 2
            ],
            'adult_number'=>[
                'type' => 'INT',
                'length' => 11
            ],
            'child_number'=>[
                'type' => 'INT',
                'length' => 11
            ],
        ];
        parent::__construct();
    }

    public function add($data)
    {

    }

    public function insertOrUpdate($data)
    {
        $data=wp_parse_args($data,array(
           'post_id'=>'',
           'check_in'=>'',
           'check_out' => '',
           'price'     => '',
           'status'    => '',
            'is_base'=>0
        ));
        $where=[
            'post_id'=>$data['post_id'],
            'check_in'=>$data['check_in'],
        ];
        $check=$this->where($where)->get(1)->row();
        if($check)
        {
            unset($data['post_id']);
            unset($data['check_in']);
            return $this->where($where)->update($data);
        }else{
            $data['adult_number']=get_post_meta($data['post_id'],'adult_number',true);
            $data['child_number']=get_post_meta($data['post_id'],'child_number',true);
            $data['allow_full_day']=get_post_meta($data['post_id'],'allow_full_day',true);
            $data['number']=get_post_meta($data['post_id'],'number_room',true);

            return $this->insert($data);
        }
    }
    public static function inst()
    {
        if(!self::$_inst) self::$_inst=new self();
        return self::$_inst;
    }
}

ST_Hotel_Room_Availability::inst();