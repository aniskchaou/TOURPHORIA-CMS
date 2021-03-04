<?php
if (!class_exists('ST_Inbox_Admin')) {
    class ST_Inbox_Admin extends STAdmin
    {
        static $_inst = FALSE;
        protected $_table_version = "1.5.2";
        protected $_table_name = '';
        function __construct()
        {
            $this->_table_name = 'st_inbox';

            /**
             *   since 1.4.8
             *   auto create & update table st_inbox
             **/
            add_action( 'after_setup_theme', [ $this, '_check_table_inbox' ] );
            parent::__construct();
        }
        function check_ver_working()
        {
            $dbhelper = new DatabaseHelper( $this->_table_version );
            return $dbhelper->check_ver_working( $this->_table_name.'_table_version' );
        }
        function _check_table_inbox()
        {
            $dbhelper = new DatabaseHelper( $this->_table_version );
            $dbhelper->setTableName( $this->_table_name);
            $column = [
                'id'           => array(
                    'type'           => 'bigint',
                    'length'         => 9,
                    'AUTO_INCREMENT' => TRUE
                ),
                'is_parent' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'from_user' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'to_user' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'post_id' => array(
                    'type' => 'INT',
                    'length' => 11
                ),
                'created_at' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'modified_at' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'title' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'content' => array(
                    'type' => 'text',
                ),
                'ip_address' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
                'is_read' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
				'post_type' => array(
                    'type' => 'varchar',
                    'length' => 255
                ),
				'booking_data' => array(
                    'type' => 'longtext'
                ),
            ];
            $column = apply_filters( 'st_change_column_st_inbox', $column );
            $dbhelper->setDefaultColums( $column );
            $dbhelper->check_meta_table_is_working( 'st_inbox_table_version' );
            return array_keys( $column );
        }

        function insert_data($data){
            global $wpdb;

            $table = $wpdb->prefix.$this->_table_name;

            $wpdb->insert($table, $data);

            return  $wpdb->insert_id;
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


        function send_message($to_user, $title, $content, $post_id = FALSE, $is_parent = 0){
            global $wpdb;

            if (is_user_logged_in()) {
                $insert = array(
                    'from_user'  => get_current_user_id(),
                    'to_user'    => $to_user,
                    'title'      => $title,
                    'content'    => wp_kses_post($content),
                    'created_at' => time(),
                    'modified_at' => time(),
                    'ip_address' => STInput::ip_address(),
                    'post_id'    => $post_id,
                    'is_read'    => 0,
                    'is_parent'=> $is_parent
                );

                if(!empty($is_parent)){
                    $this->_update_modified_message_parent($is_parent,time());
                }
                return $this->insert_data($insert);
            }

            return FALSE;
        }

        function _update_modified_message_parent($is_parent_id,$time){
            global $wpdb;
            $sql = "
                UPDATE {$wpdb->prefix}st_inbox
                    SET modified_at = {$time}
                WHERE id = {$is_parent_id}";
            $wpdb->query($sql);
        }

        function get_list_messages($user_id, $paged, $limit, $search){
            $offset = ($paged*$limit);
            $search_sql = "";
            if(!empty($search))
                $search_sql = " AND (title LIKE '%{$search}%' OR content LIKE '%{$search}%')";
            global $wpdb;
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM 
                    {$wpdb->prefix}st_inbox
                    WHERE 1=1 
                    AND is_parent = 0
                    AND ( from_user = {$user_id} OR to_user = {$user_id} )
                    {$search_sql}
                    ORDER BY modified_at DESC 
                    LIMIT {$offset},{$limit}";

            $res = $wpdb->get_results($sql,ARRAY_A);
            $total_item=$wpdb->get_var('SELECT FOUND_ROWS()');
            return array('res'=>$res , 'total' => $total_item );
        }

        function get_user_by($key, $val, $need = 'all'){
            if(!empty($key) && !empty($val)){
                $user_Obj = get_user_by($key, $val);
                if(!empty($user_Obj)){
                    if($need == 'all'){
                        return $user_Obj;
                    }else{
                        if(!empty($user_Obj->data->$need)){
                            return $user_Obj->data->$need;
                        }
                    }
                }else{
                    return false;
                }
            }
            return false;
        }
        function get_new_message_count($message_id){
            $total_item = 0;
            if($to_user = get_current_user_id()){
                global $wpdb;
                $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM 
                    {$wpdb->prefix}st_inbox
                    WHERE 
                    1=1 
                    AND is_parent = {$message_id}
                    AND ( to_user = {$to_user} )
                    AND is_read = 0
                    LIMIT 1";
                $wpdb->get_row($sql);
                $total_item=$wpdb->get_var('SELECT FOUND_ROWS()');
            }
            return $total_item;
        }


        function get_message($id){
            global $wpdb;
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM 
                    {$wpdb->prefix}st_inbox
                    WHERE 1=1
                    AND id = {$id}";
            $row = $wpdb->get_row($sql,ARRAY_A);
            return !empty($row)?$row:'';
        }

        function get_child_messages($parent_id){
            global $wpdb;
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM 
                    {$wpdb->prefix}st_inbox
                    WHERE 1=1
                    AND is_parent = {$parent_id}
                    ORDER BY id ASC";
            $res = $wpdb->get_results($sql,ARRAY_A);
            return !empty($res)?$res:'';
        }

        function find_link($text)
        {
            $text= preg_replace("/(^|[\n ])([\w]*?)([\w]*?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target='_blank' >$3</a>", $text);
            $text= preg_replace("/(^|[\n ])([\w]*?)((www)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target='_blank' >$3</a>", $text);
            $text= preg_replace("/(^|[\n ])([\w]*?)((ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"ftp://$3\" target='_blank' >$3</a>", $text);
            $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\" target='_blank' >$2@$3</a>", $text);
            return($text);
        }

        function masked_as_read($id){
            if (is_user_logged_in()) {
                global $wpdb;
                $user_id = get_current_user_id();
                $sql = "
                UPDATE {$wpdb->prefix}st_inbox
                    SET is_read = 1
                WHERE
                to_user = {$user_id}
                AND id = {$id}
                ";
                $sql2 = "
                UPDATE {$wpdb->prefix}st_inbox
                    SET is_read = 1
                WHERE
                to_user = {$user_id}
                AND is_parent = {$id}
                ";
                $wpdb->query($sql);
                $wpdb->query($sql2);
                return TRUE;
            }
            return FALSE;
        }

        function get_last_message($message_parent , $last_message_id , $user_id){
            global $wpdb;
            $sql= "
            SELECT * FROM 
            {$wpdb->prefix}st_inbox
            WHERE 
            is_parent = {$message_parent} 
            AND id > {$last_message_id} 
            AND from_user = {$user_id} 
            ";
            $res = $wpdb->get_results($sql,ARRAY_A);
            return $res;
        }

        function check_new_message(){
            if (is_user_logged_in()) {
                global $wpdb;
                $to_user =  get_current_user_id();
                $sql= "
                SELECT COUNT(*) as count_total FROM 
                {$wpdb->prefix}st_inbox
                WHERE 
                to_user = {$to_user} 
                AND is_read = 0 
                ";
                $row = $wpdb->get_row($sql,ARRAY_A);
                return (!empty($row['count_total'])?$row['count_total']:'0');
            }
            return 0;
        }

        function get_last_content_message($message_id){
            global $wpdb;
            $sql = "SELECT *
                    FROM
                    {$wpdb->prefix}st_inbox 
                    WHERE 
                    is_parent = {$message_id}
                    ORDER BY id desc
                    limit 1";
            $row = $wpdb->get_row($sql,ARRAY_A);
            return $row;
        }
        function remove_messages($message_id, $user_id){

            global $wpdb;

            $sql = "DELETE FROM {$wpdb->prefix}st_inbox WHERE id = {$message_id} AND ( from_user = '{$user_id}' OR to_user = '{$user_id}' ) ";

            $sql2 = "DELETE FROM {$wpdb->prefix}st_inbox WHERE is_parent = {$message_id}";

            $wpdb->query($sql);

            $wpdb->query($sql2);

            global $wpdb;
            $sql = "SELECT SQL_CALC_FOUND_ROWS *
                    FROM 
                    {$wpdb->prefix}st_inbox
                    WHERE 1=1 
                    AND is_parent = 0
                    AND ( from_user = {$user_id} OR to_user = {$user_id} )
                    ORDER BY id DESC
                    LIMIT 1";
            $wpdb->get_results($sql,ARRAY_A);

            $total_item=$wpdb->get_var('SELECT FOUND_ROWS()');

            return $total_item;
        }

        static function inst(){
            if(!self::$_inst)
                self::$_inst = new self();

            return self::$_inst;
        }
    }

    ST_Inbox_Admin::inst();
}