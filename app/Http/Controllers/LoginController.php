<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Usuario;
use Auth;
use Session;
use Redirect;

class LoginController extends Controller
{
    //
    public function index(){

	}
    
    public function iniciar(LoginRequest $request){
        // $recuerdame= $request['recuerdame'];
        
        // if(Auth::attempt(['usuario' => $request['usuario'], 'clave' => $request['clave']])){
        //     return back();
        // }else{
        //     Session::flash('mensaje', 'Los datos son incorrectos');
        //     return back();
        // }
    }

    public function cerrar(){
        Auth::logout();
        return redirect('adm');
    }
}
