<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelo 
use App\SeccionCarritoCompra;
use App\SeccionCarritoDireccion;
use App\SeccionCarritoVersionComprada;

use App\SeccionTiendaVersion;

use DB;

class SeccionCarritoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $objeto= SeccionCarritoCompra::all()->toArray();
        // $objeto= SeccionCarritoCompra::paginate(10);
        $objeto= SeccionCarritoCompra::join('seccion_carrito_direcciones', 'seccion_carrito_compras.fk_direccion_entrega', '=', 'seccion_carrito_direcciones.id')
        ->select('seccion_carrito_compras.*', 'seccion_carrito_direcciones.provincia', 'seccion_carrito_direcciones.ciudad')
        ->orderBy('seccion_carrito_compras.fecha_compra', 'desc')->paginate(10);

        $arrayEstadoCompra= array(
                        'iniciado' => 'iniciado',
                        'pagado' => 'pagado',
                        'cancelado' => 'cancelado');

        return view('adm.seccion_carrito_compras.listar', ['variable' => $objeto, 'arrayEstadoCompra' => $arrayEstadoCompra, 'nombreDeAccion' => 'Lista de compras']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $objeto= SeccionCarritoVersionComprada::join('seccion_tienda_versiones', 'seccion_carrito_versiones_compradas.fk_version', '=', 'seccion_tienda_versiones.id')
        ->join('seccion_tienda_productos', 'seccion_tienda_productos.id', '=', 'seccion_tienda_versiones.fk_producto')
        ->join('seccion_tienda_talles', 'seccion_tienda_talles.id', '=', 'seccion_tienda_versiones.fk_talle')
        ->join('seccion_tienda_colores', 'seccion_tienda_colores.id', '=', 'seccion_tienda_versiones.fk_color')
        ->select(DB::raw('seccion_carrito_versiones_compradas.*,
                            seccion_tienda_versiones.id as versionId,
                            seccion_tienda_versiones.codigo_producto as versionCodigoProducto, 
                            seccion_tienda_productos.nombre as productoNombre, 
                            seccion_tienda_productos.ruta as productoRuta,
                            seccion_tienda_productos.precio_original as productoPrecioOriginal,
                            seccion_tienda_productos.precio_con_descuento as productoPrecioConDescuento,
                            seccion_tienda_productos.descuento as productoDescuento,
                            seccion_tienda_talles.nombre as talleNombre, 
                            seccion_tienda_colores.nombre as colorNombre'))

        ->where('seccion_carrito_versiones_compradas.fk_compra', '=', $id)->get();

        return view('adm.seccion_carrito_compras.ver', ['variable' => $objeto, 'nombreDeAccion' => 'Ver compra']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $compra= SeccionCarritoCompra::where('id', '=', $id)->first();
        $compra->estado_compra= $request->estado_compra;

        $compra->save();

        return redirect('adm/compra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
