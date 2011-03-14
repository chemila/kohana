<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		$this->request->response = 'hey u!';
	}

    public function action_admin()
    {
        $user = Auth::instance()->get_user();

        $this->request->response = '你好，'.$user->username.'，你上次登录时间是：'.date('Y-m-d H:i:s', $user->last_login);
    }

} // End Welcome
