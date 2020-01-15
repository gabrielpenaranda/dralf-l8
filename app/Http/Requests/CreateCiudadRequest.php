<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCiudadRequest extends FormRequest
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
            'nombre' => "required|unique:ciudades,nombre|min:2|max:80",
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
            'nombre.unique' => 'El nombre ya existe',
            'nombre.min' => 'El nombre debe tener al menos dos caracteres',
            'nombre.max' => 'El nombre debe tener maximo ochenta dos caracteres',
            'estados_id.required' => 'El estado es requerido',
        ];
    }
}
