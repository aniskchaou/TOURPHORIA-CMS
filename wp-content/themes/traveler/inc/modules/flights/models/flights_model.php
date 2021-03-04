<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/7/2017
 * Version: 1.0
 */


if(!class_exists('ST_Flights_Models')){
    class ST_Flights_Models{

        static $_inst;
        protected $_table_version = "1.0.4";
        protected $_table_name = '';

        function __construct()
        {
            $this->_table_name = 'st_flights';
            add_action( 'after_setup_theme', array($this, '_check_table_activity' ));
        }

        function _check_table_activity()
        {
            $dbhelper = new DatabaseHelper( $this->_table_version );
            $dbhelper->setTableName( $this->_table_name );
            $column = array(
                'id'           => array(
                    'type'           => 'bigint',
                    'length'         => 9,
                    'AUTO_INCREMENT' => TRUE
                ),
                'post_id' => array(
                    'type' => 'INT',
                    'length' => 11
                ),
                'iata_from' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'location_from' => array(
                    'type' => 'INT',
                    'length' => 11
                ),
                'iata_to' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'location_to' => array(
                    'type' => 'INT',
                    'length' => 11
                ),
                'flight_type' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'max_ticket' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'departure_time' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'airline' => array(
                    'type' => 'INT',
                    'length' => 11
                ),
            );

            $column = apply_filters( 'st_change_column_st_flights', $column );

            $dbhelper->setDefaultColums( $column );
            $dbhelper->check_meta_table_is_working( 'st_flights_table_version' );

            return array_keys( $column );
        }

        function insert_data($data){
            global $wpdb;

            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->insert($table, $data);
        }

        function update_data($data, $where){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->update($table, $data, $where);
        }

        function get_data($post_id){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $sql = "SELECT * FROM {$table} WHERE post_id=%s";

            $res = $wpdb->get_row($wpdb->prepare($sql, $post_id));

            if(!empty($res) && count($res) > 0){
                return $res;
            }
            return false;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Flights_Models::inst();
}