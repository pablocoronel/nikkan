<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionHomeDestacadoRequest;

// Modelo de usuario
use App\SeccionHomeDestacado;

// 
use Session;
use Storage;
use File;

class SeccionHomeDestacadoController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionHomeDestacado::all()->toArray();


        return view('adm.seccion_home_destacados.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de destacados']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_home_destacados.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear destacado']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionHomeDestacadoRequest $request)
    {
    	// guardar sin imagen
	    $objeto= new SeccionHomeDestacado([
            'texto' => $request->get('texto'),
            'vinculo' => $request->get('vinculo'),
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

    	//ruta de imagen
    	$rutaDeCarpeta= 'images/seccion_home_destacados/';
    	$idArchivo= SeccionHomeDestacado::max('id');
    	$nombreArchivo= "destacado_".$idArchivo;
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
        $objeto= SeccionHomeDestacado::find($id);
        return view('adm.seccion_home_destacados.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar destacado']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionHomeDestacadoRequest $request, $id)
    {
        //
        $objeto = SeccionHomeDestacado::find($id);
        $objeto->texto = $request->get('texto');
        $objeto->vinculo = $request->get('vinculo');
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
        	//ruta de imagen
	    	$rutaDeCarpeta= 'images/seccion_home_destacados/';

	        $idArchivo= $id;

	    	$nombreArchivo= "destacado_".$idArchivo;
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
        $objeto= SeccionHomeDestacado::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
