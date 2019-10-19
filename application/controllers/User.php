<?php
/**
 * Created by PhpStorm.
 * User: sheqiangsheng
 * Date: 2019/10/19
 * Time: 13:51
 */
class User extends Api_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取我的信息
     */
    public function get_user_info()
    {
        $uid = $this->get_params("uid", rand(2, 11));
        $this->load->model("Seller_order_model");
        $this->load->model("Needs_model");
        $this->load->model("User_model");

        $user = $this->User_model->get_by_id($uid);
        if (!$user) {
            $this->response_error("用户信息不存在");
        }
        if ($user->type == 2) {
        }
        $user->order_num = $this->Seller_order_model->count_by_where(['sid' => $uid]);
        $user->needs_num = $this->Needs_model->count_by_where(['uid' => $uid]);
        $this->response_success($user);
    }

    public function update_credit()
    {
        $uid = $this->get_params("uid", rand(2, 11));
        $credit = $this->get_params("credit");
        $this->load->model("User_model");

        $user = $this->User_model->get_by_id($uid);
        if (!$user) {
            $this->response_error("用户信息不存在");
        }
        $this->User_model->update_by_where(['id' => $uid], ['credit' => $user->credit + $credit]);
        $this->response_success("更新成功");
    }
}