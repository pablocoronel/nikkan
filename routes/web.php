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

// Inicio
Route::get('/', function () {
    return view('index');
});

// ADministrador

Route::group(['prefix' => 'adm'], function() {
    //Login
	Route::get('/', function(){
		// return view('adm.usuarios.login');
		return view('adm.index');
	});

	Route::post('procesarLogin', function() {
	    //
	});

	// CRUD usuarios de administracion
	Route::resource('usuario', 'UsuarioController');

});

