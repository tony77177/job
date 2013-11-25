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
     * 获取userdefine内容
     * @param string $key   userdefine键值
     * @return array        数组    
     */
    public function getUserConfInfo($key=null){
        $this->config->load('userdefine', true);
        if ($key) {
            return $this->config->config['userdefine'][$key];
        }else{
            return $this->config->config['userdefine'];
        }
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
     * 金币操作变化原因
     * @param int $no   操作reason值
     * @return string   操作原因
     */
    public function getGradeChangeReason($no) {
        switch ($no) {
            case '0':
                return "用户升级";
                break;
            case '1':
                return "APP购买";
                break;
            case '2':
                return "随机摇取金币";
                break;
            case '3':
                return "系统赠送,首次注册";
                break;
            case '4':
                return "系统每日赠送";
                break;
            case '5':
                return "赠送礼物(花费的是购买金币)";
                break;
            case '6':
                return "礼物";
                break;
            case '7':
                return "被关注";
                break;
            case '8':
                return "被取消关注";
                break;
            case '9':
                return "冻结积分";
                break;
            case '10':
                return "兑换积分成功";
                break;
            case '11':
                return "兑换积分失败,恢复用户冻结积分";
                break;
            case '12':
                return "顶帖子";
                break;
            case '13':
                return "支付宝";
                break;
            case '14':
                return "赠送礼物(花费的是赠送金币)";
                break;
            case '15':
                return "兑换金币";
                break;
            case '16':
                return "玩野球拳(花费的是购买金币)";
                break;
            case '17':
                return "玩野球拳(花费的是赠送金币)";
                break;
            case '18':
                return "野球拳";
                break;
            case '19':
                return "人工操作";
                break;
            default :
                return "暂无定义";
                break;
        }
    }


    /**
     * 根据UID获取用户所属库
     * @param string $uid
     * @return 相应库名
     */
    public function getUserGroup($uid){
        $result = (int)($uid/$this->group_num);
        if($result==0){
            return 'db_blog';
        }else{
            return 'db_blog'.++$result;
        }
    }
    
    /**
     * 根据UID获取用户信息
     * @param string $uid   用户ID
     * @param bool $flag    显示单一信息还是数组的标志
     * @return mixed        用户信息
     */
    public function getUserInfo($uid, $flag = TRUE) {
        //通过IWS获取用户信息和金豆值
        $user_info_url = PPWS_URL . '?json={"op_type":"1026","user_id":"' . $uid . '","auth_key":"' . md5(AUTH_KEY) . '"}';
        $rst = file_get_contents($user_info_url);
        $rst = json_decode($rst);

        if (is_object($rst->user_info)) {
            $user_name   = $rst->user_info->user_name;                     //用户昵称
            $grade_value = $rst->user_info->grade_value;                    //金豆总数
            //$freeze_grade_value = $rst->user_info->freeze_grade_value; //冻结金豆数
            //$current_grade_value = $grade_num - $freeze_grade_value;    //当前可用金豆数
        }else{
            $user_name   = null;
            $grade_value = 0;
        }
        $user_info = array("user_name" => $user_name, "grade_value" => intval($grade_value));
        if ($flag == TRUE) {
            return $user_info;
        } else {
            return $user_name;
        }
    }
    
    /**
     * 根据UID获取用户银行账户信息
     * @param string $uid       用户ID
     * @return mixed            结果集
     */
    public function getUserBankInfo($uid){
        $sql = "SELECT * FROM v_user_sign_bank_info WHERE user_id='".$uid."'";
        $this->db_admin = $this->load->database('db_admin',TRUE);
        $query = $this->db_admin->query($sql);
        return $query->row();
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

    public function getAdminLevel(){
        return $this->config->config['userdefine']['admin_level'];
    }

    // 获取分页每页记录条数
    public function getPerPage(){
        $this->config->load('userdefine', true);
        $config = $this->config->config['userdefine'];

        if ($config['per_page']) {
            return $config['per_page'];
        }else{
            return 15;
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