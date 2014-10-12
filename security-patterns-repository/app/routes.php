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



Route::controller('/cwe_set', 'CweSetController');


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

Route::get('/references', 'HomeController@showReferences');
Route::get('/references/{id}', 'HomeController@showReference');

Route::get('/contact', function() 
{
	return View::make('pages.contact')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());;
});

Route::get('/types', function() 
{
	return View::make('pages.types')
		->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());;
});

Route::get('/patterns/details/{id}', 'DetailsController@showPatternById');

Route::get('login', array('uses' => 'HomeController@showLogin'));
Route::post('login', array('uses' => 'HomeController@doLogin'));

//Route::get('/users/edit/{id}', 'UsersController@edit');
//Route::post('edit', array('uses' => 'UsersController@postUpdate'));

//Route::get('nerd/edit/{id}', array('as' => 'users.getEdit', function($id) 
	//{
		// return our view and Nerd information
		//return View::make('edit') // pulls app/views/nerd-edit.blade.php
			//->with('user', Users::find($id));
	//}));
    
    // route to process the form
	//Route::post('users/edit', function() {
		// process our form
	//});
    
    
//route for edit employee page.
Route::get('/users/edit/{id}', 'UsersController@edit');
//route for delete emplooyee page
//Route::get('/delete/{employee}', 'EmployeesController@delete');
//route to handle edit form submission
Route::post('/users/edit/{id}', 'UsersController@update');
Route::controller('users', 'UsersController');
//route to handle delete.
//Route::post('/delete', 'EmployeesController@handleDelete');