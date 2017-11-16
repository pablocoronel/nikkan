<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginClienteRequest;
use App\Http\Requests\UsuarioRequest;

use App\Usuario;
use App\SeccionColeccionPortada;
use Auth;
use Session;
use Redirect;

use Gloudemans\Shoppingcart\Facades\Cart;

class LoginController extends Controller
{
    //
    public function index(){
        
	}
    
    public function iniciarAdmin(LoginRequest $request){
        if(Auth::attempt(['usuario' => $request['usuario'], 'password' => $request['clave'], 'nivel' => 'administrador'])){
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
        Cart::destroy();
        return redirect('adm');
    }

    public function entrarCliente(){
        $portada= SeccionColeccionPortada::find(1);

        return view('sitio.login', compact('portada'));
    }

    public function iniciarCliente(LoginClienteRequest $request){
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['clave'], 'nivel' => 'usuario_normal'])){
            // Session::flash('mensajeOk', 'correcto');
            // return back();
            return redirect('carrito');
        }else{
            Session::flash('mensajeError', 'Los datos son incorrectos');
            return back();
        }
    }

    public function cerrarCliente(){
        Auth::logout();
        Cart::destroy();

        return redirect('/');
    }

    // registro de clientes
    public function registrarCliente(UsuarioRequest $request){
        $objeto= new Usuario([
            'nivel' => 'usuario_normal',
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'usuario' => $request->get('usuario'),
            'password' => bcrypt($request->get('clave')),
            'tratamiento' => $request->get('tratamiento'),
            'fecha_nacimiento' => $request->get('fecha_nacimiento'),
        ]);

        $objeto->save();

        // para mostrar msj de exito
        Session::flash('guardado', 'registrado correctamente');
        return back();
    }

}
