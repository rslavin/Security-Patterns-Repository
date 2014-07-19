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
                'patterns.pattern_id',
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
                'patterns.pattern_id',
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
                'patterns.pattern_id',
				'references.short_name')
			->orderBy('patterns.title')
			->paginate(1);


		return $patterns;
	}

	public static function getSinglePatternById($id)
	{
		
		$pattern = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->where('patterns.pattern_id', '=', $id)
			->select('patterns.title',
				'patterns.description',
				'patterns.mini',
				'patterns.pattern_id',
				'patterns.design_type',
				'patterns.requirements_type',
				'patterns.architectural_type',
				'patterns.implementation_type',
				'patterns.procedural_type',
				'patterns.keywords',
				'patterns.body',
				'patterns.reference_id',
				'references.short_name')
			->first();

		return $pattern;
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
	
	public static function updatePattern($id, $description) {
		$res = DB::table('patterns')
		->where('pattern_id', $id)
		->update(array('description' => $description));
		
		return $res;
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
                		'patterns.pattern_id',
						'references.short_name',
					DB::raw(" MATCH(`patterns`.`title`) AGAINST('?' IN BOOLEAN MODE) AS rel1", array($keywords)),
					DB::raw(" MATCH(`patterns`.`description`) AGAINST('?' IN BOOLEAN MODE) AS rel2", array($keywords)),
					DB::raw(" MATCH(`patterns`.`keywords`) AGAINST('?' IN BOOLEAN MODE) AS rel3", array($keywords)))
					->whereRaw("MATCH(".
								"`patterns`.`title`,".
								"`patterns`.`description`,". 
								"`patterns`.`keywords`) ". 
								"AGAINST(? IN BOOLEAN MODE)", array($keywords))
					->orderBy('rel1')
					->orderBy('rel2')
					->orderBy('rel3')
					
					->paginate(9);

		return $patterns;
	}

}
?>
