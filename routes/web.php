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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mapa', function () {
    return view('farmacias.mapa');
});

Route::resource('divpoliticas','DivpoliticaController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('farmacias', 'FarmaciaController');

Route::post('farmacias/update', 'FarmaciaController@update')->name('farmacias.update');

Route::get('farmacias/destroy/{id}', 'FarmaciaController@destroy');



Route::resource('personas', 'PersonaController');

Route::post('personas/update', 'PersonaController@update')->name('personas.update');

Route::get('personas/destroy/{id}', 'PersonaController@destroy');



Route::resource('tipo_usuarios', 'TipoUserController');

Route::post('tipo_usuarios/update', 'TipoUserController@update')->name('tipo_usuarios.update');

Route::get('tipo_usuarios/destroy/{id}', 'TipoUserController@destroy');



Route::resource('usuarios', 'UsuarioController');

Route::post('usuarios/update', 'UsuarioController@update')->name('usuarios.update');

Route::get('usuarios/destroy/{id}', 'UsuarioController@destroy');



Route::resource('divpoliticas', 'DivPolitcaController');

Route::post('divpoliticas/update', 'DivPolitcaController@update')->name('divpoliticas.update');

Route::get('divpoliticas/destroy/{id}', 'DivPolitcaController@destroy');
