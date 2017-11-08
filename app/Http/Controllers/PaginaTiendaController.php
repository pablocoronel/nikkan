<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SeccionTiendaFamilia;
use App\SeccionTiendaCategoria;
use App\SeccionTiendaProducto;

use App\SeccionColeccionPortada;
use App\SeccionDiscontinuoPortada;



class PaginaTiendaController extends Controller
{
    //
    public function coleccionListadoDeFamilias(){
    	$nombreDeSeccion= 'coleccion';
    	
    	$portada= SeccionColeccionPortada::find(1);
    	$familias= SeccionTiendaFamilia::all();

    	return view('sitio.tienda_familia', compact('nombreDeSeccion', 'portada', 'familias'));
    }

    public function coleccionListadoDeProductos($idFamiia){
    	$nombreDeSeccion= 'coleccion';

    	$portada= SeccionColeccionPortada::find(1);


    	$productos= SeccionTiendaProducto::join('seccion_tienda_categorias', 'seccion_tienda_productos.fk_categoria', '=', 'seccion_tienda_categorias.id')
            ->select('seccion_tienda_productos.*', 'seccion_tienda_categorias.fk_familia')
            ->where('seccion_tienda_categorias.fk_familia', '=', $idFamiia)
            ->where('coleccion', '=', 'coleccion')
            ->get();

        $listadoCategorias= array();
        $matrizCategorias= SeccionTiendaCategoria::join('seccion_tienda_familias', 'seccion_tienda_categorias.fk_familia', '=', 'seccion_tienda_familias.id')
			->select('seccion_tienda_categorias.*')
			->where('seccion_tienda_categorias.fk_familia', '=', $idFamiia)
			->get();

		foreach ($matrizCategorias as $cadaUna) {
			$listadoCategorias[$cadaUna->id]= $cadaUna->nombre;
		}

 		return view('sitio.tienda_listadoProducto', compact('nombreDeSeccion', 'portada', 'productos', 'listadoCategorias'));
    }

// seguir aca
    public function coleccionFiltrarPorCategoria(){

    }







    /*** DISCONTINUOS ***/
    public function discontinuosListadoDeFamilias(){
    	$nombreDeSeccion= 'discontinuos';
    	$portada= SeccionDiscontinuoPortada::find(1);
    	$familias= SeccionTiendaFamilia::all();

    	return view('sitio.tienda_familia', compact('nombreDeSeccion', 'portada', 'familias'));
    }

    public function discontinuosListadoDeProductos($idFamiia){
    	$nombreDeSeccion= 'discontinuos';

    	$portada= SeccionDiscontinuoPortada::find(1);


    	$productos= SeccionTiendaProducto::join('seccion_tienda_categorias', 'seccion_tienda_productos.fk_categoria', '=', 'seccion_tienda_categorias.id')
            ->select('seccion_tienda_productos.*', 'seccion_tienda_categorias.fk_familia')
            ->where('seccion_tienda_categorias.fk_familia', '=', $idFamiia)
            ->where('coleccion', '=', 'discontinuo')
            ->get();

 		return view('sitio.tienda_listadoProducto', compact('nombreDeSeccion', 'portada', 'productos'));
    }
}
