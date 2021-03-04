<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 4/19/2018
 * Time: 3:44 PM
 */
class ST_Tour_Availability extends ST_Model {
	protected $table_name='st_tour_availability';
	protected $table_version='1.1.9';
	protected static $_inst;

	public function __construct()
	{
		$this->columns=array(
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
			'starttime' => [
				'type' => 'varchar',
				'length' => 255
			],
			'count_starttime' => [
				'type' => 'INT',
				'length' => 11,
				'default' => 1
			],
			'number'       => [
				'type'   => 'INT',
				'length' => 11,
				'default' => 0
			],
			'price'        => [
				'type'   => 'varchar',
				'length' => 255
			],
			'adult_price'  => [
				'type'   => 'varchar',
				'length' => 255
			],
			'child_price'  => [
				'type'   => 'varchar',
				'length' => 255
			],
			'infant_price' => [
				'type'   => 'varchar',
				'length' => 255
			],
			'status'       => [
				'type'   => 'varchar',
				'length' => 255
			],
			'groupday'     => [
				'type' => 'INT'
			],
			'number_booked' => [
				'type' => 'INT',
				'length' => 11,
				'default' => 0
			],
			'booking_period' => [
				'type' => 'INT',
				'length' => 9,
				'default' => 0
			],
			'is_base' => [
				'type' => 'INT',
				'length' => 2,
				'default' => 1
			]
		);
		parent::__construct();
	}

	/**
	 * @param $id
	 * @param $post_type
	 *
	 * @return array()
	 */
	public function get_prices_by_id($id){
		$this->select(array('price', 'adult_price', 'child_price', 'infant_price'));
		$this->where(array('post_id' => $id, 'is_base' => 1));
		$this->limit(1,0);
		$this->get();
		$res = $this->result();
		return $res;
	}

	public function insertOrUpdate($data)
	{
		$data=wp_parse_args($data,array(
			'post_id'      => '',
			'check_in'     => '',
			'check_out'    => '',
			'price'  => 0,
			'adult_price'  => 0,
			'child_price'  => 0,
			'infant_price' => 0,
			'status'       => '',
			'groupday'     => 0,
			'is_base' => 0,
			'number' => 0,
			'booking_period' => 0,
			'count_starttime' => 1
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
			return $this->insert($data);
		}
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

	public function checkInDelete($post_id, $check_in){
		$where=[
			'post_id'=>$post_id,
			'check_in'=>$check_in,
		];
		$this->where($where)->delete();
	}

	public static function inst()
	{
		if(!self::$_inst) self::$_inst=new self();
		return self::$_inst;
	}
}
ST_Tour_Availability::inst();