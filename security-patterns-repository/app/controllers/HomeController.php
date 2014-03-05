<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showPatterns()
	{
		$patterns = Patterns::allPatterns();
		return View::make('pages.patterns', array('patterns' => $patterns));
	}
	public function showPatternsByType($type)
	{
		$patterns = Patterns::getPatternsByType($type);
		return View::make('pages.patterns', array('patterns' => $patterns));
	}
	public function showPatternsById($id)
	{
		$patterns = Patterns::getPatternsById($id);
		return View::make('pages.patterns', array('patterns' => $patterns));
	}
	public function showReferences()
	{
		$references = References::allReferences();
		return View::make('pages.references', array('references' => $references));
	}
	public function showReference($id)
	{
		$references = References::getReference($id);
		$patterns = Patterns::getPatternsByReference($id);
		return View::make('pages.references', array('references' => $references, 'titles' => $patterns));
	}

}
