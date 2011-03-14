<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller {
    protected $object_required_actions = array(
        'edit', 'delete', 'update',       
    );

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
        $page = max(1, (int) @$_GET['page']);
        
        $search = new Model_Search;

        $results = $search->order_by('status', 'desc')
            ->order_by('ut', 'desc')
            ->limit(20)
            ->offset(($page - 1) * 20)
            ->find_all()
            ->as_array();

        $total = $search->count_all();
        View::set_global('total', $total);

        $this->request->response = View::factory('search/index', array(
            'results' => $results,
        ));
    }

    public function action_add()
    {
        $this->request->response = View::factory('search/add');
    }

    public function action_create()
    {
        $form = array(
            'category_name' => $_POST['category_name'],
            'title' => $_POST['title'],
            'summary' => $_POST['summary'],
            'url' => $_POST['url'],
            'picurl' => $_POST['picurl'],
        );

        $search = new Model_Search;

        if( ! $search->create($form, 'search/index'))
        {
            View::set_global('errors', $form->errors('search'));
            $this->request->response = View::factory('search/add', $form->as_array());
        }
    }

    public function action_edit()
    {
        $this->request->response = View::factory('search/edit', $this->object->as_array());
    }

    public function action_update()
    {
        $form = array(
            'category_name' => $_POST['category_name'],
            'title' => $_POST['title'],
            'summary' => $_POST['summary'],
            'url' => $_POST['url'],
            'picurl' => $_POST['picurl'],
        );

        if( ! $this->object->update($form, 'search/index'))
        {
            View::set_global('errors', $form->errors('search'));

            $this->request->response = View::factory('search/edit', 
                array_merge($form->as_array(), array('id' => $this->object->id)));
        }
    }

    public function action_delete()
    {
        if($this->object->delete())
        {
            $this->request->redirect('search/index');
        }
        else
        {
            $this->request->response = 'Delete failed';
        }
    }

    protected function object_required()
    {
        $id = $this->request->param('id', $_REQUEST['id']);

        $search = new Model_Search($id);

        if( ! $search->loaded())
        {
            $this->request->action = 'invalid';
            return FALSE;
        }
        
        $this->object = $search;
        return TRUE;
    }

    public  function action_invalid()
    {
        $this->request->response = View::factory('404');
    }
}
