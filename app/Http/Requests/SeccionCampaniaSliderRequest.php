<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SeccionCampaniaSliderRequest extends FormRequest
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
                    // 'texto' => 'required',
                    // 'vinculo' => 'required',
                    'imagen' => 'required',
                    'orden' => 'required',
                ];
                break;

            //editar
            case 'PATCH':
                return [
                    //
                    // 'texto' => 'required',
                    // 'vinculo' => 'required',
                    'orden' => 'required',
                ];
                break;
            
            default:
                # code...
                break;
        }
    }
}
