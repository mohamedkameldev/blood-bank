<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DonationRequestController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function (){

    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('reset-password', 'resetPassword');
        Route::post('new-password', 'newPassword');
        Route::post('change-password', 'changePassword')->middleware('auth:api');
        Route::post('profile', 'profile')->middleware('auth:api');
    });

    Route::group(['controller' => MainController::class], function(){
        Route::get('govs', 'governrates');
        Route::get('cities', 'cities');
        Route::get('blood-types', 'bloodTypes');
        Route::get('settings', 'settings');
        Route::post('send-message', 'storeContact')->middleware('auth:api');
    });

    Route::group(['controller' => PostController::class], function(){
        Route::get('categories', 'categories');
        Route::get('posts', 'posts');
        Route::get('posts/search', 'search');
        Route::get('post/{id}', 'post');
        Route::get('favourites', 'favourites')->middleware('auth:api');
        Route::post('toggle-fav', 'toggleFav')->middleware('auth:api');
    });

    Route::controller(DonationRequestController::class)->prefix('donation')->middleware('auth:api')->group(function(){
        Route::get('requests', 'index'); 
        Route::get('request/{id}', 'show'); 
        Route::post('create', 'create'); 
    });

    Route::controller(NotificationController::class)->prefix('notification')->middleware('auth:api')->group(function(){
        Route::get('list', 'index')->middleware('auth:api');
        Route::get('count', 'count')->middleware('auth:api');
        Route::post('register-token', 'registerToken');
        Route::post('remove-token', 'removeToken');
        Route::post('settings', 'notificationSettings')->middleware('auth:api');
    });
});
