<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SeccionTiendaGaleriaRequest extends FormRequest
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
            //crear
            case 'POST':
                return [
                    //
                    // 'fk_producto' => 'required',
                    'imagen' => 'required',
                    'orden' => 'required',
                ];
                break;

            //editar
            case 'PATCH':
                return [
                    //
                    // 'fk_producto' => 'required',
                    'orden' => 'required',
                ];
                break;
            
            default:
                # code...
                break;
        }
    }
}
