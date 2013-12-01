<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-11-25
 * Time: 下午2:26
 */


class Index extends CI_Controller {

    /**
     * 获取信息页面，初步方案每隔5分钟获取一次数据
     */

    function __construct()
    {
        parent::__construct();
        $this->load->model('spider_model');
        $this->load->library('common_class');
        $this->load->driver('cache');
    }

    /**
         * Index
         */
    public function index()
    {
        //存放缓存，如果存在直接使用；否则重新读取数据
        if (!$this->cache->file->get('cache_info_list')) {
            $data['info_list'] = $this->spider_model->get_info_list(0, 100);
            $this->cache->file->save('cache_info_list', $data['info_list'], 7200);
        } else {
            $data['info_list'] = $this->cache->file->get('cache_info_list');
        }
        $this->load->view('index', $data);
    }

    /**
     * 跳转界面
     * @param $_id
     */
    public function redirect($_id){
        if (!isset($_id)) {
            redirect('index');
        }

        if (!$this->cache->file->get('cache_url_' . $_id)) {
            $url = $this->spider_model->get_url($_id);
            if (!isset($url)) {
                redirect('index');
            }
            $this->cache->file->save('cache_url_' . $_id, $url, 7200);
        } else {
            $url = $this->cache->file->get('cache_url_' . $_id);
        }

        $this->spider_model->update_info($_id);//更新点击量

        redirect($url);
    }

    /**
     * 清除缓存
     */
    public function clear_up(){
        if($this->cache->file->delete('cache_info_list')){
            echo "缓存清除成功";
        }else{
            echo "缓存清除失败";
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */