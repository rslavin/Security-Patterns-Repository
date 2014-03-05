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
	public static function getPatternsById($id)
	{
		
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->where('patterns.pattern_id', '=', $id)
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description', 
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(1);


		return $patterns;
	}
	public static function getPatternsByReference($id)
	{
		
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->where('patterns.reference_id', '=',$id) 
			->select('references.reference_id', 
				'patterns.pattern_id',
				'patterns.title') 
			->orderBy('patterns.title')
			->get();


		return $patterns;
	}



}
?>
