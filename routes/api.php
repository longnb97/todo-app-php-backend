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
    //'middleware' => ['jwt-auth'], 
    'prefix' => 'accounts'
], function () {
    Route::get('/', 'AccountController@getAllAccounts');
    Route::get('/{id}', 'AccountController@getAccountById');
    Route::delete('/{id}', 'AccountController@deleteAccountById');
});

Route::group([
    //'middleware' => ['jwt.auth'],
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
    //'middleware' => ['jwt.auth'],
    'prefix' => 'comments'
], function () {
    // Route::get('/', 'CommentController@getAllProjects');
    // Route::post('/', 'CommentController@createProject');
    // Route::get('/all_projects/user/{userId}', 'CommentController@getAccountAllProjects');
    // Route::get('/{id}', 'CommentController@getProjectById');   
    // Route::put('/{id}', 'CommentController@changeProjectProperties');
    // Route::delete('/{id}', 'CommentController@deleteProjectById');
});



//// quandev

Route::group([
    //'middleware' => ['jwt.auth'],
    'prefix' => 'task-participant'
], function () {
    Route::get('/', 'TaskParticipantController@getAllTaskParticipant');
    Route::post('/', 'TaskParticipantController@createTaskParticipant');   
    Route::get('/task-filter/{taskId}', 'TaskParticipantController@getTaskParticipantByTaskId');
    Route::get('/account-filter/{accountId}', 'TaskParticipantController@getTaskParticipantByAccountId');
    // Route::put('/{taskId}', 'TaskParticipantController@changeTaskPropertie');
    Route::delete('/{taskId}/{accountId}', 'TaskParticipantController@deleteTaskParticipant');
});


Route::group([
    //'middleware' => ['jwt.auth'],
    'prefix' => 'project-participant'
], function () {
    Route::get('/', 'ProjectParticipantController@getAllProjectParticipant');
    Route::post('/', 'ProjectParticipantController@createProjectParticipant');   
    Route::get('/project-filter/{projectId}', 'ProjectParticipantController@getProjectParticipantByTaskId');
    Route::get('/account-filter/{accountId}', 'ProjectParticipantController@getProjectParticipantByAccountId');
    // Route::put('/{taskId}', 'ProjectParticipantController@changeTaskPropertie');
    Route::delete('/{projectId}/{accountId}', 'ProjectParticipantController@deleteProjectParticipant');
});

