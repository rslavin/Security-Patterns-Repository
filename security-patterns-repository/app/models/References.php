<?php

class References extends Eloquent {


	public static function allReferences()
	{
		$references = DB::table('references')
			->select('title', 'authors', 'short_name', 'year')
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

}
?>
