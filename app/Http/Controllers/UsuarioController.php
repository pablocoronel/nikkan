<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;

// Modelo de usuario
use App\Usuario;

// 
use Session;

class UsuarioController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= Usuario::all()->toArray();


        return view('adm.usuarios.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de usuarios']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.usuarios.crear', ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear usuario']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $objeto= new Usuario([
            'nivel' => $request->get('nivel'),
            'nombre' => $request->get('nombre'),
            'usuario' => $request->get('usuario'),
            'password' => bcrypt($request->get('clave')),
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
        $objeto= Usuario::find($id);
        return view('adm.usuarios.editar', compact('objeto'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar usuario']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        //
        $objeto = Usuario::find($id);
        $objeto->nombre = $request->get('nombre');
        $objeto->usuario = $request->get('usuario');
        $objeto->nivel = $request->get('nivel');

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
        $objeto= Usuario::find($id);
        $objeto->delete();

        return back();
    }
}
