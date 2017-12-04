<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaVersionRequest;

// Modelo
use App\SeccionTiendaVersion;
use App\SeccionTiendaProducto;
use App\SeccionTiendaColor;
use App\SeccionTiendaTalle;

use App\Shipnow;

use Session;
use DB;

class SeccionTiendaVersionController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idProducto)
    {

    	$producto= SeccionTiendaProducto::find($idProducto);
        $objeto= SeccionTiendaVersion::join('seccion_tienda_colores', 'seccion_tienda_versiones.fk_color', '=', 'seccion_tienda_colores.id')
            ->join('seccion_tienda_talles', 'seccion_tienda_versiones.fk_talle', '=', 'seccion_tienda_talles.id')
            ->select(DB::raw('seccion_tienda_versiones.*, seccion_tienda_colores.nombre as nombreColor, seccion_tienda_talles.nombre as nombreTalle'))
            ->where('fk_producto', '=', $idProducto)
            ->get();

        return view('adm.seccion_tienda_versiones.listar', ['variable' => $objeto, 'producto' => $producto, 'nombreDeAccion' => 'Lista de versiones']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idProducto)
    {
        //
        $producto= SeccionTiendaProducto::find($idProducto);

        // color
        $matrizListadoColor= SeccionTiendaColor::select('id', 'nombre')->get();
        $arrayListadoColor = array();

        foreach($matrizListadoColor as $arr) {
            $arrayListadoColor[$arr->id] = $arr->nombre;
        }

        // talle
        $matrizListadoTalle= SeccionTiendaTalle::select('id', 'nombre')->get();
        $arrayListadoTalle = array();

        foreach($matrizListadoTalle as $arr) {
            $arrayListadoTalle[$arr->id] = $arr->nombre;
        }

        return view('adm.seccion_tienda_versiones.crear', compact('arrayListadoColor', 'arrayListadoTalle'), ['producto' => $producto, 'accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear version']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaVersionRequest $request, $idProducto)
    {
        $producto= SeccionTiendaProducto::find($idProducto);
        $color= SeccionTiendaColor::find($request->get('fk_color'));
        $talle= SeccionTiendaTalle::find($request->get('fk_talle'));


        $objeto= new SeccionTiendaVersion([
            'fk_producto' => $idProducto,
            'fk_color' => $request->get('fk_color'),
            'fk_talle' => $request->get('fk_talle'),
            'stock' => $request->get('stock'),
            // 'codigo_producto' => $codigo_producto,
            'id_shipnow' => $responseProducto['id']
        ]);

        $objeto->save();

        $razon_social= 'ON';
        $nombre_producto= substr(strtoupper($producto->nombre), 0, 3);
        $nombre_color= substr(strtoupper($color->nombre), 0, 3);
        $nombre_talle= $talle->nombre;
        // aca
        $id_version= SeccionTiendaVersion::max('id');

        $codigo_producto= $razon_social.$nombre_producto.$nombre_color.$nombre_talle;

        //version
        $objeto= SeccionTiendaVersion::find($id);
        $objeto->codigo_producto = $codigo_producto;
        $objeto->save();


        // shipnow
        $shipnow = new \App\Shipnow("contacto@nikka-n.com.ar", "Drcooper2017", "/cacert/cacert.pem");


        try {
            $shipnow->login();
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        } finally {
            $crear_producto= [
                'external_reference' => $codigo_producto,
                'title' => $producto->nombre,
                'image_url' => $producto->ruta
            ];
            
            $responseProducto = $shipnow->createProduct($crear_producto);
            
            // dd($responseProducto);
        }

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
    public function edit($idProducto, $id)
    {
        //version
        $objeto= SeccionTiendaVersion::find($id);
    	
    	// producto
    	$producto= SeccionTiendaProducto::find($objeto->fk_producto);

    	// color
        $matrizListadoColor= SeccionTiendaColor::select('id', 'nombre')->get();
        $arrayListadoColor = array();
        foreach($matrizListadoColor as $arr) {
            $arrayListadoColor[$arr->id] = $arr->nombre;
        }

        // talle
        $matrizListadoTalle= SeccionTiendaTalle::select('id', 'nombre')->get();
        $arrayListadoTalle = array();
        foreach($matrizListadoTalle as $arr) {
            $arrayListadoTalle[$arr->id] = $arr->nombre;
        }

        // *****************
        // $shipnow = new \App\Shipnow("contacto@nikka-n.com.ar", "Drcooper2017", "/cacert/cacert.pem");

        // $crear_producto= [
        //     'external_reference' => $objeto->codigo_producto,
        //     'title' => $producto->nombre,
        //     'image_url' => $producto->ruta
        // ];

        // try {
        //     $shipnow->login();
        // } catch (Exception $e) {
        //     echo 'Error: '.$e->getMessage();
        // } finally {
        //     $responseProducto = $shipnow->createProduct($crear_producto);
            
        //     dd($responseProducto);
        // }

        // ***************
        
        return view('adm.seccion_tienda_versiones.editar', compact('objeto', 'producto', 'arrayListadoColor', 'arrayListadoTalle'), ['accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar version']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaVersionRequest $request, $idProducto, $id)
    {
        //
        $producto= SeccionTiendaProducto::find($idProducto);
        $color= SeccionTiendaColor::find($request->get('fk_color'));
        $talle= SeccionTiendaTalle::find($request->get('fk_talle'));

        $razon_social= 'ON';
        $nombre_producto= substr(strtoupper($producto->nombre), 0, 3);
        $nombre_color= substr(strtoupper($color->nombre), 0, 3);
        $nombre_talle= $talle->nombre;

        $codigo_producto= $razon_social.$nombre_producto.$nombre_color.$nombre_talle;

        // version
        $objeto = SeccionTiendaVersion::find($id);

        $objeto->fk_producto = $idProducto;
        $objeto->fk_color = $request->get('fk_color');
        $objeto->fk_talle = $request->get('fk_talle');
        $objeto->stock = $request->get('stock');
        $objeto->codigo_producto = $codigo_producto;

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
    public function destroy($idProducto, $id)
    {
        //
        $objeto= SeccionTiendaVersion::find($id);
        $objeto->delete();

        return back();
    }
}
