<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SeccionTiendaTransporteRequest extends FormRequest
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
        return [
            //
            'provincia' => 'required',
            // 'peso_minimo' => 'required|numeric|integer',
            // 'peso_maximo' => 'required|numeric|integer',
            'peso' => 'required',
            'precio' => 'required|numeric',
            // 'orden' => 'required'
        ];
    }
}