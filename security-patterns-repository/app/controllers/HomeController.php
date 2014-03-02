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

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function showPatterns()
	{
		$patterns = Patterns::allPatterns();
		return View::make('main', array('patterns' => $patterns));
	}
	public function showPatternsByType($type)
	{
		$patterns = Patterns::getPatternsByType($type);
		return View::make('main', array('patterns' => $patterns));
	}
	public function showReferences()
	{
		$references = References::allReferences();
		return View::make('main', array('references' => $references));
	}
	public function showReference($id)
	{
		$references = References::getReference($id);
		return View::make('main', array('references' => $references));
	}

}
