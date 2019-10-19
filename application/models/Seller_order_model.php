<?php
/**
 * Created by PhpStorm.
 * User: sheqiangsheng
 * Date: 2019/10/19
 * Time: 10:34
 */
class Seller_order_model extends BB_Model {
    public static $STATUS_ACCEPT = 0;
    public static $STATUS_BEGIN = 1;
    public static $STATUS_OVERTIME = 2;
    public static $STATUS_CANCEL = 2;
    public static $STATUS_FINISHED = 3;
    public static $STATUS_DELETE = -99;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_table_name() {
        return 'seller_order';
    }

    public function list_by_uid_status($uid, $status = 0) {
        if (!is_numeric($uid) || !is_numeric($status)) {
            return array();
        }
        return $this->execute("SELECT * FROM " . $this->get_table_name() . " WHERE `uid` = {$uid}");
    }
}