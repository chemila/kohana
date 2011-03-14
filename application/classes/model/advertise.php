<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advertise extends ORM {
    protected $_table_names_plural = FALSE;

    protected $_labels = array(
        'description' => '描述',
        'code' => '代码',
        'url' => '链接',
        'error' => '错误：',
    );

    protected $_rules = array(
        'description' => array(
            'not_empty' => NULL,
            'min_length' => array(5),
            'max_length' => array(30),
        ),       
        'code' => array(
            'not_empty' => NULL,
            'min_length' => array(20),
        ),
        'url' => array(
            'url' => NULL,   
        ),
        'id' => array(
            'digit' => NULL,
        ),
    );

    public function create(& $form, $redirect = FALSE)
    {
        $form = Validate::factory($form)
            ->label('description', $this->_labels['description'])
            ->label('code', $this->_labels['code'])
            ->label('url', $this->_labels['url'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('description', $this->_rules['description'])
            ->rules('url', $this->_rules['url'])
            ->rules('code', $this->_rules['code']);

        $status = FALSE;

        if($form->check())
        {
            $this->description = $form['description'];
            $this->code = $form['code'];
            $this->url = $form['url'];
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

    public function update(& $form, $redirect = FALSE)
    {
        $form = Validate::factory($form)
            ->label('description', $this->_labels['description'])
            ->label('code', $this->_labels['code'])
            ->label('url', $this->_labels['url'])
            ->label('error', $this->_labels['error'])
            ->filter(TRUE, 'trim')
            ->rules('description', $this->_rules['description'])
            ->rules('id', $this->_rules['id'])
            ->rules('url', $this->_rules['url'])
            ->rules('code', $this->_rules['code']);

        $status = $changed = FALSE;

        if($form->check())
        {
            if($this->description !== $form['description'])
            {
                $changed = TRUE;
                $this->description = $form['description'];
            }

            if($this->code !== $form['code'])
            {
                $changed = TRUE;
                $this->code = $form['code'];
            }

            if($this->url !== $form['url'])
            {
                $changed = TRUE;
                $this->url = $form['url'];
            }

            if( ! $changed) 
            {
                $form->error('error', 'no_change');
                return FALSE;
            }

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
}

