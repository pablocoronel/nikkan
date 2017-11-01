<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SeccionEmpresaSliderRequest;

// Modelo 
use App\SeccionEmpresaSlider;

// 
use Session;
use Storage;
use File;

class SeccionEmpresaSliderController extends Controller
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
        $objeto= SeccionEmpresaSlider::all()->toArray();


        return view('adm.seccion_home_sliders.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de sliders']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_home_sliders.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear slider']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionEmpresaSliderRequest $request)
    {
    	// guardar sin imagen
	    $objeto= new SeccionEmpresaSlider([
            'texto' => $request->get('texto'),
            'vinculo' => $request->get('vinculo'),
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

    	//ruta de imagen
    	$rutaDeCarpeta= 'images/seccion_home_sliders/';
    	$idArchivo= SeccionEmpresaSlider::max('id');
    	$nombreArchivo= "slider_".$idArchivo;
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
        $objeto= SeccionEmpresaSlider::find($id);
        return view('adm.seccion_home_sliders.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar slider']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionEmpresaSliderRequest $request, $id)
    {
        //
        $objeto = SeccionEmpresaSlider::find($id);
        $objeto->texto = $request->get('texto');
        $objeto->vinculo = $request->get('vinculo');
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
        	//ruta de imagen
	    	$rutaDeCarpeta= 'images/seccion_home_sliders/';

	        $idArchivo= $id;

	    	$nombreArchivo= "slider_".$idArchivo;
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
        $objeto= SeccionEmpresaSlider::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
