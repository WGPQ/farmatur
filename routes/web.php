<?php
use Illuminate\Support\Facades\Mail;
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



Route::resource('animal','AnimaController');

Route::resource('divpoliticas','DivpoliticaController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('inicio','InicioController');





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




Route::resource('turnos', 'TurnosController');

Route::post('turnos/update', 'TurnosController@update')->name('turnos.update');

Route::get('turnos/destroy/{id}', 'TurnosController@destroy');


Route::get('/enviar',function(){
//return view('');
$to_name='William Puma';
$to_email='dwilgeo95@gmail.com';
$data= array(
    'name'=> "Hola",
);

Mail::send('email',$data,function($message) use ($to_name,$to_email){
    $message->to($to_email)
    ->subject('lalala');
});
});

