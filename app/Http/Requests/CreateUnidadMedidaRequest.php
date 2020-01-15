<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUnidadMedidaRequest extends FormRequest
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
            'unidad' => "required|unique:unidadmedidas,unidad|min:2|max:30",
            'abreviatura' => "required|unique:unidadmedidas,abreviatura|min:2|max:10",
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
            'unidad.required' => 'La unidad es requerida',
            'unidad.unique' => "La unidad se encuentra registrada",
            'unidad.min' => 'La unidad debe tener entre 2 y 30 caracteres',
            'unidad.max' => 'La unidad debe tener entre 2 y 30 caracteres',
            'abreviatura.required' => 'La abreviatura es requerida',
            'abreviatura.unique' => "La abreviatura se encuentra registrada",
            'abreviatura.min' => 'La abreviatura debe tener entre 2 y 10 caracteres',
            'abreviatura.max' => 'La abreviatura debe tener entre 2 y 10 caracteres',
        ];
    }
}
