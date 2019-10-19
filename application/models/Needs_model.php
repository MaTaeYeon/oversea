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

}