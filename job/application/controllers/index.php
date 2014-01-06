<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: zhaoyu
 * Date: 13-11-25
 * Time: 下午2:26
 */


class Index extends CI_Controller {

    /**
     * 获取信息页面，初步方案每隔2小时获取一次数据
     */

    private $index_cache_time = 0;//首页信息缓存时间
    private $redirect_cache_time = 0;//跳转URL缓存时间

    function __construct(){
        parent::__construct();

        $this->load->model('spider_model');
        $this->load->library('common_class');
        $this->load->driver('cache');

        //设置缓存配置时间
        $cache_time = $this->common_class->getUserConfInfo('cache_time');
        $this->index_cache_time = $cache_time['index_cache'];
        $this->redirect_cache_time = $cache_time['redirect_cache'];
    }

    /**
     * Index
     */
    public function index()
    {
        //存放缓存，如果存在直接使用；否则重新读取数据
        if (!$this->cache->file->get('cache_info_list')) {
            $data['info_list'] = $this->spider_model->get_info_list(0, 50);
            $this->cache->file->save('cache_info_list', $data['info_list'], $this->index_cache_time);
        } else {
            $data['info_list'] = $this->cache->file->get('cache_info_list');
        }

        $data['from_src'] = $this->common_class->getUserConfInfo('site_list_info');
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
                redirect('/index');
            }
            $this->cache->file->save('cache_url_' . $_id, $url, $this->redirect_cache_time);
        } else {
            $url = $this->cache->file->get('cache_url_' . $_id);
        }

        $this->spider_model->update_info($_id); //更新点击量

        redirect(htmlspecialchars_decode($url)); //将HTML标签转义

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

/* End of file index.php */
/* Location: ./application/controllers/index.php */