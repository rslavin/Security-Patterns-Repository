<?php

class Cwe extends Eloquent {
	
	protected $table = "cwe";
	
	public function cwe_set() {
		return $this->belongsTo('CweSet');
	}
	
}


?>