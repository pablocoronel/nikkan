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
    // Definicion de middleware en cuales metodos usarlo
    // public function __construct(){
    //     $this->middleware('crearHistoria', ['only' => ['create', 'store']]);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adm.usuarios.crear', ['accion' => 'usuario.store', 'verbo' => 'post']);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
