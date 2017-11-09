<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\AgregarAlCarritoRequest;

use App\SeccionTiendaFamilia;
use App\SeccionTiendaCategoria;
use App\SeccionTiendaProducto;
use App\SeccionTiendaVersion;

use App\SeccionColeccionPortada;
use App\SeccionDiscontinuoPortada;

use App\SeccionTiendaGaleria;

use DB;

class PaginaTiendaController extends Controller
{
	// elegir portada segun seccion
	private function elegirPortada($tipoDeColeccion){
		switch ($tipoDeColeccion) {
    	 		case 'coleccion':
			    	$portada= SeccionColeccionPortada::find(1);
    	 			break;

    	 		case 'discontinuo':
			    	$portada= SeccionDiscontinuoPortada::find(1);
    	 			break;
    	 		
    	 		default:
    	 			$portada= null;
    	 			break;
    	}

    	return $portada;
	}

    //
    public function listadoDeFamilias($tipoDeColeccion){
    	$portada= $this->elegirPortada($tipoDeColeccion);

    	$familias= SeccionTiendaFamilia::all();

    	return view('sitio.tienda_familia', compact('tipoDeColeccion', 'portada', 'familias'));
    }

    public function listadoDeProductos($tipoDeColeccion, $idFamilia){
    	$portada= $this->elegirPortada($tipoDeColeccion);


    	$productos= SeccionTiendaProducto::join('seccion_tienda_categorias', 'seccion_tienda_productos.fk_categoria', '=', 'seccion_tienda_categorias.id')
            ->select('seccion_tienda_productos.*', 'seccion_tienda_categorias.fk_familia')
            ->where('seccion_tienda_categorias.fk_familia', '=', $idFamilia)
            ->where('coleccion', '=', $tipoDeColeccion)
            ->get();

        $listadoCategorias= array();
        $matrizCategorias= SeccionTiendaCategoria::join('seccion_tienda_familias', 'seccion_tienda_categorias.fk_familia', '=', 'seccion_tienda_familias.id')
			->select('seccion_tienda_categorias.*')
			->where('seccion_tienda_categorias.fk_familia', '=', $idFamilia)
			->get();

		foreach ($matrizCategorias as $cadaUna) {
			$listadoCategorias[$cadaUna->id]= $cadaUna->nombre;
		}

 		return view('sitio.tienda_listadoProducto', compact('tipoDeColeccion', 'portada', 'productos', 'listadoCategorias', 'idFamilia'));
    }

    public function filtrarPorCategoria(Request $request, $tipoDeColeccion, $idFamilia){
    	$portada= $this->elegirPortada($tipoDeColeccion);


    	$productos= SeccionTiendaProducto::join('seccion_tienda_categorias', 'seccion_tienda_productos.fk_categoria', '=', 'seccion_tienda_categorias.id')
            ->select('seccion_tienda_productos.*', 'seccion_tienda_categorias.fk_familia')
            ->where('seccion_tienda_categorias.fk_familia', '=', $idFamilia)
            ->where('coleccion', '=', $tipoDeColeccion)
            ->where('fk_categoria', '=', $request->idCategoria)
            ->get();


        $listadoCategorias= array();
        $matrizCategorias= SeccionTiendaCategoria::join('seccion_tienda_familias', 'seccion_tienda_categorias.fk_familia', '=', 'seccion_tienda_familias.id')
			->select('seccion_tienda_categorias.*')
			->where('seccion_tienda_categorias.fk_familia', '=', $idFamilia)
			->get();

		foreach ($matrizCategorias as $cadaUna) {
			$listadoCategorias[$cadaUna->id]= $cadaUna->nombre;
		}

 		return view('sitio.tienda_listadoProducto', compact('tipoDeColeccion', 'portada', 'productos', 'listadoCategorias', 'idFamilia'));
    }

    public function verProducto($tipoDeColeccion, $idProducto){
    	$portada= $this->elegirPortada($tipoDeColeccion);

    	$producto= SeccionTiendaProducto::find($idProducto);

    	$galeria= SeccionTiendaGaleria::where('fk_producto', '=', $idProducto)->get();

    	// lista de talles
    	$todasLasVersionesTalle= SeccionTiendaVersion::join('seccion_tienda_talles', 'seccion_tienda_versiones.fk_talle', '=', 'seccion_tienda_talles.id')
    		->select(DB::raw('seccion_tienda_versiones.*, seccion_tienda_talles.nombre as nombreTalle'))
			->where('seccion_tienda_versiones.fk_producto', '=', $idProducto)
			->groupBy('nombreTalle')
			->get();


    	$listadoTalles= array();
		foreach ($todasLasVersionesTalle as $cadaVersion) {
			$listadoTalles[$cadaVersion->fk_talle]= $cadaVersion->nombreTalle;
		}

		// lista de colores
		$todasLasVersionesColor= SeccionTiendaVersion::join('seccion_tienda_colores', 'seccion_tienda_versiones.fk_color', '=', 'seccion_tienda_colores.id')
    		->select(DB::raw('seccion_tienda_versiones.*, seccion_tienda_colores.nombre as nombreColor'))
			->where('seccion_tienda_versiones.fk_producto', '=', $idProducto)
			->groupBy('nombreColor')
			->get();

		$listadoColores= array();
		foreach ($todasLasVersionesColor as $cadaVersion) {
			$listadoColores[$cadaVersion->fk_color]= $cadaVersion->nombreColor;
		}

    	return view('sitio.tienda_verProducto', compact('tipoDeColeccion', 'portada', 'galeria', 'producto', 'listadoTalles', 'listadoColores'));
    }


    public function agregarAlCarrito(AgregarAlCarritoRequest $request, $tipoDeColeccion, $idProducto){

    }
}
