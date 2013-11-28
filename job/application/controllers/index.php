<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-11-25
 * Time: 下午2:26
 */


class Index extends CI_Controller {

    /**
     * 获取信息页面，初步方案每隔5分钟获取一次数据
     */

    function __construct()
    {
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->library('common_class');
    }

    /**
         * Index
         */
    public function index()
    {
//        $this->output->cache(5);//进行缓存
        $data['info_list'] = $this->spider_model->get_info_list(0,15);
        $this->load->view('index', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */