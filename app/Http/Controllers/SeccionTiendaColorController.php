<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaColorRequest;

// Modelo
use App\SeccionTiendaColor;

// 
use Session;

class SeccionTiendaColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaColor::all()->toArray();


        return view('adm.seccion_tienda_colores.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de colores']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_tienda_colores.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear color']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaColorRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaColor([
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
        $objeto= SeccionTiendaColor::find($id);
        return view('adm.seccion_tienda_colores.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar color']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaColorRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaColor::find($id);
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
        $objeto= SeccionTiendaColor::find($id);
        $objeto->delete();

        return back();
    }
}
