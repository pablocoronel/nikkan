<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeccionCampaniaSlider;

class PaginaCampaniaController extends Controller
{
    //
    public function index(){
    	$slider= SeccionCampaniaSlider::all();

    	return view('sitio.campania', compact('slider'));
    }
}
