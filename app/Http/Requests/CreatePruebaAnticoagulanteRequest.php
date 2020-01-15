<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePruebaAnticoagulanteRequest extends FormRequest
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
            'ph' => "required|numeric",
            'tubo' => "required|numeric",
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
            'ph.required' => "El valor de PH es requerido",
            'tubo.numeric' => "El valor de tubo debe ser numérico",
            'tubo.required' => "El valor de tubo es requerido",
        ];
    }
}
