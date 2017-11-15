<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgregarAlCarritoRequest;
use App\Http\Requests\DireccionRequest;

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

        // if (!isset($_SESSION['entrega_direccion'])) { $_SESSION['entrega_direccion']= ''; }
        // if (!isset($_SESSION['entrega_direccion2'])) { $_SESSION['entrega_direccion2']= ''; }
        // if (!isset($_SESSION['entrega_codigo_postal'])) { $_SESSION['entrega_codigo_postal']= ''; }
        // if (!isset($_SESSION['entrega_ciudad'])) { $_SESSION['entrega_ciudad']= ''; }
        // if (!isset($_SESSION['entrega_provincia'])) { $_SESSION['entrega_provincia']= ''; }
        // if (!isset($_SESSION['entrega_pais'])) { $_SESSION['entrega_pais']= ''; }
        // if (!isset($_SESSION['entrega_telefono_domicilio'])) { $_SESSION['entrega_telefono_domicilio']= ''; }
        // if (!isset($_SESSION['entrega_telefono_celular'])) { $_SESSION['entrega_telefono_celular']= ''; }
        // if (!isset($_SESSION['entrega_comentario'])) { $_SESSION['entrega_comentario']= ''; }

        // $_SESSION['facturacion_direccion']= '';
        // $_SESSION['facturacion_direccion2']= '';
        // $_SESSION['facturacion_codigo_postal']= '';
        // $_SESSION['facturacion_ciudad']= '';
        // $_SESSION['facturacion_provincia']= '';
        // $_SESSION['facturacion_pais']= '';
        // $_SESSION['facturacion_telefono_domicilio']= '';
        // $_SESSION['facturacion_telefono_celular']= '';
        // $_SESSION['facturacion_comentario']= '';

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

    public function almacenarDireccionDeEntrega(DireccionRequest $request){
        $_SESSION['entrega_direccion']= $request->get('direccion');
        $_SESSION['entrega_direccion2']= $request->get('direccion2');
        $_SESSION['entrega_codigo_postal']= $request->get('codigo_postal');
        $_SESSION['entrega_ciudad']= $request->get('ciudad');
        $_SESSION['entrega_provincia']= $request->get('provincia');
        $_SESSION['entrega_pais']= $request->get('pais');
        $_SESSION['entrega_telefono_domicilio']= $request->get('telefono_domicilio');
        $_SESSION['entrega_telefono_celular']= $request->get('telefono_celular');
        $_SESSION['entrega_comentario']= $request->get('comentario');

        $request->session()->flash('guardadoDireccionEntrega', 'Dirección de entrega guardada');
        return back();
    }

    public function almacenarDireccionDeFacturacion(DireccionRequest $request){
        $_SESSION['facturacion_direccion']= $request->get('direccion');
        $_SESSION['facturacion_direccion2']= $request->get('direccion2');
        $_SESSION['facturacion_codigo_postal']= $request->get('codigo_postal');
        $_SESSION['facturacion_ciudad']= $request->get('ciudad');
        $_SESSION['facturacion_provincia']= $request->get('provincia');
        $_SESSION['facturacion_pais']= $request->get('pais');
        $_SESSION['facturacion_telefono_domicilio']= $request->get('telefono_domicilio');
        $_SESSION['facturacion_telefono_celular']= $request->get('telefono_celular');
        $_SESSION['facturacion_comentario']= $request->get('comentario');

        $request->session()->flash('guardadoDireccionFacturacion', 'Dirección de facturación guardada');
        return back();
    }

    
    public function verFormularioTransporte(){
        $portada= SeccionColeccionPortada::find(1);

        return view('sitio.carrito_transporte', compact('portada'));
    }

    public function verTerminos(){
        $texto= SeccionTermino::find(1);
        return view('sitio.carrito_terminos', compact('texto'));   
    }
}
