<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DatoEmpresaRequest;
use App\DatoEmpresa;

class DatoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dato_empresa= DatoEmpresa::all()->toArray();


        return view('adm.dato_empresas.listar', ['variable' => $dato_empresa, 'nombreDeAccion' => 'Lista de datos']);
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
        $dato_empresa= DatoEmpresa::find($id);
        return view('adm.dato_empresas.editar', compact('dato_empresa'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar datos de empresa']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DatoEmpresaRequest $request, $id)
    {
        //
        $datoempresa = DatoEmpresa::find($id);
        $datoempresa->texto = $request->get('texto');
        
        $datoempresa->save();

        $request->session()->flash('guardado', 'Dato actualizado');
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
