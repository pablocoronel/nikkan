<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeccionHomeSlider;
use App\SeccionHomeDestacado;

class PaginaHomeController extends Controller
{
    //
    public function index(){
    	$slider= SeccionHomeSlider::orderBy('orden', 'asc')->get();

    	$destacados= SeccionHomeDestacado::orderBy('orden', 'asc')->get();

    	return view('index', compact('slider', 'destacados'));
    }
}
