<?php
class Product_model extends BB_Model {
    public static $STATUS_NORMAL = 1;
    public static $STATUS_DELETE = -99;


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_table_name() {
        return 'product';
    }

}