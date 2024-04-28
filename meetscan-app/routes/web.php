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

Route::get('/', 'LoginController@index');

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login-post');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/create', 'LoginController@create')->name('admin.create');
    Route::post('/store', 'LoginController@store')->name('admin.store');
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('home')->group(function () {
        Route::get('/', 'HomeController@index')->name('home'); 
    });
});



