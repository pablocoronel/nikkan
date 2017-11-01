<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionEmpresaPortadaRequest;

// Modelo 
use App\SeccionEmpresaPortada;

// 
use Session;
use Storage;
use File;

class SeccionEmpresaPortadaController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionEmpresaPortada::all()->toArray();


        return view('adm.seccion_empresa_portadas.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de portada']);
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
    public function store(SeccionEmpresaPortadaRequest $request)
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
        $objeto= SeccionEmpresaPortada::find($id);
        return view('adm.seccion_empresa_portadas.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar portada']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionEmpresaPortadaRequest $request, $id)
    {
        //
        $objeto = SeccionEmpresaPortada::find($id);
        $objeto->texto = $request->get('texto');
        $objeto->titulo = $request->get('titulo');

        if ($request->hasFile('imagen')) {
        	//ruta de imagen
	    	$rutaDeCarpeta= 'images/seccion_empresa_portadas/';

	        $idArchivo= $id;

	    	$nombreArchivo= "portada_".$idArchivo;
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
    }
}
