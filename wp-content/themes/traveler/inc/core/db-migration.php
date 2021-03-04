<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 6/27/2018
 * Time: 11:28 PM
 */
include_once 'async-updater.php';

if(!class_exists('ST_DBMigration'))
{
    class ST_DBMigration{

        protected static $key='traveler_db_version';

        /**
         * @var ST_AsyncUpdater
         */
        protected static $asyncUpdater;


        protected static $mirations=[
            '2.1.0'=>[
                [__CLASS__,'migration_210_version'],
                [__CLASS__,'migration_210_version'],

            ],
            '2.1.2'=>[
//                [__CLASS__,'migration_212_inbox_table'],
                //[__CLASS__,'migration_212_notifications_table'],
                //[__CLASS__,'migration_212_update_location_meta_table'],
                [__CLASS__,'migration_212_version'],
            ],
        ];
        public static function inst()
        {
            add_action('init',[__CLASS__,'__initUpdater']);

        }

        public static function __initUpdater()
        {
            self::$asyncUpdater=new ST_AsyncUpdater();
            self::checkUpdateDB();
        }

        protected static function checkUpdateDB(){

            $db_version=get_option(self::$key);

            if(!$db_version or version_compare($db_version,max(array_keys(self::$mirations)),'<'))
            {
                self::doUpdateDB();
            }

        }

        protected static function doUpdateDB(){
            $needUpdate=false;

            $db_version=get_option(self::$key);

            if(!empty(self::$mirations)){
                foreach (self::$mirations as $version=>$mirations)
                {
                    if(version_compare($db_version,$version,'>=')) continue;

                    foreach ($mirations as $callback){
                        $needUpdate=true;

                        self::$asyncUpdater->push_to_queue( $callback );
                    }

                }
            }

            if ( $needUpdate ) {
                self::$asyncUpdater->save()->dispatch();
            }

        }

        public static function updateDBVersion(){

            update_option(self::$key,ST_TRAVELER_VERSION);

        }

        public static function addOrUpdateColumns($table_name,$table_columns=[])
        {

            global $wpdb;

            $table_name = $wpdb->prefix.$table_name;

            $query = "SELECT *
                    FROM information_schema.COLUMNS
                    WHERE
                        TABLE_SCHEMA = %s
                    AND TABLE_NAME = %s";
            $old_coumns = $wpdb->get_results(
                $wpdb->prepare($query, array(
                    $wpdb->dbname,
                    $table_name

                ))
            );

            $insert_key = $table_columns;
            $update_key = [];

            if ($old_coumns and !empty($old_coumns)) {
                foreach ($old_coumns as $key => $value) {
                    unset($insert_key[$value->COLUMN_NAME]);

                    // for columns need update
                    if (isset($table_columns[$value->COLUMN_NAME])) {
                        if (strtolower($table_columns[$value->COLUMN_NAME]['type']) != strtolower($value->COLUMN_TYPE)) {
                            $update_key[$value->COLUMN_NAME] = $table_columns[$value->COLUMN_NAME];
                        }
                    }

                }
            }

            if(empty($insert_key) and empty($update_key)) return true;

            $sql="ALTER TABLE ".$wpdb->prefix.$table_name;

            // Start Insert Columns
            if(!empty($insert_key))
            {
                foreach ($insert_key as $k=>$data)
                {
                    $sql.="\r\n ADD COLUMN $k ".$data['type'].' NULL,';
                }

                //Remove last comma
                $sql=substr($sql,0,-1);
            }

            // Start Update Columns
            if(!empty($update_key))
            {
                foreach ($update_key as $k=>$data)
                {
                    $sql.="\r\n MODIFY COLUMN $k ".$data['type'].' NULL,';
                }

                //Remove last comma
                $sql=substr($sql,0,-1);
            }

            return $wpdb->query($sql);


        }


        public static function addTable($table_name,$table_columns=[]){


            global $wpdb;
            $table_name = $wpdb->prefix.$table_name;

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

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
                        // Unique key
                        $unique_key = '';

                        // Check is AUTO_INCREMENT col
                        if (isset($value['AUTO_INCREMENT']) and $value['AUTO_INCREMENT']) {
                            $unique_key = $key;
                            $col_string .= ' ' . sprintf('%s %s NOT NULL AUTO_INCREMENT PRIMARY KEY', $key, $value['type']) . $s_char;
                        } else {
                            $prefix = '';
                            //Add length for varchar data type
                            switch (strtolower($value['type'])) {
                                case "varchar":
                                    if (isset($value['length']) and $value['length']) {
                                        $prefix = '(' . $value['length'] . ')';
                                    }
                                    break;
                            }
                            $col_string .= ' ' . $key . ' ' . $value['type']  . $prefix . $s_char;
                        }

                        $i++;

                    }


                }

                $sql = "CREATE TABLE $table_name (
                        $col_string
                    ) $charset_collate;";

                $wpdb->query($sql);
            }
        }



        /**
         * Start Migrations
         *
         */


        /**
         * @todo [2.1.2] Alter Table st_inbox
         */
        public static function migration_212_inbox_table()
        {
            self::addOrUpdateColumns('st_inbox',[
               'booking_data'=>['type'=>'text'],
               'created_at'=>'int(11)',
               'modified_at'=>'int(11)',
               'is_parent'=>'int(11)',
               'from_user'=>'int(11)',
               'to_user'=>'int(11)',
               'is_read'=>'smallint(1)',
               'post_type'=>'varchar(50)',
            ]);
        }
        /**
         * @todo [2.1.2] Add table st_messages for new message system
         */

        public static function migration_212_message_table_1()
        {
           self::addTable('st_message',[
               'id'=>[
                   'AUTO_INCREAMENT'=>true,
                   'type'=>'int(11)'
               ],
               'order_id'=>['type'=>'int(11)'],
               'order_type'=>['type'=>'varchar(50)'],
               'post_type'=>['type'=>'varchar(50)'],
               'post_id'=>['type'=>'int(11)'],
               'create_at'=>['type'=>'datetime'],
               'author_id'=>['type'=>'int(11)'],
               'customer_id'=>['type'=>'int(11)'],
               'status'=>['type'=>'varchar(50)'],
               'booking_data'=>['type'=>'text'],
               'confirm_status'=>['type'=>'varchar(50)']
           ]);
        }

        /**
         * @todo [2.1.2] Add table st_notifications for new message system
         */
        public static function migration_212_notifications_table()
        {
            self::addTable('st_notifications',[
                'id'=>[
                    'AUTO_INCREAMENT'=>true,
                    'type'=>'int(11)'
                ],
                'message_id'=>['type'=>'int(11)'],
                'user_send_id'=>['type'=>'int(11)'],
                'user_receiving_id'=>['type'=>'int(11)'],
                'create_at'=>['type'=>'datetime'],
                'message'=>['type'=>'text'],
                'message_origin'=>['type'=>'text'],
                'read_message'=>['type'=>'int(1)'],
                'type'=>['type'=>'varchar(50)'],
            ]);
        }

        /**
         * @todo Cấu hình Async Task theo từng post type để update các giá trị meta của mỗi location
         *
         * @since 2.1.2
         * @author dannie
         *
         */
        public function migration_212_update_location_meta_table()
        {
            $post_types = ['st_hotel','st_cars','st_tours','st_rental','st_activity'];

            foreach ($post_types as $post_type)
            {
                self::migration_212_update_location_meta_by_post_type($post_type);
            }

        }

        /**
         * @todo Tính toán lại các meta của location theo từng post type, bao gồm min_price, min_price_post_id, offer_count, comment_count
         *
         * Lấy 5 location có id nhỏ hơn max_id, nếu chưa có thì lấy 5 location order theo id desc
         *
         * Kết thúc thì add 1 task mới theo max id, nếu ko còn location nữa thì ko tạo task
         *
         * @param string $post_type
         * @param string $max_id
         */
        public function migration_212_update_location_meta_by_post_type($post_type = '',$max_id = '')
        {
            // @todo Lấy 5 location theo max_id
            global $wpdb;
            $where = '';
            if($max_id)
            {
                $where.=$wpdb->prepare(' AND ID < %d ',$max_id);
            }

            $sql = "SELECT * FROM {$wpdb->posts} where post_type = 'location' ".$where." order by ID desc";

            $rows = $wpdb->get_results($sql);

            if(!empty($rows))
            {

                include_once "async-tasks/location.php";
                foreach ($rows as $row)
                {
                    st_212_location_update_meta_by_post_type($post_type,$row['ID']);
                }

                $last_id = $rows[count($rows)-1]->ID;
                self::$asyncUpdater->push_to_queue([__CLASS__,'migration_212_update_location_meta_by_post_type',$post_type,$last_id]);
                self::$asyncUpdater->save()->dispatch();
            }

        }


        public static function migration_212_version()
        {
            update_option(self::$key,'2.1.2');
        }





    }
}
