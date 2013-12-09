<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-12-3
 * Time: 下午3:34
 */

class Search extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->library('common_class');
        $this->load->library('pagination');
        $this->load->driver('cache');
    }

    /**
     * Index
     */
    public function index(){
        $_keyword = $this->input->get('filter_key');
        echo $_keyword;
        $data['keywords'] = $_keyword;
        $data['search_info_list'] = $this->spider_model->get_info_list(0, 20);
        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');

        $test = "filter_key=手机&site=1&page";

        $config = $this->common_class->getPageConfigInfo('/search/',4000,20,4,$test);

        $this->pagination->initialize($config);

        $this->load->view('search',$data);
    }

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */