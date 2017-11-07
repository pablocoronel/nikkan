<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaGaleriaRequest;

// Modelo
use App\SeccionTiendaProducto;
use App\SeccionTiendaGaleria;

// 
use Session;
use Storage;
use File;

class SeccionTiendaGaleriaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idProducto)
    {

    	$producto= SeccionTiendaProducto::find($idProducto);
    	// galeria
        $objeto= SeccionTiendaGaleria::where('fk_producto', $idProducto)->get();


        return view('adm.seccion_tienda_galerias.listar', ['variable' => $objeto, 'producto' => $producto, 'nombreDeAccion' => 'Lista de galerias']);
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

        return view('adm.seccion_tienda_galerias.crear', ['producto' => $producto, 'accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear galería']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaGaleriaRequest $request, $idProducto)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaGaleria([
            'fk_producto' => $idProducto,
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

        //ruta de imagen
        $rutaDeCarpeta= 'images/seccion_tienda_galerias/';
        $idArchivo= SeccionTiendaGaleria::max('id');
        $nombreArchivo= "galeria_".$idProducto."_".$idArchivo;
        $extension= $request->imagen->extension();

        $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

        // Subir imagen:
        $archivo= $request->file('imagen');
        Storage::put($rutaConArchivo, File::get($archivo));

        // guardar ruta
        $objeto->ruta = $rutaConArchivo;
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

        //galeria
        $objeto= SeccionTiendaGaleria::find($id);
    	
    	// producto
    	$producto= SeccionTiendaProducto::find($objeto->fk_producto);
        
        return view('adm.seccion_tienda_galerias.editar', compact('objeto', 'producto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar galería']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaGaleriaRequest $request, $idProducto, $id)
    {
        //
        $objeto = SeccionTiendaGaleria::find($id);
        $objeto->fk_producto = $idProducto;
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
            //ruta de imagen
            $rutaDeCarpeta= 'images/seccion_tienda_galerias/';

            $idArchivo= $id;

            $nombreArchivo= "galeria_".$idProducto."_".$idArchivo;
            $extension= $request->imagen->extension();

            $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

            // Subir imagen:
            $archivo= $request->file('imagen');
            Storage::put($rutaConArchivo, File::get($archivo));

            if ($request->file('imagen')->isValid()) {
                $objeto->ruta = $rutaConArchivo;
            }
        }

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
        $objeto= SeccionTiendaGaleria::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
