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
        $this->load->model("User_model");
        $seller_order_list = $this->Seller_order_model->list_by_uid_status($uid, $status);
        $dids = $this->result_to_array($seller_order_list, "did");
        $uids = array_merge($this->result_to_array($seller_order_list, "uid"), $this->result_to_array($seller_order_list, "sid"));
        if (empty($dids)) {
            $this->response_success([]);
        }
        $needs_list = $this->Needs_model->list_by_ids($dids);
        if (empty($needs_list)) {
            $this->response_success([]);
        }
        $user_list = $this->User_model->list_by_ids($uids);
        $user_maps = $this->result_to_map($user_list, 'id');
        $seller_order_did_maps = $this->result_to_map($seller_order_list, 'did');
        foreach ($needs_list as &$need) {
            $seller_order = $seller_order_did_maps[$need->id];
            if (isset($user_maps[$seller_order->uid])) {
                $need->user = $user_maps[$seller_order->uid];
            }
            if (isset($user_maps[$seller_order->sid])) {
                $need->seller = $user_maps[$seller_order->sid];
            }
        }
        $this->response_success($needs_list);
    }

    public function accept_needs() {
        $did = $this->get_params("did");
        $uid = $this->get_params('uid');
        $sid = $this->get_params("sid");
        $this->load->model("Seller_order_model");
        $this->load->model("Needs_model");

        $data = array();
        $data['did'] = $did;
        $data['uid'] = $uid;
        $data['sid'] = $sid;
        $this->Needs_model->update_by_where(['id' => $did], ['status' => 1]);
        $result = $this->Seller_order_model->add($data);
        if ($result) {
            $this->response_success(null, "接单成功");
        } else {
            $this->response_success(null, "接单失败");
        }
    }
}