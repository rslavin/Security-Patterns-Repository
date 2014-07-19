<?php

class CweSet extends Eloquent {
	
	protected $table = "cwe_set";
	
	public function cwe() {
		return $this->hasMany('Cwe');
	}
	
}


?>