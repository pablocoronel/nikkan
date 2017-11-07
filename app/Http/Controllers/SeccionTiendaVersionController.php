<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaVersionRequest;

// Modelo
use App\SeccionTiendaVersion;
use App\SeccionTiendaProducto;
use App\SeccionTiendaColor;
use App\SeccionTiendaTalle;

use Session;
use DB;

class SeccionTiendaVersionController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idProducto)
    {

    	$producto= SeccionTiendaProducto::find($idProducto);
    	// galeria
        // $objeto= SeccionTiendaVersion::where('fk_producto', $idProducto)->get();
        $objeto= SeccionTiendaVersion::join('seccion_tienda_colores', 'seccion_tienda_versiones.fk_color', '=', 'seccion_tienda_colores.id')
            ->join('seccion_tienda_talles', 'seccion_tienda_versiones.fk_talle', '=', 'seccion_tienda_talles.id')
            // ->select('seccion_tienda_versiones.*', 'seccion_tienda_colores.nombre', 'seccion_tienda_talles.nombre')
            ->select(DB::raw('seccion_tienda_versiones.*, seccion_tienda_colores.nombre as nombreColor, seccion_tienda_talles.nombre as nombreTalle'))
            ->get();

        return view('adm.seccion_tienda_versiones.listar', ['variable' => $objeto, 'producto' => $producto, 'nombreDeAccion' => 'Lista de versiones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idProducto)
    {
        //
        $producto= SeccionTiendaProducto::find($idProducto);

        // color
        $matrizListadoColor= SeccionTiendaColor::select('id', 'nombre')->get();
        $arrayListadoColor = array();

        foreach($matrizListadoColor as $arr) {
            $arrayListadoColor[$arr->id] = $arr->nombre;
        }

        // talle
        $matrizListadoTalle= SeccionTiendaTalle::select('id', 'nombre')->get();
        $arrayListadoTalle = array();

        foreach($matrizListadoTalle as $arr) {
            $arrayListadoTalle[$arr->id] = $arr->nombre;
        }

        return view('adm.seccion_tienda_versiones.crear', compact('arrayListadoColor', 'arrayListadoTalle'), ['producto' => $producto, 'accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear version']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaVersionRequest $request, $idProducto)
    {
        $objeto= new SeccionTiendaVersion([
            'fk_producto' => $idProducto,
            'fk_color' => $request->get('fk_color'),
            'fk_talle' => $request->get('fk_talle'),
            'stock' => $request->get('stock'),
        ]);

        $objeto->save();

        // para mostrar msj de exito
        Session::flash('guardado', 'creado correctamente');
        return back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto, $id)
    {

        //version
        $objeto= SeccionTiendaVersion::find($id);
    	
    	// producto
    	$producto= SeccionTiendaProducto::find($objeto->fk_producto);

    	// color
        $matrizListadoColor= SeccionTiendaColor::select('id', 'nombre')->get();
        $arrayListadoColor = array();
        foreach($matrizListadoColor as $arr) {
            $arrayListadoColor[$arr->id] = $arr->nombre;
        }

        // talle
        $matrizListadoTalle= SeccionTiendaTalle::select('id', 'nombre')->get();
        $arrayListadoTalle = array();
        foreach($matrizListadoTalle as $arr) {
            $arrayListadoTalle[$arr->id] = $arr->nombre;
        }
        
        return view('adm.seccion_tienda_versiones.editar', compact('objeto', 'producto', 'arrayListadoColor', 'arrayListadoTalle'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar version']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaVersionRequest $request, $idProducto, $id)
    {
        //
        $objeto = SeccionTiendaVersion::find($id);

        $objeto->fk_producto = $idProducto;
        $objeto->fk_color = $request->get('fk_color');
        $objeto->fk_talle = $request->get('fk_talle');
        $objeto->stock = $request->get('stock');

        $objeto->save();

        $request->session()->flash('guardado', 'cambios guardados');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProducto, $id)
    {
        //
        $objeto= SeccionTiendaVersion::find($id);
        $objeto->delete();

        return back();
    }
}
