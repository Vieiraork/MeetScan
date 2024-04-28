<?php

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

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('anexos')->group(function() {
        Route::get('/', 'AnexosController@index')->name('anexos.index');
        Route::get('/create', 'AnexosController@create')->name('anexos.create');
        Route::post('/store', 'AnexosController@store')->name('anexos.store');
        Route::get('/edit/{id}', 'AnexosController@edit')->name('anexos.edit');
        Route::post('/update/{id}', 'AnexosController@update')->name('anexos.update');
        Route::get('/show/{id}', 'AnexosController@show')->name('anexos.show');
        Route::post('/destroy/{id}', 'AnexosController@destroy')->name('anexos.destroy');
        Route::post('/search', 'AnexosController@search')->name('anexos.search');
    });
});
