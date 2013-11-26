<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-11-25
 * Time: 下午2:05
 */

class Spider_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /**
         * 检查数据是否存在
         * @param array $data
         * @return bool
         */
    function check_info($data = array()){
        $title = $data['title'];
        $url = $data['url'];

        $sql = "SELECT COUNT(1) AS num FROM t_info WHERE title='" . $title . "' AND url='" . $url . "'";

        $num = $this->common_model->getTotalNum($sql, 'default');
        if ($num > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
         * 保存数据
         * @param array $data
         * @return mixed
         */
    function save_info($data = array()){

        $title = $data['title'];
        $url = $data['url'];
        $insert_dt = $data['insert_dt'];
        $from = $data['from'];

        $sql = "INSERT INTO t_info(`title`,`url`,`insert_dt`,`from`) VALUES('" . $title . "','" . $url . "','" . $insert_dt . "','" . $from . "')";

        $result = $this->common_model->execQuery($sql, 'default', TRUE);
        return $result;
    }


    /**
         * 获取首页信息
         * @param null $offset
         * @param null $page_size
         * @return mixed
         */
    function get_info_list($offset = NULL, $page_size = NULL) {
//        $sql = "SELECT * FROM 36kr ORDER BY insert_dt DESC LIMIT $offset,$page_size";
        $sql = "SELECT * FROM t_info ORDER BY insert_dt DESC";
        $query = $this->common_model->getDataList($sql, 'default');
        return $query;
    }

}

/* End of file spider_model.php */
/* Location: ./application/models/spider_model.php */