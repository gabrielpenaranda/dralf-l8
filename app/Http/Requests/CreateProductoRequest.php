<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductoRequest extends FormRequest
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

    public function rules()
    {
        return [
            'codigo' => 'required|min:2|max:30',
            'nombre' => 'required|min:1|max:50',
            'capacidad' => 'required|numeric|min:0,01',
            'unidadmedidas_id' => 'required',
            'tipoproductos_id' => 'required',
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
            'codigo.required' => 'El código de producto es requerido',
            'codigo.min' => 'El código de producto debe tener al menos 2 caracteres',
            'codigo.max' => 'El código de producto debe tener máximo 30 caracteres',
            'nombre.required' => 'El nombre del producto es requerido',
            'capacidad.required' => 'La capacidad es requerida',
            'capacidad.numeric' => 'La capacidad debe ser un numero',
            'capacidad.min' => 'Capacidad mínima es 0,01',
            'unidadmedidas_id' => 'Unidad de medida es requerida',
            'tipoproductos_id' => 'Tipo de producto es requerida',
        ];
    }
}
