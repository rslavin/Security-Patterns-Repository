<?php

class UserStudy extends Eloquent {

	public static function allPatterns()
	{
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description',
                'patterns.mini',
                'patterns.pattern_id',
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(9);

		return $patterns;
	}
	
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
		DB::table('user_selections')
		->insert(array('user_id' => $user_id, 'pattern_id' => $pattern_id, 'scenario' => UserStudy::getCurrentScenario($user_id)));
	}
}
?>