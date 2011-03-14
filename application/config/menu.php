<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'manage' => array(
        'title' => '首页管理',
        'actions' => array(
            'index' => array('title' => '所有杂项列表'),   
            'add_focus' => array('title' => '添加焦点图'),   
            'add_bagua' => array('title' => '添加娱乐八卦'),   
            'add_wujixian' => array('title' => '添加娱乐无极限'),   
            'add_section' => array('title' => '添加区块文字链'),   
            'add_tuiguang' => array('title' => '添加右侧推广'),   
        ),
        'default' => array('action' => 'index'),
    ),
    'cron' => array(
        'title' => '任务计划',
        'actions' => array(
            'add' => array('title' => '抓取关键词'),   
            'fetch_all' => array('title' => '抓取所有'),   
        ),
        'default' => array('action' => 'index'),
    ),
    'category' => array(
        'title' => '分类管理',
        'actions' => array(
            'tree' => array('title' => '分类列表'),
            'add' => array('title' => '添加分类'),
            'edit/1' => array('title' => '修改根分类'),
        ),
        'default' => array('action' => 'tree'),
    ),
    'search' => array(
        'title' => '搜索管理',
        'actions' => array(
            'index' => array('title' => '搜索结果列表'),
            'add' => array('title' => '添加搜索结果'),
        ),
    ),
    'advertise' => array(
        'title' => '广告管理',
        'actions' => array(
            'index' => array('title' => '广告列表'),
            'add' => array('title' => '添加广告'),   
        ),
    ),
    'admin' => array(
        'title' => '用户管理',
        'actions' => array(
            'list' => array('title' => '用户列表'),
            'add' => array('title' => '添加用户'),
        ),
    ),
);

