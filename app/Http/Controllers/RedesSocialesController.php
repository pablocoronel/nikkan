<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RedesSocialesRequest;

// Modelo 
use App\RedesSociales;

// 
use Session;
use Storage;
use File;

class RedesSocialesController extends Controller
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
        $objeto= RedesSociales::all()->toArray();


        return view('adm.redes_sociales.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de redes sociales']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.redes_sociales.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear red social']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RedesSocialesRequest $request)
    {
    	//ruta de imagen
    	$rutaDeCarpeta= 'images/redes_sociales/';
        $nombreArchivo= $request->get('nombre');
        $ubicacion= $request->get('ubicacion');
    	$extension= $request->imagen->extension();

        $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.$ubicacion.'.'.$extension;

        // Subir imagen:
    	$archivo= $request->file('imagen');
        Storage::put($rutaConArchivo, File::get($archivo));

        if ($request->file('imagen')->isValid()) {
		    $objeto= new RedesSociales([
	            'nombre' => $request->get('nombre'),
	            'ubicacion' => $request->get('ubicacion'),
	            'vinculo' => $request->get('vinculo'),
	            'ruta' => $rutaConArchivo,
	            'orden' => $request->get('orden'),
	        ]);
		}

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
        $objeto= RedesSociales::find($id);
        return view('adm.redes_sociales.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar red social']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RedesSocialesRequest $request, $id)
    {
        //
        $objeto = RedesSociales::find($id);
        $objeto->nombre = $request->get('nombre');
        $objeto->ubicacion = $request->get('ubicacion');
        $objeto->vinculo = $request->get('vinculo');
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
        	//ruta de imagen
	    	$rutaDeCarpeta= 'images/redes_sociales/';
	        $nombreArchivo= $request->get('nombre');
            $ubicacion= $request->get('ubicacion');
	    	$extension= $request->imagen->extension();

	        $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.$ubicacion.'.'.$extension;

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
        $objeto= RedesSociales::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
