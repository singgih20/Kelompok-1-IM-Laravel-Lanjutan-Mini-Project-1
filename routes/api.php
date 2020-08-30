<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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

Route::namespace('Auth')->group(function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('logout', 'LogoutController');
});

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'UserController@show');
    Route::patch('user/{user}', 'UserController@update');
    Route::patch('ubahStatus/{user}', 'UserController@ubahStatus')->middleware('admin');

    Route::middleware('admin')->group(function () {
        Route::post('create-new-book', 'BookController@store');
        Route::patch('update-book/{book}', 'BookController@update');
        Route::delete('delete-book/{book}', 'BookController@destroy');

        Route::patch('update-status/{order}', 'OrderController@update');
    });
});
// dapat diakses tanpa login
Route::get('book', 'BookController@index');
Route::get('book/{book}', 'BookController@show');
