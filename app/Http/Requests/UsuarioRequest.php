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
        if (Auth::check()) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    //
                    'nombre' => 'required',
                    'usuario' => 'required',
                    'clave' => 'required',
                    'nivel' => 'required',
                ];
                break;
            
            case 'PATCH':
                return [
                    //
                    'nombre' => 'required',
                    'usuario' => 'required',
                    'nivel' => 'required',
                ];
                break;

            default:
                # code...
                break;
        }
    }
}
