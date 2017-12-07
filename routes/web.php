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
// buscar packages
// https://packalyst.com/

// mercado pago tutorial
// https://medium.com/@lsfiege/integrando-una-app-en-laravel-5-5-con-mercadopago-22ee24e46760

// wordpress
// http://metal.webserverns.com/~nikkan/
// 
// config email
// http://www.derekbliss.com/post/laravel-streamsocketenablecrypto-ssl-operation-failed-with-code-1

// ejemplo mp
// http://germankuber.com.ar/mercagado-pago-checkout-basico

// ejemplo 2
// https://pastebin.com/PcdWNkFt

// consulta ipn
// https://groups.google.com/forum/#!topic/mercadopago-developers/rZqEmTkLwtg

use App\Mail\EmailDeContacto;

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

Route::group(['prefix' => 'login'], function() {
	Route::get('iniciar-sesion', 'LoginController@entrarCliente');
	Route::post('procesarLoginCliente', 'LoginController@iniciarCliente');
	Route::get('cerrar-sesion', 'LoginController@cerrarCliente');
	Route::post('registrar-cliente', 'LoginController@registrarCliente');
});

Route::group(['prefix' => 'carrito'], function() {
	Route::get('/', 'PaginaCarritoController@listarCarrito');
	Route::post('agregar', 'PaginaCarritoController@agregarAlCarrito');
	Route::get('vaciar', 'PaginaCarritoController@vaciarCarrito');
	Route::delete('quitarItem', 'PaginaCarritoController@eliminarProductoDelCarrito');
	Route::post('actualizarCantidadItem', 'PaginaCarritoController@actualizarCantidadItem');
	Route::post('ingresarCupon', 'PaginaCarritoController@ingresarCupon');

	Route::group(['prefix' => 'elegir'], function() {
		Route::get('direccion', 'PaginaCarritoController@verFormularioDireccion');
		Route::post('direccion-entrega', 'PaginaCarritoController@almacenarDireccionDeEntrega');
		Route::post('direccion-facturacion', 'PaginaCarritoController@almacenarDireccionDeFacturacion');
	    //
		Route::get('transporte', 'PaginaCarritoController@verFormularioTransporte');
		Route::get('transporte/terminos', 'PaginaCarritoController@verTerminos');
		Route::post('transporte/proceso', 'PaginaCarritoController@almacenarTransporte');
		
		Route::get('pago', 'PaginaCarritoController@verFormularioDePago');
		Route::get('pago-guardar/{resultadoPago}', 'PaginaCarritoController@guardarCompra');
	});
});

Route::get('notifications/topic/{topic?}/id/{id?}', 'IpnMercadoPagoController@index');


 

Route::get('campania', 'PaginaCampaniaController@index');
Route::get('showroom', 'PaginaShowroomController@index');

Route::group(['prefix' => 'contacto'], function() {
	Route::get('/', 'PaginaContactoController@index');

    Route::post('email', function (Illuminate\Http\Request $request) {
	    Mail::send(new EmailDeContacto($request));

	    Session::flash('enviado', 'Mensaje enviado correctamente');
	    return redirect('contacto');
	});
});

// Administrador:
/******************************************/
Route::group(['prefix' => 'adm'], function() {
    // ver formulario de login
    Route::get('login', function () {
	    return view('adm.login');
	});
	
    // procesar el login
	Route::post('login', 'LoginController@iniciarAdmin');



	
	// ********************
    // Con sesion iniciada
    Route::middleware(['loginAdmin'])->group(function(){
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

			// cupones
			Route::resource('cupon', 'SeccionTiendaCuponController');

			// precios de envio
			Route::resource('transporte', 'SeccionTiendaTransporteController');
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

		// CRUD terminos y condiciones
		Route::group(['prefix' => 'terminos'], function() {
			Route::resource('texto', 'SeccionTerminosController');
		});

		// CRUD coleccion
		Route::group(['prefix' => 'coleccion'], function() {
			Route::resource('portada', 'SeccionColeccionPortadaController');
		});

		// CRUD discontinuo
		Route::group(['prefix' => 'discontinuo'], function() {
			Route::resource('portada', 'SeccionDiscontinuoPortadaController');
		});

		// CRUD compras (ADM)
		Route::resource('compra', 'SeccionCarritoCompraController');
    });
});

