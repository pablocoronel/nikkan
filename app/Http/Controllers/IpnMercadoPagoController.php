<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgregarAlCarritoRequest;
use App\Http\Requests\CarritoDireccionRequest;
use App\Http\Requests\CarritoTransporteRequest;

use Illuminate\Support\Collection;

use App\SeccionTiendaFamilia;
use App\SeccionTiendaCategoria;
use App\SeccionTiendaProducto;
use App\SeccionTiendaVersion;
use App\SeccionTiendaTalle;
use App\SeccionTiendaColor;

use App\SeccionColeccionPortada;
use App\SeccionDiscontinuoPortada;
use App\SeccionTiendaGaleria;
use App\SeccionTermino;

use App\SeccionCarritoCompra;
use App\SeccionCarritoDireccion;
use App\SeccionCarritoVersionComprada;

use App\SeccionTiendaCupon;
use App\SeccionTiendaCuponProducto;
use App\Usuario;

use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Shipnow;
use DB;
use Session;
use MP;
use Auth;

class IpnMercadoPagoController extends Controller
{
	public function __construct()
    {
        define('DOMINIO_SITIO', "http://localhost/nikkan/public/");
    }
    //
    public function index($topic= null, $id= null)
    {
    	$dominioDelSitio= DOMINIO_SITIO;
    	$mp = new MP ("618512736778458", "YOBMGVLitH7Y6bfGJ4IC6rDqVTA0lIbQ");
        $mp->sandbox_mode(TRUE);

        $params = ["access_token" => $mp->get_access_token()];
		// Check mandatory parameters
		if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
			http_response_code(400);
			return;
		}
		// else{
		// 	http_response_code(200);
		//     return;
		// }


		// Get the payment reported by the IPN. Glossary of attributes response in https://developers.mercadopago.com
		if($_GET["topic"] == 'payment'){
			$payment_info = $mp->get("/collections/notifications/" . $_GET["id"], $params, false);
			$merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"], $params, false);
		// Get the merchant_order reported by the IPN. Glossary of attributes response in https://developers.mercadopago.com	
		}else if($_GET["topic"] == 'merchant_order'){
			$merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"], $params, false);
		}
		//If the payment's transaction amount is equal (or bigger) than the merchant order's amount you can release your items 
		if ($merchant_order_info["status"] == 200) {
			$transaction_amount_payments= 0;
			$transaction_amount_order = $merchant_order_info["response"]["total_amount"];
		    $payments=$merchant_order_info["response"]["payments"];
		    foreach ($payments as  $payment) {
		    	if($payment['status'] == 'approved'){
			    	$transaction_amount_payments += $payment['transaction_amount'];
			    }	
		    }

		    if($transaction_amount_payments >= $transaction_amount_order){		    	
		    	// shipnow
                // $shipnow = new \App\Shipnow("contacto@nikka-n.com.ar", "Drcooper2017", "/cacert/cacert.pem");
		    	$shipnow = new \App\Shipnow("soporte@osole.es", "Osole2017", "/cacert/cacert.pem");

		    	// $idCompra= SeccionCarritoCompra::where('codigo_compra', '=', 'nikkan5a2812d342c14')
		    	$idCompra= SeccionCarritoCompra::where('codigo_compra', '=', $payment_info["response"]["collection"]["external_reference"])
		    						->value('id');

                $versionesCompradas= SeccionCarritoVersionComprada::where('fk_compra', $idCompra)
                                ->get();
                // dd($versionesCompradas);
                                
                $itemsDeShipnow = array();
                foreach ($versionesCompradas as $key => $value) {
                    // dd($value);
                    $versionSN= SeccionTiendaVersion::join('seccion_tienda_productos', 'seccion_tienda_productos.id', '=', 'seccion_tienda_versiones.fk_producto')
                        ->join('seccion_carrito_versiones_compradas', 'seccion_carrito_versiones_compradas.fk_version', '=', 'seccion_tienda_versiones.id')
                        ->select(DB::raw('seccion_tienda_versiones.*, 
                                            seccion_tienda_productos.nombre as nombreProducto,
                                            seccion_tienda_productos.precio_con_descuento as precioConDescuento,
                                            seccion_tienda_productos.ruta as rutaProducto,
                                            seccion_tienda_productos.descripcion as descripcionProducto,

                                            seccion_carrito_versiones_compradas.cantidad as cantidadVersionComprada,
                                            seccion_carrito_versiones_compradas.precio_final_cupon as precioVersion'))
                        ->where('seccion_tienda_versiones.id', '=', $value->fk_version)
                        ->first();
					
					// dd($versionSN);

                    $agregarItemShipnow = array(
                        "id" => $versionSN->id_shipnow,
                        "external_reference" => $versionSN->codigo_producto,
                        "quantity" => $versionSN->cantidadVersionComprada,
                        "unit_price" => $versionSN->precioConDescuento,
                        "title" => $versionSN->nombreProducto,
                        "image_url" => $dominioDelSitio.$versionSN->rutaProducto
                        );
                	// dd($agregarItemShipnow);
                    array_push($itemsDeShipnow, $agregarItemShipnow);
                }


                try {
                    $shipnow->login();
                } catch (Exception $e) {
                    echo 'Error: '.$e->getMessage();
                } finally {
		    	     $idCompradror= SeccionCarritoCompra::where('codigo_compra', '=', $payment_info["response"]["collection"]["external_reference"])
                	// $idCompradror= SeccionCarritoCompra::where('codigo_compra', '=', 'nikkan5a2812d342c14')
		    						->value('fk_usuario');
                	
                	$comprador= Usuario::join('seccion_carrito_direcciones', 'seccion_carrito_direcciones.fk_usuario', '=', 'users.id')
                        ->select(DB::raw('seccion_carrito_direcciones.*, 
                                            users.nombre as nombreUsuario,
                                            users.apellido as apellidoUsuario,
                                            users.email as emailUsuario'))
                        ->where('users.id', '=', $idCompradror)
                        ->where('seccion_carrito_direcciones.tipo', '=', 'entrega')
                        ->first();

                    // dd($comprador);

                    $telefono= '';
                    if ($comprador->telefono_celular != '') {
                        $telefono= $comprador->telefono_celular;
                    }else{
                        $telefono= $comprador->telefono_domicilio;
                    }

                    $order = [
                        'external_reference' => $payment_info["response"]["collection"]["external_reference"],
                        // 'external_reference' => 'nikkan5a2812d342c14',
                        'ship_to' => [
                            'name' => $comprador->nombreUsuario,
                            'last_name' => $comprador->apellidoUsuario,
                            "phone" => $telefono,
                            'zip_code' => $comprador->codigo_postal,
                            'address_line' => $comprador->direccion,
                            'city' => $comprador->ciudad,
                            'state' => $comprador->provincia,
                            'email' => $comprador->emailUsuario
                        ],
                        'items'   => $itemsDeShipnow,
                        "shipping_category" => "economic",
                    ];

                    // dd($order);

                    try {
                        $response = $shipnow->createOrder($order);
                    } catch (Exception $e) {
                        echo 'Error: '.$e->getMessage();
                    }

                    // dd($response);
                }
            
		    }
		}
    }
}
