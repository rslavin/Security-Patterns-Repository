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
	
	public static function getPatternsCount() {
		$all = DB::table('patterns')
				->count();
		
		$design = DB::table('patterns')
				->where('design_type', '=', 'TRUE')
				->count();
	
		$requirements = DB::table('patterns')
				->where('requirements_type', '=', 'TRUE')
				->count();
				
		$architectural = DB::table('patterns')
				->where('architectural_type', '=', 'TRUE')
				->count();
				
		$implementation = DB::table('patterns')
				->where('implementation_type', '=', 'TRUE')
				->count();
	
		return array('all_count'=>$all,'design_count'=>$design,'requirements_count'=>$requirements,
					'architectural_count'=>$architectural,'implementation_count'=>$implementation);
	}



}
?>
