<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionDocumentoPdfRequest;

// Modelo 
use App\SeccionDocumentoPdf;

// 
use Session;
use Storage;
use File;

class SeccionDocumentoPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionDocumentoPdf::all()->toArray();


        return view('adm.seccion_documento_pdfs.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de documentos']);
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
    public function store(Request $request)
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
        $objeto= SeccionDocumentoPdf::find($id);
        return view('adm.seccion_documento_pdfs.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar documento']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionDocumentoPdfRequest $request, $id)
    {
        //
        $objeto = SeccionDocumentoPdf::find($id);
        $objeto->nombre = $request->get('nombre');
        $objeto->orden = '';

        if ($request->hasFile('documento')) {
            //ruta
            $rutaDeCarpeta= 'documents/afip/';

            $idArchivo= $id;
            // $nombreArchivo= "slider_".$idArchivo;
            $nombreArchivo = $request->file('documento')->getClientOriginalName();

            // $extension= $request->documento->extension();
            // $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;
            $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo;

            // Subir:
            $archivo= $request->file('documento');
            Storage::put($rutaConArchivo, File::get($archivo));

            if ($request->file('documento')->isValid()) {
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
