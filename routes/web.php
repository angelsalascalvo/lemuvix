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
///////////////   RESTful User   ////////////////
Route::get('', 'UserController@index')->name('user.index');

//Crear Usuario
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user/store', 'UserController@store')->name('user.store');

//Editar Usuario
Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::patch('user/{id}', 'UserController@update')->name('user.update');

//Eliminar Usuario
Route::delete('user/{id}/delete', 'UserController@destroy')->name('user.destroy');
