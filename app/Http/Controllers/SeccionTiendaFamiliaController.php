<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaFamiliaRequest;

// Modelo 
use App\SeccionTiendaFamilia;

// 
use Session;
use Storage;
use File;

class SeccionTiendaFamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaFamilia::all()->toArray();


        return view('adm.seccion_tienda_familias.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de familias']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_tienda_familias.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear familia']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaFamiliaRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaFamilia([
            'nombre' => $request->get('nombre'),
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

        //ruta de imagen
        $rutaDeCarpeta= 'images/seccion_tienda_familias/';
        $idArchivo= SeccionTiendaFamilia::max('id');
        $nombreArchivo= "familia_".$idArchivo;
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
    public function edit($id)
    {
        //
        $objeto= SeccionTiendaFamilia::find($id);
        return view('adm.seccion_tienda_familias.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar familia']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaFamiliaRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaFamilia::find($id);
        $objeto->nombre = $request->get('nombre');
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
            //ruta de imagen
            $rutaDeCarpeta= 'images/seccion_tienda_familias/';

            $idArchivo= $id;

            $nombreArchivo= "familia_".$idArchivo;
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
    public function destroy($id)
    {
        //
        $objeto= SeccionTiendaFamilia::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
