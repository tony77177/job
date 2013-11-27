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
     * 获取当前控制器的url
     * @param string $url   控制器的绝对路径
     * @return string   $url     当前控制器的url
     */
    public function getSiteUrl($url=null){
        //注：2013.11.8，修改为通过 $this->uri->segment(XX)来获取相应段 by zhaoyu
//        if ($url) {
//            $delimiter = "controllers";
//            $url = str_replace(array("\\",".php"), array("/",""), substr($url, strpos($url, $delimiter)+strlen($delimiter)));
//        }
        $url = site_url().$url;
        return $url;
    }

    /**
     * 获取当前控制器的默认页面
     * @param string $url   控制器的绝对路径
     * @return string   $url     当前控制器的url
     */
    public function getDefaultUrl($url=null){
        if ($url) {
            $delimiter = "controllers";
           $url = str_replace(array("\\",".php"), array("/",""), substr($url, strpos($url, $delimiter)+strlen($delimiter)));
        }

        return $url;
    }


    /**
     * 获取当前微妙时间
     * @param string $key   userdefine键值
     * @return array        数组
     */
    public function getMicroTime(){
        return time().substr(microtime(), 2,6);
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
    public function getPageConfigInfo($base_url = null, $total_rows = 0, $per_page = 0, $uri_segment = 0,$offset=0) {
        $config = array();

        if ($offset == 0) {
            $cur_page = 1;
        }

        if(isset($cur_page)){
            $config['cur_page'] = $cur_page;
        }
        
        $config['base_url'] = site_url() . $base_url;
        $config['total_rows'] = $total_rows;

        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;

        $config['full_tag_open'] = "<table width='100%'> <tr  style=\"background-color:#eee;line-height:25px;\" align='right'><td>";
        $config['full_tag_close'] = '</td></tr></table>';

        $config['first_link'] = '首页';
        $config['first_tag_open'] = ' <span class="page_link">[';
        $config['first_tag_close'] = ']</span> ';

        $config['last_link'] = '尾页';
        $config['last_tag_open'] = ' <span class="page_link">[';
        $config['last_tag_close'] = ']</span"> ';

        $config['next_link'] = '下一页';
        $config['next_tag_open'] = ' <span class="page_link">[';
        $config['next_tag_close'] = ']</span"> ';

        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '<span class="page_link">[';
        $config['prev_tag_close'] = ']</span">';

        $config['num_tag_open'] = ' <span class="page_link">[';
        $config['num_tag_close'] = ']</span"> ';

        $config['cur_tag_open'] = ' [<span style="color:red;font-weight:bold;">';
        $config['cur_tag_close'] = '</span>] ';
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
     * 截取字符串
     * @param $contents
     * @param $length
     * @return string
     */
    function SubContents($contents, $length = 35){
        $lx = strlen($contents);
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
}
/*End of file Common_class.php*/