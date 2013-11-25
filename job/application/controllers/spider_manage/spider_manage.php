<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-11-25
 * Time: 下午1:53
 */

/**
 * Description:
 *      信息获取页面，通过配置相应URL和网站名及相应的正则表达式来获取信息
 */

class Spider_manage extends CI_Controller{

    private $start = 206670;
    private $end = 206670;
    private $number = 0;

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
    }

    function index(){
        $this->get_info();
    }

    function get_info(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        for ($i = $this->start; $i <= $this->end; $i++) {
            $url = "http://www.36kr.com/p/" . $i . ".html";
            curl_setopt($ch, CURLOPT_URL, $url);
            $page = curl_exec($ch);


            $regex = "/(<h1.*?class=\"entry-title sep10\".*?>.*?<\/h1>)/ism";

            $regex4 = "/.*?<h1 class=\"entry-title sep10\">(.*?)<\/h1>.*?/";

            if (curl_getinfo($ch)['http_code'] == 200) {

                $t = preg_match_all($regex, $page, $title);

//                preg_match_all($regex4, $str, $matches));

                var_dump($title);
                print_r($title[1]);
                exit;
//                $c = preg_match('#<div class="mainContent sep-10">.*</div>#Us', $page, $content);
                if ($t) {
                    $title = strip_tags($title[0]);
//                    $content = strip_tags($content[0]);
//                    $content = strip_tags($content[0],'<p><a>');  //保留<p>和<a>标记
//                    echo $url.','.$title."\n";
                    $this->number++;
                    $data = array(
                        'title' => $title,
                        'url' => $url
                    );
                    $this->spider_model->save_info($data);
                }
            }
        }
        echo "Success , total num is: ".$this->number;
    }

}

/* End of file spider_manage.php */
/* Location: ./application/controllers/spider_manage/spider_manage..php */