<?php

class CweSetController extends BaseController {

	public function postAdd() {
		Eloquent::unguard();

		$cwe_name = Input::get('cwe_name');
		$pattern_id = Input::get('pattern_id');
		$set = CweSet::where('pattern_id', $pattern_id)->first();
		if (!$set) {
			$set = CweSet::create(array('pattern_id' => $pattern_id));
		}
		Cwe::create(array('name' => $cwe_name, 'cwe_set_id' => $set->id));
		
		return Redirect::back();
	}

}