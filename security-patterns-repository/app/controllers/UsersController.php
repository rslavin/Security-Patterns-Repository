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
			return Redirect::to('login')
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
		$this->layout->content = View::make('users.edit')->with('user', User::find($id))->with('roles', Roles::rolesToArray());
	}

    //UPDATE USER INFORMATION
	public function update($id){
    $validator = Validator::make(Input::all(), User::$rulesUpdate);
        if ($validator->passes()) {
            $user = User::find($id);
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
			if(strlen(Input::get('password')) > 0)
            	$user->password = Hash::make(Input::get('password'));
            $user->role = Input::get('role');
            $user->save();
            return Redirect::to('admin/users')->with('message', 'Updated!');
        } else {
            return Redirect::to('admin/users/edit/' . $id)->withErrors($validator)->withInput(Input::except('password'));
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
	
	/* USER STUDY FUNCTIONS */
	
	// add a new selection for a scenario
	public function addPatternSelection(){
		UserStudy::addSelection(Auth::user()->id, Input::get('pattern_id'));
		return Redirect::to('/patterns');
		//->with('message', 'Pattern ' . Patterns::getPatternsById(Input::get('pattern_id'))->title . 'selected')
	}

}
?>