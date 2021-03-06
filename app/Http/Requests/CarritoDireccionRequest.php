<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarritoDireccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'direccion' => 'required',
            'codigo_postal' => 'required|numeric|digits_between:4,6',
            'ciudad' => 'required',
            'provincia' => 'required',
            'pais' => 'required',
            'telefono_domicilio' => 'required_without:telefono_celular',
            'telefono_celular' => 'required_without:telefono_domicilio'            
        ];
    }
}
