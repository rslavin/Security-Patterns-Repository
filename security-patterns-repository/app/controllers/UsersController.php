<?php
 
class UsersController extends \BaseController {
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
    
    //REGISTRATION LOGIC
  
    public function getRegister() {
        $this->layout->content = View::make('users.register');
    }
    
    public function postCreate() {
   
      $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->passes()) {
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->role = Input::get('role');
            $user->save();
            return Redirect::to('users/login')->with('message', 'Thanks for registering!');
        } else {
            return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }     
    }
    
    //SHOW LIST OF USERS
    public function getIndex() {
    
        $user = User::all();
		$this->layout->content = View::make('users.index')->with('user', $user);
		
	}
    
    public function show($id)
	{
		
		$user = Users::find($id);

		// show the view and pass the nerd to it
		 $this->layout->content = View::make('users.show')
			->with('user', $user);
	}
    
    //SAVE USER
    public function store(){
		
	}
    
    //EDIT USER INFORMATION
    public function edit($id){
		// get User
		$user = User::find($id);
		$this->layout->content = View::make('users.edit')->with('user', $user);
	}

    //UPDATE USER INFORMATION
	public function update($id){
    $validator = Validator::make(Input::all(), User::$rulesUpdate);
        if ($validator->passes()) {
            $user = User::find($id);
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->role = Input::get('role');
            $user->save();
            return Redirect::to('users/index')->with('message', 'Updated!');
        } else {
            return Redirect::to('users/edit/' . $id)->withErrors($validator)->withInput(Input::except('password'));
        }    
		
	}

    //REMOVE USER INFORMATION
	public function destroy($id){
		
		$user = User::find($id);
		$user->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the nerd!');
		return Redirect::to('users/index');
	}

}
?>