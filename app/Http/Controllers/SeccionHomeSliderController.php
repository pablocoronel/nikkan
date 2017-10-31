<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SeccionHomeSliderRequest;

// Modelo de usuario
use App\SeccionHomeSlider;

// 
use Session;
use Storage;
use File;

class SeccionHomeSliderController extends Controller
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
        $slider= SeccionHomeSlider::all()->toArray();


        return view('adm.seccion_home_sliders.listar', ['variable' => $slider, 'nombreDeAccion' => 'Lista de sliders']);
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
    public function store(SeccionHomeSliderRequest $request)
    {
    	// guardar sin imagen
	    $slider= new SeccionHomeSlider([
            'texto' => $request->get('texto'),
            'vinculo' => $request->get('vinculo'),
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $slider->save();

    	//ruta de imagen
    	$rutaDeCarpeta= 'images/seccion_home_sliders/';
    	$idArchivo= SeccionHomeSlider::max('id');
    	$nombreArchivo= "slider_".$idArchivo;
    	$extension= $request->imagen->extension();

        $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

        // Subir imagen:
    	$archivo= $request->file('imagen');
        Storage::put($rutaConArchivo, File::get($archivo));

        // guardar ruta
        $slider->ruta = $rutaConArchivo;
        $slider->save();

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
        $slider= SeccionHomeSlider::find($id);
        return view('adm.seccion_home_sliders.editar', compact('slider'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar slider']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionHomeSliderRequest $request, $id)
    {
        //
        $slider = SeccionHomeSlider::find($id);
        $slider->texto = $request->get('texto');
        $slider->vinculo = $request->get('vinculo');
        $slider->orden = $request->get('orden');

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
	        	$slider->ruta = $rutaConArchivo;
	    	}
        }

        $slider->save();

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
        $slider= SeccionHomeSlider::find($id);
        $slider->delete();

        Storage::delete($slider->ruta);

        return back();
    }
}
