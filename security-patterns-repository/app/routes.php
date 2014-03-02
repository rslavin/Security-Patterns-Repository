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

Route::get('/', function()
{
	return Redirect::to('patterns');
});
Route::get('/patterns', 'HomeController@showPatterns');
Route::get('/patterns/{type}', 'HomeController@showPatternsByType');
Route::get('/references', 'HomeController@showReferences');
Route::get('/references/{id}', 'HomeController@showReference');
Route::get('/contact', function() 
{
	return View::make('main');
});
