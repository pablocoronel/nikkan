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

use App\SeccionCarritoCompra;

use App\SeccionColeccionPortada;
use App\SeccionDiscontinuoPortada;
use App\SeccionTiendaGaleria;
use App\SeccionTermino;

use Gloudemans\Shoppingcart\Facades\Cart;

use DB;
use Session;
use MP;

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
                $request->session()->flash('stockNoDisponible', 'Stock no disponible para el talle y color elegido, máximo '.$version->stock);
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

            // actualizar stock
            // $version->stock = $version->stock - $request->cantidadElegidos;
            // $version->save();

            // guardar compra
            // $compra= new SeccionCarritoCompra();
            // $compra->fk_version= $version->id;
            // $compra->stock_reservado = $request->cantidadElegidos;
            // $compra->estado_pago= 'reservado';
            // $compra->save();

            return back();
        }

    }


    public function vaciarCarrito(){
        Cart::destroy();
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
        $request->session()->push('entrega.direccion', $request->get('direccion'));
        $request->session()->push('entrega.direccion2', $request->get('direccion2'));
        $request->session()->push('entrega.codigo_postal', $request->get('codigo_postal'));
        $request->session()->push('entrega.ciudad', $request->get('ciudad'));
        $request->session()->push('entrega.provincia', $request->get('provincia'));
        $request->session()->push('entrega.pais', $request->get('pais'));
        $request->session()->push('entrega.telefono_domicilio', $request->get('telefono_domicilio'));
        $request->session()->push('entrega.telefono_celular', $request->get('telefono_celular'));
        $request->session()->push('entrega.comentario', $request->get('comentario'));
        
        // $_SESSION['entrega_direccion']= $request->get('direccion');
        // $_SESSION['entrega_direccion2']= $request->get('direccion2');
        // $_SESSION['entrega_codigo_postal']= $request->get('codigo_postal');
        // $_SESSION['entrega_ciudad']= $request->get('ciudad');
        // $_SESSION['entrega_provincia']= $request->get('provincia');
        // $_SESSION['entrega_pais']= $request->get('pais');
        // $_SESSION['entrega_telefono_domicilio']= $request->get('telefono_domicilio');
        // $_SESSION['entrega_telefono_celular']= $request->get('telefono_celular');
        // $_SESSION['entrega_comentario']= $request->get('comentario');

        $request->session()->flash('guardadoDireccionEntrega', 'Dirección de entrega guardada');
        return back();
    }

    public function almacenarDireccionDeFacturacion(CarritoDireccionRequest $request){
        $request->session()->push('facturacion.direccion', $request->get('direccion'));
        $request->session()->push('facturacion.direccion2', $request->get('direccion2'));
        $request->session()->push('facturacion.codigo_postal', $request->get('codigo_postal'));
        $request->session()->push('facturacion.ciudad', $request->get('ciudad'));
        $request->session()->push('facturacion.provincia', $request->get('provincia'));
        $request->session()->push('facturacion.pais', $request->get('pais'));
        $request->session()->push('facturacion.telefono_domicilio', $request->get('telefono_domicilio'));
        $request->session()->push('facturacion.telefono_celular', $request->get('telefono_celular'));
        $request->session()->push('facturacion.comentario', $request->get('comentario'));

        // $_SESSION['facturacion_direccion']= $request->get('direccion');
        // $_SESSION['facturacion_direccion2']= $request->get('direccion2');
        // $_SESSION['facturacion_codigo_postal']= $request->get('codigo_postal');
        // $_SESSION['facturacion_ciudad']= $request->get('ciudad');
        // $_SESSION['facturacion_provincia']= $request->get('provincia');
        // $_SESSION['facturacion_pais']= $request->get('pais');
        // $_SESSION['facturacion_telefono_domicilio']= $request->get('telefono_domicilio');
        // $_SESSION['facturacion_telefono_celular']= $request->get('telefono_celular');
        // $_SESSION['facturacion_comentario']= $request->get('comentario');

        $request->session()->flash('guardadoDireccionFacturacion', 'Dirección de facturación guardada');
        return back();
    }

    
    public function verFormularioTransporte(){
        if (!Session::exists('facturacion')) {
            Session::flash('completar_facturacion', 'complete la dirección de facturacion');
            return redirect('elegir-direccion');
        }elseif (!Session::exists('entrega')) {
            Session::flash('completar_entrega', 'complete la dirección de entrega');
            return redirect('elegir-direccion');
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

        return redirect('elegir-pago');
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

        // precios:
        $precio_productos= Cart::total();
        $precio_envio= Session::get('precio_envio');
        $totalFinal= $precio_productos + $precio_envio;


        // Mercado pago
        // $mp = new MP ("CLIENT_ID", "CLIENT_SECRET");
        // $mp->sandbox_mode(TRUE);
        // $preference_data = array (
        //                     "items" => array (
        //                         array (
        //                             "title" => "Test",
        //                             "quantity" => 1,
        //                             "currency_id" => "USD",
        //                             "unit_price" => 10.4
        //                         )
        //                     )
        //                 );

        // $preference = $mp->create_preference ($preference_data);

        // print_r ($preference);
        // exit();
        return view('sitio.carrito_pagar', compact('portada', 'contenidoCarrito', 'versionUnica', 'precio_envio', 'totalFinal'));
    }
}
