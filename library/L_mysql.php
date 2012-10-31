<?php

if (!defined('SECRETKEY')) {
    die('没权限1');
}
if (SECRETKEY !== 'o0/l1I8-+$') {
    die('没权限2');
}

class L_mysql {

    private $db_host = '';
    private $db_name = '';
    private $db_password = '';
    private $prefix = '';
    private $link = '';
    private $link_table = '';
    private $sql = '';
    private $field = '';
    private $del_table = '';
    private $from = '';
    private $join = '';
    private $where = '';
    private $order = '';
    private $group = '';
    private $limit = '';
    private $result = '';
    private $data = array();
    private $info = array();

    function __construct($host = DB_HOST, $port = DB_PORT, $user = DB_USER, $password = DB_PASSWORD, $name = DB_NAME) {
        $this->db_host = $port ? $host . ':' . $port : $host;
        $this->db_user = $user;
        $this->db_password = $password;
        $this->db_name = $name;
        $this->connect();
    }

    /**     * 连接数据库	 */
    public function connect() {
        if (DB_PERSISTENT_CON) {
            $this->link = mysql_pconnect($this->db_host, $this->db_user, $this->db_password) or die("Could not connect: " . mysql_error());
        } else {
            $this->link = mysql_connect($this->db_host, $this->db_user, $this->db_password) or die("Could not connect: " . mysql_error());
        }
        if (empty($this->link)) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_query('set names utf8');
        return $this->set_link_db($this->db_name);
    }

    /**     * 初始化	 */
    public function init($table) {
        $this->prefix = 'wp_';
        $this->set_link_table($table);
        $this->set_del_table($table);
        $this->field = '*';
        $this->from = $this->link_table;
        $this->del_table = '';
        $this->join = '';
        $this->where = '';
        $this->order = '';
        $this->group = '';
        $this->limit = '';
        $this->result = '';
        $this->data = array();
    }

    /** ---------------------------------- mysql系统设置 ---------------------------------- * */

    /**     * 设置库	 * @param string $db_name[数据库名称]	 */
    public function set_link_db($db_name) {
        return mysql_select_db($db_name);
    }

    /** ---------------------------------- mysql设置 ---------------------------------- * */

    /**     * 设置表	* @param string $table[数据库表名称]	 */
    public function set_table_prefix($prefix) {
        $this->prefix = $prefix;
        return $this->prefix;
    }

    /**     * 设置表	 * @param string $table[数据库表名称]	 */
    public function set_link_table($table) {
        $this->link_table = $this->prefix . $table;
        return $this->link_table;
    }

    /**     * 设置删除表	 */
    public function set_del_table($del_table) {
        $this->del_table = $this->prefix . $del_table;
        return $this->del_table;
    }

    /**     * 设置字段	 */
    public function set_field($field) {
        $this->field = $field;
        return $this->field;
    }

    /**     * 设置from	 */
    public function set_from($from) {
        $this->from = $from;
        return $this->from;
    }

    /**     * 设置join	 */
    public function set_join($join) {
        if(is_array($join)){
            $this->join = $join;
        }else{
            $this->join[] = $join;
        }
        return $this->join;
    }

    /**     * 设置条件	 */
    public function set_where($where) {
        $this->where = $where;
        return $this->where;
    }

    /**     * 设置排序	 */
    public function set_order($order) {
        $this->order = $order;
        return $this->order;
    }

    /**     * 设置分组	 */
    public function set_group($group) {
        $this->group = $group;
        return $this->group;
    }

    /**     * 设置限制	 */
    public function set_limit($limit) {
        $this->limit = $limit;
        return $this->limit;
    }

    /** ---------------------------------- mysql获取 ---------------------------------- * */

    /**     * 获取字段	 */
    public function get_field() {
        return $this->field;
    }

    /**     * 获取删除表	 */
    public function get_del_table() {
        return $this->del_table;
    }

    /**     * 设置from	 */
    public function get_from($from) {
        return $this->from;
    }

    /**     * 获取join	 */
    public function get_join() {
        return $this->join;
    }

    /**     * 获取条件	 */
    public function get_where() {
        return $this->where;
    }

    /**     * 获取排序	 */
    public function get_order() {
        return $this->order;
    }

    /**     * 获取分组	 */
    public function get_group() {
        return $this->group;
    }

    /**     * 获取排序	 */
    public function get_limit() {
        return $this->limit;
    }

    /**     * 获取结果	 */
    public function get_result() {
        return $this->result;
    }

    /**     * 获取表总的记录行数量	 */
    public function get_count($where = 1) {
        $r = mysql_query('SELECT COUNT(*) count FROM `' . $this->link_table . '` WHERE ' . $where);
        return mysql_fetch_object($r)->count;
    }

    /** ---------------------------------- 数据库表操作 ---------------------------------- * */

    /**     * 创建表	 * @param unknown_type $tableName	 * @param unknown_type $createElement	 * @param unknown_type $parmater	 */
    public function createTable($tableName, $createElement, $parmater) {
        return $sql = 'CREATE TABLE `' . $tableName . '` (' . join(',', $createElement) . ')' . ' ' . join(' ', $parmater);
    }

    /**     * 删除表	 * @param unknown_type $tableName	 */
    public function deleteTable($tableName) {
        $findTableName = $this->findTableName();
        if (in_array($tableName, $findTableName)) {
            return $this->db->query($sql);
        } else {
            return FALSE;
        }
    }

    /** ---------------------------------- sql处理 ---------------------------------- * */

    /**     * 根据数组或者字符串整合数据到sql	 * @param array		$data	 * @param string	$start	 * @param string	$middle	 * @param string	$end	 */
    public function integrate_array_string_to_sql($data, $start = '', $middle = ' ', $end = '') {
        if (!empty($data)) {
            if (is_array($data)) {
                $this->sql = empty($data) ? $this->sql : $this->sql . ' ' . $start . ' ' . join(' '.$middle.' ', $data) . ' ' . $end;
            } elseif (is_string($data)) {
                $this->sql = empty($data) ? $this->sql : $this->sql . ' ' . $start . ' ' . $data . ' ' . $end;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**     * 检查数据库表是否存在	 */
    public function check_table($tableName) {
        $findTableName = $this->findTableName();
        if (in_array($tableName, $findTableName)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** ---------------------------------- mysql信息 ---------------------------------- * */

    /**     * 查询表名称	 */
    public function findTableName() {
        $sql = 'show tables;';
        $result = $this->query($sql);
        $objs = array();
        $tableName = 'Tables_in_' . $this->db_name;
        $obj = $this->fetch_object($result);
        foreach ($obj as $v) {
            $objs [] = $v->$tableName;
        }
        return $objs;
    }

    /**     * 获取指定数据库表字段信息	 */
    public function get_table_all_fields() {
        $sql = 'show full fields from `' . $this->link_table . '`';
        $result = $this->query($sql);
        $objs = array();
        if (mysql_num_rows($result) == 0) {
            return false;
        }
        while ($result && $f = mysql_fetch_assoc($result)) {
            $objs [] = $f ['Field'];
        }
        return $objs;
    }

    /** ---------------------------------- mysql查询 ---------------------------------- * */

    /**     * 查询	 */
    public function select() {
        $this->sql = 'SELECT';
        $this->integrate_array_string_to_sql($this->field, '', ',');
        $this->integrate_array_string_to_sql($this->from, 'FROM');
        $this->integrate_array_string_to_sql($this->join);
        $this->integrate_array_string_to_sql($this->where, 'WHERE', 'AND');
        $this->integrate_array_string_to_sql($this->order, 'ORDER BY');
        $this->integrate_array_string_to_sql($this->group, 'GROUP BY');
        $this->sql .= $this->get_limit();
        return $this->sql;
    }

    /** ---------------------------------- mysql操作 ---------------------------------- * */

    /**     * 插入一条数据	 * @param array $data[插入数据，包括数据库字段名和值]	 */
    public function insert($data) {
        $f = array_flip($this->get_table_all_fields());
        if (is_array(reset($data))) {
            $ind = 0;
            while ($info = current($data)) {
                ksort($info);
                if ($ind === 0) {
                    $ind = 1;
                    ksort($f);
                    $f = array_intersect_key($f, $info);
                    $info = array_intersect_key($info, $f);
                    $field = array_keys($f);
                    $value = array_values($info);
                    $this->sql = 'INSERT INTO ' . $this->link_table . ' ( ' . $this->link_table . '.' . join(',' . $this->link_table . '.', $field) . ' ) VALUES';
                }
                $this->sql .= '( ' . join(',', $info) . ' )';
                if (next($data) === FALSE) {
                    $this->sql .= ';';
                } else {
                    $this->sql .= ',';
                }
            }
        } else {
            ksort($data);
            ksort($f);
            $f = array_intersect_key($f, $data);
            $data = array_intersect_key($data, $f);
            $field = array_keys($f);
            $value = array_values($data);
            $this->sql = 'INSERT INTO ' . $this->link_table . ' ( ' . $this->link_table . '.' . join(',' . $this->link_table . '.', $field) . ' ) VALUES';
            $this->sql .= '( ' . join(',', $value) . ' );';
        }
        return $this->sql;
    }

    /**     * 更新	 * @param array $data	 */
    public function update($data) {
        foreach ($data as $key => $value) {
            $set [] = $this->link_table . '.' . $key . '=' . $value;
        }
        $this->sql = 'UPDATE ' . $this->link_table . ' SET ' . join(',', $set);
        $this->integrate_array_string_to_sql($this->where, ' WHERE ', ' AND ');
        return $this->sql;
    }

    /**     * 删除	 */
    public function delete() {
        $this->sql = 'DELETE ' . $this->del_table . ' FROM ' . $this->link_table;
        $this->integrate_array_string_to_sql($this->where, ' WHERE ', ' AND ');
        return $this->sql;
    }

    /** ---------------------------------- mysql结果及处理 ---------------------------------- * */

    /**     * 获取资源类型	 * @param string $sql	 */
    public function query($sql = '') {
        $this->sql = empty($sql) ? $this->sql : $sql;
        $this->result = mysql_query($this->sql);
        return $this->result;
    }

    /**     * 根据结果返回数字和字符串下标	 * @param result $result	 */
    public function fetch_both($result = '') {
        if (!empty($result)) {
            $this->result = $result;
        }
        $this->data = array();
        while ($this->result && $data = mysql_fetch_array($this->result, MYSQL_BOTH)) {
            $this->data[] = $data;
        }
        return $this->data;
    }

    /**     * 根据结果返回数字下标	 * @param result $result	 */
    public function fetch_number($result = '') {
        if (!empty($result)) {
            $this->result = $result;
        }
        $this->data = array();
        while ($this->result && $data = mysql_fetch_array($this->result, MYSQL_NUM)) {
            $this->data[] = $data;
        }
        return $this->data;
    }

    /**     * 根据结果返回字符串下标	 * @param result $result	 */
    public function fetch_array($result = '',$seq='',$overlapping='') {
        $data = array();
        if (!empty($result)) {
            $this->result = $result;
        }
        $this->data = array();
        while ($this->result && $data = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
            if(empty($seq)){
                $this->data[] = $data;
            }else{
                if(empty($overlapping)){
                    $this->data[$data[$seq]] = $data;
                }else{
                    $this->data[$data[$seq]][] = $data;
                }
            }
        }
        return $this->data;
    }

    /**     * 根据结果返回对象	 * @param result $result	 */
    public function fetch_object($result = '') {
        $data = array();
        if (!empty($result)) {
            $this->result = $result;
        }
        $this->data = array();
        while ($this->result && $data = mysql_fetch_object($this->result)) {
            $this->data[] = $data;
        }
        return $this->data;
    }

    /**     * 根据结果返回结果的行数量	 * @param result $result	 */
    public function num_rows($result = '') {
        if (!empty($result)) {
            $this->result = $result;
        }
        if (!empty($this->result)) {
            return mysql_num_rows($this->result);
        } else {
            return false;
        }
    }

    /**     * 获取最近一条插入的id	 */
    public function get_insert_id() {
        return mysql_insert_id();
    }

    /**     * 取得最近一条查询的信息	 */
    public function get_recently_sql() {
        return mysql_info();
    }

    /** ---------------------------------- 连接处理 ---------------------------------- * */

    /**     * 关闭连接	 */
    public function close() {
        return mysql_close($this->link);
    }

    /**     * 析构函数	 */
    public function __destruct() {
        is_resource($this->result) ? mysql_free_result($this->result) : '';
        is_resource($this->link) ? mysql_close($this->link) : '';
    }

    /** ---------------------------------- 应用 ---------------------------------- * */

    /**     * 获取总行数	 */
    public function appGetTotalNumber() {
        $this->set_field(' count(*) cnt ');
        $this->set_limit(' LIMIT 1');
        $this->select();
        $this->query();
        $number = $this->fetch_object();
        return empty($number) ? 0 : array_shift($number)->cnt;
    }

    /**     * 获取一个数据	 */
    public function appGetOneData() {
        $this->set_limit(' LIMIT 1');
        $this->select();
        $this->query();
        $result = $this->fetch_array();
        return empty($result) ? array() : array_shift($result);
    }

    /**     * 获取提供分页的数据	 */
    public function appGetAllData() {
        $this->set_where($where);
        $this->select();
        $this->query();
        $result = $this->fetch_array();
        return empty($result) ? array() : $result;
    }

}