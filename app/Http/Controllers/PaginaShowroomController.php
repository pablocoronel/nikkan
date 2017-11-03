<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeccionShowroomPortada;
use App\SeccionShowroomSlider;

class PaginaShowroomController extends Controller
{
    //
    public function index(){
    	$portada= SeccionShowroomPortada::find(1);
    	$slider= SeccionShowroomSlider::all();

    	return view('sitio.showroom', compact('portada', 'slider'));
    }
}
