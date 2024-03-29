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

Route::get('/', function () {
    return view('welcome');
});

Route::controller('users', 'UserController');
Route::controller('posts', 'PostController');
Route::controller('messages', 'MessageController');
Route::controller('login', 'LoginController');

Route::get('messages/index', array('uses' => 'MessageController@getindex', 'as' => 'chat'));

Route::resource('rest/users', 'UserRESTController');
Route::resource('rest/posts', 'PostRESTController');