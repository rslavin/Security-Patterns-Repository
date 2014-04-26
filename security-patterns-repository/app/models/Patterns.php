<?php

class Patterns extends Eloquent {


	public static function allPatterns()
	{
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description',
                'patterns.mini',
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(9);

		return $patterns;
	}
	
	public static function getPatternsByType($type)
	{
		
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->where($type.'_type', '=', '1')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description',
                'patterns.mini',
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
                'patterns.mini',
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
                'patterns.mini',
				'patterns.title') 
			->orderBy('patterns.title')
			->get();


		return $patterns;
	}
	
	public static function getPatternsCount() {
		$all = DB::table('patterns')
				->count();
		
		$design = DB::table('patterns')
				->where('design_type', '=', '1')
				->count();
	
		$requirements = DB::table('patterns')
				->where('requirements_type', '=', '1')
				->count();
				
		$architectural = DB::table('patterns')
				->where('architectural_type', '=', '1')
				->count();
				
		$implementation = DB::table('patterns')
				->where('implementation_type', '=', '1')
				->count();
				
		$procedural = DB::table('patterns')
				->where('procedural_type', '=', '1')
				->count();
	
		return array('all_count'=>$all,'design_count'=>$design,'requirements_count'=>$requirements,
					'architectural_count'=>$architectural,'implementation_count'=>$implementation,
					'procedural_count'=>$procedural);
	}

	public static function getSearchResults($keywords)
	{
		$keywords = implode('* ~', explode(' ',"+".$keywords."*"));
		/**
		 * returns patterns based on title, description, keywords, and body
		 */

		
		$patterns = DB::table('patterns')
					->join('references', 'patterns.reference_id', '=', 'references.reference_id')
					->select('references.reference_id', 
						'patterns.title', 
						'patterns.description',
						'patterns.mini',
						'references.short_name')
					->whereRaw("MATCH(".
								"`patterns`.`title`,". 
								"`patterns`.`description`,".
								"`patterns`.`keywords`,".
								"`patterns`.`body`) ". 
								"AGAINST(? IN BOOLEAN MODE)", array($keywords))
					->orderBy('patterns.title')
					->paginate(9);

		return $patterns;
	}

}
?>
