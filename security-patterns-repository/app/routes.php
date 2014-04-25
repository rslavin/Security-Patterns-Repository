<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::pattern('id', '[0-9]+');

Route::get('/', function()
{
	return Redirect::to('patterns');
});

Route::get('/patterns', 'HomeController@showPatterns');
Route::post('/patterns/search', function()
{
	$keywords = Input::get('q');
	return Redirect::to('patterns/search/'.$keywords);
});
Route::get('/patterns/search/{keywords}', 'HomeController@showPatternsByKeywords');
Route::get('/patterns/{id}', 'HomeController@showPatternsById');
Route::get('/patterns/{type}', 'HomeController@showPatternsByType');

Route::get('/references', 'HomeController@showReferences');
Route::get('/references/{id}', 'HomeController@showReference');

Route::get('/contact', function() 
{
	return View::make('pages.contact');
});

Route::get('/types', function() 
{
	return View::make('pages.types');
});