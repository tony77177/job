<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 公共方法类
 */
class Common_class {
    public $group_num = 5000000;//每个库UID间距最大值

    function __construct() {
        $CI =& get_instance();
        $this->config = $CI->config;
        $this->load = $CI->load;
    }
    
    /**
     * 分页生成
     * @param string $base_url  当前分页URL
     * @param int $total_rows   数据总条数
     * @param int $per_page     每页显示数据条数
     * @param int $uri_segment  分页方法自动测定你 URI 的哪个部分包含页数
     * @param int $cur_page     当前页码，用于条件查询时初始返回第一页
     * @return mixed            分页信息
     */
    public function getPageConfigInfo($base_url = NULL, $total_rows = 0, $per_page = 0, $uri_segment = 0) {
        $config = array();

        $config['use_page_numbers'] = TRUE;

        $config['enable_query_strings'] = TRUE;

        $config['page_query_string'] = TRUE;

        $config['base_url'] = site_url() . $base_url;
        $config['total_rows'] = $total_rows;

        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;

        $config['full_tag_open'] = "<ul class=\"pagination pull-right\">";
        $config['full_tag_close'] = "</ul>";

        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li> ';

        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li> ';

        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = ' <span class="sr-only">(current)</span></a></li>';
        return $config;
    }

    /**
     * 格式化时间，进行友好显示
     * @param $ptime
     * @return string
     */
    function getFormatTime( $ptime ) {
        $ptime = strtotime($ptime);
        $etime = time() - $ptime;
        if ($etime < 1) return '刚刚';
        $interval = array (
            12 * 30 * 24 * 60 * 60 => '年前 ('.date('Y-m-d', $ptime).')',
            30 * 24 * 60 * 60 => '个月前 ('.date('m-d', $ptime).')',
            7 * 24 * 60 * 60 => '周前 ('.date('m-d', $ptime).')',
            24 * 60 * 60 => '天前',
            60 * 60 => '小时前',
            60 => '分钟前',
            1 => '秒前'
        );
        foreach ($interval as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . $str;
            }
        };
    }


    /**
     * 获取字符串长度
     * @param $str
     * @return int
     */
    function strlen_UTF8($str){
        $len = strlen($str);
        $n = 0;
        for($i = 0; $i < $len; $i++) {
            $x = substr($str, $i, 1);
            $a  = base_convert(ord($x), 10, 2);
            $a = substr('00000000'.$a, -8);
            if (substr($a, 0, 1) == 0) {
            }elseif (substr($a, 0, 3) == 110) {
                $i += 1;
            }elseif (substr($a, 0, 4) == 1110) {
                $i += 2;
            }
            $n++;
        }
        return $n;
    } // End strlen_UTF8;

    /**
     * 截取字符串
     * @param $contents
     * @param $length
     * @return string
     */
    function SubContents($contents, $length = 26){
        $lx = $this->strlen_UTF8($contents);
        //yecho $lx;exit;
        if ($lx > $length) {
            return mb_substr($contents, 0, $length, 'UTF-8') . "...";
        } else {
            return $contents;
        }
    }

    /**
     * @param string $server 服务器地址
     * @param string $curlPost post数据，如：name=toy&age=22
     * @return string 页面返回值
     */
    public function post($server,$curlPost){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 80);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * 获取userdefine内容
     * @param string $key   userdefine键值
     * @return array        数组
     */
    public function getUserConfInfo($key = NULL){
        $this->config->load('user_define', TRUE);
        if (isset($key)) {
            return $this->config->config['user_define'][$key];
        } else {
            return $this->config->config['user_define'];
        }
    }
}
/*End of file Common_class.php*/