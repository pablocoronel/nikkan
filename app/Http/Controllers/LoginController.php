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
        if(Auth::attempt(['usuario' => $request['usuario'], 'password' => $request['clave']])){
            // Session::flash('mensajeOk', 'correcto');
            // return back();
            return redirect('adm');
        }else{
            Session::flash('mensajeError', 'Los datos son incorrectos');
            return back();
        }
    }

    public function cerrar(){
        Auth::logout();
        return redirect('adm');
    }
}
