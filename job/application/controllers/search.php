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
    private $keywords_cache_time = 0;//分词结果缓存时间

    function __construct(){
        parent::__construct();

        $this->load->model(array('spider_model','info_model'));
        $this->load->library(array('common_class', 'pagination'));
        $this->load->driver('cache');
//        $this->load->model('info_model');

        //设置缓存配置时间
        $cache_time = $this->common_class->getUserConfInfo('cache_time');
        $this->keywords_cache_time = $cache_time['keywords_cache'];
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

        if ($this->input->get('keywords')) {
            $keywords = trim($this->input->get('keywords'));

            $_keywords = array(); //分词结果

            if (!$this->cache->file->get(md5($keywords))) {

                //通过API获取分词结果
                $url = "http://www.xunsearch.com/scws/api.php";
                $data = array(
                    'data' => $keywords,
                    'respond' => "json"
                );

                $result = $this->common_class->post($url, $data);
                $result = json_decode($result);

                if ($result->status == 'ok') {
                    for ($i = 0; $i < count($result->words); $i++) {
                        $_keywords[$i] = $result->words[$i]->word;
                    }
                }
                $this->cache->file->save(md5($keywords), $_keywords, $this->keywords_cache_time);
            } else {
                $_keywords = $this->cache->file->get(md5($keywords));

                //此处判断考虑出于当用户点击下一页时这种情况，排除掉
                if ($offset == 0) {
                    $this->info_model->add_log($keywords); //记录搜索日志，当二次搜索的时候
                }
            }

            $data['keywords'] = $keywords;
            $param = "keywords=".$keywords; //搜索框关键词

            $where = "WHERE title LIKE '%".$keywords."%'";
            $order_by = "ORDER BY REPLACE(title,'".$keywords."',''),";

            foreach($_keywords as $key){
                $where .= " OR title LIKE '%".$key."%'";
                $order_by .= "REPLACE(title,'".$key."',''),";
            }
            $data['_keywords'] = $_keywords;//分词结果用于前台结果标红处理
        }

        $data['search_info_list'] = $this->spider_model->get_info_list($offset, $this->per_page,$where);
        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');

        $count = $this->spider_model->get_info_total_num($where); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/search/?'.$param, $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('search', $data);
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */