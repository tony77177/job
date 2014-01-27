<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: TONY
 * Date: 13-11-25
 * Time: 下午8:35
 * 用户定义类，存放爬取信息的配置URL和正则
 */

/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *                 来源网站信息获取配置
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *      采用数组形式，域名对应相应的名称键值
 */
$config['site_list_info'] = array(
    '163gz.com' => '163贵州网',
    'gufe.edu.cn' => '贵州财经大学',
    'gzu.edu.cn' => '贵州大学',
    'gyrc.com.cn' => '贵阳人才网',
    'gznu.edu.cn' => '贵州师范大学'
);

/**
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *             缓存过期时间配置（单位：秒）
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *      index_cache         ： 首页缓存时间
 *      redirect_cache      ： URL跳转缓存
 *      keywords_cache  ： 分词关键字缓存
 */
$config['cache_time'] = array(
    'index_cache' => 2 * 60 * 60,
    'redirect_cache' => 1 * 30 * 24 * 60 * 60,
    'keywords_cache' => 1 * 30 * 24 * 60 * 60
);