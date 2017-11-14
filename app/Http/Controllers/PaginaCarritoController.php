<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgregarAlCarritoRequest;
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

}
