<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Account;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/user', function(Request $request){
    return response()->json('Hello World! Welcome to codingpearls.com', 200);
});

Route::post('/login', 'Account@login');
Route::post('/signup', 'Account@createAccount');