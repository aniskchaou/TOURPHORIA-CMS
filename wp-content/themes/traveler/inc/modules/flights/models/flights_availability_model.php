<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/7/2017
 * Version: 1.0
 */


if(!class_exists('ST_Flight_Availability_Models')){
    class ST_Flight_Availability_Models extends ST_Model {

	    protected $table_name='st_flight_availability';
	    protected $table_version='1.1.7';
	    protected static $_inst;

        function __construct()
        {
	        $this->columns = array(
		        'id'           => array(
			        'type'           => 'bigint',
			        'length'         => 9,
			        'AUTO_INCREMENT' => TRUE
		        ),
		        'post_id' => array(
			        'type' => 'INT',
			        'length' => 11
		        ),
		        'start_date' => array(
			        'type' => 'varchar',
			        'length' => 255
		        ),
		        'end_date' => array(
			        'type' => 'varchar',
			        'length' => 255
		        ),
		        'eco_price' => array(
			        'type' => 'varchar',
			        'length' => 255
		        ),
		        'business_price' => array(
			        'type' => 'varchar',
			        'length' => 255
		        ),
		        'status' => array(
			        'type' => 'varchar',
			        'length' => 255
		        )
	        );
	        parent::__construct();
        }

        function get_price_data($post_id, $start){
            global $wpdb;

            $table = $wpdb->prefix.$this->table_name;

            $sql = "SELECT * FROM {$table} WHERE post_id=%d AND `start_date`=%s";

            $res = $wpdb->get_row($wpdb->prepare($sql,$post_id, $start), ARRAY_A);

            return $res;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Flight_Availability_Models::inst();
}