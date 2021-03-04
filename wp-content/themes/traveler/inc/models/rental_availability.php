<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/04/2018
 * Time: 13:53 CH
 */
class ST_Rental_Availability extends ST_Model
{
    protected $table_version='1.2.4';
    protected $table_name='st_rental_availability';

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
            'status'       => [
	            'type'   => 'varchar',
	            'length' => 255
            ],
            'price'        => [
                'type'   => 'varchar',
                'length' => 255
            ],
            'post_type'       => [
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
            'groupday'     => [
                'type' => 'INT'
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
            unset($data['post_type']);

            return $this->where($where)->update($data);
        }else{
            $data['adult_number']=get_post_meta($data['post_id'],'rental_max_adult',true);
            $data['child_number']=get_post_meta($data['post_id'],'rental_max_children',true);
            $data['allow_full_day']=get_post_meta($data['post_id'],'allow_full_day',true);
            $data['number']=get_post_meta($data['post_id'],'rental_number',true);

            return $this->insert($data);
        }
    }

	public function checkInDelete($post_id, $check_in){
		$where=[
			'post_id'=>$post_id,
			'check_in'=>$check_in,
		];
		$this->where($where)->delete();
	}

	public function checkBeforeUpdate($post_id, $check_in){
		$data=$this->where('check_in <', $check_in)->where('check_out >=', $check_in)->where('groupday', 1)->get(1)->row();
		if(!empty($data)){
			$new_check_out = strtotime('-1 day', $check_in);
			$where=[
				'post_id'=>$post_id,
				'check_in'=>$data['check_in'],
			];

			$data_update = [
				'check_out' => $new_check_out,
				'groupday' => 1
			];

			if($new_check_out - $data['check_in'] == 0)
				$data_update['groupday'] = 0;

			$this->where($where)->update($data_update);
		}
	}

	public function checkRemoveDuplicateBeforeUpdate($post_id, $check_in, $check_out){
		if($check_in  - $check_out == 0){
			$data=$this->where('check_in >=', $check_in)
			           ->where('check_out <=', $check_out)
			           ->where('post_id', $post_id)
			           ->orderby('id', 'desc')
			           ->get()->result();
			if(!empty($data)){
				if(count($data) > 1){
					for($i = 1; $i < count($data); $i++){
						$this->where('id', $data[$i]['id'])
						     ->delete();
					}
				}
			}
		}else{

			for($j = $check_in; $j <= $check_out; $j = strtotime('+1day', $j)){
				$data=$this->where('check_in >=', $j)
				           ->where('check_out <=', $j)
				           ->where('post_id', $post_id)
				           ->orderby('id', 'desc')
				           ->get()->result();

				if(!empty($data)){
					if(count($data) > 1){
						for($i = 1; $i < count($data); $i++){
							$this->where('id', $data[$i]['id'])
							     ->delete();
						}
					}
				}

			}
		}
	}

    public static function inst()
    {
        if(!self::$_inst) self::$_inst=new self();
        return self::$_inst;
    }
}

ST_Rental_Availability::inst();