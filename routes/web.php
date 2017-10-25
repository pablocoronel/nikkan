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


// Procesar login
Route::resource('login', 'LoginController');
// Route::post('login', 'LoginController');
// Desloguearse
// Route::get('logout', 'LoginController@logout');

// Administrador
Route::group(['prefix' => 'adm'], function() {
    
    Route::get('login', function () {
	    return view('adm.login');
	});

    // Con sesion iniciada
    Route::middleware(['loginAdm'])->group(function(){
	    //Incio
		Route::get('/', function(){
			return view('adm.index');
		});

		// CRUD usuarios de administracion
		Route::resource('usuario', 'UsuarioController');
    });
});

