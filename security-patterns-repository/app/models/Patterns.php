<?php

class Patterns extends Eloquent {


	public static function allPatterns()
	{
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description', 
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(9);

		return $patterns;
	}
	public static function getPatternsByType($type)
	{
		
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->where($type.'_type', '=', 'TRUE')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description', 
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(9);


		return $patterns;
	}


}
?>
