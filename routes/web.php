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

//Route::resource('usuarios','HomeController');

Route::resource('farmacias','FarmaciaController');

Route::resource('divpoliticas','DivpoliticaController');
Route::get('/create','CotrollerAnimal@vista');
Route::post('/create','CotrollerAnimal@create');
Route::resource('persona2','PersonaController2');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/usuarios','UsuarioController@index');

Route::post('/Adduser','UsuarioController@store');

Route::resource('ajax-posts', 'ajaxcrud\AjaxPostController');





//Route::resource('ajax-crud', 'AjaxCrudController');
Route::resource('personas','PersonaController');