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
		return View::make('pages.details')->with('pattern', $pattern)
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	
}
