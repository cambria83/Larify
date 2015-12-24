<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Our home route
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    
    // For all routes that require authentication add here
    
Route::get('spotify', 'SpotifyController@index');
Route::get('spotify/search', 'SpotifyController@search');
Route::post('spotify/search', 'SpotifyController@search');
Route::get('spotify/add/{uri}', 'SpotifyController@add');
Route::post('spotify/add', 'SpotifyController@add');
Route::get('/spotify/delete/{uri}', 'SpotifyController@delete');
Route::get('/spotify/auth', 'SpotifyController@auth');

Route::get('account', 'AccountController@index');

});


// Auth routes
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    ]);