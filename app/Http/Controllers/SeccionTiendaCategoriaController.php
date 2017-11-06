<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaCategoriaRequest;

// Modelo 
use App\SeccionTiendaFamilia;
use App\SeccionTiendaCategoria;

// 
use Session;
use Storage;
use File;

class SeccionTiendaCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaCategoria::all()->toArray();


        return view('adm.seccion_tienda_categorias.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de categorias']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $matrizListado= SeccionTiendaFamilia::select('id', 'nombre')->get();
        $arrayListado = array();

        foreach($matrizListado as $arr) {
            $arrayListado[$arr->id] = $arr->nombre;
        }

        return view('adm.seccion_tienda_categorias.crear', ['arrayListado' => $arrayListado, 'accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear categoria']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaCategoriaRequest $request)
    {
        $objeto= new SeccionTiendaCategoria([
            'fk_familia' => $request->get('fk_familia'),
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

        $objeto= SeccionTiendaCategoria::find($id);
        
        $matrizListado= SeccionTiendaFamilia::select('id', 'nombre')->get();
        $arrayListado = array();
        
        foreach($matrizListado as $arr) {
            $arrayListado[$arr->id] = $arr->nombre;
        }
        
        return view('adm.seccion_tienda_categorias.editar', compact('objeto'), ['arrayListado' => $arrayListado, 'accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar categoria']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaCategoriaRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaCategoria::find($id);
        $objeto->fk_familia = $request->get('fk_familia');
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
        $objeto= SeccionTiendaCategoria::find($id);
        $objeto->delete();

        return back();
    }
}
