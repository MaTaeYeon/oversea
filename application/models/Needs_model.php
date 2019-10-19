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

    public function get_by_location($id) {
        if (!is_numeric($id)) {
            return FALSE;
        }

        return $this->execute('SELECT * FROM ' . $this->get_table_name() . ' WHERE `location` = ' . $id);
    }

    public function get_my_needs($uid){
        return $this->execute('SELECT p1.*,p3.name,p3.avatar FROM needs p1 left join seller_order p2 on p1.id= p2.did left join user p3 on p2.sid = p3.id WHERE p1.uid = ' . $uid);
    }

    public function get_by_one($id){
        return $this->execute('SELECT p1.*,p3.name,p3.avatar FROM needs p1 left join seller_order p2 on p1.id= p2.did left join user p3 on p2.uid = p3.id WHERE p1.id = ' . $id);
    }

}