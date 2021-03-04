<?php
    /**
     * @since 1.1.9
     **/
    if ( !class_exists( 'DatabaseHelper' ) ) {
        class DatabaseHelper
        {
            static $instance            = NULL;
            public $curent_key;
            public $_message;
            public $_table_name         = '';
            public $_meta_table_working = FALSE;
            public $_columns            = [];
            public $_table_version_id   = '';

            public function __construct( $version = '' )
            {
                $this->_table_version_id = $version;
            }

            public function setTableName( $table_name = '' )
            {
                global $wpdb;

                $this->_table_name = $wpdb->prefix . $table_name;
            }

            public function setDefaultColums( $columns = [] )
            {
                $this->_columns = $columns;
            }

            public function check_ver_working( $option_version = "" )
            {
                $db_version = get_option( $option_version );
                if ( !$db_version ) $db_version = '0.0.0';
                if ( $db_version ) {
                    if ( version_compare( $db_version, $this->_table_version_id, '=' ) ) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            public function check_meta_table_is_working( $option_version = '' )
            {
                global $wpdb;
                if ( is_admin()  and !$this->_meta_table_working) {
                    $table_name    = $this->_table_name;
                    $table_columns = $this->_get_columns();
                    $unique_key=[];

                    foreach($table_columns as $key=>$val)
                    {
                        if(!empty($val['UNIQUE'])) $unique_key[$key]=$val;
                    }
                    $db_version = get_option($option_version . '_version');
                    if (!$db_version) $db_version = 0;


                    if(!$db_version) {
                        $table_show = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");

                        if ($table_show != $table_name) {
                            //table is not created. you may create the table here.
                            global $wpdb;
                            $charset_collate = $wpdb->get_charset_collate();

                            // Column String
                            $col_string = '';
                            if (!empty($table_columns)) {
                                $i = 0;
                                foreach ($table_columns as $key => $value) {
                                    $s_char = ',';
                                    if ($i == count($table_columns) - 1) {
                                        $s_char = '';
                                    }

                                    $default_value = '';
                                    if (isset($value['default'])) {
                                        $default_value = ' DEFAULT ' . $value['default'];
                                    }

                                    // Check is AUTO_INCREMENT col
                                    if (isset($value['AUTO_INCREMENT']) and $value['AUTO_INCREMENT']) {
                                        $col_string .= ' ' . sprintf('%s %s NOT NULL AUTO_INCREMENT PRIMARY KEY', $key, $value['type']) . $default_value . $s_char;
                                    } else {
                                        $prefix = '';
                                        //Add length for varchar data type
                                        switch (strtolower($value['type'])) {
                                            case "varchar":
                                                if (isset($value['length']) and $value['length']) {
                                                    $prefix = '(' . $value['length'] . ')';
                                                }
                                                break;
                                            case 'float':
                                                if (isset($value['length']) and $value['length']) {
                                                    $prefix = '(' . $value['length'] . ')';
                                                }
                                                break;
                                        }
                                        $col_string .= ' ' . $key . ' ' . $value['type'] . $prefix . $default_value . $s_char;
                                    }

                                    $i++;

                                }


                            }

                            if (!empty($unique_key)) {
                                $keys = array_keys($unique_key);
                                $col_string .= ",\r\n UNIQUE INDEX `ST_AVAILABILITY` (" . implode(',', $keys) . ") ";
                            }


                            $sql = "CREATE TABLE $table_name (
                        $col_string
                    ) $charset_collate;";
                            $wpdb->query($sql);


                            update_option($option_version, $this->_table_version_id);

                            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                                $this->_meta_table_working = FALSE;

                            } else {
                                $this->_meta_table_working = TRUE;

                            }

                        } else {
                            $this->_meta_table_working = TRUE;
                        }
                    }
                } else {
                    $this->_meta_table_working = TRUE;
                }
                if ( $this->_meta_table_working ) {
                    // check upgrade data
                    $db_version = get_option( $option_version );
                    if ( !$db_version ) $db_version = '0.0.0';
                    if ( $db_version ) {
                        if ( version_compare( $db_version, $this->_table_version_id, '<' ) ) {

                            $this->_upgrade_table();
                            update_option( $option_version, $this->_table_version_id );
                        }
                    }

                }
            }

            public function _upgrade_table()
            {
                global $wpdb;
                $table_name    = $this->_table_name;
                $table_columns = $this->_get_columns();
                $insert_key    = $table_columns;
                $update_key    = [];
                $unique_key=[];
                $remove_unique=[];

                foreach($table_columns as $key=>$val)
                {
                    if(!empty($val['UNIQUE'])) $unique_key[$key]=$val;
                }

                $query      = "SELECT *
                    FROM information_schema.COLUMNS
                    WHERE
                        TABLE_SCHEMA = %s
                    AND TABLE_NAME = %s";
                $old_coumns = $wpdb->get_results(
                    $wpdb->prepare( $query, [
                        $wpdb->dbname,
                        $table_name
                    ] )
                );
                if ( $old_coumns and !empty( $old_coumns ) ) {
                    foreach ( $old_coumns as $key => $value ) {
                        unset( $insert_key[ $value->COLUMN_NAME ] );

                        if ( isset( $table_columns[ $value->COLUMN_NAME ] ) ) {
                            if ( strtolower( $table_columns[ $value->COLUMN_NAME ][ 'type' ] ) != strtolower( $value->DATA_TYPE ) ) {
                                $update_key[ $value->COLUMN_NAME ] = $table_columns[ $value->COLUMN_NAME ];
                            }

                            if($value->COLUMN_TYPE=='UNI' ){
                                if(!array_key_exists($value->COLUMN_NAME,$unique_key))
                                {
                                    $remove_unique[]=$value->COLUMN_NAME;
                                }else{
                                    unset($unique_key[$value->COLUMN_NAME]);
                                }

                            }
                        }


                    }
                }

                // Do create new columns
                if ( !empty( $insert_key ) ) {
                    $insert_col_string = '';
                    foreach ( $insert_key as $key => $value ) {
                        $prefix = '';
                        //Add length for varchar data type
                        switch ( strtolower( $value[ 'type' ] ) ) {
                            case "varchar":
                                if ( isset( $value[ 'length' ] ) and $value[ 'length' ] ) {
                                    $prefix = '(' . $value[ 'length' ] . ')';
                                }
                                break;
                        }

                        $default_value = '';
                        if(isset($value['default'])){
                        	$default_value = ' DEFAULT ' . $value['default'];
                        }

                        $col_type = $value[ 'type' ];
                        $insert_col_string .= " ADD $key $col_type $default_value " . $prefix . ',';
                    }
                    $insert_col_string = substr( $insert_col_string, 0, -1 );
                    // do update query
                    $query = "ALTER TABLE $table_name " . $insert_col_string;
                    $wpdb->query( $query );
                }

                // Do update columns (change columns data type)
                if ( !empty( $update_key ) ) {
                    $update_col_string = '';
                    foreach ( $update_key as $key => $value ) {
                        $prefix = '';
                        //Add length for varchar data type
                        switch ( strtolower( $value[ 'type' ] ) ) {
                            case "varchar":
                                if ( isset( $value[ 'length' ] ) and $value[ 'length' ] ) {
                                    $prefix = '(' . $value[ 'length' ] . ')';
                                }
                                break;
                        }

	                    $default_value = '';
	                    if(isset($value['default'])){
		                    $default_value = ' DEFAULT ' . $value['default'];
	                    }

                        $col_type = $value[ 'type' ];
                        $update_col_string .= " MODIFY $key $col_type $default_value" . $prefix . ',';
                    }
                    $update_col_string = substr( $update_col_string, 0, -1 );
                    // do update query
                    $query = "ALTER TABLE $table_name " . $update_col_string;
                    $wpdb->query( $query );
                }

                // Do update unique
//                if(!empty($remove_unique))
//                {
//                    $delete=[];
//                    foreach ($remove_unique as $k)
//                    {
//                        $delete="ALTER TABLE {$table_name} DROP"
//                    }
//                }


                if(!empty($unique_key))
                {
                    $checkIndex=$wpdb->get_results("SHOW INDEX FROM ".$table_name);
//                    if($table_name=='wp_st_availability')
//                    {
//                        var_dump($checkIndex);
//                        die;
//                    }
                    $flag=true;
                    if(!empty($checkIndex))
                    {
                        foreach($checkIndex as $index)
                        {
                            if($index->Key_name=='ST_AVAILABILITY'){ $flag=false;}
                        }
                    }
                    if($flag) {
                        $keys = array_keys($unique_key);
                        $sql = "ALTER TABLE {$table_name} ADD UNIQUE INDEX `ST_AVAILABILITY` (" . implode(',', $keys) . ")";
                        $wpdb->query($sql);
                    }
                }
            }

            public function _get_columns()
            {
                return $this->_columns;
            }
        }
    }