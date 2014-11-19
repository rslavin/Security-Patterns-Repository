<?php

class UserSelection extends Eloquent {

	protected $fillable = array('user_id', 'pattern_id', 'scenario');

	// returns integer value of current scenario. Use this for the button.
	public static function getCurrentScenario($user_id){
		$scenario = DB::table('user_selections')
		->select('scenario')
		->where('user_id', '=', $user_id)
		->orderBy('scenario', 'desc')
		->first();
		
		if($scenario == null)
			return 1;
		return $scenario->scenario + 1;
	}
	
	// inserts a user's selection
	public static function addSelection($user_id, $pattern_id){
		$selection = UserSelection::create(array('user_id' => $user_id, 'pattern_id' => $pattern_id, 'scenario' => UserSelection::getCurrentScenario($user_id)));
	}
}
?>
