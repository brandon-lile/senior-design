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

Route::get('/', 'HomeController@showHome');

// Login/Registration
Route::get('login', 'User\GateController@getLogin');
Route::post('login', 'User\GateController@postLogin');
Route::get('logout', 'User\GateController@getLogout');
Route::get('register', 'User\GateController@getRegister');
Route::post('register', 'User\GateController@postRegister');

Route::controller('campaign', 'User\CampaignController');
Route::controller('character', 'User\CharacterController');
