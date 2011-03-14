<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller {
    protected $_super_required_actions = array('list', 'add', 'delete', 'edit', 'update', 'create');
    protected $_user_required_actions = array('edit', 'delete', 'update', 'info', 'change');

    public function before()
    {
        if( ! $this->check())
        {
            $this->request->action = 'login';
        }

        if(in_array($this->request->action, $this->_super_required_actions))
        {
            $this->super_admin_required();
        }

        if(in_array($this->request->action, $this->_user_required_actions))
        {
            $this->user_required();
        }

        return parent::before();
    }

    public function action_index()
    {
        $this->request->response = View::factory('admin/index');
    }

    public function action_login()
    {
        $username = '';

        if($user = Auth::instance()->get_user())
        {
            $username = $user->username;
        }

        $this->request->response = View::factory('admin/login', array('username' => $username));
    }

    public function action_authenticate()
    {
        $form = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'remember' => (bool) @$_POST['remember'],
        );

        if( ! Model::factory('user')->login($form, 'admin/index'))
        {
            View::set_global('errors', $form->errors('admin'));
            $this->request->response = View::factory('admin/login', $form->as_array());
        }
    }

    public function action_logout() 
    {
        Auth::instance()->logout();

        $this->request->redirect('admin/index');
    }

    public function action_menu()
    {
        $setting = Kohana::config('menu');

        $menu = new Menu;
        $menu->current = '/admin';
        $menu->target = 'main';
        $menu->id = 'main-nav';

        foreach($setting as $controller => $item) 
        {
            if( ! is_array($item['actions']))
            {
                $item['actions'] = array($item['actions']);
            }
            
            $children = new Menu;
            foreach($item['actions'] as $action => $value)
            {
                $children->add(HTML::anchor($controller.'/'.$action, $value['title'], array('target' => 'main')));
            }

            $default_action = isset($item['default']['action']) ? $item['default']['action'] : 'index';
            $menu->add(HTML::anchor($controller.'/'.$default_action, $item['title'], array('target' => 'main')), $children);

        }

        $this->request->response = View::factory('admin/menu', array('menu' => $menu->render()));
    }

    public function action_user()
    {
        $user = Auth::instance()->get_user();

        $this->request->response = View::factory('admin/user', $user->as_array());
    }

    protected function check()
    {
        // Skip these actions
        if(in_array($this->request->action, array('login', 'logout', 'authenticate', 'reset_super')))
            return TRUE;

        return Auth::instance()->logged_in();
    }

    public function action_list()
    {
        $this->super_admin_required();

        $users = ORM::factory('user')->order_by('id')->find_all();

        $this->request->response = View::factory('user/index', array('users' => $users));
    }

    public function action_add()
    {
        $this->request->response = View::factory('user/add');
    }

    public function action_create()
    {
        $form = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
        );

        $user = new Model_User;

        if( ! $user->create($form, 'admin/list'))
        {
            View::set_global('errors', $form->errors('admin'));

            $this->request->response = View::factory('user/add', $form->as_array());
        }
    }

    public function action_edit()
    {
        $this->request->response = View::factory('user/edit', $this->user->as_array());
    }

    public function action_info()
    {
        $this->request->response = View::factory('user/info', $this->user->as_array());
    }

    public function action_change()
    {    
        $form = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        );

        if( ! $this->user->update($form, 'admin/list'))
        {
            View::set_global('errors', $form->errors('admin'));
            $this->request->response = View::factory('user/info', $form->as_array());
        }
    }

    public function action_update()
    {
        $form = array(
            'id' => $_POST['id'],
            'old_password' => $_POST['old_password'],
            'password' => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
        );

        if( ! Auth::instance()->check_password($form['old_password']))
        {
            View::set_global('errors', array('old_password' => '旧密码不正确'));
            $this->request->response = View::factory('user/edit', $form);
            return;
        }

        if( ! $this->user->change_password($form))
        {
            View::set_global('errors', $form->errors('admin'));
            $this->request->response = View::factory('user/edit', $form->as_array());
        }
        else
        {
            $this->request->response = '密码修改成功';
        }
    }

    public function action_delete()
    {
        if( ! $this->user->is_super() AND $this->user->delete())
        {
            $this->request->redirect('admin/list');
        }
        else
        {
            $this->request->response = 'Delete user failed';
        }

    }

    protected function super_admin_required()
    {
        $user = Auth::instance()->get_user();

        if( ! $user->is_super())
        {
            $this->request->action = 'forbidden';
            return FALSE;
        }

        return TRUE;
    }

    protected function user_required()
    {
        $id = $this->request->param('id', $_REQUEST['id']);

        $user = new Model_User($id);

        if( ! $user->loaded())
        {
            $this->request->action = 'invalid';
            return FALSE;
        }
        
        $this->user = $user;
        return TRUE;
    }

    public function action_forbidden()
    {
        $this->request->response = View::factory('forbidden');
    }

    public  function action_invalid()
    {
        $this->request->response = View::factory('404');
    }

    public function action_reset_super()
    {
        $user = new Model_User(1);
        $password = 'lejuyule';

        $user->password = $password;
        $user->save();

        $this->request->response = $password;
    }
}   
