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

// Secciondes del sitio:
/******************************************/
// Inicio
Route::get('/', 'PaginaHomeController@index');
// http://metal.webserverns.com/~nikkan/

// Administrador:
/******************************************/
Route::group(['prefix' => 'adm'], function() {
    // ver formulario de login
    Route::get('login', function () {
	    return view('adm.login');
	});
	
    // procesar el login
	Route::post('login', 'LoginController@iniciar');



	
	// ********************
    // Con sesion iniciada
    Route::middleware(['loginAdm'])->group(function(){
	    //Incio
		Route::get('/', function(){
			return view('adm.index');
		});

		// Desloguearse
		Route::get('logout', 'LoginController@cerrar');


		// *********************
		// CRUD usuarios de administracion
		Route::resource('usuario', 'UsuarioController');

		// CRUD metadatos
		Route::resource('metadato', 'MetadatoController');

		// CRUD datos de empresa
		Route::resource('dato-empresa', 'DatoEmpresaController');

		// CRUD redes sociales
		Route::resource('redes-sociales', 'RedesSocialesController');

		// CRUD logos
		Route::resource('logo', 'LogoController');

		// CRUD home
		Route::group(['prefix' => 'home'], function() {
			Route::resource('slider', 'SeccionHomeSliderController');
			Route::resource('destacado', 'SeccionHomeDestacadoController');
		});

		// CRUD empresa
		Route::group(['prefix' => 'empresa'], function() {
			Route::resource('portada', 'SeccionEmpresaPortadaController');
			Route::resource('slider', 'SeccionEmpresaSliderController');
		});

		// CRUD showroom
		Route::group(['prefix' => 'showroom'], function() {
			Route::resource('portada', 'SeccionShowroomPortadaController');
			Route::resource('slider', 'SeccionShowroomSliderController');
		});

		// CRUD contacto
		Route::group(['prefix' => 'contacto'], function() {
			Route::resource('portada', 'SeccionContactoPortadaController');
			Route::resource('mapa', 'SeccionContactoMapaController');
		});

		// CRUD campaña
		Route::group(['prefix' => 'campania'], function() {
			Route::resource('slider', 'SeccionCampaniaSliderController');
		});

		// CRUD pdf afip
		Route::group(['prefix' => 'documento'], function() {
			Route::resource('pdf', 'SeccionDocumentoPdfController');
		});
    });
});

