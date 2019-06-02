<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/signup', 'AccountController@createAccount');


Route::group([
    'middleware' => 'api',
    'prefix' => 'accounts'
], function ($router) {
    Route::get('/', 'AccountController@getAllAccounts');
    Route::get('/{id}', 'AccountController@getAccountById');
    Route::delete('/{id}', 'AccountController@deleteAccountById');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', 'AccountController@handleLogin');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'projects'
], function ($router) {
    Route::get('/', 'ProjectController@getAllProjects');
    Route::post('/', 'ProjectController@createProject');
    Route::get('/all_projects/user/{userId}', 'ProjectController@getAccountAllProjects');
    Route::get('/{id}', 'ProjectController@getProjectById');   
    Route::put('/{id}', 'ProjectController@changeProjectProperties');
    Route::delete('/{id}', 'ProjectController@deleteProjectById');
});

