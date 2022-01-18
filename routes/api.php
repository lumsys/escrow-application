<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// namespace App\Http\Controllers;


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
//    return $request->user();
// });

    Route::namespace('API')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('all', 'AuthController@all');
});
   // Route::post('resetPassword', 'AuthControllerController@resetPassword');


    Route::namespace('API')->middleware(['auth:api'])->group(function () {
    // User Update and related activity
        Route::get('details', 'AuthController@details');
        Route::get('logout', 'AuthController@logout');
        Route::post('forgot', 'ForgotController@forgot');
        Route::post('updateProfile', 'AuthController@updateProfile');
    // Add product and related activity
        Route::post('addProduct/{id}', 'BuyerController@addProduct');
        Route::post('updateUsertype/{id}', 'BuyerController@updateUsertype');
        Route::get('deleteProduct/{id}', 'BuyerController@deleteProduct');
    // Show order
        Route::post('OrderList/{id}', 'OrderController@OrderList');
    //  List of Services
        Route::post('storeService/{id}', 'ServiceController@storeService');
        Route::get('getService', 'ServiceController@getService');
    //  List of category
        Route::post('storeCategory/{id}', 'CategoryController@storeCategory');
        Route::get('getCategory', 'CategoryController@getCategory');
    });
