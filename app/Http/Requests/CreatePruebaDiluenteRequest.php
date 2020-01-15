<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePruebaDiluenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::user())
        {
            return true;
        }
        else
        {
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
            'ph' => "numeric",
            'conductividad' => "numeric",
            'plt_1' => "numeric",
            'plt_2' => "numeric",
            'plt_3' => "numeric",
            'plt_4' => "numeric",
            'plt_5' => "numeric",
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ph.numeric' => "El valor de PH debe ser numérico",
            'conductividad.numeric' => "El valor de conductividad debe ser numérico",
            'plt_1.numeric' => "El valor PLT 1 debe ser numérico",
            'plt_2.numeric' => "El valor PLT 2 debe ser numérico",
            'plt_3.numeric' => "El valor PLT 3 debe ser numérico",
            'plt_4.numeric' => "El valor PLT 4 debe ser numérico",
            'plt_5.numeric' => "El valor PLT 5 debe ser numérico",
            'ph.required' => "El valor de PH es requerido",
            'conductividad.required' => "El valor de conductividad es requerido",
            'plt_1.required' => "El valor PLT 1 es requerido",
            'plt_2.required' => "El valor PLT 2 es requerido",
            'plt_3.required' => "El valor PLT 3 es requerido",
            'plt_4.required' => "El valor PLT 4 es requerido",
            'plt_5.required' => "El valor PLT 5 es requerido",
        ];
    }
}
