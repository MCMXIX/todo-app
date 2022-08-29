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
    })->middleware(['userLoginCheck'])->name($sUserRouteName);
}

//DASHBOARD ROUTES
$aDashboardRoutes = [
    'home'      => '/',
    'user_info' => '/user_info'
];

foreach ($aDashboardRoutes as $aDashboardRouteName => $sDashboardRoute) {
    Route::get($sDashboardRoute, function () {
        return view('dashboard', ['full_name' => session()->get('full_name')]);
    })->middleware(['userAuth'])->name($aDashboardRouteName);
}
/** END OF VUE ROUTES **/

/** USER API ROUTES **/
Route::namespace('App\Services\User\Controllers')->prefix('/api/user')->group(function () {
    Route::middleware(['userLoginCheck'])->group(function () {
        Route::post('/login', 'UserController@login');
        Route::post('/', 'UserController@createUser');
    });
    Route::middleware(['userAuth'])->group(function () {
        Route::put('/{id}', 'UserController@updateUser');
        Route::post('/validate', 'UserController@validatePassword');
        Route::get('/logout', 'UserController@logout');
        Route::get('/', 'UserController@getUserById');
    });
});

/** TODO & NOTE API ROUTES **/
Route::middleware(['userAuth'])->namespace('App\Services\Todo\Controllers')->prefix('/api')->group(function () {
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
