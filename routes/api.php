<?php

use Illuminate\Http\Request;

Route::get('/index', function () {
    return '<h1>To-do Webservice Api</h1>';
});

Route::post('/signup', 'AccountController@createAccount');

Route::group([
    //'middleware' => ['jwt.auth','api-header'],
    'prefix' => 'auth'
], function () {
    Route::post('/test', 'AuthController@loginTest');
    Route::post('/login', 'AuthController@handleLogin');
    Route::get('/check_auth', 'AuthController@me');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'accounts'
], function () {
    Route::get('/', 'AccountController@getAllAccounts');
    Route::get('/{id}', 'AccountController@getAccountById');
    Route::delete('/{id}', 'AccountController@deleteAccountById');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'projects'
], function () {
    Route::get('/', 'ProjectController@getAllProjects');
    Route::post('/', 'ProjectController@createProject');
    Route::get('/all_projects/user/{userId}', 'ProjectController@getAccountAllProjects');
    Route::get('/{id}', 'ProjectController@getProjectById');
    Route::put('/{id}', 'ProjectController@changeProjectProperties');
    Route::delete('/{id}', 'ProjectController@deleteProjectById');
});


Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'tasks'
], function () {
    // Route::get('/', 'ProjectController@getAllProjects');
    // Route::post('/', 'ProjectController@createProject');
    // Route::get('/all_projects/user/{userId}', 'ProjectController@getAccountAllProjects');
    // Route::get('/{id}', 'ProjectController@getProjectById');   
    // Route::put('/{id}', 'ProjectController@changeProjectProperties');
    // Route::delete('/{id}', 'ProjectController@deleteProjectById');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'comments'
], function () {
    // Route::get('/', 'ProjectController@getAllProjects');
    // Route::post('/', 'ProjectController@createProject');
    // Route::get('/all_projects/user/{userId}', 'ProjectController@getAccountAllProjects');
    // Route::get('/{id}', 'ProjectController@getProjectById');   
    // Route::put('/{id}', 'ProjectController@changeProjectProperties');
    // Route::delete('/{id}', 'ProjectController@deleteProjectById');
});
