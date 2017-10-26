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



// Administrador
Route::group(['prefix' => 'adm'], function() {
    // ver login
    Route::get('login', function () {
	    return view('adm.login');
	});
	
    // procesar el login
	Route::post('login', 'LoginController@iniciar');

	// Desloguearse
	// Route::get('logout', 'LoginController@logout');


	
	// ********************
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

