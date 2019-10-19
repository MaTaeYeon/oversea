<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller {

    public static $IMAGE_UPLOAD_PATH = '/uploads/';

    public function __construct() {
        parent::__construct();
    }

	public function upload() {
        $config['upload_path']      = '.' . self::$IMAGE_UPLOAD_PATH;
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_ext_tolower']    = true;
        $config['encrypt_name']    = true;
        $config['max_size']     = 2048;
        $config['max_width']        = 4096;
        $config['max_height']       = 4096;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->response_error($this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file_path = $data['upload_data']['file_path'];
            $file_name = $data['upload_data']['file_name'];
            $this->response_success(['src' => self::$IMAGE_UPLOAD_PATH . $file_name, 'title' => $file_name]);
        }
    }


}
