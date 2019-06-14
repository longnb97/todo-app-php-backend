<?php

use Illuminate\Http\Request;

Route::get('/index', function () {
    return '<h1>To-do Webservice Api</h1>';
});

Route::group([
    //'middleware' => ['jwt.auth','api-header'],
    'prefix' => 'auth'
], function () {
    Route::post('/test', 'AuthController@loginTest');
    Route::post('/login', 'AuthController@handleLogin');
    Route::get('/check_auth', 'AuthController@me'); // checkout
});

Route::group([
    //'middleware' => 'jwt.auth',
    'prefix' => 'accounts'
], function () {
    Route::post('/signup', 'AccountController@createAccount');
    Route::get('/', 'AccountController@getAllAccounts');
    Route::get('/mail', 'AccountController@getAccountByEmail');
    Route::get('/{id}', 'AccountController@getAccountById');
    Route::delete('/{id}', 'AccountController@deleteAccountById');
});

Route::group([
    //'middleware' => 'jwt.auth',
    'prefix' => 'projects'
], function () {
    Route::post('/', 'ProjectController@createProject');
    Route::get('/', 'ProjectController@getAllProjects');
    Route::get('/user/{userId}', 'ProjectParticipantsController@getAccountAllProjects');
    Route::get('/{projectId}/participants', 'ProjectParticipantsController@getProjectParticipants');
    Route::post('/add_participant', 'ProjectParticipantsController@addParticipantToProject');//add user to project
    Route::get('/{id}', 'ProjectController@getProjectById');
    Route::put('/{id}', 'ProjectController@changeProjectProperties');
    Route::delete('/{id}', 'ProjectController@deleteProjectById');
});


Route::group([
    //'middleware' => 'jwt.auth',
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
    //'middleware' => 'jwt.auth',
    'prefix' => 'comments'
], function () {
    Route::get('/', 'CommentController@getAllComments');
    Route::post('/', 'CommentController@createTaskComment');
    Route::get('/task/{taskId}', 'CommentController@getTaskAllComments');
    Route::get('/user/{userId}', 'CommentController@getAccountAllComments');
    Route::get('/{id}', 'CommentController@getCommentById');
    Route::put('/{id}', 'CommentController@changeCommentProperties');
    Route::delete('/{id}', 'CommentController@deleteCommentById');
});


Route::group([
    //'middleware' => 'jwt.auth',
    'prefix' => 'task-participants'
], function () {
    Route::get('/', 'TaskParticipantsController@getAllTaskParticipants');
    Route::post('/', 'TaskParticipantsController@createTaskParticipants');
    Route::get('/task-filter/{projectId}', 'TaskParticipantsController@getTaskParticipantsByTaskId');
    Route::get('/project-filter/{projectId}', 'TaskParticipantsController@getTaskParticipantsByTaskId');
    Route::get('/{taskId}', 'TaskParticipantsController@getTaskById');
    Route::put('/{taskId}', 'TaskParticipantsController@changeTaskProperties');
    Route::delete('/{taskId}', 'TaskParticipantsController@deleteTaskById');
});

Route::group([
    //'middleware' => 'jwt.auth',
    'prefix' => 'project-participants'
], function () {   
    Route::post('/', 'ProjectParticipantsController@createProjectParticipants');
});
