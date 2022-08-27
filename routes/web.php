<?php

use App\Services\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//USER API ROUTES
Route::namespace('App\Services\User\Controllers')->prefix('/api/user')->group(function () {
    Route::middleware([])->group(function () {
        Route::post('/', 'UserController@createUser');
        Route::put('/{id}', 'UserController@updateUser');
        Route::post('/validate', 'UserController@validatePassword');
        Route::post('/login', 'UserController@login');
        Route::get('/logout', 'UserController@logout');
    });
});

//TODO & NOTE API ROUTES
Route::namespace('App\Services\Todo\Controllers')->prefix('/api')->group(function () {
    Route::prefix('/todo')->group(function () {
        Route::post('/', 'TodoController@createTodo');
        Route::put('/{id}', 'TodoController@updateTodo');
        Route::delete('/{id}', 'TodoController@deleteTodo');
        Route::get('/', 'TodoController@getTodoList');
    });
});
