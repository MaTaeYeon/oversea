<?php
/**
 * Created by PhpStorm.
 * User: sheqiangsheng
 * Date: 2019/10/19
 * Time: 10:34
 */
class Seller_order_model extends BB_Model {
    public static $STATUS_NORMAL = 1;
    public static $STATUS_OVERTIME = 2;
    public static $STATUS_FINISHED = 3;
    public static $STATUS_DELETE = -99;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_table_name() {
        return 'seller_order';
    }

}