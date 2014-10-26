<?php

class Roles extends Eloquent {
	
	public static function getRoles()
	{
		$roles = DB::table('roles')
			->select('role_name', 
				'role_id')
			->orderBy('role_id')
			->get();

		return $roles;
	}
	
	// creates an array of role_id => role_name for use in 
	// dropdown menus.
	public static function rolesToArray(){
		$roles = Roles::getRoles();
		$rolesArray = array();
		foreach ($roles as $role) {
			$rolesArray[$role -> role_id] = $role->role_name;
		}
		return $rolesArray;
	}
	
	// returns string representation of role
	public static function getRole($id){
		$role_name = DB::table('roles')
			->select('role_name')
			->where('role_id', '=', $id)
			->first();
		
		if($role_name == null)
			return -1;
		return $role_name -> role_name;		
	}

}

?>