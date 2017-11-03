<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeccionEmpresaPortada;
use App\SeccionEmpresaSlider;

class PaginaEmpresaController extends Controller
{
    //  
    public function index(){
    	$portada= SeccionEmpresaPortada::find(1);
    	$slider= SeccionEmpresaSlider::all();

    	return view('sitio.empresa', compact('portada', 'slider'));
    }
}
