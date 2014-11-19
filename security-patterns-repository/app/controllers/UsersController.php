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
        $this->layout->content = View::make('users.register')->with('roles', Roles::rolesToArray());

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
            return Redirect::to('/')->with('message', 'Thanks for registering!');
        } else {
            return Redirect::to('/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
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
		UserSelection::addSelection(Auth::user()->id, Input::get('pattern_id'));
		$scenario = UserSelection::getCurrentScenario(AUTH::user()->id);
		if($scenario > 4){
			// if done, change role to "user"
			$user = User::find(Auth::user()->id);
			$user->role = 2;
			$user->save();	
			return Redirect::to("thanks");
		}
		return Redirect::to('/patterns');
		//->with('message', 'Pattern ' . Patterns::getPatternsById(Input::get('pattern_id'))->title . 'selected')
	}

	public function createStudyAccounts(){ 
		$emails =
		"the.bad.guy.mx@gmail.com;marce_a_f@hotmail.com;noremac8807@sbcglobal.net;sfz020@my.utsa.edu;f.alswhaim@gmail.com;vandrada1248@gmail.com;i.baez.g1@gmail.com;cyk617@my.utsa.edu;shadowmoses68@gmail.com;gabygoli@hotmail.com;brandon.bolt1@gmail.com;jbruneault@gmail.com;ivancapistran13@gmail.com;bcot84@gmail.com;droginator@yahoo.com;matteisermann@gmail.com;fajjosh@gmail.com;oscar.falcon@live.com;sey967@my.utsa.edu;bet_gc1991@hotmail.com;mhg197@my.utsa.edu;livingright0206@gmail.com;jharleyj@gmail.com;amski91@gmail.com;rodneycjordan@gmail.com;aaronclewis85@yahoo.com;xop651@my.utsa.edu;Ajmartinez93@live.com;xjj171@my.utsa.edu;jfreezy101@gmail.com;oscarmedina735@hotmail.com;fdf786@my.utsa.edu;jacob.pagano@gmail.com;ritesh.patel@live.com;heatherld@satx.rr.com;m.price83@yahoo.com;jeffreyrizzuto@gmail.com;fhl930@my.utsa.edu;daniel.ruhmkorf@gmail.com;zlj573@my.utsa.edu;Taioblack@gmail.com;ssilvestro@gmail.com;eviveiro@gmail.com;mpdsaiko@gmail.com;fey882@my.utsa.edu";
	$emailsArray = explode(";", $emails); $total = 0;

		foreach($emailsArray as $email){
			$user = new User;
			$user->firstname = "Student";
			$user->lastname = "Participant";
			$user->email = $email;
            $user->password = Hash::make("CS4773study");
			$user->role = 3;
			$user->save();
			$total++;
		}
		return Redirect::to('/')->with('message', $total + ' accounts created');
	}
	
}
?>
