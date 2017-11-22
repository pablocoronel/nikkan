<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;
use App\SeccionTiendaCupon;
class SeccionTiendaCuponRequest extends FormRequest
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
        // $cupon= new SeccionTiendaCupon();
        switch ($this->method()) {
            //crear
            case 'POST':
                return [
                    //
                    'codigo_cupon' => 'required|unique:seccion_tienda_cupones,codigo_cupon',
                    'vigencia_inicio' => 'required|date_format:"Y-m-d"|before:vigencia_fin',
                    'vigencia_fin' => 'required|date_format:"Y-m-d"|after:vigencia_inicio',
                    'tipo_descuento' => 'required',
                    'descuento_porcentual' => 'required_if:tipo_descuento,porcentual|required_without:descuento_monetario',
                    'descuento_monetario' => 'required_if:tipo_descuento,monetario|required_without:descuento_porcentual',
                ];
                break;
            //editar
            case 'PATCH':
                return [
                    //
                    // 'codigo_cupon' => 'required|'.Rule::unique('seccion_tienda_cupones')->ignore($cupon->id),
                    'vigencia_inicio' => 'required|date_format:"Y-m-d"|before:vigencia_fin',
                    'vigencia_fin' => 'required|date_format:"Y-m-d"|after:vigencia_inicio',
                    'tipo_descuento' => 'required',
                    'descuento_porcentual' => 'required_if:tipo_descuento,porcentual|required_without:descuento_monetario',
                    'descuento_monetario' => 'required_if:tipo_descuento,monetario|required_without:descuento_porcentual',
                ];
                break;
            
            default:
                # code...
                break;
        }
    }
}
