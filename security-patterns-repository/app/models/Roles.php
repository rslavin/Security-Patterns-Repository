<?php

class Roles extends Eloquent {

    protected $primaryKey = 'role_id';

	// creates an array of role_id => role_name for use in 
	// dropdown menus.
	public static function rolesToArray(){
		$roles = Roles::all();
		$rolesArray = array();
		foreach ($roles as $role) {
			$rolesArray[$role -> role_id] = $role->role_name;
		}
		return $rolesArray;
	}
	
	// returns string representation of role
	public static function getRole($id){
		return Roles::find($id)->role_name;
	}

}

?>
