<?php
if(!class_exists('ST_Form_Builder_Models')){
    class ST_Form_Builder_Models{

        static $_inst;
        protected $_table_version = "1.0.1";
        protected $_table_name = '';

        function __construct()
        {
            $this->_table_name = 'st_form_builder';
            add_action( 'after_setup_theme', array($this, '_check_table_form_builder' ));
        }

        function _check_table_form_builder()
        {
            $dbhelper = new DatabaseHelper( $this->_table_version );
            $dbhelper->setTableName( $this->_table_name );
            $column = array(
                'id'           => array(
                    'type'           => 'bigint',
                    'length'         => 9,
                    'AUTO_INCREMENT' => TRUE
                ),
                'name' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'meta' => array(
                	'type' => 'text'
            	),
                'data_type' => array(
                    'type' => 'text'
                ),
            	'status' => array(
            		'type' => 'varchar',
            		'length' => 255
        		)

            );

            $column = apply_filters( 'st_change_column_st_form_builder', $column );

            $dbhelper->setDefaultColums( $column );
            $dbhelper->check_meta_table_is_working( 'st_form_builder_table_version' );

            return array_keys( $column );
        }

        function insert_data($data){
            global $wpdb;

            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->insert($table, $data);

            return $wpdb->insert_id;
        }

        function create_form($name){
            global $wpdb;

            $table = $wpdb->prefix.$this->_table_name;
            $data = array(
                'name' => $name,
                'meta' => '',
                'status' => 'publish',
                'data_type' => ''
                );

            $wpdb->insert($table, $data);
            return $wpdb->insert_id;
        }

        function update_data($data, $where){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->update($table, $data, $where);
        }

        function get_data($id){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $sql = "SELECT * FROM {$table} WHERE id=%s";

            $res = $wpdb->get_row($wpdb->prepare($sql, $id), ARRAY_A);

            if(!empty($res) && count($res) > 0){
                return $res;
            }
            return false;
        }

        function delete_form($form_id){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->delete($table, array(
                'id' => $form_id
                ));
        }

        function get_all_form(){
        	global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $sql = "SELECT id, name FROM {$table} WHERE `status`='publish'";

            $res = $wpdb->get_results($sql, ARRAY_A);

            if(!empty($res) && count($res) > 0){
                return $res;
            }
            return false;
        }

        function get_form_meta($id){
        	global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $sql = "SELECT meta FROM {$table} WHERE `status`='publish' AND id=%s";

            $res = $wpdb->get_row($wpdb->prepare($sql, $id), ARRAY_A);

            if(!empty($res['meta']) && count($res) > 0){
                return $res['meta'];
            }
            return false;
        }

        function get_first_form_id(){
            global $wpdb;
            $table = $wpdb->prefix.$this->_table_name;

            $sql = "SELECT id FROM {$table} WHERE `status`='publish' ORDER BY id ASC LIMIT 1";

            $res = $wpdb->get_row($sql, ARRAY_A);

            if(!empty($res) && count($res) > 0){
                return $res['id'];
            }
            return false;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Form_Builder_Models::inst();
}

?>