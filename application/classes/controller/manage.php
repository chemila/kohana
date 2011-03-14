<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manage extends Controller {
    protected $object_required_actions = array('edit', 'delete', 'update');

    public function before()
    {
        parent::before();

        if( ! Auth::instance()->logged_in()) 
        {
            $this->request->redirect('admin/login');
        }

        if(in_array($this->request->action, $this->object_required_actions))
        {
            $this->object_required();
        }
    }

    public function action_index()
    {
        $type = $this->request->param('type', @$_GET['type']);
        $keyword = @$_GET['keyword'];
        $page = max(1, (int) @$_GET['page']);

        $misc = new Model_Misc;

        if( isset($type) AND in_array($type, array_keys(Kohana::message('options', 'misc'))))
        {
            $misc->where('type', '=', $type);
        }

        if( ! empty($keyword))
        {
            $misc->where('title', 'like', '%'.$keyword.'%');
        }

        $rows = $misc->order_by('ut', 'desc')
            ->limit(20)
            ->offset(($page-1) * 20)
            ->find_all()
            ->as_array();
        
        $total = $misc->count_last_query();
        View::set_global('total', $total);

        $this->request->response = View::factory('manage/index', array(
            'rows' => $rows,
            'type' => $type,
            'keyword' => $keyword,
        ));
    }

    public function action_add_focus()
    {
        $this->request->response = View::factory('manage/index_focus_add');
    }

    public function action_add_bagua()
    {
        $this->request->response = View::factory('manage/index_bagua_add');
    }

    public function action_add_wujixian()
    {
        $this->request->response = View::factory('manage/index_wujixian_add');
    }

    public function action_add_section()
    {
        $this->request->response = View::factory('manage/index_section_add');
    }

    public function action_add_tuiguang()
    {
        $this->request->response = View::factory('manage/tuiguang_add');
    }

    public function action_create_index_focus()
    {
        for($i = 0 ; $i < 5; $i ++)
        {
            $misc = new Model_Misc;

            $form = array(
                'code' => $_POST['code'][$i],       
                'url' => $_POST['url'][$i],       
                'tag' => $_POST['tag'][$i],       
                'title' => $_POST['title'][$i],       
                'type' => 'focus',
            );

            if( ! $misc->create($form))
            {
                View::set_global('errors', $form->errors('misc'));
                $this->request->response = View::factory('manage/index_focus_add', $form->as_array());
                return FALSE;
            }
        }

        $this->request->redirect('manage/index/focus');
    }

    public function action_create_index_bagua()
    {
        $form = array(
            'type' => 'bagua',
            'title' => $_POST['title'],
            'summary' => $_POST['summary'],
            'url' => $_POST['url'],
        );

        $misc = new Model_Misc;

        if( ! $misc->create($form, 'manage/index/bagua'))
        {
            View::set_global('errors', $form->errors('misc'));
            $this->request->response = View::factory('manage/index_bagua_add', $form->as_array());
        }
    }
    
    public function action_create_index_wujixian()
    {
        $form = array(
            'type' => 'wujixian',
            'title' => $_POST['title'],
            'url' => $_POST['url'],
            'code' => $_POST['code'],
        );

        $misc = new Model_Misc;

        if( ! $misc->create($form, 'manage/index/wujixian'))
        {
            View::set_global('errors', $form->errors('misc'));
            $this->request->response = View::factory('manage/index_wujixian_add', $form->as_array());
        }
    }

    public function action_create_section()
    {
        $form = array(
            'type' => 'section',
            'title' => $_POST['title'],
            'url' => $_POST['url'],
            'tag' => $_POST['tag'],
        );

        $misc = new Model_Misc;

        if( ! $misc->create($form, 'manage/index/section'))
        {
            View::set_global('errors', $form->errors('misc'));
            $this->request->response = View::factory('manage/index_section_add', $form->as_array());
        }
    }

    public function action_create_tuiguang()
    {
        $form = array(
            'type' => 'tuiguang',
            'title' => $_POST['title'],
            'url' => $_POST['url'],
            'code' => $_POST['code'],
        );

        // Tag image if code exists
        $form['tag'] = empty($form['code']) ? 0 : 1;

        $misc = new Model_Misc;

        if( ! $misc->create($form, 'manage/index/tuiguang'))
        {
            View::set_global('errors', $form->errors('misc'));
            $this->request->response = View::factory('manage/tuiguang_add', $form->as_array());
        }
    }

    public function action_edit()
    {
        $this->request->response = View::factory('manage/edit', $this->object->as_array());
    }

    public function action_update()
    {
        $form = array(
            'title' => $_POST['title'],
            'code' => @$_POST['code'],
            'url' => @$_POST['url'],
            'summary' => @$_POST['summary'],
            'tage' => @$_POST['tag'],
            'type' => $this->object->type,
        );

        if( ! $this->object->update($form, 'manage/index'))
        {
            View::set_global('errors', $form->errors('manage'));
            View::set_global('id', $this->object->id);
            $this->request->response = View::factory('manage/edit', $form->as_array());
        }
    }

    public function action_delete()
    {
        if($this->object->delete())
        {
            $this->request->redirect('manage/index');
        }
        
        $this->redirect->response = 'Delete failed';
    }

    public function object_required()
    {
        $id = @$_REQUEST['id'];

        $misc = new Model_Misc($id);

        if( ! $misc->loaded())
        {
            $this->request->action = 'invalid';
            return FALSE;
        }
        
        $this->object = $misc;
        return TRUE;
    }

    public  function action_invalid()
    {
        $this->request->response = View::factory('404');
    }
}
