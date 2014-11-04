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
		
		return View::make('pages.patterns', array('patterns' => $patterns))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	public function updatePattern($id)
	{
		$description = Input::get('description');
        $source = Input::get('source');
		$keywords = Input::get('keywords');
        Patterns::updatePattern($id, $description, $keywords);
        if(Input::file('pattern_file') != null && Input::file('pattern_file')->isValid())
            Patterns::updatePatternFile($id, Input::file('pattern_file'));
        // TODO add error message on failure
		return Redirect::back();
	}
	public function showPatternsByType($type)
	{
		$patterns = Patterns::getPatternsByType($type);
		return View::make('pages.patterns', array('patterns' => $patterns))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	public function showPatternsById($id)
	{
		$patterns = Patterns::getPatternsById($id);

		return View::make('pages.patterns', array('patterns' => $patterns))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	public function showPatternsByKeywords($keywords)
	{
		//$keywords = Input::get('q');
		$patterns = Patterns::getSearchResults($keywords);
		return View::make('pages.patterns', array('patterns' => $patterns))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	public function showReferences()
	{
		$references = References::allReferences();
		return View::make('pages.references', array('references' => $references))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}
	public function showReference($id)
	{
		$references = References::getReference($id);
		$patterns = Patterns::getPatternsByReference($id);
		return View::make('pages.references', array('references' => $references, 'titles' => $patterns))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}

}
