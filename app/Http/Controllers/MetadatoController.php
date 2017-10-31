<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MetadatoRequest;

use App\Metadato;

class MetadatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $metadatos= Metadato::all()->toArray();
        return view('adm.metadatos.listar', ['variable' => $metadatos, 'nombreDeAccion' => 'Lista de metadatos']);
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
        $metadato= Metadato::find($id);
        return view('adm.metadatos.editar', compact('metadato'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar metadato']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MetadatoRequest $request, $id)
    {
        //
        $metadato= Metadato::find($id);

        $metadato->seccion= $request->get('seccion');
        $metadato->keyword= $request->get('keyword');
        $metadato->descripcion= $request->get('descripcion');

        $metadato->save();

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
