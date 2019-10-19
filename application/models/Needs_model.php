<?php
/**
 * Created by PhpStorm.
 * User: huimiao
 * Date: 2019/10/19
 * Time: 10:57 AM
 */
class Needs_model extends BB_Model {


    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_table_name() {
        return 'needs';
    }

}