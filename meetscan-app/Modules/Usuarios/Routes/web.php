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

Route::prefix('usuarios')->group(function() {
    Route::get('/', 'UsuariosController@index')->name('usuarios.index');
    Route::get('/create', 'UsuariosController@create')->name('usuarios.create');
    Route::post('/store', 'UsuariosController@store')->name('usuarios.store');
    Route::get('/edit/{id}', 'UsuariosController@edit')->name('usuarios.edit');
    Route::post('/update', 'UsuariosController@update')->name('usuarios.update');
    Route::get('/show/{id}', 'UsuariosController@show')->name('usuarios.show');
    Route::post('/search', 'UsuariosController@search')->name('usuarios.search');
    Route::get('/change/{id}', 'UsuariosController@change')->name('usuarios.change');
});
