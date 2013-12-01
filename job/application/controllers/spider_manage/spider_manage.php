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

    private $number = 0;//计数
    private $totalnum = 0;//总数

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->driver('cache');
    }

    function index(){
        $this->get_163gz_info();
//        $this->get_gufe_info('EnterpriseInfo');
//        $this->get_gufe_info('CampusInfo');
//        $this->get_gzu_official_info('lowerJobs');
//        $this->get_gzu_index_info('recruitment/campus');
        $this->get_gzu_campus_info('campus');

        /**
         * 如果读取到数据则清除首页缓存
         */
        if ($this->totalnum > 0) {
            $this->cache->file->delete('cache_info_list');
        }
    }


    /**
     * 获取页面信息
     * @param $_url
     * @return mixed
     */
    function get_page_info($_url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $url = $_url;
        curl_setopt($ch, CURLOPT_URL, $url);
        $page = curl_exec($ch);

        $data = array(
            'page' =>$page,
            'ch' =>$ch
        );
        return $data;
    }

    /**
     *  检测数据是否存在
     * @param $_title
     * @param $_url
     */
    function check_info($_title,$_url){
        $data = array(
            'title' => $_title,
            'url' => $_url
        );
        return $this->spider_model->check_info($data);
    }

    /**
     * 写入数据
     * @param $_title 标题（编码为UTF-8）
     * @param $_url                 URL
     * @param $_insert_dt 时间
     * @param $_from 来源
     */
    function save_info($_title,$_url,$_insert_dt,$_from){

        if($this->check_info($_title,$_url)){
            $data = array(
                'title' => $_title,
                'url' => $_url,
                'insert_dt' => $_insert_dt,
                'from' => $_from
            );
            return $this->spider_model->save_info($data);
        }
    }

    /**
     *  输出结果
     * @param $_from
     */
    function get_result_num($_from){
        echo "<br>Success , total num is: " . $this->number." , from ".$_from."<br>";
    }

    /**
     *  获取 163gz.com 数据
     */
    function get_163gz_info(){
        $url = "http://www.163gz.com/js/163.html";

        $num = 0;//单独计数

        $data = $this->get_page_info($url);

        $page = $data['page'];

        $regex = "/(<p.*?class=\"STYLE4\".*?>.*?<\/p>)/ism";

        if (curl_getinfo($data['ch'])['http_code'] == 200) {

            //获取内容部分信息
            preg_match_all ($regex, $page, $content);

            //进行逐条数据获取
            preg_match_all('/(<a.*?>.*?<br.*?\/>)/ism',$content[0][0],$title);


            for($i=0;$i<count($title[0]);$i++){

                //获取跳转URL和标题名
                $test = '/<a.*?href="(.*?)".*?>(.*?)<\/a>/i';
                $result = preg_match($test, $title[0][$i], $matches);

                //是否为本站，排除广告信息
                $is_auth = strstr($matches[1],'www.163gz.com');

                if ($is_auth) {

                    //访问URL，获取该条数据发布时间
                    $page_dt = file_get_contents($matches[1]);

                    preg_match('/<td.*?align="center".*?valign="middle".*?bgcolor="#F7F7F7".*?class="style16"><div.*?align="left">(.*?) /i', $page_dt, $dt);

                    if ($result) {
                        $title_news = strip_tags($matches[2]);
                        $title_encode = mb_convert_encoding($title_news, "UTF-8", "GBK");//编码转换
                        $save_result = $this->save_info($title_encode,$matches[1],$dt[1],'163gz.com');
                        if (isset($save_result) && $save_result == TRUE) {
                            $num++;
                        }
                    }
                }
            }
        }
        $this->number = $num;//计数
        $this->get_result_num('163gz.com');//输出结果
        $this->totalnum = $this->totalnum + $this->number;//总数
    }

    /**
     * 获取财院数据信息
     * @para $_tag 财院就业信息网根据 cateName 参数来区分是校招新闻还是网络招聘新闻
     *      EnterpriseInfo：网络招聘
     *      CampusInfo：  校园招聘
     */
    function get_gufe_info($_tag){
        $url = "http://sw.gzife.edu.cn:8080/jiuyemis/moreJobs.do?method=moreJobs&cateName=".$_tag;

        $num = 0;//单独计数

        $data = $this->get_page_info($url);

        $page = $data['page'];

        $regex = "/(<table.*?width=\"100%\".*?border=\"0\".*?cellspacing=\"0\".*?cellpadding=\"0\">.*?<\/table>)/ism";

        if (curl_getinfo($data['ch'])['http_code'] == 200) {

            //获取内容部分信息
            preg_match_all ($regex, $page, $content);

            //进行逐条数据获取
            preg_match_all('/(<div.*?id=\"job_list\">.*?<script)/ism',$content[0][0],$title);

            preg_match_all('/(<table.*?width=\"100%\".*?border=\"0\".*?cellspacing=\"0\".*?cellpadding=\"0\">.*?<script)/ism',$title[0][0],$title);

            preg_match_all('/(<table.*?width=\"100%\".*?border=\"0\".*?cellspacing=\"0\".*?cellpadding=\"0\">.*?<script)/ism',$title[0][0],$title);

            preg_match_all('/(<tr>.*?<\/tr>)/ism',$title[0][0],$title);


            for($i=0;$i<count($title[0]);$i++){

                //获取跳转URL和标题名
                $test = '/<a href="(.*?)".*?target="_blank".*?class="news_link".*?title="(.*?)">.*?<td.*?width=\"10%\".*?><span.*?style=\"color:#666666\">(.*?)<\/span>/ism';
                $result = preg_match($test, $title[0][$i], $matches);

                $prefix_url = "http://sw.gzife.edu.cn:8080/jiuyemis/";//URL前缀

                $url_merge = $prefix_url.$matches[1];//合并后的URL
                $title_merge = $matches[2];//标题

                $dt_merge = trim($matches[3]);//时间
                $dt_merge = date("Y-m-d H:i:s",strtotime($dt_merge));//格式化

                //是否为本站，排除广告信息
                $is_auth = strstr($matches[1],'info.do');

                if ($is_auth) {
                    if ($result) {
                        $save_result = $this->save_info($title_merge,$url_merge,$dt_merge,'gufe.edu.cn');
                        if (isset($save_result) && $save_result == TRUE) {
                            $num++;
                        }
                    }
                }
            }
        }
        $this->number = $num;//计数
        $this->get_result_num('gufe.edu.cn');//输出结果
        $this->totalnum = $this->totalnum + $this->number;//总数
    }

    /**
     * 获取贵大首页招聘信息，和财院一样，根据区分参数来区别栏目（此处为获取公考栏目信息）
     * @para $_tag 获取信息参数
     */
    function get_gzu_official_info($_tag){
        $url = "http://jobs.gzu.edu.cn/channels/terminfor/".$_tag;

        $num = 0;//单独计数

        $data = $this->get_page_info($url);

        $page = $data['page'];

        $regex = "/<div.class=\"area-mainList\">.*?<\/ul>/ism";

        if (curl_getinfo($data['ch'])['http_code'] == 200) {

            //获取内容部分信息
            preg_match_all ($regex, $page, $content);

            //进行逐条数据获取
            preg_match_all('/<li>(.*?)<\/li>/ism',$content[0][0],$title);


            for($i=0;$i<count($title[0]);$i++){

                //获取跳转URL和标题名
                $test = '/<a.href="(.*?)".*?>(.*?)<\/a>.*?<div.*?>(.*?)<\/div>/ism';
                $result = preg_match($test, $title[0][$i], $matches);

                $prefix_url = "http://jobs.gzu.edu.cn/";//URL前缀

                $url_merge = $prefix_url.$matches[1];//合并后的URL

                $title_merge = $matches[2];//标题

                $dt_merge = substr($matches[3],1,strlen($matches[3])-2);//时间格式化，因为此处获取时间格式为 [2013-06-21 15:09:07]

                //是否为本站，排除广告信息
                $is_auth = strstr($matches[1],'article');

                if ($is_auth) {
                    if ($result) {
                        $save_result = $this->save_info($title_merge,$url_merge,$dt_merge,'gzu.edu.cn');
                        if (isset($save_result) && $save_result == TRUE) {
                            $num++;
                        }
                    }
                }
            }
        }
        $this->number = $num;//计数
        $this->get_result_num('gzu.edu.cn');//输出结果
        $this->totalnum = $this->totalnum + $this->number;//总数
    }

    /**
     * 获取校招信息
     * @param $_tag 传入栏目参数
     */
    function get_gzu_campus_info($_tag){
        $url = "http://jobs.gzu.edu.cn/recruitment/".$_tag;

        $num = 0;//单独计数

        $data = $this->get_page_info($url);

        $page = $data['page'];

        $regex = "/<div.class=\"area-mainList\">.*?<\/ul>/ism";

        if (curl_getinfo($data['ch'])['http_code'] == 200) {

            //获取内容部分信息
            preg_match_all ($regex, $page, $content);

            //进行逐条数据获取
            preg_match_all('/<li>(.*?)<\/li>/ism',$content[0][0],$title);


            for($i=0;$i<count($title[0]);$i++){

                //获取跳转URL和标题名
                $test = '/<a.href="(.*?)".*?>(.*?)<\/a>.*?<div.style=\"float:right;margin-right:20px;\">(.*?)<\/div>/ism';
                $result = preg_match($test, $title[0][$i], $matches);

                $prefix_url = "http://jobs.gzu.edu.cn";//URL前缀

                $url_merge = $prefix_url.$matches[1];//合并后的URL

                $title_merge = $matches[2];//标题

                $dt_merge = substr($matches[3],1,strlen($matches[3])-2);//时间格式化，因为此处获取时间格式为 [2013-06-21 15:09:07]

                //是否为本站，排除广告信息
                $is_auth = strstr($matches[1],'jobsinfor');

                if ($is_auth) {
                    if ($result) {
                        $save_result = $this->save_info($title_merge,$url_merge,$dt_merge,'gzu.edu.cn');
                        if (isset($save_result) && $save_result == TRUE) {
                            $num++;
                        }
                    }
                }
            }
        }
        $this->number = $num;//计数
        $this->get_result_num('gzu.edu.cn');//输出结果
        $this->totalnum = $this->totalnum + $this->number;//总数
    }

}

/* End of file spider_manage.php */
/* Location: ./application/controllers/spider_manage/spider_manage..php */