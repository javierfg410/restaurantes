<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/role/{id}', [App\Http\Controllers\RoleController::class, 'getUser']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'getRole']);

Route::get('/perfil', [App\Http\Controllers\UserController::class, 'perfil']);
Route::post('/setUser', [UserController::class, 'setUser']);
Route::get('/delUser', [UserController::class, 'delUser']);

Route::get('/restaurante', [RestaurantController::class, 'index']);
Route::post('/addRess', [RestaurantController::class, 'addRess']);
Route::get('/delRess/{id}', [RestaurantController::class, 'delRess']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
