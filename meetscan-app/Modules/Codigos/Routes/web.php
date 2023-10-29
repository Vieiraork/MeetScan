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
    Route::prefix('codigos')->group(function () {
        Route::get('/', 'CodigosController@index')->name('codigos.index');
        Route::get('/create', 'CodigosController@create')->name('codigos.create');
        Route::post('/store', 'CodigosController@store')->name('codigos.store');
        Route::get('/edit/{id}', 'CodigosController@edit')->name('codigos.edit');
        Route::post('/update/{id}', 'CodigosController@update')->name('codigos.update');
        Route::get('/show/{id}', 'CodigosController@show')->name('codigos.show');
        Route::get('/destroy/{id}', 'CodigosController@destroy')->name('codigos.destroy');
        Route::post('/search', 'CodigosController@search')->name('codigos.search');
    });
});
