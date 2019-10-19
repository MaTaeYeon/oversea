<?php
/**
 * Created by PhpStorm.
 * User: huimiao
 * Date: 2019/10/19
 * Time: 10:32 AM
 */
class Needs extends Api_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function post_need(){
        $data["title"] = $this->post_params("title","标题");
        $data["location"] = $this->post_params("location",0);
        $data["channel"] = $this->post_params("channel",0);
        $data["need_invoice"] = $this->post_params("need_invoice",0);
        $data["postage_commitment"] = $this->post_params("postage_commitment",0);
        $data["closing_date"] = $this->post_params("closing_date",0);
        $data["price"] = $this->post_params("price",100);
        $data["des"] = $this->post_params("des","描述");
        $data["pic"] = $this->post_params("pic","");
        $data["spec"] = $this->post_params("spec","");

        $this->load->model("Needs_model");
        $ret = $this->Needs_model->add($data);
        $this->response_success($ret);

    }

    public function get_one(){
        $id = $this->get_params("id");
        $this->load->model("Needs_model");
        $ret = $this->Needs_model->get_by_id($id);
        $this->response_success($ret);
    }

    /**
     * 需求列表
     */
    public function get_all(){
        $this->load->model("Needs_model");
        $ret = $this->Needs_model->get_all();
        $this->response_success($ret);
    }

    /**
     * 搜索
     */
    public function search(){
        $location = $this->get_params("location");
        $this->load->model("Needs_model");
        $ret = $this->Needs_model->get_by_location($location);
        $this->response_success($ret);
    }

}