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
//            print_r($_keywords);exit;
//            $so = scws_new();
//            $so->set_charset('utf-8');
//            // 这里没有调用 set_dict 和 set_rule 系统会自动试调用 ini 中指定路径下的词典和规则文件
//            $so->send_text(trim($this->input->get('keywords')));
//            while ($tmp = $so->get_result())
//            {
//                print_r($tmp);
//            }
//            $so->close();
//            exit;
            $data['keywords'] = trim($this->input->get('keywords'));
            $param = "keywords=".$this->input->get('keywords'); //搜索框关键词

//            $_keywords = $this->get_result($data['keywords']);

            $where = "WHERE title LIKE '%".$data['keywords']."%'";
            $order_by = "ORDER BY REPLACE(title,'".$data['keywords']."',''),";
            foreach($_keywords as $key){
                $where .= " OR title LIKE '%".$key."%'";
                $order_by .= "REPLACE(title,'".$key."',''),";
            }
            $data['_keywords'] = $_keywords;
        }

//        $param = "keywords=".$this->input->get('keywords'); //搜索框关键词
//        $param .= "&page" . $this->input->get('page'); //页数
//        $data['keywords'] = $this->input->get('keywords');


        $data['search_info_list'] = $this->spider_model->get_info_list($offset, $this->per_page,$where);
        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');

        $count = $this->spider_model->get_info_total_num($where); //总条数

        //初始化分页数据
        $config = $this->common_class->getPageConfigInfo('/search/?'.$param, $count, $this->per_page, $this->uri_segment);
        $this->pagination->initialize($config);

        $this->load->view('search', $data);
    }

    function get_result($_keywords){
        require_once(APPPATH.'third_party/word_segment/phpanalysis_class.php');

        $do_fork = $do_unit = $do_multi = true;
        $do_prop = $pri_dict = false;

        $pa = new PhpAnalysis_class('utf-8', 'utf-8', $pri_dict);

        $pa->loadInit = true;

        $pa->LoadDict();

        //执行分词
        $pa->SetSource($_keywords);
        $pa->differMax = $do_multi;
        $pa->unitWord = $do_unit;

        $pa->StartAnalysis( $do_fork );

        $okresult = $pa->GetFinallyResult(' ', $do_prop);
        $subStr = explode(" ", $okresult);
        array_shift($subStr);//去掉第一个空格
        return $subStr;
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */