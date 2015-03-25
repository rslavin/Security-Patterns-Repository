<?php

Route::pattern('id', '[0-9]+');
Route::get('/', function()
{
	//return Redirect::to('patterns');
	return View::make('pages.home')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
});



/*
 * ------------------------------------------------------------
 *  Patterns and Pattern References
 * ------------------------------------------------------------
 */

Route::get('/patterns', 'HomeController@showPatterns');
Route::post('/patterns/search', function()
{
	$keywords = Input::get('q');
	return Redirect::to('patterns/search/'.$keywords);
});
Route::get('/patterns/search/{keywords}', 'HomeController@showPatternsByKeywords');
Route::get('/patterns/{id}', 'HomeController@showPatternsById');
Route::post('/patterns/{id}', 'HomeController@updatePattern');
Route::get('/patterns/{type}', 'HomeController@showPatternsByType');
Route::get('/patterns/details/{id}', 'DetailsController@showPatternById');

Route::get('/references', 'HomeController@showReferences');
Route::get('/references/{id}', 'HomeController@showReference');

/*
 * ------------------------------------------------------------
 * Administrative 
 * ------------------------------------------------------------
 */
Route::get('/admin/', function()
{
	return Redirect::to('/admin/users/');
});
Route::controller('/admin/users/', 'UsersController');
Route::get('/admin/users/edit/{id}', 'UsersController@edit');
Route::post('/admin/users/edit/{id}', 'UsersController@update');

/*
 * ------------------------------------------------------------
 * Login and Registration 
 * ------------------------------------------------------------
 */
Route::get('/login', 'UsersController@getLogin');
Route::get('/logout', 'UsersController@getLogout');
Route::post('/login', array('uses' => 'UsersController@postLogin'));

Route::get('/register', 'UsersController@getRegister');
Route::post('/register', 'UsersController@postCreate');

/*
 * ------------------------------------------------------------
 * Misc.
 * ------------------------------------------------------------
 */
Route::controller('/cwe_set', 'CweSetController');

Route::get('/contact', function(){
	return Redirect::to('research');
});

Route::get('/research', function() 
{
	return View::make('pages.contact')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());;
});

Route::get('/types', function() 
{
	return View::make('pages.types')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());;
});

/*
 * ------------------------------------------------------------
 *  User Study
 * ------------------------------------------------------------
 */

Route::get("/thanks", function(){
	return View::make('study.thanks')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
});

//Route::get('/createstudy', 'UsersController@createStudyAccounts');
   
Route::post('/selectPattern', 'UsersController@addPatternSelection');

/*
|--------------------------------------------------------------------------
| Access Control
|--------------------------------------------------------------------------
|
| Here are the rules for access control. Put the logic in filters.php
|
*/

Route::when('admin*', 'admin');
Route::when('register', 'admin');



/*
|--------------------------------------------------------------------------
| Tree Generation
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/trees/parents/{id}', function($id)
{
    return Trees::getPatternParentsById($id);
});

Route::get('/api/v1/trees/childs/{id}', function($id)
{
    return Trees::getPatternChildrenById($id);
});

Route::get('/api/v1/pattern/', function()
{
    return Trees::getPatterns();
});


