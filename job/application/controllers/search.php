<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-12-3
 * Time: 下午3:34
 */

class Search extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->library('common_class');
        $this->load->driver('cache');
    }

    /**
     * Index
     */
    public function index(){
        $_keyword = $this->input->get('keywords');
        echo $_keyword;
    }

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */