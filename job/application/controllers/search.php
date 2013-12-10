<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-12-3
 * Time: 下午3:34
 */

class Search extends CI_Controller{

    private $per_page = 15; //每页显示数据条数
    private $uri_segment = 2; //分页方法自动测定你 URI 的哪个部分包含页数

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->library('common_class');
        $this->load->library('pagination');
//        $this->load->driver('cache');
    }

    /**
     * Index
     */
    public function index(){
        $param = ""; //分页参数
        $data['keywords'] = "";
        $where = "";

        $offset = 0; //偏移量

        if ($this->input->get('page')) {
            $offset = (int)$this->input->get('page') - 1;
        }

        $param = "keywords=".$this->input->get('keywords'); //搜索框关键词
        $param .= "&page" . $this->input->get('page'); //页数
        $data['keywords'] = $this->input->get('keywords');


        $data['search_info_list'] = $this->spider_model->get_info_list($offset, $this->per_page);
        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');

        $count = $this->spider_model->get_info_total_num($where); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/search/', $count, $this->per_page, $this->uri_segment, $param);
        $this->pagination->initialize($config);

        $this->load->view('search', $data);
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */