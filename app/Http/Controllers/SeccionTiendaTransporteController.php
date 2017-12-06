<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaTransporteRequest;

// Modelo
use App\SeccionTiendaTransporte;

// 
use Session;

class SeccionTiendaTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaTransporte::all()->toArray();


        return view('adm.seccion_tienda_transportes.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de transportes']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_tienda_transportes.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear transporte']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaTransporteRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaTransporte([
            'nombre' => $request->get('nombre'),
            'orden' => $request->get('orden'),
        ]);

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
        $objeto= SeccionTiendaTransporte::find($id);
        return view('adm.seccion_tienda_transportes.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar transporte']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaTransporteRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaTransporte::find($id);
        $objeto->nombre = $request->get('nombre');
        $objeto->orden = $request->get('orden');

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
        $objeto= SeccionTiendaTransporte::find($id);
        $objeto->delete();

        return back();
    }
}
