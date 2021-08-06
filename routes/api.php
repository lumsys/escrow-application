<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\api\ProductController;
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\ProductController;


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



Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});

Route::namespace('API')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('all', 'AuthController@all');

    Route::middleware(['auth:api'])->group(function() {
        Route::get('details', 'AuthController@details');
        Route::post('updateProfile', 'AuthController@updateProfile');
        Route::post('/index', 'ProductController@index');
        Route::get('logout', 'AuthController@logout');
    });
});