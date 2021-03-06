<?php defined('SYSPATH') or die('No direct script access.');

class Model_Category extends ORM {
    const LEVEL_ROOT = 0;
    const LEVEL_TOP = 1;
    const LEVEL_MID = 2;
    const LEVEL_TAIL = 3;
    
    protected $_table_names_plural = FALSE;

    protected $_belongs_to = array(
        'parent_category' => array(
            'model' => 'category',
            'foreign_key' => 'pid',
        ),
    );

    protected $_has_many = array(
        'sub_categories' => array(
            'model' => 'category',
            'foreign_key' => 'pid',
        ),
        'search_results' => array(
            'model' => 'search',
        ),
    );

    protected $_labels = array(
        'pid' => '父级分类id',
        'parent_name' => '父级分类名字',
        'name' => 'url名字',
        'title' => '网页title',
        'cn' => '中文名字',
        'error' => 'error',
    );

    protected $_rules = array(
        'name' => array(
            'not_empty' => NULL,
            'regex' => array('/^[a-z0-9]+$/'),
        ),
        'cn' => array(
            'not_empty' => NULL,
			'regex' => array('/^[\pL\pN]+$/uD'),
        ),
        'title' => array(
            'not_empty' => NULL,
			'regex' => array('/^[\pL\pN_]+$/uD'),
        ),
    );

    protected $_callbacks = array(
        'name' => 'name_available',
        'cn' => 'cn_available',
    );

    public function __construct($value = NULL)
    {
        $key = $this->unique_key($value);

        if( ! $key)
        {
            parent::__construct();
        }
        elseif(is_array($value))
        {
            parent::__construct($value);
        }
        elseif($this->_primary_key === $key)
        {
            parent::__construct((int) $value);
        }
        else
        {
            parent::__construct(array($key => $value));
        }
    }

    public function unique_key($value = NULL)
    {
        if( ! isset($value))
            return FALSE;

        if(validate::digit($value))
            return 'id';

        return preg_match('~[a-zA-Z]+~', $value) ? 'name' : 'cn';
    }

    public function is_root()
    {
        return (string) self::LEVEL_ROOT === $this->pid;
    }

    public function level()
    {
        if( ! $this->loaded())
            return FALSE;

        if($this->is_root())
            return self::LEVEL_ROOT;

        if($this->parent_category->is_root())
            return self::LEVEL_TOP;

        if( ! $this->has_subcategories()) 
            return self::LEVEL_TAIL;

        return self::LEVEL_MID;
    }

    public function has_subcategories()
    {
        $find = $this->sub_categories->find()->{$this->_primary_key};

        return ! empty($find);
    }

    public function is_tail()
    {
        return ! $this->has_subcategories();
    }

    public function path($field = NULL)
    {
        if( ! $this->loaded())
            return FALSE;

        $path = array();
        $current = $this;

        while( ! $current->is_root())
        {
            array_unshift($path, (isset($field)) ? $current->$field : $current->as_array());
            $current = $current->parent_category;
        }

        return $path;
    }

    public function depth()
    {
        if( ! $this->loaded())
            return FALSE;

        $depth = 0;

        while($category->has_subcategories())
        {
            $depth ++;
            $category = $category->sub_categories->find();
        }

        return $depth;
    }

    public function tree(array &$tree)
    {
        if( ! $this->loaded())
            return FALSE;
            
        if( ! $this->has_subcategories())
        {
            $tree[] = $this->as_array($this->_primary_key);
            return;
        }

        foreach($sub_categories = $this->sub_categories->find_all() as $category)
        {
            $category->tree($tree);
        }
    }

    public function top_categories()
    {
        $ids = DB::Select($this->_primary_key)
            ->from($this->_table_name)
            ->where('pid', '=', self::LEVEL_TOP)
            ->execute($this->_db)
            ->cached()
            ->as_array('id');

        $categories = array();

        foreach($ids as $id => $val)
        {
            $category = new Model_Category($id);
            $categories[] = $category;
        }

        return $categories;
    }

    public function breadcrumbs($in_admin = FALSE)
    {
        $breadcrumbs = $in_admin ? 
            array(HTML::anchor('/category/tree/1', '娱乐')) :
            array(HTML::anchor('http://jiaju.sina.com.cn', '家居首页'), HTML::anchor('/', '娱乐'));

        foreach($path = $this->path() as $row)
        {
            $breadcrumbs[] = $in_admin ?
                sprintf('<a href="/yule/category/tree/%s">%s</a>', $row['id'], $row['cn']) :
                sprintf('<a href="/yule/%s/">%s</a>', $row['name'], $row['cn']);
        }

        return implode(' &gt; ', $breadcrumbs);
    }

    public function create(& $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
            ->label('name', $this->_labels['name'])
            ->label('cn', $this->_labels['cn'])
            ->label('title', $this->_labels['title'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('name', $this->_rules['name'])
            ->rules('cn', $this->_rules['cn'])
            ->rules('title', $this->_rules['title'])
            ->callback('name', array($this, $this->_callbacks['name']))
            ->callback('cn', array($this, $this->_callbacks['cn']));

        $status = FALSE;

        if($array->check())
        {
            $this->name = $array['name'];
            $this->cn = $array['cn'];
            $this->title = $array['title'];
            $this->pid = $this->id;
            $this->id = NULL;
            $this->ct = date('Y-m-d H:i:s');

            if($this->save())
            {
                $status = TRUE;

                if (is_string($redirect))
                {
                    // Redirect after a successful login
                    Request::instance()->redirect($redirect);
                }
            }
            else
            {
                $array->error('error', 'save');
            }
        }

        return $status;
    }

    public function update(& $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
            ->label('name', $this->_labels['name'])
            ->label('cn', $this->_labels['cn'])
            ->label('title', $this->_labels['title'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('name', $this->_rules['name'])
            ->rules('title', $this->_rules['title'])
            ->rules('cn', $this->_rules['cn']);

        $status = $changed = FALSE;

        if($array->check())
        {
            if($this->name !== $array['name'])
            {
                $changed = TRUE;
                $this->name = $array['name'];
            }

            if($this->cn !== $array['cn'])
            {
                $changed = TRUE;
                $this->cn = $array['cn'];
            }

            if($this->title !== $array['title'])
            {
                $changed = TRUE;
                $this->title = $array['title'];
            }

            if( ! $changed)
            {
                $array->error('error', 'no_change');
                return FALSE;
            }

            if($this->save())
            {
                $status = TRUE;

                if(is_string($redirect))
                {
                    Request::instance()->redirect($redirect);
                }
            }
            else
            {
                $array->error('error', 'save');
            }
        }

        return $status;
    }

    public function name_available(Validate $array, $field)
    {
		if ($this->unique_key_exists($array[$field], 'name'))
		{
			$array->error($field, 'exists', array($array[$field]));
		}
    }

    public function cn_available(Validate $array, $field)
    {
		if ($this->unique_key_exists($array[$field], 'cn'))
		{
			$array->error($field, 'exists', array($array[$field]));
		}
    }

    public function parent_exist(Validate $array, $field)
    {
        $exists = (bool) DB::select(array('COUNT("*")', 'total_count'))
            ->from($this->_table_name)
            ->where($this->_primary_key, '=', $array[$field])
            ->execute($this->_db)
            ->get('total_count');

        if( ! $exists)
        {
			$array->error($field, 'not_exists', array($array[$field]));
        }
    }

    public function parent_id()
    {
        return $this->parent_category->id;
    }

	public function unique_key_exists($value, $field = NULL)
	{
		if ($field === NULL)
		{
			// Automatically determine field by looking at the value
			$field = $this->unique_key($value);
		}

		return (bool) DB::select(array('COUNT("*")', 'total_count'))
			->from($this->_table_name)
			->where($field, '=', $value)
			->where($this->_primary_key, '!=', $this->pk())
			->execute($this->_db)
			->get('total_count');
	}

    public function init_table()
    {
        if( ! in_array('title', array_keys($this->_table_columns)))
        {
            echo 'start to alter add title';
            try
            {
                DB::query(1, 'alter table yule_category add title varchar(255) not null default "" after cn')
                    ->execute($this->_db);
            }
            catch(Exception $e)
            {
                echo 'finish alter';
            }
        }

        print_r($this->_table_columns);
    }
}
