<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeccionTiendaProductoRequest;

// Modelo 
use App\SeccionTiendaCategoria;
use App\SeccionTiendaProducto;

// 
use Session;
use Storage;
use File;

class SeccionTiendaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objeto= SeccionTiendaProducto::all()->toArray();


        return view('adm.seccion_tienda_productos.listar', ['variable' => $objeto, 'nombreDeAccion' => 'Lista de productos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $matrizListado= SeccionTiendaCategoria::select('id', 'nombre')->get();
        $arrayListado = array();

        foreach($matrizListado as $arr) {
            $arrayListado[$arr->id] = $arr->nombre;
        }

        return view('adm.seccion_tienda_productos.crear', ['arrayListado' => $arrayListado, 'accion' => 'store', 'verbo' => 'post', 'nombreDeAccion' => 'Crear producto']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeccionTiendaProductoRequest $request)
    {
        $precio_original= $request->get('precio_original');
        $descuento= $request->get('descuento');

        if ($descuento > 0) {
            $cantidad_a_descontar= ($precio_original * $descuento) / 100;
            $precio_con_descuento= $precio_original - $cantidad_a_descontar;
        }else{
            $precio_con_descuento= $request->get('precio_original');
        }

        $objeto= new SeccionTiendaProducto([
            'fk_categoria' => $request->get('fk_categoria'),
            'nombre' => $request->get('nombre'),
            'ruta' => '',
            'descripcion' => $request->get('descripcion'),
            'precio_original' => $request->get('precio_original'),
            'precio_con_descuento' => $precio_con_descuento,
            'descuento' => $request->get('descuento'),
            'coleccion' => $request->get('coleccion'),
            'guia_de_talle' => '',
            'peso' => $request->get('peso'),
            'orden' => $request->get('orden'),
        ]);

        $objeto->save();

        //ruta de imagen
        $rutaDeCarpeta= 'images/seccion_tienda_productos/';
        $idArchivo= SeccionTiendaProducto::max('id');

        // imagen de producto
        if ($request->hasFile('guia_de_talle')) {
            $nombreArchivo= "producto_".$idArchivo;
            $extension= $request->imagen->extension();
            $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

            // Subir imagen:
            $archivo= $request->file('imagen');
            Storage::put($rutaConArchivo, File::get($archivo));

            // guardar ruta
            if ($request->file('imagen')->isValid()) {
                $objeto->ruta = $rutaConArchivo;
                $objeto->save();
            }
        }

        // Guia de talles
        if ($request->hasFile('guia_de_talle')) {
            $nombreArchivoTalle= "guia_talle_".$idArchivo;
            $extensionTalle= $request->guia_de_talle->extension();
            $rutaConArchivoTalle= $rutaDeCarpeta.$nombreArchivoTalle.'.'.$extensionTalle;

            // Subir imagen:
            $archivoTalle= $request->file('guia_de_talle');
            Storage::put($rutaConArchivoTalle, File::get($archivoTalle));

            if ($request->file('guia_de_talle')->isValid()) {
                $objeto->guia_de_talle = $rutaConArchivoTalle;
                $objeto->save();
            }
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
    public function edit($id)
    {
        //

        $objeto= SeccionTiendaProducto::find($id);
        
        $matrizListado= SeccionTiendaCategoria::select('id', 'nombre')->get();
        $arrayListado = array();
        
        foreach($matrizListado as $arr) {
            $arrayListado[$arr->id] = $arr->nombre;
        }
        
        return view('adm.seccion_tienda_productos.editar', compact('objeto'), ['arrayListado' => $arrayListado, 'accion' => 'update', 'verbo' => 'post', 'nombreDeAccion' => 'Editar producto']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeccionTiendaProductoRequest $request, $id)
    {
        $precio_original= $request->get('precio_original');
        $descuento= $request->get('descuento');

        if ($descuento > 0) {
            $cantidad_a_descontar= ($precio_original * $descuento) / 100;
            $precio_con_descuento= $precio_original - $cantidad_a_descontar;
        }else{
            $precio_con_descuento= $request->get('precio_original');
        }
        //
        $objeto = SeccionTiendaProducto::find($id);
        $objeto->fk_categoria = $request->get('fk_categoria');
        $objeto->nombre = $request->get('nombre');
        $objeto->descripcion = $request->get('descripcion');
        $objeto->precio_original = $request->get('precio_original');
        $objeto->precio_con_descuento = $precio_con_descuento;
        $objeto->descuento = $request->get('descuento');
        $objeto->coleccion = $request->get('coleccion');
        $objeto->peso = $request->get('peso');
        $objeto->orden = $request->get('orden');

        //ruta de imagen
        $rutaDeCarpeta= 'images/seccion_tienda_productos/';
        $idArchivo= $id;

        // imagen de producto
        if ($request->hasFile('imagen')) {
            $nombreArchivo= "producto_".$idArchivo;
            $extension= $request->imagen->extension();

            $rutaConArchivo= $rutaDeCarpeta.$nombreArchivo.'.'.$extension;

            // Subir imagen:
            $archivo= $request->file('imagen');
            Storage::put($rutaConArchivo, File::get($archivo));

            if ($request->file('imagen')->isValid()) {
                $objeto->ruta = $rutaConArchivo;
            }
        }

        // guia de talles
        if ($request->hasFile('guia_de_talle')) {
            $nombreArchivoTalle= "guia_talle_".$idArchivo;
            $extensionTalle= $request->guia_de_talle->extension();

            $rutaConArchivoTalle= $rutaDeCarpeta.$nombreArchivoTalle.'.'.$extensionTalle;

            // Subir imagen:
            $archivoTalle= $request->file('guia_de_talle');
            Storage::put($rutaConArchivoTalle, File::get($archivoTalle));

            if ($request->file('guia_de_talle')->isValid()) {
                $objeto->guia_de_talle = $rutaConArchivoTalle;
            }
        }

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
        $objeto= SeccionTiendaProducto::find($id);
        $objeto->delete();

        Storage::delete($objeto->ruta);
        Storage::delete($objeto->guia_de_talle);

        return back();
    }
}
