<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionShowroomSliderRequest;

// Modelo
use App\SeccionShowroomSlider;

// 
use Session;
use Storage;
use File;

class SeccionShowroomSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionShowroomSlider::all()->toArray();


        return view('adm.seccion_showroom_sliders.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de sliders']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_showroom_sliders.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear slider']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionShowroomSliderRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionShowroomSlider([
            'texto' => '',
            'vinculo' => '',
            'ruta' => '',
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

        //ruta de imagen
        $rutaDeCarpeta= 'images/seccion_showroom_sliders/';
        $idArchivo= SeccionShowroomSlider::max('id');
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
        $objeto= SeccionShowroomSlider::find($id);
        return view('adm.seccion_showroom_sliders.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar slider']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionShowroomSliderRequest $request, $id)
    {
        //
        $objeto = SeccionShowroomSlider::find($id);
        $objeto->texto = '';
        $objeto->vinculo = '';
        $objeto->orden = $request->get('orden');

        if ($request->hasFile('imagen')) {
            //ruta de imagen
            $rutaDeCarpeta= 'images/seccion_showroom_sliders/';

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
        $objeto= SeccionShowroomSlider::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);

        return back();
    }
}
