<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 信息操作模型
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 14-1-6
 * Time: 下午2:55
 */

class Info_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /**
     * 记录搜索关键词日志
     * @param $_keywords    关键词
     * @return mixed            TRUE OR FALSE
     */
    function add_log($_keywords){
        $sql = "INSERT INTO t_log(keywords,num) VALUES('" . $_keywords . "',1) ON DUPLICATE KEY UPDATE num=num+1";
        $result = $this->common_model->execQuery($sql, 'default', TRUE);
        return $result;
    }

}

/* End of file info_model.php */
/* Location: ./application/models/info_model.php */