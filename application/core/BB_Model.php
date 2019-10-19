<?php
class BB_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_table_name() {
        return '';
    }

    public function add($data) {
        if (!$data) {
            return FALSE;
        }

        $this->db->insert($this->get_table_name(), $data);
        return $this->db->insert_id();
    }

    public function get_all() {
        return $this->execute('SELECT * FROM ' . $this->get_table_name() . ' order by id desc limit 1000 ');
    }

    public function get_by_id($id) {
        if (!is_numeric($id)) {
            return FALSE;
        }

        return end($this->execute('SELECT * FROM ' . $this->get_table_name() . ' WHERE `id` = ' . $id));
    }

    public function get_by_uid($uid) {
        if (!is_numeric($uid)) {
            return FALSE;
        }

        return end($this->execute('SELECT * FROM ' . $this->get_table_name() . ' WHERE `uid` = ' . $uid));
    }

    public function list_by_ids($ids) {
        if (!is_array($ids)) {
            return FALSE;
        }

        return $this->execute('SELECT * FROM ' . $this->get_table_name() . ' WHERE `id` in(' . implode(',', $ids) . ')');
    }

    public function list_by_uids($uids) {
        if (!is_array($uids)) {
            return FALSE;
        }

        return $this->execute('SELECT * FROM ' . $this->get_table_name() . ' WHERE `uid` in(' . implode(',', $uids) . ')');
    }

    public function list_by_page_where($where, $page, $page_size, $order_by = 'id:desc') {
        $where_sql = empty($where) ? '1' : implode(' AND ', $where);
        $order_by = str_replace(':', ' ', $order_by);
        $offset = ($page - 1) * $page_size;
        $limit = $page_size;
        $table_name = $this->get_table_name();
        $sql = "SELECT * FROM `{$table_name}` WHERE {$where_sql} ORDER BY {$order_by} LIMIT {$offset}, {$limit}";
        return $this->execute($sql);
    }

    public function update_by_where($wheres, $fields) {
        $this->db->where($wheres)->update($this->get_table_name(), $fields);
        return $this->db->affected_rows();
    }

    public function count_by_where($where) {
        $where_sql = empty($where) ? '1' : implode(' AND ', $where);
        $row = end($this->execute('SELECT count(*) as `num` FROM ' . $this->get_table_name() . ' WHERE ' . $where_sql));
        return $row->num;
    }

    public function delete_by_id($id) {
        if (!is_numeric($id)) {
            return FALSE;
        }

        $table_name = $this->get_table_name();
        $this->execute_delete_by_id($table_name, $id);
        return $this->db->affected_rows();
    }
}