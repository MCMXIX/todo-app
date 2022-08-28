<?php

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

/** VUE ROUTES **/

//USER MANAGEMENT ROUTES
$aUserRoutes = [
    'login'        => '/login',
    'registration' => '/register'
];

foreach ($aUserRoutes as $sUserRouteName => $sUserVueRoute) {
    Route::get($sUserVueRoute, function () {
        return view('user');
    })->middleware([])->name($sUserRouteName);
}
/** END OF VUE ROUTES **/

/** USER API ROUTES **/
Route::namespace('App\Services\User\Controllers')->prefix('/api/user')->group(function () {
    Route::middleware([])->group(function () {
        Route::post('/', 'UserController@createUser');
        Route::put('/{id}', 'UserController@updateUser');
        Route::post('/validate', 'UserController@validatePassword');
        Route::post('/login', 'UserController@login');
        Route::get('/logout', 'UserController@logout');
    });
});

/** TODO & NOTE API ROUTES **/
Route::namespace('App\Services\Todo\Controllers')->prefix('/api')->group(function () {
    //TODO
    Route::prefix('/todo')->group(function () {
        Route::post('/', 'TodoController@createTodo');
        Route::put('/{id}', 'TodoController@updateTodo');
        Route::delete('/{id}', 'TodoController@deleteTodo');
        Route::get('/', 'TodoController@getTodoList');
    });

    //TODO NOTES
    Route::prefix('/note')->group(function () {
        Route::post('/', 'TodoNoteController@createNote');
        Route::put('/{id}', 'TodoNoteController@updateNote');
        Route::delete('/{id}', 'TodoNoteController@deleteNote');
    });
});
/** END OF API ROUTES **/
