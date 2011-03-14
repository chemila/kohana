<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Category extends Controller {
    protected $admin_action = array('add', 'update', 'edit', 'create', 'tree', 'delete', 'fetch');

    public function before()
	{
        parent::before();

        // Set root as default
        $value = $this->request->param('name', 1);

        $this->category  = new Model_Category($value);

        if( ! $this->category->loaded())
        {
            // Invalid data
            $this->request->action = '404';
            return FALSE;
        }

        View::set_global('category', $this->category);
        View::set_global('action', $this->request->action);

        // Admin required actions
        if(in_array($this->request->action, $this->admin_action))
        {
            $this->admin_required();
            
            // Breadcrumbs diff between admin or else
            View::set_global('breadcrumbs', $this->breadcrumbs(TRUE));
        }
        else
        {
            $this->top_categories = $this->category->top_categories();

            View::set_global('title', $this->get_title());
            View::set_global('breadcrumbs', $this->breadcrumbs());
            View::set_global('top_categories', $this->top_categories);
            View::set_global('sub_categories', $this->category->sub_categories->limit(10)->find_all());
        }
    }

    public function action_index()
	{
        $results = $this->category->search_results
            ->order_by('status', 'desc')
            ->order_by('ut', 'desc')
            ->limit(200)
            ->find_all()
            ->as_array();

        $advs = Model::factory('advertise')
            ->order_by('id')
            ->limit(5)
            ->find_all()
            ->as_array();
        $sections = Model::factory('misc')
            ->where('type', '=', 'section')
            ->where('tag', '=', 0)
            ->order_by('id')
            ->limit(40)
            ->find_all()
            ->as_array();
        $wujixians = Model::factory('misc')
           ->where('type', '=', 'wujixian')
           ->order_by('id')
           ->limit(12)
           ->find_all()
           ->as_array();
        $focus_rows = Model::factory('misc')
           ->where('type', '=', 'focus')
           ->order_by('tag')
           ->order_by('ut', 'desc')
           ->limit(5)
           ->find_all()
           ->as_array();
        $tuiguang_images = Model::factory('misc')
           ->where('type', '=', 'tuiguang')
           ->where('tag', '=', '1')
           ->order_by('ut', 'desc')
           ->limit(20)
           ->find_all()
           ->as_array();
        $tuiguang_links = Model::factory('misc')
           ->where('type', '=', 'tuiguang')
           ->where('tag', '=', '0')
           ->order_by('ut', 'desc')
           ->limit(60)
           ->find_all()
           ->as_array();


        View::bind_global('results', $results);
        View::set_global('advs', $advs);
        View::set_global('sections', $sections);
        View::set_global('wujixians', $wujixians);
        View::set_global('focus_rows', $focus_rows);
        View::set_global('tuiguang_images', $tuiguang_images);
        View::set_global('tuiguang_links', $tuiguang_links);

        $this->request->response = View::factory('index');
	}

    public function action_show()
    {
        $page = $this->request->param('page', 1);
        $limit = ($page == 1) ? 200 : 100;

        $results = $this->category->search_results
            ->order_by('status', 'desc')
            ->order_by('ut', 'desc')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->find_all()
            ->as_array();

        $total = $this->category->count_last_query();
        $advs = Model::factory('advertise')
            ->order_by('id')
            ->limit(5)
            ->find_all()
            ->as_array();
        $sections = Model::factory('misc')
            ->where('type', '=', 'section')
            ->where('tag', '=', 1)
            ->order_by('id')
            ->limit(40)
            ->find_all()
            ->as_array();
        $tuiguang_images = Model::factory('misc')
           ->where('type', '=', 'tuiguang')
           ->where('tag', '=', '1')
           ->order_by('ut', 'desc')
           ->limit(20)
           ->offset(($page - 1) * 20)
           ->find_all()
           ->as_array();
        $tuiguang_links = Model::factory('misc')
           ->where('type', '=', 'tuiguang')
           ->where('tag', '=', '0')
           ->order_by('ut', 'desc')
           ->limit(60)
           ->offset(($page - 1) * 60)
           ->find_all()
           ->as_array();


        View::bind_global('results', $results);
        View::bind_global('advs', $advs);
        View::bind_global('sections', $sections);
        View::bind_global('tuiguang_images', $tuiguang_images);
        View::bind_global('tuiguang_links', $tuiguang_links);

        $this->request->response = View::factory('show', array(
            'total' => $total,
            'cur_page' => $page,
        ));
    }

    public function action_top()
    {
        if($this->category->level() === Model_Category::LEVEL_TOP)
        {
            $head_categories = $this->category->sub_categories->find_all();
        }
        else
        {
            $head_categories = array($this->category);
        }

        $advs = Model::factory('advertise')->order_by('id')->find_all()->as_array();
        View::bind_global('advs', $advs);

        $this->request->response = View::factory('top', array('head_categories' => $head_categories));
    }

    public function action_tree()
    {
        $this->admin_required();

        $page = max((int) @$_GET['page'], 1);

        $sub_categories = $this->category
            ->sub_categories
            ->limit(20)
            ->offset(($page-1) * 20)
            ->find_all();

        $total = $this->category->sub_categories->count_all();
        View::set_global('total', $total);

        $this->request->response = View::factory('category/list', array(
            'categories' => $sub_categories,
        ));
    }

    public function action_edit()
    {
        $this->request->response = View::factory('category/edit');
    }

    public function action_update()
    {
        $form = array(
            'pid' => $_POST['pid'],
            'name' => $_POST['name'],
            'cn' => $_POST['cn'],
            'title' => $_POST['title'],
        );
        
        if( ! $this->category->update($form, 'category/tree/'.$this->category->parent_id()))
        {
            View::set_global('errors', $form->errors('category'));

            $this->request->response = View::factory('category/edit', $form->as_array());
        }
    }

    public function action_create()
    {
        $form = array(
            'name' => $_POST['name'],
            'cn' => $_POST['cn'],
            'title' => $_POST['title'],
        );

        if( ! $this->category->create($form, 'category/tree/'.$this->category->id))
        {
            View::set_global('errors', $form->errors('category'));

            $this->request->response = View::factory('category/add', $form->as_array());
        }
    }

    public function action_add()
    {
        $this->request->response = View::factory('category/add');
    }

    public function action_delete()
    {
        // Cant delele category that has subcategories
        if($this->category->has_subcategories())
        {
            // Response faile info
            $this->request->response = View::factory('error', array(
                'message' => '该分类有子分类，无法删除',            
            ));
        }
        else
        {
            if($this->category->delete())
            {
                // Delete successfully
                // Delete search results as well
                $this->request->redirect('category/tree');
            }
            else
            {
                // Failed
                $this->request->response = View::factory('error', array(
                    'message' => '删除失败',            
                ));
            }
        }
    }

    public function action_fetch()
    {
        $this->request->redirect('cron/index/'.$this->category->id);        
    }

    protected function breadcrumbs($in_admin = FALSE)
    {
        return 'top' === $this->request->controller ? 
            $this->category->breadcrumbs().' &gt; '.  
                HTML::anchor('top/index/'.$this->category->name, $this->category->cn.'排行榜') :
            $this->category->breadcrumbs($in_admin);
    }

    protected function admin_required()
    {
        if( ! Auth::instance()->logged_in()) 
        {
            $this->request->redirect('admin/index');
            return FALSE;
        }

        return TRUE;
    }

    public function action_404()
    {
        $this->request->response = View::factory('404');
    }

    public function get_title()
    {
        if(1 == $this->request->param('page', 1))
        {
            return sprintf('【%s】首页_%s_新浪家居网', $this->category->cn, $this->category->title);
        }
        else
        {
            return sprintf('【%s】第%d页_新浪家居网', $this->category->cn, $this->request->param('page'));
        }
    }
} // End Welcome
