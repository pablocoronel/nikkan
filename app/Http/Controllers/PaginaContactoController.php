<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeccionContactoMapa;
use App\SeccionContactoPortada;

class PaginaContactoController extends Controller
{
    public function index(){
    	$portada= SeccionContactoPortada::find(1);
    	$mapa= SeccionContactoMapa::find(1);

    	return view('sitio.contacto', compact('portada', 'mapa'));
    }

    public function enviarEmail(){
    	return view();
    }
}
