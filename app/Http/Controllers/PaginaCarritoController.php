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

use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;

use DB;
use Session;
use MP;
use Auth;

class PaginaCarritoController extends Controller
{
    //
    public function listarCarrito(){
        $portada= SeccionColeccionPortada::find(1);
    	$contenidoCarrito= Cart::content();

        $coleccionVersiones= array();
        foreach ($contenidoCarrito as $key => $value) {
        
        $version= SeccionTiendaVersion::join('seccion_tienda_productos', 'seccion_tienda_productos.id', '=', 'seccion_tienda_versiones.fk_producto')
        ->join('seccion_tienda_talles', 'seccion_tienda_talles.id', '=', 'seccion_tienda_versiones.fk_talle')
        ->join('seccion_tienda_colores', 'seccion_tienda_colores.id', '=', 'seccion_tienda_versiones.fk_color')
        ->select(DB::raw('seccion_tienda_versiones.*, 
                            seccion_tienda_productos.nombre as nombreProducto,
                            seccion_tienda_productos.precio_con_descuento as precioConDescuento,
                            seccion_tienda_productos.ruta as rutaProducto,
                            seccion_tienda_productos.descripcion as descripcionProducto,

                            seccion_tienda_talles.nombre as nombreTalle,
                            seccion_tienda_colores.nombre as nombreColor'))
        ->where('seccion_tienda_versiones.id', '=', $value->id)
        ->first();

        array_push($coleccionVersiones, $version);
        }

        $collection = Collection::make($coleccionVersiones);
        $versionUnica= $collection->unique();

        return view('sitio.carrito', compact('portada', 'contenidoCarrito', 'versionUnica'));
    }


    public function agregarAlCarrito(AgregarAlCarritoRequest $request){
        $idProducto= $request->idProducto;
        // ver si existe la version
        $version= SeccionTiendaVersion::join('seccion_tienda_productos', 'seccion_tienda_versiones.fk_producto', '=', 'seccion_tienda_productos.id')
                        ->select(DB::raw('seccion_tienda_versiones.*, seccion_tienda_productos.nombre as nombreProducto, seccion_tienda_productos.precio_con_descuento as precioProducto'))
                        ->where('seccion_tienda_versiones.fk_talle', '=', $request->talle)
                        ->where('seccion_tienda_versiones.fk_color', '=', $request->color)
                        ->where('seccion_tienda_versiones.fk_producto', '=', $idProducto)
                        ->first();
                     
        if (is_null($version)) {
            $request->session()->flash('noExisteVersion', 'El talle junto al color elegido no está disponible');
            return back();
        }else{

            if ($request->cantidadElegidos > $version->stock) {
                if ($version->stock < 1) {
                    $mensajeStock= 'Stock no disponible para el talle y color elegido';
                }else{
                    $mensajeStock= 'Stock no disponible para el talle y color elegido, máximo '.$version->stock;
                }

                $request->session()->flash('stockNoDisponible', $mensajeStock);
                return back();
            }

            $buscarItem= Cart::search(function ($cartItem, $rowId) use($version) {
                                            return $cartItem->id === $version->id;
                                        });

            $itemEnCarrito= $buscarItem->first();

            if ($itemEnCarrito) {
                if (($itemEnCarrito->qty + $request->cantidadElegidos) > $version->stock) {
                    $request->session()->flash('stockNoDisponible', 'Superó el stock disponible, máximo '.$version->stock);
                    return back();
                }
            }

            // agregado al carrito
            Cart::add(['id' => $version->id, 'name' => $version->nombreProducto, 'qty' => $request->cantidadElegidos, 'price' => $version->precioProducto])->associate('SeccionTiendaProducto');

            $request->session()->flash('agregado', 'Agregado al carrito');

            return back();
        }

    }


    public function vaciarCarrito(){
        Cart::destroy();

        if (Session::has('cuponUsado')) {
            Session::forget('cuponUsado');
        }
        if (Session::has('descuentoPorcentualCupon')) {
            Session::forget('descuentoPorcentualCupon');
        }

        if (Session::has('descuentosAplicados')) {
            Session::forget('descuentosAplicados');
        }

        return back();
    }

    public function eliminarProductoDelCarrito(Request $request){
        Cart::remove($request->rowId);
        return back();
    }

    public function actualizarCantidadItem(Request $request){
        $version= SeccionTiendaVersion::where('seccion_tienda_versiones.id', '=', $request->idVersion)
                        ->first();

        $buscarItem= Cart::search(function ($cartItem, $rowId) use($version) {
                                            return $cartItem->id === $version->id;
                                        });

        $itemEnCarrito= $buscarItem->first();
        if ($itemEnCarrito) {
            if ($request->nuevaCantidad > $version->stock) {
                $request->session()->flash('stockNoDisponible', 'Superó el stock disponible, máximo '.$version->stock);
                return back();
            }else{
                Cart::update($request->rowId, $request->nuevaCantidad);
            }
        }

        return back();
    }


    // almacenar direccion
    public function verFormularioDireccion(){
        $portada= SeccionColeccionPortada::find(1);

        $listadoProvincia = array(
        'Ciudad de Buenos Aires' => 'Ciudad de Buenos Aires',
        'Buenos Aires' => 'Buenos Aires', 
        'Catamarca' => 'Catamarca',
        'Chaco' => 'Chaco',
        'Chubut' => 'Chubut',
        'Córdoba' => 'Córdoba',
        'Corrientes' => 'Corrientes',
        'Entre Ríos' => 'Entre Ríos',
        'Formosa' => 'Formosa',
        'Jujuy' => 'Jujuy',
        'La Pampa' => 'La Pampa',
        'La Rioja' => 'La Rioja',
        'Mendoza' => 'Mendoza',
        'Misiones' => 'Misiones',
        'Neuquén' => 'Neuquén',
        'Río Negro' => 'Río Negro',
        'Salta' => 'Salta',
        'San Juan' => 'San Juan',
        'San Luis' => 'San Luis',
        'Santa Cruz' => 'Santa Cruz',
        'Santa Fe' => 'Santa Fe',
        'Santiago del Estero' => 'Santiago del Estero',
        'Tierra del Fuego' => 'Tierra del Fuego',
        'Tucumán' => 'Tucumán');

        $listadoPais= array('Argentina' => 'Argentina');

        return view('sitio.carrito_direccion', compact('portada', 'listadoProvincia', 'listadoPais'));
    }

    public function almacenarDireccionDeEntrega(CarritoDireccionRequest $request){
        $request->session()->put('entrega_direccion', $request->get('direccion'));
        $request->session()->put('entrega_direccion2', $request->get('direccion2'));
        $request->session()->put('entrega_codigo_postal', $request->get('codigo_postal'));
        $request->session()->put('entrega_ciudad', $request->get('ciudad'));
        $request->session()->put('entrega_provincia', $request->get('provincia'));
        $request->session()->put('entrega_pais', $request->get('pais'));
        $request->session()->put('entrega_telefono_domicilio', $request->get('telefono_domicilio'));
        $request->session()->put('entrega_telefono_celular', $request->get('telefono_celular'));
        $request->session()->put('entrega_comentario', $request->get('comentario'));
        
        // $_SESSION['entrega_direccion']= $request->get('direccion');
        // $_SESSION['entrega_direccion2']= $request->get('direccion2');
        // $_SESSION['entrega_codigo_postal']= $request->get('codigo_postal');
        // $_SESSION['entrega_ciudad']= $request->get('ciudad');
        // $_SESSION['entrega_provincia']= $request->get('provincia');
        // $_SESSION['entrega_pais']= $request->get('pais');
        // $_SESSION['entrega_telefono_domicilio']= $request->get('telefono_domicilio');
        // $_SESSION['entrega_telefono_celular']= $request->get('telefono_celular');
        // $_SESSION['entrega_comentario']= $request->get('comentario');

        $request->session()->put('entrega', 'facturación guardada');
        
        $request->session()->flash('guardadoDireccionEntrega', 'Dirección de entrega guardada');
        return back();
    }

    public function almacenarDireccionDeFacturacion(CarritoDireccionRequest $request){
        $request->session()->put('facturacion_direccion', $request->get('direccion'));
        $request->session()->put('facturacion_direccion2', $request->get('direccion2'));
        $request->session()->put('facturacion_codigo_postal', $request->get('codigo_postal'));
        $request->session()->put('facturacion_ciudad', $request->get('ciudad'));
        $request->session()->put('facturacion_provincia', $request->get('provincia'));
        $request->session()->put('facturacion_pais', $request->get('pais'));
        $request->session()->put('facturacion_telefono_domicilio', $request->get('telefono_domicilio'));
        $request->session()->put('facturacion_telefono_celular', $request->get('telefono_celular'));
        $request->session()->put('facturacion_comentario', $request->get('comentario'));

        // $_SESSION['facturacion_direccion']= $request->get('direccion');
        // $_SESSION['facturacion_direccion2']= $request->get('direccion2');
        // $_SESSION['facturacion_codigo_postal']= $request->get('codigo_postal');
        // $_SESSION['facturacion_ciudad']= $request->get('ciudad');
        // $_SESSION['facturacion_provincia']= $request->get('provincia');
        // $_SESSION['facturacion_pais']= $request->get('pais');
        // $_SESSION['facturacion_telefono_domicilio']= $request->get('telefono_domicilio');
        // $_SESSION['facturacion_telefono_celular']= $request->get('telefono_celular');
        // $_SESSION['facturacion_comentario']= $request->get('comentario');

        $request->session()->put('facturacion', 'facturación guardada');

        $request->session()->flash('guardadoDireccionFacturacion', 'Dirección de facturación guardada');
        return back();
    }

    
    public function verFormularioTransporte(){
        if (!Session::exists('facturacion')) {
            Session::flash('completar_facturacion', 'complete la dirección de facturacion');
            return redirect('carrito/elegir/direccion');
        }elseif (!Session::exists('entrega')) {
            Session::flash('completar_entrega', 'complete la dirección de entrega');
            return redirect('carrito/elegir/direccion');
        }

        $portada= SeccionColeccionPortada::find(1);

        return view('sitio.carrito_transporte', compact('portada'));
    }

    public function verTerminos(){
        $texto= SeccionTermino::find(1);
        return view('sitio.carrito_terminos', compact('texto'));   
    }

    public function almacenarTransporte(CarritoTransporteRequest $request){
        $request->session()->put('zona_envio', $request->transporte);

        switch ($request->transporte) {
            case 1:
                $precio_envio= 738.10;
                break;

            case 2:
                $precio_envio= 350.90;
                break;

            case 3:
                $precio_envio= 292.82;
                break;

            case 4:
                $precio_envio= 260.15;
                break;

            case 5:
                $precio_envio= 223.85;
                break;

            case 6:
                $precio_envio= 181.50;
                break;

            case 7:
                $precio_envio= 0;
                break;
            
            default:
                $precio_envio= 0;
                break;
        }

        $request->session()->put('precio_envio', $precio_envio);

        return redirect('carrito/elegir/pago');
    }

    public function verFormularioDePago(){
        $portada= SeccionColeccionPortada::find(1);
        $contenidoCarrito= Cart::content();

        $coleccionVersiones= array();
        foreach ($contenidoCarrito as $key => $value) {
        
        $version= SeccionTiendaVersion::join('seccion_tienda_productos', 'seccion_tienda_productos.id', '=', 'seccion_tienda_versiones.fk_producto')
        ->join('seccion_tienda_talles', 'seccion_tienda_talles.id', '=', 'seccion_tienda_versiones.fk_talle')
        ->join('seccion_tienda_colores', 'seccion_tienda_colores.id', '=', 'seccion_tienda_versiones.fk_color')
        ->select(DB::raw('seccion_tienda_versiones.*, 
                            seccion_tienda_productos.nombre as nombreProducto,
                            seccion_tienda_productos.precio_con_descuento as precioConDescuento,
                            seccion_tienda_productos.ruta as rutaProducto,
                            seccion_tienda_productos.descripcion as descripcionProducto,

                            seccion_tienda_talles.nombre as nombreTalle,
                            seccion_tienda_colores.nombre as nombreColor'))
        ->where('seccion_tienda_versiones.id', '=', $value->id)
        ->first();

        array_push($coleccionVersiones, $version);
        }

        $collection = Collection::make($coleccionVersiones);
        $versionUnica= $collection->unique();

        $precio_productos= str_replace(",", "", Cart::total());

        if (Session::has('precio_envio')) {
            $precio_envio= Session::get('precio_envio');
        }else{
            $precio_envio= 0;
        }

        $totalFinal= $precio_productos + $precio_envio;
        // dd($totalFinal);
        Session::put('precio_total', $totalFinal);


        // Mercado pago *******************************************************
        // terminar con /
        $dominioDelSitio= "http://localhost/nikkan/public/";

        $mp = new MP ("618512736778458", "YOBMGVLitH7Y6bfGJ4IC6rDqVTA0lIbQ");
        $mp->sandbox_mode(TRUE);

        $itemsParaMP= array();
        $carritoMP= Cart::content();

        foreach ($carritoMP as $key => $value) {
            $versionMP= SeccionTiendaVersion::join('seccion_tienda_productos', 'seccion_tienda_productos.id', '=', 'seccion_tienda_versiones.fk_producto')
                        ->join('seccion_tienda_talles', 'seccion_tienda_talles.id', '=', 'seccion_tienda_versiones.fk_talle')
                        ->join('seccion_tienda_colores', 'seccion_tienda_colores.id', '=', 'seccion_tienda_versiones.fk_color')
                        ->select(DB::raw('seccion_tienda_versiones.*, 
                                            seccion_tienda_productos.nombre as nombreProducto,
                                            seccion_tienda_productos.precio_con_descuento as precioConDescuento,
                                            seccion_tienda_productos.ruta as rutaProducto,
                                            seccion_tienda_productos.descripcion as descripcionProducto,

                                            seccion_tienda_talles.nombre as nombreTalle,
                                            seccion_tienda_colores.nombre as nombreColor'))
                        ->where('seccion_tienda_versiones.id', '=', $value->id)
                        ->first();


            $agregarItemMP = array(
                'id' => $versionMP->codigo_producto,
                "picture_url" => $dominioDelSitio.$versionMP->codigo_producto,
                "title" => $versionMP->nombreProducto,
                "quantity" => (int)$value->qty,
                "currency_id" => "ARS",
                "unit_price" => $value->price
                );

            array_push($itemsParaMP, $agregarItemMP);
        }

        $agregarCostoEnvio = array(
                'id' => 'costo_envio',
                "picture_url" => '',
                "title" => 'costo de envio',
                "quantity" => 1,
                "currency_id" => "ARS",
                "unit_price" => $precio_envio);

        array_push($itemsParaMP, $agregarCostoEnvio);


        $preference_data = array (
                            "items" => $itemsParaMP,
                            "back_urls" => array(
                                    "success" => $dominioDelSitio."carrito/elegir/pago-guardar",
                                    "failure" => $dominioDelSitio."carrito/elegir/pago",
                                    "pending" => $dominioDelSitio."carrito/elegir/pago-guardar"
                                )
                        );
        // dd($preference_data);

        $preference = $mp->create_preference ($preference_data);

        // print_r ($preference);
        // exit();

        return view('sitio.carrito_pagar', compact('portada', 'contenidoCarrito', 'versionUnica', 'precio_envio', 'totalFinal', 'preference'));
    }

    public function enviarCompraAMercadoPago(){

    }

    public function guardarCompra(){
        // direccion de entrega
        $direccion_entrega= new SeccionCarritoDireccion();
        $direccion_entrega->fk_usuario= Auth::id();
        $direccion_entrega->tipo= 'entrega';
        $direccion_entrega->direccion= Session::get('entrega_direccion');
        $direccion_entrega->direccion2= Session::get('entrega_direccion2');
        $direccion_entrega->codigo_postal= Session::get('entrega_codigo_postal');
        $direccion_entrega->ciudad= Session::get('entrega_ciudad');
        $direccion_entrega->provincia= Session::get('entrega_provincia');
        $direccion_entrega->pais= Session::get('entrega_pais');
        $direccion_entrega->telefono_domicilio= Session::get('entrega_telefono_domicilio');
        $direccion_entrega->telefono_celular= Session::get('entrega_telefono_celular');
        $direccion_entrega->comentario= Session::get('entrega_comentario');

        $direccion_entrega->save();

        // direccion de facturacion
        $direccion_facturacion= new SeccionCarritoDireccion();
        $direccion_facturacion->fk_usuario= Auth::id();
        $direccion_facturacion->tipo= 'facturacion';
        $direccion_facturacion->direccion= Session::get('facturacion_direccion');
        $direccion_facturacion->direccion2= Session::get('facturacion_direccion2');
        $direccion_facturacion->codigo_postal= Session::get('facturacion_codigo_postal');
        $direccion_facturacion->ciudad= Session::get('facturacion_ciudad');
        $direccion_facturacion->provincia= Session::get('facturacion_provincia');
        $direccion_facturacion->pais= Session::get('facturacion_pais');
        $direccion_facturacion->telefono_domicilio= Session::get('facturacion_telefono_domicilio');
        $direccion_facturacion->telefono_celular= Session::get('facturacion_telefono_celular');
        $direccion_facturacion->comentario= Session::get('facturacion_comentario');

        $direccion_facturacion->save();

        // compra del cliente
        $compra= new SeccionCarritoCompra();

        $compra->codigo_compra= uniqid();
        $compra->fk_usuario= Auth::id();
        $compra->precio_envio= Session::get('precio_envio');
        $compra->precio_total= Session::get('precio_total');
        $compra->estado_compra= 'iniciado';
        $compra->fecha_compra= Carbon::now('America/Argentina/Buenos_Aires');

        $fk_direccion_entrega= SeccionCarritoDireccion::where('tipo', '=', 'entrega')
                                    ->select('id')
                                    ->latest('id')
                                    ->first();
        $compra->fk_direccion_entrega= $fk_direccion_entrega->id;

        $fk_direccion_facturacion= SeccionCarritoDireccion::where('tipo', '=', 'facturacion')
                                    ->select('id')
                                    ->latest('id')
                                    ->first();
        $compra->fk_direccion_facturacion= $fk_direccion_facturacion->id;

        $compra->save();

        // cada articulo comprado
        $id_compra_guardada= SeccionCarritoCompra::where('fk_usuario', '=', Auth::id())
                                ->select('id')
                                ->max('id');
        $carrito= Cart::content();
        foreach ($carrito as $key => $value) {
            $cadaVersionComprada= new SeccionCarritoVersionComprada();
            $cadaVersionComprada->fk_compra= $id_compra_guardada;
            $cadaVersionComprada->fk_version= $value->id;
            $cadaVersionComprada->cantidad= $value->qty;
            $cadaVersionComprada->precio_final_cupon= $value->price;
            
            // RESTAR STOCK
            $tablaStock= SeccionTiendaVersion::where('id', '=', $value->id)->first();
            $tablaStock->stock= $tablaStock->stock - $value->qty;
            if ($tablaStock->stock < 0) {
                $tablaStock->stock= 0;
            }

            $tablaStock->save();


            $cadaVersionComprada->save();
        }


        Session::flash('guardado', 'La compra fue realizada correctamente');

        return redirect('carrito/elegir/pago');
    }

    // cupones
    public function ingresarCupon(Request $request){
        $cupon= SeccionTiendaCupon::where('codigo_cupon', '=', $request->cupon)->first();

        if (!$cupon) {
            $request->session()->flash('cupon', 'No es un cupón válido');
            return back();
        }

        $productosAdmitidosCupon= SeccionTiendaCuponProducto::where('fk_cupon', '=', $cupon->id)
                            ->pluck('fk_producto')
                            ->toArray();


        $versionesAdmitidasCupon= SeccionTiendaVersion::whereIn('fk_producto', $productosAdmitidosCupon)
                                ->pluck('id')
                                ->toArray();

        $carrito= Cart::content();
        $valorADescontar= 0;
        $descuentosAplicados= array();
        foreach ($carrito as $key => $value) {
            if (in_array($value->id, $versionesAdmitidasCupon)) {
                if ($cupon->tipo_descuento == 'porcentual') {
                    if (Session::has('cuponUsado')) {
                        $valorADescontar= 0;
                        $mostarDescuentoCupon= Session::get('descuentoPorcentualCupon'.$value->id);
                    }else{
                        $valorADescontar= ($value->price * $cupon->descuento_porcentual) / 100;
                        Session::put('descuentoPorcentualCupon'.$value->id, $valorADescontar);
                        $mostarDescuentoCupon= $valorADescontar;
                    }

                    $value->price= $value->price - $valorADescontar;
                }elseif ($cupon->tipo_descuento == 'monetario') {
                    if (Session::has('cuponUsado')) {
                        $valorADescontar= 0;
                        $mostarDescuentoCupon= $cupon->descuento_monetario;
                    }else{
                        $valorADescontar= $cupon->descuento_monetario;
                        $mostarDescuentoCupon= $valorADescontar;   
                    }

                    $value->price= $value->price - $valorADescontar;
                    if ($value->price < 0) {
                        $value->price= 0;    
                    }
                }
                
                $descuentosAplicados[$value->id]['id']= $value->id;
                $descuentosAplicados[$value->id]['descuento_cupon']= $mostarDescuentoCupon;
            
            }else{
                $descuentosAplicados[$value->id]['id']= $value->id;
                $descuentosAplicados[$value->id]['descuento_cupon']= 0;
            }

        }
        // marcar cupon como usado
        Session::put('cuponUsado', 'Ya ingreso un cupón');

        $request->session()->put('descuentosAplicados', $descuentosAplicados);

        // dd($descuentosAplicados);

        return back();
    }
}
