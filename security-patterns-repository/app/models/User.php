<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}
	
	/**
	 * Get the rolename for a user.
	 */
	 public function getRolename(){
	 	return Roles::getRole($this->role);
	 }

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
    
    public static $rules = array(
        'firstname'=>'required|alpha_dash|min:2',
        'lastname'=>'required|alpha_dash|min:2',
        'email'=>'required|email|unique:users',
        'password'=>'required|alpha_num|between:6,12|confirmed',
        'password_confirmation'=>'required|alpha_num|between:6,12',
    );
    
    public static $rulesUpdate = array(
        'firstname'=>'required|alpha_dash|min:2',
        'lastname'=>'required|alpha_dash|min:2',
        'email'=>'required|email',
        'password'=>'alpha_num|between:6,12|confirmed',
        'password_confirmation'=>'alpha_num|between:6,12',
    );
    
    public function getRememberToken()
    {
            return $this->remember_token;
    }

    public function setRememberToken($value)
    {
            $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
            return 'remember_token';
    }
}
