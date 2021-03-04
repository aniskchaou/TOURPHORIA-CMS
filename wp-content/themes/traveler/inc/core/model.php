<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 10/1/17
 * Time: 4:21 PM
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class ST_Model{


    /**
     * Name of the Table
     * @var bool
     * @since 1.0
     */
    protected $table_name = FALSE;


    /**
     * Table version to upgrade
     * @var bool
     * @since 1.0
     */
    protected $table_version = '1.0';


    /**
     * All Columns
     * @var array
     * @since 1.0
     */
    protected $columns = array();


    /**
     * Check if table meta is created
     * @var bool
     * @since 1.0
     */
    protected $is_ready = FALSE;


    /**
     * Identity Column Name for search
     * @var string
     * @since 1.0
     */
    protected $table_key = 'id';


    /**
     * If dont want to create meta table, just set it to TRUE
     * @var bool
     * @since 1.0
     */
    protected $ignore_create_table = FALSE;


    protected $_where_query = array();
    protected $_join_query = array();
    protected $_select_query = array();
    protected $_order_query = array();
    protected $_limit_query = array();
    protected $_last_query = array();
    protected $_last_result = array();
    protected $_groupby = array();
    protected $_having = array();
    protected $_like_query = array();


    /**
     * @since 1.0
     */
    function __construct()
    {
        if ($this->ignore_create_table == FALSE and $this->table_name) {

            add_action('after_setup_theme', array($this, '_check_meta_table_is_working'));
        }
    }

    /**
     * @return array
     */
    function last_query()
    {
        return $this->_last_query;
    }

    /**
     *
     *
     * @param $key
     * @param $value
     * @param string $format
     * @return $this
     */
    function like($key, $value, $format = 'both')
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $k1 => $v1) {
                $this->like($v1['key'], $v1['value'], $v1['format']);
            }

            return $this;
        }
        if (is_string($key)) {
            $this->_like_query[] = array(
                'key'    => $key,
                'value'  => $value,
                'clause' => "AND",
                'format' => $format
            );
        }

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @param string $format
     * @return $this
     */
    function or_like($key, $value, $format = 'both')
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $k1 => $v1) {
                $this->or_like($v1['key'], $v1['value'], $v1['format']);
            }

            return $this;
        }
        if (is_string($key)) {
            $this->_like_query[] = array(
                'key'    => $key,
                'value'  => $value,
                'clause' => "OR",
                'format' => $format
            );
        }

        return $this;
    }

    /**
     * Add Where Clause to current Query
     *
     * @author dannie
     * @since 1.0
     *
     * @param $key
     * @param bool|FALSE $value
     * @param $raw_where bool
     * @return $this
     */
    function where($key, $value = FALSE, $raw_where = FALSE)
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $k1 => $v1) {
                $this->where($k1, $v1, $raw_where);
            }

            return $this;
        }
        if (is_string($key)) {
            $this->_where_query[] = array(
                'key'    => $key,
                'value'  => $value,
                'clause' => 'and',
                'is_raw' => $raw_where
            );
        }

        return $this;
    }

    /**
     * Add OR Where Clause to current Query
     *
     * @author dannie
     * @since 1.0
     *
     * @param $key
     * @param bool|FALSE $value
     * @param bool
     * @return $this
     */
    function or_where($key, $value = FALSE, $raw_where = FALSE)
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $k1 => $v1) {
                $this->or_where($k1, $v1, $raw_where);
            }

            return $this;
        }
        if (is_string($key)) {
            $this->_where_query[] = array(
                'key'    => $key,
                'value'  => $value,
                'clause' => 'or',
                'is_raw' => $raw_where
            );
        }

        return $this;
    }

    /**
     * Add Select
     *
     * @since 1.0
     * @author dannie
     *
     * @param $column_name string|array Name of Column or Array of Column
     * @return ST_Model Current Object
     *
     */
    function select($column_name)
    {
        if (is_array($column_name) and !empty($column_name)) {
            foreach ($column_name as $v) $this->select($v);
        }

        if (is_string($column_name)) {
            $this->_select_query[] = $column_name;
        }

        return $this;
    }

    /**
     * Add Table Join
     *
     * @author dannie
     * @since 1.0
     *
     * @param $table string Name of table
     * @param $on_clause string on clause
     * @param $join_key string join keyword, default is INNER
     * @return ST_Model Current Object
     */
    function join($table, $on_clause, $join_key = 'INNER')
    {
        if (is_array($table) and !empty($table)) {
            foreach ($table as $v) {
                $v = wp_parse_args($v, array(
                    'table'   => '',
                    'on'      => '',
                    'keyword' => '',
                ));
                $this->join($v['table'], $v['on'], $v['keyword']);
            }
        }

        if (is_string($table)) {
            $this->_join_query[] = array('table' => $table, 'on' => $on_clause, 'keyword' => $join_key);
        }

        return $this;
    }

    /**
     * @param $key
     * @param string $value
     * @return ST_Model
     */
    function orderby($key, $value = 'asc')
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $k1 => $v1) {
                $this->orderby($k1, $v1);
            }

            return $this;
        }
        if (is_string($key)) {
            $this->_order_query[$key] = $value;
        }

        return $this;
    }

    function groupby($key)
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $v1) {
                $this->groupby($v1);
            }
        }
        if (is_string($key)) {
            $this->_groupby[] = $key;
        }

        return $this;
    }

    function having($key)
    {
        if (is_array($key) and !empty($key)) {
            foreach ($key as $v1) {
                $this->having($v1);
            }
        }
        if (is_string($key)) {
            $this->_having[] = $key;
        }

        return $this;
    }

    function limit($key, $value = 0)
    {
        $this->_limit_query[0] = $key;
        $this->_limit_query[1] = $value;

        return $this;
    }

    /**
     * Run Get Query and store the result
     *
     * @since 1.0
     * @author dannie
     *
     * @param bool $limit
     * @param bool $offset
     * @param string $result_type
     * @return $this
     */
    function get($limit=FALSE,$offset=FALSE,$result_type=ARRAY_A)
    {
        if($limit){
            $this->limit($limit,$offset);
        }
        global $wpdb;
        $query = $this->_get_query();
        $this->_last_query = $query;
        $this->_last_result = $wpdb->get_results($query, $result_type);

        return $this;
    }

    /**
     * Change Table Name of Current Model
     *
     * @since 1.0
     * @author dannie
     *
     * @param bool $table_name
     * @return $this
     */
    function table($table_name=false){
        if($table_name){
            $this->table_name=$table_name;
        }

        return $this;
    }

    /**
     * Return first row of last query result
     *
     * @author dannie
     * @since 1.0
     *
     * @return bool|array
     */
    function row($key=false)
    {
        $data = isset($this->_last_result[0]) ? $this->_last_result[0] : FALSE;
        $this->_clear_query();

        if(!empty($key)) return isset($data[$key])?$data[$key]:null;

        return $data;

    }

    /**
     * Return All Last Query Result
     *
     * @since 1.0
     * @author dannie
     *
     * @return array
     */
    function result()
    {
        $data = $this->_last_result;
        $this->_clear_query();

        return $data;
    }

    /**
     * Run Update Query
     *
     * @since 1.0
     * @author dannie
     *
     * @param array $data
     * @return bool|false|int
     */
    function update($data = array())
    {
        if (empty($data)) {
            return FALSE;
        }
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $where = FALSE;
        if (!empty($this->_where_query)) {
            $where=' WHERE 1=1 ';
            foreach ($this->_where_query as $key => $value) {
                $value = wp_parse_args($value, array(
                    'key'    => FALSE,
                    'value'  => FALSE,
                    'clause' => 'and',
                    'is_raw' => FALSE
                ));
                if (!$value['is_raw']) {
                    $last = substr($value['key'], -1);
                    switch ($last) {
                        case ">":
                        case "<":
                        case "=":
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '%s ', array($value['value']));
                            break;
                        default:
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '=%s ', array($value['value']));
                            break;

                    }
                } else {
                    $where .= ' ' . $value['clause'] . ' ' . $value['key'];
                }

            }
        }

        $set = FALSE;
        foreach ($data as $key => $value) {
            $prepare='%s';

            if(is_float($value)){
                $prepare='%f';
            }elseif(is_integer($value)){
                $prepare='%d';
            }
            $set .= $wpdb->prepare("$key={$prepare},",$value);
        }
        $set = substr($set, 0, -1);

        $query = "UPDATE " . $table_name . " SET " . $set;

        $query .= $where;

	    $this->_last_query = $query;
        $this->_clear_query();
        return $wpdb->query($query);

    }

    /**
     * Run Insert Query
     *
     * @since 1.0
     * @author dannie
     *
     * @param array $data
     * @return bool|int
     */
    function insert($data = array())
    {
        if (empty($data)) {
            return FALSE;
        }
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $set = FALSE;
        $set_data = array();
        $set_columns = FALSE;

        foreach ($data as $key => $value) {
            //if(!array_key_exists($key,$this->columns)) continue;
            $set .= "%s,";
            $set_data[] = $value;
            $set_columns.=$key.',';
        }

        $set = substr($set, 0, -1);
        $set_columns = substr($set_columns, 0, -1);

        $query = "INSERT INTO " . $table_name . " ({$set_columns}) VALUES ($set)";

        $query = $wpdb->prepare($query, $set_data);

	    $this->_last_query = $query;
        $wpdb->query($query);

        $this->_clear_query();
        return $wpdb->insert_id;

    }

    /**
     * Delete from table with where clause
     *
     * @author dannie
     * @since 1.0
     *
     * @return bool|false|int
     */
    function delete()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $where = FALSE;
        if (!empty($this->_where_query)) {
            $where=' WHERE 1=1 ';
            foreach ($this->_where_query as $key => $value) {
                $value = wp_parse_args($value, array(
                    'key'    => FALSE,
                    'value'  => FALSE,
                    'clause' => 'and',
                    'is_raw' => FALSE
                ));
                if (!$value['is_raw']) {
                    $last = substr($value['key'], -1);
                    switch ($last) {
                        case ">":
                        case "<":
                        case "=":
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '%s ', array($value['value']));
                            break;
                        default:
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '=%s ', array($value['value']));
                            break;

                    }
                } else {
                    $where .= ' ' . $value['clause'] . ' ' . $value['key'];
                }

            }
        }


        $query = "DELETE FROM " . $table_name . " ";

        $query .= $where;
        $this->_clear_query();
        return $wpdb->query($query);
    }

    /**
     * Get single row by table key
     *
     * @since 1.0
     * @author dannie
     *
     * @param $id
     * @return array|bool|null|object|void
     */
    function find($id)
    {

        if (!$this->table_key or !$this->is_ready()) return FALSE;

        $data = $this->where($this->table_key, $id)->limit(1)->get()->row();
        $this->_clear_query();

        return $data;
    }

    /**
     * Get single row by key and value
     *
     * @since 1.0
     * @author dannie
     *
     * @param $key
     * @param $id
     * @return array|bool|null|object|void
     */
    function find_by($key, $id)
    {
        $this->_clear_query();
        if (!$this->is_ready()) return FALSE;
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->where($k, $v);
            }
            $data = $this->limit(1)->get()->row();
        }else{
            $data = $this->where($key, $id)->limit(1)->get()->row();
        }


        $this->_clear_query();

        return $data;
    }

    function find_all_by($key, $value)
    {
        if (!$this->table_key or !$this->is_ready()) return FALSE;

        $data = $this->where($key, $value)->get()->result();
        $this->_clear_query();

        return $data;
    }

    /**
     * Get columns of the table
     *
     * @since 1.0
     * @author dannie
     *
     * @return array
     */
    function get_columns()
    {
        return apply_filters('wpbooking_model_table_' . $this->table_name . '_columns', $this->columns);
    }

    /**
     * Check Meta Table is ready
     *
     * @since 1.0
     * @author dannie
     *
     * @since 1.0
     * @return bool
     */
    function is_ready()
    {

        if ($this->ignore_create_table) return TRUE;

        return $this->is_ready;
    }

    /**
     * Check Meta Table is Created
     *
     * @since 1.0
     * @author dannie
     *
     * @since 1.0
     */
    public function _check_meta_table_is_working()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->table_name;
        $table_columns = $this->get_columns();
        $db_version = get_option($this->table_name . '_version');
        if (!$db_version) $db_version = 0;

        if (!$this->is_ready() and $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

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

                    //default value for col
	                $default_value = '';
	                if(isset($value['default'])){
		                $default_value = ' DEFAULT ' . $value['default'];
	                }

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
                        $col_string .= ' ' . $key . ' ' . $value['type'] . $default_value . $prefix . $s_char;
                    }

                    $i++;

                }


            }

            $sql = "CREATE TABLE $table_name (
                        $col_string
                    ) $charset_collate;";

            $wpdb->query($sql);

            update_option($this->table_name . '_version', $this->table_version);

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                $this->is_ready = FALSE;

            } else {
                $this->is_ready = TRUE;

            }

        } else {
            $this->is_ready = TRUE;
        }


        if ($this->is_ready) {
            // check upgrade data

            if (version_compare($db_version, $this->table_version, '<')) {
                $this->_upgrade_table();
                update_option($this->table_name.'_version', $this->table_version);
            }

        }
    }

    /**
     * Upgrade meta table
     *
     * @since 1.0
     * @author dannie
     *
     * @since 1.0
     */
    public function _upgrade_table()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;
        $table_columns = $this->get_columns();

        $insert_key = $table_columns;
        $delete_key=array();
        $update_key = array();
        $unique_key=[];
        //$remove_unique=[];

        foreach($table_columns as $key=>$val)
        {
            if(!empty($val['UNIQUE'])) $unique_key[$key]=$val;
        }

        //Old table columns
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

        if ($old_coumns and !empty($old_coumns)) {
            foreach ($old_coumns as $key => $value) {
                unset($insert_key[$value->COLUMN_NAME]);

                // for columns need update
                if (isset($table_columns[$value->COLUMN_NAME])) {
                    if (strtolower($table_columns[$value->COLUMN_NAME]['type']) != strtolower($value->DATA_TYPE)) {
                        $update_key[$value->COLUMN_NAME] = $table_columns[$value->COLUMN_NAME];
                    }
                }else{
                    // Delete
                    $delete_key[]=$value->COLUMN_NAME;
                }


            }
        }

        // Do create new columns
        if (!empty($insert_key)) {
            $insert_col_string = '';
            foreach ($insert_key as $key => $value) {

                if (empty($value['type'])) continue;

                $prefix = '';
                //Add length for varchar data type
                switch (strtolower($value['type'])) {
                    case "varchar":

                        if (isset($value['length']) and $value['length']) {
                            $prefix = '(' . $value['length'] . ')';
                        }
                        break;
                }

	            $default_value = '';
	            if(isset($value['default'])){
		            $default_value = ' DEFAULT ' . $value['default'];
	            }

                $col_type = $value['type'];
                $insert_col_string .= " ADD $key $col_type $default_value " . $prefix . ',';
            }
            $insert_col_string = substr($insert_col_string, 0, -1);
            // do update query
            $query = "ALTER TABLE $table_name " . $insert_col_string;

            $wpdb->query($query);
        }

        // Do update columns (change columns data type)
        if (!empty($update_key)) {
            $update_col_string = '';
            foreach ($update_key as $key => $value) {
                $prefix = '';
                //Add length for varchar data type
                switch (strtolower($value['type'])) {
                    case "varchar":
                        if (isset($value['length']) and $value['length']) {
                            $prefix = '(' . $value['length'] . ')';
                        }
                        break;
                }

	            $default_value = '';
	            if(isset($value['default'])){
		            $default_value = ' DEFAULT ' . $value['default'];
	            }

                $col_type = $value['type'];
                $update_col_string .= " MODIFY $key $col_type $default_value " . $prefix . ',';
            }
            $update_col_string = substr($update_col_string, 0, -1);
            // do update query
            $query = "ALTER TABLE $table_name " . $update_col_string;

            $wpdb->query($query);
        }

        // Do delete unused columns
        if(!empty($delete_key)){
            $delete_query_string=FALSE;
            foreach($delete_key as $val){
                $delete_query_string.=' DROP COLUMN '.$val.',';
            }
            $delete_query_string = substr($delete_query_string, 0, -1);

            $query = "ALTER TABLE $table_name " . $delete_query_string;

            $wpdb->query($query);
        }

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


    /**
     * Build the query
     *
     * @since 1.0
     * @author dannie
     *
     * @return bool|string
     */
    public function _get_query()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $select = FALSE;
        if (!empty($this->_select_query)) {

            $select = implode(',', $this->_select_query);
        } else {
            $select = '*';
        }

        $join = FALSE;
        if (!empty($this->_join_query)) {
            foreach ($this->_join_query as $j) {
                $j = wp_parse_args($j, array(
                    'tale'    => FALSE,
                    'on'      => FALSE,
                    'keyword' => FALSE
                ));

                if (!$j['table'] or !$j['on']) continue;

                $table = $wpdb->prefix . $j['table'];

                // Replace JOIN ON to add Table prefix to Table Name
                $j['on'] = str_replace($j['table'], $table, $j['on']);
                $j['on'] = str_replace($this->table_name, $table_name, $j['on']);

                $join .= ' ' . $j['keyword'] . ' JOIN ' . $table . ' ON ' . $j['on'];
            }
        }

        $where = ' WHERE 1=1 ';
        if (!empty($this->_where_query)) {

            foreach ($this->_where_query as $key => $value) {
                $value = wp_parse_args($value, array(
                    'key'    => FALSE,
                    'value'  => FALSE,
                    'clause' => 'and',
                    'is_raw' => FALSE
                ));
                if (!$value['is_raw']) {
                    $last = substr($value['key'], -1);
                    switch ($last) {
                        case ">":
                        case "<":
                        case "=":
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '%s ', array($value['value']));
                            break;
                        default:
                            $where .= $wpdb->prepare(' ' . $value['clause'] . ' ' . $value['key'] . '=%s ', array($value['value']));
                            break;

                    }
                } else {
                    $where .= ' ' . $value['clause'] . ' ' . $value['key'];
                }

            }
        }

        // Like
        if (!empty($this->_like_query)) {

            foreach ($this->_like_query as $key => $value) {
                $value = wp_parse_args($value,
                    array(
                        'key'    => FALSE,
                        'value'  => FALSE,
                        'clause' => 'AND',
                        'format' => 'both'
                    ));
                switch ($value['format']) {
                    case "before":
                        $where .= ' ' . $value['clause'] . ' ' . $value['key'] . " LIKE '%" . $wpdb->_real_escape($value['value']) . "' ";
                        break;
                    case "after":
                        $where .= ' ' . $value['clause'] . ' ' . $value['key'] . " LIKE '" . $wpdb->_real_escape($value['value']) . "%' ";
                        break;

                    default:
                        $where .= ' ' . $value['clause'] . ' ' . $value['key'] . " LIKE '%" . $wpdb->_real_escape($value['value']) . "%' ";
                        break;

                }
            }
        }


        $order = FALSE;
        if (!empty($this->_order_query)) {
            $order = ' ORDER BY ';
            foreach ($this->_order_query as $k => $v) {
                $order .= ' ' . $k . ' ' . $v . ',';
            }

            $order = substr($order, 0, -1);
        }

        $groupby = FALSE;

        if (!empty($this->_groupby)) {
            $groupby = ' GROUP BY ';
            foreach ($this->_groupby as $k => $v) {
                $groupby .= ' ' . $v . ',';
            }

            $groupby = substr($groupby, 0, -1);

            $having = FALSE;
            if (!empty($this->_having)) {
                $having .= ' HAVING ';
                foreach ($this->_having as $k => $v) {
                    $having .= ' ' . $v . ',';
                }

                $having = substr($having, 0, -1);

                $groupby .= ' ' . $having;
            }

        }

        $limit = FALSE;
        if (!empty($this->_limit_query[0])) {
            $limit = ' LIMIT ';

            $offset = !empty($this->_limit_query[1]) ? $this->_limit_query[1] : 0;

            $limit .= $offset . ',' . $this->_limit_query[0];

        }

        if ($select) {
            $query = "SELECT  SQL_CALC_FOUND_ROWS {$select} FROM {$table_name} ";
            //$query=$wpdb->prepare($query,array($select));
            $query .= $join;
            $query .= $where;
            $query .= $groupby;
            $query .= $order;
            $query .= $limit;

            return $query;
        }

        return FALSE;
    }

    /**
     * Get Table Name with Prefix
     *
     * @author dannie
     * @since 1.0
     *
     *
     * @param $prefix
     * @return string
     */
    function get_table_name($prefix=true)
    {
        global $wpdb;

        if($prefix)
            return $table_name = $wpdb->prefix . $this->table_name;
        else
            return $this->table_name;
    }


    /**
     * Clear Query Condition after each query
     *
     * @since 1.0
     * @author dannie
     */
    public function _clear_query()
    {
        $this->_where_query = array();
        $this->_select_query = array();
        $this->_order_query = array();
        $this->_limit_query = array();
        $this->_join_query = array();
        $this->_groupby = array();
        $this->_having = array();
    }


    public function add_error($mess,$mess_id=null){
        $key='ip_model_'.$this->table_name.'_errors';
        if(empty($_SESSION[$key])){
            $_SESSION[$key]=array();
        }


        if(!$mess_id)
            $_SESSION[$key][]=$mess;
        else $_SESSION[$key][$mess_id]=$mess;
    }


    /**
     * Get Errors from Session then unset
     *
     * @return array
     */
    public function get_errors(){
        $key='ip_model_'.$this->table_name.'_errors';

        if(!empty($_SESSION[$key])){
            $message= @$_SESSION[$key];
            unset($_SESSION[$key]);

            return $message;
        }

        return array();


    }

    /**
     * Get total number rows with FOUND_ROWS()
     *
     * @return int
     */
    public function get_total()
    {
        global $wpdb;
        return $wpdb->get_var('SELECT FOUND_ROWS()');
    }

}