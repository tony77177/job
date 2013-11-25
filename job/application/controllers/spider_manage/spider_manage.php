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

    private $start = 207900;
    private $end = 207912;
    private $number = 0;//计数
    private $url = NULL;//爬取信息地址
    private $pattern = NULL;//获取信息正则

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
    }

    function index(){
        $this->get_163gz_info();
    }

    function get_info_temp(){
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

                $t = preg_match($regex, $page, $title);
//                preg_match_all($regex4, $str, $matches));
//                $c = preg_match('#<div class="mainContent sep-10">.*</div>#Us', $page, $content);
                if ($t) {
                    $title = trim(strip_tags($title[0]));//去除HTML标签
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


    function get_info($_url,$_pattern){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $url = $_url;
        curl_setopt($ch, CURLOPT_URL, $url);
        $page = curl_exec($ch);

        $regex = "/(<p.*?class=\"STYLE4\".*?>.*?<\/p>)/ism";


        if (curl_getinfo($ch)['http_code'] == 200) {

            preg_match_all ($regex, $page, $content);

//            print_r($content);

            preg_match_all('/(<a.*?>.*?<br.*?\/>)/ism',$content[0][0],$title);

//            print_r($title);

            for($i=0;$i<count($title[0]);$i++){
//                echo strip_tags($title[0][$i]);

//                print_r($title[0][$i]);

                $test = '/<a.*?href="(.*?)".*?>(.*?)<\/a>/i';

                $result = preg_match($test, $title[0][$i], $matches);

//                echo $matches[1];
                $is_auth = strstr($matches[1],'www.163gz.com');//是否为本站，排除广告信息

                if ($is_auth) {

                    $page_dt = file_get_contents($matches[1]);
                    preg_match('/<td.*?align="center".*?valign="middle".*?bgcolor="#F7F7F7".*?class="style16"><div.*?align="left">(.*?) /i', $page_dt, $dt);
//                print_r($dt[1]);

//                echo strip_tags($matches[2])." ".$result." ".$matches[1]."<br>";
                    if ($result) {
                        $title_news = strip_tags($matches[2]);
                        mb_convert_encoding($title_news, "UTF-8", "GBK");
                        $this->number++;
                        $data = array(
                            'title' => mb_convert_encoding($title_news, "UTF-8", "GBK"),
                            'url' => $matches[1],
                            'insert_dt' => $dt[1]
                        );
                        $this->spider_model->save_info($data);
                    }
                }
////                print_r($matches); //为href的值

//                echo "<br>";
            }
        }
        echo "Success , total num is: " . $this->number;
    }

    function get_163gz_info(){
        $this->url = "http://www.163gz.com/js/163.html";
        $this->pattern = "/(<p class=\"STYLE4\">(.*?)</p>)/ism";
        $this->get_info($this->url,$this->pattern);
    }

}

/* End of file spider_manage.php */
/* Location: ./application/controllers/spider_manage/spider_manage..php */