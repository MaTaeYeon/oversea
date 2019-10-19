<?php
/**
 * Created by PhpStorm.
 * User: sheqiangsheng
 * Date: 2019/10/19
 * Time: 10:56
 */
class Seller extends Api_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_my_order(){
        $uid = $this->get_params("uid");
        $status = $this->get_params("status", 0);
        $this->load->model("Seller_order_model");
        $this->load->model("Needs_model");
        $seller_order_list = $this->Seller_order_model->list_by_uid_status($uid, $status);
        $dids = $this->result_to_array($seller_order_list, "did");
        $this->Nee
        $this->response_success($seller_order_list);
    }

}