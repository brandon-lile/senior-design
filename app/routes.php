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

// Settings
Route::get('settings', 'User\SettingsController@getIndex');
Route::post('settings/changeemail', 'User\SettingsController@postChangeEmail');
Route::post('settings/changeusername', 'User\SettingsController@postChangeUsername');
Route::post('settings/changepassword', 'User\SettingsController@postChangePassword');

Route::controller('dashboard', 'User\DashboardController');

// Campaign
Route::get('campaign/{id}', 'User\CampaignController@getIndex');
Route::patch('campaign/description', 'User\CampaignController@patchDescription');
Route::post('campaign/entry', 'User\CampaignController@postEntry');
Route::post('campaign/npc', 'User\CampaignController@postNpc');
Route::post('campaign/picture', 'User\CampaignController@postPicture');
Route::post('campaign/addplayer', 'User\CampaignController@postAddPlayer');
Route::get('campaign/delete/{id}', 'User\CampaignController@deleteCampaign');

// Character Sheet
Route::get('character/{id}', 'User\CharacterController@getSheet');

Route::patch('character/patchability', 'User\CharacterController@patchAbility');
Route::patch('character/patchClassAttr/{field}', 'User\CharacterController@patchClassAttr');
Route::patch('character/patchSavingThrow', 'User\CharacterController@patchSavingThrow');
Route::patch('character/patchSkills', 'User\CharacterController@patchSkills');
Route::patch('character/patchInspiration/{sheet}/{val}', 'User\CharacterController@patchInspiration');
Route::post('character/postEquipment', 'User\CharacterController@postEquipment');
Route::delete('character/deleteEquipment', 'User\CharacterController@deleteEquipment');
Route::patch('character/patchHP', 'User\CharacterController@patchHP');
Route::patch('character/patchInfo', 'User\CharacterController@patchInfo');
Route::patch('character/patchFeatures', 'User\CharacterController@patchFeatures');
Route::get('character/spells/{id}', 'User\CharacterController@getSpells');
Route::post('character/spells', 'User\CharacterController@postSpell');
Route::post('character/avatar', 'User\CharacterController@postAvatar');
Route::get('character/avatar/{id}', 'User\CharacterController@deleteAvatar');
Route::post('character/treasure', 'User\CharacterController@postTreasure');
Route::delete('character/treasure', 'User\CharacterController@deleteTreasure');
Route::get('character/delete/{id}', 'User\CharacterController@deleteCharacter');
Route::patch('character/levels', 'User\CharacterController@patchLevels');