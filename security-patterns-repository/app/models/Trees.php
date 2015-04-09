<?php

class Trees extends Eloquent {
    
    protected $primaryKey = 'tree_id';
    
    //Pattern Tree Generation
    public static function getPatternParentsById($id)
	{
		
		$parents = DB::table('trees')
			->where('pattern_id', '=', $id)
			->select('parent_id','pattern_id','required','group','relation_type')
            //->paginate(999);
            ->get();

		return $parents;
	}
    
    public static function getPatternChildrenById($id)
	{
		
		$parents = DB::table('trees')
			->where('parent_id', '=', $id)
			->select('parent_id','pattern_id','required','group','relation_type')
			->paginate(999);

		return $parents;
	}
    
    
	public static function getPatterns()
	{
		
		$pattern = DB::table('patterns')
			->select('title',
				'description',
				'mini',
				'pattern_id',
				'design_type',
				'requirements_type',
				'architectural_type',
				'implementation_type',
				'procedural_type',
				'keywords',
				'body',
				'reference_id',
                'source')
			->paginate(999);

		return $pattern;
	}
    
        //Pattern Tree Generation
    public static function getSiblingByGroup($id)
	{
		
		$parents = DB::table('trees')
			->where('group', '=', $id)
			->select('parent_id','pattern_id','required','group','relation_type')
            //->paginate(999);
            ->get();

		return $parents;
	}
    
     //Pattern Tree Generation
    public static function getOrsById($id)
	{
		
		$parents = DB::table('trees_or')
			->where('parent_id', '=', $id)
			->select('or_id','parent_id','patterns')
            //->paginate(999);
            ->get();

		return $parents;
	}

}
?>
