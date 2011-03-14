<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cron extends Controller {
    const API_URL = 'http://search.sina.com.cn/?col=1&range=all&c=news&sort=time';
    const MAX_PAGE = 10;

    public function before()
    {
        parent::before();

        if( ! Kohana::$is_cli AND ! Auth::instance()->logged_in()) 
        {
            $this->request->redirect('admin/index');
        }
    }

    public function action_index() 
    {
        set_time_limit(0);

        $value = $this->request->param('name', @ $_REQUEST['name']);
        $category = new Model_Category($value);

        if( ! $category->loaded()) 
        {
            View::set_global('errors', array('name' => '不存在该关键词'));
            $this->request->response = View::factory('cron/add');
            return FALSE;
        }

        if($count = $this->search($category->id, $category->cn))
        {
            $this->request->response = '抓取到该关键词记录数: '.$count;
        }
        else
        {
            $this->request->response = '没有新的关键词记录';
        }
    }

    public function action_add()
    {
        $this->request->response = View::factory('cron/add');
    }

    public function action_fetch_all() 
    {
        $all = ORM::factory('category')->find_all()->as_array();

        if( ! empty($all))
        {
            foreach($all as $data)
            {
                $this->search($data['id'], $data['cn']);
            }
        }

        $this->request->response = 'Finish to fetch all categories';
    }

    private function search($id, $name)
    {
        $count = 0;
        $model_search = new Model_Search;
        $name = mb_convert_encoding($name, 'gbk', 'utf-8');

        $max = min(self::MAX_PAGE, $this->parse_max($name));
        
        for($i = 1; $i <= $max; $i ++)
        {
            $url = strtr(':url&q=:name&page=:page',
                array(
                    ':url' => self::API_URL,
                    ':name' => urlencode($name),
                    ':page' => $i,
                )
            );

            // Fetch from API url
            $content = Remote::get($url, array(
                CURLOPT_CONNECTTIMEOUT => 0,            
                CURLOPT_DNS_CACHE_TIMEOUT => 3600,
                CURLOPT_TIMEOUT => 3600,
            ));

            // Set the max according to the total search results
            $data = $this->parse_content($content);

            if(! $data)
            {
                continue;
            }

            foreach ($data as $doc) 
            {
                $to_insert = array(
                    'category_id' => $id,
                    'url' => $doc['url'],
                    'title' => $doc['title'],
                    'summary' => $doc['summary'],
                    'pub_time' => time(),
                    'ct' => date('Y-m-d H:i:s'),
                );
                $model_search->insert($to_insert) AND $count ++;
            }
        }

        // Log fetch result as info
        Kohana_Log::instance()->add(Kohana::INFO, 'Fetch [:name] on :time success inserted :count', 
                array(':name' => $name, ':time' => date('Y-m-d H:i'), ':count' => $count));

        return $count;
    }

    private function parse_max($name) 
    {
        $url = strtr(':url&q=:name',
            array(
                ':url' => self::API_URL,
                ':name' => urlencode($name),
            )
        );
        // Fetch from API url
        $content = Remote::get($url, array(
            CURLOPT_CONNECTTIMEOUT => 0,            
            CURLOPT_DNS_CACHE_TIMEOUT => 3600,
            CURLOPT_TIMEOUT => 3600,
        ));

        if(preg_match('~<span style="color:#000;">.*?</span>.*?<strong>(.+)</strong>~', $content, $match))
        {
            return ceil((int)str_replace(',', '', $match[1]) / 20);
        }
        
        return 0;
    }

    private function parse_content($content)
    {
        preg_match_all('~<div class="box-result clearfix">(.*?)<p class="fgray">~ims', $content, $match);

        if(empty($match[1]))
        {
            return ;
        }

        $data = array();

        foreach($match[1] as $value)
        {
            $res = preg_match('~<h2><a href="(.*?)".*?>(.*?)</a>.*<p class="content">(.*?)<span~is', $value, $tmp);

            if(empty($res))
                continue;

            $data[] = array(
                'title' => mb_convert_encoding($tmp[2], 'utf-8', 'gbk'),
                'url' => $tmp[1],
                'summary' => mb_convert_encoding($tmp[3], 'utf-8', 'gbk'),
            );
        }

        return $data;
    }
}
