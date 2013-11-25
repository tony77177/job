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

        $sql = "INSERT INTO 36kr(title,url) VALUES('" . $title . "','" . $url . "')";

        $query = $this->common_model->getDataList($sql, 'default');
        return $query;
    }


    /**
         * 获取首页信息
         * @param null $offset
         * @param null $page_size
         * @return mixed
         */
    function get_info_list($offset = NULL, $page_size = NULL) {
        $sql = "SELECT * FROM 36kr ORDER BY id DESC LIMIT $offset,$page_size";
        $query = $this->common_model->getDataList($sql, 'default');
        return $query;
    }

}

/* End of file spider_model.php */
/* Location: ./application/models/spider_model.php */