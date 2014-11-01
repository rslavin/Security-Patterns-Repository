<?php

class References extends Eloquent {


	public static function allReferences()
	{
		$references = DB::table('references')
			->select('title', 'authors', 'short_name', 'year', 'reference_id')
			->orderBy('year')
			->paginate(10);

		return $references;
	}
	public static function getReference($id)
	{
		$references = DB::table('references')
			->select('title', 'authors', 'short_name', 'year')
			->where('reference_id', '=', $id)
			->paginate(1);

		return $references;
	}
    
    public static function getShortName($id){
		$ref = DB::table('references')
			->select('short_name')
			->where('reference_id', '=', $id)
			->first();
		
		if($ref == null)
			return -1;
		return $ref -> short_name;		
	}

}
?>
