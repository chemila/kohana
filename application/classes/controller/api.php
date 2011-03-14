<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller {

	public function action_sem()
	{
        $form = array(
            'name' => $_GET['name'],       
            'sex' => $_GET['sex'],
            'qq' => @$_GET['qq'],
            'tel' => $_GET['tel'],
            'email' => $_GET['email'],
            'note' => @$_GET['note'],
        );

        try
        {

            Email::connect();

            $result = Email::send(
                array(
                    'to' => 'zhangxin@leju.sina.com.cn', 
                    'cc' => 'cuitian@leju.sina.com.cn',
                ),
                'ileju@sina.com',
                'SEM报名',
                $this->generate_body($form)
            );

            if($result)
            {
                $this->request->response = View::factory('api/sem', array('result' => 'success'));
            }
        }
        catch(Exception $e) 
        {
            die($e->getMessage());
        } 
    }

	public function action_seo()
	{
        $form = array(
            'name' => $_GET['name'],       
            'sex' => $_GET['sex'],
            'qq' => @$_GET['qq'],
            'tel' => $_GET['tel'],
            'email' => $_GET['email'],
            'note' => @$_GET['note'],
        );

        try
        {

            Email::connect();

            $result = Email::send(
                array(
                    'to' => 'zhangxin@leju.sina.com.cn', 
                    'cc' => 'fengshuai@leju.sina.com.cn',
                ),
                'ileju@sina.com',
                'SEO报名',
                $this->generate_body($form)
            );

            if($result)
            {
                $this->request->response = View::factory('api/sem', array('result' => 'success'));
            }
        }
        catch(Exception $e) 
        {
            die($e->getMessage());
        } 
    }

    private function generate_body($form)
    {
        $content = sprintf('姓名:%s, 性别:%s, 电话:%s, 电子邮件:%s, QQ:%s, 个人说明:%s',
                urldecode($form['name']), urldecode($form['sex']),
                $form['tel'], $form['email'], $form['qq'], 
                urldecode($form['note'])
        );

        return $content;
    }
} // End Welcome
