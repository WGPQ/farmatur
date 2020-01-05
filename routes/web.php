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


Route::resource('divpoliticas','DivpoliticaController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/usuarios','UsuarioController@index');


Route::resource('farmacias', 'FarmaciaController');

Route::post('farmacias/update', 'FarmaciaController@update')->name('farmacias.update');

Route::get('farmacias/destroy/{id}', 'FarmaciaController@destroy');



Route::resource('personas', 'PersonaController');

Route::post('personas/update', 'PersonaController@update')->name('personas.update');

Route::get('personas/destroy/{id}', 'PersonaController@destroy');