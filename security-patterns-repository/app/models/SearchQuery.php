<?php

class SearchQuery extends Eloquent {

	protected $table = 'search_queries';
	protected $fillable = array('user_id', 'query');
		
}

?>
