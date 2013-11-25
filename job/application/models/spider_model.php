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
         * 保存数据
         * @param array $data
         * @return mixed
         */
    function save_info($data = array()){

        $title = $data['title'];
        $url = $data['url'];
        $insert_dt = $data['insert_dt'];

        $sql = "INSERT INTO t_info(title,url,insert_dt) VALUES('" . $title . "','" . $url . "','".$insert_dt."')";

        $this->common_model->execQuery($sql, 'default',TRUE);
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