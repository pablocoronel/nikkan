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
        $usuarios= Usuario::all()->toArray();


        return view('adm.usuarios.listar', ['listaDeUsuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.usuarios.crear', ['accion' => 'store', 'verbo' => 'post']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $usuario= new Usuario([
            'nivel' => $request->get('nivel'),
            'nombre' => $request->get('nombre'),
            'usuario' => $request->get('usuario'),
            'password' => bcrypt($request->get('clave')),
        ]);

        $usuario->save();

        // para mostrar msj de exito
        Session::flash('guardado', 'Usuario guardado correctamente');
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
        $usuario= Usuario::find($id);
        return view('adm.usuarios.editar', ['accion' => 'update', 'verbo' => 'post'], compact('usuario'));
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
        $usuario = Usuario::find($id);
        $usuario->nombre = $request->get('nombre');
        $usuario->usuario = $request->get('usuario');
        $usuario->nivel = $request->get('nivel');

        $usuario->save();

        $request->session()->flash('guardado', 'Usuario actualizado');
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
        $usuario= Usuario::find($id);
        $usuario->delete();

        return back();
    }
}
