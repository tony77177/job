<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 关于页面控制器
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-6
 * Time: 下午5:05
 */

class About extends CI_Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('about');
    }
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */