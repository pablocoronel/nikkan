<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaCuponRequest;

// Modelo
use App\SeccionTiendaCupon;

// 
use Session;

class SeccionTiendaCuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaCupon::all()->toArray();


        return view('adm.seccion_tienda_cupones.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de cupones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.seccion_tienda_cupones.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear cupón']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaCuponRequest $request)
    {
        // guardar sin imagen
        $objeto= new SeccionTiendaCupon([
            'codigo_cupon' => $request->get('codigo_cupon'),
            'vigencia_inicio' => $request->get('vigencia_inicio'),
            'vigencia_fin' => $request->get('vigencia_fin'),
            'tipo_descuento' => $request->get('tipo_descuento'),
            'descuento_porcentual' => $request->get('descuento_porcentual'),
            'descuento_monetario' => $request->get('descuento_monetario')
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
        $objeto= SeccionTiendaCupon::find($id);
        return view('adm.seccion_tienda_cupones.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar cupón']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaCuponRequest $request, $id)
    {
        //
        $objeto = SeccionTiendaCupon::find($id);
        // $objeto->codigo_cupon = $request->get('codigo_cupon');
        $objeto->vigencia_inicio = $request->get('vigencia_inicio');
        $objeto->vigencia_fin = $request->get('vigencia_fin');
        $objeto->tipo_descuento = $request->get('tipo_descuento');
        $objeto->descuento_porcentual = $request->get('descuento_porcentual');
        $objeto->descuento_monetario = $request->get('descuento_monetario');
        
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
        $objeto= SeccionTiendaCupon::find($id);
        $objeto->delete();

        return back();
    }
}
