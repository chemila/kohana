<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {
    const SUPER_ADMIN_ID = 1;
    const SUPER_ROLE_NAME = 'admin';

    public function is_super()
    {
        $roles = $this->roles->find_all();

		$super_role = ORM::factory('role', array('name' => self::SUPER_ROLE_NAME));

        // If the user doesn't have the role
        return $this->has('roles', $super_role);
    }

    public function is_self()
    {
        return $this->pk() == Auth::instance()->get_user()->pk(); 
    }

    public function create(& $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
			->label('username', $this->_labels['username'])
			->label('email', $this->_labels['email'])
			->label('password', $this->_labels['password'])
			->label('password_confirm', $this->_labels['password_confirm'])
			->filter(TRUE, 'trim')
			->rules('username', $this->_rules['username'])
			->rules('email', $this->_rules['email'])
			->rules('password', $this->_rules['password'])
			->rules('password_confirm', $this->_rules['password_confirm']);

		if ($status = $array->check())
		{
            $this->username = $array['username'];
            $this->email = $array['email'];
			$this->password = $array['password'];
            $this->last_login = time();

			if ($status = $this->save() AND is_string($redirect))
			{
                // Set the default role for the user:: editor
                // TODO: make ORM do it instead
                DB::insert('roles_users')
                    ->columns(array('user_id', 'role_id'))
                    ->values(array($this->pk(), '2'))
                    ->execute($this->_db);

				// Redirect to the success page
				Request::instance()->redirect($redirect);
			}
		}

		return $status;
    }

    public function update( & $array, $redirect = FALSE)
    {
        $array = Validate::factory($array)
			->label('username', $this->_labels['username'])
			->label('email', $this->_labels['email'])
			->filter(TRUE, 'trim')
			->rules('username', $this->_rules['username'])
			->rules('email', $this->_rules['email']);

		if ($status = $array->check())
		{
            $this->username = $array['username'];
            $this->email = $array['email'];

			if ($status = $this->save() AND is_string($redirect))
			{
				// Redirect to the success page
				Request::instance()->redirect($redirect);
			}
		}

		return $status;
    }
} // End User Model
