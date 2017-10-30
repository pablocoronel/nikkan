<?php

namespace App\Http\Controllers;

use App\Logo;
use Illuminate\Http\Request;
use App\Http\Requests\LogoRequest;

use Session;
use Storage;
use File;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $logos= Logo::all()->toArray();


        return view('adm.logos.listar', ['variable' => $logos, 'nombreDeAccion' => 'Lista de logos']);
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
    public function store(LogoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $logo= Logo::find($id);
        return view('adm.logos.editar', compact('logo'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar logo']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(LogoRequest $request, $id)
    {
        //
        $logo = Logo::find($id);
        
        if ($request->hasFile('imagen')) {
            //ruta de imagen
            $rutaDeCarpeta= 'images/logos/';
            
            switch ($logo->id) {
                case 1:
                    $nombreArchivo= 'logo_principal';
                    break;

                case 2:
                    $nombreArchivo= 'logo_footer';
                    break;

                case 3:
                    $nombreArchivo= 'logo_favicon';
                    break;
                
                default:
                    # code...
                    break;
            }
            
            $extension= $request->imagen->extension();

            $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

            // Subir imagen:
            $archivo= $request->file('imagen');
            Storage::put($rutaConArchivo, File::get($archivo));

            if ($request->file('imagen')->isValid()) {
                $logo->ruta = $rutaConArchivo;
            }
        }

        $logo->save();

        $request->session()->flash('guardado', 'logo actualizado');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
