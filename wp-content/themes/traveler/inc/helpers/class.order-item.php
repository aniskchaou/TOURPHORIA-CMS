<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 30/07/2015
 * Time: 10:29 SA
 */
if(!class_exists('ST_Order_Item_Data'))
{
    /**
     * Class ST_Order_Item_Data
     *
     * @since 1.1.8
     */
    class ST_Order_Item_Data{

        static $table_name='st_order_item_meta';
        static $is_working=false;
        /**
         *
         * @var array
         */
        static $table_columns=array(
            'id'=>array(
                'type'=>'mediumint(9)',
                'AUTO_INCREMENT'=>true
            ),
            'order_item_id'=>array(
                'type'=>'INT'
            ),
            'type'=>array(
                'type'=>'varchar(255)'
            ),
            'check_in'=>array(
                'type'=>'varchar(255)'
            ),
            'check_out'=>array(
                'type'=>'varchar(255)'
            ),
            'st_booking_post_type'=>array(
                'type'=>'varchar(255)'
            ),
            'st_booking_id'=>array(
                'type'=>'INT'
            ),
            'duration' => array('type'=>'varchar(255)'),
            'adult_number' => array('type'=>'varchar(255)'),
            'child_number' => array('type'=>'varchar(255)'),
            'discount' => array('type'=>'varchar(255)'),
            'room_id' => array('type'=>'varchar(255)'),
            'room_num_search' => array('type'=>'varchar(255)'),
            'check_in_timestamp' => array('type'=>'varchar(255)'),
            'check_out_timestamp' => array('type'=>'varchar(255)'),
            'status'=>array('type'=>'varchar(255)'),
            'wc_order_id'=>array('type'=>"INT"),
            'user_id'   =>array('type'=>"INT"),
            'return_id'   =>array('type'=>"INT"),
            'raw_data' => array('type' => "text"),
            'log_mail' => array('type'=>'varchar(255)'),
        );



        /**
         * @since 1.1.8
         */
        static function _init()
        {
            self::$table_columns=apply_filters('st_order_meta_table_columns',self::$table_columns);

            add_action('after_setup_theme',array(__CLASS__,'_check_is_working'));
            add_action('st_traveler_do_upgrade_table',array(__CLASS__,'_upgrade_table'));

            add_action('st_save_order_item_meta',array(__CLASS__,'_save_data'),10,3);

            // Re update the Order Meta
            add_action('save_post', array(__CLASS__, '_reupdate_normal_booking'), 50);

            // Update Status
            add_action('st_booking_change_status',array(__CLASS__,'_st_booking_change_status'),10,3);

            add_action('woocommerce_order_status_changed',array(__CLASS__,'_woocommerce_order_status_changed'),10,3);

            if(STInput::get('_upgrade_table') and current_user_can('manage_options'))
            {
                self::_upgrade_table();
                die;
            }
        }

        static function _woocommerce_order_status_changed($order_id,$old_status,$new_status)
        {
            // Check if table order item meta was created
            if(!self::$is_working) return false;
            global $wpdb;
            $table_name=$wpdb->prefix.self::$table_name;
            $SQL="UPDATE $table_name SET `status`='$new_status' where wc_order_id=$order_id";
            $wpdb->query($SQL);

        }

        static function _st_booking_change_status($status,$order_id,$booking_type)
        {
            // Check if table order item meta was created
            if(!self::$is_working) return false;
            global $wpdb;
            $table_name=$wpdb->prefix.self::$table_name;
            $SQL="UPDATE $table_name SET `status`='$status' where order_item_id=$order_id and `type`='$booking_type' ";
            $wpdb->query($SQL);
        }

        /**
         * for normal booking
         * @param bool $post_id
         */
        static function _reupdate_normal_booking($post_id = FALSE)
        {
            if($post_id and get_post_type($post_id)=='st_order')
            {
                // Check if table order item meta was created
                if(!self::$is_working) return false;

                global $wpdb;
                $table_name=$wpdb->prefix.self::$table_name;
                $table_columns=self::$table_columns;

                $insert_value='';
                $insert_key='';
                $update_key='';
                if (is_array($table_columns) and !empty($table_columns)){
                    foreach($table_columns as $key=>$value)
                        {
                            if($key=='id' or $key=='order_item_id' or $key=='type') continue;
                            $s_char=',';
                            $meta=get_post_meta($post_id,$key,true);
                            if($meta or (!$meta and $value['type']=='INT'))
                            {
                                if(is_array($meta) or is_object($meta)) $meta=serialize($meta);
                                $insert_value.="'".$value['type']."'".$s_char;
                                $insert_key.=$key.$s_char;
                                $update_key=$key."='".$value['type']."'".$s_char;
                            }
                        }
                }
                
                $insert_value=substr($insert_value,0,-1);
                $insert_key=substr($insert_key,0,-1);                
                $update_key=substr($update_key,0,-1);

                // Check order item id exists
                $query_check="SELECT ID FROM $table_name WHERE type='normal_booking' and order_item_id={$post_id} LIMIT 0,1";
                $count=$wpdb->get_var($query_check);

                // Order Item ID is exists
                if($count)
                {
                    // Do the update
                    $query="UPDATE $table_name SET $update_key WHERE  order_item_id=$post_id AND `type`='normal_booking'";
                    $wpdb->query($query);
                }
            }
        }

        /**
         * Check table column is missing
         *
         * @since 1.1.8
         */
        static function _upgrade_table()
        {
            $table_columns=self::$table_columns;
            if(!empty($table_columns))
            {
                foreach($table_columns as $key=>$value)
                {
                    // Check is not AUTO_INCREMENT key
                    if(!isset($value['AUTO_INCREMENT']) or $value['AUTO_INCREMENT']==false)
                    {
                        // Check colum is missing
                        if(!self::_check_col_missing($key))
                        {
                            self::_add_table_column($key,$value['type']);
                        }
                    }
                }
            }
        }

        /**
         * @param array $data
         * @param bool $order_item_id
         * @param string $type
         * @return bool
         */
        static function _save_data($data=array(),$order_item_id=false,$type='normal_booking'){

            $data['order_item_id']=$order_item_id;
            $data['type']=$type;

            //add start and end timestamp
            if(!isset($data['check_in_timestamp']) and isset($data['check_in']))
            {
                $data['check_in_timestamp']=strtotime($data['check_in']);
            }
            if(!isset($data['check_out_timestamp']) and isset($data['check_out']))
            {
                $data['check_out_timestamp']=strtotime($data['check_out']);
            }

            // Check if table order item meta was created
            if(!self::$is_working) return false;

            global $wpdb;
            $table_name=$wpdb->prefix.self::$table_name;
            $table_columns=self::$table_columns;
            if(!empty($data))
            {
                $insert_value='';
                $insert_key='';
                foreach($data as $key=>$value)
                {
                    $s_char=',';
                    if(isset($table_columns[$key]))
                    {
                        //if($table_columns[$key]['type']=='INT')
                        if(is_array($value) or is_object($value)) $value=serialize($value);
                        $insert_value.="'".$value."'".$s_char;
                        $insert_key.=$key.$s_char;
                    }
                }
                $insert_value=substr($insert_value,0,-1);
                $insert_key=substr($insert_key,0,-1);

                // Check order item id exists
                $query_check="SELECT COUNT(ID) as total FROM $table_name WHERE type=%s and order_item_id=%d";
                $count=$wpdb->get_var($wpdb->prepare($query_check,array(
                    $type,
                    $order_item_id
                )));

                // Order Item ID is not exists
                if(!$count)
                {
                    $query="INSERT INTO $table_name ($insert_key) VALUES ($insert_value) ";
                    $wpdb->query($query);
                }
            }
        }

        /**
         * Return true if column is not missing
         *
         * @param bool $col_name
         * @return null|string
         */
        static function _check_col_missing($col_name=false)
        {
            global $wpdb;
            $query="SELECT COUNT(*) as total
                    FROM information_schema.COLUMNS
                    WHERE
                        TABLE_SCHEMA = %s
                    AND TABLE_NAME = %s
                    AND COLUMN_NAME =%s";

            $query=$wpdb->prepare($query,array(
                    $wpdb->dbname,
                    $wpdb->prefix .self::$table_name,
                    $col_name
            ));

            $count=$wpdb->get_var($query);
            return $count;
        }

        static function _add_table_column($col_name,$col_type)
        {
            global $wpdb;
            $table_name=$wpdb->prefix .self::$table_name;

            $query="ALTER TABLE $table_name ADD $col_name $col_type";


            $wpdb->query($query);
        }

        /**
         * @since 1.1.8
         */
        static function _check_is_working()
        {
            global $wpdb;

            $table_name = $wpdb->prefix .self::$table_name;
            if(!self::$is_working or $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                //table is not created. you may create the table here.
                global $wpdb;
                $charset_collate = $wpdb->get_charset_collate();

                // Column String
                $col_string='';
                if(!empty(self::$table_columns))
                {
                    $i=0;
                    foreach(self::$table_columns as $key=>$value)
                    {
                        $s_char=',';
                        if($i==count(self::$table_columns)-1){
                            $s_char='';
                        }
                        // Unique key
                        $unique_key='';

                        // Check is AUTO_INCREMENT col
                        if(isset($value['AUTO_INCREMENT']) and $value['AUTO_INCREMENT'])
                        {
                            $unique_key=$key;
                            $col_string.=' '.sprintf('%s %s NOT NULL AUTO_INCREMENT PRIMARY KEY',$key,$value['type']).$s_char;
                        }else{
                            $col_string.=' '.$key.' '.$value['type'].$s_char;
                        }

                       $i++;

                    }


                }

                $sql = "CREATE TABLE $table_name (
                        $col_string
                    ) $charset_collate;";

                $wpdb->query( $sql );

                if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                    self::$is_working=false;

                }else
                {
                    self::$is_working=true;
                }

            }else{
                self::$is_working=true;
            }
        }
    }
    ST_Order_Item_Data::_init();
}