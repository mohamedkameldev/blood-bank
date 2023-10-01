<?php

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('new-password', [AuthController::class, 'newPassword']);


    Route::get('gov', [MainController::class, 'governrates']);    
    Route::get('cities', [MainController::class, 'cities']);
    Route::get('blood-types', [MainController::class, 'bloodTypes']);
    Route::get('settings', [MainController::class, 'settings']);
    Route::apiResource('contact', ContactController::class);


    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('change-password', [AuthController::class, 'changePassword']);
        Route::get('posts', [MainController::class, 'posts']);
    });

});
