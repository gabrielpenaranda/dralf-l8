<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePruebaLisanteRequest extends FormRequest
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
            'ph' => "numeric|required",
            'conductividad' => "numeric|required",
            'contaje' => "numeric|required",
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
            'conductividad.numeric' => "El valor de CONDUCTIVIDAD debe ser numérico",
            'contaje.numeric' => "El valor CONTAJE debe ser numérico",
            'ph.required' => "El valor de PH es requerido",
            'conductividad.required' => "El valor de CONDUCTIVIDAD es requerido",
            'contaje.required' => "El valor CONTAJE es requerido",
        ];
    }
}
