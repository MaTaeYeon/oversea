<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 * @property Product_model Product_model
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

    function result_to_map($result, $field = 'id') {
        $map = array();
        if (!$result || !is_array($result)) {
            return $map;
        }

        foreach ($result as $entry) {
            if (is_array($entry)) {
                $map[$entry[$field]] = $entry;
            } else {
                $map[$entry->$field] = $entry;
            }
        }
        return $map;
    }

    function result_to_array($result, $field = 'id') {
        $ary = array();
        if (!$result || !is_array($result)) {
            return $ary;
        }

        foreach ($result as $entry) {
            if (is_array($entry)) {
                $ary[] = $entry[$field];
            } else if (is_object($entry)) {
                $ary[] = $entry->$field;
            }
        }
        return $ary;
    }

    function get_params($name) {
        $value = $this->input->get($name);
        return $value;
    }

    function post_params($name) {
        $value = $this->input->post($name);
        return $value;
    }

    function get_page_pagesize($page_size = 10) {
        $page = $this->get_params('page');
        if (empty($page)) {
            return [1, $page_size];
        }

        return [$page, $page_size];
    }

    function response_list($convert_data, $count = 10, $message = "", $code = 0) {
        $data = [];
        $data['code'] = $code;
        $data['msg'] = $message;
        $data['count'] = $count;
        $data['data'] = $convert_data;
        echo json_encode($data);
        exit();
    }

    function response_json($data, $success = FALSE, $message = "") {
        $obj = new stdClass();
        $obj->success = $success;
        $obj->message = $message;
        $obj->data = $data;
        echo json_encode($data);
        exit();
    }

    function response_success($data, $message = "") {
        $obj = new stdClass();
        $obj->success = TRUE;
        $obj->message = $message;
        $obj->data = $data;
        echo json_encode($data);
        exit();
    }

    function response_error($message = "", $data = []) {
        $obj = new stdClass();
        $obj->success = FALSE;
        $obj->message = $message;
        $obj->data = $data;
        echo json_encode($data);
        exit();
    }
}
