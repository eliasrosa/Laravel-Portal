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

//
Route::pattern('id', '[0-9]+');

// route to show the login form
Route::get('login', 'LoginController@login');
Route::post('login', 'LoginController@auth');
Route::get('logoff', 'LoginController@logoff');

//
Route::group(array('before' => 'auth|error'), function()
{
	//
	Route::controller('/usuarios/grupos', 'UsuariosGruposController');
	Route::controller('/usuarios', 'UsuariosController');

	//
	Route::controller('/', 'AdminController');
});



