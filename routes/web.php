<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PicturesController;
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
/*
Route::get('/', function () {
    return view('auth.login');
});
*/
/*
//Rutas de Usuario
Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.destroy');

//Rutas de Restaurantes
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::post('/restaurants', [RestaurantController::class, 'store']);
Route::put('/restaurants/{restaurant_id}', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('/restaurants/{restaurant_id}', [RestaurantController::class, 'delete'])->name('restaurants.destroy');

//Rutas de Imagenes
Route::get('/restaurants/{restaurant_id}', [PicturesController::class, 'show']);
Route::post('/restaurants/{restaurant_id}/pictures', [PicturesController::class, 'store']);
Route::delete('/restaurants/{restaurant_id}/pictures/{picture_id}', [PicturesController::class, 'delete'])->name('pictures.destroy');*/

/*
Route::get('/home', [RestaurantController::class, 'index'])->name('home');

Auth::routes();
*/