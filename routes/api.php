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
    Route::get('/', 'AccountController@getAllAccount');
    Route::get('/{id}', 'AccountController@getAccountById');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', 'AccountController@handleLogin');
});


// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'projects'
// ], function ($router) {
//     Route::post('/login', 'AccountController@login');
// });

