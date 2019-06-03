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
    Route::get('/check_auth', 'AuthController@me');// checkout
});

Route::group([
    'middleware' => ['jwt.auth'],// has 
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
    //'middleware' => ['jwt.auth'],
    'prefix' => 'tasks'
], function () {
    Route::get('/', 'TaskController@getAllTasks');
    Route::post('/', 'TaskController@createTask');   
    Route::get('/project/{projectId}', 'TaskController@getProjectAllTasks');
    Route::get('/{taskId}', 'TaskController@getTaskById');
    Route::put('/{taskId}', 'TaskController@changeTaskProperties');
    Route::delete('/{taskId}', 'TaskController@deleteTaskById');
});

Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => 'comments'
], function () {
    // Route::get('/', 'CommentController@getAllProjects');
    // Route::post('/', 'CommentController@createProject');
    // Route::get('/all_projects/user/{userId}', 'CommentController@getAccountAllProjects');
    // Route::get('/{id}', 'CommentController@getProjectById');   
    // Route::put('/{id}', 'CommentController@changeProjectProperties');
    // Route::delete('/{id}', 'CommentController@deleteProjectById');
});
