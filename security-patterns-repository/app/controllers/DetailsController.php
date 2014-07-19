<?php

class DetailsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Details Controller
	|--------------------------------------------------------------------------
	|
	| Information for specific pattern details
	|
	*/

	public function showPatternById($id)
	{
		$pattern = Patterns::getSinglePatternById($id);
		$cwe_set = CweSet::where('pattern_id', $id)->first();
		if ($cwe_set) {
			$cwes = $cwe_set->cwe;	
		} else {
			$cwes = [];
		}
		return View::make('pages.details', array('pattern'=> $pattern, 'cwes' => $cwes))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	
}
