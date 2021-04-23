<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PicturesController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;

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
});/*
Route::get('/auth/logout', [LoginController::class, 'logout']);
Route::get('/auth/users', [LoginController::class, 'users']);
Route::post('/auth/register', [RegisterController::class, 'show']);
Route::post('/auth/login', [LoginController::class, 'login']);*/
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'create']);

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('user', [LoginController::class, 'user']);
        Route::resource('users',UserController::class);
        Route::resource('restaurants', RestaurantController::class );
        Route::resource('restaurants.pictures',PicturesController::class);
    });
});
Route::group([
    'middleware' => 'auth:api'
  ], function() {
      Route::resource('users',UserController::class);
      Route::resource('restaurants', RestaurantController::class );
      Route::resource('restaurants.pictures',PicturesController::class);
  });

