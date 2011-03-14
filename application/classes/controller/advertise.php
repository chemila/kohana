<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Advertise extends Controller {
    protected $object_required_actions = array(
        'edit', 'delete', 'update',       
    );

    public function before()
    {
        parent::before();

        if( ! Auth::instance()->logged_in()) 
        {
            $this->request->redirect('admin/index');
        }

        if(in_array($this->request->action, $this->object_required_actions))
        {
            $this->object_required();
        }
    }

	public function action_index()
	{
        $advs = ORM::factory('advertise')->order_by('id')->find_all();

        $this->request->response = View::factory('advertise/index', array('advs' => $advs));
	}

    public function action_add()
    {
        $this->request->response = View::factory('advertise/add');
    }

    public function action_edit()
    {
        $this->request->response = View::factory('advertise/edit', $this->object->as_array());
    }

    public function action_create()
    {
        $form = array(
            'description' => $_POST['description'],
            'url' => $_POST['url'],
            'code' => $_POST['code'],
        );

        $adv = new Model_Advertise;

        if( ! $adv->create($form, 'advertise/index'))
        {
            View::set_global('errors', $form->errors('advertise'));

            $this->request->response = View::factory('advertise/add', $form->as_array());
        }
    }

    public function action_update()
    {
        $form = array(
            'description' => $_POST['description'],
            'code' => $_POST['code'],
            'url' => $_POST['url'],
            'id' => $_POST['id'],
        );

        if( ! $this->object->update($form, 'advertise/index'))
        {
            View::set_global('errors', $form->errors('advertise'));

            $this->request->response = View::factory('advertise/edit', $form->as_array());
        }
    }

    public function action_delete()
    {
        if($this->object->delete())
        {
            $this->request->redirect('advertise/index');
        }
        
        $this->request->response = 'Delete failed';
    }

    public function object_required()
    {
        $id = $this->request->param('id', $_REQUEST['id']);

        $advertise = new Model_Advertise($id);

        if( ! $advertise->loaded())
        {
            $this->request->action = 'invalid';
            return FALSE;
        }
        
        $this->object = $advertise;
        return TRUE;
    }

    public  function action_invalid()
    {
        $this->request->response = View::factory('404');
    }
} // End Welcome

