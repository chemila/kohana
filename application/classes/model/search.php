<?php defined('SYSPATH') or die('No direct script access.');
class Model_Search extends ORM {
    protected $_table_names_plural = FALSE;

    const STATUS_AUTO = 0;
    const STATUS_MANUAL = 1;
    const STATUS_UP = 2;

    protected $_belongs_to = array(
        'category' => array(
            'model' => 'category',
        ),       
    );	

    protected $_labels = array(
        'title' => '标题',
        'category_name' => '所属分类名',
        'summary' => '内容摘要',
        'url' => '内容链接',
        'picurl' => '图片链接',
        'error' => '错误',
    );

    protected $_rules = array(
        'title' => array(
            'min_length' => array(10),
            'max_length' => array(50),
            'not_empty' => NULL,
        ),
        'summary' => array(
            'min_length' => array(30),
            'not_empty' => NULL,
        ),
        'url' => array(
            'not_empty' => NULL,
            'url' => NULL,               
        ),
        'picurl' => array(
            'url' => NULL,   
        ),
    );

    protected $_callbacks = array(
        'category_name' => 'category_exist',         
        'title' => 'unique_category_title',
    );

    public function insert($data)
    {
        try
        {
            return DB::insert($this->_table_name)
                ->columns(array_keys($data))
                ->values(array_values($data))
                ->execute($this->_db);
        }
        catch(Database_Exception $e)
        {
            // Maybe because of the duplicated key 
            return FALSE;
        }
    }

    public function as_array()
    {
        $array = parent::as_array();

        $category_name = $this->category->name;

        return array_merge($array, array('category_name' => $category_name));
    }

    public function create(& $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
            ->label('title', $this->_labels['title'])
            ->label('summary', $this->_labels['summary'])
            ->label('error', $this->_labels['error'])
            ->label('url', $this->_labels['url'])
            ->label('picurl', $this->_labels['picurl'])
            ->label('category_name', $this->_labels['category_name'])
            ->filter(TRUE, 'trim')
            ->rules('title', $this->_rules['title'])
            ->rules('summary', $this->_rules['summary'])
            ->rules('url', $this->_rules['url'])
            ->rules('picurl', $this->_rules['picurl'])
            ->callback('category_name', array($this, $this->_callbacks['category_name']))
            ->callback('title', array($this, $this->_callbacks['title']));

        $status = FALSE;

        if($array->check())
        {
            $this->title = $array['title'];
            $this->summary = $array['summary'];
            $this->ct = date('Y-m-d H:i:s');
            $this->url = $array['url'];
            $this->picurl = $array['picurl'];
            $this->status = self::STATUS_MANUAL;

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
            ->label('title', $this->_labels['title'])
            ->label('summary', $this->_labels['summary'])
            ->label('error', $this->_labels['error'])
            ->label('url', $this->_labels['url'])
            ->label('picurl', $this->_labels['picurl'])
            ->label('category_name', $this->_labels['category_name'])
            ->filter(TRUE, 'trim')
            ->rules('title', $this->_rules['title'])
            ->rules('summary', $this->_rules['summary'])
            ->rules('url', $this->_rules['url'])
            ->rules('picurl', $this->_rules['picurl'])
            ->callback('category_name', array($this, $this->_callbacks['category_name']))
            ->callback('title', array($this, $this->_callbacks['title']));

        $status = FALSE;

        if($array->check())
        {
            $this->title = $array['title'];
            $this->summary = $array['summary'];
            $this->url = $array['url'];
            $this->picurl = $array['picurl'];
            $this->status = self::STATUS_MANUAL;

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

    public function category_exist(Validate $array, $field) 
    {
        $category = new Model_Category($array[$field]);

        if( ! $category->loaded())
        {
			$array->error($field, 'not_exists', array($array[$field]));
        }
        else
        {
            $this->category_id = $category->pk();
        }
    }

    public function unique_category_title(Validate $array, $field)
    {
        $exists = (bool) DB::select(array('COUNT("*")', 'total_count'))
            ->from($this->_table_name)
            ->where('title', '=', $array['title'])
            ->where('category_id', '=', $this->category_id)
			->where($this->_primary_key, '!=', $this->pk())
            ->execute($this->_db)
            ->get('total_count');

        if($exists)
        {
			$array->error($field, 'duplicated', array($array[$field]));
        }
    }
}
