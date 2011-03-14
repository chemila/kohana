<?php defined('SYSPATH') or die('No direct script access.');
class Model_Misc extends ORM {
    protected $_table_names_plural = FALSE;

    protected $_labels = array(
        'code' => '源代码',
        'url' => '链接地址',
        'type' => '类型',
        'tag' => '标记',
        'title' => '标题',
        'summary' => '概要',
        'error' => '错误',
    );

    protected $_rules = array(
        'url' => array(
            'url' => NULL,
        ),       
        'title' => array(
            'not_empty' => NULL,
            'min_length' => array(2),
        ),
        'summary' => array(
            'min_length' => array(5),
        ),
        'type' => array(
            'not_empty' => NULL,
            'alpha' => NULL,
        ),
        'tag' => array(
            'digit' => NULL,   
        ),
        'code' => array(
            'min_length' => array(10),
        ),
    );

    public function create( & $form, $redirect = FALSE)
    {
        $form = Validate::factory($form)
            ->label('code', $this->_labels['code'])
            ->label('url', $this->_labels['url'])
            ->label('title', $this->_labels['title'])
            ->label('summary', $this->_labels['summary'])
            ->label('type', $this->_labels['type'])
            ->label('tag', $this->_labels['tag'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('title', $this->_rules['title'])
            ->rules('summary', $this->_rules['summary'])
            ->rules('url', $this->_rules['url'])
            ->rules('type', $this->_rules['type'])
            ->rules('tag', $this->_rules['tag'])
            ->rules('code', $this->_rules['code']);

        $status = FALSE;

        if($form->check())
        {
            $this->title = $form['title'];
            $this->code = $form['code'];
            $this->url = $form['url'];
            $this->summary = $form['summary'];
            $this->type = $form['type'];
            $this->tag = $form['tag'];
            $this->ct = time();

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
                $form->error('error', 'save');
            }
        }

        return $status;
    }

    public function update( & $form, $redirect = FALSE)
    {
        $form = Validate::factory($form)
            ->label('code', $this->_labels['code'])
            ->label('url', $this->_labels['url'])
            ->label('title', $this->_labels['title'])
            ->label('summary', $this->_labels['summary'])
            ->label('type', $this->_labels['type'])
            ->label('tag', $this->_labels['tag'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('title', $this->_rules['title'])
            ->rules('summary', $this->_rules['summary'])
            ->rules('url', $this->_rules['url'])
            ->rules('type', $this->_rules['type'])
            ->rules('tag', $this->_rules['tag'])
            ->rules('code', $this->_rules['code']);

        $status = FALSE;

        if($form->check())
        {
            $this->title = $form['title'];
            $this->code = $form['code'];
            $this->url = $form['url'];
            $this->summary = $form['summary'];
            $this->type = $form['type'];
            $this->tag = $form['tag'];

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
                $form->error('error', 'save');
            }
        }

        return $status;
    }
}

