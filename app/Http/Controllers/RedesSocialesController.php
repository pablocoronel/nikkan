<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RedesSocialesRequest;

// Modelo de usuario
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
        $redes= RedesSociales::all()->toArray();


        return view('adm.redes_sociales.listar', ['variable' => $redes, 'nombreDeAccion' => 'Lista de redes sociales']);
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
		    $red= new RedesSociales([
	            'nombre' => $request->get('nombre'),
	            'ubicacion' => $request->get('ubicacion'),
	            'vinculo' => $request->get('vinculo'),
	            'ruta' => $rutaConArchivo,
	            'orden' => $request->get('orden'),
	        ]);
		}

        $red->save();

        // para mostrar msj de exito
        Session::flash('guardado', 'Red social creada correctamente');
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
        $red= RedesSociales::find($id);
        return view('adm.redes_sociales.editar', compact('red'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar red social']);
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
        $red = RedesSociales::find($id);
        $red->nombre = $request->get('nombre');
        $red->ubicacion = $request->get('ubicacion');
        $red->vinculo = $request->get('vinculo');
        $red->orden = $request->get('orden');

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
	        	$red->ruta = $rutaConArchivo;
	    	}
        }

        $red->save();

        $request->session()->flash('guardado', 'red social actualizada');
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
        $red= RedesSociales::find($id);
        $red->delete();

        Storage::delete($red->ruta);

        return back();
    }
}
