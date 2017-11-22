<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (Auth::check()) {
            return true;
        // }else{
            // return false;
        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            //crear
            case 'POST':
                return [
                    //
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'usuario' => 'required|unique:users,usuario',
                    'clave' => 'required',
                    'email' => 'required|unique:users,email',
                    'fecha_nacimiento' => 'required|date_format:"Y-m-d"',
                    'tratamiento' => 'required',
                    // 'nivel' => 'required',
                ];
                break;
            
            //editar
            case 'PATCH':
                return [
                    //
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'usuario' => 'required|unique:users,usuario',
                    'email' => 'required|email|unique:users,email',
                    'fecha_nacimiento' => 'required|date_format:"Y-m-d"',
                    'tratamiento' => 'required',
                    // 'nivel' => 'required',
                ];
                break;

            default:
                # code...
                break;
        }
    }
}
