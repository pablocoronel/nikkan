<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AgregarAlCarritoRequest;

use App\SeccionTiendaFamilia;
use App\SeccionTiendaCategoria;
use App\SeccionTiendaProducto;
use App\SeccionTiendaVersion;

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

        return view('sitio.carrito', compact('portada', 'contenidoCarrito'));
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

}
