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
/////////////////////////////////////////////////////////////////
///////////////          RESTfull User           ////////////////
/////////////////////////////////////////////////////////////////
Route::get('users', 'UserController@index')->name('user.index');

//Crear Usuario
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user/store', 'UserController@store')->name('user.store');

//Editar Usuario
Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
Route::patch('user/{id}', 'UserController@update')->name('user.update');

//Eliminar Usuario
Route::delete('user/{id}/delete', 'UserController@destroy')->name('user.destroy');



/////////////////////////////////////////////////////////////////
///////////////          RESTfull Movie           ////////////////
/////////////////////////////////////////////////////////////////
Route::get('', 'MovieController@index')->name('movie.index');

//Crear pelicula
Route::get('movie/create', 'MovieController@create')->name('movie.create');
Route::post('movie/store', 'MovieController@store')->name('movie.store');

//Editar pelicula
Route::get('movie/{id}/edit', 'MovieController@edit')->name('movie.edit');
Route::patch('movie/{id}', 'MovieController@update')->name('movie.update');

//Eliminar pelicula
Route::delete('movie/{id}/delete', 'MovieController@destroy')->name('movie.destroy');

//Ver pelicula
Route::get('movie/{id}', 'movieController@show')->name('movie.show');
