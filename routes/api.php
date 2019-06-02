<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;


Route::post('/signup', 'AccountController@createAccount');


Route::group([
    'middleware' => 'api',
    'prefix' => 'accounts'
], function () {
    Route::get('/', 'AccountController@getAllAccounts');
    Route::get('/{id}', 'AccountController@getAccountById');
    Route::delete('/{id}', 'AccountController@deleteAccountById');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/test', 'TestController@login');
    Route::post('/login', 'AuthController@handleLogin');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'projects'
], function () {
    Route::get('/', 'ProjectController@getAllProjects');
    Route::post('/', 'ProjectController@createProject');
    Route::get('/all_projects/user/{userId}', 'ProjectController@getAccountAllProjects');
    Route::get('/{id}', 'ProjectController@getProjectById');   
    Route::put('/{id}', 'ProjectController@changeProjectProperties');
    Route::delete('/{id}', 'ProjectController@deleteProjectById');
});


