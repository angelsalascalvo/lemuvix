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
///////////////          RESTfull Movie           ////////////////
/////////////////////////////////////////////////////////////////
Route::get('', 'MovieController@index')->name('movie.index');

//Escanear peliculas existentes en los directorios
Route::get('movie/scan', 'MovieController@scan')->name("movie.scan");

//Scraping
Route::get('movie/sync/{id}', 'MovieController@sync')->name("movie.sync");

//Crear pelicula
Route::get('movie/create', 'MovieController@create')->name('movie.create');
Route::post('movie/store', 'MovieController@store')->name('movie.store');

//Editar pelicula
Route::get('movie/{id}/edit', 'MovieController@edit')->name('movie.edit');
Route::patch('movie/{id}', 'MovieController@update')->name('movie.update');

//Eliminar pelicula
Route::delete('movie/{id}/delete', 'MovieController@destroy')->name('movie.destroy');

//Ver pelicula
Route::get('movie/{id}', 'MovieController@show')->name('movie.show');

//Ver peliculas de un genero
Route::get('movie/showbygenre/{genre}', 'MovieController@showByGenre')->name('movie.showByGenre');


/////////////// RESTfull User ////////////////
Route::resource('user', 'UserController', ['except' => ['show']]);

/////////////// RESTfull Genres ///////////////
Route::resource('genre', 'GenreController', ['except' => ['show']]);

/////////////// RESTfull People ///////////////
Route::resource('person', 'PersonController');

/////////////// AUTENTICACION ///////////////
Auth::routes(['register' => false]);