<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaTalleRequest;

// Modelo
use App\SeccionTiendaTalle;

// 
use Session;

class SeccionTiendaTalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaTalle::all()->toArray();


        return view('adm.seccion_tienda_talles.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de talles']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_tienda_talles.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear talle']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaTalleRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaTalle([
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
        $objeto= SeccionTiendaTalle::find($id);
        return view('adm.seccion_tienda_talles.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar talle']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaTalleRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaTalle::find($id);
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
        $objeto= SeccionTiendaTalle::find($id);
        $objeto->delete();

        return back();
    }
}
