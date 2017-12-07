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
        $objeto= SeccionTiendaTransporte::orderBy('provincia', 'asc')->paginate(15);
        // ->toArray();


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
        $listadoProvincia = array(
        'Capital Federal' => 'Capital Federal',
        'Buenos Aires (GBA)' => 'Buenos Aires (GBA)',
        'Buenos Aires' => 'Buenos Aires', 
        'Catamarca' => 'Catamarca',
        'Chaco' => 'Chaco',
        'Chubut' => 'Chubut',
        'Córdoba' => 'Córdoba',
        'Corrientes' => 'Corrientes',
        'Entre Ríos' => 'Entre Ríos',
        'Formosa' => 'Formosa',
        'Jujuy' => 'Jujuy',
        'La Pampa' => 'La Pampa',
        'La Rioja' => 'La Rioja',
        'Mendoza' => 'Mendoza',
        'Misiones' => 'Misiones',
        'Neuquén' => 'Neuquén',
        'Río Negro' => 'Río Negro',
        'Salta' => 'Salta',
        'San Juan' => 'San Juan',
        'San Luis' => 'San Luis',
        'Santa Cruz' => 'Santa Cruz',
        'Santa Fe' => 'Santa Fe',
        'Santiago del Estero' => 'Santiago del Estero',
        'Tierra del Fuego' => 'Tierra del Fuego',
        'Tucumán' => 'Tucumán');

        return view('adm.seccion_tienda_transportes.crear', compact('listadoProvincia'), ['accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear transporte']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaTransporteRequest $request)
    {
        $peso= explode('-', $request->get('peso'));
        $peso_minimo= $peso[0];
        $peso_maximo= $peso[1];

        $objeto= new SeccionTiendaTransporte([
            'provincia' => $request->get('provincia'),
            'peso_minimo' => $peso_minimo,
            'peso_maximo' => $peso_maximo,
            'precio' => $request->get('precio'),
            // 'orden' => $request->get('orden'),
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
        $listadoProvincia = array(
        'Capital Federal' => 'Capital Federal',
        'Buenos Aires (GBA)' => 'Buenos Aires (GBA)',
        'Buenos Aires' => 'Buenos Aires', 
        'Catamarca' => 'Catamarca',
        'Chaco' => 'Chaco',
        'Chubut' => 'Chubut',
        'Córdoba' => 'Córdoba',
        'Corrientes' => 'Corrientes',
        'Entre Ríos' => 'Entre Ríos',
        'Formosa' => 'Formosa',
        'Jujuy' => 'Jujuy',
        'La Pampa' => 'La Pampa',
        'La Rioja' => 'La Rioja',
        'Mendoza' => 'Mendoza',
        'Misiones' => 'Misiones',
        'Neuquén' => 'Neuquén',
        'Río Negro' => 'Río Negro',
        'Salta' => 'Salta',
        'San Juan' => 'San Juan',
        'San Luis' => 'San Luis',
        'Santa Cruz' => 'Santa Cruz',
        'Santa Fe' => 'Santa Fe',
        'Santiago del Estero' => 'Santiago del Estero',
        'Tierra del Fuego' => 'Tierra del Fuego',
        'Tucumán' => 'Tucumán');

        $objeto= SeccionTiendaTransporte::find($id);

        return view('adm.seccion_tienda_transportes.editar', compact('objeto', 'listadoProvincia'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar transporte']);
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
        $peso= explode('-', $request->get('peso'));
        $peso_minimo= $peso[0];
        $peso_maximo= $peso[1];

        $objeto = SeccionTiendaTransporte::find($id);
        $objeto->provincia = $request->get('provincia');
        $objeto->peso_minimo = $peso_minimo;
        $objeto->peso_maximo = $peso_maximo;
        $objeto->precio = $request->get('precio');
        // $objeto->orden = $request->get('orden');

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
