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
    }

    /**
     * Index
     */
    public function index(){
        $param = ""; //分页参数
        $data['keywords'] = "";//搜索关键词
        $data['_keywords'] = "";
        $where = "WHERE 1=1";//条件查询

        $offset = 0; //偏移量

        if ($this->input->get('per_page')) {
            $offset = ((int)$this->input->get('per_page') - 1) * $this->per_page;//计算偏移量
        }

        if($this->input->get('keywords')){
            //通过API获取分词结果
            $url = "http://www.xunsearch.com/scws/api.php";
            $data = array(
                'data' => trim($this->input->get('keywords')),
                'respond' => "json"
            );
            $result = $this->common_class->post($url,$data);
            $result = json_decode($result);
            $_keywords = array();
            if ($result->status == 'ok') {
                for ($i = 0; $i < count($result->words); $i++) {
                    $_keywords[$i] = $result->words[$i]->word;
                }
            }

            $data['keywords'] = trim($this->input->get('keywords'));
            $param = "keywords=".$this->input->get('keywords'); //搜索框关键词

            $where = "WHERE title LIKE '%".$data['keywords']."%'";
            $order_by = "ORDER BY REPLACE(title,'".$data['keywords']."',''),";
            foreach($_keywords as $key){
                $where .= " OR title LIKE '%".$key."%'";
                $order_by .= "REPLACE(title,'".$key."',''),";
            }
            $data['_keywords'] = $_keywords;
        }

        $data['search_info_list'] = $this->spider_model->get_info_list($offset, $this->per_page,$where);
        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');

        $count = $this->spider_model->get_info_total_num($where); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/search/?'.$param, $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);

        $this->load->view('search', $data);
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */