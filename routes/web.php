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
Route::get('empresa', 'PaginaEmpresaController@index');

Route::group(['prefix' => 'tienda/{tipoDeColeccion}'], function() {
	Route::get('/', 'PaginaTiendaController@listadoDeFamilias');
    Route::get('familia/{idFamilia}', 'PaginaTiendaController@listadoDeProductos');
    Route::post('familia/{idFamilia}', 'PaginaTiendaController@filtrarPorCategoria');
    Route::get('producto/{idProducto}', 'PaginaTiendaController@verProducto');
});

Route::group(['prefix' => 'carrito'], function() {
	Route::get('/', 'PaginaCarritoController@listarCarrito');
	Route::post('agregar/{$idProducto}', 'PaginaCarritoController@agregarAlCarrito');
});

Route::get('campania', 'PaginaCampaniaController@index');
Route::get('showroom', 'PaginaShowroomController@index');
Route::group(['prefix' => 'contacto'], function() {
	Route::get('/', 'PaginaContactoController@index');
    Route::post('enviarEmail', 'PaginaContactoController@enviarEmail');
});
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

		// CRUD tienda
		Route::group(['prefix' => 'tienda'], function() {
			Route::resource('familia', 'SeccionTiendaFamiliaController');
			Route::resource('categoria', 'SeccionTiendaCategoriaController');
			Route::resource('producto', 'SeccionTiendaProductoController');
			Route::resource('color', 'SeccionTiendaColorController');
			Route::resource('talle', 'SeccionTiendaTalleController');

			// galeria de cada producto
			Route::resource('producto/{idProducto}/galeria', 'SeccionTiendaGaleriaController');
			// galeria de cada producto
			// Route::get('producto/{idProducto}/galeria/', 'SeccionTiendaGaleriaController@index');
			// Route::get('producto/{idProducto}/galeria/crear', 'SeccionTiendaGaleriaController@create');
			// Route::post('producto/{idProducto}/galeria/', 'SeccionTiendaGaleriaController@store');
			// Route::get('producto/{idProducto}/galeria/{idGaleria}/editar', 'SeccionTiendaGaleriaController@edit');
			// Route::patch('producto/{idProducto}/galeria/{idGaleria}/', 'SeccionTiendaGaleriaController@update');
			// Route::delete('producto/{idProducto}/galeria/{idGaleria}/', 'SeccionTiendaGaleriaController@destroy');

		    // version de cada producto
			Route::resource('producto/{idProducto}/version', 'SeccionTiendaVersionController');
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

		// CRUD coleccion
		Route::group(['prefix' => 'coleccion'], function() {
			Route::resource('portada', 'SeccionColeccionPortadaController');
		});

		// CRUD discontinuo
		Route::group(['prefix' => 'discontinuo'], function() {
			Route::resource('portada', 'SeccionDiscontinuoPortadaController');
		});
    });
});

