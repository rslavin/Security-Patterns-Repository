<?php
 
class UsersController extends BaseController {
    protected $layout = "layouts.default";

	public function __construct() {
    	$this->beforeFilter('csrf', array('on'=>'post'));
    	$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getLogin() {
    	$this->layout->content = View::make('users.login')->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	
	public function postLogin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('patterns')->with('message', 'You are now logged in!');
		} else {
			return Redirect::to('users/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::back();
	}
}
?>