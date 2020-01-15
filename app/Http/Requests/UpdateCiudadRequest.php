<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCiudadRequest extends CreateCiudadRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => "required|min:2|max:80",
            'estados_id' => "required",
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
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe tener al menos dos caracteres',
            'nombre.max' => 'El nombre debe tener maximo ochenta dos caracteres',
            'estados_id.required' => 'El estado es requerido',
        ];
    }
}
