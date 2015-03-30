<?php
namespace Dirt\Lib;


class Model {

    protected $sql = '';
    protected $table  = null;
    protected $primary_key = null;
    protected $fields = null;
    protected $conn;

    protected $sql_struct = null;

    function __construct(){
        $this->fields = join(',', $this->fields);
        if (is_null($this->table) || is_null($this->primary_key) || is_null($this->fields)) {
            throw new \Virus\Frame\VException('wraing : ImTalbeBase Class init false!', 25001);
        }
        
        $this->conn = DBImHelper::getConn();
    }

    public function  get_real_sql($sql, $param) {
        foreach ($param as $k => $v) {
            $sql = str_ireplace(":$k", $v, $sql);
        }
        return $sql;
    }

    /*
     * 创建插入数据
     */
    public function create ($param, $virual_data = false) {
        $keys = array_keys($param);

        $fields = $this->parse_fields("`?`", $keys);
        $values = $this->parse_fields(":?", $keys);
        $fields = join(',', $fields);
        $values = join(',', $values);
        $sql  = "insert into {$this->table} ($fields) value ($values)";
        $res = $this->conn->write($sql, $param);
        if ($res  == 0) {
            return false;
        }

        $last_id =  (int)$this->conn->getInsertId();
        if ($virual_data) {
            return $this->virual_data($last_id, $param);
        }

        if ($last_id) {
            return $last_id;
        }

        return $res;
    }

    /*
     * 构造刚刚写入的数据
     * */
    private function virual_data ($id , $param){
        $fields = array_flip(explode(',', $this->get_all_fields()));
        foreach ($fields as $field => &$value) {
            if ($field == $this->primary_key) {
                $value = $id;
                continue;
            }
            if (isset($param[$field])) {
                $value = $param[$field];
            }
        }
        return $fields;
    }

    /*
     * replace
     */
    public function replace_into ($param, $virual_data = false) {
        $keys = array_keys($param);

        $fields = $this->parse_fields("`?`", $keys);
        $values = $this->parse_fields(":?", $keys);
        $fields = join(',', $fields);
        $values = join(',', $values);
        $sql  = "replace into {$this->table} ($fields) value ($values)";
        $res = $this->conn->write($sql, $param);
        return $res;
    }

    /*
     *
     */
    public function ondup($param, $update) {

        $keys = array_keys($param);

        $fields = $this->parse_fields("`?`", $keys);
        $values = $this->parse_fields(":?", $keys);
        $fields = join(',', $fields);
        $values = join(',', $values);

        $where = $this->where($update)->adapter($params, 'update_', false);
        $param = array_merge($param, $params);

        $sql  = "insert into {$this->table} ($fields) value ($values) on DUPLICATE key update $where";
        $res = $this->conn->write($sql, $param);
    }

    /*
     * 更新
     */
    public function update ($param = array()) {
        if (empty($param)) {
            throw new \Virus\Frame\VException('参数错误', 25001);
        }
        $condition = $this->adapter($where, $prifix = 'updata_');

        $keys     = array_keys($param);
        $settings = $this->parse_fields(" `?`=:? ", $keys);
        $settings = join(',', $settings);

        if (empty($condition)) {
            throw new \Virus\Frame\VException('参数错误, 必须保证查询条件存在', 25001);
        }

        $sql = "update {$this->table} set $settings where 1=1 and $condition";
        $update_param = array_merge($param, $where);
        $res = $this->conn->write($sql, $update_param);

        return $res;
    }

    /*
     * 删除,暂时不能使用，因为没有提供强检测。防止清表
     */
    public function remove ($debug = false) {
        $where = $this->adapter($param);

        if (empty($where)) {
            throw new \Virus\Frame\VException('参数错误', 25001);
        }

        $sql  = "delete from {$this->table} where 1=1 and $where";
        return $this->conn->write($sql, $param);
    }

    /*状态置为删除*/
    public function del ($param) {
        return $this->where($param)->update(array('is_del' => 1));
    }

    /*
     * 查询
     */
    public function query ($fields = false, $master = false, $hash_key = null) {
        $where = $this->adapter($param);
        $order = $this->order();

        if (!$fields) $fields = $this->get_all_fields();

        $sql  = "select $fields from {$this->table} where 1=1 and $where $order";
        $res = $this->conn->read($sql, $param, $master, $hash_key);
        return $res;
    }

    /*
     * 直接查询
     */
    public function sql($sql, $param, $master = false, $hash_key = null){
        $res = $this->conn->read($sql, $param);
        return $res;
    }

    /*
     * 检查是否存在
     */
    public function exists ($where) {
        $res = $this->where($where)->query();
        if(empty($res)) return false;
        else return $res[0][$this->primary_key];
    }

    /*
     * 公共分页组件
     * 参数 ：min_id 或 max_id
     * 返回 ：datas . prev_id next_id
     */
    public function page ($sql = '', $param = array(), $min_id = null, $max_id = null, $limit = 20) {

        $return     = $this->page_data();
        $where      = '';

        $is_asc     = $this->page_is_asc($sql);
        $is_prev    = $this->page_is_prev($min_id, $max_id);
        $is_next    = $this->page_is_next($min_id, $max_id);

        if ($is_prev && $max_id) {

            if (!$is_asc) {
                $sql    = str_ireplace('desc', 'asc', $sql);
                $where .= "`{$this->primary_key}` > :page_max_id and";
            } else {
                $sql    = str_ireplace('asc', 'desc', $sql);
                $where .= "`{$this->primary_key}` < :page_max_id and";
            }
            $param['page_max_id'] = $max_id;

        }

        if ($is_next && $min_id) {

            if (!$is_asc) {
                $where .= "`{$this->primary_key}` < :page_min_id and";
            } else {
                $where .= "`{$this->primary_key}` > :page_min_id and";
            }
            $param['page_min_id'] = $min_id;
        }

        $sql = str_ireplace('where', "where $where", $sql);

        $datas = $this->offset($sql, $param, $offset = 0, ++$limit);

        if ($count = count($datas)) {
            if ( $count > --$limit ) {
                unset($datas[--$count]);
                $last_page  = 0;
            }

            if ($is_prev) {
                $next_id  = (int)$datas[0][$this->primary_key];
                $prev_id  = (int)$datas[--$count][$this->primary_key];
                $datas = array_reverse($datas);
            }

            if ($is_next) {
                $prev_id  = (int)$datas[0][$this->primary_key];
                $next_id  = (int)$datas[--$count][$this->primary_key];
            }
            $count++;
        }


        $return['datas']        = $datas;
        //$return['is_first']   = $first_page;
        $return['prev_id']      = isset($prev_id) ? $prev_id : null;
        $return['next_id']      = isset($next_id) ? $next_id : null;
        $return['is_last']      = isset($last_page) ? $last_page : 1;
        $return['count']        = $count;
        return $return;
    }

    private function page_data () {
        $data['datas']      = array();
        $data['is_first']   = 1;
        $data['prev_id']    = null;
        $data['next_id']    = null;
        $data['is_last']    = 1;
        $data['count']      = 0;
    }

    private function page_is_next ($min_id, $max_id) {
        if ( is_null($max_id) && (is_null($min_id) || is_numeric($min_id))) {
            return true;
        }
        return false;
    }

    private function page_is_prev ($min_id, $max_id) {
        if (is_null($min_id) && is_numeric($max_id)) {
            return true;
        }
        return false;
    }

    private function page_is_offset ($min_id, $max_id) {
        if ( is_null($min_id) && is_null($max_id) ) {
            return true;
        }
        return false;
    }

    private function page_is_asc (&$sql) {
        if (!stripos($sql, ' where ')) {
            $sql = str_replace($this->table, $this->table . " where 1 ", $sql);
        }

        $is_asc     = !stripos($sql, 'desc');
        $has_order  = stripos($sql, 'order');

        if ($is_asc && !$has_order) $sql .= " order by {$this->primary_key} asc";
        return $is_asc;
    }

    private function page_is_first ($min_id, $max_id, $count, $limit) {
        return 1;
    }

    private function page_is_last ($mim_id, $max_id, $count, $limit) {
        return 1;
    }

    # offset 方式分页
    public function offset ($sql, $param = array(), $offset = 0, $limit = 15) {

        $sql = "$sql limit :_page_offset , :_page_limit";
        $param['_page_offset'] = $offset;
        $param['_page_limit'] = $limit;
        $datas = $this->conn->read($sql, $param);
        return $datas;
    }

    /* page ending. */

    /*
     * 构造参数
     */

    private function get_where() {
        $where =  !empty($this->sql_struct['where']) ? $this->sql_struct['where'] : array();
        unset($this->sql_struct['where']);
        return $where;
    }

    public function adapter(&$param, $prefix = 'prefix_', $auto = true) {
        $where      = $this->get_where();
        $condition  = array();
        $AOI        = array('or', 'and', ',');
        $first      = true;

        #处理fields，处理condition
        foreach ($where as $field => $item)  {
            unset($where[$field]);
            if (!$first) {
                $first = false;
            }

            if (is_numeric($field)) {
                if (is_string($item) && in_array(strtolower($item), $AOI)) {
                    $condition[] = $item;
                }

                if (is_array($item)) {
                    $sql = $this->where($item)->adapter($param);
                    $condition[] = $sql;

                    if (!is_string(current($where)) || !in_array(strtolower(current($where)), $AOI)) {
                        $condition[] = 'AND';
                    }
                }

                continue;
            }

            if (is_array($item) && !isset($item['op'])) {
                $item =  $this->where_pre_adapter($field, $item);
            }

            //构造分两种，kv 或 复合数据结构
            if (is_array($item) && isset($item['op'])) {
                $case = $item['op'];

                if ($item['alias']) {
                    $alias  = $prefix.$item['alias'];
                } else {
                    $alias  = $prefix.$field;
                }

                $value       = $item['value'];
                $condition[] = $this->where_in_case($param, $field, $alias, $value, $case);
            } else {
                $place_holder   = $prefix . $field;
                $condition[]    = "`$field` = :$place_holder";
                $param[$place_holder] = $item;
            }

            if (!is_string(current($where)) || !in_array(strtolower(current($where)), $AOI)) {
                $condition[] = 'AND';
            }

        }

        if (in_array(strtolower(end($condition)), $AOI)) {
            $len = count($condition);
            unset($condition[--$len]);
        }

        $sql = join(" ", $condition);
        if ($auto) {
            return "(" . $sql . ")";
        } else {
            return "$sql";
        }
    }


    private function where_pre_process($where) {
        #处理fields，处理condition
        foreach ($where as $field => $item)  {

            //预处理
            if (is_array($item) && !isset($item['op'])) {
                $item =  $this->where_pre_adapter($field, $item);
            }

            //构造分两种，kv 或 复合数据结构
            if (is_array($item) && isset($item['op'])) {
                $case = $item['op'];
                if ($item['alias']) {
                    $alias  = $item['alias'];
                } else {
                    $alias  = $field;
                }

                $field       = $prefix . $field;
                $value       = $item['value'];
                $condition[] = $this->where_in_case($param, $alias, $field, $value, $case);

            } else {
                $place_holder   = $prefix . $field;
                $condition[]   = "`$field` = :$place_holder";
                $param[$place_holder] = $item;
            }

        }

    }

    private function where_pre_adapter($field, $value) {
        if (count($value) == 1) {
            return array(
                    'op'    => '=',
                    'alias' => $field,
                    'value' => join(',', $value),
                    );

        } else {
            return array(
                    'op'    => 'IN',
                    'alias' => $field,
                    'value' => $value,
                    );
        }
    }

    public function where_in_case(&$param, $field, $alias, $value, $case = '=') {
        switch ($case) {
            case 'IN':

                $in_fields = array();
                foreach ($value as $v) {
                    $in_field   = "in_{$field}_$v";
                    $param[$in_field] = $v;
                    $in_fields[] = ":" .$in_field;
                }

                $in_fields = join(',', $in_fields);
                $condition = "`$field` IN ($in_fields)";
                unset($param[$field]);
                break;

            case 'LIKE':

                $param[$field] = "%$value%";
                $condition = "`$field` LIKE :$prifix$field";
                break;

            default:

                $param[$alias] = $value;
                $condition = "`$field` $case :$alias";

        }

        return $condition;
    }


    /*设置查询条件*/
    public function where($where){
        unset($this->sql_struct['where']);
        $this->sql_struct['where'] = $where;
        return $this;
    }

    # 排序
    public function order($order = null){
        if( !$order ) {
            return !empty($this->sql_struct['order']) ? "order by " . $this->sql_struct['order'] : '';
        }
        $this->sql_struct['order'] = $order;
        return $this;
    }

    #
    public function limit($count){
        $this->sql_struct['limit'] = $count;
        return $this;
    }

    public function max_id($max){
        $this->sql_struct['max_id'] = $max;
        return $this;
    }

    public function min_id($min){
        $this->sql_struct['min'] = $min;
        return $this;
    }

    /*
     * 处理字段
     */
    private function parse_fields ($patten, &$fields) {
        $arr = array();
        foreach ($fields as $field) {
            $arr[] =  preg_replace("/\?/",  $field, $patten);
        }
        return $arr;
    }

    /*
     * 获取所有字段
     */
    private function get_all_fields(){
        if (is_array($this->fields)) {
            $this->fields = join(',', $this->fields);
        }
        return "{$this->primary_key},{$this->fields}";
    }

}
