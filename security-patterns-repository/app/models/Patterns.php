<?php

class Patterns extends Eloquent {

	protected $primaryKey = 'pattern_id';

	public static function allPatterns()
	{
		$patterns = DB::table('patterns')
			->join('references', 'patterns.reference_id', '=', 'references.reference_id')
			->select('references.reference_id', 
				'patterns.title', 
				'patterns.description',
                'patterns.mini',
                'patterns.pattern_id',
                'patterns.source',
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
                'patterns.source',
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
                'patterns.source',
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
                'patterns.source',
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
                'patterns.source',
				'patterns.title') 
			->orderBy('patterns.title')
			->get();


		return $patterns;
	}
	
	public static function updatePattern($id, $description, $keywords) {
		$res = DB::table('patterns')
		->where('pattern_id', $id)
		->update(array('description' => $description, 'keywords' => $keywords));
		
		return $res;
    }

    public static function updatePatternFile($id, $file){
        $ref = Patterns::getRefShortName($id);
        $path = public_path(). "/pattern_source/" .$ref. "/";
        $filename = $id . " - " . $file->getClientOriginalName();

        // make new directory and copy index.php (blank) to it
        if(!File::exists($path)){
            File::makeDirectory($path, $mode = 0775, true, true);
            File::copy(public_path()."/pattern_source/index.php", $path.'/index.php');
        }

        // update database
        if($ref != null){
            DB::table('patterns')
                ->where('pattern_id', $id)
                ->update(array('source' => "/repository/pattern_source/" . $ref . "/" . $filename));
            return $file->move($path, $filename); 
        }
        return -1;
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

    public static function getRefShortName($pattern_id){
        $pattern = Patterns::getSinglePatternById($pattern_id);
        return References::getShortName($pattern->reference_id);
    }

}
?>
